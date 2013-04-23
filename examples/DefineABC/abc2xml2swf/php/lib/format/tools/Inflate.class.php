<?php

class format_tools_Inflate {
	public function __construct(){}
	static function run($bytes) {
		return format_tools_InflateImpl::run(new haxe_io_BytesInput($bytes, null, null), null);
	}
	function __toString() { return 'format.tools.Inflate'; }
}
