<?php
function hw_welcome_screen_page(){
    add_dashboard_page('Welcome','Welcome','read','hw-plugin-welcome','hw_display_welcome_page');
}
add_action('admin_menu','hw_welcome_screen_page');

function hw_display_welcome_page(){
    include dirname(__FILE__) . '/templates/welcome_page.php';
}

function hw_remove_welcome_page_menu_name_item(){
    remove_submenu_page('index.php','hw-plugin-welcome');
}
add_action('admin_head','hw_remove_welcome_page_menu_name_item');

function hw_welcome_page_redirect($plugin){
if('helloworld/helloworld.php'==$plugin){
    wp_safe_redirect(admin_url('index.php?page=hw-plugin-welcome'));
    die();
}
}
add_action('activated_plugin','hw_welcome_page_redirect')
?>