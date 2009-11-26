<?php

class format_abc_OpCode extends Enum {
		public static function OApplyType($nargs) { return new format_abc_OpCode("OApplyType", 47, array($nargs)); }
		public static function OArray($nvalues) { return new format_abc_OpCode("OArray", 49, array($nvalues)); }
		public static $OAsAny;
		public static $OAsObject;
		public static $OAsString;
		public static function OAsType($t) { return new format_abc_OpCode("OAsType", 80, array($t)); }
		public static $OBreakPoint;
		public static function OBreakPointLine($n) { return new format_abc_OpCode("OBreakPointLine", 94, array($n)); }
		public static function OCallMethod($slot, $nargs) { return new format_abc_OpCode("OCallMethod", 36, array($slot, $nargs)); }
		public static function OCallPropLex($name, $nargs) { return new format_abc_OpCode("OCallPropLex", 44, array($name, $nargs)); }
		public static function OCallPropVoid($name, $nargs) { return new format_abc_OpCode("OCallPropVoid", 46, array($name, $nargs)); }
		public static function OCallProperty($name, $nargs) { return new format_abc_OpCode("OCallProperty", 39, array($name, $nargs)); }
		public static function OCallStack($nargs) { return new format_abc_OpCode("OCallStack", 34, array($nargs)); }
		public static function OCallStatic($meth, $nargs) { return new format_abc_OpCode("OCallStatic", 37, array($meth, $nargs)); }
		public static function OCallSuper($name, $nargs) { return new format_abc_OpCode("OCallSuper", 38, array($name, $nargs)); }
		public static function OCallSuperVoid($name, $nargs) { return new format_abc_OpCode("OCallSuperVoid", 45, array($name, $nargs)); }
		public static function OCast($t) { return new format_abc_OpCode("OCast", 77, array($t)); }
		public static function OCatch($c) { return new format_abc_OpCode("OCatch", 53, array($c)); }
		public static $OCheckIsXml;
		public static function OClassDef($c) { return new format_abc_OpCode("OClassDef", 51, array($c)); }
		public static function OConstruct($nargs) { return new format_abc_OpCode("OConstruct", 35, array($nargs)); }
		public static function OConstructProperty($name, $nargs) { return new format_abc_OpCode("OConstructProperty", 43, array($name, $nargs)); }
		public static function OConstructSuper($nargs) { return new format_abc_OpCode("OConstructSuper", 42, array($nargs)); }
		public static function ODebugFile($file) { return new format_abc_OpCode("ODebugFile", 93, array($file)); }
		public static function ODebugLine($line) { return new format_abc_OpCode("ODebugLine", 92, array($line)); }
		public static function ODebugReg($name, $r, $line) { return new format_abc_OpCode("ODebugReg", 91, array($name, $r, $line)); }
		public static function ODecrIReg($r) { return new format_abc_OpCode("ODecrIReg", 88, array($r)); }
		public static function ODecrReg($r) { return new format_abc_OpCode("ODecrReg", 83, array($r)); }
		public static function ODeleteProp($p) { return new format_abc_OpCode("ODeleteProp", 65, array($p)); }
		public static $ODup;
		public static function ODxNs($v) { return new format_abc_OpCode("ODxNs", 5, array($v)); }
		public static $ODxNsLate;
		public static $OFalse;
		public static function OFindDefinition($d) { return new format_abc_OpCode("OFindDefinition", 56, array($d)); }
		public static function OFindProp($p) { return new format_abc_OpCode("OFindProp", 55, array($p)); }
		public static function OFindPropStrict($p) { return new format_abc_OpCode("OFindPropStrict", 54, array($p)); }
		public static function OFloat($v) { return new format_abc_OpCode("OFloat", 29, array($v)); }
		public static $OForEach;
		public static $OForIn;
		public static function OFunction($f) { return new format_abc_OpCode("OFunction", 33, array($f)); }
		public static function OGetDescendants($c) { return new format_abc_OpCode("OGetDescendants", 52, array($c)); }
		public static $OGetGlobalScope;
		public static function OGetLex($p) { return new format_abc_OpCode("OGetLex", 57, array($p)); }
		public static function OGetProp($p) { return new format_abc_OpCode("OGetProp", 63, array($p)); }
		public static function OGetScope($n) { return new format_abc_OpCode("OGetScope", 62, array($n)); }
		public static function OGetSlot($s) { return new format_abc_OpCode("OGetSlot", 66, array($s)); }
		public static function OGetSuper($v) { return new format_abc_OpCode("OGetSuper", 3, array($v)); }
		public static $OHasNext;
		public static function OIncrIReg($r) { return new format_abc_OpCode("OIncrIReg", 87, array($r)); }
		public static function OIncrReg($r) { return new format_abc_OpCode("OIncrReg", 82, array($r)); }
		public static function OInitProp($p) { return new format_abc_OpCode("OInitProp", 64, array($p)); }
		public static $OInstanceOf;
		public static function OInt($v) { return new format_abc_OpCode("OInt", 19, array($v)); }
		public static function OIntRef($v) { return new format_abc_OpCode("OIntRef", 27, array($v)); }
		public static function OIsType($t) { return new format_abc_OpCode("OIsType", 86, array($t)); }
		public static function OJump($j, $delta) { return new format_abc_OpCode("OJump", 9, array($j, $delta)); }
		public static $OLabel;
		public static $ONaN;
		public static function ONamespace($v) { return new format_abc_OpCode("ONamespace", 31, array($v)); }
		public static $ONewBlock;
		public static function ONext($r1, $r2) { return new format_abc_OpCode("ONext", 32, array($r1, $r2)); }
		public static $ONop;
		public static $ONull;
		public static function OObject($nfields) { return new format_abc_OpCode("OObject", 48, array($nfields)); }
		public static function OOp($op) { return new format_abc_OpCode("OOp", 96, array($op)); }
		public static $OPop;
		public static $OPopScope;
		public static $OPushWith;
		public static function OReg($r) { return new format_abc_OpCode("OReg", 59, array($r)); }
		public static function ORegKill($r) { return new format_abc_OpCode("ORegKill", 7, array($r)); }
		public static $ORet;
		public static $ORetVoid;
		public static $OScope;
		public static function OSetProp($p) { return new format_abc_OpCode("OSetProp", 58, array($p)); }
		public static function OSetReg($r) { return new format_abc_OpCode("OSetReg", 60, array($r)); }
		public static function OSetSlot($s) { return new format_abc_OpCode("OSetSlot", 67, array($s)); }
		public static function OSetSuper($v) { return new format_abc_OpCode("OSetSuper", 4, array($v)); }
		public static $OSetThis;
		public static function OSmallInt($v) { return new format_abc_OpCode("OSmallInt", 18, array($v)); }
		public static function OString($v) { return new format_abc_OpCode("OString", 26, array($v)); }
		public static $OSwap;
		public static function OSwitch($def, $deltas) { return new format_abc_OpCode("OSwitch", 10, array($def, $deltas)); }
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
		public static function OUIntRef($v) { return new format_abc_OpCode("OUIntRef", 28, array($v)); }
		public static $OUndefined;
		public static function OUnknown($byte) { return new format_abc_OpCode("OUnknown", 97, array($byte)); }
	}
	format_abc_OpCode::$OAsAny = new format_abc_OpCode("OAsAny", 78);
	format_abc_OpCode::$OAsObject = new format_abc_OpCode("OAsObject", 81);
	format_abc_OpCode::$OAsString = new format_abc_OpCode("OAsString", 79);
	format_abc_OpCode::$OBreakPoint = new format_abc_OpCode("OBreakPoint", 0);
	format_abc_OpCode::$OCheckIsXml = new format_abc_OpCode("OCheckIsXml", 76);
	format_abc_OpCode::$ODup = new format_abc_OpCode("ODup", 24);
	format_abc_OpCode::$ODxNsLate = new format_abc_OpCode("ODxNsLate", 6);
	format_abc_OpCode::$OFalse = new format_abc_OpCode("OFalse", 21);
	format_abc_OpCode::$OForEach = new format_abc_OpCode("OForEach", 17);
	format_abc_OpCode::$OForIn = new format_abc_OpCode("OForIn", 13);
	format_abc_OpCode::$OGetGlobalScope = new format_abc_OpCode("OGetGlobalScope", 61);
	format_abc_OpCode::$OHasNext = new format_abc_OpCode("OHasNext", 14);
	format_abc_OpCode::$OInstanceOf = new format_abc_OpCode("OInstanceOf", 85);
	format_abc_OpCode::$OLabel = new format_abc_OpCode("OLabel", 8);
	format_abc_OpCode::$ONaN = new format_abc_OpCode("ONaN", 22);
	format_abc_OpCode::$ONewBlock = new format_abc_OpCode("ONewBlock", 50);
	format_abc_OpCode::$ONop = new format_abc_OpCode("ONop", 1);
	format_abc_OpCode::$ONull = new format_abc_OpCode("ONull", 15);
	format_abc_OpCode::$OPop = new format_abc_OpCode("OPop", 23);
	format_abc_OpCode::$OPopScope = new format_abc_OpCode("OPopScope", 12);
	format_abc_OpCode::$OPushWith = new format_abc_OpCode("OPushWith", 11);
	format_abc_OpCode::$ORet = new format_abc_OpCode("ORet", 41);
	format_abc_OpCode::$ORetVoid = new format_abc_OpCode("ORetVoid", 40);
	format_abc_OpCode::$OScope = new format_abc_OpCode("OScope", 30);
	format_abc_OpCode::$OSetThis = new format_abc_OpCode("OSetThis", 90);
	format_abc_OpCode::$OSwap = new format_abc_OpCode("OSwap", 25);
	format_abc_OpCode::$OThis = new format_abc_OpCode("OThis", 89);
	format_abc_OpCode::$OThrow = new format_abc_OpCode("OThrow", 2);
	format_abc_OpCode::$OTimestamp = new format_abc_OpCode("OTimestamp", 95);
	format_abc_OpCode::$OToBool = new format_abc_OpCode("OToBool", 74);
	format_abc_OpCode::$OToInt = new format_abc_OpCode("OToInt", 71);
	format_abc_OpCode::$OToNumber = new format_abc_OpCode("OToNumber", 73);
	format_abc_OpCode::$OToObject = new format_abc_OpCode("OToObject", 75);
	format_abc_OpCode::$OToString = new format_abc_OpCode("OToString", 68);
	format_abc_OpCode::$OToUInt = new format_abc_OpCode("OToUInt", 72);
	format_abc_OpCode::$OToXml = new format_abc_OpCode("OToXml", 69);
	format_abc_OpCode::$OToXmlAttr = new format_abc_OpCode("OToXmlAttr", 70);
	format_abc_OpCode::$OTrue = new format_abc_OpCode("OTrue", 20);
	format_abc_OpCode::$OTypeof = new format_abc_OpCode("OTypeof", 84);
	format_abc_OpCode::$OUndefined = new format_abc_OpCode("OUndefined", 16);
