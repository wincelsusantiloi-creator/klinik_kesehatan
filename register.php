<?php
include 'config.php';

if (isset($_POST['register'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    mysqli_query($conn, "INSERT INTO users VALUES('', '$user', '$pass')");
    header("Location: login.php");
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <form method="POST">
        <h2>Register</h2>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Daftar</button>

        <p class="link">Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
</div>
