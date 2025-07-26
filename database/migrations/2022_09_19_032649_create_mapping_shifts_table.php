<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappingShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('shift_id')->nullable();
            $table->date('tanggal');
            
            $table->string('jam_absen')->nullable();
            $table->string('telat')->nullable();
            $table->string('lat_absen')->nullable();
            $table->string('long_absen')->nullable();
            $table->string('jarak_masuk')->nullable();
            $table->string('foto_jam_absen')->nullable();
            $table->string('keterangan_masuk')->nullable();

            $table->string('jam_pulang')->nullable();
            $table->string('pulang_cepat')->nullable();
            $table->string('lat_pulang')->nullable();
            $table->string('long_pulang')->nullable();
            $table->string('jarak_pulang')->nullable();
            $table->string('foto_jam_pulang')->nullable();
            $table->string('keterangan_pulang')->nullable();
            
            $table->string('status_absen')->nullable();
            $table->string('lock_location')->nullable();
            $table->string('jam_masuk_pengajuan')->nullable();
            $table->string('jam_pulang_pengajuan')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('status_pengajuan')->nullable();
            $table->string('file_pengajuan')->nullable();
            $table->string('komentar')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users');

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
        Schema::dropIfExists('mapping_shifts');
    }
}
