@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
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
                        <div class="col-4">
                            <input type="datetime" name="tanggal" placeholder="Tanggal" id="tanggal" value="{{ request('tanggal') }}">
                        </div>
                        <div class="col-4">
                            <select name="status" id="status" data-live-search="true">
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
                        <div class="col-4">
                            <button type="submit" id="search" class="form-control btn" style="border-radius: 10px; width:40px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <a href="{{ url('/kasbon/tambah') }}" class="btn btn-sm btn-primary ms-4" style="border-radius: 10px">+ Tambah</a>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <table id="tablePayroll" class="table table-striped">
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
                                        {{ $d->status  }}
                                    @else
                                        {{ $d->status  }}
                                    @endif
                                </td>
                                <td>
                                    @if (auth()->user()->is_admin == 'admin')
                                        @if ($d->status !== 'ACC')
                                            <a href="{{ url('/kasbon/edit/'.$d->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                        @endif
                                        <form action="{{ url('/kasbon/delete/'.$d->id) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm btn-circle" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                        </form>
                                    @else
                                        @if ($d->status !== 'ACC')
                                            <a href="{{ url('/kasbon/edit/'.$d->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                            <form action="{{ url('/kasbon/delete/'.$d->id) }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm btn-circle" style="width: 40px" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                            </form>
                                        @else
                                        -
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        <div class="d-flex justify-content-end mr-4">
            {{ $data->links() }}
        </div>
    </div>
    <br>
    <br>
@endsection