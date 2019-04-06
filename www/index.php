<?php declare(strict_types=1);
require implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', '_autoload.php']);

header( 'Content-Type: text/plain', true, 404 );
die( "404 Not Found\r\n" );
