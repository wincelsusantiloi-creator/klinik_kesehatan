<?php
session_start();
include 'config.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != "pasien"){
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<title>Pemeriksaan Pasien</title>

<style>

body{
    font-family:Arial,sans-serif;
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

.kembali{
    display:inline-block;
    background:#2563eb;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
    margin-bottom:20px;
}

</style>

</head>


<body>

<h2>📋 Riwayat Pemeriksaan</h2>

<br>

<a class="kembali" href="dashboard_pasien.php">
← Kembali
</a>


<table>

<tr>
    <th>No</th>
    <th>Dokter</th>
    <th>Tanggal</th>
    <th>Keluhan</th>
</tr>


<?php

$no = 1;

$query = mysqli_query($conn,

"SELECT 
p.tanggal,
p.keluhan,
d.nama

FROM pemeriksaan p

JOIN dokter d 
ON p.id_dokter = d.id

");


if(!$query){
    die(mysqli_error($conn));
}


while($data = mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $data['nama']; ?></td>

<td><?= $data['tanggal']; ?></td>

<td><?= $data['keluhan']; ?></td>

</tr>


<?php

}

?>


</table>


</body>
</html>