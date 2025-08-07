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
        Schema::create('tambah_pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_handphone');
            $table->string('provinsi'); 
            $table->string('kota'); 
            $table->string('kecamatan'); 
            $table->string('kodepos'); 
            $table->text('detail_alamat'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tambah_pelanggans');
    }
};
