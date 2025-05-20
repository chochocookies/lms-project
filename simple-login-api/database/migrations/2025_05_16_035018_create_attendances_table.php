<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
        $table->id();
        $table->string('npm', 12); // ganti user_id
        $table->date('date');
        $table->string('status'); // hadir, izin, sakit, alfa
        $table->string('description')->nullable(); // keterangan tambahan
        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
