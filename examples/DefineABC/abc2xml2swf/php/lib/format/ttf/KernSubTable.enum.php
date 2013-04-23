<?php

class format_ttf_KernSubTable extends Enum {
	public static function KernSub0($kerningPairs) { return new format_ttf_KernSubTable("KernSub0", 0, array($kerningPairs)); }
	public static function KernSub1($array) { return new format_ttf_KernSubTable("KernSub1", 1, array($array)); }
	public static $__constructors = array(0 => 'KernSub0', 1 => 'KernSub1');
	}
