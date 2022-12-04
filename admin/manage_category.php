<?php 

include '../connect.php';

if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM category WHERE id=".$_GET['id']);

	foreach ($qry->fetch_array() as $key => $value) {
		$meta[$key] = $value;
	}
}

?>

<div class="container-fluid">
	<form action="" id="manage-category">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
		<div class="form-group">
			<label class="control-label">Nome
				<input 
					type="text"  
					name="name" 
					class="form-control" 
					value="<?= isset($meta['name']) ? $meta['name'] : '' ?>" required
					>
			</label>	
		</div>
		<div class="form-group">
			<label class="control-label">Descrição
				<textarea 
					type="text" 
					name="description" 
					class="form-control" required><?= isset($meta['description']) ? $meta['description'] : '' ?>
				</textarea>
			</label>
		</div>
	</form>
</div>
<script>
	$('#manage-category').submit(function(e) {
		e.preventDefault();

		start_load()
		$.ajax({
			url:'ajax.php?action=save_category',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp) {
				if (resp){
					$('.modal').modal('hide')
					end_load()
					alert_toast('Dados salvos com sucesso','success');
					load_tbl()

				}
			}
		})

	})
</script>