<?php

declare(strict_types = 1);

namespace pimine\utils;

class InternetAddress {
	public $address;
	public $port;
	public $version;
	public $token;

	public function __construct($address, $port, $version = 4) {
		$this->address = $address;
		$this->port = $port;
		$this->version = $version;
		$this->token = $address . ":" . $port;
	}
}
