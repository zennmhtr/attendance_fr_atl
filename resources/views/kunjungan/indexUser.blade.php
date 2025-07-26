@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/kunjungan') }}">

                    <div class="row">
                        <div class="col-4">
                            <input type="datetime" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                        </div>
                        <div class="col-4">
                            <input type="datetime" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                        </div>
                        <div class="col-4">
                            <button type="submit" id="search" class="form-control btn" style="border-radius: 10px; width:40px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <a href="{{ url('/kunjungan/tambah') }}" class="btn btn-sm btn-primary ms-4" style="border-radius: 10px">+ Tambah</a>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <table id="tablePayroll" class="table table-striped">
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
                                    <a href="{{ url('/maps/'.$kun->lat.'/'.$kun->long.'/'.$kun->user->id) }}" style="background-color: rgb(146, 146, 146)" class="btn btn-xs" target="_blank">Lihat</a>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/'.$kun->foto) }}" style="width: 100px">
                                </td>
                                <td>{{ $kun->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="{{ url('/kunjungan/edit/'.$kun->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                    <form action="{{ url('/kunjungan/delete/'.$kun->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm btn-circle" style="width: 40px" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        <div class="d-flex justify-content-end mr-4">
            {{ $kunjungan->links() }}
        </div>
    </div>
    <br>
    <br>
@endsection
