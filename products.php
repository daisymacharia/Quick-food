<?php include_once 'session.php' ?>
<!DOCTYPE html>
<html>
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

    <div class="col-md-offset-1 col-md-9">
        <?php include "db.php" ?>
        <?php include "header.php" ?>

        <div class="alert center">
            <h2>Products</h2>
            <?php if(auth('role') == 'admin'): ?>
            <a class="btn btn-default" href="product.php">New Product</a>
            <a class="btn btn-shine-fill" href="stock.php">Check Stock</a>
          <?php endif ?>
        </div>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']->role == 'admin'): ?>
            <a href="product.php" class="btn btn-juicy-fill pull-right">New Product</a>
        <?php endif ?>

        <?php $products = mysqli_query($db, "SELECT * FROM products") ?>
        <div class="alert">
            <table class="table table-bordered">
                <thead>
                <tr class="">
                    <th>Name</th>
                    <th>Unit Price</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($product = mysqli_fetch_object($products)) : ?>
                    <tr>
                        <td><?php echo $product->name ?></td>
                        <td><?php echo $product->unit_price ?></td>
                    </tr>
                <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
