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
        Schema::create('mentor_schedule_slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intern_mentor_id')->index();
            $table->foreign('intern_mentor_id')->references('id')->on('intern_mentors')->onDelete('cascade');
            $table->unsignedBigInteger('mentor_batch_assignments_id')->index();
            $table->foreign('mentor_batch_assignments_id')->references('id')->on('mentor_batch_assignments')->onDelete('cascade');
            $table->unsignedBigInteger('intern_selection_step_id')->index();
            $table->foreign('intern_selection_step_id')->references('id')->on('intern_selection_steps')->onDelete('cascade');
            $table->date('date_mentor_schedule_slots');
            $table->time('start_time_mentor_schedule_slots');
            $table->time('end_time_mentor_schedule_slots');
            $table->string('location_mentor_schedule_slots')->nullable();
            $table->string('meeting_link_mentor_schedule_slots')->nullable();
            $table->boolean('is_booked_mentor_schedule_slots')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_schedule_slots');
    }
};
