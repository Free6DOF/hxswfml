<?php

class Reflect {
	public function __construct(){}
	static function field($o, $field) {
		return _hx_field($o, $field);
	}
	static function callMethod($o, $func, $args) {
		if(is_string($o) && !is_array($func)) {
			return call_user_func_array(Reflect::field($o, $func), $args->a);
		}
		return call_user_func_array(((is_callable($func)) ? $func : array($o, $func)), ((null === $args) ? array() : $args->a));
	}
	static function fields($o) {
		if($o === null) {
			return new _hx_array(array());
		}
		return (($o instanceof _hx_array) ? new _hx_array(array('concat','copy','insert','iterator','length','join','pop','push','remove','reverse','shift','slice','sort','splice','toString','unshift')) : ((is_string($o)) ? new _hx_array(array('charAt','charCodeAt','indexOf','lastIndexOf','length','split','substr','toLowerCase','toString','toUpperCase')) : new _hx_array(_hx_get_object_vars($o))));
	}
	static function isFunction($f) {
		return (is_array($f) && is_callable($f)) || _hx_is_lambda($f) || is_array($f) && _hx_has_field($f[0], $f[1]) && $f[1] !== "length";
	}
	function __toString() { return 'Reflect'; }
}
