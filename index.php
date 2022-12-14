<!doctype html>
<html lang="en">
<?php
$title = "Login | CBT - Computer Based Test";
include "layout/head.php";
?>

<body class="bg-white">

    <div class="auth-page d-flex align-items-center min-vh-100">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="d-flex flex-column h-100 py-5 px-4">
                        <div class="text-center text-muted mb-2">
                            <div class="pb-3">
                                <a href="index.php">
                                    <span class="logo-lg">
                                        <img src="assets/images/logo.png" alt="" height="24"> <span class="logo-txt">Login</span>
                                    </span>
                                </a>
                                <p class="text-muted font-size-15 w-75 mx-auto mt-3 mb-0">Kindly sign in to access the CBT Portal using your <b>Jamb Registration Number</b> and <b>Email.</b></p>
                            </div>
                        </div>

                        <div class="my-auto">
                            <div class="p-3 text-center">
                                <img src="assets/images/auth-img.png" alt="" class="img-fluid">
                            </div>
                        </div>

                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">© <script>
                                    document.write(new Date().getFullYear())
                                </script> CBT. Federal University of Health Sciences Ila-orangun (FUHSI) </p>
                        </div>
                    </div>

                    <!-- end auth full page content -->
                </div>
                <!-- end col -->

                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg bg-light py-md-5 p-4 d-flex">
                        <div class="bg-overlay-gradient"></div>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center g-0 align-items-center w-100">
                            <div class="col-xl-4 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="px-3 py-3">
                                            <div class="text-center">
                                                <!-- get error message -->
                                                <?php
                                                if (isset($_GET['error'])) {
                                                    $error = $_GET['error'];
                                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <strong>Hoops!</strong> $error
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>";
                                                }
                                                ?>
                                                <h5 class="mb-0">Welcome to FUHSI</h5>
                                                <p class="text-muted mt-2">Sign in to continue the Test.</p>
                                                <p style="color:red;"><b>Only one session is allowed. Sign in only when you are ready to take exam. You are warned</b></p>
                                            </div>
                                            <form class="mt-4 pt-2" action="includes/login_code.php" method="POST">
                                                <div class="form-floating form-floating-custom mb-3">
                                                    <input type="text" name="jamb_registration_number" class="form-control" placeholder="Enter Jamb Registration Number">
                                                    <label for="input-username">Jamb Registration Number</label>
                                                    <div class="form-floating-icon">
                                                        <i class="uil uil-users-alt"></i>
                                                    </div>
                                                </div>
                                                <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                                    <input type="text" name="email_phone" class="form-control" placeholder="Enter Email / Phone Number">
                                                    <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                        <i class="fa fa-eye font-size-18 text-muted"></i>
                                                    </button>
                                                    <label for="password-input">Email/Phone Number</label>
                                                    <div class="form-floating-icon">
                                                        <i class="uil uil-padlock"></i>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-check form-check-primary font-size-16 py-1">
                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <div class="float-end">
                                                        <a href="auth-resetpassword-basic.html" class="text-muted text-decoration-underline font-size-14">Forgot your password?</a>
                                                    </div>
                                                    <label class="form-check-label font-size-14" for="remember-check">
                                                        Remember me
                                                    </label>
                                                </div> -->

                                                <div class="mt-3">
                                                    <button class="btn btn-primary w-100" type="submit" name="login">Log In</button>
                                                </div>

                                            </form><!-- end form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
    <!-- end authentication section -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/pass-addon.init.js"></script>


</body>

</html>