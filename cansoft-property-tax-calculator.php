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
*/


//checking the identification of access this plugin
if( ! define('ABSPATH') ){
    die();
}
defined('ABSPATH') or die('Hey you can\'t access file. you silly human!');

if( ! function_exists('add_action') ){
    echo 'Hey you can\'t access file. you silly human!';
    exit();
}