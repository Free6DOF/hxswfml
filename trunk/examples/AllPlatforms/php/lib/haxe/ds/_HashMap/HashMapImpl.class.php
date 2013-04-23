<?php

class haxe_ds__HashMap_HashMapImpl {
	public function __construct(){}
	static function _new() {
		return _hx_anonymous(array("keys" => new haxe_ds_IntMap(), "values" => new haxe_ds_IntMap()));
	}
	static function set($this1, $k, $v) {
		$this1->keys->set($k->hashCode(), $k);
		$this1->values->set($k->hashCode(), $v);
	}
	static function get($this1, $k) {
		return $this1->values->get($k->hashCode());
	}
	static function exists($this1, $k) {
		return $this1->values->exists($k->hashCode());
	}
	static function remove($this1, $k) {
		$this1->values->remove($k->hashCode());
		return $this1->keys->remove($k->hashCode());
	}
	static function keys($this1) {
		return $this1->keys->iterator();
	}
	static function iterator($this1) {
		return $this1->values->iterator();
	}
	static function toIMap($this1) {
		return $this1;
	}
	function __toString() { return 'haxe.ds._HashMap.HashMapImpl'; }
}
