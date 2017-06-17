<?php include_once 'session.php' ?>

    <?php include "db.php" ?>
    <?php
    if (isset($_POST['order'])) {
        foreach ($_POST['ids'] as $key => $value) {
            // $_SESSION[$value] = @$_POST['quantities'][$key];
        }

        // var_dump($_SESSION['user']); die();

        $ids = $_POST['ids'];
        $user = auth('id');
        $rest = 1;
        $quantities = $_POST['quantities'];

        mysqli_query($db, "INSERT INTO orders(user_id, rest_id) VALUES ('$user', '$rest')") or die(mysqli_error($db));
        $order_id = $db->insert_id;

        $placed = false;
        foreach ($ids as $i => $id) {
            $quantity = (int)$quantities[$i];
            if ($quantity > 0) {
                $stock = mysqli_query($db, "SELECT * FROM stocks WHERE id = '$id'")->fetch_object();
                mysqli_query($db, "INSERT INTO order_details(order_id, stock_id, quantity) VALUES('$order_id', '$id', '$quantity')") or die(mysqli_error($db));

                $new_qty = (int)($stock->quantity - $quantity);
                mysqli_query($db, "UPDATE stocks SET quantity = '$new_qty' WHERE id = '$id'") or die(mysqli_error($db));

                $placed = true;
            }
        }

        if (!$placed) {
            $_SESSION['message'] = 'Please at least order something!';
        } else {
            $_SESSION['message'] = 'Order placed successfully';
        }
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
        <div class="col-md-offset-1 col-md-9">
            <?php include('header.php') ?>
            <?php include('message.php') ?>

            <div class="alert center">
                <h2>Place Order</h2>
            </div>

            <form method="post" action="">
                <table class="table table-order" style="background-color: rgba(60, 0, 0, 0.12)">
                    <tr style="background-color: #3c0000; color: #ccc">
                        <th> Product</th>
                        <th> Unit Price</th>
                        <th> Available</th>
                        <th> Quantity</th>
                        <th class="right"> Sum</th>
                    </tr>
                    <?php $stocks = mysqli_query($db, "SELECT * FROM stocks") ?>
                    <?php while ($stock = mysqli_fetch_object($stocks))  : ?>

                        <input type="hidden" name="ids[]" value="<?php echo $stock->id ?>">

                        <?php $product = mysqli_query($db, "SELECT * FROM products WHERE id=$stock->product_id")->fetch_object(); ?>
                        <tr>
                            <td><?php echo $product->name ?></td>
                            <td class="unit"><?php echo $product->unit_price ?></td>
                            <td><?php echo $stock->quantity ?></td>

                            <td><input type="number" class="quantities" name="quantities[]" min="1"
                                       max="<?php echo $stock->quantity ?>"
                                       style="width: 100%" value="<?php echo @$_SESSION[$product->id] ?>" autofocus>
                            </td>

                            <td class="sum right">0.00</td>
                        </tr>

                    <?php endwhile; ?>
                    <tr style="background-color: #3c0000; color: #ccc">
                        <th colspan="4"></th>
                        <th class="total_sum right">0.00</th>
                    </tr>
                </table>
                <input type="submit" class="btn btn-shine-fill order" name="order" value="Submit">
                <button type="reset" class="btn btn-shine">Reset</button>

                <div class="clearfix"></div>

            </form>
        </div>
    </div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
<script>
    $('.quantities').on('keyup change', function () {
        var row = $(this).parent().parent();
        var quantity = $(this).val();
        quantity = (quantity === '') ? 0 : quantity;

        var unit_price = row.find('.unit').html();
        var sum = parseFloat(unit_price) * parseInt(quantity);

        row.find('.sum').html(sum.toFixed(2));

        GrandSums();
    });

    function GrandSums() {
        var total_sum = 0;

        $('.sum').each(function (a, b) {
            total_sum += parseInt($(b).html());
            $('.total_sum').html(total_sum.toFixed(2) + '/=');
        })
    }
</script>
</html>
