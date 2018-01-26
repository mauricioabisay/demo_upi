<?php
  $args = array(
    'posts_per_page'   => 1,
    'offset'           => 0,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_status'      => 'publish',
    'suppress_filters' => true
  );
  $posts_latest = get_posts($args);
  $args = array(
    'posts_per_page'   => 1,
    'offset'           => 0,
    'orderby'          => 'date',
    'order'            => 'ASC',
    'post_status'      => 'publish',
    'suppress_filters' => true
  );
  $post_oldest = get_posts($args);
  $latest_url = '';
  foreach ($posts_latest as $latest) {
    $latest_url = get_permalink($latest->ID);
  }
  $oldest_url = '';
  foreach ($post_oldest as $oldest) {
    $oldest_url = get_permalink($oldest->ID);
  }

  $count_posts = wp_count_posts();
  $published_posts = $count_posts->publish;

  $post_id = get_the_ID();
  $all_posts = get_posts(array(
      'fields' => 'ids',
      'numberposts' => -1,
      'orderby' => 'date',
      'order' => 'ASC'
  ));

  $post_number = array_search($post_id, $all_posts) + 1;
?>

<div class="col-xs-12 col-md-12 text-center">
    <div class="row">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <li>
          <a href="<?php echo $oldest_url;?>" aria-label="Oldest Post">
              <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i><i class="fa fa-angle-left" aria-hidden="true"></i></span>
            <a href="<?php echo get_permalink( get_adjacent_post(false,'',true) );?>" aria-label="Previous">
              <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
            </a>
          </li>
          <li class="pagination-counter"><span class="current"><?php echo $post_number;?></span> <span>/</span> <span class="total"><?php echo $published_posts;?></span></li>
          <li>
            <a href="<?php echo get_permalink( get_adjacent_post(false,'',false) );?>" aria-label="Next">
              <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
            </a>
            <a href="<?php echo $latest_url;?>" aria-label="Latest Post">
              <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i><i class="fa fa-angle-right" aria-hidden="true"></i></span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
</div><!---->