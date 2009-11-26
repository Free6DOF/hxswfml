<?php

class format_abc_Context {
	public function __construct() {
		if( !php_Boot::$skip_constructor ) {
		$this->classSupers = new HList();
		$this->bytepos = new format_abc__Context_NullOutput();
		$this->opw = new format_abc_OpWriter($this->bytepos);
		$this->hstrings = new Hash();
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
		$this->beginFunction(new _hx_array(array()), null, null);
		$this->ops(new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::$OScope)));
		$this->init = $this->curFunction;
		$this->init->f->maxStack = 2;
		$this->init->f->maxScope = 2;
		$this->classes = new _hx_array(array());
		$this->data->inits = new _hx_array(array(_hx_anonymous(array("method" => $this->init->f->type, "fields" => $this->classes))));
	}}
	public $data;
	public $hstrings;
	public $curClass;
	public $curFunction;
	public $classes;
	public $init;
	public $fieldSlot;
	public $registers;
	public $bytepos;
	public $opw;
	public $classSupers;
	public $emptyString;
	public $nsPublic;
	public $arrayProp;
	public function int($i) {
		return $this->lookup($this->data->ints, $i);
	}
	public function uint($i) {
		return $this->lookup($this->data->uints, $i);
	}
	public function float($f) {
		return $this->lookup($this->data->floats, $f);
	}
	public function string($s) {
		$n = $this->hstrings->get($s);
		if($n === null) {
			$this->data->strings->push($s);
			$n = $this->data->strings->length;
			$this->hstrings->set($s, $n);
		}
		return format_abc_Index::Idx($n);
	}
	public function _namespace($n) {
		return $this->lookup($this->data->namespaces, $n);
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
				}
				if($ok) {
					return format_abc_Index::Idx($i + 1);
				}
				unset($s,$ok,$j,$i,$_g3,$_g2);
			}
		}
		$this->data->nssets->push($ns);
		return format_abc_Index::Idx($this->data->nssets->length);
	}
	public function name($n) {
		return $this->lookup($this->data->names, $n);
	}
	public function type($path) {
		if($path == "*") {
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
	public function property($pname, $ns) {
		$pid = $this->string("");
		$nameid = $this->string($pname);
		$pid1 = ($ns === null ? $this->_namespace(format_abc_Namespace::NPublic($pid)) : $ns);
		$tid = $this->name(format_abc_Name::NName($nameid, $pid1));
		return $tid;
	}
	public function methodType($m) {
		$this->data->methodTypes->push($m);
		return format_abc_Index::Idx($this->data->methodTypes->length - 1);
	}
	public function lookup($arr, $n) {
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
	public function getData() {
		return $this->data;
	}
	public function beginFunction($args, $ret, $extra) {
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
	public function allocRegister() {
		{
			$_g1 = 0; $_g = $this->registers->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(!$this->registers->»a[$i]) {
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
	public function freeRegister($i) {
		$this->registers[$i] = false;
	}
	public function beginClass($path) {
		$this->endClass();
		$tpath = $this->type($path);
		$this->beginFunction(new _hx_array(array()), null, null);
		$st = $this->curFunction->f->type;
		$this->op(format_abc_OpCode::$ORetVoid);
		$this->endFunction();
		$this->beginFunction(new _hx_array(array()), null, null);
		$cst = $this->curFunction->f->type;
		$this->op(format_abc_OpCode::$ORetVoid);
		$this->endFunction();
		$this->fieldSlot = 1;
		$this->curClass = _hx_anonymous(array("name" => $tpath, "superclass" => $this->type("Object"), "interfaces" => new _hx_array(array()), "isSealed" => false, "isInterface" => false, "isFinal" => false, "_namespace" => null, "constructor" => $cst, "statics" => $st, "fields" => new _hx_array(array()), "staticFields" => new _hx_array(array())));
		$this->data->classes->push($this->curClass);
		$this->classes->push(_hx_anonymous(array("name" => $tpath, "slot" => 0, "kind" => format_abc_FieldKind::FClass(format_abc_Index::Idx($this->data->classes->length - 1)), "metadatas" => null)));
		$this->curFunction = null;
		return $this->curClass;
	}
	public function endClass() {
		if(_hx_field($this, "curClass") === null) {
			return;
		}
		$this->endFunction();
		$this->curFunction = $this->init;
		$this->ops(new _hx_array(array(format_abc_OpCode::$OGetGlobalScope, format_abc_OpCode::OGetLex($this->type("Object")))));
		$»it = $this->classSupers->iterator();
		while($»it->hasNext()) {
		$sup = $»it->next();
		$this->ops(new _hx_array(array(format_abc_OpCode::$OScope, format_abc_OpCode::OGetLex($sup))));
		}
		$this->ops(new _hx_array(array(format_abc_OpCode::$OScope, format_abc_OpCode::OGetLex($this->curClass->superclass), format_abc_OpCode::OClassDef(format_abc_Index::Idx($this->data->classes->length - 1)), format_abc_OpCode::$OPopScope)));
		$»it2 = $this->classSupers->iterator();
		while($»it2->hasNext()) {
		$sup2 = $»it2->next();
		$this->op(format_abc_OpCode::$OPopScope);
		}
		$this->ops(new _hx_array(array(format_abc_OpCode::OInitProp($this->curClass->name))));
		$this->curFunction->f->maxScope += $this->classSupers->length;
		$this->curFunction = null;
		$this->curClass = null;
	}
	public function addClassSuper($sup) {
		if(_hx_field($this, "curClass") === null) {
			return;
		}
		$this->classSupers->add($this->type($sup));
	}
	public function beginMethod($mname, $targs, $tret, $isStatic, $isOverride, $isFinal, $willAddLater) {
		$m = $this->beginFunction($targs, $tret, null);
		if($willAddLater !== true) {
			$fl = ($isStatic ? $this->curClass->staticFields : $this->curClass->fields);
			$fl->push(_hx_anonymous(array("name" => $this->property($mname, null), "slot" => 0, "kind" => format_abc_FieldKind::FMethod($this->curFunction->f->type, format_abc_MethodKind::$KNormal, $isFinal, $isOverride), "metadatas" => null)));
		}
		return $this->curFunction->f;
	}
	public function endMethod() {
		$this->endFunction();
	}
	public function defineField($fname, $t, $isStatic) {
		$fl = ($isStatic ? $this->curClass->staticFields : $this->curClass->fields);
		$slot = $this->fieldSlot++;
		$fl->push(_hx_anonymous(array("name" => $this->property($fname, null), "slot" => $slot, "kind" => format_abc_FieldKind::FVar($t, null, null), "metadatas" => null)));
		return $slot;
	}
	public function op($o) {
		$this->curFunction->ops->push($o);
		$this->opw->write($o);
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
	public function backwardJump() {
		$start = $this->bytepos->n;
		$me = $this;
		$this->op(format_abc_OpCode::$OLabel);
		return array(new _hx_lambda(array("me" => &$me, "start" => &$start), null, array('jcond'), "{
			\$me->op(format_abc_OpCode::OJump(\$jcond, \$start - \$me->bytepos->n - 4));
		}"), 'execute1');
	}
	public function jump($jcond) {
		$ops = $this->curFunction->ops;
		$pos = $ops->length;
		$this->op(format_abc_OpCode::OJump(format_abc_JumpStyle::$JTrue, -1));
		$start = $this->bytepos->n;
		$me = $this;
		return array(new _hx_lambda(array("jcond" => &$jcond, "me" => &$me, "ops" => &$ops, "pos" => &$pos, "start" => &$start), null, array(), "{
			\$ops[\$pos] = format_abc_OpCode::OJump(\$jcond, \$me->bytepos->n - \$start);
		}"), 'execute0');
	}
	public function finalize() {
		$this->endClass();
		$this->curFunction = $this->init;
		$this->op(format_abc_OpCode::$ORetVoid);
		$this->endFunction();
		$this->curClass = null;
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	function __toString() { return 'format.abc.Context'; }
}
