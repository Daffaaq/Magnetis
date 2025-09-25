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
        Schema::create('intern_position_batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intern_position_id')->index();
            $table->foreign('intern_position_id')->references('id')->on('intern_positions')->onDelete('cascade');
            $table->unsignedBigInteger('intern_batch_id')->index();
            $table->foreign('intern_batch_id')->references('id')->on('intern_batches')->onDelete('cascade');
            $table->unsignedBigInteger('intern_location_id')->index();
            $table->foreign('intern_location_id')->references('id')->on('intern_locations')->onDelete('cascade');
            $table->string('slug_intern_position_batches')->unique();
            $table->integer('quota_intern_position_batches');
            $table->enum('status_intern_position_batches', ['active', 'inactive'])->default('active');
            $table->date('start_date_intern_position_batches');
            $table->date('end_date_intern_position_batches');
            $table->date('start_internship_position_batches');
            $table->date('end_internship_position_batches');
            $table->text('description_intern_position_batches');
            $table->text('apply_requirements_intern_position_batches');
            $table->text('benefits_intern_position_batches');
            $table->enum('compensation_intern_position_batches', ['paid', 'unpaid'])->default('paid');
            $table->decimal('compensation_amount_intern_position_batches', 10, 2)->nullable();
            $table->text('compensation_description_intern_position_batches')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_position_batches');
    }
};
