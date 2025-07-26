@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/my-lembur') }}">
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
                                {{ $jam_masuk[1] }}
                            </td>
                            <td>
                                @php
                                    $jarak_masuk = explode(".", $dl->jarak_masuk);
                                @endphp
                                <a href="{{ url('/maps/'.$dl->lat_masuk.'/'.$dl->long_masuk.'/'.$dl->user_id) }}" class="btn btn-sm btn-secondary" target="_blank">lihat</a>
                                <br>
                                {{ $jarak_masuk[0] }} Meter
                            </td>
                            <td>
                                <img src="{{ url('storage/' . $dl->foto_jam_masuk) }}" style="width: 60px">
                            </td>
                            <td>
                                @if ($dl->jam_keluar == null)
                                    Belum Pulang Lembur
                                @else
                                    @php
                                        $jam_keluar = explode(" ", $dl->jam_keluar);
                                    @endphp
                                    {{ $jam_keluar[1] }}
                                @endif
                            </td>
                            <td>
                                @if($dl->jam_keluar == null)
                                    Belum Pulang Lembur
                                @else
                                    @php
                                        $jarak_keluar = explode(".", $dl->jarak_keluar);
                                    @endphp
                                    <a href="{{ url('/maps/'.$dl->lat_keluar.'/'.$dl->long_keluar.'/'.$dl->user_id) }}" class="btn btn-sm btn-secondary" target="_blank">lihat</a>
                                    <br>
                                    {{ $jarak_keluar[0] }} Meter
                                @endif
                            </td>
                            <td>
                                @if($dl->jam_keluar == null)
                                    Belum Pulang Lembur
                                @else
                                    <img src="{{ url('storage/' . $dl->foto_jam_keluar) }}" style="width: 60px">
                                @endif
                            </td>
                            <td>
                                @if($dl->jam_keluar == null)
                                    Belum Pulang Lembur
                                @else
                                    @php
                                        $total_lembur = $dl->total_lembur;
                                        $jam   = floor($total_lembur / (60 * 60));
                                        $menit = $total_lembur - ( $jam * (60 * 60) );
                                        $menit2 = floor( $menit / 60 );
                                    @endphp
                                    {{ $jam." Jam ".$menit2." Menit" }}
                                @endif
                            </td>
                            <td>{{ $dl->notes }}</td>
                            <td>{{ $dl->approvedBy ? $dl->approvedBy->name : '' }}</td>
                            <td>
                                @if($dl->status == 'Pending')
                                    {{ $dl->status }}
                                @elseif($dl->status == 'Rejected')
                                    {{ $dl->status }}
                                @else
                                    {{ $dl->status }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mr-4">
            {{ $data_lembur->links() }}
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
@endsection