<?php 
require('../config.php');

$id = $_GET['id'];

$prodid = $_GET['prodid'];
$size = $_GET['size'];
$qty = $_GET['qty'];

$queryUpdate = "DELETE FROM `cart` WHERE `cart_id` = $id"; //update product

$sqlUpdate = mysqli_query($sqlcon,$queryUpdate);

$queryUpdates = "UPDATE `product_data` SET `$size` = `$size` + '$qty' WHERE `product_id` = $prodid";
$sqlUpdates = mysqli_query($sqlcon,$queryUpdates);

echo header('Location: ../mycart.php');
?>