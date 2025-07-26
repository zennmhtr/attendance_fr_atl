@extends('templates.dashboard')
@section('isi')
  <div class="row">
    <div class="col-xl-12">
      <div class="items-slider">
        <div class="col-xl-2 col-lg-4 col-sm-4 des-xsm-50 box-col-33">
          <div class="card investment-sec">
            <div class="animated-bg"><i></i><i></i><i></i></div>
            <div class="card-body">
              <div class="icon"><i data-feather="users"></i></div>
              <p>Jumlah Karyawan</p>
              <h3>{{ $jumlah_user }}</h3>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-sm-4 des-xsm-50 box-col-33">
          <div class="card investment-sec">
            <div class="animated-bg"><i></i><i></i><i></i></div>
            <div class="card-body">
              <div class="icon"><i data-feather="log-in"></i></div>
              <p>Masuk</p>
              <h3>{{ $jumlah_masuk + $jumlah_izin_telat + $jumlah_izin_pulang_cepat  }}</h3>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-sm-4 des-xsm-50 box-col-33">
          <div class="card investment-sec">
            <div class="animated-bg"><i></i><i></i><i></i></div>
            <div class="card-body">
              <div class="icon"><i data-feather="user-x"></i></div>
              <p>Alfa</p>
              <h3>{{ ($jumlah_user - ($jumlah_masuk + $jumlah_izin_telat + $jumlah_izin_pulang_cepat + $jumlah_libur + $jumlah_cuti + $jumlah_izin_masuk)) }}</h3>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-sm-4 des-xsm-50 box-col-33">
          <div class="card investment-sec">
            <div class="animated-bg"><i></i><i></i><i></i></div>
            <div class="card-body">
              <div class="icon"><i data-feather="log-out"></i></div>
              <p>Libur</p>
              <h3>{{ $jumlah_libur }}</h3>
            </div>
          </div>
        </div> 
        <div class="col-xl-2 col-lg-4 col-sm-4 des-xsm-50 box-col-33">
          <div class="card investment-sec">
            <div class="animated-bg"><i></i><i></i><i></i></div>
            <div class="card-body">
              <div class="icon"><i data-feather="user-minus"></i></div>
              <p>Izin</p>
              <h3>{{ $jumlah_cuti }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 container-fluid calendar-basic">
      <div class="card">
        <div class="card-body">
          <div class="row" id="wrap">
            <div class="col-xxl-12 col-xl-12 box-col-70">
              <div id="external-events mb-4">
                <div id="external-events-list">
                </div>
              </div>
              <div class="calendar-default" id="calendar-container">
                <div id="calendar"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('script')
      <script>
        document.addEventListener("DOMContentLoaded", function () {
            var date = new Date();
            var d    = date.getDate();
            m    = date.getMonth();
            y    = date.getFullYear();
            
            var containerEl = document.getElementById("external-events-list");
            new FullCalendar.Draggable(containerEl, {
                itemSelector: ".fc-event",
                eventData: function (eventEl) {
                    return {
                        title: eventEl.innerText.trim(),
                    };
                },
            });

            var calendarEl = document.getElementById("calendar");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
                },
                initialView: "dayGridMonth",
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                selectable: true,
                nowIndicator: true,
                // dayMaxEvents: true, // allow "more" link when too many events
                events: [
                  @php
                    $tahun_skrg = date('Y');
                    $bulan_skrg = date('m');
                    $jmlh_bulan = cal_days_in_month(CAL_GREGORIAN,$bulan_skrg,$tahun_skrg);
                    $tgl_mulai = date('1945-01-01');
                    $tgl_akhir = date('Y-m-'.$jmlh_bulan);
                    $data_user = App\Models\User::select('name', 'tgl_lahir')->whereBetween('tgl_lahir', [$tgl_mulai, $tgl_akhir])->get();
                  @endphp
                  @foreach($data_user as $du)
                    @php
                      $pecah = explode("-", $du->tgl_lahir)
                    @endphp
                    {
                      title          : 'Ulang Tahun: {{ $du->name }}',
                      start          : new Date(y, {{ $pecah[1]-1 }}, {{ $pecah[2] }}),
                      allDay         : true
                    },
                  @endforeach
                  @php
                    $data_cuti = App\Models\Cuti::select('user_id', 'tanggal')->where('status_cuti', 'Diterima')->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])->get();
                  @endphp
                  @foreach($data_cuti as $dc)
                    @php
                      $pecah2 = explode("-", $dc->tanggal)
                    @endphp
                    {
                      title          : 'Izin: {{ $dc->User->name }}',
                      start          : new Date({{ $pecah2[0] }}, {{ $pecah2[1]-1 }}, {{ $pecah2[2] }}),
                      allDay         : true
                    },
                  @endforeach
                ],
                editable: true,
                droppable: true, 
                drop: function (arg) {
                    if (document.getElementById("drop-remove").checked) {
                        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                    }
                },
            });
            calendar.render();
        });

      </script>
  @endpush
@endsection
