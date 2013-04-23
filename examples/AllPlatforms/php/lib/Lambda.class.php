<?php

class Lambda {
	public function __construct(){}
	static function harray($it) {
		$a = new _hx_array(array());
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$i = $__hx__it->next();
			$a->push($i);
		}
		return $a;
	}
	static function hlist($it) {
		$l = new HList();
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$i = $__hx__it->next();
			$l->add($i);
		}
		return $l;
	}
	static function map($it, $f) {
		$l = new HList();
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			$l->add(call_user_func_array($f, array($x)));
		}
		return $l;
	}
	static function mapi($it, $f) {
		$l = new HList();
		$i = 0;
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			$l->add(call_user_func_array($f, array($i++, $x)));
		}
		return $l;
	}
	static function has($it, $elt) {
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			if($x == $elt) {
				return true;
			}
		}
		return false;
	}
	static function exists($it, $f) {
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			if(call_user_func_array($f, array($x))) {
				return true;
			}
		}
		return false;
	}
	static function hforeach($it, $f) {
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			if(!call_user_func_array($f, array($x))) {
				return false;
			}
		}
		return true;
	}
	static function iter($it, $f) {
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			call_user_func_array($f, array($x));
		}
	}
	static function filter($it, $f) {
		$l = new HList();
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			if(call_user_func_array($f, array($x))) {
				$l->add($x);
			}
		}
		return $l;
	}
	static function fold($it, $f, $first) {
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			$first = call_user_func_array($f, array($x, $first));
		}
		return $first;
	}
	static function count($it, $pred = null) {
		$n = 0;
		if($pred === null) {
			if(null == $it) throw new HException('null iterable');
			$__hx__it = $it->iterator();
			while($__hx__it->hasNext()) {
				$_ = $__hx__it->next();
				$n++;
			}
		} else {
			if(null == $it) throw new HException('null iterable');
			$__hx__it = $it->iterator();
			while($__hx__it->hasNext()) {
				$x = $__hx__it->next();
				if(call_user_func_array($pred, array($x))) {
					$n++;
				}
			}
		}
		return $n;
	}
	static function hempty($it) {
		return !$it->iterator()->hasNext();
	}
	static function indexOf($it, $v) {
		$i = 0;
		if(null == $it) throw new HException('null iterable');
		$__hx__it = $it->iterator();
		while($__hx__it->hasNext()) {
			$v2 = $__hx__it->next();
			if($v == $v2) {
				return $i;
			}
			$i++;
		}
		return -1;
	}
	static function concat($a, $b) {
		$l = new HList();
		if(null == $a) throw new HException('null iterable');
		$__hx__it = $a->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			$l->add($x);
		}
		if(null == $b) throw new HException('null iterable');
		$__hx__it = $b->iterator();
		while($__hx__it->hasNext()) {
			$x = $__hx__it->next();
			$l->add($x);
		}
		return $l;
	}
	function __toString() { return 'Lambda'; }
}
