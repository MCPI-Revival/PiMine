<?php

declare(strict_types = 1);

namespace pimine\command;

use pimine\utils\Logger;

class ConsoleCommandHandler {
	public static function handle(string $userInput, object $server): void {
		if (strlen($userInput) > 0) {
			$rawCommand = explode(" ", $userInput);
			$name = $rawCommand[0];
			$args = array_slice($rawCommand, 1, count($rawCommand) - 1);
			$manager = $server->commandManager;
			$commands = $manager->commands;
			if ($manager->hasCommand($name)) {
				$server->commandManager->execute($name, $args, $server);
			} else {
				Logger::error("Invalid command!");
			}
		}
	}
}

