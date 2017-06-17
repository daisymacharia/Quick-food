<?php include_once 'session.php' ?>
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
    <?php include "db.php" ?>

    <div class="alert center">
        <h2>Orders</h2>
    </div>

    <div class="">
        <?php
        if (isset($_GET['clear'])) {
            $id = $_GET['clear'];
            mysqli_query($db, "UPDATE order_details SET status='cleared' WHERE id='$id'") or die(mysqli_error($db));
            $_SESSION['message'] = 'Order canceled!';
        }

        if (isset($_GET['cancel'])) {
            $id = $_GET['cancel'];
            mysqli_query($db, "UPDATE order_details SET status='canceled' WHERE id='$id'") or die(mysqli_error($db));
            $_SESSION['message'] = 'Order canceled!';
        }

        $sql = "SELECT
  orders.*,
  users.name AS user_name,
  order_details.quantity AS order_qty,
  order_details.id AS order_id,
  order_details.status,
  stocks.quantity,
  products.name AS product_name,
  products.unit_price AS at
FROM orders
  INNER JOIN users ON orders.user_id = users.id
  INNER JOIN order_details ON order_details.order_id = orders.id
  INNER JOIN stocks ON order_details.stock_id = stocks.id
  INNER JOIN products ON stocks.product_id = products.id
  ORDER BY created_at DESC" 
  ?>

        <?php $orders = mysqli_query($db, $sql) ?>
        <?php if ($orders->num_rows > 0): ?>
            <table class="table table-bordered">
                <tr class="active">
                    <th>Code</th>
                    <th>Date</th>
                    <th>User</th>
                    <th>Quantity</th>
                    <th>Product</th>
                    <th>@</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php $sum = 0;
                $grand_sum = 0;
                $quantity = 0; ?>

                <?php while ($order = mysqli_fetch_object($orders)): ?>

                    <?php if ($order->status !== 'canceled') : ?>
                        <?php $sum += ($order->order_qty * $order->at) ?>
                        <?php $grand_sum += $sum ?>
                        <?php $quantity += $order->order_qty ?>
                    <?php endif ?>

                    <tr class="<?php echo $order->status ?>">
                        <td>#<?php echo $order->order_id ?></td>
                        <td><?php echo date_create($order->created_at)->format('D m Y h:m A') ?></td>
                        <td><?php echo $order->user_name ?></td>
                        <td><?php echo $order->order_qty ?></td>
                        <td><?php echo $order->product_name ?></td>
                        <td><?php echo number_format($order->at) ?></td>
                        <td><?php echo number_format($sum, 2) ?></td>
                        <td><?php echo $order->status ?></td>
                        <td>
                            <?php if ($order->status == 'pending') : ?>
                                <a href="orders.php?clear=<?php echo $order->order_id ?>"
                                   class="btn btn-shine btn-table">Clear</a>
                                <a href="orders.php?cancel=<?php echo $order->order_id ?>"
                                   class="btn btn-shine btn-table confirm">Cancel</a>
                            <?php elseif ($order->status == 'cleared'): ?>
                                Processed
                            <?php else : ?>
                                Canceled
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <th colspan="5"></th>
                    <th class="active"><?php echo $quantity ?></th>
                    <th class="active"><?php echo number_format($grand_sum, 2) ?></th>
                    <th colspan="2"></th>
                </tr>
            </table>
        <?php else: ?>
            <div class="alert">
                No orders yet
            </div>
        <?php endif ?>
    </div>

</div>

</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
