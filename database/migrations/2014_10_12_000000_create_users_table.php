<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('foto_karyawan')->nullable();
            $table->string('foto_face_recognition')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('username')->nullable();;
            $table->string('password')->nullable();;
            $table->string('tgl_lahir')->nullable();
            $table->string('gender')->nullable();
            $table->string('tgl_join')->nullable();
            $table->string('status_nikah')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('izin_cuti')->default(0);
            $table->integer('izin_lainnya')->default(0);
            $table->integer('izin_telat')->default(0);
            $table->integer('izin_pulang_cepat')->default(0);
            $table->string('is_admin')->default(0);
            $table->foreignId('jabatan_id')->nullable();
            $table->foreignId('lokasi_id')->nullable();
            $table->string('rekening')->nullable();
            $table->integer('gaji_pokok')->nullable();
            $table->integer('makan_transport')->nullable();
            $table->integer('lembur')->nullable();
            $table->integer('kehadiran')->nullable();
            $table->integer('thr')->nullable();
            $table->integer('bonus')->nullable();
            $table->integer('izin')->nullable();
            $table->integer('terlambat')->nullable();
            $table->integer('mangkir')->nullable();
            $table->integer('saldo_kasbon')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
