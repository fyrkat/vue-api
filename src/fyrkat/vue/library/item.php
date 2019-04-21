<?php declare(strict_types=1);

namespace fyrkat\vue\library;

interface Item extends \JsonSerializable
{
	function getName();
	function getType();
}
