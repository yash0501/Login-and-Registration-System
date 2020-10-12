<?php

//This script will handle login
session_start();

//Check if user already logged in
if(isset($_SESSION['email']))
{
  header("location:welcome.php");
  exit;
}

require_once "config.php";

$email = $password = "";
$err = "";

//if method is post

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  if(empty(trim($_POST['email'])) || empty(trim($_POST['password'])))
  {
    $err = "Email/Password Fields Cannot be Empty.";
  }
  else{
    $email = trim($_POST['email']);
    $password =  trim($_POST['password']);
  }
  if(empty($err))
  {
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $email;
    //Try to execute the statement
    if(mysqli_stmt_execute($stmt)){
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) == 1){
        mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
        if(mysqli_stmt_fetch($stmt)){
          if(password_verify($password, $hashed_password)){
            // This means Password is correct. Allow user to login
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["id"] = $id;
            $_SESSION["loggedin"] = true;

            // Redirect User to Welcome Page

            header("location: welcome.php");
          }
        }
      }
    }
  }
}

?>

<!-- HTML START -->class

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
    #error{
      background-color: red;
      color: white;
      padding: 10px;
      font-size: 20px;
    }
  </style>
</head>
<body>
<video autoplay muted loop id="myVideo">
  <source src="./img/shapes.mp4" type="video/mp4">
</video>
<div id="main">
  <header>
    <?php
        if($err){
    
          echo  "<div id='error'><p>" .$err . " <br>" ."</p></div>";
        }
      ?>
      
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
  <div class="form">
    <h2>Learn Something For A Life</h2>
    <form method="post" action="">
      <input type = "email" name = "email" placeholder = "Enter Email ID" class="i_field">
      <input type = "password" name = "password" placeholder = "Enter Your Password" class="i_field">
      <button id="submit">Submit</button>
    </form>
    <div id="login">
      <p>Register Another User, <a href="register.php">CLICK HERE</a></p>
    </div>
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