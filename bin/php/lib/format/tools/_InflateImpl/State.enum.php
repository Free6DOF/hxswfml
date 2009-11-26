<?php

class format_tools__InflateImpl_State extends Enum {
		public static $Block;
		public static $CData;
		public static $Crc;
		public static $Dist;
		public static $DistOne;
		public static $Done;
		public static $Flat;
		public static $Head;
	}
	format_tools__InflateImpl_State::$Block = new format_tools__InflateImpl_State("Block", 1);
	format_tools__InflateImpl_State::$CData = new format_tools__InflateImpl_State("CData", 2);
	format_tools__InflateImpl_State::$Crc = new format_tools__InflateImpl_State("Crc", 4);
	format_tools__InflateImpl_State::$Dist = new format_tools__InflateImpl_State("Dist", 5);
	format_tools__InflateImpl_State::$DistOne = new format_tools__InflateImpl_State("DistOne", 6);
	format_tools__InflateImpl_State::$Done = new format_tools__InflateImpl_State("Done", 7);
	format_tools__InflateImpl_State::$Flat = new format_tools__InflateImpl_State("Flat", 3);
	format_tools__InflateImpl_State::$Head = new format_tools__InflateImpl_State("Head", 0);
