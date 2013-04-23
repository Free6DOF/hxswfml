<?php

class format_tools_HuffTools {
	public function __construct() { 
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
			$_g = 0;
			while($_g < $nlengths) {
				$i = $_g++;
				$p = $lengths[$i + $pos];
				if($p >= $maxbits) {
					throw new HException("Invalid huffman");
				}
				$counts->a[$p]++;
				unset($p,$i);
			}
		}
		$code = 0;
		{
			$_g1 = 1; $_g = $maxbits - 1;
			while($_g1 < $_g) {
				$i = $_g1++;
				$code = $code + $counts[$i] << 1;
				$tmp[$i] = $code;
				unset($i);
			}
		}
		$bits = new haxe_ds_IntMap();
		{
			$_g = 0;
			while($_g < $nlengths) {
				$i = $_g++;
				$l = $lengths[$i + $pos];
				if($l !== 0) {
					$n = $tmp[$l - 1];
					$tmp[$l - 1] = $n + 1;
					$bits->set($n << 5 | $l, $i);
					unset($n);
				}
				unset($l,$i);
			}
		}
		return $this->treeCompress(format_tools_Huffman::NeedBit($this->treeMake($bits, $maxbits, 0, 1), $this->treeMake($bits, $maxbits, 1, 1)));
	}
	public function treeMake($bits, $maxbits, $v, $len) {
		if($len > $maxbits) {
			throw new HException("Invalid huffman");
		}
		$idx = $v << 5 | $len;
		if($bits->exists($idx)) {
			return format_tools_Huffman::Found($bits->get($idx));
		}
		$v <<= 1;
		$len += 1;
		return format_tools_Huffman::NeedBit($this->treeMake($bits, $maxbits, $v, $len), $this->treeMake($bits, $maxbits, $v | 1, $len));
	}
	public function treeWalk($table, $p, $cd, $d, $t) {
		$__hx__t = ($t);
		switch($__hx__t->index) {
		case 1:
		$b = $__hx__t->params[1]; $a = $__hx__t->params[0];
		{
			if($d > 0) {
				$this->treeWalk($table, $p, $cd + 1, $d - 1, $a);
				$this->treeWalk($table, $p | 1 << $cd, $cd + 1, $d - 1, $b);
			} else {
				$table[$p] = $this->treeCompress($t);
			}
		}break;
		default:{
			$table[$p] = $this->treeCompress($t);
		}break;
		}
	}
	public function treeCompress($t) {
		$d = $this->treeDepth($t);
		if($d === 0) {
			return $t;
		}
		if($d === 1) {
			return format_tools_HuffTools_0($this, $d, $t);
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
	public function treeDepth($t) {
		return format_tools_HuffTools_1($this, $t);
	}
	function __toString() { return 'format.tools.HuffTools'; }
}
function format_tools_HuffTools_0(&$__hx__this, &$d, &$t) {
	$__hx__t = ($t);
	switch($__hx__t->index) {
	case 1:
	$b = $__hx__t->params[1]; $a = $__hx__t->params[0];
	{
		return format_tools_Huffman::NeedBit($__hx__this->treeCompress($a), $__hx__this->treeCompress($b));
	}break;
	default:{
		throw new HException("assert");
	}break;
	}
}
function format_tools_HuffTools_1(&$__hx__this, &$t) {
	$__hx__t = ($t);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 2:
	{
		throw new HException("assert");
	}break;
	case 1:
	$b = $__hx__t->params[1]; $a = $__hx__t->params[0];
	{
		$da = $__hx__this->treeDepth($a);
		$db = $__hx__this->treeDepth($b);
		return 1 + ((($da < $db) ? $da : $db));
	}break;
	}
}
