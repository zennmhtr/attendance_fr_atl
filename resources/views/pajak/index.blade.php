@extends('layouts.dashboard')
@section('isi')
    <div class="container-fluid">
        <div class="card" style="border-radius: 20px">
            <div class="card-body">
                <form action="{{ url('/pajak-pph21') }}">
                    @php
                        $bulan = array(
                        [
                            "id" => "1",
                            "bulan" => "Januari"
                        ],
                        [
                            "id" => "2",
                            "bulan" => "Februari"
                        ],
                        [
                            "id" => "3",
                            "bulan" => "Maret"
                        ],
                        [
                            "id" => "4",
                            "bulan" => "April"
                        ],
                        [
                            "id" => "5",
                            "bulan" => "Mei"
                        ],
                        [
                            "id" => "6",
                            "bulan" => "Juni"
                        ],
                        [
                            "id" => "7",
                            "bulan" => "Juli"
                        ],
                        [
                            "id" => "8",
                            "bulan" => "Agustus"
                        ],
                        [
                            "id" => "9",
                            "bulan" => "September"
                        ],
                        [
                            "id" => "10",
                            "bulan" => "Oktober"
                        ],
                        [
                            "id" => "11",
                            "bulan" => "November"
                        ],
                        [
                            "id" => "12",
                            "bulan" => "Desember"
                        ]);

                        $last = date('Y')-10;
                        $now = date('Y');
                    @endphp
                    <div class="form-row mb-2">
                        <div class="col-2">
                            <select name="tahun" id="tahun" class="form-control selectpicker" data-live-search="true">
                                @for ($i = $now; $i >= $last; $i--)
                                    @if(old('tahun', $now) == $i)
                                        <option value="{{ $i }}" selected>{{ $i }}</option>
                                    @else
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="col-2">
                            <select name="bulan" id="bulan" class="form-control selectpicker" data-live-search="true">
                                <option value=""selected>Bulan</option>
                                @foreach($bulan as $bul)
                                    @if(request('bulan') == $bul['id'])
                                        <option value="{{ $bul['id'] }}"selected>{{ $bul['bulan'] }}</option>
                                    @else
                                        <option value="{{ $bul['id'] }}">{{ $bul['bulan'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" id="search" class="form-control btn btn-secondary" style="border-radius: 10px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <table id="tablePayroll" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Penghasilan Bruto</th>
                            <th>Penghasilan Netto Sebulan</th>
                            <th>Penghasilan Netto Setahun</th>
                            <th>PTKP</th>
                            <th>PKP Setahun</th>
                            <th>PPH 21 Setahun</th>
                            <th>PPH 21 Sebulan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->User->name  }}</td>
                                <td>
                                    @php
                                        if ($d->bulan == 1){
                                            $nama_bulan = 'Januari';
                                        } else if($d->bulan == 2) {
                                            $nama_bulan = 'Februari';
                                        } else if($d->bulan == 3) {
                                            $nama_bulan = 'Maret';
                                        } else if($d->bulan == 4) {
                                            $nama_bulan = 'April';
                                        } else if($d->bulan == 5) {
                                            $nama_bulan = 'Mei';
                                        } else if($d->bulan == 6) {
                                            $nama_bulan = 'Juni';
                                        } else if($d->bulan == 7) {
                                            $nama_bulan = 'Juli';
                                        } else if($d->bulan == 8) {
                                            $nama_bulan = 'Agustus';
                                        } else if($d->bulan == 9) {
                                            $nama_bulan = 'September';
                                        } else if($d->bulan == 10) {
                                            $nama_bulan = 'Oktober';
                                        } else if($d->bulan == 11) {
                                            $nama_bulan = 'November';
                                        } else if($d->bulan == 12) {
                                            $nama_bulan = 'Desember';
                                        } else {
                                            $nama_bulan = '-';
                                        }
                                    @endphp
                                    {{ $nama_bulan  }}
                                </td>
                                <td>{{ $d->tahun }}</td>
                                <td>{{ $d->ptkp->name }}</td>
                                <td>
                                    @php
                                        if ($d->gaji > 500000) {
                                            $biaya_jabatan = 500000;
                                        } else {
                                            $biaya_jabatan = $gaji * (5/100);
                                        }
                                        $jumlah_hadir = $d->JumlahHadir($d->user_id, $d->bulan, $d->tahun, 'Masuk') + $d->JumlahHadir($d->user_id, $d->bulan, $d->tahun, 'Izin Pulang Cepat') + $d->JumlahHadir($d->user_id, $d->bulan, $d->tahun, 'Izin Telat');
                                        $bruto = ($d->User->Golongan->Tunjangan->first()->tunjangan_makan * $jumlah_hadir) + ($d->User->Golongan->Tunjangan->first()->tunjangan_transport * $jumlah_hadir) + $d->gaji + $d->lembur;
                                        $netto = $bruto - $biaya_jabatan - ($d->setoran_bpjs_kes - $d->tunjangan_bpjs_kes);
                                        $nettoYear = $netto * 12;
                                        $cekPkp = $nettoYear - $d->ptkp->ptkp_2016;
                                    @endphp
                                    {{ number_format($bruto) }}
                                </td>
                                <td>{{ number_format($netto) }}</td>
                                <td>{{ number_format($nettoYear) }}</td>
                                <td>{{ number_format($d->ptkp->ptkp_2016) }}</td>
                                <td>
                                    @php
                                        if ($cekPkp > 0) {
                                            $pkpSetahun = $cekPkp;
                                        } else {
                                            $pkpSetahun = 0;
                                        }
                                    @endphp
                                    {{ number_format($pkpSetahun) }}
                                </td>
                                <td>
                                    @php
                                        if ($pkpSetahun <= 50000000) {
                                            $tax = 5;
                                        } else if ($pkpSetahun > 50000000 && $pkpSetahun <= 250000000) {
                                            $tax = 15;
                                        } else if ($pkpSetahun > 250000000 && $pkpSetahun <= 500000000) {
                                            $tax = 25;
                                        } else {
                                            $tax = 50;
                                        }
                                    @endphp
                                    {{ number_format($pkpSetahun * ($tax/100)) }}
                                </td>
                                <td>{{ number_format(($pkpSetahun * ($tax/100)) / 12) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mr-4">
                {{ $data->links() }}
            </div>
        </div>
    </div>
    <br>
@endsection
