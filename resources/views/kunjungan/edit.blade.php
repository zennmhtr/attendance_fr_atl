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
                        <a href="{{ url('/kunjungan') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/kunjungan/update/'.$kunjungan->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                        <div class="form-group">
                            <label for="user_id" class="float-left">Nama</label>
                            <select class="form-control selectpicker @error('user_id') is-invalid @enderror" id="user_id" name="user_id" data-live-search="true">
                                <option value="">-- Pilih --</option>
                                @foreach ($user as $us)
                                    @if(old('user_id', $kunjungan->id) == $us->id)
                                        <option value="{{ $us->id }}" selected>{{ $us->name }}</option>
                                    @else
                                        <option value="{{ $us->id }}">{{ $us->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal" class="float-left">Tanggal</label>
                            <input type="datetime" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $kunjungan->tanggal) }}">
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="visit_in" class="float-left">Visit In</label>
                            <input type="text" class="form-control clockpicker @error('visit_in') is-invalid @enderror" id="visit_in" name="visit_in" value="{{ old('visit_in', $kunjungan->visit_in) }}">
                            @error('visit_in')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="visit_out" class="float-left">Visit Out</label>
                            <input type="text" class="form-control clockpicker @error('visit_out') is-invalid @enderror" id="visit_out" name="visit_out" value="{{ old('visit_out', $kunjungan->visit_out) }}">
                            @error('visit_out')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col mb-4">
                                <label for="lat" class="float-left">Latitude</label>
                                <input type="text" class="form-control @error('lat') is-invalid @enderror" id="lat" name="lat" value="{{ old('lat') }}" readonly>
                                @error('lat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col mb-4">
                                <label for="long" class="float-left">Longitude</label>
                                <input type="text" class="form-control @error('long') is-invalid @enderror" id="long" name="long" value="{{ old('long') }}" readonly>
                                @error('long')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto">
                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan', $kunjungan->keterangan) }}</textarea>
                            @error('keterangan')
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
