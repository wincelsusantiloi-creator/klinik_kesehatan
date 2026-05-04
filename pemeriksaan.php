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
?>

<h2>Pemeriksaan</h2>

<form method="POST">
    <select name="pasien">
        <?php
        $p = mysqli_query($conn, "SELECT * FROM pasien");
        while ($d = mysqli_fetch_array($p)) {
            echo "<option value='$d[id]'>$d[nama]</option>";
        }
        ?>
    </select><br>

    <select name="dokter">
        <?php
        $d = mysqli_query($conn, "SELECT * FROM dokter");
        while ($dok = mysqli_fetch_array($d)) {
            echo "<option value='$dok[id]'>$dok[nama]</option>";
        }
        ?>
    </select><br>

    <input type="date" name="tanggal"><br>
    <textarea name="keluhan" placeholder="Keluhan"></textarea><br>

    <button name="simpan">Simpan</button>
</form>

<hr>

<table border="1">
<tr>
    <th>No</th>
    <th>Pasien</th>
    <th>Dokter</th>
    <th>Tanggal</th>
    <th>Keluhan</th>
</tr>

<?php
$no = 1;
$data = mysqli_query($conn, "
SELECT p.nama as pasien, d.nama as dokter, pm.tanggal, pm.keluhan
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
</tr>
<?php } ?>
</table>
