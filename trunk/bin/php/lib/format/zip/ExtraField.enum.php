<?php

class format_zip_ExtraField extends Enum {
		public static function FInfoZipUnicodePath($name, $crc) { return new format_zip_ExtraField("FInfoZipUnicodePath", 1, array($name, $crc)); }
		public static function FUnknown($tag, $bytes) { return new format_zip_ExtraField("FUnknown", 0, array($tag, $bytes)); }
	}
