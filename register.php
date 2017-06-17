<?php include "db.php" ?>
<?php
session_start();
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $city = trim($_POST['city']);
    $address = trim($_POST['address']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
    }

    if ($confirm !== $password) {
        $message = 'Passwords do not match!';
    } else {
        $query = mysqli_query($db, "SELECT * FROM users WHERE email='$email' LIMIT 1");
        if ($query->num_rows == 1) {
            $message = 'E-Mail already taken!';

        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($db, "INSERT INTO users(name, phone, address, email, password) VALUES('$name','$phone','$address','$email','$password')") or die(mysqli_error($db));
            foreach ($_POST as $key => $value) {
                unset($_SESSION[$key]);
            }
            $message = 'Details saved successfully!';
        }
    }
    $_SESSION['message'] = $message;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quick Food</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="col-md-offset-3 col-md-6">
        <a href="home.php"><img src="imgs/logo.png" class="logo"></a>
        <div class="alert panel-default">

            <?php include('message.php') ?>

            <h4 class="center">Register</h4>
            <form method="post" action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-4">Full Name</label>
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control"
                               value="<?php echo @$_SESSION['name'] ?>"
                               required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Cell Phone</label>
                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control"
                               value="<?php echo @$_SESSION['phone'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Nearest Town</label>
                    <div class="col-md-6">
                        <input type="text" name="city" class="form-control"
                               value="<?php echo @$_SESSION['city'] ?>"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Address</label>
                    <div class="col-md-6">
                        <input type="text" name="address" class="form-control"
                               value="<?php echo @$_SESSION['address'] ?>"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">E-Mail Address</label>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control"
                               value="<?php echo @$_SESSION['email'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Password</label>
                    <div class="col-md-6">
                        <input type="password" name="password" class="form-control"
                               value="<?php echo @$_SESSION['password'] ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Confirm Password</label>
                    <div class="col-md-6">
                        <input type="password" name="confirm" class="form-control"
                               value="<?php echo @$_SESSION['confirm'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6">
                        <input type="submit" name="register" class="btn btn-shine-fill" value="Submit">

                        <a href="index.php" class="btn btn-shine pull-right">Login Page</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
