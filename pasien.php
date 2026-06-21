<?php   
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$data = mysqli_query($conn, "SELECT * FROM pasien");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body{
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            min-height: 100vh;
            padding: 40px;
        }

        .container{
            width: 100%;
            max-width: 1000px;
            margin: auto;
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        h2{
            color: #333;
            font-size: 32px;
        }

        .menu{
            display: flex;
            gap: 10px;
        }

        .menu a{
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            color: white;
            font-size: 14px;
        }

        .kembali{
            background: #007bff;
        }

        .logout{
            background: #dc3545;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 15px;
        }

        th{
            background: #007bff;
            color: white;
            padding: 15px;
            font-size: 16px;
        }

        td{
            padding: 14px;
            text-align: center;
            color: #333;
            background: #f8f9fa;
            border-bottom: 1px solid #ddd;
            transition: 0.3s;
        }

        tr:nth-child(even) td{
            background: #eef4ff;
        }

        tr:hover td{
            background: #dbeafe;
        }

        .btn{
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            display: inline-block;
        }

        .edit{
            background: #28a745;
        }

        .hapus{
            background: #dc3545;
        }

        .btn:hover,
        .menu a:hover{
            opacity: 0.8;
        }

        @media(max-width: 768px){

            body{
                padding: 20px;
            }

            h2{
                font-size: 24px;
            }

            th, td{
                padding: 10px;
                font-size: 14px;
            }

            .header{
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>Data Pasien</h2>

        <div class="menu">
            <a href="index.php" class="kembali">Kembali</a>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php 
        $no = 1;

        while ($row = mysqli_fetch_assoc($data)) {
        ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['no_hp']; ?></td>

            <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn edit">
                    Edit
                </a>

                <a href="hapus.php?id=<?= $row['id']; ?>" 
                   class="btn hapus"
                   onclick="return confirm('Yakin ingin menghapus data?')">
                    Hapus
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>