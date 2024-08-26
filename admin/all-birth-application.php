<?php
session_start();
include('includes/dbconnection.php');

// Check if session is set, if not redirect to logout
if (!isset($_SESSION['OBCMSaid']) || strlen($_SESSION['OBCMSaid']) == 0) {
    header('location:logout.php');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>All Applications | Certificate Verification and Authentication System</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- AdminPro Icon CSS -->
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <!-- MeanMenu Icon CSS -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- mCustomScrollbar CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="materialdesign">
    <div class="wrapper-pro">
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/header.php'); ?>

        <!-- Breadcrumb Start -->
        <div class="breadcome-area mg-b-30 small-dn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcome-list shadow-reset">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="breadcome-menu">
                                        <li><a href="dashboard.php">Home</a> <span class="bread-slash">/</span></li>
                                        <li><span class="bread-blod">All Applications</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sparkline13-list shadow-reset">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>View <span class="table-project-n">Detail of</span> All Students Applications</h1>
                                    <div class="sparkline13-outline-icon">
                                        <span class="sparkline13-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                        <span><i class="fa fa-wrench"></i></span>
                                        <span class="sparkline13-collapse-close"><i class="fa fa-times"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control">
                                            <option value="">Export Basic</option>
                                            <option value="all">Export All</option>
                                            <option value="selected">Export Selected</option>
                                        </select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <!-- <th>S.No</th> -->
                                                <th>Reg. No.</th>
                                                <th>Students Name</th>
                                                <th>Campus Name</th>
                                                <!-- <th>Campus Location</th> -->
                                                <th>Department</th>
                                                <th>Faculty</th>
                                                <th>Admission Year</th>
                                                <th>Grad. Year</th>
                                                <th>Status</th>
                                                <th data-field="action">View</th>
                                                <th>Approve</th>
                                                <th>View Verified.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tblapplication";
                                            $query = $obcms->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <!-- <td><?php echo htmlentities($cnt); ?></td> -->
                                                        <td><?php echo htmlentities($row->RegistrationID); ?></td>
                                                        <td><?php echo htmlentities($row->FullName); ?></td>
                                                        <td><?php echo htmlentities($row->Camname); ?></td>
                                                        <!-- <td><?php echo htmlentities($row->Camloc); ?></td> -->
                                                        <td><?php echo htmlentities($row->Department); ?></td>
                                                        <td><?php echo htmlentities($row->Faculty); ?></td>
                                                        <td><?php echo htmlentities($row->ayr); ?></td>
                                                        <td><?php echo htmlentities($row->gyr); ?></td>
                                                        <td><?php echo htmlentities($row->Status) ?: "pending"; ?></td>
                                                        <td>
                                                            <a href="../user/<?php echo htmlentities($row->certificate); ?>" target="_blank" class="btn btn-success btn-sm">view cert</a>
                                                        </td>
                                                        <?php if ($row->Status != "APPROVED"): ?>
                                                            <td class="datatable-ct">
                                                                <a href="approve.php?regno=<?= $row->RegistrationID ?>" class="btn btn-primary btn-sm">Approve</a>
                                                            </td>
                                                        <?php else: ?>
                                                            <td class="datatable-ct">
                                                                Approved
                                                            </td>
                                                        <?php endif ?>
                                                        <td>
                                                            <?php if ($row->auth_certificate):  ?>
                                                                <a href="../<?php echo htmlentities($row->auth_certificate); ?>" target="_blank" class="btn btn-success" style="color:#fff"><i class="fa fa-eye" style="margin-right: 3px;"></i>view</a>
                                                            <?php else: ?>
                                                                N/A
                                                            <?php endif ?>
                                                        </td>

                                                    </tr>
                                            <?php
                                                    $cnt++;
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table End -->
    </div>

    <?php include_once('includes/footer.php'); ?>

    <!-- jQuery -->
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- MeanMenu JS -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- mCustomScrollbar JS -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Sticky JS -->
    <script src="js/jquery.sticky.js"></script>
    <!-- ScrollUp JS -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- CounterUp JS -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <!-- Peity JS -->
    <script src="js/peity/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <!-- Sparkline JS -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- Data Table JS -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
</body>

</html>