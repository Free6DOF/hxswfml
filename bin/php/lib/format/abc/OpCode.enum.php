<?php

class format_abc_OpCode extends Enum {
		public static function OApplyType($nargs) { return new format_abc_OpCode("OApplyType", 50, array($nargs)); }
		public static function OArray($nvalues) { return new format_abc_OpCode("OArray", 52, array($nvalues)); }
		public static $OAsAny;
		public static $OAsObject;
		public static $OAsString;
		public static function OAsType($t) { return new format_abc_OpCode("OAsType", 85, array($t)); }
		public static $OBreakPoint;
		public static function OBreakPointLine($n) { return new format_abc_OpCode("OBreakPointLine", 99, array($n)); }
		public static function OCallMethod($slot, $nargs) { return new format_abc_OpCode("OCallMethod", 39, array($slot, $nargs)); }
		public static function OCallPropLex($name, $nargs) { return new format_abc_OpCode("OCallPropLex", 47, array($name, $nargs)); }
		public static function OCallPropVoid($name, $nargs) { return new format_abc_OpCode("OCallPropVoid", 49, array($name, $nargs)); }
		public static function OCallProperty($name, $nargs) { return new format_abc_OpCode("OCallProperty", 42, array($name, $nargs)); }
		public static function OCallStack($nargs) { return new format_abc_OpCode("OCallStack", 37, array($nargs)); }
		public static function OCallStatic($meth, $nargs) { return new format_abc_OpCode("OCallStatic", 40, array($meth, $nargs)); }
		public static function OCallSuper($name, $nargs) { return new format_abc_OpCode("OCallSuper", 41, array($name, $nargs)); }
		public static function OCallSuperVoid($name, $nargs) { return new format_abc_OpCode("OCallSuperVoid", 48, array($name, $nargs)); }
		public static function OCast($t) { return new format_abc_OpCode("OCast", 82, array($t)); }
		public static function OCatch($c) { return new format_abc_OpCode("OCatch", 56, array($c)); }
		public static $OCheckIsXml;
		public static function OClassDef($c) { return new format_abc_OpCode("OClassDef", 54, array($c)); }
		public static function OConstruct($nargs) { return new format_abc_OpCode("OConstruct", 38, array($nargs)); }
		public static function OConstructProperty($name, $nargs) { return new format_abc_OpCode("OConstructProperty", 46, array($name, $nargs)); }
		public static function OConstructSuper($nargs) { return new format_abc_OpCode("OConstructSuper", 45, array($nargs)); }
		public static function ODebugFile($file) { return new format_abc_OpCode("ODebugFile", 98, array($file)); }
		public static function ODebugLine($line) { return new format_abc_OpCode("ODebugLine", 97, array($line)); }
		public static function ODebugReg($name, $r, $line) { return new format_abc_OpCode("ODebugReg", 96, array($name, $r, $line)); }
		public static function ODecrIReg($r) { return new format_abc_OpCode("ODecrIReg", 93, array($r)); }
		public static function ODecrReg($r) { return new format_abc_OpCode("ODecrReg", 88, array($r)); }
		public static function ODeleteProp($p) { return new format_abc_OpCode("ODeleteProp", 68, array($p)); }
		public static $ODup;
		public static function ODxNs($v) { return new format_abc_OpCode("ODxNs", 5, array($v)); }
		public static $ODxNsLate;
		public static $OFalse;
		public static function OFindDefinition($d) { return new format_abc_OpCode("OFindDefinition", 59, array($d)); }
		public static function OFindProp($p) { return new format_abc_OpCode("OFindProp", 58, array($p)); }
		public static function OFindPropStrict($p) { return new format_abc_OpCode("OFindPropStrict", 57, array($p)); }
		public static function OFloat($v) { return new format_abc_OpCode("OFloat", 32, array($v)); }
		public static $OForEach;
		public static $OForIn;
		public static function OFunction($f) { return new format_abc_OpCode("OFunction", 36, array($f)); }
		public static function OGetDescendants($c) { return new format_abc_OpCode("OGetDescendants", 55, array($c)); }
		public static $OGetGlobalScope;
		public static function OGetGlobalSlot($s) { return new format_abc_OpCode("OGetGlobalSlot", 71, array($s)); }
		public static function OGetLex($p) { return new format_abc_OpCode("OGetLex", 60, array($p)); }
		public static function OGetProp($p) { return new format_abc_OpCode("OGetProp", 66, array($p)); }
		public static function OGetScope($n) { return new format_abc_OpCode("OGetScope", 65, array($n)); }
		public static function OGetSlot($s) { return new format_abc_OpCode("OGetSlot", 69, array($s)); }
		public static function OGetSuper($v) { return new format_abc_OpCode("OGetSuper", 3, array($v)); }
		public static $OHasNext;
		public static function OIncrIReg($r) { return new format_abc_OpCode("OIncrIReg", 92, array($r)); }
		public static function OIncrReg($r) { return new format_abc_OpCode("OIncrReg", 87, array($r)); }
		public static function OInitProp($p) { return new format_abc_OpCode("OInitProp", 67, array($p)); }
		public static $OInstanceOf;
		public static function OInt($v) { return new format_abc_OpCode("OInt", 22, array($v)); }
		public static function OIntRef($v) { return new format_abc_OpCode("OIntRef", 30, array($v)); }
		public static function OIsType($t) { return new format_abc_OpCode("OIsType", 91, array($t)); }
		public static function OJump($j, $delta) { return new format_abc_OpCode("OJump", 10, array($j, $delta)); }
		public static function OJump2($j, $landingName, $delta) { return new format_abc_OpCode("OJump2", 11, array($j, $landingName, $delta)); }
		public static function OJump3($landingName) { return new format_abc_OpCode("OJump3", 12, array($landingName)); }
		public static $OLabel;
		public static function OLabel2($name) { return new format_abc_OpCode("OLabel2", 9, array($name)); }
		public static $ONaN;
		public static function ONamespace($v) { return new format_abc_OpCode("ONamespace", 34, array($v)); }
		public static $ONewBlock;
		public static function ONext($r1, $r2) { return new format_abc_OpCode("ONext", 35, array($r1, $r2)); }
		public static $ONop;
		public static $ONull;
		public static function OObject($nfields) { return new format_abc_OpCode("OObject", 51, array($nfields)); }
		public static function OOp($op) { return new format_abc_OpCode("OOp", 101, array($op)); }
		public static $OPop;
		public static $OPopScope;
		public static $OPushWith;
		public static function OReg($r) { return new format_abc_OpCode("OReg", 62, array($r)); }
		public static function ORegKill($r) { return new format_abc_OpCode("ORegKill", 7, array($r)); }
		public static $ORet;
		public static $ORetVoid;
		public static $OScope;
		public static function OSetGlobalSlot($s) { return new format_abc_OpCode("OSetGlobalSlot", 72, array($s)); }
		public static function OSetProp($p) { return new format_abc_OpCode("OSetProp", 61, array($p)); }
		public static function OSetReg($r) { return new format_abc_OpCode("OSetReg", 63, array($r)); }
		public static function OSetSlot($s) { return new format_abc_OpCode("OSetSlot", 70, array($s)); }
		public static function OSetSuper($v) { return new format_abc_OpCode("OSetSuper", 4, array($v)); }
		public static $OSetThis;
		public static function OSmallInt($v) { return new format_abc_OpCode("OSmallInt", 21, array($v)); }
		public static function OString($v) { return new format_abc_OpCode("OString", 29, array($v)); }
		public static $OSwap;
		public static function OSwitch($def, $deltas) { return new format_abc_OpCode("OSwitch", 13, array($def, $deltas)); }
		public static $OThis;
		public static $OThrow;
		public static $OTimestamp;
		public static $OToBool;
		public static $OToInt;
		public static $OToNumber;
		public static $OToObject;
		public static $OToString;
		public static $OToUInt;
		public static $OToXml;
		public static $OToXmlAttr;
		public static $OTrue;
		public static $OTypeof;
		public static function OUIntRef($v) { return new format_abc_OpCode("OUIntRef", 31, array($v)); }
		public static $OUndefined;
		public static function OUnknown($byte) { return new format_abc_OpCode("OUnknown", 102, array($byte)); }
	}
	format_abc_OpCode::$OAsAny = new format_abc_OpCode("OAsAny", 83);
	format_abc_OpCode::$OAsObject = new format_abc_OpCode("OAsObject", 86);
	format_abc_OpCode::$OAsString = new format_abc_OpCode("OAsString", 84);
	format_abc_OpCode::$OBreakPoint = new format_abc_OpCode("OBreakPoint", 0);
	format_abc_OpCode::$OCheckIsXml = new format_abc_OpCode("OCheckIsXml", 81);
	format_abc_OpCode::$ODup = new format_abc_OpCode("ODup", 27);
	format_abc_OpCode::$ODxNsLate = new format_abc_OpCode("ODxNsLate", 6);
	format_abc_OpCode::$OFalse = new format_abc_OpCode("OFalse", 24);
	format_abc_OpCode::$OForEach = new format_abc_OpCode("OForEach", 20);
	format_abc_OpCode::$OForIn = new format_abc_OpCode("OForIn", 16);
	format_abc_OpCode::$OGetGlobalScope = new format_abc_OpCode("OGetGlobalScope", 64);
	format_abc_OpCode::$OHasNext = new format_abc_OpCode("OHasNext", 17);
	format_abc_OpCode::$OInstanceOf = new format_abc_OpCode("OInstanceOf", 90);
	format_abc_OpCode::$OLabel = new format_abc_OpCode("OLabel", 8);
	format_abc_OpCode::$ONaN = new format_abc_OpCode("ONaN", 25);
	format_abc_OpCode::$ONewBlock = new format_abc_OpCode("ONewBlock", 53);
	format_abc_OpCode::$ONop = new format_abc_OpCode("ONop", 1);
	format_abc_OpCode::$ONull = new format_abc_OpCode("ONull", 18);
	format_abc_OpCode::$OPop = new format_abc_OpCode("OPop", 26);
	format_abc_OpCode::$OPopScope = new format_abc_OpCode("OPopScope", 15);
	format_abc_OpCode::$OPushWith = new format_abc_OpCode("OPushWith", 14);
	format_abc_OpCode::$ORet = new format_abc_OpCode("ORet", 44);
	format_abc_OpCode::$ORetVoid = new format_abc_OpCode("ORetVoid", 43);
	format_abc_OpCode::$OScope = new format_abc_OpCode("OScope", 33);
	format_abc_OpCode::$OSetThis = new format_abc_OpCode("OSetThis", 95);
	format_abc_OpCode::$OSwap = new format_abc_OpCode("OSwap", 28);
	format_abc_OpCode::$OThis = new format_abc_OpCode("OThis", 94);
	format_abc_OpCode::$OThrow = new format_abc_OpCode("OThrow", 2);
	format_abc_OpCode::$OTimestamp = new format_abc_OpCode("OTimestamp", 100);
	format_abc_OpCode::$OToBool = new format_abc_OpCode("OToBool", 79);
	format_abc_OpCode::$OToInt = new format_abc_OpCode("OToInt", 76);
	format_abc_OpCode::$OToNumber = new format_abc_OpCode("OToNumber", 78);
	format_abc_OpCode::$OToObject = new format_abc_OpCode("OToObject", 80);
	format_abc_OpCode::$OToString = new format_abc_OpCode("OToString", 73);
	format_abc_OpCode::$OToUInt = new format_abc_OpCode("OToUInt", 77);
	format_abc_OpCode::$OToXml = new format_abc_OpCode("OToXml", 74);
	format_abc_OpCode::$OToXmlAttr = new format_abc_OpCode("OToXmlAttr", 75);
	format_abc_OpCode::$OTrue = new format_abc_OpCode("OTrue", 23);
	format_abc_OpCode::$OTypeof = new format_abc_OpCode("OTypeof", 89);
	format_abc_OpCode::$OUndefined = new format_abc_OpCode("OUndefined", 19);
