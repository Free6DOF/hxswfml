<?php

class format_amf_Writer {
	public function __construct($o) {
		if(!php_Boot::$skip_constructor) {
		$this->o = $o;
		$o->set_bigEndian(true);
	}}
	public function write($v, $inObj) {
		$o = $this->o;
		$__hx__t = ($v);
		switch($__hx__t->index) {
		case 0:
		$n = $__hx__t->params[0];
		{
			$o->writeByte(0);
			$o->writeDouble($n);
		}break;
		case 1:
		$b = $__hx__t->params[0];
		{
			$o->writeByte(1);
			$o->writeByte((($b) ? 1 : 0));
		}break;
		case 2:
		$s = $__hx__t->params[0];
		{
			if(strlen($s) <= 65535) {
				$o->writeByte(2);
				$o->writeUInt16(strlen($s));
			} else {
				$o->writeByte(12);
				$o->writeInt32(strlen($s));
			}
			$o->writeString($s);
		}break;
		case 3:
		$size = $__hx__t->params[1]; $h = $__hx__t->params[0];
		{
			if($size === null) {
				$o->writeByte(3);
			} else {
				$o->writeByte(8);
				$o->writeInt32($size);
			}
			if(null == $h) throw new HException('null iterable');
			$__hx__it = $h->keys();
			while($__hx__it->hasNext()) {
				$f = $__hx__it->next();
				$o->writeUInt16(strlen($f));
				$o->writeString($f);
				$this->write($h->get($f), true);
			}
			$o->writeByte(0);
			$o->writeByte(0);
			$o->writeByte(9);
		}break;
		case 6:
		{
			$o->writeByte(5);
		}break;
		case 5:
		{
			$o->writeByte(6);
		}break;
		case 4:
		$d = $__hx__t->params[0];
		{
			$o->writeByte(11);
			$o->writeDouble($d->getTime());
			$o->writeUInt16(0);
		}break;
		case 7:
		$a = $__hx__t->params[0];
		{
			$o->writeByte(10);
			$o->writeInt32($a->length);
			{
				$_g = 0;
				while($_g < $a->length) {
					$f = $a[$_g];
					++$_g;
					$this->write($f, true);
					unset($f);
				}
			}
		}break;
		}
		if(!$inObj) {
			$o->writeByte(0);
		}
	}
	public $o;
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
	function __toString() { return 'format.amf.Writer'; }
}
