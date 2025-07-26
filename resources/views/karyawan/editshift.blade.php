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
                        <a href="{{ url('/pegawai/shift/'.$shift_karyawan->user_id) }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ url('/pegawai/proses-edit-shift/'.$shift_karyawan->id) }}" class="p-4">
                    @method('put')
                    @csrf
                        <div class="form-group">
                            <label for="shift_id" class="float-start">Jadwal</label>
                            <select class="form-control selectpicker @error('shift_id') is-invalid @enderror" id="shift_id" name="shift_id" data-live-search="true">
                                @foreach ($shift as $s)
                                    @if(old('shift_id', $shift_karyawan->shift_id) == $s->id)
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
                            <label for="tanggal" class="float-start">Tanggal</label>
                            <input type="datetime" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $shift_karyawan->tanggal) }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input name="lock_location" class="form-check-input lock_location" type="checkbox" value="{{ old('lock_location', $shift_karyawan->lock_location) }}" id="lock_location">
                            <label class="form-check-label" for="lock_location">
                                Lock Location
                            </label>
                        </div>
                        <input type="hidden" name="user_id" value="{{ $shift_karyawan->user_id }}">
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    @push('script')
        <script>
            $(function(){
                var lock_location = $('#lock_location').val();
                $('#lock_location').prop('checked', lock_location == "1");

                $('body').on('change', '#lock_location', function (event) {
                    if (this.checked) {
                        $('#lock_location').val(1)
                    } else {
                        $('#lock_location').val(null)
                    }
                });
            });
        </script>
    @endpush
@endsection
