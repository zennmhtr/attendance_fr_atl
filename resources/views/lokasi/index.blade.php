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
                        <a href="{{ url('/lokasi-kantor/tambah') }}" class="btn btn-primary ms-2">+ Tambah</a>
                        <a href="{{ url('/lokasi-kantor/pending-location') }}" class="btn btn-warning float-right btn-sm"><i class="fa fa-hourglass-start me-2"></i> Pending Location</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/lokasi-kantor') }}">
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
                                    <th>Nama Lokasi</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Radius (Meter)</th>
                                    <th>Created By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_lokasi as $dl)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dl->nama_lokasi }}</td>
                                        <td>{{ $dl->lat_kantor }}</td>
                                        <td>{{ $dl->long_kantor }}</td>
                                        <td>{{ $dl->radius }}</td>
                                        <td>{{ $dl->CreatedBy->name }}</td>
                                        <td>
                                            <ul class="action">
                                                <li>
                                                    <a href="{{ url('/lokasi-kantor/edit/'.$dl->id) }}"><i style="color:blue" class="fa fa-solid fa-edit"></i></a>
                                                </li>
                                                <li class="delete">
                                                    <form action="{{ url('/lokasi-kantor/delete/'.$dl->id) }}" method="post" class="d-inline">
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
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $data_lokasi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
