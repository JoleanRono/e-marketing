<?php
$errors=array();
$db = mysqli_connect('localhost', 'root', '', 'beginning');
if (isset($_POST['update'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $desc = mysqli_real_escape_string($db, $_POST['desc']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "please enter item name"); }
  if (empty($desc)) { array_push($errors, "please describe the product"); }
  if (empty($quantity)) { array_push($errors, "quantity?"); }
  
  // first check the database to make sure 
  // a itemdoes not already exist with the same username and/or email
  $item_check_query = "SELECT * FROM products WHERE name='$name' OR desc='$desc' LIMIT 1";
  $result = mysqli_query($db, $item_check_query);
  $item = mysqli_fetch_assoc($result);
  
  if ($item) { // if user exists
    if ($item['name'] === $name) {
      array_push($errors, "item name already exists");
    }

    if ($user['desc'] === $desc) {
      array_push($errors, "description already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO `products` (`id`, `name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) 
VALUES (id, '$name', '$desc', '$price', '$rrp', '$quantity', '$img');";
  	mysqli_query($db, $query)
 
?>
<h2>Register</h2>
  </div>
	<hr color="green">
  <form method="post" action="customer-update.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
	<TABLE WIDTH="60%">
	<tr>
  	  <td><label>Name</label></td>
  	  <td><input type="text" name="name"></td>
	  </tr>
  	</div>
  	<div class="input-group">
	<tr>
  	  <td><label>Description</label></td>
  	  <td><input type="text" name="desc"></td>
	  </tr>
  	</div>
  	<div class="input-group">
	<tr>
  	  <td><label>Quantity</label></td>
  	  <td><input type="quantity" name="quantity"></td></tr>
  	</div>
	<div class="input-group">
	<tr>
  	  <td><label>Price</label></td>
  	  <td><input type="number" name="price"></td></tr>
  	</div>
  	<div class="input-group">
	<tr><td colspan="2">
  	  <button type="submit" class="btn" name="post">Register</button></td></tr>
	  </table>
  	</div>
  </form>
</body>
</html>