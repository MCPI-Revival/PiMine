<?php

declare(strict_types = 1);

namespace pimine\utils;

use pimine\constant\TextFormat;

class Logger {
	public function log(string $type, string $content): void {
		switch (strtolower($type)) {
			case "info":
				$color = TextFormat::LIGHT_BLUE;
				break;
			case "warn":
				$color = TextFormat::LIGHT_YELLOW;
				break;
			case "success":
				$color = TextFormat::LIGHT_GREEN;
				break;
			case "error":
				$color = TextFormat::LIGHT_RED;
				break;
			default:
				return;
		}
		$result = TextFormat::YELLOW;
		$result .= "<";
		$result .= TextFormat::LIGHT_CYAN;
		$result .= date("h:i:s");
		$result .= TextFormat::YELLOW;
		$result .= " | ";
		$result .= $color;
		$result .= strtolower($type);
		$result .= TextFormat::YELLOW;
		$result .= "> ";
		$result .= TextFormat::RESET;
		$result .= $content;
		$result .= TextFormat::RESET;
		$result .= "\n";
		echo($result);
	}
}
