<?php
include '../assets/conn/config.php';

$daftar_pelanggan = mysqli_query($db, "SELECT * from tbl_pelanggan");

$filename = "Daftar Pelanggan.xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=" . $filename);

echo '<table border="1">
    <tr>
    <th>NO</th>
    <th>ID PELANGGAN</th>
    <th>NAMA PELANGGAN</th>
    <th>DAYA</th>
    <th>TIPE PEMBAYARAN</th>
    <th>MAPS</th>
    <th>FOTO KWH</th>
    <th>Merk</th>
    <th>Type</th>
    <th>Nomor Meteran</th>
    <th>KETERANGAN</th>
    <th>RINCIAN</th>
    </tr>';
$no = 1;
while ($row = mysqli_fetch_assoc($daftar_pelanggan)) {
    $maps = $row['latitude'] . ', ' . $row['longitude'];
    echo "<tr>
    <td style='mso-number-format:\"\\@\";'>$no</td>
    <td style='mso-number-format:\"\\@\";'>" . $row['idpel'] . "</td>
    <!-- Sisipkan style='mso-number-format:\"\\@\";' pada kolom yang ingin diubah menjadi format teks -->
    <td>" . $row['nama_pel'] . "</td>
    <td>" . $row['daya'] . "</td>
    <td>" . $row['tipe'] . "</td>
    <td>" . $maps . "</td>
    <td>" . $row['pmet'] . "</td>
    <td>" . $row['merk'] . "</td>
    <td>" . $row['tipemet'] . "</td>
    <td style='mso-number-format:\"\\@\";'>" . $row['nomet'] . "</td>
    <td>" . $row['ket'] . "</td>
    <td>" . $row['ket2'] . "</td>
</tr>";
    $no++;
}
echo '</table>';

mysqli_close($db);
