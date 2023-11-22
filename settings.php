<?php


function neuralrank_settings(){
    $checkOpenAI = get_post_meta( 14547, 'openai_api_key');
    $checkpexelsAPI = get_post_meta( 14558, 'pexels_api_key');
?>
<div class="content-main">
  <div class="content-box">
    <h2>Settings</h2>
<form action="" method="post">
<label for="openAPI_key">OpenAI API Key:</label>
<?php if(!empty($checkOpenAI)){?>
    <p><input type="text"  value= "<?php echo $checkOpenAI[0]; ?> "name="openAPI_key" class="nl_setting_input" placeholder="Enter your OpenAI API Key" required></p>
<?php } else{ ?>
<p><input type="text" name="openAPI_key" class="nl_setting_input" placeholder="Enter your OpenAI API Key" required></p>
<?php } ?>
<p><a href="https://openai.com/api/" target="_blank">Get OpenAI API key</a></p>

<label for="pexels_key">Pexels API Key:</label>
<?php if(empty($checkpexelsAPI)){?>
<p><input type="text" name="pexels_key" class="nl_setting_input" placeholder="Enter your Pexels API Key" required></p>
<?php } else{ ?>
<p><input type="text"  value= "<?php echo $checkpexelsAPI[0]; ?> "name="pexels_key" class="nl_setting_input" placeholder="Enter your OpenAI API Key" required></p>
<?php } ?>
<p><a href="https://www.pexels.com/api/" target="_blank">Get Pexels API key</a></p>

<p><input type="submit" value="Save" name="save_ml_api_setting"></p>
</form>
</div>
</div>
<?php

// saving APIs

if (isset($_POST['save_ml_api_setting'])) {
    $openAIAPI= $_POST['openAPI_key'];
    $pexelsAPI = $_POST['pexels_key'];
    if($checkOpenAI == ''){
    add_post_meta(14547, 'openai_api_key', $openAIAPI);
    }
    else {
    update_post_meta(14547, 'openai_api_key', $openAIAPI);
    }
    if($checkpexelsAPI == ''){
    add_post_meta(14558, 'pexels_api_key', $pexelsAPI);
    }
    else {
        update_post_meta(14558, 'pexels_api_key', $pexelsAPI);
    }
    $class = 'notice notice-success';
	$message = __( 'Setting Saved.');
	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    die;
    
}

   
}