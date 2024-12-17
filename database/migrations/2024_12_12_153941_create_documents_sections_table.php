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
        Schema::create('documents_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
        $table->string('section_number');
        $table->string('title')->nullable();
        $table->text('content')->nullable();
        $table->unsignedBigInteger('parent_section_id')->nullable();

        $table->foreign('document_id')
              ->references('id')
              ->on('documents')
              ->onDelete('cascade');

        $table->foreign('parent_section_id')
              ->references('id')
              ->on('sections')
              ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_sections');
    }
};
