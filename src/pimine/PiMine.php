<?php

declare(strict_types = 1);

namespace pimine;

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
