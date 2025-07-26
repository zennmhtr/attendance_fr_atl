<!DOCTYPE html>
<html lang="en">
  <head>
    @php
        $settings = App\Models\settings::first();
    @endphp
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="pixelstrap">
    <link rel="shortcut icon" href="{{ url('/myhr/images/logo.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('/myhr/images/logo.png') }}" />
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ url('/html/assets/css/color-1.css" media="screen') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/select2.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://unpkg.com/leaflet@1.8.0/dist/leaflet.css') }}" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="{{ url('https://unpkg.com/leaflet@1.8.0/dist/leaflet.js') }}" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <link rel="stylesheet" type="text/css" href="{{ url('clock/dist/bootstrap-clockpicker.min.css') }}">
    <style>
        .btn-grey {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }
        .btn-grey:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .btn {
            border-radius: 10px
        }
    </style>

    @stack('style')
  </head>
  
  <body>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="loader-wrapper">
      <div class="loader"></div>
    </div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search In Enzo .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="{{ url('/dashboard') }}"><img class="img-fluid" src="{{ url('/html/assets/images/logo/login.png') }}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>

          <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
              <li>
                <a class="notification-box" href="{{ url('/notifications') }}"><i class="fa fa-bell"></i>
                  @if (auth()->user()->notifications()->whereNull('read_at')->count() > 0)
                    <span class="badge rounded-pill badge-danger">{{ auth()->user()->notifications()->whereNull('read_at')->count() }}</span>
                  @endif
                </a>
              </li>
              <li class="profile-nav onhover-dropdown p-0 me-0">
                <div class="d-flex profile-media">
                  @if (auth()->user()->foto_karyawan)
                      <img class="b-r-50" 
                           src="{{ url('/storage/'.auth()->user()->foto_karyawan) }}" 
                           alt="Foto Karyawan" 
                           style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                  @else
                      <img class="b-r-50" 
                           src="{{ url('/html/assets/images/dashboard/profile.jpg') }}" 
                           alt="Foto Default" 
                           style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                  @endif
                  <div class="flex-grow-1"><span>{{ auth()->user()->name }}</span>
                    <p class="mb-0 font-roboto">{{ auth()->user()->Jabatan->nama_jabatan }} <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="{{ url('/my-profile') }}"><i data-feather="user"></i><span>Account </span></a></li>
                  <li><a href="{{ url('/my-profile/edit-password') }}"><i data-feather="lock"></i><span>Change Password</span></a></li>
                  <li><a href="{{ url('/logout') }}" onclick="return confirm('Are you sure?')"><i data-feather="log-out"> </i><span>Logout</span></a></li>
                </ul>
              </li>
            </ul>
          </div>
          <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"></div>
            </div>
            </div>
          </script>
          <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>
      <div class="page-body-wrapper">
        <div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper"><a href="{{ url('/dashboard') }}"><img class="img-fluid for-light" src="{{ asset('/storage/'.$settings->logo) }}" style="width: 60px" alt=""></a><div style="font-size: 18px; color:white; display:inline">{{ $settings->name }}</div>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="{{ url('/dashboard') }}"><img class="img-fluid" src="{{ url('/html/assets/images/logo/logo-icon1.png') }}" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="{{ url('/dashboard') }}"><img class="img-fluid" src="{{ url('/html/assets/images/logo/logo-icon.png') }}" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="sidebar-main-title">
                    <h6 class="nav-title">Menu Admin</h6>
                  </li>
                  <li class="menu-box">
                    <ul>

                      <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/dashboard') }}"><i data-feather="home"> </i><span>Dashboard</span></a>
                      </li>

                      <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/notifications') }}"><i data-feather="bell"></i>
                          <span>Notifikasi</span>
                          @if (auth()->user()->notifications()->whereNull('read_at')->count() > 0)
                            <span class="badge rounded-pill badge-danger">{{ auth()->user()->notifications()->whereNull('read_at')->count() }}</span>
                          @endif
                        </a>
                      </li>

                      <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/my-profile') }}"><i data-feather="user-check"> </i><span>Profil Admin</span></a>
                      </li>

                      <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/pegawai') }}"><i data-feather="users"> </i><span>Data Karyawan</span></a>
                      </li>

                      <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/jabatan') }}"><i data-feather="user"> </i><span>Data Jabatan</span></a>
                      </li>

                      <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/shift') }}"><i data-feather="clock"> </i><span>Data Jadwal</span></a>
                      </li>

                      <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/rekap-data') }}"><i data-feather="credit-card"> </i><span>Data Rekapitulasi</span></a>
                      </li>

                      <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/lokasi-kantor') }}"><i data-feather="map-pin"> </i><span>Lokasi Kantor</span></a>
                      </li>

                      <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="camera"></i><span>Absensi</span></a>
                        <ul class="sidebar-submenu">
                          <li><a href="{{ url('/absen') }}"><i data-feather="video"></i>Absen </a></li>
                          <li><a href="{{ url('/data-absen') }}"><i data-feather="book"></i>Data Absensi</a></li>
                        </ul>
                      </li>
                      <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ Request::is('settings*') ? 'active' : '' }}" href="{{ url('/settings') }}"><i data-feather="settings"> </i><span>Pengaturan</span></a>
                      </li>

                    </ul>
                  </li>

                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>
        <div class="page-body">
          <div class="container-fluid default-dash">
            @yield('isi')
          </div>
        </div>
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 p-0 footer-left">
                <p class="mb-0">Copyright © 2025 PT. Agung Tirta Lestari. All rights reserved.</p>
              </div>

            </div>
          </div>
        </footer>
      </div>
    </div>

    <script src="{{ url('/html/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ url('/html/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ url('/html/assets/js/scrollbar/custom.js') }}"></script>
    <script src="{{ url('/html/assets/js/config.js') }}"></script>
    <script src="{{ url('/html/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ url('/html/assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ url('/html/assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ url('/html/assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ url('/html/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ url('/html/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ url('/html/assets/js/prism/prism.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ url('/html/assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/dashboard/default.js') }}"></script>
    <script src="{{ url('/html/assets/js/notify/index.js') }}"></script>
    <script src="{{ url('/html/assets/js/slick-slider/slick.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/slick-slider/slick-theme.js') }}"></script>
    <script src="{{ url('/html/assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ url('/html/assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ url('/html/assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ url('/html/assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ url('/html/assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ url('/html/assets/js/script.js') }}"></script>
    <script src="{{ url('/html/assets/js/theme-customizer/customizer.js') }}"></script>
    <script src="{{ url('/html/assets/js/calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/html/assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ url('/html/assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
    <script src="{{ url('accounting.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/clock/dist/bootstrap-clockpicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('/push/bin/push.js') }}"></script>
    <script src="{{ url('/js/app.js') }}"></script>
    <script>
        window.Echo.channel("messages").listen("NotifApproval", (event) => {
            var user_id = {{ auth()->user()->id }};
            if (event.user_id == user_id) {
                if (event.type == "Approved") {
                    Swal.fire({
                        icon: "success",
                        title: "Approved",
                        text: event.notif,
                        footer: "<a href=" + event.url + ">View Application</a>",
                    });
                } else if (event.type == "Approval") {
                    Swal.fire({
                        icon: "info",
                        title: "",
                        text: event.notif,
                        footer: "<a href=" + event.url + ">View Application</a>",
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Rejected",
                        text: event.notif,
                        footer: "<a href=" + event.url + ">View Application</a>",
                    });
                }
                Push.create(event.notif);
            }
        });
    </script>
    <script>
      function getLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
          } else {
              x.innerHTML = "Geolocation is not supported by this browser.";
          }
      }

      function showPosition(position) {
          $('#lat').val(position.coords.latitude);
          $('#lat2').val(position.coords.latitude);
          $('#long').val(position.coords.longitude);
          $('#long2').val(position.coords.longitude);
      }

      setInterval(getLocation, 1000);
    </script>
    <script>
      $(function(){
          $('form').on('submit', function(){
              $(':input[type="submit"]').prop('disabled', true);
          })
      })
      $(function () {
        $('.selectpicker').select2();
        $('#mytable').DataTable( {
            "responsive": true,
            "paging": false,
            "info": false,
            "scrollCollapse": true,
            "autoWidth": false,
            'searching': false
        });
      });
    </script>
    <script>
      config = {
          enableTime: true,
          noCalendar: true,
          dateFormat: "H:i",
          time_24hr: true,
      }

      flatpickr("input[type=datetime-local]", config)
      flatpickr("input[type=datetime]", {})
    </script>
    @stack('script')
    @include('sweetalert::alert')

  
  </body>
</html>
