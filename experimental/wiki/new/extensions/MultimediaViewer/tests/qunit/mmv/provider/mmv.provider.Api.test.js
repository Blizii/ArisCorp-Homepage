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

( function ( mw, $ ) {
	QUnit.module( 'mmv.provider.Api', QUnit.newMwEnvironment() );

	QUnit.test( 'Api constructor sanity check', 2, function ( assert ) {
		var api = { get: function () {} },
			options = {},
			apiProvider = new mw.mmv.provider.Api( api, options ),
			ApiProviderWithNoOptions = new mw.mmv.provider.Api( api );

		assert.ok( apiProvider );
		assert.ok( ApiProviderWithNoOptions );
	} );

	QUnit.test( 'apiGetWithMaxAge()', 8, function ( assert ) {
		var api = {},
			options = {},
			apiProvider = new mw.mmv.provider.Api( api, options );

		api.get = this.sandbox.stub();
		apiProvider.apiGetWithMaxAge( {} );
		assert.ok( !( 'maxage' in api.get.getCall( 0 ).args[0] ), 'maxage is not set by default' );
		assert.ok( !( 'smaxage' in api.get.getCall( 0 ).args[0] ), 'smaxage is not set by default' );

		options = { maxage: 123 };
		apiProvider = new mw.mmv.provider.Api( api, options );

		api.get = this.sandbox.stub();
		apiProvider.apiGetWithMaxAge( {} );
		assert.strictEqual( api.get.getCall( 0 ).args[0].maxage, 123, 'maxage falls back to provider default' );
		assert.strictEqual( api.get.getCall( 0 ).args[0].smaxage, 123, 'smaxage falls back to provider default' );

		api.get = this.sandbox.stub();
		apiProvider.apiGetWithMaxAge( {}, null, 456 );
		assert.strictEqual( api.get.getCall( 0 ).args[0].maxage, 456, 'maxage can be overridden' );
		assert.strictEqual( api.get.getCall( 0 ).args[0].smaxage, 456, 'smaxage can be overridden' );

		api.get = this.sandbox.stub();
		apiProvider.apiGetWithMaxAge( {}, null, null );
		assert.ok( !( 'maxage' in api.get.getCall( 0 ).args[0] ), 'maxage can be overridden to unset' );
		assert.ok( !( 'smaxage' in api.get.getCall( 0 ).args[0] ), 'smaxage can be overridden to unset' );
	} );

	QUnit.test( 'getCachedPromise success', 5, function ( assert ) {
		var api = { get: function () {} },
			apiProvider = new mw.mmv.provider.Api( api ),
			oldMwLog = mw.log,
			promiseSource,
			promiseShouldBeCached = false;

		mw.log = function () {
			assert.ok( false, 'mw.log should not have been called' );
		};

		promiseSource = function ( result ) {
			return function () {
				assert.ok( !promiseShouldBeCached, 'promise was not cached' );
				return $.Deferred().resolve( result );
			};
		};

		apiProvider.getCachedPromise( 'foo', promiseSource( 1 ) ).done( function ( result ) {
			assert.strictEqual( result, 1, 'result comes from the promise source' );
		} );

		apiProvider.getCachedPromise( 'bar', promiseSource( 2 ) ).done( function ( result ) {
			assert.strictEqual( result, 2, 'result comes from the promise source' );
		} );

		promiseShouldBeCached = true;
		apiProvider.getCachedPromise( 'foo', promiseSource( 3 ) ).done( function ( result ) {
			assert.strictEqual( result, 1, 'result comes from cache' );
		} );

		mw.log = oldMwLog;
	} );

	QUnit.test( 'getCachedPromise failure', 7, function ( assert ) {
		var api = { get: function () {} },
			apiProvider = new mw.mmv.provider.Api( api ),
			oldMwLog = mw.log,
			promiseSource,
			promiseShouldBeCached = false;

		mw.log = function () {
			assert.ok( true, 'mw.log was called' );
		};

		promiseSource = function ( result ) {
			return function () {
				assert.ok( !promiseShouldBeCached, 'promise was not cached' );
				return $.Deferred().reject( result );
			};
		};

		apiProvider.getCachedPromise( 'foo', promiseSource( 1 ) ).fail( function ( result ) {
			assert.strictEqual( result, 1, 'result comes from the promise source' );
		} );

		apiProvider.getCachedPromise( 'bar', promiseSource( 2 ) ).fail( function ( result ) {
			assert.strictEqual( result, 2, 'result comes from the promise source' );
		} );

		promiseShouldBeCached = true;
		apiProvider.getCachedPromise( 'foo', promiseSource( 3 ) ).fail( function ( result ) {
			assert.strictEqual( result, 1, 'result comes from cache' );
		} );

		mw.log = oldMwLog;
	} );

	QUnit.test( 'getErrorMessage', 2, function ( assert ) {
		var api = { get: function () {} },
			apiProvider = new mw.mmv.provider.Api( api ),
			errorMessage;

		errorMessage = apiProvider.getErrorMessage( {
			servedby: 'mw1194',
			error: {
				code: 'unknown_action',
				info: 'Unrecognized value for parameter \'action\': FOO'
			}
		} );
		assert.strictEqual( errorMessage,
			'unknown_action: Unrecognized value for parameter \'action\': FOO',
			'error message is parsed correctly' );

		assert.strictEqual( apiProvider.getErrorMessage( {} ), 'unknown error', 'missing error message is handled' );
	} );

	QUnit.test( 'getNormalizedTitle', 3, function ( assert ) {
		var api = { get: function () {} },
			apiProvider = new mw.mmv.provider.Api( api ),
			title = new mw.Title( 'Image:Stuff.jpg' ),
			normalizedTitle;

		normalizedTitle = apiProvider.getNormalizedTitle( title, {} );
		assert.strictEqual( normalizedTitle, title, 'missing normalization block is handled' );

		normalizedTitle = apiProvider.getNormalizedTitle( title, {
			query: {
				normalized: [
					{
						from: 'Image:Foo.jpg',
						to: 'File:Foo.jpg'
					}
				]
			}
		} );
		assert.strictEqual( normalizedTitle, title, 'irrelevant normalization info is skipped' );

		normalizedTitle = apiProvider.getNormalizedTitle( title, {
			query: {
				normalized: [
					{
						from: 'Image:Stuff.jpg',
						to: 'File:Stuff.jpg'
					}
				]
			}
		} );
		assert.strictEqual( normalizedTitle.getPrefixedDb(), 'File:Stuff.jpg', 'normalization happens' );
	} );

	QUnit.test( 'getQueryField', 3, function ( assert ) {
		var api = { get: function () {} },
			apiProvider = new mw.mmv.provider.Api( api ),
			data;

		data = {
			query: {
				imageusage: [
					{
						pageid: 736,
						ns: 0,
						title: 'Albert Einstein'
					}
				]
			}
		};
		QUnit.stop();
		apiProvider.getQueryField( 'imageusage', data ).then( function ( field ) {
			assert.strictEqual( field, data.query.imageusage, 'specified field is found' );
			QUnit.start();
		} );

		QUnit.stop();
		apiProvider.getQueryField( 'imageusage', {} ).fail( function () {
			assert.ok( true, 'promise rejected when data is missing' );
			QUnit.start();
		} );

		QUnit.stop();
		apiProvider.getQueryField( 'imageusage', { data: { query: {} } } ).fail( function () {
			assert.ok( true, 'promise rejected when field is missing' );
			QUnit.start();
		} );
	} );

	QUnit.test( 'getQueryPage', 6, function ( assert ) {
		var api = { get: function () {} },
			apiProvider = new mw.mmv.provider.Api( api ),
			title = new mw.Title( 'File:Stuff.jpg' ),
			titleWithNamespaceAlias = new mw.Title( 'Image:Stuff.jpg' ),
			otherTitle = new mw.Title( 'File:Foo.jpg' ),
			data;

		data = {
			normalized: [
				{
					from: 'Image:Stuff.jpg',
					to: 'File:Stuff.jpg'
				}
			],
			query: {
				pages: {
					'-1': {
						title: 'File:Stuff.jpg'
					}
				}
			}
		};
		QUnit.stop();
		apiProvider.getQueryPage( title, data ).then( function ( field ) {
			assert.strictEqual( field, data.query.pages['-1'], 'specified page is found' );
			QUnit.start();
		} );
		QUnit.stop();
		apiProvider.getQueryPage( titleWithNamespaceAlias, data ).then( function ( field ) {
			assert.strictEqual( field, data.query.pages['-1'],
				'specified page is found even if its title was normalized' );
			QUnit.start();
		} );
		QUnit.stop();
		apiProvider.getQueryPage( otherTitle, {} ).fail( function () {
			assert.ok( true, 'promise rejected when page has different title' );
			QUnit.start();
		} );

		QUnit.stop();
		apiProvider.getQueryPage( title, {} ).fail( function () {
			assert.ok( true, 'promise rejected when data is missing' );
			QUnit.start();
		} );

		QUnit.stop();
		apiProvider.getQueryPage( title, { data: { query: {} } } ).fail( function () {
			assert.ok( true, 'promise rejected when pages are missing' );
			QUnit.start();
		} );

		QUnit.stop();
		apiProvider.getQueryPage( title, { data: { query: { pages: {} } } } ).fail( function () {
			assert.ok( true, 'promise rejected when pages are empty' );
			QUnit.start();
		} );
	} );
}( mediaWiki, jQuery ) );
