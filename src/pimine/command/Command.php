<?php

declare(strict_types = 1);

namespace pimine\command;

abstract class Command {
	public $name;
	public $description;
	public $aliases;

	public function __construct(string $name, string $description, array $aliases = []) {
		$this->name = $name;
		$this->description = $description;
		$this->aliases = $aliases;
	}

	abstract function execute(array $args, object &$sender): void;
}
