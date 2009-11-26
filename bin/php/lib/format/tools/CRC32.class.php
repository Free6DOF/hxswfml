<?php

class format_tools_CRC32 {
	public function __construct() {
		if( !php_Boot::$skip_constructor ) {
		$this->crc = -1;
	}}
	public $crc;
	public function run($b) {
		$crc = $this->crc;
		$polynom = -306674912;
		{
			$_g1 = 0; $_g = $b->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$tmp = (($crc) ^ (ord($b->b[$i]))) & 255;
				{
					$_g2 = 0;
					while($_g2 < 8) {
						$j = $_g2++;
						if((($tmp) & 1) === 1) {
							$tmp = ((_hx_shift_right(($tmp), 1)) ^ ($polynom));
						}
						else {
							$tmp = _hx_shift_right(($tmp), 1);
						}
						unset($j);
					}
				}
				$crc = ((_hx_shift_right(($crc), 8)) ^ ($tmp));
				unset($tmp,$j,$i,$_g2);
			}
		}
		$this->crc = $crc;
	}
	public function byte($b) {
		$polynom = -306674912;
		$tmp = (($this->crc) ^ ($b)) & 255;
		{
			$_g = 0;
			while($_g < 8) {
				$j = $_g++;
				if((($tmp) & 1) === 1) {
					$tmp = ((_hx_shift_right(($tmp), 1)) ^ ($polynom));
				}
				else {
					$tmp = _hx_shift_right(($tmp), 1);
				}
				unset($j);
			}
		}
		$this->crc = ((_hx_shift_right(($this->crc), 8)) ^ ($tmp));
	}
	public function get() {
		return ($this->crc) ^ -1;
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	static $POLYNOM = -306674912;
	static function encode($b) {
		$c = new format_tools_CRC32();
		$c->run($b);
		return $c->get();
	}
	function __toString() { return 'format.tools.CRC32'; }
}
