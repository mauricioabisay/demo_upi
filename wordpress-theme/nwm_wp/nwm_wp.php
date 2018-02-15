<?php
namespace NWM\WP;
/**
* Class that represents a script generic (js or css file) in Wordpress
* @package NWM
* @subpackage WP
*/
class Script {
	public $path;
	public $dependencies;
	public $version;
	/**
	* Constructor for Script class
	* @param string $path - path to the resource
	* @param array $dependencies - list of the dependecies for the resource, default to empty
	* @param float $version - resource version number, default to 1.1
	*/
	function __construct($path, $dependencies = array(), $version = 1.1) {
		$this->path = $path;
		$this->dependencies = $dependencies;
		$this->version = $version;
	}
}

/**
* Class that represents a js file
* @package NWM
* @subpackage WP
*/
class JS extends Script {
	public $footer;
	/**
	* Constructor for Script class
	* @param string $path - path to the resource
	* @param array $dependencies - list of the dependecies for the resource, default to empty
	* @param float $version - resource version number, default to 1.1
	* @param boolean $footer - where the resource should be loaded at the end of the document (footer) or in the header, default to true
	*/
	function __construct($path, $dependencies = array(), $version = 1.1, $footer = true) {
		parent::__construct($path, $dependencies, $version);
		$this->footer = $footer;
	}
}

/**
* Class that represents a css file
* @package NWM
* @subpackage WP
*/
class CSS extends Script {
	public $media;
	/**
	* Constructor for Script class
	* @param string $path - path to the resource
	* @param array $dependencies - list of the dependecies for the resource, default to empty
	* @param float $version - resource version number, default to 1.1
	* @param string $media - defines for what kind of media the resource applies, default to screen (options can be print, screen, speech or all )
	*/
	function __construct($path, $dependencies = array(), $version = 1.1, $media = 'screen') {
		parent::__construct($path, $dependencies, $version);
		$this->media = $media;
	}
}

/**
* NWM theme wordpress class
* @package NWM
* @subpackage WP
*/
abstract class Theme {
	public $scripts = array();
	public $styles = array();
	public $scripts_admin = array();
	public $styles_admin = array();
	public $public_ajax = array();
	public $admin_ajax = array();
	public $theme_menu = array();
	/**
	* NWM Theme Constructor
	* - Cleans up wordpress by disabling default settings
	* - Removes wordpress native Jquery, so you may use the most recent version
	* - Hooks up CSS and JS dependencies
	* - Sets thumbnail support ON by default
	* - Sets up filters and actions depending on user access (admin or public)
	*/
	function __construct() {
		add_action('after_setup_theme', array($this, 'cleanUp'));
		add_filter('wp_default_scripts', array($this, 'removeDefaultScripts'));
		add_action('init', array($this, 'hookScripts'));
		add_action( 'dbx_post_sidebar', array($this, 'fixedPostSaveButton'), 10, 1 );
		add_theme_support('post-thumbnails');

		add_action('admin_menu', array($this, 'themeMenu'));

		if(is_admin()) {
			$this->adminFilters();
			$this->adminActions();
		} else {
			$this->publicFilters();
			$this->publicActions();
		}
	}
	/**
	* Use this function to save PUBLIC CSS and JS files via the add_css and add_js
	*/
	abstract function setScripts();
	/**
	* Use this function to add_actions to PUBLIC
	*/
	abstract function publicActions();
	/**
	* Use this function to add_filters to PUBLIC
	*/
	abstract function publicFilters();
	/**
	* Use this function to save ADMIN CSS and JS files via the add_css and add_js methods
	*/
	abstract function setAdminScripts();
	/**
	* Use function to add_actions that are use in the ADMIN dashboard, such as:
	* - Notifications
	* - Notices (messages for admin user)
	*/
	abstract function adminActions();
	/**
	* Use function to add_filters that are use in the ADMIN dashboard
	*/
	abstract function adminFilters();

