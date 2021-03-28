<?php

declare(strict_types = 1);

namespace pimine;

function requirePathOnce(string $dir): void {
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

//requirePathOnce(dirname(__file__) . "/");

spl_autoload_register(function ($class_name) {
	include dirname(dirname(__file__)) . "/" . str_replace("\\", "/", $class_name) . ".php";
});

use pimine\Server;

if (PHP_INT_SIZE < 8) {
	echo("[ERROR] PiMine only supports 64bit hosts.\n");
	echo("> Please consider using 64bit php binaries.\n");
} else {
	$server = new Server();
}
