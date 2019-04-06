<?php declare(strict_types=1);

namespace fyrkat\vue\library\filesystem;

use fyrkat\vue\library\Collection;
use fyrkat\vue\library\Item;

class FilesystemCollection implements Collection
{
	public function __construct( string $filesystemPath )
	{
		parent::__construct( $filesystemPath );
		if ( is_dir( $filesystemPath ) ) {
			throw new \Exception( "Not a directory: $filesystemPath" );
		}
	}

	public function yieldItems(): \Generator
	{
		$dh = opendir( $this->filesystemPath );
		while( false !== ( $file = readdir( $dh ) ) ) {
			if ( '.' === substr( $file, 0, 1 ) ) continue;
			yield $this->getItemByName( $file );
		}
	}

	public function listItems(): array
	{
		iterator_to_array( $this->yieldItems() );
	}

	public function getItemByName( string $name ): Item
	{
		FilesystemItem::getItemByFilesystemPath( "{$this->filesystemPath}/$file" );
	}
}
