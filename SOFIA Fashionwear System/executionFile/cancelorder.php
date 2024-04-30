<?php 
require('../config.php');
session_start();

$id = $_POST['cancel-ords'];
$oid = $_POST['cancel-ordno'];

$queryUpdate = "UPDATE `order_data` SET order_status = 'CANCELLED' WHERE `order_id` = $id"; //update product
$sqlUpdate = mysqli_query($sqlcon,$queryUpdate); 
$userid = "";
echo header('Location: ../myorder.php');
?>