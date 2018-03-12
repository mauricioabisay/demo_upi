<?php
use NWM\WP\WP;
require_once('nwm_wp/nwm_wp.php');
require_once('nwm_wp/nwm_wp_location.php');
/**
* Functions used by theme
*/
class Theme extends NWM\WP\Theme {
	use NWM_Geolocation;

	function __construct() {
		parent::__construct();
		add_action('init', array($this, 'init'));
		$this->add_public_ajax($this, 'getSectionContent');
	}

	function getSectionContent() {
		if ( isset($_GET['id']) ) {
			$content = get_post($_GET['id']);
			if(is_null($content)) {
				print_r(json_encode(array('msg' => false)));
				exit();
			}
			print_r(json_encode(array('msg' => $content->post_content)));
			exit();
		} else {
			print_r(json_encode(array('msg' => false)));
			exit();
		}
	}

	function setScripts() {
		//Adding CDN CSS
		$this->add_css('bootstrap', new NWM\WP\CSS('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'));
		//Adding main style
		$this->add_css('nwm-wp-css-public', new NWM\WP\CSS(get_stylesheet_directory_uri() . '/style.css'));
		//Adding CDN JS
		$this->add_js('jquery', new NWM\WP\JS('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'));
		$this->add_js('popper', new NWM\WP\JS('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js'));
		$this->add_js('bootstrap-js', new NWM\WP\JS('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js'));
		//Leaflet
		$this->add_css('leaflet-css', new NWM\WP\CSS('https://unpkg.com/leaflet@1.2.0/dist/leaflet.css'));
		$this->add_js('leaflet-js', new NWM\WP\JS('https://unpkg.com/leaflet@1.2.0/dist/leaflet.js'));
		//Theme scripts
		if(!is_admin()) {
			$this->add_js('nwm-wp-js-public', new NWM\WP\JS(get_stylesheet_directory_uri().'/script.js'));
		}
	}

	function setAdminScripts() {
		//For Leaflet
		$this->add_admin_css('leaflet-css', new NWM\WP\CSS('https://unpkg.com/leaflet@1.2.0/dist/leaflet.css'));
		$this->add_admin_js('leaflet-js', new NWM\WP\JS('https://unpkg.com/leaflet@1.2.0/dist/leaflet.js'));
		//Theme scripts
		$this->add_admin_js('nwm-wp-js-admin', new NWM\WP\JS(get_stylesheet_directory_uri().'/admin.js'));
		$this->add_admin_css('nwm-wp-css-admin', new NWM\WP\CSS(get_stylesheet_directory_uri().'/admin.css'));
	}

	function show_hidden_meta_boxes($hidden, $screen) {
	    if ( 'post' == $screen->base || 'page' == $screen->base ) {
	        foreach($hidden as $key=>$value) {
	            if ('postexcerpt' == $value) {
	                unset($hidden[$key]);
	                break;
	            }
	        }
	    }
	    return $hidden;
	}

	function init() {
		add_post_type_support('post', 'excerpt');
		add_post_type_support('page', 'excerpt');
		add_filter('default_hidden_meta_boxes', array($this, 'show_hidden_meta_boxes'), 10, 2);
	}

	function override_posts_per_page( $query ){
	    if( ! is_admin() && $query->is_main_query() ) {
	        $query->set( 'posts_per_page', 12 );
	    }
	}

	function publicActions() {
		add_action( 'pre_get_posts', array($this, 'override_posts_per_page') );
	}

	function publicFilters() {
		add_filter( 'excerpt_length', array($this, 'custom_excerpt_length') );
	}

	function custom_excerpt_length( $length ) {
		return 15;
	}

	function adminActions() {
	}

	function adminFilters() {

	}

	function adminAjax() {

	}
}