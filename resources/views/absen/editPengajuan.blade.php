@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/pengajuan-absensi/update/'.$ms->id) }}" enctype="multipart/form-data">
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
                            <label for="shift">Jadwal</label>
                            <input type="text" class="@error('shift') is-invalid @enderror" id="shift" name="shift" value="{{ old('shift', $ms->Shift->nama_shift . " (" . $ms->Shift->jam_masuk . " - " . $ms->Shift->jam_keluar . ") ") }}" disabled>
                            @error('shift')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="jam_masuk_pengajuan">Jam Masuk</label>
                            <input type="text" class="form-control clockpicker @error('jam_masuk_pengajuan') is-invalid @enderror" id="jam_masuk_pengajuan" name="jam_masuk_pengajuan" autofocus value="{{ old('jam_masuk_pengajuan', $ms->jam_masuk_pengajuan) }}">
                            @error('jam_masuk_pengajuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="jam_pulang_pengajuan">Jam Pulang</label>
                            <input type="text" class="form-control clockpicker @error('jam_pulang_pengajuan') is-invalid @enderror" id="jam_pulang_pengajuan" name="jam_pulang_pengajuan" autofocus value="{{ old('jam_pulang_pengajuan', $ms->jam_pulang_pengajuan) }}">
                            @error('jam_pulang_pengajuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="@error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $ms->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if ($jabatan->manager !== auth()->user()->id)
                            <div class="group-input">
                                <input type="file" class="form-control @error('file_pengajuan') is-invalid @enderror" id="file_pengajuan" name="file_pengajuan">
                                @error('file_pengajuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="group-input">
                                <label for="status_display">Status Pengajuan</label>
                                <input type="text" class="@error('status_display') is-invalid @enderror" id="status_display" name="status_display" value="{{ old('status_display', $ms->status_pengajuan) }}" readonly>
                                @error('status_display')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <input type="hidden" name="status_pengajuan" value="Menunggu">
                        @endif

                        <div class="group-input">
                            <a href="{{ url('/storage/'.$ms->file_pengajuan) }}" target="_blank" class="form-control btn btn-success"><i class="fa fa-download me-2"></i> Lihat File</a>
                        </div>

                        <div class="group-input">
                            <label for="komentar">Komentar</label>
                            <textarea name="komentar" id="komentar" class="@error('komentar') is-invalid @enderror" {{ $jabatan->manager !== auth()->user()->id ? 'readonly' : '' }}>{{ old('komentar', $ms->komentar) }}</textarea>
                            @error('komentar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if ($jabatan->manager == auth()->user()->id)
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" name="status_pengajuan" value="Tidak Disejutui" class="btn btn-danger float-right" {{ $ms->status_pengajuan == 'Disetujui' ? 'disabled' : '' }}>Tidak Setuju</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" name="status_pengajuan" value="Disetujui" class="btn btn-primary float-right" {{ $ms->status_pengajuan == 'Disetujui' ? 'disabled' : '' }}>Setuju</button>
                                </div>
                            </div>
                        @else
                            <button type="submit" class="btn btn-primary float-right" {{ $ms->status_pengajuan == 'Disetujui' ? 'disabled' : '' }}>Submit</button>
                        @endif
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