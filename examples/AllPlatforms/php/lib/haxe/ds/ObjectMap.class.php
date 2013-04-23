<?php

class haxe_ds_ObjectMap implements IMap{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->h = array();
		$this->hk = array();
	}}
	public function toString() {
		$s = "{";
		$it = new _hx_array_iterator(array_values($this->hk));
		$__hx__it = $it;
		while($__hx__it->hasNext()) {
			$i = $__hx__it->next();
			$s .= Std::string($i);
			$s .= " => ";
			$s .= Std::string($this->get($i));
			if($it->hasNext()) {
				$s .= ", ";
			}
		}
		return _hx_string_or_null($s) . "}";
	}
	public function iterator() {
		return new _hx_array_iterator(array_values($this->h));
	}
	public function keys() {
		return new _hx_array_iterator(array_values($this->hk));
	}
	public function remove($key) {
		$id = haxe_ds_ObjectMap::getId($key);
		if(array_key_exists($id, $this->h)) {
			unset($this->h[$id]);
			unset($this->hk[$id]);
			return true;
		} else {
			return false;
		}
	}
	public function exists($key) {
		return array_key_exists(haxe_ds_ObjectMap::getId($key), $this->h);
	}
	public function get($key) {
		$id = haxe_ds_ObjectMap::getId($key);
		if(array_key_exists($id, $this->h)) {
			return $this->h[$id];
		} else {
			return null;
		}
	}
	public function set($key, $value) {
		$id = haxe_ds_ObjectMap::getId($key);
		$this->h[$id] = $value;
		$this->hk[$id] = $key;
	}
	public $hk;
	public $h;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	static function getId($key) {
		return spl_object_hash($key);
	}
	function __toString() { return $this->toString(); }
}
