<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perijinan_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('alamat', 100);
            $table->integer('rt');
            $table->integer('rw');
            $table->string('kelurahan', 30);
            $table->string('kecamatan', 30);
            $table->string('kota_kabupaten', 30);
            $table->string('provinsi', 30);
            $table->integer('kode_pos')->nullable();
            $table->string('jenis', 70);
            $table->string('gambar', 255)->nullable();
            $table->integer('users_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perijinan_usaha');
    }
};
