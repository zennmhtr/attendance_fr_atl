@extends('templates.app')
@section('container')
   <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="tf-spacing-16"></div>

                <div class="bill-content">
                    <form action="{{ url('/pegawai') }}">
                        <div class="row">
                            <div class="col-10">
                                <div class="input-field">
                                    <span class="icon-search"></span>
                                    <input required class="search-field value_input" placeholder="Search" name="search" type="text" value="{{ request('search') }}">
                                    <span class="icon-clear"></span>
                                </div>
                            </div>
                            <div class="col-2">

                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tf-spacing-16"></div>
            </div>
        </div>
    </div>
    <div class="transfer-content"></div>
    <div class="repicient-content">
       <div class="tf-container">
        <div class="box-user mt-5 text-center">
            <div class="box-avatar">
                @if($user->foto_karyawan == null)
                    <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                @else
                    <img src="{{ url('/storage/'.$user->foto_karyawan) }}" alt="image">
                @endif
            </div>
            <h3 class="fw_8 mt-3">{{ strtoupper($user->name) }}</h3>
            <p>{{ strtoupper($user->Jabatan->nama_jabatan) ?? '-' }}</p>
  
        </div>
        <ul class="mt-7">
            @php
                $tgl_lahir = new DateTime($user->tgl_lahir);
                $tgl_join = new DateTime($user->tgl_join);
            @endphp
            <li class="list-user-info"><span class="icon-user"></span>{{ $user->username }}</li>
            <li class="list-user-info"><span class="fa fa-user-secret"></span>{{ $user->Jabatan->nama_jabatan ?? '-' }}</li>
            <li class="list-user-info"><span class="fa fa-building"></span>{{ $user->Lokasi->nama_lokasi ?? '-' }}</li>
			<li class="list-user-info"><span class="fa fa-venus-mars"></span>{{ $user->gender }}</li>
			<li class="list-user-info"><span class="fa fa-ring"></span>{{ $user->status_nikah }}</li>
			<li class="list-user-info"><span class="icon-phone"></span><a href="https://wa.me/{{ $user->whatsapp($user->telepon) }}">{{ $user->telepon }}</a></li>
			<li class="list-user-info"><span class="icon-email"></span><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
            <li class="mt-4"><span class="fa fa-baby me-3" style="font-size: 20px; color:black"></span> <span style="color:black; font-size:14px">{{ $tgl_lahir->format('d M Y') }}</span> <span style="font-style: italic; font-size:12px; color:rgb(139, 139, 139); float:right"> Tanggal Lahir</span></li><hr style="color: rgb(204, 204, 204)">
            <li class="mt-2"><span class="fa fa-sign-in-alt me-3" style="font-size: 20px; color:black"></span> <span style="color:black; font-size:14px">{{ $tgl_join->format('d M Y') }}</span> <span style="font-style: italic; font-size:12px; color:rgb(139, 139, 139); float:right"> Tanggal Join</span></li><hr style="color: rgb(204, 204, 204)">
        </ul>
       </div>
     
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection