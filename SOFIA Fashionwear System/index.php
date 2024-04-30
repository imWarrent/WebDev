<?php
	require('./config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .carousel {
            position: relative;
        }

        .carousel-inner img {
            position: static;
            top: 0;
            left: 0;
            height: 90vh;
            object-fit: cover !important;
            display: block;
        }

        .carousel-item {
            height: 85vh;
        }

        body{
            background-color: #b7e1e8;
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
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="aboutus.php">About Us</a>
        </li>
        <li class="nav-item">
        <li class="nav-item">
        <a class="nav-link"></a>
        </li>
        <li class="nav-item">
            <a href="order.php" class="buy-now btn btn-outline-danger px-4" role="button">Buy Now</a>
        </li>
    </ul>
    </div>
</div>
</nav>

<!--END-->

<!--CAROUSEL-->
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="sofiaimages/Wallpaper/about.jpg" class="d-block w-100" style="filter: grayscale(50%);" alt="...">
    </div>
    <div class="carousel-item">
      <img src="sofiaimages/Wallpaper/thrift.png" class="d-block w-100" style="filter: grayscale(75%);" alt="...">
    </div>
    <div class="carousel-item">
      <img src="sofiaimages/Wallpaper/thrift2.jpg" class="d-block w-100" style="filter: grayscale(75%);" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</body>
</html>