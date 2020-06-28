// ======================================================================= Namespace
var davis = davis || {},
	$ = jQuery;


// =======================================================================  Menu
davis.menu = {

	init: function() {

		// Make sub menus accessible via keyboard navigation
		davis.menu.focusableSubMenus();

	},

	focusableSubMenus: function() {

		$( '.menu a' ).on( 'focus', function() {
			if ( $( this ).parent( 'li' ).hasClass( 'menu-item-has-children' ) ) {
				$( this ).next( 'ul' ).addClass( 'focusable' );
			} else {
				$( this ).closest( 'ul' ).find( 'ul' ).removeClass( 'focusable' );
			}
		} );

	},

} // davis.menu


// =======================================================================  Resize videos
davis.intrinsicRatioEmbeds = {

	init: function() {

		// Resize videos after their container
		var vidSelector = 'iframe, object, video';
		var resizeVideo = function( sSel ) {
			$( sSel ).each( function() {
				var $video = $( this ),
					$container = $video.parent(),
					iTargetWidth = $container.width();

				if ( ! $video.attr( 'data-origwidth' ) ) {
					$video.attr( 'data-origwidth', $video.attr( 'width' ) );
					$video.attr( 'data-origheight', $video.attr( 'height' ) );
				}

				var ratio = iTargetWidth / $video.attr( 'data-origwidth' );

				$video.css( 'width', iTargetWidth + 'px' );
				$video.css( 'height', ( $video.attr( 'data-origheight' ) * ratio ) + 'px' );
			});
		};

		resizeVideo( vidSelector );

		$( window ).resize( function() {
			resizeVideo( vidSelector );
		} );

	},

} // davis.intrinsicRatioEmbeds


// ======================================================================= Dark Mode Load
jQuery(function($) {
    $('.wpnm-button').click(function() {
        //Show either moon or sun
        $('.wpnm-button').toggleClass('active');
        //If dark mode is selected
        if ($('.wpnm-button').hasClass('active')) {
			//Add dark mode class to the body
			document.documentElement.setAttribute('data-theme', 'dark');
			//Save user preference to Storage
			localStorage.setItem('darkMode', true);
        } else {
            document.documentElement.removeAttribute('data-theme');
            localStorage.removeItem('darkMode');
        }
    })
    //Check Storage. Display user preference 
    if (localStorage.getItem("darkMode")) {
        document.documentElement.setAttribute('data-theme', 'dark');
        $('.wpnm-button').addClass('active');
    }
})

// ======================================================================= Function calls
$( document ).ready( function( ) {
	davis.menu.init();						// Menus
	davis.intrinsicRatioEmbeds.init();		// Embed resizing
} );