<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">
  <!-- Brand Logo Light -->
  <a href="index.php" class="logo logo-light">
    <span class="logo-lg">
      <img src="assets/images/logo.png" alt="logo" />
    </span>
    <span class="logo-sm">
      <img src="assets/images/logo-sm.png" alt="small logo" />
    </span>
  </a>

  <!-- Brand Logo Dark -->
  <a href="index.php" class="logo logo-dark">
    <span class="logo-lg">
      <img src="assets/images/logo-dark.png" alt="dark logo" />
    </span>
    <span class="logo-sm">
      <img src="assets/images/logo-sm.png" alt="small logo" />
    </span>
  </a>

  <!-- Sidebar Hover Menu Toggle Button -->
  <div
    class="button-sm-hover"
    data-bs-toggle="tooltip"
    data-bs-placement="right"
    title="Show Full Sidebar"
  >
    <i class="ri-checkbox-blank-circle-line align-middle"></i>
  </div>

  <!-- Full Sidebar Menu Close Button -->
  <div class="button-close-fullsidebar">
    <i class="ri-close-fill align-middle"></i>
  </div>

  <!-- Sidebar -left -->
  <div class="h-100" id="leftside-menu-container" data-simplebar>
    <!-- Leftbar User -->
    <div class="leftbar-user">
      <a href="pages-profile.php">
        <img
          src="assets/images/users/avatar-1.jpg"
          alt="user-image"
          height="42"
          class="rounded-circle shadow-sm"
        />
        <span class="leftbar-user-name mt-2"><?php echo $nama; ?><br><?php echo $email; ?></span>
      </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">
      <li class="side-nav-title">Navigation</li>

      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#"
          aria-expanded="false"
          aria-controls="sidebarDashboards"
          class="side-nav-link"
        >
          <i class="ri-home-4-line"></i>
          <span> Dashboards </span>
        </a>
      </li>

      <li class="side-nav-title">Personal</li>

      <li class="side-nav-item">
        <a href="apps-calendar.php" class="side-nav-link">
          <i class="ri-calendar-event-line"></i>
          <span> Absensi </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a href="apps-chat.php" class="side-nav-link">
          <i class="ri-message-3-line"></i>
          <span> Sistem Kinerja Individu </span>
        </a>
      </li>
		
      <li class="side-nav-item">
        <a href="apps-kanban.php" class="side-nav-link">
          <i class="ri-list-check-3"></i>
          <span> Perjalanan Dinas </span>
        </a>
      </li>
		
		<li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarMaps"
          aria-expanded="false"
          aria-controls="sidebarMaps"
          class="side-nav-link"
        >
          <i class="ri-treasure-map-line"></i>
          <span>Permintaan Pegawai</span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarMaps">
          <ul class="side-nav-second-level">
            <li>
              <a href="form-permintaan-pegawai.php">Pengajuan</a>
            </li>
            <li>
              <a href="history-permintaan-pegawai.php">History</a>
            </li>
          </ul>
        </div>
      </li>
		
      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarEmail"
          aria-expanded="false"
          aria-controls="sidebarEmail"
          class="side-nav-link"
        >
          <i class="ri-mail-line"></i>
          <span> Cuti & Izin </span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarEmail">
          <ul class="side-nav-second-level">
            <li>
              <a href="form-cuti.php">Pengajuan</a>
            </li>
            <li>
              <a href="history-cuti.php">History</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarTasks"
          aria-expanded="false"
          aria-controls="sidebarTasks"
          class="side-nav-link"
        >
          <i class="ri-task-line"></i>
          <span> Tukar Hari Libur </span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarTasks">
          <ul class="side-nav-second-level">
            <li>
              <a href="form-thl.php">Pengajuan</a>
            </li>
            <li>
              <a href="history-thl.php">Approval</a>
            </li>
          </ul>
        </div>
      </li>


      <li class="side-nav-title">Managerial</li>
	  <li class="side-nav-item">
        <a href="form-disos.php" class="side-nav-link">
          <i class="ri-pages-line"></i>
          <span> Disposisi & Sosialisasi </span>
        </a>
      </li>
		
	  <li class="side-nav-item">
        <a href="form-memodinas.php" class="side-nav-link">
          <i class="ri-shield-user-line"></i>
          <span> Memo Dinas </span>
        </a>
      </li>

	  <li class="side-nav-item">
        <a href="form-fpk.php" class="side-nav-link">
          <i class="ri-error-warning-line"></i>
          <span> Permohonan Karyawan</span>
        </a>
      </li>
      <li class="side-nav-title">Benefit</li>

      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarBaseUI"
          aria-expanded="false"
          aria-controls="sidebarBaseUI"
          class="side-nav-link"
        >
          <i class="ri-briefcase-line"></i>
          <span> Santunan Duka </span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarBaseUI">
          <ul class="side-nav-second-level">
            <li>
              <a href="ui-accordions.php">Pengajuan</a>
            </li>
            <li>
              <a href="ui-alerts.php">Approval</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarExtendedUI"
          aria-expanded="false"
          aria-controls="sidebarExtendedUI"
          class="side-nav-link"
        >
          <i class="ri-stack-line"></i>
          <span> Rembesment Asuransi </span>
          <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarExtendedUI">
          <ul class="side-nav-second-level">
            <li>
              <a href="extended-dragula.php">Pengajuan</a>
            </li>
            <li>
              <a href="extended-range-slider.php">Approval</a>
            </li>
          </ul>
        </div>
      </li>
		
	 <li class="side-nav-title">Other</li>

		<li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarIcons"
          aria-expanded="false"
          aria-controls="sidebarIcons"
          class="side-nav-link"
        >
          <i class="ri-service-line"></i>
          <span> Quesioner </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarCharts"
          aria-expanded="false"
          aria-controls="sidebarCharts"
          class="side-nav-link"
        >
          <i class="ri-bar-chart-line"></i>
          <span> Suara Rakyat Gacoan </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarForms"
          aria-expanded="false"
          aria-controls="sidebarForms"
          class="side-nav-link"
        >
          <i class="ri-survey-line"></i>
          <span> Inbox </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a
          data-bs-toggle="collapse"
          href="#sidebarTables"
          aria-expanded="false"
          aria-controls="sidebarTables"
          class="side-nav-link"
        >
          <i class="ri-table-line"></i>
          <span> Profile </span>
        </a>
      </li>

      <li class="side-nav-item">
        <a href="apps-kanban.php" class="side-nav-link">
          <i class="ri-list-check-3"></i>
          <span> Help </span>
        </a>
      </li>
    </ul>
    <!--- End Sidemenu -->

    <div class="clearfix"></div>
  </div>
</div>
<!-- ========== Left Sidebar End ========== -->
