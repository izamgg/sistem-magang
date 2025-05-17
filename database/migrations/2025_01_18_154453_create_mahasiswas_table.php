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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 10)->unique();
            $table->string('prodi');
            $table->date('tgl_lahir');
            $table->string('tempat_lahir');
            $table->string('agama');
            $table->string('gender');
            $table->string('alamat');
            $table->string('tempat_magang')->nullable();
            $table->string('lokasi_magang')->nullable();
            $table->date('awal_magang')->nullable();
            $table->date('akhir_magang')->nullable();
            $table->string('dospem')->nullable();
            $table->enum('status', [0, 1, 2])->default(0);
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
