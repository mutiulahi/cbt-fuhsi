<?php
include_once 'includes/database.php';
include_once('includes/config.php');
include_once('controller/QuestionController.php');
?>
<!doctype html>
<html lang="en">
<?php
$title = "Dashboard | CBT - Computer Based Test";
include "layout/head.php";
?>

<style>
    .unselectable {
        -webkit-user-select: none;
        -webkit-touch-callout: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        /* color: #cc0000; */
    }
    /* Style the form */
    #regForm {
        background-color: #ffffff;
        padding: 40px;
        width: 100%;
        min-width: 300px;
    }

    /* Style the input fields */
    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 20px;
        width: 20px;
        padding: 5px;
        line-height: 10px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    /* Mark the active step: */
    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #04AA6D;
    }
</style>

<body data-layout="horizontal" data-topbar="dark" class="unselectable">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include "layout/top-nav.php"; ?>
        <div class="collapse show dash-content" id="dashtoggle">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Questions</h4>

                            <div class="page-title-right">
                                <span class="breadcrumb-item active">Time Left:</span>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">5</li>
                                    <li class="breadcrumb-item active">5</li>
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
        <!-- <button id="start-camera">Start Camera</button> -->
        <!-- <button id="start-record">Start Recording</button> -->
        <!-- <button id="stop-record">Stop Recording</button> -->
        <!-- <a id="download-video" download="test.webm">Download Video</a> -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-xl-12">
                            <video id="video" width="320" height="240" autoplay></video>
                        </div>
                        <form id="regForm" method="POST" action="controller/SubmitionController.php">
                            <?php
                            if (isset($_GET['exam'])) {
                                $examination_id = $_GET['id'];
                                $exam_number = $_GET['exam'];
                                $count = 0;
                                $questions = getQuestions($examination_id, $exam_number);
                                $size = sizeof($questions);
                                for ($i = 0; $i < $size; $i++) {
                                    $count++;
                                    $question = $questions[$i];

                            ?>
                                    <div class="tab">
                                        <input type="hidden" name="examination_id" value="<?php echo $examination_id; ?>">
                                        <h4 class="card-title mb-3">Question <b><?php echo $count; ?></b></h4>
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="">
                                                        <h6 class="text-muted text-black" style="font-weight: 900;">
                                                            <?php echo $question['question']; ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul class="list-unstyled mb-0 pt-1">
                                                                    <?php
                                                                    $options = getOptions($question['id'], $question['examination_id']);
                                                                    foreach ($options as $option) {
                                                                    ?>
                                                                        <li class="py-1"> <input type="radio" name="<?php echo $question['id']; ?>" value="<?php echo $option['id']; ?>" style="width: 20px; "> <?php echo $option['question_option']; ?></li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php }
                                if ($size > 0) {
                                ?>

                                    <div style="overflow:auto;">
                                        <div style="float:right;">
                                            <button type="button" class="btn btn-success" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                            <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                            <button type="button" class="btn btn-success" id="submitBtn">Submit</button>
                                        </div>
                                    </div>
                                <?php } else {
                                    echo "<center><h3>No Questions Found</h3>
                                    <a href='dashboard.php' class='btn btn-success'>Go Back</a>    
                                    </center>";
                                } ?>
                                <!-- confirmation modal -->
                                <div class="modal fade bs-example-modal-center" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="mySmallModalLabel">Confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to submit the examination</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="submit_exam">Submit</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <!-- end confirmation modal -->

                                <!-- Circles which indicates the steps of the form: -->
                                <div style="text-align:center;margin-top:40px;">
                                    <?php for ($i = 1; $i < $size; $i++) {
                                        echo '<span class="step">' . $i . '</span>';
                                    } ?>

                                </div>
                            <?php } ?>
                        </form>
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
                            </script> &copy; FUHSI.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Computer Base Test</a>
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
    <!-- jquery  -->
    <script src="assets/js/jquery.js"></script>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
        document.getElementById("submitBtn").style.display = "none";

        function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            // submit form if last question is reached 

            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").style.display = "none";
                document.getElementById("submitBtn").style.display = "inline";
                document.getElementById("submitBtn").onclick = function() {
                    $('#confirmationModal').modal('show');
                }
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
                document.getElementById("submitBtn").style.display = "none";
                document.getElementById("nextBtn").style.display = "inline";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n);
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = true;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
        }
    </script>
    <script>
        let camera_button = document.querySelector("#start-camera");
        let video = document.querySelector("#video");
        let start_button = document.querySelector("#start-record");
        let stop_button = document.querySelector("#stop-record");
        let download_link = document.querySelector("#download-video");

        let camera_stream = null;
        let media_recorder = null;
        let blobs_recorded = [];

        // event : start camera on load
        window.addEventListener('load', async function() {
            camera_stream = await navigator.mediaDevices.getUserMedia({
                video: true,
                audio: true
            });
            video.srcObject = camera_stream;
        });

        window.addEventListener('load', function() {
            // set MIME type of recording as video/webm
            media_recorder = new MediaRecorder(camera_stream, {
                mimeType: 'video/webm'
            });

            // event : new recorded video blob available 
            media_recorder.addEventListener('dataavailable', function(e) {
                blobs_recorded.push(e.data);
            });

            // event : recording stopped & all blobs sent
            media_recorder.addEventListener('stop', function() {
                // create local object URL from the recorded video blobs
                let video_local = URL.createObjectURL(new Blob(blobs_recorded, {
                    type: 'video/webm'
                }));
                download_link.href = video_local;
            });

            // start recording with each recorded blob having 1 second video
            media_recorder.start(1000);
        });

        stop_button.addEventListener('click', function() {
            media_recorder.stop();
        });
    </script>

</body>

</html>