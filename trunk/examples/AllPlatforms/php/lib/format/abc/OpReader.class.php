<?php

class format_abc_OpReader {
	public function __construct($i) {
		if(!php_Boot::$skip_constructor) {
		$this->i = $i;
	}}
	public function readOp($op) {
		return format_abc_OpReader_0($this, $op);
	}
	public function jmp($j) {
		format_abc_OpReader::$jumpNameIndex++;
		$offset = $this->i->readInt24();
		++format_abc_OpReader::$bytePos;
		++format_abc_OpReader::$bytePos;
		++format_abc_OpReader::$bytePos;
		if($offset < 0) {
			format_abc_OpReader::$ops->push(format_abc_OpCode::OJump($j, $offset));
			return format_abc_OpCode::OJump2($j, format_abc_OpReader::$labels[format_abc_OpReader::$bytePos + $offset], $offset);
		} else {
			if(format_abc_OpReader::$jumps[format_abc_OpReader::$bytePos + $offset] === null) {
				format_abc_OpReader::$jumps[format_abc_OpReader::$bytePos + $offset] = new _hx_array(array());
			}
			_hx_array_get(format_abc_OpReader::$jumps, format_abc_OpReader::$bytePos + $offset)->push("jump" . _hx_string_rec(format_abc_OpReader::$jumpNameIndex, ""));
			format_abc_OpReader::$ops->push(format_abc_OpCode::OJump($j, $offset));
			return format_abc_OpCode::OJump2($j, "jump" . _hx_string_rec(format_abc_OpReader::$jumpNameIndex, ""), $offset);
		}
	}
	public function reg() {
		++format_abc_OpReader::$bytePos;
		return $this->i->readByte();
	}
	public function readInt32() {
		$a = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($a < 128) {
			return $a;
		}
		$a &= 127;
		$b = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($b < 128) {
			return $b << 7 | $a;
		}
		$b &= 127;
		$c = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($c < 128) {
			return $c << 14 | $b << 7 | $a;
		}
		$c &= 127;
		$d = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($d < 128) {
			return $d << 21 | $c << 14 | $b << 7 | $a;
		}
		$d &= 127;
		$e = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($e > 15) {
			throw new HException("assert");
		}
		$small = $d << 21 | $c << 14 | $b << 7 | $a;
		$big = $e << 28;
		return $big | $small;
	}
	public function readIndex() {
		return format_abc_Index::Idx($this->readInt());
	}
	public function readInt() {
		$a = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($a < 128) {
			return $a;
		}
		$a &= 127;
		$b = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($b < 128) {
			return $b << 7 | $a;
		}
		$b &= 127;
		$c = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($c < 128) {
			return $c << 14 | $b << 7 | $a;
		}
		$c &= 127;
		$d = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($d < 128) {
			return $d << 21 | $c << 14 | $b << 7 | $a;
		}
		$d &= 127;
		$e = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($e > 15) {
			throw new HException("assert");
		}
		if((($e & 8) === 0) != (($e & 4) === 0)) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		return $e << 28 | $d << 21 | $c << 14 | $b << 7 | $a;
	}
	public $i;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	static $bytePos = 0;
	static $jumps;
	static $switches;
	static $jumpNameIndex;
	static $caseNameIndex;
	static $labels;
	static $labelNameIndex;
	static $ops;
	static $positions;
	static function decode($i) {
		format_abc_OpReader::$bytePos = 0;
		format_abc_OpReader::$positions = new _hx_array(array());
		format_abc_OpReader::$jumps = new _hx_array(array());
		format_abc_OpReader::$switches = new _hx_array(array());
		format_abc_OpReader::$jumpNameIndex = 0;
		format_abc_OpReader::$caseNameIndex = 0;
		format_abc_OpReader::$labels = new _hx_array(array());
		format_abc_OpReader::$labelNameIndex = 0;
		$opr = new format_abc_OpReader($i);
		format_abc_OpReader::$ops = new _hx_array(array());
		while(true) {
			$op = null;
			format_abc_OpReader::$positions->push(format_abc_OpReader::$bytePos);
			try {
				if(format_abc_OpReader::$switches[format_abc_OpReader::$bytePos] !== null) {
					$_g = 0; $_g1 = format_abc_OpReader::$switches[format_abc_OpReader::$bytePos];
					while($_g < $_g1->length) {
						$s = $_g1[$_g];
						++$_g;
						format_abc_OpReader::$ops->push(format_abc_OpCode::OCase($s));
						unset($s);
					}
					unset($_g1,$_g);
				}
				if(format_abc_OpReader::$jumps[format_abc_OpReader::$bytePos] !== null) {
					$_g = 0; $_g1 = format_abc_OpReader::$jumps[format_abc_OpReader::$bytePos];
					while($_g < $_g1->length) {
						$s = $_g1[$_g];
						++$_g;
						format_abc_OpReader::$ops->push(format_abc_OpCode::OJump3($s));
						unset($s);
					}
					unset($_g1,$_g);
				}
				$op = $i->readByte();
				++format_abc_OpReader::$bytePos;
			}catch(Exception $__hx__e) {
				$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
				if(($e = $_ex_) instanceof haxe_io_Eof){
					break;
				} else throw $__hx__e;;
			}
			$opc = $opr->readOp($op);
			format_abc_OpReader::$ops->push($opc);
			unset($opc,$op,$e);
		}
		return format_abc_OpReader::$ops;
	}
	function __toString() { return 'format.abc.OpReader'; }
}
format_abc_OpReader::$positions = new _hx_array(array());
function format_abc_OpReader_0(&$__hx__this, &$op) {
	switch($op) {
	case 1:{
		return format_abc_OpCode::$OBreakPoint;
	}break;
	case 2:{
		return format_abc_OpCode::$ONop;
	}break;
	case 3:{
		return format_abc_OpCode::$OThrow;
	}break;
	case 4:{
		return format_abc_OpCode::OGetSuper(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 5:{
		return format_abc_OpCode::OSetSuper(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 6:{
		return format_abc_OpCode::ODxNs(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 7:{
		return format_abc_OpCode::$ODxNsLate;
	}break;
	case 8:{
		return format_abc_OpCode::ORegKill(format_abc_OpReader_1($op));
	}break;
	case 9:{
		format_abc_OpReader::$labelNameIndex++;
		format_abc_OpReader::$labels[format_abc_OpReader::$bytePos - 1] = "label" . _hx_string_rec(format_abc_OpReader::$labelNameIndex, "");
		format_abc_OpReader::$ops->push(format_abc_OpCode::$OLabel);
		return format_abc_OpCode::OLabel2("label" . _hx_string_rec(format_abc_OpReader::$labelNameIndex, ""));
	}break;
	case 12:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JNotLt);
	}break;
	case 13:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JNotLte);
	}break;
	case 14:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JNotGt);
	}break;
	case 15:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JNotGte);
	}break;
	case 16:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JAlways);
	}break;
	case 17:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JTrue);
	}break;
	case 18:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JFalse);
	}break;
	case 19:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JEq);
	}break;
	case 20:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JNeq);
	}break;
	case 21:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JLt);
	}break;
	case 22:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JLte);
	}break;
	case 23:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JGt);
	}break;
	case 24:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JGte);
	}break;
	case 25:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JPhysEq);
	}break;
	case 26:{
		return $__hx__this->jmp(format_abc_JumpStyle::$JPhysNeq);
	}break;
	case 27:{
		$base = format_abc_OpReader::$bytePos - 1;
		$_def = $__hx__this->i->readInt24();
		format_abc_OpReader::$bytePos += 3;
		$def = "";
		if($_def < 0) {
			$def = format_abc_OpReader::$labels[$base + $_def];
		} else {
			if(format_abc_OpReader::$switches[$base + $_def] === null) {
				format_abc_OpReader::$switches[$base + $_def] = new _hx_array(array());
			}
			format_abc_OpReader::$caseNameIndex++;
			$def = "case" . _hx_string_rec(format_abc_OpReader::$caseNameIndex, "");
			_hx_array_get(format_abc_OpReader::$switches, $base + $_def)->push($def);
		}
		$cases = new _hx_array(array());
		$offsets = new _hx_array(array($_def));
		$total = $__hx__this->readInt() + 1;
		{
			$_g = 0;
			while($_g < $total) {
				$_ = $_g++;
				$offset = $__hx__this->i->readInt24();
				format_abc_OpReader::$bytePos += 3;
				$offsets->push($offset);
				if($offset < 0) {
					$cases->push(format_abc_OpReader::$labels[$base + $offset]);
				} else {
					format_abc_OpReader::$caseNameIndex++;
					if(format_abc_OpReader::$switches[$base + $offset] === null) {
						format_abc_OpReader::$switches[$base + $offset] = new _hx_array(array());
					}
					_hx_array_get(format_abc_OpReader::$switches, $base + $offset)->push("case" . _hx_string_rec(format_abc_OpReader::$caseNameIndex, ""));
					$cases->push("case" . _hx_string_rec(format_abc_OpReader::$caseNameIndex, ""));
				}
				unset($offset,$_);
			}
		}
		return format_abc_OpCode::OSwitch2($def, $cases, $offsets);
	}break;
	case 28:{
		return format_abc_OpCode::$OPushWith;
	}break;
	case 29:{
		return format_abc_OpCode::$OPopScope;
	}break;
	case 30:{
		return format_abc_OpCode::$OForIn;
	}break;
	case 31:{
		return format_abc_OpCode::$OHasNext;
	}break;
	case 32:{
		return format_abc_OpCode::$ONull;
	}break;
	case 33:{
		return format_abc_OpCode::$OUndefined;
	}break;
	case 35:{
		return format_abc_OpCode::$OForEach;
	}break;
	case 36:{
		++format_abc_OpReader::$bytePos;
		return format_abc_OpCode::OSmallInt($__hx__this->i->readInt8());
	}break;
	case 37:{
		return format_abc_OpCode::OInt($__hx__this->readInt());
	}break;
	case 38:{
		return format_abc_OpCode::$OTrue;
	}break;
	case 39:{
		return format_abc_OpCode::$OFalse;
	}break;
	case 40:{
		return format_abc_OpCode::$ONaN;
	}break;
	case 41:{
		return format_abc_OpCode::$OPop;
	}break;
	case 42:{
		return format_abc_OpCode::$ODup;
	}break;
	case 43:{
		return format_abc_OpCode::$OSwap;
	}break;
	case 44:{
		return format_abc_OpCode::OString(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 45:{
		return format_abc_OpCode::OIntRef(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 46:{
		return format_abc_OpCode::OUIntRef(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 47:{
		return format_abc_OpCode::OFloat(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 48:{
		return format_abc_OpCode::$OScope;
	}break;
	case 49:{
		return format_abc_OpCode::ONamespace(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 50:{
		$r1 = $__hx__this->readInt();
		$r2 = $__hx__this->readInt();
		return format_abc_OpCode::ONext($r1, $r2);
	}break;
	case 53:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemGet8);
	}break;
	case 54:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemGet16);
	}break;
	case 55:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemGet32);
	}break;
	case 56:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemGetFloat);
	}break;
	case 57:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemGetDouble);
	}break;
	case 58:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemSet8);
	}break;
	case 59:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemSet16);
	}break;
	case 60:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemSet32);
	}break;
	case 61:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemSetFloat);
	}break;
	case 62:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMemSetDouble);
	}break;
	case 64:{
		return format_abc_OpCode::OFunction(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 65:{
		return format_abc_OpCode::OCallStack($__hx__this->readInt());
	}break;
	case 66:{
		return format_abc_OpCode::OConstruct($__hx__this->readInt());
	}break;
	case 67:{
		$s = $__hx__this->readInt();
		$n = $__hx__this->readInt();
		return format_abc_OpCode::OCallMethod($s, $n);
	}break;
	case 68:{
		$m = format_abc_Index::Idx($__hx__this->readInt());
		$n = $__hx__this->readInt();
		return format_abc_OpCode::OCallStatic($m, $n);
	}break;
	case 69:{
		$p = format_abc_Index::Idx($__hx__this->readInt());
		$n = $__hx__this->readInt();
		return format_abc_OpCode::OCallSuper($p, $n);
	}break;
	case 70:{
		$p = format_abc_Index::Idx($__hx__this->readInt());
		$n = $__hx__this->readInt();
		return format_abc_OpCode::OCallProperty($p, $n);
	}break;
	case 71:{
		return format_abc_OpCode::$ORetVoid;
	}break;
	case 72:{
		return format_abc_OpCode::$ORet;
	}break;
	case 73:{
		return format_abc_OpCode::OConstructSuper($__hx__this->readInt());
	}break;
	case 74:{
		$p = format_abc_Index::Idx($__hx__this->readInt());
		$n = $__hx__this->readInt();
		return format_abc_OpCode::OConstructProperty($p, $n);
	}break;
	case 76:{
		$p = format_abc_Index::Idx($__hx__this->readInt());
		$n = $__hx__this->readInt();
		return format_abc_OpCode::OCallPropLex($p, $n);
	}break;
	case 78:{
		$p = format_abc_Index::Idx($__hx__this->readInt());
		$n = $__hx__this->readInt();
		return format_abc_OpCode::OCallSuperVoid($p, $n);
	}break;
	case 79:{
		$p = format_abc_Index::Idx($__hx__this->readInt());
		$n = $__hx__this->readInt();
		return format_abc_OpCode::OCallPropVoid($p, $n);
	}break;
	case 80:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpSign1);
	}break;
	case 81:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpSign8);
	}break;
	case 82:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpSign16);
	}break;
	case 83:{
		return format_abc_OpCode::OApplyType($__hx__this->readInt());
	}break;
	case 85:{
		return format_abc_OpCode::OObject($__hx__this->readInt());
	}break;
	case 86:{
		return format_abc_OpCode::OArray($__hx__this->readInt());
	}break;
	case 87:{
		return format_abc_OpCode::$ONewBlock;
	}break;
	case 88:{
		return format_abc_OpCode::OClassDef(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 89:{
		return format_abc_OpCode::OGetDescendants(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 90:{
		return format_abc_OpCode::OCatch($__hx__this->readInt());
	}break;
	case 93:{
		return format_abc_OpCode::OFindPropStrict(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 94:{
		return format_abc_OpCode::OFindProp(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 95:{
		return format_abc_OpCode::OFindDefinition(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 96:{
		return format_abc_OpCode::OGetLex(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 97:{
		return format_abc_OpCode::OSetProp(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 98:{
		return format_abc_OpCode::OReg(format_abc_OpReader_2($op));
	}break;
	case 99:{
		return format_abc_OpCode::OSetReg(format_abc_OpReader_3($op));
	}break;
	case 100:{
		return format_abc_OpCode::$OGetGlobalScope;
	}break;
	case 101:{
		++format_abc_OpReader::$bytePos;
		return format_abc_OpCode::OGetScope($__hx__this->i->readByte());
	}break;
	case 102:{
		return format_abc_OpCode::OGetProp(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 104:{
		return format_abc_OpCode::OInitProp(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 106:{
		return format_abc_OpCode::ODeleteProp(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 108:{
		return format_abc_OpCode::OGetSlot($__hx__this->readInt());
	}break;
	case 109:{
		return format_abc_OpCode::OSetSlot($__hx__this->readInt());
	}break;
	case 110:{
		return format_abc_OpCode::OGetGlobalSlot($__hx__this->readInt());
	}break;
	case 111:{
		return format_abc_OpCode::OSetGlobalSlot($__hx__this->readInt());
	}break;
	case 112:{
		return format_abc_OpCode::$OToString;
	}break;
	case 113:{
		return format_abc_OpCode::$OToXml;
	}break;
	case 114:{
		return format_abc_OpCode::$OToXmlAttr;
	}break;
	case 115:{
		return format_abc_OpCode::$OToInt;
	}break;
	case 116:{
		return format_abc_OpCode::$OToUInt;
	}break;
	case 117:{
		return format_abc_OpCode::$OToNumber;
	}break;
	case 118:{
		return format_abc_OpCode::$OToBool;
	}break;
	case 119:{
		return format_abc_OpCode::$OToObject;
	}break;
	case 120:{
		return format_abc_OpCode::$OCheckIsXml;
	}break;
	case 128:{
		return format_abc_OpCode::OCast(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 130:{
		return format_abc_OpCode::$OAsAny;
	}break;
	case 133:{
		return format_abc_OpCode::$OAsString;
	}break;
	case 134:{
		return format_abc_OpCode::OAsType(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 135:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpAs);
	}break;
	case 137:{
		return format_abc_OpCode::$OAsObject;
	}break;
	case 144:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpNeg);
	}break;
	case 145:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpIncr);
	}break;
	case 146:{
		return format_abc_OpCode::OIncrReg(format_abc_OpReader_4($op));
	}break;
	case 147:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpDecr);
	}break;
	case 148:{
		return format_abc_OpCode::ODecrReg(format_abc_OpReader_5($op));
	}break;
	case 149:{
		return format_abc_OpCode::$OTypeof;
	}break;
	case 150:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpNot);
	}break;
	case 151:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpBitNot);
	}break;
	case 160:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpAdd);
	}break;
	case 161:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpSub);
	}break;
	case 162:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMul);
	}break;
	case 163:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpDiv);
	}break;
	case 164:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpMod);
	}break;
	case 165:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpShl);
	}break;
	case 166:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpShr);
	}break;
	case 167:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpUShr);
	}break;
	case 168:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpAnd);
	}break;
	case 169:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpOr);
	}break;
	case 170:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpXor);
	}break;
	case 171:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpEq);
	}break;
	case 172:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpPhysEq);
	}break;
	case 173:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpLt);
	}break;
	case 174:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpLte);
	}break;
	case 175:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpGt);
	}break;
	case 176:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpGte);
	}break;
	case 177:{
		return format_abc_OpCode::$OInstanceOf;
	}break;
	case 178:{
		return format_abc_OpCode::OIsType(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 179:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpIs);
	}break;
	case 180:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpIn);
	}break;
	case 192:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpIIncr);
	}break;
	case 193:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpIDecr);
	}break;
	case 194:{
		return format_abc_OpCode::OIncrIReg(format_abc_OpReader_6($op));
	}break;
	case 195:{
		return format_abc_OpCode::ODecrIReg(format_abc_OpReader_7($op));
	}break;
	case 196:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpINeg);
	}break;
	case 197:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpIAdd);
	}break;
	case 198:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpISub);
	}break;
	case 199:{
		return format_abc_OpCode::OOp(format_abc_Operation::$OpIMul);
	}break;
	case 208:{
		return format_abc_OpCode::$OThis;
	}break;
	case 209:{
		return format_abc_OpCode::OReg(1);
	}break;
	case 210:{
		return format_abc_OpCode::OReg(2);
	}break;
	case 211:{
		return format_abc_OpCode::OReg(3);
	}break;
	case 212:{
		return format_abc_OpCode::$OSetThis;
	}break;
	case 213:{
		return format_abc_OpCode::OSetReg(1);
	}break;
	case 214:{
		return format_abc_OpCode::OSetReg(2);
	}break;
	case 215:{
		return format_abc_OpCode::OSetReg(3);
	}break;
	case 239:{
		$b = $__hx__this->i->readByte();
		if($b !== 1) {
			throw new HException("assert");
		}
		++format_abc_OpReader::$bytePos;
		$name = format_abc_Index::Idx($__hx__this->readInt());
		$r = null;
		++format_abc_OpReader::$bytePos;
		$r = $__hx__this->i->readByte();
		$line = $__hx__this->readInt();
		return format_abc_OpCode::ODebugReg($name, $r, $line);
	}break;
	case 240:{
		return format_abc_OpCode::ODebugLine($__hx__this->readInt());
	}break;
	case 241:{
		return format_abc_OpCode::ODebugFile(format_abc_Index::Idx($__hx__this->readInt()));
	}break;
	case 242:{
		return format_abc_OpCode::OBreakPointLine($__hx__this->readInt());
	}break;
	case 243:{
		return format_abc_OpCode::$OTimestamp;
	}break;
	default:{
		return format_abc_OpCode::OUnknown($op);
	}break;
	}
}
function format_abc_OpReader_1(&$op) {
	{
		++format_abc_OpReader::$bytePos;
		return $__hx__this->i->readByte();
	}
}
function format_abc_OpReader_2(&$op) {
	{
		++format_abc_OpReader::$bytePos;
		return $__hx__this->i->readByte();
	}
}
function format_abc_OpReader_3(&$op) {
	{
		++format_abc_OpReader::$bytePos;
		return $__hx__this->i->readByte();
	}
}
function format_abc_OpReader_4(&$op) {
	{
		++format_abc_OpReader::$bytePos;
		return $__hx__this->i->readByte();
	}
}
function format_abc_OpReader_5(&$op) {
	{
		++format_abc_OpReader::$bytePos;
		return $__hx__this->i->readByte();
	}
}
function format_abc_OpReader_6(&$op) {
	{
		++format_abc_OpReader::$bytePos;
		return $__hx__this->i->readByte();
	}
}
function format_abc_OpReader_7(&$op) {
	{
		++format_abc_OpReader::$bytePos;
		return $__hx__this->i->readByte();
	}
}
