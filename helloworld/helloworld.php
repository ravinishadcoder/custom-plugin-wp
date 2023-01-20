<?php
/*
Plugin Name: Hello World
Description: My first WordPress Plugin.
Version: 1.0.2
Author: Ravi
Author URI: https://ravin.com/wordpress-plugins/
License: GPLv2 or later
*/
if(! defined('ABSPATH')){
    die("Do not do this !");
}
define("HW_PLUGIN_FILE",__FILE__);
require_once dirname(__FILE__).'./includes/wp_requirements.php';
$plugin_checks = new HW_Requirements("Hello World",HW_PLUGIN_FILE,array(
    'PHP'=>'5.3.3',
    'WordPress'=>'4.1',
));
if(false==$plugin_checks->pass()){
    $plugin_checks->halt();
    return;
}
require_once dirname(__FILE__).'./includes/news_meta_box.php';
require_once dirname(__FILE__).'./includes/shortcode.php';
require_once dirname(__FILE__).'./includes/custom_post_type.php';
require_once dirname(__FILE__).'./includes/admin_settings.php';
require_once dirname(__FILE__).'./includes/news_content.php';
require_once dirname(__FILE__).'./includes/add_content.php';
require_once dirname(__FILE__).'./includes/news_location.php';
require_once dirname(__FILE__).'./includes/test_api_calls.php';
require_once dirname(__FILE__).'./includes/welcome_screen.php';
?>
<?php


?>