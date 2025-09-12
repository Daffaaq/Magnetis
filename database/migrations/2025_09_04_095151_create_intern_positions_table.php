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
        Schema::create('intern_positions', function (Blueprint $table) {
            $table->id();
            $table->string('name_intern_positions');
            $table->text('description_intern_positions');
            $table->unsignedBigInteger('department_id')->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->enum('status_intern_positions', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_positions');
    }
};
