<?php
    require 'common.php';
    // check if signed in
    if(!isset($_SESSION["email"])){
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Success</title>
        <!-- link to Bootstrap minified css-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- link to Jquery minified-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- link to Bootstrap JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<!-- link to external CSS -->
		<link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <?php
          
            // check all items to confirmed
            $user_id = $_SESSION["id"];
            $query = "SELECT item_id FROM users_items WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

            // fetch billing details
           // fetch billing details
$user_email = $_SESSION["email"];
$query2 = "SELECT * FROM users WHERE email = '$user_email'";
$result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
$row2 = mysqli_fetch_array($result2);
$billing_name = $row2["name"];
$billing_email = $row2["email"];
$billing_address = $row2["address"];
$billing_city = $row2["city"];
$billing_state = $row2["address"];
$billing_zipcode = $row2["address"];



            while($row = mysqli_fetch_array($result)){
                $item_id = $row["item_id"];
                $query1 = "UPDATE users_items SET status = 'Confirmed' WHERE item_id = '$item_id'";
                
                $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
            }
        ?>

        <?php

$user_email = $_SESSION["email"];
$query3 = "SELECT paymentStatus, razorpayPaymentId,toValue FROM onlinepayment WHERE email = '$user_email'";
$result3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));
$row3 = mysqli_fetch_array($result3);
$payment_status = $row3["paymentStatus"];
$transaction_id= $row3["razorpayPaymentId"];
$paid_amount=$row3["toValue"];
?>
        <div class="container panel-margin">
            <div class="alert alert-success">
                <h4>Thank you for shopping with us!</h4>
                <p>Your order is confirmed. Below are the billing details:</p>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $billing_name; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $billing_email; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $billing_address; ?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><?php echo $billing_city; ?></td>
</tr>
<tr>
<td>Amount</td>
<td><?php echo $paid_amount; ?></td>
</tr>

<tr>
<td>payment status</td>
<td><?php echo $payment_status; ?></td>
</tr>

<tr>
<td>transaction_id</td>
<td><?php echo $transaction_id; ?></td>
</tr>



</tbody>
</table>
<p>To continue shopping, click <a href="products.php">here</a></p>
</div>
</div>
<?php
         require './include/footer.php';
     ?>
</body>

</html>