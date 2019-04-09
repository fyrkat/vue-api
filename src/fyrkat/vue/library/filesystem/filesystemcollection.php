<?php declare(strict_types=1);

namespace fyrkat\vue\library\filesystem;

use fyrkat\vue\library\Collection;
use fyrkat\vue\library\Item;

class FilesystemCollection extends FilesystemItem implements Collection
{
	public function __construct( string $filesystemPath )
	{
		parent::__construct( $filesystemPath );
		if ( !is_dir( $filesystemPath ) ) {
			throw new \Exception( "Not a directory: $filesystemPath" );
		}
	}

	public function jsonSerialize(): array
	{
		$items = [];
		foreach($this->listItems() as $item) {
			$items[] = [
				'name' => $item->getName(),
				'type' => $item->getType(),
			];
		}
		return [
			'items' => $items,
		] + parent::jsonSerialize();
	}

	public function yieldItems(): \Generator
	{
		if ( $dh = opendir( $this->filesystemPath ) ) {
			while( ( $file = readdir( $dh ) ) !== false ) {
				if ( '.' === substr( $file, 0, 1 ) ) continue;
				yield FilesystemItem::getItemByFilesystemPath( "{$this->filesystemPath}/$file" );
			}
			closedir( $dh );
		}
	}

	public function getType()
	{
		return array_merge( parent::getType(), ['collection'] );
	}

	public function listItems(): array
	{
		return iterator_to_array( $this->yieldItems() );
	}

	public function getItemByName( string $name ): Item
	{
		return FilesystemItem::getItemByFilesystemPath( "{$this->filesystemPath}/$name" );
	}
}
