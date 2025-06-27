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
        Schema::create('jadwal_periksas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokter'); // Tambahkan ini dulu
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat',]);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('status')->default('Aktif');
            $table->timestamps();

            // Baru setelah itu tambahkan foreign key-nya
            $table->foreign('id_dokter')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_periksas');
    }
};
