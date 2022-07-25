<?php
include("server.php");?>
<?=template_header('THANKS!!')?>

<style>
h1{
	{
text-align: center;
margin-bottom: 40px;
font-family: Ink Free;
font-size: 60px;
color: morado;
}
</style>
<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for shopping with us, we'll contact you by email with your order details.</p>
</div>
<?php
$num_COMMENTS_on_each_page =10;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM boom ORDER BY time comment LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_COMMENTS_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_COMMENTS_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_comments = $pdo->query('SELECT * FROM boom')->rowCount();
?>

<div class="products content-wrapper">
    <h1>COMMENTS</h1>
    <p><?=$total_comments?> <B> COMMENTS</B></p>
    
        <?php foreach ($comments as $comment): ?>     
		    <p><?=$comment['penname']?></p>           
		   <p><?=$comment['comment']?></p>
			<hr>
        <?php endforeach; ?>
    </div>

<?=template_footer()?>