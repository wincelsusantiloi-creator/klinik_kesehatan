<?php
session_start();
include 'config.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != "admin"){
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Transaksi Pembelian</title>

<style>

body{
    font-family:Arial;
    background:#f1f5f9;
    padding:30px;
}

h2{
    color:#2563eb;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th{
    background:#2563eb;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border:1px solid #ddd;
    text-align:center;
}

a{
    background:#ef4444;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:8px;
}

</style>

</head>


<body>


<h2>🛒 Data Transaksi Pembelian Obat</h2>

<br>

<a href="dashboard.php">
← Kembali
</a>

<br><br>


<table>

<tr>
<th>No</th>
<th>Pasien</th>
<th>Obat</th>
<th>Jumlah</th>
<th>Total Harga</th>
<th>Tanggal</th>
</tr>


<?php

$no = 1;


$query = mysqli_query($conn,

"SELECT 
p.username,
o.nama_obat,
p.jumlah,
p.total_harga,
p.tanggal

FROM pembelian p

JOIN obat o 
ON p.id_obat = o.id

ORDER BY p.id_pembelian DESC"

) or die(mysqli_error($conn));


while($data=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $data['username']; ?></td>

<td><?= $data['nama_obat']; ?></td>

<td><?= $data['jumlah']; ?></td>

<td>
Rp <?= number_format($data['total_harga']); ?>
</td>

<td><?= $data['tanggal']; ?></td>

</tr>


<?php } ?>


</table>


</body>
</html>