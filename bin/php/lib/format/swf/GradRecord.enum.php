<?php

class format_swf_GradRecord extends Enum {
		public static function GRRGB($pos, $col) { return new format_swf_GradRecord("GRRGB", 0, array($pos, $col)); }
		public static function GRRGBA($pos, $col) { return new format_swf_GradRecord("GRRGBA", 1, array($pos, $col)); }
	}
