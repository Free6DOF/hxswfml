<?php

class format_zip_ExtraField extends Enum {
	public static function FInfoZipUnicodePath($name, $crc) { return new format_zip_ExtraField("FInfoZipUnicodePath", 1, array($name, $crc)); }
	public static function FUnknown($tag, $bytes) { return new format_zip_ExtraField("FUnknown", 0, array($tag, $bytes)); }
	public static $FUtf8;
	public static $__constructors = array(1 => 'FInfoZipUnicodePath', 0 => 'FUnknown', 2 => 'FUtf8');
	}
format_zip_ExtraField::$FUtf8 = new format_zip_ExtraField("FUtf8", 2);
