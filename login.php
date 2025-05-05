<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password='$pass' AND status='aktif'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == 'admin') {
            header('Location: admin/dashboard.php');
        } elseif ($data['role'] == 'pelanggan') {
            header('Location: user/dashboard_pelanggan.php');
        }
        exit;
    } else {
        echo "<script>alert('Login gagal! Username atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem PDAM</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Login Sistem PDAM</h3>

                    <form method="post">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
