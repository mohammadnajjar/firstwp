jQuery('.featured-section .title-wrap').matchHeight({
	property: 'min-height'
});

/* owl-carousel takes load time so matchHeight is called just after loading owl-carousel with setTimeout, Now works properly when resizing screen */
jQuery(window).on("load resize",function(){

	setTimeout(() => {
		jQuery('.featured-banner .featured-banner-grid-col').matchHeight({
			property: 'height',
		})
	}, 300);

});