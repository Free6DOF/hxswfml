<?php

class format_swf_Tools {
	public function __construct(){}
	static function signExtend($v, $nbits) {
		$max = 1 << $nbits;
		if(($v & ($max >> 1)) !== 0) {
			return $v - $max;
		}
		return $v;
	}
	static function floatFixedBits($i, $nbits) {
		$i = format_swf_Tools::signExtend($i, $nbits);
		return ($i >> 16) + ($i & 65535) / 65536.0;
	}
	static function floatFixed($i) {
		return eval("if(isset(\$this)) \$�this =& \$this;\$x = (\$i) >> 16;
			if((((\$x) >> 30) & 1) !== (_hx_shift_right((\$x), 31))) {
				throw new HException(\"Overflow \" . \$x);
			}
			\$�r = ((\$x) & -1);
			return \$�r;
		") + eval("if(isset(\$this)) \$�this =& \$this;\$x2 = (\$i) & 65535;
			if((((\$x2) >> 30) & 1) !== (_hx_shift_right((\$x2), 31))) {
				throw new HException(\"Overflow \" . \$x2);
			}
			\$�r2 = ((\$x2) & -1);
			return \$�r2;
		") / 65536.0;
	}
	static function floatFixed8($i) {
		return ($i >> 8) + ($i & 255) / 256.0;
	}
	static function toFixed8($f) {
		$i = intval($f);
		if(((($i > 0) ? $i : -$i)) >= 128) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 256 - $i;
		}
		return ($i << 8) | intval(($f - $i) * 256.0);
	}
	static function toFixed16($f) {
		$i = intval($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return ($i << 16) | intval(($f - $i) * 65536.0);
	}
	static function minBits($values) {
		$max_bits = 0;
		{
			$_g = 0;
			while($_g < $values->length) {
				$x = $values[$_g];
				++$_g;
				if($x < 0) {
					$x = -$x;
				}
				$x |= ($x >> 1);
				$x |= ($x >> 2);
				$x |= ($x >> 4);
				$x |= ($x >> 8);
				$x |= ($x >> 16);
				$x -= (($x >> 1) & 1431655765);
				$x = ((($x >> 2) & 858993459) + ($x & 858993459));
				$x = ((($x >> 4) + $x) & 252645135);
				$x += ($x >> 8);
				$x += ($x >> 16);
				$x &= 63;
				if($x > $max_bits) {
					$max_bits = $x;
				}
				unset($x);
			}
		}
		return $max_bits;
	}
	static function hex($b, $max) {
		$hex = new _hx_array(array(48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70));
		$count = ($max === null || $b->length <= $max ? $b->length : $max);
		$buf = new StringBuf();
		{
			$_g = 0;
			while($_g < $count) {
				$i = $_g++;
				$v = ord($b->b[$i]);
				$buf->b .= chr($hex[$v >> 4]);
				$buf->b .= chr($hex[$v & 15]);
				unset($v,$i);
			}
		}
		if($count < $b->length) {
			$buf->b .= "...";
		}
		return $buf->b;
	}
	static function bin($b, $maxBytes) {
		$buf = new StringBuf();
		$cnt = (($maxBytes === null) ? $b->length : (($maxBytes > $b->length ? $b->length : $maxBytes)));
		{
			$_g = 0;
			while($_g < $cnt) {
				$i = $_g++;
				$v = ord($b->b[$i]);
				{
					$_g1 = 0;
					while($_g1 < 8) {
						$j = $_g1++;
						$buf->b .= (((($v >> (7 - $j)) & 1) === 1) ? "1" : "0");
						if($j === 3) {
							$buf->b .= " ";
						}
						unset($j);
					}
				}
				$buf->b .= "  ";
				unset($v,$j,$i,$_g1);
			}
		}
		return $buf->b;
	}
	static function dumpTag($t, $max) {
		$infos = eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$t);
			switch(\$�t->index) {
			case 0:
			{
				\$�r = new _hx_array(array());
			}break;
			case 1:
			{
				\$�r = new _hx_array(array());
			}break;
			case 6:
			\$color = \$�t->params[0];
			{
				\$�r = new _hx_array(array(StringTools::hex(\$color, 6)));
			}break;
			case 2:
			\$sdata = \$�t->params[1]; \$id = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id));
			}break;
			case 3:
			\$data = \$�t->params[1]; \$id2 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id2));
			}break;
			case 4:
			\$data2 = \$�t->params[1]; \$id3 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id3));
			}break;
			case 5:
			\$data3 = \$�t->params[1]; \$id4 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id4));
			}break;
			case 21:
			\$data4 = \$�t->params[1]; \$id5 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id5, \"data\", format_swf_Tools::hex(\$data4, \$max)));
			}break;
			case 7:
			\$tags = \$�t->params[2]; \$frames = \$�t->params[1]; \$id6 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id6, \"frames\", \$frames));
			}break;
			case 8:
			\$po = \$�t->params[0];
			{
				\$�r = new _hx_array(array(Std::string(\$po)));
			}break;
			case 9:
			\$po2 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(Std::string(\$po2)));
			}break;
			case 10:
			\$d = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"depth\", \$d));
			}break;
			case 11:
			\$anchor = \$�t->params[1]; \$label = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"label\", \$label, \"anchor\", \$anchor));
			}break;
			case 12:
			\$data5 = \$�t->params[1]; \$id7 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id7, \"data\", format_swf_Tools::hex(\$data5, \$max)));
			}break;
			case 13:
			\$context = \$�t->params[1]; \$data6 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"context\", \$context, \"data\", format_swf_Tools::hex(\$data6, \$max)));
			}break;
			case 14:
			\$symbols = \$�t->params[0];
			{
				\$�r = new _hx_array(array(Std::string(\$symbols)));
			}break;
			case 15:
			\$symbols2 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(Std::string(\$symbols2)));
			}break;
			case 16:
			\$v = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\$v));
			}break;
			case 17:
			case 18:
			\$l = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$l->cid, \"color\", \$l->color, \"width\", \$l->width, \"height\", \$l->height, \"data\", format_swf_Tools::hex(\$l->data, \$max)));
			}break;
			case 20:
			\$data7 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"data\", format_swf_Tools::hex(\$data7, \$max)));
			}break;
			case 19:
			\$jdata = \$�t->params[1]; \$id8 = \$�t->params[0];
			{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$�t2 = (\\\$jdata);
					switch(\\\$�t2->index) {
					case 0:
					\\\$data8 = \\\$�t2->params[0];
					{
						\\\$�r2 = new _hx_array(array(\\\"id\\\", \\\$id8, \\\"ver\\\", 1, \\\"data\\\", format_swf_Tools::hex(\\\$data8, \\\$max)));
					}break;
					case 1:
					\\\$data9 = \\\$�t2->params[0];
					{
						\\\$�r2 = new _hx_array(array(\\\"id\\\", \\\$id8, \\\"ver\\\", 2, \\\"data\\\", format_swf_Tools::hex(\\\$data9, \\\$max)));
					}break;
					case 2:
					\\\$mask = \\\$�t2->params[1]; \\\$data10 = \\\$�t2->params[0];
					{
						\\\$�r2 = new _hx_array(array(\\\"id\\\", \\\$id8, \\\"ver\\\", 3, \\\"data\\\", format_swf_Tools::hex(\\\$data10, \\\$max), \\\"mask\\\", format_swf_Tools::hex(\\\$mask, \\\$max)));
					}break;
					default:{
						\\\$�r2 = null;
					}break;
					}
					return \\\$�r2;
				\");
			}break;
			case 22:
			\$data11 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"sid\", \$data11->sid, \"format\", \$data11->format, \"rate\", \$data11->rate));
			}break;
			case 23:
			\$soundInfo = \$�t->params[1]; \$id9 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id9, \"syncStop\", \$soundInfo->syncStop, \"hasLoops\", \$soundInfo->hasLoops, \"loopCount\", \$soundInfo->loopCount));
			}break;
			case 24:
			\$data12 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(format_swf_Tools::hex(\$data12, \$max)));
			}break;
			case 25:
			\$timeoutSeconds = \$�t->params[1]; \$maxRecursion = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"maxRecursion\", \$maxRecursion, \"timeoutSeconds\", \$timeoutSeconds));
			}break;
			case 26:
			\$records = \$�t->params[1]; \$id10 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id10, \"records\", \$records));
			}break;
			case 27:
			\$data13 = \$�t->params[1]; \$id11 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id11));
			}break;
			case 28:
			\$data14 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"metadata\", \$data14));
			}break;
			case 29:
			\$splitter = \$�t->params[1]; \$id12 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id12, \"splitter\", \"todo\"));
			}break;
			case 30:
			\$data15 = \$�t->params[1]; \$id13 = \$�t->params[0];
			{
				\$�r = new _hx_array(array(\"id\", \$id13, \"data\", format_swf_Tools::hex(\$data15, \$max)));
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
		$b = new StringBuf();
		$b->b .= Type::enumConstructor($t);
		$b->b .= "(";
		while($infos->length > 0) {
			$b->b .= $infos->shift();
			if($infos->length === 0) {
				break;
			}
			$b->b .= ":";
			$b->b .= $infos->shift();
			if($infos->length === 0) {
				break;
			}
			$b->b .= ",";
			;
		}
		$b->b .= ")";
		return $b->b;
	}
	function __toString() { return 'format.swf.Tools'; }
}
