jQuery(document).ready(function($)
	{





	$(document).on('click','.meme-generator-container .sticker-load-more',function(){
		
		$(this).addClass("loading");
		$(this).text("loading..");
		
		var sticker_terms = $('.sticker-cat').val();
		var offset = parseInt($(this).attr("offset"));
		var per_page = parseInt($(this).attr("per_page"));		
		
	
		
		$.ajax(
			{
		type: 'POST',
		url: meme_generator_ajax.meme_generator_ajaxurl,
		data: {"action": "meme_generator_get_sticker_list_ajax","offset":offset,"sticker_terms":sticker_terms},
		success: function(data)
				{
					
					$(".sticker-list").append(data);
					$('.sticker-load-more').removeClass("loading");
					$('.sticker-load-more').html("Load More...");
					
					var offest_last = parseInt(offset+per_page);
					$(".sticker-load-more").attr("offset",offest_last);
					
					}
			});
		
	})


	$(document).on('click','.meme-generator-container .meme-load-more',function(){
		
		$(this).addClass("loading");
		$(this).text("loading..");
		
		var meme_terms = $('.meme-cat').val();
		var offset = parseInt($(this).attr("offset"));
		var per_page = parseInt($(this).attr("per_page"));		
		
		//alert(meme_terms);
		
		$.ajax(
			{
		type: 'POST',
		url: meme_generator_ajax.meme_generator_ajaxurl,
		data: {"action": "meme_generator_get_meme_list_ajax","offset":offset,"meme_terms":meme_terms},
		success: function(data)
				{
					
					$(".meme-list").append(data);
					$('.meme-load-more').removeClass("loading");
					$('.meme-load-more').html("Load More...");
					
					var offest_last = parseInt(offset+per_page);
					$(".meme-load-more").attr("offset",offest_last);
					
					}
			});
		
	})










	$(document).on('click','.meme-generator-container .preview-save',function(){
		
		
		$('.preview-loading').css('display','inline-block');		
		var meme_id = $(this).attr('meme-id');
		var url = $(this).attr('url');		



		$.ajax(
			{
		type: 'POST',
		url:meme_generator_ajax.meme_generator_ajaxurl,
		data: {"action": "meme_generator_save_session","meme_id":meme_id ,"url":url},
		success: function(data)
				{	

					$(".preview-holder").fadeOut();
					//location(data);
					window.open(data);

				}
			});

		});



























	$(document).on('click', '.meme-generator-container .preview-close', function(){
		
		$(".preview-holder").fadeOut();
		})


	$(document).on('click', '.meme-generator-container .preview', function(){
		
		$(".preview-holder").fadeIn();
		
		
			html2canvas([ document.getElementById('canvas') ],{
			onrendered: function(canvas) {
				
				//alert(canvas.toDataURL());
				$('.preview-holder img').attr('src',canvas.toDataURL());
				$('.preview-save').attr('url',canvas.toDataURL());				
				
			//$('.tshirt-preview a').attr('href',canvas.toDataURL());			
			//$('.tshirt-preview img').attr('src',canvas.toDataURL());
			//$('.tshirt_gift_wrap').val(canvas.toDataURL());

		 	// window.open(canvas.toDataURL());
	
			 }
			});
		
		
		
		})
		
		

    $.fn.rotationDegrees = function () {
         var matrix = this.css("-webkit-transform") ||
		this.css("-moz-transform")    ||
		this.css("-ms-transform")     ||
		this.css("-o-transform")      ||
		this.css("transform");
		if(typeof matrix === 'string' && matrix !== 'none') {
			var values = matrix.split('(')[1].split(')')[0].split(',');
			var a = values[0];
			var b = values[1];
			var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
		} else { var angle = 0; }
		return angle;
   };




	$(document).on('change', '.meme-generator-container .rotate', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var rotate = $(this).val();	
		// for image
		$('.canvas #sticker-'+stickerid+' img').css('transform', 'rotate('+rotate+'deg)');
		$('.canvas #sticker-'+stickerid+' img').css('-ms-transform', 'rotate('+rotate+'deg)');		
		$('.canvas #sticker-'+stickerid+' img').css('-webkit-transform', 'rotate('+rotate+'deg)');
		
		// for text
		$('.canvas #sticker-'+stickerid+' p').css('transform', 'rotate('+rotate+'deg)');
		$('.canvas #sticker-'+stickerid+' p').css('-ms-transform', 'rotate('+rotate+'deg)');		
		$('.canvas #sticker-'+stickerid+' p').css('-webkit-transform', 'rotate('+rotate+'deg)');		
		
		
			
	
		})





	$(document).on('change', '.meme-generator-container .opacity', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var opacity = $(this).val();	
		$('.canvas #sticker-'+stickerid).css('opacity',(opacity));
	
		})



	$(document).on('change', '.meme-generator-container .layer', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var z_index = parseInt($(this).val());	
		$('.canvas #sticker-'+stickerid).css('z-index',(z_index));
	
		})
	
		
		
		
	$(document).on('click', '.meme-generator-container .remove-sticker', function(){
		
		var stickerid = $('.sticker-option').attr('stickerid');
		if(stickerid == '')
			{
				alert("Please select sticker first!!");
			}
			
		$('.canvas #sticker-'+stickerid).remove();
		$('.sticker-option').fadeOut();
		$('.sticker-text-option').fadeOut();			
		
		
		})			
		
	$(document).on('change', '.meme-generator-container .sticker-text-font-size', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var font_size = parseInt($(this).val());	
		$('.canvas #sticker-'+stickerid+' p').css('font-size',font_size);
		$('.canvas #sticker-'+stickerid).css('font-size',font_size);
		
		//$('.canvas #sticker-'+stickerid+' p').css('line-height',(font_size+10)+'px');
				
		})
		
	$(document).on('change', '.meme-generator-container .sticker-text-font-name', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var font_name = $(this).val();	
		$('.canvas #sticker-'+stickerid+' p').css('font-family',font_name);
		$('.canvas #sticker-'+stickerid).css('font-family',font_name);		

		})
		
	$(document).on('change', '.meme-generator-container .sticker-text-font-color', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var font_color = $(this).val();	
		$('.canvas #sticker-'+stickerid+' p').css('color','#'+font_color);
		$('.canvas #sticker-'+stickerid).css('color',font_color);
		})
		
		
	$(document).on('click', '.meme-generator-container .sticker-text-bold', function(){
		
		var stickerid = $('.sticker-option').attr('stickerid');
		var $this = $(this);
		
		 if($this.hasClass('active')){
		   $this.removeClass('active').addClass('inactive')
		   $('.canvas #sticker-'+stickerid+' p').css('font-weight','normal');
		 }else{
		   $this.removeClass('inactive').addClass('active');
		   $('.canvas #sticker-'+stickerid+' p').css('font-weight','bold');
		 }

		//$('.canvas #sticker-'+stickerid).css('font-weight','bold');
		})
		
		
	$(document).on('click', '.meme-generator-container .sticker-text-italic', function(){
		
		var stickerid = $('.sticker-option').attr('stickerid');
		var $this = $(this);
		
		 if($this.hasClass('active')){
			 
		   $this.removeClass('active').addClass('inactive')
		   $('.canvas #sticker-'+stickerid+' p').css('font-style','normal');
		 }else{
			 
		   $this.removeClass('inactive').addClass('active');
		   $('.canvas #sticker-'+stickerid+' p').css('font-style','italic');
		 }

		//$('.canvas #sticker-'+stickerid).css('font-weight','bold');
		})		
		
		
		
		
		
		
		
		
		
		
		
		
	$(document).on('change', '.meme-generator-container .sticker-text-input', function(){

		var stickerid = $('.sticker-option').attr('stickerid');
		var text = $(this).val();	
		$('.canvas #sticker-'+stickerid+' p').text(text);

		})		
		

	$(document).on('click', '.meme-generator-container .sticker-text', function(){


		//$('.sticker p').circleType({radius: 384});
		
		//activating text tab
		$(".td-nav.active").removeClass("active");
		$('.td-nav3').addClass("active");
		$(".td-nav-box").css("display","none");
		$(".td-nav-box3").css("display","block");
		
		
		$('.sticker-text-option').fadeIn('slow');
		
		var stickerid = $(this).attr('stickerid');
		var text = $(this).text();
		var font_size = parseInt($(this).css('font-size'));		
		var font_name = $(this).children().css('font-family');
		var font_color = $(this).children().css('color');		
			
		$('.sticker-text-input').val(text);
		$('.sticker-text-font-size').val(font_size);
		$('.sticker-text-font-name').val(font_name);
		
		$('.sticker-text-font-color').val(rgb2hex(font_color));
		$('.sticker-text-font-color').css('background-color',font_color);		
		
		
							
		function rgb2hex(rgb) {
				 if (  rgb.search("rgb") == -1 ) {
					  return rgb;
				 } else {
					  rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
					  function hex(x) {
						   return ("0" + parseInt(x).toString(16)).slice(-2);
					  }
					  return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]); 
				 }
			}
			
			
		})

	$(document).on('click', '.meme-generator-container .sticker-img', function(){
		
		//activating sticker tab
		$(".td-nav.active").removeClass("active");
		$('.td-nav2').addClass("active");
		
		$(".td-nav-box").css("display","none");
		$(".td-nav-box2").css("display","block");
		
		})
		
		
		
		
	$(document).on('click', '.meme-generator-container .sticker', function(){
		
		
		$('.stickeractive').removeClass("stickeractive");
		$(this).addClass("stickeractive");

	
		
		var stickerid = $(this).attr('stickerid');
		var z_index = parseInt($(this).css('zIndex'));
		var opacity = $(this).css('opacity');
		var rotate = $(this).children().rotationDegrees();
		
		$('.sticker-option').attr('stickerid',stickerid);
		$('.sticker-option .layer').val(z_index);

		$('.sticker-option .opacity').val(opacity);		
		$('.sticker-option .rotate').val(rotate);
			
			
			
			
		$('.sticker-option').fadeIn('slow');		
		})	
		
		
		
		
	$(document).on('click', '.meme-generator-container .sticker-list img', function(){
			
			var time_now = $.now(); 
		
			var sticker_src = $(this).attr('src');
			var stickerid = $(this).attr('stickerid')+'_'+time_now;
			$(".canvas").prepend('<div class="sticker sticker-img" id="sticker-'+stickerid+'" stickerid="'+stickerid+'" style=" z-index:10;"><img rotate="0" src='+sticker_src+' /></div>');

			$('.sticker').draggable();
			$('.sticker').resizable();
			//$('.sticker img').rotatable();
			
			
		  }); 


	$(document).on('click', '.meme-generator-container .inserttext', function(){
		
			var time_now = $.now(); 
		
			var text = $('.sticker-text-input').val();
			var stickerid = time_now;
			var font_size = $('.sticker-text-font-size').val();
			var font_name = $('.sticker-text-font-name').val();
			var font_color = $('.sticker-text-font-color').val();
			
							
			$(".canvas").prepend('<div  class="sticker sticker-text" id="sticker-'+stickerid+'" stickerid="'+stickerid+'" style=" z-index:10;color:#'+font_color+';font-size:'+font_size+'px; font-family:'+font_name+'"><p style="color:#'+font_color+';font-size:'+font_size+'px; font-family:'+font_name+'">'+text+'</p></div>');

			$('.sticker').draggable();
			$('.sticker').resizable();
			//$('.sticker').rotatable();
			
			
			
			
		  }); 












		
		$(document).on('click', '.meme-generator-container .td-navs li', function()
			{
				$(".active").removeClass("active");
				$(this).addClass("active");
				
				var nav = $(this).attr("nav");
				
				$(".td-nav-boxs li.td-nav-box").css("display","none");
				$(".td-nav-box"+nav).css("display","block");
		
			})
			
			

		
		$(document).on('click', '.meme-generator-container .meme-list img', function()
			{
				var meme_id = $(this).attr("meme-id");
				var src = $(this).attr("src");
				
				$('.preview-save').attr('meme-id',meme_id);	
				
				//$('.canvas').css('background','url('+src+') no-repeat scroll 0 0 rgba(0, 0, 0, 0)');
				$('.canvas img.main-tshirt').attr('src',src);				
				
				var front_img = $(this).attr("front-img");				
				var back_img = $(this).attr("back-img");					
				
				$('.canvas-menu .front').attr("front-img",front_img);	
				$('.canvas-menu .back').attr("back-img",back_img);				

				
			})

		



	});	







