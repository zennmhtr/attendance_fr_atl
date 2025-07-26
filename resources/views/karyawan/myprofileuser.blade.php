@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner-left d-flex justify-content-between align-items-center">
                        @if(auth()->user()->foto_karyawan == null)
                            <img src="{{ url('assets/img/foto_default.jpg') }}" alt="image">
                        @else
                            <img src="{{ url('/storage/'.auth()->user()->foto_karyawan) }}" alt="image">
                        @endif
                        <p class="fw_7 on_surface_color">{{ auth()->user()->name }}</p>
                    </div>
                    <p class="fw_7 on_surface_color">{{ auth()->user()->Jabatan->nama_jabatan }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <form class="tf-form" action="{{ url('/my-profile/update/'.auth()->user()->id) }}" enctype="multipart/form-data" method="POST">
            @method('PUT')
            @csrf
            <div class="tf-container">
                <h3>Informasi Karyawan</h3>
                <br>
                <div class="group-input">
                    <label>Nama Karyawan</label>
                    <input type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name', auth()->user()->name) }}" />
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input input-group">
                    <input type="file" class="form-control @error('foto_karyawan') is-invalid @enderror" name="foto_karyawan" />
                    <span class="input-group-text" id="basic-addon2">Foto</span>
                    @error('foto_karyawan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="hidden" name="foto_karyawan_lama" value="{{ auth()->user()->foto_karyawan }}">
                </div>
                <div class="group-input">
                    <label>Email</label>
                    <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email', auth()->user()->email) }}" />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Telepon</label>
                    <input type="text" class="@error('telepon') is-invalid @enderror" name="telepon" value="{{ old('telepon', auth()->user()->telepon) }}" />
                    @error('telepon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Username</label>
                    <input type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username', auth()->user()->username) }}" />
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Roles</label>
                    <input type="text" class="@error('is_admin') is-invalid @enderror" name="is_admin" value="{{ auth()->user()->is_admin }}" readonly />
                    @error('is_admin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="hidden" name="password" value="{{ auth()->user()->password }}">
                </div>
                <div class="group-input">
                    <label>Tanggal Lahir</label>
                    <input type="datetime" class="@error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir', auth()->user()->tgl_lahir) }}" />
                    @error('tgl_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Tanggal Masuk Perusahaan</label>
                    <input type="datetime" class="@error('tgl_join') is-invalid @enderror" name="tgl_join" value="{{ old('tgl_join', auth()->user()->tgl_join) }}" />
                    @error('tgl_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    @php
                        $gender = array(
                            [
                                "gender" => "Laki-Laki"
                            ],
                            [
                                "gender" => "Perempuan"
                            ]
                        );
                    @endphp
                    <label style="z-index: 1000">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="">- - Pilih - -</option>
                        @foreach ($gender as $g)
                            @if(old('gender', auth()->user()->gender) == $g["gender"])
                                <option value="{{ $g["gender"] }}" selected>{{ $g["gender"] }}</option>
                            @else
                                <option value="{{ $g["gender"] }}">{{ $g["gender"] }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('tgl_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="group-input">
                    @php
                        $status_nikah = array(
                            [
                                "status_nikah" => "Menikah"
                            ],
                            [
                                "status_nikah" => "Lajang"
                            ]
                        );
                    @endphp
                    <label style="z-index: 1000">Status Nikah</label>
                    <select name="status_nikah" id="status_nikah" class="form-select">
                        <option value="">- - Pilih - -</option>
                        @foreach ($status_nikah as $sn)
                            @if(old('status_nikah', auth()->user()->status_nikah) == $sn["status_nikah"])
                                <option value="{{ $sn["status_nikah"] }}" selected>{{ $sn["status_nikah"] }}</option>
                            @else
                                <option value="{{ $sn["status_nikah"] }}">{{ $sn["status_nikah"] }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('tgl_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Rekening</label>
                    <input type="number" class="@error('rekening') is-invalid @enderror" name="rekening" value="{{ old('rekening', auth()->user()->rekening) }}" />
                    @error('rekening')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Alamat</label>
                    <textarea name="alamat" class="@error('alamat') is-invalid @enderror">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <h3>Cuti & Izin</h3>
                <br>
                <div class="group-input">
                    <label>Cuti</label>
                    <input type="number" class="@error('izin_cuti') is-invalid @enderror" name="izin_cuti" value="{{ old('izin_cuti', auth()->user()->izin_cuti) }}" readonly />
                    @error('izin_cuti')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Izin Masuk</label>
                    <input type="number" class="@error('izin_lainnya') is-invalid @enderror" name="izin_lainnya" value="{{ old('izin_lainnya', auth()->user()->izin_lainnya) }}" readonly />
                    @error('izin_lainnya')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Izin Telat</label>
                    <input type="number" class="@error('izin_telat') is-invalid @enderror" name="izin_telat" value="{{ old('izin_telat', auth()->user()->izin_telat) }}" readonly />
                    @error('izin_telat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Izin Pulang Cepat</label>
                    <input type="number" class="@error('izin_pulang_cepat') is-invalid @enderror" name="izin_pulang_cepat" value="{{ old('izin_pulang_cepat', auth()->user()->izin_pulang_cepat) }}" readonly />
                    @error('izin_pulang_cepat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <h3>Penjumlahan Gaji</h3>
                <br>
                <div class="group-input">
                    <label>Gaji Pokok</label>
                    <input type="text" class="money @error('gaji_pokok') is-invalid @enderror" name="gaji_pokok" value="{{ old('gaji_pokok', auth()->user()->gaji_pokok) }}" readonly />
                    @error('gaji_pokok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Makan & Transport</label>
                    <input type="text" class="money @error('makan_transport') is-invalid @enderror" name="makan_transport" value="{{ old('makan_transport', auth()->user()->makan_transport) }}" readonly />
                    @error('makan_transport')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Lembur</label>
                    <input type="text" class="money @error('lembur') is-invalid @enderror" name="lembur" value="{{ old('lembur', auth()->user()->lembur) }}" readonly />
                    @error('lembur')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>100% Kehadiran</label>
                    <input type="text" class="money @error('kehadiran') is-invalid @enderror" name="kehadiran" value="{{ old('kehadiran', auth()->user()->kehadiran) }}" readonly />
                    @error('kehadiran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>THR</label>
                    <input type="text" class="money @error('thr') is-invalid @enderror" name="thr" value="{{ old('thr', auth()->user()->thr) }}" readonly />
                    @error('thr')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Bonus</label>
                    <input type="text" class="money @error('bonus') is-invalid @enderror" name="bonus" value="{{ old('bonus', auth()->user()->bonus) }}" readonly />
                    @error('bonus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <h3>Pengurangan Gaji</h3>
                <br>
                <div class="group-input">
                    <label>Izin</label>
                    <input type="text" class="money @error('izin') is-invalid @enderror" name="izin" value="{{ old('izin', auth()->user()->izin) }}" readonly />
                    @error('izin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Terlambat</label>
                    <input type="text" class="money @error('terlambat') is-invalid @enderror" name="terlambat" value="{{ old('terlambat', auth()->user()->terlambat) }}" readonly />
                    @error('terlambat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Mangkir</label>
                    <input type="text" class="money @error('mangkir') is-invalid @enderror" name="mangkir" value="{{ old('mangkir', auth()->user()->mangkir) }}" readonly />
                    @error('mangkir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="group-input">
                    <label>Saldo Kasbon</label>
                    <input type="text" class="money @error('saldo_kasbon') is-invalid @enderror" name="saldo_kasbon" value="{{ old('saldo_kasbon', auth()->user()->saldo_kasbon) }}" readonly />
                    @error('saldo_kasbon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="tf-btn accent large">Save</button>
            </div>
            <br>
            <br>
            <br>
            <br>
        </form>
    </div>
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $('.money').mask('000,000,000,000,000', {
                reverse: true
            });
            $('#gender').select2();
            $('#status_nikah').select2();
        </script>
    @endpush
@endsection