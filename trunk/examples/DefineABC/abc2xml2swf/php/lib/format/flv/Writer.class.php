<?php

class format_flv_Writer {
	public function __construct($o) {
		if(!php_Boot::$skip_constructor) {
		$this->ch = $o;
		$o->set_bigEndian(true);
	}}
	public function writeChunk($chunk) {
		$k = null; $data = null; $time = null;
		$__hx__t = ($chunk);
		switch($__hx__t->index) {
		case 0:
		$t = $__hx__t->params[1]; $d = $__hx__t->params[0];
		{
			$k = 8;
			$data = $d;
			$time = $t;
		}break;
		case 1:
		$t = $__hx__t->params[1]; $d = $__hx__t->params[0];
		{
			$k = 9;
			$data = $d;
			$time = $t;
		}break;
		case 2:
		$t = $__hx__t->params[1]; $d = $__hx__t->params[0];
		{
			$k = 18;
			$data = $d;
			$time = $t;
		}break;
		}
		$this->ch->writeByte($k);
		$this->ch->writeUInt24($data->length);
		$this->ch->writeUInt24($time);
		$this->ch->writeInt32(0);
		$this->ch->write($data);
		$this->ch->writeInt32($data->length + 11);
	}
	public function writeHeader($h) {
		$this->ch->writeString("FLV");
		$this->ch->writeByte(1);
		$this->ch->writeByte(((($h->hasAudio) ? 1 : 0)) | ((($h->hasVideo) ? 4 : 0)) | ((($h->hasMeta) ? 8 : 0)));
		$this->ch->writeInt32(9);
		$this->ch->writeInt32(0);
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
	function __toString() { return 'format.flv.Writer'; }
}
