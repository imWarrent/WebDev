<?php
	require('./config.php');
  session_start();

  $error = 0;
  $id = 0;
  if( !isset($_COOKIE['username']) && !isset($_SESSION['username']) ){
    echo '<script type="text/javascript">
    $(document).ready(function(){
      $("#exampleModalCenter").modal("show");
    });
    </script>';
  }
  //for login
  if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT count(id) as userID, id FROM user_table WHERE `username` = '$username' && `password` = '$password'";
    $sql = mysqli_query($sqlcon,$query);
    $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    if($row['userID'] > 0) {
      $error = 0;
      $id = $row['id'];
      if(isset($_POST['keeplogin'])){
        setcookie("username", "$username", time() + (10 * 365 * 24 * 60 * 60));
        setcookie("userid", "$id", time() + (10 * 365 * 24 * 60 * 60));
      }
      else{
        $_SESSION["username"] = "$username";
        $_SESSION["userid"] = "$id";
      }
      header("location: order.php");
    }
    else{
      $error = 1;
    }
  }

  $userquery = "";
  if(isset($_SESSION["userid"])){$userquery = $_SESSION["userid"];}
  else if(isset($_COOKIE["userid"])){$userquery = $_COOKIE["userid"];}
  
  //deleting expired carts
  $expDate = date("Y-m-d");
  $expiredCart = "DELETE FROM cart WHERE `expiration` < '$expDate'";
  $sqlExp = mysqli_query($sqlcon,$expiredCart);

  //for change
  $leader = "SELECT `user_table`.`ID` AS 'ID', `user_table`.`name` AS 'name', SUM(`order_data`.`qty`) AS 'total' FROM `user_table` INNER JOIN `order_data` ON `user_table`.`ID` = `order_data`.`customer_id` WHERE `order_data`.`order_status` = 'DELIVERED' GROUP BY `user_table`.`name` ORDER BY SUM(`order_data`.`qty`) DESC LIMIT 2";
  $sqlead = mysqli_query($sqlcon,$leader);
  
  $countlead = 0;
  while($rowlead = mysqli_fetch_array($sqlead, MYSQLI_ASSOC)){
    if($rowlead['ID'] == $userquery){
      setcookie("ranking", "true", time() + (10 * 365 * 24 * 60 * 60));
      break;
    }
    $countlead++;
  }
  

  //for cart count
  $query = "SELECT count(cart_id) as userCart FROM cart WHERE `user_id` = '$userquery'";
  $sql = mysqli_query($sqlcon,$query);
  $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
  $cartCount = 0;
  if($row > 0){
    $cartCount = $row['userCart'];
  }
  else{
    $cartCount = 0;
  }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="order.css">
</head>
<body>
<!--NAVBAR-->
<nav class="navbar navbar-expand-lg  navbar-light bg-light">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">
    <img src="sofiaimages/sofia.png" alt="" style="height: 3vh;" class="d-inline-block align-text-top">    
    Sofia Fashionwear</a>
    <?php
      if(isset($_COOKIE['username'])){
        echo 'Welcome, '.$_COOKIE['username'];
      }
      else if(isset($_SESSION['username'])){
        echo 'Welcome, '.$_SESSION['username'];
      }
      else{
        echo "Guest Account";
      }
    ?>
    <button class="navbar-toggler" type="button" style="width: 100%" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link" href="order.php">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="myorder.php">My Order</a>
        </li>
        <ul class="navbar-nav mb-2 mb-lg-0">
        <div class="input-group">
        <!-- LEADERBOARD -->
        <li class="nav-item" title = "Leaderboards of active users">
          <a
            class="nav-link mx-2 me-2 active"
            href="leaderboard.php"
            role="button"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
              <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
            </svg>
          </a>
        </li>

        <!-- CART -->
          <li class="nav-item" title = "Cart">
          <a
            class="nav-link me-2"
            href="mycart.php"
            role="button"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              <span class="badge rounded-pill badge-notification bg-danger"><?php echo $cartCount ?></span>
            </svg>
          </a>
          </li>

          <!-- LOGOUT -->
          <li class="nav-item" title = "Logout">
          <a
            class="nav-link"
            href="logout.php"
            role="button"
            
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
              <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
            </svg>
          </a>
          </li>
        </ul>
    </div>
    </div>
</div>
</nav>
<!--END-->
<style>
    th, td{
        font-size: 20px;
    }

    table{
        text-align: center;
        overflow: scroll;
        height: 50px;
    }
</style>
<div class="container-fluid mt-5"><center>
    <div class="row">
        <div class="col-12">
            <h1 style="font-size: 50px" class="mt-3 mb-5">LEADERBOARDS</h1>
        </div>
        <div class="col-12 overflow-auto" style="height: 65vh; background-color: #f2f2f2;">
        <div class="col-12">
            <?php ?>
            <table class="table table-warning">
                <th style="width: 30vh;">Rank No.</th>
                <th style="width: 40vh;">Name</th>
                <th style="width: 30vh;">Total Items</th>
                <?php
                    $query = "SELECT user_table.`ID` AS 'ID', user_table.`name` AS 'name', SUM(order_data.`qty`) AS 'total' FROM user_table INNER JOIN order_data ON user_table.`ID` = order_data.`customer_id` WHERE order_data.`order_status` = 'DELIVERED' AND order_data.`qty` >= 1 GROUP BY user_table.`name` ORDER BY SUM(order_data.`qty`) DESC LIMIT 20;";
                    $sql = mysqli_query($sqlcon,$query);
                    $counter = 0;
                    while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                    $name = $row['name']; $total = $row['total']; $id = $row['ID']; $counter++;
                ?>
                <tr <?php 
                if($userquery == $id){
                echo "class='table-danger'";}?>>
                <td><?php echo $counter?></td>
                <td><?php echo $name?></td>
                <td><?php echo $total?></td>
                <?php 
                    }
                ?>
            </table>
        </div>
                </div>
    </div>
    </center>
</div>
</body>
</html>