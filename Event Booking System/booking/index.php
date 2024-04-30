<?php
    require('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
</head>
    
<body class="container-fluid">
    <div class="row">
        <div id="first-panel" class="col-12">
            <h1 id="page-title">Event Booking System</h1>
            <center><button id="button-first">Learn More</button></center>
            <div id="availability" class="row">
                <div class="col-3">Event Date</div>
                <div class="col-3">Event Time</div>
                <div class="col-3">Type of Event</div>
                <div class="col-3"></div>

                <div class="col-3"><input type="date" id="availability-input" name="date"/></div>
                <div class="col-3">
                    <select id="availability-input" name="time">
                        <option value="wedding">7:00 AM to 12:00 PM</option>
                        <option value="birthday">1:00 PM to 7:00 PM</option>
                        <option value="debut">8:00 PM to 12:00 AM</option>
                    </select>
                </div>
                <div class="col-3">
                    <select id="availability-input" name="typeof">
                        <option value="wedding">Wedding</option>
                        <option value="birthday">Birthday</option>
                        <option value="debut">Debut</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="col-3"><input id="availability-input-button" type="button" value="CHECK AVAILABILITY"/></div>
            </div>
        </div>

        <div id="second-panel" class="col-12">
            <h1 class="text-center fw-bold">Our Offers</h1>
            <div class="row" id="celeb-list">
                <div class="col-12 col-md-3">
                    <div id="celeb" class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="icons/rings.png" id="celeb-icon"/>
                            <h5 class="card-title">Wedding</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Wedding Reception</h6>
                            <p class="card-text">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div id="celeb" class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="icons/balloons.png" id="celeb-icon"/>
                            <h5 class="card-title">Birthday</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Birthday Celebration</h6>
                            <p class="card-text">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div id="celeb" class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="icons/crown.png" id="celeb-icon"/>
                            <h5 class="card-title">Debut</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Debut Celebration</h6>
                            <p class="card-text">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div id="celeb" class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="icons/fireworks.png" id="celeb-icon"/>
                            <h5 class="card-title">Others</h5>
                            <h6 class="card-subtitle mb-2 text-muted">and More!</h6>
                            <p class="card-text">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="third-panel">
            <div class="row">
                <div class="d-none d-sm-block col-sm-6" id="tfchild-panel"></div>
                <div class="col-12 col-sm-6 d-flex align-items-center justify-content-center">
                    
                    <div id="save" class="px-4">
                        <center><img src="icons/fireworks.png" style="width: 100px; margin-bottom: 3vh"></center>
                        <h1 class="text-center fw-bold">Book Now!</h1>
                        <label class="fw-bold">Event Date</label>
                            <input type="date" id="book-input" name="date"/>
                        <label class="fw-bold">Event Time</label>
                            <select id="book-input" name="time">
                                <option value="wedding">7:00 AM to 12:00 PM</option>
                                <option value="birthday">1:00 PM to 7:00 PM</option>
                                <option value="debut">8:00 PM to 12:00 AM</option>
                            </select>
                        <label class="fw-bold">Type of Event</label>
                            <select id="book-input" name="typeof">
                                <option value="wedding">Wedding</option>
                                <option value="birthday">Birthday</option>
                                <option value="debut">Debut</option>
                                <option value="others">Others</option>
                            </select>
                            <input id="book-input-button" type="button" value="CHECK AVAILABILITY"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript" src="packages/particles.min.js"></script>
<script type="text/javascript" src="packages/app.js"></script>