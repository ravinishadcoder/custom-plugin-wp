<?php
class HW_Admin{
    function __construct(){
        add_action('admin_menu',array($this,'register_settings_menu_page'));
        add_action('admin_enqueue_scripts',array($this,'add_styles'));
    }
    function add_styles($hook){
        if("news_page_news-settings"!=$hook){
            return ;
        }
        wp_enqueue_style('news-settings-style',
        plugins_url('includes/css/settings.css',HW_PLUGIN_FILE),
        array(),
    );
    wp_enqueue_script(
        'news-settings-js',
        plugins_url('includes/js/settings.js',HW_PLUGIN_FILE),
        array("jquery"),
        true
    );
    }
    function register_settings_menu_page(){
        add_submenu_page('edit.php?post_type=news','News Settings','Settings','manage_options','news-settings',array($this,'render_settings_page'));
    }
    function render_settings_page(){
        if(isset($_POST['news_settings_nonce']))
        $this->save_settings();
        include dirname(__FILE__) . '/templates/admin_settings.php';
    }
    function save_settings(){
        if(!wp_verify_nonce($_POST['news_settings_nonce'],'news-settings-save')){
            wp_die("Security token invalied");
        }
        if(isset($_POST['news_related_title']))
        update_option('hw_news_related_title',sanitize_text_field($_POST['news_related_title']));
        update_option('hw_show_related',isset($_POST['show_related'])?true:false);
        if(isset($_POST['related_news_amount'])){
            update_option('hw_related_news_amount',intval($_POST['related_news_amount']));
        }
        $this->show_success_message();
    }
    function show_success_message(){
        ?>
        <div class="notice notice-success">
            Settings Saved
        </div>
        <?php
    }
}
$hw_admin=new HW_Admin();
?>