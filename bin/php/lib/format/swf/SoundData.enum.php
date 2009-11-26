<?php

class format_swf_SoundData extends Enum {
		public static function SDMp3($seek, $data) { return new format_swf_SoundData("SDMp3", 0, array($seek, $data)); }
		public static function SDOther($data) { return new format_swf_SoundData("SDOther", 2, array($data)); }
		public static function SDRaw($data) { return new format_swf_SoundData("SDRaw", 1, array($data)); }
	}
