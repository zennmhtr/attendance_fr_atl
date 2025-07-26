@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/my-absen') }}">
                    <div class="row">
                        <div class="col-4">
                            <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                        </div>
                        <div class="col-4">
                            <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                        </div>
                        <div class="col-4">
                            <button type="submit" id="search" class="form-control btn" style="width: 25px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <table id="tablePayroll" class="table table-bordered table-striped">
               <thead>
                   <tr>
                       <th>No.</th>
                       <th>Nama Karyawan</th>
                       <th>Jadwal</th>
                       <th>Tanggal</th>
                       <th>Jam Masuk</th>
                       <th>Telat</th>
                       <th>Lokasi Masuk</th>
                       <th>Foto Masuk</th>
                       <th>Keterangan Masuk</th>
                       <th>Jam Pulang :</th>
                       <th>Pulang Cepat : </th>
                       <th>Lokasi Pulang : </th>
                       <th>Foto Pulang : </th>
                       <th>Keterangan Pulang : </th>
                       <th>Status Absen : </th>
                       <th>Actions</th>
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
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @else
                                    {{ $da->jam_absen }}
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->status_absen == 'Izin Telat')
                                    Izin Telat
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @else
                                <?php
                                    $telat = $da->telat;
                                    $jam   = floor($telat / (60 * 60));
                                    $menit = $telat - ( $jam * (60 * 60) );
                                    $menit2 = floor( $menit / 60 );
                                    $detik = $telat % 60;
                                ?>
                                    @if($jam <= 0 && $menit2 <= 0)
                                        Tepat Waktu
                                    @else
                                        {{ $jam." Jam ".$menit2." Menit" }}
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @else
                                    @php
                                        $jarak_masuk = explode(".", $da->jarak_masuk);
                                    @endphp
                                    <a href="{{ url('/maps/'.$da->lat_absen.'/'.$da->long_absen.'/'.$da->user_id) }}" class="btn btn-sm btn-secondary" target="_blank">lihat</a>
                                    {{ $jarak_masuk[0] }} Meter
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @else
                                    <img src="{{ url('storage/' . $da->foto_jam_absen) }}" style="width: 60px">
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @else
                                    {{ $da->keterangan_masuk }}
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @elseif($da->jam_pulang == null)
                                    Belum Pulang
                                @else
                                    {{ $da->jam_pulang }}
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->status_absen == 'Izin Pulang Cepat')
                                    Izin Pulang Cepat
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @elseif($da->jam_pulang == null)
                                    Belum Pulang
                                @else
                                    <?php
                                        $pulang_cepat = $da->pulang_cepat;

                                        $jam   = floor($pulang_cepat / (60 * 60));
                                        $menit = $pulang_cepat - ( $jam * (60 * 60) );
                                        $menit2 = floor( $menit / 60 );
                                        $detik = $pulang_cepat % 60;
                                    ?>
                                    @if($jam <= 0 && $menit2 <= 0)
                                        Tidak Pulang Cepat
                                    @else
                                        {{ $jam." Jam ".$menit2." Menit" }}
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @elseif($da->jam_pulang == null)
                                    Belum Pulang
                                @else
                                    @php
                                        $jarak_pulang = explode(".", $da->jarak_pulang);
                                    @endphp
                                    <a href="{{ url('/maps/'.$da->lat_pulang.'/'.$da->long_pulang.'/'.$da->user_id) }}" class="btn btn-sm btn-secondary" target="_blank">lihat</a>
                                    {{ $jarak_pulang[0] }} Meter
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @elseif($da->jam_pulang == null)
                                    Belum Pulang
                                @else
                                    <img src="{{ url('storage/' . $da->foto_jam_pulang) }}" style="width: 60px">
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti')
                                    Sedang Cuti
                                @elseif($da->jam_absen == null)
                                    Belum Absen
                                @elseif($da->jam_pulang == null)
                                    Belum Pulang
                                @else
                                    {{ $da->keterangan_pulang }}
                                @endif
                            </td>
                            <td>
                                @if($da->status_absen == 'Libur')
                                    Libur
                                @elseif($da->status_absen == 'Cuti' || $da->status_absen == 'Izin Telat' || $da->status_absen == 'Izin Pulang Cepat')
                                    {{ $da->status_absen }}
                                @elseif($da->status_absen == 'Masuk')
                                    {{ $da->status_absen }}
                                @else
                                    {{ $da->status_absen }}
                                @endif
                            </td>
                            <td>
                                @if ($da->tanggal < date('Y-m-d'))
                                    @if ($da->jam_masuk_pengajuan == null)
                                        <a href="{{ url('/my-absen/pengajuan/'.$da->id) }}" class="btn btn-sm btn-warning">Ajukan</a>
                                    @else
                                        <span style="background-color: greenyellow">Sudah Pengajuan</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mr-4">
            {{ $data_absen->links() }}
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
@endsection