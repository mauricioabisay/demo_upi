<!DOCTYPE html>
<html lang="es">
  <head>
    <link rel="icon" href="<?php echo get_stylesheet_directory_uri();?>/img/fav.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/img/fav.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Resource-type" content="Document" />
    <?php
      $img_url = get_stylesheet_directory_uri().'/img/share.jpg';
      $title = get_bloginfo( 'name' );
      $description = '';
      $link = site_url();
    ?>
    <title><?php echo $title;?></title>
    <meta name="description" content="<?php echo $description;?>" />
    <meta name="keywords"  content="<?php echo get_option('seo_keywords', '');?>" />

    <?php if(is_home()) : ?>
      <meta property="og:url" content="<?php echo $link;?>">
      <meta property="og:image" content="<?php echo $img_url;?>">
      <meta property="og:title" content="<?php echo get_option('seo_description', '');?>">
      <meta property="og:description" content="<?php echo get_option('seo_description', '');?>">

      <meta name="twitter:card" content="summary">
      <meta name="twitter:title" content="<?php //pll_e('home-title-tw');?>">
      <meta name="twitter:description" content="<?php //pll_e('home-desc-tw');?>">
      <meta name="twitter:image" content="<?php echo $img_url;?>">
    <?php else : ?>
      <meta property="og:url" content="<?php echo $link;?>">
      <meta property="og:image" content="<?php echo $img_url;?>">
      <meta property="og:title" content="<?php echo $title;?>">
      <meta property="og:description" content="<?php echo $description;?>">

      <meta name="twitter:card" content="summary">
      <meta name="twitter:title" content="<?php echo $title;?>">
      <meta name="twitter:description" content="<?php echo $description;?>">
      <meta name="twitter:image" content="<?php echo $img_url;?>">
    <?php endif;?>

    <?php wp_head(); ?>
  </head>
  <body>
  <?php
    global $post;
    if($post) {
      $current_page = $post->post_name;
    } else {
      $current_page = '';
    }
  ?>
  <nav class="navbar navbar-dark fixed-top navbar-expand-lg navbar-expand-md">
    <a class="navbar-brand" href="#">
      <img src="<?php echo get_stylesheet_directory_uri();?>/img/logo.svg" width="40" height="40" alt="">
    </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#golf">Golf</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#equitacion">Equitacion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">...</a>
          </li>
        </ul>
        <ul class="navbar-nav mr-3">
          <li class="nav-item">
            <a class="nav-link" href="#mv-membership">Membresias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacto">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="<?php echo get_option('fb');?>"><div class="fb"></div></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="<?php echo get_option('tw');?>"><div class="tw"></div></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="<?php echo get_option('itg');?>"><div class="itg"></div></a>
          </li>

        </ul>
      </div>

  </nav>
  <div id="fullpage" class="container">