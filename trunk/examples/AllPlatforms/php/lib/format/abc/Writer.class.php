<?php

class format_abc_Writer {
	public function __construct($o) {
		if(!php_Boot::$skip_constructor) {
		$this->o = $o;
		$this->opw = new format_abc_OpWriter($o);
	}}
	public function write($d) {
		$_g = $this;
		$this->o->writeInt32(3014672);
		$this->writeList($d->ints, (isset($this->opw->writeInt32) ? $this->opw->writeInt32: array($this->opw, "writeInt32")));
		$this->writeList($d->uints, (isset($this->opw->writeInt32) ? $this->opw->writeInt32: array($this->opw, "writeInt32")));
		$this->writeList($d->floats, (isset($this->o->writeDouble) ? $this->o->writeDouble: array($this->o, "writeDouble")));
		$this->writeList($d->strings, (isset($this->writeString) ? $this->writeString: array($this, "writeString")));
		$this->writeList($d->namespaces, (isset($this->writeNamespace) ? $this->writeNamespace: array($this, "writeNamespace")));
		$this->writeList($d->nssets, (isset($this->writeNsSet) ? $this->writeNsSet: array($this, "writeNsSet")));
		$this->writeList($d->names, array(new _hx_lambda(array(&$_g, &$d), "format_abc_Writer_0"), 'execute'));
		$this->writeList2($d->methodTypes, (isset($this->writeMethodType) ? $this->writeMethodType: array($this, "writeMethodType")));
		$this->writeList2($d->metadatas, (isset($this->writeMetadata) ? $this->writeMetadata: array($this, "writeMetadata")));
		$this->writeList2($d->classes, (isset($this->writeClass) ? $this->writeClass: array($this, "writeClass")));
		{
			$_g1 = 0; $_g11 = $d->classes;
			while($_g1 < $_g11->length) {
				$c = $_g11[$_g1];
				++$_g1;
				$this->writeIndex($c->statics);
				$this->writeList2($c->staticFields, (isset($this->writeField) ? $this->writeField: array($this, "writeField")));
				unset($c);
			}
		}
		$this->writeList2($d->inits, (isset($this->writeInit) ? $this->writeInit: array($this, "writeInit")));
		$this->writeList2($d->functions, (isset($this->writeFunction) ? $this->writeFunction: array($this, "writeFunction")));
	}
	public function writeFunction($f) {
		$this->writeIndex($f->type);
		$this->opw->writeInt($f->maxStack);
		$this->opw->writeInt($f->nRegs);
		$this->opw->writeInt($f->initScope);
		$this->opw->writeInt($f->maxScope);
		$this->opw->writeInt($f->code->length);
		$this->o->write($f->code);
		$this->writeList2($f->trys, (isset($this->writeTryCatch) ? $this->writeTryCatch: array($this, "writeTryCatch")));
		$this->writeList2($f->locals, (isset($this->writeField) ? $this->writeField: array($this, "writeField")));
	}
	public function writeTryCatch($t) {
		$this->opw->writeInt($t->start);
		$this->opw->writeInt($t->end);
		$this->opw->writeInt($t->handle);
		$this->writeIndexOpt($t->type);
		$this->writeIndexOpt($t->variable);
	}
	public function writeInit($i) {
		$this->writeIndex($i->method);
		$this->writeList2($i->fields, (isset($this->writeField) ? $this->writeField: array($this, "writeField")));
	}
	public function writeClass($c) {
		$this->writeIndex($c->name);
		$this->writeIndexOpt($c->superclass);
		$flags = 0;
		if($c->isSealed) {
			$flags |= 1;
		}
		if($c->isFinal) {
			$flags |= 2;
		}
		if($c->isInterface) {
			$flags |= 4;
		}
		if($c->_namespace !== null) {
			$flags |= 8;
		}
		$this->o->writeByte($flags);
		if($c->_namespace !== null) {
			$this->writeIndex($c->_namespace);
		}
		$this->writeList2($c->interfaces, (isset($this->writeIndex) ? $this->writeIndex: array($this, "writeIndex")));
		if($c->constructor === null) {
			throw new HException("missing constructor for class with index: " . Std::string($c->name));
		}
		$this->writeIndex($c->constructor);
		$this->writeList2($c->fields, (isset($this->writeField) ? $this->writeField: array($this, "writeField")));
	}
	public function writeMetadata($m) {
		$this->writeIndex($m->name);
		$this->opw->writeInt($m->data->length);
		{
			$_g = 0; $_g1 = $m->data;
			while($_g < $_g1->length) {
				$d = $_g1[$_g];
				++$_g;
				$this->writeIndex($d->n);
				unset($d);
			}
		}
		{
			$_g = 0; $_g1 = $m->data;
			while($_g < $_g1->length) {
				$d = $_g1[$_g];
				++$_g;
				$this->writeIndex($d->v);
				unset($d);
			}
		}
	}
	public function writeMethodType($m) {
		$this->o->writeByte($m->args->length);
		$this->writeIndexOpt($m->ret);
		{
			$_g = 0; $_g1 = $m->args;
			while($_g < $_g1->length) {
				$a = $_g1[$_g];
				++$_g;
				$this->writeIndexOpt($a);
				unset($a);
			}
		}
		$x = $m->extra;
		if($x === null) {
			$this->writeIndexOpt(null);
			$this->o->writeByte(0);
			return;
		}
		$this->writeIndexOpt($x->debugName);
		$flags = 0;
		if($x->argumentsDefined) {
			$flags |= 1;
		}
		if($x->newBlock) {
			$flags |= 2;
		}
		if($x->variableArgs) {
			$flags |= 4;
		}
		if($x->defaultParameters !== null) {
			$flags |= 8;
		}
		if($x->unused) {
			$flags |= 16;
		}
		if($x->native) {
			$flags |= 32;
		}
		if($x->usesDXNS) {
			$flags |= 64;
		}
		if($x->paramNames !== null) {
			$flags |= 128;
		}
		$this->o->writeByte($flags);
		if($x->defaultParameters !== null) {
			$this->o->writeByte($x->defaultParameters->length);
			{
				$_g = 0; $_g1 = $x->defaultParameters;
				while($_g < $_g1->length) {
					$v = $_g1[$_g];
					++$_g;
					$this->writeValue(true, $v);
					unset($v);
				}
			}
		}
		if($x->paramNames !== null) {
			if($x->paramNames->length !== $m->args->length) {
				throw new HException("assert");
			}
			{
				$_g = 0; $_g1 = $x->paramNames;
				while($_g < $_g1->length) {
					$i = $_g1[$_g];
					++$_g;
					$this->writeIndexOpt($i);
					unset($i);
				}
			}
		}
	}
	public function writeField($f) {
		$this->writeIndex($f->name);
		$flags = 0;
		if($f->metadatas !== null) {
			$flags |= 64;
		}
		$__hx__t = ($f->kind);
		switch($__hx__t->index) {
		case 0:
		$_const = $__hx__t->params[2]; $v = $__hx__t->params[1]; $t = $__hx__t->params[0];
		{
			$this->o->writeByte(((($_const) ? 6 : 0)) | $flags);
			$this->opw->writeInt($f->slot);
			$this->writeIndexOpt($t);
			$this->writeValue(false, $v);
		}break;
		case 1:
		$isOverride = $__hx__t->params[3]; $isFinal = $__hx__t->params[2]; $k = $__hx__t->params[1]; $t = $__hx__t->params[0];
		{
			if($isFinal) {
				$flags |= 16;
			}
			if($isOverride) {
				$flags |= 32;
			}
			$__hx__t2 = ($k);
			switch($__hx__t2->index) {
			case 0:
			{
				$flags |= 1;
			}break;
			case 1:
			{
				$flags |= 2;
			}break;
			case 2:
			{
				$flags |= 3;
			}break;
			}
			$this->o->writeByte($flags);
			if($isOverride) {
				$this->opw->writeInt(0);
			} else {
				$this->opw->writeInt($f->slot);
			}
			$this->writeIndex($t);
		}break;
		case 2:
		$c = $__hx__t->params[0];
		{
			$this->o->writeByte(4 | $flags);
			$this->opw->writeInt($f->slot);
			$this->writeIndex($c);
		}break;
		case 3:
		$i = $__hx__t->params[0];
		{
			$this->o->writeByte(5 | $flags);
			$this->opw->writeInt($f->slot);
			$this->writeIndex($i);
		}break;
		}
		if($f->metadatas !== null) {
			$this->writeList2($f->metadatas, (isset($this->writeIndex) ? $this->writeIndex: array($this, "writeIndex")));
		}
	}
	public function writeValue($extra, $v) {
		if($v === null) {
			if($extra) {
				$this->o->writeByte(0);
			}
			$this->o->writeByte(0);
			return;
		}
		$__hx__t = ($v);
		switch($__hx__t->index) {
		case 0:
		{
			$this->o->writeByte(12);
			$this->o->writeByte(12);
		}break;
		case 1:
		$b = $__hx__t->params[0];
		{
			$c = (($b) ? 11 : 10);
			$this->o->writeByte($c);
			$this->o->writeByte($c);
		}break;
		case 2:
		$i = $__hx__t->params[0];
		{
			$this->writeIndex($i);
			$this->o->writeByte(1);
		}break;
		case 3:
		$i = $__hx__t->params[0];
		{
			$this->writeIndex($i);
			$this->o->writeByte(3);
		}break;
		case 4:
		$i = $__hx__t->params[0];
		{
			$this->writeIndex($i);
			$this->o->writeByte(4);
		}break;
		case 5:
		$i = $__hx__t->params[0];
		{
			$this->writeIndex($i);
			$this->o->writeByte(6);
		}break;
		case 6:
		$i = $__hx__t->params[1]; $n = $__hx__t->params[0];
		{
			$this->writeIndex($i);
			$this->o->writeByte($n);
		}break;
		}
	}
	public function writeName($k = null, $n) {
		if($k === null) {
			$k = -1;
		}
		$__hx__t = ($n);
		switch($__hx__t->index) {
		case 0:
		$ns = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->o->writeByte((($k < 0) ? 7 : $k));
			$this->writeIndex($ns);
			$this->writeIndex($id);
		}break;
		case 1:
		$ns = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->o->writeByte((($k < 0) ? 9 : $k));
			$this->writeIndex($id);
			$this->writeIndex($ns);
		}break;
		case 2:
		$n1 = $__hx__t->params[0];
		{
			$this->o->writeByte((($k < 0) ? 15 : $k));
			$this->writeIndex($n1);
		}break;
		case 3:
		{
			$this->o->writeByte((($k < 0) ? 17 : $k));
		}break;
		case 4:
		$ns = $__hx__t->params[0];
		{
			$this->o->writeByte((($k < 0) ? 27 : $k));
			$this->writeIndex($ns);
		}break;
		case 5:
		$n1 = $__hx__t->params[0];
		{
			$this->writeName(format_abc_Writer_1($this, $k, $n, $n1), $n1);
		}break;
		case 6:
		$params = $__hx__t->params[1]; $n1 = $__hx__t->params[0];
		{
			$this->o->writeByte((($k < 0) ? 29 : $k));
			$this->writeIndex($n1);
			$this->o->writeByte($params->length);
			{
				$_g = 0;
				while($_g < $params->length) {
					$i = $params[$_g];
					++$_g;
					$this->writeIndex($i);
					unset($i);
				}
			}
		}break;
		}
	}
	public function writeNameByte($k, $n) {
		$this->o->writeByte((($k < 0) ? $n : $k));
	}
	public function writeNsSet($n) {
		$this->o->writeByte($n->length);
		{
			$_g = 0;
			while($_g < $n->length) {
				$i = $n[$_g];
				++$_g;
				$this->writeIndex($i);
				unset($i);
			}
		}
	}
	public function writeNamespace($n) {
		$__hx__t = ($n);
		switch($__hx__t->index) {
		case 0:
		$id = $__hx__t->params[0];
		{
			$this->o->writeByte(5);
			$this->writeIndex($id);
		}break;
		case 1:
		$ns = $__hx__t->params[0];
		{
			$this->o->writeByte(8);
			$this->writeIndex($ns);
		}break;
		case 2:
		$id = $__hx__t->params[0];
		{
			$this->o->writeByte(22);
			$this->writeIndex($id);
		}break;
		case 3:
		$id = $__hx__t->params[0];
		{
			$this->o->writeByte(23);
			$this->writeIndex($id);
		}break;
		case 4:
		$id = $__hx__t->params[0];
		{
			$this->o->writeByte(24);
			$this->writeIndex($id);
		}break;
		case 5:
		$id = $__hx__t->params[0];
		{
			$this->o->writeByte(25);
			$this->writeIndex($id);
		}break;
		case 6:
		$id = $__hx__t->params[0];
		{
			$this->o->writeByte(26);
			$this->writeIndex($id);
		}break;
		}
	}
	public function writeIndexOpt($i) {
		if($i === null) {
			$this->o->writeByte(0);
			return;
		}
		$this->writeIndex($i);
	}
	public function writeIndex($i) {
		$__hx__t = ($i);
		switch($__hx__t->index) {
		case 0:
		$n = $__hx__t->params[0];
		{
			$this->opw->writeInt($n);
		}break;
		}
	}
	public function writeString($s) {
		$this->opw->writeInt(strlen($s));
		$this->o->writeString($s);
	}
	public function writeList2($a, $write) {
		$this->opw->writeInt($a->length);
		{
			$_g1 = 0; $_g = $a->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				call_user_func_array($write, array($a[$i]));
				unset($i);
			}
		}
	}
	public function writeList($a, $write) {
		if($a->length === 0) {
			$this->opw->writeInt(0);
			return;
		}
		$this->opw->writeInt($a->length + 1);
		{
			$_g1 = 0; $_g = $a->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				call_user_func_array($write, array($a[$i]));
				unset($i);
			}
		}
	}
	public function writeUInt($n) {
		$this->opw->writeInt($n);
	}
	public function writeInt($n) {
		$this->opw->writeInt($n);
	}
	public $opw;
	public $o;
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
	function __toString() { return 'format.abc.Writer'; }
}
function format_abc_Writer_0(&$_g, &$d, $n) {
	{
		$_g->writeName(-1, $n);
	}
}
function format_abc_Writer_1(&$__hx__this, &$k, &$n, &$n1) {
	$__hx__t2 = ($n1);
	switch($__hx__t2->index) {
	case 0:
	{
		return 13;
	}break;
	case 1:
	{
		return 14;
	}break;
	case 2:
	{
		return 16;
	}break;
	case 3:
	{
		return 18;
	}break;
	case 4:
	{
		return 28;
	}break;
	case 5:
	case 6:
	{
		throw new HException("assert");
	}break;
	}
}
