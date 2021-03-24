<?php

declare(strict_types = 1);

namespace pimine\command;

use pimine\command\Command;

class StopCommand extends Command {
	public function __construct() {
		parent::__construct("stop", "Stop Command");
	}

	public function execute(array $args, object &$sender, object &$server): void {
		$server->logger->log("info", "Stopping server...");
		$server->stopped = true;
		$server->logger->log("success", "Server Stopped.");
	}
}
