<?php

/*
    @package cansoft-property-tax-calculator
*/

/*
    Plugin Name: Cansoft Property  Tax Calculator
    Plugin Url: https://github.com/programmerashraful/cansoft-property-tax-calculator
    Description:  This  is a custom plugin for property tax calculator for canada.
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
        add_action('init', array($this, 'registerAreaProvince'));
    }
    
    function activate(){
        // Generated a CPT
        // Flash rewrite rolls
        flush_rewrite_rules();
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
            'singular_name' => __( 'City' )
          ),
          'public' 		=> true,
          'has_archive' => true,
          'menu_icon' => 'dashicons-location-alt',
          'supports'    => array( 'title',  ),
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
    
    function addCustomField(){
        
    }
    
    function uninstall(){
        // Delate CPT
        // Delete all the plugins data form database
    }
}

// if class exists
if(class_exists('CansoftPropertyTaxCalculator')){
    $taxCalculator = new CansoftPropertyTaxCalculator();
}


// Activation
register_activation_hook( __FILE__, array($taxCalculator, 'activate'));

// Deactivation
register_deactivation_hook( __FILE__, array($taxCalculator, 'deactivate'));