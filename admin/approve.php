<?php
session_start();
//error_reporting(0);
include_once 'includes/dbconnection.php';
include('gh.php');

if (strlen($_SESSION['OBCMSaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['approve_cert'])) {
        $status = $_POST['status'];
        $regid = $_POST['regid'];

        if ($status != 'approved') {
            $status = "REJECTED";
            $remark = "APPLICATION IS REJECTED";
            $sql = "UPDATE tblapplication set Remark =:remark, Status=:status, auth_certificate=:cert where RegistrationID=:regid";
            $query = $obcms->prepare($sql);
            $query->bindParam(':remark', $remark, PDO::PARAM_STR);
            $query->bindParam(':status', $status, PDO::PARAM_STR);
            $query->bindParam(':regid', $regid, PDO::PARAM_STR);
            $query->bindParam(':cert', $certqrcode, PDO::PARAM_STR);
            if ($query->execute()) {
                echo "<script>alert('Application & QRCode Authentication REJECTED.')</script>";
                echo "<script>window.location.href= 'all-birth-application.php'</script>";
                exit;
            }
        }

        //get the user
        $sql = "SELECT * FROM tblapplication where RegistrationID=:regid";
        $query_a = $obcms->prepare($sql);
        $query_a->bindParam(':regid', $regid, PDO::PARAM_STR);
        $query_a->execute();
        $results_a = $query_a->fetchObject();
        $fullname = $results_a->FullName;
        $certificate = "../user/" . $results_a->certificate;
        $regid = $results_a->RegistrationID;
        $department = $results_a->Department;
        $grad_year = $results_a->gyr;

        //generate qrcode and cert.
        $certqrcode = generate($certificate, $fullname, $grad_year, $regid, $department);
        //set REMARK
        $remark = "APPLICATION SUCCESSFUL";
        $status = "APPROVED";
        //update app
        $sql = "UPDATE tblapplication set Remark =:remark, Status=:status, auth_certificate=:cert where RegistrationID=:regid";
        $query = $obcms->prepare($sql);
        $query->bindParam(':remark', $remark, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':regid', $regid, PDO::PARAM_STR);
        $query->bindParam(':cert', $certqrcode, PDO::PARAM_STR);
        if ($query->execute()) {
            echo "<script>alert('Student Application & QRCode Authentication approved Successfully.')</script>";
            echo "<script>window.location.href= 'all-birth-application.php'</script>";
        } else {
            echo "<script>alert('Could not approve Student application')</script>";
        }
    }
?>
    <!doctype html>
    <html class="no-js" lang="en">

    <head>

        <title>Approve Cert. | Certificate Verification and Authentication System</title>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
        <!-- Bootstrap CSS
		============================================ -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Bootstrap CSS
		============================================ -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- adminpro icon CSS
		============================================ -->
        <link rel="stylesheet" href="css/adminpro-custon-icon.css">
        <!-- meanmenu icon CSS
		============================================ -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
        <!-- mCustomScrollbar CSS
		============================================ -->
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
        <!-- animate CSS
		============================================ -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- modals CSS
		============================================ -->
        <link rel="stylesheet" href="css/modals.css">
        <!-- normalize CSS
		============================================ -->
        <link rel="stylesheet" href="css/normalize.css">
        <!-- forms CSS
		============================================ -->
        <link rel="stylesheet" href="css/form/all-type-forms.css">
        <!-- style CSS
		============================================ -->
        <link rel="stylesheet" href="style.css">
        <!-- responsive CSS
		============================================ -->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- modernizr JS
		============================================ -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body class="materialdesign">

        <div class="wrapper-pro">
            <?php include_once('includes/sidebar.php'); ?>
            <?php include_once('includes/header.php'); ?>
            <!-- Breadcome start-->
            <div class="breadcome-area mg-b-30 small-dn">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcome-list shadow-reset">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="dashboard.php">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">approve application</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Form Start -->
            <div class="basic-form-area mg-b-15">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline12-list shadow-reset mg-t-30">
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                        <h1>Approve Application</h1>
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

                                                    <form method="post" name="bwdatesreport" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                                        <input type="hidden" name="regid" value="<?= $_GET['regno'] ?>">
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">Status:</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <select name="status" class="form-control">
                                                                        <option selected>SELECT</option>
                                                                        <option value="approved">APPROVED</option>
                                                                        <option value="rejected">REJECTED</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-3"></div>
                                                                    <div class="col-lg-9">
                                                                        <div class="login-horizental cancel-wp pull-left">

                                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="approve_cert">Approve</button>
                                                                        </div>
                                                                    </div>
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
            <!-- Basic Form End-->

        </div>
        </div>
        <?php include_once('includes/footer.php'); ?>

        <!-- jquery
		============================================ -->
        <script src="js/vendor/jquery-1.11.3.min.js"></script>
        <!-- bootstrap JS
		============================================ -->
        <script src="js/bootstrap.min.js"></script>
        <!-- meanmenu JS
		============================================ -->
        <script src="js/jquery.meanmenu.js"></script>
        <!-- mCustomScrollbar JS
		============================================ -->
        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- sticky JS
		============================================ -->
        <script src="js/jquery.sticky.js"></script>
        <!-- scrollUp JS
		============================================ -->
        <script src="js/jquery.scrollUp.min.js"></script>
        <!-- counterup JS
		============================================ -->
        <script src="js/counterup/jquery.counterup.min.js"></script>
        <script src="js/counterup/waypoints.min.js"></script>
        <!-- modal JS
		============================================ -->
        <script src="js/modal-active.js"></script>
        <!-- icheck JS
		============================================ -->
        <script src="js/icheck/icheck.min.js"></script>
        <script src="js/icheck/icheck-active.js"></script>
        <!-- main JS
		============================================ -->
        <script src="js/main.js"></script>
    </body>

    </html><?php }  ?>