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
                        <a href="{{ url('/dokumen/tambah') }}" class="btn btn-primary">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/dokumen') }}">
                        <div class="row mb-2">
                            <div class="col-2">
                                <input type="text" placeholder="Search...." class="form-control" value="{{ request('search') }}" name="search">
                            </div>
                            <div class="col">
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
                                            <ul class="action">
                                                <li class="me-2">
                                                    <a href="{{ url('storage/'.$dd->file) }}" target="_blank"><i style="color: blue" class="fa fa-solid fa-download"></i></a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/dokumen/edit/'.$dd->id) }}"><i style="color: rgb(171, 97, 97)" class="fa fa-solid fa-edit"></i></a>
                                                </li>
                                                <li class="delete">
                                                    <form action="{{ url('/dokumen/delete/'.$dd->id) }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="border-0" style="background-color: transparent" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
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
                        {{ $data_dokumen->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
