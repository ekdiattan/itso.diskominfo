
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->  
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="m-auto">
            <a href="/dashboard" class="navbar-brand">
              <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 35px; width: 143px;">
            </a>
          </div>
        </div>  

        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="/dashboard" class="nav-link {{ ($title === 'Dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
          @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="IT")
            <li class="nav-item {{ ($title === 'Catatan IT') ? 'menu-is-opening menu-open' : '' }} ">
              <a class="nav-link {{ ($title === 'Catatan IT') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Tim IT</p>
                  <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/laporan/" class="nav-link {{ ($title === 'Catatan IT') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-desktop ml-3"></i>
                      <p>Catatan IT</p>
                    </a>
                  </li>
              </ul>
            </li>
            @endif

            @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Aset")
              <li class="nav-item {{ ($title === 'Inventaris' || $title === 'Booking') ? 'menu-is-opening menu-open' : '' }}">
                <a class="nav-link {{ ($title === 'Inventaris' || $title === 'Booking') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Tim Aset</p>
                    <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/fiturmaintenance/" class="nav-link {{ ($title === 'Inventaris') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-chart-pie ml-3"></i>
                      <p>Inventaris</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/booking/" class="nav-link {{ ($title === 'Booking') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-bookmark ml-3"></i>
                      <p>Peminjaman</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif

          @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Kepegawaian")
            <li class="nav-item {{ ($title === 'Kehadiran' || $title === 'Cuti' || $title === 'Jumlah Cuti' || $title === 'Belum Absen Masuk' || $title === 'Belum Absen Pulang' || $title === 'Data Terlambat Harian' || $title === 'Rekapitulasi Masuk Pegawai' || $title === 'Pegawai' || $title === 'Rekapitulasi Terlambat Masuk Unit' || $title === 'Rekapitulasi Tidak Absen Pulang Pegawai' || $title === 'Pegawai Tidak Aktif') ? 'menu-is-opening menu-open' : '' }}">
              <a class="nav-link {{ ($title === 'Kehadiran' || $title === 'Cuti' || $title === 'Jumlah Cuti' || $title === 'Belum Absen Masuk' || $title === 'Belum Absen Pulang' || $title === 'Data Terlambat Harian' || $title === 'Rekapitulasi Masuk Pegawai' || $title === 'Pegawai' || $title === 'Rekapitulasi Terlambat Masuk Unit' || $title === 'Rekapitulasi Tidak Absen Pulang Pegawai' || $title === 'Pegawai Tidak Aktif') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Tim Kepegawaian
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/kepegawaian/kehadiran" class="nav-link {{ ($title === 'Kehadiran') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clipboard ml-3"></i>
                    <p>Data Kehadiran</p>
                  </a>
                </li>
                <li class="nav-item {{ ($title === 'Cuti') || ($title === 'Jumlah Cuti') ? 'menu-is-opening menu-open' : '' }}">
                  <a class="nav-link {{ ($title === 'Cuti') || ($title === 'Jumlah Cuti') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users ml-3"></i>
                    <p>Cuti
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/cuti" class="nav-link {{ ($title === 'Cuti') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database ml-5"></i>
                        <p>Data Cuti</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/jumlah-cuti" class="nav-link {{ ($title === 'Jumlah Cuti') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-equals ml-5"></i>
                        <p>Jumlah Cuti</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="/store-masuk" class="nav-link {{ ($title === 'Belum Absen Masuk') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clock ml-3"></i>
                    <p>Belum Absen Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/store-pulang" class="nav-link {{ ($title === 'Belum Absen Pulang') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clock ml-3"></i>
                    <p>Belum Absen Pulang</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/terlambat-harian" class="nav-link {{ ($title === 'Data Terlambat Harian') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-exclamation ml-3"></i>
                    <p style="font-size:15px;">Data Terlambat Harian</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/rekap/terlambat-masuk" class="nav-link {{ ($title === 'Rekapitulasi Masuk Pegawai' || $title === 'Rekapitulasi Terlambat Masuk Unit' || $title === 'Rekapitulasi Tidak Absen Pulang Pegawai') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file  ml-3"></i>
                    <p>Rekapitulasi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/master-pegawai" class="nav-link {{ ($title === 'Pegawai') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-address-book  ml-3"></i>
                    <p>Master Pegawai</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/nonaktif" class="nav-link {{ ($title === 'Pegawai Tidak Aktif') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-slash  ml-3"></i>
                    <p>Pegawai Tidak Aktif</p>
                  </a>
                </li>
            </ul>

          @endif
          @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Keamanan")
            <li class="nav-item {{ ($title === 'Kendaraan') ? 'menu-is-opening menu-open' : '' }}">
                <a class="nav-link {{ ($title === 'Kendaraan') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Tim Keamanan
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/keamanan" class="nav-link {{ ($title === 'Kendaraan') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-car ml-3"></i>
                      <p style="font-size:13px;">Peminjaman Transportasi</p>
                    </a>
                  </li>
                </ul>
            </li>
          @endif
          @if(auth()->user()->hak_akses=="Admin")
            <li class="nav-item">
              <a href="/index" class="nav-link {{ ($title === 'Pengguna') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>Pengguna</p>
              </a>
            </li>
          @endif
          @if(auth()->user()->hak_akses=="Admin" ||  auth()->user()->hak_akses=="Aset")
            <li class="nav-item {{ ($title === 'Aset' || $title === 'Kode Aset' || $title === 'Unit Kerja' || $title === 'Pengecualian Pegawai'|| $title === 'Kategori' || $title === 'Role' || $title === 'Merk' || $title === 'Satuan' || $title === 'Libur Nasional' || $title === 'Mapping Dashboard' || $title === 'Kategori Pendidikan' || $title === 'Kategori Usia') ? 'menu-is-opening menu-open' : '' }}">
              <a class="nav-link {{ ($title === 'Aset' || $title === 'Kode Aset' || $title === 'Unit Kerja' || $title === 'Pengecualian Pegawai'|| $title === 'Kategori' || $title === 'Role' || $title === 'Merk' || $title === 'Satuan' || $title === 'Libur Nasional' || $title === 'Mapping Dashboard' ) ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog "></i>
                <p>
                  Master
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
            @endif
              <ul class="nav nav-treeview">
            @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Aset")
                <li class="nav-item">
                  <a href="/kodeAset" class="nav-link {{ ($title === 'Kode Aset') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book ml-3"></i>
                    <p>Kode Aset</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/aset" class="nav-link {{ ($title === 'Aset') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-weight ml-3"></i>
                    <p>Aset</p>
                  </a>
                </li>
            @endif
            @if(auth()->user()->hak_akses=="Admin")
                <li class="nav-item">
                  <a href="/unitkerja" class="nav-link {{ ($title === 'Unit Kerja') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building ml-3"></i>
                    <p>Unit Kerja</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/kategori" class="nav-link {{ ($title === 'Kategori') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list ml-3"></i>
                    <p>Kategori</p>
                  </a>
                </li>
            @endif
            @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Kepegawaian")
                <li class="nav-item">
                  <a href="/pengecualian" class="nav-link {{ ($title === 'Pengecualian Pegawai') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-ban ml-3"></i>
                    <p>Pengecualian Pegawai</p>
                  </a>
                </li>
            @endif
            @if(auth()->user()->hak_akses=="Admin")
                <li class="nav-item">
                  <a href="/role/" class="nav-link {{ ($title === 'Role') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-hard-hat ml-3"></i>
                    <p>Role</p>
                  </a>
                </li>
            @endif
            @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Aset")
                <li class="nav-item">
                  <a href="/merk/" class="nav-link {{ ($title === 'Merk') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-window-restore ml-3"></i>
                    <p>Merk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/satuan/" class="nav-link {{ ($title === 'Satuan') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-cookie-bite ml-3"></i>
                    <p>Satuan</p>
                  </a>
                </li>
            @endif
            @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Kepegawaian")
                <li class="nav-item">
                  <a href="/libur/" class="nav-link {{ ($title === 'Libur Nasional') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-umbrella-beach ml-3"></i>
                    <p>Liburan</p>
                  </a>
                </li>
            @endif
            @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Kepegawaian")
                <li class="nav-item">
                  <a href="/usia/" class="nav-link {{ ($title === 'Kategori Usia') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-umbrella-beach ml-3"></i>
                    <p>Kategori Usia</p>
                  </a>
                </li>
            @endif
            @if(auth()->user()->hak_akses=="Admin")
                <li class="nav-item">
                  <a href="/mapDashboard/" class="nav-link {{ ($title === 'Mapping Dashboard') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt ml-3"></i>
                    <p>Mapping Dashboard</p>
                  </a>
                </li>
            @endif
            @if(auth()->user()->hak_akses=="Admin" || auth()->user()->hak_akses=="Kepegawaian")
                <li class="nav-item">
                  <a href="/kategori-pendidikan/" class="nav-link {{ ($title === 'Kategori Pendidikan') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-user-graduate ml-3"></i>
                    <p>Kategori Pendidikan</p>
                  </a>
                </li>
            @endif
                </ul>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>