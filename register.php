<?php

require_once "config.php";

$parent_name = $email = $mobile = $student_name = $password = $grade = $laptop = "";
$err = $password_err = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //CHECK IF USERNAME IS EMPTY OR NOT
    if(empty(trim($_POST["parent_name"]))||empty(trim($_POST["email"]))||empty(trim($_POST["mobile"]))||empty(trim($_POST["student_name"]))||empty(trim($_POST["grade"]))||empty(trim($_POST["laptop"]))){
        $err = "Any Field Cannot be Empty";
    }
    else{
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set value of param_username
            $param_email = trim($_POST['email']);

            //Try to execute the statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This email is already registered, either login or register with another email.";
                }
                else{
                    $parent_name = trim($_POST['parent_name']);
                    $email = trim($_POST['email']);
                    $mobile = trim($_POST['mobile']);
                    $student_name = trim($_POST['student_name']);
                    $grade = trim($_POST['grade']);
                    $laptop = trim($_POST['laptop']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }

    


//Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password Cannot be Blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password Cannot be less than 5 characters";
}
else{
  $password = trim($_POST['password']);
}

// Validate the password using confirm password
/*if(trim($_POST['password'])!= trim($_POST['confirm_password'])){
  $password_err = "Passwords should match";
}*/

//$gender = $_POST['gender'];
//$gender = trim($_POST['gender']);
// If there were no errors, insert data in database
if(empty($err)&&empty($password_err)){

  $sql = "INSERT INTO users (parent_name, email, mobile, student_name, password, grade, laptop) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  if($stmt)
  {
    mysqli_stmt_bind_param($stmt, "sssssss", $param_parent_name, $param_email, $param_mobile, $param_student_name, $param_password, $param_grade, $param_laptop);

    //Set parameters
    $param_parent_name = $parent_name;
    $param_email = $email ;
    $param_mobile = $mobile ;
    $param_student_name = $student_name ;
    $param_grade = $grade ;
    $param_laptop = $laptop ;
    $param_password = password_hash($password, PASSWORD_DEFAULT);
    

    // Try to execute
    if(mysqli_stmt_execute($stmt)){
      header("location:login.php");
    }
    else{
      echo "Something went wrong... Cannot Redirect";
    }
  }
  mysqli_stmt_close($stmt);
}
mysqli_close($conn);
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
    
          echo  "<div id='error'><p>" .$err . " or " . $password_err . " <br>" ."</p></div>";
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
    <h2>What are You Waiting For....<br> Register Now!</h2>
    <form method="post" action="">
      <input type = "text" name = "parent_name" placeholder = "Enter Parent's Name" class="i_field">
      <input type = "email" name = "email" placeholder = "Enter Email ID" class="i_field">
      <input type = "text" name = "mobile" placeholder = "Enter Mobile Number" class="i_field">
      <input type = "text" name = "student_name" placeholder = "Enter Student's Name" class="i_field">
      <input type = "password" name = "password" placeholder = "Enter Your Password" class="i_field">
      <select id="dropdown" name="grade" class="i_field1">
    		<option disabled selected value>Select Student's Grade</option>
    		<option value="5-7">Class 5 - 7</option>
    		<option value="above_8">Class 8 and above</option>
      </select>
      <div class="radio">
        <p>Do you have access to a laptop/desktop?</p>
  			<input type="radio" class="input-radio" name="laptop" value="yes">
  			<label>Yes</label>
  			<input type="radio" class="input-radio" name="laptop" value="no">
        <label>No</label>
      </div>
      <button id="submit">Submit</button>
    </form>
    <div id="login">
      <p>Already have an account, <a href="login.php">Login Here</a></p>
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