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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 30);
            $table->string('nama', 50);
            $table->string('email', 50);
            $table->string('pangkat_golongan', 100)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('password', 255);
            $table->string('alamat', 100)->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->string('kelurahan', 30)->nullable();
            $table->string('kecamatan', 30)->nullable();
            $table->string('kota_kabupaten', 30)->nullable();
            $table->string('provinsi', 30)->nullable();
            $table->integer('kode_pos')->nullable();
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('no_telp', 50)->nullable();
            $table->string('gambar', 255)->nullable();
            $table->string('role', 10)->default('user');
            $table->timestamps();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
