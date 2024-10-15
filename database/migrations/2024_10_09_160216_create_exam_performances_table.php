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
        Schema::create('exam_performances', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID

            $table->timestamps(); // Created and updated timestamps

            $table->integer('userID'); // Foreign key to the members table

            $table->date('ExamTakenDate'); // Date of the exam
            $table->integer('correctAnswered')->default(0); // Number of correct answers
            $table->integer('inCorrectAnswered')->default(0); // Number of incorrect answers
            $table->boolean('isPassed')->default(false); // Exam pass status

            $table->integer('examID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_performances');
    }
};
