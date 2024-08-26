<?php
session_start();
//include('includes/dbconnection.php');
include('phpqrcode/qrlib.php');

if (strlen($_SESSION['OBCMSuid'] == 0)) {
    header('location:logout.php');
} else {
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Manage Application Form | Certificate Verification and Authentication System</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/c3.min.css">
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
                                        <li><span class="bread-blod">Application Form</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sparkline13-list shadow-reset">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>Certificate Details</h1>
                                    <div class="sparkline13-outline-icon">
                                        <span class="sparkline13-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                        <span><i class="fa fa-wrench"></i></span>
                                        <span class="sparkline13-collapse-close"><i class="fa fa-times"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div id="exampl">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                        <h3 align="center">Certificate of Graduation</h3>
                                        <hr />
                                        <p align="center">This is to certify that the following information has been taken from the original record of Glory-Pretty Certificate Verification and Authentication System.</p>

                                        <?php
                                        $vid = $_GET['viewid'];
                                        $sql = "SELECT tblapplication.*, tbluser.FirstName, tbluser.LastName, tbluser.mobile, tbluser.Address FROM tblapplication JOIN tbluser ON tblapplication.UserID=tbluser.ID WHERE tblapplication.ID=:vid AND tblapplication.Status='Verified'";
                                        $query = $obcms->prepare($sql);
                                        $query->bindParam(':vid', $vid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $row) {
                                            $certgendate = $row->UpdationDate;

                                            // Generate QR code
                                            //$qrText = 'Registration ID: ' . $row->RegistrationID . ' - Name: ' . $row->FullName;
                                            //$qrFile = 'qrcodes/' . $row->RegistrationID . '.png';
                                            //QRcode::png($qrText, $qrFile, QR_ECLEVEL_L, 5);
                                        ?>
                                            <table border="2" class="table table-bordered">
                                                <tr align="center">
                                                    <td colspan="2"><strong>Registration Number:</strong> <?php echo $row->RegistrationID; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Student Name</th>
                                                    <td><?php echo $row->FullName; ?></td>
                                                    <th scope="row">Campus Name</th>
                                                    <td><?php echo $row->Camname; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Campus Location</th>
                                                    <td><?php echo $row->Camloc; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Department</th>
                                                    <td><?php echo $row->Department; ?></td>
                                                    <th scope="row">Faculty</th>
                                                    <td><?php echo $row->Faculty; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Admission Year</th>
                                                    <td><?php echo $row->ayr; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Graduation Year</th>
                                                    <td><?php echo $row->gyr; ?></td>
                                                    <th scope="row">Date of Apply</th>
                                                    <td><?php echo $row->Dateofapply; ?></td>
                                                </tr>
                                            </table>

                                            <p align="center"><b>Certificate Generation Date:</b> <?php echo htmlentities($certgendate); ?></p>

                                            <!-- Display QR code above the print button -->
                                            <div align="center">
                                                <img src="<?php echo $qrFile; ?>" alt="QR Code">
                                            </div>

                                            <p>
                                                <i class="fa fa-print fa-2x" style="cursor: pointer;" OnClick="CallPrint(this.value)"></i>
                                            </p>
                                        <?php } ?>
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

    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.meanmenu.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/peity/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <script src="js/main.js"></script>

    <script>
        function CallPrint(strid) {
            var prtContent = document.getElementById("exampl");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            setTimeout(() => {
                WinPrint.print();
                setTimeout(() => {
                    WinPrint.close();
                }, 500);
            }, 500);
        }
    </script>
</body>

</html>
<?php } ?>
