<?php declare(strict_types=1);

namespace fyrkat\vue\app;

use Yosymfony\Toml\Toml;

class VueConfig {

	private static $globalConfig = null;

	public static function getConfig(): VueConfig
	{
		if ( null === static::$globalConfig ) {
			$configFile = implode( DIRECTORY_SEPARATOR, [dirname( __DIR__, 4 ), 'config.toml'] );
			$config = Toml::ParseFile( $configFile );
			static::$globalConfig = new VueConfig( $config );
		}
		return static::$globalConfig;
	}

	private $config;

	public function __construct( array $config )
	{
		$this->config = $config;
	}

	public function getRootCollectionPath(): string {
		$result = $this->config['root_collection']['path'];
		if ( !is_string( $result ) ) {
			throw new ConfigException( 'root_collection.path must be string' );
		}
		return $result;
	}

	public function getRootCollectionType(): string {
		$result = $this->config['root_collection']['type'];
		if ( !is_string( $result ) ) {
			throw new ConfigException( 'root_collection.type must be string' );
		}
		if ( preg_match( '/[^a-z]/', $result ) ) {
			throw new ConfigException( 'root_collection.type can only contain lowercase [a-z]' );
		}
		return $result;
	}

	public function getBaseUrl(): string {
		$result = $this->config['base_url'];
		if ( !is_string( $result ) ) {
			throw new ConfigException( 'base_url must be string' );
		}
		return $result;
	}

}
