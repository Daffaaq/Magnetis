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
        Schema::create('intern_candidate_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('fullname_intern_candidate_profiles');
            $table->string('email_intern_candidate_profiles');
            $table->date('date_of_birth_intern_candidate_profiles');
            $table->enum('gender_intern_candidate_profiles', ['male', 'female']);
            $table->string('university_intern_candidate_profiles')->nullable();
            $table->string('major_intern_candidate_profiles')->nullable();
            $table->integer('semester_intern_candidate_profiles')->nullable();
            $table->decimal('gpa_intern_candidate_profiles', 3, 2)->nullable();
            $table->text('address_intern_candidate_profiles');
            $table->string('province_intern_candidate_profiles');
            $table->string('regency_intern_candidate_profiles');
            $table->string('district_intern_candidate_profiles');
            $table->string('village_intern_candidate_profiles');
            $table->string('country_intern_candidate_profiles');
            $table->string('phone_number_intern_candidate_profiles');
            $table->string('linkedin_intern_candidate_profiles')->nullable();
            $table->string('github_intern_candidate_profiles')->nullable();
            $table->string('portfolio_intern_candidate_profiles')->nullable();
            $table->text('bio_intern_candidate_profiles')->nullable();
            $table->text('soft_skills_intern_candidate_profiles')->nullable();
            $table->text('hard_skills_intern_candidate_profiles')->nullable();
            $table->string('profile_picture_intern_candidate_profiles')->nullable();
            $table->string('type_profile_picture_intern_candidate_profiles')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_candidate_profiles');
    }
};
