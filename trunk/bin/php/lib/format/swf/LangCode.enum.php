<?php

class format_swf_LangCode extends Enum {
		public static $LCJapanese;
		public static $LCKorean;
		public static $LCLatin;
		public static $LCNone;
		public static $LCSimplifiedChinese;
		public static $LCTraditionalChinese;
	}
	format_swf_LangCode::$LCJapanese = new format_swf_LangCode("LCJapanese", 2);
	format_swf_LangCode::$LCKorean = new format_swf_LangCode("LCKorean", 3);
	format_swf_LangCode::$LCLatin = new format_swf_LangCode("LCLatin", 1);
	format_swf_LangCode::$LCNone = new format_swf_LangCode("LCNone", 0);
	format_swf_LangCode::$LCSimplifiedChinese = new format_swf_LangCode("LCSimplifiedChinese", 4);
	format_swf_LangCode::$LCTraditionalChinese = new format_swf_LangCode("LCTraditionalChinese", 5);
