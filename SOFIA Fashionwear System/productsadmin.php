<?php
   include "config.php";
   session_start();
   if(!isset($_SESSION['loggedin'])){
      echo header('Location: ./adminlogin.php');
   }
?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
</head>

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
        <a class="nav-link active" aria-current="page" href="productsadmin.php">Products</a>
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

<!--PRODUCTS-->
<div class="container-fluid mt-4">
<div class="row">
    <div class = "col-12 mb-3">
    <h1>SOFIA Products</h1>
    </div>
    <div class="col-12">
        <form action="mycart.php" method="POST">
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
            <th scope="col" style="text-align:center;vertical-align:middle;display:none;">Product ID</th>
            <th scope="col" style="text-align:center;vertical-align:middle;display:none;">Product Name</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Image</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Description</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Price</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Ratings</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Category</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Release Date</th>
            <th scope="col" style="text-align:center;vertical-align:middle">Stocks</th>
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
                        $query = "SELECT * FROM product_data";
                    }
                    else {
                        $query = "SELECT * FROM product_data WHERE `product_name` LIKE '%$search%' OR `product_data` LIKE '%$search%'";
                    }
                }
                else{
                    $query = "SELECT * FROM product_data";
                }
                
                $sql = mysqli_query($sqlcon,$query);
                $counter = 0;
                while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                    $id = $row["product_id"]; $pname = $row["product_name"]; 
                    $price= $row["price"];  $rate = $row["ratings"];
                    $imgpath = $row["image_path"]; $desc = $row['description']; 
                    $small = $row['small']; $medium = $row['medium']; $large = $row['large'];
                    $category = $row['category']; $release = $row['release_date'];

                    $counter+=1;?>
                    <tr>
                    <th scope="row" style="width: 30vh; text-align:center;vertical-align:middle;display:none;"><?php echo "$id"?></th>
                    <td style="width: 40vh; text-align:center; vertical-align:middle;display:none;"><?php echo "$pname"?></td>
                    <td style="width: 40vh; text-align:center; vertical-align:middle">
                    <img style="width: 20vh;" src="<?php echo "$imgpath"?>">
                    </td>
                    <td style="width: 40vh; text-align:center; vertical-align:middle"><?php echo "$desc"?></td>
                    <td style="width: 40vh; text-align:center; vertical-align:middle"><?php echo "$price"?></td>
                    <td style="width: 40vh; text-align:center; vertical-align:middle"><?php echo "$rate"?></td>
                    <td style="width: 40vh; text-align:center; vertical-align:middle"><?php echo "$category"?></td>
                    <td style="width: 40vh; text-align:center; vertical-align:middle"><?php echo "$release"?></td>
                    <td style="width: 40vh; text-align:center;vertical-align:middle"><button style="vertical-align:middle; width: 12vh; margin-top: 5px;" type="button" class="openupModal btn btn-success" onclick="stocks()" data-toggle="modal" data-target="#checkModal">Check</button></td>
                    <td style="width: 40vh; text-align:center;vertical-align:middle">
                        <input type="hidden" value="<?php echo $small?>" id = "small<?php echo $id?>">
                        <input type="hidden" value="<?php echo $medium?>" id = "medium<?php echo $id?>">
                        <input type="hidden" value="<?php echo $large?>" id = "large<?php echo $id?>">
                        <button style="vertical-align:middle; width: 12vh; margin-top: 5px;" type="button" class="openupModal btn btn-secondary" onclick="updateProd()" data-toggle="modal" data-target="#updateModal">EDIT</button>
                        <button style="vertical-align:middle; width: 12vh; margin-top: 5px;" type="button" class="openupModal btn btn-info" onclick="deleteProd()" data-toggle="modal" data-target="#deleteModal">ARCHIVE</button>
                    </td>
                    </tr>
            <?php }?>
        </tbody>
        </table>
        </div>
        <div class="d-flex flex-column-reverse">
            <div class="align-self-end">
                <button style="vertical-align:middle; margin-top: 10px; width: 30vh;" type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal">Add Product</button>
            </div>
        </div>
    </div>

</div>
</div>
</body>
</html>

<!-- Modal AddProd-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productname">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="executionFile/addprod.php" method="POST" enctype='multipart/form-data'>
          <div class="form-group">
            <label for="product-id" class="col-form-label">ID:</label>
            <input type="text" class="form-control" id="add-id" name="add-id" value="Automatically Generated" readonly>
          </div>
          <div class="form-group">
            <label for="formFile" class="col-form-label">Product Thumbnail:</label>
            <input class="form-control" type="file" id="add-img" name="add-img" accept=".jpg,.png" required>
          </div>
          <div class="form-group">
            <label for="formFile" class="col-form-label">Front Image (Optional):</label>
            <input class="form-control" type="file" id="add-front" name="add-front" accept=".jpg,.png">
          </div>
          <div class="form-group">
            <label for="formFile" class="col-form-label">Back Image (Optional):</label>
            <input class="form-control" type="file" id="add-back" name="add-back" accept=".jpg,.png">
          </div>
          <div class="form-group">
            <label for="product-name" class="col-form-label">Product Name:</label>
            <input type="text" class="form-control" id="add-name" name="add-name" required>
          </div>
          <div class="form-group">
            <label for="product" class="col-form-label">Description:</label>
            <input type="text" class="form-control" id="add-desc" name="add-desc" required>
          </div>
          
          <div class="form-group">
          <label for="date" class="col-form-label">Category:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Category" name="add-cat" id="add-cat" aria-label="Username" aria-describedby="basic-addon1" readonly required>
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-menu-button-wide-fill"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" onclick="category('Tops')">Tops</a>
                  <a class="dropdown-item" onclick="category('Bottoms')">Bottoms</a>
                  <a class="dropdown-item" onclick="category('Footwear')">Footwear</a>
                  <a class="dropdown-item" onclick="category('Dresses')">Dresses</a>
                  <a class="dropdown-item" onclick="category('Accessories')">Accessories</a>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="date" class="col-form-label">Release Date:</label>
            <input type="date" class="form-control" id="add-date" name="add-date" value="12/13/2001" required>
          </div>


          <div class="form-group">
            <label for="price" class="col-form-label">Price:</label>
            <div class="input-group mb-3">
                <span class="input-group-text">₱</span>
                <input type="number" step=".01" min="0" class="form-control" id="add-price" name="add-price" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Check-->
