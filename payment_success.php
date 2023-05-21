<?php
    require './include/common.php';

    $razorpayOrderId = $_SESSION['razorpay_order_id'];

    $success = true;

    if (empty($_POST['razorpay_payment_id']) === false)
    {
        $api = new Api('YOUR_RAZORPAY_KEY_ID', 'YOUR_RAZORPAY_SECRET_KEY');
        $payment = $api->payment->fetch($_POST['razorpay_payment_id']);

        if ($payment['amount'] == $razorpayAmount)
        {
            $capture = $api->payment->capture($_POST['razorpay_payment_id'], $razorpayAmount);
            $success = true;
        }
    }
    else
    {
        $success = false;
    }

   
