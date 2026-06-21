<?php  
include 'config.php';

if (isset($_POST['simpan'])) {
    $pasien = $_POST['pasien'];
    $dokter = $_POST['dokter'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];

    mysqli_query($conn, "INSERT INTO pemeriksaan VALUES('', '$pasien', '$dokter', '$tanggal', '$keluhan')");
    header("Location: pemeriksaan.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM pemeriksaan WHERE id='$id'");
    header("Location: pemeriksaan.php");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $pasien = $_POST['pasien'];
    $dokter = $_POST['dokter'];
    $tanggal = $_POST['tanggal'];
    $keluhan = $_POST['keluhan'];

    mysqli_query($conn, "UPDATE pemeriksaan SET
        id_pasien='$pasien',
        id_dokter='$dokter',
        tanggal='$tanggal',
        keluhan='$keluhan'
        WHERE id='$id'
    ");

    header("Location: pemeriksaan.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Pasien</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            min-height:100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding:40px;
        }

        .container{
            width:100%;
            max-width:1100px;
            margin:auto;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(15px);
            border-radius:25px;
            padding:35px;
            box-shadow:0 10px 35px rgba(0,0,0,0.25);
            border:1px solid rgba(255,255,255,0.2);
        }

        h2{
            text-align:center;
            color:white;
            margin-bottom:20px;
            font-size:38px;
        }

        .menu{
            display:flex;
            gap:10px;
            margin-bottom:25px;
        }

        .menu a{
            text-decoration:none;
            padding:10px 18px;
            border-radius:10px;
            color:white;
            font-weight:bold;
        }

        .logout{
            background:red;
        }

        .kembali{
            background:green;
        }

        form{
            display:grid;
            gap:18px;
            margin-bottom:35px;
        }

        select,
        input,
        textarea{
            width:100%;
            padding:15px;
            border:none;
            outline:none;
            border-radius:15px;
            background:rgba(255,255,255,0.9);
            font-size:16px;
        }

        textarea{
            min-height:120px;
            resize:none;
        }

        button{
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color:white;
            border:none;
            padding:15px;
            border-radius:15px;
            font-size:18px;
            cursor:pointer;
            font-weight:bold;
        }

        .btn{
            padding:8px 12px;
            border-radius:8px;
            text-decoration:none;
            color:white;
        }

        .edit{
            background:orange;
        }

        .hapus{
            background:red;
        }

        .table-box{
            overflow-x:auto;
            border-radius:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:20px;
        }

        th{
            background:rgba(255,255,255,0.25);
            color:white;
            padding:18px;
        }

        td{
            background:rgba(255,255,255,0.92);
            padding:16px;
            text-align:center;
            color:#333;
        }

        tr:nth-child(even) td{
            background:#eef3ff;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Pemeriksaan Pasien</h2>

    
    <div class="menu"> 
    <a href="logout.php" class="logout">Logout</a>
    <a href="dashboard.php" class="kembali">Kembali Dashboard</a>
</div>

    <?php
    $edit = null;

    if (isset($_GET['edit'])) {
        $id_edit = $_GET['edit'];

        $ambil = mysqli_query($conn, "SELECT * FROM pemeriksaan WHERE id='$id_edit'");
        $edit = mysqli_fetch_array($ambil);
    }
    ?>

    <form method="POST">

        <?php if($edit){ ?>
            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
        <?php } ?>

        <select name="pasien" required>
            <option value="">-- Pilih Pasien --</option>
            <?php
            $p = mysqli_query($conn, "SELECT * FROM pasien");
            while ($d = mysqli_fetch_array($p)) {
            ?>
                <option value="<?= $d['id'] ?>"
                    <?= ($edit && $edit['id_pasien'] == $d['id']) ? 'selected' : '' ?>>
                    <?= $d['nama'] ?>
                </option>
            <?php } ?>
        </select>

        <select name="dokter" required>
            <option value="">-- Pilih Dokter --</option>
            <?php
            $d = mysqli_query($conn, "SELECT * FROM dokter");
            while ($dok = mysqli_fetch_array($d)) {
            ?>
                <option value="<?= $dok['id'] ?>"
                    <?= ($edit && $edit['id_dokter'] == $dok['id']) ? 'selected' : '' ?>>
                    <?= $dok['nama'] ?>
                </option>
            <?php } ?>
        </select>

        <input type="date" 
               name="tanggal" 
               value="<?= $edit ? $edit['tanggal'] : '' ?>" 
               required>

        <textarea name="keluhan" required><?= $edit ? $edit['keluhan'] : '' ?></textarea>

        <?php if($edit){ ?>
            <button name="update">Update Pemeriksaan</button>
        <?php } else { ?>
            <button name="simpan">💾 Simpan Pemeriksaan</button>
        <?php } ?>

    </form>

    <hr>

    <div class="table-box">
        <table>
            <tr>
                <th>No</th>
                <th>Pasien</th>
                <th>Dokter</th>
                <th>Tanggal</th>
                <th>Keluhan</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;
            $data = mysqli_query($conn, "
            SELECT 
                pm.id,
                p.nama as pasien, 
                d.nama as dokter, 
                pm.tanggal, 
                pm.keluhan
            FROM pemeriksaan pm
            JOIN pasien p ON pm.id_pasien = p.id
            JOIN dokter d ON pm.id_dokter = d.id
            ");

            while ($row = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['pasien'] ?></td>
                <td><?= $row['dokter'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['keluhan'] ?></td>

                <td>
                    <a href="pemeriksaan.php?edit=<?= $row['id'] ?>" class="btn edit">
                        Edit
                    </a>

                    <a href="pemeriksaan.php?hapus=<?= $row['id'] ?>" 
                       class="btn hapus"
                       onclick="return confirm('Yakin ingin hapus data?')">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>