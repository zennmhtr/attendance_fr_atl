<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slip Gaji</title>
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

    .total {
      margin-top: 20px;
      font-weight: bold;
    }
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
    .col {
        box-sizing: border-box;
        float: left;
    }

    .col-1 { width: 8.33%; }
    .col-2 { width: 16.66%; }
    .col-3 { width: 25%; }
    .col-4 { width: 33.33%; }
    .col-6 { width: 50%; }
    .col-8 { width: 66.66%; }
    .col-12 { width: 100%; }
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
    <span style="font-size: 10px; color:rgb(112, 112, 112)">{{ $settings->alamat }}</span>
    <br>
    <span style="font-size: 10px; color:rgb(112, 112, 112)">{{ $settings->email }} - ({{ $settings->phone }})</span>
    <hr>
    <center>
      <div class="header">Slip Gaji</div>
    </center>

    @php
        if ($data->bulan == 1) {
          $bulan = "Januari";
      } elseif ($data->bulan == 2) {
          $bulan = "Februari";
      } elseif ($data->bulan == 3) {
          $bulan = "Maret";
      } elseif ($data->bulan == 4) {
          $bulan = "April";
      } elseif ($data->bulan == 5) {
          $bulan = "Mei";
      } elseif ($data->bulan == 6) {
          $bulan = "Juni";
      } elseif ($data->bulan == 7) {
          $bulan = "Juli";
      } elseif ($data->bulan == 8) {
          $bulan = "Agustus";
      } elseif ($data->bulan == 9) {
          $bulan = "September";
      } elseif ($data->bulan == 10) {
          $bulan = "Oktober";
      } elseif ($data->bulan == 11) {
          $bulan = "November";
      } else {
          $bulan = "Desember";
      }
    @endphp
    <div class="row">
      <div class="col">
        <table style="font-size: 13px">
          <tbody>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td>{{ $data->User->name }}</td>
            </tr>
            <tr>
              <td>Jabatan</td>
              <td>:</td>
              <td>{{ $data->User->jabatan->nama_jabatan }}</td>
            </tr>
            <tr>
              <td>Rekening</td>
              <td>:</td>
              <td>{{ $data->User->rekening }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col" style="margin-left: 28%">
        <table style="font-size: 13px">
          <tbody>
            <tr>
              <td>Tgl Gabung</td>
              <td>:</td>
              <td>{{ $data->User->tgl_join }}</td>
            </tr>
            <tr>
              <td>Bulan</td>
              <td>:</td>
              <td>{{ $bulan . ' ' . $data->tahun }}</td>
            </tr>
            <tr>
              <td>Periode</td>
              <td>:</td>
              <td>{{ $data->tanggal_mulai }} s/d {{ $data->tanggal_akhir }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <br>
    <div style="font-style:italic; text-decoration: underline; font-size:14px">RINCIAN GAJI BULAN INI</div>
    <br>

    <table style="font-size: 13px">
      <tbody>
        <tr>
          <td style="padding-left: 10px; padding-right: 10px">Gaji Pokok</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->gaji_pokok) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 10px">Uang Makan & Transport</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->uang_transport) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 10px">Lembur</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px">{{ $data->jumlah_lembur }}</td>
          <td style="padding-left: 10px; padding-right: 10px">Jam</td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_lembur) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 10px">Bonus 100% Kehadiran</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_kehadiran) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 10px">Insentif</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_bonus) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 10px">Tunjangan Hari Raya</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_thr) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 10px">Reimbursement</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_reimbursement) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">_______________________</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 10px; font-weight: bold;">Subtotal</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_penjumlahan) }}</td>
        </tr>
      </tbody>
    </table>

    <br>
    <div style="font-style:italic; text-decoration: underline; font-size:14px">DIKURANGI</div>
    <br>

    <table style="font-size: 13px">
      <tbody>
        <tr>
          <td style="padding-left: 10px; padding-right: 17px">Keterlambatan</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px">{{ $data->jumlah_terlambat }}</td>
          <td style="padding-left: 10px; padding-right: 10px">Kali</td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_terlambat) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 17px">Mangkir</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px">{{ $data->jumlah_mangkir }}</td>
          <td style="padding-left: 10px; padding-right: 10px">Hari</td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_mangkir) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 17px">Izin</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px">{{ $data->jumlah_izin }}</td>
          <td style="padding-left: 10px; padding-right: 10px">Hari</td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_izin) }}</td>
        </tr>
        <br>
        <tr>
          <td style="padding-left: 10px; padding-right: 17px">Kasbon</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->bayar_kasbon) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 17px">Loss</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->loss) }}</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 17px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">_______________________</td>
        </tr>
        <tr>
          <td style="padding-left: 10px; padding-right: 17px; font-weight: bold;">Subtotal</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px">Rp {{ number_format($data->total_pengurangan) }}</td>
        </tr>
        <br>
        <tr>
          <td style="padding-left: 10px; padding-right: 17px; font-weight: bold;">GAJI YANG DITERIMA</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px"></td>
          <td style="padding-left: 10px; padding-right: 10px; font-weight: bold; border: 1px solid #000;">Rp {{ number_format($data->grand_total) }}</td>
        </tr>
        <br>
        <tr>
          <td style="padding-left: 10px; padding-right: 17px">Sisa Cuti</td>
          <td style="padding-left: 10px; padding-right: 10px">:</td>
          <td style="padding-left: 10px; padding-right: 10px">{{ $data->User->izin_cuti }}</td>
          <td style="padding-left: 10px; padding-right: 10px">Kali</td>
          <td style="padding-left: 10px; padding-right: 10px">/ Tahun</td>
        </tr>
      </tbody>

    </table>
  </div>
</body>
</html>
