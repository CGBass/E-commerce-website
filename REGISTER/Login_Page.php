<?php    
session_start();
	$msg="";
	$role="";
	$status="";
	$flag=false;
	if(isset($_POST["submit"]))
	{
		$id=$_POST["id"];  
		$pwd=$_POST["pwd"];  
		$db=mysqli_connect("localhost","root","");
		mysqli_select_db($db,"optimus_db");
		$result=mysqli_query($db,"select role,status from login_tb where id='$id' and Password='$pwd'");
		while($row=mysqli_fetch_array($result))
		{
			$flag=true;
			$role=$row[0];
			$status=$row[1];
		}
		mysqli_close($db);
		
		if($flag==true)
		{
			if($status=="Active")
			{
				if($role=="admin")
					header("location: Admin_User.php");
				else
				{
					$_SESSION["loginid"]=$id;
					header("location: User_Profile.php");
				}
			}	
			else
			$msg="Sry!!You Are Blocked By Admin..";
		}
		else
		$msg="Invalid Loginid or Password";
	}	
?>

<head>
  <title>Collapsible Navbar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css">
  <script src="jquery/jquery-3.3.1.js"></script>
  <script src="bootstrap3/js/bootstrap.min.js"></script>
</head>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Optimus Infotech</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>  
        <li><a href="#">ContactUs</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="Registration_Page.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="Login_Page.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<h2>Login Here</h2>
 <div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-8">
  <form action="Login_Page.php" method="post">
    <div class="form-group">
      <label for="login">Login ID</label>
      <input type="text" class="form-control"  placeholder="Enter Login ID" name="id">
    </div>
    <div class="form-group">
      <label for="pwd">Password</label>
      <input type="password" class="form-control"  placeholder="Enter password" name="pwd">
    </div>
        <input type="submit" class="btn btn-success" name="submit" value="Login">
	<a href="Registration_Page.php">New User</a>
  </form>
  <?php
  echo $msg;
  ?>
</div>
 </div>
  <br><br> 
</div>
