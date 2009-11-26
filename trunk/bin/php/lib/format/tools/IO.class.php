<?php

class format_tools_IO {
	public function __construct(){}
	static function copy($i, $o, $buf, $size) {
		$bufsize = $buf->length;
		while($size > 0) {
			$n = $i->readBytes($buf, 0, ($size > $bufsize ? $bufsize : $size));
			$size -= $n;
			$o->writeFullBytes($buf, 0, $n);
			unset($n);
		}
	}
	function __toString() { return 'format.tools.IO'; }
}
