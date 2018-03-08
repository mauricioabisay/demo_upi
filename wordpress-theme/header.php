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

  <nav id="main-menu" class="side">
    <a href="javascript:void(0)" class="side-close">&times;</a>
    <div class="side-open-internal"><a href="<?php echo (is_home()) ? 'javascript:void(0)' : site_url();?>" onclick="<?php echo (is_home()) ? "jQuery.scrollify.move('#home')" : '';?>"><img src="<?php echo get_stylesheet_directory_uri();?>/img/logo.svg" width="40" height="40" alt=""></a></div>
    <div class="links">
      <?php
        $categories = get_categories(array(
          'hide_empty' => 0,
          'orderby' => 'term_id',
          'order' => 'ASC'
        ));
        foreach ($categories as $category) :
          if ( $category->term_id!==1 && !stristr($category->slug, 'logros') && !stristr($category->slug, 'menu') ):
            if ( is_home() ) :
      ?>
            <a href="javascript:void(0)" onclick="jQuery.scrollify.move('#<?php echo $category->slug;?>');"><?php echo $category->name;?></a>
      <?php else : ?>
            <a href="<?php echo site_url().'/#'.$category->slug;?>"><?php echo $category->name;?></a>
      <?php endif; ?>
      <?php
          endif;
        endforeach;
      ?>
    </div>
    <div class="social">
      <div class="sections">
        <a class="page-link" href="<?php echo site_url().'/#membresias';?>">Membresías</a>
        <a class="page-link" href="<?php echo (is_home()) ? '#contacto' : site_url().'/#contacto';?>">Contacto</a>
      </div>
      <div class="networks">
      <?php if (get_option('fb')) : ?>
        <a target="_blank" href="<?php echo get_option('fb');?>"><div class="fb"></div></a>
      <?php endif;?>
      <?php if (get_option('tw')) : ?>
        <a target="_blank" href="<?php echo get_option('tw');?>"><div class="tw"></div></a>
      <?php endif;?>
      <?php if (get_option('itg')) : ?>
        <a target="_blank" href="<?php echo get_option('itg');?>"><div class="itg"></div></a>
      <?php endif;?>
      </div>
    </div>
  </nav>

  <div class="side-open"><img src="<?php echo get_stylesheet_directory_uri();?>/img/logo.svg" width="40" height="40" alt=""></div>


  <div id="fullpage" class="container">
    <?php if (is_home()) : ?>
      <div class="mv-scrollify" data-section-name="home">
        <div class="mv-featured-img jarallax" style="height: 80vh;width: auto;">
          <img src="<?php echo get_stylesheet_directory_uri();?>/img/home.jpg" class="jarallax-img">
          <h1 class="mv-title title">Molino Viejo</h1>
        </div>
        <div class="mv-scroll-hint">
          <span style="background: url(<?php echo get_stylesheet_directory_uri();?>/img/logo_bg.svg)"></span>
        </div>
      </div>
    <?php else : ?>
      <div class="mv-scrollify" data-section-name="home">
        <div class="mv-featured-img jarallax" style="height: 80vh;width: auto;">
          <img src="<?php echo get_stylesheet_directory_uri();?>/img/home.jpg" class="jarallax-img">
          <h1 class="mv-title title"><?php the_title();?></h1>
        </div>
        <div class="mv-scroll-hint">
          <span style="background: url(<?php echo get_stylesheet_directory_uri();?>/img/logo_bg.svg)"></span>
        </div>
      </div>
    <?php endif;?>