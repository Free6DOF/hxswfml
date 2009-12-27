<?php

class format_abc_OpReader {
	public function __construct($i) {
		if( !php_Boot::$skip_constructor ) {
		$this->i = $i;
	}}
	public $i;
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
			return ($b << 7) | $a;
		}
		$b &= 127;
		$c = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($c < 128) {
			return (($c << 14) | ($b << 7)) | $a;
		}
		$c &= 127;
		$d = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($d < 128) {
			return ((($d << 21) | ($c << 14)) | ($b << 7)) | $a;
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
		return (((($e << 28) | ($d << 21)) | ($c << 14)) | ($b << 7)) | $a;
	}
	public function readIndex() {
		return format_abc_Index::Idx($this->readInt());
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
			return ($b << 7) | $a;
		}
		$b &= 127;
		$c = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($c < 128) {
			return (($c << 14) | ($b << 7)) | $a;
		}
		$c &= 127;
		$d = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($d < 128) {
			return ((($d << 21) | ($c << 14)) | ($b << 7)) | $a;
		}
		$d &= 127;
		$e = $this->i->readByte();
		++format_abc_OpReader::$bytePos;
		if($e > 15) {
			throw new HException("assert");
		}
		$small = ((($d << 21) | ($c << 14)) | ($b << 7)) | $a;
		$big = ($e) << 28;
		return ($big) | ($small);
	}
	public function reg() {
		++format_abc_OpReader::$bytePos;
		return $this->i->readByte();
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
		}
		else {
			if(format_abc_OpReader::$jumps[format_abc_OpReader::$bytePos + $offset] === null) {
				format_abc_OpReader::$jumps[format_abc_OpReader::$bytePos + $offset] = new _hx_array(array());
			}
			_hx_array_get(format_abc_OpReader::$jumps, format_abc_OpReader::$bytePos + $offset)->push("j" . format_abc_OpReader::$jumpNameIndex);
			format_abc_OpReader::$ops->push(format_abc_OpCode::OJump($j, $offset));
			return format_abc_OpCode::OJump2($j, "j" . format_abc_OpReader::$jumpNameIndex, $offset);
		}
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
				\$�r = format_abc_OpCode::ORegKill(eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$�r2 = \\\$�this->i->readByte();
					return \\\$�r2;
				\"));
			}break;
			case 9:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;format_abc_OpReader::\\\$labelNameIndex++;
					format_abc_OpReader::\\\$labels[format_abc_OpReader::\\\$bytePos - 1] = \\\"label\\\" . format_abc_OpReader::\\\$labelNameIndex;
					format_abc_OpReader::\\\$ops->push(format_abc_OpCode::\\\$OLabel);
					\\\$�r3 = format_abc_OpCode::OLabel2(\\\"label\\\" . format_abc_OpReader::\\\$labelNameIndex);
					return \\\$�r3;
				\");
			}break;
			case 12:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j = format_abc_JumpStyle::\\\$JNotLt;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r4 = (\\\$offset < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j, \\\\\$offset));
						\\\\\$�r5 = format_abc_OpCode::OJump2(\\\\\$j, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset], \\\\\$offset);
						return \\\\\$�r5;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j, \\\\\$offset));
						\\\\\$�r6 = format_abc_OpCode::OJump2(\\\\\$j, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset);
						return \\\\\$�r6;
					\\\"));
					return \\\$�r4;
				\");
			}break;
			case 13:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j2 = format_abc_JumpStyle::\\\$JNotLte;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset2 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r7 = (\\\$offset2 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j2, \\\\\$offset2));
						\\\\\$�r8 = format_abc_OpCode::OJump2(\\\\\$j2, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset2], \\\\\$offset2);
						return \\\\\$�r8;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset2] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset2] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset2)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j2, \\\\\$offset2));
						\\\\\$�r9 = format_abc_OpCode::OJump2(\\\\\$j2, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset2);
						return \\\\\$�r9;
					\\\"));
					return \\\$�r7;
				\");
			}break;
			case 14:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j3 = format_abc_JumpStyle::\\\$JNotGt;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset3 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r10 = (\\\$offset3 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j3, \\\\\$offset3));
						\\\\\$�r11 = format_abc_OpCode::OJump2(\\\\\$j3, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset3], \\\\\$offset3);
						return \\\\\$�r11;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset3] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset3] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset3)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j3, \\\\\$offset3));
						\\\\\$�r12 = format_abc_OpCode::OJump2(\\\\\$j3, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset3);
						return \\\\\$�r12;
					\\\"));
					return \\\$�r10;
				\");
			}break;
			case 15:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j4 = format_abc_JumpStyle::\\\$JNotGte;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset4 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r13 = (\\\$offset4 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j4, \\\\\$offset4));
						\\\\\$�r14 = format_abc_OpCode::OJump2(\\\\\$j4, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset4], \\\\\$offset4);
						return \\\\\$�r14;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset4] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset4] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset4)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j4, \\\\\$offset4));
						\\\\\$�r15 = format_abc_OpCode::OJump2(\\\\\$j4, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset4);
						return \\\\\$�r15;
					\\\"));
					return \\\$�r13;
				\");
			}break;
			case 16:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j5 = format_abc_JumpStyle::\\\$JAlways;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset5 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r16 = (\\\$offset5 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j5, \\\\\$offset5));
						\\\\\$�r17 = format_abc_OpCode::OJump2(\\\\\$j5, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset5], \\\\\$offset5);
						return \\\\\$�r17;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset5] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset5] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset5)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j5, \\\\\$offset5));
						\\\\\$�r18 = format_abc_OpCode::OJump2(\\\\\$j5, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset5);
						return \\\\\$�r18;
					\\\"));
					return \\\$�r16;
				\");
			}break;
			case 17:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j6 = format_abc_JumpStyle::\\\$JTrue;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset6 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r19 = (\\\$offset6 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j6, \\\\\$offset6));
						\\\\\$�r20 = format_abc_OpCode::OJump2(\\\\\$j6, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset6], \\\\\$offset6);
						return \\\\\$�r20;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset6] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset6] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset6)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j6, \\\\\$offset6));
						\\\\\$�r21 = format_abc_OpCode::OJump2(\\\\\$j6, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset6);
						return \\\\\$�r21;
					\\\"));
					return \\\$�r19;
				\");
			}break;
			case 18:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j7 = format_abc_JumpStyle::\\\$JFalse;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset7 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r22 = (\\\$offset7 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j7, \\\\\$offset7));
						\\\\\$�r23 = format_abc_OpCode::OJump2(\\\\\$j7, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset7], \\\\\$offset7);
						return \\\\\$�r23;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset7] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset7] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset7)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j7, \\\\\$offset7));
						\\\\\$�r24 = format_abc_OpCode::OJump2(\\\\\$j7, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset7);
						return \\\\\$�r24;
					\\\"));
					return \\\$�r22;
				\");
			}break;
			case 19:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j8 = format_abc_JumpStyle::\\\$JEq;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset8 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r25 = (\\\$offset8 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j8, \\\\\$offset8));
						\\\\\$�r26 = format_abc_OpCode::OJump2(\\\\\$j8, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset8], \\\\\$offset8);
						return \\\\\$�r26;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset8] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset8] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset8)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j8, \\\\\$offset8));
						\\\\\$�r27 = format_abc_OpCode::OJump2(\\\\\$j8, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset8);
						return \\\\\$�r27;
					\\\"));
					return \\\$�r25;
				\");
			}break;
			case 20:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j9 = format_abc_JumpStyle::\\\$JNeq;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset9 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r28 = (\\\$offset9 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j9, \\\\\$offset9));
						\\\\\$�r29 = format_abc_OpCode::OJump2(\\\\\$j9, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset9], \\\\\$offset9);
						return \\\\\$�r29;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset9] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset9] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset9)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j9, \\\\\$offset9));
						\\\\\$�r30 = format_abc_OpCode::OJump2(\\\\\$j9, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset9);
						return \\\\\$�r30;
					\\\"));
					return \\\$�r28;
				\");
			}break;
			case 21:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j10 = format_abc_JumpStyle::\\\$JLt;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset10 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r31 = (\\\$offset10 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j10, \\\\\$offset10));
						\\\\\$�r32 = format_abc_OpCode::OJump2(\\\\\$j10, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset10], \\\\\$offset10);
						return \\\\\$�r32;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset10] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset10] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset10)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j10, \\\\\$offset10));
						\\\\\$�r33 = format_abc_OpCode::OJump2(\\\\\$j10, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset10);
						return \\\\\$�r33;
					\\\"));
					return \\\$�r31;
				\");
			}break;
			case 22:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j11 = format_abc_JumpStyle::\\\$JLte;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset11 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r34 = (\\\$offset11 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j11, \\\\\$offset11));
						\\\\\$�r35 = format_abc_OpCode::OJump2(\\\\\$j11, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset11], \\\\\$offset11);
						return \\\\\$�r35;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset11] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset11] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset11)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j11, \\\\\$offset11));
						\\\\\$�r36 = format_abc_OpCode::OJump2(\\\\\$j11, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset11);
						return \\\\\$�r36;
					\\\"));
					return \\\$�r34;
				\");
			}break;
			case 23:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j12 = format_abc_JumpStyle::\\\$JGt;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset12 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r37 = (\\\$offset12 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j12, \\\\\$offset12));
						\\\\\$�r38 = format_abc_OpCode::OJump2(\\\\\$j12, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset12], \\\\\$offset12);
						return \\\\\$�r38;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset12] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset12] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset12)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j12, \\\\\$offset12));
						\\\\\$�r39 = format_abc_OpCode::OJump2(\\\\\$j12, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset12);
						return \\\\\$�r39;
					\\\"));
					return \\\$�r37;
				\");
			}break;
			case 24:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j13 = format_abc_JumpStyle::\\\$JGte;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset13 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r40 = (\\\$offset13 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j13, \\\\\$offset13));
						\\\\\$�r41 = format_abc_OpCode::OJump2(\\\\\$j13, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset13], \\\\\$offset13);
						return \\\\\$�r41;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset13] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset13] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset13)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j13, \\\\\$offset13));
						\\\\\$�r42 = format_abc_OpCode::OJump2(\\\\\$j13, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset13);
						return \\\\\$�r42;
					\\\"));
					return \\\$�r40;
				\");
			}break;
			case 25:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j14 = format_abc_JumpStyle::\\\$JPhysEq;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset14 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r43 = (\\\$offset14 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j14, \\\\\$offset14));
						\\\\\$�r44 = format_abc_OpCode::OJump2(\\\\\$j14, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset14], \\\\\$offset14);
						return \\\\\$�r44;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset14] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset14] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset14)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j14, \\\\\$offset14));
						\\\\\$�r45 = format_abc_OpCode::OJump2(\\\\\$j14, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset14);
						return \\\\\$�r45;
					\\\"));
					return \\\$�r43;
				\");
			}break;
			case 26:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$j15 = format_abc_JumpStyle::\\\$JPhysNeq;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset15 = \\\$�this->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$�r46 = (\\\$offset15 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j15, \\\\\$offset15));
						\\\\\$�r47 = format_abc_OpCode::OJump2(\\\\\$j15, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset15], \\\\\$offset15);
						return \\\\\$�r47;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset15] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset15] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset15)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j15, \\\\\$offset15));
						\\\\\$�r48 = format_abc_OpCode::OJump2(\\\\\$j15, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset15);
						return \\\\\$�r48;
					\\\"));
					return \\\$�r46;
				\");
			}break;
			case 27:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;format_abc_OpReader::\\\$bytePos += 3;
					\\\$def = \\\$�this->i->readInt24();
					\\\$cases = new _hx_array(array());
					{
						\\\$_g1 = 0; \\\$_g = \\\$�this->readInt() + 1;
						while(\\\$_g1 < \\\$_g) {
							\\\$_ = \\\$_g1++;
							format_abc_OpReader::\\\$bytePos += 3;
							\\\$cases->push(\\\$�this->i->readInt24());
							unset(\\\$_);
						}
					}
					\\\$�r49 = format_abc_OpCode::OSwitch(\\\$def, \\\$cases);
					return \\\$�r49;
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
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$�r50 = format_abc_OpCode::OSmallInt(\\\$�this->i->readInt8());
					return \\\$�r50;
				\");
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
					\\\$�r51 = format_abc_OpCode::ONext(\\\$r1, \\\$r2);
					return \\\$�r51;
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
					\\\$�r52 = format_abc_OpCode::OCallMethod(\\\$s, \\\$n);
					return \\\$�r52;
				\");
			}break;
			case 68:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$m = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n2 = \\\$�this->readInt();
					\\\$�r53 = format_abc_OpCode::OCallStatic(\\\$m, \\\$n2);
					return \\\$�r53;
				\");
			}break;
			case 69:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n3 = \\\$�this->readInt();
					\\\$�r54 = format_abc_OpCode::OCallSuper(\\\$p, \\\$n3);
					return \\\$�r54;
				\");
			}break;
			case 70:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p2 = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n4 = \\\$�this->readInt();
					\\\$�r55 = format_abc_OpCode::OCallProperty(\\\$p2, \\\$n4);
					return \\\$�r55;
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
					\\\$�r56 = format_abc_OpCode::OConstructProperty(\\\$p3, \\\$n5);
					return \\\$�r56;
				\");
			}break;
			case 76:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p4 = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n6 = \\\$�this->readInt();
					\\\$�r57 = format_abc_OpCode::OCallPropLex(\\\$p4, \\\$n6);
					return \\\$�r57;
				\");
			}break;
			case 78:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p5 = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n7 = \\\$�this->readInt();
					\\\$�r58 = format_abc_OpCode::OCallSuperVoid(\\\$p5, \\\$n7);
					return \\\$�r58;
				\");
			}break;
			case 79:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p6 = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$n8 = \\\$�this->readInt();
					\\\$�r59 = format_abc_OpCode::OCallPropVoid(\\\$p6, \\\$n8);
					return \\\$�r59;
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
				\$�r = format_abc_OpCode::OReg(eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$�r60 = \\\$�this->i->readByte();
					return \\\$�r60;
				\"));
			}break;
			case 99:{
				\$�r = format_abc_OpCode::OSetReg(eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$�r61 = \\\$�this->i->readByte();
					return \\\$�r61;
				\"));
			}break;
			case 100:{
				\$�r = format_abc_OpCode::\$OGetGlobalScope;
			}break;
			case 101:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$�r62 = format_abc_OpCode::OGetScope(\\\$�this->i->readByte());
					return \\\$�r62;
				\");
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
			case 110:{
				\$�r = format_abc_OpCode::OGetGlobalSlot(\$�this->readInt());
			}break;
			case 111:{
				\$�r = format_abc_OpCode::OSetGlobalSlot(\$�this->readInt());
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
				\$�r = format_abc_OpCode::OIncrReg(eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$�r63 = \\\$�this->i->readByte();
					return \\\$�r63;
				\"));
			}break;
			case 147:{
				\$�r = format_abc_OpCode::OOp(format_abc_Operation::\$OpDecr);
			}break;
			case 148:{
				\$�r = format_abc_OpCode::ODecrReg(eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$�r64 = \\\$�this->i->readByte();
					return \\\$�r64;
				\"));
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
				\$�r = format_abc_OpCode::OIncrIReg(eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$�r65 = \\\$�this->i->readByte();
					return \\\$�r65;
				\"));
			}break;
			case 195:{
				\$�r = format_abc_OpCode::ODecrIReg(eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$�r66 = \\\$�this->i->readByte();
					return \\\$�r66;
				\"));
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
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					if(\\\$�this->i->readByte() !== 1) {
						throw new HException(\\\"assert\\\");
					}
					\\\$name = format_abc_Index::Idx(\\\$�this->readInt());
					\\\$r = eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;++format_abc_OpReader::\\\\\$bytePos;
						\\\\\$�r68 = \\\\\$�this->i->readByte();
						return \\\\\$�r68;
					\\\");
					\\\$line = \\\$�this->readInt();
					\\\$�r67 = format_abc_OpCode::ODebugReg(\\\$name, \\\$r, \\\$line);
					return \\\$�r67;
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
	static $bytePos = 0;
	static $jumps;
	static $jumpNameIndex;
	static $labels;
	static $labelNameIndex;
	static $ops;
	static function decode($i) {
		format_abc_OpReader::$bytePos = 0;
		format_abc_OpReader::$jumps = new _hx_array(array());
		format_abc_OpReader::$jumpNameIndex = 0;
		format_abc_OpReader::$labels = new _hx_array(array());
		format_abc_OpReader::$labelNameIndex = 0;
		$opr = new format_abc_OpReader($i);
		format_abc_OpReader::$ops = new _hx_array(array());
		while(true) {
			$op = null;
			try {
				if(format_abc_OpReader::$jumps[format_abc_OpReader::$bytePos] !== null) {
					$_g = 0; $_g1 = format_abc_OpReader::$jumps[format_abc_OpReader::$bytePos];
					while($_g < $_g1->length) {
						$s = $_g1[$_g];
						++$_g;
						format_abc_OpReader::$ops->push(format_abc_OpCode::OJump3($s));
						unset($s);
					}
				}
				$op = $i->readByte();
				++format_abc_OpReader::$bytePos;
			}catch(Exception $�e) {
			$_ex_ = ($�e instanceof HException) ? $�e->e : $�e;
			;
			if(($e = $_ex_) instanceof haxe_io_Eof){
				break;
			} else throw $�e; }
			format_abc_OpReader::$ops->push($opr->readOp($op));
			unset($�e,$s,$op,$e,$_g1,$_g,$_ex_);
		}
		return format_abc_OpReader::$ops;
	}
	function __toString() { return 'format.abc.OpReader'; }
}
