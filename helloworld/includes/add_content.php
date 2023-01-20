<?php
function hw_add_content_on_activation(){
    if(get_option('hw_page_id',false)){
        return ;
    }
   $post_id= wp_insert_post(array(
        'post_title'=> 'Hello world confirmation!',
        'post_status'=>'publish',
        'post_type'=>'page',
        'post_content'=>'[my-test-shortcode]',
    ));
    update_option('hw_page_id',$post_id);
}
register_activation_hook(HW_PLUGIN_FILE,'hw_add_content_on_activation');
?>