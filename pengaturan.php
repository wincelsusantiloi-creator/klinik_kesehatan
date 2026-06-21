<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html>
<head>

<title>Pengaturan</title>


<style>

body{
font-family:Arial;
background:#f5f7fb;
padding:30px;
}


.box{
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 5px 15px #ddd;
}


h2{
color:#17395f;
}


input{
padding:10px;
width:300px;
margin:10px 0;
}


button{
background:#17395f;
color:white;
border:0;
padding:10px 20px;
border-radius:5px;
}

</style>

</head>


<body>


<div class="box">


<h2>Pengaturan Sistem</h2>

<hr>


<form>

<label>Nama Klinik</label><br>

<input type="text" value="Klinik Sehat">


<br>


<label>Nama Admin</label><br>

<input type="text" value="Admin">


<br>


<button>Simpan</button>


</form>


<br>

<a href="dashboard.php">
Kembali ke Dashboard
</a>


</div>


</body>

</html>