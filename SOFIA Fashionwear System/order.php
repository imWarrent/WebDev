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
    $password = md5($_POST['password']);
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
  
  //date basis
  $expDate = date("Y-m-d");

  //get total quantity of expired carts to return stocks
  $queryGetStocks = "SELECT * FROM `cart` WHERE `expiration` < '$expDate'";
  $sqlExps = mysqli_query($sqlcon,$queryGetStocks);
  while ($sqlExp = mysqli_fetch_array($sqlExps, MYSQLI_ASSOC)){
    $retSize = $sqlExp['size']; $retQty = $sqlExp['qty']; $retID = $sqlExp['product_id'];
    //adding stocks
    $stocksUpdate = "UPDATE `product_data` SET $retSize = $retSize + $retQty WHERE product_id = '$retID'";
    $sqlead = mysqli_query($sqlcon,$stocksUpdate);
  }

  //deleting expired carts
  $expiredCart = "DELETE FROM cart WHERE `expiration` < '$expDate'";
  $sqlExp = mysqli_query($sqlcon,$expiredCart);


  $leader = "SELECT `user_table`.`ID` AS 'ID', `user_table`.`name` AS 'name', SUM(`order_data`.`qty`) AS 'total' FROM `user_table` INNER JOIN `order_data` ON `user_table`.`ID` = `order_data`.`customer_id` WHERE `order_data`.`order_status` = 'DELIVERED' GROUP BY `user_table`.`name` ORDER BY SUM(`order_data`.`qty`) DESC LIMIT 20";
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
        <a class="nav-link active" href="order.php">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="myorder.php">My Order</a>
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
<div class="container mt-5">
    <div class="row">
      <div class = "col-12 mb-3">
        <h1>Sofia Fashionwear</h1>
      </div>
      <div class="col-12">
          <form action="order.php" method="GET">
          <div class="input-group mb-5">
              <input type="text" style="height: 50px;" name="search" class="form-control" placeholder="Search Product Name" aria-label="Search Products" aria-describedby="button-addon2">
                <button class="btn btn-secondary dropdown-toggle" style="width: 10vh;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bi bi-filter" style="font-size: 3.5vh;"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="padding: 2vh">
                  <p>Category</p>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category" value="All" checked>
                    <label class="form-check-label" for="category">
                      All
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category" value="Tops">
                    <label class="form-check-label" for="category">
                      Tops
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category" value="Bottoms">
                    <label class="form-check-label" for="category">
                      Bottoms
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category" value="Footwear">
                    <label class="form-check-label" for="category">
                      Footwear
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category" value="Dresses">
                    <label class="form-check-label" for="category">
                      Dresses
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category" value="Accessories">
                    <label class="form-check-label" for="category">
                      Accessories
                    </label>
                  </div>
                  <hr>
                  <p>Price Range</p>
                  <div class="input-group input-group-sm mb-3">
                      <input type="number" min="0" class="form-control" name="low" id="low" style="width: 1vh" placeholder="Lowest" onchange 
                        onpropertychange 
                        onkeyuponpaste oninput="priceRange('Low')">
                      <input type="number" min="0" class="form-control" name="high" id="high" placeholder="Highest" onchange 
                        onpropertychange 
                        onkeyuponpaste oninput="priceRange('High')">
                  </div>
            </div>
              <button class="btn btn-dark" style="width: 15vh; padding: 5px;" type="submit" id="button-addon2">Search</button>
          </div>
          </form>
          <?php
            if(isset($_GET['search'])){
              $search = $_GET['search']; $lows = $_GET['low']; $highs = $_GET['high']; $cats = $_GET['category'];
              
              if($search != "" && $lows != "" && $highs != "" && $cats != "All"){
                echo "Filter Search: ".$search." / Category: ".$cats." / Price Range: ".$lows." - ".$highs;
              }
              else if($search != "" && $cats != "All"){
                echo "Filter Search: ".$search." / Category: ".$cats;
              }
              else if($search != "" && $lows != "" && $highs != ""){
                echo "Filter Search: ".$search." / Price Range: ".$lows." - ".$highs;
              }
              else if($search != ""){
                echo "Filter Search: ".$search;
              }
            }
          ?>
      </div>
    </div>
