<?php
session_start();
//error_reporting(0);
//include('includes/dbconnection.php');
if (strlen($_SESSION['OBCMSuid'] == 0)) {
  header('location:logout.php');
  exit;
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>

  <title>Certificcate List| Certificate Verification and Authentication System </title>

  <!-- Google Fonts
		============================================ -->
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
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
  <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="css/normalize.css">
  <!-- charts CSS
		============================================ -->
  <link rel="stylesheet" href="css/c3.min.css">
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
                    <li><span class="bread-blod">Certificates</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcome End-->

    <!-- Static Table Start -->
    <div class="data-table-area mg-b-15">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="sparkline13-list shadow-reset">
              <div class="sparkline13-hd">
                <div class="main-sparkline13-hd">
                  <h1>Certificate Lists</h1>
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
                        <th>S.No</th>
                        <th>Reg Number</th>
                        <th>Student Names</th>
                        <th>Campus Name</th>
                        <th>Department</th>
                        <th>Faculty</th>
                        <th>Admission Year</th>
                        <th>Graduation Year</th>
                        <th>Certificate</th>
                        <th>Status</th>
                        <th data-field="action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $uid = $_SESSION['OBCMSuid'];
                      $sql = "SELECT * from tblapplication where UserID=:uid and Status='APPROVED'";

                      $query = $obcms->prepare($sql);
                      $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      ?>
                      <?php if ($query->rowCount() > 0): ?>
                        <?php $cnt = 1; ?>
                        <?php foreach ($results as $row): ?>
                          <tr>
                            <td></td>
                            <td><?php echo htmlentities($cnt); ?></td>
                            <td><?php echo htmlentities($row->RegistrationID); ?></td>
                            <td><?php echo htmlentities($row->FullName); ?></td>
                            <!--<td><?php echo htmlentities($row->RegistrationID); ?></td>-->
                            <td><?php echo htmlentities($row->Camname); ?></td>
                            <td><?php echo htmlentities($row->Department); ?></td>
                            <td><?php echo htmlentities($row->Faculty); ?></td>
                            <td><?php echo htmlentities($row->ayr); ?></td>
                            <td><?php echo htmlentities($row->gyr); ?></td>
                            <td>
                              <?php if ($row->certificate): ?>
                                <strong>Uploaded</strong>
                              <?php else: ?>
                                <strong>Not Uploaded Yet</strong>
                              <?php endif ?>
                            </td>
                            <td><?php if ($row->Status == ""): ?>
                                <?php echo "Still Pending"; ?>
                              <?php else: ?>
                                <?php echo htmlentities($row->Status); ?>
                              <?php endif ?>
                            </td>
                            <td>
                              <?php if ($row->auth_certificate):  ?>
                                <a href="../<?php echo htmlentities($row->auth_certificate); ?>" target="_blank" class="btn btn-success" style="color:#fff"><i class="fa fa-eye" style="margin-right: 3px;"></i>view</a>
                              <?php else: ?>
                                N/A
                              <?php endif ?>
                            </td>
                          </tr>
                          <?php $cnt = $cnt + 1; ?>
                        <?php endforeach ?>
                      <?php endif ?>
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
  <!-- peity JS
		============================================ -->
  <script src="js/peity/jquery.peity.min.js"></script>
  <script src="js/peity/peity-active.js"></script>
  <!-- sparkline JS
		============================================ -->
  <script src="js/sparkline/jquery.sparkline.min.js"></script>
  <script src="js/sparkline/sparkline-active.js"></script>
  <!-- data table JS
		============================================ -->
  <script src="js/data-table/bootstrap-table.js"></script>
  <script src="js/data-table/tableExport.js"></script>
  <script src="js/data-table/data-table-active.js"></script>
  <script src="js/data-table/bootstrap-table-editable.js"></script>
  <script src="js/data-table/bootstrap-editable.js"></script>
  <script src="js/data-table/bootstrap-table-resizable.js"></script>
  <script src="js/data-table/colResizable-1.5.source.js"></script>
  <script src="js/data-table/bootstrap-table-export.js"></script>
  <!-- main JS
		============================================ -->
  <script src="js/main.js"></script>


</body>

</html>