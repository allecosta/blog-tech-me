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
<style>
	body {
		width: 100%;
	    height: calc(100%);
	    background: #2C4964;
	}
	main#main {
		width:100%;
		height: calc(100%);
		background: #2C4964;
	}
	main #login {
		position: inherit;
		margin: 0 auto;
		width: 50%;
		height: calc(100%);
		display: flex;
		align-items: center;
	}
	main #login .card {
		margin: auto
	}
</style>
<body>
  <main id="main" class=" alert-info">
	<div id="login">
		<div class="card col-md-8">
			<div class="card-body">
				<form id="login-form" >
					<div class="form-group">
						<label class="control-label">Usuário
							<input type="text" name="username" class="form-control">
						</label>
					</div>
					<div class="form-group">
						<label class="control-label">Senha
							<input type="password" name="password" class="form-control">
						</label>
					</div>
					<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Entrar</button></center>
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