	/**
	* Loads scripts defined by override to setScripts and setAdminScripts methods and adds them to the theme in the interface they belong (PUBLIC or ADMIN).
	*/
	function hookScripts() {
		$this->setScripts();
		foreach ($this->styles as $label => $css) {
			wp_enqueue_style($label, $css->path, $css->dependencies, $css->version, $css->media);
		}
		foreach($this->scripts as $label => $script) {
			wp_enqueue_script($label, $script->path, $script->dependencies, $script->version, $script->footer);
		}
		$this->setAdminScripts();
		add_action( 'admin_enqueue_scripts', array($this, 'hookAdminScripts') );
	}

	/**
	* Stores the reference to a CSS resource for future hook up to the PUBLIC interface.
	* @param string $label - web friendly name for the CSS resource (no commas, no spaces, no acutes, no special chars)
	* @param NWM\CSS $css - valid NWM\CSS instance
	*/
	function add_css($label, $css) {
		$this->styles[$label] = $css;
	}

	/**
	* Stores the reference to a JS resource for future hook up to the PUBLIC interface.
	* @param string $label - web friendly name for the JS resource (no commas, no spaces, no acutes, no special chars)
	* @param NWM\JS $js - valid NWM\JS instance
	*/
	function add_js($label, $js) {
		$this->scripts[$label] = $js;
	}

	/**
	* Stores the reference to a CSS resource for future hook up to the ADMIN interface.
	* @param string $label - web friendly name for the CSS resource (no commas, no spaces, no acutes, no special chars)
	* @param NWM\CSS $css - valid NWM\CSS instance
	*/
	function add_admin_css($label, $css) {
		$this->styles_admin[$label] = $css;
	}

	/**
	* Stores the reference to a JS resource for future hook up to the ADMIN interface.
	* @param string $label - web friendly name for the JS resource (no commas, no spaces, no acutes, no special chars)
	* @param NWM\JS $js - valid NWM\JS instance
	*/
	function add_admin_js($label, $js) {
		$this->scripts_admin[$label] = $js;
	}

	/**
	* Loads the resources to the ADMIN interface, this function is called internally by the action admin_enqueue_scripts, to specifically load the resources to the ADMIN interface.
	*/
	function hookAdminScripts() {
		foreach ($this->styles_admin as $label => $css) {
			wp_enqueue_style($label, $css->path, $css->dependencies, $css->version, $css->media);
		}
		foreach($this->scripts_admin as $label => $script) {
			wp_enqueue_script($label, $script->path, $script->dependencies, $script->version, $script->footer);
		}
	}

	/**
	* Add a function so may be accessed via AJAX from anywhere
	* @param Object $obj - instance where the function is defined
	* @param string $function_name - function's name
	*/
	function add_public_ajax($obj, $function_name) {
		add_action( 'wp_ajax_'.$function_name, array($obj, $function_name) );
		add_action( 'wp_ajax_nopriv_'.$function_name, array($obj, $function_name) );
	}

	/**
	* Add a function so it may be accessed via AJAX only from the ADMIN interface
	* @param Object $obj - instance where the function is defined
	* @param string $function_name - function's name
	*/
	function add_admin_ajax($obj, $function_name) {
		add_action( 'wp_ajax_'.$function_name, array($obj, $function_name) );
	}

	/**
	* Cleans up Wordpress, by removing commonly unused actions and filters
	*/
	function cleanUp() {
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_shortlink_wp_head');
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

		add_filter('the_generator', '__return_false');
		add_filter('show_admin_bar','__return_false');

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}

	/**
	* Removes jQuery included in Wordpress by default
	*/
	function removeDefaultScripts(&$scripts) {
		if(!is_admin()) {
			$scripts->remove( 'jquery');
		}
	}

	/**
	* Adds a second fixed submit button to all posts edit form
	*/
	function fixedPostSaveButton( $post ) {
	    echo '<button id="nwm-submit" class="button button-primary button-large">Update</button>';
	    return;
	}

