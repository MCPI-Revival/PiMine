<?php

declare(strict_types = 1);

namespace pimine\command\commands;

use pimine\command\Command;
use pimine\utils\Logger;

class HelpCommand extends Command {
	public $server;

	public function __construct(object &$server) {
		parent::__construct("help", "Help Command", ["?"]);
		$this->server = $server;
	}

	public function execute(array $args, object &$sender): void {
		foreach ($this->server->commandManager->commands as $command) {
			Logger::info("/" . $command->name . ": " . $command->description);
		}
	}
}