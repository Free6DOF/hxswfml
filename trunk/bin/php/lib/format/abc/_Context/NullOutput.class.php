<?php

class format_abc__Context_NullOutput extends haxe_io_Output {
	public function __construct() {
		if( !php_Boot::$skip_constructor ) {
		$this->n = 0;
	}}
	public $n;
	public function writeByte($c) {
		$this->n++;
	}
	public function writeBytes($b, $pos, $len) {
		$this->n += $len;
		return $len;
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	function __toString() { return 'format.abc._Context.NullOutput'; }
}
