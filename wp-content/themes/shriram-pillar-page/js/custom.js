jQuery(document).ready(function($){
	if($('.map')[0])
	{
		var map = g_map($('.map').data('lat'),$('.map').data('lng'),$('.map').data('name'),$('.map').data('address'),17,$('.map').attr('id'));
		var newLatlng=new google.maps.LatLng($('.map').data('lat'),$('.map').data('lng'));
	}
	if($('.map-mob')[0])
	{
		var map_mob = g_map($('.map-mob').data('lat'),$('.map-mob').data('lng'),$('.map-mob').data('name'),$('.map-mob').data('address'),17,$('.map-mob').attr('id'));
		var newLatlng=new google.maps.LatLng($('.map-mob').data('lat'),$('.map-mob').data('lng'));
	}
	$(window).on('load',function(){
		if($(window).width()>950)
		{
			var height = 0;
			$('.content-height').each(function(){
				if(height<$(this).outerHeight())
				{
					height = $(this).outerHeight();
				}
			});
			$('.content-height').css('height',height);
		}
	});
	$(window).on('load',function(){
		if($(window).width()>950)
		{
			var height = 0;
			$('.title-height').each(function(){
				if(height<$(this).outerHeight())
				{
					height = $(this).outerHeight();
				}
			});
			$('.title-height').css('height',height);
		}
	});
	$('.accordion-section>a').on('click',function(e){
		var parent = $(this).parent('.accordion-section').parent('.accordion'),
		accordionparent = $(this).parent('.accordion-section');
		if(accordionparent.hasClass('active'))
		{
			accordionparent.removeClass('active');
			accordionparent.children('.accordion-panel').slideUp();
		}
		else
		{
			parent.children('.accordion-section').removeClass('active').children('.accordion-panel').slideUp();
			accordionparent.addClass('active');			
			accordionparent.children('.accordion-panel').slideDown();
		}
		e.preventDefault();
	});
	$('.click-to-scroll-accordion').click(function(e){
		$('.accordion-panel').hide();
		$('#chapter-content-'+$(this).data('accordion')).show();
		$('html,body').animate({scrollTop:$('#chapter-title-'+$(this).data('accordion')).offset().top},1000);
		e.preventDefault();
	});
	$('.btn-secondary').click(function(e){
		var project = $(this).data('enquire');
		$('#UserProjectSingle').val(project);
	});
	$('.nav-toggle').click(function(e){
		$('#site-navigation').slideToggle();
		e.preventDefault();
	});
	$('.navigation-toggle-upscale').click(function(e){
		$('#site-navigation-upscale').slideToggle();
		e.preventDefault();
	});
	if($('.form-url')[0]){$('.form-url').val(window.location.href);}
	$(window).load(function(){
		var elementHeights = $('.same-height').map(function() {
			return $(this).height();
		}).get();
		var maxHeight = Math.max.apply(null, elementHeights);
		$('.same-height').height(maxHeight);
	});	
	var d = new Date();
	$('.year').html(d.getFullYear());
	$('.slideinform-toogler').magnificPopup({type:'image'});
	$('.scroll').click(function(e){
		$('html,body').animate({scrollTop:$($(this).attr('href')).offset().top},1000);
		e.preventDefault();
	});
});
new WOW().init();