<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternLocation extends Model
{
    use HasFactory;

    protected $table = 'intern_locations';

    // Kolom-kolom yang boleh diisi massal
    protected $fillable = [
        'intern_location_name',
        'intern_location_address',
        'intern_location_province',
        'intern_location_regency',
        'intern_location_district',
        'intern_location_village',
        'intern_location_country',
        'intern_location_postal_code',
        'intern_location_phone_number',
        'intern_location_type',
        'intern_location_status',
    ];
}
