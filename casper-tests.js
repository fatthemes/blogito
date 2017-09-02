casper.test.begin( 'test 1', 4, function ( test ) {
    casper.start( 'http://wp.test/', function () {
	test.assertResourceExists( 'blogito.min.js' );
	test.assertTextDoesntExist( 'Warning:', 'No PHP Warnings' );
	test.assertTextDoesntExist( 'Notice:', 'No PHP Notices' );
	test.assertTextDoesntExist( 'Fatal error:', 'No PHP Fatal Errors' );
    } ).run( function () {
	test.done();
    } );
} );
/*
 casper.test.begin('test 2', 4, function(test) {
 casper.start('http://pat/alpha/hello-world/', function() {
 test.assertResourceExists('blogito.min.js');
 test.assertTextDoesntExist('Warning', 'No PHP Warning');
 test.assertTextDoesntExist('Notice', 'No PHP Notice');
 test.assertTextDoesntExist('Fatal Error', 'No PHP Fatal Error');
 }).run(function() {
 test.done();
 });
 });
 
 casper.test.begin('test 3', 4, function(test) {
 casper.start('http://pat/alpha/sample-page/', function() {
 test.assertResourceExists('blogito.min.js');
 test.assertTextDoesntExist('Warning', 'No PHP Warning');
 test.assertTextDoesntExist('Notice', 'No PHP Notice');
 test.assertTextDoesntExist('Fatal Error', 'No PHP Fatal Error');
 }).run(function() {
 test.done();
 });
 });
 
 casper.test.begin('test 4', 4, function(test) {
 casper.start('http://pat/alpha/?s=aaaaa', function() {
 test.assertResourceExists('blogito.min.js');
 test.assertTextDoesntExist('Warning', 'No PHP Warning');
 test.assertTextDoesntExist('Notice', 'No PHP Notice');
 test.assertTextDoesntExist('Fatal Error', 'No PHP Fatal Error');
 }).run(function() {
 test.done();
 });
 });
 */
