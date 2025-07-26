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
                        <a href="{{ url('/kunjungan/tambah') }}" class="btn btn-primary">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/kunjungan') }}">
                        <div class="row mb-2">
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
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Visit In</th>
                                    <th>Visit Out</th>
                                    <th>Lokasi</th>
                                    <th>Foto</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kunjungan as $kun)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kun->user->name ?? '-' }}</td>
                                        <td>{{ $kun->tanggal ?? '-' }}</td>
                                        <td>{{ $kun->visit_in ?? '-' }}</td>
                                        <td>{{ $kun->visit_out ?? '-' }}</td>
                                        <td>
                                            <a href="{{ url('/maps/'.$kun->lat.'/'.$kun->long.'/'.$kun->user->id) }}" style="background-color: rgb(146, 146, 146)" class="btn btn-xs" target="_blank"><i class="fa fa-eye" class="me-2"></i> Lihat</a>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/'.$kun->foto) }}" style="width: 100px">
                                        </td>
                                        <td>{{ $kun->keterangan ?? '-' }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ url('/kunjungan/edit/'.$kun->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                </li>
                                                <li class="delete">
                                                    <form action="{{ url('/kunjungan/delete/'.$kun->id) }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $kunjungan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

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
