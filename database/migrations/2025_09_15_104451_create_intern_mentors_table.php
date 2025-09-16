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
        Schema::create('intern_mentors', function (Blueprint $table) {
            $table->id();
            $table->string('name_intern_mentors');
            $table->string('email_intern_mentors');
            $table->string('phone_intern_mentors');
            $table->unsignedBigInteger('department_id')->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status_intern_mentors', ['active', 'inactive'])->default('active');
            $table->text('bio_intern_mentors');
            $table->string('position_title_intern_mentors');
            $table->string('profile_picture_intern_mentors')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_mentors');
    }
};
