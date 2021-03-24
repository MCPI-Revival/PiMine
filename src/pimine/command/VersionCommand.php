<?php

declare(strict_types = 1);

namespace pimine\command;

use pimine\command\Command;
use pimine\constant\Version;

class VersionCommand extends Command {
	public function __construct() {
		parent::__construct("version", "Version Command", ["ver"]);
	}

	public function execute(array $args, object &$sender, object &$server): void {
		$out = "This server is running PiMine version ";
		$out .= Version::PIMINE_VERSION;
		$out .= " ";
		$out .= Version::PIMINE_CODENAME;
		$out .= " on API ";
		$out .= Version::PIMINE_API_VERSION;
		$out .= " for mcpi ";
		$out .= Version::MCPI_VERSION;
		$out .= " (";
		$out .= Version::MCPI_PROTOCOL_VERSION;
		$out .= "). This version is licensed under the ";
		$out .= Version::PIMINE_LICENSE;
		$out .=  " license.";
		$server->logger->log("info", $out);
	}
}
