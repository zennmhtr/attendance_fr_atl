@extends('layouts.dashboard')
@section('isi')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/status-ptkp/tambah') }}" class="btn btn-primary">+ Tambah Status Pegawai</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('/status-ptkp') }}">
                    <div class="form-row mb-2">
                        <div class="col-2">
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}">
                        </div>
                        <div>
                            <button type="submit" id="search" class="form-control btn btn-secondary" style="border-radius: 10px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <table id="tablePayroll" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Status</th>
                            <th>Nilai PKTP 2016 DST</th>
                            <th>Nilai PKTP 2015</th>
                            <th>Nilai PKTP 2009 - 2012</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->name }}</td>
                                <td>Rp {{ number_format($d->ptkp_2016) }}</td>
                                <td>Rp {{ number_format($d->ptkp_2015) }}</td>
                                <td>Rp {{ number_format($d->ptkp_2009_2012) }}</td>
                                <td>
                                    <a href="{{ url('/status-ptkp/'.$d->id.'/edit') }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                    <form action="{{ url('/status-ptkp/'.$d->id.'/delete') }}" method="post" class="d-inline">
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
