@extends('layouts.dashboard')
@section('isi')
<div class="container-fluid">
    <div class="card col-lg-12">
        <div class="mt-4 p-4">
            <form method="post" action="{{ url('/reset-cuti/'.$data_cuti->id) }}">
                @method('put')
                @csrf
                <div class="form-row">
                    <div class="col">
                        <label for="izin_cuti">Izin Cuti</label>
                        <input type="number" class="form-control @error('izin_cuti') is-invalid @enderror" id="izin_cuti" name="izin_cuti" value="{{ old('izin_cuti', $data_cuti->izin_cuti) }}">
                        @error('izin_cuti')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="izin_dinas_luar">Izin Dinas Luar</label>
                        <input type="number" class="form-control @error('izin_dinas_luar') is-invalid @enderror" id="izin_dinas_luar" name="izin_dinas_luar" value="{{ old('izin_dinas_luar', $data_cuti->izin_dinas_luar) }}">
                        @error('izin_dinas_luar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="izin_sakit">Izin Sakit</label>
                        <input type="number" class="form-control @error('izin_sakit') is-invalid @enderror" id="izin_sakit" name="izin_sakit" value="{{ old('izin_sakit', $data_cuti->izin_sakit) }}">
                        @error('izin_sakit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="izin_cek_kesehatan">Izin Cek Kesehatan</label>
                        <input type="number" class="form-control @error('izin_cek_kesehatan') is-invalid @enderror" id="izin_cek_kesehatan" name="izin_cek_kesehatan" value="{{ old('izin_cek_kesehatan', $data_cuti->izin_cek_kesehatan) }}">
                        @error('izin_cek_kesehatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="izin_keperluan_pribadi">Izin Keperluan Pribadi</label>
                        <input type="number" class="form-control @error('izin_keperluan_pribadi') is-invalid @enderror" id="izin_keperluan_pribadi" name="izin_keperluan_pribadi" value="{{ old('izin_keperluan_pribadi', $data_cuti->izin_keperluan_pribadi) }}">
                        @error('cuti_melahirkan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="izin_lainnya">Izin Lainnya</label>
                        <input type="number" class="form-control @error('izin_lainnya') is-invalid @enderror" id="izin_lainnya" name="izin_lainnya" value="{{ old('izin_lainnya', $data_cuti->izin_lainnya) }}">
                        @error('izin_lainnya')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="izin_telat">Izin Telat</label>
                        <input type="number" class="form-control @error('izin_telat') is-invalid @enderror" id="izin_telat" name="izin_telat" value="{{ old('izin_telat', $data_cuti->izin_telat) }}">
                        @error('izin_telat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="izin_pulang_cepat">Izin Pulang Cepat</label>
                        <input type="number" class="form-control @error('izin_pulang_cepat') is-invalid @enderror" id="izin_pulang_cepat" name="izin_pulang_cepat" value="{{ old('izin_pulang_cepat', $data_cuti->izin_pulang_cepat) }}">
                        @error('izin_pulang_cepat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
              </form>
              <br>
        </div>
    </div>
</div>
<br>
@endsection