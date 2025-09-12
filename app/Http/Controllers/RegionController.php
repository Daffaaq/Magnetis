<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class RegionController extends Controller
{
    /**
     * Get regencies (kabupaten/kota) berdasarkan nama provinsi
     */
    public function getRegencies($province_name)
    {
        $province = Province::where('name', $province_name)->first();

        if (!$province) {
            return response()->json(['error' => 'Province not found'], 404);
        }

        $regencies = Regency::where('province_id', $province->id)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($regencies);
    }

    /**
     * Get districts (kecamatan) berdasarkan nama kabupaten/kota
     */
    public function getDistricts($regency_name)
    {
        $regency = Regency::where('name', $regency_name)->first();

        if (!$regency) {
            return response()->json(['error' => 'Regency not found'], 404);
        }

        $districts = District::where('regency_id', $regency->id)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($districts);
    }

    /**
     * Get villages (desa/kelurahan) berdasarkan nama kecamatan
     */
    public function getVillages($district_name)
    {
        $district = District::where('name', $district_name)->first();

        if (!$district) {
            return response()->json(['error' => 'District not found'], 404);
        }

        $villages = Village::where('district_id', $district->id)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($villages);
    }
}
