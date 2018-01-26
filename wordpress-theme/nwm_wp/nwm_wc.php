<?php
namespace NWM\WC;

/**
*
*/
abstract class WC {
    public $extra_fields = array();
    private $SEARCH = array(
        ' ',
        'á', 'é', 'í', 'ó', 'ú',
        'ä', 'ë', 'ï', 'ö', 'ü',
        'ñ'
    );
    private $REPLACE = array(
        '_',
        'a', 'e', 'i', 'o', 'u',
        'a', 'e', 'i', 'o', 'u',
        'n'
    );

    function __construct() {
        $this->register_extra_fields();
        add_action( 'woocommerce_product_options_general_product_data', array($this, 'load_extra_fields') );
        add_action( 'woocommerce_process_product_meta', array($this, 'save_extra_fields') );
        add_action( 'admin_head', array($this, 'nwm_wc_dashboard_style'));
    }

    abstract function register_extra_fields();

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
    * @param string $hint Message that displays when you go hover the question icon, next to the field's name. It defaults to show the description
    */
    function add_field($key, $name, $type, $description = '', $options = array(), $hint = '') {
        $this->extra_fields[] = (object) array(
            'id' => $key,
            'label' => $name,
            'type' => $type,
            'description' => $description,
            'options' => $options,
            'hint' => $hint
        );
    }

    function load_extra_fields() {
        foreach ($this->extra_fields as $field) {
            $wc_field = array(
                'id' => $field->id,
                'label' => $field->label,
                'description' => $field->description,
                'desc_tip' => (!empty($field->hint)) ? $field->hint : true
            );
            switch ($field->type) {
                case 'text': {
                    $wc_field['placeholder'] = $field->label;
                    woocommerce_wp_text_input($wc_field);
                    break;
                }
                case 'description': {
                    woocommerce_wp_textarea_input($wc_field);
                    break;
                }
                case 'single-choice': {
                    $wc_field['wrapper_class'] = 'nwm-wc-single-choice';
                    if( !array_key_exists('query_args', $field->options) ) {
                        $wc_field['options'] = $field->options;
                    } else {
                        $options = get_posts($field->options['query_args']);
                        $temp_options = array();
                        foreach ($options as $opt) {
                            $temp_options[$opt->ID] = $opt->post_title;
                        }
                        wp_reset_postdata();
                        $wc_field['options'] = $temp_options;
                    }
                    woocommerce_wp_radio($wc_field);
                    break;
                }
                case 'multi-choice': {
                    if( !array_key_exists('query_args', $field->options) ) {
                        foreach ($field->options as $opt) {
                            $opt_key = strtolower($opt);
                            $opt_key = str_replace($this->SEARCH, $this->REPLACE, $opt_key);
                            $wc_option_field = array(
                                'id' => $field->id.'-'.$opt_key,
                                'label' => $opt,
                                'description' => $field->description,
                                'desc_tip' => (!empty($field->hint)) ? $field->hint : true
                            );
                            woocommerce_wp_checkbox($wc_option_field);
                        }
                    } else {
                        $options = get_posts($field->options['query_args']);
                        foreach ($options as $opt) {
                            $opt_key = strtolower($opt->post_title);
                            $opt_key = str_replace($this->SEARCH, $this->REPLACE, $opt_key);
                            $wc_option_field = array(
                                'id' => $field->id.'-'.$opt_key,
                                'label' => $opt->post_title,
                                'description' => $field->description,
                                'desc_tip' => (!empty($field->hint)) ? $field->hint : true
                            );
                            woocommerce_wp_checkbox($wc_option_field);
                        }
                        wp_reset_postdata();
                    }
                    break;
                }
                case 'dropdown': {
                    if( !array_key_exists('query_args', $field->options) ) {
                        $wc_field['options'] = $field->options;
                    } else {
                        $options = get_posts($field->options['query_args']);
                        $temp_options = array();
                        foreach ($options as $opt) {
                            $temp_options[$opt->ID] = $opt->post_title;
                        }
                        $wc_field['options'] = $temp_options;
                        wp_reset_postdata();
                    }
                    woocommerce_wp_select($wc_field);
                    break;
                }
            }
        }
    }

    function save_extra_fields($post_id) {
        foreach ($this->extra_fields as $field) {
            if( !empty( $_POST[$field->id] ) ) {
                update_post_meta(
                    $post_id,
                    $field->id,
                    esc_attr( $_POST[$field->id] )
                );
            } elseif( $field->type == 'multi-choice' ) {
                if( !array_key_exists('query_args', $field->options) ) {
                    foreach ($field->options as $opt) {
                        $opt_key = strtolower($opt);
                        $opt_key = str_replace($this->SEARCH, $this->REPLACE, $opt_key);
                        delete_post_meta( $post_id, $field->id.'-'.$opt_key );
                        update_post_meta(
                            $post_id,
                            $field->id.'-'.$opt_key,
                            esc_attr( $_POST[$field->id.'-'.$opt_key] )
                        );
                    }
                } else {
                    $options = get_posts($field->options['query_args']);
                    foreach ($options as $opt) {
                        $opt_key = strtolower($opt->post_title);
                        $opt_key = str_replace($this->SEARCH, $this->REPLACE, $opt_key);
                        delete_post_meta( $post_id, $field->id.'-'.$opt_key );
                        update_post_meta(
                            $post_id,
                            $field->id.'-'.$opt_key,
                            esc_attr( $_POST[$field->id.'-'.$opt_key] )
                        );
                    }
                    wp_reset_postdata();
                }
            } elseif( isset($field->default) ) {
                update_post_meta(
                    $post_id,
                    $field->id,
                    esc_attr( $field->default )
                );
            }
        }
    }

    function nwm_wc_dashboard_style() {
      echo '<style>
      .nwm-wc-single-choice legend {
        display: block;
        margin-bottom: 1em;
      }
      .nwm-wc-single-choice .wc-radios {
        display: block;
        clear: both;
        width: 100%;
      }
      .nwm-wc-single-choice .wc-radios li label {
        width: 100%;
        clear: both;
      }
      .nwm-wc-single-choice .wc-radios li label input {
        width: 25px !important;
        height: 25px !important;
        margin: 5px;
      }
      #general_product_data {
        display: block !important;
      }
      input[type=radio]:checked:before {
        width: 12px;
        height: 12px;
        margin: 6px;
      }
      </style>';
    }
}