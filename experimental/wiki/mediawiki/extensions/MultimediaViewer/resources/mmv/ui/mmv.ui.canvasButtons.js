/*
 * This file is part of the MediaWiki extension MultimediaViewer.
 *
 * MultimediaViewer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * MultimediaViewer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MultimediaViewer.  If not, see <http://www.gnu.org/licenses/>.
 */

( function ( mw, $, oo ) {
	var CBP;

	/**
	 * Represents the buttons which are displayed over the image - next, previous, close
	 * and fullscreen.
	 * @class mw.mmv.ui.CanvasButtons
	 * @extends mw.mmv.ui.Element
	 * @constructor
	 * @param {jQuery} $container The parent element we should put the buttons into.
	 * @param {jQuery} $closeButton The close button element from the parent class.
	 * @param {jQuery} $fullscreenButton The fullscreen button from the parent class.
	 */
	function CanvasButtons( $container, $closeButton, $fullscreenButton ) {
		var buttons = this,
			tooltipDelay = mw.config.get( 'wgMultimediaViewer' ).tooltipDelay;

		mw.mmv.ui.Element.call( this, $container );

		this.$close = $closeButton;
		this.$fullscreen = $fullscreenButton;

		this.$reuse = $( '<div>' )
			.addClass( 'mw-mmv-reuse-button' )
			.html( '&nbsp;' )
			.prop( 'title', mw.message( 'multimediaviewer-reuse-link' ).text() )
			.tipsy( {
				delayIn: tooltipDelay,
				gravity: this.correctEW( 'se' )
			} );

		this.$options = $( '<div>' )
			.text( ' ' )
			.prop( 'title', mw.message( 'multimediaviewer-options-tooltip' ).text() )
			.addClass( 'mw-mmv-options-button' )
			.tipsy( {
				delayIn: tooltipDelay,
				gravity: this.correctEW( 'se' )
			} );

		this.$download = $( '<div>' )
			.addClass( 'mw-mmv-download-button' )
			.html( '&nbsp;' )
			.prop( 'title', mw.message( 'multimediaviewer-download-link' ).text() )
			.tipsy( {
				delayIn: tooltipDelay,
				gravity: this.correctEW( 'se' )
			} );

		this.$next = $( '<div>' )
			.addClass( 'mw-mmv-next-image disabled' )
			.html( '&nbsp;' );

		this.$prev = $( '<div>' )
			.addClass( 'mw-mmv-prev-image disabled' )
			.html( '&nbsp;' );

		this.$nav = this.$next
			.add( this.$prev );

		this.$buttons = this.$close
			.add( this.$download )
			.add( this.$reuse )
			.add( this.$fullscreen )
			.add( this.$options )
			.add( this.$next )
			.add( this.$prev );

		this.$buttons.appendTo( this.$container );

		$( document ).on( 'mmv-close', function () {
			buttons.$nav.addClass( 'disabled' );
		} );

		this.$close.click( function () {
			$container.trigger( $.Event( 'mmv-close' ) );
		} );

		this.$next.click( function () {
			buttons.emit( 'next' );
		} );

		this.$prev.click( function () {
			buttons.emit( 'prev' );
		} );
	}
	oo.inheritClass( CanvasButtons, mw.mmv.ui.Element );
	CBP = CanvasButtons.prototype;

	/**
	 * Sets the top offset for the navigation buttons.
	 * @param {number} offset
	 */
	CBP.setOffset = function ( offset ) {
		this.$nav.css( {
			top: offset
		} );
	};

	/**
	 * Stops the fading animation of the buttons and cancel any opacity value
	 */
	CBP.stopFade = function () {
		this.$buttons
			.stop( true )
			.removeClass( 'hidden' )
			.css( 'opacity', '' );

		this.$container.trigger( $.Event( 'mmv-fade-stopped' ) );
	};

	/**
	 * Toggles buttons being disabled or not
	 * @param {boolean} showPrevButton
	 * @param {boolean} showNextButton
	 */
	CBP.toggle = function ( showPrevButton, showNextButton ) {
		this.$next.toggleClass( 'disabled', !showPrevButton );
		this.$prev.toggleClass( 'disabled', !showNextButton );
	};

	/**
	 * Fades out the active buttons
	 */
	CBP.fadeOut = function () {
		var buttons = this;

		// We don't use animation chaining because delay() can't be stop()ed
		this.buttonsFadeTimeout = setTimeout( function () {
			buttons.$buttons.not( '.disabled' ).animate( { opacity: 0 }, 1000, 'swing',
				function () {
					buttons.$buttons.addClass( 'hidden' );
					buttons.$container.trigger( $.Event( 'mmv-faded-out' ) );
				} );
		}, 1500 );
	};

	/**
	 * Checks if any active buttons are currently hovered, given a position
	 * @param {number} x The horizontal coordinate of the position
	 * @param {number} y The vertical coordinate of the position
	 * @return bool
	 */
	CBP.isAnyActiveButtonHovered = function ( x, y ) {
		// We don't use mouseenter/mouseleave events because content is subject
		// to change underneath the cursor, eg. when entering fullscreen or
		// when going prev/next (the button can disappear when reaching ends)
		var hovered = false;

		this.$buttons.not( '.disabled' ).each( function ( idx, e ) {
			var $e = $( e ),
				offset = $e.offset();

			if ( y >= offset.top
				&& y <= offset.top + $e.height()
				&& x >= offset.left
				&& x <= offset.left + $e.width() ) {
				hovered = true;
			}
		} );

		return hovered;
	};

	/**
	 * Reveals all active buttons and schedule a fade out if needed
	 */
	CBP.revealAndFade = function ( mousePosition ) {
		if ( this.buttonsFadeTimeout ) {
			clearTimeout( this.buttonsFadeTimeout );
		}

		// Stop ongoing animations and make sure the buttons that need to be displayed are displayed
		this.stopFade();

		// mousePosition can be empty, for instance when we enter fullscreen and haven't
		// recorded a real mousemove event yet
		if ( !mousePosition
			|| !this.isAnyActiveButtonHovered( mousePosition.x, mousePosition.y ) ) {
			this.fadeOut();
		}
	};

	/**
	 * @event mmv-reuse-open
	 * Fired when the button to open the reuse dialog is clicked.
	 */
	/**
	 * Registers listeners.
	 */
	CBP.attach = function () {
		var buttons = this;

		this.$reuse.on( 'click.mmv-canvasButtons', function ( e ) {
			$( document ).trigger( 'mmv-reuse-open', e );
			e.stopPropagation(); // the dialog would take it as an outside click and close
		} );
		this.handleEvent( 'mmv-reuse-opened', function () {
			buttons.$reuse.addClass( 'open' );
		} );
		this.handleEvent( 'mmv-reuse-closed', function () {
			buttons.$reuse.removeClass( 'open' );
		} );

		this.$download.on( 'click.mmv-canvasButtons', function ( e ) {
			$( document ).trigger( 'mmv-download-open', e );
			e.stopPropagation();
		} );
		this.handleEvent( 'mmv-download-opened', function () {
			buttons.$download.addClass( 'open' );
		} );
		this.handleEvent( 'mmv-download-closed', function () {
			buttons.$download.removeClass( 'open' );
		} );

		this.$options.on( 'click.mmv-canvasButtons', function ( e ) {
			$( document ).trigger( 'mmv-options-open', e );
			e.stopPropagation();
		} );
		this.handleEvent( 'mmv-options-opened', function () {
			buttons.$options.addClass( 'open' );
		} );
		this.handleEvent( 'mmv-options-closed', function () {
			buttons.$options.removeClass( 'open' );
		} );

		this.$download
			.add( this.$reuse )
			.add( this.$options )
			.add( this.$close )
			.add( this.$fullscreen )
			.each( function () {
				$( this ).tipsy( 'enable' );
			} );
	};

	/**
	 * Removes all UI things from the DOM, or hides them
	 */
	CBP.unattach = function () {
		this.$download
			.add( this.$reuse )
			.add( this.$options )
			.add( this.$close )
			.add( this.$fullscreen )
			.off( 'click.mmv-canvasButtons' )
			.each( function () {
				$( this ).tipsy( 'hide' ).tipsy( 'disable' );
			} );
	};

	CBP.empty = function () {
		this.$reuse.removeClass( 'open' );
	};

	mw.mmv.ui.CanvasButtons = CanvasButtons;
}( mediaWiki, jQuery, OO ) );
