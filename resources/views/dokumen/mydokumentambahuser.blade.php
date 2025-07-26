@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/my-dokumen/tambah-proses') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="group-input">
                                <label for="nama_dokumen">Nama Dokumen</label>
                                <input type="text" name="nama_dokumen" value="{{ old('nama_dokumen') }}" class="@error('nama_dokumen') is-invalid @enderror" id="nama_dokumen">
                                @error('nama_dokumen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="group-input">
                                <label for="tanggal_berakhir">Tanggal Upload</label>
                                <input type="datetime" class="@error('tanggal_berakhir') is-invalid @enderror" id="tanggal_berakhir" name="tanggal_berakhir" autofocus value="{{ old('tanggal_berakhir') }}">
                                @error('tanggal_berakhir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="group-input">
                                <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file">
                                <span class="float-left font-italic form-control-sm" style="font-size: 10px">File yang di perbolehkan doc,docx,pdf,xls,xlsx,ppt,pptx dan Max Size 10 MB</span>
                                @error('file')
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
@endsection