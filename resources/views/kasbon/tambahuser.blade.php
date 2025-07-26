@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/kasbon/tambah-proses') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="group-input">
                            @if (auth()->user()->is_admin == 'admin')
                                <label for="user_id">Nama Pegawai</label>
                                <select class="@error('user_id') is-invalid @enderror" id="user_id" name="user_id" data-live-search="true">
                                    <option value="">Pilih Pegawai</option>
                                    @foreach ($data_user as $du)
                                        @if(old('user_id') == $du->id)
                                            <option value="{{ $du->id }}" selected>{{ $du->name }}</option>
                                        @else
                                            <option value="{{ $du->id }}">{{ $du->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @else
                                <label for="pegawai">Nama Pegawai</label>
                                <input type="text" class="@error('pegawai') is-invalid @enderror" id="pegawai" name="pegawai" value="{{ old('pegawai', auth()->user()->name) }}" readonly>
                                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                            @endif
                        </div>
                        <div class="group-input">
                            <label for="tanggal">Tanggal</label>
                            <input type="datetime" class="@error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="group-input">
                            <label for="nominal">Nominal</label>
                            <input type="text" class="money @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal') }}">
                            @error('nominal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="group-input">
                            <label for="keperluan">Keperluan</label>
                            <textarea name="keperluan" id="keperluan" class="@error('keperluan') is-invalid @enderror">{{ old('keperluan') }}</textarea>
                            @error('keperluan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="hidden" name="status" value="PENDING">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
     @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $('.money').mask('000,000,000,000,000', {
                reverse: true
            });
            $('select').select2();
        </script>
    @endpush
@endsection