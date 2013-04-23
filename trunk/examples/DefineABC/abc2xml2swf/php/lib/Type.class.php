<?php

class Type {
	public function __construct(){}
	static function getEnum($o) {
		if(!$o instanceof Enum) {
			return null;
		} else {
			return _hx_ttype(get_class($o));
		}
	}
	static function getClassName($c) {
		if($c === null) {
			return null;
		}
		return $c->__qname__;
	}
	static function getEnumName($e) {
		return $e->__qname__;
	}
	static function createEnum($e, $constr, $params = null) {
		$f = Reflect::field($e, $constr);
		if($f === null) {
			throw new HException("No such constructor " . _hx_string_or_null($constr));
		}
		if(Reflect::isFunction($f)) {
			if($params === null) {
				throw new HException("Constructor " . _hx_string_or_null($constr) . " need parameters");
			}
			return Reflect::callMethod($e, $f, $params);
		}
		if($params !== null && $params->length !== 0) {
			throw new HException("Constructor " . _hx_string_or_null($constr) . " does not need parameters");
		}
		return $f;
	}
	static function getEnumConstructs($e) {
		if($e->__tname__ == 'Bool') {
			return new _hx_array(array("true", "false"));
		}
		if($e->__tname__ == 'Void') {
			return new _hx_array(array());
		}
		return new _hx_array($e->__constructors);
	}
	static function typeof($v) {
		if($v === null) {
			return ValueType::$TNull;
		}
		if(is_array($v)) {
			if(is_callable($v)) {
				return ValueType::$TFunction;
			}
			return ValueType::TClass(_hx_qtype("Array"));
		}
		if(is_string($v)) {
			if(_hx_is_lambda($v)) {
				return ValueType::$TFunction;
			}
			return ValueType::TClass(_hx_qtype("String"));
		}
		if(is_bool($v)) {
			return ValueType::$TBool;
		}
		if(is_int($v)) {
			return ValueType::$TInt;
		}
		if(is_float($v)) {
			return ValueType::$TFloat;
		}
		if($v instanceof _hx_anonymous) {
			return ValueType::$TObject;
		}
		if($v instanceof _hx_enum) {
			return ValueType::$TObject;
		}
		if($v instanceof _hx_class) {
			return ValueType::$TObject;
		}
		$c = _hx_ttype(get_class($v));
		if($c instanceof _hx_enum) {
			return ValueType::TEnum($c);
		}
		if($c instanceof _hx_class) {
			return ValueType::TClass($c);
		}
		return ValueType::$TUnknown;
	}
	static function enumEq($a, $b) {
		if($a == $b) {
			return true;
		}
		try {
			if(!_hx_equal($a->index, $b->index)) {
				return false;
			}
			{
				$_g1 = 0; $_g = count($a->params);
				while($_g1 < $_g) {
					$i = $_g1++;
					if(Type::getEnum($a->params[$i]) !== null) {
						if(!Type::enumEq($a->params[$i], $b->params[$i])) {
							return false;
						}
					} else {
						if(!_hx_equal($a->params[$i], $b->params[$i])) {
							return false;
						}
					}
					unset($i);
				}
			}
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return false;
			}
		}
		return true;
	}
	static function enumConstructor($e) {
		return $e->tag;
	}
	static function enumParameters($e) {
		if(_hx_field($e, "params") === null) {
			return new _hx_array(array());
		} else {
			return new _hx_array($e->params);
		}
	}
	function __toString() { return 'Type'; }
}
