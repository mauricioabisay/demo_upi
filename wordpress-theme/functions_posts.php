<?php
use NWM\WP\WP;
use NWM\WC;
require_once('nwm_wp/nwm_wp.php');
require_once('nwm_wp/nwm_wc.php');

class Test extends NWM\WP\SimplePost {
    function __construct() {
        parent::__construct('test', 'Test', 'Pruebas');
        $this->add_field('loc-cata-cerveza-single', 'Cerveza', 'single-choice', '','product');
        $this->add_field('loc-cata-cerveza-multi', 'Cerveza', 'multi-choice', '','product');
        $this->add_field('loc-cata-cerveza-dropdown', 'Cerveza', 'dropdown', '','product');
    }
}

class Cata extends NWM\WP\SimplePost {
    function __construct() {
        parent::__construct('cata', 'Cata', 'Catas');
        $this->add_field('loc-cata-cerveza', 'Cerveza', 'dropdown', '','product');
        $this->add_field('loc-cata-color', 'Color', 'text');
        $this->add_field('loc-cata-espuma', 'Espuma', 'text');
        $this->add_field('loc-cata-alcohol', 'Alcohol', 'text');
        $this->add_field('loc-cata-cuerpo', 'Cuerpo', 'text');
        $this->add_field('loc-cata-amargor', 'Amargor', 'text');
        $this->add_field('loc-cata-final', 'Final', 'text');
    }
}

class Cerveceria extends NWM\WP\SimplePost {
    function __construct() {
        parent::__construct('cerveceria', 'Cervecería', 'Cerveceras');
    }
}

class GalleryItem extends NWM\WP\SimplePost {
    function __construct() {
        parent::__construct('gallery-our-work', 'Our Work Image', 'Our Work Gallery');
        $this->supports = array('title', 'thumbnail');
    }
}

class WC_Cerveza extends NWM\WC\WC {
    function __construct() {
        parent::__construct();
    }

    function register_extra_fields() {
        $this->add_field('loc-cerveceria', 'Cervecería', 'dropdown', 'Nombre de la cervecería', array('query_args' => array('post_type' => 'cerveceria')));

        $this->add_field('loc-multi', 'Cervecería', 'multi-choice', 'Nombre de la cervecería', array('query_args' => array('post_type' => 'cerveceria')));

        $this->add_field('loc-single', 'Cervecería', 'single-choice', 'Nombre de la cervecería', array('query_args' => array('post_type' => 'cerveceria')));

        /*
        $this->add_field('nwm-desc', 'NWM Desc.', 'description', 'Hola mundo');
        $this->add_field('nwm-radio', 'NWM Radio', 'single-choice', 'Hola mundo', array('op1', 'op2', 'op3'));
        $this->add_field('nwm-chk', 'NWM Check', 'multi-choice', 'Hola mundo', array('op1', 'op2', 'op3'));
        */
        $this->add_field('loc-origen', 'Origen', 'text', 'Lugar de origen de la cerveza');
    }
}

class WP_Test extends NWM\WP\SimplePost {
    function __construct() {
        parent::__construct('nwm-test-post', 'Test', 'Tests');
        $this->add_field('nwm-wp-text', 'Text', 'text');
        $this->add_field('nwm-wp-radio', 'Radio', 'single-choice', 'Selecciona una opción', array('R1', 'R2', 'R3'));
        $this->add_field('nwm-wp-text', 'Checkbox', 'multi-choice', 'Selecciona las opciones', array('Cb1', 'Cb2', 'Cb3'));
        $this->add_field('nwm-wp-select', 'Select', 'dropdown', 'Elige una opción', array('Op1', 'Op2', 'Op3'));
        $this->add_field('nwm-wp-location', 'Location', 'map', 'Pick a location');
    }
}