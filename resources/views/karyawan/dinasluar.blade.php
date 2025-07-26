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
                        <a href="{{ url('/pegawai') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="p-4">
                    <form method="post" action="{{ url('/pegawai/dinas-luar/proses-tambah-shift') }}">
                        @csrf
                            <div class="form-group">
                                <label for="shift_id" class="float-left">Shift</label>
                                <select class="form-control selectpicker @error('shift_id') is-invalid @enderror" id="shift_id" name="shift_id" data-live-search="true">
                                    <option value="">Pilih Shift</option>
                                    @foreach ($shift as $s)
                                        @if(old('shift_id') == $s->id)
                                            <option value="{{ $s->id }}" selected>{{ $s->nama_shift . " (" . $s->jam_masuk . " - " . $s->jam_keluar . ") " }}</option>
                                        @else
                                            <option value="{{ $s->id }}">{{ $s->nama_shift . " (" . $s->jam_masuk . " - " . $s->jam_keluar . ") " }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('shift_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_mulai" class="float-left">Tanggal Mulai</label>
                                <input type="datetime" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_akhir" class="float-left">Tanggal Akhir</label>
                                <input type="datetime" class="form-control @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                                @error('tanggal_akhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="hidden" name="tanggal">
                                <input type="hidden" name="status_absen">
                            <input type="hidden" name="user_id" value="{{ $karyawan->id }}">
                            </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <center>
                        <h3>{{ $karyawan->name }}</h3>
                    </center>
                    <hr>
                    <form action="{{ url('/pegawai/dinas-luar/'.$karyawan->id) }}">
                        <div class="row">
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="tanggal" placeholder="Tanggal" id="tanggal" value="{{ request('tanggal') }}">
                            </div>
                            <div class="col">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Shift Pegawai</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dinas_luar as $dl)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dl->tanggal}}</td>
                                        <td>{{ $dl->Shift->nama_shift}}</td>
                                        <td>{{ $dl->Shift->jam_masuk}}</td>
                                        <td>{{ $dl->Shift->jam_keluar}}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ url('/pegawai/edit-dinas/'.$dl->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                </li>
                                                <li class="delete">
                                                    <form action="{{ url('/pegawai/delete-dinas/'.$dl->id) }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $karyawan->id }}">
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
                </div>
                <div class="d-flex justify-content-end me-4 mb-4">
                    {{ $dinas_luar->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
