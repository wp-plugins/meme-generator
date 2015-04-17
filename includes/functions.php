<?php






function meme_generator_display($atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => "",
				), $atts);

	$html = '';
	



	$html .= '<div class="meme-generator-container">';

	
	$html .= '<div class="preview-holder"><img src="" />
	<span class="preview-close"></span>
	<span class="preview-save" side="front" meme-id="0" url=""></span>	
	<span class="preview-loading" ></span>	
	</div>';
	$html .= '<div class="tools-input">';
	$html .= '<ul class="td-navs"> 
					<li nav="1" class="td-nav td-nav1 active">Meme</li>
					<li nav="2" class="td-nav td-nav2">Sticker</li>
					<li nav="3" class="td-nav td-nav3">Text</li>

				</ul> <!-- tab-nav end -->
				 
				<ul class="td-nav-boxs">
				<li style="display: block;" class="td-nav-box1 td-nav-box active">
					
					<div class="td-option-box">'.meme_generator_get_meme_list().'</div>
				</li>
				<li style="display: none;" class="td-nav-box2 td-nav-box">
                <div class="sticker-option" stickerid="" z-index="">
					
					<label >Remove <span title="Remove Selected Sticker." class="remove-sticker" ></span></label>
					<label >Z-Index  <input title="Z-index for Selected Sticker." size="10" class="layer" type="number" min="0" max="9999"></label>
					<label >Opacity  <input title="Opacity for Selected Sticker." size="10" class="opacity" type="number" min="0" max="1" step="0.01"></label>
					<label >Rotation <input title="Rotate for Selected Sticker." size="10" class="rotate" type="number" min="-360" max="360" step="1"></label>
				</div>
				<div class="td-option-box">'.meme_generator_get_sticker_list().'</div>

				</li>
				<li style="display: none;" class="td-nav-box3 td-nav-box">
				<div class="td-option-box">
					<div class="sticker-text-option">
					<label >Remove <span title="Remove Selected Sticker." class="remove-sticker" ></span></label><br/>
					
						<input placeholder="text font size. ex: 18" size="5" type="number" min="0" max="9999" class="sticker-text-font-size" />
						<input  placeholder="text font color. ex: #66ff00" size="10" value="66ff00" class="sticker-text-font-color color" />'.meme_generator_font_list().'
						
						
						<span title="Make Bold Text" class="sticker-text-bold" ></span>
						<span title="Make Bold Text" class="sticker-text-italic" ></span>
					</div>
					<textarea placeholder="Text Here" class="sticker-text-input" style="width:90%;" role="" rows="2" ></textarea>
					
					<span class="inserttext">Insert</span>
				
				
                </div>
				</li>
				
			';	
	$html .= '</div>';
	$html .= '<div class="playground">';
	$html .= '<div class="canvas-menu">';
	$html .= '<span class="preview">Preview</span>';
	$html .= '<span class="loading-side">&nbsp;</span>';
	$html .= '</div>';
	
	$html .= '<div class="canvas" id="canvas"><img alt="Please select meme first." class="main-tshirt" src="'.meme_generator_plugin_url.'/css/demo.png" /></div>';

	$html .= '</div>';

	$html .= '</div>';
	
	return $html;



	}
	
add_shortcode('meme_generator', 'meme_generator_display');






