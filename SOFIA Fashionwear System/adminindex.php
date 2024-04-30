<?php
   include "config.php";
   session_start();
   if(!isset($_SESSION['loggedin'])){
      echo header('Location: ./adminlogin.php');
   }


   //sales
   $query = "SELECT SUM(total) as total FROM order_data WHERE order_status = 'DELIVERED'";
   $sql = mysqli_query($sqlcon,$query);

   $sales = 0;
   if($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
      $sales = $row['total'];

      if($sales == ""){
         $sales = "0.00";
      }
   }

   //users
   $query = "SELECT COUNT(id) as user FROM user_table";
   $sql = mysqli_query($sqlcon,$query);
   $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
   $users = $row['user'];

   //products
   $query = "SELECT COUNT(product_id) as product FROM product_data";
   $sql = mysqli_query($sqlcon,$query);
   $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
   $products = $row['product'];

   //orderstatus

   $query = "SELECT (SELECT COUNT(order_id) FROM order_data WHERE order_status = 'DELIVERED') AS DELIVERED, (SELECT COUNT(order_id) FROM order_data WHERE order_status = 'PENDING') AS PENDING, (SELECT COUNT(order_id) FROM order_data WHERE order_status = 'CANCELLED') AS CANCELLED FROM `order_data` LIMIT 1;";
   $sql = mysqli_query($sqlcon,$query);
   $pending = 0;
   $cancelled = 0;
   $delivered = 0;
   if($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
      $pending = $row['PENDING'];
      $cancelled = $row['CANCELLED'];
      $delivered = $row['DELIVERED'];
   }
?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <style>
      .vertical-center {
         min-height: 100%;
         min-height: 90vh;

         display: flex;
         align-items: center;
      }

      body{
         background: rgb(131,199,210);
         background: linear-gradient(7deg, rgba(131,199,210,1) 0%, rgba(183,225,232,1) 49%);
      }

      .navbar{
         background: rgb(180,226,233);
         background: linear-gradient(7deg, rgba(180,226,233,1) 0%, rgba(217,243,247,1) 60%);
      }
   </style>
</head>
<body>
<!--NAVBAR-->
<nav class="navbar navbar-expand-lg  navbar-light bg-light">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">
    <img src="sofiaimages/sofia.png" alt="" style="height: 3vh;" class="d-inline-block align-text-top">    
    Sofia Fashionwear</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="adminindex.php">Dashboard</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="productsadmin.php">Products</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="ordersadmin.php">Orders</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="transactionadmin.php">Transactions</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="usersadmin.php">Users</a>
        </li>
        <!-- LOGOUT -->
        <li class="nav-item" title = "Logout">
          <a
            class="nav-link"
            href="executionFile/logoutadmin.php";
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
</nav>
<!--END-->

<div class="vertical-center">

<div class="container">
   <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3 text-end">
         <div class="card bg-warning" style = "height: 27vh;
background: rgb(255,160,58);
background: linear-gradient(338deg, rgba(255,160,58,1) 0%, rgba(252,198,140,1) 100%);">
            <div class="card-body">
               <div class="row align-items-center h-100">
                  <div class="col-3">
                     <i class="bi bi-cash-stack" style="font-size: 55px; color: white"></i>
                  </div>
                  <div class="col-9">
                     <h1 class="card-title fw-bold" style="color: #faf7f7; font-size: 35px">₱ <?php echo $sales?></h1>
                     <p class="card-text" style="font-size: 20px">Total Sales</p>
                  </div>
               </div>
            </div>
            <div class="card-footer text-muted text-center">
            </div>
         </div>
      </div>

      <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3 text-end">
         <div class="card bg-warning" style = "height: 27vh;
            background: rgb(255,45,45);
background: linear-gradient(338deg, rgba(255,45,45,1) 0%, rgba(250,126,117,1) 100%);">
            <div class="card-body">
               <div class="row align-items-center h-100">
                  <div class="col-3">
                     <i class="bi bi-people-fill" style="font-size: 55px; color: white"></i>
                  </div>
                  <div class="col-9">
                     <h1 class="card-title fw-bold" style="color: #faf7f7; font-size: 35px"><?php echo $users?></h1>
                     <p class="card-text" style="font-size: 20px">Top 20 Miners</p>
                  </div>
               </div>
            </div>
            <div class="card-footer text-muted text-center">
            </div>
         </div>
      </div>

      <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3 text-end">
         <div class="card bg-warning" style = "height: 27vh;
            background: rgb(45,219,255);
background: linear-gradient(338deg, rgba(45,219,255,1) 0%, rgba(117,142,250,1) 100%);">
            <div class="card-body">
               <div class="row align-items-center h-100">
                  <div class="col-3">
                     <i class="bi bi-tags-fill" style="font-size: 55px; color: white"></i>
                  </div>
                  <div class="col-9">
                     <h1 class="card-title fw-bold" style="color: #faf7f7; font-size: 35px"><?php echo $products?></h1>
                     <p class="card-text" style="font-size: 20px">Total Products</p>
                  </div>
               </div>
            </div>
            <div class="card-footer text-muted text-center">
            </div>
         </div>
      </div>

      <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3 text-end">
         <div class="card bg-warning" style = "height: 27vh;
            background: rgb(125,45,255);
background: linear-gradient(338deg, rgba(125,45,255,1) 0%, rgba(221,117,250,1) 100%);">
            <div class="card-body">
               <div class="row align-items-center h-100">
                  <div class="col-3">
                     <i class="bi bi-clock-history" style="font-size: 65px; color: white"></i>
                  </div>
                  <div class="col-9">
                     <h1 class="card-title fw-bold" style="color: #faf7f7; font-size: 35px"><?php echo $pending?></h1>
                     <p class="card-text" style="font-size: 20px">Total Unclaimed</p>
                  </div>
               </div>
            </div>
            <div class="card-footer text-muted text-center">
            </div>
         </div>
      </div>

      <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3 text-end">
         <div class="card bg-warning" style = "height: 27vh;
            background: rgb(52,246,37);
background: linear-gradient(338deg, rgba(52,246,37,1) 0%, rgba(87,247,162,1) 100%);">
            <div class="card-body">
               <div class="row align-items-center h-100">
                  <div class="col-3">
                     <i class="bi bi-truck" style="font-size: 65px; color: white"></i>
                  </div>
                  <div class="col-9">
                     <h1 class="card-title fw-bold" style="color: #faf7f7; font-size: 35px"><?php echo $delivered?></h1>
                     <p class="card-text" style="font-size: 20px">Total Claimed</p>
                  </div>
               </div>
            </div>
            <div class="card-footer text-muted text-center">
            </div>
         </div>
      </div>

      <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3 mb-3 text-end">
         <div class="card bg-warning" style = "height: 27vh;
            background: rgb(255,58,58);
            background: linear-gradient(338deg, rgba(255,58,58,1) 0%, rgba(252,140,140,1) 100%);">
            <div class="card-body">
               <div class="row align-items-center h-100">
                  <div class="col-3">
                     <i class="bi bi-x-circle-fill" style="font-size: 55px; color: white"></i>
                  </div>
                  <div class="col-9">
                     <h1 class="card-title fw-bold" style="color: #faf7f7; font-size: 35px"><?php echo $cancelled?></h1>
                     <p class="card-text" style="font-size: 20px;">Total Cancelled</p>
                  </div>
               </div>
            </div>
            <div class="card-footer text-muted text-center">
            </div>
         </div>
      </div>
   </div>
</div>

</div>
</body>
</html>