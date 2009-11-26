<?php

class format_abc_Reader {
	public function __construct($i) {
		if( !php_Boot::$skip_constructor ) {
		$this->i = $i;
		$this->opr = new format_abc_OpReader($i);
	}}
	public $i;
	public $opr;
	public function readInt() {
		return $this->opr->readInt();
	}
	public function readIndex() {
		return format_abc_Index::Idx($this->opr->readInt());
	}
	public function readIndexOpt() {
		$i = $this->opr->readInt();
		return (($i === 0) ? null : format_abc_Index::Idx($i));
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
				$a->push(call_user_func_array($f, array()));
				unset($i);
			}
		}
		return $a;
	}
	public function readList2($f) {
		$a = new _hx_array(array());
		$n = $this->opr->readInt();
		{
			$_g = 0;
			while($_g < $n) {
				$i = $_g++;
				$a->push(call_user_func_array($f, array()));
				unset($i);
			}
		}
		return $a;
	}
	public function readString() {
		return $this->i->readString($this->opr->readInt());
	}
	public function readNamespace() {
		$k = $this->i->readByte();
		$p = format_abc_Index::Idx($this->opr->readInt());
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$k) {
			case 5:{
				\$팿 = format_abc_Namespace::NPrivate(\$p);
			}break;
			case 8:{
				\$팿 = format_abc_Namespace::NNamespace(\$p);
			}break;
			case 22:{
				\$팿 = format_abc_Namespace::NPublic(\$p);
			}break;
			case 23:{
				\$팿 = format_abc_Namespace::NInternal(\$p);
			}break;
			case 24:{
				\$팿 = format_abc_Namespace::NProtected(\$p);
			}break;
			case 25:{
				\$팿 = format_abc_Namespace::NExplicit(\$p);
			}break;
			case 26:{
				\$팿 = format_abc_Namespace::NStaticProtected(\$p);
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\"assert\\\");
					return \\\$팿2;
				\");
			}break;
			}
			return \$팿;
		");
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
	public function readName($k) {
		if($k === null) {
			$k = -1;
		}
		if($k === -1) {
			$k = $this->i->readByte();
		}
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$k) {
			case 7:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$ns = format_abc_Index::Idx(\\\$퍁his->opr->readInt());
					\\\$id = format_abc_Index::Idx(\\\$퍁his->opr->readInt());
					\\\$팿2 = format_abc_Name::NName(\\\$id, \\\$ns);
					return \\\$팿2;
				\");
			}break;
			case 9:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$id2 = format_abc_Index::Idx(\\\$퍁his->opr->readInt());
					\\\$ns2 = format_abc_Index::Idx(\\\$퍁his->opr->readInt());
					\\\$팿3 = format_abc_Name::NMulti(\\\$id2, \\\$ns2);
					return \\\$팿3;
				\");
			}break;
			case 13:{
				\$팿 = format_abc_Name::NAttrib(\$퍁his->readName(7));
			}break;
			case 14:{
				\$팿 = format_abc_Name::NAttrib(\$퍁his->readName(9));
			}break;
			case 15:{
				\$팿 = format_abc_Name::NRuntime(format_abc_Index::Idx(\$퍁his->opr->readInt()));
			}break;
			case 16:{
				\$팿 = format_abc_Name::\$NRuntimeLate;
			}break;
			case 18:{
				\$팿 = format_abc_Name::NAttrib(\$퍁his->readName(17));
			}break;
			case 27:{
				\$팿 = format_abc_Name::NMultiLate(format_abc_Index::Idx(\$퍁his->opr->readInt()));
			}break;
			case 28:{
				\$팿 = format_abc_Name::NAttrib(\$퍁his->readName(27));
			}break;
			case 29:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;\\\$id3 = format_abc_Index::Idx(\\\$퍁his->opr->readInt());
					\\\$params = \\\$퍁his->readList2(isset(\\\$퍁his->readIndex) ? \\\$퍁his->readIndex: array(\\\$퍁his, \\\"readIndex\\\"));
					\\\$팿4 = format_abc_Name::NParams(\\\$id3, \\\$params);
					return \\\$팿4;
				\");
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\"assert\\\");
					return \\\$팿5;
				\");
			}break;
			}
			return \$팿;
		");
	}
	public function readValue($extra) {
		$idx = $this->opr->readInt();
		if($idx === 0) {
			if($extra && $this->i->readByte() !== 0) {
				throw new HException("assert");
			}
			return null;
		}
		$n = $this->i->readByte();
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$n) {
			case 1:{
				\$팿 = format_abc_Value::VString(format_abc_Index::Idx(\$idx));
			}break;
			case 3:{
				\$팿 = format_abc_Value::VInt(format_abc_Index::Idx(\$idx));
			}break;
			case 4:{
				\$팿 = format_abc_Value::VUInt(format_abc_Index::Idx(\$idx));
			}break;
			case 6:{
				\$팿 = format_abc_Value::VFloat(format_abc_Index::Idx(\$idx));
			}break;
			case 5:case 8:case 22:case 23:case 24:case 25:case 26:{
				\$팿 = format_abc_Value::VNamespace(\$n, format_abc_Index::Idx(\$idx));
			}break;
			case 10:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;if(\\\$idx !== 10) {
						throw new HException(\\\"assert\\\");
					}
					\\\$팿2 = format_abc_Value::VBool(false);
					return \\\$팿2;
				\");
			}break;
			case 11:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;if(\\\$idx !== 11) {
						throw new HException(\\\"assert\\\");
					}
					\\\$팿3 = format_abc_Value::VBool(true);
					return \\\$팿3;
				\");
			}break;
			case 12:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;if(\\\$idx !== 12) {
						throw new HException(\\\"assert\\\");
					}
					\\\$팿4 = format_abc_Value::\\\$VNull;
					return \\\$팿4;
				\");
			}break;
			default:{
				\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\"assert\\\");
					return \\\$팿5;
				\");
			}break;
			}
			return \$팿;
		");
	}
	public function readMethodType() {
		$nargs = $this->i->readByte();
		$tret = $this->readIndexOpt();
		$targs = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $nargs) {
				$i = $_g++;
				$targs->push($this->readIndexOpt());
				unset($i);
			}
		}
		$dname = $this->readIndexOpt();
		$flags = $this->i->readByte();
		if($flags === 0 && $dname === null) {
			return _hx_anonymous(array("args" => $targs, "ret" => $tret, "extra" => null));
		}
		$dparams = null; $pnames = null;
		if(($flags & 8) !== 0) {
			$dparams = $this->readList2(call_user_func_array(array(new _hx_lambda(array("_g" => &$_g, "dname" => &$dname, "dparams" => &$dparams, "flags" => &$flags, "i" => &$i, "nargs" => &$nargs, "pnames" => &$pnames, "targs" => &$targs, "tret" => &$tret), null, array('f','a1'), "{
				return array(new _hx_lambda(array(\"_g\" => &\$_g, \"a1\" => &\$a1, \"dname\" => &\$dname, \"dparams\" => &\$dparams, \"f\" => &\$f, \"flags\" => &\$flags, \"i\" => &\$i, \"nargs\" => &\$nargs, \"pnames\" => &\$pnames, \"targs\" => &\$targs, \"tret\" => &\$tret), null, array(), \"{
					return call_user_func_array(\\\$f, array(\\\$a1));
				}\"), 'execute0');
			}"), 'execute2'), array(isset($this->readValue) ? $this->readValue: array($this, "readValue"), true)));
		}
		if(($flags & 128) !== 0) {
			$pnames = new _hx_array(array());
			{
				$_g2 = 0;
				while($_g2 < $nargs) {
					$i2 = $_g2++;
					$pnames->push($this->readIndexOpt());
					unset($i2);
				}
			}
		}
		return _hx_anonymous(array("args" => $targs, "ret" => $tret, "extra" => _hx_anonymous(array("native" => ($flags & 32) !== 0, "variableArgs" => ($flags & 4) !== 0, "argumentsDefined" => ($flags & 1) !== 0, "usesDXNS" => ($flags & 64) !== 0, "newBlock" => ($flags & 2) !== 0, "unused" => ($flags & 16) !== 0, "debugName" => $dname, "defaultParameters" => $dparams, "paramNames" => $pnames))));
	}
	public function readMetadata() {
		$name = format_abc_Index::Idx($this->opr->readInt());
		$data = $this->readList2(isset($this->readIndexOpt) ? $this->readIndexOpt: array($this, "readIndexOpt"));
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
			$kind1 = eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$kind & 15) {
				case 1:{
					\$팿 = format_abc_MethodKind::\$KNormal;
				}break;
				case 2:{
					\$팿 = format_abc_MethodKind::\$KGetter;
				}break;
				case 3:{
					\$팿 = format_abc_MethodKind::\$KSetter;
				}break;
				default:{
					\$팿 = eval(\"if(isset(\\\$this)) \\\$퍁his =& \\\$this;throw new HException(\\\"assert\\\");
						return \\\$팿2;
					\");
				}break;
				}
				return \$팿;
			");
			$f = format_abc_FieldKind::FMethod($mt, $kind1, $final, $over);
		}break;
		case 4:{
			$f = format_abc_FieldKind::FClass(format_abc_Index::Idx($this->opr->readInt()));
		}break;
		case 5:{
			$f = format_abc_FieldKind::FFunction(format_abc_Index::Idx($this->opr->readInt()));
		}break;
		default:{
			throw new HException("assert");
		}break;
		}
		$metas = null;
		if(($kind & 64) !== 0) {
			$metas = $this->readList2(isset($this->readIndex) ? $this->readIndex: array($this, "readIndex"));
		}
		return _hx_anonymous(array("name" => $name, "slot" => $slot, "kind" => $f, "metadatas" => $metas));
	}
	public function readClass() {
		$name = format_abc_Index::Idx($this->opr->readInt());
		$csuper = $this->readIndexOpt();
		$flags = $this->i->readByte();
		$ns = null;
		if(($flags & 8) !== 0) {
			$ns = format_abc_Index::Idx($this->opr->readInt());
		}
		$interfs = $this->readList2(isset($this->readIndex) ? $this->readIndex: array($this, "readIndex"));
		$construct = format_abc_Index::Idx($this->opr->readInt());
		$fields = $this->readList2(isset($this->readField) ? $this->readField: array($this, "readField"));
		return _hx_anonymous(array("name" => $name, "superclass" => $csuper, "interfaces" => $interfs, "constructor" => $construct, "fields" => $fields, "_namespace" => $ns, "isSealed" => ($flags & 1) !== 0, "isFinal" => ($flags & 2) !== 0, "isInterface" => ($flags & 4) !== 0, "statics" => null, "staticFields" => null));
	}
	public function readInit() {
		return _hx_anonymous(array("method" => format_abc_Index::Idx($this->opr->readInt()), "fields" => $this->readList2(isset($this->readField) ? $this->readField: array($this, "readField"))));
	}
	public function readTryCatch() {
		return _hx_anonymous(array("start" => $this->opr->readInt(), "end" => $this->opr->readInt(), "handle" => $this->opr->readInt(), "type" => $this->readIndexOpt(), "variable" => $this->readIndexOpt()));
	}
	public function readFunction() {
		$t = format_abc_Index::Idx($this->opr->readInt());
		$ss = $this->opr->readInt();
		$nregs = $this->opr->readInt();
		$init_scope = $this->opr->readInt();
		$max_scope = $this->opr->readInt();
		$code = $this->i->read($this->opr->readInt());
		$trys = $this->readList2(isset($this->readTryCatch) ? $this->readTryCatch: array($this, "readTryCatch"));
		$locals = $this->readList2(isset($this->readField) ? $this->readField: array($this, "readField"));
		return _hx_anonymous(array("type" => $t, "maxStack" => $ss, "nRegs" => $nregs, "initScope" => $init_scope, "maxScope" => $max_scope, "code" => $code, "trys" => $trys, "locals" => $locals));
	}
	public function read() {
		if($this->i->readUInt30() !== 3014672) {
			throw new HException("invalid header");
		}
		$data = new format_abc_ABCData();
		$data->ints = $this->readList(isset($this->opr->readInt32) ? $this->opr->readInt32: array($this->opr, "readInt32"));
		$data->uints = $this->readList(isset($this->opr->readInt32) ? $this->opr->readInt32: array($this->opr, "readInt32"));
		$data->floats = $this->readList(isset($this->i->readDouble) ? $this->i->readDouble: array($this->i, "readDouble"));
		$data->strings = $this->readList(isset($this->readString) ? $this->readString: array($this, "readString"));
		$data->namespaces = $this->readList(isset($this->readNamespace) ? $this->readNamespace: array($this, "readNamespace"));
		$data->nssets = $this->readList(isset($this->readNsSet) ? $this->readNsSet: array($this, "readNsSet"));
		$data->names = $this->readList(call_user_func_array(array(new _hx_lambda(array("data" => &$data), null, array('f','a1'), "{
			return array(new _hx_lambda(array(\"a1\" => &\$a1, \"data\" => &\$data, \"f\" => &\$f), null, array(), \"{
				return call_user_func_array(\\\$f, array(\\\$a1));
			}\"), 'execute0');
		}"), 'execute2'), array(isset($this->readName) ? $this->readName: array($this, "readName"), -1)));
		$data->methodTypes = $this->readList2(isset($this->readMethodType) ? $this->readMethodType: array($this, "readMethodType"));
		$data->metadatas = $this->readList2(isset($this->readMetadata) ? $this->readMetadata: array($this, "readMetadata"));
		$data->classes = $this->readList2(isset($this->readClass) ? $this->readClass: array($this, "readClass"));
		{
			$_g = 0; $_g1 = $data->classes;
			while($_g < $_g1->length) {
				$c = $_g1[$_g];
				++$_g;
				$c->statics = format_abc_Index::Idx($this->opr->readInt());
				$c->staticFields = $this->readList2(isset($this->readField) ? $this->readField: array($this, "readField"));
				unset($c);
			}
		}
		$data->inits = $this->readList2(isset($this->readInit) ? $this->readInit: array($this, "readInit"));
		$data->functions = $this->readList2(isset($this->readFunction) ? $this->readFunction: array($this, "readFunction"));
		return $data;
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->팪ynamics[$m]) && is_callable($this->팪ynamics[$m]))
			return call_user_func_array($this->팪ynamics[$m], $a);
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	function __toString() { return 'format.abc.Reader'; }
}
