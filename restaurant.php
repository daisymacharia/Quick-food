<?php include_once 'session.php' ?>
<?php
if (isset($_GET['logout'])) {
    unset($_SESSION['user']);

    session_unset();
    session_destroy();

    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quick Food</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<?php include "db.php" ?>
<div class="container">
    <div class="col-md-offset-2 col-md-9">
        <?php include "header.php" ?>
    </div>
    <div class="col-md-offset-2 col-md-6">
        <?php include('message.php') ?>
        <?php $id = $_GET['id'] ?>
        <?php $restaurant = mysqli_query($db, "SELECT * FROM restaurants WHERE id='$id'")->fetch_object() ?>

        <div class="alert">
            <h3><?php echo $restaurant->name ?></h3>
            <b>Name :</b> <?php echo $restaurant->name ?><br>
            <b>E-Mail :</b> <?php echo $restaurant->email ?><br>
            <b>Location :</b> <?php echo $restaurant->location ?><br>
            <b>Address :</b> <?php echo $restaurant->address ?><br><br>

            <a href="restaurants.php" class="btn btn-default">Go Back</a>
        </div>
    </div>
    <div class="col-md-offset--2 col-md-3">
    <div class="row" style="padding:0px 8px;">
      <div class="col-xs-10 white-back-grey-border">
          <div class="row filter-head">
              <div class="col-xs-12">
                  <h5>Opening Hours</h5>
              </div>
          </div>
          <div class="row">
              <table class="table table-condensed table-striped margin-bottom-0">
                  <tr>
                      <td>Monday</td>
                      <td class="text-centre">09:00am - 09:00pm</td>
                  </tr>
                  <tr>
                      <td>Tuesday</td>
                      <td class="text-centre">09:00am - 09:00pm</td>
                  </tr>
                  <tr>
                      <td>Wednesday</td>
                      <td class="text-centre">09:00am - 09:00pm</td>
                  </tr>
                  <tr>
                      <td>Thursday</td>
                      <td class="text-centre">09:00am - 09:00pm</td>
                  <tr>
                      <td>Friday</td>
                      <td class="text-centre">09:00am - 09:00pm</td>
                  </tr>
                  <tr>
                      <td>Saturday</td>
                      <td class="text-centre">09:00am - 09:00pm</td>
                  </tr>
                  <tr>
                      <td>Sunday</td>
                      <td class="text-centre">09:00am - 09:00pm</td>
                  </tr>
              </table>
          </div>
      </div>
    </div>
</div>
</div>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
