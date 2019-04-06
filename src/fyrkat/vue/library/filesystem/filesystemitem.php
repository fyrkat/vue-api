<?php declare(strict_types=1);

namespace fyrkat\vue\library\filesystem;

use fyrkat\vue\library\Item;

class FilesystemItem implements Item
{
	public static function getItemByFilesystemPath( string $filesystemPath )
	{
		if ( is_dir( $filesystemPath ) ) {
			return new FilesystemCollection( $filesystemPath );
		}
		if ( is_file( $filesystemPath ) ) {
			return new FilesystemResource( $filesystemPath );
		}
		throw new \Exception( "Cannot use in library: $filesystemPath" );
	}

	protected $filesystemPath;

	public function __construct( string $filesystemPath )
	{
		if ( !file_exists( $filesystemPath ) ) {
			throw new \Exception( "Does not exist: $filesystemPath" );
		}
		$this->filesystemPath = $filesystemPath;
	}

	public function jsonSerialize(): array
	{
		return [
			'name' => $this->getName(),
			'title' => $this->getTitle(),
		];
	}

	public function getName()
	{
		return basename( $this->filesystemPath );
	}

	public function getTitle()
	{
		return $this->getName();
	}

	public function getImage()
	{
		return null;
	}

	public function getDescription()
	{
		return null;
	}

	public function getReleaseDate()
	{
		return null;
	}
}
