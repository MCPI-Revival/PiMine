<?php

declare(strict_types = 1);

namespace pimine\network;

use pimine\network\InternetAddress;
use pimine\utils\Logger;

class RakNetHandler {
	public $server;

	public function __construct(object &$server) {
		$this->server = $server;
	}

	public function handle(string $data, InternetAddress $address): void {
		if (strlen($data) > 0) {
			Logger::info("0x" . bin2hex($data[0])); // DEBUG
		}
	}
}
