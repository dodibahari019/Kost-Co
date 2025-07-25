<!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Kost & Co</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Ahmad Einstein</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        {{-- PENGURUS --}}
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Pengelolaan Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/pengelolaan-penghuni" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Penghuni</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pengelolaan-kamar" class="nav-link">
                  <i class="fas fa-bed nav-icon"></i>
                  <p>Kamar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pengelolaan-sewa-kamar" class="nav-link">
                  <i class="fas fa-money-check nav-icon"></i>
                  <p>Sewa Kamar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pengelolaan-denda" class="nav-link">
                  <i class="fas fa-money-bill-wave nav-icon"></i>
                  <p>Denda</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Pengelolaan Ajuan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/pengelolaan-ajuan-pindah-kamar" class="nav-link">
                  <i class="fas fa-door-closed nav-icon"></i>
                  <p>Pindah Kamar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pengelolaan-ajuan-check-out" class="nav-link">
                  <i class="fas fa-door-open nav-icon"></i>
                  <p>Check Out</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pengelolaan-ajuan-perbaikan" class="nav-link">
                  <i class="fas fa-tools nav-icon"></i>
                  <p>Perbaikan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/laporan" class="nav-link">
                  <i class="fas fa-file-contract nav-icon"></i>
                  <p>Laporan</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- PENGHUNI --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas  fa-building"></i>
              <p>
                Kamar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/list-kamar" class="nav-link">
                  <i class="fas fa-bed nav-icon"></i>
                  <p>List Kamar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Ajuan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-door-closed nav-icon"></i>
                  <p>Ajuan Pindah Kamar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-door-open nav-icon"></i>
                  <p>Ajuan Check Out</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-tools nav-icon"></i>
                  <p>Ajuan Perbaikan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Pembayaran
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/laporan" class="nav-link">
                  <i class="fas fa-usd nav-icon"></i>
                  <p>Sewa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/laporan" class="nav-link">
                  <i class="fas fa-usd nav-icon"></i>
                  <p>Denda</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/log" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->