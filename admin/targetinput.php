<?php
$pageTitle = "Target";
include '../assets/layouts/sidebar.php';

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $level = $_SESSION['level'];

  if (isset($_GET['cari'])) {
    $cari = $db->real_escape_string($_GET['cari']);
    $query = $db->query("SELECT * FROM tbl_akun WHERE nama_lengkap LIKE '%$cari%' ");
  } else {
    $query = $db->query("SELECT * FROM tbl_akun where level='1'");
  }

  $totalData = $query->num_rows;
  $dataPerPage = 8;
  $totalPages = ceil($totalData / $dataPerPage);

  if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
  } else {
    $currentPage = 1;
  }

  $startIndex = ($currentPage - 1) * $dataPerPage;
  $endIndex = $startIndex + $dataPerPage;
} else {
  header("location: ../index.php");
  exit();
}
?>

<body class="g-sidenav-show bg-gray-200">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 ">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Target Pelanggan</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-3">
                <div class="d-flex justify-content-between mb-3">
                  <div class="row">
                    <div class="col">
                      <button class="btn btn-success ml-2" onclick="openImportPopup()">Import Data</button>
                    </div>
                  </div>
                  <div id="importPopup" class="modal">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3>Import Data</h3>
                        <span class="close" onclick="closeImportPopup()">&times;</span>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col text-center">
                            <a href="../assets/tmp/Daftar_Target.xlsx" target="_blank">
                              <button class="btn btn-primary" download>Template Excel</button>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="modal-body">
                        <form action="import.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="excelFile">Import File Excel</label>
                            <div class="row">
                              <div class="col text-center">
                                <div class="input-group ">
                                  <input type="file" class="form-control" name="excelFile">
                                </div>
                              </div>
                              <div class="col text-center">
                                <button class="btn btn-danger">Import</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <form class="d-flex ml-auto">
                    <input class="form-control mr-1" name="cari" type="search" placeholder="Search" aria-label="Search" value="<?php if (isset($_GET['cari'])) {
                                                                                                                                  echo $_GET['cari'];
                                                                                                                                } ?>">
                    <button class="btn" type="submit">
                      <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </button>
                  </form>
                </div>
                <hr>
                <div class="row">
                  <?php foreach ($query as $row) : ?>
                    <?php
                    $kd_akun = $row['kd_akun'];
                    $target_query = $db->query("SELECT COUNT(*) as jumlah_target FROM tbl_target WHERE kd_akun = '$kd_akun'");
                    $target_data = $target_query->fetch_assoc();
                    $jumlah_target = $target_data['jumlah_target'];

                    $countQuery = $db->query("SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE kd_akun = '$kd_akun'");
                    $countData = $countQuery->fetch_assoc();
                    $jumlah_data = $countData['jumlah_data'];

                    $selisih = $jumlah_data - $jumlah_target;

                    $kd_akun = $row['kd_akun'];
                    $queryAkun = $db->query("SELECT foto FROM tbl_akun WHERE kd_akun = '$kd_akun'");
                    $akunData = $queryAkun->fetch_assoc();
                    $fotoProfil = $akunData['foto'];
                    $fotoProfilPath = '../assets/img/akun/' . $fotoProfil;
                    ?>
                    <div class="col-md-3">
                      <div class="card card-primary card-outline" style="border-top: 5px solid #007bff; margin-bottom: 20px;">
                        <div class="card-body box-profile">
                          <div class="text-center">
                            <img class="foto-user" style="border-radius:20px;" src="<?php echo $fotoProfilPath; ?>" alt="User profile picture">
                          </div>

                          <h3 class="profile-username text-center"><?php echo $row['nama_lengkap']; ?></h3>
                          <p class="text-muted text-center">
                            <?php
                            if ($row['level'] == 0) {
                              echo "Admin";
                            } elseif ($row['level'] == 1) {
                              echo "Petugas Lapangan ($kd_akun)";
                            } else {
                              echo $row['level'];
                            }
                            ?>
                          </p>
                          <table class="table table-striped">
                            <tr>
                              <td>
                                <b>Jumlah</b>
                              </td>
                              <td>
                                <b><?php echo $jumlah_target; ?></b>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <b>Pending</b>
                              </td>
                              <td>
                                <b><?php echo $selisih; ?></b>
                              </td>
                            </tr>
                          </table>
                          <center>
                            <a href="targetaksi.php?aksi=tambah&kd_akun=<?php echo $row['kd_akun']; ?>" class="btn btn-success btn-block"><b>Tambah Target</b></a>
                            <a href="targetdetail.php?kd_akun=<?php echo $row['kd_akun']; ?>" class="btn btn-primary btn-block"><b>Detail Target</b></a>
                          </center>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>