</div>
<div class="container">
<div class="row">
  <?php
    $query = "SELECT * FROM product_data WHERE ";
    $datetoday = date("Y-m-d");
    if(isset($_GET['search'])){
        $search = $_GET['search']; $lows = $_GET['low']; $highs = $_GET['high']; $cats = $_GET['category'];

        if($search != "" || $cats != "All" || $lows != ""){
          if($search != ""){
            $query .= " `product_name` LIKE '%$search%' AND";
          }

          if($cats != "All"){
            $query .= " `category` = '$cats' AND";
          }

          if($highs != "" && $lows != ""){
            $query .= " (`price` >= $lows AND `price` <= $highs) AND";
          }
        }
    }
    $query .= " (small >= 1 OR medium >= 1 OR large >= 1) AND `release_date` <= '$datetoday';";

    //echo $query;
    $sql = mysqli_query($sqlcon,$query);
    $counter = 0;
  while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
    $id = $row['product_id']; $name = $row['product_name']; $desc = $row['description']; $cat = $row['category']; $price = $row['price']; $rating = $row['ratings'];
    $imgpath = $row['image_path']; $frontpath = $row['front_image']; $backpath = $row['back_image']; $sm = $row['small']; $md = $row['medium']; $lg = $row['large']; $counter++;
  ?>
  <div class="col-12 col-sm-6 col-md-6 col-lg-4 d-flex justify-content-center mb-5">
    <div id="containers">
      <div class="col-3">
        <div class="card" id="cards">
          <div class="imgBx">
            <img src="<?php echo $imgpath?>">
          </div>
          <div class="contentBx">
            <h2 id="prodName<?php echo $id?>"><?php echo $name ?></h2>
            <div class="size" id="sizes">
              <h3>Description : <?php echo $desc ?></h3>
            </div>
            <div class="color" id="colors">
              <h3 style="color:#f09f3c"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>  Ratings : <?php echo $rating ?></h3>
            </div>
            <div class="color mb-3" id="colors">
              <h3>Price : ₱<?php echo $price ?></h3>
              <input type="hidden" id="prodPrice<?php echo $id ?>" value="<?php echo $price?>">
              <input type="hidden" id="prodID<?php echo $id?>" value="<?php echo $id?>">

              <!--SIZES-->
              <input type="hidden" id="sm<?php echo $id?>" value="<?php echo $sm?>">
              <input type="hidden" id="md<?php echo $id?>" value="<?php echo $md?>">
              <input type="hidden" id="lg<?php echo $id?>" value="<?php echo $lg?>">
              <input type="hidden" id="cat<?php echo $id?>" value="<?php echo $cat?>">

              <!--PRODUCT IMAGES-->
              <input type="hidden" id="front<?php echo $id?>" value="<?php echo $frontpath?>">
              <input type="hidden" id="back<?php echo $id?>" value="<?php echo $backpath?>">
            </div>
            <?php
            if(isset($_COOKIE['username']) || isset($_SESSION['username'])){
             echo "<button type='button' id='addCarts' onclick='addCartz(this);' 
             value='$id' class='btn btn-warning' data-toggle='modal' data-target='#addModal'>Add to cart</button>";
            }
            else{
              echo "<a href='' data-toggle='modal' data-target='#exampleModalCenter' class='mt-3'>Add to Cart</a>";
            }
            ?>
            </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
    
  } 
  if($counter == '0'){
    echo "<center><br><br><b>No product available.</b></center>";
  }
  ?>
</div>
</div>

