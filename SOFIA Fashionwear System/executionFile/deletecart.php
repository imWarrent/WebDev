<?php 
require('../config.php');

$id = $_GET['id'];

$queryUpdate = "DELETE FROM `cart`"; //update product

$sqlUpdate = mysqli_query($sqlcon,$queryUpdate); 

echo header('Location: ../myorder.php');
?>