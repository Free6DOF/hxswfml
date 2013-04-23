<?php

class format_amf_Tools {
	public function __construct(){}
	static function encode($o) {
		return format_amf_Tools_0($o);
	}
	static function number($a) {
		if($a === null) {
			return null;
		}
		return format_amf_Tools_1($a);
	}
	static function string($a) {
		if($a === null) {
			return null;
		}
		return format_amf_Tools_2($a);
	}
	static function object($a) {
		if($a === null) {
			return null;
		}
		return format_amf_Tools_3($a);
	}
	static function abool($a) {
		if($a === null) {
			return null;
		}
		return format_amf_Tools_4($a);
	}
	static function harray($a) {
		if($a === null) {
			return null;
		}
		return format_amf_Tools_5($a);
	}
	function __toString() { return 'format.amf.Tools'; }
}
function format_amf_Tools_0(&$o) {
	$__hx__t = (Type::typeof($o));
	switch($__hx__t->index) {
	case 0:
	{
		return format_amf_Value::$ANull;
	}break;
	case 1:
	{
		return format_amf_Value::ANumber($o);
	}break;
	case 2:
	{
		return format_amf_Value::ANumber($o);
	}break;
	case 3:
	{
		return format_amf_Value::ABool($o);
	}break;
	case 4:
	{
		$h = new haxe_ds_StringMap();
		{
			$_g = 0; $_g1 = Reflect::fields($o);
			while($_g < $_g1->length) {
				$f = $_g1[$_g];
				++$_g;
				$h->set($f, format_amf_Tools::encode(Reflect::field($o, $f)));
				unset($f);
			}
		}
		return format_amf_Value::AObject($h, null);
	}break;
	case 6:
	$c = $__hx__t->params[0];
	{
		switch($c) {
		case _hx_qtype("String"):{
			return format_amf_Value::AString($o);
		}break;
		case _hx_qtype("haxe.ds.StringMap"):{
			$o1 = $o;
			$h = new haxe_ds_StringMap();
			if(null == $o1) throw new HException('null iterable');
			$__hx__it = $o1->keys();
			while($__hx__it->hasNext()) {
				$f = $__hx__it->next();
				$h->set($f, format_amf_Tools::encode($o1->get($f)));
			}
			return format_amf_Value::AObject($h, null);
		}break;
		case _hx_qtype("Array"):{
			$o1 = $o;
			$a = new _hx_array(array());
			{
				$_g = 0;
				while($_g < $o1->length) {
					$v = $o1[$_g];
					++$_g;
					$a->push(format_amf_Tools::encode($v));
					unset($v);
				}
			}
			return format_amf_Value::AArray($a);
		}break;
		default:{
			throw new HException("Can't encode instance of " . _hx_string_or_null(Type::getClassName($c)));
		}break;
		}
	}break;
	default:{
		throw new HException("Can't encode " . Std::string($o));
	}break;
	}
}
function format_amf_Tools_1(&$a) {
	$__hx__t = ($a);
	switch($__hx__t->index) {
	case 0:
	$n = $__hx__t->params[0];
	{
		return $n;
	}break;
	default:{
		return null;
	}break;
	}
}
function format_amf_Tools_2(&$a) {
	$__hx__t = ($a);
	switch($__hx__t->index) {
	case 2:
	$s = $__hx__t->params[0];
	{
		return $s;
	}break;
	default:{
		return null;
	}break;
	}
}
function format_amf_Tools_3(&$a) {
	$__hx__t = ($a);
	switch($__hx__t->index) {
	case 3:
	$o = $__hx__t->params[0];
	{
		return $o;
	}break;
	default:{
		return null;
	}break;
	}
}
function format_amf_Tools_4(&$a) {
	$__hx__t = ($a);
	switch($__hx__t->index) {
	case 1:
	$b = $__hx__t->params[0];
	{
		return $b;
	}break;
	default:{
		return null;
	}break;
	}
}
function format_amf_Tools_5(&$a) {
	$__hx__t = ($a);
	switch($__hx__t->index) {
	case 7:
	$a1 = $__hx__t->params[0];
	{
		return $a1;
	}break;
	default:{
		return null;
	}break;
	}
}
