<?php

class format_abc_Value extends Enum {
	public static function VBool($b) { return new format_abc_Value("VBool", 1, array($b)); }
	public static function VFloat($f) { return new format_abc_Value("VFloat", 5, array($f)); }
	public static function VInt($i) { return new format_abc_Value("VInt", 3, array($i)); }
	public static function VNamespace($kind, $ns) { return new format_abc_Value("VNamespace", 6, array($kind, $ns)); }
	public static $VNull;
	public static function VString($i) { return new format_abc_Value("VString", 2, array($i)); }
	public static function VUInt($i) { return new format_abc_Value("VUInt", 4, array($i)); }
	public static $__constructors = array(1 => 'VBool', 5 => 'VFloat', 3 => 'VInt', 6 => 'VNamespace', 0 => 'VNull', 2 => 'VString', 4 => 'VUInt');
	}
format_abc_Value::$VNull = new format_abc_Value("VNull", 0);
