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
                        <a href="{{ url('/shift') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/shift/'.$shift->id) }}">
                    @method('put')
                    @csrf
                        <div class="form-group">
                            <label for="nama_shift" class="float-left">Nama Jadwal</label>
                            <input type="text" class="form-control @error('nama_shift') is-invalid @enderror" id="nama_shift" name="nama_shift" autofocus value="{{ old('nama_shift', $shift->nama_shift) }}">
                            @error('nama_shift')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_masuk" class="float-left">Jam Masuk</label>
                            <input type="text" class="form-control clockpicker @error('jam_masuk') is-invalid @enderror" id="jam_masuk" name="jam_masuk" autofocus value="{{ old('jam_masuk', $shift->jam_masuk) }}">
                            @error('jam_masuk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_keluar" class="float-left">Jam Keluar</label>
                            <input type="text" class="form-control clockpicker @error('jam_keluar') is-invalid @enderror" id="jam_keluar" name="jam_keluar" autofocus value="{{ old('jam_keluar', $shift->jam_keluar) }}">
                            @error('jam_keluar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
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
