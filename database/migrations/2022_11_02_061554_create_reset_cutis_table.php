<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResetCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reset_cutis', function (Blueprint $table) {
            $table->id();
            $table->string('izin_cuti');
            $table->string('izin_dinas_luar');
            $table->string('izin_sakit');
            $table->string('izin_cek_kesehatan');
            $table->string('izin_keperluan_pribadi');
            $table->string('izin_telat');
            $table->string('izin_pulang_cepat');
            $table->string('izin_lainnya');
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
        Schema::dropIfExists('reset_cutis');
    }
}
