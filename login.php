<?php
session_start();
include 'config.php';

if(isset($_POST['login'])){

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($conn,
    "SELECT * FROM users 
    WHERE username='$user' 
    AND password='$pass'");


    if(mysqli_num_rows($query) > 0){

        $data = mysqli_fetch_assoc($query);

        $_SESSION['login'] = $data['username'];
        $_SESSION['role'] = $data['role'];


        if($data['role']=="admin"){

            header("Location: dashboard.php");

        }else{

            header("Location: dashboard_pasien.php");

        }

        exit;

    }else{

        $error="Login gagal!";

    }

}

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Klinik</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:url('gambar 1.jpg') no-repeat center center/cover;
    position:relative;
    overflow:hidden;
    animation:bgZoom 15s infinite alternate;
}

/* Efek zoom background */
@keyframes bgZoom{
    from{
        background-size:100%;
    }
    to{
        background-size:110%;
    }
}

body::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.45);
    z-index:0;
}

.container{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
    position:relative;
    z-index:1;
}


form{
    width:350px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(10px);
    padding:35px;
    border-radius:20px;
    box-shadow:0 8px 25px rgba(0,0,0,0.3);
    text-align:center;
    border:1px solid rgba(255,255,255,0.2);

    animation:slideUp 1s ease;
}

form h2{
    margin-bottom:25px;
    color:white;
    font-size:30px;
    font-weight:bold;
    animation:floatText 3s ease-in-out infinite;
}

@keyframes floatText{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(-5px);
    }
}

@keyframes slideUp{
    from{
        opacity:0;
        transform:translateY(50px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

input{
    width:100%;
    padding:14px;
    margin:10px 0;
    border:none;
    outline:none;
    border-radius:12px;
    background:rgba(255,255,255,0.2);
    color:white;
    font-size:15px;
    transition:0.3s;
}

input:focus{
    background:rgba(255,255,255,0.3);
    transform:scale(1.03);
    box-shadow:0 0 15px rgba(255,255,255,0.5);
}

input::placeholder{
    color:#eee;
}

button{
    width:100%;
    padding:14px;
    margin-top:15px;
    border:none;
    border-radius:12px;
    background:white;
    color:#2193b0;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}


button:hover{
    background:#2193b0;
    color:white;
    transform:translateY(-3px) scale(1.05);
    box-shadow:0 10px 20px rgba(33,147,176,0.4);
}

button:active{
    transform:scale(0.95);
}

.error{
    background:#ff4d4d;
    color:white;
    padding:10px;
    border-radius:10px;
    margin-bottom:15px;
    font-size:14px;
    animation:shake 0.5s;
}

/* Animasi error */
@keyframes shake{
    0%,100%{transform:translateX(0);}
    25%{transform:translateX(-5px);}
    50%{transform:translateX(5px);}
    75%{transform:translateX(-5px);}
}

.link{
    margin-top:18px;
    color:white;
    font-size:14px;
}

.link a{
    color:#fff;
    font-weight:bold;
    text-decoration:none;
    transition:0.3s;
}

.link a:hover{
    color:#00e5ff;
    text-shadow:0 0 10px #00e5ff;
}

.link a:hover{
    text-decoration:underline;
}
</style>

</head>
<body>

<div class="container">
    <form method="POST">
        <h2>Login Klinik</h2>

        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>

        <p class="link">
            Belum punya akun? 
            <a href="register.php">Daftar</a>
        </p>
    </form>
</div>

</body>
</html>