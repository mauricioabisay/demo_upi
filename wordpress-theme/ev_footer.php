<?php
  $footer_class = '';
  $contact_class = '';
  if(is_single() || is_page()) {
    $share_url = get_the_permalink();
  } else {
    $share_url = get_home_url();
  }
  if(is_single()) {
    $footer_class = 'post-footer';
    $contact_class = 'post-contact';
  }
  if(is_page()) {
    $footer_class = 'page-footer';
    $contact_class = 'page-contact';
  }
  if(is_search()) {
    $footer_class = 'search-footer';
    $contact_class = '';
  }
?>
<?php if(!is_home()) : ?>
<div class="foot-bottom"></div>
<button class="btn pull-right cu <?php echo $contact_class;?>" data-toggle="modal" data-target="#myformulario"><?php //pll_e('ev-contact-us');?></button>
<?php endif;?>
<?php
  $flag = true;
  if(isset($_GET['s']) || is_archive()) {
    $flag = false;
  }
  if(is_page()) {
    global $post;
    $current_page = $post->post_name;
    if( $current_page=='journal' || $current_page=='resources' || $current_page=='press' || $current_page=='privacy-policy' || $current_page=='terms-of-use' ) {
      $flag = false;
    }
  }
?>
<?php if ( $flag ) : ?>
<div class="container good">
  <div class="row">
    <p class="col-md-6"><?php ////pll_e('ev-share-motto');?></p>
    <div class="col-md-5 pull-right share">
      <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url;?>">
        <button class="btn fb"><i class="fa fa-facebook" aria-hidden="true"></i>share on Facebook</button>
      </a>
      <a target="_blank" href="https://plus.google.com/share?url=<?php echo $share_url;?>">
        <button class="btn gplus"><i class="fa fa-google-plus" aria-hidden="true"></i>share on Google</button>
      </a>
      <a target="_blank" href="https://twitter.com/share?url=<?php echo $share_url;?>">
        <button class="btn tw"><i class="fa fa-twitter" aria-hidden="true"></i>share on Twitter  </button>
      </a>
      <a target="_blank" href="https://www.linkedin.com/cws/share?url=<?php echo $share_url;?>">
        <button class="btn ln"><i class="fa fa-linkedin" aria-hidden="true"></i>share on LinkedIn</button>
      </a>
    </div>
  </div>
</div>
<?php endif;?>
<footer <?php echo 'class="'.$footer_class.'"';?>>
  <div class="container-fluid foot">
    <div class="row">
      <div class="col-md-4 col-sm-12 hidden-sm hidden-xs">
        <span><?php //pll_e('ev-footer-stay-updated');?></span>
        <span><?php //pll_e('ev-footer-stay-updated-subtitle');?></span>
        <button class="btn" data-toggle="modal" data-target="#myNews"><?php //pll_e('ev-subscribe');?></button>
      </div>
      <div class="col-md-2 col-sm-6 col-xs-6 text-center">
        <p><a href="<?php //echo get_the_permalink(//pll_get_post(get_page_by_path( 'resources' )->ID));?>"><?php //pll_e('ev-resources');?></a></p>
        <p><a href="<?php //echo get_the_permalink(//pll_get_post(get_page_by_path( 'press' )->ID));?>"><?php //pll_e('ev-press');?></a></p>
      </div>
      <div class="col-md-2 col-sm-6 col-xs-6 text-center">
        <p><a href="<?php //echo get_the_permalink(//pll_get_post(get_page_by_path( 'privacy-policy' )->ID));?>"><?php //pll_e('ev-privacy-policy');?></a></p>
        <p><a href="<?php //echo get_the_permalink(//pll_get_post(get_page_by_path( 'terms-of-use' )->ID));?>"><?php //pll_e('ev-terms');?></a></p>
      </div>
      <div class="col-md-3 col-sm-12 col-xs-12 text-center">
        <span><?php //pll_e('ev-follow-us');?>:</span>
        <a href="http://facebook.com" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        <a href="http://twitter.com" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
        <a href="http://pinterest.com" target="_blank"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
        <a href="http://instagram.com" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="http://youtube.com" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</footer>