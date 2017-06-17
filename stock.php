<?php include_once 'session.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quick Food</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<?php include "db.php" ?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-9">

            <?php include "header.php" ?>

            <div class="alert center">
                <h4>Current Stock</h4>
                <a href="#stock" class="btn btn-shine-fill" data-toggle="modal">Add Stock</a>
            </div>
            <?php
            if (isset($_POST['stock'])) {
                $product = $_POST['product'];
                $at = $_POST['@'];
                $quantity = $_POST['quantity'];

                $stock = mysqli_query($db, "SELECT * FROM stocks WHERE product_id='$product'")->fetch_object();
                  if(isset($stock)) {
                    $new_qty = ((int)$stock->quantity + $quantity);
                    mysqli_query($db, "UPDATE stocks SET quantity='$new_qty', sell_price='$at' WHERE id='$stock->id'") or die(mysqli_error($db));
                  } else {
                    mysqli_query($db, "INSERT INTO stocks(quantity, sell_price,product_id, rest_id) VALUES('$quantity','$at', $product, 1)") or die(mysqli_error($db));
                  }
              }
            ?>

            <?php $stocks = mysqli_query($db, "SELECT * FROM stocks") ?>
            <table class="table table-bordered">
                <tr class="active">
                    <th>Stock Date</th>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Sell Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                <?php while ($stock = mysqli_fetch_object($stocks)) : ?>
                    <?php $product = mysqli_query($db, "SELECT * FROM products WHERE id= '$stock->product_id'")->fetch_object() ?>
                    <tr>
                        <td><?php echo date_create($stock->created_at)->format('D d M y h:m') ?></td>
                        <td><?php echo $product->name ?></td>
                        <td><?php echo $product->unit_price ?></td>
                        <td><?php echo $stock->sell_price ?></td>
                        <td><?php echo $stock->quantity ?></td>
                        <td>
                            <a href="orders.php?stock=<?php echo $stock->id ?>" class="btn btn-shine btn-table">Orders
                                &raquo;</a> &nbsp;
                        </td>
                    </tr>
                <?php endwhile ?>
            </table>
        </div>

        <div id="stock" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Stock</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="">
                            <div class="form-group">
                                <label class="control-label col-md-3">Product</label>
                                <div class="col-md-6">
                                    <?php $products = mysqli_query($db, "SELECT * FROM products") ?>
                                    <select class="form-control" name="product" required>
                                        <option value="">--select--</option>
                                        <?php while ($product = mysqli_fetch_object($products)) : ?>
                                            <option value="<?php echo $product->id ?>"><?php echo $product->name ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Quantity</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="quantity" value="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Unit Price</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="@" value="0.00">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <input type="submit" name="stock" class="btn btn-shine" value="Submit">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
