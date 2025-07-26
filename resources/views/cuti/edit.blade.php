@extends('layouts.dashboard')
@section('isi')
    <div class="container-fluid">
            <div class="card col-lg-12">
                <div class="mt-4 p-3">
                    <form method="post" action="{{ url('/cuti/proses-edit/'.$data_cuti_user->id) }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="user_id">Nama Karyawan</label>
                                <select id="user_id" name="user_id" class="form-control selectpicker" id="">
                                    <option value="{{ $data_cuti_user->User->id }}">{{ $data_cuti_user->User->name }}</option>
                                </select>
                            </div>
                            <div class="col">
                                @php
                                    $izin_cuti = $data_cuti_user->User->izin_cuti;
                                    $izin_dinas_luar = $data_cuti_user->User->izin_dinas_luar;
                                    $izin_sakit = $data_cuti_user->User->izin_sakit;
                                    $izin_cek_kesehatan = $data_cuti_user->User->izin_cek_kesehatan;
                                    $izin_keperluan_pribadi = $data_cuti_user->User->izin_keperluan_pribadi;
                                    $izin_lainnya = $data_cuti_user->User->izin_lainnya;
                                    $izin_telat = $data_cuti_user->User->izin_telat;
                                    $izin_pulang_cepat = $data_cuti_user->User->izin_pulang_cepat;

                                    $data_cuti = array(
                                        [
                                            'nama' => 'Izin Cuti',
                                            'nama_cuti' => 'Izin Cuti ('.$izin_cuti.')'
                                        ],
                                        [
                                            'nama' => 'Izin Dinas Luar',
                                            'nama_cuti' => 'Izin Dinas Luar ('.$izin_dinas_luar.')'
                                        ],
                                        [
                                            'nama' => 'Izin Sakit',
                                            'nama_cuti' => 'Izin Sakit ('.$izin_sakit.')'
                                        ],
                                        [
                                            'nama' => 'Izin Cek Kesehatan',
                                            'nama_cuti' => 'Izin Cek Kesehatan ('.$izin_cek_kesehatan.')'
                                        ],
                                        [
                                            'nama' => 'Izin Keperluan Pribadi',
                                            'nama_cuti' => 'Izin Keperluan Pribadi ('.$izin_keperluan_pribadi.')'
                                        ],
                                        [
                                            'nama' => 'Izin Lainnya',
                                            'nama_cuti' => 'Izin Lainnya ('.$izin_lainnya.')'
                                        ],
                                        [
                                            'nama' => 'Izin Telat',
                                            'nama_cuti' => 'Izin Telat ('.$izin_telat.')'
                                        ],
                                        [
                                            'nama' => 'Izin Pulang Cepat',
                                            'nama_cuti' => 'Izin Pulang Cepat ('.$izin_pulang_cepat.')'
                                        ]
                                    );
                                @endphp
                                <label for="nama_cuti">Nama Cuti</label>
                                <select class="form-control selectpicker @error('nama_cuti') is-invalid @enderror" id="nama_cuti" name="nama_cuti" data-live-search="true">
                                    <option value="">Pilih Cuti</option>
                                    @foreach ($data_cuti as $dc)
                                    @if(old('nama_cuti', $data_cuti_user->nama_cuti) == $dc["nama"])
                                    <option value="{{ $dc["nama"] }}" selected>{{ $dc["nama_cuti"] }}</option>
                                    @else
                                    <option value="{{ $dc["nama"] }}">{{ $dc["nama_cuti"] }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('nama_cuti')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="tanggal">Tanggal</label>
                                <input type="datetime" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{ old('tanggal', $data_cuti_user->tanggal) }}">
                                @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="foto_cuti">Unggah Foto</label>
                                <input type="file" name="foto_cuti" id="foto_cuti" class="form-control @error('foto_cuti') is-invalid @enderror">
                                @error('foto_cuti')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="hidden" name="foto_cuti_lama" value="{{ $data_cuti_user->foto_cuti }}">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="alasan_cuti">Alasan Cuti</label>
                                <input type="text" class="form-control @error('alasan_cuti') is-invalid @enderror" id="alasan_cuti" name="alasan_cuti" value="{{ old('alasan_cuti', $data_cuti_user->alasan_cuti) }}">
                                @error('alasan_cuti')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <br>
                </div>
            </div>
    </div>
    <br>
@endsection
