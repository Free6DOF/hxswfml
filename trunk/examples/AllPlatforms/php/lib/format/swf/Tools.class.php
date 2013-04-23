<?php

class format_swf_Tools {
	public function __construct(){}
	static function signExtend($v, $nbits) {
		$max = 1 << $nbits;
		if(($v & $max >> 1) !== 0) {
			return $v - $max;
		}
		return $v;
	}
	static function floatFixedBits($i, $nbits) {
		$i = format_swf_Tools::signExtend($i, $nbits);
		return ($i >> 16) + ($i & 65535) / 65536.0;
	}
	static function floatFixed($i) {
		return ($i >> 16) + ($i & 65535) / 65536.0;
	}
	static function floatFixed8($i) {
		return ($i >> 8) + ($i & 255) / 256.0;
	}
	static function toFixed8($f) {
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 128) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 256 - $i;
		}
		return $i << 8 | Std::int(($f - $i) * 256.0);
	}
	static function toFixed16($f) {
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
	static function minBits($values) {
		$max = 0;
		{
			$_g = 0;
			while($_g < $values->length) {
				$i = $values[$_g];
				++$_g;
				if($i === 0) {
					continue;
				}
				if($i < 0) {
					$i = -$i;
				}
				$m = 1;
				while(($i = $i >> 1) !== 0) {
					++$m;
				}
				if($m > $max) {
					$max = $m;
				}
				unset($m,$i);
			}
		}
		return $max;
	}
	static function minBitsOld($values) {
		$max_bits = 0;
		{
			$_g = 0;
			while($_g < $values->length) {
				$x = $values[$_g];
				++$_g;
				if($x < 0) {
					$x = -$x;
				}
				$x |= $x >> 1;
				$x |= $x >> 2;
				$x |= $x >> 4;
				$x |= $x >> 8;
				$x |= $x >> 16;
				$x -= $x >> 1 & 1431655765;
				$x = ($x >> 2 & 858993459) + ($x & 858993459);
				$x = ($x >> 4) + $x & 252645135;
				$x += $x >> 8;
				$x += $x >> 16;
				$x &= 63;
				if($x > $max_bits) {
					$max_bits = $x;
				}
				unset($x);
			}
		}
		return $max_bits;
	}
	static function hex($b, $max = null) {
		$hex = new _hx_array(array(48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70));
		$count = format_swf_Tools_0($b, $hex, $max);
		$buf = new StringBuf();
		{
			$_g = 0;
			while($_g < $count) {
				$i = $_g++;
				$v = ord($b->b[$i]);
				$buf->b .= _hx_string_or_null(chr($hex[$v >> 4]));
				$buf->b .= _hx_string_or_null(chr($hex[$v & 15]));
				unset($v,$i);
			}
		}
		if($count < $b->length) {
			$buf->add("...");
		}
		return $buf->b;
	}
	static function bin($b, $maxBytes = null) {
		$buf = new StringBuf();
		$cnt = format_swf_Tools_1($b, $buf, $maxBytes);
		{
			$_g = 0;
			while($_g < $cnt) {
				$i = $_g++;
				$v = ord($b->b[$i]);
				{
					$_g1 = 0;
					while($_g1 < 8) {
						$j = $_g1++;
						$buf->add(((($v >> 7 - $j & 1) === 1) ? "1" : "0"));
						if($j === 3) {
							$buf->add(" ");
						}
						unset($j);
					}
					unset($_g1);
				}
				$buf->add("  ");
				unset($v,$i);
			}
		}
		return $buf->b;
	}
	static function dumpTag($t, $max = null) {
		$infos = format_swf_Tools_2($max, $t);
		$b = new StringBuf();
		$b->add(Type::enumConstructor($t));
		$b->add("(");
		while($infos->length > 0) {
			$b->add($infos->shift());
			if($infos->length === 0) {
				break;
			}
			$b->add(":");
			$b->add($infos->shift());
			if($infos->length === 0) {
				break;
			}
			$b->add(",");
		}
		$b->add(")");
		return $b->b;
	}
	function __toString() { return 'format.swf.Tools'; }
}
function format_swf_Tools_0(&$b, &$hex, &$max) {
	if($max === null || $b->length <= $max) {
		return $b->length;
	} else {
		return $max;
	}
}
function format_swf_Tools_1(&$b, &$buf, &$maxBytes) {
	if($maxBytes === null) {
		return $b->length;
	} else {
		if($maxBytes > $b->length) {
			return $b->length;
		} else {
			return $maxBytes;
		}
	}
}
function format_swf_Tools_2(&$max, &$t) {
	$__hx__t = ($t);
	switch($__hx__t->index) {
	case 0:
	{
		return new _hx_array(array());
	}break;
	case 1:
	{
		return new _hx_array(array());
	}break;
	case 6:
	$color = $__hx__t->params[0];
	{
		return new _hx_array(array(StringTools::hex($color, 6)));
	}break;
	case 2:
	$sdata = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id));
	}break;
	case 3:
	$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id));
	}break;
	case 4:
	$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id));
	}break;
	case 5:
	$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id));
	}break;
	case 22:
	$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id, "data", format_swf_Tools::hex($data, $max)));
	}break;
	case 7:
	$tags = $__hx__t->params[2]; $frames = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id, "frames", $frames));
	}break;
	case 8:
	$po = $__hx__t->params[0];
	{
		return new _hx_array(array(Std::string($po)));
	}break;
	case 9:
	$po = $__hx__t->params[0];
	{
		return new _hx_array(array(Std::string($po)));
	}break;
	case 10:
	$d = $__hx__t->params[0];
	{
		return new _hx_array(array("depth", $d));
	}break;
	case 11:
	$anchor = $__hx__t->params[1]; $label = $__hx__t->params[0];
	{
		return new _hx_array(array("label", $label, "anchor", $anchor));
	}break;
	case 12:
	$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id, "data", format_swf_Tools::hex($data, $max)));
	}break;
	case 13:
	$context = $__hx__t->params[1]; $data = $__hx__t->params[0];
	{
		return new _hx_array(array("context", $context, "data", format_swf_Tools::hex($data, $max)));
	}break;
	case 14:
	$symbols = $__hx__t->params[0];
	{
		return new _hx_array(array(Std::string($symbols)));
	}break;
	case 16:
	$symbols = $__hx__t->params[0];
	{
		return new _hx_array(array(Std::string($symbols)));
	}break;
	case 15:
	$url = $__hx__t->params[0];
	{
		return new _hx_array(array(Std::string($url)));
	}break;
	case 17:
	$v = $__hx__t->params[0];
	{
		return new _hx_array(array($v));
	}break;
	case 18:
	case 19:
	$l = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $l->cid, "color", $l->color, "width", $l->width, "height", $l->height, "data", format_swf_Tools::hex($l->data, $max)));
	}break;
	case 21:
	$data = $__hx__t->params[0];
	{
		return new _hx_array(array("data", format_swf_Tools::hex($data, $max)));
	}break;
	case 20:
	$jdata = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		$d = $jdata;
		$__hx__t2 = ($d);
		switch($__hx__t2->index) {
		case 0:
		$data = $__hx__t2->params[0];
		{
			return new _hx_array(array("id", $id, "ver", 1, "data", format_swf_Tools::hex($data, $max)));
		}break;
		case 1:
		$data = $__hx__t2->params[0];
		{
			return new _hx_array(array("id", $id, "ver", 2, "data", format_swf_Tools::hex($data, $max)));
		}break;
		case 2:
		$mask = $__hx__t2->params[1]; $data = $__hx__t2->params[0];
		{
			return new _hx_array(array("id", $id, "ver", 3, "data", format_swf_Tools::hex($data, $max), "mask", format_swf_Tools::hex($mask, $max)));
		}break;
		}
		unset($d);
	}break;
	case 23:
	$data = $__hx__t->params[0];
	{
		return new _hx_array(array("sid", $data->sid, "format", $data->format, "rate", $data->rate));
	}break;
	case 28:
	$soundInfo = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id, "syncStop", $soundInfo->syncStop, "hasLoops", $soundInfo->hasLoops, "loopCount", $soundInfo->loopCount));
	}break;
	case 29:
	$data = $__hx__t->params[0];
	{
		return new _hx_array(array(format_swf_Tools::hex($data, $max)));
	}break;
	case 30:
	$timeoutSeconds = $__hx__t->params[1]; $maxRecursion = $__hx__t->params[0];
	{
		return new _hx_array(array("maxRecursion", $maxRecursion, "timeoutSeconds", $timeoutSeconds));
	}break;
	case 31:
	$records = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id, "records", $records));
	}break;
	case 32:
	$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id));
	}break;
	case 33:
	$data = $__hx__t->params[0];
	{
		return new _hx_array(array("metadata", $data));
	}break;
	case 34:
	$splitter = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id, "splitter", "todo"));
	}break;
	case 24:
	$data = $__hx__t->params[2]; $seekSamples = $__hx__t->params[1]; $samplesCount = $__hx__t->params[0];
	{
		return new _hx_array(array("samplesCount", $samplesCount, "seekSamples", $seekSamples));
	}break;
	case 25:
	$soundStreamHeadData = $__hx__t->params[0];
	{
		return new _hx_array(array("soundStreamHeadData", $soundStreamHeadData));
	}break;
	case 26:
	$videoInfo = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id, "videoInfo", $videoInfo));
	}break;
	case 27:
	$data = $__hx__t->params[2]; $frameNum = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id, "frameNum", $frameNum, "data", format_swf_Tools::hex($data, $max)));
	}break;
	case 35:
	$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
	{
		return new _hx_array(array("id", $id, "data", format_swf_Tools::hex($data, $max)));
	}break;
	}
}
