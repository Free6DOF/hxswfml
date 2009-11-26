<?php

class format_tools__InflateImpl_Window {
	public function __construct() {
		if( !php_Boot::$skip_constructor ) {
		$this->buffer = haxe_io_Bytes::alloc(65536);
		$this->pos = 0;
		$this->crc = new format_tools_Adler32();
	}}
	public $buffer;
	public $pos;
	public $crc;
	public function slide() {
		$this->crc->update($this->buffer, 0, 32768);
		$b = haxe_io_Bytes::alloc(65536);
		$this->pos -= 32768;
		$b->blit(0, $this->buffer, 32768, $this->pos);
		$this->buffer = $b;
	}
	public function addBytes($b, $p, $len) {
		if($this->pos + $len > 65536) {
			$this->slide();
		}
		$this->buffer->blit($this->pos, $b, $p, $len);
		$this->pos += $len;
	}
	public function addByte($c) {
		if($this->pos === 65536) {
			$this->slide();
		}
		$this->buffer->b[$this->pos] = chr($c);
		$this->pos++;
	}
	public function getLastChar() {
		return ord($this->buffer->b[$this->pos - 1]);
	}
	public function available() {
		return $this->pos;
	}
	public function checksum() {
		$this->crc->update($this->buffer, 0, $this->pos);
		return $this->crc;
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	static $SIZE = 32768;
	static $BUFSIZE = 65536;
	function __toString() { return 'format.tools._InflateImpl.Window'; }
}
