<?php
if(! defined('ABSPATH')){
    die("Do not do this !");
}
function hw_add_news_meta_box(){
    add_meta_box('news_meta_box','News Location','hw_render_news_location_meta_box','news','normal','low');
}

add_action('add_meta_boxes_news','hw_add_news_meta_box');

function hw_render_news_location_meta_box($post){
?>
<div class="inside">
    <p>
        <label class="screen-render-test" for="news_loaction">Location</label>
        <input id="news_location" type="text" name="news_location" value="<?php echo esc_attr(get_post_meta($post->ID,'_news_location',true)) ?>">
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
}
add_action('save_post_news','hw_save_news_meta_data');

?>