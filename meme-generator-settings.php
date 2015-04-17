<?php	


if ( ! defined('ABSPATH')) exit; // if direct access 



if(empty($_POST['meme_generator_hidden']))
	{
		$meme_generator_posts_per_page = get_option( 'meme_generator_posts_per_page' );
		$meme_generator_allow_sticker_upload = get_option( 'meme_generator_allow_sticker_upload' );		
		$meme_generator_sticker_size = get_option( 'meme_generator_sticker_size' );
		
		
		
		
	}
else
	{	
		if($_POST['meme_generator_hidden'] == 'Y') {
			//Form data sent
			$meme_generator_posts_per_page = stripslashes_deep($_POST['meme_generator_posts_per_page']);
			update_option('meme_generator_posts_per_page', $meme_generator_posts_per_page);
	
			$meme_generator_allow_sticker_upload = stripslashes_deep($_POST['meme_generator_allow_sticker_upload']);
			update_option('meme_generator_allow_sticker_upload', $meme_generator_allow_sticker_upload);	
			
			$meme_generator_sticker_size = stripslashes_deep($_POST['meme_generator_sticker_size']);
			update_option('meme_generator_sticker_size', $meme_generator_sticker_size);				
			
			
			
			
			
	
			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.', 'meme_generator' ); ?></strong></p></div>
	
			<?php
			} 
	}
?>

<div class="wrap">
	<?php echo "<h2>".__(meme_generator_plugin_name.' Settings')."</h2>";
	
    $meme_generator_customer_type = get_option('meme_generator_customer_type');
    $meme_generator_version = get_option('meme_generator_version');
	
	
	?>
    <br />
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="meme_generator_hidden" value="Y">
        <?php settings_fields( 'meme_generator_plugin_options' );
				do_settings_sections( 'meme_generator_plugin_options' );
			
		?>

    <div class="para-settings">
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Options</li>
            <li nav="2" class="nav2">Help</li>
        </ul> <!-- tab-nav end -->  
        
		<ul class="box">
            <li style="display: block;" class="box1 tab-box active">
            
				<div class="option-box">
                    <p class="option-title">Number of items on list</p>
                    <p class="option-info"></p>
                	<input size="15" type="text" name="meme_generator_posts_per_page" value="<?php if(!empty($meme_generator_posts_per_page)) echo $meme_generator_posts_per_page; else echo 10; ?>" />
                </div>
            
				<div class="option-box">
                    <p class="option-title">Allow Upload Custom Sticker.</p>
                    <p class="option-info">You can control who should access to sticker/image upload to designer.</p>
                    <select name="meme_generator_allow_sticker_upload" >
                        <option value="no" <?php if($meme_generator_allow_sticker_upload == 'no') echo 'selected'?> >No</option>
                        <option value="user" <?php if($meme_generator_allow_sticker_upload == 'user') echo 'selected'?> >User Only</option>
                        <option value="visitor" <?php if($meme_generator_allow_sticker_upload == 'visitor') echo 'selected'?> >Visitors</option>
                        
                    </select>
                	
                </div>     
				<div class="option-box">
                    <p class="option-title">Sticker file size.</p>
                    <p class="option-info">size in Mb</p>
                	<input size="15" type="text" name="meme_generator_sticker_size" value="<?php if(!empty($meme_generator_sticker_size)) echo $meme_generator_sticker_size; else echo 2; ?>" />Mb
                </div>
            
            
            
            </li>
            <li style="display: none;" class="box2 tab-box">
<div class="option-box">
                    <p class="option-title">Need Help ?</p>
                    <p class="option-info">Feel free to contact with any issue for this plugin, Ask any question via forum <a href="<?php echo meme_generator_qa_url; ?>"><?php echo meme_generator_qa_url; ?></a> <strong style="color:#139b50;">(free)</strong><br />

    <?php

    if($meme_generator_customer_type=="free")
        {
    
            echo 'You are using <strong> '.$meme_generator_customer_type.' version  '.$meme_generator_version.'</strong> of <strong>'.meme_generator_plugin_name.'</strong>, To get more feature you could try our premium version. ';
            
            echo '<br /><a href="'.meme_generator_pro_url.'">'.meme_generator_pro_url.'</a>';
            
        }
    else
        {
    
            echo 'Thanks for using <strong> premium version  '.$meme_generator_version.'</strong> of <strong>'.meme_generator_plugin_name.'</strong> ';	
            
            
        }
    
     ?>       

                    
                    </p>

                </div>
				<div class="option-box">
                    <p class="option-title">Please Share</p>
                    <p class="option-info">If you like this plugin please share with your social share network.</p>
					<?php echo meme_generator_share_plugin(); ?>
                </div>
				<div class="option-box">
                    <p class="option-title">Video Tutorial</p>
                    <p class="option-info">Please watch this video tutorial.</p>
                	<iframe width="640" height="480" src="<?php echo meme_generator_tutorial_video_url; ?>" frameborder="0" allowfullscreen></iframe>
                </div>




            </li>        
        
        
    
    </div>
<p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','team' ); ?>" />
                </p>
		</form>
        
</div> <!-- wrap end -->