<?php

declare(strict_types = 1);

namespace pimine;

$dir = dirname(__file__) . "/";
$dh  = opendir($dir);
$dir_list = array($dir);
while (false !== ($filename = readdir($dh))) {
	if ($filename != "." && $filename != ".." && is_dir($dir . $filename)) {
		array_push($dir_list, $dir . $filename . "/");
	}
}
foreach ($dir_list as $dir) {
	foreach (glob($dir . "*.php") as $filename) {
		require_once $filename;
	}
}

use pimine\Server;

$server = new Server();
