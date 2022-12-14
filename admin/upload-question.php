<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<?php
session_start();
$title = 'Upload | CBT FUHSI Dashboard';
include 'includes/head.php';
include '../includes/database.php';
include 'islogin.php';
?>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include 'includes/header.php'; ?>

        <!-- ========== App Menu ========== -->
        <?php include 'includes/navbar.php'; ?>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Upload Questions</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Upload Questions</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <!-- error or success alart -->
                                <?php
                                // error or success alart using get method 
                                if (isset($_GET['type'])) {
                                    if ($_GET['type'] == 'success') {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Well done!</strong> ' . $_GET['msg'] . '
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                    } else {
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Oh snap!</strong> ' . $_GET['msg'] . '
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                    }
                                }
                                ?>
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Upload Questions</h4>
                                </div><!-- end card header -->
                                <div class="card-body mt-4">
                                    <div class="live-preview">
                                        <form action="controller/GeneralController.php" method="post" enctype="multipart/form-data">
                                            <div class="row gy-4">
                                                <!-- upload question -->
                                                <div class="container">
                                                    <!--end col-->
                                                    <div class="col-xxl-12 col-md-6">
                                                        <div>
                                                            <label for="basiInput" class="form-label">Select Subject</label>
                                                            <select class="form-select mb-3" aria-label="Default select example" required name="examination_id">
                                                                <option selected>Select your Status </option>
                                                                <?php
                                                                include '../includes/database.php';
                                                                $SelectSubject = "SELECT * FROM examinations";
                                                                $SelectSubjectQuery = mysqli_query($dbconnect, $SelectSubject);
                                                                while ($SelectSubjectRow = mysqli_fetch_array($SelectSubjectQuery)) {
                                                                    $SubjectName = $SelectSubjectRow['subject'];
                                                                    $SubjectId = $SelectSubjectRow['id'];
                                                                    echo "<option value='$SubjectId'>$SubjectName</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-12 col-md-6">
                                                        <div>
                                                            <label for="basiInput" class="form-label">Questions <code>note this must be excel file *</code></label>
                                                            <input type="file" name="file" class="form-control" id="basiInput" required>
                                                        </div>
                                                    </div>
                                                    <!-- submit button -->
                                                    <div class="col-xxl-2 col-md-6 mt-5">
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary" name="upload_question" type="submit">Upload</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--end row-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->


                </div> <!-- container-fluid -->
            </div><!-- End Page-content -->

            <?php echo include "includes/footer.php"; ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- prismjs plugin -->
    <script src="assets/libs/prismjs/prism.js"></script>

    <script src="assets/js/app.js"></script>

</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/forms-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Dec 2022 11:14:49 GMT -->

</html>