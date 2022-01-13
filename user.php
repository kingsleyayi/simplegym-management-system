<?php
session_start();
$_SESSION['specialid'];
$id = $_SESSION['specialid'];
if(!isset($id)){
    header('location: index.php');
}
include './include/db_conn.php';

$check = "SELECT * FROM users WHERE userid = '$id'";
$checkresult =mysqli_query($con,$check);
$checkdetail=mysqli_fetch_array($checkresult,MYSQLI_ASSOC);
$plan = $checkdetail['plan'];
$username = $checkdetail['username'];
$email = $checkdetail['email'];
$gender = $checkdetail['gender'];
$dob = $checkdetail['dob'];
$join = $checkdetail['joining_date'];
$mobile = $checkdetail['mobile'];

?>
<html>

<head>

    <title>Card Hover Effect</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"

        crossorigin="anonymous">

</head>

<body>

    <div class="container">

       

        <div class="card">

            <div class="slide slide1">

                <div class="content">

                    <div class="icon">

                        <i class="fa fa-user-circle" aria-hidden="true"></i>

                    </div>

                </div>

            </div>

            <div class="slide slide2">

                <div class="content">

                    <h3>

                    <?php echo $username; ?>

                    </h3>
                    <p><b>Email: </b><?php echo $email; ?></p>
                    <p><b>Date of birth: </b><?php echo $dob; ?></p>
                    <p><b>date joined: </b><?php echo $join; ?></p>
                    <p><b>Gender: </b><?php echo $gender; ?></p>
                    <p><b>Plan: </b><?php echo $plan; ?></p>

                </div>

            </div>

        </div>

        

    </div>

</body>
<style>
body {

margin: 0;

padding: 0;

min-height: 100vh;

display: flex;

align-items: center;

justify-content: center;  

font-family: sans-serif;

background-color: #f1f1f1; 

}

.container .card .icon {

position: absolute;

top: 0;

left: 0;

width: 100%;

height: 100%;

background: #2c73df;

}

.container .card .icon .fa {

position: absolute;

top: 50%;

left: 50%;

transform: translate(-50%, -50%);

font-size: 80px;

color: #fff;

}

.container .card .slide {

width: 300px;

height: 200px;

transition: 0.5s;

}

.container .card .slide.slide1 {

position: relative;

display: flex;

justify-content: center;

align-items: center;

z-index: 1;

transition: .7s;

transform: translateY(100px);

}

.container .card:hover .slide.slide1{

transform: translateY(0px);

}

.container .card .slide.slide2 {

position: relative;

display: flex;

justify-content: center;

align-items: center;

padding: 20px;

box-sizing: border-box;

transition: .8s;

transform: translateY(-100px);

box-shadow: 0 20px 40px rgba(0,0,0,0.4);

}

.container .card:hover .slide.slide2{

transform: translateY(0);

}

.container .card .slide.slide2::after{

content: "";

position: absolute;

width: 30px;

height: 4px;

bottom: 15px;

left: 50%;

left: 50%;

transform: translateX(-50%);

background: #2c73df;

}

.container .card .slide.slide2 .content p {

margin: 0;

padding: 0;

text-align: center;

color: #414141;

}

.container .card .slide.slide2 .content h3 {

margin: 0 0 10px 0;

padding: 0;

font-size: 24px;

text-align: center;

color: #414141;

} 
    </style>
</html>