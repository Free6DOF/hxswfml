<?php

class format_tools_MD5 {
	public function __construct() { 
	}
	public function encode($b) {
		$x = $this->str2blks($b);
		$a = 1732584193;
		$b1 = -271733879;
		$c = -1732584194;
		$d = 271733878;
		$step = null;
		$i = 0;
		$max = $x->length;
		while($i < $max) {
			$olda = $a;
			$oldb = $b1;
			$oldc = $c;
			$oldd = $d;
			$step = 0;
			$a = $this->ff($a, $b1, $c, $d, $x[$i], 7, -680876936);
			$d = $this->ff($d, $a, $b1, $c, $x[$i + 1], 12, -389564586);
			$c = $this->ff($c, $d, $a, $b1, $x[$i + 2], 17, 606105819);
			$b1 = $this->ff($b1, $c, $d, $a, $x[$i + 3], 22, -1044525330);
			$a = $this->ff($a, $b1, $c, $d, $x[$i + 4], 7, -176418897);
			$d = $this->ff($d, $a, $b1, $c, $x[$i + 5], 12, 1200080426);
			$c = $this->ff($c, $d, $a, $b1, $x[$i + 6], 17, -1473231341);
			$b1 = $this->ff($b1, $c, $d, $a, $x[$i + 7], 22, -45705983);
			$a = $this->ff($a, $b1, $c, $d, $x[$i + 8], 7, 1770035416);
			$d = $this->ff($d, $a, $b1, $c, $x[$i + 9], 12, -1958414417);
			$c = $this->ff($c, $d, $a, $b1, $x[$i + 10], 17, -42063);
			$b1 = $this->ff($b1, $c, $d, $a, $x[$i + 11], 22, -1990404162);
			$a = $this->ff($a, $b1, $c, $d, $x[$i + 12], 7, 1804603682);
			$d = $this->ff($d, $a, $b1, $c, $x[$i + 13], 12, -40341101);
			$c = $this->ff($c, $d, $a, $b1, $x[$i + 14], 17, -1502002290);
			$b1 = $this->ff($b1, $c, $d, $a, $x[$i + 15], 22, 1236535329);
			$a = $this->gg($a, $b1, $c, $d, $x[$i + 1], 5, -165796510);
			$d = $this->gg($d, $a, $b1, $c, $x[$i + 6], 9, -1069501632);
			$c = $this->gg($c, $d, $a, $b1, $x[$i + 11], 14, 643717713);
			$b1 = $this->gg($b1, $c, $d, $a, $x[$i], 20, -373897302);
			$a = $this->gg($a, $b1, $c, $d, $x[$i + 5], 5, -701558691);
			$d = $this->gg($d, $a, $b1, $c, $x[$i + 10], 9, 38016083);
			$c = $this->gg($c, $d, $a, $b1, $x[$i + 15], 14, -660478335);
			$b1 = $this->gg($b1, $c, $d, $a, $x[$i + 4], 20, -405537848);
			$a = $this->gg($a, $b1, $c, $d, $x[$i + 9], 5, 568446438);
			$d = $this->gg($d, $a, $b1, $c, $x[$i + 14], 9, -1019803690);
			$c = $this->gg($c, $d, $a, $b1, $x[$i + 3], 14, -187363961);
			$b1 = $this->gg($b1, $c, $d, $a, $x[$i + 8], 20, 1163531501);
			$a = $this->gg($a, $b1, $c, $d, $x[$i + 13], 5, -1444681467);
			$d = $this->gg($d, $a, $b1, $c, $x[$i + 2], 9, -51403784);
			$c = $this->gg($c, $d, $a, $b1, $x[$i + 7], 14, 1735328473);
			$b1 = $this->gg($b1, $c, $d, $a, $x[$i + 12], 20, -1926607734);
			$a = $this->hh($a, $b1, $c, $d, $x[$i + 5], 4, -378558);
			$d = $this->hh($d, $a, $b1, $c, $x[$i + 8], 11, -2022574463);
			$c = $this->hh($c, $d, $a, $b1, $x[$i + 11], 16, 1839030562);
			$b1 = $this->hh($b1, $c, $d, $a, $x[$i + 14], 23, -35309556);
			$a = $this->hh($a, $b1, $c, $d, $x[$i + 1], 4, -1530992060);
			$d = $this->hh($d, $a, $b1, $c, $x[$i + 4], 11, 1272893353);
			$c = $this->hh($c, $d, $a, $b1, $x[$i + 7], 16, -155497632);
			$b1 = $this->hh($b1, $c, $d, $a, $x[$i + 10], 23, -1094730640);
			$a = $this->hh($a, $b1, $c, $d, $x[$i + 13], 4, 681279174);
			$d = $this->hh($d, $a, $b1, $c, $x[$i], 11, -358537222);
			$c = $this->hh($c, $d, $a, $b1, $x[$i + 3], 16, -722521979);
			$b1 = $this->hh($b1, $c, $d, $a, $x[$i + 6], 23, 76029189);
			$a = $this->hh($a, $b1, $c, $d, $x[$i + 9], 4, -640364487);
			$d = $this->hh($d, $a, $b1, $c, $x[$i + 12], 11, -421815835);
			$c = $this->hh($c, $d, $a, $b1, $x[$i + 15], 16, 530742520);
			$b1 = $this->hh($b1, $c, $d, $a, $x[$i + 2], 23, -995338651);
			$a = $this->ii($a, $b1, $c, $d, $x[$i], 6, -198630844);
			$d = $this->ii($d, $a, $b1, $c, $x[$i + 7], 10, 1126891415);
			$c = $this->ii($c, $d, $a, $b1, $x[$i + 14], 15, -1416354905);
			$b1 = $this->ii($b1, $c, $d, $a, $x[$i + 5], 21, -57434055);
			$a = $this->ii($a, $b1, $c, $d, $x[$i + 12], 6, 1700485571);
			$d = $this->ii($d, $a, $b1, $c, $x[$i + 3], 10, -1894986606);
			$c = $this->ii($c, $d, $a, $b1, $x[$i + 10], 15, -1051523);
			$b1 = $this->ii($b1, $c, $d, $a, $x[$i + 1], 21, -2054922799);
			$a = $this->ii($a, $b1, $c, $d, $x[$i + 8], 6, 1873313359);
			$d = $this->ii($d, $a, $b1, $c, $x[$i + 15], 10, -30611744);
			$c = $this->ii($c, $d, $a, $b1, $x[$i + 6], 15, -1560198380);
			$b1 = $this->ii($b1, $c, $d, $a, $x[$i + 13], 21, 1309151649);
			$a = $this->ii($a, $b1, $c, $d, $x[$i + 4], 6, -145523070);
			$d = $this->ii($d, $a, $b1, $c, $x[$i + 11], 10, -1120210379);
			$c = $this->ii($c, $d, $a, $b1, $x[$i + 2], 15, 718787259);
			$b1 = $this->ii($b1, $c, $d, $a, $x[$i + 9], 21, -343485551);
			$a = $this->addme($a, $olda);
			$b1 = $this->addme($b1, $oldb);
			$c = $this->addme($c, $oldc);
			$d = $this->addme($d, $oldd);
			$i += 16;
			unset($oldd,$oldc,$oldb,$olda);
		}
		$out = haxe_io_Bytes::alloc(16);
		$out->b[0] = chr($a & 255);
		$out->b[1] = chr($a >> 8 & 255);
		$out->b[2] = chr($a >> 16 & 255);
		$out->b[3] = chr($a >> 24);
		$out->b[4] = chr($b1 & 255);
		$out->b[5] = chr($b1 >> 8 & 255);
		$out->b[6] = chr($b1 >> 16 & 255);
		$out->b[7] = chr($b1 >> 24);
		$out->b[8] = chr($c & 255);
		$out->b[9] = chr($c >> 8 & 255);
		$out->b[10] = chr($c >> 16 & 255);
		$out->b[11] = chr($c >> 24);
		$out->b[12] = chr($d & 255);
		$out->b[13] = chr($d >> 8 & 255);
		$out->b[14] = chr($d >> 16 & 255);
		$out->b[15] = chr($d >> 24);
		return $out;
	}
	public function ii($a, $b, $c, $d, $x, $s, $t) {
		return $this->cmn($this->bitXOR($c, $this->bitOR($b, ~$d)), $a, $b, $x, $s, $t);
	}
	public function hh($a, $b, $c, $d, $x, $s, $t) {
		return $this->cmn($this->bitXOR($this->bitXOR($b, $c), $d), $a, $b, $x, $s, $t);
	}
	public function gg($a, $b, $c, $d, $x, $s, $t) {
		return $this->cmn($this->bitOR($this->bitAND($b, $d), $this->bitAND($c, ~$d)), $a, $b, $x, $s, $t);
	}
	public function ff($a, $b, $c, $d, $x, $s, $t) {
		return $this->cmn($this->bitOR($this->bitAND($b, $c), $this->bitAND(~$b, $d)), $a, $b, $x, $s, $t);
	}
	public function cmn($q, $a, $b, $x, $s, $t) {
		return $this->addme($this->rol($this->addme($this->addme($a, $q), $this->addme($x, $t)), $s), $b);
	}
	public function rol($num, $cnt) {
		return $num << $cnt | _hx_shift_right($num, 32 - $cnt);
	}
	public function str2blks($b) {
		$length = $b->length;
		$l = $length << 3;
		$nblk = ($length + 8 >> 6) + 1;
		$blks = new _hx_array(array());
		{
			$_g1 = 0; $_g = $nblk * 16;
			while($_g1 < $_g) {
				$i = $_g1++;
				$blks[$i] = 0;
				unset($i);
			}
		}
		{
			$_g = 0;
			while($_g < $length) {
				$i = $_g++;
				$blks->a[$i >> 2] |= ord($b->b[$i]) << (($l + $i & 3) << 3);
				unset($i);
			}
		}
		$blks->a[$length >> 2] |= 128 << (($l + $length & 3) << 3);
		$blks[$nblk * 16 - 2] = $l & 255;
		$blks->a[$nblk * 16 - 2] |= (_hx_shift_right($l, 8) & 255) << 8;
		$blks->a[$nblk * 16 - 2] |= (_hx_shift_right($l, 16) & 255) << 16;
		$blks->a[$nblk * 16 - 2] |= (_hx_shift_right($l, 24) & 255) << 24;
		return $blks;
	}
	public function addme($x, $y) {
		$lsw = ($x & 65535) + ($y & 65535);
		$msw = ($x >> 16) + ($y >> 16) + ($lsw >> 16);
		return $msw << 16 | $lsw & 65535;
	}
	public function bitAND($a, $b) {
		$lsb = $a & 1 & ($b & 1);
		$msb31 = _hx_shift_right($a, 1) & _hx_shift_right($b, 1);
		return $msb31 << 1 | $lsb;
	}
	public function bitXOR($a, $b) {
		$lsb = $a & 1 ^ $b & 1;
		$msb31 = _hx_shift_right($a, 1) ^ _hx_shift_right($b, 1);
		return $msb31 << 1 | $lsb;
	}
	public function bitOR($a, $b) {
		$lsb = $a & 1 | $b & 1;
		$msb31 = _hx_shift_right($a, 1) | _hx_shift_right($b, 1);
		return $msb31 << 1 | $lsb;
	}
	static function make($s) {
		return format_tools_MD5::$inst->encode($s);
	}
	static $inst;
	function __toString() { return 'format.tools.MD5'; }
}
format_tools_MD5::$inst = new format_tools_MD5();
