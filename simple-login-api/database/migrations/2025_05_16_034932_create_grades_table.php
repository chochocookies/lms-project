<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
        $table->id();
        $table->string('npm', 12); // FK ke users.npm
        $table->string('subject_name');
        $table->string('grade');
        $table->float('grade_point');
        $table->integer('sks');
        $table->unsignedBigInteger('semester_id')->nullable(); // FIX: foreign key must be unsignedBigInteger
        $table->timestamps();

        // Foreign keys
        $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('set null');
        $table->foreign('npm')->references('npm')->on('users')->onDelete('cascade');
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
