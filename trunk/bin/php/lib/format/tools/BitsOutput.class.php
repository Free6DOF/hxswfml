<?php

class format_tools_BitsOutput {
	public function __construct($o) {
		if( !php_Boot::$skip_constructor ) {
		$this->o = $o;
		$this->nbits = 0;
		$this->bits = 0;
	}}
	public $o;
	public $nbits;
	public $bits;
	public function writeBits($n, $v) {
		$v = ($v & ((1 << $n) - 1));
		if($n + $this->nbits >= 32) {
			if($n >= 31) {
				throw new HException("Bits error");
			}
			$n2 = 32 - $this->nbits - 1;
			$n3 = $n - $n2;
			$this->writeBits($n2, $v >> $n3);
			$this->writeBits($n3, $v & ((1 << $n3) - 1));
			return;
		}
		if($n < 0) {
			throw new HException("Bits error");
		}
		$this->bits = (($this->bits << $n) | $v);
		$this->nbits += $n;
		while($this->nbits >= 8) {
			$this->nbits -= 8;
			$this->o->writeByte(($this->bits >> $this->nbits) & 255);
			;
		}
	}
	public function writeBit($flag) {
		$this->bits <<= 1;
		if($flag) {
			$this->bits |= 1;
		}
		$this->nbits++;
		if($this->nbits === 8) {
			$this->nbits = 0;
			$this->o->writeByte($this->bits & 255);
		}
	}
	public function flush() {
		if($this->nbits > 0) {
			$this->writeBits(8 - $this->nbits, 0);
			$this->nbits = 0;
		}
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	function __toString() { return 'format.tools.BitsOutput'; }
}
