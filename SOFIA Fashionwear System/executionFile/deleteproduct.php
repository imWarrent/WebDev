<?php 
require('../config.php');

$id = $_POST['del-id'];

$queryUpdate = "DELETE FROM `product_data` WHERE product_id = $id"; //delete product

$sqlUpdate = mysqli_query($sqlcon,$queryUpdate); 

$queryUpdate = "DELETE FROM `cart` WHERE product_id = $id"; //delete cart

$sqlUpdate = mysqli_query($sqlcon,$queryUpdate); 
//delete cart with product...
echo header('Location: ../productsadmin.php');
?>