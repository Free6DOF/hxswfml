<?php

class Sys {
	public function __construct(){}
	static function hprint($v) {
		echo(Std::string($v));
	}
	static function println($v) {
		Sys::hprint($v);
		Sys::hprint("\x0A");
	}
	static function args() {
		return ((array_key_exists("argv", $_SERVER)) ? new _hx_array(array_slice($_SERVER["argv"], 1)) : new _hx_array(array()));
	}
	static function hexit($code) {
		exit($code);
	}
	function __toString() { return 'Sys'; }
}
