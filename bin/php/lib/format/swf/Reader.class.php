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
			$_x = eval("if(isset(\$this)) \$퍁his =& \$this;\$i = \$퍁his->bits->readBits(\$nbits);
				\$i = format_swf_Tools::signExtend(\$i, \$nbits);
				\$팿 = (\$i >> 16) + (\$i & 65535) / 65536.0;
				return \$팿;
			");
			$_y = eval("if(isset(\$this)) \$퍁his =& \$this;\$i2 = \$퍁his->bits->readBits(\$nbits);
				\$i2 = format_swf_Tools::signExtend(\$i2, \$nbits);
				\$팿2 = (\$i2 >> 16) + (\$i2 & 65535) / 65536.0;
				return \$팿2;
			");
			$scale = _hx_anonymous(array("x" => $_x, "y" => $_y));
		}
		$rotate = null;
		if($this->bits->read()) {
			$nbits2 = $this->bits->readBits(5);
			$_rs0 = eval("if(isset(\$this)) \$퍁his =& \$this;\$i3 = \$퍁his->bits->readBits(\$nbits2);
				\$i3 = format_swf_Tools::signExtend(\$i3, \$nbits2);
				\$팿3 = (\$i3 >> 16) + (\$i3 & 65535) / 65536.0;
				return \$팿3;
			");
			$_rs1 = eval("if(isset(\$this)) \$퍁his =& \$this;\$i4 = \$퍁his->bits->readBits(\$nbits2);
				\$i4 = format_swf_Tools::signExtend(\$i4, \$nbits2);
				\$팿4 = (\$i4 >> 16) + (\$i4 & 65535) / 65536.0;
				return \$팿4;
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
		$spread = eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$퍁his->bits->readBits(2)) {
			case 0:{
				\$팿 = format_swf_SpreadMode::\$SMPad;
			}break;
			case 1:{
				\$팿 = format_swf_SpreadMode::\$SMReflect;
			}break;
			case 2:{
				\$팿 = format_swf_SpreadMode::\$SMRepeat;
			}break;
			case 3:{
				\$팿 = format_swf_SpreadMode::\$SMReserved;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
		$interp = eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$퍁his->bits->readBits(2)) {
			case 0:{
				\$팿2 = format_swf_InterpolationMode::\$IMNormalRGB;
			}break;
			case 1:{
				\$팿2 = format_swf_InterpolationMode::\$IMLinearRGB;
			}break;
			case 2:{
				\$팿2 = format_swf_InterpolationMode::\$IMReserved1;
			}break;
			case 3:{
				\$팿2 = format_swf_InterpolationMode::\$IMReserved2;
			}break;
			default:{
				\$팿2 = null;
			}break;
			}
			return \$팿2;
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
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$t) {
			case 0:{
				\$팿 = format_swf_LineCapStyle::\$LCRound;
			}break;
			case 1:{
				\$팿 = format_swf_LineCapStyle::\$LCNone;
			}break;
			case 2:{
				\$팿 = format_swf_LineCapStyle::\$LCSquare;
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(\\\"invalid lineCap\\\"));
					return \\\$팿2;
				\");
			}break;
			}
			return \$팿;
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
				$arr->push(_hx_anonymous(array("width" => $width, "data" => ($ver <= 2 ? format_swf_LineStyleData::LSRGB($this->readRGB($this->i)) : ($ver === 3 ? format_swf_LineStyleData::LSRGBA($this->readRGBA($this->i)) : ($ver === 4 ? eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁his->bits->nbits = 0;
					\$startCap = \$퍁his->getLineCap(\$퍁his->bits->readBits(2));
					\$_join = \$퍁his->bits->readBits(2);
					\$_fill = \$퍁his->bits->read();
					\$noHScale = \$퍁his->bits->read();
					\$noVScale = \$퍁his->bits->read();
					\$pixelHinting = \$퍁his->bits->read();
					if(\$퍁his->bits->readBits(5) !== 0) {
						throw new HException(\$퍁his->error(\"invalid nbits in line style\"));
					}
					\$noClose = \$퍁his->bits->read();
					\$endCap = \$퍁his->getLineCap(\$퍁his->bits->readBits(2));
					\$join = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;switch(\\\$_join) {
						case 0:{
							\\\$팿2 = format_swf_LineJoinStyle::\\\$LJRound;
						}break;
						case 1:{
							\\\$팿2 = format_swf_LineJoinStyle::\\\$LJBevel;
						}break;
						case 2:{
							\\\$팿2 = format_swf_LineJoinStyle::LJMiter(eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;\\\\\$i = null;
								if(\\\\\$i === null) {
									\\\\\$i = \\\\\$퍁his->i;
								}
								\\\\\$팿3 = \\\\\$i->readUInt16();
								return \\\\\$팿3;
							\\\"));
						}break;
						default:{
							\\\$팿2 = eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;throw new HException(\\\\\$퍁his->error(\\\\\"invalid joint style in line style\\\\\"));
								return \\\\\$팿4;
							\\\");
						}break;
						}
						return \\\$팿2;
					\");
					\$fill = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;switch(\\\$_fill) {
						case false:{
							\\\$팿5 = format_swf_LS2Fill::LS2FColor(\\\$퍁his->readRGBA(\\\$퍁his->i));
						}break;
						case true:{
							\\\$팿5 = format_swf_LS2Fill::LS2FStyle(\\\$퍁his->readFillStyle(\\\$ver));
						}break;
						default:{
							\\\$팿5 = null;
						}break;
						}
						return \\\$팿5;
					\");
					\$팿 = format_swf_LineStyleData::LS2(_hx_anonymous(array(\"startCap\" => \$startCap, \"join\" => \$join, \"fill\" => \$fill, \"noHScale\" => \$noHScale, \"noVScale\" => \$noVScale, \"pixelHinting\" => \$pixelHinting, \"noClose\" => \$noClose, \"endCap\" => \$endCap)));
					return \$팿;
				") : eval("if(isset(\$this)) \$퍁his =& \$this;throw new HException(\$퍁his->error(\"invalid line style version\"));
					return \$팿6;
				")))))));
				unset($팿6,$팿5,$팿4,$팿3,$팿2,$팿,$width,$startCap,$pixelHinting,$noVScale,$noHScale,$noClose,$join,$i,$fill,$endCap,$c,$_join,$_fill);
			}
		}
		return $arr;
	}
	public function readFillStyle($ver) {
		$type = $this->i->readByte();
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$type) {
			case 0:{
				\$팿 = ((\$ver <= 2) ? format_swf_FillStyle::FSSolid(\$퍁his->readRGB(\$퍁his->i)) : format_swf_FillStyle::FSSolidAlpha(\$퍁his->readRGBA(\$퍁his->i)));
			}break;
			case 16:case 18:case 19:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$mat = \\\$퍁his->readMatrix();
					\\\$grad = \\\$퍁his->readGradient(\\\$ver);
					\\\$팿2 = eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;switch(\\\\\$type) {
						case 19:{
							\\\\\$팿3 = format_swf_FillStyle::FSFocalGradient(\\\\\$mat, _hx_anonymous(array(\\\\\"focalPoint\\\\\" => eval(\\\\\"if(isset(\\\\\\\$this)) \\\\\\\$퍁his =& \\\\\\\$this;\\\\\\\$i = \\\\\\\$퍁his->i;
								if(\\\\\\\$i === null) {
									\\\\\\\$i = \\\\\\\$퍁his->i;
								}
								\\\\\\\$팿4 = \\\\\\\$i->readUInt16();
								return \\\\\\\$팿4;
							\\\\\"), \\\\\"data\\\\\" => \\\\\$grad)));
						}break;
						case 16:{
							\\\\\$팿3 = format_swf_FillStyle::FSLinearGradient(\\\\\$mat, \\\\\$grad);
						}break;
						case 18:{
							\\\\\$팿3 = format_swf_FillStyle::FSRadialGradient(\\\\\$mat, \\\\\$grad);
						}break;
						default:{
							\\\\\$팿3 = eval(\\\\\"if(isset(\\\\\\\$this)) \\\\\\\$퍁his =& \\\\\\\$this;throw new HException(\\\\\\\$퍁his->error(\\\\\\\"invalid fill style type\\\\\\\"));
								return \\\\\\\$팿5;
							\\\\\");
						}break;
						}
						return \\\\\$팿3;
					\\\");
					return \\\$팿2;
				\");
			}break;
			case 64:case 65:case 66:case 67:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$cid = \\\$퍁his->i->readUInt16();
					\\\$mat2 = \\\$퍁his->readMatrix();
					\\\$isRepeat = (\\\$type === 64 || \\\$type === 66);
					\\\$isSmooth = (\\\$type === 64 || \\\$type === 65);
					\\\$팿6 = format_swf_FillStyle::FSBitmap(\\\$cid, \\\$mat2, \\\$isRepeat, \\\$isSmooth);
					return \\\$팿6;
				\");
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(null) . \\\" code \\\" . \\\$type);
					return \\\$팿7;
				\");
			}break;
			}
			return \$팿;
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
		$data = _hx_anonymous(array("color" => null, "color2" => null, "blurX" => $this->i->readInt32(), "blurY" => $this->i->readInt32(), "angle" => $this->i->readInt32(), "distance" => $this->i->readInt32(), "strength" => eval("if(isset(\$this)) \$퍁his =& \$this;\$i2 = null;
			if(\$i2 === null) {
				\$i2 = \$퍁his->i;
			}
			\$팿 = \$i2->readUInt16();
			return \$팿;
		"), "flags" => $this->readFilterFlags(true)));
		return _hx_anonymous(array("colors" => $colors, "data" => $data));
	}
	public function readFilter() {
		$n = $this->i->readByte();
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$n) {
			case 0:{
				\$팿 = format_swf_Filter::FDropShadow(_hx_anonymous(array(\"color\" => \$퍁his->readRGBA(null), \"color2\" => null, \"blurX\" => \$퍁his->i->readInt32(), \"blurY\" => \$퍁his->i->readInt32(), \"angle\" => \$퍁his->i->readInt32(), \"distance\" => \$퍁his->i->readInt32(), \"strength\" => eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$i = null;
					if(\\\$i === null) {
						\\\$i = \\\$퍁his->i;
					}
					\\\$팿2 = \\\$i->readUInt16();
					return \\\$팿2;
				\"), \"flags\" => \$퍁his->readFilterFlags(false))));
			}break;
			case 1:{
				\$팿 = format_swf_Filter::FBlur(_hx_anonymous(array(\"blurX\" => \$퍁his->i->readInt32(), \"blurY\" => \$퍁his->i->readInt32(), \"passes\" => \$퍁his->i->readByte() >> 3)));
			}break;
			case 2:{
				\$팿 = format_swf_Filter::FGlow(_hx_anonymous(array(\"color\" => \$퍁his->readRGBA(null), \"color2\" => null, \"blurX\" => \$퍁his->i->readInt32(), \"blurY\" => \$퍁his->i->readInt32(), \"angle\" => 0, \"distance\" => 0, \"strength\" => eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$i2 = null;
					if(\\\$i2 === null) {
						\\\$i2 = \\\$퍁his->i;
					}
					\\\$팿3 = \\\$i2->readUInt16();
					return \\\$팿3;
				\"), \"flags\" => \$퍁his->readFilterFlags(false))));
			}break;
			case 3:{
				\$팿 = format_swf_Filter::FBevel(_hx_anonymous(array(\"color\" => \$퍁his->readRGBA(null), \"color2\" => \$퍁his->readRGBA(null), \"blurX\" => \$퍁his->i->readInt32(), \"blurY\" => \$퍁his->i->readInt32(), \"angle\" => \$퍁his->i->readInt32(), \"distance\" => \$퍁his->i->readInt32(), \"strength\" => eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$i3 = null;
					if(\\\$i3 === null) {
						\\\$i3 = \\\$퍁his->i;
					}
					\\\$팿4 = \\\$i3->readUInt16();
					return \\\$팿4;
				\"), \"flags\" => \$퍁his->readFilterFlags(true))));
			}break;
			case 5:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(\\\"convolution filter not supported\\\"));
					return \\\$팿5;
				\");
			}break;
			case 4:{
				\$팿 = format_swf_Filter::FGradientGlow(\$퍁his->readFilterGradient());
			}break;
			case 6:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$a = new _hx_array(array());
					{
						\\\$_g = 0;
						while(\\\$_g < 20) {
							\\\$n1 = \\\$_g++;
							\\\$a->push(\\\$퍁his->i->readFloat());
							unset(\\\$n1);
						}
					}
					\\\$팿6 = format_swf_Filter::FColorMatrix(\\\$a);
					return \\\$팿6;
				\");
			}break;
			case 7:{
				\$팿 = format_swf_Filter::FGradientBevel(\$퍁his->readFilterGradient());
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(\\\"unknown filter\\\"));
					\\\$팿7 = null;
					return \\\$팿7;
				\");
			}break;
			}
			return \$팿;
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
			return format_swf_SWFTag::TShape($id, eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$ver) {
				case 1:{
					\$팿 = format_swf_ShapeData::SHDShape1(\$bounds, \$sws);
				}break;
				case 2:{
					\$팿 = format_swf_ShapeData::SHDShape2(\$bounds, \$sws);
				}break;
				case 3:{
					\$팿 = format_swf_ShapeData::SHDShape3(\$bounds, \$sws);
				}break;
				default:{
					\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(\\\"invalid shape type\\\"));
						return \\\$팿2;
					\");
				}break;
				}
				return \$팿;
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
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$type) {
			case 0:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$startColor = \\\$퍁his->readRGBA(\\\$퍁his->i);
					\\\$endColor = \\\$퍁his->readRGBA(\\\$퍁his->i);
					\\\$팿2 = format_swf_MorphFillStyle::MFSSolid(\\\$startColor, \\\$endColor);
					return \\\$팿2;
				\");
			}break;
			case 16:case 18:case 19:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$startMatrix = \\\$퍁his->readMatrix();
					\\\$endMatrix = \\\$퍁his->readMatrix();
					\\\$grads = \\\$퍁his->readMorphGradients(\\\$ver);
					\\\$팿3 = eval(\\\"if(isset(\\\\\$this)) \\\\\$퍁his =& \\\\\$this;switch(\\\\\$type) {
						case 16:{
							\\\\\$팿4 = format_swf_MorphFillStyle::MFSLinearGradient(\\\\\$startMatrix, \\\\\$endMatrix, \\\\\$grads);
						}break;
						case 18:{
							\\\\\$팿4 = format_swf_MorphFillStyle::MFSRadialGradient(\\\\\$startMatrix, \\\\\$endMatrix, \\\\\$grads);
						}break;
						default:{
							\\\\\$팿4 = eval(\\\\\"if(isset(\\\\\\\$this)) \\\\\\\$퍁his =& \\\\\\\$this;throw new HException(\\\\\\\$퍁his->error(\\\\\\\"invalid filltype in morphshape\\\\\\\"));
								return \\\\\\\$팿5;
							\\\\\");
						}break;
						}
						return \\\\\$팿4;
					\\\");
					return \\\$팿3;
				\");
			}break;
			case 64:case 65:case 66:case 67:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$cid = \\\$퍁his->i->readUInt16();
					\\\$startMatrix2 = \\\$퍁his->readMatrix();
					\\\$endMatrix2 = \\\$퍁his->readMatrix();
					\\\$isRepeat = (\\\$type === 64 || \\\$type === 66);
					\\\$isSmooth = (\\\$type === 64 || \\\$type === 65);
					\\\$팿6 = format_swf_MorphFillStyle::MFSBitmap(\\\$cid, \\\$startMatrix2, \\\$endMatrix2, \\\$isRepeat, \\\$isSmooth);
					return \\\$팿6;
				\");
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(null) . \\\" code \\\" . \\\$type);
					return \\\$팿7;
				\");
			}break;
			}
			return \$팿;
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
		$morphData = _hx_anonymous(array("startWidth" => $startWidth, "endWidth" => $endWidth, "startCapStyle" => eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$startCapStyle) {
			case 0:{
				\$팿 = format_swf_LineCapStyle::\$LCRound;
			}break;
			case 1:{
				\$팿 = format_swf_LineCapStyle::\$LCNone;
			}break;
			case 2:{
				\$팿 = format_swf_LineCapStyle::\$LCSquare;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		"), "joinStyle" => eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$joinStyle) {
			case 0:{
				\$팿2 = format_swf_LineJoinStyle::\$LJRound;
			}break;
			case 1:{
				\$팿2 = format_swf_LineJoinStyle::\$LJBevel;
			}break;
			case 2:{
				\$팿2 = format_swf_LineJoinStyle::LJMiter(eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$i = \\\$퍁his->i;
					if(\\\$i === null) {
						\\\$i = \\\$퍁his->i;
					}
					\\\$팿3 = \\\$i->readUInt16();
					return \\\$팿3;
				\"));
			}break;
			default:{
				\$팿2 = null;
			}break;
			}
			return \$팿2;
		"), "noHScale" => $noHScale, "noVScale" => $noVScale, "pixelHinting" => $pixelHinting, "noClose" => $noClose, "endCapStyle" => eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$endCapStyle) {
			case 0:{
				\$팿4 = format_swf_LineCapStyle::\$LCRound;
			}break;
			case 1:{
				\$팿4 = format_swf_LineCapStyle::\$LCNone;
			}break;
			case 2:{
				\$팿4 = format_swf_LineCapStyle::\$LCSquare;
			}break;
			default:{
				\$팿4 = null;
			}break;
			}
			return \$팿4;
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
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$퍁his->i->readByte()) {
			case 0:case 1:{
				\$팿 = format_swf_BlendMode::\$BNormal;
			}break;
			case 2:{
				\$팿 = format_swf_BlendMode::\$BLayer;
			}break;
			case 3:{
				\$팿 = format_swf_BlendMode::\$BMultiply;
			}break;
			case 4:{
				\$팿 = format_swf_BlendMode::\$BScreen;
			}break;
			case 5:{
				\$팿 = format_swf_BlendMode::\$BLighten;
			}break;
			case 6:{
				\$팿 = format_swf_BlendMode::\$BDarken;
			}break;
			case 7:{
				\$팿 = format_swf_BlendMode::\$BAdd;
			}break;
			case 8:{
				\$팿 = format_swf_BlendMode::\$BSubtract;
			}break;
			case 9:{
				\$팿 = format_swf_BlendMode::\$BDifference;
			}break;
			case 10:{
				\$팿 = format_swf_BlendMode::\$BInvert;
			}break;
			case 11:{
				\$팿 = format_swf_BlendMode::\$BAlpha;
			}break;
			case 12:{
				\$팿 = format_swf_BlendMode::\$BErase;
			}break;
			case 13:{
				\$팿 = format_swf_BlendMode::\$BOverlay;
			}break;
			case 14:{
				\$팿 = format_swf_BlendMode::\$BHardLight;
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(\\\"invalid blend mode\\\"));
					return \\\$팿2;
				\");
			}break;
			}
			return \$팿;
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
		return _hx_anonymous(array("cid" => $cid, "width" => $this->i->readUInt16(), "height" => $this->i->readUInt16(), "color" => eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$bits) {
			case 3:{
				\$팿 = format_swf_ColorModel::CM8Bits(\$퍁his->i->readByte());
			}break;
			case 4:{
				\$팿 = format_swf_ColorModel::\$CM15Bits;
			}break;
			case 5:{
				\$팿 = (\$v2 ? format_swf_ColorModel::\$CM32Bits : format_swf_ColorModel::\$CM24Bits);
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(\\\"invalid lossless bits\\\"));
					return \\\$팿2;
				\");
			}break;
			}
			return \$팿;
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
		$soundFormat = eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$퍁his->bits->readBits(4)) {
			case 0:{
				\$팿 = format_swf_SoundFormat::\$SFNativeEndianUncompressed;
			}break;
			case 1:{
				\$팿 = format_swf_SoundFormat::\$SFADPCM;
			}break;
			case 2:{
				\$팿 = format_swf_SoundFormat::\$SFMP3;
			}break;
			case 3:{
				\$팿 = format_swf_SoundFormat::\$SFLittleEndianUncompressed;
			}break;
			case 4:{
				\$팿 = format_swf_SoundFormat::\$SFNellymoser16k;
			}break;
			case 5:{
				\$팿 = format_swf_SoundFormat::\$SFNellymoser8k;
			}break;
			case 6:{
				\$팿 = format_swf_SoundFormat::\$SFNellymoser;
			}break;
			case 11:{
				\$팿 = format_swf_SoundFormat::\$SFSpeex;
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(\\\"invalid sound format\\\"));
					return \\\$팿2;
				\");
			}break;
			}
			return \$팿;
		");
		$soundRate = eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$퍁his->bits->readBits(2)) {
			case 0:{
				\$팿3 = format_swf_SoundRate::\$SR5k;
			}break;
			case 1:{
				\$팿3 = format_swf_SoundRate::\$SR11k;
			}break;
			case 2:{
				\$팿3 = format_swf_SoundRate::\$SR22k;
			}break;
			case 3:{
				\$팿3 = format_swf_SoundRate::\$SR44k;
			}break;
			default:{
				\$팿3 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\$퍁his->error(\\\"invalid sound rate\\\"));
					return \\\$팿4;
				\");
			}break;
			}
			return \$팿3;
		");
		$is16bit = $this->bits->read();
		$isStereo = $this->bits->read();
		$soundSamples = $this->i->readInt32();
		$sdata = eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$soundFormat);
			switch(\$퍁->index) {
			case 2:
			{
				\$팿5 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$seek = \\\$퍁his->i->readInt16();
					\\\$팿6 = format_swf_SoundData::SDMp3(\\\$seek, \\\$퍁his->i->read(\\\$len - 9));
					return \\\$팿6;
				\");
			}break;
			case 3:
			{
				\$팿5 = format_swf_SoundData::SDRaw(\$퍁his->i->read(\$len - 7));
			}break;
			default:{
				\$팿5 = format_swf_SoundData::SDOther(\$퍁his->i->read(\$len - 7));
			}break;
			}
			return \$팿5;
		");
		return format_swf_SWFTag::TSound(_hx_anonymous(array("sid" => $sid, "format" => $soundFormat, "rate" => $soundRate, "is16bit" => $is16bit, "isStereo" => $isStereo, "samples" => $soundSamples, "data" => $sdata)));
	}
	public function readLanguage() {
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$퍁his->i->readByte()) {
			case 0:{
				\$팿 = format_swf_LangCode::\$LCNone;
			}break;
			case 1:{
				\$팿 = format_swf_LangCode::\$LCLatin;
			}break;
			case 2:{
				\$팿 = format_swf_LangCode::\$LCJapanese;
			}break;
			case 3:{
				\$팿 = format_swf_LangCode::\$LCKorean;
			}break;
			case 4:{
				\$팿 = format_swf_LangCode::\$LCSimplifiedChinese;
			}break;
			case 5:{
				\$팿 = format_swf_LangCode::\$LCTraditionalChinese;
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\"Unknown language code!\\\");
					return \\\$팿2;
				\");
			}break;
			}
			return \$팿;
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
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$ver) {
			case 2:{
				\$팿 = format_swf_FontData::FDFont2(\$hasWideCodes, \$f2data);
			}break;
			case 3:{
				\$팿 = format_swf_FontData::FDFont3(\$f2data);
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
	}
	public function readFont($len, $ver) {
		$cid = $this->i->readUInt16();
		return format_swf_SWFTag::TFont($cid, eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$ver) {
			case 1:{
				\$팿 = \$퍁his->readFont1Data(\$len);
			}break;
			case 2:{
				\$팿 = \$퍁his->readFont2Data(\$ver);
			}break;
			case 3:{
				\$팿 = \$퍁his->readFont2Data(\$ver);
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
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
		return format_swf_SWFTag::TFontInfo($cid, eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$ver) {
			case 1:{
				\$팿 = format_swf_FontInfoData::FIDFont1(\$shiftJIS, \$isANSI, \$hasWideCodes, \$fi_data);
			}break;
			case 2:{
				\$팿 = format_swf_FontInfoData::FIDFont2(\$language, \$fi_data);
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
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
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$id) {
			case 0:{
				\$팿 = null;
			}break;
			case 1:{
				\$팿 = format_swf_SWFTag::\$TShowFrame;
			}break;
			case 2:{
				\$팿 = \$퍁his->readShape(\$len, 1);
			}break;
			case 22:{
				\$팿 = \$퍁his->readShape(\$len, 2);
			}break;
			case 32:{
				\$팿 = \$퍁his->readShape(\$len, 3);
			}break;
			case 83:{
				\$팿 = \$퍁his->readShape(\$len, 4);
			}break;
			case 46:{
				\$팿 = \$퍁his->readMorphShape(1);
			}break;
			case 84:{
				\$팿 = \$퍁his->readMorphShape(2);
			}break;
			case 10:{
				\$팿 = \$퍁his->readFont(\$len, 1);
			}break;
			case 48:{
				\$팿 = \$퍁his->readFont(\$len, 2);
			}break;
			case 75:{
				\$팿 = \$퍁his->readFont(\$len, 3);
			}break;
			case 13:{
				\$팿 = \$퍁his->readFontInfo(\$len, 1);
			}break;
			case 62:{
				\$팿 = \$퍁his->readFontInfo(\$len, 2);
			}break;
			case 9:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$퍁his->i->setEndian(true);
					\\\$color = \\\$퍁his->i->readUInt24();
					\\\$퍁his->i->setEndian(false);
					\\\$팿2 = format_swf_SWFTag::TBackgroundColor(\\\$color);
					return \\\$팿2;
				\");
			}break;
			case 20:{
				\$팿 = format_swf_SWFTag::TBitsLossless(\$퍁his->readLossless(\$len, false));
			}break;
			case 36:{
				\$팿 = format_swf_SWFTag::TBitsLossless2(\$퍁his->readLossless(\$len, true));
			}break;
			case 8:{
				\$팿 = format_swf_SWFTag::TJPEGTables(\$퍁his->i->read(\$len));
			}break;
			case 6:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$cid = \\\$퍁his->i->readUInt16();
					\\\$팿3 = format_swf_SWFTag::TBitsJPEG(\\\$cid, format_swf_JPEGData::JDJPEG1(\\\$퍁his->i->read(\\\$len - 2)));
					return \\\$팿3;
				\");
			}break;
			case 21:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$cid2 = \\\$퍁his->i->readUInt16();
					\\\$팿4 = format_swf_SWFTag::TBitsJPEG(\\\$cid2, format_swf_JPEGData::JDJPEG2(\\\$퍁his->i->read(\\\$len - 2)));
					return \\\$팿4;
				\");
			}break;
			case 35:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$cid3 = \\\$퍁his->i->readUInt16();
					\\\$dataSize = \\\$퍁his->i->readUInt30();
					\\\$data = \\\$퍁his->i->read(\\\$dataSize);
					\\\$mask = \\\$퍁his->i->read(\\\$len - \\\$dataSize - 6);
					\\\$팿5 = format_swf_SWFTag::TBitsJPEG(\\\$cid3, format_swf_JPEGData::JDJPEG3(\\\$data, \\\$mask));
					return \\\$팿5;
				\");
			}break;
			case 26:{
				\$팿 = format_swf_SWFTag::TPlaceObject2(\$퍁his->readPlaceObject(false));
			}break;
			case 70:{
				\$팿 = format_swf_SWFTag::TPlaceObject3(\$퍁his->readPlaceObject(true));
			}break;
			case 28:{
				\$팿 = format_swf_SWFTag::TRemoveObject2(\$퍁his->i->readUInt16());
			}break;
			case 39:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$cid4 = \\\$퍁his->i->readUInt16();
					\\\$fcount = \\\$퍁his->i->readUInt16();
					\\\$tags = \\\$퍁his->readTagList();
					\\\$팿6 = format_swf_SWFTag::TClip(\\\$cid4, \\\$fcount, \\\$tags);
					return \\\$팿6;
				\");
			}break;
			case 43:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$label = \\\$퍁his->readUTF8Bytes();
					\\\$anchor = (\\\$len === \\\$label->length + 2 ? \\\$퍁his->i->readByte() === 1 : false);
					\\\$팿7 = format_swf_SWFTag::TFrameLabel(\\\$label->toString(), \\\$anchor);
					return \\\$팿7;
				\");
			}break;
			case 59:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$cid5 = \\\$퍁his->i->readUInt16();
					\\\$팿8 = format_swf_SWFTag::TDoInitActions(\\\$cid5, \\\$퍁his->i->read(\\\$len - 2));
					return \\\$팿8;
				\");
			}break;
			case 69:{
				\$팿 = format_swf_SWFTag::TSandBox(\$퍁his->readFileAttributes());
			}break;
			case 72:{
				\$팿 = format_swf_SWFTag::TActionScript3(\$퍁his->i->read(\$len), null);
			}break;
			case 76:{
				\$팿 = format_swf_SWFTag::TSymbolClass(\$퍁his->readSymbols());
			}break;
			case 56:{
				\$팿 = format_swf_SWFTag::TExportAssets(\$퍁his->readSymbols());
			}break;
			case 82:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$infos = _hx_anonymous(array(\\\"id\\\" => \\\$퍁his->i->readUInt30(), \\\"label\\\" => \\\$퍁his->i->readUntil(0)));
					\\\$len -= 4 + strlen(\\\$infos->label) + 1;
					\\\$팿9 = format_swf_SWFTag::TActionScript3(\\\$퍁his->i->read(\\\$len), \\\$infos);
					return \\\$팿9;
				\");
			}break;
			case 87:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$id1 = \\\$퍁his->i->readUInt16();
					if(\\\$퍁his->i->readUInt30() !== 0) {
						throw new HException(\\\$퍁his->error(\\\"invalid binary data tag\\\"));
					}
					\\\$팿10 = format_swf_SWFTag::TBinaryData(\\\$id1, \\\$퍁his->i->read(\\\$len - 6));
					return \\\$팿10;
				\");
			}break;
			case 14:{
				\$팿 = \$퍁his->readSound(\$len);
			}break;
			case 12:{
				\$팿 = format_swf_SWFTag::TDoAction(\$퍁his->i->read(\$len));
			}break;
			case 65:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$maxRecursion = \\\$퍁his->i->readUInt16();
					\\\$timeoutSeconds = \\\$퍁his->i->readUInt16();
					\\\$팿11 = format_swf_SWFTag::TScriptLimits(\\\$maxRecursion, \\\$timeoutSeconds);
					return \\\$팿11;
				\");
			}break;
			case 15:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$id12 = \\\$퍁his->i->readUInt16();
					\\\$팿12 = format_swf_SWFTag::TStartSound(\\\$id12, \\\$퍁his->readSoundInfo());
					return \\\$팿12;
				\");
			}break;
			case 34:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$cid6 = \\\$퍁his->i->readUInt16();
					\\\$data2 = \\\$퍁his->i->read(\\\$len - 2);
					\\\$팿13 = format_swf_SWFTag::TUnknown(\\\$id, \\\$data2);
					return \\\$팿13;
				\");
			}break;
			case 37:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$cid7 = \\\$퍁his->i->readUInt16();
					\\\$data3 = \\\$퍁his->i->read(\\\$len - 2);
					\\\$팿14 = format_swf_SWFTag::TUnknown(\\\$id, \\\$data3);
					return \\\$팿14;
				\");
			}break;
			case 77:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$data4 = \\\$퍁his->i->readString(\\\$len);
					\\\$팿15 = format_swf_SWFTag::TMetadata(\\\$data4);
					return \\\$팿15;
				\");
			}break;
			case 78:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$id13 = \\\$퍁his->i->readUInt16();
					\\\$splitter = \\\$퍁his->readRect();
					\\\$팿16 = format_swf_SWFTag::TDefineScalingGrid(\\\$id13, \\\$splitter);
					return \\\$팿16;
				\");
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$data5 = \\\$퍁his->i->read(\\\$len);
					\\\$팿17 = format_swf_SWFTag::TUnknown(\\\$id, \\\$data5);
					return \\\$팿17;
				\");
			}break;
			}
			return \$팿;
		");
	}
	public function read() {
		return _hx_anonymous(array("header" => $this->readHeader(), "tags" => $this->readTagList()));
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->팪ynamics[$m]) && is_callable($this->팪ynamics[$m]))
			return call_user_func_array($this->팪ynamics[$m], $a);
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	function __toString() { return 'format.swf.Reader'; }
}
