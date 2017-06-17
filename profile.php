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


    <div class="col-md-offset-1 col-md-9">
        <?php include "header.php" ?>
        <?php include('message.php') ?>

        <div class="alert center">
            <h3>Profile</h3>
            <b>Name :</b> <?php echo auth('name') ?><br>
            <b>Role :</b> <?php echo auth('role') ?><br>
            <b>Phone :</b> <?php echo auth('phone') ?><br>
            <b>E-Mail :</b> <?php echo auth('email') ?><br><br>
            <a href="profile.php?logout=true" class="btn btn-shine-fill">Logout</a>
        </div>

        <div class="alert">
            <h4>Order History</h4>
            <?php $id = auth('id') ?>
            <?php $orders = mysqli_query($db, "SELECT * FROM orders WHERE user_id='$id' ORDER BY created_at DESC") ?>

            <?php if ($orders->num_rows > 0): ?>
                <?php while ($order = mysqli_fetch_object($orders)) : ?>
                    <?php $order_details = mysqli_query($db, "SELECT * FROM order_details WHERE order_id='$order->id'") ?>
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading">
                                #<?php echo $order->id ?>
                                <small>Ordered on <?php echo $order->created_at ?></small>
                            </h4>
                        </div>
                    </div>

                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr class="active">
                            <th>Product</th>
                            <th>Status</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($o = mysqli_fetch_object($order_details)) : ?>
                            <?php $stock = mysqli_query($db, "SELECT * FROM stocks WHERE id='$o->stock_id'")->fetch_object() ?>
                            <?php $product = @mysqli_query($db, "SELECT * FROM products WHERE id= '$stock->product_id'")->fetch_object() ?>

                            <?php if ($o->status != 'canceled') : ?>
                                <?php @$total = (@$product->unit_price * $o->quantity) ?>
                                <?php @$sum += $total ?>
                                <?php @$qty += $order->quantity ?>
                            <?php endif ?>

                            <tr class="<?php echo $o->status ?>">
                                <td><?php echo @$product->name ?></td>
                                <td style="font-style: italic"><?php echo $o->status ?></td>
                                <td><?php echo @$product->unit_price ?></td>
                                <td><?php echo @$o->quantity ?></td>
                                <th>
                                    <?php if ($o->status != 'canceled') : ?>
                                        <?php echo number_format($total, 2) ?>
                                    <?php endif ?>
                                </th>
                            </tr>
                        <?php endwhile ?>
                        </tbody>
                        <tfoot>
                        <th colspan="3"></th>
                        <th class="active"><?php echo number_format(@$qty) ?></th>
                        <th class="active"><?php echo number_format(@$sum, 2) ?></th>
                        </tfoot>
                    </table>
                <?php endwhile ?>
            <?php else: ?>
                You have not placed any order
            <?php endif ?>
        </div>
    </div>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
