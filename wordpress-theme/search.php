<?php get_header();?>

<?php

$value = '';
if ( isset($_GET['s']) && (strlen($_GET['s']) > 0) ) {
    $args = array(
        's' => $_GET['s'],
        'post_type' => 'any',
    );
    $query = new WP_Query($args);
    $value = $_GET['s'];
} else {
    $query = new WP_Query();
}
?>

<div class="journey interiores" >
    <div class="section moveDown padding-top0 ev-page" id="section5">
        <div class="container-fluid box-search">
            <div class="container">
                <form id="custom-search-input" action="<?php echo esc_url(home_url('/'));?>">
                    <div class="input-group col-md-12">
                        <input type="text" class="search-query form-control" placeholder="Search" name="s" value="<?php echo $value;?>" />
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit">
                                <span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div><!--custom-search-input-->
            <div id="ev-results-list" class="row results">
            <?php if($query->have_posts()): ?>
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12 result-count">
                    <p><?php pll_e('ev-we-have-found');?> <?php echo $query->post_count;?> <?php pll_e('ev-results');?>...</p>
                </div>
                <?php while($query->have_posts()) : $query->the_post();?>
                <figure class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                  <figcaption>
                    <h3><?php the_title();?></h3>
                    <span><?php echo get_the_date();?></span>
                    <?php the_excerpt();?>
                    <a href="<?php echo get_the_permalink();?>"><?php pll_e('ev-continue-reading');?></a>
                  </figcaption>
                </figure>
                <?php endwhile;?>
            <?php else : ?>
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12 result-count">
                    <p><?php pll_e('ev-no-results-found');?></p>
                </div>
            <?php endif;?>
            </div>
        </div>
        <?php get_template_part('ev_footer');?>
    </div><!--container fluid-->
</div><!--section5-->
<?php get_footer();?>