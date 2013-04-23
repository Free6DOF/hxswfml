<?php

class haxe_crypto_Crc32 {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->crc = -1;
	}}
	public function get() {
		return $this->crc ^ -1;
	}
	public function update($b, $pos, $len) {
		$b1 = $b->b;
		{
			$_g1 = $pos; $_g = $pos + $len;
			while($_g1 < $_g) {
				$i = $_g1++;
				$tmp = ($this->crc ^ ord($b1[$i])) & 255;
				{
					$_g2 = 0;
					while($_g2 < 8) {
						$j = $_g2++;
						if(($tmp & 1) === 1) {
							$tmp = _hx_shift_right($tmp, 1) ^ -306674912;
						} else {
							$tmp = _hx_shift_right($tmp, 1);
						}
						unset($j);
					}
					unset($_g2);
				}
				$this->crc = _hx_shift_right($this->crc, 8) ^ $tmp;
				unset($tmp,$i);
			}
		}
	}
	public function byte($b) {
		$tmp = ($this->crc ^ $b) & 255;
		{
			$_g = 0;
			while($_g < 8) {
				$j = $_g++;
				if(($tmp & 1) === 1) {
					$tmp = _hx_shift_right($tmp, 1) ^ -306674912;
				} else {
					$tmp = _hx_shift_right($tmp, 1);
				}
				unset($j);
			}
		}
		$this->crc = _hx_shift_right($this->crc, 8) ^ $tmp;
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
	static function make($data) {
		$init = -1;
		$crc = $init;
		$b = $data->b;
		{
			$_g1 = 0; $_g = $data->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$tmp = ($crc ^ ord($b[$i])) & 255;
				{
					$_g2 = 0;
					while($_g2 < 8) {
						$j = $_g2++;
						if(($tmp & 1) === 1) {
							$tmp = _hx_shift_right($tmp, 1) ^ -306674912;
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
		return $crc ^ $init;
	}
	function __toString() { return 'haxe.crypto.Crc32'; }
}
