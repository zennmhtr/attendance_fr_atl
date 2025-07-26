
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail PDF</title>
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
        <div class="header">Export Detail</div>
        </center>

        <table style="border-collapse: collapse; width: 100%; font-size: 8px;">
            <thead>
                <tr>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Nama Pegawai</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Shift</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Tanggal</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Jam Masuk</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Telat</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Keterangan Masuk</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Jam Pulang</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Pulang Cepat</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Keterangan Pulang</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;">Status</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    @php
                        $telat = $d->telat;
                        $jam   = floor($telat / (60 * 60));
                        $menit = $telat - ( $jam * (60 * 60) );
                        $menit2 = floor( $menit / 60 );
                        $detik = $telat % 60;
                        if($jam <= 0 && $menit2 <= 0){
                            $late = '-';
                        } else {
                            $late = $jam . ' Jam ' . $menit2 . ' Menit ' . $detik . ' Detik';
                        }

                        $pulang_cepat = $d->pulang_cepat;
                        $jam_pulang_cepat   = floor($pulang_cepat / (60 * 60));
                        $menit_pulang_cepat = $pulang_cepat - ( $jam_pulang_cepat * (60 * 60) );
                        $menit_pulang_cepat2 = floor( $menit_pulang_cepat / 60 );
                        $detik_pulang_cepat = $pulang_cepat % 60;

                        if($jam_pulang_cepat <= 0 && $menit_pulang_cepat2 <= 0){
                            $quick_return = '-';
                        } else {
                            $quick_return = $jam_pulang_cepat . ' Hour ' . $menit_pulang_cepat2 . ' Minute ' . $detik_pulang_cepat . ' Second';
                        }

                        if ($d->Shift) {
                            $shift_name = $d->Shift->nama_shift . ' ' . $d->Shift->jam_masuk . ' - ' . $d->Shift->jam_keluar;
                        } else {
                            $shift_name = '-';
                        }
                    @endphp
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;">{{ $d->name }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $shift_name }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $d->tanggal ?? '-' }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $d->jam_absen ? $d->jam_absen : '-' }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $late }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $d->keterangan_masuk }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $d->jam_pulang ? $d->jam_pulang : '-' }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $quick_return }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $d->keterangan_pulang }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $d->status_absen }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
