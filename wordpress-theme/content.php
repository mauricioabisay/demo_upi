<div class="post">
    <div class="img-featured" style="background: url(<?php the_post_thumbnail_url('large');?>);"></div>
    <div class="post-container">
        <div class="header">
            <h1 class="title"><?php the_title();?></h1>
            <h6 class="date"><?php the_date();?></h6>
        </div>
        <div class="content">
            <?php the_content();?>
        </div>
    </div>
</div>