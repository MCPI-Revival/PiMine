<?php

declare(strict_types = 1);

namespace pimine;

function requirePathOnce(string $dir) {
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while ($file = readdir($dh)) {
				if ($file != '.' && $file != '..') {
					if (is_dir($dir . $file)) {
						requirePathOnce($dir . $file . "/");
					} elseif (strtolower(substr($dir . $file, -4)) === ".php") {
						require_once($dir . $file);
					}
				}
			}
		}
		closedir($dh);
	}
}

requirePathOnce(dirname(__file__) . "/");

use pimine\Server;

$server = new Server();
