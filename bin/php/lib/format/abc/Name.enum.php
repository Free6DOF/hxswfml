<?php

class format_abc_Name extends Enum {
		public static function NAttrib($n) { return new format_abc_Name("NAttrib", 5, array($n)); }
		public static function NMulti($name, $ns) { return new format_abc_Name("NMulti", 1, array($name, $ns)); }
		public static function NMultiLate($nset) { return new format_abc_Name("NMultiLate", 4, array($nset)); }
		public static function NName($name, $ns) { return new format_abc_Name("NName", 0, array($name, $ns)); }
		public static function NParams($n, $params) { return new format_abc_Name("NParams", 6, array($n, $params)); }
		public static function NRuntime($name) { return new format_abc_Name("NRuntime", 2, array($name)); }
		public static $NRuntimeLate;
	}
	format_abc_Name::$NRuntimeLate = new format_abc_Name("NRuntimeLate", 3);
