<a href="home.php"><img src="imgs/logo.png" class="logo"></a>
<ul class="list-inline">
    <li><a href="home.php">Home</a></li>

    <li><a href="products.php">Products</a></li>
    <li><a href="restaurants.php">Restaurants</a></li>
    <li><a href="order.php">Order</a></li>

    <?php if(auth('role') == 'admin'): ?>
      <li><a href="stock.php">Stock</a></li>
      <li><a href="orders.php">Orders</a></li>
    <?php endif ?>

    <li class="pull-right"><a href="profile.php">Profile</a></li>
</ul>
