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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->string('dospem_nama')->nullable();
            $table->integer('dospem_nilai')->nullable();
            $table->string('dospeng_1_nama')->nullable();
            $table->integer('dospeng_1_nilai')->nullable();
            $table->string('dospeng_2_nama')->nullable();
            $table->integer('dospeng_2_nilai')->nullable();
            $table->string('dospeng_3_nama')->nullable();
            $table->integer('dospeng_3_nilai')->nullable();
            $table->foreignId('mahasiswa_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
