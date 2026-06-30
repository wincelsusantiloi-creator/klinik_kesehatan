<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role']!="admin"){
    header("Location: login.php");
    exit;
}

include "config.php";


$dokter = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM dokter"));
$obat = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM obat"));
$pasien = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pasien"));
$pemeriksaan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pemeriksaan"));
$transaksi = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pembelian"));

?>


<!DOCTYPE html>
<html>
<head>

<title>Dashboard Admin Klinik</title>

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
height:100vh;
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
color:#9fc5ff;
margin:20px 0 10px;
}


.menu a{

display:block;
color:white;
text-decoration:none;
padding:12px;

}


.menu a:hover{

background:#285889;
border-radius:8px;

}



.content{

margin-left:220px;
padding:30px;

}



.header{

display:flex;
justify-content:space-between;

}



.cards{

display:grid;
grid-template-columns:repeat(5,1fr);
gap:20px;
margin-top:30px;

}



.card{

background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 15px #ddd;

}



.card h1{

font-size:32px;

}



.blue{
border-left:7px solid #2563eb;
}

.green{
border-left:7px solid green;
}

.orange{
border-left:7px solid orange;
}

.red{
border-left:7px solid red;
}



.box{

background:white;
padding:25px;
margin-top:30px;
border-radius:10px;

}



table{

width:100%;
border-collapse:collapse;

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


</style>

</head>


<body>


<div class="sidebar">


<div class="logo">
🏥 Klinik Kesehatan
<small>Sistem Manajemen Klinik</small>
</div>



<div class="menu">


<h4>UTAMA</h4>

<a href="dashboard.php">
Dashboard
</a>


<a href="dokter.php">
Data Dokter
</a>


<a href="pasien.php">
Data Pasien
</a>



<h4>LAYANAN</h4>


<a href="obat.php">
Data Obat
</a>


<a href="pemeriksaan.php">
Pemeriksaan
</a>


<a href="transaksi.php">
🛒 Transaksi
</a>



<h4>SISTEM</h4>


<a href="logout.php">
Logout
</a>


</div>


</div>



<div class="content">


<div class="header">

<h2>Dashboard</h2>

<p>
<?= date("l, d M Y"); ?>
</p>

</div>



<div class="cards">


<div class="card blue">
<h1><?= $dokter ?></h1>
<p>Dokter</p>
</div>


<div class="card green">
<h1><?= $obat ?></h1>
<p>Obat</p>
</div>


<div class="card orange">
<h1><?= $pasien ?></h1>
<p>Pasien</p>
</div>


<div class="card red">
<h1><?= $pemeriksaan ?></h1>
<p>Pemeriksaan</p>
</div>


<div class="card blue">
<h1><?= $transaksi ?></h1>
<p>Transaksi</p>
</div>


</div>



<div class="box">
    <div class="box">

<h3>📊 Statistik Klinik</h3>

<br>

<div style="
display:flex;
align-items:end;
gap:30px;
height:250px;
">


<div style="text-align:center">
<span style="
display:block;
height:150px;
width:80px;
background:#2563eb;
color:white;
padding-top:10px;
border-radius:8px 8px 0 0;
">
<?= $dokter ?>
</span>
Dokter
</div>



<div style="text-align:center">
<span style="
display:block;
height:120px;
width:80px;
background:green;
color:white;
padding-top:10px;
border-radius:8px 8px 0 0;
">
<?= $obat ?>
</span>
Obat
</div>



<div style="text-align:center">
<span style="
display:block;
height:90px;
width:80px;
background:orange;
color:white;
padding-top:10px;
border-radius:8px 8px 0 0;
">
<?= $pasien ?>
</span>
Pasien
</div>



<div style="text-align:center">
<span style="
display:block;
height:110px;
width:80px;
background:#dc2626;
color:white;
padding-top:10px;
border-radius:8px 8px 0 0;
">
<?= $pemeriksaan ?>
</span>
Pemeriksaan
</div>



<div style="text-align:center">
<span style="
display:block;
height:100px;
width:80px;
background:#9333ea;
color:white;
padding-top:10px;
border-radius:8px 8px 0 0;
">
<?= $transaksi ?>
</span>
Transaksi
</div>


</div>

</div>


<h3>
🛒 Transaksi Terbaru
</h3>

<br>


<table>


<tr>

<th>No</th>
<th>Pasien</th>
<th>Obat</th>
<th>Jumlah</th>
<th>Total</th>
<th>Tanggal</th>

</tr>



<?php


$no=1;


$data=mysqli_query($conn,


"SELECT 
p.username,
o.nama_obat,
p.jumlah,
p.total_harga,
p.tanggal

FROM pembelian p

JOIN obat o 
ON p.id_obat=o.id

ORDER BY p.id_pembelian DESC

LIMIT 10"


);



while($row=mysqli_fetch_assoc($data)){


?>


<tr>

<td><?= $no++; ?></td>

<td><?= $row['username']; ?></td>

<td><?= $row['nama_obat']; ?></td>

<td><?= $row['jumlah']; ?></td>

<td>
Rp <?= number_format($row['total_harga']); ?>
</td>

<td><?= $row['tanggal']; ?></td>


</tr>


<?php } ?>


</table>
</div>

</div>

</body>
</html>