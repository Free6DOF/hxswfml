<?php

class format_abc_ABCData {
	public function __construct() {
		;
	}
	public function get($t, $i) {
		return format_abc_ABCData_0($this, $i, $t);
	}
	public $functions;
	public $inits;
	public $classes;
	public $metadatas;
	public $methodTypes;
	public $names;
	public $nssets;
	public $namespaces;
	public $strings;
	public $floats;
	public $uints;
	public $ints;
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
	function __toString() { return 'format.abc.ABCData'; }
}
function format_abc_ABCData_0(&$__hx__this, &$i, &$t) {
	$__hx__t = ($i);
	switch($__hx__t->index) {
	case 0:
	$n = $__hx__t->params[0];
	{
		return $t[$n - 1];
	}break;
	}
}
