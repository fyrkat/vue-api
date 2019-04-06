<?php declare(strict_types=1);

namespace fyrkat\vue\library\filesystem;

use fyrkat\vue\library\Resource;

class FilesystemResource implements Resource
{
	public function getSha1()
	{
		return hash_file( 'sha1', $this->filesystemPath );
	}
}
