@extends('layouts.dashboard')
@section('isi')
    <center>
        <div class="container-fluid">
            <div class="card col-lg-4">
                <div class="p-4">
                    <form method="post" action="{{ url('/auto-shift/update/'.$auto_shift->id) }}">
                        @method('put')
                        @csrf
                            <div class="form-group">
                                <label for="jabatan_id" class="float-left">Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($data_jabatan as $dj)
                                        @if(old('jabatan_id', $auto_shift->jabatan_id) == $dj->id)
                                        <option value="{{ $dj->id }}" selected>{{ $dj->nama_jabatan }}</option>
                                        @else
                                        <option value="{{ $dj->id }}">{{ $dj->nama_jabatan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('jabatan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                    <label for="shift_id" class="float-left">Shift</label>
                                    <select class="form-control selectpicker @error('shift_id') is-invalid @enderror" id="shift_id" name="shift_id" data-live-search="true">
                                        <option value="">Pilih Shift</option>
                                        @foreach ($shift as $s)
                                            @if(old('shift_id', $auto_shift->shift_id) == $s->id)
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
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                      </form>
                      <br>
                </div>
            </div>
        </div>
    </center>
    <br>
@endsection