	function themeMenu() {
		add_menu_page(
			'Ajustes Sitio',
			'Ajustes Sitio',
			'manage_options',//For more info check https://codex.wordpress.org/Roles_and_Capabilities
			sanitize_key('nwm-ajustes'),
			array($this, 'themeMenuTemplate'),
			'dashicons-admin-generic',//Icon check https://developer.wordpress.org/resource/dashicons/#googleplus
			null//Position in the menu order
		);
		/*add_submenu_page(
			'nwm-ajustes',
			'Sub Sitio',//Title added to head
			'Sub Sitio',//Title added to menu
			'manage_options',
			sanitize_key('nwm-ajustes-sub'),
			array($this, 'themeMenuTemplate')
		);*/
	}

	function themeMenuTemplate() {
		if (!current_user_can('manage_options')) {
		    wp_die('You do not have sufficient permissions to access this page.');
		}
		if ( (isset($_POST)) && (sizeof($_POST)>0) ) {
			foreach ($_POST as $key => $option) {
				update_option( $key, $option, true );
			}
		}
		include 'templates/theme_menu.php';
	}

}

/**
* NWM SimplePost class, it serves the purpose of loading, registering and saving custom posts
* @package NWM
* @subpackage WP
*/
abstract class SimplePost {
	/**
	* @var string $key_name Web friendly identifier for the post type (no spaces, no acutes, no special chars)
	*/
	public $key_name;
	/**
	* @var array $labels List with the human friendly names for this post
	*/
	public $labels;
	/**
	* @var int $menu_position Position where the post menu will be rendered in the ADMIN interface, defaults to 5 (below Posts)
	* 5 - below Posts
	* 10 - below Media
	* 15 - below Links
	* 20 - below Pages
	* 25 - below comments
	* 60 - below first separator
	* 65 - below Plugins
	* 70 - below Users
	* 75 - below Tools
	* 80 - below Settings
	* 100 - below second separator
	*/
	public $menu_position = 5;
	/**
	* @var string $menu_icon URL or CSS reference (class name) to the icon to be used for the post's menu in ADMIN interface, defaults to null (default Wordpress post icon)
	* Wordpress offers a set of icons out of the box, check:
	* @link https://developer.wordpress.org/resource/dashicons/#visibility
	*/
	public $menu_icon = null;
	/**
	* @var boolean $is_public Post type visibility and search for ADMIN and PUBLIC interfaces, defaults to true
	*/
	public $is_public = true;
	/**
	* @var boolean $has_archive Enables/Disables archive templates for the post type, defaults to true
	*/
	public $has_archive = true;
	/**
	* @var $show_in_rest Enables/Disables rest api availability, defaults to false
	*/
	public $show_in_rest = false;

	/**
	 * @var $taxonomy If the post requires a custom taxonomy, else category will be used
	*/
	public $taxonomy = false;

	public $taxonomies = array();

	/**
	* @var array $supports List with the options available to this post type
	* Options are:
	* - 'title'
	* - 'editor' (content)
	* - 'author'
	* - 'thumbnail' (featured image, current theme must also support post-thumbnails)
	* - 'excerpt'
	* - 'trackbacks'
	* - 'custom-fields'
	* - 'comments' (also will see comment count balloon on edit screen)
	* - 'revisions' (will store revisions)
	* - 'page-attributes' (menu order, hierarchical must be true to show Parent option)
	* - 'post-formats' add post formats, see Post Formats
	*/
	public $supports = array(
		'title',
		'editor',
		//'author',
		'thumbnail',
		'excerpt',
		//'trackbacks',
		//'custom-fields',
		//'comments',
		//'revisions',
		//'page-attributes',
		//'post-formats'
	);

	/**
	* @var array $fields Stores custom extra fields for the post type, defaults to empty array
	* Fields are added using the add_field function.
	*/
	public $fields = array();

