<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('course_takens', function (Blueprint $table) {
        $table->id();
        $table->string('npm', 12); // ganti user_id
        $table->string('course_name');
        $table->integer('sks');
        $table->string('semester'); // misal: Ganjil 2024/2025
        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('course_takens');
    }
};
