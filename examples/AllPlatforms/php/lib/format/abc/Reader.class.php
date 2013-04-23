<?php

class format_abc_Reader {
	public function __construct($i) {
		if(!php_Boot::$skip_constructor) {
		$this->functions = new _hx_array(array());
		$this->i = $i;
		$this->opr = new format_abc_OpReader($i);
	}}
	public function read() {
		$_g = $this;
		if($this->i->readInt32() !== 3014672) {
			throw new HException("invalid header");
		}
		$data = new format_abc_ABCData();
		$data->ints = $this->readList((isset($this->opr->readInt32) ? $this->opr->readInt32: array($this->opr, "readInt32")));
		$data->uints = $this->readList((isset($this->opr->readInt32) ? $this->opr->readInt32: array($this->opr, "readInt32")));
		$data->floats = $this->readList((isset($this->i->readDouble) ? $this->i->readDouble: array($this->i, "readDouble")));
		$data->strings = $this->readList((isset($this->readString) ? $this->readString: array($this, "readString")));
		$data->namespaces = $this->readList((isset($this->readNamespace) ? $this->readNamespace: array($this, "readNamespace")));
		$data->nssets = $this->readList((isset($this->readNsSet) ? $this->readNsSet: array($this, "readNsSet")));
		$data->names = $this->readList(array(new _hx_lambda(array(&$_g, &$data), "format_abc_Reader_0"), 'execute'));
		$data->methodTypes = $this->readList2((isset($this->readMethodType) ? $this->readMethodType: array($this, "readMethodType")));
		$data->metadatas = $this->readList2((isset($this->readMetadata) ? $this->readMetadata: array($this, "readMetadata")));
		$data->classes = $this->readList2((isset($this->readClass) ? $this->readClass: array($this, "readClass")));
		{
			$_g1 = 0; $_g11 = $data->classes;
			while($_g1 < $_g11->length) {
				$c = $_g11[$_g1];
				++$_g1;
				$c->statics = format_abc_Index::Idx($this->opr->readInt());
				$c->staticFields = $this->readList2((isset($this->readField) ? $this->readField: array($this, "readField")));
				unset($c);
			}
		}
		$data->inits = $this->readList2((isset($this->readInit) ? $this->readInit: array($this, "readInit")));
		$data->functions = $this->readList2((isset($this->readFunction) ? $this->readFunction: array($this, "readFunction")));
		return $data;
	}
	public function readFunction() {
		$t = format_abc_Index::Idx($this->opr->readInt());
		$ss = $this->opr->readInt();
		$nregs = $this->opr->readInt();
		$init_scope = $this->opr->readInt();
		$max_scope = $this->opr->readInt();
		$code = $this->i->read($this->opr->readInt());
		$trys = $this->readList2((isset($this->readTryCatch) ? $this->readTryCatch: array($this, "readTryCatch")));
		$locals = $this->readList2((isset($this->readField) ? $this->readField: array($this, "readField")));
		$func = _hx_anonymous(array("type" => $t, "maxStack" => $ss, "nRegs" => $nregs, "initScope" => $init_scope, "maxScope" => $max_scope, "code" => $code, "trys" => $trys, "locals" => $locals));
		$this->functions[_hx_array_get(Type::enumParameters($t), 0)] = $func;
		return $func;
	}
	public function readTryCatch() {
		return _hx_anonymous(array("start" => $this->opr->readInt(), "end" => $this->opr->readInt(), "handle" => $this->opr->readInt(), "type" => $this->readIndexOpt(), "variable" => $this->readIndexOpt()));
	}
	public function readInit() {
		$method = format_abc_Index::Idx($this->opr->readInt());
		$fields = $this->readList2((isset($this->readField) ? $this->readField: array($this, "readField")));
		return _hx_anonymous(array("method" => $method, "fields" => $fields));
	}
	public function readClass() {
		$name = format_abc_Index::Idx($this->opr->readInt());
		$csuper = $this->readIndexOpt();
		$flags = $this->i->readByte();
		$ns = null;
		if(($flags & 8) !== 0) {
			$ns = format_abc_Index::Idx($this->opr->readInt());
		}
		$interfs = $this->readList2((isset($this->readIndex) ? $this->readIndex: array($this, "readIndex")));
		$construct = format_abc_Index::Idx($this->opr->readInt());
		$fields = $this->readList2((isset($this->readField) ? $this->readField: array($this, "readField")));
		return _hx_anonymous(array("name" => $name, "superclass" => $csuper, "interfaces" => $interfs, "constructor" => $construct, "fields" => $fields, "_namespace" => $ns, "isSealed" => ($flags & 1) !== 0, "isFinal" => ($flags & 2) !== 0, "isInterface" => ($flags & 4) !== 0, "statics" => null, "staticFields" => null));
	}
	public function readField() {
		$name = format_abc_Index::Idx($this->opr->readInt());
		$kind = $this->i->readByte();
		$slot = $this->opr->readInt();
		$f = null;
		switch($kind & 15) {
		case 0:case 6:{
			$t = $this->readIndexOpt();
			$v = $this->readValue(false);
			$f = format_abc_FieldKind::FVar($t, $v, $kind === 6);
		}break;
		case 1:case 2:case 3:{
			$mt = format_abc_Index::Idx($this->opr->readInt());
			$final = ($kind & 16) !== 0;
			$over = ($kind & 32) !== 0;
			$kind1 = format_abc_Reader_1($this, $f, $final, $kind, $mt, $name, $over, $slot);
			$f = format_abc_FieldKind::FMethod($mt, $kind1, $final, $over);
		}break;
		case 4:{
			$f = format_abc_FieldKind::FClass(format_abc_Index::Idx($this->opr->readInt()));
		}break;
		case 5:{
			$f = format_abc_FieldKind::FFunction(format_abc_Index::Idx($this->opr->readInt()));
		}break;
		default:{
			throw new HException("assert readField2 " . _hx_string_rec(($kind & 15), ""));
		}break;
		}
		$metas = new _hx_array(array());
		if(($kind & 64) !== 0) {
			$_g = 0; $_g1 = $this->readList2((isset($this->readIndex) ? $this->readIndex: array($this, "readIndex")));
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				$metas->push($i);
				unset($i);
			}
		}
		return _hx_anonymous(array("name" => $name, "slot" => $slot, "kind" => $f, "metadatas" => $metas));
	}
	public function readMetadata() {
		$name = format_abc_Index::Idx($this->opr->readInt());
		$data = $this->readList2((isset($this->readIndexOpt) ? $this->readIndexOpt: array($this, "readIndexOpt")));
		$a = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $data->length) {
				$i = $data[$_g];
				++$_g;
				$a->push(_hx_anonymous(array("n" => $i, "v" => format_abc_Index::Idx($this->opr->readInt()))));
				unset($i);
			}
		}
		return _hx_anonymous(array("name" => $name, "data" => $a));
	}
	public function readMethodType() {
		$_g = $this;
		$nargs = $this->i->readByte();
		$tret = $this->readIndexOpt();
		$targs = new _hx_array(array());
		{
			$_g1 = 0;
			while($_g1 < $nargs) {
				$i = $_g1++;
				$targs->push($this->readIndexOpt());
				unset($i);
			}
		}
		$dname = $this->readIndexOpt();
		$flags = $this->i->readByte();
		if($flags === 0 && $dname === null) {
			return _hx_anonymous(array("args" => $targs, "ret" => $tret, "extra" => null));
		}
		$dparams = new _hx_array(array());
		$pnames = new _hx_array(array());
		if(($flags & 8) !== 0) {
			$dparams = $this->readList2(array(new _hx_lambda(array(&$_g, &$dname, &$dparams, &$flags, &$nargs, &$pnames, &$targs, &$tret), "format_abc_Reader_2"), 'execute'));
		}
		if(($flags & 128) !== 0) {
			$pnames = new _hx_array(array());
			{
				$_g1 = 0;
				while($_g1 < $nargs) {
					$i = $_g1++;
					$pnames->push($this->readIndexOpt());
					unset($i);
				}
			}
		}
		return _hx_anonymous(array("args" => $targs, "ret" => $tret, "extra" => _hx_anonymous(array("native" => ($flags & 32) !== 0, "variableArgs" => ($flags & 4) !== 0, "argumentsDefined" => ($flags & 1) !== 0, "usesDXNS" => ($flags & 64) !== 0, "newBlock" => ($flags & 2) !== 0, "unused" => ($flags & 16) !== 0, "debugName" => $dname, "defaultParameters" => (($dparams->length === 0) ? null : $dparams), "paramNames" => (($pnames->length === 0) ? null : $pnames)))));
	}
	public function readValue($extra) {
		$idx = $this->opr->readInt();
		if($idx === 0) {
			if($extra && $this->i->readByte() !== 0) {
				throw new HException("assert readValue1 " . _hx_string_rec($idx, ""));
			}
			return null;
		}
		$n = $this->i->readByte();
		return format_abc_Reader_3($this, $extra, $idx, $n);
	}
	public function readName($k = null) {
		if($k === null) {
			$k = -1;
		}
		if($k === -1) {
			$k = $this->i->readByte();
		}
		return format_abc_Reader_4($this, $k);
	}
	public function readNsSet() {
		$a = new _hx_array(array());
		{
			$_g1 = 0; $_g = $this->i->readByte();
			while($_g1 < $_g) {
				$n = $_g1++;
				$a->push(format_abc_Index::Idx($this->opr->readInt()));
				unset($n);
			}
		}
		return $a;
	}
	public function readNamespace() {
		$k = $this->i->readByte();
		$p = format_abc_Index::Idx($this->opr->readInt());
		return format_abc_Reader_5($this, $k, $p);
	}
	public function readString() {
		return $this->i->readString($this->opr->readInt());
	}
	public function readList2($f) {
		$a = new _hx_array(array());
		$n = $this->opr->readInt();
		{
			$_g = 0;
			while($_g < $n) {
				$i = $_g++;
				$a->push(call_user_func($f));
				unset($i);
			}
		}
		return $a;
	}
	public function readList($f) {
		$a = new _hx_array(array());
		$n = $this->opr->readInt();
		if($n === 0) {
			return $a;
		}
		{
			$_g1 = 0; $_g = $n - 1;
			while($_g1 < $_g) {
				$i = $_g1++;
				$a->push(call_user_func($f));
				unset($i);
			}
		}
		return $a;
	}
	public function readIndexOpt() {
		$i = $this->opr->readInt();
		return (($i === 0) ? null : format_abc_Index::Idx($i));
	}
	public function readIndex() {
		return format_abc_Index::Idx($this->opr->readInt());
	}
	public function readInt() {
		return $this->opr->readInt();
	}
	public $functions;
	public $opr;
	public $i;
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
	function __toString() { return 'format.abc.Reader'; }
}
function format_abc_Reader_0(&$_g, &$data) {
	{
		return $_g->readName(-1);
	}
}
function format_abc_Reader_1(&$__hx__this, &$f, &$final, &$kind, &$mt, &$name, &$over, &$slot) {
	switch($kind & 15) {
	case 1:{
		return format_abc_MethodKind::$KNormal;
	}break;
	case 2:{
		return format_abc_MethodKind::$KGetter;
	}break;
	case 3:{
		return format_abc_MethodKind::$KSetter;
	}break;
	default:{
		throw new HException("assert readField1 " . _hx_string_rec(($kind & 15), ""));
	}break;
	}
}
function format_abc_Reader_2(&$_g, &$dname, &$dparams, &$flags, &$nargs, &$pnames, &$targs, &$tret) {
	{
		return $_g->readValue(true);
	}
}
function format_abc_Reader_3(&$__hx__this, &$extra, &$idx, &$n) {
	switch($n) {
	case 1:{
		return format_abc_Value::VString(format_abc_Index::Idx($idx));
	}break;
	case 3:{
		return format_abc_Value::VInt(format_abc_Index::Idx($idx));
	}break;
	case 4:{
		return format_abc_Value::VUInt(format_abc_Index::Idx($idx));
	}break;
	case 6:{
		return format_abc_Value::VFloat(format_abc_Index::Idx($idx));
	}break;
	case 5:case 8:case 22:case 23:case 24:case 25:case 26:{
		return format_abc_Value::VNamespace($n, format_abc_Index::Idx($idx));
	}break;
	case 10:{
		if($idx !== 10) {
			return format_abc_Value::VBool(false);
		}
	}break;
	case 11:{
		if($idx !== 11) {
			return format_abc_Value::VBool(true);
		}
	}break;
	case 12:{
		if($idx !== 12) {
			return format_abc_Value::$VNull;
		}
	}break;
	default:{
		throw new HException("assert readValue3 " . _hx_string_rec($n, ""));
	}break;
	}
}
function format_abc_Reader_4(&$__hx__this, &$k) {
	switch($k) {
	case 7:{
		$ns = format_abc_Index::Idx($__hx__this->opr->readInt());
		$id = format_abc_Index::Idx($__hx__this->opr->readInt());
		return format_abc_Name::NName($id, $ns);
	}break;
	case 9:{
		$id = format_abc_Index::Idx($__hx__this->opr->readInt());
		$ns = format_abc_Index::Idx($__hx__this->opr->readInt());
		return format_abc_Name::NMulti($id, $ns);
	}break;
	case 13:{
		return format_abc_Name::NAttrib($__hx__this->readName(7));
	}break;
	case 14:{
		return format_abc_Name::NAttrib($__hx__this->readName(9));
	}break;
	case 15:{
		return format_abc_Name::NRuntime(format_abc_Index::Idx($__hx__this->opr->readInt()));
	}break;
	case 16:{
		return format_abc_Name::$NRuntimeLate;
	}break;
	case 17:{
		return format_abc_Name::$NRuntimeLate;
	}break;
	case 18:{
		return format_abc_Name::NAttrib($__hx__this->readName(17));
	}break;
	case 27:{
		return format_abc_Name::NMultiLate(format_abc_Index::Idx($__hx__this->opr->readInt()));
	}break;
	case 28:{
		return format_abc_Name::NAttrib($__hx__this->readName(27));
	}break;
	case 29:{
		$id = format_abc_Index::Idx($__hx__this->opr->readInt());
		$params = $__hx__this->readList2((isset($__hx__this->readIndex) ? $__hx__this->readIndex: array($__hx__this, "readIndex")));
		return format_abc_Name::NParams($id, $params);
	}break;
	default:{
		throw new HException("assert readName" . _hx_string_rec($k, ""));
	}break;
	}
}
function format_abc_Reader_5(&$__hx__this, &$k, &$p) {
	switch($k) {
	case 5:{
		return format_abc_Namespace::NPrivate($p);
	}break;
	case 8:{
		return format_abc_Namespace::NNamespace($p);
	}break;
	case 22:{
		return format_abc_Namespace::NPublic($p);
	}break;
	case 23:{
		return format_abc_Namespace::NInternal($p);
	}break;
	case 24:{
		return format_abc_Namespace::NProtected($p);
	}break;
	case 25:{
		return format_abc_Namespace::NExplicit($p);
	}break;
	case 26:{
		return format_abc_Namespace::NStaticProtected($p);
	}break;
	default:{
		throw new HException("assert readNamespace" . _hx_string_rec($k, ""));
	}break;
	}
}
