<?php

class format_tools_HuffTools {
	public function __construct() { ;
		;
	}
	public function treeDepth($t) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$t);
			switch(\$퍁->index) {
			case 0:
			{
				\$팿 = 0;
			}break;
			case 2:
			{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\"assert\\\");
					return \\\$팿2;
				\");
			}break;
			case 1:
			\$b = \$퍁->params[1]; \$a = \$퍁->params[0];
			{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$da = \\\$퍁his->treeDepth(\\\$a);
					\\\$db = \\\$퍁his->treeDepth(\\\$b);
					\\\$팿3 = 1 + (((\\\$da < \\\$db) ? \\\$da : \\\$db));
					return \\\$팿3;
				\");
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
	}
	public function treeCompress($t) {
		$d = $this->treeDepth($t);
		if($d === 0) {
			return $t;
		}
		if($d === 1) {
			return eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$t);
				switch(\$퍁->index) {
				case 1:
				\$b = \$퍁->params[1]; \$a = \$퍁->params[0];
				{
					\$팿 = format_tools_Huffman::NeedBit(\$퍁his->treeCompress(\$a), \$퍁his->treeCompress(\$b));
				}break;
				default:{
					\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\"assert\\\");
						return \\\$팿2;
					\");
				}break;
				}
				return \$팿;
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
		$퍁 = ($t);
		switch($퍁->index) {
		case 1:
		$b = $퍁->params[1]; $a = $퍁->params[0];
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
				$counts->팤[$p]++;
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
