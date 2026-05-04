<?php
include 'config.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_obat'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    mysqli_query($conn, "INSERT INTO obat VALUES('', '$nama', '$stok', '$harga')");
    header("Location: obat.php");
}
?>

<h2>Data Obat</h2>

<form method="POST">
    <input type="text" name="nama_obat" placeholder="Nama Obat" required><br>
    <input type="number" name="stok" placeholder="Stok"><br>
    <input type="number" name="harga" placeholder="Harga"><br>
    <button name="simpan">Simpan</button>
</form>

<hr>

<table border="1">
<tr>
    <th>No</th>
    <th>Nama Obat</th>
    <th>Stok</th>
    <th>Harga</th>
</tr>

<?php
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM obat");

while ($d = mysqli_fetch_array($data)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama_obat'] ?></td>
    <td><?= $d['stok'] ?></td>
    <td><?= $d['harga'] ?></td>
</tr>
<?php } ?>
</table>
