<?php
session_start();
include '../assets/conn/cek.php';
include '../assets/conn/config.php';

$successCount = 0;
$failCount = 0;

if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] === UPLOAD_ERR_OK) {
    $excelFile = $_FILES['excelFile']['tmp_name'];

    require '../vendor/autoload.php'; // Sesuaikan dengan lokasi library

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelFile);
    $worksheet = $spreadsheet->getActiveSheet();

    foreach ($worksheet->getRowIterator() as $row) {
        $rowData = [];
        foreach ($row->getCellIterator() as $cell) {
            $rowData[] = $cell->getValue();
        }

        $idpel = $rowData[0]; // Kolom 1
        $kd_akun = $rowData[1]; // Kolom 2
        $nama_pel = $rowData[2]; // Kolom 4
        $rbm = $rowData[3]; // Kolom 3
        $tipe = $rowData[4]; // Kolom 5
        $alamat = $rowData[5]; // Kolom 6
        $tanggal = $rowData[6]; // Kolom 7
        $tanggal_akhir = $rowData[7]; // Kolom 8
        $latitude = $rowData[8]; // Kolom 9
        $longitude = $rowData[9]; // Kolom 10
        $status = $rowData[10]; // Kolom 11

        // Modifikasi kode untuk memeriksa keberadaan kd_akun dalam tbl_akun
        $checkValidKdAkunQuery = "SELECT COUNT(*) FROM tbl_akun WHERE kd_akun = '$kd_akun'";
        $result = mysqli_query($db, $checkValidKdAkunQuery);
        $row = mysqli_fetch_array($result);
        $count = $row[0];

        // Validasi jika idpel sudah ada dalam tbl_target
        $checkIdpelQuery = "SELECT COUNT(*) FROM tbl_target WHERE idpel = '$idpel'";
        $resultIdpel = mysqli_query($db, $checkIdpelQuery);
        $rowIdpel = mysqli_fetch_array($resultIdpel);
        $countIdpel = $rowIdpel[0];

        if ($count > 0 && $countIdpel == 0) {
            // `kd_akun` valid, lanjutkan dengan INSERT
            $query = "INSERT INTO tbl_target (idpel, kd_akun, nama_pel, rbm, tipe, alamat, tanggal, tanggal_akhir, latitude, longitude, status) VALUES ('$idpel', '$kd_akun', '$nama_pel', '$rbm', '$tipe', '$alamat', '$tanggal', '$tanggal_akhir', '$latitude', '$longitude', '$status')";

            if (mysqli_query($db, $query)) {
                $successCount++;
            } else {
                $failCount++;
            }
        } elseif ($countIdpel > 0) {
            // idpel sudah ada, tampilkan pesan kesalahan
            echo '<script>';
            echo 'alert("idpel yang anda masukkan sudah ada: ' . $idpel . '");';
            echo '</script>';
        }
    }
    if ($count == 0) {
        // kd_akun tidak valid, tampilkan pesan kesalahan
        echo '<script>';
        echo 'alert("kd_akun yang anda masukkan tidak valid: ' . $kd_akun . '");';
        echo '</script>';
    }
}

// Menambahkan notifikasi JavaScript
echo '<script>';
echo 'alert("Data berhasil diimpor: ' . $successCount . ' data");';
echo 'window.location.href = "targetinput.php";'; // Gantilah "halaman_tujuan.php" dengan halaman tujuan Anda.
echo '</script>';
