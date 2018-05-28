<?php
use NWM\WP\WP;
use NWM\WC;
require_once('nwm_wp/nwm_wp.php');
require_once('nwm_wp/nwm_wc.php');

class Research extends NWM\WP\SimplePost {
    function __construct() {
        parent::__construct('upaep-research', 'Investigación', 'Investigaciones');
        //Lider del proyecto
        $this->add_field(
            'upaep-research-leader', 
            'Líder de proyecto', 
            'dropdown', 
            'Líder del proyecto', 
            'upaep-student');
        //Alumnos participantes
        $this->add_field(
            'upaep-research-alumno', 
            'Alumno', 
            'dropdown', 
            'Selecciona un alumno', 
            'upaep-student'
        );
        //Instituciones participantes
        //Carreas participantes
        //Equipo y software que usa el proyecto
        $this->add_field(
            'upaep-research-herramientas', 
            'Equipo y software que usa el proyecto',
            'description',
            'Describe el equipo que se usará para desarrollar el proyecto'
        );
        //Necesidades resueltas
        $this->add_field(
            'upaep-research-logros', 
            'Logros',
            'description',
            'Describe las necesidades que ha resuelto el proyecto'
        );
        //Desc breve del trabajo a futuro
        $this->add_field(
            'upaep-research-futuro', 
            'Trabajo a futuro',
            'description',
            'Describe el trabajo a futuro del proyecto'
        );
        //Desc del financiamiento
        //Comentarios adicionales
        $this->add_field(
            'upaep-research-comentarios', 
            'Comentarios adicionales',
            'description',
            'Comentarios adicionales del proyecto'
        );

        /*/ Create the WP_User_Query object
        $wp_user_query = new WP_User_Query(array('order' => 'ASC'));

        // Get the results
        $authors = $wp_user_query->get_results();

        // Check for results
        if ( ! empty( $authors ) ) {
            echo '<ul>';
            // loop through each author
            foreach ( $authors as $author ) {
                // get all the user's data
                $author_info = get_userdata( $author->ID );
                echo '<li>';
                print_r($author_info);
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo 'No authors found';
        }
        exit();*/
    }
}

class Student extends NWM\WP\SimplePost {
    function __construct() {
        parent::__construct('upaep-student', 'Alumno', 'Alumnos');
        $this->add_field('upaep-student-name', 'Nombre', 'text');
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