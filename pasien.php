<?php
include 'config.php';

$data = mysqli_query($conn, "SELECT * FROM pasien");
?>

<h2>Data Pasien</h2>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>No HP</th>
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
</tr>
<?php } ?>

</table>
