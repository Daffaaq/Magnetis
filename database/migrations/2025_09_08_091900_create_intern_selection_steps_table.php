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
        Schema::create('intern_selection_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intern_position_batch_id')->index();
            $table->foreign('intern_position_batch_id')->references('id')->on('intern_position_batches')->onDelete('cascade');
            $table->unsignedBigInteger('selection_step_id')->index();
            $table->foreign('selection_step_id')->references('id')->on('selection_steps')->onDelete('cascade');
            $table->integer('step_order_intern_selection_steps');
            $table->boolean('is_mondatory_intern_selection_steps');
            $table->boolean('is_invitation_only_intern_selection_steps');
            $table->text('description_intern_selection_steps');
            $table->date('estimated_start_date_intern_selection_steps');
            $table->date('estimated_end_date_intern_selection_steps');
            $table->enum('status_intern_selection_steps', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_selection_steps');
    }
};
