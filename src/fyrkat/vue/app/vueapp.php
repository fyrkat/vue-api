<?php declare(strict_types=1);

namespace fyrkat\vue\app;

use fyrkat\vue\library\Collection;

final class VueApp {

	private $config;

	public function __construct( VueConfig $config = null )
	{
		$this->config = $config ?? VueConfig::getConfig();
	}

	public function getRootCollection(): Collection
	{
		$rootPath = $this->config->getRootCollectionPath();
		$rootType = $this->config->getRootCollectionType();
		$className = sprintf( '%sCollection', ucfirst( $rootType ) );
		$class = "fyrkat\\vue\\library\\{$rootType}\\{$className}";
		return new $class( $rootPath );
	}

	public function getBaseUrl(): string
	{
		return $this->config->getBaseUrl();
	}

	public function dispatchItem( $urlencodedPath ): \JsonSerializable
	{
		$path = rawurldecode( $urlencodedPath );
		$item = $this->getRootCollection();
		$segments = explode( '/', $path );
		foreach( $segments as $segment ) {
			if ( ! ( $item instanceof Collection ) ) {
				// $item->getItemByName( string ) is only in Collection
				throw new \Exception( '404 Not Found' );
			}
			if ( '' === $segment ) continue;
			$item = $item->getItemByName( $segment );
		}
		return $item;
	}

}
