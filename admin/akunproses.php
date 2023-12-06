<?php
include '../assets/layouts/sidebar.php';

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $kd_akun = $_POST['kd_akun'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $foto = $_FILES['foto']['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $file_tmp = $_FILES['foto']['tmp_name'];
        $new_width = 128;
        $new_height = 128;

        list($width, $height, $type) = getimagesize($file_tmp);

        if ($type == IMAGETYPE_JPEG) {
            $image = imagecreatefromjpeg($file_tmp);
        } elseif ($type == IMAGETYPE_PNG) {
            $image = imagecreatefrompng($file_tmp);
        } else {

        }

        $new_image = imagecreatetruecolor($new_width, $new_height);

        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Simpan gambar yang sudah diubah ukuran ke format JPG
        $new_image_filename = '../assets/img/akun/' . pathinfo($foto, PATHINFO_FILENAME) . '.jpg'; // Ubah format menjadi JPG
        imagejpeg($new_image, $new_image_filename);

        unlink($file_tmp);

        // Simpan informasi ke database dengan format JPG
        $foto_jpg = pathinfo($new_image_filename, PATHINFO_FILENAME) . '.jpg'; // Ubah format di sini
        $hasil = $db->query("INSERT into tbl_akun (kd_akun, nama_lengkap, foto, username, password, level) values ('$kd_akun', '$nama_lengkap', '$foto_jpg', '$username', '$password', '$level')");
        echo '<script>window.location.href = "akuninput.php";</script>';
    } elseif ($_GET['proses'] == 'ubah') {
        $kd_akun = $_POST['kd_akun'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $updateFoto = false;

        if ($_FILES['foto']['name']) {
            $file_tmp = $_FILES['foto']['tmp_name'];
            $new_width = 128;
            $new_height = 128;

            list($width, $height, $type) = getimagesize($file_tmp);

            if ($type == IMAGETYPE_JPEG) {
                $image = imagecreatefromjpeg($file_tmp);
            } elseif ($type == IMAGETYPE_PNG) {
                $image = imagecreatefrompng($file_tmp);
            } else {
                // Handle other image types if needed
                // You can add support for other image types here
            }

            $new_image = imagecreatetruecolor($new_width, $new_height);

            imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            $new_image_filename = '../assets/img/akun/' . pathinfo($_FILES['foto']['name'], PATHINFO_FILENAME) . '.jpg';
            imagejpeg($new_image, $new_image_filename);

            unlink($file_tmp);

            $foto_jpg = pathinfo($new_image_filename, PATHINFO_FILENAME) . '.jpg';
            $updateFoto = true;
        }

        if ($updateFoto) {
            $hasil = $db->query("UPDATE tbl_akun set nama_lengkap='$nama_lengkap', username='$username',password='$password',level='$level',foto='$foto_jpg' where kd_akun='$kd_akun'");
        } else {
            $hasil = $db->query("UPDATE tbl_akun set nama_lengkap='$nama_lengkap', username='$username',password='$password',level='$level' where kd_akun='$kd_akun'");
        }
        echo '<script>window.location.href = "akuninput.php";</script>';
    } elseif ($_GET['proses'] == 'proseshapus') {
        $kd_akun = $_GET['kode'];

        $query = "SELECT foto FROM tbl_akun WHERE kd_akun='$kd_akun'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $fileToDelete = $row['foto'];
        $filePath = '../assets/img/akun/' . $fileToDelete;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $deleteQuery = "DELETE FROM tbl_akun WHERE kd_akun='$kd_akun'";
        $deleteResult = mysqli_query($db, $deleteQuery);

        if ($deleteResult) {
            echo "<script>alert('Data dan file berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }

        echo '<script>window.location.href = "akuninput.php";</script>';
    }
}
