<?php declare(strict_types=1);

namespace fyrkat\vue\library\filesystem;

use fyrkat\vue\library\Resource;

class FilesystemResource extends FilesystemItem implements Resource
{
	public function getSha1()
	{
		return hash_file( 'sha1', $this->filesystemPath );
	}
	public function getType()
	{
		return array_merge( parent::getType(), ['resource'] );
	}
}
