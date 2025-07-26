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
                        <a href="{{ url('/reimbursement') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/reimbursement/update/'.$reimbursement->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                        <div class="form-group">
                            <label for="tanggal" class="float-left">Tanggal</label>
                            <input type="datetime" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" autofocus value="{{ old('tanggal', $reimbursement->tanggal) }}">
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id" class="float-left">Nama</label>
                            <select class="form-control selectpicker @error('user_id') is-invalid @enderror" id="user_id" name="user_id" data-live-search="true">
                                <option value="">-- Pilih --</option>
                                @foreach ($user as $us)
                                    @if(old('user_id', $reimbursement->user_id) == $us->id)
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
                            <label for="event" class="float-left">Event</label>
                            <input type="text" class="form-control @error('event') is-invalid @enderror" id="event" name="event" value="{{ old('event', $reimbursement->event) }}">
                            @error('event')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori_id" class="float-left">Kategori</label>
                            <select class="form-control selectpicker @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" data-live-search="true">
                                <option value="">-- Pilih --</option>
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
                        <div class="form-group">
                            <label for="status" class="float-left">Status</label>
                            <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" readonly name="status" value="{{ old('status', $reimbursement->status) }}">
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="float-left">Jumlah</label>
                            <input type="text" class="form-control money @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', $reimbursement->jumlah) }}">
                            @error('jumlah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="file_path" class="form-label">File</label>
                            <input class="form-control @error('file_path') is-invalid @enderror" type="file" id="file_path" name="file_path">
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

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.money').mask('000,000,000,000,000', {
                    reverse: true
                });
            });
        </script>
    @endpush
@endsection
