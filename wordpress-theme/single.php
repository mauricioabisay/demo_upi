<?php get_header(); ?>

<?php
the_post();
$share_url = get_the_permalink();
?>
<div class="journal interiores ev-post">
  <div class="section moveDown ev-page" id="section5">
    <div class="img-header" style="background: url(<?php echo the_post_thumbnail_url();?>);"></div>
    <div class="container">
      <h1 class="text-center"><?php the_title();?></h1>
      <!-- <h3 class="text-center">OUR PHILOSOPHY, WORK AND LATEST NEWS.</h3> -->
      <div class="panel-group">
        <div class="panel ">
          <div class="panel-heading">By: <?php the_author();?></div>
            <div class="panel-heading"><?php the_date();?></div>
            <div class="panel-body content">
              <?php the_content();?>
            </div>
        </div><!--panel-->
      </div><!--panel-group-->

      <div class="col-xs-12 col-md-5 pull-left share share1">
        <span class="col-md-6 col-sm-12 link">
          <a class="fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url;?>">
            <i class="fa fa-facebook" aria-hidden="true"></i>share on Facebook
          </a>
        </span>
        <span class="col-md-6 col-sm-12 link">
          <a class="tw" target="_blank" href="https://twitter.com/share?url=<?php echo $share_url;?>">
            <i class="fa fa-twitter" aria-hidden="true"></i>share on Twitter
          </a>
        </span>
      </div>

      <div class="col-md-12 tags">
        <?php $tags = wp_get_post_tags(get_the_ID());?>
        <?php foreach($tags as $t) : ?>
          <a href="<?php echo get_tag_link($t->term_id); ?>"><button class="btn"><?php echo $t->name;?></button></a>
        <?php endforeach;?>
      </div>

      <?php get_template_part('ev-posts_links');?>
    </div><!--container-->
    <?php get_template_part('ev_footer');?>
  </div><!--section5-->
</div>
<?php get_footer(); ?>