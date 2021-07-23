<?php

declare(strict_types = 1);

namespace pimine\command\commands;

use pimine\command\Command;
use pimine\utils\Logger;

class StopCommand extends Command {
	public $server;

	public function __construct(object &$server) {
		parent::__construct("stop", "Stop Command");
		$this->server = $server;
	}

	public function execute(array $args, object &$sender): void {
		Logger::info("Stopping server...");
		$this->server->stopped = true;
		Logger::success("Server Stopped.");
	}
}
