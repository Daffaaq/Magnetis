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
        Schema::create('mentor_batch_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intern_mentor_id')->index();
            $table->foreign('intern_mentor_id')->references('id')->on('intern_mentors')->onDelete('cascade');
            $table->unsignedBigInteger('intern_position_batch_id')->index();
            $table->foreign('intern_position_batch_id')->references('id')->on('intern_position_batches')->onDelete('cascade');
            $table->enum('status_mentor_batch_assignments', ['active', 'inactive', 'resigned', 'on_leave'])->default('active');
            $table->text('note_mentor_batch_assignments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_batch_assignments');
    }
};
