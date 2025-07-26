@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 mt-2 p-0 d-flex">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/data-absen/export') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-success">Export</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cold-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/data-absen') }}">
                        <div class="row">
                            <div class="col-3">
                                <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true">
                                    <option value=""selected>Pilih Karyawan</option>
                                    @foreach($user as $u)
                                        @if(request('user_id') == $u->id)
                                            <option value="{{ $u->id }}"selected>{{ $u->name }}</option>
                                        @else
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                            </div>
                            <div class="col-3">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="mytable" class="table table-striped">
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
                                    <th>Jam Pulang</th>
                                    <th>Pulang Cepat</th>
                                    <th>Lokasi Pulang</th>
                                    <th>Foto Pulang</th>
                                    <th>Keterangan Pulang</th>
                                    <th>Status Absen</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_absen as $da)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $da->name }}</td>
                                <td>
                                    @if ($da->Shift)
                                        {{ $da->Shift->nama_shift }} ({{ $da->Shift->jam_masuk }} - {{ $da->Shift->jam_keluar }})
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $da->tanggal ?? '-' }}</td>
                                <td>
                                    @if($da->status_absen == 'Libur')
                                        <span class="badge badge-info">Libur</span>
                                    @elseif($da->status_absen == 'Cuti')
                                        <span class="badge badge-warning">Sedang Izin</span>
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
                                        <span class="badge badge-warning">Sedang Izin</span>
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
                                        <span class="badge badge-warning">Sedang Izin</span>
                                    @elseif($da->jam_absen == null)
                                        <span class="badge badge-danger">Belum Absen</span>
                                    @else
                                        @php
                                            $jarak_masuk = explode(".", $da->jarak_masuk);
                                        @endphp
                                        <a href="{{ url('/maps/'.$da->lat_absen.'/'.$da->long_absen.'/'.$da->User->id) }}" style="background-color: rgb(146, 146, 146)" class="btn btn-xs" target="_blank"><i class="fa fa-eye" class="me-2"></i> Lihat</a>
                                        <span class="badge badge-warning">{{ $jarak_masuk[0] }} Meter</span>
                                    @endif
                                </td>
                                <td>
                                    @if($da->status_absen == 'Libur')
                                        <span class="badge badge-info">Libur</span>
                                    @elseif($da->status_absen == 'Cuti')
                                        <span class="badge badge-warning">Sedang Izin</span>
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
                                        <span class="badge badge-warning">Sedang Izin</span>
                                    @elseif($da->jam_absen == null)
                                        <span class="badge badge-danger">Belum Absen</span>
                                    @else
                                        {{ $da->keterangan_masuk }}
                                    @endif
                                </td>
                                <td>
                                    @if($da->status_absen == 'Libur')
                                        <span class="badge badge-info">Libur</span>
                                    @elseif($da->status_absen == 'Cuti')
                                        <span class="badge badge-warning">Sedang Izin</span>
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
                                        <span class="badge badge-warning">Sedang Izin</span>
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
                                        <span class="badge badge-warning">Sedang Izin</span>
                                    @elseif($da->jam_absen == null)
                                        <span class="badge badge-danger">Belum Absen</span>
                                    @elseif($da->jam_pulang == null)
                                        <span class="badge badge-warning">Belum Pulang</span>
                                    @else
                                        @php
                                            $jarak_pulang = explode(".", $da->jarak_pulang);
                                        @endphp
                                        <a href="{{ url('/maps/'.$da->lat_pulang.'/'.$da->long_pulang.'/'.$da->User->id) }}" style="background-color: rgb(146, 146, 146)" class="btn btn-xs" target="_blank"><i class="fa fa-eye" class="me-2"></i> Lihat</a>
                                        <span class="badge badge-warning">{{ $jarak_pulang[0] }} Meter</span>
                                    @endif
                                </td>
                                <td>
                                    @if($da->status_absen == 'Libur')
                                        <span class="badge badge-info">Libur</span>
                                    @elseif($da->status_absen == 'Cuti')
                                        <span class="badge badge-warning">Sedang Izin</span>
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
                                    @elseif($da->status_absen == 'Cuti')
                                        <span class="badge badge-warning">Sedang Izin</span>
                                    @elseif($da->jam_absen == null)
                                        <span class="badge badge-danger">Belum Absen</span>
                                    @elseif($da->jam_pulang == null)
                                        <span class="badge badge-warning">Belum Pulang</span>
                                    @else
                                        {{ $da->keterangan_pulang }}
                                    @endif
                                </td>
                                <td>
                                    @if($da->status_absen == 'Libur')
                                        <span class="badge badge-info">{{ $da->status_absen }}</span>
                                    @elseif($da->status_absen == 'Cuti' || $da->status_absen == 'Izin Telat' || $da->status_absen == 'Izin Pulang Cepat')
                                        <span class="badge badge-warning">{{ $da->status_absen }}</span>
                                    @elseif($da->status_absen == 'Masuk')
                                        <span class="badge badge-success">{{ $da->status_absen }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $da->status_absen }}</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="action">
                                        @if($da->status_absen == 'Libur')
                                            <li class="me-2">
                                                <span class="badge badge-info">Libur</span>
                                            </li>
                                         @elseif($da->status_absen == 'Cuti')
                                            <li class="me-2">
                                                <span class="badge badge-warning">Sedang Izin</span>
                                            </li>
                                        @else
                                            @if ($da->id)
                                                <li class="me-2">
                                                    <a href="{{ url('/data-absen/'.$da->id.'/edit-masuk') }}" class="btn btn-xs btn-warning">Edit Masuk</a>
                                                </li>
                                            @endif
                                        @endif

                                        @if($da->status_absen == 'Libur')
                                            <li class="me-2">
                                                <span class="badge badge-info">Libur</span>
                                            </li>
                                        @elseif($da->status_absen == 'Cuti')
                                            <li class="me-2">
                                                <span class="badge badge-warning">Sedang Izin</span>
                                            </li>
                                        @elseif($da->jam_absen == null)
                                            <li class="me-2">
                                                <span class="badge badge-danger">Belum Masuk</span>
                                            </li>
                                        @else
                                            @if ($da->id)
                                                <li class="me-2">
                                                    <a href="{{ url('/data-absen/'.$da->id.'/edit-pulang') }}" class="btn btn-xs btn-warning">Edit Pulang</a>
                                                </li>
                                            @endif
                                        @endif

                                        @if ($da->id)
                                            <li class="delete">
                                                <form action="{{ url('/data-absen/'.$da->id.'/delete') }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="border-0" style="background-color: transparent" onClick="return confirm('Are You Sure')"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $data_absen->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#mulai').change(function(){
                    var mulai = $(this).val();
                $('#akhir').val(mulai);
                });
            });
        </script>
    @endpush
@endsection
