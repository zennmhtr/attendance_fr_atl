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
                        <a href="{{ url('/kasbon/tambah') }}" class="btn btn-sm btn-primary">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/kasbon') }}">
                        @php
                            $status = array(
                            [
                                "status" => "PENDING",
                            ],
                            [
                                "status" => "ACC",
                            ]);
                        @endphp
                        <div class="row">
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="tanggal" placeholder="Tanggal" id="tanggal" value="{{ request('tanggal') }}">
                            </div>
                            <div class="col-3">
                                <select name="status" id="status" class="form-control selectpicker" data-live-search="true">
                                    <option value=""selected>Status</option>
                                    @foreach($status as $stat)
                                        @if(request('status') == $stat['status'])
                                            <option value="{{ $stat['status'] }}"selected>{{ $stat['status'] }}</option>
                                        @else
                                            <option value="{{ $stat['status'] }}">{{ $stat['status'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
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
                                    <th>Total</th>
                                    <th>Keperluan</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->User->name  }}</td>
                                        <td>Rp {{ number_format($d->nominal) }}</td>
                                        <td>{{ $d->keperluan  }}</td>
                                        <td>
                                            @if ($d->status == 'ACC')
                                                <span class="badge badge-success">{{ $d->status  }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ $d->status  }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action">
                                                @if (auth()->user()->is_admin == 'admin')
                                                    @if ($d->status !== 'ACC')
                                                        <li>
                                                            <a href="{{ url('/kasbon/edit/'.$d->id) }}"><i style="color: blue" class="fa fa-solid fa-edit"></i></a>
                                                        </li>
                                                    @endif
                                                    <li class="delete">
                                                        <form action="{{ url('/kasbon/delete/'.$d->id) }}" method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="border-0" style="background-color: transparent" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </li>
                                                @else
                                                    @if ($d->status !== 'ACC')
                                                        <li>
                                                            <a href="{{ url('/kasbon/edit/'.$d->id) }}"><i style="color: blue" class="fa fa-solid fa-edit"></i></a>
                                                        </li>
                                                        <li class="delete">
                                                            <form action="{{ url('/kasbon/delete/'.$d->id) }}" method="post" class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="border-0" style="background-color: transparent" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </li>
                                                    @else
                                                    -
                                                    @endif
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
