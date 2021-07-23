<?php

declare(strict_types = 1);

namespace pimine\command\commands;

use pimine\command\Command;
use pimine\network\mcpi\ProtocolInfo;
use pimine\utils\Logger;
use pimine\Version;

class VersionCommand extends Command {
	public $server;

	public function __construct(object &$server) {
		parent::__construct("version", "Version Command", ["ver"]);
		$this->server = $server;
	}

	public function execute(array $args, object &$sender): void {
		$out = "This server is running PiMine version ";
		$out .= Version::PIMINE_VERSION;
		$out .= " ";
		$out .= Version::PIMINE_CODENAME;
		$out .= " on API ";
		$out .= Version::PIMINE_API_VERSION;
		$out .= " for mcpi ";
		$out .= ProtocolInfo::VERSION;
		$out .= " (";
		$out .= ProtocolInfo::PROTOCOL_VERSION;
		$out .= "). This version is licensed under the ";
		$out .= Version::PIMINE_LICENSE;
		$out .=  " license.";
		Logger::info($out);
	}
}
