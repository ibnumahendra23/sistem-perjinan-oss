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
        Schema::create('status_perijinan', function (Blueprint $table) {
            $table->id();
            $table->string('no_perijinan', 11)->unique();
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_disetujui')->nullable();
            $table->string('status', 20);
            $table->string('alasan', 255)->nullable();
            $table->string('gambar', 255)->nullable();
            $table->integer('perijinan_usaha_id');
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
        Schema::dropIfExists('status_perijinann');
    }
};