<!--LOGIN MODAL-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" data-backdrop='static' data-keyboard='false' role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Login to your SOFIA Store Account</h5>
      </div>
      <div class="modal-body">
      <div class="alert alert-info" role="alert">
        You should logged in to your SOFIA Account to access the Store.
      </div>
        <form action="order.php" method="POST">
        <p for="exampleInputEmail1">Username</p>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="username" name="username" aria-label="Username" required>
        </div>
        <p for="exampleInputEmail1">Password</p>
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" aria-label="Password" required>
        </div>
        <?php
          if($error != 0){
            echo '<div class="alert alert-danger" role="alert">
              Invalid Username/Password.
            </div>';
          }
        ?>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" name="keeplogin" id="defaultCheck1">
        <label class="form-check-label" for="defaultCheck1">
            Keep me logged in
        </label>
        </div>
        <p class="mt-4">Don't have an account? <a href="register.php">Signup here</a>.</p>
      </div>
      <div class="modal-footer">
        <a href="index.php"><button type="button" class="btn btn-secondary">Back</button></a>
        <button type="submit" class="btn btn-danger">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>

<!-- Modal Add-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" data-backdrop='static' aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productname"></h5>
      </div>
      <div class="row">

        <div class="col-sm-12 col-md-5 p-4 modal-body">
          <div id="carouselExampleControls" class="carousel" data-ride="carousel">
            <div class="carousel-inner" style="height: 38vh; align-item: center">
              <div class="carousel-item active">
                <img class="d-block m-auto" src="" id="frontimg" alt="First slide" style="height:40vh;">
              </div>
              <div class="carousel-item">
                <img class="d-block m-auto" src=""id="backimg" alt="Second slide" style="height:40vh;">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only"></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only"></span>
            </a>
          </div>
        </div>
        <div class="col-7 p-4 modal-body">
              <form action="executionFile/addcart.php" method="POST">

              <div id="genderDIV">
                <p for="exampleInputEmail1">Gender</p>
                <div class="input-group mb-3">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" onclick="changeGender('Men')" name="gender" checked>
                    <label class="form-check-label" for="inlineRadio1">Men</label>
                  </div><br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" onclick="changeGender('Women')" name="gender">
                    <label class="form-check-label" for="inlineRadio2">Woman</label>
                  </div><br>
                </div>
              </div>

              <p for="exampleInputEmail1">Sizes</p>
              <div class="input-group mb-3">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" onclick="radioSize(this)" name="productSizes" id="smz" value="Small">
                  <label class="form-check-label" for="inlineRadio1" id="smlabel">Small</label>
                </div><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" onclick="radioSize(this)" name="productSizes" id="mdz" value="Medium">
                  <label class="form-check-label" for="inlineRadio2" id="mdlabel">Medium</label>
                </div><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" onclick="radioSize(this)" name="productSizes" id="lgz" value="Large">
                  <label class="form-check-label" for="inlineRadio3" id="lglabel">Large</label>
                </div>
              </div>
              <p for="exampleInputEmail1">Quantity</p>
              <div class="input-group mb-3">
                  <input type="number" class="form-control" id="qtyy" min="1" name="qty" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="0"
                    onchange 
                    onpropertychange 
                    onkeyuponpaste oninput="total()">
              </div>
              <p for="exampleInputEmail1">Price</p>
              <div class="input-group mb-3">
                  <span class="input-group-text">₱</span>
                  <input type="text" class="form-control" id="totalpricee" name="totalprice" aria-label="Amount (to the nearest dollar)" readonly>
                  <input type="hidden" class="form-control" id="actualprice">

                  <!--FOR SIZES--> 
                  <input type="hidden" class="form-control" id="sms" value="">
                  <input type="hidden" class="form-control" id="mds" value="">
                  <input type="hidden" class="form-control" id="lgs" value="">
              </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="order.php"><button type="button" class="btn btn-secondary">Close</button></a>
        <input type="hidden" id="modalID" name="modalID" value=""/>
        <button type="submit" class="btn btn-danger" id ="adders">Add to cart</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function addCartz(button){
    var id= document.getElementById("prodID".concat(button.value)).value;
    var name = document.getElementById("prodName".concat(button.value)).innerHTML;
    var price = document.getElementById("prodPrice".concat(button.value)).value;

    var gender = document.getElementById("genderDIV");
    var category = document.getElementById("cat".concat(button.value)).value;

    if(category == 'Footwear'){
      gender.style.display = "block";
      changeGender('Men');
    }
    else{
      gender.style.display = "none";
    }

    //for images
    let frontimg = document.getElementById("front".concat(button.value)).value;
    let backimg = document.getElementById("back".concat(button.value)).value;

    //sizes
    const small = document.getElementById("smz");
    const medium = document.getElementById("mdz");
    const large = document.getElementById("lgz");
    const qty = document.getElementById("qtyy");

    //sizes value
    var smalls = document.getElementById("sm".concat(button.value)).value;
    var mediums = document.getElementById("md".concat(button.value)).value;
    var larges = document.getElementById("lg".concat(button.value)).value;

    if(smalls > 0){document.getElementById("qtyy").value = "1"; small.checked = true; qty.max = smalls;}
    else if(mediums > 0){document.getElementById("qtyy").value = "1"; medium.checked = true; qty.max = mediums;}
    else if(larges > 0){document.getElementById("qtyy").value = "1"; large.checked = true; qty.max = larges;}

    if(smalls == 0){small.disabled = true;}
    if(mediums == 0){medium.disabled = true;}
    if(larges == 0){large.disabled = true;}

    document.getElementById("modalID").value = id;
    document.getElementById("productname").innerHTML = name;
    document.getElementById("totalpricee").value = price;
    document.getElementById("actualprice").value = price;

    document.getElementById("sms").value = smalls;
    document.getElementById("mds").value = mediums;
    document.getElementById("lgs").value = larges;

    if(frontimg != "sofiaimages/Products/"){
      document.getElementById("frontimg").src = frontimg;
    }
    else{
      document.getElementById("frontimg").src = "sofiaimages/wallpaper/noimg.png";
    }

    if(backimg != "sofiaimages/Products/"){
      document.getElementById("backimg").src = backimg;
    }
    else{
      document.getElementById("backimg").src = "sofiaimages/wallpaper/noimg.png";
    }
    
  }

  function increase(){
      var maxQty = 10;
      if(document.getElementById("qtyy").value >= 1 && document.getElementById("qtyy").value != maxQTY){
          let val = Number(document.getElementById("qtyy").value) + Number(1);
          let price = Number(document.getElementById("actualprice").value) * val;
          document.getElementById("qtyy").value = val;
          document.getElementById("totalpricee").value = price;
      }
  }

  function changeGender(gender){
    if(gender == "Men"){
      document.getElementById("smlabel").innerHTML = "Small (8-10)"
      document.getElementById("mdlabel").innerHTML = "Medium (11-13)"
      document.getElementById("lglabel").innerHTML = "Large (14-15)"
    }
    else if (gender == "Women"){
      document.getElementById("smlabel").innerHTML = "Small (5-7)"
      document.getElementById("mdlabel").innerHTML = "Medium (8-10)"
      document.getElementById("lglabel").innerHTML = "Large (11-12)"
    }
  }

  function total() {
    var price = document.getElementById("actualprice").value;
    var qty = document.getElementById("qtyy").value;
    var total = qty * price;

    document.getElementById("totalpricee").value = total;
  }
  
  function radioSize(myRadio){
    var x = document.getElementById("sms").value;
    var y = document.getElementById("mds").value;
    var z = document.getElementById("lgs").value;
    const qty = document.getElementById("qtyy");

    if(myRadio.value == "Small"){
      qty.value = 1;
      qty.max = x;
    }
    else if(myRadio.value == "Medium"){
      qty.value = 1;
      qty.max = y;
    }
    else if(myRadio.value == "Large"){
      qty.value = 1;
      qty.max = z;
    }
  }

  function priceRange(item){
    var lowest = document.getElementById("low").value;
    var highest = document.getElementById("high").value;
    var x = lowest + 100;

    if(item == "Low" && highest == ""){
      document.getElementById("high").value = 100;
    }
    else if (item == "High" && lowest == ""){
      document.getElementById("low").value = 0;
    }

    document.getElementById("high").min = parseInt(lowest) + 1;
    document.getElementById("low").max = parseInt(highest) - 1;
  }
</script>