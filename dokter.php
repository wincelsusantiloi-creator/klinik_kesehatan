<?php
include 'config.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];

    mysqli_query($conn, "INSERT INTO dokter VALUES('', '$nama', '$spesialis')");
    header("Location: dokter.php");
}
?>

<h2>Data Dokter</h2>

<form method="POST">
    <input type="text" name="nama" placeholder="Nama Dokter" required><br>
    <input type="text" name="spesialis" placeholder="Spesialis"><br>
    <button name="simpan">Simpan</button>
</form>

<hr>

<table border="1">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Spesialis</th>
</tr>

<?php
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM dokter");

while ($d = mysqli_fetch_array($data)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama'] ?></td>
    <td><?= $d['spesialis'] ?></td>
</tr>
<?php } ?>
</table>
