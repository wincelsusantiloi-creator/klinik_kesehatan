<?php
include 'config.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    mysqli_query($conn, "
        INSERT INTO dokter
        (nama, spesialis, hari, jam_mulai, jam_selesai)
        VALUES
        ('$nama','$spesialis','$hari','$jam_mulai','$jam_selesai')
    ");

    header("Location: dokter.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($conn, "
        DELETE FROM dokter
        WHERE id='$id'
    ");

    header("Location: dokter.php");
    exit;
}

// UPDATE DATA
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    mysqli_query($conn, "
        UPDATE dokter SET
        nama='{$_POST['nama']}',
        spesialis='{$_POST['spesialis']}',
        hari='{$_POST['hari']}',
        jam_mulai='{$_POST['jam_mulai']}',
        jam_selesai='{$_POST['jam_selesai']}'
        WHERE id='$id'
    ");

    header("Location: dokter.php");
    exit;
}

// EDIT
$edit = null;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $ambil = mysqli_query($conn, "
        SELECT * FROM dokter
        WHERE id='$id'
    ");

    $edit = mysqli_fetch_assoc($ambil);
}
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
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
    box-shadow:0 10px 30px rgba(0,0,0,.2);
}

h2{
    text-align:center;
    margin-bottom:20px;
}

.menu{
    margin-bottom:20px;
}

.menu a{
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
    color:white;
    margin-right:10px;
}

.logout{
    background:red;
}

.kembali{
    background:green;
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
    cursor:pointer;
}

table{
    width:100%;
    margin-top:25px;
    border-collapse:collapse;
}

th{
    background:#4facfe;
    color:white;
}

th, td{
    padding:12px;
    text-align:center;
}

td{
    border-bottom:1px solid #ddd;
}

.edit,
.hapus{
    padding:7px 12px;
    color:white;
    border-radius:6px;
    text-decoration:none;
}

.edit{
    background:orange;
}

.hapus{
    background:red;
}

</style>
</head>

<body>

<div class="container">

<h2>🩺 Data Dokter Klinik</h2>

<div class="menu">
    <a href="logout.php" class="logout">Logout</a>
    <a href="dashboard.php" class="kembali">Kembali ke Dashboard</a>
</div>

<form method="POST">

<?php if($edit): ?>
<input type="hidden" name="id" value="<?= $edit['id'] ?>">
<?php endif; ?>

<div class="input-group">
<input
type="text"
name="nama"
placeholder="Nama Dokter"
value="<?= $edit['nama'] ?? '' ?>"
required>
</div>

<div class="input-group">
<input
type="text"
name="spesialis"
placeholder="Spesialis"
value="<?= $edit['spesialis'] ?? '' ?>">
</div>

<div class="input-group">
<input
type="text"
name="hari"
placeholder="Hari Praktik"
value="<?= $edit['hari'] ?? '' ?>">
</div>

<div class="input-group">
<input
type="time"
name="jam_mulai"
value="<?= $edit['jam_mulai'] ?? '' ?>">
</div>

<div class="input-group">
<input
type="time"
name="jam_selesai"
value="<?= $edit['jam_selesai'] ?? '' ?>">
</div>

<button name="<?= $edit ? 'update' : 'simpan' ?>">
<?= $edit ? 'Update Data' : 'Simpan Data' ?>
</button>

</form>

<table>

<tr>
<th>No</th>
<th>Nama</th>
<th>Spesialis</th>
<th>Hari</th>
<th>Jam Mulai</th>
<th>Jam Selesai</th>
<th>Aksi</th>
</tr>

<?php
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM dokter");

while ($d = mysqli_fetch_assoc($data)):
?>

<tr>

<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['spesialis'] ?></td>
<td><?= $d['hari'] ?></td>
<td><?= substr($d['jam_mulai'],0,5) ?></td>
<td><?= substr($d['jam_selesai'],0,5) ?></td>

<td>
<a class="edit" href="dokter.php?edit=<?= $d['id'] ?>">
Edit
</a>

<a
class="hapus"
href="dokter.php?hapus=<?= $d['id'] ?>"
onclick="return confirm('Yakin ingin hapus data?')">
Hapus
</a>
</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</body>
</html>