<?php

declare(strict_types = 1);

namespace pimine\network;

class UDPServerSocket {
	public $address;
	public $port;
	public $version;
	public $socket;

	public function __construct(string $address, int $port, int $version = 4) {
		$this->address = $address;
		$this->port = $port;
		$this->version = $version;
		if ($version === 4) {
			$this->socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		} elseif ($version === 6) {
			$this->socket = socket_create(AF_INET6, SOCK_DGRAM, SOL_UDP);
			socket_set_option($this->socket, IPPROTO_IPV6, IPV6_V6ONLY, 1);
		} else {
			throw new Exception("Unknown IP version " . $version);
		}
		socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
		socket_set_option($this->socket, SOL_SOCKET, SO_BROADCAST, 1);
		if (socket_bind($this->socket, $address, $port) === true) {
			socket_set_nonblock($this->socket);
		} else {
			throw new Exception("Unable to bind to " . $host . ":" . $port);
		}
	}

	public function receive(string &$data, string &$address, int &$port): void {
		@socket_recvfrom($this->socket, $data, 65535, 0, $address, $port);
	}

	public function send(string $data, string $address, int $port): int {
		return @socket_sendto($this->socket, $data, strlen($data), 0, $address, $port);
	}
}
