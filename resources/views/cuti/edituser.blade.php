@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form method="post" class="tf-form" action="{{ url('/cuti/proses-edit/'.$data_cuti_user->id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="group-input">
                        <label for="user_id" style="z-index: 1000">Nama Karyawan</label>
                        <select id="user_id" name="user_id" id="">
                            <option value="{{ $data_cuti_user->User->id }}">{{ $data_cuti_user->User->name }}</option>
                        </select>
                    </div>
                    <div class="group-input">
                        @php
                            $izin_cuti = $data_cuti_user->User->izin_cuti;
                            $izin_lainnya = $data_cuti_user->User->izin_lainnya;
                            $izin_telat = $data_cuti_user->User->izin_telat;
                            $izin_pulang_cepat = $data_cuti_user->User->izin_pulang_cepat;

                            $data_cuti = array(
                                [
                                    'nama' => 'Cuti',
                                    'nama_cuti' => 'Cuti ('.$izin_cuti.')'
                                ],
                                [
                                    'nama' => 'Izin Masuk',
                                    'nama_cuti' => 'Izin Masuk ('.$izin_lainnya.')'
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
                        <label for="nama_cuti"  style="z-index: 1000">Nama Cuti</label>
                        <select class="@error('nama_cuti') is-invalid @enderror" id="nama_cuti" name="nama_cuti" data-live-search="true">
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
                    <div class="group-input">
                        <label for="tanggal">Tanggal</label>
                        <input type="datetime" class="@error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{ old('tanggal', $data_cuti_user->tanggal) }}">
                        @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="group-input">
                        <input type="file" name="foto_cuti" id="foto_cuti" class="form-control @error('foto_cuti') is-invalid @enderror">
                        @error('foto_cuti')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input type="hidden" name="foto_cuti_lama" value="{{ $data_cuti_user->foto_cuti }}">
                    </div>
                    <div class="group-input">
                        <label for="alasan_cuti">Alasan Cuti</label>
                        <input type="text" class="@error('alasan_cuti') is-invalid @enderror" id="alasan_cuti" name="alasan_cuti" value="{{ old('alasan_cuti', $data_cuti_user->alasan_cuti) }}">
                        @error('alasan_cuti')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    @push('script')
        <script>
            $('select').select2();
        </script>
    @endpush
@endsection