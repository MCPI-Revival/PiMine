<?php

declare(strict_types = 1);

namespace pimine\handler;

class CommandHandler {
	public object $server;

	public function __construct(object &$server) {
		$this->server = $server;
	}

	public function handle(string $userInput): void {
		if (strlen($userInput) > 0) {
			$rawCommand = explode(" ", $userInput);
			$name = $rawCommand[0];
			$args = array_slice($rawCommand, 1, count($rawCommand) - 1);
			$manager = $this->server->commandManager;
			$commands = $manager->commands;
			if ($manager->hasCommand($name)) {
				$this->server->commandManager->execute($name, $args, $this->server);
			} else {
				$this->server->logger->log("error", "Invalid command!");
			}
		}
	}
}

