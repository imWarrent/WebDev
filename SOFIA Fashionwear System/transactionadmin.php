<?php
   include "config.php";
   session_start();
   if(!isset($_SESSION['loggedin'])){
      echo header('Location: ./adminlogin.php');
   }
?>

<style>
  body{
    background: rgb(131,199,210);
    background: linear-gradient(7deg, rgba(131,199,210,1) 0%, rgba(183,225,232,1) 49%);
  }

  .navbar{
    background: rgb(180,226,233);
    background: linear-gradient(7deg, rgba(180,226,233,1) 0%, rgba(217,243,247,1) 60%);
  }
</style>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
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
        <a class="nav-link" aria-current="page" href="adminindex.php">Dashboard</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="productsadmin.php">Products</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="ordersadmin.php">Orders</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="transactionadmin.php">Transactions</a>
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

<!--PRODUCTS-->
<div class="container-fluid mt-4">
<div class="row">
    <div class = "col-12 mb-3">
    <h1>SOFIA Transactions</h1>
    </div>
    <div class="col-12">
        <form action="transactionadmin.php" method="POST">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search Product Name" aria-label="Search Products" aria-describedby="button-addon2">
            <select class="form-select" name="status" aria-label="Default select example">
                <option selected value="ALL">ALL</option>
                <option value="DELIVERED">DELIVERED</option>
                <option value="CANCELLED">CANCELLED</option>
            </select>
            <button class="btn btn-danger" style="width: 15vh;" type="submit" id="button-addon2">Search</button>
        </div>
        </form>
    </div>
    <div class="col-12 overflow-auto" style="height: 60vh; background-color: #f2f2f2;">
        <table class="table table-striped" id="myTable">
        <thead class="table-dark" style="position: sticky; top: 0; z-index: 1;">
            <tr>
            <th scope="col" style="text-align:center;vertical-align:middle">Order ID</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Customer ID</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Product ID</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Product Name</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Quantity</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Total</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Transaction No</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Order Status</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "";

                if(isset($_POST['search'])){
                    $search = $_POST['search'];
                    $status = $_POST['status'];

                    if($search == "" && $status != "ALL"){
                        $query = "SELECT * FROM order_data WHERE order_status = '$status'";
                    }
                    else if($search == "" && $status = "ALL"){
                        $query = "SELECT * FROM order_data WHERE order_status != 'PENDING' ORDER BY order_status DESC";
                    }
                    else if($search != "" && $status != "ALL"){
                        $query = "SELECT * FROM order_data WHERE (`prod_name` LIKE '%$search%' OR order_no = '$search') AND order_status = '$status'";
                    }
                    else if($search != ""){
                        $query = "SELECT * FROM order_data WHERE `prod_name` LIKE '%$search%' OR order_no = '$search' AND order_status != 'PENDING' ORDER BY order_status DESC";
                    }
                }
                else{
                    $query = "SELECT * FROM order_data WHERE order_status != 'PENDING' ORDER BY order_status DESC";
                }
                
                $sql = mysqli_query($sqlcon,$query);
                $counter = 0;
                while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                $oid = $row['order_id']; $id = $row["customer_id"]; $pid = $row["product_id"]; $pname = $row["prod_name"]; $qty = $row["qty"];
                $total = $row["total"]; $orderno = $row["order_no"]; $orderstatus = $row["order_status"]; $rated = $row["rate"]; $counter+=1;?>
                <tr>
                <th scope="row" style="width: 20vh; text-align:center;vertical-align:middle"><?php echo "$oid"?></th>
                <td style="width: 20vh; text-align:center; vertical-align:middle"><?php echo "$id"?></td>
                <td style="width: 20vh; text-align:center; vertical-align:middle"><?php echo "$pid"?></td>
                <td style="width: 40vh; text-align:center; vertical-align:middle"><?php echo "$pname"?></td>
                <td style="width: 20vh; text-align:center; vertical-align:middle"><?php echo "$qty"?></td>
                <td style="width: 40vh; text-align:center;vertical-align:middle"><?php echo "$total"?></td>
                <td style="width: 40vh; text-align:center;vertical-align:middle"><?php echo "$orderno"?></td>
                <td style="width: 40vh; text-align:center;vertical-align:middle; 
                <?php if($orderstatus == "PENDING"){echo 'color: #cf550e;';} else if ($orderstatus == "DELIVERED"){echo 'color:green;';} else if ($orderstatus == "CANCELLED"){echo 'color:red;';} ?>">
                
                <?php echo "$orderstatus"?></td>
                <td style="width: 40vh; text-align:center;vertical-align:middle; <?php if($orderstatus == "PENDING"){echo 'color: #cf550e;';} else if ($orderstatus == "DELIVERED"){echo 'color:green;';} else if ($orderstatus == "CANCELLED"){echo 'color:red;';} ?>"">

                  <?php
                    if($orderstatus == "DELIVERED"){
                        echo 'ORDER COMPLETE';
                    }
                    else if($orderstatus == "CANCELLED"){
                        echo 'ORDER CANCELLED';
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

<!-- Modal SUCCESS-->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="com-name"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Orders Complete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="executionFile/orderstat.php" method="POST">
            <input type="hidden" id="com-id" name="com-id" value=""/>
            <input type="hidden" id="com-cusid" name="cusid" value=""/>
            <input type="hidden" id="can-oid" name="oid" value=""/>
            <input type="hidden" id="stats" name="stats" value="DELIVERED"/>
            <button type="submit" class="btn btn-success">Complete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal CANCEL-->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="can-name"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Do you really want to cancel this order?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="executionFile/orderstat.php" method="POST">
            <input type="hidden" id="can-id" name="can-id" value=""/>
            <input type="hidden" id="can-cusid" name="cusid" value=""/>
            <input type="hidden" id="can-oid" name="oid" value=""/>
            <input type="hidden" id="stats" name="stats" value="CANCELLED"/>
            <button type="submit" class="btn btn-danger">Cancel Order</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $("#myTable").on('click','.openupModal',function () {
        var currentRow=$(this).closest("tr");
        var id = currentRow.find("th:eq(0)").text();
        var custid = currentRow.find("td:eq(0)").text();
        var ono = currentRow.find("td:eq(5)").text();
        var name = currentRow.find("td:eq(2)").text();

        //FOR STOCKS
        document.getElementById("can-name").innerHTML = name + " (ORDER NO. "+ono+")";
        document.getElementById("can-id").value = id;

        document.getElementById("com-name").innerHTML = name + " (ORDER NO. "+ono+")";
        document.getElementById("com-id").value = id;

        document.getElementById("can-cusid").value = custid;
        document.getElementById("com-cusid").value = custid;

        document.getElementById("can-oid").value = ono;
        document.getElementById("com-oid").value = ono;
    });
</script>
