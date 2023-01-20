<?php
if(! defined('ABSPATH')){
    die("Do not do this !");
}
//add custom type
function hw_add_news_post_type(){
    $args=array(
        'public'=>true,
        'label'=>"News",
        'has_archive'=>true,
        'supports'=>array('title','editor','excerpt','thumbnail')
    );
    register_post_type('news',$args);
    
    register_taxonomy('news_category','news',array(
        'hierarchical'=>true,
        'label'=>'News Categories'
    ));
}
add_action('init','hw_add_news_post_type');
function hw_activate(){
    hw_add_news_post_type();
    flush_rewrite_rules();
}
register_activation_hook(HW_PLUGIN_FILE,'hw_activate');

?>