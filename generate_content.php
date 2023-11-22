
<?php
/*

*/
include(plugin_dir_path((__FILE__)) .'curl.php');

function neuralrank_generate_content_page() {
?>
<section class="plugin-table">
    <div class="table-col-main">

        <div class="table-content">
          <form action="" method="post">
            <div class="col-inner">
                <label>Fill to get AI generated content</label>
             <p> <input type="text" class="nl_input" name="title" placeholder="Enter title for blog post" required></p>
            <p><input type="text" class="nl_input" name="topic" placeholder="Enter topic to generate from AI" required></p>
            </div>


            <div class="col-inner flex-row">
                <div class="inner-check">
                    <input type="checkbox" name="generate_images" class="featuredimg">
                    <label>Also search for relatable images</label>
                    <p> <input type="hidden" name="image_keyword" placeholder="Enter image keyword" class="hidden_input nl_input"></p>
                </div>
                <span onclick="popupOpen();">
                    Advanced Options</span>
            </div>
            
            <div class="col-inner action-button">

            <button type="submit">Generate Content</button>
            </div>
            <?php
          include(plugin_dir_path((__FILE__)) .'popup.php');
            ?>
        </form>
        </div>

    </div>
</section>

 
  <?php 
    if (isset($_POST['topic'])) {
      $enteredText =$_POST['topic'];
      $title =$_POST['title'];
      $imageKeyword = $_POST['image_keyword'];
      $max_token = (int)$_POST['max_token'];
      $temperature = (float)$_POST['temperature'];
      $model = $_POST['model'];
      $commandtoAPI= "Write an article in English using HTML with H2,H3,lists and bold,about:.$enteredText";
      $openai = new OpenAI($commandtoAPI, $max_token,$temperature,$model);
      $generated_text = $openai->writeContent($temperature,$model);
      $getImages= $openai->generateImage($imageKeyword);

      global $post;
      $username = 'neuralrankai';
      $user = get_user_by( 'login', $username );
      if ( $user ) {
      $author_id =$user->ID;
      } else {
      $admins = get_users( array( 'role' => 'administrator' ) );
      $admin = $admins[0];
      $author_id = $admin->ID;
      }
    }
    if (isset($generated_text)) {
      $post_data = array(
        'post_title'    => $title,
        'post_content'  => $generated_text,
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'post',
        'post_author'   => $author_id,
      );
  
      $post_id = wp_insert_post($post_data);
      $class = 'notice notice-success';
      $message = __( 'Blog Posted, Please go to posts to check.');
      printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    }
    if (isset($getImages)){
      if( ! is_wp_error( $post_id ) ){
        $thumbnail_id = $getImages[2];
        // echo $thumbnail_id;
      update_post_meta( $post_id, '_thumbnail_id', $thumbnail_id );
      }
    }
    

  ?>
  
<?php

}
