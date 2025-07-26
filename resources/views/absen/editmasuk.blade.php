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
                <form method="post" class="p-4" action="{{ url('/data-absen/'.$data_absen->id.'/proses-edit-masuk') }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="jam_absen">Jam Absen</label>
                        <input type="text" class="form-control clockpicker @error('jam_absen') is-invalid @enderror" id="jam_absen" name="jam_absen" value="{{ old('jam_absen', $data_absen->jam_absen) }}">
                        @error('jam_absen')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto_jam_absen">Foto Absen Masuk</label>
                        <input type="file" class="form-control @error('foto_jam_absen') is-invalid @enderror" name="foto_jam_absen" id="foto_jam_absen">
                        @error('foto_jam_absen')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input type="hidden" name="foto_jam_absen_lama" value="{{ $data_absen->foto_jam_absen }}">
                    </div>
                    <input type="hidden" name="lat_absen" value="{{ $lokasi_kantor->lat_kantor }}">
                    <input type="hidden" name="long_absen" value="{{ $lokasi_kantor->long_kantor }}">
                    <input type="hidden" name="telat">
                    <input type="hidden" name="jarak_masuk">
                    <input type="hidden" name="status_absen" value="Masuk">
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
