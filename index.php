<?php include "db.php" ?>
<?php
session_start();

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $_SESSION['username'] = $email;
    $query = mysqli_query($db, "SELECT * FROM users WHERE email='$email' LIMIT 1");

    if ($query->num_rows == 0) {
        $message = 'Credentials not found!';

    } elseif ($query->num_rows == 1) {
        $user = $query->fetch_object();
        if (!password_verify($password, $user->password)) {
            $message = 'You entered wrong password!';

        } else {
            $_SESSION['user'] = $user;
            unset($_SESSION['username']);

            $message = 'Successfully logged in!';
            header('location:home.php');
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
    <div class="row">
        <div class="col-md-offset-3 col-md-6">

            <a href="home.php"><img src="imgs/logo.png" class="logo"></a>

            <div class="alert panel-default">

                <?php if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <?php echo $_SESSION['message']; ?>
                    </div>
                <?php endif ?>

                <h4 class="center">Login</h4>
                <form method="post" action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-4">E-Mail</label>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control"
                                   value="<?php echo @$_SESSION['username'] ?>">
                        </div>
                    </div>
                    <div class="form-group <?php if (isset($_SESSION['username'])) : ?> has-error <?php endif ?>">
                        <label class="control-label col-md-4">Password</label>
                        <div class="col-md-6">
                            <input type="password" name="password"
                                   class="form-control" <?php if (isset($_SESSION['username'])) : ?> autofocus <?php endif ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-6">
                            <input type="submit" name="login" class="btn btn-shine-fill" value="Login">
                            <a class="btn btn-juicy" href="register.php">Create Account?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
