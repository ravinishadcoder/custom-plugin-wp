<?php
function hw_test_api_calls(){
    $data = wp_remote_get('https://jsonplaceholder.typicode.com/posts');
    if(is_array($data)) {
        $posts = json_decode($data['body']);
        foreach( $posts as $post ){
            ?>
            <!-- wp_insert_post(array(
           'post_title'=>$post->title,
           'post_content'=>$post->body,
           )); -->
            <h2><?php echo esc_html( $post->title ); ?></h2>
            <p>
                <?php echo esc_html( $post->body) ;?>
            </p>
            <?php
        }
        die();
    }
}
//add_filter('the_content','hw_test_api_calls');
?>
