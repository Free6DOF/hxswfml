<?php

class format_png_Tools {
	public function __construct(){}
	static function getHeader($d) {
		if(null == $d) throw new HException('null iterable');
		$__hx__it = $d->iterator();
		while($__hx__it->hasNext()) {
			$c = $__hx__it->next();
			$__hx__t = ($c);
			switch($__hx__t->index) {
			case 1:
			$h = $__hx__t->params[0];
			{
				return $h;
			}break;
			default:{
			}break;
			}
		}
		throw new HException("Header not found");
	}
	static function filter($rgba, $x, $y, $stride, $prev, $p) {
		$b = ord($rgba->b[$p - $stride]);
		$c = (($x === 0 || $y === 0) ? 0 : ord($rgba->b[$p - $stride - 4]));
		$k = $prev + $b - $c;
		$pa = $k - $prev;
		if($pa < 0) {
			$pa = -$pa;
		}
		$pb = $k - $b;
		if($pb < 0) {
			$pb = -$pb;
		}
		$pc = $k - $c;
		if($pc < 0) {
			$pc = -$pc;
		}
		return (($pa <= $pb && $pa <= $pc) ? $prev : (($pb <= $pc) ? $b : $c));
	}
	static function extract32($d) {
		$h = format_png_Tools::getHeader($d);
		$rgba = haxe_io_Bytes::alloc($h->width * $h->height * 4);
		$data = null;
		$fullData = null;
		if(null == $d) throw new HException('null iterable');
		$__hx__it = $d->iterator();
		while($__hx__it->hasNext()) {
			$c = $__hx__it->next();
			$__hx__t = ($c);
			switch($__hx__t->index) {
			case 2:
			$b = $__hx__t->params[0];
			{
				if($fullData !== null) {
					$fullData->b .= _hx_string_or_null($b->b);
				} else {
					if($data === null) {
						$data = $b;
					} else {
						$fullData = new haxe_io_BytesBuffer();
						$fullData->b .= _hx_string_or_null($data->b);
						$fullData->b .= _hx_string_or_null($b->b);
						$data = null;
					}
				}
			}break;
			default:{
			}break;
			}
		}
		if($fullData !== null) {
			$data = $fullData->getBytes();
		}
		if($data === null) {
			throw new HException("Data not found");
		}
		$data = format_tools_Inflate::run($data);
		$r = 0; $w = 0;
		$alpha_b = false;
		$__hx__t = ($h->color);
		switch($__hx__t->index) {
		case 1:
		$alpha = $__hx__t->params[0];
		{
			$alpha_b = true;
			if($h->colbits !== 8) {
				throw new HException("Unsupported color mode");
			}
			$width = $h->width;
			$stride = ((($alpha) ? 4 : 3)) * $width + 1;
			if($data->length < $h->height * $stride) {
				throw new HException("Not enough data");
			}
			{
				$_g1 = 0; $_g = $h->height;
				while($_g1 < $_g) {
					$y = $_g1++;
					$f = ord($data->b[$r++]);
					switch($f) {
					case 0:{
						if($alpha) {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$rgba->b[$w++] = chr(ord($data->b[$r]));
								$rgba->b[$w++] = chr(ord($data->b[$r + 1]));
								$rgba->b[$w++] = chr(ord($data->b[$r + 2]));
								$rgba->b[$w++] = chr(ord($data->b[$r + 3]));
								$r += 4;
								unset($x);
							}
						} else {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$rgba->b[$w++] = chr(ord($data->b[$r]));
								$rgba->b[$w++] = chr(ord($data->b[$r + 1]));
								$rgba->b[$w++] = chr(ord($data->b[$r + 2]));
								$rgba->b[$w++] = chr(255);
								$r += 3;
								unset($x);
							}
						}
					}break;
					case 1:{
						$cr = 0; $cg = 0; $cb = 0; $ca = 0;
						if($alpha) {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$cr += ord($data->b[$r]);
								$rgba->b[$w++] = chr($cr);
								$cg += ord($data->b[$r + 1]);
								$rgba->b[$w++] = chr($cg);
								$cb += ord($data->b[$r + 2]);
								$rgba->b[$w++] = chr($cb);
								$ca += ord($data->b[$r + 3]);
								$rgba->b[$w++] = chr($ca);
								$r += 4;
								unset($x);
							}
						} else {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$cr += ord($data->b[$r]);
								$rgba->b[$w++] = chr($cr);
								$cg += ord($data->b[$r + 1]);
								$rgba->b[$w++] = chr($cg);
								$cb += ord($data->b[$r + 2]);
								$rgba->b[$w++] = chr($cb);
								$rgba->b[$w++] = chr(255);
								$r += 3;
								unset($x);
							}
						}
					}break;
					case 2:{
						$stride1 = format_png_Tools_0($_g, $_g1, $alpha, $alpha_b, $d, $data, $f, $fullData, $h, $r, $rgba, $stride, $w, $width, $y);
						if($alpha) {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$rgba->b[$w] = chr(ord($data->b[$r]) + ord($rgba->b[$w - $stride1]));
								$w++;
								$rgba->b[$w] = chr(ord($data->b[$r + 1]) + ord($rgba->b[$w - $stride1]));
								$w++;
								$rgba->b[$w] = chr(ord($data->b[$r + 2]) + ord($rgba->b[$w - $stride1]));
								$w++;
								$rgba->b[$w] = chr(ord($data->b[$r + 3]) + ord($rgba->b[$w - $stride1]));
								$w++;
								$r += 4;
								unset($x);
							}
						} else {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$rgba->b[$w] = chr(ord($data->b[$r]) + ord($rgba->b[$w - $stride1]));
								$w++;
								$rgba->b[$w] = chr(ord($data->b[$r + 1]) + ord($rgba->b[$w - $stride1]));
								$w++;
								$rgba->b[$w] = chr(ord($data->b[$r + 2]) + ord($rgba->b[$w - $stride1]));
								$w++;
								$rgba->b[$w++] = chr(255);
								$r += 3;
								unset($x);
							}
						}
					}break;
					case 3:{
						$cr = 0; $cg = 0; $cb = 0; $ca = 0;
						$stride1 = format_png_Tools_1($_g, $_g1, $alpha, $alpha_b, $ca, $cb, $cg, $cr, $d, $data, $f, $fullData, $h, $r, $rgba, $stride, $w, $width, $y);
						if($alpha) {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$cr = ord($data->b[$r]) + ($cr + ord($rgba->b[$w - $stride1]) >> 1) & 255;
								$rgba->b[$w++] = chr($cr);
								$cg = ord($data->b[$r + 1]) + ($cg + ord($rgba->b[$w - $stride1]) >> 1) & 255;
								$rgba->b[$w++] = chr($cg);
								$cb = ord($data->b[$r + 2]) + ($cb + ord($rgba->b[$w - $stride1]) >> 1) & 255;
								$rgba->b[$w++] = chr($cb);
								$ca = ord($data->b[$r + 3]) + ($ca + ord($rgba->b[$w - $stride1]) >> 1) & 255;
								$rgba->b[$w++] = chr($ca);
								$r += 4;
								unset($x);
							}
						} else {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$cr = ord($data->b[$r]) + ($cr + ord($rgba->b[$w - $stride1]) >> 1) & 255;
								$rgba->b[$w++] = chr($cr);
								$cg = ord($data->b[$r + 1]) + ($cg + ord($rgba->b[$w - $stride1]) >> 1) & 255;
								$rgba->b[$w++] = chr($cg);
								$cb = ord($data->b[$r + 2]) + ($cb + ord($rgba->b[$w - $stride1]) >> 1) & 255;
								$rgba->b[$w++] = chr($cb);
								$rgba->b[$w++] = chr(255);
								$r += 3;
								unset($x);
							}
						}
					}break;
					case 4:{
						$stride1 = $width * 4;
						$cr = 0; $cg = 0; $cb = 0; $ca = 0;
						if($alpha) {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$cr = format_png_Tools_2($_g, $_g1, $_g2, $alpha, $alpha_b, $ca, $cb, $cg, $cr, $d, $data, $f, $fullData, $h, $r, $rgba, $stride, $stride1, $w, $width, $x, $y) + ord($data->b[$r]) & 255;
								$rgba->b[$w++] = chr($cr);
								$cg = format_png_Tools_3($_g, $_g1, $_g2, $alpha, $alpha_b, $ca, $cb, $cg, $cr, $d, $data, $f, $fullData, $h, $r, $rgba, $stride, $stride1, $w, $width, $x, $y) + ord($data->b[$r + 1]) & 255;
								$rgba->b[$w++] = chr($cg);
								$cb = format_png_Tools_4($_g, $_g1, $_g2, $alpha, $alpha_b, $ca, $cb, $cg, $cr, $d, $data, $f, $fullData, $h, $r, $rgba, $stride, $stride1, $w, $width, $x, $y) + ord($data->b[$r + 2]) & 255;
								$rgba->b[$w++] = chr($cb);
								$ca = format_png_Tools_5($_g, $_g1, $_g2, $alpha, $alpha_b, $ca, $cb, $cg, $cr, $d, $data, $f, $fullData, $h, $r, $rgba, $stride, $stride1, $w, $width, $x, $y) + ord($data->b[$r + 3]) & 255;
								$rgba->b[$w++] = chr($ca);
								$r += 4;
								unset($x);
							}
						} else {
							$_g2 = 0;
							while($_g2 < $width) {
								$x = $_g2++;
								$cr = format_png_Tools_6($_g, $_g1, $_g2, $alpha, $alpha_b, $ca, $cb, $cg, $cr, $d, $data, $f, $fullData, $h, $r, $rgba, $stride, $stride1, $w, $width, $x, $y) + ord($data->b[$r]) & 255;
								$rgba->b[$w++] = chr($cr);
								$cg = format_png_Tools_7($_g, $_g1, $_g2, $alpha, $alpha_b, $ca, $cb, $cg, $cr, $d, $data, $f, $fullData, $h, $r, $rgba, $stride, $stride1, $w, $width, $x, $y) + ord($data->b[$r + 1]) & 255;
								$rgba->b[$w++] = chr($cg);
								$cb = format_png_Tools_8($_g, $_g1, $_g2, $alpha, $alpha_b, $ca, $cb, $cg, $cr, $d, $data, $f, $fullData, $h, $r, $rgba, $stride, $stride1, $w, $width, $x, $y) + ord($data->b[$r + 2]) & 255;
								$rgba->b[$w++] = chr($cb);
								$rgba->b[$w++] = chr(255);
								$r += 3;
								unset($x);
							}
						}
					}break;
					default:{
						throw new HException("Invalid filter " . _hx_string_rec($f, ""));
					}break;
					}
					unset($y,$f);
				}
			}
		}break;
		default:{
			throw new HException("Unsupported color mode " . Std::string($h->color));
		}break;
		}
		return $rgba;
	}
	static function build24($width, $height, $data) {
		$rgb = haxe_io_Bytes::alloc($width * $height * 3 + $height);
		$w = 0; $r = 0;
		{
			$_g = 0;
			while($_g < $height) {
				$y = $_g++;
				$rgb->b[$w++] = chr(0);
				{
					$_g1 = 0;
					while($_g1 < $width) {
						$x = $_g1++;
						$rgb->b[$w++] = chr(ord($data->b[$r + 2]));
						$rgb->b[$w++] = chr(ord($data->b[$r + 1]));
						$rgb->b[$w++] = chr(ord($data->b[$r]));
						$r += 3;
						unset($x);
					}
					unset($_g1);
				}
				unset($y);
			}
		}
		$l = new HList();
		$l->add(format_png_Chunk::CHeader(_hx_anonymous(array("width" => $width, "height" => $height, "colbits" => 8, "color" => format_png_Color::ColTrue(false), "interlaced" => false))));
		$l->add(format_png_Chunk::CData(format_tools_Deflate::run($rgb)));
		$l->add(format_png_Chunk::$CEnd);
		return $l;
	}
	static function build32BE($width, $height, $data) {
		$rgba = haxe_io_Bytes::alloc($width * $height * 4 + $height);
		$w = 0; $r = 0;
		{
			$_g = 0;
			while($_g < $height) {
				$y = $_g++;
				$rgba->b[$w++] = chr(0);
				{
					$_g1 = 0;
					while($_g1 < $width) {
						$x = $_g1++;
						$rgba->b[$w++] = chr(ord($data->b[$r + 1]));
						$rgba->b[$w++] = chr(ord($data->b[$r + 2]));
						$rgba->b[$w++] = chr(ord($data->b[$r + 3]));
						$rgba->b[$w++] = chr(ord($data->b[$r]));
						$r += 4;
						unset($x);
					}
					unset($_g1);
				}
				unset($y);
			}
		}
		$l = new HList();
		$l->add(format_png_Chunk::CHeader(_hx_anonymous(array("width" => $width, "height" => $height, "colbits" => 8, "color" => format_png_Color::ColTrue(true), "interlaced" => false))));
		$l->add(format_png_Chunk::CData(format_tools_Deflate::run($rgba)));
		$l->add(format_png_Chunk::$CEnd);
		return $l;
	}
	static function build32LE($width, $height, $data) {
		$rgba = haxe_io_Bytes::alloc($width * $height * 4 + $height);
		$w = 0; $r = 0;
		{
			$_g = 0;
			while($_g < $height) {
				$y = $_g++;
				$rgba->b[$w++] = chr(0);
				{
					$_g1 = 0;
					while($_g1 < $width) {
						$x = $_g1++;
						$rgba->b[$w++] = chr(ord($data->b[$r + 2]));
						$rgba->b[$w++] = chr(ord($data->b[$r + 1]));
						$rgba->b[$w++] = chr(ord($data->b[$r]));
						$rgba->b[$w++] = chr(ord($data->b[$r + 3]));
						$r += 4;
						unset($x);
					}
					unset($_g1);
				}
				unset($y);
			}
		}
		$l = new HList();
		$l->add(format_png_Chunk::CHeader(_hx_anonymous(array("width" => $width, "height" => $height, "colbits" => 8, "color" => format_png_Color::ColTrue(true), "interlaced" => false))));
		$l->add(format_png_Chunk::CData(format_tools_Deflate::run($rgba)));
		$l->add(format_png_Chunk::$CEnd);
		return $l;
	}
	static function rgba2argbmult($width, $height, $data) {
		$argb = haxe_io_Bytes::alloc($width * $height * 4);
		$w = 0; $r = 0;
		{
			$_g = 0;
			while($_g < $height) {
				$y = $_g++;
				{
					$_g1 = 0;
					while($_g1 < $width) {
						$x = $_g1++;
						$a = ord($data->b[$r + 3]) / 255;
						$argb->b[$w++] = chr(ord($data->b[$r + 3]));
						$argb->b[$w++] = chr(Math::round(ord($data->b[$r]) * $a));
						$argb->b[$w++] = chr(Math::round(ord($data->b[$r + 1]) * $a));
						$argb->b[$w++] = chr(Math::round(ord($data->b[$r + 2]) * $a));
						$r += 4;
						unset($x,$a);
					}
					unset($_g1);
				}
				unset($y);
			}
		}
		return $argb;
	}
	function __toString() { return 'format.png.Tools'; }
}
function format_png_Tools_0(&$_g, &$_g1, &$alpha, &$alpha_b, &$d, &$data, &$f, &$fullData, &$h, &$r, &$rgba, &$stride, &$w, &$width, &$y) {
	if($y === 0) {
		return 0;
	} else {
		return $width * 4;
	}
}
function format_png_Tools_1(&$_g, &$_g1, &$alpha, &$alpha_b, &$ca, &$cb, &$cg, &$cr, &$d, &$data, &$f, &$fullData, &$h, &$r, &$rgba, &$stride, &$w, &$width, &$y) {
	if($y === 0) {
		return 0;
	} else {
		return $width * 4;
	}
}
function format_png_Tools_2(&$_g, &$_g1, &$_g2, &$alpha, &$alpha_b, &$ca, &$cb, &$cg, &$cr, &$d, &$data, &$f, &$fullData, &$h, &$r, &$rgba, &$stride, &$stride1, &$w, &$width, &$x, &$y) {
	{
		$b = ord($rgba->b[$w - $stride1]);
		$c = (($x === 0 || $y === 0) ? 0 : ord($rgba->b[$w - $stride1 - 4]));
		$k = $cr + $b - $c;
		$pa = $k - $cr;
		if($pa < 0) {
			$pa = -$pa;
		}
		$pb = $k - $b;
		if($pb < 0) {
			$pb = -$pb;
		}
		$pc = $k - $c;
		if($pc < 0) {
			$pc = -$pc;
		}
		if($pa <= $pb && $pa <= $pc) {
			return $cr;
		} else {
			if($pb <= $pc) {
				return $b;
			} else {
				return $c;
			}
		}
		unset($pc,$pb,$pa,$k,$c,$b);
	}
}
function format_png_Tools_3(&$_g, &$_g1, &$_g2, &$alpha, &$alpha_b, &$ca, &$cb, &$cg, &$cr, &$d, &$data, &$f, &$fullData, &$h, &$r, &$rgba, &$stride, &$stride1, &$w, &$width, &$x, &$y) {
	{
		$b = ord($rgba->b[$w - $stride1]);
		$c = (($x === 0 || $y === 0) ? 0 : ord($rgba->b[$w - $stride1 - 4]));
		$k = $cg + $b - $c;
		$pa = $k - $cg;
		if($pa < 0) {
			$pa = -$pa;
		}
		$pb = $k - $b;
		if($pb < 0) {
			$pb = -$pb;
		}
		$pc = $k - $c;
		if($pc < 0) {
			$pc = -$pc;
		}
		if($pa <= $pb && $pa <= $pc) {
			return $cg;
		} else {
			if($pb <= $pc) {
				return $b;
			} else {
				return $c;
			}
		}
		unset($pc,$pb,$pa,$k,$c,$b);
	}
}
function format_png_Tools_4(&$_g, &$_g1, &$_g2, &$alpha, &$alpha_b, &$ca, &$cb, &$cg, &$cr, &$d, &$data, &$f, &$fullData, &$h, &$r, &$rgba, &$stride, &$stride1, &$w, &$width, &$x, &$y) {
	{
		$b = ord($rgba->b[$w - $stride1]);
		$c = (($x === 0 || $y === 0) ? 0 : ord($rgba->b[$w - $stride1 - 4]));
		$k = $cb + $b - $c;
		$pa = $k - $cb;
		if($pa < 0) {
			$pa = -$pa;
		}
		$pb = $k - $b;
		if($pb < 0) {
			$pb = -$pb;
		}
		$pc = $k - $c;
		if($pc < 0) {
			$pc = -$pc;
		}
		if($pa <= $pb && $pa <= $pc) {
			return $cb;
		} else {
			if($pb <= $pc) {
				return $b;
			} else {
				return $c;
			}
		}
		unset($pc,$pb,$pa,$k,$c,$b);
	}
}
function format_png_Tools_5(&$_g, &$_g1, &$_g2, &$alpha, &$alpha_b, &$ca, &$cb, &$cg, &$cr, &$d, &$data, &$f, &$fullData, &$h, &$r, &$rgba, &$stride, &$stride1, &$w, &$width, &$x, &$y) {
	{
		$b = ord($rgba->b[$w - $stride1]);
		$c = (($x === 0 || $y === 0) ? 0 : ord($rgba->b[$w - $stride1 - 4]));
		$k = $ca + $b - $c;
		$pa = $k - $ca;
		if($pa < 0) {
			$pa = -$pa;
		}
		$pb = $k - $b;
		if($pb < 0) {
			$pb = -$pb;
		}
		$pc = $k - $c;
		if($pc < 0) {
			$pc = -$pc;
		}
		if($pa <= $pb && $pa <= $pc) {
			return $ca;
		} else {
			if($pb <= $pc) {
				return $b;
			} else {
				return $c;
			}
		}
		unset($pc,$pb,$pa,$k,$c,$b);
	}
}
function format_png_Tools_6(&$_g, &$_g1, &$_g2, &$alpha, &$alpha_b, &$ca, &$cb, &$cg, &$cr, &$d, &$data, &$f, &$fullData, &$h, &$r, &$rgba, &$stride, &$stride1, &$w, &$width, &$x, &$y) {
	{
		$b = ord($rgba->b[$w - $stride1]);
		$c = (($x === 0 || $y === 0) ? 0 : ord($rgba->b[$w - $stride1 - 4]));
		$k = $cr + $b - $c;
		$pa = $k - $cr;
		if($pa < 0) {
			$pa = -$pa;
		}
		$pb = $k - $b;
		if($pb < 0) {
			$pb = -$pb;
		}
		$pc = $k - $c;
		if($pc < 0) {
			$pc = -$pc;
		}
		if($pa <= $pb && $pa <= $pc) {
			return $cr;
		} else {
			if($pb <= $pc) {
				return $b;
			} else {
				return $c;
			}
		}
		unset($pc,$pb,$pa,$k,$c,$b);
	}
}
function format_png_Tools_7(&$_g, &$_g1, &$_g2, &$alpha, &$alpha_b, &$ca, &$cb, &$cg, &$cr, &$d, &$data, &$f, &$fullData, &$h, &$r, &$rgba, &$stride, &$stride1, &$w, &$width, &$x, &$y) {
	{
		$b = ord($rgba->b[$w - $stride1]);
		$c = (($x === 0 || $y === 0) ? 0 : ord($rgba->b[$w - $stride1 - 4]));
		$k = $cg + $b - $c;
		$pa = $k - $cg;
		if($pa < 0) {
			$pa = -$pa;
		}
		$pb = $k - $b;
		if($pb < 0) {
			$pb = -$pb;
		}
		$pc = $k - $c;
		if($pc < 0) {
			$pc = -$pc;
		}
		if($pa <= $pb && $pa <= $pc) {
			return $cg;
		} else {
			if($pb <= $pc) {
				return $b;
			} else {
				return $c;
			}
		}
		unset($pc,$pb,$pa,$k,$c,$b);
	}
}
function format_png_Tools_8(&$_g, &$_g1, &$_g2, &$alpha, &$alpha_b, &$ca, &$cb, &$cg, &$cr, &$d, &$data, &$f, &$fullData, &$h, &$r, &$rgba, &$stride, &$stride1, &$w, &$width, &$x, &$y) {
	{
		$b = ord($rgba->b[$w - $stride1]);
		$c = (($x === 0 || $y === 0) ? 0 : ord($rgba->b[$w - $stride1 - 4]));
		$k = $cb + $b - $c;
		$pa = $k - $cb;
		if($pa < 0) {
			$pa = -$pa;
		}
		$pb = $k - $b;
		if($pb < 0) {
			$pb = -$pb;
		}
		$pc = $k - $c;
		if($pc < 0) {
			$pc = -$pc;
		}
		if($pa <= $pb && $pa <= $pc) {
			return $cb;
		} else {
			if($pb <= $pc) {
				return $b;
			} else {
				return $c;
			}
		}
		unset($pc,$pb,$pa,$k,$c,$b);
	}
}
