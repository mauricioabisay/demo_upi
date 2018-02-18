<?php get_header(); ?>
<div class="mv-scrollify">
  <?php /*
  <div id="carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="wrapper"></div>
        <img class="d-block" src="<?php echo get_stylesheet_directory_uri();?>/img/golf_bag.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <div class="wrapper"></div>
        <img class="d-block" src="<?php echo get_stylesheet_directory_uri();?>/img/horse_sadle.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <div class="wrapper"></div>
        <img class="d-block" src="<?php echo get_stylesheet_directory_uri();?>/img/golf_shoot.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  */?>
  <div style="background-image: url(<?php echo get_stylesheet_directory_uri();?>/img/home.jpg);background-repeat: no-repeat;background-size: cover;background-position: center;height: 85vh;width: auto;margin-bottom: 0em;padding-bottom: 0em:"></div>
  <div class="mv-scroll-hint">
    <span style="background: url(<?php echo get_stylesheet_directory_uri();?>/img/logo_bg.svg)"></span>
  </div>
</div>

<div class="mv-scrollify">
  <div class="row mv-row-center">
    <div class="col-xs-1 col-sm-1 d-block d-xs-block d-sm-block d-md-none d-lg-none d-xl-none"></div>
    <div class="col">
      <p style="margin: 2em auto;">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>
  </div>
  <div class="row">
      <ul class="nav mv-nav-secondary">
        <li class="nav-item">
          <a class="nav-link active" href="#golf">Golf</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#equitacion">Equitacion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#gastronomia">Gastronomia</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#eventos">Eventos Especiales</a>
        </li>
      </ul>
  </div>

  <div class="row mv-image-feed">
    <div class="col-md-6 col-lg mv-feed">
      <div class="image"></div>
    </div>
    <div class="col-md-6 col-lg mv-feed">
      <div class="image"></div>
    </div>
    <div class="col-md-6 col-lg d-block d-xs-none d-sm-none d-md-block d-lg-block d-xl-block mv-feed">
      <div class="image"></div>
    </div>
    <div class="col-md-6 col-lg d-block d-xs-none d-sm-none d-md-block d-lg-block d-xl-block mv-feed">
      <div class="image"></div>
    </div>
    <div class="col-sm-12 col-lg d-block d-xs-none d-sm-none d-md-none d-lg-block d-xl-block mv-feed">
      <div class="image"></div>
    </div>
  </div>
</div>

<?php
  $categories = get_categories(array(
    'hide_empty' => 0,
    'orderby' => 'term_id',
    'order' => 'ASC'
  ));
  foreach ($categories as $category) :
    if ( $category->term_id!==1 && !stristr($category->slug, 'logros') && !stristr($category->slug, 'menu') ):
