<?php
	require('./config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
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
        <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="aboutus.php">About Us</a>
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

<!--About Us-->
<div class="col-12 .justify-content-center" style="height:40vh; background-image: url('sofiaimages/Wallpaper/about.jpg'); background-position: center; background-size: cover; filter: brightness(50%);">
</div>

<div class="container-fluid">
<div class="row">
<div class="d-none d-md-block .d-xl-none col-2"></div>
<div class="col-md-12 col-lg-8 mt-5 ml-3 mr-3">
    <h1 class="mb-5">About Us</h1>
    <p class="m-auto" style="font-size: 20px; color: gray;">Sofia Fashionwear is a Philippine store located in the city of Malolos Bulacan that was established on the year 2007
wherein there is an online thrift shop apparel such as clothes, shoes, toys are sold at cheaper prices.
The name of the Owner is Ms. Mary May Ramos. The store is located at RRV7, F9J, Lucero St. Malolos, Bulacan.</p>
</div>
<div class="d-none d-md-block .d-xl-none col-2"></div>
<div class="col-12 text-center mt-5"><h1 class="fw-bold">OUR SOCIALS</h1></div>
<div class="col-12 text-center mt-3" style = "margin-bottom: 100px;">
    <a href="https://www.facebook.com/Sofia-Fashionwear-110517934074604/" class="text-reset"><i class="bi bi-facebook mx-2" style="font-size: 30px"></i></a>
    <a href="mailto:Marymayramos8@gmail.com" class="text-reset"><i class="bi bi-google mx-2" style="font-size: 30px"></i></div></a>
</div>
</div>

</body>
</html>