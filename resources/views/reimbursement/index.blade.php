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
                        <a href="{{ url('/reimbursement/tambah') }}" class="btn btn-primary">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/reimbursement') }}">
                        <div class="row mb-2">
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
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
                                        <td>
                                            @if($re->status == 'Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($re->status == 'Approved')
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($re->jumlah) }}</td>
                                        <td>
                                            @if($re->file_path)
                                                <a href="{{ url('/storage/'.$re->file_path) }}" target="_blank" class="btn btn-primary"><i class="fa fa-download me-2"></i>{{ $re->file_name }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action">
                                                @if ($re->status == 'Pending')
                                                    <button class="border-0" style="background-color: transparent" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i style="color:blue" class="fa fa-check-circle"></i></button>

                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Approval</h5>
                                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ url('/reimbursement/approval/'.$re->id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            @php
                                                                                $status = array(
                                                                                    [
                                                                                        "status" => "Pending",
                                                                                        "status_name" => "Pending"
                                                                                    ],
                                                                                    [
                                                                                        "status" => "Approved",
                                                                                        "status_name" => "Approve"
                                                                                    ],
                                                                                    [
                                                                                        "status" => "Rejected",
                                                                                        "status_name" => "Reject"
                                                                                    ]
                                                                                );
                                                                            @endphp
                                                                            <label for="status">Status</label>
                                                                            <select name="status" id="status" class="form-control selectpicker" data-live-search="true">
                                                                                <option value="">-- Pilih --</option>
                                                                                @foreach ($status as $s)
                                                                                    @if(old('status', $re->status) == $s["status"])
                                                                                    <option value="{{ $s["status"] }}" selected>{{ $s["status_name"] }}</option>
                                                                                    @else
                                                                                    <option value="{{ $s["status"] }}">{{ $s["status_name"] }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                            @error('status')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                                                        <button class="btn btn-secondary" type="submit">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <li class="edit">
                                                        <a href="{{ url('/reimbursement/edit/'.$re->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                    </li>
                                                    <li class="delete">
                                                        <form action="{{ url('/reimbursement/delete/'.$re->id) }}" method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $reimbursement->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#mulai').change(function(){
                    var mulai = $(this).val();
                $('#akhir').val(mulai);
                });
            });
        </script>
    @endpush
@endsection
