<?php

class format_flv_Tools {
	public function __construct(){}
	static function isVideoKeyFrame($data) {
		return ord($data->b[0]) >> 4 === 1;
	}
	function __toString() { return 'format.flv.Tools'; }
}
