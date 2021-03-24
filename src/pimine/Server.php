<?php

declare(strict_types = 1);

namespace pimine;

use pimine\constant\Misc;
use pimine\constant\TextFormat;
use pimine\command\HelpCommand;
use pimine\command\StopCommand;
use pimine\command\VersionCommand;
use pimine\handler\CommandHandler;
use pimine\handler\RakNetHandler;
use pimine\manager\CommandManager;
use pimine\utils\Logger;
use pimine\utils\InternetAddress;
use pimine\utils\UDPServerSocket;

class Server {
	public $stopped;
	public $commandManager;
	public $commandHandler;
	public $socket;
	public $address;

	public function __construct() {
		$this->logger = new Logger();
		$this->commandManager = new CommandManager($this);
		$this->commandHandler = new CommandHandler($this);
		$this->address = new InternetAddress("0.0.0.0", 19132);
		$this->socket = new UDPServerSocket($this->address->address, $this->address->port, $this->address->version);
		$this->rakNetHandler = new RakNetHandler($this);
		$this->start();
	}

	public function registerVanillaCommands(): void {
		$this->commandManager->register(new HelpCommand());
		$this->commandManager->register(new StopCommand());
		$this->commandManager->register(new VersionCommand());
	}

	public function start(): void {
		echo(Misc::PIMINE_LOGO . "\n");
		$startTime = (float) microtime();
		$this->registerVanillaCommands();
		$this->stopped = false;
		$command = "";
		$finishTime = (float) microtime();
		$diffTime = $finishTime - $startTime;
		$dtfa = explode(".", (string) $diffTime);
		$dtf = $dtfa[0] . "." . substr($dtfa[1], 0, 3);
		$this->logger->log("success", "Done in " . $dtf . ". Type 'help' or '?' to view all available commands.");
		while (!$this->stopped) {
			stream_set_blocking(STDIN, false);
			$command .= fread(STDIN, 1);
			if (substr($command, -1) == "\n") {
				$this->commandHandler->handle(substr($command, 0, -1));
				$command = "";
			}
			$data = "";
			$address = "";
			$port = 0;
			$this->socket->receive($data, $address, $port);
			$internetAddress = new InternetAddress($address, $port);
			$this->rakNetHandler->handle($data, $internetAddress);
		}
	}
}
