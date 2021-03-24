<?php

declare(strict_types = 1);

namespace pimine;

function require_path(string $dir) {
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while ($file = readdir($dh)) {
				if ($file != '.' && $file != '..') {
					if (is_dir($dir . $file)) {
						require_path($dir . $file . "/");
					} elseif (strtolower(substr($dir . $file, -4)) === ".php") {
						require_once($dir . $file);
					}
				}
			}
		}
		closedir($dh);
	}
}

require_path(dirname(__file__) . "/");

use pimine\Server;

$server = new Server();
