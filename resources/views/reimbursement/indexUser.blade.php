@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/reimbursement') }}">

                    <div class="row">
                        <div class="col-4">
                            <input type="datetime" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                        </div>
                        <div class="col-4">
                            <input type="datetime" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
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
    <a href="{{ url('/reimbursement/tambah') }}" class="btn btn-sm btn-primary ms-4" style="border-radius: 10px">+ Tambah</a>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <table id="tablePayroll" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Event</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th>File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reimbursement as $re)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $re->tanggal ?? '-' }}</td>
                                <td>{{ $re->user->name ?? '-' }}</td>
                                <td>{{ $re->event ?? '-' }}</td>
                                <td>{{ $re->kategori->name ?? '-' }}</td>
                                <td>{{ $re->status ?? '-' }}</td>
                                <td>Rp {{ number_format($re->jumlah) }}</td>
                                <td>
                                    @if($re->file_path)
                                        <a href="{{ url('/storage/'.$re->file_path) }}" target="_blank" class=""><i class="fa fa-download me-2"></i>{{ $re->file_name }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($re->status == 'Pending')
                                        <a href="{{ url('/reimbursement/edit/'.$re->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                        <form action="{{ url('/reimbursement/delete/'.$re->id) }}" method="post" class="d-inline">
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
            {{ $reimbursement->links() }}
        </div>
    </div>
    <br>
    <br>
@endsection
