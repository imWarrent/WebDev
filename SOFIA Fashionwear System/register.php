<?php
	require('./config.php');
    if (isset($_COOKIE["username"]))
    {
        echo '<script>window.location.href = "order.php";</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            color: black;
            background: rgb(131,199,210);
            background: linear-gradient(7deg, rgba(131,199,210,1) 0%, rgba(183,225,232,1) 49%);
        }

        .navbar{
            background: rgb(180,226,233);
            background: linear-gradient(7deg, rgba(180,226,233,1) 0%, rgba(217,243,247,1) 60%);
        }
        .wrapper{padding-top: 50px; padding-bottom: 50px;}
    </style>
</head>
<body>
<!--NAVBAR-->
<nav class="navbar navbar-expand-lg  navbar-light bg-light">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">
    <img src="sofiaimages/sofia.png" alt="" style="height: 4vh;" class="d-inline-block align-text-top">    
    Sofia Fashionwear</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link" href="index.php" style="font-size: 2.5vh">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="aboutus.php" style="font-size: 2.5vh">About Us</a>
        </li>
        <li class="nav-item">
        <li class="nav-item">
        <a class="nav-link"></a>
        </li>
        <li class="nav-item">
            <a href="order.php" class="btn btn-outline-danger px-4" role="button">Buy Now</a>
        </li>
    </ul>
    </div>
</div>
</nav>
<!--END-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-lg-4"></div>
        <div class="col-md-8 col-lg-4"> 
            <div class="wrapper">
                <h2>Sign Up</h2>
                <p>Please fill this form to create an account.</p>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="" placeholder="Surname, Firstname" required>
                    </div>   
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="" placeholder="Full Address" required>
                    </div> 
                    <div class="form-group">
                        <label>Email Address</label>
                    <input type="email" name="emailadd" class="form-control" value="" placeholder="example@website.com" required>
                    </div>    

                    <div class="form-group">
                        <label>Phone Number</label>
                    <input type="number" name="phoneno" class="form-control" value="" placeholder="(+63) 09XX XXXX XXX" required>
                    </div> 

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="" placeholder="Username" required>
                    </div>    

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <?php
                        if(isset($_POST['password'])){
                            if($_POST['password'] != $_POST['confirm_password']){
                                echo '<div class="alert alert-danger" role="alert">
                                Password Mismatch
                                </div>';
                            }
                            else{
                                $name = $_POST['name'];
                                $address = $_POST['address'];
                                $email = $_POST['emailadd'];
                                $phone = $_POST['phoneno'];
                                $username = $_POST['username'];
                                $password = md5($_POST['password']);
                                
                                //find if there's same username
                                $query = "SELECT count(username) as users FROM user_table WHERE username = '$username'";
                                $sql = mysqli_query($sqlcon,$query);
                                $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);

                                if($row['users'] < 1){

                                    //insert new user
                                    $queryUpdate = "INSERT INTO `user_table`(`ID`, `name`, `address`,`phoneno`, `email_add`, `username`, `password`) 
                                    VALUES ('','$name','$address','$phone','$email','$username','$password')";

                                    $sqlUpdate = mysqli_query($sqlcon,$queryUpdate); 
                                    echo '<script>window.location.href = "order.php";</script>';

                                    //set cookies to keep user logged in for 1 day
                                    setcookie("username", "$username", time() + 2 * 24 * 60 * 60);
                                }
                                else{
                                    echo '<div class="alert alert-danger" role="alert">
                                        Username already exist
                                    </div>';
                                }
                            }
                        }
                    ?>
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger" value="Signup">
                        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                    </div>
                    <p>Already have an account? <a href="order.php">Login here</a>.</p>
                </form>
            </div>
        </div>
        <div class="col-md-2 col-lg-4"></div> 
    </div>   
</div>   
</body>
</html>