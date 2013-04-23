<?php

class haxe_ds_WeakMap implements IMap{
	public function __construct() { if(!php_Boot::$skip_constructor) {
		throw new HException("Not implemented for this platform");
	}}
	public function toString() {
		return null;
	}
	public function iterator() {
		return null;
	}
	public function keys() {
		return null;
	}
	public function remove($key) {
		return false;
	}
	public function exists($key) {
		return false;
	}
	public function get($key) {
		return null;
	}
	public function set($key, $value) {
	}
	function __toString() { return $this->toString(); }
}
