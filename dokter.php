<?php
include 'config.php';


if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    mysqli_query($conn,"
    INSERT INTO dokter
    (nama,spesialis,hari,jam_mulai,jam_selesai)

    VALUES

    ('$nama','$spesialis','$hari','$jam_mulai','$jam_selesai')
    ");

    header("Location:dokter.php");
}


if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,"
    DELETE FROM dokter
    WHERE id='$id'
    ");

    header("Location:dokter.php");
}



if(isset($_POST['update'])){

    $id = $_POST['id'];

    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];

    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    mysqli_query($conn,"

    UPDATE dokter SET

    nama='$nama',
    spesialis='$spesialis',

    hari='$hari',
    jam_mulai='$jam_mulai',
    jam_selesai='$jam_selesai'

    WHERE id='$id'

    ");

    header("Location:dokter.php");
}

?>


<!DOCTYPE html>
<html>

<head>

<title>Data Dokter</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins;
}


body{

background:linear-gradient(135deg,#74ebd5,#ACB6E5);

padding:40px;

}


.container{

width:95%;
max-width:1100px;

margin:auto;

background:white;

padding:30px;

border-radius:20px;

box-shadow:0 10px 30px rgba(0,0,0,0.2);

}


h2{

text-align:center;

margin-bottom:20px;

}


.input-group{

margin-bottom:15px;

}


input{

width:100%;

padding:12px;

border:none;

border-radius:10px;

background:#f1f5f9;

}


button{

width:100%;

padding:14px;

border:none;

border-radius:10px;

background:#4facfe;

color:white;

font-size:16px;

cursor:pointer;

}


table{

width:100%;

border-collapse:collapse;

margin-top:25px;

}


th{

background:#4facfe;

color:white;

padding:12px;

}


td{

padding:12px;

text-align:center;

border-bottom:1px solid #ddd;

}


.edit{

background:orange;

padding:7px 12px;

border-radius:6px;

color:white;

text-decoration:none;

}


.hapus{

background:red;

padding:7px 12px;

border-radius:6px;

color:white;

text-decoration:none;

}


.menu{

margin-bottom:20px;

}


.menu a{

padding:10px 15px;

border-radius:8px;

text-decoration:none;

color:white;

}


.logout{

background:red;

}


.kembali{

background:green;

}

</style>

</head>


<body>


<div class="container">


<h2>🩺 Data Dokter Klinik</h2>


<div class="menu">

<a href="logout.php" class="logout">

Logout

</a>


<a href="index.php" class="kembali">

Kembali

</a>

</div>



<?php

$edit = null;


if(isset($_GET['edit'])){


$id = $_GET['edit'];

$ambil = mysqli_query($conn,"
SELECT * FROM dokter
WHERE id='$id'
");

$edit = mysqli_fetch_assoc($ambil);

}

?>


<form method="POST">


<?php if($edit){ ?>

<input type="hidden"

name="id"

value="<?= $edit['id'] ?>">

<?php } ?>



<div class="input-group">

<input type="text"

name="nama"

placeholder="Nama Dokter"

value="<?= $edit ? $edit['nama'] : '' ?>"

required>

</div>



<div class="input-group">

<input type="text"

name="spesialis"

placeholder="Spesialis"

value="<?= $edit ? $edit['spesialis'] : '' ?>">

</div>



<div class="input-group">

<input type="text"

name="hari"

placeholder="Hari Praktik"

value="<?= $edit ? $edit['hari'] : '' ?>">

</div>



<div class="input-group">

<input type="time"

name="jam_mulai"

value="<?= $edit ? $edit['jam_mulai'] : '' ?>">

</div>



<div class="input-group">

<input type="time"

name="jam_selesai"

value="<?= $edit ? $edit['jam_selesai'] : '' ?>">

</div>



<?php if($edit){ ?>

<button name="update">

Update Data

</button>

<?php } else { ?>

<button name="simpan">

Simpan Data

</button>

<?php } ?>


</form>



<table>

<tr>

<th>No</th>

<th>Nama Dokter</th>

<th>Spesialis</th>

<th>Hari</th>

<th>Jam Mulai</th>

<th>Jam Selesai</th>

<th>Aksi</th>

</tr>



<?php

$no=1;

$data = mysqli_query($conn,"
SELECT * FROM dokter
");


while($d=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++ ?></td>

<td><?= $d['nama'] ?></td>

<td><?= $d['spesialis'] ?></td>

<td><?= $d['hari'] ?></td>

<td><?= substr($d['jam_mulai'],0,5) ?></td>

<td><?= substr($d['jam_selesai'],0,5) ?></td>

<td>

<a class="edit"

href="dokter.php?edit=<?= $d['id'] ?>">

Edit

</a>


<a class="hapus"

href="dokter.php?hapus=<?= $d['id'] ?>"

onclick="return confirm('Yakin ingin hapus data?')">

Hapus

</a>

</td>

</tr>

<?php } ?>


</table>


</div>


</body>
</html>