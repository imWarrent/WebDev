<?php 
require('../config.php');

$id = $_POST['userid'];

$queryUpdate = "DELETE FROM `user_table` WHERE ID = $id"; //update product

$sqlUpdate = mysqli_query($sqlcon,$queryUpdate); 

echo header('Location: ../usersadmin.php');
?>