<?php declare(strict_types=1);

namespace fyrkat\vue\app;

class VueConfig {

	public static function getConfig(): VueConfig
	{
		// todo implement with TOML
	}

	private $config;

	public function __construct( stdObject $config )
	{
		$this->config = $config;
	}

	public function getRootCollectionPath(): string {
		$result = $this->config->root_collection->path;
		if ( !is_string( $result ) ) {
			throw new \ConfigException( 'root_collection.path must be string' );
		}
		return $result;
	}

	public function getRootCollectionType(): string {
		$result = $this->config->root_collection->path;
		if ( !is_string( $result ) ) {
			throw new \ConfigException( 'root_collection.type must be string' );
		}
		if ( preg_match( '/[^a-z]/', $result ) ) {
			throw new \ConfigException( 'root_collection.type can only contain lowercase [a-z]' );
		}
		return $result;
	}

}
