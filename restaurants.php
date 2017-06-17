<?php include('session.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Restaurants</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<?php include "db.php" ?>
<div class="container">
    <?php include('message.php') ?>
    <div class="col-md-offset-1 col-md-9">
        <?php include "header.php" ?>
        <?php $restaurants = mysqli_query($db, "SELECT * FROM restaurants") ?>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>E-Mail</th>
                <th>Phone</th>
                <th></th>
            </tr>
            <?php while ($restaurant = mysqli_fetch_object($restaurants)): ?>
                <tr>
                    <td><?php echo $restaurant->name ?></td>
                    <td><?php echo $restaurant->location ?></td>
                    <td><?php echo $restaurant->email ?></td>
                    <td><?php echo $restaurant->phone ?></td>
                    <td>
                      
                        <a href="restaurant.php?id=<?php echo $restaurant->id ?>" class="btn btn-shine btn-table">More &raquo;</a>
                    </td>
                </tr>
            <?php endwhile ?>
        </table>
    </div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/scripts.js"></script>
</html>
