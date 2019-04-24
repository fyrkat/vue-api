<?php declare(strict_types=1);

namespace fyrkat\vue\library\filesystem;

use fyrkat\vue\library\Resource;

class FilesystemResource extends FilesystemItem implements Resource
{
	public function getUniqueIdentifier()
	{
		return hash_file( 'sha1', $this->filesystemPath );
	}
	public function getType()
	{
		return array_merge( parent::getType(), ['resource', 'file'] );
	}
	public function passThroughHttp()
	{
		header( 'Content-Description: File Transfer' );
		header( 'Content-Type: application/octet-stream' );
		header( 'Content-Disposition: attachment; filename="' . basename( $this->filesystemPath ) . '"' );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Content-Length: ' . filesize( $this->filesystemPath ) );
		readfile( $this->filesystemPath );
	}
}
