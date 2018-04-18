<?php get_header(); ?>
<div class="mv-scrollify">
  <div class="row mv-row-center">
    <div class="col">
      <p class="" style="margin: 2em auto 0.5em;text-align: center;">
        Molino Viejo, donde la tranquilidad fluye con sensación de libertad y paz; un espacio de fusión clásica y contemporánea, que convive con actividades de deporte y entretenimiento como el golf, equitación y gastronomía. Perfecta armonía del bienestar, la cercanía, la atención e instalaciones de primera.
      </p>
    </div>
  </div>
  <div class="row">
      <ul class="nav mv-nav-secondary">
        <?php
          $categories = get_categories(array(
            'hide_empty' => 0,
            'orderby' => 'term_id',
            'order' => 'ASC'
          ));
          foreach ($categories as $category) :
            if ( $category->term_id!==1 && !stristr($category->slug, 'logros') && !stristr($category->slug, 'menu') ):
        ?>
              <li class="nav-item col-md-12 col-lg col-xl">
                <a class="nav-link active" href="#<?php echo $category->slug;?>"><span><?php echo $category->name;?></span></a>
              </li>
        <?php
            endif;
          endforeach;
        ?>
      </ul>
  </div>

  <div class="jarallax" style="height: 40vh; width: auto;margin-top: 50px;">
    <img src="<?php echo get_stylesheet_directory_uri();?>/img/valle.jpg" class="jarallax-img">
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
<div id="<?php echo $category->slug;?>" data-section-name="<?php echo $category->slug;?>" class="mv-section mv-scrollify <?php echo $category->slug;?>">
  <div class="row title mv-row-center">
    <!--<div class="col-xs-1 col-sm-1 d-block d-xs-block d-sm-block d-md-none d-lg-none d-xl-none"></div>-->
    <div class="col">
      <h2 class="title"><?php echo $category->name;?></h2>
    </div>
  </div>
  <div class="row desc mv-row-center">
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
  <div class="row menu mv-row-center">
    <?php
      $len = sizeof($menu);
      foreach ($menu as $key => $menu_item) :
    ?>
    <div class="nav-item col hidden-md <?php echo ($key==0) ? 'mv-default-content' : '';?>" style="<?php echo 'padding:0em;width: calc( ( 100% - 6em ) / '.$len.' );';?>">
      <a href="javascript:void(0)" class="nav-link mv-section-option" href="#" data-id="<?php echo $menu_item->ID;?>" data-url="<?php echo admin_url('admin-ajax.php');?>" data-target="#mv-section-content-<?php echo $category->slug;?>"><span><?php echo $menu_item->post_title;?></span></a>
    </div>
    <div class="nav-item col-12 hidden-lg <?php echo ($key==0) ? 'mv-default-content' : '';?>">
      <a href="javascript:void(0)" class="nav-link mv-section-option" href="#" data-id="<?php echo $menu_item->ID;?>" data-url="<?php echo admin_url('admin-ajax.php');?>" data-target="#mv-section-content-<?php echo $category->slug;?>"><span><?php echo $menu_item->post_title;?></span></a>
    </div>
    <?php
      endforeach;
    ?>
  </div>
  <?php
    endif;
    wp_reset_postdata();
    wp_reset_query();
  ?>

  <div class="row mv-row-center mv-section-content">
    <div class="col">
      <div id="mv-section-content-<?php echo $category->slug;?>"></div>
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
        wp_reset_query();
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
  wp_reset_query();
?>
<div class="mv-scrollify wrapper" data-section-name="membresias">
  <div id="mv-membership" class="mv-section mv-membership">
    <div class="row title">
      <h2 class="">Membresías</h2>
    </div>
    <div class="desc row">
      <?php
        $memberships = new WP_Query(array(
          'post_type' => 'mv-membresias'
        ));
        while($memberships->have_posts()):
          $memberships->the_post();
      ?>
      <div class="row mv-packet col-md-12 col-lg-3 col-xl-3">
        <div class="mv-packet-img col-12">
          <?php if(has_post_thumbnail(get_the_ID())) : ?>
            <div class="image" style="background-image: url(<?php echo get_the_post_thumbnail_url();?>);background-size: cover;background-position: center;background-repeat: no-repeat;"></div>
          <?php else : ?>
            <div class="image" style=""></div>
          <?php endif;?>
        </div>
        <div class="info post_content col-12">
          <h3><?php the_title();?></h3>
          <?php the_content();?>
        </div>
      </div>
      <?php
        endwhile;
        wp_reset_postdata();
      ?>
    </div>
  </div>
  <div id="molino-contacto"></div>
  <div id="contacto" class="mv-section mv-contact">
    <div class="desc">
      <div class="info">
        <h3>Dirección</h3>
        <p><?php echo get_option('contact_calle');?> <?php echo get_option('contact_colonia');?></p>
        <p><?php echo get_option('contact_ciudad');?>, <?php echo get_option('contact_estado');?> C.P. <?php echo get_option('contact_cp');?></p>
        <h3>Teléfonos</h3>
        <p><?php echo get_option('contact_phone');?></p>
        <h3>Correo electrónico</h3>
        <p>mail@mail.com</p>
        <div class="social">
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
      <div id="mv-map-contact" class="map">
      </div>
    </div>
    <div style="clear: both;"></div>
  </div>
</div>
<div id="mv-instagram" class="mv-image-feed">
  <div class="row">
    <div class="col-md-6 col-lg mv-feed">
      <img id="mv-itg-1" class="image">
    </div>
    <div class="col-md-6 col-lg mv-feed">
      <img id="mv-itg-2" class="image">
    </div>
    <div class="col-md-6 col-lg d-none d-xs-none d-sm-none d-md-none d-lg-block d-xl-block mv-feed">
      <img id="mv-itg-3" class="image">
    </div>
    <div class="col-md-6 col-lg d-none d-xs-none d-sm-none d-md-none d-lg-block d-xl-block mv-feed">
      <img id="mv-itg-4" class="image">
    </div>
    <div class="col-sm-12 col-lg d-none d-xs-none d-sm-none d-md-none d-lg-block d-xl-block mv-feed">
      <img id="mv-itg-5" class="image">
    </div>
  </div>
</div>
<?php get_footer(); ?>
