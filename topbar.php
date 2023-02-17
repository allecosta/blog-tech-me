
<?php include './config/connect.php'; ?>

<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
        <div class="contact-info mr-auto">
            <i class="icofont-envelope"></i> 
            <a  href="mailto:<?= isset($meta['email']) ? $meta['email'] : '' ?>"><?= isset($meta['email']) ? $meta['email'] : '' ?></a>
        </div>
        <div class="social-links">
            <a 
                href="https://www.linkedin.com/in/allexandrecosta/" 
                class="linkedin"><i class="icofont-linkedin"></i></i>
            </a>
            <a 
                href="https://twitter.com/alle_developer" 
                class="twitter"><i class="icofont-twitter"></i>
            </a>  
        </div>
    </div>
</div>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo mr-auto"><a href="index.php" ><?= isset($meta['blog_name']) ? $meta['blog_name'] : '' ?></a></h1>
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="nav-home"><a href="index.php?page=home">Home</a></li>
                <li class="drop-down"><a href="javascript:void(0)">Categorias</a>
                    <ul>
                        <?php

                        $qry = $conn->query("SELECT * FROM category WHERE status = 1"); 

                        while($row=$qry->fetch_assoc()) : ?>
                            <li>
                                <a href="index.php?page=category&id=<?= $row['id'] ?>"><?php echo $row['name'] ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </li>
                <li class="nav-about"><a href="index.php?page=about">Quem sou</a></li>
            </ul>
        </nav>
    </div>
</header>
<script>
  $('.nav-<?= !isset($_GET['page']) ? 'home': $_GET['page'] ?>').addClass('active');
</script>