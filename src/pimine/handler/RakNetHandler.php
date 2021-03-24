<?php

declare(strict_types = 1);

namespace pimine\handler;

use pimine\utils\InternetAddress;

class RakNetHandler {
	public object $server;

	public function __construct(object &$server) {
		$this->server = $server;
	}

	public function handle(string $data, InternetAddress $address) {
		if (strlen($data) > 0) {
			$this->server->logger->log("info", "0x" . bin2hex($data[0])); // DEBUG
		}
	}
}
