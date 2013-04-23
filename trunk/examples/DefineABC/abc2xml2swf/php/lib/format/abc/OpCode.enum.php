<?php

class format_abc_OpCode extends Enum {
	public static function OApplyType($nargs) { return new format_abc_OpCode("OApplyType", 52, array($nargs)); }
	public static function OArray($nvalues) { return new format_abc_OpCode("OArray", 54, array($nvalues)); }
	public static $OAsAny;
	public static $OAsObject;
	public static $OAsString;
	public static function OAsType($t) { return new format_abc_OpCode("OAsType", 87, array($t)); }
	public static $OBreakPoint;
	public static function OBreakPointLine($n) { return new format_abc_OpCode("OBreakPointLine", 101, array($n)); }
	public static function OCallMethod($slot, $nargs) { return new format_abc_OpCode("OCallMethod", 41, array($slot, $nargs)); }
	public static function OCallPropLex($name, $nargs) { return new format_abc_OpCode("OCallPropLex", 49, array($name, $nargs)); }
	public static function OCallPropVoid($name, $nargs) { return new format_abc_OpCode("OCallPropVoid", 51, array($name, $nargs)); }
	public static function OCallProperty($name, $nargs) { return new format_abc_OpCode("OCallProperty", 44, array($name, $nargs)); }
	public static function OCallStack($nargs) { return new format_abc_OpCode("OCallStack", 39, array($nargs)); }
	public static function OCallStatic($meth, $nargs) { return new format_abc_OpCode("OCallStatic", 42, array($meth, $nargs)); }
	public static function OCallSuper($name, $nargs) { return new format_abc_OpCode("OCallSuper", 43, array($name, $nargs)); }
	public static function OCallSuperVoid($name, $nargs) { return new format_abc_OpCode("OCallSuperVoid", 50, array($name, $nargs)); }
	public static function OCase($landingName) { return new format_abc_OpCode("OCase", 15, array($landingName)); }
	public static function OCast($t) { return new format_abc_OpCode("OCast", 84, array($t)); }
	public static function OCatch($c) { return new format_abc_OpCode("OCatch", 58, array($c)); }
	public static $OCheckIsXml;
	public static function OClassDef($c) { return new format_abc_OpCode("OClassDef", 56, array($c)); }
	public static function OConstruct($nargs) { return new format_abc_OpCode("OConstruct", 40, array($nargs)); }
	public static function OConstructProperty($name, $nargs) { return new format_abc_OpCode("OConstructProperty", 48, array($name, $nargs)); }
	public static function OConstructSuper($nargs) { return new format_abc_OpCode("OConstructSuper", 47, array($nargs)); }
	public static function ODebugFile($file) { return new format_abc_OpCode("ODebugFile", 100, array($file)); }
	public static function ODebugLine($line) { return new format_abc_OpCode("ODebugLine", 99, array($line)); }
	public static function ODebugReg($name, $r, $line) { return new format_abc_OpCode("ODebugReg", 98, array($name, $r, $line)); }
	public static function ODecrIReg($r) { return new format_abc_OpCode("ODecrIReg", 95, array($r)); }
	public static function ODecrReg($r) { return new format_abc_OpCode("ODecrReg", 90, array($r)); }
	public static function ODeleteProp($p) { return new format_abc_OpCode("ODeleteProp", 70, array($p)); }
	public static $ODup;
	public static function ODxNs($v) { return new format_abc_OpCode("ODxNs", 5, array($v)); }
	public static $ODxNsLate;
	public static $OFalse;
	public static function OFindDefinition($d) { return new format_abc_OpCode("OFindDefinition", 61, array($d)); }
	public static function OFindProp($p) { return new format_abc_OpCode("OFindProp", 60, array($p)); }
	public static function OFindPropStrict($p) { return new format_abc_OpCode("OFindPropStrict", 59, array($p)); }
	public static function OFloat($v) { return new format_abc_OpCode("OFloat", 34, array($v)); }
	public static $OForEach;
	public static $OForIn;
	public static function OFunction($f) { return new format_abc_OpCode("OFunction", 38, array($f)); }
	public static function OGetDescendants($c) { return new format_abc_OpCode("OGetDescendants", 57, array($c)); }
	public static $OGetGlobalScope;
	public static function OGetGlobalSlot($s) { return new format_abc_OpCode("OGetGlobalSlot", 73, array($s)); }
	public static function OGetLex($p) { return new format_abc_OpCode("OGetLex", 62, array($p)); }
	public static function OGetProp($p) { return new format_abc_OpCode("OGetProp", 68, array($p)); }
	public static function OGetScope($n) { return new format_abc_OpCode("OGetScope", 67, array($n)); }
	public static function OGetSlot($s) { return new format_abc_OpCode("OGetSlot", 71, array($s)); }
	public static function OGetSuper($v) { return new format_abc_OpCode("OGetSuper", 3, array($v)); }
	public static $OHasNext;
	public static function OIncrIReg($r) { return new format_abc_OpCode("OIncrIReg", 94, array($r)); }
	public static function OIncrReg($r) { return new format_abc_OpCode("OIncrReg", 89, array($r)); }
	public static function OInitProp($p) { return new format_abc_OpCode("OInitProp", 69, array($p)); }
	public static $OInstanceOf;
	public static function OInt($v) { return new format_abc_OpCode("OInt", 24, array($v)); }
	public static function OIntRef($v) { return new format_abc_OpCode("OIntRef", 32, array($v)); }
	public static function OIsType($t) { return new format_abc_OpCode("OIsType", 93, array($t)); }
	public static function OJump($j, $delta) { return new format_abc_OpCode("OJump", 10, array($j, $delta)); }
	public static function OJump2($j, $landingName, $delta) { return new format_abc_OpCode("OJump2", 11, array($j, $landingName, $delta)); }
	public static function OJump3($landingName) { return new format_abc_OpCode("OJump3", 12, array($landingName)); }
	public static $OLabel;
	public static function OLabel2($name) { return new format_abc_OpCode("OLabel2", 9, array($name)); }
	public static $ONaN;
	public static function ONamespace($v) { return new format_abc_OpCode("ONamespace", 36, array($v)); }
	public static $ONewBlock;
	public static function ONext($r1, $r2) { return new format_abc_OpCode("ONext", 37, array($r1, $r2)); }
	public static $ONop;
	public static $ONull;
	public static function OObject($nfields) { return new format_abc_OpCode("OObject", 53, array($nfields)); }
	public static function OOp($op) { return new format_abc_OpCode("OOp", 103, array($op)); }
	public static $OPop;
	public static $OPopScope;
	public static $OPushWith;
	public static function OReg($r) { return new format_abc_OpCode("OReg", 64, array($r)); }
	public static function ORegKill($r) { return new format_abc_OpCode("ORegKill", 7, array($r)); }
	public static $ORet;
	public static $ORetVoid;
	public static $OScope;
	public static function OSetGlobalSlot($s) { return new format_abc_OpCode("OSetGlobalSlot", 74, array($s)); }
	public static function OSetProp($p) { return new format_abc_OpCode("OSetProp", 63, array($p)); }
	public static function OSetReg($r) { return new format_abc_OpCode("OSetReg", 65, array($r)); }
	public static function OSetSlot($s) { return new format_abc_OpCode("OSetSlot", 72, array($s)); }
	public static function OSetSuper($v) { return new format_abc_OpCode("OSetSuper", 4, array($v)); }
	public static $OSetThis;
	public static function OSmallInt($v) { return new format_abc_OpCode("OSmallInt", 23, array($v)); }
	public static function OString($v) { return new format_abc_OpCode("OString", 31, array($v)); }
	public static $OSwap;
	public static function OSwitch($def, $deltas) { return new format_abc_OpCode("OSwitch", 13, array($def, $deltas)); }
	public static function OSwitch2($def, $deltas, $offsets) { return new format_abc_OpCode("OSwitch2", 14, array($def, $deltas, $offsets)); }
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
	public static function OUIntRef($v) { return new format_abc_OpCode("OUIntRef", 33, array($v)); }
	public static $OUndefined;
	public static function OUnknown($byte) { return new format_abc_OpCode("OUnknown", 104, array($byte)); }
	public static $__constructors = array(52 => 'OApplyType', 54 => 'OArray', 85 => 'OAsAny', 88 => 'OAsObject', 86 => 'OAsString', 87 => 'OAsType', 0 => 'OBreakPoint', 101 => 'OBreakPointLine', 41 => 'OCallMethod', 49 => 'OCallPropLex', 51 => 'OCallPropVoid', 44 => 'OCallProperty', 39 => 'OCallStack', 42 => 'OCallStatic', 43 => 'OCallSuper', 50 => 'OCallSuperVoid', 15 => 'OCase', 84 => 'OCast', 58 => 'OCatch', 83 => 'OCheckIsXml', 56 => 'OClassDef', 40 => 'OConstruct', 48 => 'OConstructProperty', 47 => 'OConstructSuper', 100 => 'ODebugFile', 99 => 'ODebugLine', 98 => 'ODebugReg', 95 => 'ODecrIReg', 90 => 'ODecrReg', 70 => 'ODeleteProp', 29 => 'ODup', 5 => 'ODxNs', 6 => 'ODxNsLate', 26 => 'OFalse', 61 => 'OFindDefinition', 60 => 'OFindProp', 59 => 'OFindPropStrict', 34 => 'OFloat', 22 => 'OForEach', 18 => 'OForIn', 38 => 'OFunction', 57 => 'OGetDescendants', 66 => 'OGetGlobalScope', 73 => 'OGetGlobalSlot', 62 => 'OGetLex', 68 => 'OGetProp', 67 => 'OGetScope', 71 => 'OGetSlot', 3 => 'OGetSuper', 19 => 'OHasNext', 94 => 'OIncrIReg', 89 => 'OIncrReg', 69 => 'OInitProp', 92 => 'OInstanceOf', 24 => 'OInt', 32 => 'OIntRef', 93 => 'OIsType', 10 => 'OJump', 11 => 'OJump2', 12 => 'OJump3', 8 => 'OLabel', 9 => 'OLabel2', 27 => 'ONaN', 36 => 'ONamespace', 55 => 'ONewBlock', 37 => 'ONext', 1 => 'ONop', 20 => 'ONull', 53 => 'OObject', 103 => 'OOp', 28 => 'OPop', 17 => 'OPopScope', 16 => 'OPushWith', 64 => 'OReg', 7 => 'ORegKill', 46 => 'ORet', 45 => 'ORetVoid', 35 => 'OScope', 74 => 'OSetGlobalSlot', 63 => 'OSetProp', 65 => 'OSetReg', 72 => 'OSetSlot', 4 => 'OSetSuper', 97 => 'OSetThis', 23 => 'OSmallInt', 31 => 'OString', 30 => 'OSwap', 13 => 'OSwitch', 14 => 'OSwitch2', 96 => 'OThis', 2 => 'OThrow', 102 => 'OTimestamp', 81 => 'OToBool', 78 => 'OToInt', 80 => 'OToNumber', 82 => 'OToObject', 75 => 'OToString', 79 => 'OToUInt', 76 => 'OToXml', 77 => 'OToXmlAttr', 25 => 'OTrue', 91 => 'OTypeof', 33 => 'OUIntRef', 21 => 'OUndefined', 104 => 'OUnknown');
	}
