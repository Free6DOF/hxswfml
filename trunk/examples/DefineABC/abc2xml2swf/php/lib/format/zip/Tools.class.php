<?php

class format_zip_Tools {
	public function __construct(){}
	static function uncompress($f) {
		if(!$f->compressed) {
			return;
		}
		throw new HException("No uncompress support");
	}
	static function compress($f, $level) {
		if($f->compressed) {
			return;
		}
		throw new HException("No compress support");
	}
	function __toString() { return 'format.zip.Tools'; }
}
