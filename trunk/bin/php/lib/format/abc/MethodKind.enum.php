<?php

class format_abc_MethodKind extends Enum {
		public static $KGetter;
		public static $KNormal;
		public static $KSetter;
	}
	format_abc_MethodKind::$KGetter = new format_abc_MethodKind("KGetter", 1);
	format_abc_MethodKind::$KNormal = new format_abc_MethodKind("KNormal", 0);
	format_abc_MethodKind::$KSetter = new format_abc_MethodKind("KSetter", 2);
