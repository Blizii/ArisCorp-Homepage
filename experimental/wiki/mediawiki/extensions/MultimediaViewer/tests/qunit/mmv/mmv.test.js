( function ( mw, $ ) {
	QUnit.module( 'mmv', QUnit.newMwEnvironment() );

	QUnit.test( 'eachPrealoadableLightboxIndex()', 11, function ( assert ) {
		var viewer = new mw.mmv.MultimediaViewer( { get: $.noop } ),
			expectedIndices,
			i;

		viewer.preloadDistance = 3;
		viewer.thumbs = [];

		// 0..10
		for ( i = 0; i < 11; i++ ) {
			viewer.thumbs.push( { image: false } );
		}

		viewer.currentIndex = 2;
		i = 0;
		expectedIndices = [2, 3, 1, 4, 0, 5];
		viewer.eachPrealoadableLightboxIndex( function ( index ) {
			assert.strictEqual( index, expectedIndices[i++], 'preload on left edge' );
		} );

		viewer.currentIndex = 9;
		i = 0;
		expectedIndices = [9, 10, 8, 7, 6];
		viewer.eachPrealoadableLightboxIndex( function ( index ) {
			assert.strictEqual( index, expectedIndices[i++], 'preload on right edge' );
		} );
	} );

	QUnit.test( 'Hash handling', 8, function ( assert ) {
		var oldUnattach,
			viewer = new mw.mmv.MultimediaViewer( { get: $.noop } ),
			ui = new mw.mmv.LightboxInterface(),
			imageSrc = 'Foo bar.jpg',
			image = { filePageTitle: new mw.Title( 'File:' + imageSrc ) };

		// animation would keep running, conflict with other tests
		this.sandbox.stub( $.fn, 'animate' ).returnsThis();

		window.location.hash = '';

		viewer.setupEventHandlers();
		oldUnattach = ui.unattach;

		ui.unattach = function () {
			assert.ok( true, 'Lightbox was unattached' );
			oldUnattach.call( this );
		};

		viewer.ui = ui;
		viewer.close();

		assert.ok( !viewer.isOpen, 'Viewer is closed' );

		viewer.isOpen = true;

		// Verify that passing an invalid mmv hash when the mmv is open triggers unattach()
		window.location.hash = 'Foo';
		viewer.hash();

		// Verify that mmv doesn't reset a foreign hash
		assert.strictEqual( window.location.hash, '#Foo', 'Foreign hash remains intact' );
		assert.ok( !viewer.isOpen, 'Viewer is closed' );

		ui.unattach = function () {
			assert.ok( false, 'Lightbox was not unattached' );
			oldUnattach.call( this );
		};

		// Verify that passing an invalid mmv hash when the mmv is closed doesn't trigger unattach()
		window.location.hash = 'Bar';
		viewer.hash();

		// Verify that mmv doesn't reset a foreign hash
		assert.strictEqual( window.location.hash, '#Bar', 'Foreign hash remains intact' );

		viewer.ui = { images: [ image ], disconnect: $.noop };

		$( '#qunit-fixture' ).append( '<a class="image"><img src="' + imageSrc + '"></a>' );

		viewer.loadImageByTitle = function ( title ) {
			assert.strictEqual( title.getPrefixedText(), 'File:' + imageSrc, 'The title matches' );
		};

		// Open a valid mmv hash link and check that the right image is requested.
		// imageSrc contains a space without any encoding on purpose
		window.location.hash = '/media/File:' + imageSrc;
		viewer.hash();

		// Reset the hash, because for some browsers switching from the non-URI-encoded to
		// the non-URI-encoded version of the same text with a space will not trigger a hash change
		window.location.hash = '';
		viewer.hash();

		// Try again with an URI-encoded imageSrc containing a space
		window.location.hash = '/media/File:' + encodeURIComponent( imageSrc );
		viewer.hash();

		// Reset the hash
		window.location.hash = '';
		viewer.hash();

		// Try again with a legacy hash
		window.location.hash = 'mediaviewer/File:' + imageSrc;
		viewer.hash();

		viewer.cleanupEventHandlers();

		window.location.hash = '';
	} );

	QUnit.test( 'Progress', 4, function ( assert ) {
		var imageDeferred = $.Deferred(),
			viewer = new mw.mmv.MultimediaViewer( { get: $.noop } ),
			fakeImage = {
				filePageTitle: new mw.Title( 'File:Stuff.jpg' ),
				extraStatsDeferred: $.Deferred().reject()
			};

		viewer.thumbs = [];
		viewer.displayPlaceholderThumbnail = $.noop;
		viewer.setImage = $.noop;
		viewer.scroll = $.noop;
		viewer.preloadFullscreenThumbnail = $.noop;
		viewer.fetchSizeIndependentLightboxInfo = function () { return $.Deferred().resolve( {} ); };
		viewer.ui = {
			setFileReuseData: $.noop,
			setupForLoad: $.noop,
			canvas: { set: $.noop,
				unblurWithAnimation: $.noop,
				unblur: $.noop,
				getCurrentImageWidths: function () { return { real: 0 }; },
				getDimensions: function () { return {}; }
			},
			panel: {
				setImageInfo: $.noop,
				scroller: {
					animateMetadataOnce: $.noop
				},
				progressBar: {
					animateTo: this.sandbox.stub(),
					jumpTo: this.sandbox.stub()
				}
			},
			open: $.noop };

		viewer.imageProvider.get = function () { return imageDeferred.promise(); };
		viewer.imageInfoProvider.get = function () { return $.Deferred().resolve( {} ); };
		viewer.thumbnailInfoProvider.get = function () { return $.Deferred().resolve( {} ); };

		viewer.loadImage( fakeImage, new Image() );
		assert.ok( viewer.ui.panel.progressBar.jumpTo.lastCall.calledWith( 0 ),
			'Percentage correctly reset by loadImage' );

		assert.ok( viewer.ui.panel.progressBar.animateTo.lastCall.calledWith( 5 ),
			'Percentage correctly animated to 5 by loadImage' );

		imageDeferred.notify( 'response', 45 );
		assert.ok( viewer.ui.panel.progressBar.animateTo.lastCall.calledWith( 45 ),
			'Percentage correctly funneled to panel UI' );

		imageDeferred.resolve( {}, {} );
		assert.ok( viewer.ui.panel.progressBar.animateTo.lastCall.calledWith( 100 ),
			'Percentage correctly funneled to panel UI' );

		viewer.close();
	} );

	QUnit.test( 'Progress when switching images', 11, function ( assert ) {
		var firstImageDeferred = $.Deferred(),
			secondImageDeferred = $.Deferred(),
			firstImage = {
				index: 1,
				filePageTitle: new mw.Title( 'File:First.jpg' ),
				extraStatsDeferred: $.Deferred().reject()
			},
			secondImage = {
				index: 2,
				filePageTitle: new mw.Title( 'File:Second.jpg' ),
				extraStatsDeferred: $.Deferred().reject()
			},
			viewer = new mw.mmv.MultimediaViewer( { get: $.noop } );

		// animation would keep running, conflict with other tests
		this.sandbox.stub( $.fn, 'animate' ).returnsThis();

		viewer.thumbs = [];
		viewer.displayPlaceholderThumbnail = $.noop;
		viewer.setImage = $.noop;
		viewer.scroll = $.noop;
		viewer.preloadFullscreenThumbnail = $.noop;
		viewer.preloadImagesMetadata = $.noop;
		viewer.preloadThumbnails = $.noop;
		viewer.fetchSizeIndependentLightboxInfo = function () { return $.Deferred().resolve( {} ); };
		viewer.ui = {
			setFileReuseData: $.noop,
			setupForLoad: $.noop,
			canvas: { set: $.noop,
				unblurWithAnimation: $.noop,
				unblur: $.noop,
				getCurrentImageWidths: function () { return { real: 0 }; },
				getDimensions: function () { return {}; }
			},
			panel: {
				setImageInfo: $.noop,
				scroller: {
					animateMetadataOnce: $.noop
				},
				progressBar: {
					hide: this.sandbox.stub(),
					animateTo: this.sandbox.stub(),
					jumpTo: this.sandbox.stub()
				}
			},
			open: $.noop,
			empty: $.noop };

		viewer.imageInfoProvider.get = function () { return $.Deferred().resolve( {} ); };
		viewer.thumbnailInfoProvider.get = function () { return $.Deferred().resolve( {} ); };

		// load some image
		viewer.imageProvider.get = this.sandbox.stub().returns( firstImageDeferred );
		viewer.loadImage( firstImage, new Image() );

		assert.ok( viewer.ui.panel.progressBar.jumpTo.lastCall.calledWith( 0 ),
			'Percentage correctly reset for new first image' );
		assert.ok( viewer.ui.panel.progressBar.animateTo.lastCall.calledWith( 5 ),
			'Percentage correctly animated to 5 for first new image' );

		firstImageDeferred.notify( 'response', 20 );

		assert.ok( viewer.ui.panel.progressBar.animateTo.lastCall.calledWith( 20 ),
			'Percentage correctly animated when active image is loading' );

		// change to another image
		viewer.imageProvider.get = this.sandbox.stub().returns( secondImageDeferred );
		viewer.loadImage( secondImage, new Image() );

		assert.ok( viewer.ui.panel.progressBar.jumpTo.lastCall.calledWith( 0 ),
			'Percentage correctly reset for second new image' );
		assert.ok( viewer.ui.panel.progressBar.animateTo.lastCall.calledWith( 5 ),
			'Percentage correctly animated to 5 for second new image' );

		secondImageDeferred.notify( 'response', 30 );

		assert.ok( viewer.ui.panel.progressBar.animateTo.lastCall.calledWith( 30 ),
			'Percentage correctly animated when active image is loading' );

		// this is the most convenient way of checking for new calls - just reset() and check called
		viewer.ui.panel.progressBar.animateTo.reset();
		viewer.ui.panel.progressBar.jumpTo.reset();

		firstImageDeferred.notify( 'response', 40 );

		assert.ok( !viewer.ui.panel.progressBar.animateTo.called,
			'Percentage not animated when inactive image is loading' );
		assert.ok( !viewer.ui.panel.progressBar.jumpTo.called,
			'Percentage not changed when inactive image is loading' );

		secondImageDeferred.notify( 'response', 50 );

		// change back to first image
		viewer.loadImage( firstImage, new Image() );

		assert.ok( viewer.ui.panel.progressBar.jumpTo.lastCall.calledWith( 40 ),
			'Percentage jumps to right value when changing images' );

		secondImageDeferred.resolve( {}, {} );
		assert.ok( !viewer.ui.panel.progressBar.hide.called,
			'Progress bar not hidden when something finishes in the background' );

		// change to second image which has finished loading
		viewer.imageProvider.get = this.sandbox.stub().returns( secondImageDeferred );
		viewer.loadImage( secondImage, new Image() );

		assert.ok( viewer.ui.panel.progressBar.hide.called,
			'Progress bar not hidden when switching to finished image' );

		viewer.close();
	} );

	QUnit.test( 'resetBlurredThumbnailStates', 4, function ( assert ) {
		var viewer = new mw.mmv.MultimediaViewer( { get: $.noop } );

		// animation would keep running, conflict with other tests
		this.sandbox.stub( $.fn, 'animate' ).returnsThis();

		assert.ok( !viewer.realThumbnailShown, 'Real thumbnail state is correct' );
		assert.ok( !viewer.blurredThumbnailShown, 'Placeholder state is correct' );

		viewer.realThumbnailShown = true;
		viewer.blurredThumbnailShown = true;

		viewer.resetBlurredThumbnailStates();

		assert.ok( !viewer.realThumbnailShown, 'Real thumbnail state is correct' );
		assert.ok( !viewer.blurredThumbnailShown, 'Placeholder state is correct' );
	} );

	QUnit.test( 'Placeholder first, then real thumbnail', 4, function ( assert ) {
		var viewer = new mw.mmv.MultimediaViewer( { get: $.noop } );

		viewer.setImage = $.noop;
		viewer.ui = { canvas: {
			unblurWithAnimation: $.noop,
			unblur: $.noop,
			maybeDisplayPlaceholder: function () { return true; }
		} };
		viewer.imageInfoProvider.get = this.sandbox.stub();

		viewer.displayPlaceholderThumbnail( { originalWidth: 100, originalHeight: 100 }, undefined, undefined );

		assert.ok( viewer.blurredThumbnailShown, 'Placeholder state is correct' );
		assert.ok( !viewer.realThumbnailShown, 'Real thumbnail state is correct' );

		viewer.displayRealThumbnail( { url: undefined } );

		assert.ok( viewer.realThumbnailShown, 'Real thumbnail state is correct' );
		assert.ok( viewer.blurredThumbnailShown, 'Placeholder state is correct' );
	} );

	QUnit.test( 'Placeholder first, then real thumbnail - missing size', 4, function ( assert ) {
		var viewer = new mw.mmv.MultimediaViewer( { get: $.noop } );

		viewer.currentIndex = 1;
		viewer.setImage = $.noop;
		viewer.ui = { canvas: {
			unblurWithAnimation: $.noop,
			unblur: $.noop,
			maybeDisplayPlaceholder: function () { return true; }
		} };
		viewer.imageInfoProvider.get = this.sandbox.stub().returns( $.Deferred().resolve( { width: 100, height: 100 } ) );

		viewer.displayPlaceholderThumbnail( { index: 1 }, undefined, undefined );

		assert.ok( viewer.blurredThumbnailShown, 'Placeholder state is correct' );
		assert.ok( !viewer.realThumbnailShown, 'Real thumbnail state is correct' );

		viewer.displayRealThumbnail( { url: undefined } );

		assert.ok( viewer.realThumbnailShown, 'Real thumbnail state is correct' );
		assert.ok( viewer.blurredThumbnailShown, 'Placeholder state is correct' );
	} );

	QUnit.test( 'Real thumbnail first, then placeholder', 4, function ( assert ) {
		var viewer = new mw.mmv.MultimediaViewer( { get: $.noop } );

		viewer.setImage = $.noop;
		viewer.ui = {
			showImage: $.noop,
			canvas: {
				unblurWithAnimation: $.noop,
				unblur: $.noop
		} };

		viewer.displayRealThumbnail( { url: undefined } );

		assert.ok( viewer.realThumbnailShown, 'Real thumbnail state is correct' );
		assert.ok( !viewer.blurredThumbnailShown, 'Placeholder state is correct' );

		viewer.displayPlaceholderThumbnail( {}, undefined, undefined );

		assert.ok( viewer.realThumbnailShown, 'Real thumbnail state is correct' );
		assert.ok( !viewer.blurredThumbnailShown, 'Placeholder state is correct' );
	} );

	QUnit.test( 'displayRealThumbnail', 2, function ( assert ) {
		var viewer = new mw.mmv.MultimediaViewer( { get: $.noop } );

		viewer.setImage = $.noop;
		viewer.ui = { canvas: {
			unblurWithAnimation: this.sandbox.stub(),
			unblur: $.noop
		} };
		viewer.blurredThumbnailShown = true;

		// Should not result in an unblurWithAnimation animation (image cache from cache)
		viewer.displayRealThumbnail( { url: undefined }, undefined, undefined, 5 );
		assert.ok( !viewer.ui.canvas.unblurWithAnimation.called, 'There should not be an unblurWithAnimation animation' );

		// Should result in an unblurWithAnimation (image didn't come from cache)
		viewer.displayRealThumbnail( { url: undefined }, undefined, undefined, 1000 );
		assert.ok( viewer.ui.canvas.unblurWithAnimation.called, 'There should be an unblurWithAnimation animation' );
	} );

	QUnit.test( 'New image loaded while another one is loading', 5, function ( assert ) {
		var viewer = new mw.mmv.MultimediaViewer( { get: $.noop } ),
			firstImageDeferred = $.Deferred(),
			secondImageDeferred = $.Deferred(),
			firstLigthboxInfoDeferred = $.Deferred(),
			secondLigthboxInfoDeferred = $.Deferred(),
			firstImage = {
				filePageTitle: new mw.Title( 'File:Foo.jpg' ),
				index: 0,
				extraStatsDeferred: $.Deferred().reject()
			},
			secondImage = {
				filePageTitle: new mw.Title( 'File:Bar.jpg' ),
				index: 1,
				extraStatsDeferred: $.Deferred().reject()
			};

		viewer.preloadFullscreenThumbnail = $.noop;
		viewer.fetchSizeIndependentLightboxInfo = this.sandbox.stub();
		viewer.ui = {
			setFileReuseData: $.noop,
			setupForLoad: $.noop,
			canvas: {
				set: $.noop,
				getCurrentImageWidths: function () { return { real: 0 }; },
				getDimensions: function () { return {}; }
			},
			panel: {
				setImageInfo: this.sandbox.stub(),
				scroller: {
					animateMetadataOnce: $.noop
				},
				progressBar: {
					animateTo: this.sandbox.stub(),
					jumpTo: this.sandbox.stub()
				},
				empty: $.noop
			},
			open: $.noop,
			empty: $.noop };
		viewer.displayRealThumbnail = this.sandbox.stub();
		viewer.eachPrealoadableLightboxIndex = $.noop;
		viewer.animateMetadataDivOnce = this.sandbox.stub().returns( $.Deferred().reject() );
		viewer.imageProvider.get = this.sandbox.stub();
		viewer.imageInfoProvider.get = function () { return $.Deferred().reject(); };
		viewer.thumbnailInfoProvider.get = function () { return $.Deferred().resolve( {} ); };

		viewer.imageProvider.get.returns( firstImageDeferred.promise() );
		viewer.fetchSizeIndependentLightboxInfo.returns( firstLigthboxInfoDeferred.promise() );
		viewer.loadImage( firstImage, new Image() );
		assert.ok( !viewer.animateMetadataDivOnce.called, 'Metadata of the first image should not be animated' );
		assert.ok( !viewer.ui.panel.setImageInfo.called, 'Metadata of the first image should not be shown' );

		viewer.imageProvider.get.returns( secondImageDeferred.promise() );
		viewer.fetchSizeIndependentLightboxInfo.returns( secondLigthboxInfoDeferred.promise() );
		viewer.loadImage( secondImage, new Image() );

		viewer.ui.panel.progressBar.animateTo.reset();
		firstImageDeferred.notify( undefined, 45 );
		assert.ok( !viewer.ui.panel.progressBar.animateTo.reset.called, 'Progress of the first image should not be shown' );

		firstImageDeferred.resolve( {}, {} );
		firstLigthboxInfoDeferred.resolve( {} );
		assert.ok( !viewer.displayRealThumbnail.called, 'The first image being done loading should have no effect' );

		viewer.displayRealThumbnail = this.sandbox.spy( function () { viewer.close(); } );
		secondImageDeferred.resolve( {}, {} );
		secondLigthboxInfoDeferred.resolve( {} );
		assert.ok( viewer.displayRealThumbnail.called, 'The second image being done loading should result in the image being shown' );
	} );

	QUnit.test( 'Events are not trapped after the viewer is closed', 0, function ( assert ) {
		var i, j, k, eventParameters,
			viewer = new mw.mmv.MultimediaViewer( { get: $.noop } ),
			$document = $( document ),
			$qf = $( '#qunit-fixture' ),
			eventTypes = [ 'keydown', 'keyup', 'keypress', 'click', 'mousedown', 'mouseup' ],
			modifiers = [ undefined, 'altKey', 'ctrlKey', 'shiftKey', 'metaKey' ],
			oldScrollTo = $.scrollTo;

		// animation would keep running, conflict with other tests
		this.sandbox.stub( $.fn, 'animate' ).returnsThis();

		$.scrollTo = function () { return { scrollTop: $.noop, on: $.noop, off: $.noop }; };

		viewer.setupEventHandlers();

		viewer.imageProvider.get = function () { return $.Deferred().reject(); };
		viewer.imageInfoProvider.get = function () { return $.Deferred().reject(); };
		viewer.thumbnailInfoProvider.get = function () { return $.Deferred().reject(); };
		viewer.fileRepoInfoProvider.get = function () { return $.Deferred().reject(); };

		viewer.preloadFullscreenThumbnail = $.noop;
		viewer.initWithThumbs( [] );

		viewer.loadImage( { filePageTitle: new mw.Title( 'File:Stuff.jpg' ),
			thumbnail: new mw.mmv.model.Thumbnail( 'foo', 10, 10 ),
			extraStatsDeferred: $.Deferred().reject() },
			new Image() );

		viewer.ui.$closeButton.click();

		function eventHandler ( e ) {
			if ( e.isDefaultPrevented() ) {
				assert.ok( false, 'Event was incorrectly trapped: ' + e.which );
			}

			e.preventDefault();

			// Wait for the last event
			if ( e.which === 32 && e.type === 'mouseup' ) {
				QUnit.start();
				$document.off( '.mmvtest' );
				viewer.cleanupEventHandlers();
				$.scrollTo = oldScrollTo;
			}
		}

		// Events are async, we need to wait for the last event to be caught before ending the test
		QUnit.stop();

		for ( j = 0; j < eventTypes.length; j++ ) {
			$document.on( eventTypes[ j ] + '.mmvtest', eventHandler );

		eventloop:
			for ( i = 0; i < 256; i++ ) {
				// Save some time by not testing unlikely values for mouse events
				if ( i > 32 ) {
					switch ( eventTypes[ j ] ) {
						case 'click':
						case 'mousedown':
						case 'mouseup':
							break eventloop;
					}
				}

				for ( k = 0; k < modifiers.length; k++ ) {
					eventParameters = { which: i };
					if ( modifiers[ k ] !== undefined ) {
						eventParameters[ modifiers[ k ] ] = true;
					}
					$qf.trigger( $.Event( eventTypes[ j ], eventParameters ) );
				}
			}
		}
	} );

	QUnit.test( 'Refuse to load too-big thumbnails', 1, function ( assert ) {
		var viewer = new mw.mmv.MultimediaViewer( { get: $.noop } ),
			intendedWidth = 50,
			title = mw.Title.newFromText( 'File:Foobar.svg' );

		viewer.thumbnailInfoProvider.get = function ( fileTitle, width ) {
			assert.strictEqual( width, intendedWidth );
			return $.Deferred().reject();
		};

		viewer.fetchThumbnail( title, 1000, null, intendedWidth, 60 );
	} );

	QUnit.test( 'fetchThumbnail()', 32, function ( assert ) {
		var guessedThumbnailInfoStub,
			thumbnailInfoStub,
			imageStub,
			promise,
			viewer = new mw.mmv.MultimediaViewer( { get: $.noop } ),
			sandbox = this.sandbox,
			oldUseThumbnailGuessing = mw.config.get( 'wgMultimediaViewer' ).useThumbnailGuessing,
			file = new mw.Title( 'File:Copyleft.svg' ),
			sampleURL = 'http://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Copyleft.svg/300px-Copyleft.svg.png',
			width = 100,
			originalWidth = 1000,
			originalHeight = 1000,
			image = {};

		function setupStubs() {
			guessedThumbnailInfoStub = viewer.guessedThumbnailInfoProvider.get = sandbox.stub();
			thumbnailInfoStub = viewer.thumbnailInfoProvider.get = sandbox.stub();
			imageStub = viewer.imageProvider.get = sandbox.stub();
		}

		mw.config.get( 'wgMultimediaViewer' ).useThumbnailGuessing = true;

		// When we lack sample URL and original dimensions, the classic provider should be used
		setupStubs();
		guessedThumbnailInfoStub.returns( $.Deferred().resolve( { url: 'guessedURL' } ) );
		thumbnailInfoStub.returns( $.Deferred().resolve( { url: 'apiURL' } ) );
		imageStub.returns( $.Deferred().resolve( image ) );
		promise = viewer.fetchThumbnail( file, width );
		assert.ok( !guessedThumbnailInfoStub.called, 'When we lack sample URL and original dimensions, GuessedThumbnailInfoProvider is not called' );
		assert.ok( thumbnailInfoStub.calledOnce, 'When we lack sample URL and original dimensions, ThumbnailInfoProvider is called once' );
		assert.ok( imageStub.calledOnce, 'When we lack sample URL and original dimensions, ImageProvider is called once' );
		assert.ok( imageStub.calledWith( 'apiURL' ), 'When we lack sample URL and original dimensions, ImageProvider is called with the API url' );
		assert.strictEqual( promise.state(), 'resolved', 'When we lack sample URL and original dimensions, fetchThumbnail resolves' );

		// When the guesser bails out, the classic provider should be used
		setupStubs();
		guessedThumbnailInfoStub.returns( $.Deferred().reject() );
		thumbnailInfoStub.returns( $.Deferred().resolve( { url: 'apiURL' } ) );
		imageStub.returns( $.Deferred().resolve( image ) );
		promise = viewer.fetchThumbnail( file, width, sampleURL, originalWidth, originalHeight );
		assert.ok( guessedThumbnailInfoStub.calledOnce, 'When the guesser bails out, GuessedThumbnailInfoProvider is called once' );
		assert.ok( thumbnailInfoStub.calledOnce, 'When the guesser bails out, ThumbnailInfoProvider is called once' );
		assert.ok( imageStub.calledOnce, 'When the guesser bails out, ImageProvider is called once' );
		assert.ok( imageStub.calledWith( 'apiURL' ), 'When the guesser bails out, ImageProvider is called with the API url' );
		assert.strictEqual( promise.state(), 'resolved', 'When the guesser bails out, fetchThumbnail resolves' );

		// When the guesser returns an URL, that should be used
		setupStubs();
		guessedThumbnailInfoStub.returns( $.Deferred().resolve( { url: 'guessedURL' } ) );
		thumbnailInfoStub.returns( $.Deferred().resolve( { url: 'apiURL' } ) );
		imageStub.returns( $.Deferred().resolve( image ) );
		promise = viewer.fetchThumbnail( file, width, sampleURL, originalWidth, originalHeight );
		assert.ok( guessedThumbnailInfoStub.calledOnce, 'When the guesser returns an URL, GuessedThumbnailInfoProvider is called once' );
		assert.ok( !thumbnailInfoStub.called, 'When the guesser returns an URL, ThumbnailInfoProvider is not called' );
		assert.ok( imageStub.calledOnce, 'When the guesser returns an URL, ImageProvider is called once' );
		assert.ok( imageStub.calledWith( 'guessedURL' ), 'When the guesser returns an URL, ImageProvider is called with the guessed url' );
		assert.strictEqual( promise.state(), 'resolved', 'When the guesser returns an URL, fetchThumbnail resolves' );

		// When the guesser returns an URL, but that returns 404, image loading should be retried with the classic provider
		setupStubs();
		guessedThumbnailInfoStub.returns( $.Deferred().resolve( { url: 'guessedURL' } ) );
		thumbnailInfoStub.returns( $.Deferred().resolve( { url: 'apiURL' } ) );
		imageStub.withArgs( 'guessedURL' ).returns( $.Deferred().reject() );
		imageStub.withArgs( 'apiURL' ).returns( $.Deferred().resolve( image ) );
		promise = viewer.fetchThumbnail( file, width, sampleURL, originalWidth, originalHeight );
		assert.ok( guessedThumbnailInfoStub.calledOnce, 'When the guesser returns an URL, but that returns 404, GuessedThumbnailInfoProvider is called once' );
		assert.ok( thumbnailInfoStub.calledOnce, 'When the guesser returns an URL, but that returns 404, ThumbnailInfoProvider is called once' );
		assert.ok( imageStub.calledTwice, 'When the guesser returns an URL, but that returns 404, ImageProvider is called twice' );
		assert.ok( imageStub.getCall( 0 ).calledWith( 'guessedURL' ), 'When the guesser returns an URL, but that returns 404, ImageProvider is called first with the guessed url' );
		assert.ok( imageStub.getCall( 1 ).calledWith( 'apiURL' ), 'When the guesser returns an URL, but that returns 404, ImageProvider is called second with the guessed url' );
		assert.strictEqual( promise.state(), 'resolved', 'When the guesser returns an URL, but that returns 404, fetchThumbnail resolves' );

		// When even the retry fails, fetchThumbnail() should reject
		setupStubs();
		guessedThumbnailInfoStub.returns( $.Deferred().resolve( { url: 'guessedURL' } ) );
		thumbnailInfoStub.returns( $.Deferred().resolve( { url: 'apiURL' } ) );
		imageStub.withArgs( 'guessedURL' ).returns( $.Deferred().reject() );
		imageStub.withArgs( 'apiURL' ).returns( $.Deferred().reject() );
		promise = viewer.fetchThumbnail( file, width, sampleURL, originalWidth, originalHeight );
		assert.ok( guessedThumbnailInfoStub.calledOnce, 'When even the retry fails, GuessedThumbnailInfoProvider is called once' );
		assert.ok( thumbnailInfoStub.calledOnce, 'When even the retry fails, ThumbnailInfoProvider is called once' );
		assert.ok( imageStub.calledTwice, 'When even the retry fails, ImageProvider is called twice' );
		assert.ok( imageStub.getCall( 0 ).calledWith( 'guessedURL' ), 'When even the retry fails, ImageProvider is called first with the guessed url' );
		assert.ok( imageStub.getCall( 1 ).calledWith( 'apiURL' ), 'When even the retry fails, ImageProvider is called second with the guessed url' );
		assert.strictEqual( promise.state(), 'rejected', 'When even the retry fails, fetchThumbnail rejects' );

		mw.config.get( 'wgMultimediaViewer' ).useThumbnailGuessing = false;

		// When guessing is disabled, the classic provider is used
		setupStubs();
		guessedThumbnailInfoStub.returns( $.Deferred().resolve( { url: 'guessedURL' } ) );
		thumbnailInfoStub.returns( $.Deferred().resolve( { url: 'apiURL' } ) );
		imageStub.returns( $.Deferred().resolve( image ) );
		promise = viewer.fetchThumbnail( file, width );
		assert.ok( !guessedThumbnailInfoStub.called, 'When guessing is disabled, GuessedThumbnailInfoProvider is not called' );
		assert.ok( thumbnailInfoStub.calledOnce, 'When guessing is disabled, ThumbnailInfoProvider is called once' );
		assert.ok( imageStub.calledOnce, 'When guessing is disabled, ImageProvider is called once' );
		assert.ok( imageStub.calledWith( 'apiURL' ), 'When guessing is disabled, ImageProvider is called with the API url' );
		assert.strictEqual( promise.state(), 'resolved', 'When guessing is disabled, fetchThumbnail resolves' );

		mw.config.get( 'wgMultimediaViewer' ).useThumbnailGuessing = oldUseThumbnailGuessing;
	} );

	QUnit.test( 'document.title', 2, function ( assert ) {
		var viewer = new mw.mmv.MultimediaViewer( { get: $.noop } ),
			bootstrap = new mw.mmv.MultimediaViewerBootstrap(),
			title = new mw.Title( 'File:This_should_show_up_in_document_title.png' ),
			oldDocumentTitle = document.title;

		viewer.currentImageFileTitle = title;
		bootstrap.setupEventHandlers();
		viewer.setHash();

		assert.ok( document.title.match( title.getNameText() ), 'File name is visible in title' );

		viewer.close();
		bootstrap.cleanupEventHandlers();

		assert.strictEqual( document.title, oldDocumentTitle, 'Original title restored after viewer is closed' );
	} );

}( mediaWiki, jQuery ) );