function meme_generator_get_meme_list()
	{
		
		$meme_generator_posts_per_page = get_option('meme_generator_posts_per_page');
		if(empty($meme_generator_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $meme_generator_posts_per_page;
			}
		
		
		$args_tshirt = array(
			
			'post_type' => 'meme',
			'post_status' => 'publish',				
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var( 'paged' ),
			
			);
		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	

		$html = '';

		
		
		$html.='<div class="meme-list">';

		if($tshirt_query->have_posts()): while($tshirt_query->have_posts()): $tshirt_query->the_post();
		
		$meme_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
		$meme_thumb_url = $meme_thumb['0'];

			if(!empty($meme_thumb_url))
				{
				$html.= '<img meme-id="'.get_the_ID().'" src="'.$meme_thumb_url.'"/>';

				}
		
		endwhile; 
		wp_reset_postdata();
		endif;
		$html.='</div>';
		$html.='<div class="meme-load-more" per_page="'.$posts_per_page.'" offset="'.$posts_per_page.'">Load More</div>';

		return $html;

	}





function meme_generator_get_meme_list_ajax()
	{
		if(isset($_POST['offset'])) $offset = (int)$_POST['offset'];
		if(isset($_POST['meme_terms'])) $meme_terms = (int)$_POST['meme_terms'];		
		
		$meme_generator_posts_per_page = get_option('meme_generator_posts_per_page');
		if(empty($meme_generator_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $meme_generator_posts_per_page;
			}
		
		$meme_generator_taxonomy = 'meme_cat';
		
		
		if($meme_terms=='all')
			{
				$args_tshirt = array(
					
					'post_type' => 'meme',
					'post_status' => 'publish',
					'posts_per_page' => $posts_per_page,
					'offset' => $offset,
					
					);
			}
		else
			{
				$args_tshirt = array(
					
					'post_type' => 'meme',
					'post_status' => 'publish',
					'tax_query' => array(
						array(
							   'taxonomy' => $meme_generator_taxonomy,
							   'field' => 'id',
							   'terms' => $meme_terms,
						)
					),
					'posts_per_page' => $posts_per_page,
					'offset' => $offset,
					
					);
			}
		

		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	
		
		$html = '';
		if($tshirt_query->have_posts()){
			while($tshirt_query->have_posts()): $tshirt_query->the_post();
		
			$meme_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			$meme_thumb_url = $meme_thumb['0'];	

			if(!empty($meme_thumb_url))
				{
				$html.= '<img meme-id="'.get_the_ID().'" src="'.$meme_thumb_url.'"/>';

				}
		
		endwhile; 
		wp_reset_postdata();
		
		}
		else{ ?>
<script>
jQuery(document).ready(function($)
	{
		
		$('.meme-load-more').css('background','#ff5337');
		$('.meme-load-more').prop('disabled', true);
		$('.meme-load-more').css('cursor', 'not-allowed');

	})
</script>
<?php
		}
		echo $html;
		die();
		
	
	}
add_action('wp_ajax_meme_generator_get_meme_list_ajax', 'meme_generator_get_meme_list_ajax');
add_action('wp_ajax_nopriv_meme_generator_get_meme_list_ajax', 'meme_generator_get_meme_list_ajax');





function meme_generator_meme_list_by_cat_ajax()
	{
		if(isset($_POST['offset'])) $offset = (int)$_POST['offset'];
		if(isset($_POST['meme_terms'])) $meme_terms = $_POST['meme_terms'];		
		
		$meme_generator_posts_per_page = get_option('meme_generator_posts_per_page');
		
		if(empty($meme_generator_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $meme_generator_posts_per_page;
			}
		
		
		$meme_generator_taxonomy = 'meme_cat';
		
		
		if($meme_terms == 'all')
			{
				$args_tshirt = array(
					
					'post_type' => 'meme',
					'post_status' => 'publish',
					'posts_per_page' => $posts_per_page,
					'offset' => $offset,
					
					);	
			}
		else
			{
				$args_tshirt = array(
					
					'post_type' => 'meme',
					'post_status' => 'publish',
					'tax_query' => array(
						array(
							   'taxonomy' => $meme_generator_taxonomy,
							   'field' => 'id',
							   'terms' => $meme_terms,
						)
					),
					'posts_per_page' => $posts_per_page,
					'offset' => $offset,
					
					);
			}
		

			
			
		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	
		
		$html = '';
		if($tshirt_query->have_posts()){
			 while($tshirt_query->have_posts()): $tshirt_query->the_post();
				
				
			$meme_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			$meme_thumb_url = $meme_thumb['0'];

		
			if(!empty($meme_thumb_url))
				{
				$html.= '<img meme-id="'.get_the_ID().'" src="'.$meme_thumb_url.'"/>';

				}
			
			endwhile; 
			wp_reset_postdata();
		
		}
		else{ 
		
		$html.= 'No meme for design.';
		
		
		?>
<script>
jQuery(document).ready(function($)
	{
		
		$('.meme-load-more').css('background','#ff5337');
		$('.meme-load-more').prop('disabled', true);
		$('.meme-load-more').css('cursor', 'not-allowed');

	})
</script>
<?php
		}
		echo $html;
		die();
		
	
	}
add_action('wp_ajax_meme_generator_meme_list_by_cat_ajax', 'meme_generator_meme_list_by_cat_ajax');
add_action('wp_ajax_nopriv_meme_generator_meme_list_by_cat_ajax', 'meme_generator_meme_list_by_cat_ajax');






	
function meme_generator_get_sticker_list_ajax()
	{
		if(isset($_POST['offset'])) $offset = (int)$_POST['offset'];
		if(isset($_POST['sticker_terms'])) $sticker_terms = (int)$_POST['sticker_terms'];		
		
		$meme_generator_posts_per_page = get_option('meme_generator_posts_per_page');
		if(empty($meme_generator_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $meme_generator_posts_per_page;
			}
		
		
		if($sticker_terms == 'all')
			{
				$args_tshirt = array(
					
					'post_type' => 'meme_sticker',
					'post_status' => 'publish',
					'meta_key' => '_thumbnail_id',
					'meta_value' => '',
					'meta_compare' => '!=',
					'posts_per_page' => $posts_per_page,
					'offset' => $offset,
					);
			}
		else
			{
				$args_tshirt = array(
					
					'post_type' => 'meme_sticker',
					'post_status' => 'publish',
					'meta_key' => '_thumbnail_id',
					'meta_value' => '',
					'meta_compare' => '!=',
					'tax_query' => array(
						array(
							   'taxonomy' => 'meme_sticker_cat',
							   'field' => 'id',
							   'terms' => $sticker_terms,
						)
					),
					'posts_per_page' => $posts_per_page,
					'offset' => $offset,
					);
			}
		
		

			
			
		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	

		$html = '';


		if($tshirt_query->have_posts()){ while($tshirt_query->have_posts()): $tshirt_query->the_post();
		

			$sticker_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

			if(!empty($sticker_url))
				{
					$html.= '<img stickerid="'.get_the_ID().'" src="'.$sticker_url.'"/>';

				}
		
		endwhile;
		wp_reset_postdata();
		}
		else
			{
			?>
			<script>
            jQuery(document).ready(function($)
                {
                    
                    $('.sticker-load-more').css('background','#ff5337');
                    $('.sticker-load-more').prop('disabled', true);
                    $('.sticker-load-more').css('cursor', 'not-allowed');
            
                })
            </script>
            <?php
			}
		echo $html;
		die();
	
	}	
add_action('wp_ajax_meme_generator_get_sticker_list_ajax', 'meme_generator_get_sticker_list_ajax');
add_action('wp_ajax_nopriv_meme_generator_get_sticker_list_ajax', 'meme_generator_get_sticker_list_ajax');





	
function meme_generator_get_sticker_list_by_cat_ajax()
	{
		if(isset($_POST['offset'])) $offset = (int)$_POST['offset'];
		if(isset($_POST['sticker_terms'])) $sticker_terms = $_POST['sticker_terms'];		
		
		$meme_generator_posts_per_page = get_option('meme_generator_posts_per_page');
		if(empty($meme_generator_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $meme_generator_posts_per_page;
			}
		
		
		if($sticker_terms == 'all')
			{
				$args_tshirt = array(
					
					'post_type' => 'meme_sticker',
					'post_status' => 'publish',
					'meta_key' => '_thumbnail_id',
					'meta_value' => '',
					'meta_compare' => '!=',
					'posts_per_page' => $posts_per_page,
					'offset' => $offset,
					);
			}
		else
			{
				$args_tshirt = array(
					
					'post_type' => 'meme_sticker',
					'post_status' => 'publish',
					'meta_key' => '_thumbnail_id',
					'meta_value' => '',
					'meta_compare' => '!=',
					'tax_query' => array(
						array(
							   'taxonomy' => 'meme_sticker_cat',
							   'field' => 'id',
							   'terms' => $sticker_terms,
						)
					),
					'posts_per_page' => $posts_per_page,
					'offset' => $offset,
					);
			}
		
		

			
			
		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	

		$html = '';


		if($tshirt_query->have_posts()){ while($tshirt_query->have_posts()): $tshirt_query->the_post();
		

			$sticker_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

			if(!empty($sticker_url))
				{
					$html.= '<img stickerid="'.get_the_ID().'" src="'.$sticker_url.'"/>';

				}
		
		endwhile;
		wp_reset_postdata();
		}
		else
			{
				$html.= 'No sticker for this category.';
			?>
			<script>
            jQuery(document).ready(function($)
                {
                    
                    $('.sticker-load-more').css('background','#ff5337');
                    $('.sticker-load-more').prop('disabled', true);
                    $('.sticker-load-more').css('cursor', 'not-allowed');
            
                })
            </script>
            <?php
			}
		echo $html;
		die();
	
	}	
add_action('wp_ajax_meme_generator_get_sticker_list_by_cat_ajax', 'meme_generator_get_sticker_list_by_cat_ajax');
add_action('wp_ajax_nopriv_meme_generator_get_sticker_list_by_cat_ajax', 'meme_generator_get_sticker_list_by_cat_ajax');








function meme_generator_get_sticker_list()
	{
		$meme_generator_posts_per_page = get_option('meme_generator_posts_per_page');
		if(empty($meme_generator_posts_per_page))	
			{
				$posts_per_page = get_option('posts_per_page');
			}
		else
			{
				$posts_per_page = $meme_generator_posts_per_page;
			}
		
		$args_tshirt = array(
			
			'post_type' => 'meme_sticker',
			'post_status' => 'publish',
			'meta_key' => '_thumbnail_id',
			'meta_value' => '',
			'meta_compare' => '!=',
			'posts_per_page' => $posts_per_page,
			'paged' => get_query_var( 'paged' ),
			);
		global $tshirt_query;
		$tshirt_query = new WP_Query( $args_tshirt );	

		$html = '';	
		$html .='<div class="sticker-list">';

		if($tshirt_query->have_posts()): while($tshirt_query->have_posts()): $tshirt_query->the_post();
		

			$sticker_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

			if(!empty($sticker_url))
				{
					$html.= '<img stickerid="'.get_the_ID().'" src="'.$sticker_url.'"/>';

				}
		
		endwhile;
		wp_reset_postdata();
		endif;
		$html.='</div>';
		
		$html.='<div class="sticker-load-more" per_page="'.$posts_per_page.'" offset="'.$posts_per_page.'">Load More</div>';	
		

		

		return $html;

	}






function meme_generator_is_user_logged()
{
	if(is_user_logged_in())
		{
			return true;
		}
	else
		{
			return false;
		}
	
}


function meme_generator_init_session()
	{
	  session_start();
	}

add_action('init', 'meme_generator_init_session', 1);




function meme_generator_save_session() {
	

	$meme_id = $_POST['meme_id'];
	$url = $_POST['url'];
	
	$_SESSION['meme_id'] = $meme_id;
	
	
	


			
			
	$uniqid = uniqid();
	$img = $url;
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = meme_generator_plugin_dir.'meme/'. $uniqid . '.png';
	$success = file_put_contents($file, $data); 	

	$img_url = meme_generator_plugin_url.'meme/'.$uniqid.'.png';
		
	echo $img_url;
			
	die();
	
	}

add_action('wp_ajax_meme_generator_save_session', 'meme_generator_save_session');
add_action('wp_ajax_nopriv_meme_generator_save_session', 'meme_generator_save_session');



function meme_generator_font_list()
	{
		$google_fonts = array(
							'Open Sans',		
							'Shadows Into Light',
							'Josefin Slab',
							'Arvo',						
							'Lato',						
							'Vollkorn',						
							'Abril Fatface',
							'Ubuntu',						
							'PT Sans',						
							'Old Standard TT',	
							'Droid Sans',
							'Anivers',						
							'Junction',						
							'Fertigo',	
							'Aller',							
							'Audimat',							
							'Delicious',
							'Prociono',						
							'Fontin',						
							'Fontin-Sans',						
							'Chunkfive',					
										
			);
			
		$html = '';
		$html .= '<select class="sticker-text-font-name">';			
			
		foreach($google_fonts as $font)
			{
				$html .= '<option value="'.$font.'" >'.$font.'</option>';

			}
		$html .= '</select>';	
					
		$fonts_script = '';
		foreach($google_fonts as $font)
			{
				
				$fonts_script .= '"'.str_replace(' ','+',$font).'::latin",';

			}

			
			
			
		$html .= '
			<script type="text/javascript">
			  WebFontConfig = {
				google: { families: [ '.$fonts_script.' ] }
			  };
			  (function() {
				var wf = document.createElement("script");
				wf.src = ("https:" == document.location.protocol ? "https" : "http") +
				  "://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";
				wf.type = "text/javascript";
				wf.async = "true";
				var s = document.getElementsByTagName("script")[0];
				s.parentNode.insertBefore(wf, s);
			  })(); 
			  </script>';
			
			
			
			
			
			
		return $html;	
							
		
	  
	}









//cart_item_data


	

	

	

	
	
	
	
	
	
	
	
	
	
	function meme_generator_share_plugin()
		{
			
			?>
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwordpress.org%2Fplugins%2Fmeme-generator%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=652982311485932" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
            
            <br />
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php echo meme_generator_share_url; ?>"></div>
            
            <br />
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo meme_generator_share_url; ?>" data-text="<?php echo meme_generator_plugin_name; ?>" data-via="ParaTheme" data-hashtags="WordPress">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



            <?php
			
			
			
		
		
		}
	
	
	
	

/////////////////////////////

