<?php
  require('./config.php');
  session_start();

  if( !isset($_COOKIE['username']) && !isset($_SESSION['username']) ){
    header("location: order.php");
  }

  //cart variable holder
  $userquery = "";
  if(isset($_SESSION["userid"])){$userquery = $_SESSION["userid"];}
  else if(isset($_COOKIE["userid"])){$userquery = $_COOKIE["userid"];}

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

  //end
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
    <button class="navbar-toggler" type="button" style="width:100%" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link" href="order.php">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="myorder.php">My Order</a>
        </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
        <div class="input-group">
        <!-- LEADERBOARD -->
        <li class="nav-item" title = "Leaderboards of active users">
          <a
            class="nav-link mx-2 me-2"
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

<div class="container-fluid mt-4">
<div class="row">
    <div class = "col-12 mb-3">
        <h1>My Order</h1>
    </div>
    <div class="col-12">
        <form action="myorder.php" method="POST">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search Product Name" aria-label="Search Products" aria-describedby="button-addon2">
            <button class="btn btn-danger" style="width: 15vh;" type="submit" id="button-addon2">Search</button>
        </div>
        </form>
    </div>
    <div class="col-12 overflow-auto" style="height: 60vh; background-color: #f2f2f2;">
        <table class="table table-striped" id="myTable">
        <thead class="table-dark" style="position: sticky; top: 0; z-index: 1;">
            <tr>
            <th scope="col" style="text-align:center;vertical-align:middle">Order No</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Product ID</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Product Name</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Quantity</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Total</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Order Status</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "";
                $customerid = 0;

                if(isset($_SESSION["userid"])){$customerid = $_SESSION["userid"];}
                else if(isset($_COOKIE["userid"])){$customerid = $_COOKIE["userid"];}

                if(isset($_POST['search'])){
                    $search = $_POST['search'];

                    if($search == ""){
                        $query = "SELECT * FROM order_data WHERE customer_id = '$customerid' ORDER BY order_status DESC";
                    }
                    else {
                        $query = "SELECT * FROM order_data WHERE `prod_name` LIKE '%$search%' OR `order_no` LIKE '%$search%' AND customer_id = '$customerid' ORDER BY order_status DESC";
                    }
                }
                else{
                    $query = "SELECT * FROM order_data WHERE customer_id = '$customerid' ORDER BY order_status DESC";
                }
                
                $sql = mysqli_query($sqlcon,$query);
                $counter = 0;
                while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                $orid = $row["order_id"]; $id = $row["customer_id"]; $pid = $row["product_id"]; $pname = $row["prod_name"]; $qty = $row["qty"];
                $total = $row["total"]; $orderno = $row["order_no"]; $orderstatus = $row["order_status"]; $rated = $row["rate"]; $counter+=1;?>
                <tr>
                <th scope="row" style="width: 20vh; text-align:center;vertical-align:middle"><?php echo "$orderno"?></th>
                <td style="width: 40vh; text-align:center; vertical-align:middle"><?php echo "$pid"?></td>
                <td style="width: 40vh; text-align:center; vertical-align:middle"><?php echo "$pname"?></td>
                <td style="width: 40vh; text-align:center; vertical-align:middle"><?php echo "$qty"?></td>
                <td style="width: 40vh; text-align:center;vertical-align:middle"><?php echo "$total"?></td>
                <td style="width: 40vh; text-align:center;vertical-align:middle"><?php 

                if($orderstatus == "PENDING"){
                  echo "UNCLAIMED";
                }
                else if($orderstatus == "DELIVERED"){
                  echo "CLAIMED";
                }
                else{
                  echo "CANCELLED";
                }
                ?>
                </td>
                <td style="width: 40vh; text-align:center;vertical-align:middle">

                  <?php

                  if($orderstatus == "DELIVERED" && $rated == "NOT"){
                    echo '<button style="vertical-align:middle;width: 20vh; margin-top: 5px;" type="button" class="openupModal btn btn-warning"  data-toggle="modal" data-target="#rateModal";  data-dismiss="modal";>Rate</button></a>';
                  }
                  else if($orderstatus == "DELIVERED" && $rated == "DONE"){
                    echo '<button style="vertical-align:middle; width: 20vh; margin-top: 5px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#doneModal";>Claimed</button>';
                  }
                  else if($orderstatus == "CANCELLED"){
                    echo '<button style="vertical-align:middle; width: 20vh; margin-top: 5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">Details</button>';
                  }
                  else{
                    echo '<button  onclick="getIDs(this)" value='.$orid.' style="vertical-align:middle; width: 20vh; margin-top: 5px;" type="button" class="openupModal btn btn-warning" data-toggle="modal" data-target="#cancelOrdModal">Cancel Order</button>';
                  }
                  ?>
                  
                </td>
                </tr>
            <?php }?>
        </tbody>
        </table>
        </div>
    </div>

</div>
</div>
</body>
</html>

<!-- Modal Rate-->
<div class="modal fade" id="rateModal" tabindex="-1" role="dialog" data-backdrop='static' aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productname"></h5>
      </div>
      <div class="modal-body">
        
      <div class="alert alert-info mb-3" role="alert">
          Your feedback is highly appreciated and will help us to improve our products.
        </div>
        <p for="exampleInputEmail1">Product Rating: </p>
        <form action = "executionFile/rate.php" method = "POST">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="1">
          <label class="form-check-label" for="inlineRadio1">1</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="2">
          <label class="form-check-label" for="inlineRadio1">2</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="3">
          <label class="form-check-label" for="inlineRadio1">3</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="4">
          <label class="form-check-label" for="inlineRadio1">4</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="5" checked>
          <label class="form-check-label" for="inlineRadio1">5</label>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
          <input type="hidden" id="rateID" name="rateID" value=""/>
          <input type="hidden" id="orderno" name="orderno" value=""/>
          <button type="submit" class="btn btn-warning" id ="adders">Rate</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Done-->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productname">SOFIA Order</h5>
      </div>
      <div class="modal-body">
        <div class="alert alert-info mb-3" role="alert">
          This order delivered succesfully, Thank you for supporting our business!
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
          <button type="button" data-dismiss="modal" class="btn btn-primary">You're welcome!</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cancel-->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productname">SOFIA Order</h5>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger mb-3" role="alert">
          This order has been cancelled.
          <br><br>
          Possible Reasons:<br><br>
          - You cancel the order.<br>
          - The seller cancel the order.

        </div>
      </div>
      <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
          <button type="button" data-dismiss="modal" class="btn btn-danger">I Understand</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cancel Order-->
<div class="modal fade" id="cancelOrdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ord-name"></h5>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger mb-3" role="alert">
          Are you sure you're going to cancel this order?
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">No</button>
          <form action = "executionFile/cancelorder.php" method="POST">
            <input type="hidden" id="cancel-ords" name="cancel-ords" value=""/>
            <input type="hidden" id="cancel-ordno" name="cancel-ordno" value=""/>
            <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $("#myTable").on('click','.openupModal',function () {
        var currentRow=$(this).closest("tr");
        var name = currentRow.find("td:eq(1)").text();
        var id = currentRow.find("td:eq(0)").text();
        var oid = currentRow.find("th:eq(0)").text();


        document.getElementById("productname").innerHTML = name;
        document.getElementById("ord-name").innerHTML = name + " (ORDER NO. "+oid+")";

        document.getElementById("rateID").value = id;
        document.getElementById("orderno").value = oid;
        document.getElementById("cancel-ordno").value = oid;
    });

    function getIDs(button){
      document.getElementById("cancel-ords").value = button.value;
    }
</script>