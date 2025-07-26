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
                        <a href="{{ url('/jabatan/create') }}" class="btn btn-primary">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/jabatan') }}">
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
                                    <th>Nama Jabatan</th>
                                    <th>Manager</th>
                                    <th>Anggota</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_jabatan as $dj)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dj->nama_jabatan }}</td>
                                        <td>{{ $dj->atasan($dj->manager)->name ?? '-' }}</td>
                                        <td>
                                            @if (count($dj->anggota($dj->id, $dj->manager)) > 0)
                                                @foreach ($dj->anggota($dj->id, $dj->manager) as $user)
                                                    <span class="badge badge-warning">{{ $user->name }}</span>
                                                @endforeach
                                            @else
                                                -                                                
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li>
                                                    <a href="{{ url('/jabatan/edit/'.$dj->id) }}"><i style="color:blue" class="fa fa-solid fa-edit"></i></a>
                                                </li>
                                                <li class="delete">
                                                    <form action="{{ url('/jabatan/delete/'.$dj->id) }}" method="post" class="d-inline">
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
                        {{ $data_jabatan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
