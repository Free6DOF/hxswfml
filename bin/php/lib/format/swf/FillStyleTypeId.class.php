<?php

class format_swf_FillStyleTypeId {
	public function __construct(){}
	static $Solid = 0;
	static $LinearGradient = 16;
	static $RadialGradient = 18;
	static $FocalRadialGradient = 19;
	static $RepeatingBitmap = 64;
	static $ClippedBitmap = 65;
	static $NonSmoothedRepeatingBitmap = 66;
	static $NonSmoothedClippedBitmap = 67;
	function __toString() { return 'format.swf.FillStyleTypeId'; }
}
