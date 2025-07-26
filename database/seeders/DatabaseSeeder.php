<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Shift;
use App\Models\Lokasi;
use App\Models\Counter;
use App\Models\Jabatan;
use App\Models\Payroll;
use App\Models\Golongan;
use App\Models\Kategori;
use App\Models\settings;
use App\Models\ResetCuti;
use App\Models\Tunjangan;
use App\Models\StatusPtkp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'name' => 'Bensin Pertalite (Mobil)',
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Bensin Pertalite (Motor)',
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Biaya Jasa Pasang PSB (50.000)',
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Pasang ODP (200.000)',
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Tarik Kabel DC Backbone (500/m)',
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Pelatihan Olahraga',
        ]);

        settings::create([
            'name' => 'Absensi Ricky',
            'logo' => 'logo/absensi.png',
            'alamat' => 'jln. akasia 1 c.221, purwakarta, aceh',
            'phone' => '081212099664',
            'email' => 'ricky@gmail.com',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'telepon' => '0987654321',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'tgl_lahir' => date('Y-m-d'),
            'gender' => 'Laki-Laki',
            'tgl_join' => '1998-01-26',
            'status_nikah' => 'Menikah',
            'alamat' => 'jl. admin test',
            'izin_cuti' => '12',
            'izin_lainnya' => '6',
            'izin_telat' => '16',
            'izin_pulang_cepat' => '9',
            'is_admin' => 'admin',
            'jabatan_id' => '1',
            'lokasi_id' => '1',
            'rekening' => '5112231',
            'gaji_pokok' => 7000000,
            'makan_transport' => 800000,
            'lembur' => 20000,
            'kehadiran' => 300000,
            'thr' => 200000,
            'bonus' => 200000,
            'izin' => 100000,
            'terlambat' => 100000,
            'mangkir' => 200000,
            'saldo_kasbon' => 220000,
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'telepon' => '123456789',
            'username' => 'user',
            'password' => Hash::make('user123'),
            'tgl_lahir' => date('Y-m-d'),
            'gender' => 'Laki-Laki',
            'tgl_join' => '2022-01-28',
            'status_nikah' => 'Lajang',
            'alamat' => 'jl. user test',
            'izin_cuti' => '10',
            'izin_lainnya' => '10',
            'izin_telat' => '10',
            'izin_pulang_cepat' => '10',
            'is_admin' => 'user',
            'jabatan_id' => '1',
            'lokasi_id' => '1',
            'rekening' => '5112231',
            'gaji_pokok' => 10000000,
            'makan_transport' => 900000,
            'lembur' => 20000,
            'kehadiran' => 800000,
            'thr' => 700000,
            'bonus' => 600000,
            'izin' => 100000,
            'terlambat' => 100000,
            'mangkir' => 200000,
            'saldo_kasbon' => 4000000,
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Teknologi Informasi',
            'manager' => '1'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Keuangan dan Akutansi'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Administrasi & Umum'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Humas & Pemasaran'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Sekretariat'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Direktur'
        ]);

        Golongan::create([
            'name' => 'DIREKSI'
        ]);

        Golongan::create([
            'name' => 'KABAG'
        ]);

        Golongan::create([
            'name' => 'STAFF'
        ]);

        Golongan::create([
            'name' => 'PELAKSANA'
        ]);


        Shift::create([
            'nama_shift' => "Libur",
            'jam_masuk' => "00:00",
            'jam_keluar' => "00:00",
        ]);

        Shift::create([
            'nama_shift' => "Office",
            'jam_masuk' => "08:00",
            'jam_keluar' => "17:00",
        ]);

        Shift::create([
            'nama_shift' => "Siang",
            'jam_masuk' => "13:00",
            'jam_keluar' => "21:00",
        ]);

        Shift::create([
            'nama_shift' => "Malam",
            'jam_masuk' => "21:00",
            'jam_keluar' => "07:00",
        ]);

        Lokasi::create([
            'nama_lokasi' => 'Kantor Cabang A',
            'lat_kantor' => '-6.3707314',
            'long_kantor' => '106.8138057',
            'radius' => '200',
            'status' => 'approved',
            'created_by' => 1
        ]);

        ResetCuti::create([
            'izin_cuti' => '10',
            'izin_dinas_luar' => '10',
            'izin_sakit' => '10',
            'izin_cek_kesehatan' => '10',
            'izin_keperluan_pribadi' => '10',
            'izin_lainnya' => '10',
            'izin_telat' => '10',
            'izin_pulang_cepat' => '10',
        ]);

        Tunjangan::create([
            'golongan_id' => 1,
            'tunjangan_makan' => '20000.00',
            'tunjangan_transport' => '20000.00'
        ]);

        Tunjangan::create([
            'golongan_id' => 2,
            'tunjangan_makan' => '30000.00',
            'tunjangan_transport' => '20000.00'
        ]);

        Tunjangan::create([
            'golongan_id' => 3,
            'tunjangan_makan' => '30000.00',
            'tunjangan_transport' => '30000.00'
        ]);


        StatusPtkp::create([
            'name' => 'TK/0',
            'ptkp_2016' => '54000000',
            'ptkp_2015' => '36000000',
            'ptkp_2009_2012' => '15840000',
        ]);
        StatusPtkp::create([
            'name' => 'TK/1',
            'ptkp_2016' => '58500000',
            'ptkp_2015' => '39000000',
            'ptkp_2009_2012' => '17160000',
        ]);

        StatusPtkp::create([
            'name' => 'TK/2',
            'ptkp_2016' => '63000000',
            'ptkp_2015' => '42000000',
            'ptkp_2009_2012' => '18480000',
        ]);
        StatusPtkp::create([
            'name' => 'TK/3',
            'ptkp_2016' => '67500000',
            'ptkp_2015' => '45000000',
            'ptkp_2009_2012' => '19800000',
        ]);

        Counter::create([
            'name' => 'Gaji',
            'text' => 'GJ',
            'counter' => 0
        ]);


    }
}
