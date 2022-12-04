<nav id="sidebar" class='mx-lt-5 bg-light' style="background-color: #e3f2fd !important;">
	<div class="container-fluid">
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt"></i></span> CPainel</a>
				<a href="index.php?page=category" class="nav-item nav-category"><span class='icon-field'><i class="fa fa-list"></i></span> Categoria</a>
				<a href="index.php?page=posts" class="nav-item nav-posts"><span class='icon-field'><i class="fa fa-blog"></i></span> Posts</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> Configuração</a>
		</div>

	</div>
</nav>
<script>
	$('.nav-<?php echo $_GET['page'] ?>').addClass('active')
</script>