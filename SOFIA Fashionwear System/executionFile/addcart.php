<?php
require('../config.php');
session_start();

$userquery = "";
$productid = $_POST['modalID'];
$qty = $_POST['qty'];
$size = $_POST['productSizes'];
$total = $_POST['totalprice'];
$expiry = "";
$Date = date('Y-m-d');
if(isset($_COOKIE['ranking'])){
    $expiry = date('Y-m-d', strtotime($Date. ' + 7 days'));
}
else{
    $expiry = date('Y-m-d', strtotime($Date. ' + 3 days'));
}

if(isset($_SESSION["userid"])){$userquery = $_SESSION["userid"];}
else if(isset($_COOKIE["userid"])){$userquery = $_COOKIE["userid"];}

$queryUpdate = "INSERT INTO `cart`(`cart_id`, `user_id`, `product_id`, `qty`, `total`,`size`,`expiration`) 
VALUES ('','$userquery','$productid','$qty','$total','$size','$expiry')"; //insert product

$sqlUpdate = mysqli_query($sqlcon,$queryUpdate);

$queryUpdates = "UPDATE `product_data` SET `$size` = `$size` - '$qty' WHERE `product_id` = $productid";
$sqlUpdates = mysqli_query($sqlcon,$queryUpdates);

echo header('Location: ../order.php');
?>