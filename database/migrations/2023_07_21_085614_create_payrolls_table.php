<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->string('bulan');
            $table->string('tahun');
            $table->string('persentase_kehadiran');
            $table->string('no_gaji');
            $table->bigInteger('gaji_pokok');
            $table->bigInteger('uang_transport');
            $table->bigInteger('total_reimbursement');
            $table->bigInteger('jumlah_mangkir');
            $table->bigInteger('uang_mangkir');
            $table->bigInteger('total_mangkir');
            $table->bigInteger('jumlah_lembur');
            $table->bigInteger('uang_lembur');
            $table->bigInteger('total_lembur');
            $table->bigInteger('jumlah_izin');
            $table->bigInteger('uang_izin');
            $table->bigInteger('total_izin');
            $table->bigInteger('jumlah_bonus');
            $table->bigInteger('uang_bonus');
            $table->bigInteger('total_bonus');
            $table->bigInteger('jumlah_terlambat');
            $table->bigInteger('uang_terlambat');
            $table->bigInteger('total_terlambat');
            $table->bigInteger('jumlah_kehadiran');
            $table->bigInteger('uang_kehadiran');
            $table->bigInteger('total_kehadiran');
            $table->bigInteger('saldo_kasbon');
            $table->bigInteger('bayar_kasbon');
            $table->bigInteger('jumlah_thr');
            $table->bigInteger('uang_thr');
            $table->bigInteger('total_thr');
            $table->bigInteger('loss');
            $table->bigInteger('total_penjumlahan');
            $table->bigInteger('total_pengurangan');
            $table->bigInteger('grand_total');
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
        Schema::dropIfExists('payrolls');
    }
}
