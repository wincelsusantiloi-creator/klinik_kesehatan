<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include "config.php";

$dokter = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dokter"));
$obat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM obat"));
$pasien = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pasien"));
$pemeriksaan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pemeriksaan"));

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Klinik kesehatan</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#f5f7fb;
}



.sidebar{
    position:fixed;
    width:220px;
    height:100%;
    background:#17395f;
    color:white;
    padding:20px;
}


.logo{
    font-size:20px;
    font-weight:bold;
}

.logo small{
    display:block;
    font-size:11px;
    color:#9fc5ff;
}


.menu{
    margin-top:40px;
}

.menu h4{
    font-size:12px;
    color:#8da8c7;
    margin:20px 0 10px;
}


.menu a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    border-radius:5px;
    margin-bottom:5px;
}


.menu a:hover{
    background:#285889;
}


/* CONTENT */

.content{
    margin-left:220px;
    padding:25px;
}


.header{
    display:flex;
    justify-content:space-between;
}


.header h2{
    font-weight:normal;
}


.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
    margin-top:35px;
}


.card{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 5px 15px #ddd;
    animation:fade .7s;
}


.card h1{
    font-size:32px;
}


.card p{
    color:#777;
}


.blue{
    border-left:7px solid #2670b8;
}

.green{
    border-left:7px solid green;
}

.orange{
    border-left:7px solid orange;
}

.red{
    border-left:7px solid #c0392b;
}



/* BAGIAN BAWAH */

.area{
    display:grid;
    grid-template-columns:70% 30%;
    margin-top:40px;
    gap:20px;
}


/* GRAFIK */

.chart{
    background:white;
    padding:25px;
    border-radius:10px;
}


.bar{
    display:flex;
    align-items:end;
    height:220px;
    gap:25px;
}


.bar div{
    width:100px;
    text-align:center;
}


.bar span{
    display:block;
    background:#2167a8;
    color:white;
    padding:10px;
    border-radius:5px 5px 0 0;
}


.bar .obat{
    background:#38720d;
}

.bar .pasien{
    background:#9a5b0b;
}

.bar .periksa{
    background:#ad3030;
}



/* AKTIVITAS */

.activity{
    background:white;
    padding:20px;
    border-radius:10px;
}


.activity li{
    list-style:none;
    padding:15px 0;
    border-bottom:1px solid #eee;
}



/* ANIMASI */

@keyframes fade{

from{
opacity:0;
transform:translateY(20px);
}

to{
opacity:1;
transform:translateY(0);
}

}


</style>

</head>


<body>


<div class="sidebar">

<div class="logo">
Klinik Kesehatan
<small>Sistem Manajemen Klinik</small>
</div>


<div class="menu">

<h4>UTAMA</h4>

<a href="dashboard.php">Dashboard</a>
<a href="dokter.php">Data Dokter</a>
<a href="pasien.php">Data Pasien</a>


<h4>LAYANAN</h4>

<a href="obat.php">Data Obat</a>
<a href="pemeriksaan.php">Pemeriksaan</a>


<h4>SISTEM</h4>

<a href="laporan.php">Laporan</a>
<a href="pengaturan.php">Pengaturan</a>


</div>


</div>



<div class="content">


<div class="header">

<h2>Dashboard</h2>

<p>
<?php echo date("l, d M Y"); ?>
</p>

</div>



<div class="cards">


<div class="card blue">
<h1><?= $dokter ?></h1>
<p>Data Dokter</p>
</div>


<div class="card green">
<h1><?= $obat ?></h1>
<p>Data Obat</p>
</div>


<div class="card orange">
<h1><?= $pasien ?></h1>
<p>Data Pasien</p>
</div>

<div class="card red">
<h1><?= $pemeriksaan ?></h1>
<p>Pemeriksaan</p>
</div>
</div>
<div class="area">
<div class="chart">

<h3>Statistik Klinik</h3>

<br>


<div class="bar">

<div>
<span style="height:150px">
<?= $dokter ?>
</span>
Dokter
</div>


<div>
<span class="obat" style="height:120px">
<?= $obat ?>
</span>
Obat
</div>


<div>
<span class="pasien" style="height:90px">
<?= $pasien ?>
</span>
Pasien
</div>


<div>
<span class="periksa" style="height:110px">
<?= $pemeriksaan ?>
</span>
Periksa
</div>

</div>
</div>
<div class="activity">

<h3>Aktivitas Terbaru</h3>
<ul>

<li>🔵 Dokter melakukan konsultasi</li>

<li>🟢 Obat masuk stok baru</li>

<li>🟠 Pasien melakukan pendaftaran</li>

<li>🔴 Pemeriksaan selesai</li>


</ul>

</div>

</div>
</div>
</body>
</html>