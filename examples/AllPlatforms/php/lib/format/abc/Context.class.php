<?php

class format_abc_Context {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->classSupers = new HList();
		$this->bytepos = new format_abc__Context_NullOutput();
		$this->opw = new format_abc_OpWriter($this->bytepos);
		$this->hstrings = new haxe_ds_StringMap();
		$this->data = new format_abc_ABCData();
		$this->data->ints = new _hx_array(array());
		$this->data->uints = new _hx_array(array());
		$this->data->floats = new _hx_array(array());
		$this->data->strings = new _hx_array(array());
		$this->data->namespaces = new _hx_array(array());
		$this->data->nssets = new _hx_array(array());
		$this->data->metadatas = new _hx_array(array());
		$this->data->methodTypes = new _hx_array(array());
		$this->data->names = new _hx_array(array());
		$this->data->classes = new _hx_array(array());
		$this->data->functions = new _hx_array(array());
		$this->emptyString = $this->string("");
		$this->nsPublic = $this->_namespace(format_abc_Namespace::NPublic($this->emptyString));
		$this->arrayProp = $this->name(format_abc_Name::NMultiLate($this->nsset(new _hx_array(array($this->nsPublic)))));
		$this->classes = new _hx_array(array());
		$this->data->inits = new _hx_array(array());
	}}
	public function finalize() {
		$this->endClass(null);
		$this->curFunction = $this->init;
		$this->op(format_abc_OpCode::$ORetVoid);
		$this->endFunction();
		$this->curClass = null;
	}
	public function freeRegister($i) {
		$this->registers[$i] = false;
	}
	public function allocRegister() {
		{
			$_g1 = 0; $_g = $this->registers->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(!$this->registers[$i]) {
					$this->registers[$i] = true;
					return $i;
				}
				unset($i);
			}
		}
		$this->registers->push(true);
		$this->curFunction->f->nRegs++;
		return $this->registers->length - 1;
	}
	public function jump($jcond) {
		$ops = $this->curFunction->ops;
		$pos = $ops->length;
		$this->op(format_abc_OpCode::OJump(format_abc_JumpStyle::$JTrue, -1));
		$start = $this->bytepos->n;
		$me = $this;
		return array(new _hx_lambda(array(&$jcond, &$me, &$ops, &$pos, &$start), "format_abc_Context_0"), 'execute');
	}
	public function backwardJump() {
		$start = $this->bytepos->n;
		$me = $this;
		$this->op(format_abc_OpCode::$OLabel);
		return array(new _hx_lambda(array(&$me, &$start), "format_abc_Context_1"), 'execute');
	}
	public function switchCase($index) {
		$ops = $this->curFunction->ops;
		$pos = $ops->length;
		$start = $this->bytepos->n;
		$me = $this;
		return array(new _hx_lambda(array(&$index, &$me, &$ops, &$pos, &$start), "format_abc_Context_2"), 'execute');
	}
	public function switchDefault() {
		$ops = $this->curFunction->ops;
		$pos = $ops->length;
		$start = $this->bytepos->n;
		$me = $this;
		return array(new _hx_lambda(array(&$me, &$ops, &$pos, &$start), "format_abc_Context_3"), 'execute');
	}
	public function ops($ops) {
		$_g = 0;
		while($_g < $ops->length) {
			$o = $ops[$_g];
			++$_g;
			$this->op($o);
			unset($o);
		}
	}
	public function op($o) {
		$this->curFunction->ops->push($o);
		$this->opw->write($o);
	}
	public function defineField($fname, $t, $isStatic = null, $value = null, $_const = null, $ns = null, $slot = null) {
		$fl = format_abc_Context_4($this, $_const, $fname, $isStatic, $ns, $slot, $t, $value);
		$kind = format_abc_FieldKind::FVar($t, null, null);
		if($value !== null) {
			$kind = format_abc_FieldKind::FVar($t, $value, null);
			if($_const) {
				$kind = format_abc_FieldKind::FVar($t, $value, $_const);
			}
		}
		$fl->push(_hx_anonymous(array("name" => $this->property($fname, $ns), "slot" => (($slot === null) ? 0 : $slot), "kind" => $kind, "metadatas" => null)));
		return $fl->length;
	}
	public function endMethod() {
		$this->endFunction();
	}
	public function beginMethod($mname, $targs, $tret, $isStatic = null, $isOverride = null, $isFinal = null, $willAddLater = null, $kind = null, $extra = null, $ns = null) {
		$m = $this->beginFunction($targs, $tret, $extra);
		if($willAddLater !== true) {
			$fl = format_abc_Context_5($this, $extra, $isFinal, $isOverride, $isStatic, $kind, $m, $mname, $ns, $targs, $tret, $willAddLater);
			$fl->push(_hx_anonymous(array("name" => $this->property($mname, $ns), "slot" => $fl->length + 1, "kind" => format_abc_FieldKind::FMethod($this->curFunction->f->type, $kind, $isFinal, $isOverride), "metadatas" => null)));
		}
		return $this->curFunction->f;
	}
	public function endFunction() {
		if(_hx_field($this, "curFunction") === null) {
			return;
		}
		$old = $this->opw->o;
		$bytes = new haxe_io_BytesOutput();
		$this->opw->o = $bytes;
		{
			$_g = 0; $_g1 = $this->curFunction->ops;
			while($_g < $_g1->length) {
				$op = $_g1[$_g];
				++$_g;
				$this->opw->write($op);
				unset($op);
			}
		}
		$this->curFunction->f->code = $bytes->getBytes();
		$this->opw->o = $old;
		$this->curFunction = null;
	}
	public function beginFunction($args, $ret, $extra = null) {
		$this->endFunction();
		$f = _hx_anonymous(array("type" => $this->methodType(_hx_anonymous(array("args" => $args, "ret" => $ret, "extra" => $extra))), "nRegs" => $args->length + 1, "initScope" => 0, "maxScope" => 0, "maxStack" => 0, "code" => null, "trys" => new _hx_array(array()), "locals" => new _hx_array(array())));
		$this->curFunction = _hx_anonymous(array("f" => $f, "ops" => new _hx_array(array())));
		$this->data->functions->push($f);
		$this->registers = new _hx_array(array());
		{
			$_g1 = 0; $_g = $f->nRegs;
			while($_g1 < $_g) {
				$x = $_g1++;
				$this->registers->push(true);
				unset($x);
			}
		}
		return format_abc_Index::Idx($this->data->functions->length - 1);
	}
	public function beginInterfaceFunction($args, $ret, $extra = null) {
		$this->endFunction();
		$f = _hx_anonymous(array("type" => $this->methodType(_hx_anonymous(array("args" => $args, "ret" => $ret, "extra" => $extra))), "nRegs" => $args->length + 1, "initScope" => 0, "maxScope" => 0, "maxStack" => 0, "code" => null, "trys" => new _hx_array(array()), "locals" => new _hx_array(array())));
		$this->curFunction = _hx_anonymous(array("f" => $f, "ops" => new _hx_array(array())));
		return format_abc_Index::Idx($this->data->methodTypes->length - 1);
	}
	public function beginInterfaceMethod($mname, $targs, $tret, $isStatic = null, $isOverride = null, $isFinal = null, $willAddLater = null, $kind = null, $extra = null, $ns = null) {
		$m = $this->beginInterfaceFunction($targs, $tret, $extra);
		if($willAddLater !== true) {
			$fl = format_abc_Context_6($this, $extra, $isFinal, $isOverride, $isStatic, $kind, $m, $mname, $ns, $targs, $tret, $willAddLater);
			$fl->push(_hx_anonymous(array("name" => $this->property($mname, $ns), "slot" => $fl->length + 1, "kind" => format_abc_FieldKind::FMethod($this->curFunction->f->type, $kind, $isFinal, $isOverride), "metadatas" => null)));
		}
		return $this->curFunction->f;
	}
	public function addClassSuper($sup) {
		if(_hx_field($this, "curClass") === null) {
			return;
		}
		$this->classSupers->add($this->type($sup));
	}
	public function endClass($makeInit = null) {
		if($makeInit === null) {
			$makeInit = true;
		}
		if(_hx_field($this, "curClass") === null) {
			return;
		}
		$this->endFunction();
		if($makeInit) {
			$this->curFunction = $this->init;
			$this->ops(new _hx_array(array(format_abc_OpCode::$OGetGlobalScope, format_abc_OpCode::OGetLex($this->type("Object")))));
			if(null == $this->classSupers) throw new HException('null iterable');
			$__hx__it = $this->classSupers->iterator();
			while($__hx__it->hasNext()) {
				$sup = $__hx__it->next();
				$this->ops(new _hx_array(array(format_abc_OpCode::$OScope, format_abc_OpCode::OGetLex($sup))));
			}
			$this->ops(new _hx_array(array(format_abc_OpCode::$OScope, format_abc_OpCode::OGetLex($this->curClass->superclass), format_abc_OpCode::OClassDef(format_abc_Index::Idx($this->data->classes->length - 1)), format_abc_OpCode::$OPopScope)));
			if(null == $this->classSupers) throw new HException('null iterable');
			$__hx__it = $this->classSupers->iterator();
			while($__hx__it->hasNext()) {
				$sup = $__hx__it->next();
				$this->op(format_abc_OpCode::$OPopScope);
			}
			$this->ops(new _hx_array(array(format_abc_OpCode::OInitProp($this->curClass->name))));
			$this->curFunction->f->maxScope += $this->classSupers->length;
			$this->op(format_abc_OpCode::$ORetVoid);
			$this->endFunction();
		} else {
			$this->curFunction = $this->init;
			$this->op(format_abc_OpCode::$ORetVoid);
			$this->endFunction();
		}
		if($this->curClass->statics === null) {
			$this->beginFunction(new _hx_array(array()), null, null);
			$st = $this->curFunction->f->type;
			$this->curClass->statics = $st;
			$this->curFunction->f->maxStack = 1;
			$this->curFunction->f->maxScope = 1;
			$this->op(format_abc_OpCode::$OThis);
			$this->op(format_abc_OpCode::$OScope);
			$this->op(format_abc_OpCode::$ORetVoid);
			$this->endFunction();
		}
		$this->curFunction = null;
		$this->curClass = null;
	}
	public function beginClass($path, $isInterface = null) {
		$this->classSupers = new HList();
		if(!$isInterface) {
			$this->beginFunction(new _hx_array(array()), null, null);
		} else {
			$this->beginInterfaceFunction(new _hx_array(array()), null, null);
		}
		$this->ops(new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::$OScope)));
		$this->init = $this->curFunction;
		$this->init->f->maxStack = 2;
		$this->init->f->maxScope = 2;
		$script = _hx_anonymous(array("method" => $this->init->f->type, "fields" => new _hx_array(array())));
		$this->data->inits->push($script);
		$this->classes = $script->fields;
		$this->endClass(null);
		$tpath = $this->type($path);
		$this->fieldSlot = 1;
		$this->curClass = _hx_anonymous(array("name" => $tpath, "superclass" => $this->type("Object"), "interfaces" => new _hx_array(array()), "isSealed" => false, "isInterface" => false, "isFinal" => false, "_namespace" => null, "constructor" => null, "statics" => null, "fields" => new _hx_array(array()), "staticFields" => new _hx_array(array())));
		$this->data->classes->push($this->curClass);
		$this->classes->push(_hx_anonymous(array("name" => $tpath, "slot" => $this->classes->length + 1, "kind" => format_abc_FieldKind::FClass(format_abc_Index::Idx($this->data->classes->length - 1)), "metadatas" => null)));
		$this->curFunction = null;
		return $this->curClass;
	}
	public function getClass($n) {
		{
			$_g1 = 0; $_g = $this->data->classes->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(_hx_equal($this->data->classes[$i], $n)) {
					return format_abc_Index::Idx($i);
				}
				unset($i);
			}
		}
		throw new HException("unknown class: " . Std::string($n));
	}
	public function methodType($m) {
		$this->data->methodTypes->push($m);
		return format_abc_Index::Idx($this->data->methodTypes->length - 1);
	}
	public function property($pname, $ns = null) {
		$tid = null;
		if(_hx_index_of($pname, ".", null) !== -1) {
			$tid = $this->type($pname);
		} else {
			$pid = $this->string("");
			$nameid = $this->string($pname);
			$pid1 = (($ns === null) ? $this->_namespace(format_abc_Namespace::NPublic($pid)) : $ns);
			$tid = $this->name(format_abc_Name::NName($nameid, $pid1));
		}
		return $tid;
	}
	public function typeParams($path) {
		if($path === "*") {
			return null;
		}
		$parts = _hx_explode(" params:", $path);
		$_path = $parts[0];
		$__path = $this->type($_path);
		$_params = _hx_explode(",", $parts[1]);
		$__params = new _hx_array(array());
		{
			$_g1 = 0; $_g = $_params->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$__params->push($this->type($_params[$i]));
				unset($i);
			}
		}
		$tid = $this->name(format_abc_Name::NParams($__path, $__params));
		return $tid;
	}
	public function type($path) {
		if($path !== null && _hx_index_of($path, " params:", null) !== -1) {
			return $this->typeParams($path);
		}
		if($path === "*") {
			return null;
		}
		$patharr = _hx_explode(".", $path);
		$cname = $patharr->pop();
		$ns = $patharr->join(".");
		$pid = $this->string($ns);
		$nameid = $this->string($cname);
		$pid1 = $this->_namespace(format_abc_Namespace::NPublic($pid));
		$tid = $this->name(format_abc_Name::NName($nameid, $pid1));
		return $tid;
	}
	public function name($n) {
		$arr = $this->data->names;
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(Type::enumEq($arr[$i], $n)) {
					return format_abc_Index::Idx($i + 1);
				}
				unset($i);
			}
		}
		$arr->push($n);
		return format_abc_Index::Idx($arr->length);
	}
	public function nsset($ns) {
		{
			$_g1 = 0; $_g = $this->data->nssets->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$s = $this->data->nssets[$i];
				if($s->length !== $ns->length) {
					continue;
				}
				$ok = true;
				{
					$_g3 = 0; $_g2 = $s->length;
					while($_g3 < $_g2) {
						$j = $_g3++;
						if(!Type::enumEq($s[$j], $ns[$j])) {
							$ok = false;
							break;
						}
						unset($j);
					}
					unset($_g3,$_g2);
				}
				if($ok) {
					return format_abc_Index::Idx($i + 1);
				}
				unset($s,$ok,$i);
			}
		}
		$this->data->nssets->push($ns);
		return format_abc_Index::Idx($this->data->nssets->length);
	}
	public function _namespace($n) {
		$arr = $this->data->namespaces;
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(Type::enumEq($arr[$i], $n)) {
					return format_abc_Index::Idx($i + 1);
				}
				unset($i);
			}
		}
		$arr->push($n);
		return format_abc_Index::Idx($arr->length);
	}
	public function string($s) {
		if($s === null) {
			return format_abc_Index::Idx(0);
		}
		$n = $this->hstrings->get($s);
		if($n === null) {
			$this->data->strings->push($s);
			$n = $this->data->strings->length;
			$this->hstrings->set($s, $n);
		}
		return format_abc_Index::Idx($n);
	}
	public function float($f) {
		$arr = $this->data->floats;
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if($arr[$i] === $f) {
					return format_abc_Index::Idx($i + 1);
				}
				unset($i);
			}
		}
		$arr->push($f);
		return format_abc_Index::Idx($arr->length);
	}
	public function uint($n) {
		$arr = $this->data->uints;
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if($arr[$i] === $n) {
					return format_abc_Index::Idx($i + 1);
				}
				unset($i);
			}
		}
		$arr->push($n);
		return format_abc_Index::Idx($arr->length);
	}
	public function int($n) {
		$arr = $this->data->ints;
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if($arr[$i] === $n) {
					return format_abc_Index::Idx($i + 1);
				}
				unset($i);
			}
		}
		$arr->push($n);
		return format_abc_Index::Idx($arr->length);
	}
	public function elookup($arr, $n) {
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(Type::enumEq($arr[$i], $n)) {
					return format_abc_Index::Idx($i + 1);
				}
				unset($i);
			}
		}
		$arr->push($n);
		return format_abc_Index::Idx($arr->length);
	}
	public function lookup($arr, $n) {
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if($arr[$i] == $n) {
					return format_abc_Index::Idx($i + 1);
				}
				unset($i);
			}
		}
		$arr->push($n);
		return format_abc_Index::Idx($arr->length);
	}
	public function getData() {
		return $this->data;
	}
	public $arrayProp;
	public $nsPublic;
	public $emptyString;
	public $classSupers;
	public $opw;
	public $bytepos;
	public $registers;
	public $fieldSlot;
	public $init;
	public $classes;
	public $curClass;
	public $hstrings;
	public $data;
	public $isExtending;
	public $curFunction;
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
	function __toString() { return 'format.abc.Context'; }
}
function format_abc_Context_0(&$jcond, &$me, &$ops, &$pos, &$start) {
	{
		$ops[$pos] = format_abc_OpCode::OJump($jcond, $me->bytepos->n - $start);
	}
}
function format_abc_Context_1(&$me, &$start, $jcond) {
	{
		if($jcond === null) {
			return $start - $me->bytepos->n;
		} else {
			$me->op(format_abc_OpCode::OJump($jcond, $start - $me->bytepos->n - 4));
			return 0;
		}
	}
}
function format_abc_Context_2(&$index, &$me, &$ops, &$pos, &$start) {
	{
		$ops[$pos] = format_abc_Context_7($__hx__this, $index, $me, $ops, $pos, $start);
	}
}
function format_abc_Context_3(&$me, &$ops, &$pos, &$start) {
	{
		$ops[$pos] = format_abc_Context_8($__hx__this, $me, $ops, $pos, $start);
	}
}
function format_abc_Context_4(&$__hx__this, &$_const, &$fname, &$isStatic, &$ns, &$slot, &$t, &$value) {
	if($isStatic) {
		return $__hx__this->curClass->staticFields;
	} else {
		return $__hx__this->curClass->fields;
	}
}
function format_abc_Context_5(&$__hx__this, &$extra, &$isFinal, &$isOverride, &$isStatic, &$kind, &$m, &$mname, &$ns, &$targs, &$tret, &$willAddLater) {
	if($isStatic) {
		return $__hx__this->curClass->staticFields;
	} else {
		return $__hx__this->curClass->fields;
	}
}
function format_abc_Context_6(&$__hx__this, &$extra, &$isFinal, &$isOverride, &$isStatic, &$kind, &$m, &$mname, &$ns, &$targs, &$tret, &$willAddLater) {
	if($isStatic) {
		return $__hx__this->curClass->staticFields;
	} else {
		return $__hx__this->curClass->fields;
	}
}
function format_abc_Context_7(&$__hx__this, &$index, &$me, &$ops, &$pos, &$start) {
	$__hx__t = ($ops[$pos]);
	switch($__hx__t->index) {
	case 13:
	$cases = $__hx__t->params[1]; $def = $__hx__t->params[0];
	{
		$cases[$index] = $me->bytepos->n - $start;
		return format_abc_OpCode::OSwitch($def, $cases);
	}break;
	default:{
		return format_abc_OpCode::OSwitch(0, new _hx_array(array()));
	}break;
	}
}
function format_abc_Context_8(&$__hx__this, &$me, &$ops, &$pos, &$start) {
	$__hx__t = ($ops[$pos]);
	switch($__hx__t->index) {
	case 13:
	$cases = $__hx__t->params[1]; $def = $__hx__t->params[0];
	{
		return format_abc_OpCode::OSwitch($me->bytepos->n - $start, $cases);
	}break;
	default:{
		return format_abc_OpCode::OSwitch(0, new _hx_array(array()));
	}break;
	}
}
