<?php declare(strict_types=1);

namespace fyrkat\vue\library;

interface Collection extends Item
{
	function listItems(): array;
	function getItemByName( string $name ): Item;
}
