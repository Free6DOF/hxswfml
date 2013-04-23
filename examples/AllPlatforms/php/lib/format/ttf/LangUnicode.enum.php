<?php

class format_ttf_LangUnicode extends Enum {
	public static $Default;
	public static $ISO10646;
	public static $Unicode2;
	public static $Version11;
	public static $__constructors = array(0 => 'Default', 2 => 'ISO10646', 3 => 'Unicode2', 1 => 'Version11');
	}
format_ttf_LangUnicode::$Default = new format_ttf_LangUnicode("Default", 0);
format_ttf_LangUnicode::$ISO10646 = new format_ttf_LangUnicode("ISO10646", 2);
format_ttf_LangUnicode::$Unicode2 = new format_ttf_LangUnicode("Unicode2", 3);
format_ttf_LangUnicode::$Version11 = new format_ttf_LangUnicode("Version11", 1);
