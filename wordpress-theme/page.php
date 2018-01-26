<?php get_header();?>

<?php
the_post();
$share_url = get_the_permalink();
?>

<div class="journey interiores" >
    <div class="section moveDown ev-page" id="section5">
        <div class="container" style="padding-top:50px;">
            <h2 class="text-center"><?php the_title();?></h2>
            <div class="panel-group">
              <div class="panel ">
                    <div class="panel-body text-justify">
                        <?php the_content();?>
                    </div>
              </div><!--panel-->
            </div><!--panel-group-->
        </div><!--container-->
        <?php get_template_part('ev_footer');?>
    </div><!--section5-->
</div>
<?php get_footer();?>