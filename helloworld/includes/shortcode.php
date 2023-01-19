<?php
if(! defined('ABSPATH')){
    die("Do not do this !");
}
function hw_handle_test_shortcode($atts,$content=""){
    global $post;
 $atts=shortcode_atts(array(
       'color'=>'red'
 ),$atts);
 ob_start();
 ?>
 <div class="test">
    <h2><?php echo $content ?>(<?php echo get_the_ID()  ?>)</h2>
    <span style="color:<?php echo $atts['color'] ?>">test</span>
 </div>
 <?php
 return ob_get_clean();
}
add_shortcode('my-test-shortcode','hw_handle_test_shortcode');

function hw_add_content_at_bottom($content){
    global $post;
    if(is_page('about')){
     $content=str_ireplace('lorem ipsum','Ravi Nishad',$content);
     $content= $content . '<p>My Content At bottom</p>';
    }
     return $content;
}
add_filter('the_content','hw_add_content_at_bottom');
?>