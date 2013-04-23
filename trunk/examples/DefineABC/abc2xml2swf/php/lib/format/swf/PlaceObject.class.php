<?php

class format_swf_PlaceObject {
	public function __construct() {
		;
	}
	public $hasImage;
	public $className;
	public $bitmapCache;
	public $blendMode;
	public $filters;
	public $events;
	public $clipDepth;
	public $instanceName;
	public $ratio;
	public $color;
	public $matrix;
	public $cid;
	public $move;
	public $depth;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return 'format.swf.PlaceObject'; }
}
