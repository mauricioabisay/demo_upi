<?php get_header();?>

<?php
the_post();
$share_url = get_the_permalink();
?>

<div class="blog interiores">
    <div class="section moveDown ev-page" id="section5">
        <div class="container">
            <h1 class="text-center"><?php echo get_the_title();?></h1>
            <h2 class="text-center"><?php pll_e('blog-motto');?></h2>
            <div class="blog-figures">
                <?php
                    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 12,
                        'paged' => $paged,
                    );
                    $query = new WP_Query( $args );
                    $posts_per_row = 4;
                    $posts_counter = 0;
                ?>

                <?php while ( $query->have_posts() ) : ?>
                    <?php
                        $query->the_post();
                        if($posts_counter%$posts_per_row == 0) {
                            $class = 'col-md-offset-2';
                            $open_row = true;
                        ?>
                        <div class="row">
                        <?php
                        } elseif($posts_counter==0){
                            $class = 'col-md-offset-2';
                        } else {
                            $class = '';
                        }

                    ?>
                    <figure class="col-md-2 col-sm-12 col-xs-12 <?php echo $class;?>">
                        <a href="<?php the_permalink();?>"><img src="<?php echo get_the_post_thumbnail_url();?>" alt="" class="img-responsive"></a>
                        <figcaption>
                            <a href="<?php the_permalink();?>"><h3><?php the_title();?></h3></a>
                            <span><?php echo get_the_date();?></span>
                            <p><?php the_excerpt();?></p>
                            <a href="<?php the_permalink();?>"><?php pll_e('ev-continue-reading');?><span class="sr-only"> <?php the_title();?></span></a>
                        </figcaption>
                    </figure>
                    <?php
                        if(($posts_counter+1)%$posts_per_row == 0) {
                            $open_row = false;
                    ?>
                        </div>
                    <?php
                        }
                    ?>
                    <?php $posts_counter++;?>
                <?php endwhile;?>
                <?php if($open_row) {
                ?>
                    </div>
                <?php
                    }
                ?>
            </div>
            <?php
                $numpages = $query->max_num_pages;

                $pagination_args = array(
                    'base'            => get_pagenum_link(1) . '%_%',
                    'format'          => 'page/%#%',
                    'total'           => $numpages,
                    'current'         => $paged,
                    'show_all'        => false,
                    'end_size'        => 1,
                    //'mid_size'        => $pagerange,
                    'prev_next'       => true,
                    'prev_text'       => '<span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
                    'next_text'       => '<span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
                    'type'            => 'plain',
                    'add_args'        => false,
                    'add_fragment'    => ''
                  );

                  $paginate_links = paginate_links($pagination_args);
            ?>
            <div class="col-xs-12 col-md-12 text-center">
                <div class="row">
                    <nav aria-label="Page navigation" class="ev-pagination">
                        <?php echo $paginate_links;?>
                    </nav>
                </div>
            </div>
        </div>
        <?php get_template_part('ev_footer');?>
    </div><!--section5-->
</div>
<?php get_footer();?>