<?php

class format_ttf_GlyfDescription extends Enum {
	public static function TGlyphComposite($header, $components) { return new format_ttf_GlyfDescription("TGlyphComposite", 1, array($header, $components)); }
	public static $TGlyphNull;
	public static function TGlyphSimple($header, $data) { return new format_ttf_GlyfDescription("TGlyphSimple", 0, array($header, $data)); }
	public static $__constructors = array(1 => 'TGlyphComposite', 2 => 'TGlyphNull', 0 => 'TGlyphSimple');
	}
format_ttf_GlyfDescription::$TGlyphNull = new format_ttf_GlyfDescription("TGlyphNull", 2);