	/**
	* Constructor for the SimplePost class
	* @param string $key_name Web friendly identifier for the post type (no spaces, no acutes, no special chars)
	* @param string $singular Human friendly post singular name
	* @param string $plural Human frinedly post plural name
	*/
	function __construct($key_name, $singular, $plural) {
		$this->key_name = $key_name;
		$this->labels = array(
			'name' => $plural,
			'singular_name' => $singular,
		);
		add_action( 'init', array($this, 'init') );
		add_action( 'save_post', array($this, 'save'), 1, 2 );
	}
	 /**
	 * Regiters the post type to Wordpress.
	 */
	function init() {
		if ($this->taxonomy) {

		} else {
			register_post_type(
				$this->key_name,
				array(
					'labels' => $this->labels,
					'public' => $this->is_public,
					'has_archive' => $this->has_archive,
					'menu_position' => $this->menu_position,
					'menu_icon' => $this->menu_icon,
					'show_in_rest' => $this->show_in_rest,
					'supports' => $this->supports,
					'register_meta_box_cb' => array($this, 'meta_box'),
					'taxonomies' => array('category')
				)

			);
		}
	}

	/**
	* Adds a custom field to the post.
	* @param string $key Web friendly identifier for the field (no spaces, no acutes, no special chars)
	* @param string $name Human friendly name for the field
	* @param string $type Field data type
	* Type may be:
	* - text
	* - description
	* - single-choice
	* - multi-choice
	* - dropdown
	* @param string $instructions Instructions for the field, defaults to empty string
	* @param array $options Special for single-choice, multi-choice and dropdown data types, it defines the different options available for user selection, default to empty array, it specs a string array
	*/
	function add_field($key, $name, $type, $instructions = '', $options = array()) {
		$this->fields[] = (object) array(
			'id' => $key,
			'name' => $name,
			'type' => $type,
			'instructions' => $instructions,
			'options' => $options
		);
	}
	 /**
	* Stores the custom fields data and links it to the post
	 */
	function save($post_id, $post) {
		if ( $post->post_type != $this->key_name )
		    return;
	    //Add values to custom fields
	    foreach ($this->fields as $field) {
	    	switch ($field->type) {
	    		case 'multi-choice': {
	    			$search = array(
	    				' ',
	    				'á', 'é', 'í', 'ó', 'ú',
	    				'ä', 'ë', 'ï', 'ö', 'ü',
	    				'ñ'
	    			);
	    			$replace = array(
	    				'_',
	    				'a', 'e', 'i', 'o', 'u',
	    				'a', 'e', 'i', 'o', 'u',
	    				'n'
	    			);
	    			if( is_array($field->options) && !array_key_exists('query_args', $field->options) ) {
						foreach ($field->options as $opt) {
							$opt_key = strtolower($opt);
	    					$opt_key = str_replace($search, $replace, $opt_key);
	    					if ( isset($_POST[$field->id.'_'.$opt_key]) ) {
	    						if ( get_post_meta( $post->ID, $field->id.'_'.$opt_key, FALSE ) ) {
	    						    update_post_meta( $post->ID, $field->id.'_'.$opt_key, $_POST[$field->id.'_'.$opt_key] );
	    						} else {
	    						    add_post_meta( $post->ID, $field->id.'_'.$opt_key, $_POST[$field->id.'_'.$opt_key] );
	    						}
	    						if ( !$_POST[$field->id.'_'.$opt_key] ) {
	    						    delete_post_meta($post->ID, $field->id.'_'.$opt_key);
	    						}
	    					} else {
	    						delete_post_meta($post->ID, $field->id.'_'.$opt_key);
	    					}
						}
					} else {
						$query_posts = array();
						if( is_array($field->options) && array_key_exists('query_args', $field->options) ) {
							$query_posts = get_posts($field->options['query_args']);
						} else {
							$query_posts = get_posts(array('post_type' => $field->options));
						}
						wp_reset_query();
						if( sizeof($query_posts) > 0 ) {
							foreach ($query_posts as $opt) {
								$opt_key = strtolower($opt->post_title);
	    						$opt_key = str_replace($search, $replace, $opt_key);
		    					if ( isset($_POST[$field->id.'_'.$opt_key]) ) {
		    						if ( get_post_meta( $post->ID, $field->id.'_'.$opt_key, FALSE ) ) {
		    						    update_post_meta( $post->ID, $field->id.'_'.$opt_key, $_POST[$field->id.'_'.$opt_key] );
		    						} else {
		    						    add_post_meta( $post->ID, $field->id.'_'.$opt_key, $_POST[$field->id.'_'.$opt_key] );
		    						}
		    						if ( !$_POST[$field->id.'_'.$opt_key] ) {
		    						    delete_post_meta($post->ID, $field->id.'_'.$opt_key);
		    						}
		    					} else {
		    						delete_post_meta($post->ID, $field->id.'_'.$opt_key);
		    					}
							}
						}
					}
	    			break;
	    		}
	    		case 'map': {
	    			if ( isset($_POST[$field->id.'-lat']) && isset($_POST[$field->id.'-lng']) ) {
	    				if ( get_post_meta( $post->ID, $field->id.'-lat', FALSE ) ) {
	    				    update_post_meta( $post->ID, $field->id.'-lat', $_POST[$field->id.'-lat'] );
	    				} else {
	    				    add_post_meta( $post->ID, $field->id.'-lat', $_POST[$field->id.'-lat'] );
	    				}
	    				if ( get_post_meta( $post->ID, $field->id.'-lng', FALSE ) ) {
	    				    update_post_meta( $post->ID, $field->id.'-lng', $_POST[$field->id.'-lng'] );
	    				} else {
	    				    add_post_meta( $post->ID, $field->id.'-lng', $_POST[$field->id.'-lng'] );
	    				}
	    			}
	    			break;
	    		}
	    		default: {
	    			if ( isset($_POST[$field->id]) ) {
	    				if ( get_post_meta( $post->ID, $field->id, FALSE ) ) {
	    				    update_post_meta( $post->ID, $field->id, $_POST[$field->id] );
	    				} else {
	    				    add_post_meta( $post->ID, $field->id, $_POST[$field->id] );
	    				}
	    				if ( !$_POST[$field->id] ) {
	    				    delete_post_meta($post->ID, $field->id);
	    				}
	    			}
	    			break;
	    		}
	    	}
	    }
	}

