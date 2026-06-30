<?php
session_start();
include "config.php";


if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}


if(isset($_POST['beli'])){

    $username = $_SESSION['login'];
    $id_obat = $_POST['id_obat'];
    $jumlah = $_POST['jumlah'];


    $data = mysqli_query($conn,
    "SELECT * FROM obat WHERE id='$id_obat'");


    $obat = mysqli_fetch_assoc($data);


    $total = $obat['harga'] * $jumlah;


    mysqli_query($conn,

    "INSERT INTO pembelian
    (username,id_obat,jumlah,total_harga,tanggal)

    VALUES

    ('$username',
    '$id_obat',
    '$jumlah',
    '$total',
    CURDATE())"

    );


    echo "<script>
    alert('Pembelian berhasil');
    window.location='dashboard_pasien.php';
    </script>";

}

?>


<!DOCTYPE html>
<html>

<head>

<title>Pembelian Obat</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}


body{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;


    background:

    linear-gradient(
        rgba(37,99,235,0.7),
        rgba(30,64,175,0.8)
    ),

    url('gambar klinik.jpg');


    background-size:cover;

    background-position:center;

}


/* BOX PEMBELIAN */

.box{

    width:420px;

    background:rgba(255,255,255,0.18);

    backdrop-filter:blur(15px);

    padding:40px;

    border-radius:25px;

    box-shadow:

    0 15px 35px rgba(0,0,0,0.3);


    animation: muncul 0.8s ease;


}



/* JUDUL */

.box h2{

    text-align:center;

    color:white;

    font-size:30px;

    margin-bottom:25px;


}



/* SELECT */

select{

    width:100%;

    padding:15px;

    margin-bottom:20px;

    border:none;

    outline:none;

    border-radius:15px;


    background:white;

    font-size:16px;


    cursor:pointer;


    transition:.3s;

}



select:hover{

    transform:scale(1.03);

}



/* INPUT JUMLAH */


input{

    width:100%;

    padding:15px;

    margin-bottom:20px;


    border:none;

    outline:none;


    border-radius:15px;


    font-size:16px;


}



input:focus{

    box-shadow:

    0 0 10px rgba(255,255,255,.8);

    transform:scale(1.03);

}



/* BUTTON */


button{


    width:100%;


    padding:15px;


    border:none;


    border-radius:15px;


    background:white;


    color:#2563eb;


    font-size:17px;


    font-weight:bold;


    cursor:pointer;


    transition:.3s;


}



button:hover{


    background:#2563eb;


    color:white;


    transform:

    translateY(-5px);


    box-shadow:

    0 10px 20px rgba(0,0,0,.3);


}



/* ANIMASI */


@keyframes muncul{


from{

    opacity:0;

    transform:translateY(50px);

}


to{

    opacity:1;

    transform:translateY(0);

}


}


</style>


</head>


<body>


<div class="box">


<h2>🛒 Pembelian Obat</h2>


<form method="POST">


<select name="id_obat">


<?php

$query=mysqli_query($conn,
"SELECT * FROM obat");


while($data=mysqli_fetch_assoc($query)){


?>


<option value="<?= $data['id']; ?>">

<?= $data['nama_obat']; ?> 
- Rp <?= number_format($data['harga']); ?>

</option>


<?php } ?>


</select>



<input type="number" 
name="jumlah"
placeholder="Jumlah beli"
required>


<button name="beli">

Beli Obat

</button>


</form>


</div>


</body>

</html>