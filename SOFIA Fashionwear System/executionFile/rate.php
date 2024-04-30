<?php 
    require('../config.php');
    session_start();

    $userquery = "";
    $rate = $_POST["rate"];
    $rateid = $_POST['rateID'];
    $orderno = $_POST['orderno'];

    if(isset($_SESSION["userid"])){$userquery = $_SESSION["userid"];}
    else if(isset($_COOKIE["userid"])){$userquery = $_COOKIE["userid"];}

    $queryy = "SELECT COUNT(product_id) as exist FROM rating WHERE product_id = '$rateid'";
    $sqll = mysqli_query($sqlcon,$queryy);
    $row = mysqli_fetch_array($sqll, MYSQLI_ASSOC);
    $exist = $row['exist']; 
    if($exist == 0){
        $queryUpdate = "INSERT INTO `rating`(`rate_id`, `product_id`, `five`, `four`, `three`, `two`, `one`) 
        VALUES ('',$rateid,0,0,0,0,0)"; //add product
        $sqlUpdate = mysqli_query($sqlcon,$queryUpdate); 
    }

    echo $rate;
    echo $rateid;
    $queryUpdate = "";
    //update rate
    if($rate == '5'){
        $queryUpdate = "UPDATE `rating` SET `five`= `five` + 1 WHERE product_id = '$rateid'";
    }
    else if($rate == '4'){
        $queryUpdate = "UPDATE `rating` SET `four`= `four` + 1 WHERE product_id = '$rateid'";
    }
    else if($rate == '3'){
        $queryUpdate = "UPDATE `rating` SET `three`= `three` + 1 WHERE product_id = '$rateid'";
    }
    else if($rate == '2'){
        $queryUpdate = "UPDATE `rating` SET `two`= `two` + 1 WHERE product_id = '$rateid'";
    }
    else if($rate == '1'){
        $queryUpdate = "UPDATE `rating` SET `one`= `one` + 1 WHERE product_id = '$rateid'";
    }

    $sqlUpdate = mysqli_query($sqlcon,$queryUpdate);
    
    //computation
    $query = "SELECT * FROM rating WHERE product_id = '$rateid'";
    $sql = mysqli_query($sqlcon,$query);
    $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $five = $row['five']; $four = $row['four']; $three = $row['three'];
    $two = $row['two']; $one = $row['one'];

    $score = 5 * $five + 4 * $four + 3 * $three + 2 * $two + 1 * $one;
    $response = $five + $four + $three + $two + $one ;
    $updatedRatings = $score / $response;
    $updatedRating = number_format((float)$updatedRatings, 2, '.', '');

    //update rating of product
    $queryUpdates = "UPDATE `product_data` SET `ratings`='$updatedRating' WHERE product_id = '$rateid'";
    $sqlUpdate = mysqli_query($sqlcon,$queryUpdates);

    $queryUpdatez = "UPDATE `order_data` SET `rate`='DONE' WHERE product_id = '$rateid' AND order_no = '$orderno'";
    $sqlUpdate = mysqli_query($sqlcon,$queryUpdatez);
    echo header('Location: ../order.php');
?>