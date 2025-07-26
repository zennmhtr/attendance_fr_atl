@extends('layouts.dashboard')
@section('isi')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <form action="{{ url('/my-lembur') }}">
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
                <table id="tableprintlembur" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Lokasi Masuk</th>
                            <th>Foto Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Lokasi Pulang</th>
                            <th>Foto Pulang</th>
                            <th>Total Lembur</th>
                            <th>Notes</th>
                            <th>User Approval</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lembur as $dl)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dl->User->name }}</td>
                                <td>{{ $dl->tanggal }}</td>
                                <td>
                                    @php
                                        $jam_masuk = explode(" ", $dl->jam_masuk);
                                    @endphp
                                    <span class="badge badge-success">{{ $jam_masuk[1] }}</span>
                                </td>
                                <td>
                                    @php
                                        $jarak_masuk = explode(".", $dl->jarak_masuk);
                                    @endphp
                                    <a href="{{ url('/maps/'.$dl->lat_masuk.'/'.$dl->long_masuk.'/'.$dl->user_id) }}" class="btn btn-sm btn-secondary" target="_blank">lihat</a>
                                    <span class="badge badge-warning">{{ $jarak_masuk[0] }} Meter</span>
                                </td>
                                <td>
                                    <img src="{{ url('storage/' . $dl->foto_jam_masuk) }}" style="width: 60px">
                                </td>
                                <td>
                                    @if ($dl->jam_keluar == null)
                                        <span class="badge badge-warning">Belum Pulang Lembur</span>
                                    @else
                                        @php
                                            $jam_keluar = explode(" ", $dl->jam_keluar);
                                        @endphp
                                        <span class="badge badge-success">{{ $jam_keluar[1] }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($dl->jam_keluar == null)
                                        <span class="badge badge-warning">Belum Pulang Lembur</span>
                                    @else
                                        @php
                                            $jarak_keluar = explode(".", $dl->jarak_keluar);
                                        @endphp
                                        <a href="{{ url('/maps/'.$dl->lat_keluar.'/'.$dl->long_keluar.'/'.$dl->user_id) }}" class="btn btn-sm btn-secondary" target="_blank">lihat</a>
                                        <span class="badge badge-warning">{{ $jarak_keluar[0] }} Meter</span>
                                    @endif
                                </td>
                                <td>
                                    @if($dl->jam_keluar == null)
                                        <span class="badge badge-warning">Belum Pulang Lembur</span>
                                    @else
                                        <img src="{{ url('storage/' . $dl->foto_jam_keluar) }}" style="width: 60px">
                                    @endif
                                </td>
                                <td>
                                    @if($dl->jam_keluar == null)
                                        <span class="badge badge-warning">Belum Pulang Lembur</span>
                                    @else
                                        @php
                                            $total_lembur = $dl->total_lembur;
                                            $jam   = floor($total_lembur / (60 * 60));
                                            $menit = $total_lembur - ( $jam * (60 * 60) );
                                            $menit2 = floor( $menit / 60 );
                                        @endphp
                                        <span class="badge badge-success">{{ $jam." Jam ".$menit2." Menit" }}</span>
                                    @endif
                                </td>
                                <td>{{ $dl->notes }}</td>
                                <td>{{ $dl->approvedBy ? $dl->approvedBy->name : '' }}</td>
                                <td>
                                    @if($dl->status == 'Pending')
                                        <span class="badge badge-warning">{{ $dl->status }}</span>
                                    @elseif($dl->status == 'Rejected')
                                        <span class="badge badge-danger">{{ $dl->status }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $dl->status }}</span>
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
