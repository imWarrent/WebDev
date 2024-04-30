<?php
    require('../config.php');
    session_start();

    $userquery = "";
    $orderno = $_POST['orderno'];

    if(isset($_SESSION["userid"])){$userquery = $_SESSION["userid"];}
    else if(isset($_COOKIE["userid"])){$userquery = $_COOKIE["userid"];}

    //retrieve all cart
    $query = "SELECT product_data.product_id as 'prodid', product_data.price as 'price', cart.size as size, product_data.product_name as 'prodname', cart.qty as 'qty', cart.total as 'total', product_data.image_path as 'imgpath' 
    FROM product_data
    INNER JOIN cart ON product_data.product_id = cart.product_id WHERE user_id = '$userquery'";

    $sql = mysqli_query($sqlcon,$query);
    while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
        $id = $row["prodid"]; $pname = $row["prodname"]; 
        $price= $row["price"];  $qty = $row["qty"];
        $total = $row["total"]; $imgpath = $row["imgpath"]; $sizess = $row['size'];

        $queryUpdate = "INSERT INTO `order_data`(`customer_id`, `product_id`, `prod_name`, `qty`, `total`, `order_no`, `order_status`,`rate`) 
        VALUES ('$userquery','$id','$pname','$qty','$total','$orderno','PENDING','NOT')"; //insert product

        $sqlUpdate = mysqli_query($sqlcon,$queryUpdate);
    }

    echo header('Location: ./deletecart.php');
?>