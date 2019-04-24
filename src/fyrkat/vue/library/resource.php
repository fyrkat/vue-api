<?php declare(strict_types=1);

namespace fyrkat\vue\library;

interface Resource extends Item
{
	function getUniqueIdentifier();
	function passThroughHttp();
}
