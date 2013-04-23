<?php

class format_ttf_Table extends Enum {
	public static function TCmap($subtables) { return new format_ttf_Table("TCmap", 2, array($subtables)); }
	public static function TGlyf($descriptions) { return new format_ttf_Table("TGlyf", 0, array($descriptions)); }
	public static function THead($data) { return new format_ttf_Table("THead", 5, array($data)); }
	public static function THhea($data) { return new format_ttf_Table("THhea", 6, array($data)); }
	public static function THmtx($metrics) { return new format_ttf_Table("THmtx", 1, array($metrics)); }
	public static function TKern($kerning) { return new format_ttf_Table("TKern", 3, array($kerning)); }
	public static function TLoca($data) { return new format_ttf_Table("TLoca", 7, array($data)); }
	public static function TMaxp($data) { return new format_ttf_Table("TMaxp", 8, array($data)); }
	public static function TName($records) { return new format_ttf_Table("TName", 4, array($records)); }
	public static function TOS2($data) { return new format_ttf_Table("TOS2", 10, array($data)); }
	public static function TPost($data) { return new format_ttf_Table("TPost", 9, array($data)); }
	public static function TUnkn($bytes) { return new format_ttf_Table("TUnkn", 11, array($bytes)); }
	public static $__constructors = array(2 => 'TCmap', 0 => 'TGlyf', 5 => 'THead', 6 => 'THhea', 1 => 'THmtx', 3 => 'TKern', 7 => 'TLoca', 8 => 'TMaxp', 4 => 'TName', 10 => 'TOS2', 9 => 'TPost', 11 => 'TUnkn');
	}
