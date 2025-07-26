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
                        <a href="{{ url('/data-absen') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/data-absen/'.$data_absen->id.'/proses-edit-pulang') }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="jam_pulang">Jam Pulang</label>
                        <input type="text" class="form-control clockpicker @error('jam_pulang') is-invalid @enderror" name="jam_pulang" id="jam_pulang" value="{{ old('jam_pulang', $data_absen->jam_pulang) }}">
                        @error('jam_pulang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto_jam_pulang">Foto Absen Pulang</label>
                        <input type="file" class="form-control @error('foto_jam_pulang') is-invalid @enderror" id="foto_jam_pulang" name="foto_jam_pulang">
                        @error('foto_jam_pulang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input type="hidden" name="foto_jam_pulang_lama" value="{{ $data_absen->foto_jam_pulang }}">
                    </div>
                    <input type="hidden" name="lat_pulang" value="{{ $lokasi_kantor->lat_kantor }}">
                    <input type="hidden" name="long_pulang" value="{{ $lokasi_kantor->long_kantor }}">
                    <input type="hidden" name="pulang_cepat">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function(){
                $('.clockpicker').clockpicker({
                    donetext: 'Done'
                });

                $('body').on('keyup', '.clockpicker', function (event) {
                    var val = $(this).val();
                    val = val.replace(/[^0-9:]/g, '');
                    val = val.replace(/:+/g, ':');
                    $(this).val(val);
                });
            });
        </script>
    @endpush
@endsection
