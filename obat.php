<?php  
include 'config.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_obat'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    mysqli_query($conn, "INSERT INTO obat VALUES('', '$nama', '$stok', '$harga')");
    header("Location: obat.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM obat WHERE id='$id'");
    header("Location: obat.php");
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_obat'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    mysqli_query($conn, "UPDATE obat SET 
        nama_obat='$nama',
        stok='$stok',
        harga='$harga'
        WHERE id='$id'
    ");

    header("Location: obat.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Obat</title>

    <style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    background: linear-gradient(
        135deg,
        #0f172a,
        #1e293b,
        #312e81,
        #0f172a
    );
    background-size:400% 400%;
    animation:bgMove 12s ease infinite;
    padding:40px 20px;
    color:white;
}

@keyframes bgMove{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

.container{
    max-width:1100px;
    margin:auto;
}

.card{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(25px);
    border:1px solid rgba(255,255,255,0.15);
    border-radius:30px;
    padding:35px;
    box-shadow:
    0 20px 40px rgba(0,0,0,.25),
    inset 0 1px 1px rgba(255,255,255,.2);
    animation:showCard 1s ease;
}

@keyframes showCard{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

h2{
    text-align:center;
    font-size:42px;
    margin-bottom:30px;
    font-weight:700;
    background:linear-gradient(
    90deg,
    #38bdf8,
    #818cf8,
    #ec4899
    );
    background-size:200%;
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
    animation:textGlow 4s linear infinite;
}

@keyframes textGlow{
    from{background-position:0%;}
    to{background-position:200%;}
}

form{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:15px;
    margin-bottom:30px;
}

form input{
    padding:15px 18px;
    border:none;
    border-radius:16px;
    background:#ffffff;
    color:#1e293b;
    font-size:15px;
    box-shadow:0 2px 10px rgba(42, 168, 252, 0.08);
}

form input::placeholder{
    color:#64748b;
    opacity:1;
}
button{
    border:none;
    border-radius:16px;
    background:linear-gradient(
        135deg,
        #38bdf8,
        #6366f1,
        #8b5cf6
    );
    color:white;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    transition:.4s;
}

button:hover{
    transform:translateY(-4px);
    box-shadow:0 15px 30px rgba(99,102,241,.4);
}

.menu{
    display:flex;
    gap:12px;
    margin-bottom:25px;
}

.menu a{
    text-decoration:none;
    padding:12px 18px;
    border-radius:14px;
    color:white;
    font-weight:600;
    transition:.4s;
}

.logout{
    background:linear-gradient(135deg,#ef4444,#dc2626);
}

.kembali{
    background:linear-gradient(135deg,#22c55e,#16a34a);
}

.menu a:hover{
    transform:translateY(-3px);
}

.table-container{
    overflow:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:20px;
}

thead{
    background:linear-gradient(
        135deg,
        #38bdf8,
        #6366f1
    );
}

th{
    padding:18px;
    color:white;
}

td{
    padding:16px;
    text-align:center;
    background:rgba(255,255,255,.05);
    border-bottom:1px solid rgba(255,255,255,.08);
}

tbody tr{
    transition:.4s;
}

tbody tr:hover{
    background:rgba(255,255,255,.08);
    transform:scale(1.01);
}

.harga{
    color:#4ade80;
    font-weight:700;
}

.btn{
    padding:9px 14px;
    border-radius:12px;
    text-decoration:none;
    color:white;
    transition:.4s;
}

.edit{
    background:linear-gradient(135deg,#f59e0b,#f97316);
}

.hapus{
    background:linear-gradient(135deg,#ef4444,#dc2626);
}

.btn:hover{
    transform:scale(1.08);
}
    </style>
</head>
<body>

<div class="container">
    <div class="card">

        <h2>💊  Pharmacy Management</h2>

        <div class="menu">
            <a href="logout.php" class="logout">Logout</a>
             <a href="dashboard.php" class="kembali">🏠 Dashboard</a>
        </div>

        <?php
        $edit = null;

        if (isset($_GET['edit'])) {
            $id_edit = $_GET['edit'];
            $ambil = mysqli_query($conn, "SELECT * FROM obat WHERE id='$id_edit'");
            $edit = mysqli_fetch_array($ambil);
        }
        ?>

        <form method="POST">

            <?php if($edit) { ?>
                <input type="hidden" name="id" value="<?= $edit['id'] ?>">
            <?php } ?>

            <input type="text" 
                   name="nama_obat" 
                   placeholder="Masukkan Nama Obat"
                   value="<?= $edit ? $edit['nama_obat'] : '' ?>"
                   required>

            <input type="number" 
                   name="stok" 
                   placeholder="Masukkan Jumlah Stok"
                   value="<?= $edit ? $edit['stok'] : '' ?>">

            <input type="number" 
                   name="harga" 
                   placeholder="Masukkan Harga Obat"
                   value="<?= $edit ? $edit['harga'] : '' ?>">

            <?php if($edit) { ?>
                <button name="update">✏️ Update Data</button>
            <?php } else { ?>
                <button name="simpan">✨ Simpan Data</button>
            <?php } ?>

        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $data = mysqli_query($conn, "SELECT * FROM obat");

                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nama_obat'] ?></td>
                        <td><?= $d['stok'] ?></td>
                        <td class="harga">
                            Rp <?= number_format($d['harga'],0,',','.') ?>
                        </td>

                        <td>
                            <a href="obat.php?edit=<?= $d['id'] ?>" class="btn edit">
                                Edit
                            </a>

                            <a href="obat.php?hapus=<?= $d['id'] ?>" 
                               class="btn hapus"
                               onclick="return confirm('Yakin hapus data?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>

    </div>
</div>

</body>
</html>