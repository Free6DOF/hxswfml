<?php

class format_amf_Value extends Enum {
	public static function AArray($values) { return new format_amf_Value("AArray", 7, array($values)); }
	public static function ABool($b) { return new format_amf_Value("ABool", 1, array($b)); }
	public static function ADate($d) { return new format_amf_Value("ADate", 4, array($d)); }
	public static $ANull;
	public static function ANumber($f) { return new format_amf_Value("ANumber", 0, array($f)); }
	public static function AObject($fields, $size = null) { return new format_amf_Value("AObject", 3, array($fields, $size)); }
	public static function AString($s) { return new format_amf_Value("AString", 2, array($s)); }
	public static $AUndefined;
	public static $__constructors = array(7 => 'AArray', 1 => 'ABool', 4 => 'ADate', 6 => 'ANull', 0 => 'ANumber', 3 => 'AObject', 2 => 'AString', 5 => 'AUndefined');
	}
format_amf_Value::$ANull = new format_amf_Value("ANull", 6);
format_amf_Value::$AUndefined = new format_amf_Value("AUndefined", 5);
