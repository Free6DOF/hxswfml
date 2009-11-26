<?php

class HxGraphix {
	public function __construct() {
		if( !php_Boot::$skip_constructor ) {
		$this->_xMin = 0.0;
		$this->_yMin = 0.0;
		$this->_xMax = 0.0;
		$this->_yMax = 0.0;
		$this->_fillStyles = new _hx_array(array());
		$this->_lineStyles = new _hx_array(array());
		$this->_shapeRecords = new _hx_array(array());
		$this->_stateFillStyle = false;
		$this->_stateLineStyle = false;
		$this->_lastX = 0.0;
		$this->_lastY = 0.0;
	}}
	public $_xMin;
	public $_yMin;
	public $_xMax;
	public $_yMax;
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
		$matrix = _hx_anonymous(array("scale" => _hx_anonymous(array("x" => $scaleX, "y" => $scaleY)), "rotate" => _hx_anonymous(array("rs0" => $rotate0, "rs1" => $rotate1)), "translate" => _hx_anonymous(array("x" => intval($this->toFloat5($x)) * 20, "y" => intval($this->toFloat5($y)) * 20))));
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
		$matrix = _hx_anonymous(array("scale" => _hx_anonymous(array("x" => $this->toFloat5($scaleX) * 20, "y" => $this->toFloat5($scaleY) * 20)), "rotate" => _hx_anonymous(array("rs0" => $rotate0, "rs1" => $rotate1)), "translate" => _hx_anonymous(array("x" => intval($this->toFloat5($x)) * 20, "y" => intval($this->toFloat5($y)) * 20))));
		$this->_fillStyles->push(format_swf_FillStyle::FSBitmap($bitmapId, $matrix, $repeat, $smooth));
		$_shapeChangeRec = _hx_anonymous(array("moveTo" => null, "fillStyle0" => _hx_anonymous(array("idx" => $this->_fillStyles->length)), "fillStyle1" => null, "lineStyle" => ($this->_stateLineStyle ? _hx_anonymous(array("idx" => $this->_lineStyles->length)) : null), "newStyles" => null));
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRChange($_shapeChangeRec));
	}
	public function lineStyle($width, $color, $alpha) {
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
		$this->_lineStyles->push(_hx_anonymous(array("width" => intval($this->toFloat5($width) * 20), "data" => format_swf_LineStyleData::LSRGBA($this->hexToRgba($color, $alpha)))));
		$_shapeChangeRec = _hx_anonymous(array("moveTo" => null, "fillStyle0" => ($this->_stateFillStyle ? _hx_anonymous(array("idx" => $this->_fillStyles->length)) : null), "fillStyle1" => null, "lineStyle" => _hx_anonymous(array("idx" => $this->_lineStyles->length)), "newStyles" => null));
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRChange($_shapeChangeRec));
	}
	public function lineTo($x, $y) {
		$x1 = $this->toFloat5($x);
		$y1 = $this->toFloat5($y);
		$dx = $x1 - $this->_lastX;
		$dy = $y1 - $this->_lastY;
		$this->_lastX = $x1;
		$this->_lastY = $y1;
		if($x1 < $this->_xMin) {
			$this->_xMin = $x1;
		}
		if($x1 > $this->_xMax) {
			$this->_xMax = $x1;
		}
		if($y1 < $this->_yMin) {
			$this->_yMin = $y1;
		}
		if($y1 > $this->_yMax) {
			$this->_yMax = $y1;
		}
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHREdge(intval($dx * 20), intval($dy * 20)));
	}
	public function moveTo($x, $y) {
		$x1 = $this->toFloat5($x);
		$y1 = $this->toFloat5($y);
		$this->_lastX = $x1;
		$this->_lastY = $y1;
		if($x1 < $this->_xMin) {
			$this->_xMin = $x1;
		}
		if($x1 > $this->_xMax) {
			$this->_xMax = $x1;
		}
		if($y1 < $this->_yMin) {
			$this->_yMin = $y1;
		}
		if($y1 > $this->_yMax) {
			$this->_yMax = $y1;
		}
		$_shapeChangeRec = _hx_anonymous(array("moveTo" => _hx_anonymous(array("dx" => intval($x1 * 20), "dy" => intval($y1 * 20))), "fillStyle0" => ($this->_stateFillStyle ? _hx_anonymous(array("idx" => $this->_fillStyles->length)) : null), "fillStyle1" => null, "lineStyle" => ($this->_stateLineStyle ? _hx_anonymous(array("idx" => $this->_lineStyles->length)) : null), "newStyles" => null));
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRChange($_shapeChangeRec));
	}
	public function curveTo($cx, $cy, $ax, $ay) {
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
		if($ax1 < $this->_xMin) {
			$this->_xMin = $ax1;
		}
		if($ax1 > $this->_xMax) {
			$this->_xMax = $ax1;
		}
		if($ay1 < $this->_yMin) {
			$this->_yMin = $ay1;
		}
		if($ay1 > $this->_yMax) {
			$this->_yMax = $ay1;
		}
		$this->_shapeRecords->push(format_swf_ShapeRecord::SHRCurvedEdge(intval($dcx * 20), intval($dcy * 20), intval($dax * 20), intval($day * 20)));
	}
	public function endFill() {
		$this->_stateFillStyle = false;
		$this->beginFill(0, 0);
	}
	public function endLine() {
		$this->_stateLineStyle = false;
		$this->lineStyle(0, 0, 0);
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
	public function getTag($id) {
		$this->_shapeRecords->push(format_swf_ShapeRecord::$SHREnd);
		$_rect = _hx_anonymous(array("left" => intval($this->_xMin * 20), "right" => intval($this->_xMax * 20), "top" => intval($this->_yMin * 20), "bottom" => intval($this->_yMax * 20)));
		$_shapeWithStyleData = _hx_anonymous(array("fillStyles" => $this->_fillStyles, "lineStyles" => $this->_lineStyles, "shapeRecords" => $this->_shapeRecords));
		return format_swf_SWFTag::TShape($id, format_swf_ShapeData::SHDShape3($_rect, $_shapeWithStyleData));
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
		return _hx_anonymous(array("r" => ($color & 16711680) >> 16, "g" => ($color & 65280) >> 8, "b" => ($color & 255), "a" => intval($alpha * 255)));
	}
	public function toFloat5($float) {
		$temp1 = intval($float * 100);
		$diff = $temp1 % 5;
		$temp2 = ($diff < 3 ? $temp1 - $diff : $temp1 + (5 - $diff));
		$temp3 = $temp2 / 100;
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
	function __toString() { return 'HxGraphix'; }
}
