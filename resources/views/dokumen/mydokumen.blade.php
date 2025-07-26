@extends('layouts.dashboard')
@section('isi')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <center>
                    <a href="{{ url('/my-dokumen/tambah') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Dokumen</a>
                </center>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tableprint" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pegawai</th>
                            <th>Nama Dokumen</th>
                            <th>Tanggal Upload</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_dokumen as $dd)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dd->User->name }}</td>
                                <td>{{ $dd->nama_dokumen}}</td>
                                <td>{{ $dd->tanggal_berakhir}}</td>
                                
                                <td>
                                    <a href="{{ url('storage/'.$dd->file) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-solid fa-download"></i></a>
                                    <a href="{{ url('/my-dokumen/edit/'.$dd->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                    <form action="{{ url('/my-dokumen/delete/'.$dd->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm btn-circle" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <br>
@endsection
