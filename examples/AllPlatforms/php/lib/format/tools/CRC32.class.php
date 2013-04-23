<?php

class format_tools_CRC32 {
	public function __construct() {
		;
	}
	public function get() {
		return $this->crc ^ -1;
	}
	public function run($b) {
		$crc = -1;
		$polynom = -306674912;
		{
			$_g1 = 0; $_g = $b->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$tmp = ($crc ^ ord($b->b[$i])) & 255;
				{
					$_g2 = 0;
					while($_g2 < 8) {
						$j = $_g2++;
						if(($tmp & $i) === 1) {
							$tmp = _hx_shift_right($tmp, 1) ^ $polynom;
						} else {
							$tmp = _hx_shift_right($tmp, 1);
						}
						unset($j);
					}
					unset($_g2);
				}
				$crc = _hx_shift_right($crc, 8) ^ $tmp;
				unset($tmp,$i);
			}
		}
		$this->crc = $crc;
	}
	public $crc;
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
	static function encode($b) {
		$c = new format_tools_CRC32();
		$c->run($b);
		return $c->get();
	}
	function __toString() { return 'format.tools.CRC32'; }
}
