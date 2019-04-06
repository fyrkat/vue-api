<?php declare(strict_types=1);

namespace fyrkat\vue\library;

interface Item
{
	function getName();
	function getTitle();
	function getImage();
	function getDescription();
	function getReleaseDate();
}
