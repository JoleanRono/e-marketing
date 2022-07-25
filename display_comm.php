<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
// The amounts of products to show on each page
$num_comments_on_each_page = 20;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM boom ORDER BY time comment LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_comments_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_comments_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_comments = $pdo->query('SELECT * FROM boom')->rowCount();
?>
<?=template_header('comments')?>

<div class="products content-wrapper">
    <h1>COMMENTS</h1>
    <p><?=$total_comments?> comments</p>
    <div class="products-wrapper">
        <?php foreach ($comments as $comment): ?>
		<? echo $comment;?>
        <?php endforeach; ?>
    </div>
    <div class="buttons">
        <?php if ($current_page > 1): ?>
        <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
        <?php endif; ?>
        <?php if ($total_comments > ($current_page * $num_comments_on_each_page) - $num_comments_on_each_page + count($comments)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>