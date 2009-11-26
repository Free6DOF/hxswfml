<?php

class format_abc_OpReader {
	public function __construct($i) {
		if( !php_Boot::$skip_constructor ) {
		$this->i = $i;
	}}
	public $i;
	public function readInt() {
		$a = $this->i->readByte();
		if($a < 128) {
			return $a;
		}
		$a &= 127;
		$b = $this->i->readByte();
		if($b < 128) {
			return ($b << 7) | $a;
		}
		$b &= 127;
		$c = $this->i->readByte();
		if($c < 128) {
			return (($c << 14) | ($b << 7)) | $a;
		}
		$c &= 127;
		$d = $this->i->readByte();
		if($d < 128) {
			return ((($d << 21) | ($c << 14)) | ($b << 7)) | $a;
		}
		$d &= 127;
		$e = $this->i->readByte();
		if($e > 15) {
			throw new HException("assert");
		}
		if((($e & 8) === 0) != (($e & 4) === 0)) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		return (((($e << 28) | ($d << 21)) | ($c << 14)) | ($b << 7)) | $a;
	}
	public function readIndex() {
		return format_abc_Index::Idx($this->readInt());
	}
	public function readInt32() {
		$a = $this->i->readByte();
		if($a < 128) {
			return $a;
		}
		$a &= 127;
		$b = $this->i->readByte();
		if($b < 128) {
			return ($b << 7) | $a;
		}
		$b &= 127;
		$c = $this->i->readByte();
		if($c < 128) {
			return (($c << 14) | ($b << 7)) | $a;
		}
		$c &= 127;
		$d = $this->i->readByte();
		if($d < 128) {
			return ((($d << 21) | ($c << 14)) | ($b << 7)) | $a;
		}
		$d &= 127;
		$e = $this->i->readByte();
		if($e > 15) {
			throw new HException("assert");
		}
		$small = ((($d << 21) | ($c << 14)) | ($b << 7)) | $a;
		$big = ($e) << 28;
		return ($big) | ($small);
	}
	public function reg() {
		return $this->i->readByte();
	}
	public function jmp($j) {
		return format_abc_OpCode::OJump($j, $this->i->readInt24());
	}
	public function readOp($op) {
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$op) {
			case 1:{
				\$�r = format_abc_OpCode::\$OBreakPoint;
			}break;
			case 2:{
				\$�r = format_abc_OpCode::\$ONop;
			}break;
			case 3:{
				\$�r = format_abc_OpCode::\$OThrow;
			}break;
			case 4:{
				\$�r = format_abc_OpCode::OGetSuper(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 5:{
				\$�r = format_abc_OpCode::OSetSuper(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 6:{
				\$�r = format_abc_OpCode::ODxNs(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 7:{
				\$�r = format_abc_OpCode::\$ODxNsLate;
			}break;
			case 8:{
				\$�r = format_abc_OpCode::ORegKill(\$�this->i->readByte());
			}break;
			case 9:{
				\$�r = format_abc_OpCode::\$OLabel;
			}break;
			case 12:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JNotLt, \$�this->i->readInt24());
			}break;
			case 13:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JNotLte, \$�this->i->readInt24());
			}break;
			case 14:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JNotGt, \$�this->i->readInt24());
			}break;
			case 15:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JNotGte, \$�this->i->readInt24());
			}break;
			case 16:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JAlways, \$�this->i->readInt24());
			}break;
			case 17:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JTrue, \$�this->i->readInt24());
			}break;
			case 18:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JFalse, \$�this->i->readInt24());
			}break;
			case 19:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JEq, \$�this->i->readInt24());
			}break;
			case 20:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JNeq, \$�this->i->readInt24());
			}break;
			case 21:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JLt, \$�this->i->readInt24());
			}break;
			case 22:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JLte, \$�this->i->readInt24());
			}break;
			case 23:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JGt, \$�this->i->readInt24());
			}break;
			case 24:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JGte, \$�this->i->readInt24());
			}break;
			case 25:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JPhysEq, \$�this->i->readInt24());
			}break;
			case 26:{
				\$�r = format_abc_OpCode::OJump(format_abc_JumpStyle::\$JPhysNeq, \$�this->i->readInt24());
			}break;
			case 27:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$def = \\\$�this->i->readInt24();
					\\\$cases = new _hx_array(array());
					{
						\\\$_g1 = 0; \\\$_g = \\\$�this->readInt() + 1;
						while(\\\$_g1 < \\\$_g) {
							\\\$_ = \\\$_g1++;
							\\\$cases->push(\\\$�this->i->readInt24());
							unset(\\\$_);
						}
					}
					\\\$�r2 = format_abc_OpCode::OSwitch(\\\$def, \\\$cases);
					return \\\$�r2;
				\");
			}break;
			case 28:{
				\$�r = format_abc_OpCode::\$OPushWith;
			}break;
			case 29:{
				\$�r = format_abc_OpCode::\$OPopScope;
			}break;
			case 30:{
				\$�r = format_abc_OpCode::\$OForIn;
			}break;
			case 31:{
				\$�r = format_abc_OpCode::\$OHasNext;
			}break;
			case 32:{
				\$�r = format_abc_OpCode::\$ONull;
			}break;
			case 33:{
				\$�r = format_abc_OpCode::\$OUndefined;
			}break;
			case 35:{
				\$�r = format_abc_OpCode::\$OForEach;
			}break;
			case 36:{
				\$�r = format_abc_OpCode::OSmallInt(\$�this->i->readInt8());
			}break;
			case 37:{
				\$�r = format_abc_OpCode::OInt(\$�this->readInt());
			}break;
			case 38:{
				\$�r = format_abc_OpCode::\$OTrue;
			}break;
			case 39:{
				\$�r = format_abc_OpCode::\$OFalse;
			}break;
			case 40:{
				\$�r = format_abc_OpCode::\$ONaN;
			}break;
			case 41:{
				\$�r = format_abc_OpCode::\$OPop;
			}break;
			case 42:{
				\$�r = format_abc_OpCode::\$ODup;
			}break;
			case 43:{
				\$�r = format_abc_OpCode::\$OSwap;
			}break;
			case 44:{
				\$�r = format_abc_OpCode::OString(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 45:{
				\$�r = format_abc_OpCode::OIntRef(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 46:{
				\$�r = format_abc_OpCode::OUIntRef(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 47:{
				\$�r = format_abc_OpCode::OFloat(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 48:{
				\$�r = format_abc_OpCode::\$OScope;
			}break;
			case 49:{
				\$�r = format_abc_OpCode::ONamespace(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 50:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$r1 = \\\$�this->readInt();
					\\\$r2 = \\\$�this->readInt();
					\\\$�r3 = format_abc_OpCode::ONext(\\\$r1, \\\$r2);
					return \\\$�r3;
				\");
			}break;
			case 53:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGet8);
			}break;
			case 54:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGet16);
			}break;
			case 55:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGet32);
			}break;
			case 56:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGetFloat);
			}break;
			case 57:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGetDouble);
			}break;
			case 58:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSet8);
			}break;
			case 59:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSet16);
			}break;
			case 60:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSet32);
			}break;
			case 61:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSetFloat);
			}break;
			case 62:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSetDouble);
			}break;
			case 64:{
				\$�r = format_abc_OpCode::OFunction(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 65:{
				\$�r = format_abc_OpCode::OCallStack(\$�this->readInt());
			}break;
			case 66:{
				\$�r = format_abc_OpCode::OConstruct(\$�this->readInt());
			}break;
			case 67:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$s = \\\$�this->readInt();
					\\\$n = \\\$�this->readInt();
					\\\$�r4 = format_abc_OpCode::OCallMethod(\\\$s, \\\$n);
					return \\\$�r4;
				\");
			}break;
			case 68:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$m = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n2 = \\\$�this->readInt();
					\\\$�r5 = format_abc_OpCode::OCallStatic(\\\$m, \\\$n2);
					return \\\$�r5;
				\");
			}break;
			case 69:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n3 = \\\$�this->readInt();
					\\\$�r6 = format_abc_OpCode::OCallSuper(\\\$p, \\\$n3);
					return \\\$�r6;
				\");
			}break;
			case 70:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p2 = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n4 = \\\$�this->readInt();
					\\\$�r7 = format_abc_OpCode::OCallProperty(\\\$p2, \\\$n4);
					return \\\$�r7;
				\");
			}break;
			case 71:{
				\$�r = format_abc_OpCode::\$ORetVoid;
			}break;
			case 72:{
				\$�r = format_abc_OpCode::\$ORet;
			}break;
			case 73:{
				\$�r = format_abc_OpCode::OConstructSuper(\$�this->readInt());
			}break;
			case 74:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p3 = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n5 = \\\$�this->readInt();
					\\\$�r8 = format_abc_OpCode::OConstructProperty(\\\$p3, \\\$n5);
					return \\\$�r8;
				\");
			}break;
			case 76:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p4 = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n6 = \\\$�this->readInt();
					\\\$�r9 = format_abc_OpCode::OCallPropLex(\\\$p4, \\\$n6);
					return \\\$�r9;
				\");
			}break;
			case 78:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p5 = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n7 = \\\$�this->readInt();
					\\\$�r10 = format_abc_OpCode::OCallSuperVoid(\\\$p5, \\\$n7);
					return \\\$�r10;
				\");
			}break;
			case 79:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p6 = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n8 = \\\$�this->readInt();
					\\\$�r11 = format_abc_OpCode::OCallPropVoid(\\\$p6, \\\$n8);
					return \\\$�r11;
				\");
			}break;
			case 80:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpSign1);
			}break;
			case 81:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpSign8);
			}break;
			case 82:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpSign16);
			}break;
			case 83:{
				\$�r = format_abc_OpCode::OApplyType(\$�this->readInt());
			}break;
			case 85:{
				\$�r = format_abc_OpCode::OObject(\$�this->readInt());
			}break;
			case 86:{
				\$�r = format_abc_OpCode::OArray(\$�this->readInt());
			}break;
			case 87:{
				\$�r = format_abc_OpCode::\$ONewBlock;
			}break;
			case 88:{
				\$�r = format_abc_OpCode::OClassDef(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 89:{
				\$�r = format_abc_OpCode::OGetDescendants(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 90:{
				\$�r = format_abc_OpCode::OCatch(\$�this->readInt());
			}break;
			case 93:{
				\$�r = format_abc_OpCode::OFindPropStrict(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 94:{
				\$�r = format_abc_OpCode::OFindProp(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 95:{
				\$�r = format_abc_OpCode::OFindDefinition(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 96:{
				\$�r = format_abc_OpCode::OGetLex(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 97:{
				\$�r = format_abc_OpCode::OSetProp(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 98:{
				\$�r = format_abc_OpCode::OReg(\$�this->i->readByte());
			}break;
			case 99:{
				\$�r = format_abc_OpCode::OSetReg(\$�this->i->readByte());
			}break;
			case 100:{
				\$�r = format_abc_OpCode::\$OGetGlobalScope;
			}break;
			case 101:{
				\$�r = format_abc_OpCode::OGetScope(\$�this->i->readByte());
			}break;
			case 102:{
				\$�r = format_abc_OpCode::OGetProp(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 104:{
				\$�r = format_abc_OpCode::OInitProp(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 106:{
				\$�r = format_abc_OpCode::ODeleteProp(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 108:{
				\$�r = format_abc_OpCode::OGetSlot(\$�this->readInt());
			}break;
			case 109:{
				\$�r = format_abc_OpCode::OSetSlot(\$�this->readInt());
			}break;
			case 112:{
				\$�r = format_abc_OpCode::\$OToString;
			}break;
			case 113:{
				\$�r = format_abc_OpCode::\$OToXml;
			}break;
			case 114:{
				\$�r = format_abc_OpCode::\$OToXmlAttr;
			}break;
			case 115:{
				\$�r = format_abc_OpCode::\$OToInt;
			}break;
			case 116:{
				\$�r = format_abc_OpCode::\$OToUInt;
			}break;
			case 117:{
				\$�r = format_abc_OpCode::\$OToNumber;
			}break;
			case 118:{
				\$�r = format_abc_OpCode::\$OToBool;
			}break;
			case 119:{
				\$�r = format_abc_OpCode::\$OToObject;
			}break;
			case 120:{
				\$�r = format_abc_OpCode::\$OCheckIsXml;
			}break;
			case 128:{
				\$�r = format_abc_OpCode::OCast(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 130:{
				\$�r = format_abc_OpCode::\$OAsAny;
			}break;
			case 133:{
				\$�r = format_abc_OpCode::\$OAsString;
			}break;
			case 134:{
				\$�r = format_abc_OpCode::OAsType(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 135:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpAs);
			}break;
			case 137:{
				\$�r = format_abc_OpCode::\$OAsObject;
			}break;
			case 144:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpNeg);
			}break;
			case 145:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpIncr);
			}break;
			case 146:{
				\$�r = format_abc_OpCode::OIncrReg(\$�this->i->readByte());
			}break;
			case 147:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpDecr);
			}break;
			case 148:{
				\$�r = format_abc_OpCode::ODecrReg(\$�this->i->readByte());
			}break;
			case 149:{
				\$�r = format_abc_OpCode::\$OTypeof;
			}break;
			case 150:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpNot);
			}break;
			case 151:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpBitNot);
			}break;
			case 160:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpAdd);
			}break;
			case 161:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpSub);
			}break;
			case 162:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMul);
			}break;
			case 163:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpDiv);
			}break;
			case 164:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpMod);
			}break;
			case 165:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpShl);
			}break;
			case 166:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpShr);
			}break;
			case 167:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpUShr);
			}break;
			case 168:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpAnd);
			}break;
			case 169:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpOr);
			}break;
			case 170:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpXor);
			}break;
			case 171:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpEq);
			}break;
			case 172:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpPhysEq);
			}break;
			case 173:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpLt);
			}break;
			case 174:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpLte);
			}break;
			case 175:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpGt);
			}break;
			case 176:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpGte);
			}break;
			case 177:{
				\$�r = format_abc_OpCode::\$OInstanceOf;
			}break;
			case 178:{
				\$�r = format_abc_OpCode::OIsType(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 179:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpIs);
			}break;
			case 180:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpIn);
			}break;
			case 192:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpIIncr);
			}break;
			case 193:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpIDecr);
			}break;
			case 194:{
				\$�r = format_abc_OpCode::OIncrIReg(\$�this->i->readByte());
			}break;
			case 195:{
				\$�r = format_abc_OpCode::ODecrIReg(\$�this->i->readByte());
			}break;
			case 196:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpINeg);
			}break;
			case 197:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpIAdd);
			}break;
			case 198:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpISub);
			}break;
			case 199:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpIMul);
			}break;
			case 208:{
				\$�r = format_abc_OpCode::\$OThis;
			}break;
			case 209:{
				\$�r = format_abc_OpCode::OReg(1);
			}break;
			case 210:{
				\$�r = format_abc_OpCode::OReg(2);
			}break;
			case 211:{
				\$�r = format_abc_OpCode::OReg(3);
			}break;
			case 212:{
				\$�r = format_abc_OpCode::\$OSetThis;
			}break;
			case 213:{
				\$�r = format_abc_OpCode::OSetReg(1);
			}break;
			case 214:{
				\$�r = format_abc_OpCode::OSetReg(2);
			}break;
			case 215:{
				\$�r = format_abc_OpCode::OSetReg(3);
			}break;
			case 239:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;if(\\\$�this->i->readByte() !== 1) {
						throw new HException(\\\"assert\\\");
					}
					\\\$name = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$r = \\\$�this->i->readByte();
					\\\$line = \\\$�this->readInt();
					\\\$�r12 = format_abc_OpCode::ODebugReg(\\\$name, \\\$r, \\\$line);
					return \\\$�r12;
				\");
			}break;
			case 240:{
				\$�r = format_abc_OpCode::ODebugLine(\$�this->readInt());
			}break;
			case 241:{
				\$�r = format_abc_OpCode::ODebugFile(format_abc_Index::Idx(\$�this->readInt()));
			}break;
			case 242:{
				\$�r = format_abc_OpCode::OBreakPointLine(\$�this->readInt());
			}break;
			case 243:{
				\$�r = format_abc_OpCode::\$OTimestamp;
			}break;
			default:{
				\$�r = format_abc_OpCode::OUnknown(\$op);
			}break;
			}
			return \$�r;
		");
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->�dynamics[$m]) && is_callable($this->�dynamics[$m]))
			return call_user_func_array($this->�dynamics[$m], $a);
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	static function decode($i) {
		$opr = new format_abc_OpReader($i);
		$ops = new _hx_array(array());
		while(true) {
			$op = null;
			try {
				$op = $i->readByte();
			}catch(Exception $�e) {
			$_ex_ = ($�e instanceof HException) ? $�e->e : $�e;
			;
			if(($e = $_ex_) instanceof haxe_io_Eof){
				break;
			} else throw $�e; }
			$ops->push($opr->readOp($op));
			unset($�e,$op,$e,$_ex_);
		}
		return $ops;
	}
	function __toString() { return 'format.abc.OpReader'; }
}
