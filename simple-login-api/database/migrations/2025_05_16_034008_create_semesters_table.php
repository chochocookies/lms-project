<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('semesters', function (Blueprint $table) {
        $table->id();
        $table->string('npm', 12); // FK ke users.npm
        $table->string('name');
        $table->date('start_date');
        $table->date('end_date');
        $table->timestamps();

        $table->foreign('npm')->references('npm')->on('users')->onDelete('cascade');
    });


    }

    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
