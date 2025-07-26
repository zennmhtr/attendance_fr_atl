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
                        <a href="{{ url('/data-cuti') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <form method="post" action="{{ url('/data-cuti/proses-tambah') }}" enctype="multipart/form-data" class="p-4">
                    @csrf
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="user_id_ajax">Nama Karyawan</label>
                            <select id="user_id_ajax" name="user_id" class="form-control selectpicker" id="">
                                <option value="">Pilih Karyawan </option>
                                @foreach ($data_user as $du)
                                    @if(old('user_id') == $du->id)
                                        <option value="{{ $du->id }}" selected>{{ $du->name }}</option>
                                    @else
                                        <option value="{{ $du->id }}">{{ $du->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-4">
                            <label for="nama_cuti_ajax">Nama Cuti / Izin</label>
                            <select name="nama_cuti" id="nama_cuti_ajax" class="form-control">
                                <option value="">Pilih Cuti</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="datetime" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                            @error('tanggal_mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="datetime" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                            @error('tanggal_akhir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="tanggal">
                    </div>
                    <div class="form-row">
                        <div class="col mb-4">
                            <label for="foto_cuti">Unggah Foto</label>
                            <input type="file" name="foto_cuti" id="foto_cuti" class="form-control @error('foto_cuti') is-invalid @enderror">
                            @error('foto_cuti')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col mb-4">
                            <label for="alasan_cuti">Alasan Cuti / Izin</label>
                            <input type="text" class="form-control @error('alasan_cuti') is-invalid @enderror" id="alasan_cuti" name="alasan_cuti" value="{{ old('alasan_cuti') }}">
                            @error('alasan_cuti')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="status_cuti">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $('#nama_cuti_ajax').select2();
            $(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            })

            $(function(){
                $('#user_id_ajax').on('change', function(){
                    let user_id = $('#user_id_ajax').val();

                    $.ajax({
                        type : 'POST',
                        url : "{{ url('/data-cuti/getuserid') }}",
                        data :  {id:user_id},
                        cache : false,
                        success: function(msg){
                            $('#nama_cuti_ajax').select2('destroy');
                            $('#nama_cuti_ajax').html(msg);
                            $('#nama_cuti_ajax').select2();
                        },
                        error: function(data){
                            console.log('error:' ,data);
                        }
                    })
                })
            })
        </script>
    @endpush
@endsection
