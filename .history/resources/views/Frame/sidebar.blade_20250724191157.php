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
            <a href="#" class="nav-link" onclick="ButtonClickLogOutCustomer(); return false;">
                <i class="nav-icon fas fa-arrow-right-from-bracket" style="color: red;"></i>
                <p>Logout</p>
            </a>
            <div hidden>
                <form action="/logout" id="formLogoutCustomer" method="POST">
                    @csrf
                    <button type="submit" id="LogOutId" class="nav-link btn" style="padding: 0.3rem 0.75rem; background-color: red; color: white; border: none; border-radius: 0.25rem;">
                        Logout
                    </button>
                </form>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on("submit", "#formLogoutCustomer", function (event) {
            event.preventDefault(); // hentikan submit default

            Swal.fire({
                title: 'Peringatan',
                text: 'Yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2600FF',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = $('#formLogoutCustomer');
                    let actionUrl = form.attr("action");
                    let formData = form.serialize(); // ambil _token

                    $.ajax({
                        type: "POST",
                        url: actionUrl,
                        data: formData,
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Logout Berhasil',
                                text: response.message,
                                confirmButtonColor: "#2600FF",
                                timer: 1500
                            }).then(() => {
                                window.location.href = '/loginUser';
                            });
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Logout',
                                text: 'Terjadi kesalahan saat logout.',
                                confirmButtonColor: "#2600FF"
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script>
        function ButtonClickLogOutCustomer(){
            document.getElementById('LogOutId').click();
        }
    </script>