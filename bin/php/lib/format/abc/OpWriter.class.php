<?php

class format_abc_OpWriter {
	public function __construct($o) {
		if( !php_Boot::$skip_constructor ) {
		$this->o = $o;
	}}
	public $o;
	public function writeInt($n) {
		$e = _hx_shift_right($n, 28);
		$d = ($n >> 21) & 127;
		$c = ($n >> 14) & 127;
		$b = ($n >> 7) & 127;
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
					}
					else {
						$this->o->writeByte($d);
					}
				}
				else {
					$this->o->writeByte($c);
				}
			}
			else {
				$this->o->writeByte($b);
			}
		}
		else {
			$this->o->writeByte($a);
		}
	}
	public function writeInt32($n) {
		$e = eval("if(isset(\$this)) \$�this =& \$this;\$x = _hx_shift_right((\$n), 28);
			if((((\$x) >> 30) & 1) !== (_hx_shift_right((\$x), 31))) {
				throw new HException(\"Overflow \" . \$x);
			}
			\$�r = ((\$x) & -1);
			return \$�r;
		");
		$n1 = eval("if(isset(\$this)) \$�this =& \$this;\$x2 = (\$n) & 268435455;
			if((((\$x2) >> 30) & 1) !== (_hx_shift_right((\$x2), 31))) {
				throw new HException(\"Overflow \" . \$x2);
			}
			\$�r2 = ((\$x2) & -1);
			return \$�r2;
		");
		$d = ($n1 >> 21) & 127;
		$c = ($n1 >> 14) & 127;
		$b = ($n1 >> 7) & 127;
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
					}
					else {
						$this->o->writeByte($d);
					}
				}
				else {
					$this->o->writeByte($c);
				}
			}
			else {
				$this->o->writeByte($b);
			}
		}
		else {
			$this->o->writeByte($a);
		}
	}
	public function int($i) {
		$this->writeInt($i);
	}
	public function b($v) {
		$this->o->writeByte($v);
	}
	public function reg($v) {
		$this->o->writeByte($v);
	}
	public function idx($i) {
		$�t = ($i);
		switch($�t->index) {
		case 0:
		$i1 = $�t->params[0];
		{
			$this->int($i1);
		}break;
		}
	}
	public function jumpCode($j) {
		return eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$j);
			switch(\$�t->index) {
			case 0:
			{
				\$�r = 12;
			}break;
			case 1:
			{
				\$�r = 13;
			}break;
			case 2:
			{
				\$�r = 14;
			}break;
			case 3:
			{
				\$�r = 15;
			}break;
			case 4:
			{
				\$�r = 16;
			}break;
			case 5:
			{
				\$�r = 17;
			}break;
			case 6:
			{
				\$�r = 18;
			}break;
			case 7:
			{
				\$�r = 19;
			}break;
			case 8:
			{
				\$�r = 20;
			}break;
			case 9:
			{
				\$�r = 21;
			}break;
			case 10:
			{
				\$�r = 22;
			}break;
			case 11:
			{
				\$�r = 23;
			}break;
			case 12:
			{
				\$�r = 24;
			}break;
			case 13:
			{
				\$�r = 25;
			}break;
			case 14:
			{
				\$�r = 26;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	public function operationCode($o) {
		return eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$o);
			switch(\$�t->index) {
			case 0:
			{
				\$�r = 135;
			}break;
			case 1:
			{
				\$�r = 144;
			}break;
			case 2:
			{
				\$�r = 145;
			}break;
			case 3:
			{
				\$�r = 147;
			}break;
			case 4:
			{
				\$�r = 150;
			}break;
			case 5:
			{
				\$�r = 151;
			}break;
			case 6:
			{
				\$�r = 160;
			}break;
			case 7:
			{
				\$�r = 161;
			}break;
			case 8:
			{
				\$�r = 162;
			}break;
			case 9:
			{
				\$�r = 163;
			}break;
			case 10:
			{
				\$�r = 164;
			}break;
			case 11:
			{
				\$�r = 165;
			}break;
			case 12:
			{
				\$�r = 166;
			}break;
			case 13:
			{
				\$�r = 167;
			}break;
			case 14:
			{
				\$�r = 168;
			}break;
			case 15:
			{
				\$�r = 169;
			}break;
			case 16:
			{
				\$�r = 170;
			}break;
			case 17:
			{
				\$�r = 171;
			}break;
			case 18:
			{
				\$�r = 172;
			}break;
			case 19:
			{
				\$�r = 173;
			}break;
			case 20:
			{
				\$�r = 174;
			}break;
			case 21:
			{
				\$�r = 175;
			}break;
			case 22:
			{
				\$�r = 176;
			}break;
			case 23:
			{
				\$�r = 179;
			}break;
			case 24:
			{
				\$�r = 180;
			}break;
			case 25:
			{
				\$�r = 192;
			}break;
			case 26:
			{
				\$�r = 193;
			}break;
			case 27:
			{
				\$�r = 196;
			}break;
			case 28:
			{
				\$�r = 197;
			}break;
			case 29:
			{
				\$�r = 198;
			}break;
			case 30:
			{
				\$�r = 199;
			}break;
			case 31:
			{
				\$�r = 53;
			}break;
			case 32:
			{
				\$�r = 54;
			}break;
			case 33:
			{
				\$�r = 55;
			}break;
			case 34:
			{
				\$�r = 56;
			}break;
			case 35:
			{
				\$�r = 57;
			}break;
			case 36:
			{
				\$�r = 58;
			}break;
			case 37:
			{
				\$�r = 59;
			}break;
			case 38:
			{
				\$�r = 60;
			}break;
			case 39:
			{
				\$�r = 61;
			}break;
			case 40:
			{
				\$�r = 62;
			}break;
			case 41:
			{
				\$�r = 80;
			}break;
			case 42:
			{
				\$�r = 81;
			}break;
			case 43:
			{
				\$�r = 82;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	public function write($op) {
		$�t = ($op);
		switch($�t->index) {
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
		$v = $�t->params[0];
		{
			$this->o->writeByte(4);
			$this->idx($v);
		}break;
		case 4:
		$v2 = $�t->params[0];
		{
			$this->o->writeByte(5);
			$this->idx($v2);
		}break;
		case 5:
		$i = $�t->params[0];
		{
			$this->o->writeByte(6);
			$this->idx($i);
		}break;
		case 6:
		{
			$this->o->writeByte(7);
		}break;
		case 7:
		$r = $�t->params[0];
		{
			$this->o->writeByte(8);
			$this->reg($r);
		}break;
		case 8:
		{
			$this->o->writeByte(9);
		}break;
		case 9:
		$delta = $�t->params[1]; $j = $�t->params[0];
		{
			$this->o->writeByte($this->jumpCode($j));
			$this->o->writeInt24($delta);
		}break;
		case 10:
		$deltas = $�t->params[1]; $def = $�t->params[0];
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
		case 11:
		{
			$this->o->writeByte(28);
		}break;
		case 12:
		{
			$this->o->writeByte(29);
		}break;
		case 13:
		{
			$this->o->writeByte(30);
		}break;
		case 14:
		{
			$this->o->writeByte(31);
		}break;
		case 15:
		{
			$this->o->writeByte(32);
		}break;
		case 16:
		{
			$this->o->writeByte(33);
		}break;
		case 17:
		{
			$this->o->writeByte(35);
		}break;
		case 18:
		$v3 = $�t->params[0];
		{
			$this->o->writeByte(36);
			$this->o->writeInt8($v3);
		}break;
		case 19:
		$v4 = $�t->params[0];
		{
			$this->o->writeByte(37);
			$this->int($v4);
		}break;
		case 20:
		{
			$this->o->writeByte(38);
		}break;
		case 21:
		{
			$this->o->writeByte(39);
		}break;
		case 22:
		{
			$this->o->writeByte(40);
		}break;
		case 23:
		{
			$this->o->writeByte(41);
		}break;
		case 24:
		{
			$this->o->writeByte(42);
		}break;
		case 25:
		{
			$this->o->writeByte(43);
		}break;
		case 26:
		$v5 = $�t->params[0];
		{
			$this->o->writeByte(44);
			$this->idx($v5);
		}break;
		case 27:
		$v6 = $�t->params[0];
		{
			$this->o->writeByte(45);
			$this->idx($v6);
		}break;
		case 28:
		$v7 = $�t->params[0];
		{
			$this->o->writeByte(46);
			$this->idx($v7);
		}break;
		case 29:
		$v8 = $�t->params[0];
		{
			$this->o->writeByte(47);
			$this->idx($v8);
		}break;
		case 30:
		{
			$this->o->writeByte(48);
		}break;
		case 31:
		$v9 = $�t->params[0];
		{
			$this->o->writeByte(49);
			$this->idx($v9);
		}break;
		case 32:
		$r2 = $�t->params[1]; $r1 = $�t->params[0];
		{
			$this->o->writeByte(50);
			$this->int($r1);
			$this->int($r2);
		}break;
		case 33:
		$f = $�t->params[0];
		{
			$this->o->writeByte(64);
			$this->idx($f);
		}break;
		case 34:
		$n = $�t->params[0];
		{
			$this->o->writeByte(65);
			$this->int($n);
		}break;
		case 35:
		$n2 = $�t->params[0];
		{
			$this->o->writeByte(66);
			$this->int($n2);
		}break;
		case 36:
		$n3 = $�t->params[1]; $s = $�t->params[0];
		{
			$this->o->writeByte(67);
			$this->int($s);
			$this->int($n3);
		}break;
		case 37:
		$n4 = $�t->params[1]; $m = $�t->params[0];
		{
			$this->o->writeByte(68);
			$this->idx($m);
			$this->int($n4);
		}break;
		case 38:
		$n5 = $�t->params[1]; $p = $�t->params[0];
		{
			$this->o->writeByte(69);
			$this->idx($p);
			$this->int($n5);
		}break;
		case 39:
		$n6 = $�t->params[1]; $p2 = $�t->params[0];
		{
			$this->o->writeByte(70);
			$this->idx($p2);
			$this->int($n6);
		}break;
		case 40:
		{
			$this->o->writeByte(71);
		}break;
		case 41:
		{
			$this->o->writeByte(72);
		}break;
		case 42:
		$n7 = $�t->params[0];
		{
			$this->o->writeByte(73);
			$this->int($n7);
		}break;
		case 43:
		$n8 = $�t->params[1]; $p3 = $�t->params[0];
		{
			$this->o->writeByte(74);
			$this->idx($p3);
			$this->int($n8);
		}break;
		case 44:
		$n9 = $�t->params[1]; $p4 = $�t->params[0];
		{
			$this->o->writeByte(76);
			$this->idx($p4);
			$this->int($n9);
		}break;
		case 45:
		$n10 = $�t->params[1]; $p5 = $�t->params[0];
		{
			$this->o->writeByte(78);
			$this->idx($p5);
			$this->int($n10);
		}break;
		case 46:
		$n11 = $�t->params[1]; $p6 = $�t->params[0];
		{
			$this->o->writeByte(79);
			$this->idx($p6);
			$this->int($n11);
		}break;
		case 47:
		$n12 = $�t->params[0];
		{
			$this->o->writeByte(83);
			$this->int($n12);
		}break;
		case 48:
		$n13 = $�t->params[0];
		{
			$this->o->writeByte(85);
			$this->int($n13);
		}break;
		case 49:
		$n14 = $�t->params[0];
		{
			$this->o->writeByte(86);
			$this->int($n14);
		}break;
		case 50:
		{
			$this->o->writeByte(87);
		}break;
		case 51:
		$c = $�t->params[0];
		{
			$this->o->writeByte(88);
			$this->idx($c);
		}break;
		case 52:
		$i2 = $�t->params[0];
		{
			$this->o->writeByte(89);
			$this->idx($i2);
		}break;
		case 53:
		$c2 = $�t->params[0];
		{
			$this->o->writeByte(90);
			$this->int($c2);
		}break;
		case 54:
		$p7 = $�t->params[0];
		{
			$this->o->writeByte(93);
			$this->idx($p7);
		}break;
		case 55:
		$p8 = $�t->params[0];
		{
			$this->o->writeByte(94);
			$this->idx($p8);
		}break;
		case 56:
		$d2 = $�t->params[0];
		{
			$this->o->writeByte(95);
			$this->idx($d2);
		}break;
		case 57:
		$p9 = $�t->params[0];
		{
			$this->o->writeByte(96);
			$this->idx($p9);
		}break;
		case 58:
		$p10 = $�t->params[0];
		{
			$this->o->writeByte(97);
			$this->idx($p10);
		}break;
		case 59:
		$r3 = $�t->params[0];
		{
			switch($r3) {
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
				$this->reg($r3);
			}break;
			}
		}break;
		case 60:
		$r4 = $�t->params[0];
		{
			switch($r4) {
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
				$this->reg($r4);
			}break;
			}
		}break;
		case 61:
		{
			$this->o->writeByte(100);
		}break;
		case 62:
		$n15 = $�t->params[0];
		{
			$this->o->writeByte(101);
			$this->o->writeByte($n15);
		}break;
		case 63:
		$p11 = $�t->params[0];
		{
			$this->o->writeByte(102);
			$this->idx($p11);
		}break;
		case 64:
		$p12 = $�t->params[0];
		{
			$this->o->writeByte(104);
			$this->idx($p12);
		}break;
		case 65:
		$p13 = $�t->params[0];
		{
			$this->o->writeByte(106);
			$this->idx($p13);
		}break;
		case 66:
		$s2 = $�t->params[0];
		{
			$this->o->writeByte(108);
			$this->int($s2);
		}break;
		case 67:
		$s3 = $�t->params[0];
		{
			$this->o->writeByte(109);
			$this->int($s3);
		}break;
		case 68:
		{
			$this->o->writeByte(112);
		}break;
		case 69:
		{
			$this->o->writeByte(113);
		}break;
		case 70:
		{
			$this->o->writeByte(114);
		}break;
		case 71:
		{
			$this->o->writeByte(115);
		}break;
		case 72:
		{
			$this->o->writeByte(116);
		}break;
		case 73:
		{
			$this->o->writeByte(117);
		}break;
		case 74:
		{
			$this->o->writeByte(118);
		}break;
		case 75:
		{
			$this->o->writeByte(119);
		}break;
		case 76:
		{
			$this->o->writeByte(120);
		}break;
		case 77:
		$t = $�t->params[0];
		{
			$this->o->writeByte(128);
			$this->idx($t);
		}break;
		case 78:
		{
			$this->o->writeByte(130);
		}break;
		case 79:
		{
			$this->o->writeByte(133);
		}break;
		case 80:
		$t2 = $�t->params[0];
		{
			$this->o->writeByte(134);
			$this->idx($t2);
		}break;
		case 81:
		{
			$this->o->writeByte(137);
		}break;
		case 82:
		$r5 = $�t->params[0];
		{
			$this->o->writeByte(146);
			$this->reg($r5);
		}break;
		case 83:
		$r6 = $�t->params[0];
		{
			$this->o->writeByte(148);
			$this->reg($r6);
		}break;
		case 84:
		{
			$this->o->writeByte(149);
		}break;
		case 85:
		{
			$this->o->writeByte(177);
		}break;
		case 86:
		$t3 = $�t->params[0];
		{
			$this->o->writeByte(178);
			$this->idx($t3);
		}break;
		case 87:
		$r7 = $�t->params[0];
		{
			$this->o->writeByte(194);
			$this->reg($r7);
		}break;
		case 88:
		$r8 = $�t->params[0];
		{
			$this->o->writeByte(195);
			$this->reg($r8);
		}break;
		case 89:
		{
			$this->o->writeByte(208);
		}break;
		case 90:
		{
			$this->o->writeByte(212);
		}break;
		case 91:
		$line = $�t->params[2]; $r9 = $�t->params[1]; $name = $�t->params[0];
		{
			$this->o->writeByte(239);
			$this->o->writeByte(1);
			$this->idx($name);
			$this->reg($r9);
			$this->int($line);
		}break;
		case 92:
		$line2 = $�t->params[0];
		{
			$this->o->writeByte(240);
			$this->int($line2);
		}break;
		case 93:
		$file = $�t->params[0];
		{
			$this->o->writeByte(241);
			$this->idx($file);
		}break;
		case 94:
		$n16 = $�t->params[0];
		{
			$this->o->writeByte(242);
			$this->int($n16);
		}break;
		case 95:
		{
			$this->o->writeByte(243);
		}break;
		case 96:
		$op1 = $�t->params[0];
		{
			$this->o->writeByte($this->operationCode($op1));
		}break;
		case 97:
		$byte = $�t->params[0];
		{
			$this->o->writeByte($byte);
		}break;
		}
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->�dynamics[$m]) && is_callable($this->�dynamics[$m]))
			return call_user_func_array($this->�dynamics[$m], $a);
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	function __toString() { return 'format.abc.OpWriter'; }
}
