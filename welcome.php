<?php 
  session_start(); 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
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
p{
	font-size: 28px;
padding-bottom: 1px;
padding-top: 1px;
}
h1,h2,h3,h4{
text-align: center;
margin-bottom: 40px;
font-family: Ink Free;
font-size: 60px;
color: morado;
padding-bottom: 2px;
padding-top: 1px;
border-bottom: 1px solid #ffffff;
}

button{
	font-weight: bolder;
	background: red;
font-family: calibri;
font-size: 28px;
</style>

<body>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
<table width=100%>
<thead>
<td><a href="index.php" align="left"><button>View ads</button></a> </td> <td align="right"><a href="register.php"><button>logout</button></a></td><thead>
<td colspan=2><h2 align="block">Welcome <strong><?php echo $_SESSION['username']; ?></strong></h2></td></tr></table>
	
    <?php endif ?>
</div>
<table width="75%" height="50%">
<tr><td>
<img src="cartman.jpg" height="300" width="300" align="left"></td></td>
<td><img src="cart.jpg" height="300" width="300"align="right"></td></td>
</tr>
</table></br>

</body>
<?php
$comment="";
$penname="";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'beginning');

if (isset($_POST['submit_comment'])) {
  $penname = mysqli_real_escape_string($db, $_POST['penname']);
  $comment = mysqli_real_escape_string($db, $_POST['comment']);
 
   if (empty($penname)) { array_push($errors, "subject cannot be empty"); }
  if (empty($comment)) { array_push($errors, "please add a comment"); }

  $user_check_query = "SELECT * FROM boom WHERE penname='$penname' OR comment='$comment' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
   
    if ($user['comment'] === $comment) {
      array_push($errors, "your comment is a duplicate");
    }
  }
  if (count($errors) == 0) {

  	$query = "INSERT INTO boom (penname, comment) 
  			  VALUES('$penname', '$comment')";
  	mysqli_query($db, $query);
  	
  }
}
?>
</head>
<body>
  <div class="header">
  	<p ><b>Hi <?php echo $_SESSION['username']; ?>, care to leave us a comment? please drop it below;</b></p>
  </div>
  <form method="post" action="welcome.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
	<TABLE WIDTH="60%">
	<tr>
  	  <td><label>SUBJECT</label></td>
  	  <td><input type="text" name="penname" value="<?php echo $penname; ?>"></td>
	  </tr>
  	</div>
  	<div class="input-group">
	<tr>
  	  <td><label>COMMENT</label></td>
  	  <td><textarea name="comment" value="<?php echo $comment; ?>" cols="" rows="4"></textarea></td>
	  </tr>
  	</div>

  	<div class="input-group">
	<tr><td colspan="2">
  	  <button type="submit" class="btn" name="submit_comment">POST</button></td></tr>
	  </table>
  	</div>
  </form>
</body>
</html>
<?php
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year,E-marketing System</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
?>
</html>