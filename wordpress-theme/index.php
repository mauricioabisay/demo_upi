<?php
get_header();
if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    $share_url = get_the_permalink();
    get_template_part( 'content', get_post_format() );
  }

}
get_footer();
?>