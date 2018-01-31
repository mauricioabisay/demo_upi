<?php get_header(); ?>
<div class="mv-scrollify">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="wrapper"></div>
        <img class="d-block" src="<?php echo get_stylesheet_directory_uri();?>/img/golf_bag.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <div class="wrapper"></div>
        <img class="d-block" src="<?php echo get_stylesheet_directory_uri();?>/img/horse_sadle.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <div class="wrapper"></div>
        <img class="d-block" src="<?php echo get_stylesheet_directory_uri();?>/img/golf_shoot.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="mv-scroll-hint">
    <span style="background: url(<?php echo get_stylesheet_directory_uri();?>/img/logo_bg.svg)"></span>
  </div>
</div>

<div class="mv-scrollify">
  <div class="row mv-row-center">
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
  </div>
  <div class="row">
      <ul class="nav mv-nav-secondary">
        <li class="nav-item">
          <a class="nav-link active" href="#golf">Golf</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#equitacion">Equitacion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#gastronomia">Gastronomia</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#eventos">Eventos Especiales</a>
        </li>
      </ul>
  </div>

  <div class="row mv-image-feed">
    <div class="col-md-6 col-lg">
      <div class="image"></div>
    </div>
    <div class="col-md-6 col-lg">
      <div class="image"></div>
    </div>
    <div class="col-md-6 col-lg">
      <div class="image"></div>
    </div>
    <div class="col-md-6 col-lg">
      <div class="image"></div>
    </div>
    <div class="col-sm-12 d-block d-md-none d-lg-block col-lg">
      <div class="image"></div>
    </div>
  </div>
</div>

<div id="golf" class="mv-section golf mv-scrollify">
  <div class="row title">
    <h2>Golf</h2>
  </div>
  <div class="row desc">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </div>
  <div class="row menu">
    <div class="col-2 logo">
      <div class="img"></div>
    </div>
    <div class="col-10 navigation">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link active" href="#">Horarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Clinicas y Clases</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tienda</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="row gallery">
    <div class="col-md-5 col-lg-3 side">
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/golf_bag.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/golf_course.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-7 col-lg-6 center">
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/golf_player.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
    </div>
    <div class="d-block d-md-none d-lg-block col-sm-12 col-lg-3 side">
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/golf_pot.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/golf_shoot.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
    </div>
  </div>

</div>


<div id="equitacion" class="mv-section horse mv-scrollify">
  <div class="row title">
    <h2>Equitacion</h2>
  </div>
  <div class="row desc">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </div>
  <div class="row menu">
    <div class="col-2 logo">
      <div class="img"></div>
    </div>
    <div class="col-10 navigation">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link active" href="#">Horarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Clases</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Competencias</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="achivements">
    <div class="row title">
      <h3>Logros</h3>
    </div>
    <div class="row gallery">
      <div class="col-md-6 col-lg">
        <div class="image"></div>
      </div>
      <div class="col-md-6 col-lg">
        <div class="image"></div>
      </div>
      <div class="col-md-6 col-lg">
        <div class="image"></div>
      </div>
      <div class="col-md-6 col-lg">
        <div class="image"></div>
      </div>
      <div class="col-sm-12 d-block d-md-none d-lg-block col-lg">
        <div class="image"></div>
      </div>
    </div>
  </div>

  <div class="row gallery">
    <div class="col-md-5 col-lg-3 side">
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/horse_ground.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/horse_polo.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-7 col-lg-6 center">
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/horse.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
    </div>
    <div class="d-block d-md-none d-lg-block col-sm-12 col-lg-3 side">
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/horse_sadle.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
      <div class="image">
        <img class="img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/horse_rider.jpg">
        <div class="info">
            <div class="bg"></div>
            <div class="content">
              <h3>Lorem ipsum</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mv-scrollify">
  <div id="mv-membership" class="mv-section mv-membership">
    <div class="row title">
      <h2>Membresias</h2>
    </div>
    <div class="desc">
      <div class="row mv-packet">
        <div class="align-middle col-2">
          <div class="image"></div>
          <h3>Paquete 1</h3>
        </div>
        <div class="info col-10">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>

      <div class="row mv-packet">
        <div class="align-middle col-2">
          <div class="image"></div>
          <h3>Paquete 2</h3>
        </div>
        <div class="info col-10">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>
    </div>
  </div>

  <div id="contacto" class="mv-section mv-contact">
    <div class="row desc">
      <div class="col-5">
        <h2>Contacto</h2>
        <h3>lorem ipsum</h3>
        <p>calle colonia</p>
        <p>00.00.00.00.00</p>
        <p>
          <span class="itg"></span>
          <span class="fb"></span>
          <span class="tw"></span>
        </p>
      </div>
      <div class="col-7 map">
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
