<?php
include_once 'includes/database.php';
include_once('includes/config.php');
include_once('controller/QuestionController.php');
$total_minutes = 60;
$time_started = $_SESSION['start_time'];
$current_time = date("Y-m-d H:i:s");
$time_left =  strtotime($time_started) - strtotime($current_time);
$time_left = ($total_minutes - $time_left) / 60;
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

                            <div class="page-title">
                                <span class="breadcrumb-item active">Time Left:</span>
                                <ol class="breadcrumb m-0">
                                    <span style="color:#fff;" id="demo"></span>
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
                        <div class="col-xl-12 mb-3 mt-3">
                            <!-- <button type="button" class="btn btn-danger">Intelligence Area</button> -->


                            <center><video id="video" width="320" height="240" autoplay></video><br><br>
                                <div id="texto" class="header_title">
                                    <p style="color:red;">AI video capturing started</p>
                                </div>
                            </center><br>

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
                                                        <h6 class="text-muted text-black" style="color:#000000;">
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
                                                <button type="submit" id="submit" class="btn btn-primary" name="submit_exam">Submit</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <!-- end confirmation modal -->
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

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63999707b0d6371309d45ae9/1gk7vbu91';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <script>
        // get php variable 
        var time = "<?php echo 3600000 - $time_left; ?>";
        // Set the date we're counting down to be 2 minutes from now
        var countDownDate = new Date().getTime() + 60000 * time;

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("demo").innerHTML = hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is finished, submit the form
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                document.getElementById("submit").click();
            }
        }, 1000);
    </script>

    <script>
        $(function() {
            $("#texto").hide();
        });

        var i = 0;
        // warning array 
        var warning = ['...detecting login record (fetching result)',
            '...recording number of tabs (fetching results)',
            '...comparing image AI on video (submitting results)',
            '....zigzag (parallel periodic array-submission'
        ]
        setInterval(function() {
            $("#texto").fadeIn(2000).delay(5000);
            $("#texto").fadeOut(2000, function() {
                $("#texto").html("<p style='color:red'>" + warning[i] + "</p>");
                i++;
            });
            if (i == warning.length) {
                i = 0;
            }
        }, 2000);
    </script>

</body>

</html>