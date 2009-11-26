<?php

class format_abc_FieldKind extends Enum {
		public static function FClass($c) { return new format_abc_FieldKind("FClass", 2, array($c)); }
		public static function FFunction($f) { return new format_abc_FieldKind("FFunction", 3, array($f)); }
		public static function FMethod($type, $k, $isOverride = null, $isFinal = null) { return new format_abc_FieldKind("FMethod", 1, array($type, $k, $isOverride, $isFinal)); }
		public static function FVar($type = null, $value = null, $_const = null) { return new format_abc_FieldKind("FVar", 0, array($type, $value, $_const)); }
	}
