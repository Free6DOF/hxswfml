<?php

class format_tools_Deflate {
	public function __construct(){}
	static function run($b) {
		throw new HException("Deflate is not supported on this platform");
		return null;
	}
	function __toString() { return 'format.tools.Deflate'; }
}
