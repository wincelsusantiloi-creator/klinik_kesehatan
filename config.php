<?php
$conn = mysqli_connect("localhost", "root", "", "klinik_kesehatan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
