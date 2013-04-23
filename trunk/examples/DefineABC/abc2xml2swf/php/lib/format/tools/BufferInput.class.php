<?php

class format_tools_BufferInput extends haxe_io_Input {
	public function __construct($i, $buf, $pos = null, $available = null) {
		if(!php_Boot::$skip_constructor) {
		if($available === null) {
			$available = 0;
		}
		if($pos === null) {
			$pos = 0;
		}
		$this->i = $i;
		$this->buf = $buf;
		$this->pos = $pos;
		$this->available = $available;
	}}
	public function readBytes($buf, $pos, $len) {
		if($this->available === 0) {
			$this->refill();
		}
		$size = format_tools_BufferInput_0($this, $buf, $len, $pos);
		$buf->blit($pos, $this->buf, $this->pos, $size);
		$this->pos += $size;
		$this->available -= $size;
		return $size;
	}
	public function readByte() {
		if($this->available === 0) {
			$this->refill();
		}
		$c = ord($this->buf->b[$this->pos]);
		$this->pos++;
		$this->available--;
		return $c;
	}
	public function refill() {
		if($this->pos > 0) {
			$this->buf->blit(0, $this->buf, $this->pos, $this->available);
			$this->pos = 0;
		}
		$this->available += $this->i->readBytes($this->buf, $this->available, $this->buf->length - $this->available);
	}
	public $pos;
	public $available;
	public $buf;
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
	static $__properties__ = array("set_bigEndian" => "set_bigEndian");
	function __toString() { return 'format.tools.BufferInput'; }
}
function format_tools_BufferInput_0(&$__hx__this, &$buf, &$len, &$pos) {
	if($len > $__hx__this->available) {
		return $__hx__this->available;
	} else {
		return $len;
	}
}
