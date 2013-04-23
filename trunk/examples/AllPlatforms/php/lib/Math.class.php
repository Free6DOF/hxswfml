<?php

class Math {
	public function __construct(){}
	static $PI;
	static $NaN;
	static $POSITIVE_INFINITY;
	static $NEGATIVE_INFINITY;
	static function abs($v) {
		return abs($v);
	}
	static function min($a, $b) {
		return Math_0($a, $b);
	}
	static function max($a, $b) {
		return Math_1($a, $b);
	}
	static function sin($v) {
		return sin($v);
	}
	static function cos($v) {
		return cos($v);
	}
	static function atan2($y, $x) {
		return atan2($y, $x);
	}
	static function tan($v) {
		return tan($v);
	}
	static function exp($v) {
		if(Math::isNaN($v)) {
			return Math::$NaN;
		}
		if(is_finite($v)) {
			return exp($v);
		} else {
			if($v === Math::$POSITIVE_INFINITY) {
				return Math::$POSITIVE_INFINITY;
			} else {
				return 0.0;
			}
		}
	}
	static function log($v) {
		return log($v);
	}
	static function sqrt($v) {
		return sqrt($v);
	}
	static function round($v) {
		return (int) floor($v + 0.5);
	}
	static function floor($v) {
		return (int) floor($v);
	}
	static function ceil($v) {
		return (int) ceil($v);
	}
	static function atan($v) {
		return atan($v);
	}
	static function asin($v) {
		return asin($v);
	}
	static function acos($v) {
		return acos($v);
	}
	static function pow($v, $exp) {
		return pow($v, $exp);
	}
	static function random() {
		return mt_rand() / mt_getrandmax();
	}
	static function isNaN($f) {
		return is_nan($f);
	}
	static function isFinite($f) {
		return is_finite($f);
	}
	static function fround($v) {
		return floor($v + 0.5);
	}
	static function ffloor($v) {
		return floor($v);
	}
	static function fceil($v) {
		return ceil($v);
	}
	function __toString() { return 'Math'; }
}
{
	Math::$PI = M_PI;
	Math::$NaN = acos(1.01);
	Math::$NEGATIVE_INFINITY = log(0);
	Math::$POSITIVE_INFINITY = -Math::$NEGATIVE_INFINITY;
}
function Math_0(&$a, &$b) {
	if(!Math::isNaN($a)) {
		return min($a, $b);
	} else {
		return Math::$NaN;
	}
}
function Math_1(&$a, &$b) {
	if(!Math::isNaN($b)) {
		return max($a, $b);
	} else {
		return Math::$NaN;
	}
}
