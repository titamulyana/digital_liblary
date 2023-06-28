<!doctype html>
<html lang="en">
<?php include('../layout/header.php') ?>
<body>
<?php
    include('../controllers/user_controller.php');

    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $create_user = user_controller::create($username,$password);

        $status = $create_user;
    }
?>

    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <?php 
                            if($status == "sukses") {
                            ?>
                                <div class="alert alert-primary" role="alert"> 
                                    <h3>Berhasil register</h3>
                                    <p>silahkan melakukan login</p>
                                </div>
                            <?php
                            }
                            ?>
                            <?php 
                            if($status == "gagal") {
                            ?>
                                <div class="alert alert-danger" role="alert"> 
                                    <h3>Gagal register</h3>
                                    <p>silahkan mencoba kembali</p>
                                </div>
                            <?php
                            }
                            ?>
                            <h3 class="mb-5">Register</h3>
                            <form action="" method="post">

                                <div class="form-outline mb-4">
                                    <input required type="text" id="username" name="username" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX-2">Username</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input required type="password" id="password" name="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX-2">Password</label>
                                </div>
                                <div class="text-center text-lg-center mt-4 pt-2">
                                    <button type="submit" name="register" class="btn btn-primary btn-lg"
                                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                                    <p class="small fw-bold mt-2 pt-1 mb-0">Sudah punya akun? <a href="/admin/login.php"
                                    class="link-danger">Login</a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../layout/footer.php') ?>
    </section>
</body>
</html>