	/**
	* Loads the form UI for each custom field registered
	*/
	function meta_box() {
		foreach ($this->fields as $field) {
			add_meta_box(
				//html id
				$field->id,
				//title
				$field->name,
				//template function
				array( $this, 'meta_box_gen' ),
				//post type
				$this->key_name,
				//context (side|normal|advanced)
				'normal',
				//priority (high|default|low)
				'default',
				array( 'field' => $field )
			);
		}
	}

	/**
	* Auto generates the custom field form UI
	*/
	function meta_box_gen($post, $callback_args) {
		$field = $callback_args['args']['field'];
		if( isset($field->options) && sizeof($field->options) > 0 ) {
			$search = array(
				' ',
				'á', 'é', 'í', 'ó', 'ú',
				'ä', 'ë', 'ï', 'ö', 'ü',
				'ñ'
			);
			$replace = array(
				'_',
				'a', 'e', 'i', 'o', 'u',
				'a', 'e', 'i', 'o', 'u',
				'n'
			);
		}

		switch ($field->type) {
			case 'text':{
				include 'templates/input_type_text.php';
				break;
			}
			case 'description': {
				include 'templates/textarea.php';
				break;
			}
			case 'single-choice': {
				//This creates radios
				$current_value = get_post_meta($post->ID, $field->id, true);
				$options = array();
				if( is_array($field->options) && !array_key_exists('query_args', $field->options) ) {
					foreach ($field->options as $opt) {
						$opt_key = strtolower($opt);
    					$opt_key = str_replace($search, $replace, $opt_key);
    					$options[] = (object) array(
    						'id' => $field->id.'_'.$opt_key,
    						'name' => $field->id,
    						'value' => $opt,
    						'current' => stristr($current_value, $opt) ? true : false,
    						'text' => $opt
    					);
					}
				} else {
					$query_posts = array();
					if( is_array($field->options) && array_key_exists('query_args', $field->options) ) {
						$query_posts = get_posts($field->options['query_args']);
					} else {
						$query_posts = get_posts(array('post_type' => $field->options));
					}
					wp_reset_query();
					if( sizeof($query_posts) > 0 ) {
						foreach ($query_posts as $opt) {
	    					$options[] = (object) array(
	    						'id' => $field->id.'_'.$opt->ID,
	    						'name' => $field->id,
	    						'value' => $opt->ID,
	    						'current' => ($current_value == $opt->ID) ? true : false,
	    						'text' => $opt->post_title
	    					);
						}
					}
				}
				include 'templates/input_type_radio.php';
				break;
			}
			case 'dropdown': {
				$current_value = get_post_meta($post->ID, $field->id, true);
				$options = array();
				if( is_array($field->options) && !array_key_exists('query_args', $field->options) ) {
					foreach ($field->options as $opt) {
						$opt_key = strtolower($opt);
    					$opt_key = str_replace($search, $replace, $opt_key);
    					$options[] = (object) array(
    						'id' => $field->id.'_'.$opt_key,
    						//'name' => $field->id,
    						'value' => $opt,
    						'current' => stristr($current_value, $opt) ? true : false,
    						'text' => $opt
    					);
					}
				} else {
					$query_posts = array();
					if( is_array($field->options) && array_key_exists('query_args', $field->options) ) {
						$query_posts = get_posts($field->options['query_args']);
					} else {
						$query_posts = get_posts(array('post_type' => $field->options));
					}
					wp_reset_query();
					if( sizeof($query_posts) > 0 ) {
						foreach ($query_posts as $opt) {
	    					$options[] = (object) array(
	    						'id' => $field->id.'_'.$opt->ID,
	    						//'name' => $field->id,
	    						'value' => $opt->ID,
	    						'current' => ($current_value == $opt->ID) ? true : false,
	    						'text' => $opt->post_title
	    					);
						}
					}
				}
				include 'templates/select.php';
				break;
			}
			case 'multi-choice': {
				$options = array();
				if( is_array($field->options) && !array_key_exists('query_args', $field->options) ) {
					foreach ($field->options as $opt) {
						$opt_key = strtolower($opt);
    					$opt_key = str_replace($search, $replace, $opt_key);
    					$options[] = (object) array(
    						'id' => $field->id.'_'.$opt_key,
    						'name' => $field->id.'_'.$opt_key,
    						'value' => 1,
    						'current' => (get_post_meta($post->ID, $field->id.'_'.$opt_key, true) > 0) ? true : false,
    						'text' => $opt
    					);
					}
				} else {
					$query_posts = array();
					if( is_array($field->options) && array_key_exists('query_args', $field->options) ) {
						$query_posts = get_posts($field->options['query_args']);
					} else {
						$query_posts = get_posts(array('post_type' => $field->options));
					}
					wp_reset_query();
					if( sizeof($query_posts) > 0 ) {
						foreach ($query_posts as $opt) {
							$opt_key = strtolower($opt->post_title);
    						$opt_key = str_replace($search, $replace, $opt_key);
	    					$options[] = (object) array(
	    						'id' => $field->id.'_'.$opt_key,
	    						'name' => $field->id.'_'.$opt_key,
	    						'value' => $opt->ID,
	    						'current' => (get_post_meta($post->ID, $field->id.'_'.$opt_key, true) > 0) ? true : false,
	    						'text' => $opt->post_title
	    					);
						}
					}
				}
				include 'templates/input_type_checkbox.php';
				break;
			}

			case 'map': {
				include 'templates/map_marker.php';
			}
		}
	}
}