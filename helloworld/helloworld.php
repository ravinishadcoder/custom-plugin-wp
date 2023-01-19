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
require_once dirname(__FILE__).'./includes/news_meta_box.php';
require_once dirname(__FILE__).'./includes/shortcode.php';
require_once dirname(__FILE__).'./includes/custom_post_type.php';
?>
<?php




// add metabox for news location

function hw_add_news_location_to_content($content){
    if(is_singular('news')){
        $content= '<p class="news-location">'. esc_html(get_post_meta(get_the_ID(),'_news_location',true)) .'</p>'.$content;
    }
    return $content;
}
add_filter('the_content','hw_add_news_location_to_content');

function hw_add_posts_to_end_of_content($content){
    if(is_singular("news")){
        $args = array(
            'numberposts'=>3,
            'post_type'=>'news',
            'post__not_in'=>array(get_the_ID()),
            'meta_key'=>'_news_location',
            'meta_value'=> esc_html(get_post_meta(get_the_ID(),'_news_location',true)),
        );
       $wp_query= new WP_Query;
       $latest_posts= $wp_query->query($args);
       if(count($latest_posts)){
       ob_start();
       ?>
       <h3>Related news</h3>
       <ul class="latest-posts">
        <?php foreach ($latest_posts as $post): ?>
            <?php setup_postdata($post);?>
            <li><a href="<?php echo get_the_permalink($post->ID);?>"><?php echo get_the_title($post->ID); ?></a></li>
            <?php endforeach; ?>
       </ul>
       <?php
       $content .= ob_get_clean();
        }
    }
    return $content;
}
add_filter('the_content','hw_add_posts_to_end_of_content');
?>