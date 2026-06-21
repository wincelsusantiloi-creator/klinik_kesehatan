<?php
include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan");
}

$id = intval($_GET['id']);

$data = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id'");

if (mysqli_num_rows($data) == 0) {
    die("Data pasien tidak ditemukan");
}

$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $no_hp  = mysqli_real_escape_string($conn, $_POST['no_hp']);

    $update = mysqli_query($conn, "UPDATE pasien SET
        nama='$nama',
        alamat='$alamat',
        no_hp='$no_hp'
        WHERE id='$id'
    ");

    if ($update) {
        header("Location: tampil.php");
        exit;
    } else {
        echo "Gagal update data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pasien</title>

```
<style>
    body{
        font-family: Arial, sans-serif;
        background:#f2f2f2;
    }

    .container{
        width:400px;
        margin:50px auto;
        background:white;
        padding:25px;
        border-radius:10px;
        box-shadow:0 0 10px rgba(0,0,0,0.1);
    }

    h2{
        text-align:center;
    }

    input, textarea{
        width:100%;
        padding:10px;
        margin-top:10px;
        margin-bottom:15px;
        box-sizing:border-box;
    }

    button{
        width:100%;
        padding:12px;
        border:none;
        background:#007bff;
        color:white;
        border-radius:6px;
        cursor:pointer;
    }

    button:hover{
        background:#0056b3;
    }
</style>
```

</head>
<body>

<div class="container">
    <h2>Edit Data Pasien</h2>

```
<form method="POST">
    <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>

    <textarea name="alamat" required><?php echo $row['alamat']; ?></textarea>

    <input type="text" name="no_hp" value="<?php echo $row['no_hp']; ?>" required>

    <button type="submit" name="update">Update</button>
</form>
```

</div>

</body>
</html>
