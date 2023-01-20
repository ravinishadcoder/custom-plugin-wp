<?php
function hw_create_news_location_table(){
global $wpdb;
// var_dump($wpdb->prefix);
// die();
$table_name=$wpdb->prefix . 'hw_news_location';
$charset = $wpdb->get_charset_collate();
$sql = "CREATE TABLE $table_name (
    post_id int(11) NOT NULL,
    lat decimal(9,6) NOT NULL,
    lon decimal(9,6) NOT NULL,
    PRIMARY KEY (post_id)
) $charset;";
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);
}
register_activation_hook(HW_PLUGIN_FILE,'hw_create_news_location_table');

function hw_get_news_location($post_id){
    global $wpdb;
    $table_name=$wpdb->prefix . 'hw_news_location';
    if($news_location = get_transient('hw_news_location' . $post_id)){
        return $news_location;
    }
   $news_location = $wpdb->get_row("SELECT * FROM $table_name WHERE post_id=" . intval( $post_id ));
   set_transient('hw_news_location' . $post_id , $news_location);
   return $news_location;
}

function hw_save_news_location($post_id,$lat,$lon){
    global $wpdb;
    $table_name=$wpdb->prefix . 'hw_news_location';
    if(hw_get_news_location($post_id)){
        //update
        $wpdb->update(
            $table_name,
            array(
            'lat'=>$lat,
            'lon'=>$lon    
            ),
            array('post_id'=>$post_id),
            array(
                '%f',
                '%f',
            ),
            array('%d')
        );
    }else{
        //insert
       
        $wpdb->insert(
            $table_name,
            array(
                'post_id'=>$post_id,
                'lat'=>$lat,
                'lon'=>$lon
            ),
            array(
                '%d',
                '%f',
                '%f'
            )
            );
        
    }
    delete_transient('hw_news_location' . $post_id);
}
?>