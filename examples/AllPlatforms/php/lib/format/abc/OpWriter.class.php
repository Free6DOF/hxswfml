<?php

class format_abc_OpWriter {
	public function __construct($o) {
		if(!php_Boot::$skip_constructor) {
		$this->o = $o;
	}}
	public function write($op) {
		$__hx__t = ($op);
		switch($__hx__t->index) {
		case 0:
		{
			$this->o->writeByte(1);
		}break;
		case 1:
		{
			$this->o->writeByte(2);
		}break;
		case 2:
		{
			$this->o->writeByte(3);
		}break;
		case 3:
		$v = $__hx__t->params[0];
		{
			$this->o->writeByte(4);
			$this->idx($v);
		}break;
		case 4:
		$v = $__hx__t->params[0];
		{
			$this->o->writeByte(5);
			$this->idx($v);
		}break;
		case 5:
		$i = $__hx__t->params[0];
		{
			$this->o->writeByte(6);
			$this->idx($i);
		}break;
		case 6:
		{
			$this->o->writeByte(7);
		}break;
		case 7:
		$r = $__hx__t->params[0];
		{
			$this->o->writeByte(8);
			$this->reg($r);
		}break;
		case 8:
		{
			$this->o->writeByte(9);
		}break;
		case 9:
		$landingName = $__hx__t->params[0];
		{
			return;
		}break;
		case 10:
		$delta = $__hx__t->params[1]; $j = $__hx__t->params[0];
		{
			$this->o->writeByte($this->jumpCode($j));
			$this->o->writeInt24($delta);
		}break;
		case 11:
		$delta = $__hx__t->params[2]; $landingName = $__hx__t->params[1]; $j = $__hx__t->params[0];
		{
			return;
		}break;
		case 12:
		$landingName = $__hx__t->params[0];
		{
			return;
		}break;
		case 13:
		$deltas = $__hx__t->params[1]; $def = $__hx__t->params[0];
		{
			$this->o->writeByte(27);
			$this->o->writeInt24($def);
			$this->int($deltas->length - 1);
			{
				$_g = 0;
				while($_g < $deltas->length) {
					$d = $deltas[$_g];
					++$_g;
					$this->o->writeInt24($d);
					unset($d);
				}
			}
		}break;
		case 14:
		$offsets = $__hx__t->params[2]; $deltas = $__hx__t->params[1]; $def = $__hx__t->params[0];
		{
			return;
		}break;
		case 15:
		$landingName = $__hx__t->params[0];
		{
			return;
		}break;
		case 16:
		{
			$this->o->writeByte(28);
		}break;
		case 17:
		{
			$this->o->writeByte(29);
		}break;
		case 18:
		{
			$this->o->writeByte(30);
		}break;
		case 19:
		{
			$this->o->writeByte(31);
		}break;
		case 20:
		{
			$this->o->writeByte(32);
		}break;
		case 21:
		{
			$this->o->writeByte(33);
		}break;
		case 22:
		{
			$this->o->writeByte(35);
		}break;
		case 23:
		$v = $__hx__t->params[0];
		{
			$this->o->writeByte(36);
			$this->o->writeInt8($v);
		}break;
		case 24:
		$v = $__hx__t->params[0];
		{
			$this->o->writeByte(37);
			$this->int($v);
		}break;
		case 25:
		{
			$this->o->writeByte(38);
		}break;
		case 26:
		{
			$this->o->writeByte(39);
		}break;
		case 27:
		{
			$this->o->writeByte(40);
		}break;
		case 28:
		{
			$this->o->writeByte(41);
		}break;
		case 29:
		{
			$this->o->writeByte(42);
		}break;
		case 30:
		{
			$this->o->writeByte(43);
		}break;
		case 31:
		$v = $__hx__t->params[0];
		{
			$this->o->writeByte(44);
			$this->idx($v);
		}break;
		case 32:
		$v = $__hx__t->params[0];
		{
			$this->o->writeByte(45);
			$this->idx($v);
		}break;
		case 33:
		$v = $__hx__t->params[0];
		{
			$this->o->writeByte(46);
			$this->idx($v);
		}break;
		case 34:
		$v = $__hx__t->params[0];
		{
			$this->o->writeByte(47);
			$this->idx($v);
		}break;
		case 35:
		{
			$this->o->writeByte(48);
		}break;
		case 36:
		$v = $__hx__t->params[0];
		{
			$this->o->writeByte(49);
			$this->idx($v);
		}break;
		case 37:
		$r2 = $__hx__t->params[1]; $r1 = $__hx__t->params[0];
		{
			$this->o->writeByte(50);
			$this->int($r1);
			$this->int($r2);
		}break;
		case 38:
		$f = $__hx__t->params[0];
		{
			$this->o->writeByte(64);
			$this->idx($f);
		}break;
		case 39:
		$n = $__hx__t->params[0];
		{
			$this->o->writeByte(65);
			$this->int($n);
		}break;
		case 40:
		$n = $__hx__t->params[0];
		{
			$this->o->writeByte(66);
			$this->int($n);
		}break;
		case 41:
		$n = $__hx__t->params[1]; $s = $__hx__t->params[0];
		{
			$this->o->writeByte(67);
			$this->int($s);
			$this->int($n);
		}break;
		case 42:
		$n = $__hx__t->params[1]; $m = $__hx__t->params[0];
		{
			$this->o->writeByte(68);
			$this->idx($m);
			$this->int($n);
		}break;
		case 43:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			$this->o->writeByte(69);
			$this->idx($p);
			$this->int($n);
		}break;
		case 44:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			$this->o->writeByte(70);
			$this->idx($p);
			$this->int($n);
		}break;
		case 45:
		{
			$this->o->writeByte(71);
		}break;
		case 46:
		{
			$this->o->writeByte(72);
		}break;
		case 47:
		$n = $__hx__t->params[0];
		{
			$this->o->writeByte(73);
			$this->int($n);
		}break;
		case 48:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			$this->o->writeByte(74);
			$this->idx($p);
			$this->int($n);
		}break;
		case 49:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			$this->o->writeByte(76);
			$this->idx($p);
			$this->int($n);
		}break;
		case 50:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			$this->o->writeByte(78);
			$this->idx($p);
			$this->int($n);
		}break;
		case 51:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			$this->o->writeByte(79);
			$this->idx($p);
			$this->int($n);
		}break;
		case 52:
		$n = $__hx__t->params[0];
		{
			$this->o->writeByte(83);
			$this->int($n);
		}break;
		case 53:
		$n = $__hx__t->params[0];
		{
			$this->o->writeByte(85);
			$this->int($n);
		}break;
		case 54:
		$n = $__hx__t->params[0];
		{
			$this->o->writeByte(86);
			$this->int($n);
		}break;
		case 55:
		{
			$this->o->writeByte(87);
		}break;
		case 56:
		$c = $__hx__t->params[0];
		{
			$this->o->writeByte(88);
			$this->idx($c);
		}break;
		case 57:
		$i = $__hx__t->params[0];
		{
			$this->o->writeByte(89);
			$this->idx($i);
		}break;
		case 58:
		$c = $__hx__t->params[0];
		{
			$this->o->writeByte(90);
			$this->int($c);
		}break;
		case 59:
		$p = $__hx__t->params[0];
		{
			$this->o->writeByte(93);
			$this->idx($p);
		}break;
		case 60:
		$p = $__hx__t->params[0];
		{
			$this->o->writeByte(94);
			$this->idx($p);
		}break;
		case 61:
		$d = $__hx__t->params[0];
		{
			$this->o->writeByte(95);
			$this->idx($d);
		}break;
		case 62:
		$p = $__hx__t->params[0];
		{
			$this->o->writeByte(96);
			$this->idx($p);
		}break;
		case 63:
		$p = $__hx__t->params[0];
		{
			$this->o->writeByte(97);
			$this->idx($p);
		}break;
		case 64:
		$r = $__hx__t->params[0];
		{
			switch($r) {
			case 0:{
				$this->o->writeByte(208);
			}break;
			case 1:{
				$this->o->writeByte(209);
			}break;
			case 2:{
				$this->o->writeByte(210);
			}break;
			case 3:{
				$this->o->writeByte(211);
			}break;
			default:{
				$this->o->writeByte(98);
				$this->reg($r);
			}break;
			}
		}break;
		case 65:
		$r = $__hx__t->params[0];
		{
			switch($r) {
			case 0:{
				$this->o->writeByte(212);
			}break;
			case 1:{
				$this->o->writeByte(213);
			}break;
			case 2:{
				$this->o->writeByte(214);
			}break;
			case 3:{
				$this->o->writeByte(215);
			}break;
			default:{
				$this->o->writeByte(99);
				$this->reg($r);
			}break;
			}
		}break;
		case 66:
		{
			$this->o->writeByte(100);
		}break;
		case 67:
		$n = $__hx__t->params[0];
		{
			$this->o->writeByte(101);
			$this->o->writeByte($n);
		}break;
		case 68:
		$p = $__hx__t->params[0];
		{
			$this->o->writeByte(102);
			$this->idx($p);
		}break;
		case 69:
		$p = $__hx__t->params[0];
		{
			$this->o->writeByte(104);
			$this->idx($p);
		}break;
		case 70:
		$p = $__hx__t->params[0];
		{
			$this->o->writeByte(106);
			$this->idx($p);
		}break;
		case 71:
		$s = $__hx__t->params[0];
		{
			$this->o->writeByte(108);
			$this->int($s);
		}break;
		case 72:
		$s = $__hx__t->params[0];
		{
			$this->o->writeByte(109);
			$this->int($s);
		}break;
		case 73:
		$s = $__hx__t->params[0];
		{
			$this->o->writeByte(110);
			$this->int($s);
		}break;
		case 74:
		$s = $__hx__t->params[0];
		{
			$this->o->writeByte(111);
			$this->int($s);
		}break;
		case 75:
		{
			$this->o->writeByte(112);
		}break;
		case 76:
		{
			$this->o->writeByte(113);
		}break;
		case 77:
		{
			$this->o->writeByte(114);
		}break;
		case 78:
		{
			$this->o->writeByte(115);
		}break;
		case 79:
		{
			$this->o->writeByte(116);
		}break;
		case 80:
		{
			$this->o->writeByte(117);
		}break;
		case 81:
		{
			$this->o->writeByte(118);
		}break;
		case 82:
		{
			$this->o->writeByte(119);
		}break;
		case 83:
		{
			$this->o->writeByte(120);
		}break;
		case 84:
		$t = $__hx__t->params[0];
		{
			$this->o->writeByte(128);
			$this->idx($t);
		}break;
		case 85:
		{
			$this->o->writeByte(130);
		}break;
		case 86:
		{
			$this->o->writeByte(133);
		}break;
		case 87:
		$t = $__hx__t->params[0];
		{
			$this->o->writeByte(134);
			$this->idx($t);
		}break;
		case 88:
		{
			$this->o->writeByte(137);
		}break;
		case 89:
		$r = $__hx__t->params[0];
		{
			$this->o->writeByte(146);
			$this->reg($r);
		}break;
		case 90:
		$r = $__hx__t->params[0];
		{
			$this->o->writeByte(148);
			$this->reg($r);
		}break;
		case 91:
		{
			$this->o->writeByte(149);
		}break;
		case 92:
		{
			$this->o->writeByte(177);
		}break;
		case 93:
		$t = $__hx__t->params[0];
		{
			$this->o->writeByte(178);
			$this->idx($t);
		}break;
		case 94:
		$r = $__hx__t->params[0];
		{
			$this->o->writeByte(194);
			$this->reg($r);
		}break;
		case 95:
		$r = $__hx__t->params[0];
		{
			$this->o->writeByte(195);
			$this->reg($r);
		}break;
		case 96:
		{
			$this->o->writeByte(208);
		}break;
		case 97:
		{
			$this->o->writeByte(212);
		}break;
		case 98:
		$line = $__hx__t->params[2]; $r = $__hx__t->params[1]; $name = $__hx__t->params[0];
		{
			$this->o->writeByte(239);
			$this->o->writeByte(1);
			$this->idx($name);
			$this->reg($r);
			$this->int($line);
		}break;
		case 99:
		$line = $__hx__t->params[0];
		{
			$this->o->writeByte(240);
			$this->int($line);
		}break;
		case 100:
		$file = $__hx__t->params[0];
		{
			$this->o->writeByte(241);
			$this->idx($file);
		}break;
		case 101:
		$n = $__hx__t->params[0];
		{
			$this->o->writeByte(242);
			$this->int($n);
		}break;
		case 102:
		{
			$this->o->writeByte(243);
		}break;
		case 103:
		$op1 = $__hx__t->params[0];
		{
			$this->o->writeByte($this->operationCode($op1));
		}break;
		case 104:
		$byte = $__hx__t->params[0];
		{
			$this->o->writeByte($byte);
		}break;
		}
	}
	public function operationCode($o) {
		return format_abc_OpWriter_0($this, $o);
	}
	public function jumpCode($j) {
		return format_abc_OpWriter_1($this, $j);
	}
	public function idx($i) {
		$__hx__t = ($i);
		switch($__hx__t->index) {
		case 0:
		$i1 = $__hx__t->params[0];
		{
			$this->int($i1);
		}break;
		}
	}
	public function reg($v) {
		$this->o->writeByte($v);
	}
	public function b($v) {
		$this->o->writeByte($v);
	}
	public function int($i) {
		$this->writeInt($i);
	}
	public function writeInt32($n) {
		$e = _hx_shift_right($n, 28);
		$n1 = $n & 268435455;
		$d = $n1 >> 21 & 127;
		$c = $n1 >> 14 & 127;
		$b = $n1 >> 7 & 127;
		$a = $n1 & 127;
		if($b !== 0 || $c !== 0 || $d !== 0 || $e !== 0) {
			$this->o->writeByte($a | 128);
			if($c !== 0 || $d !== 0 || $e !== 0) {
				$this->o->writeByte($b | 128);
				if($d !== 0 || $e !== 0) {
					$this->o->writeByte($c | 128);
					if($e !== 0) {
						$this->o->writeByte($d | 128);
						$this->o->writeByte($e);
					} else {
						$this->o->writeByte($d);
					}
				} else {
					$this->o->writeByte($c);
				}
			} else {
				$this->o->writeByte($b);
			}
		} else {
			$this->o->writeByte($a);
		}
	}
	public function writeInt($n) {
		$e = _hx_shift_right($n, 28);
		$d = $n >> 21 & 127;
		$c = $n >> 14 & 127;
		$b = $n >> 7 & 127;
		$a = $n & 127;
		if($b !== 0 || $c !== 0 || $d !== 0 || $e !== 0) {
			$this->o->writeByte($a | 128);
			if($c !== 0 || $d !== 0 || $e !== 0) {
				$this->o->writeByte($b | 128);
				if($d !== 0 || $e !== 0) {
					$this->o->writeByte($c | 128);
					if($e !== 0) {
						$this->o->writeByte($d | 128);
						$this->o->writeByte($e);
					} else {
						$this->o->writeByte($d);
					}
				} else {
					$this->o->writeByte($c);
				}
			} else {
				$this->o->writeByte($b);
			}
		} else {
			$this->o->writeByte($a);
		}
	}
	public $o;
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
	function __toString() { return 'format.abc.OpWriter'; }
}
function format_abc_OpWriter_0(&$__hx__this, &$o) {
	$__hx__t = ($o);
	switch($__hx__t->index) {
	case 0:
	{
		return 135;
	}break;
	case 1:
	{
		return 144;
	}break;
	case 2:
	{
		return 145;
	}break;
	case 3:
	{
		return 147;
	}break;
	case 4:
	{
		return 150;
	}break;
	case 5:
	{
		return 151;
	}break;
	case 6:
	{
		return 160;
	}break;
	case 7:
	{
		return 161;
	}break;
	case 8:
	{
		return 162;
	}break;
	case 9:
	{
		return 163;
	}break;
	case 10:
	{
		return 164;
	}break;
	case 11:
	{
		return 165;
	}break;
	case 12:
	{
		return 166;
	}break;
	case 13:
	{
		return 167;
	}break;
	case 14:
	{
		return 168;
	}break;
	case 15:
	{
		return 169;
	}break;
	case 16:
	{
		return 170;
	}break;
	case 17:
	{
		return 171;
	}break;
	case 18:
	{
		return 172;
	}break;
	case 19:
	{
		return 173;
	}break;
	case 20:
	{
		return 174;
	}break;
	case 21:
	{
		return 175;
	}break;
	case 22:
	{
		return 176;
	}break;
	case 23:
	{
		return 179;
	}break;
	case 24:
	{
		return 180;
	}break;
	case 25:
	{
		return 192;
	}break;
	case 26:
	{
		return 193;
	}break;
	case 27:
	{
		return 196;
	}break;
	case 28:
	{
		return 197;
	}break;
	case 29:
	{
		return 198;
	}break;
	case 30:
	{
		return 199;
	}break;
	case 31:
	{
		return 53;
	}break;
	case 32:
	{
		return 54;
	}break;
	case 33:
	{
		return 55;
	}break;
	case 34:
	{
		return 56;
	}break;
	case 35:
	{
		return 57;
	}break;
	case 36:
	{
		return 58;
	}break;
	case 37:
	{
		return 59;
	}break;
	case 38:
	{
		return 60;
	}break;
	case 39:
	{
		return 61;
	}break;
	case 40:
	{
		return 62;
	}break;
	case 41:
	{
		return 80;
	}break;
	case 42:
	{
		return 81;
	}break;
	case 43:
	{
		return 82;
	}break;
	}
}
function format_abc_OpWriter_1(&$__hx__this, &$j) {
	$__hx__t = ($j);
	switch($__hx__t->index) {
	case 0:
	{
		return 12;
	}break;
	case 1:
	{
		return 13;
	}break;
	case 2:
	{
		return 14;
	}break;
	case 3:
	{
		return 15;
	}break;
	case 4:
	{
		return 16;
	}break;
	case 5:
	{
		return 17;
	}break;
	case 6:
	{
		return 18;
	}break;
	case 7:
	{
		return 19;
	}break;
	case 8:
	{
		return 20;
	}break;
	case 9:
	{
		return 21;
	}break;
	case 10:
	{
		return 22;
	}break;
	case 11:
	{
		return 23;
	}break;
	case 12:
	{
		return 24;
	}break;
	case 13:
	{
		return 25;
	}break;
	case 14:
	{
		return 26;
	}break;
	}
}
