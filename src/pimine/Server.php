<?php

declare(strict_types = 1);

namespace pimine;

use pimine\constant\TextFormat;
use pimine\command\CommandManager;
use pimine\command\commands\HelpCommand;
use pimine\command\commands\StopCommand;
use pimine\command\commands\VersionCommand;
use pimine\command\ConsoleCommandHandler;
use pimine\network\RakNetHandler;
use pimine\network\UDPServerSocket;
use pimine\network\InternetAddress;
use pimine\utils\Logger;


class Server {
	public $stopped;
	public $commandManager;
	public $commandHandler;
	public $socket;
	public $address;

	public function __construct() {
		$this->commandManager = new CommandManager($this);
		$this->address = new InternetAddress("0.0.0.0", 19132);
		$this->socket = new UDPServerSocket($this->address->address, $this->address->port, $this->address->version);
		$this->rakNetHandler = new RakNetHandler($this);
		$this->start();
	}

	public function registerVanillaCommands(): void {
		$this->commandManager->register(new HelpCommand($this));
		$this->commandManager->register(new StopCommand($this));
		$this->commandManager->register(new VersionCommand($this));
	}

	public function start(): void {
		echo("    ____  _ __  __ _            
   |  _ \(_)  \/  (_)_ __   ___ 
   | |_) | | |\/| | | '_ \ / _ \
   |  __/| | |  | | | | | |  __/
   |_|   |_|_|  |_|_|_| |_|\___|
		" . "\n");
		$startTime = (float) microtime();
		$this->registerVanillaCommands();
		$this->stopped = false;
		$command = "";
		$finishTime = (float) microtime();
		$diffTime = $finishTime - $startTime;
		$dtfa = explode(".", (string) $diffTime);
		$dtf = $dtfa[0] . "." . substr($dtfa[1], 0, 3);
		Logger::success("Done in " . $dtf . ". Type 'help' or '?' to view all available commands.");
		while (!$this->stopped) {
			stream_set_blocking(STDIN, false);
			$command .= fread(STDIN, 1);
			if (substr($command, -1) == "\n") {
				ConsoleCommandHandler::handle(substr($command, 0, -1), $this);
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
