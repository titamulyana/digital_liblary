<!doctype html>
<html lang="en">
<?php include('../layout/header.php');?>
<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    .h-custom {
        height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>
<body>
<?php
    include('../controllers/user_controller.php');
    
    static $result_id = "";                         
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        static $result_username = "";

        $login = user_controller::login($username,$password);
        list($status,$user) = $login;
        while ($row = mysqli_fetch_assoc($user)) {
            $result_username = $row["username"];
            $result_id = $row["id"];
        }

        setcookie("username", $result_username, time() + 3600);
        setcookie("user_id", $result_id, time() + 3600);

        if($status = 'sukses') {
            header("Location: /admin/book_list.php");
        } else {
            header("Location: /admin/login.php");
        }

    }

?>
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                     class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <?php 
                if($status == "sukses") {
                ?>
                    <div class="alert alert-primary" role="alert"> 
                        <h3>Berhasil login</h3>
                    </div>
                <?php
                }
                ?>
                <?php 
                if($status == "gagal") {
                ?>
                    <div class="alert alert-danger" role="alert"> 
                        <h3>Gagal login</h3>
                        <p>periksa kembali username dan password</p>
                    </div>
                <?php
                }
                ?>
                <form action="" method="post">
                    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                        <h1 class="lead fw-normal mb-0 me-3">Selamat datang di Digital Liblary</h1>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mt-3 mb-4">
                        <input required type="text" maxlength="20" name="username" id="username" class="form-control form-control-lg"
                               placeholder="masukan username" />
                        <label class="form-label" for="form3Example3">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input required type="password" id="password" name="password" class="form-control form-control-lg"
                               placeholder="masukan password" />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" name="login" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Tidak punya akun? <a href="/admin/register.php"
                                                                                          class="link-danger">Register</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php include('../layout/footer.php'); ?>
</section>
</body>
</html>
