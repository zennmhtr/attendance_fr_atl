@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ url('/payroll/'.$data->id.'/update') }}" enctype="multipart/form-data" class="p-4">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col mb-4">
                            <label for="pegawai">Nama Karyawan</label>
                            <input type="text" class="form-control @error('pegawai') is-invalid @enderror" id="pegawai" name="pegawai" value="{{ old('pegawai', $data->user->name ?? '') }}" readonly>
                            @error('pegawai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <input type="hidden" name="user_id" value="{{ $data->id }}">
                        </div>
                        @php
                            $bulan = array(
                            [
                                "id" => "1",
                                "bulan" => "Januari"
                            ],
                            [
                                "id" => "2",
                                "bulan" => "Februari"
                            ],
                            [
                                "id" => "3",
                                "bulan" => "Maret"
                            ],
                            [
                                "id" => "4",
                                "bulan" => "April"
                            ],
                            [
                                "id" => "5",
                                "bulan" => "Mei"
                            ],
                            [
                                "id" => "6",
                                "bulan" => "Juni"
                            ],
                            [
                                "id" => "7",
                                "bulan" => "Juli"
                            ],
                            [
                                "id" => "8",
                                "bulan" => "Agustus"
                            ],
                            [
                                "id" => "9",
                                "bulan" => "September"
                            ],
                            [
                                "id" => "10",
                                "bulan" => "Oktober"
                            ],
                            [
                                "id" => "11",
                                "bulan" => "November"
                            ],
                            [
                                "id" => "12",
                                "bulan" => "Desember"
                            ]);
                        @endphp
                        <div class="col mb-4">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror selectpicker" data-live-search="true">
                                <option value="">Pilih Bulan</option>
                                @foreach ($bulan as $bu)
                                    @if(old('bulan', $data->bulan) == $bu['id'])
                                        <option value="{{ $bu['id'] }}" selected>{{ $bu['bulan'] }}</option>
                                    @else
                                        <option value="{{ $bu['id'] }}">{{ $bu['bulan'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('bulan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $last = date('Y')-10;
                            $now = date('Y');
                        @endphp
                        <div class="col mb-4">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror selectpicker" data-live-search="true">
                                <option value="">Pilih Tahun</option>
                                @for ($i = $now; $i >= $last; $i--)
                                    @if(old('tahun', $data->tahun) == $i)
                                        <option value="{{ $i }}" selected>{{ $i }}</option>
                                    @else
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                            @error('tahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="persentase_kehadiran">Persentase Kehadiran</label>
                            <input type="text" class="form-control @error('persentase_kehadiran') is-invalid @enderror" id="persentase_kehadiran" name="persentase_kehadiran" value="{{ old('persentase_kehadiran', $data->persentase_kehadiran) }}" readonly>
                            @error('persentase_kehadiran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan', $data->user->Jabatan->nama_jabatan ?? '') }}" readonly>
                            @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="no_gaji">Nomor Gaji</label>
                            <input type="text" class="form-control @error('no_gaji') is-invalid @enderror" id="no_gaji" name="no_gaji" value="{{ old('no_gaji', $data->no_gaji) }}" readonly>
                            @error('no_gaji')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="text" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $data->tanggal_mulai) }}" readonly>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="text" class="form-control @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir', $data->tanggal_akhir) }}" readonly>
                            @error('tanggal_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4">
                            <label for="gaji_pokok">Gaji Pokok</label>
                            <input type="text" class="form-control money @error('gaji_pokok') is-invalid @enderror" id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok', $data->gaji_pokok) }}">
                            @error('gaji_pokok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="uang_transport">Uang Transport</label>
                            <input type="text" class="form-control money @error('uang_transport') is-invalid @enderror" id="uang_transport" name="uang_transport" value="{{ old('uang_transport', $data->uang_transport) }}">
                            @error('uang_transport')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4">
                            <div class="card p-4">
                                <label for="total_reimbursement">Reimbursement</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('total_reimbursement') is-invalid @enderror" name="total_reimbursement" value="{{ old('total_reimbursement', $data->total_reimbursement) }}" id="total_reimbursement" style="background-color: orange">
                                    <div class="input-group-text">
                                        <span>Total Reimbursement</span>
                                    </div>
                                    @error('total_reimbursement')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="card p-4">
                                <label for="jumlah_mangkir">Mangkir</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('jumlah_mangkir') is-invalid @enderror" name="jumlah_mangkir" value="{{ old('jumlah_mangkir', $data->jumlah_mangkir) }}" id="jumlah_mangkir" style="background-color: orange">
                                    <div class="input-group-text">
                                        <span>/ Kali</span>
                                    </div>
                                    @error('jumlah_mangkir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('uang_mangkir') is-invalid @enderror" id="uang_mangkir" name="uang_mangkir" value="{{ old('uang_mangkir', $data->uang_mangkir) }}">
                                    <div class="input-group-text">
                                        <span>Uang Mangkir</span>
                                    </div>
                                    @error('uang_mangkir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="total_mangkir" id="total_mangkir" value="{{ old('total_mangkir', $data->total_mangkir) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col mb-4">
                            <div class="card p-4">
                                <label for="jumlah_lembur">Lembur</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('jumlah_lembur') is-invalid @enderror" name="jumlah_lembur" value="{{ old('jumlah_lembur', $data->jumlah_lembur) }}" id="jumlah_lembur" style="background-color: orange">
                                    <div class="input-group-text">
                                        <span>/ Jam</span>
                                    </div>
                                    @error('jumlah_lembur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('uang_lembur') is-invalid @enderror" id="uang_lembur" name="uang_lembur" value="{{ old('uang_lembur', $data->uang_lembur) }}">
                                    <div class="input-group-text">
                                        <span>Uang Lembur</span>
                                    </div>
                                    @error('uang_lembur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="total_lembur" id="total_lembur" value="{{ old('total_lembur', $data->total_lembur) }}">
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="card p-4">
                                <label for="jumlah_izin">Izin Masuk</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('jumlah_izin') is-invalid @enderror" name="jumlah_izin" value="{{ old('jumlah_izin', $data->jumlah_izin) }}" id="jumlah_izin" style="background-color: orange">
                                    <div class="input-group-text">
                                        <span>/ Kali</span>
                                    </div>
                                    @error('jumlah_izin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('uang_izin') is-invalid @enderror" id="uang_izin" name="uang_izin" value="{{ old('uang_izin', $data->uang_izin) }}">
                                    <div class="input-group-text">
                                        <span>Uang Izin</span>
                                    </div>
                                    @error('izin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="total_izin" id="total_izin" value="{{ old('total_izin', $data->total_izin) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col mb-4">
                            <div class="card p-4">
                                <label for="jumlah_bonus">Bonus</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('jumlah_bonus') is-invalid @enderror" name="jumlah_bonus" value="{{ old('jumlah_bonus', $data->jumlah_bonus) }}" id="jumlah_bonus" style="background-color: orange">
                                    <div class="input-group-text">
                                        <span>/ Kali</span>
                                    </div>
                                    @error('jumlah_bonus')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('uang_bonus') is-invalid @enderror" id="uang_bonus" name="uang_bonus" value="{{ old('uang_bonus', $data->uang_bonus) }}">
                                    <div class="input-group-text">
                                        <span>Uang Bonus</span>
                                    </div>
                                    @error('uang_bonus')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="total_bonus" id="total_bonus" value="{{ old('total_bonus', $data->total_bonus) }}">
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="card p-4">
                                <label for="jumlah_terlambat">Terlambat</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('jumlah_terlambat') is-invalid @enderror" name="jumlah_terlambat" value="{{ old('jumlah_terlambat', $data->jumlah_terlambat) }}" id="jumlah_terlambat" style="background-color: orange">
                                    <div class="input-group-text">
                                        <span>/ Kali</span>
                                    </div>
                                    @error('jumlah_terlambat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('uang_terlambat') is-invalid @enderror" id="uang_terlambat" name="uang_terlambat" value="{{ old('uang_terlambat', $data->uang_terlambat) }}">
                                    <div class="input-group-text">
                                        <span>Uang Terlambat</span>
                                    </div>
                                    @error('uang_terlambat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="total_terlambat" id="total_terlambat" value="{{ old('total_terlambat', $data->total_terlambat) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col mb-4">
                            <div class="card p-4">
                                <label for="jumlah_kehadiran">100% Kehadiran</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('jumlah_kehadiran') is-invalid @enderror" name="jumlah_kehadiran" value="{{ old('jumlah_kehadiran', $data->jumlah_kehadiran) }}" id="jumlah_kehadiran" style="background-color: orange">
                                    <div class="input-group-text">
                                        <span>/ Kali</span>
                                    </div>
                                    @error('jumlah_kehadiran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('uang_kehadiran') is-invalid @enderror" id="uang_kehadiran" name="uang_kehadiran" value="{{ old('uang_kehadiran', $data->uang_kehadiran) }}">
                                    <div class="input-group-text">
                                        <span>Uang 100% Kehadiran</span>
                                    </div>
                                    @error('uang_kehadiran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="total_kehadiran" id="total_kehadiran" value="{{ old('total_kehadiran', $data->total_kehadiran) }}">
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="card p-4">
                                <label for="saldo_kasbon">Kasbon</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('saldo_kasbon') is-invalid @enderror" name="saldo_kasbon" value="{{ old('saldo_kasbon', $data->saldo_kasbon) }}" id="saldo_kasbon" style="background-color: orange" readonly>
                                    <div class="input-group-text">
                                        <span>Total Kasbon</span>
                                    </div>
                                    @error('saldo_kasbon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('bayar_kasbon') is-invalid @enderror" id="bayar_kasbon" name="bayar_kasbon" value="{{ old('bayar_kasbon', $data->bayar_kasbon) }}">
                                    <div class="input-group-text">
                                        <span>Bayar Kasbon</span>
                                    </div>
                                    @error('bayar_kasbon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col mb-4">
                            <div class="card p-4">
                                <label for="jumlah_thr">Tunjangan Hari Raya</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('jumlah_thr') is-invalid @enderror" name="jumlah_thr" value="{{ old('jumlah_thr', $data->jumlah_thr) }}" id="jumlah_thr" style="background-color: orange">
                                    <div class="input-group-text">
                                        <span>/ Kali</span>
                                    </div>
                                    @error('jumlah_thr')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money @error('uang_thr') is-invalid @enderror" id="uang_thr" name="uang_thr" value="{{ old('uang_thr', $data->uang_thr) }}">
                                    <div class="input-group-text">
                                        <span>Uang THR</span>
                                    </div>
                                    @error('uang_thr')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="total_thr" id="total_thr" value="{{ old('total_thr', $data->total_thr) }}">
                            </div>
                        </div>
                        <div class="col mb-4">
                            <label for="loss">Loss</label>
                            <input type="text" class="form-control money @error('loss') is-invalid @enderror" id="loss" name="loss" value="{{ old('loss', $data->loss) }}">
                            @error('loss')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <button class="btn form-control btn-secondary mt-3 mb-3" id="proses">Proses</button>
                            <button type="submit" class="btn form-control btn-primary mt-3 mb-3" id="submit" disabled>Simpan</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4">
                            <div class="card p-4">
                                <center>
                                    <label style="color:green">TOTAL PENJUMLAHAN</label>
                                    <input type="text" class="form-control border-white text-center money @error('total_penjumlahan') is-invalid @enderror" id="total_penjumlahan" name="total_penjumlahan" value="{{ old('total_penjumlahan', $data->total_penjumlahan) }}" readonly style="background-color: white; color:black">
                                </center>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="card p-4">
                                <center>
                                    <label style="color:red">TOTAL PENGURANGAN</label>
                                    <input type="text" class="form-control border-white text-center money @error('total_pengurangan') is-invalid @enderror" id="total_pengurangan" name="total_pengurangan" value="{{ old('total_pengurangan', $data->total_pengurangan) }}" readonly style="background-color: white; color:black">
                                </center>
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="col">
                            <div class="card p-4">
                                <label style="color:blue">GRAND TOTAL</label>
                                <input type="text" class="form-control border-white text-center money @error('grand_total') is-invalid @enderror" id="grand_total" name="grand_total" value="{{ old('grand_total', $data->grand_total) }}" readonly style="background-color: white; color:black">
                            </div>
                        </div>
                    </center>
                  </form>
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            function replaceCurrency(n) {
                if (n) {
                    return n.replace(/\,/g, '');
                }
            }
        </script>
        <script>
            $(document).ready(function(){
                $('.money').mask('000,000,000,000,000', {
                    reverse: true
                });

                $("#proses").click(function(e) {
                    e.preventDefault();

                    //Penambahan Gaji
                    var gaji_pokok = $('#gaji_pokok').val() ? parseFloat(replaceCurrency($('#gaji_pokok').val())) : 0;
                    var total_reimbursement = $('#total_reimbursement').val() ? parseFloat(replaceCurrency($('#total_reimbursement').val())) : 0;
                    var uang_transport = $('#uang_transport').val() ? parseFloat(replaceCurrency($('#uang_transport').val())) : 0;

                    var jumlah_lembur = $('#jumlah_lembur').val() ? parseFloat($('#jumlah_lembur').val()) : 0;
                    var uang_lembur = $('#uang_lembur').val() ? parseFloat(replaceCurrency($('#uang_lembur').val())) : 0;
                    var total_lembur = jumlah_lembur * uang_lembur;
                    $('#total_lembur').val(accounting.formatMoney(total_lembur, '', 0, ",", "."));

                    var jumlah_bonus = $('#jumlah_bonus').val() ? parseFloat($('#jumlah_bonus').val()) : 0;
                    var uang_bonus = $('#uang_bonus').val() ? parseFloat(replaceCurrency($('#uang_bonus').val())) : 0;
                    var total_bonus = jumlah_bonus * uang_bonus;
                    $('#total_bonus').val(accounting.formatMoney(total_bonus, '', 0, ",", "."));

                    var jumlah_kehadiran = $('#jumlah_kehadiran').val() ? parseFloat($('#jumlah_kehadiran').val()) : 0;
                    var uang_kehadiran = $('#uang_kehadiran').val() ? parseFloat(replaceCurrency($('#uang_kehadiran').val())) : 0;
                    var total_kehadiran = jumlah_kehadiran * uang_kehadiran;
                    $('#total_kehadiran').val(accounting.formatMoney(total_kehadiran, '', 0, ",", "."));

                    var jumlah_thr = $('#jumlah_thr').val() ? parseFloat($('#jumlah_thr').val()) : 0;
                    var uang_thr = $('#uang_thr').val() ? parseFloat(replaceCurrency($('#uang_thr').val())) : 0;
                    var total_thr = jumlah_thr * uang_thr;
                    $('#total_thr').val(accounting.formatMoney(total_thr, '', 0, ",", "."));

                    var total_penjumlahan = gaji_pokok + total_reimbursement + uang_transport + total_lembur + total_bonus + total_kehadiran + total_thr;

                    $('#total_penjumlahan').val(accounting.formatMoney(total_penjumlahan, '', 0, ",", "."));

                    //Pengurangan Gaji
                    var jumlah_mangkir = $('#jumlah_mangkir').val() ? parseFloat($('#jumlah_mangkir').val()) : 0;
                    var uang_mangkir = $('#uang_mangkir').val() ? parseFloat(replaceCurrency($('#uang_mangkir').val())) : 0;
                    var total_mangkir = jumlah_mangkir * uang_mangkir;
                    $('#total_mangkir').val(accounting.formatMoney(total_mangkir, '', 0, ",", "."));

                    var jumlah_izin = $('#jumlah_izin').val() ? parseFloat($('#jumlah_izin').val()) : 0;
                    var uang_izin = $('#uang_izin').val() ? parseFloat(replaceCurrency($('#uang_izin').val())) : 0;
                    var total_izin = jumlah_izin * uang_izin;
                    $('#total_izin').val(accounting.formatMoney(total_izin, '', 0, ",", "."));

                    var jumlah_terlambat = $('#jumlah_terlambat').val() ? parseFloat($('#jumlah_terlambat').val()) : 0;
                    var uang_terlambat = $('#uang_terlambat').val() ? parseFloat(replaceCurrency($('#uang_terlambat').val())) : 0;
                    var total_terlambat = jumlah_terlambat * uang_terlambat;
                    $('#total_terlambat').val(accounting.formatMoney(total_terlambat, '', 0, ",", "."));

                    var bayar_kasbon = $('#bayar_kasbon').val() ? parseFloat(replaceCurrency($('#bayar_kasbon').val())) : 0;
                    var loss = $('#loss').val() ? parseFloat(replaceCurrency($('#loss').val())) : 0;

                    var total_pengurangan = total_mangkir + total_izin + total_terlambat + bayar_kasbon + loss;

                    $('#total_pengurangan').val(accounting.formatMoney(total_pengurangan, '', 0, ",", "."));

                    $("#submit").prop('disabled', false);

                    var grand_total = total_penjumlahan - total_pengurangan;
                    $('#grand_total').val(accounting.formatMoney(grand_total, '', 0, ",", "."));
                    Swal.fire('Berhasil Proses Data, Klik Simpan Untuk Melanjutkan', '', 'success');
                    setTimeout(function() {
                        Swal.close();
                    }, 2000);
                });
            });
        </script>
    @endpush
@endsection
