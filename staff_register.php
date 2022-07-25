<?php
session_start();
// initializing variables
$email    = "";
$staff-id="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'beginning');

// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $staff-id = mysqli_real_escape_string($db, $_POST['staff-id']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($staff-id)) { array_push($errors, "your ID is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM STAFF WHERE staff-id='$staff-id' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if !($user['staff-id'] ===$staff-id) {
      array_push($errors, "your id does not exist");
    }

    if !($user['email'] === $email) {
      array_push($errors, "email not found!!");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO staff_reg (staff-id, email, password) 
  			  VALUES('$staff-id', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['staff-id'] = $staff-id;
  	//$_SESSION['success'] = "You are now logged in";
  	header('location: customer-update.php');
  }
}


<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
<STYLE>
body{
background: #b76f20;
font-family: times new roman;
display: justified;
}

form{
width: 75%;
border: 2px solid #ccc;
padding: 30px;
background:#d4bb7e;
border-radius: 15px;
}
h1,h2,h3,h4{
text-align: center;
margin-bottom: 40px;
font-family: Ink Free;
font-size: 60px;
color: morado;
}

a{
text-align: left;
color: black;
underline: none;
}

input{
display: block;
border: 2px solid #652a0e;
width: 95%;
padding: 10px auto;
border-radius: 5px;
}

label{
color:  #000080;
font-size: 18px;
padding: 10px;
}

button {
float:center;
background: #bd8865;
padding: 10px 15px;
color: #5f4b8b;
border-radius: 5px;
margin-right: 10px;
border:none;
width: 70px;
}

button:hover{
opacity: .7;
}
</STYLE>
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	<hr color="green">
  <form method="post" action="staff_register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
	<TABLE WIDTH="60%">
	<tr>
  	  <td><label>Staff ID</label></td>
  	  <td><input type="text" name="staff-id"></td>
	  </tr>
  	</div>
  	<div class="input-group">
	<tr>
  	  <td><label>Email</label></td>
  	  <td><input type="email" name="email"></td>
	  </tr>
  	</div>
  	<div class="input-group">
	<tr>
  	  <td><label>Password</label></td>
  	  <td><input type="password" name="password_1"></td></tr>
  	</div>
	<div class="input-group">
	<tr>
  	  <td><label>Confirm Password</label></td>
  	  <td><input type="password" name="password_2"></td></tr>
  	</div>
  	<div class="input-group">
	<tr><td colspan="2">
  	  <button type="submit" class="btn" name="reg_user">Register</button></td></tr>
	  </table>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>