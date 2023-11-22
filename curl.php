<?php
class OpenAI {
    private $prompt;
    private $api_key;
    private $api_endpoint;
    private $max_token;
    private $title;
    private $image_api_endpoint;
    private $temperature;
    private $model;
  
  
    public function __construct($prompt, $max_token, $title,$model) {
      $this->prompt = $prompt;
      $this->max_token = $max_token;
      $this->api_key = get_post_meta( 14547, 'openai_api_key')[0];
      $this->api_endpoint = "https://api.openai.com/v1/engines/$model/completions";
      $this->title = $title;
    }
      
    public function writeContent($temperature) {
      $textinit = curl_init();
      curl_setopt($textinit, CURLOPT_URL, $this->api_endpoint);
      curl_setopt($textinit, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($textinit, CURLOPT_POST, true);
      curl_setopt($textinit, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $this->api_key
      ]);
      curl_setopt($textinit, CURLOPT_POSTFIELDS, json_encode([
        'prompt' => $this->prompt,
        'max_tokens' =>$this->max_token,
        'temperature' => $temperature,
      ]));
  
      $response = curl_exec($textinit);
      $result = json_decode($response, true);
     
      curl_close($textinit);
      $post_content = $result['choices'][0]['text'];
     
      return $result['choices'][0]['text'];
    }

    public function generateImage($imageKeyword) {
        if(isset($_POST['generate_images'])){
        $base_url = "https://api.pexels.com/v1/search?";
        $query = $imageKeyword;

        // API Key
        $pexels_api_key =  get_post_meta( 14558, 'pexels_api_key')[0];

        // Build the URL
        $url = $base_url . "query=" . urlencode($query) . "&per_page=1&page=1";

        $imginit = curl_init();

        // Set URL and other appropriate options
        curl_setopt($imginit, CURLOPT_URL, $url);
        curl_setopt($imginit, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($imginit, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer ".$pexels_api_key
        ));

        // Get the response
        $img_response = curl_exec($imginit);

        // Close cURL resource, and free up system resources
        curl_close($imginit);

        // Decode the JSON data
        $img_url = json_decode($img_response, true);

        $image_url= $img_url['photos'][0]['src']['medium'];
       // echo $image_url;
        $file = preg_replace(
          "/(.+(\.(jpg|gif|jp2|png|bmp|jpeg|svg)))(.*)$/",
          '${1}',
          $image_url
        );
       // echo $file;

$filename = basename($file);

$upload_file = wp_upload_bits($filename, null, file_get_contents($file));
if (!$upload_file['error']) {
	$wp_filetype = wp_check_filetype($filename, null );
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
		'post_content' => '',
		'post_status' => 'inherit'
	);
	$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );
	if (!is_wp_error($attachment_id)) {
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
		wp_update_attachment_metadata( $attachment_id,  $attachment_data );
   
	}
  // Assuming $attachment_id contains the attachment ID generated by wp_insert_attachment()
$image_attributes = wp_get_attachment_image_src($attachment_id, 'full');

if ($image_attributes) {
    $featured_image_url = $image_attributes[0]; // URL of the full size image
    $image_width = $image_attributes[1]; // width of the full size image
    $image_height = $image_attributes[2]; // height of the full size image

    // Output the image tag
    // echo '<img src="' . $image_url . '" width="' . $image_width . '" height="' . $image_height . '">';
    $images_urls= array($image_url, $featured_image_url, $attachment_id);
}
}
    return $images_urls;
        
      }
    }
  }
  

  