format_abc_OpCode::$OAsAny = new format_abc_OpCode("OAsAny", 85);
format_abc_OpCode::$OAsObject = new format_abc_OpCode("OAsObject", 88);
format_abc_OpCode::$OAsString = new format_abc_OpCode("OAsString", 86);
format_abc_OpCode::$OBreakPoint = new format_abc_OpCode("OBreakPoint", 0);
format_abc_OpCode::$OCheckIsXml = new format_abc_OpCode("OCheckIsXml", 83);
format_abc_OpCode::$ODup = new format_abc_OpCode("ODup", 29);
format_abc_OpCode::$ODxNsLate = new format_abc_OpCode("ODxNsLate", 6);
format_abc_OpCode::$OFalse = new format_abc_OpCode("OFalse", 26);
format_abc_OpCode::$OForEach = new format_abc_OpCode("OForEach", 22);
format_abc_OpCode::$OForIn = new format_abc_OpCode("OForIn", 18);
format_abc_OpCode::$OGetGlobalScope = new format_abc_OpCode("OGetGlobalScope", 66);
format_abc_OpCode::$OHasNext = new format_abc_OpCode("OHasNext", 19);
format_abc_OpCode::$OInstanceOf = new format_abc_OpCode("OInstanceOf", 92);
format_abc_OpCode::$OLabel = new format_abc_OpCode("OLabel", 8);
format_abc_OpCode::$ONaN = new format_abc_OpCode("ONaN", 27);
format_abc_OpCode::$ONewBlock = new format_abc_OpCode("ONewBlock", 55);
format_abc_OpCode::$ONop = new format_abc_OpCode("ONop", 1);
format_abc_OpCode::$ONull = new format_abc_OpCode("ONull", 20);
format_abc_OpCode::$OPop = new format_abc_OpCode("OPop", 28);
format_abc_OpCode::$OPopScope = new format_abc_OpCode("OPopScope", 17);
format_abc_OpCode::$OPushWith = new format_abc_OpCode("OPushWith", 16);
format_abc_OpCode::$ORet = new format_abc_OpCode("ORet", 46);
format_abc_OpCode::$ORetVoid = new format_abc_OpCode("ORetVoid", 45);
format_abc_OpCode::$OScope = new format_abc_OpCode("OScope", 35);
format_abc_OpCode::$OSetThis = new format_abc_OpCode("OSetThis", 97);
format_abc_OpCode::$OSwap = new format_abc_OpCode("OSwap", 30);
format_abc_OpCode::$OThis = new format_abc_OpCode("OThis", 96);
format_abc_OpCode::$OThrow = new format_abc_OpCode("OThrow", 2);
format_abc_OpCode::$OTimestamp = new format_abc_OpCode("OTimestamp", 102);
format_abc_OpCode::$OToBool = new format_abc_OpCode("OToBool", 81);
format_abc_OpCode::$OToInt = new format_abc_OpCode("OToInt", 78);
format_abc_OpCode::$OToNumber = new format_abc_OpCode("OToNumber", 80);
format_abc_OpCode::$OToObject = new format_abc_OpCode("OToObject", 82);
format_abc_OpCode::$OToString = new format_abc_OpCode("OToString", 75);
format_abc_OpCode::$OToUInt = new format_abc_OpCode("OToUInt", 79);
format_abc_OpCode::$OToXml = new format_abc_OpCode("OToXml", 76);
format_abc_OpCode::$OToXmlAttr = new format_abc_OpCode("OToXmlAttr", 77);
format_abc_OpCode::$OTrue = new format_abc_OpCode("OTrue", 25);
format_abc_OpCode::$OTypeof = new format_abc_OpCode("OTypeof", 91);
format_abc_OpCode::$OUndefined = new format_abc_OpCode("OUndefined", 21);
