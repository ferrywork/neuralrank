
<?php
/*
*/


function neuralrank_generate_images_page() {
?>
<section class="plugin-table">
    <div class="table-col-main">
     <div class="table-content">
<form action="" method="post">
<input type="text" placeholder="Enter keyword for image" name="image_generate_text" class="nl_input" id="" required>


<div class="col-inner action-button">
  <button type="submit">Generate Image</button>
</div>
</div>
</div>
</section>
<?php



if(isset($_POST['image_generate_text'])) {
  $base_url = "https://api.pexels.com/v1/search?";
        $query = $_POST['image_generate_text'];

        // API Key
        $pexels_api_key =  get_post_meta( 14558, 'pexels_api_key')[0];

        // Build the URL
        $url = $base_url . "query=" . urlencode($query) . "&per_page=10&page=1";

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
        $image_url= $img_url['photos'];
        foreach($image_url as $imgUrl){
          echo "<img src=".$imgUrl['src']['medium']." class='image_nl'>";
        }
}


}