<?php

namespace App\Imports;

use App\Models\Jabatan;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $jabatan = Jabatan::where('nama_jabatan', $row['jabatan'])->first();
        if ($jabatan) {
            $jabatan_id = $jabatan->id;
        } else {
            $jabatan_new = Jabatan::create([
                'nama_jabatan' => $row['jabatan']
            ]);
            $jabatan_id = $jabatan_new->id;
        }

        $lokasi = Lokasi::where('nama_lokasi', $row['lokasi'])->first();
        if ($lokasi) {
            $lokasi_id = $lokasi->id;
        } else {
            $lokasi_new = Lokasi::create([
                'nama_lokasi' => $row['lokasi'],
                'created_by' => auth()->user()->id,
                'status' => 'approved',
            ]);

            $lokasi_id = $lokasi_new->id;
        }
        return new User([
            "name" => $row["nama"],
            "email" => $row["email"],
            "telepon" => $row["telepon"],
            "username" => $row["username"],
            "password" => Hash::make($row['password']),
            "tgl_lahir" => $row["tanggal_lahir"],
            "gender" => $row["gender"],
            "tgl_join" => $row["tanggal_masuk_perusahaan"],
            "status_nikah" => $row['status_pernikahan'],
            "alamat" => $row['alamat'],
            "izin_cuti" => $row["cuti"],
            "izin_lainnya" => $row["izin_masuk"],
            "izin_telat" => $row['izin_telat'],
            "izin_pulang_cepat" => $row['izin_pulang_cepat'],
            "is_admin" => $row['role'],
            "jabatan_id" => $jabatan_id,
            "lokasi_id" => $lokasi_id,
            "rekening" => $row['rekening'],
            "gaji_pokok" => $row['gaji_pokok'],
            "makan_transport" => $row['makan_dan_transport'],
            "lembur" => $row['lembur'],
            "kehadiran" => $row['kehadiran'],
            "thr" => $row['thr'],
            "bonus" => $row['bonus'],
            "izin" => $row['izin'],
            "terlambat" => $row['terlambat'],
            "mangkir" => $row['mangkir'],
            "saldo_kasbon" => $row['saldo_kasbon'],
        ]);
    }
}
