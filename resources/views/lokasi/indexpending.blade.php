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
                        <a href="{{ url('/lokasi-kantor') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
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
                                            <ul class="action">
                                                <li>
                                                    <form action="{{ url('/lokasi-kantor/update-pending-location/'.$dl->id) }}" method="post" class="d-inline">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="status" value="approved">
                                                        <button class="border-0" style="background-color: transparent;" title="Approve" onClick="return confirm('Are You Sure To Approve?')"><i style="color: blue" class="fa fa fa-check-circle"></i></button>
                                                    </form>
                                                </li>
                                                <li class="delete">
                                                    <form action="{{ url('/lokasi-kantor/update-pending-location/'.$dl->id) }}" method="post" class="d-inline">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button  class="border-0" style="background-color: transparent;" title="Reject" onClick="return confirm('Are You Sure To Reject?')"><i class="fa fa-times-circle"></i></button>
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
