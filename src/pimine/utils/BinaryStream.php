<?php

declare(strict_types = 1);

namespace pimine\utils;

class BinaryStream {
    private const BIG_ENDIAN = 0x00;
    private const LITTLE_ENDIAN = 0x01;
	public $data;
	public $pos;

	public function __construct(string $data = "", int $pos = 0) {
		$this->data = $data;
		$this->pos = $pos;
	}
	
	public static function getEndianess(): int {
        return (pack("s", 1) === "\0\1" ? BinaryStream::BIG_ENDIAN : BinaryStream::LITTLE_ENDIAN);
	}

	public function read(int $size): string {
		$this->pos += $size;
		return substr($this->data, $this->pos - $size, $size);
	}

	public function write(string $data): void {
		$this->data .= $data;
	}

	public function readByte(): int {
		return unpack("c", $this->read(1))[1];
	}

	public function writeByte(int $value): void {
		$this->write(pack("c", $value));
	}
	
	public function readUnsignedByte(): int {
		return unpack("C", $this->read(1))[1];
	}

	public function writeUnsignedByte(int $value): void {
		$this->write(pack("C", $value));
	}
	
	public function readBool(): bool {
		return $this->readUnsignedByte() > 0;
	}

	public function writeBool(bool $value): void {
		$this->writeUnsignedByte($value ? 0x01 : 0x00);
	}
	
	public function readShortBE(): int {
	    $data = $this->read(2);
		return unpack("s", BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? $data : strrev($data))[1];
	}

	public function writeShortBE(int $value): void {
	    $data = pack("s", $value);
		$this->write(BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? $data : strrev($data));
	}
	
	public function readUnsignedShortBE(): int {
		return unpack("n", $this->read(2))[1];
	}

	public function writeUnsignedShortBE(int $value): void {
		$this->write(pack("n", $value));
	}
	
	public function readShortLE(): int {
	    $data = $this->read(2);
		return unpack("s", BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? strrev($data) : $data)[1];
	}

	public function writeShortLE(int $value): void {
	    $data = pack("s", $value);
		$this->write(BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? strrev($data) : $data);
	}
	
	public function readUnsignedShortLE(): int {
		return unpack("v", $this->read(2))[1];
	}

	public function writeUnsignedShortLE(int $value): void {
		$this->write(pack("v", $value));
	}
	
	public function readIntBE(): int {
	    $data = $this->read(4);
		return unpack("l", BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? $data : strrev($data))[1];
	}

	public function writeIntBE(int $value): void {
	    $data = pack("l", $value);
		$this->write(BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? $data : strrev($data));
	}
	
	public function readUnsignedIntBE(): int {
		return unpack("N", $this->read(4))[1];
	}

	public function writeUnsignedIntBE(int $value): void {
		$this->write(pack("N", $value));
	}
	
	public function readIntLE(): int {
	    $data = $this->read(4);
		return unpack("l", BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? strrev($data) : $data)[1];
	}

	public function writeIntLE(int $value): void {
	    $data = pack("l", $value);
		$this->write(BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? strrev($data) : $data);
	}
	
	public function readUnsignedIntLE(): int {
		return unpack("V", $this->read(4))[1];
	}

	public function writeUnsignedIntLE(int $value): void {
		$this->write(pack("V", $value));
	}
	
	public function readLongBE(): int {
	    $data = $this->read(8);
		return unpack("q", BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? $data : strrev($data))[1];
	}

	public function writeLongBE(int $value): void {
	    $data = pack("q", $value);
		$this->write(BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? $data : strrev($data));
	}
	
	public function readUnsignedLongBE(): int {
		return unpack("J", $this->read(8))[1];
	}

	public function writeUnsignedLongBE(int $value): void {
		$this->write(pack("J", $value));
	}
	
	public function readLongLE(): int {
	    $data = $this->read(8);
		return unpack("q", BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? strrev($data) : $data)[1];
	}

	public function writeLongLE(int $value): void {
	    $data = pack("q", $value);
		$this->write(BinaryStream::getEndianess() == BinaryStream::BIG_ENDIAN ? strrev($data) : $data);
	}
	
	public function readUnsignedLongLE(): int {
		return unpack("P", $this->read(8))[1];
	}

	public function writeUnsignedLongLE(int $value): void {
		$this->write(pack("P", $value));
	}
	
	public function readFloatBE(): float {
		return unpack("G", $this->read(4))[1];
	}

	public function writeFloatBE(float $value): void {
		$this->write(pack("G", $value));
	}
	
	public function readFloatLE(): float {
		return unpack("g", $this->read(4))[1];
	}

	public function writeFloatLE(float $value): void {
		$this->write(pack("g", $value));
	}
	
	public function readDoubleBE(): double {
		return unpack("E", $this->read(8))[1];
	}

	public function writeDoubleBE(double $value): void {
		$this->write(pack("E", $value));
	}
	
	public function readDoubleLE(): double {
		return unpack("e", $this->read(8))[1];
	}

	public function writeDoubleLE(double $value): void {
		$this->write(pack("e", $value));
	}
}
