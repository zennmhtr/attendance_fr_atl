@extends('templates.dashboard')
@section('isi')
   <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/rekap-data') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                        <button class="btn btn-primary ms-2" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal2">Export Rekap</button>
                        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModal2Label">Export Rekap</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center gap-2">
                                        <a href="{{ url('/rekap-data/export') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-success ms-2"><i class="fa fa-file-excel me-2"></i> Excel</a>
                                        <a href="{{ url('/rekap-data/rekap-pdf') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-danger" target="_blank"><i class="fa fa-file-pdf me-2"></i> Pdf</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-grey" type="button" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Export Details</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Export Details</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center gap-2">
                                        <a href="{{ url('/data-absen/export') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-success ms-2"><i class="fa fa-file-excel me-2"></i> Excel</a>
                                        <a href="{{ url('/rekap-data/detail-pdf') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-danger" target="_blank"><i class="fa fa-file-pdf me-2"></i> Pdf</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-grey" type="button" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/rekap-data/get-data') }}">
                            <div class="row">
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
                        <table  id="mytable">
                            <thead>
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <th>Total Hadir</th>
                                    <th>Total Alfa</th>
                                    <th>Total Libur</th>
                                    <th>Total Telat</th>
                                    <th>Persentase Kehadiran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_user as $du)
                                    <tr>
                                        @php
                                            $cuti = $du->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Cuti')->count();

                                            $izin_masuk = $du->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Izin Masuk')->count();

                                            $izin_telat = $du->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Izin Telat')->count();

                                            $izin_pulang_cepat = $du->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Izin Pulang Cepat')->count();

                                            $masuk = $du->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Masuk')->count();

                                            $total_hadir = $masuk + $izin_telat + $izin_pulang_cepat;

                                            $libur = $du->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Libur')->count();

                                            $mulai = new \DateTime($tanggal_mulai);
                                            $akhir = new \DateTime($tanggal_akhir);
                                            $interval = $mulai->diff($akhir);
                                            $total_alfa = $interval->days + 1 - $masuk - $cuti - $izin_masuk - $libur;

                                        @endphp
                                        <td>
                                            {{ $du->name }}
                                        </td>

                                        <td>
                                            {{ $total_hadir }} x
                                        </td>
                                        <td>
                                            {{ $total_alfa }}
                                        </td>
                                        <td>
                                            {{ $libur }} x
                                        </td>
                                        <td>
                                            @php
                                                $total_telat = $du->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->sum('telat');
                                                $jam   = floor($total_telat / (60 * 60));
                                                $menit = $total_telat - ( $jam * (60 * 60) );
                                                $menit2 = floor($menit / 60);
                                                $jumlah_telat = $du->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('telat', '>', 0)->count();
                                            @endphp

                                            @if($jam <= 0 && $menit2 <= 0)
                                                <span class="badge badge-success">Tidak Pernah Telat</span>
                                            @else
                                                <span class="badge badge-danger">{{ $jam." Jam ".$menit2." Menit" }}</span>
                                                <br>
                                                <span class="badge badge-danger">{{ $jumlah_telat }} x</span>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @php
                                                $timestamp_mulai = strtotime($tanggal_mulai);
                                                $timestamp_akhir = strtotime($tanggal_akhir);
                                                $selisih_timestamp = $timestamp_akhir - $timestamp_mulai;
                                                $jumlah_hari = (floor($selisih_timestamp / (60 * 60 * 24)))+1;
                                                $persentase_kehadiran = (($total_hadir + $libur) / $jumlah_hari) * 100;
                                            @endphp
                                            {{ $persentase_kehadiran }} %
                                        </td>
                                        <td>
                                            @php
                                                $pecah_tanggal = explode("-", $tanggal_mulai);
                                                $tahun_filter = $pecah_tanggal[0];
                                                $bulan_filter = intval($pecah_tanggal[1]);
                                                $payroll = \App\Models\Payroll::where('user_id', $du->id)->where('bulan', $bulan_filter)->where('tahun', $tahun_filter)->first();
                                            @endphp
                                            <ul class="action">
                                                @if (!$payroll)
                                                    <li class="me-2">
                                                        <a href="{{ url('/rekap-data/payroll/'.$du->id) }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" title="Input Gaji"><i style="color: orangered" class="fa fa-money me-2"></i></a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="{{ url('/data-absen/export?user_id='.$du->id) }}{{ $_GET?'&'.$_SERVER['QUERY_STRING']: '' }}" title="Download Absen"><i style="color: blue" class="fa fa-print"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mr-4">
                        {{ $data_user->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
