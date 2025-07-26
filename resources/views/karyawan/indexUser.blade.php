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
    @if (request('search') !== null)
        <div id="app-wrap">
            <div class="bill-content">
                <div class="tf-container">
                    <h3 class="fw_6 d-flex justify-content-between mt-3">{{ $title }}</h3>
                    <ul class="mt-3 mb-5">
                        
                        @foreach ($data_user as $du)
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="user-info">
                                    @if($du->foto_karyawan == null)
                                        <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                    @else
                                        <img src="{{ url('/storage/'.$du->foto_karyawan) }}" alt="image">
                                    @endif
                                </div>
                                <div class="content-right">
                                    <h4><a href="{{ url('/pegawai/show/'.$du->id) }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}">{{ $du->name }} <span class="primary_color">View</span></a></h4>
                                    <p>
                                        {{ $du->Jabatan->nama_jabatan ?? '-' }} <br> <a href="https://wa.me/{{ $du->whatsapp($du->telepon) }}">{{ $du->telepon }}</a>
                                    </p>
                                </div>
                            </li>
                        @endforeach
                        <div class="d-flex justify-content-end me-4 mt-4">
                            {{ $data_user->links() }}
                        </div>
                    </ul>

                </div>
            </div>
        </div>
    @endif
@endsection