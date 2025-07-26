@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/my-dokumen') }}">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" name="search" placeholder="search.." id="search" value="{{ request('search') }}">
                        </div>
                        
                        <div class="col-2">
                            <button type="submit" id="search" class="form-control btn" style="border-radius: 10px; width:40px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <a href="{{ url('/my-dokumen/tambah') }}" class="btn btn-primary btn-sm ms-4" style="font-size: 12px">+ Tambah</a>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <table id="tablePayroll" class="table table-bordered table-striped">
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
                                    <button class="btn btn-danger btn-sm btn-circle" style="width: 30px" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mr-4">
            {{ $data_dokumen->links() }}
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
@endsection