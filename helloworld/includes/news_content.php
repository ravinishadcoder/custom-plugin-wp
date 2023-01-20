<?php

function hw_add_news_location_to_content($content){
    if(is_singular('news')){
        $location = hw_get_news_location(get_the_ID());
        $content = '<p class="news-lat-lon">' . esc_html($location->lat) . ', ' . esc_html($location->lon) . ' </p>' .$content;
        $content = '<p class="news-location">'. esc_html(get_post_meta(get_the_ID(),'_news_location',true)) .'</p>'  .$content;
        
    }
    return $content;
}
add_filter('the_content','hw_add_news_location_to_content');

function hw_add_posts_to_end_of_content($content){
    if(is_singular("news") && get_option('hw_show_related',true)){
        $args = array(
            'numberposts'=>intval(get_option('hw_related_news_amount',3)),
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
       <h3><?php echo esc_html(get_option('hw_news_related_title','Related News')) ?></h3>
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