/* Back-to-top button and reading progress bar; loaded only when one of them is turned on. */
( function () {
    'use strict';

    var button = document.querySelector( '.blogito-back-to-top' );
    var bar = document.querySelector( '.blogito-progress-bar' );
    var skipLink = document.querySelector( '.skip-link' );
    var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' );
    var ticking = false;

    var update = function () {
	var top = window.pageYOffset || document.documentElement.scrollTop;
	var max = document.documentElement.scrollHeight - window.innerHeight;

	if ( button ) {
	    button.hidden = top < 600;
	}

	if ( bar ) {
	    bar.style.transform = 'scaleX(' + ( max > 0 ? Math.min( top / max, 1 ) : 0 ) + ')';
	}

	ticking = false;
    };

    var requestUpdate = function () {
	if ( ! ticking ) {
	    ticking = true;
	    window.requestAnimationFrame( update );
	}
    };

    if ( button ) {
	button.addEventListener( 'click', function ( e ) {
	    if ( reduceMotion && reduceMotion.matches ) {
		window.scrollTo( 0, 0 );
	    } else {
		window.scrollTo( { top: 0, behavior: 'smooth' } );
	    }

	    // Keyboard activation (no pointer detail) moves focus to the top of the page.
	    if ( e.detail === 0 && skipLink ) {
		skipLink.focus( { preventScroll: true } );
	    }
	} );
    }

    window.addEventListener( 'scroll', requestUpdate, { passive: true } );
    window.addEventListener( 'resize', requestUpdate );
    update();
} )();
