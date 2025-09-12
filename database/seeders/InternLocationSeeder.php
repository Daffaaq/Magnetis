<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternLocation;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Faker\Factory as Faker;

class InternLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $allowedLocations = [
            'JAWA BARAT'   => 'Kota Bandung',
            'JAWA TIMUR'   => 'Kota Surabaya',
            'JAWA TENGAH'  => 'Kota Semarang',
            'DKI JAKARTA'  => 'Jakarta Selatan',
        ];

        foreach ($allowedLocations as $provinceName => $regencyName) {
            $province = Province::where('name', $provinceName)->first();

            if (!$province) {
                $this->command->error("Provinsi $provinceName tidak ditemukan");
                continue;
            }

            $regency = Regency::where('province_id', $province->id)
                ->where('name', 'LIKE', "%$regencyName%")
                ->first();

            if (!$regency) {
                $this->command->error("Regency $regencyName tidak ditemukan untuk provinsi $provinceName");
                continue;
            }

            $district = District::where('regency_id', $regency->id)
                ->inRandomOrder()
                ->first();

            if (!$district) {
                $this->command->error("District tidak ditemukan untuk regency {$regency->name}");
                continue;
            }

            $village = Village::where('district_id', $district->id)
                ->inRandomOrder()
                ->first();

            if (!$village) {
                $this->command->error("Village tidak ditemukan untuk district {$district->name}");
                continue;
            }

            // Set location type
            $locationType = ($provinceName === 'DKI JAKARTA') ? 'head_office' : 'branch';

            // Generate random postal code: 5 digits
            $postalCode = $faker->numberBetween(10000, 99999);

            // Faker address example
            $address = $faker->streetAddress;

            // Tentukan nama lokasi berdasarkan tipe
            if ($locationType === 'head_office') {
                // Head Office: pakai nama provinsi saja (contoh: "Head Office Jakarta")
                // Karena DKI JAKARTA provinsinya 'DKI JAKARTA', kita ubah jadi 'Jakarta'
                $locationName = 'Head Office ' . ($provinceName === 'DKI JAKARTA' ? 'Jakarta' : $provinceName);
            } else {
                // Branch Office: pakai regency tanpa kata 'Kota'
                $cleanRegencyName = str_ireplace('Kota ', '', $regencyName);
                $locationName = 'Branch Office ' . $cleanRegencyName;
            }

            InternLocation::create([
                'intern_location_name'         => $locationName,
                'intern_location_address'      => $address,
                'intern_location_province'     => $province->name,
                'intern_location_regency'      => $regency->name,
                'intern_location_district'     => $district->name,
                'intern_location_village'      => $village->name,
                'intern_location_country'      => 'Indonesia',
                'intern_location_postal_code'  => $postalCode,
                'intern_location_phone_number' => $faker->phoneNumber,
                'intern_location_type'         => $locationType,
                'intern_location_status'       => 'active',
            ]);

            $this->command->info("✅ Intern Location berhasil di-seed untuk: $provinceName - $regencyName - $district->name - $village->name (type: $locationType)");
        }
    }
}
