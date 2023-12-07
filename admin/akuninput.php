<?php
$pageTitle = "Petugas";
include '../assets/layouts/sidebar.php';
$hasil = "SELECT * FROM tbl_akun ";

$tampil = mysqli_query($db, $hasil);

?>

<body class="g-sidenav-show bg-gray-200">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 ">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Data Petugas</h6>
              </div>
              <br>
              <a href="akunaksi.php?aksi=tambah" class="btn btn-primary">Tambah Akun</a>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">

                <table class="table align-items-center table-bordered">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-center text-s ">Nama Lengkap</th>
                      <th class="text-uppercase text-center text-s ">Username</th>
                      <th class="text-uppercase text-center text-s ">Role</th>
                      <th class="text-uppercase text-center text-s ">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($d = $tampil->fetch_array()) {
                    ?>
                      <tr>
                        <td class="text-uppercase text-center text-s "><?php echo $d['nama_lengkap'] ?></td>
                        <td class="text-uppercase text-center text-s "><?php echo $d['username'] ?></td>
                        <td class="text-center">
                          <?php
                          if ($d['level'] == 0) {
                            echo "Admin";
                          } elseif ($d['level'] == 1) {
                            echo "Petugas Lapangan";
                          } else {
                            echo $d['level'];
                          }
                          ?>
                        </td>
                        <td class="text-center">
                          <a href="akunaksi.php?kode=<?php echo $d['kd_akun'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                          <a href="javascript:void(0);" class="btn btn-danger" onclick="hapusData('<?php echo $d['kd_akun']; ?>')">Hapus</a>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1" />
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)" />
          </div>
        </div>
        <hr class="horizontal dark my-3" />
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)" />
          </div>
        </div>
      </div>
    </div>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
      var win = navigator.platform.indexOf("Win") > -1;
      if (win && document.querySelector("#sidenav-scrollbar")) {
        var options = {
          damping: "0.5",
        };
        Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
      }

      function hapusData(akun) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
          window.location.href = 'akunproses.php?kode=' + akun + '&proses=proseshapus';
        }
      }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
    <?php
    include '../assets/layouts/footer.php'
    ?>
</body>