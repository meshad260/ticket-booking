


<?php
 session_start();
 extract($_POST);
 include('config.php');
 $_SESSION['screen']=$screen;
 $_SESSION['seats']=$seats;
 $_SESSION['amount']=$amount;
 $_SESSION['date']=$date;
//  $_SESSION['phone']=$phone;
//  $_SESSION['name']=$name;
//  $_SESSION['email']=$email;
$user_id = $_SESSION["user"];




// Retrieve user details from the database
$query = "SELECT * FROM tbl_registration WHERE user_id='$user_id'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);

// // Get cart items and total amount
// $query = "SELECT p.id, p.name, p.price FROM items p INNER JOIN users_items up ON up.item_id = p.id WHERE up.user_id = '$user_id' AND up.status = 'Added to cart'";
// $result = mysqli_query($con, $query) or die(mysqli_error($con));

// $total = 0;
// while($item = mysqli_fetch_array($result)){
//     $total += $item["price"];
// }


?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <!-- link to Bootstrap minified css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- link to Jquery minified-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- link to Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- link to fontawesome CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- link to external CSS -->
    <link rel="stylesheet" type="text/css" href="index.css">
    <!-- link to Razorpay Checkout JS -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
 

    <div class="container panel-margin">
        <h3>Checkout</h3>
        <div class="row">
            <div class="col-xs-6">
                <h4>Billing Details</h4>
                <form method="GET" action="pay.php">
                <input type="text" name="name" Placeholder="Name" value="<?php echo $row['name'] ?>"><br>
                    <input type="number" name="phone" Placeholder="Phone Number" value="<?php echo $row['phone'] ?>"><br>
                    <input type="email" name="email" Placeholder="Enter Email Address" value="<?php echo $row['email'] ?>"><br>
                    <input type="hidden" name="uid" value="<?php echo $row['user_id'] ?>">
                    <input type="hidden" name="total" Placeholder="Enter Amount" value="<?php echo $amount ?>"><br>
                    <input type="hidden" name="tid" value="<?php echo 'TEMP' . time() ?>">
            </div>
            <div class="col-xs-6">
                <h4>Order Summary</h4>
                <table class="table table-hover">
                    <tr>
                        <th>Item Number</th>
                        <th>Item Name</th>
                        <th>Price</th>
                    </tr>
                    <?php while($item = mysqli_fetch_array($result)){ ?>
                    <tr>
                        <td><?php echo $item["id"] ?></td>
                        <td><?php echo $item["name"] ?></td>
                        <td><?php $total += $item["price"]; echo $item["price"] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td>Total:</td>
                        <td><i class="fa fa rupee"></i>
                        <?php echo $amount ?></td>
                        </tr>
            </table>
            <button type="submit" class="btn btn-primary">Pay Now</button>
            </form>
        </div>
    </div>
</div>

<!-- <?php require './include/footer.php'; ?> -->
</body>
</html>
