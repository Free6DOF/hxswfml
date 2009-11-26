<?php

class format_abc_ABCData {
	public function __construct() {
		;
		;
	}
	public $ints;
	public $uints;
	public $floats;
	public $strings;
	public $namespaces;
	public $nssets;
	public $names;
	public $methodTypes;
	public $metadatas;
	public $classes;
	public $inits;
	public $functions;
	public function get($t, $i) {
		return eval("if(isset(\$this)) \$»this =& \$this;\$»t = (\$i);
			switch(\$»t->index) {
			case 0:
			\$n = \$»t->params[0];
			{
				\$»r = \$t[\$n - 1];
			}break;
			default:{
				\$»r = null;
			}break;
			}
			return \$»r;
		");
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	function __toString() { return 'format.abc.ABCData'; }
}
