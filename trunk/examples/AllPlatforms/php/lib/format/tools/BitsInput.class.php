<?php

class format_tools_BitsInput {
	public function __construct($i) {
		if(!php_Boot::$skip_constructor) {
		$this->i = $i;
		$this->nbits = 0;
		$this->bits = 0;
	}}
	public function reset() {
		$this->nbits = 0;
	}
	public function readBit() {
		if($this->nbits === 0) {
			$this->bits = $this->i->readByte();
			$this->nbits = 8;
		}
		$this->nbits--;
		return (_hx_shift_right($this->bits, $this->nbits) & 1) === 1;
	}
	public function readBits($n) {
		if($this->nbits >= $n) {
			$c = $this->nbits - $n;
			$k = _hx_shift_right($this->bits, $c) & (1 << $n) - 1;
			$this->nbits = $c;
			return $k;
		}
		$k = $this->i->readByte();
		if($this->nbits >= 24) {
			if($n >= 31) {
				throw new HException("Bits error");
			}
			$c = 8 + $this->nbits - $n;
			$d = $this->bits & (1 << $this->nbits) - 1;
			$d = $d << 8 - $c | $k << $c;
			$this->bits = $k;
			$this->nbits = $c;
			return $d;
		}
		$this->bits = $this->bits << 8 | $k;
		$this->nbits += 8;
		return $this->readBits($n);
	}
	public $bits;
	public $nbits;
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
	function __toString() { return 'format.tools.BitsInput'; }
}
