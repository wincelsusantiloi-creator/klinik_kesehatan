<?php 
include 'config.php';

if (isset($_POST['register'])) {

    $user = $_POST['username'];
    $pass = $_POST['password'];

    mysqli_query($conn, "INSERT INTO users VALUES('', '$user', '$pass')");

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Klinik</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg, #2563eb, #1e3a8a);
        }

        .container{
            width:100%;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        form{
            width:380px;
            background:white;
            padding:35px;
            border-radius:20px;
            box-shadow:0 8px 20px rgba(0,0,0,0.2);
            animation:fadeIn 0.5s ease;
        }

        form h2{
            text-align:center;
            margin-bottom:25px;
            color:#2563eb;
            font-size:30px;
        }

        .input-box{
            margin-bottom:20px;
        }

        .input-box input{
            width:100%;
            padding:14px;
            border:1px solid #ccc;
            border-radius:10px;
            outline:none;
            font-size:16px;
            transition:0.3s;
        }

        .input-box input:focus{
            border-color:#2563eb;
            box-shadow:0 0 5px rgba(37,99,235,0.5);
        }

        button{
            width:100%;
            padding:14px;
            border:none;
            background:#2563eb;
            color:white;
            font-size:17px;
            border-radius:10px;
            cursor:pointer;
            transition:0.3s;
            font-weight:bold;
        }

        button:hover{
            background:#1d4ed8;
        }

        .link{
            text-align:center;
            margin-top:18px;
            font-size:15px;
        }

        .link a{
            color:#2563eb;
            text-decoration:none;
            font-weight:bold;
        }

        .link a:hover{
            text-decoration:underline;
        }

        .icon{
            text-align:center;
            font-size:55px;
            margin-bottom:10px;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(-20px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }
        }

    </style>

</head>

<body>

<div class="container">

    <form method="POST">

        <div class="icon">
            🏥
        </div>

        <h2>Register</h2>

        <div class="input-box">
            <input 
                type="text" 
                name="username" 
                placeholder="Masukkan Username"
                required
            >
        </div>

        <div class="input-box">
            <input 
                type="password" 
                name="password" 
                placeholder="Masukkan Password"
                required
            >
        </div>

        <button type="submit" name="register">
            Daftar
        </button>

        <p class="link">
            Sudah punya akun?
            <a href="login.php">Login</a>
        </p>

    </form>

</div>

</body>
</html>