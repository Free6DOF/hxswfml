<?php

class format_amf_Reader {
	public function __construct($i) {
		if(!php_Boot::$skip_constructor) {
		$this->i = $i;
		$i->set_bigEndian(true);
	}}
	public function read() {
		return $this->readWithCode($this->i->readByte(), false);
	}
	public function readWithCode($id, $inObj) {
		$i = $this->i;
		return format_amf_Reader_0($this, $i, $id, $inObj);
	}
	public function readArray($n) {
		$a = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $n) {
				$i = $_g++;
				$a->push($this->read());
				unset($i);
			}
		}
		return $a;
	}
	public function readObject() {
		$h = new haxe_ds_StringMap();
		while(true) {
			$c1 = $this->i->readByte();
			$c2 = $this->i->readByte();
			$name = $this->i->readString($c1 << 8 | $c2);
			$k = $this->i->readByte();
			if($k === 9) {
				break;
			}
			$h->set($name, $this->readWithCode($k, true));
			unset($name,$k,$c2,$c1);
		}
		return $h;
	}
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
	function __toString() { return 'format.amf.Reader'; }
}
function format_amf_Reader_0(&$__hx__this, &$i, &$id, &$inObj) {
	switch($id) {
	case 0:{
		$out = format_amf_Value::ANumber($i->readDouble());
		if(!$inObj) {
			$i->readByte();
		}
		return $out;
	}break;
	case 1:{
		$out = format_amf_Value::ABool(format_amf_Reader_1($__hx__this, $i, $id, $inObj));
		if(!$inObj) {
			$i->readByte();
		}
		return $out;
	}break;
	case 2:{
		$len = $i->readUInt16();
		$out = format_amf_Value::AString($i->readString($len));
		if(!$inObj) {
			$i->readByte();
		}
		return $out;
	}break;
	case 3:case 8:{
		$ismixed = $id === 8;
		$size = (($ismixed) ? $i->readInt32() : null);
		$out = format_amf_Value::AObject($__hx__this->readObject(), $size);
		if(!$inObj) {
			$i->readByte();
		}
		return $out;
	}break;
	case 5:{
		$out = format_amf_Value::$ANull;
		if(!$inObj) {
			$i->readByte();
		}
		return $out;
	}break;
	case 6:{
		$out = format_amf_Value::$AUndefined;
		if(!$inObj) {
			$i->readByte();
		}
		return $out;
	}break;
	case 7:{
		throw new HException("Not supported : Reference");
	}break;
	case 10:{
		$out = format_amf_Value::AArray($__hx__this->readArray($i->readInt32()));
		if(!$inObj) {
			$i->readByte();
		}
		return $out;
	}break;
	case 11:{
		$time_ms = $i->readDouble();
		$tz_min = $i->readUInt16();
		$out = format_amf_Value::ADate(Date::fromTime($time_ms + $tz_min * 60 * 1000.0));
		if(!$inObj) {
			$i->readByte();
		}
		return $out;
	}break;
	case 12:{
		$out = format_amf_Value::AString($i->readString($i->readInt32()));
		if(!$inObj) {
			$i->readByte();
		}
		return $out;
	}break;
	default:{
		throw new HException("Unknown AMF " . _hx_string_rec($id, ""));
	}break;
	}
}
function format_amf_Reader_1(&$__hx__this, &$i, &$id, &$inObj) {
	switch($i->readByte()) {
	case 0:{
		return false;
	}break;
	case 1:{
		return true;
	}break;
	default:{
		throw new HException("Invalid AMF");
	}break;
	}
}
