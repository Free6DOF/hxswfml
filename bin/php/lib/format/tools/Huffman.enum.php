<?php

class format_tools_Huffman extends Enum {
		public static function Found($i) { return new format_tools_Huffman("Found", 0, array($i)); }
		public static function NeedBit($left, $right) { return new format_tools_Huffman("NeedBit", 1, array($left, $right)); }
		public static function NeedBits($n, $table) { return new format_tools_Huffman("NeedBits", 2, array($n, $table)); }
	}
