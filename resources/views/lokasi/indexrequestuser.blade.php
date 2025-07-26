@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/request-location') }}">
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
    <a href="{{ url('/request-location/tambah') }}" class="btn btn-primary btn-sm ms-4" style="font-size: 12px">+ Tambah Data Lokasi</a>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <table id="tablePayroll" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Lokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Radius (Meter)</th>
                            <th>Status</th>
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
                                <td>{{ $dl->status }}</td>
                                <td>{{ $dl->CreatedBy->name }}</td>
                                <td>
                                    @if ($dl->status == 'approved')
                                        <span class="badge badge-success">{{ $dl->status }}</span>
                                    @else
                                        <a href="{{ url('/request-location/edit/'.$dl->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                        <form action="{{ url('/request-location/delete/'.$dl->id) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm btn-circle" style="width: 40px" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mr-4">
            {{ $data_lokasi->links() }}
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
@endsection