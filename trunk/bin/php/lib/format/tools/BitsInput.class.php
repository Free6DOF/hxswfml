<?php

class format_tools_BitsInput {
	public function __construct($i) {
		if( !php_Boot::$skip_constructor ) {
		$this->i = $i;
		$this->nbits = 0;
		$this->bits = 0;
	}}
	public $i;
	public $nbits;
	public $bits;
	public function readBits($n) {
		if($this->nbits >= $n) {
			$c = $this->nbits - $n;
			$k = (_hx_shift_right($this->bits, $c)) & ((1 << $n) - 1);
			$this->nbits = $c;
			return $k;
		}
		$k2 = $this->i->readByte();
		if($this->nbits >= 24) {
			if($n >= 31) {
				throw new HException("Bits error");
			}
			$c2 = 8 + $this->nbits - $n;
			$d = $this->bits & ((1 << $this->nbits) - 1);
			$d = (($d << (8 - $c2)) | ($k2 << $c2));
			$this->bits = $k2;
			$this->nbits = $c2;
			return $d;
		}
		$this->bits = (($this->bits << 8) | $k2);
		$this->nbits += 8;
		return $this->readBits($n);
	}
	public function read() {
		if($this->nbits === 0) {
			$this->bits = $this->i->readByte();
			$this->nbits = 8;
		}
		$this->nbits--;
		return ((_hx_shift_right($this->bits, $this->nbits)) & 1) === 1;
	}
	public function reset() {
		$this->nbits = 0;
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	function __toString() { return 'format.tools.BitsInput'; }
}