<div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productname">Add Stocks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="executionFile/upstock.php" method="POST" enctype='multipart/form-data'>
          <div class="form-group">
            <label for="product-id" class="col-form-label">Product ID:</label>
            <input type="text" class="form-control" id="check-id" name="check-id" readonly>
          </div>
          <div class="form-group">
            <label for="product-name" class="col-form-label">Product Name:</label>
            <input type="text" class="form-control" id="check-name" name="check-name" readonly>
          </div>
          <div class="form-group">
            <label for="small" class="col-form-label">Stocks Per Size:</label>
            <div class="input-group mb-3">
                <span class="input-group-text">S</span>
                <input type="number" min="0" class="form-control" id="check-small" name="check-small" required>

                <span class="input-group-text">M</span>
                <input type="number" min="0" class="form-control" id="check-medium" name="check-medium" required>

                <span class="input-group-text">L</span>
                <input type="number" min="0" class="form-control" id="check-large" name="check-large" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update Stocks</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="del-name"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Are you sure you want to delete this item?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="executionFile/deleteproduct.php" method="POST">
            <input type="hidden" id="del-id" name="del-id" value=""/>
            <button type="submit" class="btn btn-danger">Delete Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal UpdateProd-->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productname">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="executionFile/upprod.php" method="POST" enctype='multipart/form-data'>
          <div class="form-group">
            <label for="up-id" class="col-form-label">ID:</label>
            <input type="text" class="form-control" id="up-id" name="up-id" readonly>
          </div>
          <div class="form-group">
            <label for="formFile" class="col-form-label">Product Thumbnail:</label>
            <input class="form-control" type="file" id="up-img" name="up-img" accept=".jpg,.png">
          </div>
          <div class="form-group">
            <label for="formFile" class="col-form-label">Front Image (Optional):</label>
            <input class="form-control" type="file" id="up-front" name="up-front" accept=".jpg,.png">
          </div>
          <div class="form-group">
            <label for="formFile" class="col-form-label">Back Image (Optional):</label>
            <input class="form-control" type="file" id="up-back" name="up-back" accept=".jpg,.png">
          </div>
          <div class="form-group">
            <label for="product-name" class="col-form-label">Product Name:</label>
            <input type="text" class="form-control" id="up-name" name="up-name" required>
          </div>
          <div class="form-group">
            <label for="category" class="col-form-label">Description:</label>
            <input type="text" class="form-control" id="up-desc" name="up-desc" required>
          </div>

          <div class="form-group">
          <label for="date" class="col-form-label">Category:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Category" name="up-cat" id="up-cat" aria-label="Username" aria-describedby="basic-addon1" readonly required>
              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-menu-button-wide-fill"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" onclick="category('Tops')">Tops</a>
                  <a class="dropdown-item" onclick="category('Bottoms')">Bottoms</a>
                  <a class="dropdown-item" onclick="category('Footwear')">Footwear</a>
                  <a class="dropdown-item" onclick="category('Dresses')">Dresses</a>
                  <a class="dropdown-item" onclick="category('Accessories')">Accessories</a>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="date" class="col-form-label">Release Date:</label>
            <input type="date" class="form-control" id="up-date" name="up-date" required>
          </div>

          <div class="form-group">
            <label for="price" class="col-form-label">Price:</label>
            <div class="input-group mb-3">
                <span class="input-group-text">₱</span>
                <input type="number" step=".01" min="0" class="form-control" id="up-price" name="up-price" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning">Update Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $("#myTable").on('click','.openupModal',function () {
        var currentRow=$(this).closest("tr");
        var id = currentRow.find("th:eq(0)").text();
        var name = currentRow.find("td:eq(0)").text();
        var desc = currentRow.find("td:eq(2)").text();
        var price = currentRow.find("td:eq(3)").text();
        var category = currentRow.find("td:eq(5)").text();
        var release = currentRow.find("td:eq(6)").text();

        var small =  document.getElementById("small"+id).value;
        var medium =  document.getElementById("medium"+id).value;
        var large =  document.getElementById("large"+id).value;


        //FOR STOCKS
        document.getElementById("check-id").value = id;

        document.getElementById("check-name").value = name;

        document.getElementById("check-small").value = small;
        document.getElementById("check-medium").value = medium;
        document.getElementById("check-large").value = large;

        //FOR DELETE
        document.getElementById("del-id").value = id;
        document.getElementById("del-name").innerHTML = name;

        //FOR UPDATE
        document.getElementById("up-id").value = id;
        document.getElementById("up-name").value = name;
        document.getElementById("up-desc").value = desc;
        document.getElementById("up-price").value = price;
        document.getElementById("up-cat").value = category;
        document.getElementById("up-date").value = release;

    });

    function category(value){
      document.getElementById("add-cat").value = value;
      document.getElementById("up-cat").value = value;
    }
</script>