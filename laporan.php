<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include "config.php";

$dokter = mysqli_query($conn,"SELECT * FROM dokter");
$pasien = mysqli_query($conn, "SELECT * FROM pasien");
$obat = mysqli_query($conn, "SELECT * FROM obat");

$pemeriksaan = mysqli_query($conn,"
SELECT pemeriksaan.*,
       pasien.nama AS nama_pasien,
       dokter.nama AS nama_dokter
FROM pemeriksaan
LEFT JOIN pasien ON pemeriksaan.id_pasien = pasien.id
LEFT JOIN dokter ON pemeriksaan.id_dokter = dokter.id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Klinik</title>

<style>
body{
    font-family:Arial;
    background:#f5f7fb;
    padding:30px;
}

.container{
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 5px 15px #ddd;
}

h2{
    color:#17395f;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-bottom:30px;
}

th{
    background:#17395f;
    color:white;
    padding:10px;
}

td{
    border:1px solid #ddd;
    padding:10px;
}

a{
    text-decoration:none;
    color:#17395f;
    font-weight:bold;
}
</style>

</head>

<body>

<div class="container">

<h2>Laporan Klinik</h2>
<hr>


<h3>Laporan Data Dokter</h3>

<table>

<tr>
    <th>No</th>
    <th>Nama Dokter</th>
    <th>Spesialis</th>
    <th>Hari Praktik</th>
    <th>Jam Mulai</th>
    <th>Jam Selesai</th>
</tr>

<?php
$no = 1;

while($d = mysqli_fetch_assoc($dokter)){
?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['nama'] ?></td>

<td><?= $d['spesialis'] ?></td>

<td><?= $d['hari'] ?></td>

<td><?= substr($d['jam_mulai'],0,5) ?></td>

<td><?= substr($d['jam_selesai'],0,5) ?></td>

</tr>

<?php } ?>

</table>


<!-- Data Pasien -->
<h3>Laporan Data Pasien</h3>

<table>
<tr>
    <th>No</th>
    <th>Nama Pasien</th>
    <th>Umur</th>
    <th>Alamat</th>
    <th>No HP</th>
</tr>

<?php
$no=1;
while($p=mysqli_fetch_assoc($pasien)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['nama'] ?></td>
    <td><?= $p['umur'] ?></td>
    <td><?= $p['alamat'] ?></td>
    <td><?= $p['no_hp'] ?></td>
</tr>
<?php } ?>
</table>


<!-- Data Obat -->
<h3>Laporan Data Obat</h3>

<table>
<tr>
    <th>No</th>
    <th>Nama Obat</th>
    <th>Stok</th>
    <th>Harga</th>
</tr>

<?php
$no=1;
while($o=mysqli_fetch_assoc($obat)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $o['nama_obat'] ?></td>
    <td><?= $o['stok'] ?></td>
    <td><?= $o['harga'] ?></td>
</tr>
<?php } ?>

</table>


<!-- Data Pemeriksaan -->
<h3>Laporan Pemeriksaan</h3>

<table>
<tr>
    <th>No</th>
    <th>Pasien</th>
    <th>Dokter</th>
    <th>Tanggal</th>
    <th>Keluhan</th>
</tr>

<?php
$no=1;
while($pm=mysqli_fetch_assoc($pemeriksaan)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $pm['nama_pasien'] ?></td>
    <td><?= $pm['nama_dokter'] ?></td>
    <td><?= $pm['tanggal'] ?></td>
    <td><?= $pm['keluhan'] ?></td>
</tr>
<?php } ?>

</table>

<a href="dashboard.php">← Kembali ke Dashboard</a>

</div>

</body>
</html>