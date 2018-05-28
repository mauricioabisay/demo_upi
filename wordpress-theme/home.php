<?php get_header(); ?>
<?php /*
<div class="mv-scrollify">
  <div class="jarallax" style="height: 40vh; width: auto;margin-top: 50px;">
    <img src="<?php echo get_stylesheet_directory_uri();?>/img/valle.jpg" class="jarallax-img">
  </div>
</div>
*/?>
<div class="">
<div class="upaep-project-list row">

<?php
  $counter = 0;
  $query = new WP_Query(array(
    'post_type' => 'upaep-research'
  ));
  if ( $query->have_posts() ) :
  while ( $query->have_posts() ) :
    $query->the_post();
?>

<a class="post-thumb col" href="<?php echo get_the_permalink();?>">
  <?php if ( $counter%2 == 0 ) : ?>
    <div class="desc col-5">
      <h2><?php the_title();?></h2>
      <p><?php the_excerpt();?><p>
    </div>
    <div class="img col-6" style="background-image:url(<?php echo get_the_post_thumbnail_url();?>);"></div>
  <?php else : ?>
    <div class="img col-6" style="background-image:url(<?php echo get_the_post_thumbnail_url();?>);"></div>
    <div class="desc col-5">
      <h2><?php the_title();?></h2>
      <p><?php the_excerpt();?><p>
    </div>
  <?php endif;?>
</a>

<?php
  $counter++;
  endwhile;
  endif;
  wp_reset_postdata();
  wp_reset_query();
?>

</div>
</div>
<?php get_footer(); ?>
