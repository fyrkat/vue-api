<?php declare(strict_types=1);

namespace fyrkat\vue\app;

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

}
