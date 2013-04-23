<?php

class haxe_crypto_Crc32 {
	public function __construct(){}
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
