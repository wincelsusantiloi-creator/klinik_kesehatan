<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['role'] != "pasien"){
    header("Location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<title>Dashboard Pasien</title>


<style>


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}


body{

    min-height:100vh;

    background:
    linear-gradient(
    rgba(15,23,42,0.55),
    rgba(37,99,235,0.55)
    ),
    url('gambar klinik.jpg');

    background-size:cover;
    background-position:center;

}



/* NAVBAR */

.navbar{

    width:100%;
    padding:20px 50px;

    background:rgba(255,255,255,0.15);

    backdrop-filter:blur(15px);

    display:flex;

    justify-content:space-between;

    align-items:center;

    color:white;

    box-shadow:
    0 5px 20px rgba(0,0,0,.2);

}


.logo{

    font-size:25px;
    font-weight:bold;

}



.logout{

    background:#ef4444;

    color:white;

    padding:12px 25px;

    border-radius:30px;

    text-decoration:none;

    transition:.3s;

}


.logout:hover{

    background:#dc2626;

    transform:scale(1.05);

}



/* CONTENT */


.container{

    padding:50px;

}



.welcome{


    background:rgba(255,255,255,.18);

    backdrop-filter:blur(15px);

    padding:30px;

    border-radius:25px;

    color:white;

    box-shadow:
    0 10px 30px rgba(0,0,0,.25);


    animation:slide .8s;


}



.welcome h1{

    font-size:35px;

}



.welcome p{

    margin-top:10px;

}



/* CARD */


.menu{


    margin-top:40px;

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(230px,1fr));

    gap:30px;


}



.card{


    background:rgba(255,255,255,.85);

    backdrop-filter:blur(10px);


    padding:30px;


    border-radius:25px;


    text-align:center;


    box-shadow:
    0 10px 30px rgba(0,0,0,.25);


    transition:.4s;


    animation:slide 1s;


}



.card:hover{


    transform:
    translateY(-10px)
    scale(1.03);


}



.card h3{


    color:#2563eb;

    margin-bottom:15px;


}



.card p{

    color:#555;

}



.card a{


    display:inline-block;

    margin-top:15px;


    background:#2563eb;


    color:white;


    padding:12px 25px;


    border-radius:30px;


    text-decoration:none;


    transition:.3s;


}



.card a:hover{

    background:#1d4ed8;

}




/* ANIMASI */


@keyframes slide{


from{

opacity:0;

transform:translateY(40px);

}


to{

opacity:1;

transform:translateY(0);

}


}



</style>


</head>



<body>



<div class="navbar">


<div class="logo">

🏥 Klinik Sehat

</div>


<a class="logout" href="logout.php">

Logout

</a>


</div>





<div class="container">



<div class="welcome">


<h1>

Selamat Datang,
<?= $_SESSION['login']; ?>

</h1>


<p>

Silahkan pilih layanan kesehatan yang tersedia.

</p>


</div>





<div class="menu">





<div class="card">

<h3>💊 Daftar Obat</h3>

<p>
Lihat obat yang tersedia
</p>


<a href="obat.php">
Lihat
</a>

</div>





<div class="card">

<h3>👨‍⚕️ Dokter</h3>

<p>
Lihat daftar dokter
</p>


<a href="dokter.php">
Lihat
</a>

</div>





<div class="card">

<h3>📋 Pemeriksaan</h3>

<p>
Lihat riwayat pemeriksaan
</p>


<a href="pemeriksaan_pasien.php">
Lihat
</a>

</div>





<div class="card">

<h3>🛒 Pembelian</h3>

<p>
Beli obat yang tersedia
</p>


<a href="pembelian.php">
Beli
</a>

</div>




</div>


</div>


</body>

</html>