<?php 
    require('../config.php');

    $id = $_POST['idcarts'];
    $qty = $_POST['qty'];
    $price = $_POST['prices'];

    $size = $_POST['sizez'];
    $productid = $_POST['prodidz'];
    $oldqty = $_POST['oldqty'];

    $total = $qty * $price;
    $queryUpdate = "UPDATE `cart` SET 
    `qty`='$qty', `total` = '$total' WHERE `cart_id` = $id"; //update product

    $sqlUpdate = mysqli_query($sqlcon,$queryUpdate); 


    $queryUpdates = "";
    if($qty > $oldqty){
        $newQTY = (int) $qty - (int) $oldqty;
        $queryUpdates = "UPDATE `product_data` SET `$size` = `$size` + '$newQTY' WHERE `product_id` = $productid";
    }
    else if($qty < $oldqty){
        $newQTY = (int) $oldqty - (int) $qty;
        $queryUpdates = "UPDATE `product_data` SET `$size` = `$size` - '$newQTY' WHERE `product_id` = $productid";
    }
    
    $sqlUpdates = mysqli_query($sqlcon,$queryUpdates);

    echo header('Location: ../mycart.php');
?>