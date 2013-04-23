<?php

class format_flv_Reader {
	public function __construct($i) {
		if(!php_Boot::$skip_constructor) {
		$this->ch = $i;
		$i->set_bigEndian(true);
	}}
	public function readChunk() {
		$k = null;
		try {
			$k = $this->ch->readByte();
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			if(($e = $_ex_) instanceof haxe_io_Eof){
				return null;
			} else throw $__hx__e;;
		}
		$size = $this->ch->readUInt24();
		$time = $this->ch->readUInt24();
		$reserved = $this->ch->readInt32();
		if($reserved !== 0) {
			throw new HException("Invalid reserved " . _hx_string_rec($reserved, ""));
		}
		$data = $this->ch->read($size);
		$size2 = $this->ch->readInt32();
		if($size2 !== 0 && $size2 !== $size + 11) {
			throw new HException("Invalid size2 (" . _hx_string_rec($size, "") . " != " . _hx_string_rec($size2, "") . ")");
		}
		return format_flv_Reader_0($this, $data, $e, $k, $reserved, $size, $size2, $time);
	}
	public function readHeader() {
		if($this->ch->readString(3) !== "FLV") {
			throw new HException("Invalid signature");
		}
		if($this->ch->readByte() !== 1) {
			throw new HException("Invalid version");
		}
		$flags = $this->ch->readByte();
		if(($flags & 242) !== 0) {
			throw new HException("Invalid type flags " . _hx_string_rec($flags, ""));
		}
		$offset = $this->ch->readInt32();
		if($offset !== 9) {
			throw new HException("Invalid offset " . _hx_string_rec($offset, ""));
		}
		$prev = $this->ch->readInt32();
		if($prev !== 0) {
			throw new HException("Invalid prev " . _hx_string_rec($prev, ""));
		}
		return _hx_anonymous(array("hasAudio" => ($flags & 1) !== 0, "hasVideo" => ($flags & 4) !== 0, "hasMeta" => ($flags & 8) !== 0));
	}
	public function readInt() {
		return $this->ch->readInt32();
	}
	public function close() {
		$this->ch->close();
	}
	public $ch;
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
	function __toString() { return 'format.flv.Reader'; }
}
function format_flv_Reader_0(&$__hx__this, &$data, &$e, &$k, &$reserved, &$size, &$size2, &$time) {
	switch($k) {
	case 8:{
		return format_flv_Data::FLVAudio($data, $time);
	}break;
	case 9:{
		return format_flv_Data::FLVVideo($data, $time);
	}break;
	case 18:{
		return format_flv_Data::FLVMeta($data, $time);
	}break;
	default:{
		throw new HException("Invalid FLV tag " . _hx_string_rec($k, ""));
	}break;
	}
}
