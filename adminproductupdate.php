<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>ADS UPDATE</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>ADS UPDATE</h2>
  </div>
	
  <form method="post" action="adminproductupdate.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Item name</label>
  	  <input type="text" name="name" value="<?php echo $name; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Description</label>
  	  <input type="text" name="desc" value="<?php echo $desc; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Price</label>
  	  <input type="currency" name="price" "<?php echo $price; ?>">
  	</div>
  	  <button type="submit" class="btn" name="add_ads">UPDATE</button>
  	</div>
  </form>
</body>
</html>