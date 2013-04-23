<?php

class haxe_io_BytesBuffer {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->b = "";
	}}
	public function getBytes() {
		$bytes = new haxe_io_Bytes(strlen($this->b), $this->b);
		$this->b = null;
		return $bytes;
	}
	public function addBytes($src, $pos, $len) {
		if($pos < 0 || $len < 0 || $pos + $len > $src->length) {
			throw new HException(haxe_io_Error::$OutsideBounds);
		}
		$this->b .= _hx_string_or_null(substr($src->b, $pos, $len));
	}
	public function add($src) {
		$this->b .= _hx_string_or_null($src->b);
	}
	public function addByte($byte) {
		$this->b .= _hx_string_or_null(chr($byte));
	}
	public $b;
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
	function __toString() { return 'haxe.io.BytesBuffer'; }
}
