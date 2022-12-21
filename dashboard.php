<?php
include_once('includes/database.php');
include_once('includes/config.php');
include_once('controller/QuestionController.php');
?>
<!doctype html>
<html lang="en">
<?php
$title = "Dashboard | CBT - Computer Based Test";
include "layout/head.php";
?>
<!-- <script defer>
    window.open("dashboard.php",null, "width=850, height=450, directories=no, menubar=no, resizable=no, scrollbars=no, status=no, toolbar=no, directories=no");
</script> -->

<body data-layout="horizontal" data-topbar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include "layout/top-nav.php"; ?>
        <div class="collapse show dash-content" id="dashtoggle">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <a href="https://tawk.to/fushsi" target="new">
                                        <li class="breadcrumb-item active">Live Chat</li>
                                    </a>
                                </ol>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>

        </header>
        <div class="hori-overlay"></div>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3">Welcome to CBT Portal</h4>
                                    <div class="mt-3">
                                        <!-- <h3 class="text-muted text-black">Please note that you can only take the test once. If you have taken the test, you can not take it again.</h3> -->
                                        <p class="font-size-15 mb-1">Hi <?php echo $name; ?>.</p>
                                        <p class="font-size-15"><b>Jamb Registration Number:</b> <?php echo $user_id; ?></p>
                                        <p class="font-size-15"><b>Email:</b> <?php echo $email; ?></p>
                                        <p class="font-size-15"><b>Phone:</b> <?php echo $phone; ?></p>
                                        <marquee scrollamount="5">
                                            <p style="color:red"> WARNING: This is a sensitive zone, be cautious. By clicking the START EXAMINATION, the system detects EVENTS e.g number of tabs opening, your clicks, sounds, video etc. When prompted to use video, kindly allow your PC to use cam, else you get an invalid submission.</p>
                                        </marquee>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="row continer">
                                <?php
                                $examinations = getExaminations();
                                foreach ($examinations as $examination) {
                                ?>
                                    <div class="col-xl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3"><?php echo $examination['subject']; ?></h5>
                                                <div class="mt-3">
                                                    <p><?php echo $examination['total_number_of_question'] ?> Questions</p>
                                                    <p><?php echo $examination['duration'];
                                                        if (!isset($_SESSION['start_time'])) {
                                                            $_SESSION['start_time'] = date("Y-m-d H:i:s");
                                                        }
                                                        ?> Minutes</p>
                                                    <input type="hidden" name="examination_id" value="<?php echo $examination['id']; ?>">
                                                    <input type="hidden" name="subject" value="<?php echo $examination['subject']; ?>">
                                                    <?php
                                                    if (IsSubmited($user_id, $examination['id']) == 1) {
                                                        echo '<button type="button" disabled class="btn btn-primary mt-5">Submitted</button> ';
                                                    } else {
                                                    ?>
                                                        <a href="examination.php?exam=<?php echo $examination['total_number_of_question']; ?>&id=<?php echo $examination['id']; ?>&time=<?php echo $examination['duration']; ?>" type="submit" name="start_exam" class="btn btn-primary mt-5">Start Examination</a>
                                                    <?php
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div><!-- end row -->


                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; CBT Federal University of Health Sciences Ila Orangun.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Developed By <i class="mdi mdi-heart text-danger"></i> by <a href="#" target="_blank">Lead Technologies Limited</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- profile init -->
    <script src="assets/js/pages/profile.init.js"></script>
    <!-- app js -->
    <script src="assets/js/app.js"></script>

    <script>
        $("body").on("click", "a[data-href]", function() {
            var href = $(this).data("href");
            if (href) {
                location.href = href;
            }
        });
    </script>
    <script>
        // avoid right click on page and inspect element 
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey &&
                (e.keyCode === 67 ||
                    e.keyCode === 86 ||
                    e.keyCode === 85 ||
                    e.keyCode === 117)) {
                alert('not allowed');
                return false;
            } else {
                return true;
            }
        });
    </script>
    <script>
        // avoid opening new tab 
        window.onbeforeunload = function() {
            return "Dude, are you sure you want to leave? Think of the kittens!";
        };
        
    </script>


</body>

</html>