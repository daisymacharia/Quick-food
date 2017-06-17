<?php include 'session.php' ?>
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

    <?php include('header.php') ?>

    <?php include('message.php') ?>

    <div class="alert center">
        <h1>Quick Food!</h1>
        <p>Feel free to order, sweet, delicious food from the comfort of your desk, anytime, anywhere!.<br>
            <b>Quick Food</b> is determined to make your stomach full 24/7, that's right, step right up!<br>
            We have a variety from <b>Chicken, Beef, Samaki and even Mutura!</b></p>
        <p>
            <?php if (!isset($_SESSION['user'])): ?>
                <a class="btn btn-default" href="index.php">Sign In</a>
                <a class="btn btn-default" href="register.php">Sign Up</a>
            <?php else: ?>
                <a class="btn btn-shine-fill" href="order.php">Order Now! &raquo;</a>
            <?php endif ?>
        </p>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="thumbnail">
                <img src="imgs/food1.jpg" alt="Sample Image">
                <div class="caption">
                    <h3>Cakes</h3>
                    <p>Our pizza is the most delicious you have ever had! That's right try today</p>
                    <p><a href="order.php" class="btn btn-shine-fill">Order</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="thumbnail">
                <img src="imgs/food3.jpeg" alt="Sample Image">
                <div class="caption">
                    <h3>Chips</h3>
                    <p>Our chips is the most delicious you have ever had! That's right try today</p>
                    <p><a href="order.php" class="btn btn-shine-fill">Order</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="thumbnail">
                <img src="imgs/pizza.jpg" alt="Sample Image">
                <div class="caption">
                    <h3>Pizza</h3>
                    <p>Our pizza is the most delicious you have ever had! That's right try today</p>
                    <p><a href="order.php" class="btn btn-shine-fill">Order</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="thumbnail">
                <img src="imgs/food1.jpg" alt="Sample Image">
                <div class="caption">
                    <h3>Cheese Bugger</h3>
                    <p>Our pizza is the most delicious you have ever had! That's right try today</p>
                    <p><a href="order.php" class="btn btn-shine-fill">Order</a></p>
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
