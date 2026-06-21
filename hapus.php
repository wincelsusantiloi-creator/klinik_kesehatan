<?php 
include 'config.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM pasien WHERE id='$id'");

header("Location: pasien.php");
?>