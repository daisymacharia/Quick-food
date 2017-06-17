<?php include('session.php') ?>
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
  <?php
  if (isset($_POST['product'])) {
      $name = $_POST['name'];
      $unit_price = $_POST['unit_price'];

      mysqli_query($db, "INSERT INTO products(name, unit_price) VALUES('$name', '$unit_price')") or die(mysqli_error($db));
      header('location:products.php');
  }
  ?>
    <div class="col-md-8 col-md-offset-2">
        <?php include "header.php" ?>

        <div class="alert">
            <h4 class="center">New Product</h4>
            <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-4">Product Name</label>
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Unit Price</label>
                    <div class="col-md-6">
                        <input type="number" min="0" name="unit_price" class="form-control" value="0.00">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6">
                        <input type="submit" class="btn btn-shine" name="product" value="Submit">
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
