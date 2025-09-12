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
        Schema::create('intern_batches', function (Blueprint $table) {
            $table->id();
            $table->string('name_intern_batches');
            $table->text('description_intern_batches');
            $table->date('start_date_intern_batches');
            $table->date('end_date_intern_batches');
            $table->enum('status_intern_batches', ['upcoming', 'ongoing', 'completed'])->default('upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_batches');
    }
};
