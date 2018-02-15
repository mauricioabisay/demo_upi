<?php
use NWM\WP\WP;
use NWM\WC;
require_once('nwm_wp/nwm_wp.php');
require_once('nwm_wp/nwm_wc.php');

class Membership extends NWM\WP\SimplePost {
    function __construct() {
        parent::__construct('mv-membresias', 'Membresia', 'Membresias');
    }
}

class Sponsor extends NWM\WP\SimplePost {
    function __construct() {
        parent::__construct('mv-sponsor', 'Patrocinador', 'Patrocinadores');
        $this->add_field('mv-sponsor-link', 'Link', 'text');
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