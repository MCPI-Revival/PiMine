<?php

declare(strict_types = 1);

namespace pimine\command;

use pimine\command\Command;

class HelpCommand extends Command {
	public function __construct() {
		parent::__construct("help", "Help Command", ["?"]);
	}

	public function execute(array $args, object &$sender, object &$server): void {
		foreach ($server->commandManager->commands as $command) {
			$server->logger->log("info", "/". $command->name . ": " . $command->description);
		}
	}
}
