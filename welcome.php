<?php

    require_once "config.php";
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("location: login.php");
    }
    $sql = "SELECT id, student_name FROM users";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }
?>

<!-- HTML START -->

<!DOCTYPE html>
<html>
<head>
  <title>KickStarting Your Child's Financial Journey</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    *{
      margin: 0;
      padding: 0;
      /*background-color: #2dcfff;*/
    }
    #myVideo {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      z-index: -1;
    }
    #nav-bar ul{
	list-style-type: none;
	display: flex;
	flex-direction: row;
	justify-content: flex-end;
	margin-right: 20px;
    }
    #nav-bar li{
	padding: 5px;
	margin: 3px;
	margin-right: 20px;
	margin-left: 20px;
	border-radius: 15px;
    }
    #nav-bar a{
	text-decoration: none;
	font-size: 20px;
	color: white;
    }
    #nav-bar{
	display: flex;
	justify-content: flex-end;
    margin-right: 20px;
    color: white;
    }
    #main{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: auto;
        text-align: center;
    }
    h1{
      margin: 18px;
      font-size: 36px;
      font-family: Tahoma;
      color: white;
    }
    h3{
      margin: 15px;
      font-size: 26px;
      color: white;
    }
    .container{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }
    .box{
      display: flex;
      flex-direction: row;
      width: 26vw;
      margin: 10px;
      border: 2px solid black;
      border-radius: 8px;
      padding: 10px;
      background-color: white;
    }
    .box p{
      font-size: 20px;
    }
    .mini{
      width:40px;
      height: 40px;
    }
    @media(max-width: 700px){
      .container{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .box{
      display: flex;
      flex-direction: row;
      width: 60vw;
      margin: 10px;
      border: 2px solid black;
      border-radius: 8px;
      padding: 10px;
      background-color: white;
    }
    footer{
      margin: 20px;
      background-color: white;
      font-size: 20px;
      border-radius: 25px;
      font-family: Tahoma;
    }
    .clg img{
      width: 350px;
      margin: 10px;
    }
    }
    .form{
      background-color: white;
      padding: 15px;
      border-radius: 20px;
      margin: 15px;
    }
    .form h2{
      color: blue;
      font-size: 28px;
    }
    form{
      display: flex;
      flex-direction: column;
    }
    .i_field{
      width: 40vw;
      margin: 10px;
      padding: 10px;
      font-size: 20px;
      border-radius: 5px;
    }
    .i_field1{
      width: auto;
      margin: 10px;
      padding: 10px;
      font-size: 20px;
      border-radius: 5px;
    }
    .radio p, label{
      font-size: 20px;
    }
    label{
      margin:0px 20px;
    }
    #submit{
      font-size: 20px;
      margin: 5px;
      padding: 8px;
      background-color: orange;
    }
    #login p{
      font-size: 20px;
      font-weight: 9;
      font-style: bolder;
    }
    #login a{
      text-decoration: none;
      color: red;
    }
    footer{
      margin: 20px;
      background-color: white;
      font-size: 24px;
      border-radius: 30px;
      font-family: Tahoma;
    }
    .clg img{
      width: 60vw;
      margin: 10px;
    }
    .matter p{
        font-size: 20px;
        color: white;
    }
  </style>
</head>
<body>
<video autoplay muted loop id="myVideo">
  <source src="./img/shapes.mp4" type="video/mp4">
</video>
<div id="main">
  <header>
  <nav id="nav-bar">
			<ul>
				<li><a href="register.php" class="nav-link">Home</a></li>
				<li><a href="#" class="nav-link">Features</a></li>
				<li><a href="logout.php" class="nav-link">Logout</a></li>
			</ul>
		</nav>
    <h1>KickStarting Your Child's Financial Journey</h1>
    <h3>#1 Financial Literacy Program for Kids of class 5 and above in India with IIT-IIM Alumni</h3>
    <div class="container">
      <div class="box">
        <img src="./img/medalmedal.png" class="mini">
        <p>Education for kids to become finance planners from early age</p>
      </div>
      <div class="box">
        <img src="./img/graphgraph.png" class="mini">
        <p>Learn about the fastest growing and highest paying finance domain</p>
      </div>
      <div class="box">
        <img src="./img/brainbrain.png" class="mini">
        <p>Skills for future employability and financial competence in Kids</p>
      </div>
    </div>
  </header>
  <div class="matter">
  <h1>Hello <?php  echo $row["student_name"]; ?>, Welcome to the World of Cerebro Kids</h1>
  <p>Presenting you to a world where you will start your financial journey right in your school days.</p>
  </div>
  <footer>
    <p>BROUGHT TO YOU BY A TEAM FROM</p>
    <div class="clg">
    <img src="./img/iitr.png">
    </div>
  </footer>
</div>
</body>
</html>