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
		if ( !file_exists( $filesystemPath ) ) {
			throw new \Exception( "Filesystem path not found: $filesystemPath", 404 );
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
			'type' => $this->getType(),
		];
	}

	public function getType()
	{
		return ['filesystem'];
	}

	public function getName()
	{
		return basename( $this->filesystemPath );
	}

	public function getTitle()
	{
		return $this->getName();
	}
}
