@extends('layouts.dashboard')
@section('isi')
    <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="mt-4 p-4">
                <form method="post" action="{{ url('/payroll/tambah-proses') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <label for="user_id">Pegawai</label>
                            <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true">
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
                        <div class="col">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control selectpicker" data-live-search="true">
                                <option value="">Pilih Bulan</option>
                                @foreach ($bulan as $bu)
                                    @if(old('bulan') == $bu['id'])
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
                    <br>
                    <div class="form-row">
                        @php
                            $last = date('Y')-10;
                            $now = date('Y');
                        @endphp
                        <div class="col">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control selectpicker" data-live-search="true">
                                <option value="">Pilih Tahun</option>
                                @for ($i = $now; $i >= $last; $i--)
                                    @if(old('tahun') == $i)
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
                        <div class="col">
                            <label for="gaji">Gaji</label>
                            <input type="text" class="form-control money @error('gaji') is-invalid @enderror" id="gaji" name="gaji" value="{{ old('gaji') }}">
                            @error('gaji')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="status_id">Status</label>
                            <select name="status_id" id="status_id" class="form-control selectpicker" data-live-search="true">
                                <option value="">Pilih Status</option>
                                @foreach ($data_status as $ds)
                                    @if(old('status_id') == $ds->id)
                                        <option value="{{ $ds->id }}" selected>{{ $ds->name }}</option>
                                    @else
                                        <option value="{{ $ds->id }}">{{ $ds->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('status_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="setoran_bpjs_kes">Setoran BPJS Kesehatan</label>
                            <input type="text" class="form-control money @error('setoran_bpjs_kes') is-invalid @enderror" id="setoran_bpjs_kes" name="setoran_bpjs_kes" value="{{ old('setoran_bpjs_kes') }}">
                            @error('setoran_bpjs_kes')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="tunjangan_bpjs_kes">Tunjangan BPJS Kesehatan</label>
                            <input type="text" class="form-control money @error('tunjangan_bpjs_kes') is-invalid @enderror" id="tunjangan_bpjs_kes" name="tunjangan_bpjs_kes" value="{{ old('tunjangan_bpjs_kes') }}">
                            @error('tunjangan_bpjs_kes')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="setoran_bpjs_tk">Setoran BPJS Ketengakerjaan</label>
                            <input type="text" class="form-control money @error('setoran_bpjs_tk') is-invalid @enderror" id="setoran_bpjs_tk" name="setoran_bpjs_tk" value="{{ old('setoran_bpjs_tk') }}">
                            @error('setoran_bpjs_tk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="tunjangan_bpjs_tk">Tunjangan BPJS Ketengakerjaan</label>
                            <input type="text" class="form-control money @error('tunjangan_bpjs_tk') is-invalid @enderror" id="tunjangan_bpjs_tk" name="tunjangan_bpjs_tk" value="{{ old('tunjangan_bpjs_tk') }}">
                            @error('tunjangan_bpjs_tk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="tunjangan_pensiun">Tunjangan Pensiun</label>
                            <input type="text" class="form-control money @error('tunjangan_pensiun') is-invalid @enderror" id="tunjangan_pensiun" name="tunjangan_pensiun" value="{{ old('tunjangan_pensiun') }}">
                            @error('tunjangan_pensiun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="tunjangan_komunikasi">Tunjangan Komunikasi</label>
                            <input type="text" class="form-control money @error('tunjangan_komunikasi') is-invalid @enderror" id="tunjangan_komunikasi" name="tunjangan_komunikasi" value="{{ old('tunjangan_komunikasi') }}">
                            @error('tunjangan_komunikasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="tunjangan_pph_21">Tunjangan PPH 21</label>
                            <input type="text" class="form-control money @error('tunjangan_pph_21') is-invalid @enderror" id="tunjangan_pph_21" name="tunjangan_pph_21" value="{{ old('tunjangan_pph_21') }}">
                            @error('tunjangan_pph_21')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="pot_lainnya">Potongan Lainnya</label>
                            <input type="text" class="form-control money @error('pot_lainnya') is-invalid @enderror" id="pot_lainnya" name="pot_lainnya" value="{{ old('pot_lainnya') }}">
                            @error('pot_lainnya')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="lembur">Lembur</label>
                            <input type="text" class="form-control money @error('lembur') is-invalid @enderror" id="lembur" name="lembur" value="{{ old('lembur') }}">
                            @error('lembur')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                  </form>
                  <br>
            </div>
        </div>
    </div>
    <br>
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.money').mask('000,000,000,000,000.00', {
                    reverse: true
                });
            });
        </script>
    @endpush
@endsection
