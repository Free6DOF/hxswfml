<?php

class format_swf_Reader {
	public function __construct($i) {
		if( !php_Boot::$skip_constructor ) {
		$this->i = $i;
	}}
	public $i;
	public $bits;
	public $version;
	public $bitsRead;
	public function readFixed8($i) {
		if($i === null) {
			$i = $this->i;
		}
		return $i->readUInt16();
	}
	public function readFixed() {
		return $this->i->readInt32();
	}
	public function readUTF8Bytes() {
		$b = new haxe_io_BytesBuffer();
		while(true) {
			$c = $this->i->readByte();
			if($c === 0) {
				break;
			}
			$b->b .= chr($c);
			unset($c);
		}
		return $b->getBytes();
	}
	public function readRect() {
		$this->bits->nbits = 0;
		$nbits = $this->bits->readBits(5);
		return _hx_anonymous(array("left" => format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits), "right" => format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits), "top" => format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits), "bottom" => format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits)));
	}
	public function readMatrixPart() {
		$nbits = $this->bits->readBits(5);
		return _hx_anonymous(array("nbits" => $nbits, "x" => $this->bits->readBits($nbits), "y" => $this->bits->readBits($nbits)));
	}
	public function readMatrix() {
		$this->bits->nbits = 0;
		$scale = null;
		if($this->bits->read()) {
			$nbits = $this->bits->readBits(5);
			$_x = eval("if(isset(\$this)) \$�this =& \$this;\$i = \$�this->bits->readBits(\$nbits);
				\$i = format_swf_Tools::signExtend(\$i, \$nbits);
				\$�r = (\$i >> 16) + (\$i & 65535) / 65536.0;
				return \$�r;
			");
			$_y = eval("if(isset(\$this)) \$�this =& \$this;\$i2 = \$�this->bits->readBits(\$nbits);
				\$i2 = format_swf_Tools::signExtend(\$i2, \$nbits);
				\$�r2 = (\$i2 >> 16) + (\$i2 & 65535) / 65536.0;
				return \$�r2;
			");
			$scale = _hx_anonymous(array("x" => $_x, "y" => $_y));
		}
		$rotate = null;
		if($this->bits->read()) {
			$nbits2 = $this->bits->readBits(5);
			$_rs0 = eval("if(isset(\$this)) \$�this =& \$this;\$i3 = \$�this->bits->readBits(\$nbits2);
				\$i3 = format_swf_Tools::signExtend(\$i3, \$nbits2);
				\$�r3 = (\$i3 >> 16) + (\$i3 & 65535) / 65536.0;
				return \$�r3;
			");
			$_rs1 = eval("if(isset(\$this)) \$�this =& \$this;\$i4 = \$�this->bits->readBits(\$nbits2);
				\$i4 = format_swf_Tools::signExtend(\$i4, \$nbits2);
				\$�r4 = (\$i4 >> 16) + (\$i4 & 65535) / 65536.0;
				return \$�r4;
			");
			$rotate = _hx_anonymous(array("rs0" => $_rs0, "rs1" => $_rs1));
		}
		$nbits3 = $this->bits->readBits(5);
		$translate = _hx_anonymous(array("x" => format_swf_Tools::signExtend($this->bits->readBits($nbits3), $nbits3), "y" => format_swf_Tools::signExtend($this->bits->readBits($nbits3), $nbits3)));
		return _hx_anonymous(array("scale" => $scale, "rotate" => $rotate, "translate" => $translate));
	}
	public function readRGBA($i) {
		if($i === null) {
			$i = $this->i;
		}
		return _hx_anonymous(array("r" => $i->readByte(), "g" => $i->readByte(), "b" => $i->readByte(), "a" => $i->readByte()));
	}
	public function readRGB($i) {
		if($i === null) {
			$i = $this->i;
		}
		return _hx_anonymous(array("r" => $i->readByte(), "g" => $i->readByte(), "b" => $i->readByte()));
	}
	public function readCXAColor($nbits) {
		return _hx_anonymous(array("r" => $this->bits->readBits($nbits), "g" => $this->bits->readBits($nbits), "b" => $this->bits->readBits($nbits), "a" => $this->bits->readBits($nbits)));
	}
	public function readCXA() {
		$this->bits->nbits = 0;
		$add = $this->bits->read();
		$mult = $this->bits->read();
		$nbits = $this->bits->readBits(4);
		return _hx_anonymous(array("nbits" => $nbits, "mult" => ($mult ? $this->readCXAColor($nbits) : null), "add" => ($add ? $this->readCXAColor($nbits) : null)));
	}
	public function readGradient($ver) {
		$this->bits->nbits = 0;
		$spread = eval("if(isset(\$this)) \$�this =& \$this;switch(\$�this->bits->readBits(2)) {
			case 0:{
				\$�r = format_swf_SpreadMode::\$SMPad;
			}break;
			case 1:{
				\$�r = format_swf_SpreadMode::\$SMReflect;
			}break;
			case 2:{
				\$�r = format_swf_SpreadMode::\$SMRepeat;
			}break;
			case 3:{
				\$�r = format_swf_SpreadMode::\$SMReserved;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
		$interp = eval("if(isset(\$this)) \$�this =& \$this;switch(\$�this->bits->readBits(2)) {
			case 0:{
				\$�r2 = format_swf_InterpolationMode::\$IMNormalRGB;
			}break;
			case 1:{
				\$�r2 = format_swf_InterpolationMode::\$IMLinearRGB;
			}break;
			case 2:{
				\$�r2 = format_swf_InterpolationMode::\$IMReserved1;
			}break;
			case 3:{
				\$�r2 = format_swf_InterpolationMode::\$IMReserved2;
			}break;
			default:{
				\$�r2 = null;
			}break;
			}
			return \$�r2;
		");
		$nGrad = $this->bits->readBits(4);
		$arr = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $nGrad) {
				$c = $_g++;
				$pos = $this->i->readByte();
				if($ver <= 2) {
					$arr->push(format_swf_GradRecord::GRRGB($pos, $this->readRGB(null)));
				}
				else {
					$arr->push(format_swf_GradRecord::GRRGBA($pos, $this->readRGBA(null)));
				}
				unset($pos,$c);
			}
		}
		return _hx_anonymous(array("spread" => $spread, "interpolate" => $interp, "data" => $arr));
	}
	public function getLineCap($t) {
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$t) {
			case 0:{
				\$�r = format_swf_LineCapStyle::\$LCRound;
			}break;
			case 1:{
				\$�r = format_swf_LineCapStyle::\$LCNone;
			}break;
			case 2:{
				\$�r = format_swf_LineCapStyle::\$LCSquare;
			}break;
			default:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(\\\"invalid lineCap\\\"));
					return \\\$�r2;
				\");
			}break;
			}
			return \$�r;
		");
	}
	public function readLineStyles($ver) {
		$cnt = $this->i->readByte();
		if($cnt === 255) {
			if($ver === 1) {
				throw new HException($this->error("invalid line count in line styles array"));
			}
			$cnt = $this->i->readUInt16();
		}
		$arr = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $cnt) {
				$c = $_g++;
				$width = $this->i->readUInt16();
				$arr->push(_hx_anonymous(array("width" => $width, "data" => ($ver <= 2 ? format_swf_LineStyleData::LSRGB($this->readRGB($this->i)) : ($ver === 3 ? format_swf_LineStyleData::LSRGBA($this->readRGBA($this->i)) : ($ver === 4 ? eval("if(isset(\$this)) \$�this =& \$this;\$�this->bits->nbits = 0;
					\$startCap = \$�this->getLineCap(\$�this->bits->readBits(2));
					\$_join = \$�this->bits->readBits(2);
					\$_fill = \$�this->bits->read();
					\$noHScale = \$�this->bits->read();
					\$noVScale = \$�this->bits->read();
					\$pixelHinting = \$�this->bits->read();
					if(\$�this->bits->readBits(5) !== 0) {
						throw new HException(\$�this->error(\"invalid nbits in line style\"));
					}
					\$noClose = \$�this->bits->read();
					\$endCap = \$�this->getLineCap(\$�this->bits->readBits(2));
					\$join = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;switch(\\\$_join) {
						case 0:{
							\\\$�r2 = format_swf_LineJoinStyle::\\\$LJRound;
						}break;
						case 1:{
							\\\$�r2 = format_swf_LineJoinStyle::\\\$LJBevel;
						}break;
						case 2:{
							\\\$�r2 = format_swf_LineJoinStyle::LJMiter(eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;\\\\\$i = null;
								if(\\\\\$i === null) {
									\\\\\$i = \\\\\$�this->i;
								}
								\\\\\$�r3 = \\\\\$i->readUInt16();
								return \\\\\$�r3;
							\\\"));
						}break;
						default:{
							\\\$�r2 = eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;throw new HException(\\\\\$�this->error(\\\\\"invalid joint style in line style\\\\\"));
								return \\\\\$�r4;
							\\\");
						}break;
						}
						return \\\$�r2;
					\");
					\$fill = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;switch(\\\$_fill) {
						case false:{
							\\\$�r5 = format_swf_LS2Fill::LS2FColor(\\\$�this->readRGBA(\\\$�this->i));
						}break;
						case true:{
							\\\$�r5 = format_swf_LS2Fill::LS2FStyle(\\\$�this->readFillStyle(\\\$ver));
						}break;
						default:{
							\\\$�r5 = null;
						}break;
						}
						return \\\$�r5;
					\");
					\$�r = format_swf_LineStyleData::LS2(_hx_anonymous(array(\"startCap\" => \$startCap, \"join\" => \$join, \"fill\" => \$fill, \"noHScale\" => \$noHScale, \"noVScale\" => \$noVScale, \"pixelHinting\" => \$pixelHinting, \"noClose\" => \$noClose, \"endCap\" => \$endCap)));
					return \$�r;
				") : eval("if(isset(\$this)) \$�this =& \$this;throw new HException(\$�this->error(\"invalid line style version\"));
					return \$�r6;
				")))))));
				unset($�r6,$�r5,$�r4,$�r3,$�r2,$�r,$width,$startCap,$pixelHinting,$noVScale,$noHScale,$noClose,$join,$i,$fill,$endCap,$c,$_join,$_fill);
			}
		}
		return $arr;
	}
	public function readFillStyle($ver) {
		$type = $this->i->readByte();
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$type) {
			case 0:{
				\$�r = ((\$ver <= 2) ? format_swf_FillStyle::FSSolid(\$�this->readRGB(\$�this->i)) : format_swf_FillStyle::FSSolidAlpha(\$�this->readRGBA(\$�this->i)));
			}break;
			case 16:case 18:case 19:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$mat = \\\$�this->readMatrix();
					\\\$grad = \\\$�this->readGradient(\\\$ver);
					\\\$�r2 = eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;switch(\\\\\$type) {
						case 19:{
							\\\\\$�r3 = format_swf_FillStyle::FSFocalGradient(\\\\\$mat, _hx_anonymous(array(\\\\\"focalPoint\\\\\" => eval(\\\\\"if(isset(\\\\\\\$this)) \\\\\\\$�this =& \\\\\\\$this;\\\\\\\$i = \\\\\\\$�this->i;
								if(\\\\\\\$i === null) {
									\\\\\\\$i = \\\\\\\$�this->i;
								}
								\\\\\\\$�r4 = \\\\\\\$i->readUInt16();
								return \\\\\\\$�r4;
							\\\\\"), \\\\\"data\\\\\" => \\\\\$grad)));
						}break;
						case 16:{
							\\\\\$�r3 = format_swf_FillStyle::FSLinearGradient(\\\\\$mat, \\\\\$grad);
						}break;
						case 18:{
							\\\\\$�r3 = format_swf_FillStyle::FSRadialGradient(\\\\\$mat, \\\\\$grad);
						}break;
						default:{
							\\\\\$�r3 = eval(\\\\\"if(isset(\\\\\\\$this)) \\\\\\\$�this =& \\\\\\\$this;throw new HException(\\\\\\\$�this->error(\\\\\\\"invalid fill style type\\\\\\\"));
								return \\\\\\\$�r5;
							\\\\\");
						}break;
						}
						return \\\\\$�r3;
					\\\");
					return \\\$�r2;
				\");
			}break;
			case 64:case 65:case 66:case 67:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$cid = \\\$�this->i->readUInt16();
					\\\$mat2 = \\\$�this->readMatrix();
					\\\$isRepeat = (\\\$type === 64 || \\\$type === 66);
					\\\$isSmooth = (\\\$type === 64 || \\\$type === 65);
					\\\$�r6 = format_swf_FillStyle::FSBitmap(\\\$cid, \\\$mat2, \\\$isRepeat, \\\$isSmooth);
					return \\\$�r6;
				\");
			}break;
			default:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(null) . \\\" code \\\" . \\\$type);
					return \\\$�r7;
				\");
			}break;
			}
			return \$�r;
		");
	}
	public function readFillStyles($ver) {
		$cnt = $this->i->readByte();
		if($cnt === 255 && $ver > 1) {
			$cnt = $this->i->readUInt16();
		}
		$arr = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $cnt) {
				$c = $_g++;
				$fillStyle = $this->readFillStyle($ver);
				$arr->push($fillStyle);
				unset($fillStyle,$c);
			}
		}
		return $arr;
	}
	public function readShapeWithStyle($ver) {
		$fillStyles = $this->readFillStyles($ver);
		$lineStyles = $this->readLineStyles($ver);
		return _hx_anonymous(array("fillStyles" => $fillStyles, "lineStyles" => $lineStyles, "shapeRecords" => $this->readShapeRecords($ver)));
	}
	public function readShapeWithoutStyle($ver) {
		return _hx_anonymous(array("shapeRecords" => $this->readShapeRecords($ver)));
	}
	public function readShapeRecords($ver) {
		$this->bits->nbits = 0;
		$fillBits = $this->bits->readBits(4);
		$lineBits = $this->bits->readBits(4);
		$recs = new _hx_array(array());
		do {
			if($this->bits->read()) {
				if($this->bits->read()) {
					$nbits = $this->bits->readBits(4) + 2;
					$isGeneral = $this->bits->read();
					$isVertical = ((!$isGeneral) ? $this->bits->read() : false);
					$dx = (($isGeneral || !$isVertical) ? format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits) : 0);
					$dy = (($isGeneral || $isVertical) ? format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits) : 0);
					$recs->push(format_swf_ShapeRecord::SHREdge($dx, $dy));
				}
				else {
					$nbits2 = $this->bits->readBits(4) + 2;
					$cdx = format_swf_Tools::signExtend($this->bits->readBits($nbits2), $nbits2);
					$cdy = format_swf_Tools::signExtend($this->bits->readBits($nbits2), $nbits2);
					$adx = format_swf_Tools::signExtend($this->bits->readBits($nbits2), $nbits2);
					$ady = format_swf_Tools::signExtend($this->bits->readBits($nbits2), $nbits2);
					$recs->push(format_swf_ShapeRecord::SHRCurvedEdge($cdx, $cdy, $adx, $ady));
				}
			}
			else {
				$flags = $this->bits->readBits(5);
				if($flags === 0) {
					$recs->push(format_swf_ShapeRecord::$SHREnd);
					break;
				}
				else {
					$cdata = _hx_anonymous(array("moveTo" => null, "fillStyle0" => null, "fillStyle1" => null, "lineStyle" => null, "newStyles" => null));
					if(($flags & 1) !== 0) {
						$mbits = $this->bits->readBits(5);
						$dx2 = format_swf_Tools::signExtend($this->bits->readBits($mbits), $mbits);
						$dy2 = format_swf_Tools::signExtend($this->bits->readBits($mbits), $mbits);
						$cdata->moveTo = _hx_anonymous(array("dx" => $dx2, "dy" => $dy2));
					}
					if(($flags & 2) !== 0) {
						$cdata->fillStyle0 = _hx_anonymous(array("idx" => $this->bits->readBits($fillBits)));
					}
					if(($flags & 4) !== 0) {
						$cdata->fillStyle1 = _hx_anonymous(array("idx" => $this->bits->readBits($fillBits)));
					}
					if(($flags & 8) !== 0) {
						$cdata->lineStyle = _hx_anonymous(array("idx" => $this->bits->readBits($lineBits)));
					}
					if(($flags & 16) !== 0) {
						$fst = $this->readFillStyles($ver);
						$lst = $this->readLineStyles($ver);
						$this->bits->nbits = 0;
						$fillBits = $this->bits->readBits(4);
						$lineBits = $this->bits->readBits(4);
						$cdata->newStyles = _hx_anonymous(array("fillStyles" => $fst, "lineStyles" => $lst));
					}
					$recs->push(format_swf_ShapeRecord::SHRChange($cdata));
				}
			}
			unset($nbits2,$nbits,$mbits,$lst,$isVertical,$isGeneral,$fst,$flags,$dy2,$dy,$dx2,$dx,$cdy,$cdx,$cdata,$ady,$adx);
		} while(true);
		return $recs;
	}
	public function readClipEvents() {
		if($this->i->readUInt16() !== 0) {
			throw new HException($this->error("invalid clip events"));
		}
		$this->i->readUInt30();
		$a = new _hx_array(array());
		while(true) {
			$code = $this->i->readUInt30();
			if($code === 0) {
				break;
			}
			$data = $this->i->read($this->i->readUInt30());
			$a->push(_hx_anonymous(array("eventsFlags" => $code, "data" => $data)));
			unset($data,$code);
		}
		return $a;
	}
	public function readFilterFlags($top) {
		$flags = $this->i->readByte();
		return _hx_anonymous(array("inner" => ($flags & 128) !== 0, "knockout" => ($flags & 64) !== 0, "ontop" => ($top ? (($flags & 16) !== 0) : false), "passes" => $flags & (($top ? 15 : 31))));
	}
	public function readFilterGradient() {
		$ncolors = $this->i->readByte();
		$colors = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $ncolors) {
				$i = $_g++;
				$colors->push(_hx_anonymous(array("color" => $this->readRGBA(null), "position" => 0)));
				unset($i);
			}
		}
		{
			$_g2 = 0;
			while($_g2 < $colors->length) {
				$c = $colors[$_g2];
				++$_g2;
				$c->position = $this->i->readByte();
				unset($c);
			}
		}
		$data = _hx_anonymous(array("color" => null, "color2" => null, "blurX" => $this->i->readInt32(), "blurY" => $this->i->readInt32(), "angle" => $this->i->readInt32(), "distance" => $this->i->readInt32(), "strength" => eval("if(isset(\$this)) \$�this =& \$this;\$i2 = null;
			if(\$i2 === null) {
				\$i2 = \$�this->i;
			}
			\$�r = \$i2->readUInt16();
			return \$�r;
		"), "flags" => $this->readFilterFlags(true)));
		return _hx_anonymous(array("colors" => $colors, "data" => $data));
	}
	public function readFilter() {
		$n = $this->i->readByte();
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$n) {
			case 0:{
				\$�r = format_swf_Filter::FDropShadow(_hx_anonymous(array(\"color\" => \$�this->readRGBA(null), \"color2\" => null, \"blurX\" => \$�this->i->readInt32(), \"blurY\" => \$�this->i->readInt32(), \"angle\" => \$�this->i->readInt32(), \"distance\" => \$�this->i->readInt32(), \"strength\" => eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$i = null;
					if(\\\$i === null) {
						\\\$i = \\\$�this->i;
					}
					\\\$�r2 = \\\$i->readUInt16();
					return \\\$�r2;
				\"), \"flags\" => \$�this->readFilterFlags(false))));
			}break;
			case 1:{
				\$�r = format_swf_Filter::FBlur(_hx_anonymous(array(\"blurX\" => \$�this->i->readInt32(), \"blurY\" => \$�this->i->readInt32(), \"passes\" => \$�this->i->readByte() >> 3)));
			}break;
			case 2:{
				\$�r = format_swf_Filter::FGlow(_hx_anonymous(array(\"color\" => \$�this->readRGBA(null), \"color2\" => null, \"blurX\" => \$�this->i->readInt32(), \"blurY\" => \$�this->i->readInt32(), \"angle\" => 0, \"distance\" => 0, \"strength\" => eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$i2 = null;
					if(\\\$i2 === null) {
						\\\$i2 = \\\$�this->i;
					}
					\\\$�r3 = \\\$i2->readUInt16();
					return \\\$�r3;
				\"), \"flags\" => \$�this->readFilterFlags(false))));
			}break;
			case 3:{
				\$�r = format_swf_Filter::FBevel(_hx_anonymous(array(\"color\" => \$�this->readRGBA(null), \"color2\" => \$�this->readRGBA(null), \"blurX\" => \$�this->i->readInt32(), \"blurY\" => \$�this->i->readInt32(), \"angle\" => \$�this->i->readInt32(), \"distance\" => \$�this->i->readInt32(), \"strength\" => eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$i3 = null;
					if(\\\$i3 === null) {
						\\\$i3 = \\\$�this->i;
					}
					\\\$�r4 = \\\$i3->readUInt16();
					return \\\$�r4;
				\"), \"flags\" => \$�this->readFilterFlags(true))));
			}break;
			case 5:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(\\\"convolution filter not supported\\\"));
					return \\\$�r5;
				\");
			}break;
			case 4:{
				\$�r = format_swf_Filter::FGradientGlow(\$�this->readFilterGradient());
			}break;
			case 6:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$a = new _hx_array(array());
					{
						\\\$_g = 0;
						while(\\\$_g < 20) {
							\\\$n1 = \\\$_g++;
							\\\$a->push(\\\$�this->i->readFloat());
							unset(\\\$n1);
						}
					}
					\\\$�r6 = format_swf_Filter::FColorMatrix(\\\$a);
					return \\\$�r6;
				\");
			}break;
			case 7:{
				\$�r = format_swf_Filter::FGradientBevel(\$�this->readFilterGradient());
			}break;
			default:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(\\\"unknown filter\\\"));
					\\\$�r7 = null;
					return \\\$�r7;
				\");
			}break;
			}
			return \$�r;
		");
	}
	public function readFilters() {
		$filters = new _hx_array(array());
		{
			$_g1 = 0; $_g = $this->i->readByte();
			while($_g1 < $_g) {
				$i = $_g1++;
				$filters->push($this->readFilter());
				unset($i);
			}
		}
		return $filters;
	}
	public function error($msg) {
		if($msg === null) {
			$msg = "";
		}
		return "Invalid SWF: " . $msg;
	}
	public function readHeader() {
		$tag = $this->i->readString(3);
		$compressed = null;
		if($tag == "CWS") {
			$compressed = true;
		}
		else {
			if($tag == "FWS") {
				$compressed = false;
			}
			else {
				throw new HException($this->error("invalid file signature"));
			}
		}
		$this->version = $this->i->readByte();
		$size = $this->i->readUInt30();
		if($compressed) {
			$bytes = format_tools_Inflate::run($this->i->readAll(null));
			if($bytes->length + 8 !== $size) {
				throw new HException($this->error("wrong bytes length after decompression"));
			}
			$this->i = new haxe_io_BytesInput($bytes, null, null);
		}
		$this->bits = new format_tools_BitsInput($this->i);
		$r = $this->readRect();
		if($r->left !== 0 || $r->top !== 0 || $r->right % 20 !== 0 || $r->bottom % 20 !== 0) {
			throw new HException($this->error("invalid swf width or height"));
		}
		$this->i->readByte();
		$fps = $this->i->readByte();
		$nframes = $this->i->readUInt16();
		return _hx_anonymous(array("version" => $this->version, "compressed" => $compressed, "width" => intval($r->right / 20), "height" => intval($r->bottom / 20), "fps" => $fps, "nframes" => $nframes));
	}
	public function readTagList() {
		$a = new _hx_array(array());
		while(true) {
			$t = $this->readTag();
			if($t === null) {
				break;
			}
			$a->push($t);
			unset($t);
		}
		return $a;
	}
	public function readShape($len, $ver) {
		$id = $this->i->readUInt16();
		if($ver <= 3) {
			$bounds = $this->readRect();
			$sws = $this->readShapeWithStyle($ver);
			return format_swf_SWFTag::TShape($id, eval("if(isset(\$this)) \$�this =& \$this;switch(\$ver) {
				case 1:{
					\$�r = format_swf_ShapeData::SHDShape1(\$bounds, \$sws);
				}break;
				case 2:{
					\$�r = format_swf_ShapeData::SHDShape2(\$bounds, \$sws);
				}break;
				case 3:{
					\$�r = format_swf_ShapeData::SHDShape3(\$bounds, \$sws);
				}break;
				default:{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(\\\"invalid shape type\\\"));
						return \\\$�r2;
					\");
				}break;
				}
				return \$�r;
			"));
		}
		$shapeBounds = $this->readRect();
		$edgeBounds = $this->readRect();
		$this->bits->readBits(5);
		$useWinding = $this->bits->read();
		$useNonScalingStroke = $this->bits->read();
		$useScalingStroke = $this->bits->read();
		$shapes = $this->readShapeWithStyle($ver);
		return format_swf_SWFTag::TShape($id, format_swf_ShapeData::SHDShape4(_hx_anonymous(array("shapeBounds" => $shapeBounds, "edgeBounds" => $edgeBounds, "useWinding" => $useWinding, "useNonScalingStroke" => $useNonScalingStroke, "useScalingStroke" => $useScalingStroke, "shapes" => $shapes))));
	}
	public function readMorphGradient($ver) {
		$sr = $this->i->readByte();
		$sc = $this->readRGBA($this->i);
		$er = $this->i->readByte();
		$ec = $this->readRGBA($this->i);
		return _hx_anonymous(array("startRatio" => $sr, "startColor" => $sc, "endRatio" => $er, "endColor" => $ec));
	}
	public function readMorphGradients($ver) {
		$num = $this->i->readByte();
		if($num < 1 || $num > 8) {
			throw new HException("Invalid number of morph gradients (" . $num . "). Should be in range 1..8!");
		}
		$grads = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $num) {
				$i = $_g++;
				$grads->push($this->readMorphGradient($ver));
				unset($i);
			}
		}
		return $grads;
	}
	public function readMorphFillStyle($ver) {
		$type = $this->i->readByte();
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$type) {
			case 0:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$startColor = \\\$�this->readRGBA(\\\$�this->i);
					\\\$endColor = \\\$�this->readRGBA(\\\$�this->i);
					\\\$�r2 = format_swf_MorphFillStyle::MFSSolid(\\\$startColor, \\\$endColor);
					return \\\$�r2;
				\");
			}break;
			case 16:case 18:case 19:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$startMatrix = \\\$�this->readMatrix();
					\\\$endMatrix = \\\$�this->readMatrix();
					\\\$grads = \\\$�this->readMorphGradients(\\\$ver);
					\\\$�r3 = eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;switch(\\\\\$type) {
						case 16:{
							\\\\\$�r4 = format_swf_MorphFillStyle::MFSLinearGradient(\\\\\$startMatrix, \\\\\$endMatrix, \\\\\$grads);
						}break;
						case 18:{
							\\\\\$�r4 = format_swf_MorphFillStyle::MFSRadialGradient(\\\\\$startMatrix, \\\\\$endMatrix, \\\\\$grads);
						}break;
						default:{
							\\\\\$�r4 = eval(\\\\\"if(isset(\\\\\\\$this)) \\\\\\\$�this =& \\\\\\\$this;throw new HException(\\\\\\\$�this->error(\\\\\\\"invalid filltype in morphshape\\\\\\\"));
								return \\\\\\\$�r5;
							\\\\\");
						}break;
						}
						return \\\\\$�r4;
					\\\");
					return \\\$�r3;
				\");
			}break;
			case 64:case 65:case 66:case 67:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$cid = \\\$�this->i->readUInt16();
					\\\$startMatrix2 = \\\$�this->readMatrix();
					\\\$endMatrix2 = \\\$�this->readMatrix();
					\\\$isRepeat = (\\\$type === 64 || \\\$type === 66);
					\\\$isSmooth = (\\\$type === 64 || \\\$type === 65);
					\\\$�r6 = format_swf_MorphFillStyle::MFSBitmap(\\\$cid, \\\$startMatrix2, \\\$endMatrix2, \\\$isRepeat, \\\$isSmooth);
					return \\\$�r6;
				\");
			}break;
			default:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(null) . \\\" code \\\" . \\\$type);
					return \\\$�r7;
				\");
			}break;
			}
			return \$�r;
		");
	}
	public function readMorphFillStyles($ver) {
		$len = $this->i->readByte();
		if($len === 255) {
			$len = $this->i->readUInt16();
		}
		$fill_styles = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $len) {
				$i = $_g++;
				$fill_styles->push($this->readMorphFillStyle($ver));
				unset($i);
			}
		}
		return $fill_styles;
	}
	public function readMorph1LineStyle() {
		$sw = $this->i->readUInt16();
		$ew = $this->i->readUInt16();
		$sc = $this->readRGBA($this->i);
		$ec = $this->readRGBA($this->i);
		return _hx_anonymous(array("startWidth" => $sw, "endWidth" => $ew, "startColor" => $sc, "endColor" => $ec));
	}
	public function readMorph2LineStyle() {
		$startWidth = $this->i->readUInt16();
		$endWidth = $this->i->readUInt16();
		$this->bits->nbits = 0;
		$startCapStyle = $this->bits->readBits(2);
		$joinStyle = $this->bits->readBits(2);
		$hasFill = $this->bits->read();
		$noHScale = $this->bits->read();
		$noVScale = $this->bits->read();
		$pixelHinting = $this->bits->read();
		$this->bits->readBits(5);
		$noClose = $this->bits->read();
		$endCapStyle = $this->bits->readBits(2);
		$this->bits->nbits = 0;
		$morphData = _hx_anonymous(array("startWidth" => $startWidth, "endWidth" => $endWidth, "startCapStyle" => eval("if(isset(\$this)) \$�this =& \$this;switch(\$startCapStyle) {
			case 0:{
				\$�r = format_swf_LineCapStyle::\$LCRound;
			}break;
			case 1:{
				\$�r = format_swf_LineCapStyle::\$LCNone;
			}break;
			case 2:{
				\$�r = format_swf_LineCapStyle::\$LCSquare;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		"), "joinStyle" => eval("if(isset(\$this)) \$�this =& \$this;switch(\$joinStyle) {
			case 0:{
				\$�r2 = format_swf_LineJoinStyle::\$LJRound;
			}break;
			case 1:{
				\$�r2 = format_swf_LineJoinStyle::\$LJBevel;
			}break;
			case 2:{
				\$�r2 = format_swf_LineJoinStyle::LJMiter(eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$i = \\\$�this->i;
					if(\\\$i === null) {
						\\\$i = \\\$�this->i;
					}
					\\\$�r3 = \\\$i->readUInt16();
					return \\\$�r3;
				\"));
			}break;
			default:{
				\$�r2 = null;
			}break;
			}
			return \$�r2;
		"), "noHScale" => $noHScale, "noVScale" => $noVScale, "pixelHinting" => $pixelHinting, "noClose" => $noClose, "endCapStyle" => eval("if(isset(\$this)) \$�this =& \$this;switch(\$endCapStyle) {
			case 0:{
				\$�r4 = format_swf_LineCapStyle::\$LCRound;
			}break;
			case 1:{
				\$�r4 = format_swf_LineCapStyle::\$LCNone;
			}break;
			case 2:{
				\$�r4 = format_swf_LineCapStyle::\$LCSquare;
			}break;
			default:{
				\$�r4 = null;
			}break;
			}
			return \$�r4;
		")));
		if($hasFill) {
			return format_swf_Morph2LineStyle::M2LSFill($this->readMorphFillStyle(2), $morphData);
		}
		$startColor = $this->readRGBA($this->i);
		$endColor = $this->readRGBA($this->i);
		return format_swf_Morph2LineStyle::M2LSNoFill($startColor, $endColor, $morphData);
	}
	public function readMorph1LineStyles() {
		$len = $this->i->readByte();
		if($len === 255) {
			$len = $this->i->readUInt16();
		}
		$styles = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $len) {
				$i = $_g++;
				$styles->push($this->readMorph1LineStyle());
				unset($i);
			}
		}
		return $styles;
	}
	public function readMorph2LineStyles() {
		$len = $this->i->readByte();
		if($len === 255) {
			$len = $this->i->readUInt16();
		}
		$styles = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $len) {
				$i = $_g++;
				$styles->push($this->readMorph2LineStyle());
				unset($i);
			}
		}
		return $styles;
	}
	public function readMorphShape($ver) {
		$id = $this->i->readUInt16();
		$startBounds = $this->readRect();
		$endBounds = $this->readRect();
		switch($ver) {
		case 1:{
			$this->i->readUInt30();
			$fillStyles = $this->readMorphFillStyles($ver);
			$lineStyles = $this->readMorph1LineStyles();
			$startEdges = $this->readShapeWithoutStyle(3);
			$this->bits->nbits = 0;
			$endEdges = $this->readShapeWithoutStyle(3);
			return format_swf_SWFTag::TMorphShape($id, format_swf_MorphShapeData::MSDShape1(_hx_anonymous(array("startBounds" => $startBounds, "endBounds" => $endBounds, "fillStyles" => $fillStyles, "lineStyles" => $lineStyles, "startEdges" => $startEdges, "endEdges" => $endEdges))));
		}break;
		case 2:{
			$startEdgeBounds = $this->readRect();
			$endEdgeBounds = $this->readRect();
			$this->bits->nbits = 0;
			$this->bits->readBits(6);
			$useNonScalingStrokes = $this->bits->read();
			$useScalingStrokes = $this->bits->read();
			$this->bits->nbits = 0;
			$this->i->readUInt30();
			$fillStyles2 = $this->readMorphFillStyles($ver);
			$lineStyles2 = $this->readMorph2LineStyles();
			$startEdges2 = $this->readShapeWithoutStyle(4);
			$this->bits->nbits = 0;
			$endEdges2 = $this->readShapeWithoutStyle(4);
			return format_swf_SWFTag::TMorphShape($id, format_swf_MorphShapeData::MSDShape2(_hx_anonymous(array("startBounds" => $startBounds, "endBounds" => $endBounds, "startEdgeBounds" => $startEdgeBounds, "endEdgeBounds" => $endEdgeBounds, "useNonScalingStrokes" => $useNonScalingStrokes, "useScalingStrokes" => $useScalingStrokes, "fillStyles" => $fillStyles2, "lineStyles" => $lineStyles2, "startEdges" => $startEdges2, "endEdges" => $endEdges2))));
		}break;
		default:{
			throw new HException("Unsupported morph fill style version!");
		}break;
		}
	}
	public function readBlendMode() {
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$�this->i->readByte()) {
			case 0:case 1:{
				\$�r = format_swf_BlendMode::\$BNormal;
			}break;
			case 2:{
				\$�r = format_swf_BlendMode::\$BLayer;
			}break;
			case 3:{
				\$�r = format_swf_BlendMode::\$BMultiply;
			}break;
			case 4:{
				\$�r = format_swf_BlendMode::\$BScreen;
			}break;
			case 5:{
				\$�r = format_swf_BlendMode::\$BLighten;
			}break;
			case 6:{
				\$�r = format_swf_BlendMode::\$BDarken;
			}break;
			case 7:{
				\$�r = format_swf_BlendMode::\$BAdd;
			}break;
			case 8:{
				\$�r = format_swf_BlendMode::\$BSubtract;
			}break;
			case 9:{
				\$�r = format_swf_BlendMode::\$BDifference;
			}break;
			case 10:{
				\$�r = format_swf_BlendMode::\$BInvert;
			}break;
			case 11:{
				\$�r = format_swf_BlendMode::\$BAlpha;
			}break;
			case 12:{
				\$�r = format_swf_BlendMode::\$BErase;
			}break;
			case 13:{
				\$�r = format_swf_BlendMode::\$BOverlay;
			}break;
			case 14:{
				\$�r = format_swf_BlendMode::\$BHardLight;
			}break;
			default:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(\\\"invalid blend mode\\\"));
					return \\\$�r2;
				\");
			}break;
			}
			return \$�r;
		");
	}
	public function readPlaceObject($v3) {
		$f = $this->i->readByte();
		$f2 = ($v3 ? $this->i->readByte() : 0);
		if($f2 >> 3 !== 0) {
			throw new HException($this->error("unsupported bit flags in place object"));
		}
		$po = new format_swf_PlaceObject();
		$po->depth = $this->i->readUInt16();
		if(($f & 1) !== 0) {
			$po->move = true;
		}
		if(($f & 2) !== 0) {
			$po->cid = $this->i->readUInt16();
		}
		if(($f & 4) !== 0) {
			$po->matrix = $this->readMatrix();
		}
		if(($f & 8) !== 0) {
			$po->color = $this->readCXA();
		}
		if(($f & 16) !== 0) {
			$po->ratio = $this->i->readUInt16();
		}
		if(($f & 32) !== 0) {
			$po->instanceName = $this->readUTF8Bytes()->toString();
		}
		if(($f & 64) !== 0) {
			$po->clipDepth = $this->i->readUInt16();
		}
		if(($f2 & 1) !== 0) {
			$po->filters = $this->readFilters();
		}
		if(($f2 & 2) !== 0) {
			$po->blendMode = $this->readBlendMode();
		}
		if(($f2 & 4) !== 0) {
			$po->bitmapCache = true;
		}
		if(($f & 128) !== 0) {
			$po->events = $this->readClipEvents();
		}
		return $po;
	}
	public function readLossless($len, $v2) {
		$cid = $this->i->readUInt16();
		$bits = $this->i->readByte();
		return _hx_anonymous(array("cid" => $cid, "width" => $this->i->readUInt16(), "height" => $this->i->readUInt16(), "color" => eval("if(isset(\$this)) \$�this =& \$this;switch(\$bits) {
			case 3:{
				\$�r = format_swf_ColorModel::CM8Bits(\$�this->i->readByte());
			}break;
			case 4:{
				\$�r = format_swf_ColorModel::\$CM15Bits;
			}break;
			case 5:{
				\$�r = (\$v2 ? format_swf_ColorModel::\$CM32Bits : format_swf_ColorModel::\$CM24Bits);
			}break;
			default:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(\\\"invalid lossless bits\\\"));
					return \\\$�r2;
				\");
			}break;
			}
			return \$�r;
		"), "data" => $this->i->read($len - (($bits === 3 ? 8 : 7)))));
	}
	public function readSymbols() {
		$sl = new _hx_array(array());
		{
			$_g1 = 0; $_g = $this->i->readUInt16();
			while($_g1 < $_g) {
				$n = $_g1++;
				$sl->push(_hx_anonymous(array("cid" => $this->i->readUInt16(), "className" => $this->i->readUntil(0))));
				unset($n);
			}
		}
		return $sl;
	}
	public function readSound($len) {
		$sid = $this->i->readUInt16();
		$this->bits->nbits = 0;
		$soundFormat = eval("if(isset(\$this)) \$�this =& \$this;switch(\$�this->bits->readBits(4)) {
			case 0:{
				\$�r = format_swf_SoundFormat::\$SFNativeEndianUncompressed;
			}break;
			case 1:{
				\$�r = format_swf_SoundFormat::\$SFADPCM;
			}break;
			case 2:{
				\$�r = format_swf_SoundFormat::\$SFMP3;
			}break;
			case 3:{
				\$�r = format_swf_SoundFormat::\$SFLittleEndianUncompressed;
			}break;
			case 4:{
				\$�r = format_swf_SoundFormat::\$SFNellymoser16k;
			}break;
			case 5:{
				\$�r = format_swf_SoundFormat::\$SFNellymoser8k;
			}break;
			case 6:{
				\$�r = format_swf_SoundFormat::\$SFNellymoser;
			}break;
			case 11:{
				\$�r = format_swf_SoundFormat::\$SFSpeex;
			}break;
			default:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(\\\"invalid sound format\\\"));
					return \\\$�r2;
				\");
			}break;
			}
			return \$�r;
		");
		$soundRate = eval("if(isset(\$this)) \$�this =& \$this;switch(\$�this->bits->readBits(2)) {
			case 0:{
				\$�r3 = format_swf_SoundRate::\$SR5k;
			}break;
			case 1:{
				\$�r3 = format_swf_SoundRate::\$SR11k;
			}break;
			case 2:{
				\$�r3 = format_swf_SoundRate::\$SR22k;
			}break;
			case 3:{
				\$�r3 = format_swf_SoundRate::\$SR44k;
			}break;
			default:{
				\$�r3 = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$�this->error(\\\"invalid sound rate\\\"));
					return \\\$�r4;
				\");
			}break;
			}
			return \$�r3;
		");
		$is16bit = $this->bits->read();
		$isStereo = $this->bits->read();
		$soundSamples = $this->i->readInt32();
		$sdata = eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$soundFormat);
			switch(\$�t->index) {
			case 2:
			{
				\$�r5 = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$seek = \\\$�this->i->readInt16();
					\\\$�r6 = format_swf_SoundData::SDMp3(\\\$seek, \\\$�this->i->read(\\\$len - 9));
					return \\\$�r6;
				\");
			}break;
			case 3:
			{
				\$�r5 = format_swf_SoundData::SDRaw(\$�this->i->read(\$len - 7));
			}break;
			default:{
				\$�r5 = format_swf_SoundData::SDOther(\$�this->i->read(\$len - 7));
			}break;
			}
			return \$�r5;
		");
		return format_swf_SWFTag::TSound(_hx_anonymous(array("sid" => $sid, "format" => $soundFormat, "rate" => $soundRate, "is16bit" => $is16bit, "isStereo" => $isStereo, "samples" => $soundSamples, "data" => $sdata)));
	}
	public function readLanguage() {
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$�this->i->readByte()) {
			case 0:{
				\$�r = format_swf_LangCode::\$LCNone;
			}break;
			case 1:{
				\$�r = format_swf_LangCode::\$LCLatin;
			}break;
			case 2:{
				\$�r = format_swf_LangCode::\$LCJapanese;
			}break;
			case 3:{
				\$�r = format_swf_LangCode::\$LCKorean;
			}break;
			case 4:{
				\$�r = format_swf_LangCode::\$LCSimplifiedChinese;
			}break;
			case 5:{
				\$�r = format_swf_LangCode::\$LCTraditionalChinese;
			}break;
			default:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\"Unknown language code!\\\");
					return \\\$�r2;
				\");
			}break;
			}
			return \$�r;
		");
	}
	public function readGlyphs($len, $offsets) {
		$shape_data = $this->i->read($len);
		$glyphs = new _hx_array(array());
		if($offsets->length === 0) {
			return $glyphs;
		}
		{
			$_g = 0;
			while($_g < $offsets->length) {
				$offs = $offsets[$_g];
				++$_g;
				$old_i = $this->i;
				$old_bits = $this->bits;
				$this->i = new haxe_io_BytesInput($shape_data, $offs, null);
				$this->bits = new format_tools_BitsInput($this->i);
				$glyphs->push($this->readShapeWithoutStyle(1));
				$this->i = $old_i;
				$this->bits = $old_bits;
				unset($old_i,$old_bits,$offs);
			}
		}
		return $glyphs;
	}
	public function readKerningRecord($hasWideCodes) {
		return _hx_anonymous(array("charCode1" => ($hasWideCodes ? $this->i->readUInt16() : $this->i->readByte()), "charCode2" => ($hasWideCodes ? $this->i->readUInt16() : $this->i->readByte()), "adjust" => $this->i->readInt16()));
	}
	public function readFont1Data($len) {
		$offs1 = $this->i->readUInt16();
		$num_glyphs = $offs1 >> 1;
		$offset_table = new _hx_array(array());
		$offset_table->push(0);
		{
			$_g = 1;
			while($_g < $num_glyphs) {
				$j = $_g++;
				$offset_table->push($this->i->readUInt16() - $offs1);
				unset($j);
			}
		}
		return format_swf_FontData::FDFont1(_hx_anonymous(array("glyphs" => $this->readGlyphs($len - 2 - $num_glyphs * 2, $offset_table))));
	}
	public function readFont2Data($ver) {
		$this->bits->nbits = 0;
		$hasLayout = $this->bits->read();
		$shiftJIS = $this->bits->read();
		$isSmall = $this->bits->read();
		$isANSI = $this->bits->read();
		$hasWideOffsets = $this->bits->read();
		$hasWideCodes = $this->bits->read();
		$isItalic = $this->bits->read();
		$isBold = $this->bits->read();
		$language = $this->readLanguage();
		$name = $this->i->readString($this->i->readByte());
		$num_glyphs = $this->i->readUInt16();
		$offset_table = new _hx_array(array());
		$shape_data_length = 0;
		if($hasWideOffsets) {
			$first_glyph_offset = $num_glyphs * 4 + 4;
			{
				$_g = 0;
				while($_g < $num_glyphs) {
					$j = $_g++;
					$offset_table->push($this->i->readUInt30() - $first_glyph_offset);
					unset($j);
				}
			}
			$code_table_offset = $this->i->readUInt30();
			$shape_data_length = $code_table_offset - $first_glyph_offset;
		}
		else {
			$first_glyph_offset2 = $num_glyphs * 2 + 2;
			{
				$_g2 = 0;
				while($_g2 < $num_glyphs) {
					$j2 = $_g2++;
					$offs = $this->i->readUInt16();
					$offset_table->push($offs - $first_glyph_offset2);
					unset($offs,$j2);
				}
			}
			$code_table_offset2 = $this->i->readUInt16();
			$shape_data_length = $code_table_offset2 - $first_glyph_offset2;
		}
		$glyph_shapes = $this->readGlyphs($shape_data_length, $offset_table);
		$glyphs = new _hx_array(array());
		if($hasWideCodes) {
			{
				$_g3 = 0;
				while($_g3 < $num_glyphs) {
					$j3 = $_g3++;
					$glyphs->push(_hx_anonymous(array("charCode" => $this->i->readUInt16(), "shape" => $glyph_shapes[$j3])));
					unset($j3);
				}
			}
		}
		else {
			{
				$_g4 = 0;
				while($_g4 < $num_glyphs) {
					$j4 = $_g4++;
					$glyphs->push(_hx_anonymous(array("charCode" => $this->i->readByte(), "shape" => $glyph_shapes[$j4])));
					unset($j4);
				}
			}
		}
		$layout = null;
		if($hasLayout) {
			$ascent = $this->i->readInt16();
			$descent = $this->i->readInt16();
			$leading = $this->i->readInt16();
			$advance_table = new _hx_array(array());
			{
				$_g5 = 0;
				while($_g5 < $num_glyphs) {
					$j5 = $_g5++;
					$advance_table->push($this->i->readInt16());
					unset($j5);
				}
			}
			$glyph_layout = new _hx_array(array());
			{
				$_g6 = 0;
				while($_g6 < $num_glyphs) {
					$j6 = $_g6++;
					$bounds = $this->readRect();
					$glyph_layout->push(_hx_anonymous(array("advance" => $advance_table[$j6], "bounds" => $bounds)));
					unset($j6,$bounds);
				}
			}
			$num_kerning = $this->i->readUInt16();
			$kerning = new _hx_array(array());
			{
				$_g7 = 0;
				while($_g7 < $num_kerning) {
					$i = $_g7++;
					$kerning->push($this->readKerningRecord($hasWideCodes));
					unset($i);
				}
			}
			$layout = _hx_anonymous(array("ascent" => $ascent, "descent" => $descent, "leading" => $leading, "glyphs" => $glyph_layout, "kerning" => $kerning));
		}
		$f2data = _hx_anonymous(array("shiftJIS" => $shiftJIS, "isSmall" => $isSmall, "isANSI" => $isANSI, "isItalic" => $isItalic, "isBold" => $isBold, "language" => $language, "name" => $name, "glyphs" => $glyphs, "layout" => $layout));
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$ver) {
			case 2:{
				\$�r = format_swf_FontData::FDFont2(\$hasWideCodes, \$f2data);
			}break;
			case 3:{
				\$�r = format_swf_FontData::FDFont3(\$f2data);
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	public function readFont($len, $ver) {
		$cid = $this->i->readUInt16();
		return format_swf_SWFTag::TFont($cid, eval("if(isset(\$this)) \$�this =& \$this;switch(\$ver) {
			case 1:{
				\$�r = \$�this->readFont1Data(\$len);
			}break;
			case 2:{
				\$�r = \$�this->readFont2Data(\$ver);
			}break;
			case 3:{
				\$�r = \$�this->readFont2Data(\$ver);
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		"));
	}
	public function readFontInfo($len, $ver) {
		$cid = $this->i->readUInt16();
		$name = $this->i->readString($this->i->readByte());
		$this->bits->nbits = 0;
		$this->bits->readBits(2);
		$isSmall = $this->bits->read();
		$shiftJIS = $this->bits->read();
		$isANSI = $this->bits->read();
		$isItalic = $this->bits->read();
		$isBold = $this->bits->read();
		$hasWideCodes = $this->bits->read();
		$language = ($ver === 2 ? $this->readLanguage() : format_swf_LangCode::$LCNone);
		$num_glyphs = $len - 4 - strlen($name);
		$code_table = new _hx_array(array());
		if($hasWideCodes) {
			$num_glyphs >>= 1;
			{
				$_g = 0;
				while($_g < $num_glyphs) {
					$j = $_g++;
					$code_table->push($this->i->readUInt16());
					unset($j);
				}
			}
		}
		else {
			{
				$_g2 = 0;
				while($_g2 < $num_glyphs) {
					$j2 = $_g2++;
					$code_table->push($this->i->readByte());
					unset($j2);
				}
			}
		}
		$fi_data = _hx_anonymous(array("name" => $name, "isSmall" => $isSmall, "isItalic" => $isItalic, "isBold" => $isBold, "codeTable" => $code_table));
		return format_swf_SWFTag::TFontInfo($cid, eval("if(isset(\$this)) \$�this =& \$this;switch(\$ver) {
			case 1:{
				\$�r = format_swf_FontInfoData::FIDFont1(\$shiftJIS, \$isANSI, \$hasWideCodes, \$fi_data);
			}break;
			case 2:{
				\$�r = format_swf_FontInfoData::FIDFont2(\$language, \$fi_data);
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		"));
	}
	public function readSoundInfo() {
		$this->bits->nbits = 0;
		$this->bits->readBits(2);
		$syncStop = ($this->bits->readBits(1) === 1 ? true : false);
		$syncNoMultiple = $this->bits->readBits(1);
		$hasEnvelope = $this->bits->readBits(1);
		$hasLoops = ($this->bits->readBits(1) === 1 ? true : false);
		$hasOutPoint = $this->bits->readBits(1);
		$hasInPoint = $this->bits->readBits(1);
		$inPoint = null;
		$outPoint = null;
		$loopCount = null;
		$envPoints = null;
		$envelopeRecords = null;
		if($hasInPoint === 1) {
			$inPoint = $this->i->readUInt30();
		}
		if($hasOutPoint === 1) {
			$outPoint = $this->i->readUInt30();
		}
		if($hasLoops) {
			$loopCount = $this->i->readUInt16();
		}
		if($hasEnvelope === 1) {
			$envPoints = $this->i->readByte();
			$envelopeRecords = $this->readEnvelopeRecords($envPoints);
		}
		return _hx_anonymous(array("syncStop" => $syncStop, "hasLoops" => $hasLoops, "loopCount" => ($hasLoops ? $loopCount : null)));
	}
	public function readEnvelopeRecords($count) {
		$envelopeRecords = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $count) {
				$env = $_g++;
				$envelopeRecords->push(_hx_anonymous(array("pos44" => $this->i->readUInt30(), "leftLevel" => $this->i->readUInt16(), "rightLevel" => $this->i->readUInt16())));
				unset($env);
			}
		}
		return $envelopeRecords;
	}
	public function readFileAttributes() {
		$this->bits->nbits = 0;
		$this->bits->readBits(1);
		$useDirectBlit = ($this->bits->readBits(1) === 1 ? true : false);
		$useGPU = ($this->bits->readBits(1) === 1 ? true : false);
		$hasMetaData = ($this->bits->readBits(1) === 1 ? true : false);
		$actionscript3 = ($this->bits->readBits(1) === 1 ? true : false);
		$this->bits->readBits(2);
		$useNetWork = ($this->bits->readBits(1) === 1 ? true : false);
		$this->bits->readBits(24);
		return _hx_anonymous(array("useDirectBlit" => $useDirectBlit, "useGPU" => $useGPU, "hasMetaData" => $hasMetaData, "actionscript3" => $actionscript3, "useNetWork" => $useNetWork));
	}
	public function readTag() {
		$h = $this->i->readUInt16();
		$id = $h >> 6;
		$len = $h & 63;
		$ext = false;
		if($len === 63) {
			$len = $this->i->readUInt30();
			if($len < 63) {
				$ext = true;
			}
		}
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$id) {
			case 0:{
				\$�r = null;
			}break;
			case 1:{
				\$�r = format_swf_SWFTag::\$TShowFrame;
			}break;
			case 2:{
				\$�r = \$�this->readShape(\$len, 1);
			}break;
			case 22:{
				\$�r = \$�this->readShape(\$len, 2);
			}break;
			case 32:{
				\$�r = \$�this->readShape(\$len, 3);
			}break;
			case 83:{
				\$�r = \$�this->readShape(\$len, 4);
			}break;
			case 46:{
				\$�r = \$�this->readMorphShape(1);
			}break;
			case 84:{
				\$�r = \$�this->readMorphShape(2);
			}break;
			case 10:{
				\$�r = \$�this->readFont(\$len, 1);
			}break;
			case 48:{
				\$�r = \$�this->readFont(\$len, 2);
			}break;
			case 75:{
				\$�r = \$�this->readFont(\$len, 3);
			}break;
			case 13:{
				\$�r = \$�this->readFontInfo(\$len, 1);
			}break;
			case 62:{
				\$�r = \$�this->readFontInfo(\$len, 2);
			}break;
			case 9:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$�this->i->setEndian(true);
					\\\$color = \\\$�this->i->readUInt24();
					\\\$�this->i->setEndian(false);
					\\\$�r2 = format_swf_SWFTag::TBackgroundColor(\\\$color);
					return \\\$�r2;
				\");
			}break;
			case 20:{
				\$�r = format_swf_SWFTag::TBitsLossless(\$�this->readLossless(\$len, false));
			}break;
			case 36:{
				\$�r = format_swf_SWFTag::TBitsLossless2(\$�this->readLossless(\$len, true));
			}break;
			case 8:{
				\$�r = format_swf_SWFTag::TJPEGTables(\$�this->i->read(\$len));
			}break;
			case 6:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$cid = \\\$�this->i->readUInt16();
					\\\$�r3 = format_swf_SWFTag::TBitsJPEG(\\\$cid, format_swf_JPEGData::JDJPEG1(\\\$�this->i->read(\\\$len - 2)));
					return \\\$�r3;
				\");
			}break;
			case 21:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$cid2 = \\\$�this->i->readUInt16();
					\\\$�r4 = format_swf_SWFTag::TBitsJPEG(\\\$cid2, format_swf_JPEGData::JDJPEG2(\\\$�this->i->read(\\\$len - 2)));
					return \\\$�r4;
				\");
			}break;
			case 35:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$cid3 = \\\$�this->i->readUInt16();
					\\\$dataSize = \\\$�this->i->readUInt30();
					\\\$data = \\\$�this->i->read(\\\$dataSize);
					\\\$mask = \\\$�this->i->read(\\\$len - \\\$dataSize - 6);
					\\\$�r5 = format_swf_SWFTag::TBitsJPEG(\\\$cid3, format_swf_JPEGData::JDJPEG3(\\\$data, \\\$mask));
					return \\\$�r5;
				\");
			}break;
			case 26:{
				\$�r = format_swf_SWFTag::TPlaceObject2(\$�this->readPlaceObject(false));
			}break;
			case 70:{
				\$�r = format_swf_SWFTag::TPlaceObject3(\$�this->readPlaceObject(true));
			}break;
			case 28:{
				\$�r = format_swf_SWFTag::TRemoveObject2(\$�this->i->readUInt16());
			}break;
			case 39:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$cid4 = \\\$�this->i->readUInt16();
					\\\$fcount = \\\$�this->i->readUInt16();
					\\\$tags = \\\$�this->readTagList();
					\\\$�r6 = format_swf_SWFTag::TClip(\\\$cid4, \\\$fcount, \\\$tags);
					return \\\$�r6;
				\");
			}break;
			case 43:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$label = \\\$�this->readUTF8Bytes();
					\\\$anchor = (\\\$len === \\\$label->length + 2 ? \\\$�this->i->readByte() === 1 : false);
					\\\$�r7 = format_swf_SWFTag::TFrameLabel(\\\$label->toString(), \\\$anchor);
					return \\\$�r7;
				\");
			}break;
			case 59:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$cid5 = \\\$�this->i->readUInt16();
					\\\$�r8 = format_swf_SWFTag::TDoInitActions(\\\$cid5, \\\$�this->i->read(\\\$len - 2));
					return \\\$�r8;
				\");
			}break;
			case 69:{
				\$�r = format_swf_SWFTag::TSandBox(\$�this->readFileAttributes());
			}break;
			case 72:{
				\$�r = format_swf_SWFTag::TActionScript3(\$�this->i->read(\$len), null);
			}break;
			case 76:{
				\$�r = format_swf_SWFTag::TSymbolClass(\$�this->readSymbols());
			}break;
			case 56:{
				\$�r = format_swf_SWFTag::TExportAssets(\$�this->readSymbols());
			}break;
			case 82:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$infos = _hx_anonymous(array(\\\"id\\\" => \\\$�this->i->readUInt30(), \\\"label\\\" => \\\$�this->i->readUntil(0)));
					\\\$len -= 4 + strlen(\\\$infos->label) + 1;
					\\\$�r9 = format_swf_SWFTag::TActionScript3(\\\$�this->i->read(\\\$len), \\\$infos);
					return \\\$�r9;
				\");
			}break;
			case 87:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$id1 = \\\$�this->i->readUInt16();
					if(\\\$�this->i->readUInt30() !== 0) {
						throw new HException(\\\$�this->error(\\\"invalid binary data tag\\\"));
					}
					\\\$�r10 = format_swf_SWFTag::TBinaryData(\\\$id1, \\\$�this->i->read(\\\$len - 6));
					return \\\$�r10;
				\");
			}break;
			case 14:{
				\$�r = \$�this->readSound(\$len);
			}break;
			case 12:{
				\$�r = format_swf_SWFTag::TDoAction(\$�this->i->read(\$len));
			}break;
			case 65:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$maxRecursion = \\\$�this->i->readUInt16();
					\\\$timeoutSeconds = \\\$�this->i->readUInt16();
					\\\$�r11 = format_swf_SWFTag::TScriptLimits(\\\$maxRecursion, \\\$timeoutSeconds);
					return \\\$�r11;
				\");
			}break;
			case 15:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$id12 = \\\$�this->i->readUInt16();
					\\\$�r12 = format_swf_SWFTag::TStartSound(\\\$id12, \\\$�this->readSoundInfo());
					return \\\$�r12;
				\");
			}break;
			case 34:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$cid6 = \\\$�this->i->readUInt16();
					\\\$data2 = \\\$�this->i->read(\\\$len - 2);
					\\\$�r13 = format_swf_SWFTag::TUnknown(\\\$id, \\\$data2);
					return \\\$�r13;
				\");
			}break;
			case 37:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$cid7 = \\\$�this->i->readUInt16();
					\\\$data3 = \\\$�this->i->read(\\\$len - 2);
					\\\$�r14 = format_swf_SWFTag::TUnknown(\\\$id, \\\$data3);
					return \\\$�r14;
				\");
			}break;
			case 77:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$data4 = \\\$�this->i->readString(\\\$len);
					\\\$�r15 = format_swf_SWFTag::TMetadata(\\\$data4);
					return \\\$�r15;
				\");
			}break;
			case 78:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$id13 = \\\$�this->i->readUInt16();
					\\\$splitter = \\\$�this->readRect();
					\\\$�r16 = format_swf_SWFTag::TDefineScalingGrid(\\\$id13, \\\$splitter);
					return \\\$�r16;
				\");
			}break;
			default:{
				\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$data5 = \\\$�this->i->read(\\\$len);
					\\\$�r17 = format_swf_SWFTag::TUnknown(\\\$id, \\\$data5);
					return \\\$�r17;
				\");
			}break;
			}
			return \$�r;
		");
	}
	public function read() {
		return _hx_anonymous(array("header" => $this->readHeader(), "tags" => $this->readTagList()));
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->�dynamics[$m]) && is_callable($this->�dynamics[$m]))
			return call_user_func_array($this->�dynamics[$m], $a);
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	function __toString() { return 'format.swf.Reader'; }
}
