<?php

class format_abc_Namespace extends Enum {
		public static function NExplicit($ns) { return new format_abc_Namespace("NExplicit", 5, array($ns)); }
		public static function NInternal($ns) { return new format_abc_Namespace("NInternal", 3, array($ns)); }
		public static function NNamespace($ns) { return new format_abc_Namespace("NNamespace", 1, array($ns)); }
		public static function NPrivate($ns) { return new format_abc_Namespace("NPrivate", 0, array($ns)); }
		public static function NProtected($ns) { return new format_abc_Namespace("NProtected", 4, array($ns)); }
		public static function NPublic($ns) { return new format_abc_Namespace("NPublic", 2, array($ns)); }
		public static function NStaticProtected($ns) { return new format_abc_Namespace("NStaticProtected", 6, array($ns)); }
	}
