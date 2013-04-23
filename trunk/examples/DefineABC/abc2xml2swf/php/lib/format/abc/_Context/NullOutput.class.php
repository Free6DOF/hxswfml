<?php

class format_abc__Context_NullOutput extends haxe_io_Output {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->n = 0;
	}}
	public function writeBytes($b, $pos, $len) {
		$this->n += $len;
		return $len;
	}
	public function writeByte($c) {
		$this->n++;
	}
	public $n;
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
	static $__properties__ = array("set_bigEndian" => "set_bigEndian");
	function __toString() { return 'format.abc._Context.NullOutput'; }
}
