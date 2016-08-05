jQuery(window).load(function (){
	( function( $ ) {

		//Scroll to section
		$('body').on('click', '#accordion-panel-crafter_front_page_sections .control-subsection .accordion-section-title', function(event) {
			if ( !$(this).parent('.control-subsection').hasClass('open') ) {
				return false;
			};
			var section_id = $(this).parent('.control-subsection').attr('id');
			scrollToSection( section_id );
			
		});

		function scrollToSection( section_id ){
			var section_class = "welcome-section";
			var $contents = $('#customize-preview iframe').contents();
			switch ( section_id ) {
				case 'accordion-section-welcome':
			        section_class = "welcome-section";
			        break;
				case 'accordion-section-services':
			        section_class = "services-section";
			        break;
			    case 'accordion-section-crafter_quote_section':
			        section_class = "quote-section";
			        break;
			    case 'accordion-section-crafter_video_section':
			        section_class = "video-section";
			        break;
			    case 'accordion-section-crafter_testimonials_section':
			        section_class = "testimonials-section";
			        break;
			    case 'accordion-section-crafter_image_section':
			        section_class = "image-section";
			        break;
			    case 'accordion-section-crafter_team_section':
			        section_class = "team-section";
			        break;
			    case 'accordion-section-crafter_phone_section':
			        section_class = "phone-section";
			        break;
			    case 'accordion-section-crafter_tagline_section':
			        section_class = "tagline-section";
			        break;
			    case 'accordion-section-crafter_clients_section':
			        section_class = "clients-section";
			        break;
			    case 'accordion-section-crafter_map_section':
			        section_class = "map-section";
			        break;
			    case 'accordion-section-crafter_pricing_section':
			        section_class = "pricing-section";
			        break;
			    case 'accordion-section-crafter_portfolio_section':
			        section_class = "portfolio-section";
			        break;
			    case 'accordion-section-crafter_blog_section':
			        section_class = "blog-section";
			        break;
			    case 'accordion-section-crafter_subscribe_section':
			        section_class = "subscribe-section";
			        break;
			}
			$contents.find("html, body").animate({
		    	scrollTop: $contents.find( "." + section_class ).offset().top - 30
		    }, 1000);

		}

		//console.log("a");
		//console.log( wp.customize.control( 'crafter_quote' ).section() );

		/*
		 * Make Front Page Sections Sortable
		 */
		var $front_page_sections = $("#accordion-panel-crafter_front_page_sections > .accordion-sub-container");
		var sort_text = '<div class="sortable-sections-desc description customize-section-description">' + wp_customizer_admin.sortable_text + '</div>';
		$front_page_sections.append(sort_text);
		$front_page_sections.sortable({
			helper: "clone",
			items: "> li.control-section"
		});
		$front_page_sections.on( "sortupdate", function( event, ui ) {
			$front_page_sections.find('.sortable-sections-desc').prepend('<img src="' + wp_customizer_admin.admin_url + '/images/wpspin_light.gif" /> ');
			var items_ar = $front_page_sections.sortable( "toArray" );
			for(var i=0; i < items_ar.length; i++) {
				items_ar[i] = items_ar[i].replace('accordion-section-','');
			}
			$.ajax({
				url: wp_customizer_admin.ajax_url,
				type: 'post',
				dataType: 'json',
				data: {
					action : 'crafter_save_sortable',
					items: items_ar
				},
			})
			.done(function(data) {
				$front_page_sections.find('.sortable-sections-desc img').remove();
				wp.customize.previewer.refresh()
			});
			
		} );


		/*
		 * Links to different sections in the Customizer
		 * Just create a link like this: <a href="#" data-section="section-id">link</a>
		 */
		$('body').on('click', 'a[data-section]', function(event) {
			wp.customize.section( $(this).attr( 'data-section' ) ).focus();
		});

	} )( jQuery );
});

