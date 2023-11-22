<?php
/*
menu page
*/

add_action( 'admin_menu', 'neuralrank_admin_menu' );
function neuralrank_admin_menu() {
    add_menu_page( 'Neural Rank', 'Neural Rank', 'manage_options', 'neuralrank', 'neuralrank_admin_page', 'dashicons-chart-area', 60 );
    add_submenu_page( 'neuralrank', 'Generate Images', 'Generate Images', 'manage_options', 'neuralrank-generate-images', 'neuralrank_generate_images_page' );
    // add_submenu_page( 'neuralrank', 'Generate Images(Google)', 'Generate Images(Google)', 'manage_options', 'neuralrank-generate-images-google', 'neuralrank_generate_images_using_google_page' );
    add_submenu_page( 'neuralrank', 'Generate AI Content', 'Generate AI Content', 'manage_options', 'neuralrank-generate-content', 'neuralrank_generate_content_page' );
    add_submenu_page( 'neuralrank', 'Settings (API)', 'Settings (API)', 'manage_options', 'neuralrank-settings', 'neuralrank_settings' );
}

