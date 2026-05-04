<?php 
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password='$pass'");
    
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['login'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $error = "Login gagal!";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <form method="POST">
        <h2>Login Klinik</h2>

        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

        <p class="link">Belum punya akun? <a href="register.php">Daftar</a></p>
    </form>
</div>
