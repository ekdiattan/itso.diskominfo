<Title>Diskominfo Jabar | Light</Title>
<!-- Navbar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="/dashboard"><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="/dashboard"><img src="{{ asset('assets/images/jabar.png') }}" alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="{{ asset('assets/images/faces/face15.jpg') }}" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal" style="font-size:14px;">{{ auth()->user()->nama }}</h5>
            <span>{{ auth()->user()->hak_akses }}</span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="/account/{{ auth()->user()->id }}" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="/account/password/{{ auth()->user()->id }}" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
          </a>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="/dashboard">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="/laporan">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">Catatan IT</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="/inventaris">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">Inventaris</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#kepegawaian" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-account-multiple"></i>
        </span>
        <span class="menu-title">Kepegawaian</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="kepegawaian">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/kepegawaian/kehadiran">Data Kehadiran</a></li>
          <li class="nav-item"> <a class="nav-link" href="/cuti">Data Cuti</a></li>
          <li class="nav-item"> <a class="nav-link" href="/absen-masuk">Belum Absen Masuk</a></li>
          <li class="nav-item"> <a class="nav-link" href="/absen-pulang">Belum Absen Pulang</a></li>
          <li class="nav-item"> <a class="nav-link" href="/terlambat-harian">Data Terlambat Harian</a></li>
          <li class="nav-item"> <a class="nav-link" href="/rekap/terlambat-masuk">Rekapitulasi</a></li>
          <li class="nav-item"> <a class="nav-link" href="/master-pegawai">Master Pegawai</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-brightness-5"></i>
        </span>
        <span class="menu-title">Master</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/bidang">Bidang</a></li>
          <li class="nav-item"> <a class="nav-link" href="/kategori">Ketegori</a></li>
          <li class="nav-item"> <a class="nav-link" href="/role">Role</a></li>
          <li class="nav-item"> <a class="nav-link" href="/merk">Merk</a></li>
          <li class="nav-item"> <a class="nav-link" href="/satuan">Satuan</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="/index">
        <span class="menu-icon">
          <i class="mdi mdi-account"></i>
        </span>
        <span class="menu-title">+ Pengguna</span>
      </a>
    </li>
  </ul>
</nav>
<!-- End Navbar -->