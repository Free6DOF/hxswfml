<?php

class be_haxer_hxswfml_HxGraphix {
	public function __construct($forceShape3) {
		if( !php_Boot::$skip_constructor ) {
		if($forceShape3 === null) {
			$forceShape3 = false;
		}
		$this->_xMin = Math::$POSITIVE_INFINITY;
		$this->_yMin = Math::$POSITIVE_INFINITY;
		$this->_xMax = Math::$POSITIVE_INFINITY;
		$this->_yMax = Math::$POSITIVE_INFINITY;
		$this->_boundsInitialized = false;
		$this->_fillStyles = new _hx_array(array());
		$this->_lineStyles = new _hx_array(array());
		$this->_shapeRecords = new _hx_array(array());
		$this->_stateFillStyle = false;
		$this->_stateLineStyle = false;
		$this->_lastX = 0.0;
		$this->_lastY = 0.0;
		$this->_shapeType = 4;
		$this->_forceShape3 = $forceShape3;
	}}
	public $_shapeType;
	public $_forceShape3;
	public $_xMin;
	public $_yMin;
	public $_xMax;
	public $_yMax;
	public $_xMin2;
	public $_yMin2;
	public $_xMax2;
	public $_yMax2;
	public $_boundsInitialized;
	public $_fillStyles;
	public $_lineStyles;
	public $_shapeRecords;
	public $_lastX;
	public $_lastY;
	public $_stateFillStyle;
	public $_stateLineStyle;
	public function beginFill($color, $alpha) {
		if($alpha === null) {
			$alpha = 1.0;
		}
		if($color === null) {
			$color = 0;
		}
		$this->_stateFillStyle = true;
		$this->_fillStyles->push(format_swf_FillStyle::FSSolidAlpha($this->hexToRgba($color, $alpha)));
		$_shapeChangeRec = _hx_anonymous(array("moveTo" => null, "fillStyle0" => _hx_anonymous(array("idx" => $this->_fillStyles->length)), "fillStyle1" => null, "lineStyle" => ($this->_stateLineStyle ? _hx_anonymous(array("idx" => $this->_lineStyles->length)) : null), "newStyles" => null));
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRChange($_shapeChangeRec));
	}
	public function beginGradientFill($type, $colors, $alphas, $ratios, $x, $y, $scaleX, $scaleY, $rotate0, $rotate1) {
		if($rotate1 === null) {
			$rotate1 = 0;
		}
		if($rotate0 === null) {
			$rotate0 = 0;
		}
		if($type === null) {
			$type = "linear";
		}
		$this->_stateFillStyle = true;
		$data = new _hx_array(array());
		{
			$_g1 = 0; $_g = $colors->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$pos = Std::parseInt($ratios[$i]);
				$color = Std::parseInt($colors[$i]);
				$alpha = Std::parseFloat($alphas[$i]);
				$data->push(format_swf_GradRecord::GRRGBA($pos, $this->hexToRgba($color, $alpha)));
				unset($pos,$i,$color,$alpha);
			}
		}
		$matrix = _hx_anonymous(array("scale" => _hx_anonymous(array("x" => $scaleX, "y" => $scaleY)), "rotate" => _hx_anonymous(array("rs0" => $rotate0, "rs1" => $rotate1)), "translate" => _hx_anonymous(array("x" => Math::round($this->toFloat5($x) * 20), "y" => Math::round($this->toFloat5($y) * 20)))));
		$gradient = _hx_anonymous(array("spread" => format_swf_SpreadMode::$SMPad, "interpolate" => format_swf_InterpolationMode::$IMNormalRGB, "data" => $data));
		switch($type) {
		case "linear":{
			$this->_fillStyles->push(format_swf_FillStyle::FSLinearGradient($matrix, $gradient));
		}break;
		case "radial":{
			$this->_fillStyles->push(format_swf_FillStyle::FSRadialGradient($matrix, $gradient));
		}break;
		default:{
			throw new HException("Unsupported gradient type");
		}break;
		}
		$_shapeChangeRec = _hx_anonymous(array("moveTo" => null, "fillStyle0" => _hx_anonymous(array("idx" => $this->_fillStyles->length)), "fillStyle1" => null, "lineStyle" => ($this->_stateLineStyle ? _hx_anonymous(array("idx" => $this->_lineStyles->length)) : null), "newStyles" => null));
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRChange($_shapeChangeRec));
	}
	public function beginBitmapFill($bitmapId, $x, $y, $scaleX, $scaleY, $rotate0, $rotate1, $repeat, $smooth) {
		if($smooth === null) {
			$smooth = false;
		}
		if($repeat === null) {
			$repeat = false;
		}
		if($rotate1 === null) {
			$rotate1 = 0.0;
		}
		if($rotate0 === null) {
			$rotate0 = 0.0;
		}
		if($scaleY === null) {
			$scaleY = 1.0;
		}
		if($scaleX === null) {
			$scaleX = 1.0;
		}
		if($y === null) {
			$y = 0;
		}
		if($x === null) {
			$x = 0;
		}
		$this->_stateFillStyle = true;
		$matrix = _hx_anonymous(array("scale" => _hx_anonymous(array("x" => $this->toFloat5($scaleX) * 20, "y" => $this->toFloat5($scaleY) * 20)), "rotate" => _hx_anonymous(array("rs0" => $rotate0, "rs1" => $rotate1)), "translate" => _hx_anonymous(array("x" => Math::round($this->toFloat5($x) * 20), "y" => Math::round($this->toFloat5($y) * 20)))));
		$this->_fillStyles->push(format_swf_FillStyle::FSBitmap($bitmapId, $matrix, $repeat, $smooth));
		$_shapeChangeRec = _hx_anonymous(array("moveTo" => null, "fillStyle0" => _hx_anonymous(array("idx" => $this->_fillStyles->length)), "fillStyle1" => null, "lineStyle" => ($this->_stateLineStyle ? _hx_anonymous(array("idx" => $this->_lineStyles->length)) : null), "newStyles" => null));
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRChange($_shapeChangeRec));
	}
	public function lineStyle($width, $color, $alpha, $pixelHinting, $scaleMode, $caps, $joints, $miterLimit, $noClose) {
		if($miterLimit === null) {
			$miterLimit = 255;
		}
		if($alpha === null) {
			$alpha = 1.0;
		}
		if($color === null) {
			$color = 0;
		}
		if($width === null) {
			$width = 1.0;
		}
		$this->_stateLineStyle = true;
		if($width > 255.0) {
			$width = 255.0;
		}
		if($width <= 0.0) {
			$width = 0.05;
		}
		if($pixelHinting === null && $scaleMode === null && $caps === null && $noClose === null && $this->_shapeType === 3 || $this->_forceShape3) {
			$this->_lineStyles->push(_hx_anonymous(array("width" => Math::round($this->toFloat5($width) * 20), "data" => format_swf_LineStyleData::LSRGBA($this->hexToRgba($color, $alpha)))));
		}
		else {
			$this->_lineStyles->push(_hx_anonymous(array("width" => Math::round($this->toFloat5($width) * 20), "data" => format_swf_LineStyleData::LS2($this->lineStyle2($color, $alpha, $pixelHinting, $scaleMode, $caps, $joints, $miterLimit, $noClose)))));
		}
		$_shapeChangeRec = _hx_anonymous(array("moveTo" => null, "fillStyle0" => ($this->_stateFillStyle ? _hx_anonymous(array("idx" => $this->_fillStyles->length)) : null), "fillStyle1" => null, "lineStyle" => _hx_anonymous(array("idx" => $this->_lineStyles->length)), "newStyles" => null));
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRChange($_shapeChangeRec));
	}
	public function lineStyle2($color, $alpha, $pixelHinting, $scaleMode, $caps, $joints, $miterLimit, $noClose) {
		if($miterLimit === null) {
			$miterLimit = 255;
		}
		if($alpha === null) {
			$alpha = 1.0;
		}
		if($color === null) {
			$color = 0;
		}
		$this->_shapeType = 4;
		$pixelHinting1 = ($pixelHinting === null ? false : $pixelHinting);
		$scaleMode1 = ($scaleMode === null ? "" : strtolower($scaleMode));
		$caps1 = ($caps === null ? "" : strtolower($caps));
		$joints1 = ($joints === null ? "" : strtolower($joints));
		$cap = ($caps1 == "none" ? format_swf_LineCapStyle::$LCNone : ($caps1 == "round" ? format_swf_LineCapStyle::$LCRound : ($caps1 == "square" ? format_swf_LineCapStyle::$LCSquare : format_swf_LineCapStyle::$LCRound)));
		return _hx_anonymous(array("startCap" => $cap, "join" => ($joints1 == "round" ? format_swf_LineJoinStyle::$LJRound : ($joints1 == "bevel" ? format_swf_LineJoinStyle::$LJBevel : ($joints1 == "miter" ? format_swf_LineJoinStyle::LJMiter($miterLimit) : format_swf_LineJoinStyle::$LJRound))), "fill" => format_swf_LS2Fill::LS2FColor($this->hexToRgba($color, $alpha)), "noHScale" => ($scaleMode1 == "none" || $scaleMode1 == "horizontal" ? true : false), "noVScale" => ($scaleMode1 == "none" || $scaleMode1 == "vertical" ? true : false), "pixelHinting" => $pixelHinting1, "noClose" => $noClose, "endCap" => $cap));
	}
	public function lineTo($x, $y) {
		if(!$this->_boundsInitialized) {
			$this->initBounds(0, 0);
		}
		$x1 = $this->toFloat5($x);
		$y1 = $this->toFloat5($y);
		$dx = $x1 - $this->_lastX;
		$dy = $y1 - $this->_lastY;
		if(_hx_equal($dx, 0) && _hx_equal($dy, 0)) {
			return;
		}
		$this->_lastX = $x1;
		$this->_lastY = $y1;
		$midLine = ($this->_lineStyles[$this->_lineStyles->length - 1] === null ? 0 : _hx_array_get($this->_lineStyles, $this->_lineStyles->length - 1)->width / 40);
		if($x1 < $this->_xMin) {
			$this->_xMin = $x1;
			$this->_xMin2 = $x1 - $midLine;
		}
		if($x1 > $this->_xMax) {
			$this->_xMax = $x1;
			$this->_xMax2 = $x1 + $midLine;
		}
		if($y1 < $this->_yMin) {
			$this->_yMin = $y1;
			$this->_yMin2 = $y1 - $midLine;
		}
		if($y1 > $this->_yMax) {
			$this->_yMax = $y1;
			$this->_yMax2 = $y1 + $midLine;
		}
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHREdge(Math::round($dx * 20), Math::round($dy * 20)));
	}
	public function moveTo($x, $y) {
		$x1 = $this->toFloat5($x);
		$y1 = $this->toFloat5($y);
		if(!$this->_boundsInitialized) {
			$this->initBounds($x1, $y1);
		}
		if($x1 === $this->_lastX && $y1 === $this->_lastY) {
			return;
		}
		$this->_lastX = $x1;
		$this->_lastY = $y1;
		$midLine = ($this->_lineStyles[$this->_lineStyles->length - 1] === null ? 0 : _hx_array_get($this->_lineStyles, $this->_lineStyles->length - 1)->width / 40);
		if($x1 < $this->_xMin) {
			$this->_xMin = $x1;
			$this->_xMin2 = $x1 - $midLine;
		}
		if($x1 > $this->_xMax) {
			$this->_xMax = $x1;
			$this->_xMax2 = $x1 + $midLine;
		}
		if($y1 < $this->_yMin) {
			$this->_yMin = $y1;
			$this->_yMin2 = $y1 - $midLine;
		}
		if($y1 > $this->_yMax) {
			$this->_yMax = $y1;
			$this->_yMax2 = $y1 + $midLine;
		}
		$_shapeChangeRec = _hx_anonymous(array("moveTo" => _hx_anonymous(array("dx" => Math::round($x1 * 20), "dy" => Math::round($y1 * 20))), "fillStyle0" => ($this->_stateFillStyle ? _hx_anonymous(array("idx" => $this->_fillStyles->length)) : null), "fillStyle1" => null, "lineStyle" => ($this->_stateLineStyle ? _hx_anonymous(array("idx" => $this->_lineStyles->length)) : null), "newStyles" => null));
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRChange($_shapeChangeRec));
	}
	public function curveTo($cx, $cy, $ax, $ay) {
		if(!$this->_boundsInitialized) {
			$this->initBounds(0, 0);
		}
		$cx1 = $this->toFloat5($cx);
		$cy1 = $this->toFloat5($cy);
		$ax1 = $this->toFloat5($ax);
		$ay1 = $this->toFloat5($ay);
		$dcx = $cx1 - $this->_lastX;
		$dcy = $cy1 - $this->_lastY;
		$dax = $ax1 - $cx1;
		$day = $ay1 - $cy1;
		$this->_lastX = $ax1;
		$this->_lastY = $ay1;
		$midLine = ($this->_lineStyles[$this->_lineStyles->length - 1] === null ? 0 : _hx_array_get($this->_lineStyles, $this->_lineStyles->length - 1)->width / 40);
		if($ax1 < $this->_xMin) {
			$this->_xMin = $ax1;
			$this->_xMin2 = $ax1 - $midLine;
		}
		if($ax1 > $this->_xMax) {
			$this->_xMax = $ax1;
			$this->_xMax2 = $ax1 + $midLine;
		}
		if($ay1 < $this->_yMin) {
			$this->_yMin = $ay1;
			$this->_yMin2 = $ay1 - $midLine;
		}
		if($ay1 > $this->_yMax) {
			$this->_yMax = $ay1;
			$this->_yMax2 = $ay1 + $midLine;
		}
		if($cx1 < $this->_xMin) {
			$this->_xMin = $cx1;
			$this->_xMin2 = $cx1 - $midLine;
		}
		if($cx1 > $this->_xMax) {
			$this->_xMax = $cx1;
			$this->_xMax2 = $cx1 + $midLine;
		}
		if($cy1 < $this->_yMin) {
			$this->_yMin = $cy1;
			$this->_yMin2 = $cy1 - $midLine;
		}
		if($cy1 > $this->_yMax) {
			$this->_yMax = $cy1;
			$this->_yMax2 = $cy1 + $midLine;
		}
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRCurvedEdge(Math::round($dcx * 20), Math::round($dcy * 20), Math::round($dax * 20), Math::round($day * 20)));
	}
	public function endFill() {
		$this->_stateFillStyle = false;
		$this->beginFill(0, 0);
	}
	public function endLine() {
		$this->_stateLineStyle = false;
		$this->lineStyle(0, 0, 0, null, null, null, null, null, null);
	}
	public function clear() {
		$this->_shapeRecords = new _hx_array(array());
	}
	public function drawRect($x, $y, $width, $height) {
		$this->moveTo($x, $y);
		$this->lineTo($x + $width, $y);
		$this->lineTo($x + $width, $y + $height);
		$this->lineTo($x, $y + $height);
		$this->lineTo($x, $y);
	}
	public function drawRoundRect($x, $y, $w, $h, $r) {
		$this->drawRoundRectComplex($x, $y, $w, $h, $r, $r, $r, $r);
	}
	public function drawRoundRectComplex($x, $y, $w, $h, $rtl, $rtr, $rbl, $rbr) {
		$this->moveTo($rtl + $x, $y);
		$this->lineTo($w - $rtr + $x, $y);
		$this->curveTo($w + $x, $y, $w + $x, $y + $rtr);
		$this->lineTo($w + $x, $h - $rbr + $y);
		$this->curveTo($w + $x, $h + $y, $w - $rbr + $x, $h + $y);
		$this->lineTo($rbl + $x, $h + $y);
		$this->curveTo($x, $h + $y, $x, $h - $rbl + $y);
		$this->lineTo($x, $rtl + $y);
		$this->curveTo($x, $y, $rtl + $x, $y);
	}
	public function drawCircle($x, $y, $r, $sections) {
		if($sections === null) {
			$sections = 16;
		}
		if($sections < 3) {
			$sections = 3;
		}
		if($sections > 360) {
			$sections = 360;
		}
		$span = Math::$PI / $sections;
		$controlRadius = $r / Math::cos($span);
		$anchorAngle = 0.0;
		$controlAngle = 0.0;
		$startPosX = $x + Math::cos($anchorAngle) * $r;
		$startPosY = $y + Math::sin($anchorAngle) * $r;
		$this->moveTo($startPosX, $startPosY);
		{
			$_g = 0;
			while($_g < $sections) {
				$i = $_g++;
				$controlAngle = $anchorAngle + $span;
				$anchorAngle = $controlAngle + $span;
				$cx = $x + Math::cos($controlAngle) * $controlRadius;
				$cy = $y + Math::sin($controlAngle) * $controlRadius;
				$ax = $x + Math::cos($anchorAngle) * $r;
				$ay = $y + Math::sin($anchorAngle) * $r;
				$this->curveTo($cx, $cy, $ax, $ay);
				unset($i,$cy,$cx,$ay,$ax);
			}
		}
	}
	public function drawEllipse($x, $y, $w, $h) {
		$this->moveTo($x, $y + $h / 2);
		$this->curveTo($x, $y, $x + $w / 2, $y);
		$this->curveTo($x + $w, $y, $x + $w, $y + $h / 2);
		$this->curveTo($x + $w, $y + $h, $x + $w / 2, $y + $h);
		$this->curveTo($x, $y + $h, $x, $y + $h / 2);
	}
	public function getTag($id, $useWinding, $useNonScalingStroke, $useScalingStroke) {
		$this->_shapeRecords->push(format_swf_ShapeRecord::$SHREnd);
		if(!$this->_boundsInitialized) {
			$this->initBounds(0, 0);
		}
		$_rect = _hx_anonymous(array("left" => Math::round($this->_xMin * 20), "right" => Math::round($this->_xMax * 20), "top" => Math::round($this->_yMin * 20), "bottom" => Math::round($this->_yMax * 20)));
		$_rect2 = _hx_anonymous(array("left" => Math::round($this->_xMin2 * 20), "right" => Math::round($this->_xMax2 * 20), "top" => Math::round($this->_yMin2 * 20), "bottom" => Math::round($this->_yMax2 * 20)));
		$_shapeWithStyleData = _hx_anonymous(array("fillStyles" => $this->_fillStyles, "lineStyles" => $this->_lineStyles, "shapeRecords" => $this->_shapeRecords));
		if($useWinding !== null || $useNonScalingStroke !== null || $useScalingStroke !== null) {
			$this->_shapeType = 4;
		}
		if($this->_shapeType === 3 || $this->_forceShape3) {
			return format_swf_SWFTag::TShape($id, format_swf_ShapeData::SHDShape3($_rect, $_shapeWithStyleData));
		}
		else {
			$useWinding = ($useWinding === null ? false : $useWinding);
			$useNonScalingStroke = ($useNonScalingStroke === null ? false : $useNonScalingStroke);
			$useScalingStroke = ($useScalingStroke === null ? false : $useScalingStroke);
			return format_swf_SWFTag::TShape($id, format_swf_ShapeData::SHDShape4(_hx_anonymous(array("shapeBounds" => $_rect2, "edgeBounds" => $_rect, "useWinding" => $useWinding, "useNonScalingStroke" => $useNonScalingStroke, "useScalingStroke" => $useScalingStroke, "shapes" => $_shapeWithStyleData))));
		}
	}
	public function initBounds($x, $y) {
		$midLine = ($this->_lineStyles[$this->_lineStyles->length - 1] === null ? 0 : _hx_array_get($this->_lineStyles, $this->_lineStyles->length - 1)->width / 40);
		if(Math::$POSITIVE_INFINITY === $this->_xMin) {
			$this->_xMin = $x;
		}
		$this->_xMin2 = $x - $midLine;
		if(Math::$POSITIVE_INFINITY === $this->_xMax) {
			$this->_xMax = $x;
		}
		$this->_xMax2 = $x + $midLine;
		if(Math::$POSITIVE_INFINITY === $this->_yMin) {
			$this->_yMin = $y;
		}
		$this->_yMin2 = $y - $midLine;
		if(Math::$POSITIVE_INFINITY === $this->_yMax) {
			$this->_yMax = $y;
		}
		$this->_yMax2 = $y + $midLine;
		$this->_boundsInitialized = true;
	}
	public function hexToRgba($color, $alpha) {
		if($alpha < 0) {
			$alpha = 0.0;
		}
		if($alpha > 1) {
			$alpha = 1.0;
		}
		if($color > 16777215) {
			$color = 16777215;
		}
		return _hx_anonymous(array("r" => ($color & 16711680) >> 16, "g" => ($color & 65280) >> 8, "b" => ($color & 255), "a" => Math::round($alpha * 255)));
	}
	public function toFloat5($float) {
		$temp1 = Math::round($float * 1000);
		$diff = $temp1 % 50;
		$temp2 = ($diff < 25 ? $temp1 - $diff : $temp1 + (50 - $diff));
		$temp3 = $temp2 / 1000;
		return $temp3;
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	function __toString() { return 'be.haxer.hxswfml.HxGraphix'; }
}
