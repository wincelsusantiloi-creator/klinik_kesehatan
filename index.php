<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Klinik</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            margin: 0;
        }

        .header {
            background: #2c7be5;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            padding: 30px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            width: 200px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .card-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .logout {
            position: absolute;
            right: 20px;
            top: 15px;
            background: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Dashboard Klinik Kesehatan</h2>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="container">

    <div class="card">
        <div class="card-icon">👨‍⚕️</div>
        <a href="dokter.php">Data Dokter</a>
    </div>

    <div class="card">
        <div class="card-icon">💊</div>
        <a href="obat.php">Data Obat</a>
    </div>

    <div class="card">
        <div class="card-icon">🧑‍🤝‍🧑</div>
        <a href="pasien.php">Data Pasien</a>
    </div>

    <div class="card">
        <div class="card-icon">📋</div>
        <a href="pemeriksaan.php">Pemeriksaan</a>
    </div>

</div>

</body>
</html>
