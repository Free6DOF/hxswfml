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
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$op) {
			case 1:{
				\$팿 = format_abc_OpCode::\$OBreakPoint;
			}break;
			case 2:{
				\$팿 = format_abc_OpCode::\$ONop;
			}break;
			case 3:{
				\$팿 = format_abc_OpCode::\$OThrow;
			}break;
			case 4:{
				\$팿 = format_abc_OpCode::OGetSuper(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 5:{
				\$팿 = format_abc_OpCode::OSetSuper(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 6:{
				\$팿 = format_abc_OpCode::ODxNs(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 7:{
				\$팿 = format_abc_OpCode::\$ODxNsLate;
			}break;
			case 8:{
				\$팿 = format_abc_OpCode::ORegKill(eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$팿2 = \\\$퍁his->i->readByte();
					return \\\$팿2;
				\"));
			}break;
			case 9:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;format_abc_OpReader::\\\$labelNameIndex++;
					format_abc_OpReader::\\\$labels[format_abc_OpReader::\\\$bytePos - 1] = \\\"label\\\" . format_abc_OpReader::\\\$labelNameIndex;
					format_abc_OpReader::\\\$ops->push(format_abc_OpCode::\\\$OLabel);
					\\\$팿3 = format_abc_OpCode::OLabel2(\\\"label\\\" . format_abc_OpReader::\\\$labelNameIndex);
					return \\\$팿3;
				\");
			}break;
			case 12:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j = format_abc_JumpStyle::\\\$JNotLt;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿4 = (\\\$offset < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j, \\\\\$offset));
						\\\\\$팿5 = format_abc_OpCode::OJump2(\\\\\$j, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset], \\\\\$offset);
						return \\\\\$팿5;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j, \\\\\$offset));
						\\\\\$팿6 = format_abc_OpCode::OJump2(\\\\\$j, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset);
						return \\\\\$팿6;
					\\\"));
					return \\\$팿4;
				\");
			}break;
			case 13:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j2 = format_abc_JumpStyle::\\\$JNotLte;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset2 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿7 = (\\\$offset2 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j2, \\\\\$offset2));
						\\\\\$팿8 = format_abc_OpCode::OJump2(\\\\\$j2, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset2], \\\\\$offset2);
						return \\\\\$팿8;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset2] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset2] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset2)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j2, \\\\\$offset2));
						\\\\\$팿9 = format_abc_OpCode::OJump2(\\\\\$j2, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset2);
						return \\\\\$팿9;
					\\\"));
					return \\\$팿7;
				\");
			}break;
			case 14:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j3 = format_abc_JumpStyle::\\\$JNotGt;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset3 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿10 = (\\\$offset3 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j3, \\\\\$offset3));
						\\\\\$팿11 = format_abc_OpCode::OJump2(\\\\\$j3, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset3], \\\\\$offset3);
						return \\\\\$팿11;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset3] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset3] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset3)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j3, \\\\\$offset3));
						\\\\\$팿12 = format_abc_OpCode::OJump2(\\\\\$j3, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset3);
						return \\\\\$팿12;
					\\\"));
					return \\\$팿10;
				\");
			}break;
			case 15:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j4 = format_abc_JumpStyle::\\\$JNotGte;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset4 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿13 = (\\\$offset4 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j4, \\\\\$offset4));
						\\\\\$팿14 = format_abc_OpCode::OJump2(\\\\\$j4, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset4], \\\\\$offset4);
						return \\\\\$팿14;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset4] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset4] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset4)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j4, \\\\\$offset4));
						\\\\\$팿15 = format_abc_OpCode::OJump2(\\\\\$j4, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset4);
						return \\\\\$팿15;
					\\\"));
					return \\\$팿13;
				\");
			}break;
			case 16:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j5 = format_abc_JumpStyle::\\\$JAlways;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset5 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿16 = (\\\$offset5 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j5, \\\\\$offset5));
						\\\\\$팿17 = format_abc_OpCode::OJump2(\\\\\$j5, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset5], \\\\\$offset5);
						return \\\\\$팿17;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset5] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset5] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset5)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j5, \\\\\$offset5));
						\\\\\$팿18 = format_abc_OpCode::OJump2(\\\\\$j5, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset5);
						return \\\\\$팿18;
					\\\"));
					return \\\$팿16;
				\");
			}break;
			case 17:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j6 = format_abc_JumpStyle::\\\$JTrue;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset6 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿19 = (\\\$offset6 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j6, \\\\\$offset6));
						\\\\\$팿20 = format_abc_OpCode::OJump2(\\\\\$j6, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset6], \\\\\$offset6);
						return \\\\\$팿20;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset6] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset6] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset6)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j6, \\\\\$offset6));
						\\\\\$팿21 = format_abc_OpCode::OJump2(\\\\\$j6, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset6);
						return \\\\\$팿21;
					\\\"));
					return \\\$팿19;
				\");
			}break;
			case 18:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j7 = format_abc_JumpStyle::\\\$JFalse;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset7 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿22 = (\\\$offset7 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j7, \\\\\$offset7));
						\\\\\$팿23 = format_abc_OpCode::OJump2(\\\\\$j7, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset7], \\\\\$offset7);
						return \\\\\$팿23;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset7] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset7] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset7)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j7, \\\\\$offset7));
						\\\\\$팿24 = format_abc_OpCode::OJump2(\\\\\$j7, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset7);
						return \\\\\$팿24;
					\\\"));
					return \\\$팿22;
				\");
			}break;
			case 19:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j8 = format_abc_JumpStyle::\\\$JEq;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset8 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿25 = (\\\$offset8 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j8, \\\\\$offset8));
						\\\\\$팿26 = format_abc_OpCode::OJump2(\\\\\$j8, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset8], \\\\\$offset8);
						return \\\\\$팿26;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset8] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset8] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset8)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j8, \\\\\$offset8));
						\\\\\$팿27 = format_abc_OpCode::OJump2(\\\\\$j8, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset8);
						return \\\\\$팿27;
					\\\"));
					return \\\$팿25;
				\");
			}break;
			case 20:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j9 = format_abc_JumpStyle::\\\$JNeq;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset9 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿28 = (\\\$offset9 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j9, \\\\\$offset9));
						\\\\\$팿29 = format_abc_OpCode::OJump2(\\\\\$j9, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset9], \\\\\$offset9);
						return \\\\\$팿29;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset9] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset9] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset9)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j9, \\\\\$offset9));
						\\\\\$팿30 = format_abc_OpCode::OJump2(\\\\\$j9, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset9);
						return \\\\\$팿30;
					\\\"));
					return \\\$팿28;
				\");
			}break;
			case 21:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j10 = format_abc_JumpStyle::\\\$JLt;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset10 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿31 = (\\\$offset10 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j10, \\\\\$offset10));
						\\\\\$팿32 = format_abc_OpCode::OJump2(\\\\\$j10, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset10], \\\\\$offset10);
						return \\\\\$팿32;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset10] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset10] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset10)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j10, \\\\\$offset10));
						\\\\\$팿33 = format_abc_OpCode::OJump2(\\\\\$j10, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset10);
						return \\\\\$팿33;
					\\\"));
					return \\\$팿31;
				\");
			}break;
			case 22:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j11 = format_abc_JumpStyle::\\\$JLte;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset11 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿34 = (\\\$offset11 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j11, \\\\\$offset11));
						\\\\\$팿35 = format_abc_OpCode::OJump2(\\\\\$j11, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset11], \\\\\$offset11);
						return \\\\\$팿35;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset11] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset11] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset11)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j11, \\\\\$offset11));
						\\\\\$팿36 = format_abc_OpCode::OJump2(\\\\\$j11, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset11);
						return \\\\\$팿36;
					\\\"));
					return \\\$팿34;
				\");
			}break;
			case 23:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j12 = format_abc_JumpStyle::\\\$JGt;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset12 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿37 = (\\\$offset12 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j12, \\\\\$offset12));
						\\\\\$팿38 = format_abc_OpCode::OJump2(\\\\\$j12, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset12], \\\\\$offset12);
						return \\\\\$팿38;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset12] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset12] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset12)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j12, \\\\\$offset12));
						\\\\\$팿39 = format_abc_OpCode::OJump2(\\\\\$j12, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset12);
						return \\\\\$팿39;
					\\\"));
					return \\\$팿37;
				\");
			}break;
			case 24:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j13 = format_abc_JumpStyle::\\\$JGte;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset13 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿40 = (\\\$offset13 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j13, \\\\\$offset13));
						\\\\\$팿41 = format_abc_OpCode::OJump2(\\\\\$j13, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset13], \\\\\$offset13);
						return \\\\\$팿41;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset13] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset13] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset13)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j13, \\\\\$offset13));
						\\\\\$팿42 = format_abc_OpCode::OJump2(\\\\\$j13, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset13);
						return \\\\\$팿42;
					\\\"));
					return \\\$팿40;
				\");
			}break;
			case 25:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j14 = format_abc_JumpStyle::\\\$JPhysEq;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset14 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿43 = (\\\$offset14 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j14, \\\\\$offset14));
						\\\\\$팿44 = format_abc_OpCode::OJump2(\\\\\$j14, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset14], \\\\\$offset14);
						return \\\\\$팿44;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset14] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset14] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset14)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j14, \\\\\$offset14));
						\\\\\$팿45 = format_abc_OpCode::OJump2(\\\\\$j14, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset14);
						return \\\\\$팿45;
					\\\"));
					return \\\$팿43;
				\");
			}break;
			case 26:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$j15 = format_abc_JumpStyle::\\\$JPhysNeq;
					format_abc_OpReader::\\\$jumpNameIndex++;
					\\\$offset15 = \\\$퍁his->i->readInt24();
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					++format_abc_OpReader::\\\$bytePos;
					\\\$팿46 = (\\\$offset15 < 0 ? eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j15, \\\\\$offset15));
						\\\\\$팿47 = format_abc_OpCode::OJump2(\\\\\$j15, format_abc_OpReader::\\\\\$labels[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset15], \\\\\$offset15);
						return \\\\\$팿47;
					\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;if(format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset15] === null) {
							format_abc_OpReader::\\\\\$jumps[format_abc_OpReader::\\\\\$bytePos + \\\\\$offset15] = new _hx_array(array());
						}
						_hx_array_get(format_abc_OpReader::\\\\\$jumps, format_abc_OpReader::\\\\\$bytePos + \\\\\$offset15)->push(\\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex);
						format_abc_OpReader::\\\\\$ops->push(format_abc_OpCode::OJump(\\\\\$j15, \\\\\$offset15));
						\\\\\$팿48 = format_abc_OpCode::OJump2(\\\\\$j15, \\\\\"j\\\\\" . format_abc_OpReader::\\\\\$jumpNameIndex, \\\\\$offset15);
						return \\\\\$팿48;
					\\\"));
					return \\\$팿46;
				\");
			}break;
			case 27:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;format_abc_OpReader::\\\$bytePos += 3;
					\\\$def = \\\$퍁his->i->readInt24();
					\\\$cases = new _hx_array(array());
					{
						\\\$_g1 = 0; \\\$_g = \\\$퍁his->readInt() + 1;
						while(\\\$_g1 < \\\$_g) {
							\\\$_ = \\\$_g1++;
							format_abc_OpReader::\\\$bytePos += 3;
							\\\$cases->push(\\\$퍁his->i->readInt24());
							unset(\\\$_);
						}
					}
					\\\$팿49 = format_abc_OpCode::OSwitch(\\\$def, \\\$cases);
					return \\\$팿49;
				\");
			}break;
			case 28:{
				\$팿 = format_abc_OpCode::\$OPushWith;
			}break;
			case 29:{
				\$팿 = format_abc_OpCode::\$OPopScope;
			}break;
			case 30:{
				\$팿 = format_abc_OpCode::\$OForIn;
			}break;
			case 31:{
				\$팿 = format_abc_OpCode::\$OHasNext;
			}break;
			case 32:{
				\$팿 = format_abc_OpCode::\$ONull;
			}break;
			case 33:{
				\$팿 = format_abc_OpCode::\$OUndefined;
			}break;
			case 35:{
				\$팿 = format_abc_OpCode::\$OForEach;
			}break;
			case 36:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$팿50 = format_abc_OpCode::OSmallInt(\\\$퍁his->i->readInt8());
					return \\\$팿50;
				\");
			}break;
			case 37:{
				\$팿 = format_abc_OpCode::OInt(\$퍁his->readInt());
			}break;
			case 38:{
				\$팿 = format_abc_OpCode::\$OTrue;
			}break;
			case 39:{
				\$팿 = format_abc_OpCode::\$OFalse;
			}break;
			case 40:{
				\$팿 = format_abc_OpCode::\$ONaN;
			}break;
			case 41:{
				\$팿 = format_abc_OpCode::\$OPop;
			}break;
			case 42:{
				\$팿 = format_abc_OpCode::\$ODup;
			}break;
			case 43:{
				\$팿 = format_abc_OpCode::\$OSwap;
			}break;
			case 44:{
				\$팿 = format_abc_OpCode::OString(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 45:{
				\$팿 = format_abc_OpCode::OIntRef(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 46:{
				\$팿 = format_abc_OpCode::OUIntRef(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 47:{
				\$팿 = format_abc_OpCode::OFloat(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 48:{
				\$팿 = format_abc_OpCode::\$OScope;
			}break;
			case 49:{
				\$팿 = format_abc_OpCode::ONamespace(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 50:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$r1 = \\\$퍁his->readInt();
					\\\$r2 = \\\$퍁his->readInt();
					\\\$팿51 = format_abc_OpCode::ONext(\\\$r1, \\\$r2);
					return \\\$팿51;
				\");
			}break;
			case 53:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGet8);
			}break;
			case 54:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGet16);
			}break;
			case 55:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGet32);
			}break;
			case 56:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGetFloat);
			}break;
			case 57:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemGetDouble);
			}break;
			case 58:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSet8);
			}break;
			case 59:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSet16);
			}break;
			case 60:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSet32);
			}break;
			case 61:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSetFloat);
			}break;
			case 62:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMemSetDouble);
			}break;
			case 64:{
				\$팿 = format_abc_OpCode::OFunction(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 65:{
				\$팿 = format_abc_OpCode::OCallStack(\$퍁his->readInt());
			}break;
			case 66:{
				\$팿 = format_abc_OpCode::OConstruct(\$퍁his->readInt());
			}break;
			case 67:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$s = \\\$퍁his->readInt();
					\\\$n = \\\$퍁his->readInt();
					\\\$팿52 = format_abc_OpCode::OCallMethod(\\\$s, \\\$n);
					return \\\$팿52;
				\");
			}break;
			case 68:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$m = format_abc_Index::Idx(\\\$퍁his->readInt());
					\\\$n2 = \\\$퍁his->readInt();
					\\\$팿53 = format_abc_OpCode::OCallStatic(\\\$m, \\\$n2);
					return \\\$팿53;
				\");
			}break;
			case 69:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$p = format_abc_Index::Idx(\\\$퍁his->readInt());
					\\\$n3 = \\\$퍁his->readInt();
					\\\$팿54 = format_abc_OpCode::OCallSuper(\\\$p, \\\$n3);
					return \\\$팿54;
				\");
			}break;
			case 70:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$p2 = format_abc_Index::Idx(\\\$퍁his->readInt());
					\\\$n4 = \\\$퍁his->readInt();
					\\\$팿55 = format_abc_OpCode::OCallProperty(\\\$p2, \\\$n4);
					return \\\$팿55;
				\");
			}break;
			case 71:{
				\$팿 = format_abc_OpCode::\$ORetVoid;
			}break;
			case 72:{
				\$팿 = format_abc_OpCode::\$ORet;
			}break;
			case 73:{
				\$팿 = format_abc_OpCode::OConstructSuper(\$퍁his->readInt());
			}break;
			case 74:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$p3 = format_abc_Index::Idx(\\\$퍁his->readInt());
					\\\$n5 = \\\$퍁his->readInt();
					\\\$팿56 = format_abc_OpCode::OConstructProperty(\\\$p3, \\\$n5);
					return \\\$팿56;
				\");
			}break;
			case 76:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$p4 = format_abc_Index::Idx(\\\$퍁his->readInt());
					\\\$n6 = \\\$퍁his->readInt();
					\\\$팿57 = format_abc_OpCode::OCallPropLex(\\\$p4, \\\$n6);
					return \\\$팿57;
				\");
			}break;
			case 78:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$p5 = format_abc_Index::Idx(\\\$퍁his->readInt());
					\\\$n7 = \\\$퍁his->readInt();
					\\\$팿58 = format_abc_OpCode::OCallSuperVoid(\\\$p5, \\\$n7);
					return \\\$팿58;
				\");
			}break;
			case 79:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$p6 = format_abc_Index::Idx(\\\$퍁his->readInt());
					\\\$n8 = \\\$퍁his->readInt();
					\\\$팿59 = format_abc_OpCode::OCallPropVoid(\\\$p6, \\\$n8);
					return \\\$팿59;
				\");
			}break;
			case 80:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpSign1);
			}break;
			case 81:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpSign8);
			}break;
			case 82:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpSign16);
			}break;
			case 83:{
				\$팿 = format_abc_OpCode::OApplyType(\$퍁his->readInt());
			}break;
			case 85:{
				\$팿 = format_abc_OpCode::OObject(\$퍁his->readInt());
			}break;
			case 86:{
				\$팿 = format_abc_OpCode::OArray(\$퍁his->readInt());
			}break;
			case 87:{
				\$팿 = format_abc_OpCode::\$ONewBlock;
			}break;
			case 88:{
				\$팿 = format_abc_OpCode::OClassDef(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 89:{
				\$팿 = format_abc_OpCode::OGetDescendants(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 90:{
				\$팿 = format_abc_OpCode::OCatch(\$퍁his->readInt());
			}break;
			case 93:{
				\$팿 = format_abc_OpCode::OFindPropStrict(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 94:{
				\$팿 = format_abc_OpCode::OFindProp(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 95:{
				\$팿 = format_abc_OpCode::OFindDefinition(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 96:{
				\$팿 = format_abc_OpCode::OGetLex(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 97:{
				\$팿 = format_abc_OpCode::OSetProp(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 98:{
				\$팿 = format_abc_OpCode::OReg(eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$팿60 = \\\$퍁his->i->readByte();
					return \\\$팿60;
				\"));
			}break;
			case 99:{
				\$팿 = format_abc_OpCode::OSetReg(eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$팿61 = \\\$퍁his->i->readByte();
					return \\\$팿61;
				\"));
			}break;
			case 100:{
				\$팿 = format_abc_OpCode::\$OGetGlobalScope;
			}break;
			case 101:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$팿62 = format_abc_OpCode::OGetScope(\\\$퍁his->i->readByte());
					return \\\$팿62;
				\");
			}break;
			case 102:{
				\$팿 = format_abc_OpCode::OGetProp(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 104:{
				\$팿 = format_abc_OpCode::OInitProp(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 106:{
				\$팿 = format_abc_OpCode::ODeleteProp(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 108:{
				\$팿 = format_abc_OpCode::OGetSlot(\$퍁his->readInt());
			}break;
			case 109:{
				\$팿 = format_abc_OpCode::OSetSlot(\$퍁his->readInt());
			}break;
			case 110:{
				\$팿 = format_abc_OpCode::OGetGlobalSlot(\$퍁his->readInt());
			}break;
			case 111:{
				\$팿 = format_abc_OpCode::OSetGlobalSlot(\$퍁his->readInt());
			}break;
			case 112:{
				\$팿 = format_abc_OpCode::\$OToString;
			}break;
			case 113:{
				\$팿 = format_abc_OpCode::\$OToXml;
			}break;
			case 114:{
				\$팿 = format_abc_OpCode::\$OToXmlAttr;
			}break;
			case 115:{
				\$팿 = format_abc_OpCode::\$OToInt;
			}break;
			case 116:{
				\$팿 = format_abc_OpCode::\$OToUInt;
			}break;
			case 117:{
				\$팿 = format_abc_OpCode::\$OToNumber;
			}break;
			case 118:{
				\$팿 = format_abc_OpCode::\$OToBool;
			}break;
			case 119:{
				\$팿 = format_abc_OpCode::\$OToObject;
			}break;
			case 120:{
				\$팿 = format_abc_OpCode::\$OCheckIsXml;
			}break;
			case 128:{
				\$팿 = format_abc_OpCode::OCast(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 130:{
				\$팿 = format_abc_OpCode::\$OAsAny;
			}break;
			case 133:{
				\$팿 = format_abc_OpCode::\$OAsString;
			}break;
			case 134:{
				\$팿 = format_abc_OpCode::OAsType(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 135:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpAs);
			}break;
			case 137:{
				\$팿 = format_abc_OpCode::\$OAsObject;
			}break;
			case 144:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpNeg);
			}break;
			case 145:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpIncr);
			}break;
			case 146:{
				\$팿 = format_abc_OpCode::OIncrReg(eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$팿63 = \\\$퍁his->i->readByte();
					return \\\$팿63;
				\"));
			}break;
			case 147:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpDecr);
			}break;
			case 148:{
				\$팿 = format_abc_OpCode::ODecrReg(eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$팿64 = \\\$퍁his->i->readByte();
					return \\\$팿64;
				\"));
			}break;
			case 149:{
				\$팿 = format_abc_OpCode::\$OTypeof;
			}break;
			case 150:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpNot);
			}break;
			case 151:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpBitNot);
			}break;
			case 160:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpAdd);
			}break;
			case 161:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpSub);
			}break;
			case 162:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMul);
			}break;
			case 163:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpDiv);
			}break;
			case 164:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpMod);
			}break;
			case 165:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpShl);
			}break;
			case 166:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpShr);
			}break;
			case 167:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpUShr);
			}break;
			case 168:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpAnd);
			}break;
			case 169:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpOr);
			}break;
			case 170:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpXor);
			}break;
			case 171:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpEq);
			}break;
			case 172:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpPhysEq);
			}break;
			case 173:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpLt);
			}break;
			case 174:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpLte);
			}break;
			case 175:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpGt);
			}break;
			case 176:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpGte);
			}break;
			case 177:{
				\$팿 = format_abc_OpCode::\$OInstanceOf;
			}break;
			case 178:{
				\$팿 = format_abc_OpCode::OIsType(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 179:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpIs);
			}break;
			case 180:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpIn);
			}break;
			case 192:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpIIncr);
			}break;
			case 193:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpIDecr);
			}break;
			case 194:{
				\$팿 = format_abc_OpCode::OIncrIReg(eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$팿65 = \\\$퍁his->i->readByte();
					return \\\$팿65;
				\"));
			}break;
			case 195:{
				\$팿 = format_abc_OpCode::ODecrIReg(eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					\\\$팿66 = \\\$퍁his->i->readByte();
					return \\\$팿66;
				\"));
			}break;
			case 196:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpINeg);
			}break;
			case 197:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpIAdd);
			}break;
			case 198:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpISub);
			}break;
			case 199:{
				\$팿 = format_abc_OpCode::OOp(format_abc_Operation::\$OpIMul);
			}break;
			case 208:{
				\$팿 = format_abc_OpCode::\$OThis;
			}break;
			case 209:{
				\$팿 = format_abc_OpCode::OReg(1);
			}break;
			case 210:{
				\$팿 = format_abc_OpCode::OReg(2);
			}break;
			case 211:{
				\$팿 = format_abc_OpCode::OReg(3);
			}break;
			case 212:{
				\$팿 = format_abc_OpCode::\$OSetThis;
			}break;
			case 213:{
				\$팿 = format_abc_OpCode::OSetReg(1);
			}break;
			case 214:{
				\$팿 = format_abc_OpCode::OSetReg(2);
			}break;
			case 215:{
				\$팿 = format_abc_OpCode::OSetReg(3);
			}break;
			case 239:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;++format_abc_OpReader::\\\$bytePos;
					if(\\\$퍁his->i->readByte() !== 1) {
						throw new HException(\\\"assert\\\");
					}
					\\\$name = format_abc_Index::Idx(\\\$퍁his->readInt());
					\\\$r = eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;++format_abc_OpReader::\\\\\$bytePos;
						\\\\\$팿68 = \\\\\$퍁his->i->readByte();
						return \\\\\$팿68;
					\\\");
					\\\$line = \\\$퍁his->readInt();
					\\\$팿67 = format_abc_OpCode::ODebugReg(\\\$name, \\\$r, \\\$line);
					return \\\$팿67;
				\");
			}break;
			case 240:{
				\$팿 = format_abc_OpCode::ODebugLine(\$퍁his->readInt());
			}break;
			case 241:{
				\$팿 = format_abc_OpCode::ODebugFile(format_abc_Index::Idx(\$퍁his->readInt()));
			}break;
			case 242:{
				\$팿 = format_abc_OpCode::OBreakPointLine(\$퍁his->readInt());
			}break;
			case 243:{
				\$팿 = format_abc_OpCode::\$OTimestamp;
			}break;
			default:{
				\$팿 = format_abc_OpCode::OUnknown(\$op);
			}break;
			}
			return \$팿;
		");
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->팪ynamics[$m]) && is_callable($this->팪ynamics[$m]))
			return call_user_func_array($this->팪ynamics[$m], $a);
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
			}catch(Exception $팫) {
			$_ex_ = ($팫 instanceof HException) ? $팫->e : $팫;
			;
			if(($e = $_ex_) instanceof haxe_io_Eof){
				break;
			} else throw $팫; }
			format_abc_OpReader::$ops->push($opr->readOp($op));
			unset($팫,$s,$op,$e,$_g1,$_g,$_ex_);
		}
		return format_abc_OpReader::$ops;
	}
	function __toString() { return 'format.abc.OpReader'; }
}
