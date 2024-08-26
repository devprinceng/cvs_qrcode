<?php
session_start();
error_reporting(1);
include('includes/dbconnection.php');

if (strlen($_SESSION['OBCMSuid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $uid = $_SESSION['OBCMSuid'];
        $FullName = $_POST['FullName'];
        $camname = $_POST['camname']; // Add this line to define $camname
        $camloc = $_POST['camloc'];
        $department = $_POST['department'];
        $faculty = $_POST['faculty'];
        $ayr = $_POST['ayr'];
        $gyr = $_POST['gyr'];
        $regnumber = mt_rand(100000000, 999999999);

        //check if user application is available on DB
        // Check if the details already exist in the database
        $ret = "SELECT * from tblapplication where ayr=:ayr AND gyr=:gyr AND camname=:camname AND camloc=:camloc";
        $query = $obcms->prepare($ret);
        $query->bindParam(':ayr', $ayr, PDO::PARAM_STR);
        $query->bindParam(':gyr', $gyr, PDO::PARAM_STR);
        $query->bindParam(':camname', $camname, PDO::PARAM_STR);
        $query->bindParam(':camloc', $camloc, PDO::PARAM_STR);

        // Directory where the uploaded files will be saved
        $uploadDir = 'uploads/';

        // Maximum file size (5 MB in bytes)
        $maxFileSize = 5 * 1024 * 1024;

        // Check if the form was submitted
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if the file was uploaded without errors
        if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] == UPLOAD_ERR_OK) {
            // Get file information
            $fileTmpPath = $_FILES['certificate']['tmp_name'];
            $fileName = $_FILES['certificate']['name'];
            $fileSize = $_FILES['certificate']['size'];
            $fileType = $_FILES['certificate']['type'];
            $fileNameCmps = explode('.', $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Allowed file extensions
            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            // Validate file size
            if ($fileSize > $maxFileSize) {
                die('Error: File size exceeds the maximum limit of 5MB.');
            }

            // Validate file extension
            if (!in_array($fileExtension, $allowedExtensions)) {
                die('Error: Unsupported file type.');
            }

            // Create upload directory if it does not exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Move the file to the upload directory
            $destination = $uploadDir . time() . '-' . basename($fileName);

            if (move_uploaded_file($fileTmpPath, $destination)) {
                // echo 'File is successfully uploaded.';

                //continue with application query
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() == 0) {

                    // Insert new details into the database
                    $sql = "insert INTO tblapplication(UserID, RegistrationID, FullName, camname, camloc, Department, Faculty, ayr, gyr, certificate) VALUES (:uid, :regnumber, :FullName, :camname, :camloc, :department, :faculty, :ayr, :gyr, :certificate)";
                    $query = $obcms->prepare($sql);
                    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                    $query->bindParam(':regnumber', $regnumber, PDO::PARAM_STR);
                    $query->bindParam(':FullName', $FullName, PDO::PARAM_STR);
                    $query->bindParam(':camname', $camname, PDO::PARAM_STR);
                    $query->bindParam(':camloc', $camloc, PDO::PARAM_STR);
                    $query->bindParam(':department', $department, PDO::PARAM_STR);
                    $query->bindParam(':faculty', $faculty, PDO::PARAM_STR);
                    $query->bindParam(':ayr', $ayr, PDO::PARAM_STR);
                    $query->bindParam(':gyr', $gyr, PDO::PARAM_STR);
                    $query->bindParam(':certificate', $destination, PDO::PARAM_STR);

                    $query->execute();
                    $LastInsertId = $obcms->lastInsertId();

                    if ($LastInsertId > 0) {
                        echo '<script>alert("Details have been added successfully.")</script>';
                        echo "<script>window.location.href ='fill-birthregform.php'</script>";
                    } else {
                        echo '<script>alert("Something went wrong. Please try again.")</script>';
                    }
                } else {
                    echo "<script>alert('The details are already in the system. Please try again.');</script>";
                }
            } else {
                echo 'Error: There was an issue uploading your file.';
            }
        } else {
            echo 'Error: No file uploaded or there was an upload error.';
        }
    }
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Certificate Form | Certificate Verification and Authentication System</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/modals.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/form/all-type-forms.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="materialdesign">
    <div class="wrapper-pro">
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/header.php'); ?>
        <div class="breadcome-area mg-b-30 small-dn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcome-list shadow-reset">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="breadcome-menu">
                                        <li><a href="dashboard.php">Home</a> <span class="bread-slash">/</span></li>
                                        <li><span class="bread-blod">Registration Form</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="basic-form-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sparkline12-list shadow-reset mg-t-30">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Certificate Form</h1>
                                    <div class="sparkline12-outline-icon">
                                        <span class="sparkline12-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                        <span><i class="fa fa-wrench"></i></span>
                                        <span class="sparkline12-collapse-close"><i class="fa fa-times"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="all-form-element-inner">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="login2 pull-right pull-right-pro">Student Names</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control" name="FullName" value="" required="true" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="login2 pull-right pull-right-pro">Campus Name</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control" name="camname" value="" required="true" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="login2 pull-right pull-right-pro">Campus Location</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control" name="camloc" value="" required="true" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="login2 pull-right pull-right-pro">Department</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <select id="departmentSelect" name="department" class="form-control">
                                                                    <option value="computerScience">Choose Department</option>
                                                                    <option value="computerScience">Computer Science</option>
                                                                    <option value="engineering">Engineering</option>
                                                                    <option value="business">Business Administration</option>
                                                                    <option value="biology">Biology</option>
                                                                    <option value="chemistry">Chemistry</option>
                                                                    <option value="physics">Physics</option>
                                                                    <option value="mathematics">Mathematics</option>
                                                                    <option value="english">English</option>
                                                                    <option value="history">History</option>
                                                                    <option value="psychology">Psychology</option>
                                                                    <option value="sociology">Sociology</option>
                                                                    <option value="economics">Economics</option>
                                                                    <option value="education">Education</option>
                                                                    <option value="nursing">Nursing</option>
                                                                    <option value="art">Art</option>
                                                                    <option value="music">Music</option>
                                                                    <option value="philosophy">Philosophy</option>
                                                                    <option value="politicalScience">Political Science</option>
                                                                    <option value="environmentalScience">Environmental Science</option>
                                                                    <option value="anthropology">Anthropology</option>
                                                                    <option value="communication">Communication Studies</option>
                                                                    <option value="law">Law</option>
                                                                    <option value="medicine">Medicine</option>
                                                                    <option value="publicHealth">Public Health</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="login2 pull-right pull-right-pro">Faculty</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <select id="facultySelect" name="faculty" class="form-control">
                                                                    <option value="arts">Choose Faculty</option>
                                                                    <option value="arts">Faculty of Arts</option>
                                                                    <option value="science">Faculty of Science</option>
                                                                    <option value="engineering">Faculty of Engineering</option>
                                                                    <option value="business">Faculty of Business</option>
                                                                    <option value="education">Faculty of Education</option>
                                                                    <option value="law">Faculty of Law</option>
                                                                    <option value="medicine">Faculty of Medicine</option>
                                                                    <option value="nursing">Faculty of Nursing</option>
                                                                    <option value="environment">Faculty of Environmental Studies</option>
                                                                    <option value="socialScience">Faculty of Social Sciences</option>
                                                                    <option value="pharmacy">Faculty of Pharmacy</option>
                                                                    <option value="health">Faculty of Health Sciences</option>
                                                                    <option value="humanities">Faculty of Humanities</option>
                                                                    <option value="informationTech">Faculty of Information Technology</option>
                                                                    <option value="communication">Faculty of Communication</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="login2 pull-right pull-right-pro">Admission Year</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control" name="ayr" value="" required="true" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="login2 pull-right pull-right-pro">Graduation Year</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="text" class="form-control" name="gyr" value="" required="true" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- certificate upload -->
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label class="certificate pull-right pull-right-pro">Upload Certificate</label>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <input type="file" class="form-control" name="certificate" value="" required="true" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3"></div>
                                                            <div class="col-lg-9">
                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit">Add Details</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php'); ?>
    </div>
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.meanmenu.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/dropzone.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/data-table-act.js"></script>
    <script src="js/main.js"></script>
</body>

</html>