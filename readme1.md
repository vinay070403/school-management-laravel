1. # users------>Stores all users (Super Admin, Admin, School Admin, Counsellor, Student).
    id
    first_name
    last_name
    email
    dob
    avatar
    address
    school_id
    country_id
    state_id
    zipcode
    password
    email_verified_at
    interest
    goal
    created_at
    updated_at
    ===========================

countries--->

id
name
created_at
updated_at
===========================

states--->

id
country_id
name
created_at
updated_at
=========================

4. # schools-->Stores school information for school management.

    id
    name
    state_id ---->Foreign key referencing the states table, links the school to a state.
    address
    zipcode
    created_at
    updated_at
    =========================

5. # subject--

    id
    school_id
    name
    created_at
    updated_at

6. # grade_scales--->Stores grade scale information for GPA calculation, linked to schools.

    id
    school_id -->Foreign key referencing the schools table, links the grade scale to a school.
    grade
    min_score
    max_score
    grade_point
    created_at
    updated_at
    =========================

7. # classes-->Stores class information, linked to schools.

    id
    school_id -->Foreign key referencing the schools table, links the class to a school.
    name
    created_at
    updated_at
    =========================

8. # student_grades-->Stores grades for users with the Student role.
    id
    student_id --->Foreign key referencing the users table, identifies the student.
    class_id -->Foreign key referencing the classes table, links the grade to a class.
    subject_id
    grade_id
    created_at
    updated_at
    ========================

password_resets---->

email
token
created_at

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->string('avatar')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('school_id')->nullable()->constrained('schools')->onDelete('set null');
            $table->foreignId('country_id')->constrained('countries')->onDelete('restrict');
            $table->foreignId('state_id')->constrained('states')->onDelete('restrict');
            $table->string('zipcode')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->text('interest')->nullable(); // Fixed typo from 'intrest'
            $table->text('goal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
