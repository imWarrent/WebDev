<?php
    require('../config.php'); //connect to database.php

    if (isset($_POST['up-id'])){
        $id = $_POST['up-id'];
        $imgpath = $_FILES['up-img'];
        $name = ucfirst($_POST['up-name']);
        $desc = ucfirst($_POST['up-desc']);
        $price = $_POST['up-price'];
        $category = $_POST['up-cat'];
        $date = $_POST['up-date'];
        $queryUpdate = "";

        //FILE UPLOADING
        $file = $_FILES['up-img'];
        //File Properties
        $fileName = $file['name'];
        $tmpName = $file['tmp_name'];
        $file_destination = '../sofiaimages/Products/'.$fileName;
        $file_dest = 'sofiaimages/Products/'.$fileName;

        if(move_uploaded_file($tmpName,$file_destination)){
            echo $file_destination;
        }
        else{
            $file_destination = 'Images/NoValue';
            echo "Not Saved";
        }

        if(file_exists($file_destination) || is_uploaded_file($file_destination)){
            echo "true";
            $queryUpdate = "UPDATE `product_data` SET `product_name`='$name',
            `description`='$desc',`price`='$price',`category`='$category',`release_date`='$date',`image_path`='$file_dest' WHERE product_id = $id";
        }
        else{
            echo "trues";
            $queryUpdate = "UPDATE `product_data` SET `product_name`='$name',
            `description`='$desc',`price`='$price',`category`='$category',`release_date`='$date' WHERE product_id = $id";
        }

        $sqlUpdate = mysqli_query($sqlcon,$queryUpdate);


        //for front and back image
        $frontpath = $_FILES['up-front'];
        $backpath = $_FILES['up-back'];

        //FILE UPLOADING
        $file1 = $_FILES['up-front'];
        //File Properties
        $fileName1 = $file1['name'];
        $tmpName1 = $file1['tmp_name'];
        $file_destination1 = '../sofiaimages/Products/'.$fileName1;
        $file_dest1 = 'sofiaimages/Products/'.$fileName1;

        //FILE UPLOADING
        $file2 = $_FILES['up-back'];
        //File Properties
        $fileName2 = $file2['name'];
        $tmpName2 = $file2['tmp_name'];
        $file_destination2 = '../sofiaimages/Products/'.$fileName2;
        $file_dest2 = 'sofiaimages/Products/'.$fileName2;

        if(move_uploaded_file($tmpName1,$file_destination1)){
            echo $file_dest1." ".$file_dest2;
        }
        else{
            echo "ok";
        }

        if(move_uploaded_file($tmpName2,$file_destination2)){
            echo $file_dest1." ".$file_dest2;
        }
        else{
            echo "ok2";
        }

        $queryUpdates = "SELECT * FROM product_data";
        if($file_dest1 != "sofiaimages/Products/" && $file_dest2 !="sofiaimages/Products/"){
            $queryUpdates = "UPDATE `product_data` SET `front_image`='$file_dest1', `back_image`='$file_dest2' WHERE product_id = $id";
        }
        else if($file_dest1 != "sofiaimages/Products/" && $file_dest2 == "sofiaimages/Products/"){
            $queryUpdates = "UPDATE `product_data` SET `front_image`='$file_dest1' WHERE product_id = $id";
        }
        else if($file_dest1 == "sofiaimages/Products/" && $file_dest2 != "sofiaimages/Products/"){
            $queryUpdates = "UPDATE `product_data` SET `back_image`='$file_dest2' WHERE product_id = $id";
        }
        $sqlUpdates = mysqli_query($sqlcon,$queryUpdates);

        echo header('Location: ../productsadmin.php'); //go to other location
    }
?>

