<?php
/*
Plugin Name: NeuralRank
description: The NeuralRank is a powerful plugin that uses the latest in artificial intelligence technology to optimize your blog for maximum readability and search engine visibility. With features like automated content generation, keyword analysis, readability score, automated image and link optimization, meta description, and alt text, as well as speech-to-text and image generation capabilities, NeuralRank makes it easy to create high-quality, SEO-friendly blog content in minutes
version: 1.0
author: SoftProdigy
author uri: https://softprodigy.com/
*/

function neuralrank_activate() {
    // Code to run during plugin activation
    add_post_meta(14547, 'openai_api_key', '');
    add_post_meta(14558, 'pexels_api_key', '');
    nl_check_api_keys();

    // adding user as author role to post blogs automatic
    $user_id = wp_insert_user( array(
        'user_login' => 'neuralrankai',
        'user_pass' => wp_generate_password(),
        'role' => 'author'
    ) );
}
register_activation_hook( __FILE__, 'neuralrank_activate' );

function neuralrank_deactivate() {
    // Code to run during plugin deactivation

      // Delete the user with the username "Neural Rank AI"
      $user = get_user_by( 'login', 'neuralrankai' );
      if ( $user ) {
          wp_delete_user( $user->ID );
      }
  
}
register_deactivation_hook( __FILE__, 'neuralrank_deactivate' );

require(dirname(__FILE__). '/menu.php');
require(dirname(__FILE__). '/pages/generate_images.php');
require(dirname(__FILE__). '/pages/generate_content.php');
require(dirname(__FILE__). '/pages/neuralrank_admin_menu.php');
require(dirname(__FILE__). '/pages/settings.php');
// require(dirname(__FILE__). '/pages/popup.php');


function enqueue_admin_scripts(){
wp_enqueue_script( 'NL-js', plugins_url( 'assets/js/main.js' , __FILE__ ) );
wp_enqueue_script( 'NL-jquery',"https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" );
wp_enqueue_style( 'NL-css', plugins_url( 'assets/css/main.css' , __FILE__ ));
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_scripts');

// checking if APIs has been filled or not 
add_action( 'admin_notices', 'nl_check_api_keys');
function nl_check_api_keys(){
$checkOpenAI = get_post_meta( 14547, 'openai_api_key');
$checkpexelsAPI = get_post_meta( 14558, 'pexels_api_key');
if($checkOpenAI ==''){
    $class = 'notice notice-error';
	$message = __( 'Please Add OpenAI API-key From Neural Rank Settings.');
	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
if($checkpexelsAPI ==''){
    $class = 'notice notice-error';
	$message = __( 'Please Add Pexels API-Key From Neural Rank Settings.');
	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
}