?>
<div id="<?php echo $category->slug;?>" class="mv-section mv-scrollify <?php echo $category->slug;?>">
  <div class="row title">
    <div class="col-xs-1 col-sm-1 d-block d-xs-block d-sm-block d-md-none d-lg-none d-xl-none"></div>
    <div class="col">
      <h2><?php echo $category->name;?></h2>
    </div>
  </div>
  <div class="row desc">
    <p><?php echo $category->description;?></p>
  </div>

  <?php
    $menu = get_posts(array(
      'orderby' => 'ID',
      'order' => 'ASC',
      'post_type' => 'post',
      'post_status' => 'publish',
      'tax_query' => array(
        array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => $category->slug
        ),
        array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => 'menu'
        )
      )
    ));
    if (sizeof($menu)>0) :
  ?>
  <div class="row menu">
    <div class="col-2 logo">
      <div class="img"></div>
    </div>

    <div class="col-10 navigation">
      <ul class="nav">
        <?php
          foreach ($menu as $key => $menu_item) :
        ?>
        <li class="nav-item col-md-12">
          <a class="nav-link active" href="#"><span><?php echo $menu_item->post_title;?></span></a>
        </li>
        <?php
          endforeach;
        ?>
      </ul>
    </div>

  </div>
  <?php
    endif;
    wp_reset_postdata();
  ?>

  <div class="row" class="mv-section-content">
    <div class="col">

    </div>
  </div>

  <?php
    $achievements = get_posts(array(
      'posts_per_page'   => 5,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post_type'        => 'post',
      'post_status'      => 'publish',
      'tax_query'        => array(
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $category->slug
          ),
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'logros'
          )
      )
    ));
    if(sizeof($achievements)>0):
  ?>
  <div class="achievements">
    <div class="row title">
      <h3>Logros</h3>
    </div>
    <div class="row gallery">
      <?php
        $class = 'col-md-6 col-lg';
        foreach ($achievements as $key => $achievement) :
      ?>
        <div class="<?php echo $class;?>">
          <div class="image" style="background-image: url(<?php echo get_the_post_thumbnail_url($achievement->ID);?>);background-repeat: no-repeat;background-position: center;background-size: cover;"></div>
        </div>
      <?php
        if($key+1==sizeof($achievements)) {
          $class = 'col-sm-12 d-block d-md-none d-lg-block col-lg';
        } else {
          $class = 'col-md-6 col-lg';
        }
        endforeach;
        wp_reset_postdata();
      ?>
    </div>
  </div>
  <?php
    endif;
  ?>
  <?php
    $gallery = get_posts(array(
      'posts_per_page'   => 5,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post_type'        => 'post',
      'post_status'      => 'publish',
      'tax_query'        => array(
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $category->slug
          ),
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'logros',
            'operator' => 'NOT IN'
          ),
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'menu',
            'operator' => 'NOT IN'
          )
      )
    ));
    $gallery_len = sizeof($gallery);
    if ($gallery_len>0) :
  ?>
  <div class="row gallery">

    <div class="col-md-5 col-lg-3 side">
      <?php for($i=0; $i<2; $i++) :?>
      <div class="image" style="height: 40vh;width: 100%;background-image: url(<?php echo get_the_post_thumbnail_url($gallery[$i]->ID);?>);background-size: cover;background-repeat: no-repeat;background-position: center;">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3><?php echo $gallery[$i]->post_title;?></h3>
              <p><?php echo $gallery[$i]->post_excerpt;?></p>
            </div>
        </div>
      </div>
      <?php endfor;?>
    </div>
    <div class="col-md-7 col-lg-6 center">
      <?php for($i=$i; $i<3; $i++) :?>
      <div class="image" style="height: 100%;width: 100%;background-image: url(<?php echo get_the_post_thumbnail_url($gallery[$i]->ID);?>);background-size: cover;background-repeat: no-repeat;background-position: center;">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3><?php echo $gallery[$i]->post_title;?></h3>
              <p><?php echo $gallery[$i]->post_excerpt;?></p>
            </div>
        </div>
      </div>
      <?php endfor;?>
    </div>

    <div class="d-block d-md-none d-lg-block col-sm-12 col-lg-3 side">
      <?php for($i=$i; $i<$gallery_len; $i++) :?>
      <div class="image" style="height: 40vh;width: 100%;background-image: url(<?php echo get_the_post_thumbnail_url($gallery[$i]->ID);?>);background-size: cover;background-repeat: no-repeat;background-position: center;">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3><?php echo $gallery[$i]->post_title;?></h3>
              <p><?php echo $gallery[$i]->post_excerpt;?></p>
            </div>
        </div>
      </div>
      <?php endfor;?>
    </div>
  </div>
  <?php
    endif;
  ?>
</div>
<?php
  endif;
  endforeach;
  wp_reset_postdata();
?>
<div class="mv-scrollify">
  <div id="mv-membership" class="mv-section mv-membership">
    <div class="row title">
      <h2>Membresias</h2>
    </div>
    <div class="desc">
      <?php
        $memberships = new WP_Query(array(
          'post_type' => 'mv-membresias'
        ));
        while($memberships->have_posts()):
          $memberships->the_post();
      ?>
      <div class="row mv-packet">
        <div class="col-2">
          <div class="image" style="background-image: url(<?php echo get_the_post_thumbnail_url();?>);background-size: cover;background-position: center;background-repeat: no-repeat;"></div>
          <h3><?php the_title();?></h3>
        </div>
        <div class="info col-10 post_content">
          <?php the_content();?>
        </div>
      </div>
      <?php
        endwhile;
        wp_reset_postdata();
      ?>
    </div>
  </div>

  <div id="contacto" class="mv-section mv-contact">
    <div class="row desc">
      <div class="col-5">
        <h2 class="title">Contacto</h2>
        <h3><?php echo get_option('contact_calle');?> <?php echo get_option('contact_colonia');?></h3>
        <p><?php echo get_option('contact_ciudad');?>, <?php echo get_option('contact_estado');?></p>
        <p>C.P. <?php echo get_option('contact_cp');?></p>
        <p><?php echo get_option('contact_phone');?></p>
        <div class="social">
          <a target="_blank" href="<?php echo get_option('fb');?>"><div class="fb"></div></a>
          <a target="_blank" href="<?php echo get_option('tw');?>"><div class="tw"></div></a>
          <a target="_blank" href="<?php echo get_option('itg');?>"><div class="itg"></div></a>
        </div>
      </div>
      <div id="mv-map-contact" class="col-7 map">
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
