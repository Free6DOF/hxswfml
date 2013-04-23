<?php

class format_png_Writer {
	public function __construct($o) {
		if(!php_Boot::$skip_constructor) {
		$this->o = $o;
		$o->set_bigEndian(true);
	}}
	public function writeChunk($id, $data) {
		$this->o->writeInt32($data->length);
		$this->o->writeString($id);
		$this->o->write($data);
		$b = haxe_io_Bytes::alloc(4);
		{
			$_g = 0;
			while($_g < 4) {
				$i = $_g++;
				$b->b[$i] = chr(_hx_char_code_at($id, $i));
				unset($i);
			}
		}
		$this->o->writeInt32(haxe_crypto_Crc32::make($b));
	}
	public function write($png) {
		{
			$_g = 0; $_g1 = new _hx_array(array(137, 80, 78, 71, 13, 10, 26, 10));
			while($_g < $_g1->length) {
				$b = $_g1[$_g];
				++$_g;
				$this->o->writeByte($b);
				unset($b);
			}
		}
		if(null == $png) throw new HException('null iterable');
		$__hx__it = $png->iterator();
		while($__hx__it->hasNext()) {
			$c = $__hx__it->next();
			$__hx__t = ($c);
			switch($__hx__t->index) {
			case 1:
			$h = $__hx__t->params[0];
			{
				$b = new haxe_io_BytesOutput();
				$b->set_bigEndian(true);
				$b->writeInt32($h->width);
				$b->writeInt32($h->height);
				$b->writeByte($h->colbits);
				$b->writeByte(format_png_Writer_0($this, $b, $c, $h, $png));
				$b->writeByte(0);
				$b->writeByte(0);
				$b->writeByte((($h->interlaced) ? 1 : 0));
				$this->writeChunk("IHDR", $b->getBytes());
			}break;
			case 0:
			{
				$this->writeChunk("IEND", haxe_io_Bytes::alloc(0));
			}break;
			case 2:
			$d = $__hx__t->params[0];
			{
				$this->writeChunk("IDAT", $d);
			}break;
			case 3:
			$b = $__hx__t->params[0];
			{
				$this->writeChunk("PLTE", $b);
			}break;
			case 4:
			$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
			{
				$this->writeChunk($id, $data);
			}break;
			}
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
	function __toString() { return 'format.png.Writer'; }
}
function format_png_Writer_0(&$__hx__this, &$b, &$c, &$h, &$png) {
	$__hx__t2 = ($h->color);
	switch($__hx__t2->index) {
	case 0:
	$alpha = $__hx__t2->params[0];
	{
		if($alpha) {
			return 4;
		} else {
			return 0;
		}
	}break;
	case 1:
	$alpha = $__hx__t2->params[0];
	{
		if($alpha) {
			return 6;
		} else {
			return 2;
		}
	}break;
	case 2:
	{
		return 3;
	}break;
	}
}
