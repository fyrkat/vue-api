<?php declare(strict_types=1);

require implode( DIRECTORY_SEPARATOR, [dirname( __DIR__ ), 'src', '_autoload.php'] );
require implode( DIRECTORY_SEPARATOR, [dirname( __DIR__ ), 'vendor', 'autoload.php'] );

$app = new \fyrkat\vue\app\VueApp();
$router = new \AltoRouter( [], '/api' );

$router->map( 'GET', '/item/[*:path]/', [$app, 'dispatchItem'] );
$router->map( 'GET', '/meta/[*:metasource]/[*:path]/', [$app, 'dispatchMeta'] );

$match = $router->match();

if ( is_array( $match ) && is_callable( $match['target'] ) ) {
	try {
		$result = call_user_func_array( $match['target'], $match['params'] );
		if ( is_array( $result ) || $result instanceof JsonSerializable ) {
			header( 'Content-Type: application/json' );
			die( json_encode( $result ) );
		}
	} catch ( \Exception $e ) {
		error_log( $e->getMessage() . ': ' . $e->getTraceAsString() );
		header( 'Content-Type: text/plain', true, 500 );
		die( "500 Internal Server Error\r\n\r\n" . $e->getMessage() . "\r\n" );
	}
} else {
	header( 'Content-Type: text/plain', true, 404 );
	die( "404 Not Found\r\n" );
}
