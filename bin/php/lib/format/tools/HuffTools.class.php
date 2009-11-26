<?php

class format_tools_HuffTools {
	public function __construct() { ;
		;
	}
	public function treeDepth($t) {
		return eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$t);
			switch(\$�t->index) {
			case 0:
			{
				\$�r = 0;
			}break;
			case 2:
			{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\"assert\\\");
					return \\\$�r2;
				\");
			}break;
			case 1:
			\$b = \$�t->params[1]; \$a = \$�t->params[0];
			{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$da = \\\$�this->treeDepth(\\\$a);
					\\\$db = \\\$�this->treeDepth(\\\$b);
					\\\$�r3 = 1 + (((\\\$da < \\\$db) ? \\\$da : \\\$db));
					return \\\$�r3;
				\");
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	public function treeCompress($t) {
		$d = $this->treeDepth($t);
		if($d === 0) {
			return $t;
		}
		if($d === 1) {
			return eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$t);
				switch(\$�t->index) {
				case 1:
				\$b = \$�t->params[1]; \$a = \$�t->params[0];
				{
					\$�r = format_tools_Huffman::NeedBit(\$�this->treeCompress(\$a), \$�this->treeCompress(\$b));
				}break;
				default:{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\"assert\\\");
						return \\\$�r2;
					\");
				}break;
				}
				return \$�r;
			");
		}
		$size = 1 << $d;
		$table = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $size) {
				$i = $_g++;
				$table->push(format_tools_Huffman::Found(-1));
				unset($i);
			}
		}
		$this->treeWalk($table, 0, 0, $d, $t);
		return format_tools_Huffman::NeedBits($d, $table);
	}
	public function treeWalk($table, $p, $cd, $d, $t) {
		$�t = ($t);
		switch($�t->index) {
		case 1:
		$b = $�t->params[1]; $a = $�t->params[0];
		{
			if($d > 0) {
				$this->treeWalk($table, $p, $cd + 1, $d - 1, $a);
				$this->treeWalk($table, $p | (1 << $cd), $cd + 1, $d - 1, $b);
			}
			else {
				$table[$p] = $this->treeCompress($t);
			}
		}break;
		default:{
			$table[$p] = $this->treeCompress($t);
		}break;
		}
	}
	public function treeMake($bits, $maxbits, $v, $len) {
		if($len > $maxbits) {
			throw new HException("Invalid huffman");
		}
		$idx = ($v << 5) | $len;
		if($bits->exists($idx)) {
			return format_tools_Huffman::Found($bits->get($idx));
		}
		$v <<= 1;
		$len += 1;
		return format_tools_Huffman::NeedBit($this->treeMake($bits, $maxbits, $v, $len), $this->treeMake($bits, $maxbits, $v | 1, $len));
	}
	public function make($lengths, $pos, $nlengths, $maxbits) {
		$counts = new _hx_array(array());
		$tmp = new _hx_array(array());
		if($maxbits > 32) {
			throw new HException("Invalid huffman");
		}
		{
			$_g = 0;
			while($_g < $maxbits) {
				$i = $_g++;
				$counts->push(0);
				$tmp->push(0);
				unset($i);
			}
		}
		{
			$_g2 = 0;
			while($_g2 < $nlengths) {
				$i2 = $_g2++;
				$p = $lengths[$i2 + $pos];
				if($p >= $maxbits) {
					throw new HException("Invalid huffman");
				}
				$counts->�a[$p]++;
				unset($p,$i2);
			}
		}
		$code = 0;
		{
			$_g1 = 1; $_g3 = $maxbits - 1;
			while($_g1 < $_g3) {
				$i3 = $_g1++;
				$code = ($code + $counts[$i3]) << 1;
				$tmp[$i3] = $code;
				unset($i3);
			}
		}
		$bits = new IntHash();
		{
			$_g4 = 0;
			while($_g4 < $nlengths) {
				$i4 = $_g4++;
				$l = $lengths[$i4 + $pos];
				if($l !== 0) {
					$n = $tmp[$l - 1];
					$tmp[$l - 1] = $n + 1;
					$bits->set(($n << 5) | $l, $i4);
				}
				unset($n,$l,$i4);
			}
		}
		return $this->treeCompress(format_tools_Huffman::NeedBit($this->treeMake($bits, $maxbits, 0, 1), $this->treeMake($bits, $maxbits, 1, 1)));
	}
	function __toString() { return 'format.tools.HuffTools'; }
}
