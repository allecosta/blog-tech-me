<?php

include '../config/connect.php';

$qry = $conn->query("SELECT * FROM site_settings LIMIT 1");

if ($qry->num_rows > 0) {
	foreach ($qry->fetch_array() as $k => $val) {
		$meta[$k] = $val;
	}
}

?>

<div class="container-fluid">
	<div class="card col-lg-12">
		<div class="card-body">
			<form action="" id="manage-settings">
				<div class="form-group">
					<label class="control-label">Nome
						<input 
							type="text" 
							class="form-control" 
							name="name" 
							value="<?= isset($meta['blog_name']) ? $meta['blog_name'] : '' ?>" required
							>
					</label>
				</div>
				<div class="form-group">
					<label class="control-label">Email
						<input 
							type="email" 
							class="form-control" 
							name="email" 
							value="<?= isset($meta['email']) ? $meta['email'] : '' ?>" required
							>
					</label>
				</div>
				<div class="form-group">
					<label class="control-label">Contato
						<input 
							type="text" 
							class="form-control" 
							name="contact" 
							value="<?= isset($meta['contact']) ? $meta['contact'] : '' ?>" required
							>
					</label>
				</div>
				<div class="form-group">
					<label class="control-label">Sobre o conteúdo
						<textarea 
							name="about" 
							class="text-jqte"><?= isset($meta['about']) ? $meta['about'] : '' ?>
						</textarea>
					</label>
				</div>
				<center>
					<button class="btn btn-info btn-primary btn-block col-md-2">Salvar</button>
				</center>
			</form>
		</div>
	</div>
	<script>
		$('.text-jqte').jqte();
		$('#manage-settings').submit(function(e) {
			e.preventDefault()
			start_load()
			$.ajax({
				url:'ajax.php?action=save_settings',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
				},
				success:function(resp) {
					if (resp == 1) {
						alert_toast('Dados salvo com sucesso.','success')
						end_load()
					}
				}
			})
		})
	</script>
</div>