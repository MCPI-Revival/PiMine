<?php

declare(strict_types = 1);

namespace pimine\manager;

class CommandManager {
	public $server;
	public array $commands;

	public function __construct(object &$server) {
		$this->server = $server;
		$this->commands = [];
	}

	public function register(object $command): void {
		$this->commands[] = $command;
	}

	public function hasCommand(string $name): bool {
		foreach ($this->commands as $key => $value) {
			if ($value->name === $name) {
				return true;
			}
			foreach ($value->aliases as $aName) {
				if ($aName == $name) {
					return true;
				}
			}
		}
		return false;
	}

	public function execute(string $name, array $args, object $sender): void {
		foreach ($this->commands as $key => $value) {
			if ($value->name === $name) {
				$this->commands[$key]->execute($args, $sender, $this->server);
				return;
			}
			foreach ($value->aliases as $aName) {
				if ($aName == $name) {
					$this->commands[$key]->execute($args, $sender, $this->server);
					return;
				}
			}
		}
	}
}
