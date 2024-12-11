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
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('id')->on('members')->onDelete('cascade');

            $table->date('testTakenDate');
            $table->text('Answered');
            $table->boolean('isCorrect')->default(false);
            $table->integer('questID');
            $table->unsignedBigInteger('sectionID');
            $table->foreign('sectionID')->references('id')->on('sections')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
