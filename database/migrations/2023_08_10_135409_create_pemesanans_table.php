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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->references('id')->on('karyawans');
            $table->foreignId('driver_id')->references('id')->on('drivers');
            $table->foreignId('karyawan_approval_id')->references('id')->on('karyawans');
            $table->foreignId('kendaraan_id')->references('id')->on('kendaraans');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
