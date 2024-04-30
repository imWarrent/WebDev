<?php
    require('./config.php');
    session_start();
    $notice = "This is restricted area, if you're not our employee please proceed to <a href='./index.php'> our main page!</a>";

    if(isset($_SESSION['loggedin'])){
        echo header('Location: ./adminindex.php');
    }

    if(isset($_POST['username'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM admin_db WHERE username = '$username' and password = '$password'";
        $sql = mysqli_query($sqlcon,$query);
        if ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
            $_SESSION['loggedin'] = "Yes";
            $_SESSION['usernameAdmin'] = "$username";
            echo header('Location: ./adminindex.php');
        }
        else{
            $notice = "Invalid Username/Password <br><br> This is restricted area, if you're not our employee please proceed to <a href='./index.php'> our main page!</a>";
        }
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 60vh;
            background-color: #b7e1e8;
  
         }
        .wrapper{ width: 500px; padding: 20px;
         }
    </style>
</head>
<body>
    <div class="wrapper">
        <img src ="sofiaimages/sofia.png" class = "mb-5" style = "width: 20vh">
        <h2>SOFIA Admin Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="adminlogin.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" class="form-control" value="" required>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
        <div class="alert alert-danger" role="alert">
            <?php echo "$notice";?>
        </div>
    </div>
</body>
</html>