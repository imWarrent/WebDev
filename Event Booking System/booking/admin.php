<?php
    require('config.php');
    session_start();
    // if(!isset($_SESSION['loggedin'])){
    //     echo header('Location: ./adminlogin.php');
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div id="navbar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" id="navClose"><i class="bi bi-arrow-left-circle"></i></a><br>
        <div id="nav-button">
            <img src="icons/admin.png" class="mb-4" style="width: 100px;">
            <p id="navBar-label">Admin Tools</p>
            <button id="navbar-item"><i class="bi bi-house-fill pe-2"></i>Dashboard</button>
            <button id="navbar-item"><i class="bi bi-calendar-check-fill pe-2"></i>Schedules</button>
            
            
            <p id="navBar-label" class="mt-4">Reports</p>
            <button id="navbar-item"><i class="bi bi-journal-bookmark-fill pe-2"></i>Admin Logs</button>
            <button id="navbar-item"><i class="bi bi-currency-exchange pe-2"></i>Transaction History</button>
            
            <p id="navBar-label" class="mt-4">Account Management</p>
            <button id="navbar-item"><i class="bi bi-people-fill pe-2"></i>Users Account</button>
            <button id="navbar-item"><i class="bi bi-lock-fill pe-2"></i>Admin Account</button>
            <hr>
            <a href="adminlogin.php"><button id="navbar-item"><i class="bi bi-box-arrow-right pe-2"></i>Logout</button></a>
            
        </div>
    </div>
    <div id="main">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript:void(0)" onclick="navBarFunction()"><span class="navbar-toggler-icon"></span></a>
                <a class="navbar-brand">Dashboard</a>
            </div>
        </nav>

        <div id="content">
            <div class="row">
                <h1 id="title"><i class="bi bi-cash-coin pe-2"></i> Sales Report</h1>
                <hr>
                <div class="col-12 col-sm-4">
                    <div class="card text-white bg-info mb-3" style="max-width: 100%;">
                        <div class="card-header">Total Sales</div>
                        <div class="card-body">
                            <h5 class="card-title">₱ 150,000</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card text-white bg-danger mb-3" style="max-width: 100%;">
                        <div class="card-header">Total Sales (Month)</div>
                        <div class="card-body">
                            <h5 class="card-title">₱ 65,000</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card text-white bg-success mb-3" style="max-width: 100%;">
                        <div class="card-header">Upcoming Events</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-calendar-event pe-2"></i> 5 events</h5>
                        </div>
                    </div>
                </div>
                <h1 id="title"><i class="bi bi-lightning-charge-fill pe-2"></i>Performance</h1>
                <hr>
                <div class="col-12 col-sm-6">
                    <h1 id="title1"><i class="bi bi-graph-up pe-2"></i>Sales Chart</h1>
                    <div id="myChart"></div>
                </div>
                <div class="col-12 col-sm-6">
                    <h1 id="title1"><i class="bi bi-pie-chart-fill pe-2"></i>Pie Chart</h1>
                    <div id="myChart2"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    if (!window.matchMedia('screen and (max-width: 600px)').matches) {
        document.getElementById("main").style.width = window.innerWidth - 256;
    }
    
    function navBarFunction(){
        let w = document.getElementById("navbar").style.width;
        if(w == "0px" || w == "0%"){
            openNav();
        }
        else{
            closeNav();
        }
    }

    function openNav(){
        if (window.matchMedia('screen and (max-width: 600px)').matches) {
            document.getElementById("navbar").style.width = "100%";
            document.getElementById("main").style.marginLeft = "0%";
        }
        else{
            document.getElementById("navbar").style.width = "256px";
            document.getElementById("main").style.width = window.innerWidth - 256;
            document.getElementById("main").style.marginLeft = "256px";
        }
    }

    function closeNav(){
        if (window.matchMedia('screen and (max-width: 600px)').matches) {
            document.getElementById("navbar").style.width = "0%";
            document.getElementById("main").style.marginLeft= "0%";
        }
        else{
            document.getElementById("navbar").style.width = "0px";
            document.getElementById("main").style.marginLeft = "0px";
            document.getElementById("main").style.width = window.innerWidth;
        }
    }
    
    google.charts.load('current',{packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Set Data
        var data = google.visualization.arrayToDataTable([
        ['Price', 'Months'],
        ['Jan',17000],['Feb',80000],['Mar',58000],['Apr',0409],['May',40449],
        ['Jun',53459],['Jul',15430],['Aug',14051],
        ['Sept',153454],['Oct',14435],['Nov',10405],['Dec',10454]
        ]);
        // Set Options
        var options = {
            title: 'Total Sales (2022)',
            color: 'red',
            hAxis: {title: 'Monthly Sales'},
            vAxis: {title: 'Months'},
            colors: ['#e494ff'],
            backgroundColor: 'rgb(231, 231, 231)',
            legend: 'none'
        };
        // Draw
        var chart = new google.visualization.AreaChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }

    google.charts.load('current',{packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        // Set Data
        var data = google.visualization.arrayToDataTable([
        ['Price', 'Months'],
        ['Jan',7],['Feb',8],['Mar',8],['Apr',9],['May',9],
        ['Jun',9],['Jul',10],['Aug',11],
        ['Sept',14],['Oct',14],['Nov',15],['Dec',15]
        ]);
        // Set Options
        var options = {
            title: 'Total Sales (2022)',
            color: 'red',
            hAxis: {title: 'Monthly Sales'},
            vAxis: {title: 'Months'},
            backgroundColor: 'rgb(231, 231, 231)',
            legend: 'none'
        };
        // Draw
        var chart = new google.visualization.PieChart(document.getElementById('myChart2'));
        chart.draw(data, options);
    }
</script>