@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('my-absen/pengajuan-proses/'.$ms->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="group-input">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" class="@error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $ms->tanggal) }}" disabled>
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="shift">Shift</label>
                            <input type="text" class="@error('shift') is-invalid @enderror" id="shift" name="shift" value="{{ old('shift', $ms->Shift->nama_shift . " (" . $ms->Shift->jam_masuk . " - " . $ms->Shift->jam_keluar . ") ") }}" disabled>
                            @error('shift')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="jam_masuk_pengajuan">Jam Masuk</label>
                            <input type="text" class="form-control clockpicker @error('jam_masuk_pengajuan') is-invalid @enderror" id="jam_masuk_pengajuan" name="jam_masuk_pengajuan" autofocus value="{{ old('jam_masuk_pengajuan', $ms->Shift->jam_masuk) }}">
                            @error('jam_masuk_pengajuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="jam_pulang_pengajuan">Jam Pulang</label>
                            <input type="text" class="form-control clockpicker @error('jam_pulang_pengajuan') is-invalid @enderror" id="jam_pulang_pengajuan" name="jam_pulang_pengajuan" autofocus value="{{ old('jam_pulang_pengajuan', $ms->Shift->jam_keluar) }}">
                            @error('jam_pulang_pengajuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="@error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <input type="file" class="form-control @error('file_pengajuan') is-invalid @enderror" id="file_pengajuan" name="file_pengajuan">
                            @error('file_pengajuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <input type="hidden" name="status_pengajuan" value="Menunggu">
                        
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
            $(document).ready(function(){
                $('.clockpicker').clockpicker({
                    donetext: 'Done'
                });

                $('select').select2();

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