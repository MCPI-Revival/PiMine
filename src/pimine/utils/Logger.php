<?php

declare(strict_types = 1);

namespace pimine\utils;

use pimine\utils\TextFormat;

class Logger {
	private static function log(string $type, string $typeColor, string $content): void {
		$result = TextFormat::YELLOW;
		$result .= "<";
		$result .= TextFormat::LIGHT_CYAN;
		$result .= date("h:i:s");
		$result .= TextFormat::YELLOW;
		$result .= " | ";
		$result .= $typeColor;
		$result .= strtolower($type);
		$result .= TextFormat::YELLOW;
		$result .= "> ";
		$result .= TextFormat::RESET;
		$result .= $content;
		$result .= TextFormat::RESET;
		$result .= "\n";
		echo($result);
	}

	public static function info(string $content): void {
		Logger::log("info", TextFormat::LIGHT_BLUE, $content);
	}

	public static function warn(string $content): void {
		Logger::log("warn", TextFormat::LIGHT_YELLOW, $content);
	}

	public static function success(string $content): void {
		Logger::log("success", TextFormat::LIGHT_GREEN, $content);
	}

	public static function error(string $content): void {
		Logger::log("error", TextFormat::LIGHT_RED, $content);
	}
}
