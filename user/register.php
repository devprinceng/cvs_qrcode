<?php 
session_start();
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $Email = $_POST['Email'];
    $password = md5($_POST['password']);

    // Validate the email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
    } else {
        // Check if mobile number already exists
        $ret = "SELECT mobile FROM tbluser WHERE mobile = :mobile";
        $query = $obcms->prepare($ret);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() == 0) {
            // Insert new user data
            $sql = "INSERT INTO tbluser (FirstName, LastName, mobile, address, Email, password) 
                    VALUES (:FirstName, :LastName, :mobile, :address, :Email, :password)";
            $query = $obcms->prepare($sql);
            $query->bindParam(':FirstName', $FirstName, PDO::PARAM_STR);
            $query->bindParam(':LastName', $LastName, PDO::PARAM_STR);
            $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':Email', $Email, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->execute();

            $lastInsertId = $obcms->lastInsertId();
            if ($lastInsertId) {
                echo "<script>alert('You have signed up successfully');</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again');</script>";
            }
        } else {
            echo "<script>alert('This Mobile Number already exists. Please try again');</script>";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Register | Certificate Verification and Authentication System</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="materialdesign">
    <div class="wrapper-pro">
        <div class="login-form-area mg-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <form class="adminpro-form" method="post">
                        <div class="col-lg-6">
                            <div class="login-bg">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="logo">
                                            <h3 style="font-weight: bold;color: blue">Certificate Verification and Authentication System</h3>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="login-title">
                                            <h1>User Registration Form</h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>First Name</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <input type="text" name="FirstName" required />
                                            <i class="fa fa-user login-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Last Name</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <input type="text" name="LastName" required />
                                            <i class="fa fa-user login-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Mobile Number</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <input type="text" name="mobile" maxlength="11" pattern="[0-9]+" required />
                                            <i class="fa fa-mobile login-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Address</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <input type="text" name="address" />
                                            <i class="fa fa-home login-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Email</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <input type="email" name="Email" required />
                                            <i class="fa fa-envelope login-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Password</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <input type="password" name="password" required />
                                            <i class="fa fa-lock login-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="login-button-pro" style="text-align:center">
                                            <button type="submit" class="login-button login-button-lg" name="submit">Register</button>
                                        </div>
                                        <div class="login-keep-me register-check">
                                            <p style="text-align:center">
                                                <small>Do you have an account?</small>
                                                <a href="login.php">SIGN IN</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>
        <!-- Register End-->
    </div>
    <?php include_once('includes/footer.php'); ?>
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.meanmenu.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/form-active.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
