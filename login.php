<?php
require 'function.php';


//cek login, terdaftar atau enggak
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //mencocokan ke database, cari .... ada atau enggak datanya
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where username='$username' and password='$password'");
    //hitung jumlah data
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        //kalau data ditemukan
        $ambildatarole = mysqli_fetch_array($cekdatabase);
        $role = $ambildatarole['role'];

        if ($role == 'admin') {
            //kalau dia admin 
            $_SESSION['log'] = 'true';
            $_SESSION['role'] = 'Admin';
            header('location:index.php');
        } elseif ($role == "kepsek") {
            //kalau dia user 
            $_SESSION['log'] = 'true';
            $_SESSION['role'] = 'kepsek';
            header('location:index_kepsek.php');
        } elseif ($role == "siswa") {
            //kalau dia user 
            $_SESSION['log'] = 'true';
            $_SESSION['role'] = 'siswa';
            header('location:index_siswa.php');
        };
    } else {
        header('location:index.php');
    };
};





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="login-bg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body.login-bg {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #1e3c72, #2a5298, #00C9FF, #92FE9D);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            padding: 1.5rem;
            color: #fff;
        }

        .glass-card .card-header, .glass-card .card-footer {
            border-bottom: none;
            border-top: none;
            background: transparent;
        }

        .login-logo {
            width: 85px;
            margin-bottom: 15px;
            filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.2));
            background: white;
            border-radius: 50%;
            padding: 5px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 12px;
            padding: 15px;
            color: #333;
        }

        .form-control:focus {
            background: #fff;
            box-shadow: 0 0 15px rgba(255,255,255,0.6);
            outline: none;
        }

        .btn-glass {
            background: linear-gradient(45deg, #ff7e5f, #feb47b);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 12px;
            transition: 0.3s all;
            width: 100%;
            box-shadow: 0 4px 15px rgba(255, 126, 95, 0.4);
        }

        .btn-glass:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 126, 95, 0.6);
            color: white;
        }
        
        label {
            color: #f8f9fa;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .title-text {
            color: #fff; 
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .subtitle-text {
            color: #e0e0e0;
            font-weight: 300;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }
    </style>

    <div id="layoutAuthentication" style="width: 100%;">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card glass-card mt-4">
                                <div class="card-header text-center pb-0">
                                    <img src="images/foto1.png" class="login-logo" alt="Logo SMKN 1 Binuang">
                                    <h4 class="title-text">SMKN 1 BINUANG</h4>
                                    <p class="subtitle-text small mb-0">Sistem Informasi Manajemen Barang Daerah (BMD)</p>
                                </div>
                                <div class="card-body mt-3">
                                    <form method="post">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Username</label>
                                            <input class="form-control py-4" name="username" id="inputEmailAddress" type="text" placeholder="Masukkan Username Anda" required />
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Masukkan Password Anda" required />
                                        </div>
                                        <div class="form-group mt-4 pt-2 mb-0">
                                            <button class="btn btn-glass" name="login">L O G I N</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>