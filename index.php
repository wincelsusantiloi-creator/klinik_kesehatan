<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Klinik Sehat</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:linear-gradient(-45deg,#eff6ff,#dbeafe,#bfdbfe,#eff6ff);
    background-size:400% 400%;
    animation:gradientBG 12s ease infinite;
    overflow-x:hidden;
}

/* Background Blur */
.circle{
    position:fixed;
    border-radius:50%;
    filter:blur(100px);
    z-index:-1;
}

.c1{
    width:300px;
    height:300px;
    background:#60a5fa;
    top:50px;
    left:-100px;
    animation:move1 10s infinite alternate;
}

.c2{
    width:350px;
    height:350px;
    background:#93c5fd;
    bottom:-100px;
    right:-100px;
    animation:move2 12s infinite alternate;
}

/* Navbar */
nav{
    background:rgba(37,99,235,.9);
    backdrop-filter:blur(15px);
    color:white;
    padding:18px 60px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:sticky;
    top:0;
    z-index:1000;
    box-shadow:0 5px 20px rgba(0,0,0,.1);
}

nav h2{
    font-size:28px;
}

nav a{
    color:white;
    text-decoration:none;
    margin-left:20px;
    font-weight:600;
    transition:.3s;
}

nav a:hover{
    color:#dbeafe;
}


.hero{
    min-height:90vh;
    display:flex;
    justify-content:space-around;
    align-items:center;
    padding:60px;
    flex-wrap:wrap;
    animation:fadeIn 1s ease;
}

.hero-text{
    max-width:550px;
}

.hero-text h1{
    font-size:55px;
    color:#2563eb;
    margin-bottom:20px;
}

.hero-text p{
    font-size:18px;
    color:#555;
    line-height:1.8;
    margin-bottom:30px;
}

.btn{
    display:inline-block;
    padding:15px 35px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:12px;
    font-weight:bold;
    transition:.3s;
}

.btn:hover{
    transform:translateY(-5px);
    box-shadow:0 0 25px rgba(37,99,235,.5);
}

/* Browser */
.browser{
    width:520px;
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 20px 40px rgba(0,0,0,.15);
    animation:floating 4s ease-in-out infinite;
}

.browser-top{
    background:#e5e7eb;
    padding:12px;
}

.dot{
    width:12px;
    height:12px;
    border-radius:50%;
    display:inline-block;
    margin-right:5px;
}

.red{background:#ef4444;}
.yellow{background:#facc15;}
.green{background:#22c55e;}

.browser-content{
    padding:30px;
}

.dashboard{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
}

.card{
    background:#f8fafc;
    border-radius:15px;
    padding:25px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    transition:.4s;
    cursor:pointer;
}

.card:hover{
    transform:translateY(-10px) scale(1.05);
    box-shadow:0 15px 30px rgba(37,99,235,.25);
}

.card .icon{
    font-size:40px;
}

.card h3{
    color:#2563eb;
    margin:10px 0;
}

/* Features */
.features{
    padding:80px 50px;
    text-align:center;
}

.features h2{
    font-size:36px;
    color:#2563eb;
    margin-bottom:40px;
}

.feature-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
}

.feature-box{
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    transition:.4s;
}

.feature-box:hover{
    transform:translateY(-10px);
    box-shadow:0 15px 30px rgba(37,99,235,.2);
}

.feature-box h3{
    margin:15px 0;
    color:#2563eb;
}

/* Footer */
footer{
    background:#2563eb;
    color:white;
    text-align:center;
    padding:25px;
    margin-top:50px;
}

/* Animations */
@keyframes floating{
    0%{transform:translateY(0);}
    50%{transform:translateY(-15px);}
    100%{transform:translateY(0);}
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@keyframes gradientBG{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

@keyframes move1{
    from{transform:translateY(0);}
    to{transform:translateY(120px);}
}

@keyframes move2{
    from{transform:translateY(0);}
    to{transform:translateY(-120px);}
}

@media(max-width:768px){

    nav{
        padding:15px 20px;
    }

    .hero{
        padding:30px;
        text-align:center;
    }

    .hero-text h1{
        font-size:40px;
    }

    .browser{
        width:100%;
        margin-top:40px;
    }
}
</style>
</head>

<body>

<div class="circle c1"></div>
<div class="circle c2"></div>

<nav>
    <h2>🏥 Klinik Kesehatan</h2>

    <div>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</nav>

<section class="hero">

    <div class="hero-text">
        <h1>Sistem Informasi Klinik Modern</h1>

        <p>
            Kelola data pasien, dokter, obat, dan pemeriksaan
            secara cepat, aman, dan efisien dalam satu platform
            digital yang modern dan mudah digunakan.
        </p>

        <a href="login.php" class="btn">
            Masuk Sekarang
        </a>
    </div>

    <div class="browser">

        <div class="browser-top">
            <span class="dot red"></span>
            <span class="dot yellow"></span>
            <span class="dot green"></span>
        </div>

        <div class="browser-content">

            <div class="dashboard">

                <div class="card">
                    <div class="icon">👨‍⚕️</div>
                    <h3>Dokter</h3>
                    <p>Kelola data dokter</p>
                </div>

                <div class="card">
                    <div class="icon">🧑‍🤝‍🧑</div>
                    <h3>Pasien</h3>
                    <p>Kelola data pasien</p>
                </div>

                <div class="card">
                    <div class="icon">💊</div>
                    <h3>Obat</h3>
                    <p>Kelola stok obat</p>
                </div>

                <div class="card">
                    <div class="icon">📋</div>
                    <h3>Pemeriksaan</h3>
                    <p>Riwayat pemeriksaan</p>
                </div>

            </div>

        </div>

    </div>

</section>

<section class="features">

    <h2>✨ Fitur Utama</h2>

    <div class="feature-grid">

        <div class="feature-box">
            <h3>📄 Data Pasien</h3>
            <p>Mengelola informasi pasien dengan mudah dan cepat.</p>
        </div>

        <div class="feature-box">
            <h3>👨‍⚕️ Data Dokter</h3>
            <p>Menyimpan dan mengatur data dokter klinik.</p>
        </div>

        <div class="feature-box">
            <h3>💊 Data Obat</h3>
            <p>Mengelola stok dan informasi obat secara realtime.</p>
        </div>

        <div class="feature-box">
            <h3>📋 Pemeriksaan</h3>
            <p>Mencatat hasil pemeriksaan pasien dengan rapi.</p>
        </div>

    </div>

</section>

<footer>
    © 2026 Sistem Informasi Klinik | Project Klinik Kesehatan
</footer>

</body>
</html>