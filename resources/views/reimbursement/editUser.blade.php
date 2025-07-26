@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/reimbursement/update/'.$reimbursement->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="group-input">
                            <label for="pegawai">Nama Pegawai</label>
                            <input type="text" class="@error('pegawai') is-invalid @enderror" id="pegawai" name="pegawai" value="{{ old('pegawai', $reimbursement->user->name) }}" readonly>
                            <input type="hidden" name="user_id" id="user_id" value="{{ $reimbursement->user_id }}">
                        </div>
                        <div class="group-input">
                            <label for="tanggal">Tanggal</label>
                            <input type="datetime" class="@error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $reimbursement->tanggal) }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="event">event</label>
                            <textarea name="event" id="event" class="@error('event') is-invalid @enderror">{{ old('event', $reimbursement->event) }}</textarea>
                            @error('event')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <select class="@error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" data-live-search="true">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $kat)
                                    @if(old('kategori_id', $reimbursement->kategori_id) == $kat->id)
                                        <option value="{{ $kat->id }}" selected>{{ $kat->name }}</option>
                                    @else
                                        <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="status">status</label>
                            <input type="text" class="@error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status', $reimbursement->status) }}">
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="money @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', $reimbursement->jumlah) }}">
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <input type="file" class="form-control @error('file_path') is-invalid @enderror" id="file_path" name="file_path" value="{{ old('file_path') }}">
                            @error('file_path')
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
