<?php

class format_tools_Adler32 {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->a1 = 1;
		$this->a2 = 0;
	}}
	public function equals($a) {
		return $a->a1 === $this->a1 && $a->a2 === $this->a2;
	}
	public function update($b, $pos, $len) {
		$a1 = $this->a1; $a2 = $this->a2;
		{
			$_g1 = $pos; $_g = $pos + $len;
			while($_g1 < $_g) {
				$p = $_g1++;
				$c = ord($b->b[$p]);
				$a1 = _hx_mod(($a1 + $c), 65521);
				$a2 = _hx_mod(($a2 + $a1), 65521);
				unset($p,$c);
			}
		}
		$this->a1 = $a1;
		$this->a2 = $a2;
	}
	public $a2;
	public $a1;
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
	static function read($i) {
		$a = new format_tools_Adler32();
		$a2a = $i->readByte();
		$a2b = $i->readByte();
		$a1a = $i->readByte();
		$a1b = $i->readByte();
		$a->a1 = $a1a << 8 | $a1b;
		$a->a2 = $a2a << 8 | $a2b;
		return $a;
	}
	function __toString() { return 'format.tools.Adler32'; }
}
