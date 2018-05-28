<?php get_header(); ?>

<?php
the_post();
$share_url = get_the_permalink();
?>
<div class="post">
  
  <div class="container">      
    <div class="row date section">
      <p class="col"><?php the_date();?></p>
    </div>
    
    <div class="leader section">
      <div class="row">
        <div class="col">
          <h2>Investigador Responsable</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-4 participant-profile">
          <div class="picture"></div>
          <div class="name">Mi nombre y mi apellido</div>
        </div>
      </div>
    </div>
    
    <div class="participants section">
      <div class="row">
        <div class="col">
          <h2>Investigadores</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-4 participant-profile">
            <div class="picture"></div>
            <div class="name">Mi nombre y mi apellido</div>
        </div>
        <div class="col-4 participant-profile">
          <div class="picture"></div>
          <div class="name">Mi nombre y mi apellido</div>
        </div>
        <div class="col-4 participant-profile">
          <div class="picture"></div>
          <div class="name">Mi nombre y mi apellido</div>
        </div>
      </div>
    </div>
    
    <div class="row tools section">
      <div class="col">
        <h2>Equipo y software empleado</h2>
        <pre><?php echo get_post_meta( get_the_ID(), 'upaep-research-herramientas', true );?></pre>
      </div>
    </div>
    
    <div class="row content section">
      <div class="col-12">
        <h2>Descripción</h2>
      </div>
      <div class="col-12">
        <?php the_content();?>
      </div>
    </div>
    
    <div class="row achievements section">
      <div class="col">
        <h2>Logros</h2>
        <pre><?php echo get_post_meta( get_the_ID(), 'upaep-research-logros', true );?></pre>
      </div>
    </div>
    
    <div class="row future section">
    <div class="col">
        <h2>Trabajo a futuro</h2>
        <pre><?php echo get_post_meta( get_the_ID(), 'upaep-research-futuro', true );?></pre>
      </div>
    </div>

    <div class="row comments section">
    <div class="col">
        <h2>Comentarios adicionales</h2>
        <p><?php echo get_post_meta( get_the_ID(), 'upaep-research-comentarios', true );?></p>
      </div>
    </div>

    <div class="row social">
      <div class="col">
        <span class="link">
          <a class="fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url;?>"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
        </span>
        <span class="link">
          <a class="tw" target="_blank" href="https://twitter.com/share?url=<?php echo $share_url;?>"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a>
        </span>
      </div>
    </div>

    <div class="row tags">
      <?php $tags = wp_get_post_tags(get_the_ID());?>
      <?php foreach($tags as $t) : ?>
        <a href="<?php echo get_tag_link($t->term_id); ?>"><button class="btn"><?php echo $t->name;?></button></a>
      <?php endforeach;?>
    </div>

  </div><!--container-->
</div>
<?php get_footer(); ?>

