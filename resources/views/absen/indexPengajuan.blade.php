@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="tf-spacing-16"></div>

                <div class="bill-content">
                    <form action="{{ url('/pengajuan-absensi') }}">
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
    <div id="app-wrap">
        <div class="bill-content">
            <div class="tf-container">
                <ul class="mt-3 mb-5">
                    
                    @foreach ($mapping_shift as $ms)
                        @php
                            $tanggal = new DateTime($ms->tanggal);
                        @endphp
                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                            <div class="user-info">
                                @if($ms->User->foto_karyawan == null)
                                    <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                @else
                                    <img src="{{ url('/storage/'.$ms->User->foto_karyawan) }}" alt="image">
                                @endif
                            </div>
                            <div class="content-right">
                                <h4><a href="{{ url('/pengajuan-absensi/edit/'.$ms->id) }}">{{ $ms->User->name }} <span>{{ $ms->status_pengajuan }}</span></a></h4>
                                <p><a style="color: rgb(141, 141, 141)" href="{{ url('/pengajuan-absensi/edit/'.$ms->id) }}">Attendance Request <span>{{ $tanggal->format('d M Y') }}</span></a></p>
                                <p><a style="color: rgb(141, 141, 141)" href="{{ url('/pengajuan-absensi/edit/'.$ms->id) }}">{{ $ms->deskripsi }}</a></p>
                            </div>
                        </li>
                    @endforeach
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $mapping_shift->links() }}
                    </div>
                </ul>

            </div>
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
@endsection