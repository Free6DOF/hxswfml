<?php

class format_tools__InflateImpl_Window {
	public function __construct($hasCrc) {
		if(!php_Boot::$skip_constructor) {
		$this->buffer = haxe_io_Bytes::alloc(65536);
		$this->pos = 0;
		if($hasCrc) {
			$this->crc = new format_tools_Adler32();
		}
	}}
	public function checksum() {
		if($this->crc !== null) {
			$this->crc->update($this->buffer, 0, $this->pos);
		}
		return $this->crc;
	}
	public function available() {
		return $this->pos;
	}
	public function getLastChar() {
		return ord($this->buffer->b[$this->pos - 1]);
	}
	public function addByte($c) {
		if($this->pos === 65536) {
			$this->slide();
		}
		$this->buffer->b[$this->pos] = chr($c);
		$this->pos++;
	}
	public function addBytes($b, $p, $len) {
		if($this->pos + $len > 65536) {
			$this->slide();
		}
		$this->buffer->blit($this->pos, $b, $p, $len);
		$this->pos += $len;
	}
	public function slide() {
		if($this->crc !== null) {
			$this->crc->update($this->buffer, 0, 32768);
		}
		$b = haxe_io_Bytes::alloc(65536);
		$this->pos -= 32768;
		$b->blit(0, $this->buffer, 32768, $this->pos);
		$this->buffer = $b;
	}
	public $crc;
	public $pos;
	public $buffer;
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
	function __toString() { return 'format.tools._InflateImpl.Window'; }
}
