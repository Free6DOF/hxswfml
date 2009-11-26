<?php

class format_swf_PlaceObject {
	public function __construct() {
		;
		;
	}
	public $depth;
	public $move;
	public $cid;
	public $matrix;
	public $color;
	public $ratio;
	public $instanceName;
	public $clipDepth;
	public $events;
	public $filters;
	public $blendMode;
	public $bitmapCache;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	function __toString() { return 'format.swf.PlaceObject'; }
}
