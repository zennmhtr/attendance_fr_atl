
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Pdf</title>
    <style>
        body {
          font-family: Arial, sans-serif;
        }
        .container {
          max-width: 800px;
          margin: 0 auto;
        }
        .header {
          font-size: 20px;
          font-weight: bold;
          margin-bottom: 20px;
        }
      </style>
</head>
<body>
    @php
        $settings = App\Models\settings::first();
        $logo_path = storage_path('app/public/' . $settings->logo);
        if (file_exists($logo_path)) {
            $logo_mime = mime_content_type($logo_path);
            $logo_data = base64_encode(file_get_contents($logo_path));
        } else {
            $logo_mime = null;
            $logo_data = null;
        }
    @endphp
    <div class="container">
        @if($logo_data)
            <img src="data:{{ $logo_mime }};base64,{{ $logo_data }}" style="width: 80px; float:right">
        @endif
        <h3 style="text-transform: uppercase;">{{ $settings->name }}</h3>
        <span style="font-size: 10px; color:rgb(112, 112, 112);">{{ $settings->alamat }}</span>
        <br>
        <span style="font-size: 10px; color:rgb(112, 112, 112);">{{ $settings->email }} - {{ $settings->phone }}</span>
        <hr>
        <center>
        <div class="header">Export Rekap</div>
        </center>


        <table style="border-collapse: collapse; width: 100%; font-size: 8px;">
            <thead>
                <tr>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Nama Pegawai</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Cuti</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Izin Masuk</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Izin Telat</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Izin Pulang Cepat</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Hadir</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Alfa</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Libur</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Total Telat</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Total Pulang Cepat</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Total Lembur</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Persentase Kehadiran</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    @php
                        $tanggal_mulai = request()->input('mulai');
                        $tanggal_akhir = request()->input('akhir');
                        $cuti = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Cuti')->count();
                        $izin_masuk = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Izin Masuk')->count();
                        $izin_telat = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Izin Telat')->count();
                        $izin_pulang_cepat = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Izin Pulang Cepat')->count();
                        $masuk = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Masuk')->count();
                        $total_hadir = $masuk + $izin_telat + $izin_pulang_cepat;
                        $libur = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Libur')->count();
                        $mulai = new \DateTime($tanggal_mulai);
                        $akhir = new \DateTime($tanggal_akhir);
                        $interval = $mulai->diff($akhir);
                        $total_alfa = $interval->days + 1 - $masuk - $cuti - $izin_masuk - $libur;
                        $total_telat = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->sum('telat');
                        $jam   = floor($total_telat / (60 * 60));
                        $menit = $total_telat - ( $jam * (60 * 60) );
                        $menit2 = floor($menit / 60);
                        $jumlah_telat = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('telat', '>', 0)->count();
                        $total_pulang_cepat = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->sum('pulang_cepat');
                        $jam_cepat   = floor($total_pulang_cepat / (60 * 60));
                        $menit_cepat = $total_pulang_cepat - ( $jam_cepat * (60 * 60) );
                        $menit_cepat2 = floor($menit_cepat / 60);
                        $jumlah_pulang_cepat = $d->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('pulang_cepat', '>', 0)->count();
                        $total_lembur = $d->Lembur->where('status', 'Approved')->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->sum('total_lembur');
                        $jam_lembur   = floor($total_lembur / (60 * 60));
                        $menit_lembur = $total_lembur - ( $jam_lembur * (60 * 60) );
                        $menit_lembur2 = floor($menit_lembur / 60);
                        $timestamp_mulai = strtotime($tanggal_mulai);
                        $timestamp_akhir = strtotime($tanggal_akhir);
                        $selisih_timestamp = $timestamp_akhir - $timestamp_mulai;
                        $jumlah_hari = (floor($selisih_timestamp / (60 * 60 * 24)))+1;
                        $persentase_kehadiran = (($total_hadir + $libur) / $jumlah_hari) * 100;
                    @endphp
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;">{{ $d->name }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $cuti }} x</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $izin_masuk }} x</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $izin_telat }} x</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $izin_pulang_cepat }} x</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $total_hadir }} x</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $total_alfa }} x</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $libur }} x</td>
                        <td style="border: 1px solid black; padding: 8px;">
                            <p>{{ $jam . " Jam " . $menit2 . " Menit" }}</p>
                            <p>{{ $jumlah_telat . " x" }}</p>
                        </td>
                        <td style="border: 1px solid black; padding: 8px;">
                            <p>{{ $jam_cepat . " Jam " . $menit_cepat2 . " Menit" }}</p>
                            <p>{{ $jumlah_pulang_cepat . " x" }}</p>
                        </td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $jam_lembur." Jam ".$menit_lembur2." Menit" }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $persentase_kehadiran }} x</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>
</html>
