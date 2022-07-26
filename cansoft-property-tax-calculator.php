<?php

/*
    @package cansoft-property-tax-calculator
*/

/*
    Plugin Name: Cansoft  Calculators
    Plugin Url: https://github.com/programmerashraful/cansoft-property-tax-calculator
    Description:  This  is a custom plugin for property tax calculator for canada. this calculater will show by adding a shortcode like ([property_calculator]) or ([property_calculator p_value=50000 value_title='Test' rate_title='test'])
    Author Name:  Ashraful Islam
    Author URI: https://github.com/programmerashraful
    License: Update Letter
    Text Domain: cansoft-property
    Version: 1.0
*/


//Checking the identification of access this plugin

defined('ABSPATH') or die('Hey you can\'t access file. you silly human!');

if( ! function_exists('add_action') ){
    echo 'Hey you can\'t access file. you silly human!';
    exit();
}


class CansoftPropertyTaxCalculator{
    
    // Constructor
    
    function  __construct(){
        add_action('init', array($this, 'registerAreaPostType'));
        add_action('init', array($this, 'registerAreaProvince'), 10);
        
    }
    
    function activate(){
        // Generated a CPT
        $this->registerAreaPostType();
        $this->registerAreaProvince();
        // Flash rewrite rolls
        flush_rewrite_rules();
    }
    
    function register(){
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
    }
    
    function deactivate(){
        // Flash rewrite rolls
    }
    
    
    function registerAreaPostType(){
        // Making a custom post type for provice and city
        register_post_type( 'cansoft_city',
        array(
          'labels' => array(
            'name' => __( 'Cities' ),
            'singular_name' => __( 'City' ),
            'add_new_item' => __( 'Add City' ),
            'add_new' => __( 'Add City' ),
            'edit_item' => __( 'Edit City' ),
          ),
          'public' 		=> true,
          'has_archive' => true,
          'menu_icon' => 'dashicons-location-alt',
          'supports'    => array( 'title'),
          'rewrite' 	=> array('slug' => 'cansoft_city')
        )
      );
    }
    
    
    function registerAreaProvince(){
        // Making a custom taxonomy for province
        
        
        $labels = array(
            'name'              => _x( 'Province', 'Province', 'cansoft-property' ),
            'singular_name'     => _x( 'Province', 'Province', 'cansoft-property' ),
            'search_items'      => __( 'Search Province', 'cansoft-property' ),
            'all_items'         => __( 'All Province', 'cansoft-property' ),
            'parent_item'       => __( 'Parent Province', 'cansoft-property' ),
            'parent_item_colon' => __( 'Parent Province:', 'cansoft-property' ),
            'edit_item'         => __( 'Edit Province', 'cansoft-property' ),
            'update_item'       => __( 'Update Province', 'cansoft-property' ),
            'add_new_item'      => __( 'Add New Province', 'cansoft-property' ),
            'new_item_name'     => __( 'New Province Name', 'cansoft-property' ),
            'menu_name'         => __( 'Canada Province', 'cansoft-property' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'cansoft_province' ),
        );

        register_taxonomy( 'cansoft_province', array( 'cansoft_city' ), $args );
        
    }
    
    function load_terms( $taxonomy ){
        global $wpdb;
        $query = "SELECT DISTINCT 
                   t.name, t.term_id
                  FROM
                   {$wpdb->terms} t 
                  INNER JOIN 
                   {$wpdb->term_taxonomy} tax 
                  ON 
                   tax.term_id = t.term_id
                  WHERE 
                   ( tax.taxonomy = '{$taxonomy}')";                     
        $result = $wpdb->get_results( $query , ARRAY_A );

        return $result;                 
    }
    
    
    
    function getCitiesByProvince($province){
        $args = array(
        'post_type'        => 'cansoft_city',
        'orderby'         => 'menu_order',
        'order'           => 'ASC',
        'post_status'     => 'publish',
        'posts_per_page'  => -1,
        'tax_query' => array(
            array (
                'taxonomy' => 'cansoft_province',
                'field' => 'term_id',
                'terms' => $province,
            )
        ),
        'suppress_filters' => true );

        
        return $newspress_query = get_posts($args);
    }
    
    
    
    function jsonObjectOfCities(){
        $provinces = $this->load_terms('cansoft_province');
        $provinces_cities = array();
        $new_obj=array();
        $new_city = array();
        if($provinces){
            foreach($provinces as $province){
                
                $provinces_cities['province_id_'.$province['term_id']]['cities'] = [];
                $cities = $this->getCitiesByProvince($province['term_id']);
                
                if($cities){
                    foreach($cities as $city){
                        $new_cit = [];
                        $new_cit=[
                            'province_id'=>$province['term_id'],
                            'city_id'=>$city->ID,
                            'city_name'=>$city->post_title,
                            'tax_rate'=>get_post_meta($city->ID, 'tax_rate', true),
                            'tax_rate_primary'=>get_post_meta($city->ID, 'tax_rate_primary', true),
                            'primary_residence'=>get_post_meta($city->ID, 'primary_residence', true),
                        ];
                        
                        $provinces_cities['province_id_'.$province['term_id']]['cities']['city_id_'.$city->ID ] = $new_cit;
                    }
                }
            }
        }
        return $provinces_cities;
    }

    
    
    
    function enqueue(){
        //enqueue all our script
        wp_register_style('property-tax-css', plugins_url('/assets/style.css', __FILE__));
		wp_enqueue_style('property-tax-css');
        wp_enqueue_script('jquery');
        //wp_enqueue_script('property-tax-vue-js', plugins_url('/assets/vue.js', __FILE__), array(), '1.0', true);
        wp_enqueue_script('property-tax-script', plugins_url('/assets/script.js', __FILE__), array(), '1.0', true);
    }
    
    
    function uninstall(){
        // Delate CPT
        // Delete all the plugins data form database
    }
    
   
}

// if class exists
if(class_exists('CansoftPropertyTaxCalculator')){
    $taxCalculator = new CansoftPropertyTaxCalculator();
    $taxCalculator->register();
}


// Activation
register_activation_hook( __FILE__, array($taxCalculator, 'activate'));

// Deactivation
register_deactivation_hook( __FILE__, array($taxCalculator, 'deactivate'));




include( plugin_dir_path( __FILE__ ) . 'custom-meta-box.php');
include( plugin_dir_path( __FILE__ ) . 'short-code.php');
include( plugin_dir_path( __FILE__ ) . 'short-code-inflauation-calculator.php');
include( plugin_dir_path( __FILE__ ) . 'short-code-income-tax-calculator.php');

