<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique(); // e.g. 2411600117
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('course'); // e.g. BSIT, BSCS
            $table->string('year_level'); // 1st Year, 2nd Year, etc.
            $table->decimal('grade', 5, 2)->nullable(); // overall grade 0-100
            $table->string('status')->default('Active'); // Active, Incomplete, Dropped
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
