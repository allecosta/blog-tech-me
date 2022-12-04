<?php 

include('connect.php');

$qry = $conn->query("
	SELECT 
		p.*,c.name AS cname 
	FROM 
		posts p 
	INNER JOIN 
		category c ON c.id = p.category_id 
	WHERE p.id =".$_GET['id']);

	foreach ($qry->fetch_array() as $key => $value) {
		$meta[$key] = $value;
	}
?>

<div class="container">
	<div class="col-md-12">
		<h3><?= isset($meta['title']) ? $meta['title'] : ''; ?></h3>
		<small><?= isset($meta['cname']) ? $meta['cname'] : ''; ?></small>
	</div>
	<div class="col-md-12">
		<center>
			<img src="assets/img/<?= isset($meta['img_path']) ? $meta['img_path'] : ''; ?>" alt="" class='col-md-5'>
		</center>
	</div>
	<div class="col-md-12">
		<?= isset($meta['post']) ? html_entity_decode($meta['post']) : ''; ?>
	</div>
</div>