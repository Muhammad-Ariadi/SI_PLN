<?php
include '../assets/conn/config.php';

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $idpel = $_POST['idpel'];
        $nama_pel = $_POST['nama_pel'];

        if (isset($_POST['daya_select']) && !empty($_POST['daya_select'])) {
            $daya = $_POST['daya_select'];
        } elseif (isset($_POST['daya_input']) && !empty($_POST['daya_input'])) {
            $daya = $_POST['daya_input'];
        } else {
            $daya = null;
        }

        $tipe = $_POST['tipe'];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $pmet = $_FILES['pmet']['name'];

        $nama_file_baru = $idpel . ".jpg";

        move_uploaded_file($_FILES['pmet']['tmp_name'], '../file/' . $nama_file_baru);
        $merk = $_POST["merk"];
        $tipemet = $_POST["tipemet"];
        $nomet = $_POST["nomet"];
        $ket = $_POST["ket"];
        $ket2 = $_POST["ket2"];


        $query = "INSERT INTO tbl_pelanggan (idpel, nama_pel, daya, tipe, latitude, longitude, pmet,merk,tipemet,nomet, ket, ket2, tanggal) 
        VALUES ('$idpel', '$nama_pel', '$daya', '$tipe', '$latitude', '$longitude', '$nama_file_baru', '$merk', '$tipemet', '$nomet', '$ket', '$ket2', CURDATE())";

        mysqli_query($db, $query);

        echo "<script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'pelangganinput.php';
              </script>";
        echo '<script>window.location.href = "pelangganinput.php";</script>';
    } elseif ($_GET['proses'] == 'ubah') {
        $kd_idpel = $_GET['kode'];
        $idpel = $_POST['idpel'];
        $nama_pel = $_POST['nama_pel'];
        $daya = $_POST['daya'];
        $tipe = $_POST['tipe'];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $merk = $_POST["merk"];
        $tipemet = $_POST["tipemet"];
        $nomet = $_POST["nomet"];
        $pmet = $_FILES['pmet']['name'];
        $nama_file_baru = $idpel . ".jpg";

        move_uploaded_file($_FILES['pmet']['tmp_name'], '../file/' . $nama_file_baru);
        $ket = $_POST["ket"];
        $ket2 = $_POST["ket2"];

        $hasil = $db->query("UPDATE tbl_pelanggan set nama_pel='$nama_pel', daya='$daya', tipe='$tipe', pmet='$nama_file_baru', merk='$merk',tipemet= '$tipemet',nomet= '$nomet', ket='$ket', ket2='$ket2' where idpel='$idpel'");
        if ($hasil) {
            echo "<script>alert('Update berhasil');</script>";
        } else {
            echo "<script>alert('Update gagal: " . mysqli_error($db) . "');</script>";
        }
        echo '<script>window.location.href = "pelangganinput.php";</script>';
    } elseif ($_GET['proses'] == 'proseshapus') {
        $idpel = $_GET['kode'];

        $query = "SELECT pmet FROM tbl_pelanggan WHERE idpel='$idpel'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $fileToDelete = $row['pmet'];
        $filePath = '../file/' . $fileToDelete;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $deleteQuery = "DELETE FROM tbl_pelanggan WHERE idpel='$idpel'";
        $deleteResult = mysqli_query($db, $deleteQuery);

        if ($deleteResult) {
            echo "<script>alert('Data dan file berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }

        echo '<script>window.location.href = "pelangganinput.php";</script>';
    }
}
