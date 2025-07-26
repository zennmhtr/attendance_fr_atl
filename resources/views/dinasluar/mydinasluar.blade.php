@extends('layouts.dashboard')
@section('isi')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <form action="{{ url('/my-dinas-luar') }}">
                    <span>Filter Rentang Tanggal</span><br><br>
                    <div class="form-row">
                        <div class="col-3">
                            <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                        </div>
                        <div class="col-3">
                            <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                        </div>
                        <div>
                            <button type="submit" id="search" class="form-control btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table id="tableprint" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pegawai</th>
                            <th>Shift</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Telat</th>
                            <th>Lokasi Masuk</th>
                            <th>Foto Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Pulang Cepat</th>
                            <th>Lokasi Pulang</th>
                            <th>Foto Pulang</th>
                            <th>Status Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_absen as $da)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $da->User->name }}</td>
                        <td>{{ $da->Shift->nama_shift }} ({{ $da->Shift->jam_masuk }} - {{ $da->Shift->jam_keluar }})</td>
                        <td>{{ $da->tanggal }}</td>
                        <td>
                             @if($da->status_absen == 'Libur')
                                <span class="badge badge-info">Libur</span>
                            @elseif($da->status_absen == 'Cuti')
                                <span class="badge badge-warning">Sedang Cuti</span>
                            @elseif($da->jam_absen == null)
                                <span class="badge badge-danger">Belum Absen</span>
                            @else
                                {{ $da->jam_absen }}
                            @endif
                        </td>
                        <td>
                            @if($da->status_absen == 'Libur')
                                <span class="badge badge-info">Libur</span>
                            @elseif($da->status_absen == 'Cuti')
                                <span class="badge badge-warning">Sedang Cuti</span>
                            @elseif($da->status_absen == 'Izin Telat')
                                <span class="badge badge-warning">Izin Telat</span>
                            @elseif($da->jam_absen == null)
                                <span class="badge badge-danger">Belum Absen</span>
                            @else
                            <?php
                                $telat = $da->telat;
                                $jam   = floor($telat / (60 * 60));
                                $menit = $telat - ( $jam * (60 * 60) );
                                $menit2 = floor( $menit / 60 );
                                $detik = $telat % 60;
                            ?>
                                @if($jam <= 0 && $menit2 <= 0)
                                    <span class="badge badge-success">Tepat Waktu</span>
                                @else
                                    <span class="badge badge-danger">{{ $jam." Jam ".$menit2." Menit" }}</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($da->status_absen == 'Libur')
                                <span class="badge badge-info">Libur</span>
                            @elseif($da->status_absen == 'Cuti')
                                <span class="badge badge-warning">Sedang Cuti</span>
                            @elseif($da->jam_absen == null)
                                <span class="badge badge-danger">Belum Absen</span>
                            @else
                                <a href="{{ url('/maps/'.$da->lat_absen.'/'.$da->long_absen.'/'.$da->user_id) }}" class="btn btn-sm btn-secondary" target="_blank">lihat</a>
                            @endif
                        </td>
                        <td>
                            @if($da->status_absen == 'Libur')
                                <span class="badge badge-info">Libur</span>
                            @elseif($da->status_absen == 'Cuti')
                                <span class="badge badge-warning">Sedang Cuti</span>
                            @elseif($da->jam_absen == null)
                                <span class="badge badge-danger">Belum Absen</span>
                            @else
                                <img src="{{ url('storage/' . $da->foto_jam_absen) }}" style="width: 60px">
                            @endif
                        </td>
                        <td>
                            @if($da->status_absen == 'Libur')
                                <span class="badge badge-info">Libur</span>
                            @elseif($da->status_absen == 'Cuti')
                                <span class="badge badge-warning">Sedang Cuti</span>
                            @elseif($da->jam_absen == null)
                                <span class="badge badge-danger">Belum Absen</span>
                            @elseif($da->jam_pulang == null)
                                <span class="badge badge-warning">Belum Pulang</span>
                            @else
                                {{ $da->jam_pulang }}
                            @endif
                        </td>
                        <td>
                            @if($da->status_absen == 'Libur')
                                <span class="badge badge-info">Libur</span>
                            @elseif($da->status_absen == 'Cuti')
                                <span class="badge badge-warning">Sedang Cuti</span>
                            @elseif($da->status_absen == 'Izin Pulang Cepat')
                                <span class="badge badge-warning">Izin Pulang Cepat</span>
                            @elseif($da->jam_absen == null)
                                <span class="badge badge-danger">Belum Absen</span>
                            @elseif($da->jam_pulang == null)
                                <span class="badge badge-warning">Belum Pulang</span>
                            @else
                                <?php
                                    $pulang_cepat = $da->pulang_cepat;

                                    $jam   = floor($pulang_cepat / (60 * 60));
                                    $menit = $pulang_cepat - ( $jam * (60 * 60) );
                                    $menit2 = floor( $menit / 60 );
                                    $detik = $pulang_cepat % 60;
                                ?>
                                 @if($jam <= 0 && $menit2 <= 0)
                                    <span class="badge badge-success">Tidak Pulang Cepat</span>
                                 @else
                                    <span class="badge badge-danger">{{ $jam." Jam ".$menit2." Menit" }}</span>
                                 @endif
                            @endif
                        </td>
                        <td>
                            @if($da->status_absen == 'Libur')
                                <span class="badge badge-info">Libur</span>
                            @elseif($da->status_absen == 'Cuti')
                                <span class="badge badge-warning">Sedang Cuti</span>
                            @elseif($da->jam_absen == null)
                                <span class="badge badge-danger">Belum Absen</span>
                            @elseif($da->jam_pulang == null)
                                <span class="badge badge-warning">Belum Pulang</span>
                            @else
                                <a href="{{ url('/maps/'.$da->lat_pulang.'/'.$da->long_pulang.'/'.$da->user_id) }}" class="btn btn-sm btn-secondary" target="_blank">lihat</a>
                            @endif
                        </td>
                        <td>
                            @if($da->status_absen == 'Libur')
                                <span class="badge badge-info">Libur</span>
                            @elseif($da->status_absen == 'Cuti')
                                <span class="badge badge-warning">Sedang Cuti</span>
                            @elseif($da->jam_absen == null)
                                <span class="badge badge-danger">Belum Absen</span>
                            @elseif($da->jam_pulang == null)
                                <span class="badge badge-warning">Belum Pulang</span>
                            @else
                                <img src="{{ url('storage/' . $da->foto_jam_pulang) }}" style="width: 60px">
                            @endif
                        </td>
                        <td>
                            @if($da->status_absen == 'Libur')
                                <span class="badge badge-info">Libur</span>
                            @elseif($da->status_absen == 'Cuti' || $da->status_absen == 'Izin Telat' || $da->status_absen == 'Izin Pulang Cepat')
                                <span class="badge badge-warning">{{ $da->status_absen }}</span>
                            @elseif($da->status_absen == 'Masuk')
                                <span class="badge badge-success">{{ $da->status_absen }}</span>
                            @else
                                <span class="badge badge-danger">{{ $da->status_absen }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
@endsection
