<?php
if(! defined('ABSPATH')){
    die("Do not do this !");
}
function hw_add_news_meta_box(){
    add_meta_box('news_meta_box','News Location','hw_render_news_location_meta_box','news','normal','low');
}

add_action('add_meta_boxes_news','hw_add_news_meta_box');

function hw_render_news_location_meta_box($post){
    wp_nonce_field('news_meta_box_saving','news_meta_box_nonce');
    $location = hw_get_news_location($post->ID);
?>
<div class="inside">
    <p>
        <label class="screen-render-test" for="news_loaction">Location</label>
        <input id="news_location" type="text" name="news_location" value="<?php echo esc_attr(get_post_meta($post->ID,'_news_location',true)) ?>">
    </p>
    <p>
        <label  for="news_loaction_lat">Latitude</label>
        <input id="news_location_lat" type="text" name="news_location_lat" value="<?php echo esc_attr($location->lat) ?>">
    </p>
    <p>
        <label  for="news_loaction_lon">Lontitude</label>
        <input id="news_location_lon" type="text" name="news_location_lon" value="<?php echo esc_attr($location->lon) ?>">
    </p>
</div>
<?php
}

function hw_save_news_meta_data($post_id){
    if(defined("DOING_AUTOSAVE")&& DOING_AUTOSAVE)
    return;
    if(isset($_POST['news_location'])){
     update_post_meta($post_id,'_news_location',sanitize_text_field($_POST['news_location']));
    }
    if(isset($_POST['news_number'])&& is_email($_POST['news_number'])){
     update_post_meta($post_id,'_news_number',intval($_POST['news_number']));
    }
    if(isset($_POST['news_location_lat']) && isset($_POST['news_location_lon'])){
        hw_save_news_location($post_id,floatval($_POST['news_location_lat']),floatval($_POST['news_location_lon']));
    }
}
add_action('save_post_news','hw_save_news_meta_data');

?>