<?php
    require('../config.php'); //connect to database.php

    if (isset($_POST['add-id'])){
        $id = $_POST['add-id'];
        $imgpath = $_FILES['add-img'];
        $name = ucfirst($_POST['add-name']);
        $desc = ucfirst($_POST['add-desc']);
        $price = $_POST['add-price'];
        $category = $_POST['add-cat'];
        $date = $_POST['add-date'];
        $queryUpdate = "";

        //FILE UPLOADING
        $file = $_FILES['add-img'];

        //File Properties
        $fileName = $file['name'];
        $tmpName = $file['tmp_name'];
        $file_destination = '../sofiaimages/Products/'.$fileName;
        $file_dest = 'sofiaimages/Products/'.$fileName;

        //for front and back image
        $frontpath = $_FILES['add-front'];
        $backpath = $_FILES['add-back'];

        //FILE UPLOADING
        $file1 = $_FILES['add-front'];
        //File Properties
        $fileName1 = $file1['name'];
        $tmpName1 = $file1['tmp_name'];
        $file_destination1 = '../sofiaimages/Products/'.$fileName1;
        $file_dest1 = 'sofiaimages/Products/'.$fileName1;

        //FILE UPLOADING
        $file2 = $_FILES['add-back'];
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

        if(move_uploaded_file($tmpName,$file_destination)){
            echo $file_destination;
        }
        else{
            $file_destination = 'Images/NoValue';
            echo "Not Saved";
        }

        if(file_exists($file_destination) || is_uploaded_file($file_destination)){
            echo "true";
            $queryUpdate = "INSERT INTO `product_data`(`product_id`, `product_name`, `description`, `price`, `ratings`, `image_path`,`front_image`,`back_image`,`small`, `medium`, `large`,`category`,`release_date`) 
            VALUES ('','$name','$desc',$price,'No Ratings Yet','$file_dest','$file_dest1','$file_dest2',0,0,0,'$category','$date')"; //update product
        }

        $sqlUpdate = mysqli_query($sqlcon,$queryUpdate); 
        
        echo header('Location: ../productsadmin.php'); //go to other location
    }
?>

