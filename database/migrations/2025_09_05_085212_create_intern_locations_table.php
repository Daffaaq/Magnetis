<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('intern_locations', function (Blueprint $table) {
            $table->id();
            $table->string('intern_location_name');
            $table->text('intern_location_address');
            $table->string('intern_location_province');
            $table->string('intern_location_regency');
            $table->string('intern_location_district');
            $table->string('intern_location_village');
            $table->string('intern_location_country');
            $table->string('intern_location_postal_code')->nullable();
            $table->string('intern_location_phone_number')->nullable();
            $table->enum('intern_location_type', ['head_office', 'branch']);
            $table->enum('intern_location_status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_locations');
    }
};
