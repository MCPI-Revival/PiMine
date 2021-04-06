<?php

declare(strict_types = 1);

namespace pimine\constant;

class RakNetProtocolInfo {
	public const PROTOCOL_VERSION = 5;
	public const ONLINE_PING = 0x00;
	public const OFFLINE_PING = 0x01;
	public const OFFLINE_PING_OPEN_CONNECTION = 0x02;
	public const ONLINE_PONG = 0x03;
	public const OPEN_CONNECTION_REQUEST_1 = 0x05;
	public const OPEN_CONNECTION_REPLY_1 = 0x06;
	public const OPEN_CONNECTION_REQUEST_2 = 0x07;
	public const OPEN_CONNECTION_REPLY_2 = 0x08;
	public const CONNECTION_REQUEST = 0x09;
	public const CONNECTION_REQUEST_ACCEPTED = 0x10;
	public const NEW_INCOMMING_CONNECTION = 0x13;
	public const DISCONNECT = 0x15;
	public const INCOMPATIBLE_PROTOCOL_VERSION = 0x1A;
	public const OFFLINE_PONG = 0x1C;
	public const FRAME_SET_0 = 0x80;
	public const FRAME_SET_1 = 0x81;
	public const FRAME_SET_2 = 0x82;
	public const FRAME_SET_3 = 0x83;
	public const FRAME_SET_4 = 0x84;
	public const FRAME_SET_5 = 0x85;
	public const FRAME_SET_6 = 0x86;
	public const FRAME_SET_7 = 0x87;
	public const FRAME_SET_8 = 0x88;
	public const FRAME_SET_9 = 0x89;
	public const FRAME_SET_A = 0x8A;
	public const FRAME_SET_B = 0x8B;
	public const FRAME_SET_C = 0x8C;
	public const FRAME_SET_D = 0x8D;
	public const FRAME_SET_E = 0x8E;
	public const FRAME_SET_F = 0x8F;
	public const NACK = 0xA0;
	public const ACK = 0xC0;
}
