<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin - Blog Tech Me</title>
 	
	<?php 

	include './header.php';

	session_start();

	if (isset($_SESSION['login_id'])) {
		header("location: index.php?page=home");
	}

	?>

</head>
<body>
  <main class=" alert-info">
	<div class="d-flex justify-content-center align-items-center" style="height: 100vh; background: #2C4964;">
		<div class="card align-items-center" style="width: 20rem;">
			<div class="card-body">
				<form id="login-form" >
					<div class="mb-3">
						<label class="form-label">Usuário
							<input type="text" name="username" class="form-control">
						</label>
					</div>
					<div class="mb-3">
						<label class="form-label">Senha
							<input type="password" name="password" class="form-control">
						</label>
					</div>
					<div class="text-center">
						<button class="btn btn-primary">Entrar</button>
					</div>
				</form>		
			</div>
		</div>
	</div>
  </main>
  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</body>
<script>
	$('#login-form').submit(function(e) {
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Fazendo login...');
		if ($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
			},
			success:function(resp) {
				if (resp == 1) {
					location.reload('index.php?page=home');
				} else {
					$('#login-form').prepend('<div class="alert alert-danger">OPS! Usuário ou senha incorreta</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>