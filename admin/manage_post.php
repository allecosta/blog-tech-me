<div class="card col-lg-12">
	<div class="card-body">
		<?php 

		include '../connect.php';

		if (isset($_GET['id'])) {
			$qry = $conn->query("SELECT * FROM posts WHERE id=".$_GET['id']);

			foreach ($qry->fetch_array() as $key => $value) {
				$meta[$key] = $value;
			}
		}

		?>

		<div class="container-fluid">
			<form action="" id="manage-category">
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
				<div class="form-group col-md-4">
					<label class="control-label">Título
						<input 
							type="text" 
							name="name" 
							class="form-control" value="<?= isset($meta['title']) ? $meta['title'] : '' ?>" required
							>
					</label>
				</div>
				<div class="form-group col-md-4">
					<label class="control-label">Categoria
						<select type="text" name="category_id" class="form-control"  required>
							<option value=""></option>
							<?php
							$cat = $conn->query("SELECT * FROM category WHERE status = 1 ORDER BY name ASC");

							while ($row= $cat->fetch_assoc()) {

							?>
							<option value="<?= $row['id'] ?>" <?= isset($meta['category_id']) && $meta['category_id'] == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
							<?php } ?>
						</select>
					</label>	
				</div>
				<div class="form-group">
					<label for="" class="control-label">Adicionar imagem ao conteúdo
						<div>
						<img src="../assets/img/<?= isset($meta['img_path']) ? $meta['img_path'] : '' ?>" alt="" class="img-field">
						<br>
							<div class="input-group mb-3 col-md-3">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="">Upload</span>
							  </div>
							  <div class="custom-file">
							    <input type="file" name="img" class="custom-file-input" id="img" aria-describedby="" accept="image/*" onchange="displayImg(this,$(this))">
							    <label class="custom-file-label" for="img">Escolher arquivo</label>
							  </div>
							</div>
						</div>
					</label>
				</div>
				<div class="form-group">
					<label for="post" class="control-label">Descrição</label>
					<textarea type="text" id="post" name="post" class="text-jqte" required><?php echo isset($meta['post']) ? html_entity_decode($meta['post']) : '' ?></textarea>
				</div>
				<center><button class="btn btn-primary btn-block col-md-2">Salvar</button></center>
			</form>
		</div>
		<script>
	$('.text-jqte').jqte();
			function displayImg(input,_this) {
			    if (input.files && input.files[0]) {
			        var reader = new FileReader();
			        reader.onload = function (e) {
			        	_this.parent().parent().parent().find('.img-field').attr('src', e.target.result);
            			_this.siblings('label').html(input.files[0]['name'])
            			_this.siblings('input[name="fname"]').val('<?php echo strtotime(date('y-m-d H:i:s')) ?>_'+input.files[0]['name'])
            			var p = $('<p></p>')
			            
			        }

			        reader.readAsDataURL(input.files[0]);
			    }
			}

			$('#manage-category').submit(function(e){
				e.preventDefault();
				start_load();

				$.ajax({
					url: 'ajax.php?action=save_post',
				    data: new FormData($(this)[0]),
				    cache: false,
				    contentType: false,
				    processData: false,
				    method: 'POST',
				    type: 'POST', 
				    success: function(resp){
				    	resp =JSON.parse(resp)
				        if(resp.status== 1){
				        	alert_toast("Dados atualizado com sucesso.",'success');
				        	setTimeout(function(){
				        	location.replace('index.php?page=preview_post&id='+resp.id)

				        },1500)
				        }
				    }
				})
			})
		</script>
	</div>
</div>
<style>
	img.img-field {
	max-width: 20vw;
	max-height: 11vh;
	}
</style>