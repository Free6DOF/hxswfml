<?php

class format_tools_InflateImpl {
	public function __construct($i, $header = null, $crc = null) {
		if(!php_Boot::$skip_constructor) {
		if($crc === null) {
			$crc = true;
		}
		if($header === null) {
			$header = true;
		}
		$this->{"final"} = false;
		$this->htools = new format_tools_HuffTools();
		$this->huffman = $this->buildFixedHuffman();
		$this->huffdist = null;
		$this->len = 0;
		$this->dist = 0;
		$this->state = (($header) ? format_tools__InflateImpl_State::$Head : format_tools__InflateImpl_State::$Block);
		$this->input = $i;
		$this->bits = 0;
		$this->nbits = 0;
		$this->needed = 0;
		$this->output = null;
		$this->outpos = 0;
		$this->lengths = new _hx_array(array());
		{
			$_g = 0;
			while($_g < 19) {
				$i1 = $_g++;
				$this->lengths->push(-1);
				unset($i1);
			}
		}
		$this->window = new format_tools__InflateImpl_Window($crc);
	}}
	public function inflateLoop() {
		$__hx__t = ($this->state);
		switch($__hx__t->index) {
		case 0:
		{
			$cmf = $this->input->readByte();
			$cm = $cmf & 15;
			$cinfo = $cmf >> 4;
			if($cm !== 8 || $cinfo !== 7) {
				throw new HException("Invalid data");
			}
			$flg = $this->input->readByte();
			$fdict = ($flg & 32) !== 0;
			if(_hx_mod((($cmf << 8) + $flg), 31) !== 0) {
				throw new HException("Invalid data");
			}
			if($fdict) {
				throw new HException("Unsupported dictionary");
			}
			$this->state = format_tools__InflateImpl_State::$Block;
			return true;
		}break;
		case 4:
		{
			$calc = $this->window->checksum();
			if($calc === null) {
				$this->state = format_tools__InflateImpl_State::$Done;
				return true;
			}
			$crc = format_tools_Adler32::read($this->input);
			if(!$calc->equals($crc)) {
				throw new HException("Invalid CRC");
			}
			$this->state = format_tools__InflateImpl_State::$Done;
			return true;
		}break;
		case 7:
		{
			return false;
		}break;
		case 1:
		{
			$this->{"final"} = $this->getBit();
			switch($this->getBits(2)) {
			case 0:{
				$this->len = $this->input->readUInt16();
				$nlen = $this->input->readUInt16();
				if($nlen !== 65535 - $this->len) {
					throw new HException("Invalid data");
				}
				$this->state = format_tools__InflateImpl_State::$Flat;
				$r = $this->inflateLoop();
				$this->resetBits();
				return $r;
			}break;
			case 1:{
				$this->huffman = $this->buildFixedHuffman();
				$this->huffdist = null;
				$this->state = format_tools__InflateImpl_State::$CData;
				return true;
			}break;
			case 2:{
				$hlit = $this->getBits(5) + 257;
				$hdist = $this->getBits(5) + 1;
				$hclen = $this->getBits(4) + 4;
				{
					$_g = 0;
					while($_g < $hclen) {
						$i = $_g++;
						$this->lengths[format_tools_InflateImpl::$CODE_LENGTHS_POS[$i]] = $this->getBits(3);
						unset($i);
					}
				}
				{
					$_g = $hclen;
					while($_g < 19) {
						$i = $_g++;
						$this->lengths[format_tools_InflateImpl::$CODE_LENGTHS_POS[$i]] = 0;
						unset($i);
					}
				}
				$this->huffman = $this->htools->make($this->lengths, 0, 19, 8);
				$lengths = new _hx_array(array());
				{
					$_g1 = 0; $_g = $hlit + $hdist;
					while($_g1 < $_g) {
						$i = $_g1++;
						$lengths->push(0);
						unset($i);
					}
				}
				$this->inflateLengths($lengths, $hlit + $hdist);
				$this->huffdist = $this->htools->make($lengths, $hlit, $hdist, 16);
				$this->huffman = $this->htools->make($lengths, 0, $hlit, 16);
				$this->state = format_tools__InflateImpl_State::$CData;
				return true;
			}break;
			default:{
				throw new HException("Invalid data");
			}break;
			}
		}break;
		case 3:
		{
			$rlen = format_tools_InflateImpl_0($this);
			$bytes = $this->input->read($rlen);
			$this->len -= $rlen;
			$this->addBytes($bytes, 0, $rlen);
			if($this->len === 0) {
				$this->state = (($this->{"final"}) ? format_tools__InflateImpl_State::$Crc : format_tools__InflateImpl_State::$Block);
			}
			return $this->needed > 0;
		}break;
		case 6:
		{
			$rlen = format_tools_InflateImpl_1($this);
			$this->addDistOne($rlen);
			$this->len -= $rlen;
			if($this->len === 0) {
				$this->state = format_tools__InflateImpl_State::$CData;
			}
			return $this->needed > 0;
		}break;
		case 5:
		{
			while($this->len > 0 && $this->needed > 0) {
				$rdist = format_tools_InflateImpl_2($this);
				$rlen = format_tools_InflateImpl_3($this, $rdist);
				$this->addDist($this->dist, $rlen);
				$this->len -= $rlen;
				unset($rlen,$rdist);
			}
			if($this->len === 0) {
				$this->state = format_tools__InflateImpl_State::$CData;
			}
			return $this->needed > 0;
		}break;
		case 2:
		{
			$n = $this->applyHuffman($this->huffman);
			if($n < 256) {
				$this->addByte($n);
				return $this->needed > 0;
			} else {
				if($n === 256) {
					$this->state = (($this->{"final"}) ? format_tools__InflateImpl_State::$Crc : format_tools__InflateImpl_State::$Block);
					return true;
				} else {
					$n -= 257;
					$extra_bits = format_tools_InflateImpl::$LEN_EXTRA_BITS_TBL[$n];
					if($extra_bits === -1) {
						throw new HException("Invalid data");
					}
					$this->len = format_tools_InflateImpl::$LEN_BASE_VAL_TBL->a[$n] + $this->getBits($extra_bits);
					$dist_code = (($this->huffdist === null) ? $this->getRevBits(5) : $this->applyHuffman($this->huffdist));
					$extra_bits = format_tools_InflateImpl::$DIST_EXTRA_BITS_TBL[$dist_code];
					if($extra_bits === -1) {
						throw new HException("Invalid data");
					}
					$this->dist = format_tools_InflateImpl::$DIST_BASE_VAL_TBL->a[$dist_code] + $this->getBits($extra_bits);
					if($this->dist > $this->window->available()) {
						throw new HException("Invalid data");
					}
					$this->state = (($this->dist === 1) ? format_tools__InflateImpl_State::$DistOne : format_tools__InflateImpl_State::$Dist);
					return true;
				}
			}
		}break;
		}
	}
	public function inflateLengths($a, $max) {
		$i = 0;
		$prev = 0;
		while($i < $max) {
			$n = $this->applyHuffman($this->huffman);
			switch($n) {
			case 0:case 1:case 2:case 3:case 4:case 5:case 6:case 7:case 8:case 9:case 10:case 11:case 12:case 13:case 14:case 15:{
				$prev = $n;
				$a[$i] = $n;
				$i++;
			}break;
			case 16:{
				$end = $i + 3 + $this->getBits(2);
				if($end > $max) {
					throw new HException("Invalid data");
				}
				while($i < $end) {
					$a[$i] = $prev;
					$i++;
				}
			}break;
			case 17:{
				$i += 3 + $this->getBits(3);
				if($i > $max) {
					throw new HException("Invalid data");
				}
			}break;
			case 18:{
				$i += 11 + $this->getBits(7);
				if($i > $max) {
					throw new HException("Invalid data");
				}
			}break;
			default:{
				throw new HException("Invalid data");
			}break;
			}
			unset($n);
		}
	}
	public function applyHuffman($h) {
		return format_tools_InflateImpl_4($this, $h);
	}
	public function addDist($d, $len) {
		$this->addBytes($this->window->buffer, $this->window->pos - $d, $len);
	}
	public function addDistOne($n) {
		$c = $this->window->getLastChar();
		{
			$_g = 0;
			while($_g < $n) {
				$i = $_g++;
				$this->addByte($c);
				unset($i);
			}
		}
	}
	public function addByte($b) {
		$this->window->addByte($b);
		$this->output->b[$this->outpos] = chr($b);
		$this->needed--;
		$this->outpos++;
	}
	public function addBytes($b, $p, $len) {
		$this->window->addBytes($b, $p, $len);
		$this->output->blit($this->outpos, $b, $p, $len);
		$this->needed -= $len;
		$this->outpos += $len;
	}
	public function resetBits() {
		$this->bits = 0;
		$this->nbits = 0;
	}
	public function getRevBits($n) {
		return format_tools_InflateImpl_5($this, $n);
	}
	public function getBit() {
		if($this->nbits === 0) {
			$this->nbits = 8;
			$this->bits = $this->input->readByte();
		}
		$b = ($this->bits & 1) === 1;
		$this->nbits--;
		$this->bits >>= 1;
		return $b;
	}
	public function getBits($n) {
		while($this->nbits < $n) {
			$this->bits |= $this->input->readByte() << $this->nbits;
			$this->nbits += 8;
		}
		$b = $this->bits & (1 << $n) - 1;
		$this->nbits -= $n;
		$this->bits >>= $n;
		return $b;
	}
	public function readBytes($b, $pos, $len) {
		$this->needed = $len;
		$this->outpos = $pos;
		$this->output = $b;
		if($len > 0) {
			while($this->inflateLoop()) {
			}
		}
		return $len - $this->needed;
	}
	public function buildFixedHuffman() {
		if(format_tools_InflateImpl::$FIXED_HUFFMAN !== null) {
			return format_tools_InflateImpl::$FIXED_HUFFMAN;
		}
		$a = new _hx_array(array());
		{
			$_g = 0;
			while($_g < 288) {
				$n = $_g++;
				$a->push((($n <= 143) ? 8 : (($n <= 255) ? 9 : (($n <= 279) ? 7 : 8))));
				unset($n);
			}
		}
		format_tools_InflateImpl::$FIXED_HUFFMAN = $this->htools->make($a, 0, 288, 10);
		return format_tools_InflateImpl::$FIXED_HUFFMAN;
	}
	public $window;
	public $lengths;
	public $input;
	public $outpos;
	public $output;
	public $needed;
	public $dist;
	public $len;
	public $htools;
	public $huffdist;
	public $huffman;
	public $final;
	public $state;
	public $bits;
	public $nbits;
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
	static $LEN_EXTRA_BITS_TBL;
	static $LEN_BASE_VAL_TBL;
	static $DIST_EXTRA_BITS_TBL;
	static $DIST_BASE_VAL_TBL;
	static $CODE_LENGTHS_POS;
	static $FIXED_HUFFMAN = null;
	static function run($i, $bufsize = null) {
		if($bufsize === null) {
			$bufsize = 65536;
		}
		$buf = haxe_io_Bytes::alloc($bufsize);
		$output = new haxe_io_BytesBuffer();
		$inflate = new format_tools_InflateImpl($i, null, null);
		while(true) {
			$len = $inflate->readBytes($buf, 0, $bufsize);
			{
				if($len < 0 || $len > $buf->length) {
					throw new HException(haxe_io_Error::$OutsideBounds);
				}
				$output->b .= _hx_string_or_null(substr($buf->b, 0, $len));
			}
			if($len < $bufsize) {
				break;
			}
			unset($len);
		}
		return $output->getBytes();
	}
	function __toString() { return 'format.tools.InflateImpl'; }
}
format_tools_InflateImpl::$LEN_EXTRA_BITS_TBL = new _hx_array(array(0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 2, 2, 2, 2, 3, 3, 3, 3, 4, 4, 4, 4, 5, 5, 5, 5, 0, -1, -1));
format_tools_InflateImpl::$LEN_BASE_VAL_TBL = new _hx_array(array(3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 15, 17, 19, 23, 27, 31, 35, 43, 51, 59, 67, 83, 99, 115, 131, 163, 195, 227, 258));
format_tools_InflateImpl::$DIST_EXTRA_BITS_TBL = new _hx_array(array(0, 0, 0, 0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9, 10, 10, 11, 11, 12, 12, 13, 13, -1, -1));
format_tools_InflateImpl::$DIST_BASE_VAL_TBL = new _hx_array(array(1, 2, 3, 4, 5, 7, 9, 13, 17, 25, 33, 49, 65, 97, 129, 193, 257, 385, 513, 769, 1025, 1537, 2049, 3073, 4097, 6145, 8193, 12289, 16385, 24577));
format_tools_InflateImpl::$CODE_LENGTHS_POS = new _hx_array(array(16, 17, 18, 0, 8, 7, 9, 6, 10, 5, 11, 4, 12, 3, 13, 2, 14, 1, 15));
function format_tools_InflateImpl_0(&$__hx__this) {
	if($__hx__this->len < $__hx__this->needed) {
		return $__hx__this->len;
	} else {
		return $__hx__this->needed;
	}
}
function format_tools_InflateImpl_1(&$__hx__this) {
	if($__hx__this->len < $__hx__this->needed) {
		return $__hx__this->len;
	} else {
		return $__hx__this->needed;
	}
}
function format_tools_InflateImpl_2(&$__hx__this) {
	if($__hx__this->len < $__hx__this->dist) {
		return $__hx__this->len;
	} else {
		return $__hx__this->dist;
	}
}
function format_tools_InflateImpl_3(&$__hx__this, &$rdist) {
	if($__hx__this->needed < $rdist) {
		return $__hx__this->needed;
	} else {
		return $rdist;
	}
}
function format_tools_InflateImpl_4(&$__hx__this, &$h) {
	$__hx__t = ($h);
	switch($__hx__t->index) {
	case 0:
	$n = $__hx__t->params[0];
	{
		return $n;
	}break;
	case 1:
	$b = $__hx__t->params[1]; $a = $__hx__t->params[0];
	{
		return $__hx__this->applyHuffman((($__hx__this->getBit()) ? $b : $a));
	}break;
	case 2:
	$tbl = $__hx__t->params[1]; $n = $__hx__t->params[0];
	{
		return $__hx__this->applyHuffman($tbl[$__hx__this->getBits($n)]);
	}break;
	}
}
function format_tools_InflateImpl_5(&$__hx__this, &$n) {
	if($n === 0) {
		return 0;
	} else {
		if($__hx__this->getBit()) {
			return 1 << $n - 1 | $__hx__this->getRevBits($n - 1);
		} else {
			return $__hx__this->getRevBits($n - 1);
		}
	}
}
