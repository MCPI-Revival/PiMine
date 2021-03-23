<?php

declare(strict_types = 1);

namespace pimine;

use pimine\constant\TextFormat;
use pimine\command\HelpCommand;
use pimine\command\StopCommand;
use pimine\command\VersionCommand;
use pimine\handler\CommandHandler;
use pimine\manager\CommandManager;
use pimine\utils\Logger;

class Server {
	public $stopped;
	public $commandManager;
	public $commandHandler;

	public function __construct() {
		$this->logger = new Logger();
		$this->commandManager = new CommandManager($this);
		$this->commandHandler = new CommandHandler($this);
		$this->start();
	}

	public function registerVanillaCommands(): void {
		$this->commandManager->register(new HelpCommand());
		$this->commandManager->register(new StopCommand());
		$this->commandManager->register(new VersionCommand());
	}

	public function start(): void {
		$startTime = (float) microtime();
		$this->registerVanillaCommands();
		$this->stopped = false;
		$command = "";
		$finishTime = (float) microtime();
		$diffTime = $finishTime - $startTime;
		$dtfa = explode(".", (string) $diffTime);
		$dtf = $dtfa[0] . "." . substr($dtfa[1], 0, 3);
		$this->logger->log("success", "Done in " . $dtf . ". Type help to view all available commands.");
		while (!$this->stopped) {
			stream_set_blocking(STDIN, false);
			$command .= fread(STDIN, 1);
			if (substr($command, -1) == "\n") {
				$this->commandHandler->handleCommand(substr($command, 0, -1));
				$command = "";
			}
		}
	}
}
