<?php

class be_haxer_hxswfml_AbcReader {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->debugFile = "";
		$this->debugInfo = true;
		$this->jumpInfo = false;
		$this->sourceInfo = false;
		$this->functionParseIndex = 0;
		$this->abcId = 0;
	}}
	public function lineSplitter($str) {
		$out = _hx_explode("\x0D\x0A", $str)->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
	public function urlEncode($str) {
		return _hx_explode("\x1B", _hx_explode("\x0A", _hx_explode("\x0D", _hx_explode("\x09", _hx_explode("<", _hx_explode("\"", _hx_explode("&", $str)->join("&amp;"))->join("&quot;"))->join("&lt;"))->join("\\t"))->join("\\r"))->join("\\n"))->join("\\u001b");
	}
	public function fileToLines($fileName) {
		$this->debugFileName = _hx_explode(";", _hx_explode(";;", _hx_explode("\\", $fileName)->join("/"))->join("/"))->join("/");
		$this->debugLines = new _hx_array(array());
		if($this->sourceInfo) {
			if(file_exists($this->debugFileName)) {
				$str = sys_io_File::getContent($this->debugFileName);
				$str = be_haxer_hxswfml_AbcReader_0($this, $fileName, $str);
				$this->debugLines = _hx_explode("\x0A", $str);
				{
					$_g1 = 0; $_g = $this->debugLines->length;
					while($_g1 < $_g) {
						$i = $_g1++;
						$this->debugLines[$i] = _hx_explode("\x0A", (be_haxer_hxswfml_AbcReader_1($this, $_g, $_g1, $fileName, $i, $str)))->join("");
						unset($i);
					}
				}
			} else {
			}
		}
		$out = be_haxer_hxswfml_AbcReader_2($this, $fileName);
		return $out;
	}
	public function getValue($value) {
		if($value === null) {
			return "";
		}
		$out = "";
		$out = be_haxer_hxswfml_AbcReader_3($this, $out, $value);
		return $out;
	}
	public function getDefaultValue($value) {
		if($value === null) {
			return "";
		}
		$out = "";
		$out = be_haxer_hxswfml_AbcReader_4($this, $out, $value);
		return $out;
	}
	public function cutComma($str) {
		$out = (($str === null) ? "" : $str);
		if($str !== null && _hx_last_index_of($str, ",", null) === strlen($str) - 1) {
			$out = _hx_substr($str, 0, strlen($str) - 1);
		}
		return $out;
	}
	public function getFieldName($id) {
		return $this->getName($id);
	}
	public function getNameType($name) {
		$__namespace = "";
		$__name = "";
		if($name === null) {
			$__name = "*";
		} else {
			$__hx__t = ($name);
			switch($__hx__t->index) {
			case 0:
			$ns = $__hx__t->params[1]; $name1 = $__hx__t->params[0];
			{
				$__name = $this->abcFile->get($this->abcFile->strings, $name1);
				$__namespace = be_haxer_hxswfml_AbcReader_5($this, $__name, $__namespace, $name, $name1, $ns);
			}break;
			case 1:
			$nsset = $__hx__t->params[1]; $name1 = $__hx__t->params[0];
			{
				$__name = $this->abcFile->get($this->abcFile->strings, $name1);
				$__hx__t2 = ($nsset);
				switch($__hx__t2->index) {
				case 0:
				$index = $__hx__t2->params[0];
				{
					$nset = $this->abcFile->nssets[$index - 1];
					if($nset->length === 1) {
						$__namespace = be_haxer_hxswfml_AbcReader_6($this, $__name, $__namespace, $index, $name, $name1, $nset, $nsset);
						return _hx_string_or_null($__namespace) . _hx_string_or_null(be_haxer_hxswfml_AbcReader_7($this, $__name, $__namespace, $index, $name, $name1, $nset, $nsset));
					}
				}break;
				}
				{
					$_g = 0; $_g1 = $this->abcFile->names;
					while($_g < $_g1->length) {
						$n = $_g1[$_g];
						++$_g;
						$__hx__t2 = ($n);
						switch($__hx__t2->index) {
						case 0:
						$nns = $__hx__t2->params[1]; $nname = $__hx__t2->params[0];
						{
							if($this->abcFile->get($this->abcFile->strings, $nname) === $__name) {
								$__namespace = be_haxer_hxswfml_AbcReader_8($this, $__name, $__namespace, $_g, $_g1, $n, $name, $name1, $nname, $nns, $nsset);
							}
						}break;
						default:{
						}break;
						}
						unset($n);
					}
				}
			}break;
			case 2:
			$name1 = $__hx__t->params[0];
			{
				$__name = $this->abcFile->get($this->abcFile->strings, $name1);
			}break;
			case 3:
			{
				$__name = "#arrayProp";
			}break;
			case 4:
			$nset = $__hx__t->params[0];
			{
				$__name = "#arrayProp";
			}break;
			case 5:
			$n = $__hx__t->params[0];
			{
				$__name = $this->getNameType($n);
			}break;
			case 6:
			$params = $__hx__t->params[1]; $n = $__hx__t->params[0];
			{
				$__name .= _hx_string_or_null($this->getName($n)) . " params:";
				{
					$_g = 0;
					while($_g < $params->length) {
						$i = $params[$_g];
						++$_g;
						$__name .= _hx_string_or_null($this->getName($i)) . ",";
						unset($i);
					}
				}
			}break;
			}
		}
		return _hx_string_or_null($__namespace) . _hx_string_or_null(be_haxer_hxswfml_AbcReader_9($this, $__name, $__namespace, $name));
	}
	public function getName($id) {
		if($id === null) {
			return "*";
		} else {
			$name = $this->abcFile->get($this->abcFile->names, $id);
			return $this->getNameType($name);
		}
	}
	public function getNamespace($id) {
		$out = "";
		if($id !== null) {
			$ns = $this->abcFile->get($this->abcFile->namespaces, $id);
			$name = _hx_array_get(Type::enumParameters($ns), 0);
			$_name = $this->abcFile->get($this->abcFile->strings, $name);
			if($_name === null) {
				$out = "";
			} else {
				$out = be_haxer_hxswfml_AbcReader_10($this, $_name, $id, $name, $ns, $out);
			}
		}
		return $out;
	}
	public function getClass($id) {
		return $this->abcFile->classes[_hx_array_get(Type::enumParameters($id), 0)];
	}
	public function getMethod($id) {
		return $this->abcFile->methodTypes[_hx_array_get(Type::enumParameters($id), 0)];
	}
	public function getFloat($id) {
		return Std::string($this->abcFile->get($this->abcFile->floats, $id));
	}
	public function getUInt($id) {
		return Std::string($this->abcFile->get($this->abcFile->uints, $id));
	}
	public function getInt($id) {
		return Std::string($this->abcFile->get($this->abcFile->ints, $id));
	}
	public function getString($id) {
		return $this->abcFile->get($this->abcFile->strings, $id);
	}
	public function indent() {
		$str = new StringBuf();
		{
			$_g1 = 0; $_g = $this->indentLevel;
			while($_g1 < $_g) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
	public function parseLocals($locals) {
		$out = "";
		$_locals = new _hx_array(array());
		{
			$_g1 = 0; $_g = $locals->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$l = $locals[$i];
				$slot = $l->slot;
				$__hx__t = ($l->kind);
				switch($__hx__t->index) {
				case 0:
				$_const = $__hx__t->params[2]; $value = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$str = "";
					$con = null;
					if($_const) {
						$con = "true";
					} else {
						$con = "false";
					}
					$str .= _hx_string_or_null($this->getName($l->name));
					$str .= ":";
					$str .= _hx_string_or_null($this->getName($type));
					$str .= ":";
					$str .= _hx_string_or_null($this->getValue($value));
					$str .= ":";
					$str .= _hx_string_or_null($con);
					$_locals[$slot] = $str;
				}break;
				case 1:
				$isOverride = $__hx__t->params[3]; $isFinal = $__hx__t->params[2]; $k = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$_locals[$slot] = "FMethod";
				}break;
				case 2:
				$c = $__hx__t->params[0];
				{
					$_locals[$slot] = "FClass";
				}break;
				case 3:
				$f = $__hx__t->params[0];
				{
					$_locals[$slot] = "FFunction";
				}break;
				}
				unset($slot,$l,$i);
			}
		}
		{
			$_g1 = 1; $_g = $_locals->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$out .= _hx_string_or_null($_locals[$i]) . ",";
				unset($i);
			}
		}
		return be_haxer_hxswfml_AbcReader_11($this, $_locals, $locals, $out);
	}
	public function parseMethodExtra($extra) {
		$out = new StringBuf();
		if($extra !== null) {
			if($extra->native) {
				$out->add(" native=\"true\"");
			}
			if($extra->variableArgs) {
				$out->add(" variableArgs=\"true\"");
			}
			if($extra->argumentsDefined) {
				$out->add(" argumentsDefined=\"true\"");
			}
			if($extra->usesDXNS) {
				$out->add(" usesDXNS=\"true\"");
			}
			if($extra->newBlock) {
				$out->add(" newBlock=\"true\"");
			}
			if($extra->unused) {
				$out->add(" unused=\"true\"");
			}
			if($extra->debugName !== null && $this->abcFile->get($this->abcFile->strings, $extra->debugName) !== "") {
				$out->add(" debugName=\"");
				$out->add($this->abcFile->get($this->abcFile->strings, $extra->debugName));
				$out->add("\"");
			}
			if($extra->defaultParameters !== null) {
				$str = new StringBuf();
				{
					$_g1 = 0; $_g = $extra->defaultParameters->length;
					while($_g1 < $_g) {
						$i = $_g1++;
						$str->add(_hx_string_or_null($this->getDefaultValue($extra->defaultParameters[$i])) . ",");
						unset($i);
					}
				}
				$out->add(" defaultParameters=\"");
				$out->add(be_haxer_hxswfml_AbcReader_12($this, $extra, $out, $str));
				$out->add("\"");
			}
		}
		return $out->b;
	}
	public function createFunctionClosure($f) {
		$out = new StringBuf();
		$_m = $this->abcFile->methodTypes[_hx_array_get(Type::enumParameters($f), 0)];
		$_args = "";
		{
			$_g = 0; $_g1 = $_m->args;
			while($_g < $_g1->length) {
				$a = $_g1[$_g];
				++$_g;
				$_args .= _hx_string_or_null($this->getName($a)) . ",";
				unset($a);
			}
		}
		$_ret = $this->getName($_m->ret);
		$_name = "function__" . _hx_string_or_null(_hx_array_get(Type::enumParameters($f), 0));
		$out->add(be_haxer_hxswfml_AbcReader_13($this, $_args, $_m, $_name, $_ret, $f, $out));
		$out->add("<function f=\"");
		$out->add($_name);
		$out->add("\" name=\"");
		$out->add($_name);
		$out->add("\" kind=\"KFunction\" args=\"");
		$out->add(be_haxer_hxswfml_AbcReader_14($this, $_args, $_m, $_name, $_ret, $f, $out));
		$out->add("\"");
		if($_ret !== "") {
			$out->add(" return=\"");
			$out->add($_ret);
			$out->add("\"");
		}
		$out->add(be_haxer_hxswfml_AbcReader_15($this, $_args, $_m, $_name, $_ret, $f, $out));
		$this->currentFunctionName = $_name;
		{
			$_g = 0; $_g1 = $this->abcFile->functions;
			while($_g < $_g1->length) {
				$_f = $_g1[$_g];
				++$_g;
				if(Type::enumEq($f, $_f->type)) {
					if($_f->locals->length !== 0) {
						$out->add(" locals=\"");
						$out->add(be_haxer_hxswfml_AbcReader_16($this, $_args, $_f, $_g, $_g1, $_m, $_name, $_ret, $f, $out));
						$out->add("\"");
					}
					$out->add(" > <!-- maxStack=\"");
					$out->add($_f->maxStack);
					$out->add("\" nRegs=\"");
					$out->add($_f->nRegs);
					$out->add("\" initScope=\"");
					$out->add($_f->initScope);
					$out->add("\" maxScope=\"");
					$out->add($_f->maxScope);
					$out->add("\" length=\"" . _hx_string_rec($_f->code->length, "") . " bytes\"-->\x0A");
					$out->add($this->decodeToXML(format_abc_OpReader::decode(new haxe_io_BytesInput($_f->code, null, null)), $_f));
					$out->add(be_haxer_hxswfml_AbcReader_17($this, $_args, $_f, $_g, $_g1, $_m, $_name, $_ret, $f, $out));
					$out->add("</function>\x0A");
					break;
				}
				unset($_f);
			}
		}
		return $out->b;
	}
	public function decodeToXML($ops, $f) {
		$this->indentLevel++;
		$buf = new StringBuf();
		$index = 0;
		$bytePos = 0;
		{
			$_g = 0;
			while($_g < $ops->length) {
				$op = $ops[$_g];
				++$_g;
				$ec = Type::enumConstructor($op);
				if($ec !== "OLabel2" && $ec !== "OJump" && $ec !== "OJump3" && $ec !== "OCase") {
					$bytePos = format_abc_OpReader::$positions[$index++];
					$buf->add("<!--");
					$buf->add($bytePos);
					$buf->add("-->");
				}
				$__hx__t = ($op);
				switch($__hx__t->index) {
				case 0:
				case 1:
				case 2:
				case 6:
				case 16:
				case 17:
				case 18:
				case 19:
				case 20:
				case 21:
				case 22:
				case 25:
				case 26:
				case 27:
				case 28:
				case 29:
				case 30:
				case 35:
				case 55:
				case 45:
				case 46:
				case 75:
				case 66:
				case 92:
				case 76:
				case 77:
				case 78:
				case 79:
				case 80:
				case 81:
				case 82:
				case 83:
				case 85:
				case 86:
				case 88:
				case 91:
				case 96:
				case 97:
				case 102:
				{
					$buf->add(be_haxer_hxswfml_AbcReader_18($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" />\x0A");
				}break;
				case 5:
				$v = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_19($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $v));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add($this->abcFile->get($this->abcFile->strings, $v));
					$buf->add("\" />\x0A");
				}break;
				case 31:
				$v = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_20($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $v));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add(_hx_explode("\x1B", _hx_explode("\x0A", _hx_explode("\x0D", _hx_explode("\x09", _hx_explode("<", _hx_explode("\"", _hx_explode("&", $this->abcFile->get($this->abcFile->strings, $v))->join("&amp;"))->join("&quot;"))->join("&lt;"))->join("\\t"))->join("\\r"))->join("\\n"))->join("\\u001b"));
					$buf->add("\" />\x0A");
				}break;
				case 32:
				case 33:
				$v = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_21($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $v));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add(Std::string($this->abcFile->get($this->abcFile->ints, $v)));
					$buf->add("\" />\x0A");
				}break;
				case 34:
				$v = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_22($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $v));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add(Std::string($this->abcFile->get($this->abcFile->floats, $v)));
					$buf->add("\" />\x0A");
				}break;
				case 36:
				$v = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_23($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $v));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add(be_haxer_hxswfml_AbcReader_24($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $v));
					$buf->add("\" />\x0A");
				}break;
				case 56:
				$c = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_25($this, $_g, $buf, $bytePos, $c, $ec, $f, $index, $op, $ops));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add($this->className);
					$buf->add("\" />\x0A");
				}break;
				case 38:
				$f1 = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_26($this, $_g, $buf, $bytePos, $ec, $f, $f1, $index, $op, $ops));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"function__");
					$buf->add(_hx_string_or_null(_hx_array_get(Type::enumParameters($f1), 0)) . "\"");
					$buf->add(" />\x0A");
					$this->functionClosuresBodies->push($f1);
				}break;
				case 3:
				case 4:
				case 57:
				case 59:
				case 60:
				case 61:
				case 62:
				case 63:
				case 68:
				case 69:
				case 70:
				case 84:
				case 87:
				case 93:
				$v = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_27($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $v));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add($this->getName($v));
					$buf->add("\" />\x0A");
				}break;
				case 43:
				case 44:
				case 48:
				case 49:
				case 50:
				case 51:
				$nargs = $__hx__t->params[1]; $p = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_28($this, $_g, $buf, $bytePos, $ec, $f, $index, $nargs, $op, $ops, $p));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add($this->getName($p));
					$buf->add("\" nargs=\"");
					$buf->add($nargs);
					$buf->add("\" />\x0A");
				}break;
				case 7:
				case 64:
				case 65:
				case 89:
				case 90:
				case 94:
				case 95:
				case 23:
				case 24:
				case 67:
				case 101:
				case 104:
				case 39:
				case 40:
				case 47:
				case 52:
				case 53:
				case 54:
				case 71:
				case 72:
				case 73:
				case 74:
				$v = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_29($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $v));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add($v);
					$buf->add("\" />\x0A");
				}break;
				case 58:
				$v = $__hx__t->params[0];
				{
					$_try_ = $f->trys[$v];
					$start = $_try_->start;
					$end = $_try_->end;
					$handle = $_try_->handle;
					$type = $this->getName($_try_->type);
					$variable = $this->getName($_try_->variable);
					$buf->add(be_haxer_hxswfml_AbcReader_30($this, $_g, $_try_, $buf, $bytePos, $ec, $end, $f, $handle, $index, $op, $ops, $start, $type, $v, $variable));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add($v);
					$buf->add("\" start=\"");
					$buf->add($start);
					$buf->add("\" end=\"");
					$buf->add($end);
					$buf->add("\" handle=\"");
					$buf->add($handle);
					$buf->add("\" type=\"");
					$buf->add($type);
					$buf->add("\" variable=\"");
					$buf->add($variable);
					$buf->add("\" />\x0A");
				}break;
				case 103:
				$o = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_31($this, $_g, $buf, $bytePos, $ec, $f, $index, $o, $op, $ops));
					$buf->add("<");
					$buf->add(Type::enumConstructor($o));
					$buf->add(" />\x0A");
				}break;
				case 42:
				$nargs = $__hx__t->params[1]; $s = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_32($this, $_g, $buf, $bytePos, $ec, $f, $index, $nargs, $op, $ops, $s));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add($s);
					$buf->add("\" nargs=\"");
					$buf->add($nargs);
					$buf->add("\" />\x0A");
				}break;
				case 41:
				$nargs = $__hx__t->params[1]; $s = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_33($this, $_g, $buf, $bytePos, $ec, $f, $index, $nargs, $op, $ops, $s));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v=\"");
					$buf->add($s);
					$buf->add("\" nargs=\"");
					$buf->add($nargs);
					$buf->add("\" />\x0A");
				}break;
				case 8:
				{
				}break;
				case 9:
				$landingName = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_34($this, $_g, $buf, $bytePos, $ec, $f, $index, $landingName, $op, $ops));
					$buf->add("<OLabel name=\"");
					$buf->add($landingName);
					$buf->add("\"/>\x0A");
					if($this->jumpInfo) {
						$buf->add("<!-- ");
						$buf->add($landingName);
						$buf->add(" -->\x0A");
					}
				}break;
				case 10:
				$offset = $__hx__t->params[1]; $jump = $__hx__t->params[0];
				{
				}break;
				case 11:
				$offset = $__hx__t->params[2]; $landingName = $__hx__t->params[1]; $jump = $__hx__t->params[0];
				{
					if($offset >= 0) {
						$buf->add(be_haxer_hxswfml_AbcReader_35($this, $_g, $buf, $bytePos, $ec, $f, $index, $jump, $landingName, $offset, $op, $ops));
						$buf->add("<");
						$buf->add(Type::enumConstructor($jump));
						$buf->add(" jump=\"");
						$buf->add($landingName);
						$buf->add("\" offset=\"");
						$buf->add($offset);
						$buf->add("\" />");
						$buf->add("<!--" . _hx_string_rec(($bytePos + 4 + $offset), "") . "-->\x0A");
					} else {
						if($offset < 0) {
							$buf->add(be_haxer_hxswfml_AbcReader_36($this, $_g, $buf, $bytePos, $ec, $f, $index, $jump, $landingName, $offset, $op, $ops));
							$buf->add("<");
							$buf->add(Type::enumConstructor($jump));
							$buf->add(" label=\"");
							$buf->add($landingName);
							$buf->add("\" offset=\"");
							$buf->add($offset);
							$buf->add("\" />");
							$buf->add("<!--" . _hx_string_rec(($bytePos + 4 + $offset), "") . "-->\x0A");
						}
					}
				}break;
				case 12:
				$landingName = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_37($this, $_g, $buf, $bytePos, $ec, $f, $index, $landingName, $op, $ops));
					$buf->add("<OJump name=\"");
					$buf->add($landingName);
					$buf->add("\"/>\x0A");
					if($this->jumpInfo) {
						$buf->add("<!-- ");
						$buf->add($landingName);
						$buf->add(" -->\x0A");
					}
				}break;
				case 13:
				$deltas = $__hx__t->params[1]; $def = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_38($this, $_g, $buf, $bytePos, $def, $deltas, $ec, $f, $index, $op, $ops));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" default=\"");
					$buf->add($def);
					$buf->add("\" deltas=\"");
					$buf->add($deltas);
					$buf->add("\" />");
					$buf->add("<!--");
					{
						$_g1 = 0;
						while($_g1 < $deltas->length) {
							$d = $deltas[$_g1];
							++$_g1;
							$buf->add(" " . _hx_string_rec(($bytePos + $d), "") . ", ");
							unset($d);
						}
					}
					$buf->add("-->\x0A");
				}break;
				case 14:
				$offsets = $__hx__t->params[2]; $deltas = $__hx__t->params[1]; $def = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_39($this, $_g, $buf, $bytePos, $def, $deltas, $ec, $f, $index, $offsets, $op, $ops));
					$buf->add("<!--");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" default=\"");
					$buf->add($offsets->shift());
					$buf->add("\" deltas=\"");
					$buf->add($offsets);
					$buf->add("\" />-->");
					$buf->add("<!--");
					{
						$_g1 = 0;
						while($_g1 < $offsets->length) {
							$d = $offsets[$_g1];
							++$_g1;
							$buf->add(" [" . _hx_string_rec($d, "") . "->" . _hx_string_rec(($bytePos + $d), "") . "], ");
							unset($d);
						}
					}
					$buf->add("-->\x0A");
					$buf->add("<!--");
					$buf->add($bytePos);
					$buf->add("-->");
					$buf->add(be_haxer_hxswfml_AbcReader_40($this, $_g, $buf, $bytePos, $def, $deltas, $ec, $f, $index, $offsets, $op, $ops));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" default=\"");
					$buf->add($def);
					$buf->add("\" deltas=\"");
					$buf->add($deltas);
					$buf->add("\" />\x0A");
				}break;
				case 15:
				$landingName = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_41($this, $_g, $buf, $bytePos, $ec, $f, $index, $landingName, $op, $ops));
					$buf->add("<OCase name=\"");
					$buf->add($landingName);
					$buf->add("\"/>\x0A");
					if($this->jumpInfo) {
						$buf->add("<!-- ");
						$buf->add($landingName);
						$buf->add(" -->\x0A");
					}
				}break;
				case 37:
				$r2 = $__hx__t->params[1]; $r1 = $__hx__t->params[0];
				{
					$buf->add(be_haxer_hxswfml_AbcReader_42($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $r1, $r2));
					$buf->add("<");
					$buf->add(Type::enumConstructor($op));
					$buf->add(" v1=\"");
					$buf->add($r1);
					$buf->add("\" v2=\"");
					$buf->add($r2);
					$buf->add("\" />\x0A");
				}break;
				case 100:
				$v = $__hx__t->params[0];
				{
					if($this->debugInfo) {
						$name = $this->abcFile->get($this->abcFile->strings, $v);
						if($this->debugLines === null || $name !== $this->debugFile) {
							$this->debugFile = $name;
							$this->debugFileName = be_haxer_hxswfml_AbcReader_43($this, $_g, $buf, $bytePos, $ec, $f, $index, $name, $op, $ops, $v);
						}
						$buf->add(be_haxer_hxswfml_AbcReader_44($this, $_g, $buf, $bytePos, $ec, $f, $index, $name, $op, $ops, $v));
						$buf->add("<");
						$buf->add(Type::enumConstructor($op));
						$buf->add(" v=\"");
						$buf->add($this->debugFileName);
						$buf->add("\" />\x0A");
					}
					if($this->sourceInfo && !$this->debugInfo) {
						$name = $this->abcFile->get($this->abcFile->strings, $v);
						$this->debugFile = $name;
						$this->debugFileName = be_haxer_hxswfml_AbcReader_45($this, $_g, $buf, $bytePos, $ec, $f, $index, $name, $op, $ops, $v);
					}
				}break;
				case 99:
				$v = $__hx__t->params[0];
				{
					if($this->debugInfo) {
						$buf->add(be_haxer_hxswfml_AbcReader_46($this, $_g, $buf, $bytePos, $ec, $f, $index, $op, $ops, $v));
						$buf->add("<");
						$buf->add(Type::enumConstructor($op));
						$buf->add(" v=\"");
						$buf->add($v);
						$buf->add("\" />\x0A");
					}
					if($this->sourceInfo && $this->debugLines[$v - 1] !== null) {
						$buf->add("<!--  ");
						$buf->add($v);
						$buf->add(")");
						$buf->add($this->debugLines[$v - 1]);
						$buf->add("-->\x0A");
					}
				}break;
				case 98:
				$line = $__hx__t->params[2]; $r = $__hx__t->params[1]; $name = $__hx__t->params[0];
				{
					if($this->debugInfo) {
						$buf->add(be_haxer_hxswfml_AbcReader_47($this, $_g, $buf, $bytePos, $ec, $f, $index, $line, $name, $op, $ops, $r));
						$buf->add("<");
						$buf->add(Type::enumConstructor($op));
						$buf->add(" name=\"");
						$buf->add($this->abcFile->get($this->abcFile->strings, $name));
						$buf->add("\" r=\"");
						$buf->add($r);
						$buf->add("\" line=\"");
						$buf->add($line);
						$buf->add("\"/>\x0A");
					}
				}break;
				default:{
					throw new HException(Std::string($op) . " Unknown opcode.");
				}break;
				}
				unset($op,$ec);
			}
		}
		$this->indentLevel--;
		return $buf->b;
	}
	public function abcToXml($data, $infos) {
		$abcReader = new format_abc_Reader(new haxe_io_BytesInput($data, null, null));
		$this->abcFile = $abcReader->read();
		$this->functionClosures = new _hx_array(array());
		$this->functionClosuresBodies = new _hx_array(array());
		$this->indentLevel = 1;
		$name = be_haxer_hxswfml_AbcReader_48($this, $abcReader, $data, $infos);
		$xml = new StringBuf();
		$xml->add(be_haxer_hxswfml_AbcReader_49($this, $abcReader, $data, $infos, $name, $xml));
		$xml->add("<abcfile name=\"");
		$xml->add($name);
		$xml->add("\">\x0A");
		$this->indentLevel++;
		$hasMethodBody = false;
		$loopIndex = 0;
		{
			$_g = 0; $_g1 = $this->abcFile->inits;
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				{
					$_g2 = 0; $_g3 = $i->fields;
					while($_g2 < $_g3->length) {
						$field = $_g3[$_g2];
						++$_g2;
						$__hx__t = ($field->kind);
						switch($__hx__t->index) {
						case 1:
						$isOverride = $__hx__t->params[3]; $isFinal = $__hx__t->params[2]; $k = $__hx__t->params[1]; $methodType = $__hx__t->params[0];
						{
							$_m = $this->abcFile->methodTypes[_hx_array_get(Type::enumParameters($methodType), 0)];
							$_args = "";
							{
								$_g4 = 0; $_g5 = $_m->args;
								while($_g4 < $_g5->length) {
									$a = $_g5[$_g4];
									++$_g4;
									$_args .= _hx_string_or_null($this->getName($a)) . ",";
									unset($a);
								}
							}
							$_ret = $this->getName($_m->ret);
							$_k = be_haxer_hxswfml_AbcReader_50($this, $_args, $_g, $_g1, $_g2, $_g3, $_m, $_ret, $abcReader, $data, $field, $hasMethodBody, $i, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $xml);
							$_name = $this->getName($field->name);
							$xml->add(be_haxer_hxswfml_AbcReader_51($this, $_args, $_g, $_g1, $_g2, $_g3, $_k, $_m, $_name, $_ret, $abcReader, $data, $field, $hasMethodBody, $i, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $xml));
							$xml->add("<function name=\"");
							$xml->add($_name);
							$xml->add("\"");
							if($isOverride) {
								$xml->add(" override=\"true\"");
							}
							if($isFinal) {
								$xml->add(" final=\"true\"");
							}
							if($_k !== "normal") {
								$xml->add(" kind=\"");
								$xml->add($_k);
								$xml->add("\"");
							}
							$xml->add(" args=\"");
							$xml->add(be_haxer_hxswfml_AbcReader_52($this, $_args, $_g, $_g1, $_g2, $_g3, $_k, $_m, $_name, $_ret, $abcReader, $data, $field, $hasMethodBody, $i, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $xml));
							$xml->add("\" return=\"");
							$xml->add($_ret);
							$xml->add("\"");
							$xml->add(be_haxer_hxswfml_AbcReader_53($this, $_args, $_g, $_g1, $_g2, $_g3, $_k, $_m, $_name, $_ret, $abcReader, $data, $field, $hasMethodBody, $i, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $xml));
							$hasMethodBody = false;
							$this->currentFunctionName = $_name;
							$f = $abcReader->functions[_hx_array_get(Type::enumParameters($methodType), 0)];
							if($f !== null) {
								$hasMethodBody = true;
								if($f->locals->length !== 0) {
									$xml->add(" locals=\"");
									$xml->add(be_haxer_hxswfml_AbcReader_54($this, $_args, $_g, $_g1, $_g2, $_g3, $_k, $_m, $_name, $_ret, $abcReader, $data, $f, $field, $hasMethodBody, $i, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $xml));
									$xml->add("\"");
								}
								$xml->add(" slot=\"" . _hx_string_rec($field->slot, "") . "\"");
								$xml->add(" > <!-- maxStack=\"");
								$xml->add($f->maxStack);
								$xml->add("\" nRegs=\"");
								$xml->add($f->nRegs);
								$xml->add("\" initScope=\"");
								$xml->add($f->initScope);
								$xml->add("\" maxScope=\"");
								$xml->add($f->maxScope);
								$xml->add("\" length=\"" . _hx_string_rec($f->code->length, "") . " bytes\"-->\x0A");
								$xml->add($this->decodeToXML(format_abc_OpReader::decode(new haxe_io_BytesInput($f->code, null, null)), $f));
							}
							if(!$hasMethodBody) {
								$xml->add(" >\x0A");
							}
							$xml->add(be_haxer_hxswfml_AbcReader_55($this, $_args, $_g, $_g1, $_g2, $_g3, $_k, $_m, $_name, $_ret, $abcReader, $data, $f, $field, $hasMethodBody, $i, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $xml));
							$xml->add("</function>\x0A\x0A");
						}break;
						default:{
						}break;
						}
						unset($field);
					}
					unset($_g3,$_g2);
				}
				unset($i);
			}
		}
		{
			$_g = 0; $_g1 = $this->abcFile->classes;
			while($_g < $_g1->length) {
				$_class = $_g1[$_g];
				++$_g;
				$clName = $this->getName($_class->name);
				$this->className = $clName;
				$_extends = $this->getName($_class->superclass);
				$_implements = $_class->interfaces;
				$__implements = "";
				{
					$_g2 = 0;
					while($_g2 < $_implements->length) {
						$i = $_implements[$_g2];
						++$_g2;
						$__implements .= _hx_string_or_null($this->getName($i)) . ",";
						unset($i);
					}
					unset($_g2);
				}
				$_ns = be_haxer_hxswfml_AbcReader_56($this, $__implements, $_class, $_extends, $_g, $_g1, $_implements, $abcReader, $clName, $data, $hasMethodBody, $infos, $loopIndex, $name, $xml);
				$_sealed = $_class->isSealed;
				$_final = $_class->isFinal;
				$_interface = $_class->isInterface;
				$script_init = null;
				$script_init2 = null;
				{
					$_g2 = 0; $_g3 = $this->abcFile->inits;
					while($_g2 < $_g3->length) {
						$i = $_g3[$_g2];
						++$_g2;
						{
							$_g4 = 0; $_g5 = $i->fields;
							while($_g4 < $_g5->length) {
								$field = $_g5[$_g4];
								++$_g4;
								$__hx__t = ($field->kind);
								switch($__hx__t->index) {
								case 2:
								$c = $__hx__t->params[0];
								{
									if(_hx_equal($_class, $this->abcFile->classes[_hx_array_get(Type::enumParameters($c), 0)])) {
										$script_init2 = $i->method;
										$script_init = $this->abcFile->methodTypes[_hx_array_get(Type::enumParameters($i->method), 0)];
										break 2;
									}
								}break;
								default:{
								}break;
								}
								unset($field);
							}
							unset($_g5,$_g4);
						}
						unset($i);
					}
					unset($_g3,$_g2);
				}
				if($script_init !== null) {
					$stargsStr = "";
					{
						$_g2 = 0; $_g3 = $script_init->args;
						while($_g2 < $_g3->length) {
							$a = $_g3[$_g2];
							++$_g2;
							$stargsStr .= _hx_string_or_null($this->getName($a)) . ",";
							unset($a);
						}
						unset($_g3,$_g2);
					}
					$ret = $this->getName($script_init->ret);
					$xml->add(be_haxer_hxswfml_AbcReader_57($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $clName, $data, $hasMethodBody, $infos, $loopIndex, $name, $ret, $script_init, $script_init2, $stargsStr, $xml));
					$xml->add("<init name=\"");
					$xml->add($clName);
					$xml->add("\"");
					if($stargsStr !== "") {
						$xml->add(" args=\"");
						$xml->add(be_haxer_hxswfml_AbcReader_58($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $clName, $data, $hasMethodBody, $infos, $loopIndex, $name, $ret, $script_init, $script_init2, $stargsStr, $xml));
						$xml->add("\"");
					}
					$xml->add(" return=\"");
					$xml->add($ret);
					$xml->add("\"");
					$xml->add(be_haxer_hxswfml_AbcReader_59($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $clName, $data, $hasMethodBody, $infos, $loopIndex, $name, $ret, $script_init, $script_init2, $stargsStr, $xml));
					$this->currentFunctionName = $clName;
					$f = $abcReader->functions[_hx_array_get(Type::enumParameters($script_init2), 0)];
					if($f->locals->length !== 0) {
						$xml->add(" locals=\"");
						$xml->add(be_haxer_hxswfml_AbcReader_60($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $clName, $data, $f, $hasMethodBody, $infos, $loopIndex, $name, $ret, $script_init, $script_init2, $stargsStr, $xml));
						$xml->add("\"");
					}
					$xml->add(" ><!-- maxStack=\"");
					$xml->add($f->maxStack);
					$xml->add("\" nRegs=\"");
					$xml->add($f->nRegs);
					$xml->add("\" initScope=\"");
					$xml->add($f->initScope);
					$xml->add("\" maxScope=\"");
					$xml->add($f->maxScope);
					$xml->add("\" length=\"" . _hx_string_rec($f->code->length, "") . " bytes\"-->\x0A");
					$xml->add($this->decodeToXML(format_abc_OpReader::decode(new haxe_io_BytesInput($f->code, null, null)), $f));
					$xml->add(be_haxer_hxswfml_AbcReader_61($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $clName, $data, $f, $hasMethodBody, $infos, $loopIndex, $name, $ret, $script_init, $script_init2, $stargsStr, $xml));
					$xml->add("</init>\x0A");
					unset($stargsStr,$ret,$f);
				}
				$xml->add(be_haxer_hxswfml_AbcReader_62($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $clName, $data, $hasMethodBody, $infos, $loopIndex, $name, $script_init, $script_init2, $xml));
				$xml->add("<class name=\"");
				$xml->add($clName);
				$xml->add("\"");
				if($_extends !== null && $_extends !== "") {
					$xml->add(" extends=\"");
					$xml->add($_extends);
					$xml->add("\"");
				}
				if($__implements !== "") {
					$xml->add(" implements=\"");
					$xml->add(be_haxer_hxswfml_AbcReader_63($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $clName, $data, $hasMethodBody, $infos, $loopIndex, $name, $script_init, $script_init2, $xml));
					$xml->add("\"");
				}
				if($_sealed) {
					$xml->add(" sealed=\"true\"");
				}
				if($_final) {
					$xml->add(" final=\"true\"");
				}
				if($_interface) {
					$xml->add(" interface=\"true\"");
				}
				$xml->add(">\x0A");
				$this->indentLevel++;
				{
					$_g2 = 0; $_g3 = $_class->fields;
					while($_g2 < $_g3->length) {
						$field = $_g3[$_g2];
						++$_g2;
						$__hx__t = ($field->kind);
						switch($__hx__t->index) {
						case 0:
						$_const = $__hx__t->params[2]; $value = $__hx__t->params[1]; $type = $__hx__t->params[0];
						{
							$_type = $this->getName($type);
							$_value = $this->getValue($value);
							$cnst = $_const;
							$xml->add(be_haxer_hxswfml_AbcReader_64($this, $__implements, $_class, $_const, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_ns, $_sealed, $_type, $_value, $abcReader, $clName, $cnst, $data, $field, $hasMethodBody, $infos, $loopIndex, $name, $script_init, $script_init2, $type, $value, $xml));
							$xml->add("<var name=\"");
							$xml->add($this->getName($field->name));
							$xml->add("\"");
							if($_type !== null && $_type !== "*" && $_type !== "") {
								$xml->add(" type=\"");
								$xml->add($_type);
								$xml->add("\"");
							}
							if($_value !== "") {
								$xml->add(" value=\"");
								$xml->add($_value);
								$xml->add("\"");
							}
							if($cnst) {
								$xml->add(" const=\"true\"");
							}
							$xml->add(" slot=\"" . _hx_string_rec($field->slot, "") . "\"");
							$xml->add(" />\x0A");
						}break;
						default:{
						}break;
						}
						unset($field);
					}
					unset($_g3,$_g2);
				}
				{
					$_g2 = 0; $_g3 = $_class->staticFields;
					while($_g2 < $_g3->length) {
						$field = $_g3[$_g2];
						++$_g2;
						$__hx__t = ($field->kind);
						switch($__hx__t->index) {
						case 0:
						$_const = $__hx__t->params[2]; $value = $__hx__t->params[1]; $type = $__hx__t->params[0];
						{
							$_type = $this->getName($type);
							$_value = $this->getValue($value);
							$cnst = $_const;
							$xml->add(be_haxer_hxswfml_AbcReader_65($this, $__implements, $_class, $_const, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_ns, $_sealed, $_type, $_value, $abcReader, $clName, $cnst, $data, $field, $hasMethodBody, $infos, $loopIndex, $name, $script_init, $script_init2, $type, $value, $xml));
							$xml->add("<var name=\"");
							$xml->add($this->getName($field->name));
							$xml->add("\"");
							if($_type !== null && $_type !== "*" && $_type !== "") {
								$xml->add(" type=\"");
								$xml->add($_type);
								$xml->add("\"");
							}
							if($_value !== "") {
								$xml->add(" value=\"");
								$xml->add($_value);
								$xml->add("\"");
							}
							if($cnst) {
								$xml->add(" const=\"true\"");
							}
							$xml->add(" slot=\"" . _hx_string_rec($field->slot, "") . "\"");
							$xml->add(" static=\"true\" />\x0A");
						}break;
						default:{
						}break;
						}
						unset($field);
					}
					unset($_g3,$_g2);
				}
				$cst = $this->abcFile->methodTypes[_hx_array_get(Type::enumParameters($_class->constructor), 0)];
				$cargsStr = "";
				{
					$_g2 = 0; $_g3 = $cst->args;
					while($_g2 < $_g3->length) {
						$a = $_g3[$_g2];
						++$_g2;
						$cargsStr .= _hx_string_or_null($this->getName($a)) . ",";
						unset($a);
					}
					unset($_g3,$_g2);
				}
				$returnType = $this->getName($cst->ret);
				$xml->add(be_haxer_hxswfml_AbcReader_66($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $hasMethodBody, $infos, $loopIndex, $name, $returnType, $script_init, $script_init2, $xml));
				$xml->add("<function name=\"");
				$xml->add($clName);
				$xml->add("\" args=\"");
				$xml->add(be_haxer_hxswfml_AbcReader_67($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $hasMethodBody, $infos, $loopIndex, $name, $returnType, $script_init, $script_init2, $xml));
				$xml->add("\" return=\"");
				$xml->add($returnType);
				$xml->add("\"");
				$xml->add(be_haxer_hxswfml_AbcReader_68($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $hasMethodBody, $infos, $loopIndex, $name, $returnType, $script_init, $script_init2, $xml));
				$this->currentFunctionName = $clName;
				$f = $abcReader->functions[_hx_array_get(Type::enumParameters($_class->constructor), 0)];
				if($f !== null) {
					if($f->locals->length !== 0) {
						$xml->add(" locals=\"");
						$xml->add(be_haxer_hxswfml_AbcReader_69($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $hasMethodBody, $infos, $loopIndex, $name, $returnType, $script_init, $script_init2, $xml));
						$xml->add("\"");
					}
					$xml->add(" > <!-- maxStack=\"");
					$xml->add($f->maxStack);
					$xml->add("\" nRegs=\"");
					$xml->add($f->nRegs);
					$xml->add("\" initScope=\"");
					$xml->add($f->initScope);
					$xml->add("\" maxScope=\"");
					$xml->add($f->maxScope);
					$xml->add("\" length=\"" . _hx_string_rec($f->code->length, "") . " bytes\"-->\x0A");
					$xml->add($this->decodeToXML(format_abc_OpReader::decode(new haxe_io_BytesInput($f->code, null, null)), $f));
				}
				if($_interface || $f === null) {
					$xml->add(" >\x0A");
					$xml->add(be_haxer_hxswfml_AbcReader_70($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $hasMethodBody, $infos, $loopIndex, $name, $returnType, $script_init, $script_init2, $xml));
					$xml->add("</function>\x0A\x0A");
				} else {
					$xml->add(be_haxer_hxswfml_AbcReader_71($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $hasMethodBody, $infos, $loopIndex, $name, $returnType, $script_init, $script_init2, $xml));
					$xml->add("</function>\x0A\x0A");
				}
				$st = $this->abcFile->methodTypes[_hx_array_get(Type::enumParameters($_class->statics), 0)];
				$stargsStr = "";
				{
					$_g2 = 0; $_g3 = $st->args;
					while($_g2 < $_g3->length) {
						$a = $_g3[$_g2];
						++$_g2;
						$stargsStr .= _hx_string_or_null($this->getName($a)) . ",";
						unset($a);
					}
					unset($_g3,$_g2);
				}
				$ret = $this->getName($st->ret);
				$xml->add(be_haxer_hxswfml_AbcReader_72($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $hasMethodBody, $infos, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
				$xml->add("<function name=\"");
				$xml->add($this->getName($_class->name));
				$xml->add("\" static=\"true\" args=\"");
				$xml->add(be_haxer_hxswfml_AbcReader_73($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $hasMethodBody, $infos, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
				$xml->add("\" return=\"");
				$xml->add($ret);
				$xml->add("\"");
				$xml->add(be_haxer_hxswfml_AbcReader_74($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $hasMethodBody, $infos, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
				$this->currentFunctionName = $clName;
				$f1 = $abcReader->functions[_hx_array_get(Type::enumParameters($_class->statics), 0)];
				if($f1->locals->length !== 0) {
					$xml->add(" locals=\"");
					$xml->add(be_haxer_hxswfml_AbcReader_75($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $hasMethodBody, $infos, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
					$xml->add("\"");
				}
				$xml->add(" > <!-- maxStack=\"");
				$xml->add($f1->maxStack);
				$xml->add("\" nRegs=\"");
				$xml->add($f1->nRegs);
				$xml->add("\" initScope=\"");
				$xml->add($f1->initScope);
				$xml->add("\" maxScope=\"");
				$xml->add($f1->maxScope);
				$xml->add("\" length=\"" . _hx_string_rec($f1->code->length, "") . " bytes\"-->\x0A");
				$xml->add($this->decodeToXML(format_abc_OpReader::decode(new haxe_io_BytesInput($f1->code, null, null)), $f1));
				$xml->add(be_haxer_hxswfml_AbcReader_76($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $hasMethodBody, $infos, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
				$xml->add("</function>\x0A\x0A");
				{
					$_g2 = 0; $_g3 = $_class->fields;
					while($_g2 < $_g3->length) {
						$field = $_g3[$_g2];
						++$_g2;
						$__hx__t = ($field->kind);
						switch($__hx__t->index) {
						case 1:
						$isOverride = $__hx__t->params[3]; $isFinal = $__hx__t->params[2]; $k = $__hx__t->params[1]; $methodType = $__hx__t->params[0];
						{
							$_m = $this->abcFile->methodTypes[_hx_array_get(Type::enumParameters($methodType), 0)];
							$_args = "";
							{
								$_g4 = 0; $_g5 = $_m->args;
								while($_g4 < $_g5->length) {
									$a = $_g5[$_g4];
									++$_g4;
									$_args .= _hx_string_or_null($this->getName($a)) . ",";
									unset($a);
								}
							}
							$_ret = $this->getName($_m->ret);
							$_k = be_haxer_hxswfml_AbcReader_77($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_m, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml);
							$_name = $this->getName($field->name);
							$xml->add(be_haxer_hxswfml_AbcReader_78($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
							$xml->add("<function name=\"");
							$xml->add($_name);
							$xml->add("\"");
							if($isOverride) {
								$xml->add(" override=\"true\"");
							}
							if($isFinal) {
								$xml->add(" final=\"true\"");
							}
							if($_k !== "normal") {
								$xml->add(" kind=\"");
								$xml->add($_k);
								$xml->add("\"");
							}
							$xml->add(" args=\"");
							$xml->add(be_haxer_hxswfml_AbcReader_79($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
							$xml->add("\" return=\"");
							$xml->add($_ret);
							$xml->add("\"");
							$xml->add(be_haxer_hxswfml_AbcReader_80($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
							$hasMethodBody = false;
							$this->currentFunctionName = $_name;
							$f2 = $abcReader->functions[_hx_array_get(Type::enumParameters($methodType), 0)];
							if($f2 !== null) {
								$hasMethodBody = true;
								if($f2->locals->length !== 0) {
									$xml->add(" locals=\"");
									$xml->add(be_haxer_hxswfml_AbcReader_81($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $f2, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
									$xml->add("\"");
								}
								$xml->add(" slot=\"" . _hx_string_rec($field->slot, "") . "\"");
								$xml->add(" > <!-- maxStack=\"");
								$xml->add($f2->maxStack);
								$xml->add("\" nRegs=\"");
								$xml->add($f2->nRegs);
								$xml->add("\" initScope=\"");
								$xml->add($f2->initScope);
								$xml->add("\" maxScope=\"");
								$xml->add($f2->maxScope);
								$xml->add("\" length=\"" . _hx_string_rec($f2->code->length, "") . " bytes\"-->\x0A");
								$xml->add($this->decodeToXML(format_abc_OpReader::decode(new haxe_io_BytesInput($f2->code, null, null)), $f2));
							}
							if(!$hasMethodBody) {
								$xml->add(" >\x0A");
							}
							$xml->add(be_haxer_hxswfml_AbcReader_82($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $f2, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
							$xml->add("</function>\x0A\x0A");
						}break;
						default:{
						}break;
						}
						unset($field);
					}
					unset($_g3,$_g2);
				}
				{
					$_g2 = 0; $_g3 = $_class->staticFields;
					while($_g2 < $_g3->length) {
						$field = $_g3[$_g2];
						++$_g2;
						$__hx__t = ($field->kind);
						switch($__hx__t->index) {
						case 1:
						$isOverride = $__hx__t->params[3]; $isFinal = $__hx__t->params[2]; $k = $__hx__t->params[1]; $type = $__hx__t->params[0];
						{
							$_m = $this->abcFile->methodTypes[_hx_array_get(Type::enumParameters($type), 0)];
							$_args = "";
							{
								$_g4 = 0; $_g5 = $_m->args;
								while($_g4 < $_g5->length) {
									$a = $_g5[$_g4];
									++$_g4;
									$_args .= _hx_string_or_null($this->getName($a)) . ",";
									unset($a);
								}
							}
							$_ret = $this->getName($_m->ret);
							$_k = be_haxer_hxswfml_AbcReader_83($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_m, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $type, $xml);
							$_name = $this->getName($field->name);
							$xml->add(be_haxer_hxswfml_AbcReader_84($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $type, $xml));
							$xml->add("<function name=\"");
							$xml->add($_name);
							$xml->add("\" static=\"true\"");
							if($isOverride) {
								$xml->add(" override=\"true\"");
							}
							if($isFinal) {
								$xml->add(" final=\"true\"");
							}
							if($_k !== "normal") {
								$xml->add(" kind=\"");
								$xml->add($_k);
								$xml->add("\"");
							}
							$xml->add(" args=\"");
							$xml->add(be_haxer_hxswfml_AbcReader_85($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $type, $xml));
							$xml->add("\" return=\"");
							$xml->add($_ret);
							$xml->add("\"");
							$xml->add(be_haxer_hxswfml_AbcReader_86($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $type, $xml));
							$hasMethodBody = false;
							$this->currentFunctionName = $_name;
							$f2 = $abcReader->functions[_hx_array_get(Type::enumParameters($type), 0)];
							if($f2 !== null) {
								$hasMethodBody = true;
								if($f2->locals->length !== 0) {
									$xml->add(" locals=\"");
									$xml->add(be_haxer_hxswfml_AbcReader_87($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $f2, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $type, $xml));
									$xml->add("\"");
								}
								$xml->add(" slot=\"" . _hx_string_rec($field->slot, "") . "\"");
								$xml->add(" > <!-- maxStack=\"");
								$xml->add($f2->maxStack);
								$xml->add("\" nRegs=\"");
								$xml->add($f2->nRegs);
								$xml->add("\" initScope=\"");
								$xml->add($f2->initScope);
								$xml->add("\" maxScope=\"");
								$xml->add($f2->maxScope);
								$xml->add("\" length=\"" . _hx_string_rec($f2->code->length, "") . " bytes\"-->\x0A");
								$xml->add($this->decodeToXML(format_abc_OpReader::decode(new haxe_io_BytesInput($f2->code, null, null)), $f2));
							}
							if(!$hasMethodBody) {
								$xml->add(" >\x0A");
							}
							$xml->add(be_haxer_hxswfml_AbcReader_88($this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $f2, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $type, $xml));
							$xml->add("</function>\x0A\x0A");
						}break;
						default:{
						}break;
						}
						unset($field);
					}
					unset($_g3,$_g2);
				}
				$this->indentLevel--;
				$xml->add(be_haxer_hxswfml_AbcReader_89($this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $f, $f1, $hasMethodBody, $infos, $loopIndex, $name, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $xml));
				$xml->add("</class>\x0A");
				unset($stargsStr,$st,$script_init2,$script_init,$returnType,$ret,$f1,$f,$cst,$clName,$cargsStr,$_sealed,$_ns,$_interface,$_implements,$_final,$_extends,$_class,$__implements);
			}
		}
		$temp = new _hx_array(array());
		while($this->functionClosuresBodies->length > 0) {
			$temp->push($this->createFunctionClosure($this->functionClosuresBodies->shift()));
		}
		$temp->reverse();
		$xml->add($temp->join(""));
		$this->indentLevel--;
		$xml->add(be_haxer_hxswfml_AbcReader_90($this, $abcReader, $data, $hasMethodBody, $infos, $loopIndex, $name, $temp, $xml));
		$xml->add("</abcfile>\x0A");
		return $xml->b;
	}
	public function getXML() {
		return $this->xml_out->b;
	}
	public function read($type, $bytes) {
		$this->xml_out = new StringBuf();
		$this->xml_out->add("<abcfiles>\x0A");
		if($type === "abc") {
			$this->xml_out->add($this->abcToXml($bytes, null));
		} else {
			if($type === "swf") {
				$swf = $bytes;
				$swfBytesInput = new haxe_io_BytesInput($swf, null, null);
				$swfReader = new format_swf_Reader($swfBytesInput);
				$header = $swfReader->readHeader();
				$tags = $swfReader->readTagList(null);
				$swfBytesInput->close();
				$index = 0;
				$loopIndex = 0;
				{
					$_g = 0;
					while($_g < $tags->length) {
						$tag = $tags[$_g];
						++$_g;
						$__hx__t = ($tag);
						switch($__hx__t->index) {
						case 13:
						$ctx = $__hx__t->params[1]; $data = $__hx__t->params[0];
						{
							$this->xml_out->add($this->abcToXml($data, $ctx));
						}break;
						default:{
						}break;
						}
						unset($tag);
					}
				}
			} else {
				if($type === "swc") {
					$zipBytesInput = new haxe_io_BytesInput($bytes, null, null);
					$zipReader = new format_zip_Reader($zipBytesInput);
					$list = $zipReader->read();
					$swf = null;
					if(null == $list) throw new HException('null iterable');
					$__hx__it = $list->iterator();
					while($__hx__it->hasNext()) {
						$file = $__hx__it->next();
						$extension = strtolower(_hx_substr($file->fileName, _hx_last_index_of($file->fileName, ".", null) + 1, null));
						if($extension === "swf") {
							$swf = $file->data;
						}
						unset($extension);
					}
					if($swf === null) {
						throw new HException("No swf file found inside swc");
					}
					$swfBytesInput = new haxe_io_BytesInput($swf, null, null);
					$swfReader = new format_swf_Reader($swfBytesInput);
					$header = $swfReader->readHeader();
					$tags = $swfReader->readTagList(null);
					$swfBytesInput->close();
					$index = 0;
					$loopIndex = 0;
					{
						$_g = 0;
						while($_g < $tags->length) {
							$tag = $tags[$_g];
							++$_g;
							$__hx__t = ($tag);
							switch($__hx__t->index) {
							case 13:
							$ctx = $__hx__t->params[1]; $data = $__hx__t->params[0];
							{
								$this->xml_out->add($this->abcToXml($data, $ctx));
							}break;
							default:{
							}break;
							}
							unset($tag);
						}
					}
				} else {
					throw new HException("Unsupported input file format");
				}
			}
		}
		$this->xml_out->add("</abcfiles>");
	}
	public $sourceInfo;
	public $jumpInfo;
	public $debugInfo;
	public $xml_out;
	public $abcId;
	public $abcReader_import;
	public $lastLabel;
	public $lastJump;
	public $debugFileName;
	public $debugFile;
	public $debugLines;
	public $className;
	public $currentFunctionName;
	public $functionParseIndex;
	public $functionClosuresBodies;
	public $functionClosures;
	public $indentLevel;
	public $abcFile;
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
	function __toString() { return 'be.haxer.hxswfml.AbcReader'; }
}
function be_haxer_hxswfml_AbcReader_0(&$__hx__this, &$fileName, &$str) {
	{
		$out = _hx_explode("\x0D\x0A", $str)->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_AbcReader_1(&$__hx__this, &$_g, &$_g1, &$fileName, &$i, &$str) {
	{
		$out = _hx_explode("\x0D\x0A", $__hx__this->debugLines[$i])->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_AbcReader_2(&$__hx__this, &$fileName) {
	if($__hx__this->debugFileName === "<null>") {
		return "";
	} else {
		return $__hx__this->debugFileName;
	}
}
function be_haxer_hxswfml_AbcReader_3(&$__hx__this, &$out, &$value) {
	$__hx__t = ($value);
	switch($__hx__t->index) {
	case 0:
	{
		return "";
	}break;
	case 2:
	$v = $__hx__t->params[0];
	{
		return _hx_explode("\x1B", _hx_explode("\x0A", _hx_explode("\x0D", _hx_explode("\x09", _hx_explode("<", _hx_explode("\"", _hx_explode("&", $__hx__this->abcFile->get($__hx__this->abcFile->strings, $v))->join("&amp;"))->join("&quot;"))->join("&lt;"))->join("\\t"))->join("\\r"))->join("\\n"))->join("\\u001b");
	}break;
	case 3:
	$v = $__hx__t->params[0];
	{
		return Std::string($__hx__this->abcFile->get($__hx__this->abcFile->ints, $v));
	}break;
	case 4:
	$v = $__hx__t->params[0];
	{
		return Std::string($__hx__this->abcFile->get($__hx__this->abcFile->uints, $v));
	}break;
	case 5:
	$v = $__hx__t->params[0];
	{
		return Std::string($__hx__this->abcFile->get($__hx__this->abcFile->floats, $v));
	}break;
	case 1:
	$v = $__hx__t->params[0];
	{
		if($v === true) {
			return "true";
		} else {
			return "false";
		}
	}break;
	case 6:
	$ns = $__hx__t->params[1]; $kind = $__hx__t->params[0];
	{
		return _hx_string_rec($kind, "") . _hx_string_or_null(be_haxer_hxswfml_AbcReader_91($__hx__this, $kind, $ns, $out, $value));
	}break;
	}
}
function be_haxer_hxswfml_AbcReader_4(&$__hx__this, &$out, &$value) {
	$__hx__t = ($value);
	switch($__hx__t->index) {
	case 0:
	{
		return "";
	}break;
	case 2:
	$v = $__hx__t->params[0];
	{
		return _hx_string_or_null(_hx_explode("\x1B", _hx_explode("\x0A", _hx_explode("\x0D", _hx_explode("\x09", _hx_explode("<", _hx_explode("\"", _hx_explode("&", $__hx__this->abcFile->get($__hx__this->abcFile->strings, $v))->join("&amp;"))->join("&quot;"))->join("&lt;"))->join("\\t"))->join("\\r"))->join("\\n"))->join("\\u001b")) . ":String";
	}break;
	case 3:
	$v = $__hx__t->params[0];
	{
		return Std::string($__hx__this->abcFile->get($__hx__this->abcFile->ints, $v)) . ":int";
	}break;
	case 4:
	$v = $__hx__t->params[0];
	{
		return Std::string($__hx__this->abcFile->get($__hx__this->abcFile->uints, $v)) . ":uint";
	}break;
	case 5:
	$v = $__hx__t->params[0];
	{
		return Std::string($__hx__this->abcFile->get($__hx__this->abcFile->floats, $v)) . ":Number";
	}break;
	case 1:
	$v = $__hx__t->params[0];
	{
		if($v === true) {
			return "true:Boolean";
		} else {
			return "false:Boolean";
		}
	}break;
	case 6:
	$ns = $__hx__t->params[1]; $kind = $__hx__t->params[0];
	{
		return _hx_string_rec($kind, "") . _hx_string_or_null(be_haxer_hxswfml_AbcReader_92($__hx__this, $kind, $ns, $out, $value)) . ":Namespace";
	}break;
	}
}
function be_haxer_hxswfml_AbcReader_5(&$__hx__this, &$__name, &$__namespace, &$name, &$name1, &$ns) {
	{
		$out = "";
		if($ns !== null) {
			$ns1 = $__hx__this->abcFile->get($__hx__this->abcFile->namespaces, $ns);
			$name2 = _hx_array_get(Type::enumParameters($ns1), 0);
			$_name = $__hx__this->abcFile->get($__hx__this->abcFile->strings, $name2);
			if($_name === null) {
				$out = "";
			} else {
				$out = be_haxer_hxswfml_AbcReader_93($__hx__this, $__name, $__namespace, $_name, $name, $name1, $name2, $ns, $ns1, $out);
			}
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_6(&$__hx__this, &$__name, &$__namespace, &$index, &$name, &$name1, &$nset, &$nsset) {
	{
		$id = $nset[0];
		$out = "";
		if($id !== null) {
			$ns = $__hx__this->abcFile->get($__hx__this->abcFile->namespaces, $id);
			$name2 = _hx_array_get(Type::enumParameters($ns), 0);
			$_name = $__hx__this->abcFile->get($__hx__this->abcFile->strings, $name2);
			if($_name === null) {
				$out = "";
			} else {
				$out = be_haxer_hxswfml_AbcReader_94($__hx__this, $__name, $__namespace, $_name, $id, $index, $name, $name1, $name2, $ns, $nset, $nsset, $out);
			}
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_7(&$__hx__this, &$__name, &$__namespace, &$index, &$name, &$name1, &$nset, &$nsset) {
	{
		$out = (($__name === null) ? "" : $__name);
		if($__name !== null && _hx_last_index_of($__name, ",", null) === strlen($__name) - 1) {
			$out = _hx_substr($__name, 0, strlen($__name) - 1);
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_8(&$__hx__this, &$__name, &$__namespace, &$_g, &$_g1, &$n, &$name, &$name1, &$nname, &$nns, &$nsset) {
	{
		$out = "";
		if($nns !== null) {
			$ns = $__hx__this->abcFile->get($__hx__this->abcFile->namespaces, $nns);
			$name2 = _hx_array_get(Type::enumParameters($ns), 0);
			$_name = $__hx__this->abcFile->get($__hx__this->abcFile->strings, $name2);
			if($_name === null) {
				$out = "";
			} else {
				$out = be_haxer_hxswfml_AbcReader_95($__hx__this, $__name, $__namespace, $_g, $_g1, $_name, $n, $name, $name1, $name2, $nname, $nns, $ns, $nsset, $out);
			}
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_9(&$__hx__this, &$__name, &$__namespace, &$name) {
	{
		$out = (($__name === null) ? "" : $__name);
		if($__name !== null && _hx_last_index_of($__name, ",", null) === strlen($__name) - 1) {
			$out = _hx_substr($__name, 0, strlen($__name) - 1);
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_10(&$__hx__this, &$_name, &$id, &$name, &$ns, &$out) {
	if($_name !== "") {
		return _hx_string_or_null($_name) . ".";
	} else {
		return $_name;
	}
}
function be_haxer_hxswfml_AbcReader_11(&$__hx__this, &$_locals, &$locals, &$out) {
	{
		$out1 = (($out === null) ? "" : $out);
		if($out !== null && _hx_last_index_of($out, ",", null) === strlen($out) - 1) {
			$out1 = _hx_substr($out, 0, strlen($out) - 1);
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_12(&$__hx__this, &$extra, &$out, &$str) {
	{
		$str1 = $str->b;
		$out1 = (($str1 === null) ? "" : $str1);
		if($str1 !== null && _hx_last_index_of($str1, ",", null) === strlen($str1) - 1) {
			$out1 = _hx_substr($str1, 0, strlen($str1) - 1);
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_13(&$__hx__this, &$_args, &$_m, &$_name, &$_ret, &$f, &$out) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g = $__hx__this->indentLevel;
			while($_g1 < $_g) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_14(&$__hx__this, &$_args, &$_m, &$_name, &$_ret, &$f, &$out) {
	{
		$out1 = (($_args === null) ? "" : $_args);
		if($_args !== null && _hx_last_index_of($_args, ",", null) === strlen($_args) - 1) {
			$out1 = _hx_substr($_args, 0, strlen($_args) - 1);
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_15(&$__hx__this, &$_args, &$_m, &$_name, &$_ret, &$f, &$out) {
	{
		$extra = $_m->extra;
		$out1 = new StringBuf();
		if($extra !== null) {
			if($extra->native) {
				$out1->add(" native=\"true\"");
			}
			if($extra->variableArgs) {
				$out1->add(" variableArgs=\"true\"");
			}
			if($extra->argumentsDefined) {
				$out1->add(" argumentsDefined=\"true\"");
			}
			if($extra->usesDXNS) {
				$out1->add(" usesDXNS=\"true\"");
			}
			if($extra->newBlock) {
				$out1->add(" newBlock=\"true\"");
			}
			if($extra->unused) {
				$out1->add(" unused=\"true\"");
			}
			if($extra->debugName !== null && $__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName) !== "") {
				$out1->add(" debugName=\"");
				$out1->add($__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName));
				$out1->add("\"");
			}
			if($extra->defaultParameters !== null) {
				$str = new StringBuf();
				{
					$_g1 = 0; $_g = $extra->defaultParameters->length;
					while($_g1 < $_g) {
						$i = $_g1++;
						$str->add(_hx_string_or_null($__hx__this->getDefaultValue($extra->defaultParameters[$i])) . ",");
						unset($i);
					}
				}
				$out1->add(" defaultParameters=\"");
				$out1->add(be_haxer_hxswfml_AbcReader_96($__hx__this, $_args, $_m, $_name, $_ret, $extra, $f, $out, $out1, $str));
				$out1->add("\"");
			}
		}
		return $out1->b;
	}
}
function be_haxer_hxswfml_AbcReader_16(&$__hx__this, &$_args, &$_f, &$_g, &$_g1, &$_m, &$_name, &$_ret, &$f, &$out) {
	{
		$locals = $_f->locals;
		$out1 = "";
		$_locals = new _hx_array(array());
		{
			$_g11 = 0; $_g2 = $locals->length;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$l = $locals[$i];
				$slot = $l->slot;
				$__hx__t = ($l->kind);
				switch($__hx__t->index) {
				case 0:
				$_const = $__hx__t->params[2]; $value = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$str = "";
					$con = null;
					if($_const) {
						$con = "true";
					} else {
						$con = "false";
					}
					$str .= _hx_string_or_null($__hx__this->getName($l->name));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getName($type));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getValue($value));
					$str .= ":";
					$str .= _hx_string_or_null($con);
					$_locals[$slot] = $str;
				}break;
				case 1:
				$isOverride = $__hx__t->params[3]; $isFinal = $__hx__t->params[2]; $k = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$_locals[$slot] = "FMethod";
				}break;
				case 2:
				$c = $__hx__t->params[0];
				{
					$_locals[$slot] = "FClass";
				}break;
				case 3:
				$f1 = $__hx__t->params[0];
				{
					$_locals[$slot] = "FFunction";
				}break;
				}
				unset($slot,$l,$i);
			}
		}
		{
			$_g11 = 1; $_g2 = $_locals->length;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$out1 .= _hx_string_or_null($_locals[$i]) . ",";
				unset($i);
			}
		}
		{
			$out2 = (($out1 === null) ? "" : $out1);
			if($out1 !== null && _hx_last_index_of($out1, ",", null) === strlen($out1) - 1) {
				$out2 = _hx_substr($out1, 0, strlen($out1) - 1);
			}
			return $out2;
		}
		unset($out1,$locals,$_locals);
	}
}
function be_haxer_hxswfml_AbcReader_17(&$__hx__this, &$_args, &$_f, &$_g, &$_g1, &$_m, &$_name, &$_ret, &$f, &$out) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_18(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_19(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$v) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_20(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$v) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_21(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$v) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_22(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$v) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_23(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$v) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_24(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$v) {
	{
		$out = "";
		if($v !== null) {
			$ns = $__hx__this->abcFile->get($__hx__this->abcFile->namespaces, $v);
			$name = _hx_array_get(Type::enumParameters($ns), 0);
			$_name = $__hx__this->abcFile->get($__hx__this->abcFile->strings, $name);
			if($_name === null) {
				$out = "";
			} else {
				$out = be_haxer_hxswfml_AbcReader_97($__hx__this, $_g, $_name, $buf, $bytePos, $ec, $f, $index, $name, $ns, $op, $ops, $out, $v);
			}
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_25(&$__hx__this, &$_g, &$buf, &$bytePos, &$c, &$ec, &$f, &$index, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_26(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$f1, &$index, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_27(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$v) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_28(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$nargs, &$op, &$ops, &$p) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_29(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$v) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_30(&$__hx__this, &$_g, &$_try_, &$buf, &$bytePos, &$ec, &$end, &$f, &$handle, &$index, &$op, &$ops, &$start, &$type, &$v, &$variable) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_31(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$o, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_32(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$nargs, &$op, &$ops, &$s) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_33(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$nargs, &$op, &$ops, &$s) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_34(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$landingName, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_35(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$jump, &$landingName, &$offset, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_36(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$jump, &$landingName, &$offset, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_37(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$landingName, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_38(&$__hx__this, &$_g, &$buf, &$bytePos, &$def, &$deltas, &$ec, &$f, &$index, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_39(&$__hx__this, &$_g, &$buf, &$bytePos, &$def, &$deltas, &$ec, &$f, &$index, &$offsets, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_40(&$__hx__this, &$_g, &$buf, &$bytePos, &$def, &$deltas, &$ec, &$f, &$index, &$offsets, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_41(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$landingName, &$op, &$ops) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_42(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$r1, &$r2) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_43(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$name, &$op, &$ops, &$v) {
	{
		$__hx__this->debugFileName = _hx_explode(";", _hx_explode(";;", _hx_explode("\\", $name)->join("/"))->join("/"))->join("/");
		$__hx__this->debugLines = new _hx_array(array());
		if($__hx__this->sourceInfo) {
			if(file_exists($__hx__this->debugFileName)) {
				$str = sys_io_File::getContent($__hx__this->debugFileName);
				$str = be_haxer_hxswfml_AbcReader_98($__hx__this, $_g, $buf, $bytePos, $ec, $f, $index, $name, $op, $ops, $str, $v);
				$__hx__this->debugLines = _hx_explode("\x0A", $str);
				{
					$_g1 = 0; $_g2 = $__hx__this->debugLines->length;
					while($_g1 < $_g2) {
						$i = $_g1++;
						$__hx__this->debugLines[$i] = _hx_explode("\x0A", (be_haxer_hxswfml_AbcReader_99($__hx__this, $_g, $_g1, $_g2, $buf, $bytePos, $ec, $f, $i, $index, $name, $op, $ops, $str, $v)))->join("");
						unset($i);
					}
				}
			} else {
			}
		}
		$out = be_haxer_hxswfml_AbcReader_100($__hx__this, $_g, $buf, $bytePos, $ec, $f, $index, $name, $op, $ops, $v);
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_44(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$name, &$op, &$ops, &$v) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_45(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$name, &$op, &$ops, &$v) {
	{
		$__hx__this->debugFileName = _hx_explode(";", _hx_explode(";;", _hx_explode("\\", $name)->join("/"))->join("/"))->join("/");
		$__hx__this->debugLines = new _hx_array(array());
		if($__hx__this->sourceInfo) {
			if(file_exists($__hx__this->debugFileName)) {
				$str = sys_io_File::getContent($__hx__this->debugFileName);
				$str = be_haxer_hxswfml_AbcReader_101($__hx__this, $_g, $buf, $bytePos, $ec, $f, $index, $name, $op, $ops, $str, $v);
				$__hx__this->debugLines = _hx_explode("\x0A", $str);
				{
					$_g1 = 0; $_g2 = $__hx__this->debugLines->length;
					while($_g1 < $_g2) {
						$i = $_g1++;
						$__hx__this->debugLines[$i] = _hx_explode("\x0A", (be_haxer_hxswfml_AbcReader_102($__hx__this, $_g, $_g1, $_g2, $buf, $bytePos, $ec, $f, $i, $index, $name, $op, $ops, $str, $v)))->join("");
						unset($i);
					}
				}
			} else {
			}
		}
		$out = be_haxer_hxswfml_AbcReader_103($__hx__this, $_g, $buf, $bytePos, $ec, $f, $index, $name, $op, $ops, $v);
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_46(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$op, &$ops, &$v) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_47(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$line, &$name, &$op, &$ops, &$r) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g1 < $_g2) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_48(&$__hx__this, &$abcReader, &$data, &$infos) {
	if($infos !== null) {
		return $infos->label;
	} else {
		return "untitled_" . Std::string($__hx__this->abcId++);
	}
}
function be_haxer_hxswfml_AbcReader_49(&$__hx__this, &$abcReader, &$data, &$infos, &$name, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g = $__hx__this->indentLevel;
			while($_g1 < $_g) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_50(&$__hx__this, &$_args, &$_g, &$_g1, &$_g2, &$_g3, &$_m, &$_ret, &$abcReader, &$data, &$field, &$hasMethodBody, &$i, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$xml) {
	$__hx__t2 = ($k);
	switch($__hx__t2->index) {
	case 0:
	{
		return "normal";
	}break;
	case 2:
	{
		return "setter";
	}break;
	case 1:
	{
		return "getter";
	}break;
	}
}
function be_haxer_hxswfml_AbcReader_51(&$__hx__this, &$_args, &$_g, &$_g1, &$_g2, &$_g3, &$_k, &$_m, &$_name, &$_ret, &$abcReader, &$data, &$field, &$hasMethodBody, &$i, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g4 = $__hx__this->indentLevel;
			while($_g11 < $_g4) {
				$i1 = $_g11++;
				$str->add("\x09");
				unset($i1);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_52(&$__hx__this, &$_args, &$_g, &$_g1, &$_g2, &$_g3, &$_k, &$_m, &$_name, &$_ret, &$abcReader, &$data, &$field, &$hasMethodBody, &$i, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$xml) {
	{
		$out = (($_args === null) ? "" : $_args);
		if($_args !== null && _hx_last_index_of($_args, ",", null) === strlen($_args) - 1) {
			$out = _hx_substr($_args, 0, strlen($_args) - 1);
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_53(&$__hx__this, &$_args, &$_g, &$_g1, &$_g2, &$_g3, &$_k, &$_m, &$_name, &$_ret, &$abcReader, &$data, &$field, &$hasMethodBody, &$i, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$xml) {
	{
		$extra = $_m->extra;
		$out = new StringBuf();
		if($extra !== null) {
			if($extra->native) {
				$out->add(" native=\"true\"");
			}
			if($extra->variableArgs) {
				$out->add(" variableArgs=\"true\"");
			}
			if($extra->argumentsDefined) {
				$out->add(" argumentsDefined=\"true\"");
			}
			if($extra->usesDXNS) {
				$out->add(" usesDXNS=\"true\"");
			}
			if($extra->newBlock) {
				$out->add(" newBlock=\"true\"");
			}
			if($extra->unused) {
				$out->add(" unused=\"true\"");
			}
			if($extra->debugName !== null && $__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName) !== "") {
				$out->add(" debugName=\"");
				$out->add($__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName));
				$out->add("\"");
			}
			if($extra->defaultParameters !== null) {
				$str = new StringBuf();
				{
					$_g11 = 0; $_g4 = $extra->defaultParameters->length;
					while($_g11 < $_g4) {
						$i1 = $_g11++;
						$str->add(_hx_string_or_null($__hx__this->getDefaultValue($extra->defaultParameters[$i1])) . ",");
						unset($i1);
					}
				}
				$out->add(" defaultParameters=\"");
				$out->add(be_haxer_hxswfml_AbcReader_104($__hx__this, $_args, $_g, $_g1, $_g2, $_g3, $_k, $_m, $_name, $_ret, $abcReader, $data, $extra, $field, $hasMethodBody, $i, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $out, $str, $xml));
				$out->add("\"");
			}
		}
		return $out->b;
	}
}
function be_haxer_hxswfml_AbcReader_54(&$__hx__this, &$_args, &$_g, &$_g1, &$_g2, &$_g3, &$_k, &$_m, &$_name, &$_ret, &$abcReader, &$data, &$f, &$field, &$hasMethodBody, &$i, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$xml) {
	{
		$locals = $f->locals;
		$out = "";
		$_locals = new _hx_array(array());
		{
			$_g11 = 0; $_g4 = $locals->length;
			while($_g11 < $_g4) {
				$i1 = $_g11++;
				$l = $locals[$i1];
				$slot = $l->slot;
				$__hx__t2 = ($l->kind);
				switch($__hx__t2->index) {
				case 0:
				$_const = $__hx__t2->params[2]; $value = $__hx__t2->params[1]; $type = $__hx__t2->params[0];
				{
					$str = "";
					$con = null;
					if($_const) {
						$con = "true";
					} else {
						$con = "false";
					}
					$str .= _hx_string_or_null($__hx__this->getName($l->name));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getName($type));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getValue($value));
					$str .= ":";
					$str .= _hx_string_or_null($con);
					$_locals[$slot] = $str;
				}break;
				case 1:
				$isOverride1 = $__hx__t2->params[3]; $isFinal1 = $__hx__t2->params[2]; $k1 = $__hx__t2->params[1]; $type = $__hx__t2->params[0];
				{
					$_locals[$slot] = "FMethod";
				}break;
				case 2:
				$c = $__hx__t2->params[0];
				{
					$_locals[$slot] = "FClass";
				}break;
				case 3:
				$f1 = $__hx__t2->params[0];
				{
					$_locals[$slot] = "FFunction";
				}break;
				}
				unset($slot,$l,$i1);
			}
		}
		{
			$_g11 = 1; $_g4 = $_locals->length;
			while($_g11 < $_g4) {
				$i1 = $_g11++;
				$out .= _hx_string_or_null($_locals[$i1]) . ",";
				unset($i1);
			}
		}
		{
			$out1 = (($out === null) ? "" : $out);
			if($out !== null && _hx_last_index_of($out, ",", null) === strlen($out) - 1) {
				$out1 = _hx_substr($out, 0, strlen($out) - 1);
			}
			return $out1;
		}
		unset($out,$locals,$_locals);
	}
}
function be_haxer_hxswfml_AbcReader_55(&$__hx__this, &$_args, &$_g, &$_g1, &$_g2, &$_g3, &$_k, &$_m, &$_name, &$_ret, &$abcReader, &$data, &$f, &$field, &$hasMethodBody, &$i, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g4 = $__hx__this->indentLevel;
			while($_g11 < $_g4) {
				$i1 = $_g11++;
				$str->add("\x09");
				unset($i1);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_56(&$__hx__this, &$__implements, &$_class, &$_extends, &$_g, &$_g1, &$_implements, &$abcReader, &$clName, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$xml) {
	{
		$id = $_class->_namespace;
		$out = "";
		if($id !== null) {
			$ns = $__hx__this->abcFile->get($__hx__this->abcFile->namespaces, $id);
			$name1 = _hx_array_get(Type::enumParameters($ns), 0);
			$_name = $__hx__this->abcFile->get($__hx__this->abcFile->strings, $name1);
			if($_name === null) {
				$out = "";
			} else {
				$out = be_haxer_hxswfml_AbcReader_105($__hx__this, $__implements, $_class, $_extends, $_g, $_g1, $_implements, $_name, $abcReader, $clName, $data, $hasMethodBody, $id, $infos, $loopIndex, $name, $name1, $ns, $out, $xml);
			}
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_57(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$clName, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$script_init, &$script_init2, &$stargsStr, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_58(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$clName, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$script_init, &$script_init2, &$stargsStr, &$xml) {
	{
		$out = (($stargsStr === null) ? "" : $stargsStr);
		if($stargsStr !== null && _hx_last_index_of($stargsStr, ",", null) === strlen($stargsStr) - 1) {
			$out = _hx_substr($stargsStr, 0, strlen($stargsStr) - 1);
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_59(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$clName, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$script_init, &$script_init2, &$stargsStr, &$xml) {
	{
		$extra = $script_init->extra;
		$out = new StringBuf();
		if($extra !== null) {
			if($extra->native) {
				$out->add(" native=\"true\"");
			}
			if($extra->variableArgs) {
				$out->add(" variableArgs=\"true\"");
			}
			if($extra->argumentsDefined) {
				$out->add(" argumentsDefined=\"true\"");
			}
			if($extra->usesDXNS) {
				$out->add(" usesDXNS=\"true\"");
			}
			if($extra->newBlock) {
				$out->add(" newBlock=\"true\"");
			}
			if($extra->unused) {
				$out->add(" unused=\"true\"");
			}
			if($extra->debugName !== null && $__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName) !== "") {
				$out->add(" debugName=\"");
				$out->add($__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName));
				$out->add("\"");
			}
			if($extra->defaultParameters !== null) {
				$str = new StringBuf();
				{
					$_g11 = 0; $_g2 = $extra->defaultParameters->length;
					while($_g11 < $_g2) {
						$i = $_g11++;
						$str->add(_hx_string_or_null($__hx__this->getDefaultValue($extra->defaultParameters[$i])) . ",");
						unset($i);
					}
				}
				$out->add(" defaultParameters=\"");
				$out->add(be_haxer_hxswfml_AbcReader_106($__hx__this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $clName, $data, $extra, $hasMethodBody, $infos, $loopIndex, $name, $out, $ret, $script_init, $script_init2, $stargsStr, $str, $xml));
				$out->add("\"");
			}
		}
		return $out->b;
	}
}
function be_haxer_hxswfml_AbcReader_60(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$clName, &$data, &$f, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$script_init, &$script_init2, &$stargsStr, &$xml) {
	{
		$locals = $f->locals;
		$out = "";
		$_locals = new _hx_array(array());
		{
			$_g11 = 0; $_g2 = $locals->length;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$l = $locals[$i];
				$slot = $l->slot;
				$__hx__t = ($l->kind);
				switch($__hx__t->index) {
				case 0:
				$_const = $__hx__t->params[2]; $value = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$str = "";
					$con = null;
					if($_const) {
						$con = "true";
					} else {
						$con = "false";
					}
					$str .= _hx_string_or_null($__hx__this->getName($l->name));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getName($type));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getValue($value));
					$str .= ":";
					$str .= _hx_string_or_null($con);
					$_locals[$slot] = $str;
				}break;
				case 1:
				$isOverride = $__hx__t->params[3]; $isFinal = $__hx__t->params[2]; $k = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$_locals[$slot] = "FMethod";
				}break;
				case 2:
				$c = $__hx__t->params[0];
				{
					$_locals[$slot] = "FClass";
				}break;
				case 3:
				$f1 = $__hx__t->params[0];
				{
					$_locals[$slot] = "FFunction";
				}break;
				}
				unset($slot,$l,$i);
			}
		}
		{
			$_g11 = 1; $_g2 = $_locals->length;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$out .= _hx_string_or_null($_locals[$i]) . ",";
				unset($i);
			}
		}
		{
			$out1 = (($out === null) ? "" : $out);
			if($out !== null && _hx_last_index_of($out, ",", null) === strlen($out) - 1) {
				$out1 = _hx_substr($out, 0, strlen($out) - 1);
			}
			return $out1;
		}
		unset($out,$locals,$_locals);
	}
}
function be_haxer_hxswfml_AbcReader_61(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$clName, &$data, &$f, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$script_init, &$script_init2, &$stargsStr, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_62(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$clName, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$script_init, &$script_init2, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_63(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$clName, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$script_init, &$script_init2, &$xml) {
	{
		$out = (($__implements === null) ? "" : $__implements);
		if($__implements !== null && _hx_last_index_of($__implements, ",", null) === strlen($__implements) - 1) {
			$out = _hx_substr($__implements, 0, strlen($__implements) - 1);
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_64(&$__hx__this, &$__implements, &$_class, &$_const, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_ns, &$_sealed, &$_type, &$_value, &$abcReader, &$clName, &$cnst, &$data, &$field, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$script_init, &$script_init2, &$type, &$value, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g4 = $__hx__this->indentLevel;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_65(&$__hx__this, &$__implements, &$_class, &$_const, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_ns, &$_sealed, &$_type, &$_value, &$abcReader, &$clName, &$cnst, &$data, &$field, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$script_init, &$script_init2, &$type, &$value, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g4 = $__hx__this->indentLevel;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_66(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$returnType, &$script_init, &$script_init2, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_67(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$returnType, &$script_init, &$script_init2, &$xml) {
	{
		$out = (($cargsStr === null) ? "" : $cargsStr);
		if($cargsStr !== null && _hx_last_index_of($cargsStr, ",", null) === strlen($cargsStr) - 1) {
			$out = _hx_substr($cargsStr, 0, strlen($cargsStr) - 1);
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_68(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$returnType, &$script_init, &$script_init2, &$xml) {
	{
		$extra = $cst->extra;
		$out = new StringBuf();
		if($extra !== null) {
			if($extra->native) {
				$out->add(" native=\"true\"");
			}
			if($extra->variableArgs) {
				$out->add(" variableArgs=\"true\"");
			}
			if($extra->argumentsDefined) {
				$out->add(" argumentsDefined=\"true\"");
			}
			if($extra->usesDXNS) {
				$out->add(" usesDXNS=\"true\"");
			}
			if($extra->newBlock) {
				$out->add(" newBlock=\"true\"");
			}
			if($extra->unused) {
				$out->add(" unused=\"true\"");
			}
			if($extra->debugName !== null && $__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName) !== "") {
				$out->add(" debugName=\"");
				$out->add($__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName));
				$out->add("\"");
			}
			if($extra->defaultParameters !== null) {
				$str = new StringBuf();
				{
					$_g11 = 0; $_g2 = $extra->defaultParameters->length;
					while($_g11 < $_g2) {
						$i = $_g11++;
						$str->add(_hx_string_or_null($__hx__this->getDefaultValue($extra->defaultParameters[$i])) . ",");
						unset($i);
					}
				}
				$out->add(" defaultParameters=\"");
				$out->add(be_haxer_hxswfml_AbcReader_107($__hx__this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $extra, $hasMethodBody, $infos, $loopIndex, $name, $out, $returnType, $script_init, $script_init2, $str, $xml));
				$out->add("\"");
			}
		}
		return $out->b;
	}
}
function be_haxer_hxswfml_AbcReader_69(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$returnType, &$script_init, &$script_init2, &$xml) {
	{
		$locals = $f->locals;
		$out = "";
		$_locals = new _hx_array(array());
		{
			$_g11 = 0; $_g2 = $locals->length;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$l = $locals[$i];
				$slot = $l->slot;
				$__hx__t = ($l->kind);
				switch($__hx__t->index) {
				case 0:
				$_const = $__hx__t->params[2]; $value = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$str = "";
					$con = null;
					if($_const) {
						$con = "true";
					} else {
						$con = "false";
					}
					$str .= _hx_string_or_null($__hx__this->getName($l->name));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getName($type));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getValue($value));
					$str .= ":";
					$str .= _hx_string_or_null($con);
					$_locals[$slot] = $str;
				}break;
				case 1:
				$isOverride = $__hx__t->params[3]; $isFinal = $__hx__t->params[2]; $k = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$_locals[$slot] = "FMethod";
				}break;
				case 2:
				$c = $__hx__t->params[0];
				{
					$_locals[$slot] = "FClass";
				}break;
				case 3:
				$f1 = $__hx__t->params[0];
				{
					$_locals[$slot] = "FFunction";
				}break;
				}
				unset($slot,$l,$i);
			}
		}
		{
			$_g11 = 1; $_g2 = $_locals->length;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$out .= _hx_string_or_null($_locals[$i]) . ",";
				unset($i);
			}
		}
		{
			$out1 = (($out === null) ? "" : $out);
			if($out !== null && _hx_last_index_of($out, ",", null) === strlen($out) - 1) {
				$out1 = _hx_substr($out, 0, strlen($out) - 1);
			}
			return $out1;
		}
		unset($out,$locals,$_locals);
	}
}
function be_haxer_hxswfml_AbcReader_70(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$returnType, &$script_init, &$script_init2, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_71(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$returnType, &$script_init, &$script_init2, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_72(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_73(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$out = (($stargsStr === null) ? "" : $stargsStr);
		if($stargsStr !== null && _hx_last_index_of($stargsStr, ",", null) === strlen($stargsStr) - 1) {
			$out = _hx_substr($stargsStr, 0, strlen($stargsStr) - 1);
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_74(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$extra = $st->extra;
		$out = new StringBuf();
		if($extra !== null) {
			if($extra->native) {
				$out->add(" native=\"true\"");
			}
			if($extra->variableArgs) {
				$out->add(" variableArgs=\"true\"");
			}
			if($extra->argumentsDefined) {
				$out->add(" argumentsDefined=\"true\"");
			}
			if($extra->usesDXNS) {
				$out->add(" usesDXNS=\"true\"");
			}
			if($extra->newBlock) {
				$out->add(" newBlock=\"true\"");
			}
			if($extra->unused) {
				$out->add(" unused=\"true\"");
			}
			if($extra->debugName !== null && $__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName) !== "") {
				$out->add(" debugName=\"");
				$out->add($__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName));
				$out->add("\"");
			}
			if($extra->defaultParameters !== null) {
				$str = new StringBuf();
				{
					$_g11 = 0; $_g2 = $extra->defaultParameters->length;
					while($_g11 < $_g2) {
						$i = $_g11++;
						$str->add(_hx_string_or_null($__hx__this->getDefaultValue($extra->defaultParameters[$i])) . ",");
						unset($i);
					}
				}
				$out->add(" defaultParameters=\"");
				$out->add(be_haxer_hxswfml_AbcReader_108($__hx__this, $__implements, $_class, $_extends, $_final, $_g, $_g1, $_implements, $_interface, $_ns, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $extra, $f, $hasMethodBody, $infos, $loopIndex, $name, $out, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $str, $xml));
				$out->add("\"");
			}
		}
		return $out->b;
	}
}
function be_haxer_hxswfml_AbcReader_75(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$locals = $f1->locals;
		$out = "";
		$_locals = new _hx_array(array());
		{
			$_g11 = 0; $_g2 = $locals->length;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$l = $locals[$i];
				$slot = $l->slot;
				$__hx__t = ($l->kind);
				switch($__hx__t->index) {
				case 0:
				$_const = $__hx__t->params[2]; $value = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$str = "";
					$con = null;
					if($_const) {
						$con = "true";
					} else {
						$con = "false";
					}
					$str .= _hx_string_or_null($__hx__this->getName($l->name));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getName($type));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getValue($value));
					$str .= ":";
					$str .= _hx_string_or_null($con);
					$_locals[$slot] = $str;
				}break;
				case 1:
				$isOverride = $__hx__t->params[3]; $isFinal = $__hx__t->params[2]; $k = $__hx__t->params[1]; $type = $__hx__t->params[0];
				{
					$_locals[$slot] = "FMethod";
				}break;
				case 2:
				$c = $__hx__t->params[0];
				{
					$_locals[$slot] = "FClass";
				}break;
				case 3:
				$f2 = $__hx__t->params[0];
				{
					$_locals[$slot] = "FFunction";
				}break;
				}
				unset($slot,$l,$i);
			}
		}
		{
			$_g11 = 1; $_g2 = $_locals->length;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$out .= _hx_string_or_null($_locals[$i]) . ",";
				unset($i);
			}
		}
		{
			$out1 = (($out === null) ? "" : $out);
			if($out !== null && _hx_last_index_of($out, ",", null) === strlen($out) - 1) {
				$out1 = _hx_substr($out, 0, strlen($out) - 1);
			}
			return $out1;
		}
		unset($out,$locals,$_locals);
	}
}
function be_haxer_hxswfml_AbcReader_76(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_77(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_m, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	$__hx__t2 = ($k);
	switch($__hx__t2->index) {
	case 0:
	{
		return "normal";
	}break;
	case 2:
	{
		return "setter";
	}break;
	case 1:
	{
		return "getter";
	}break;
	}
}
function be_haxer_hxswfml_AbcReader_78(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g4 = $__hx__this->indentLevel;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_79(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$out = (($_args === null) ? "" : $_args);
		if($_args !== null && _hx_last_index_of($_args, ",", null) === strlen($_args) - 1) {
			$out = _hx_substr($_args, 0, strlen($_args) - 1);
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_80(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$extra = $_m->extra;
		$out = new StringBuf();
		if($extra !== null) {
			if($extra->native) {
				$out->add(" native=\"true\"");
			}
			if($extra->variableArgs) {
				$out->add(" variableArgs=\"true\"");
			}
			if($extra->argumentsDefined) {
				$out->add(" argumentsDefined=\"true\"");
			}
			if($extra->usesDXNS) {
				$out->add(" usesDXNS=\"true\"");
			}
			if($extra->newBlock) {
				$out->add(" newBlock=\"true\"");
			}
			if($extra->unused) {
				$out->add(" unused=\"true\"");
			}
			if($extra->debugName !== null && $__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName) !== "") {
				$out->add(" debugName=\"");
				$out->add($__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName));
				$out->add("\"");
			}
			if($extra->defaultParameters !== null) {
				$str = new StringBuf();
				{
					$_g11 = 0; $_g4 = $extra->defaultParameters->length;
					while($_g11 < $_g4) {
						$i = $_g11++;
						$str->add(_hx_string_or_null($__hx__this->getDefaultValue($extra->defaultParameters[$i])) . ",");
						unset($i);
					}
				}
				$out->add(" defaultParameters=\"");
				$out->add(be_haxer_hxswfml_AbcReader_109($__hx__this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $extra, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $methodType, $name, $out, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $str, $xml));
				$out->add("\"");
			}
		}
		return $out->b;
	}
}
function be_haxer_hxswfml_AbcReader_81(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$f2, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$locals = $f2->locals;
		$out = "";
		$_locals = new _hx_array(array());
		{
			$_g11 = 0; $_g4 = $locals->length;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$l = $locals[$i];
				$slot = $l->slot;
				$__hx__t2 = ($l->kind);
				switch($__hx__t2->index) {
				case 0:
				$_const = $__hx__t2->params[2]; $value = $__hx__t2->params[1]; $type = $__hx__t2->params[0];
				{
					$str = "";
					$con = null;
					if($_const) {
						$con = "true";
					} else {
						$con = "false";
					}
					$str .= _hx_string_or_null($__hx__this->getName($l->name));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getName($type));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getValue($value));
					$str .= ":";
					$str .= _hx_string_or_null($con);
					$_locals[$slot] = $str;
				}break;
				case 1:
				$isOverride1 = $__hx__t2->params[3]; $isFinal1 = $__hx__t2->params[2]; $k1 = $__hx__t2->params[1]; $type = $__hx__t2->params[0];
				{
					$_locals[$slot] = "FMethod";
				}break;
				case 2:
				$c = $__hx__t2->params[0];
				{
					$_locals[$slot] = "FClass";
				}break;
				case 3:
				$f3 = $__hx__t2->params[0];
				{
					$_locals[$slot] = "FFunction";
				}break;
				}
				unset($slot,$l,$i);
			}
		}
		{
			$_g11 = 1; $_g4 = $_locals->length;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$out .= _hx_string_or_null($_locals[$i]) . ",";
				unset($i);
			}
		}
		{
			$out1 = (($out === null) ? "" : $out);
			if($out !== null && _hx_last_index_of($out, ",", null) === strlen($out) - 1) {
				$out1 = _hx_substr($out, 0, strlen($out) - 1);
			}
			return $out1;
		}
		unset($out,$locals,$_locals);
	}
}
function be_haxer_hxswfml_AbcReader_82(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$f2, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g4 = $__hx__this->indentLevel;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_83(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_m, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$type, &$xml) {
	$__hx__t2 = ($k);
	switch($__hx__t2->index) {
	case 0:
	{
		return "normal";
	}break;
	case 2:
	{
		return "setter";
	}break;
	case 1:
	{
		return "getter";
	}break;
	}
}
function be_haxer_hxswfml_AbcReader_84(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$type, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g4 = $__hx__this->indentLevel;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_85(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$type, &$xml) {
	{
		$out = (($_args === null) ? "" : $_args);
		if($_args !== null && _hx_last_index_of($_args, ",", null) === strlen($_args) - 1) {
			$out = _hx_substr($_args, 0, strlen($_args) - 1);
		}
		return $out;
	}
}
function be_haxer_hxswfml_AbcReader_86(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$type, &$xml) {
	{
		$extra = $_m->extra;
		$out = new StringBuf();
		if($extra !== null) {
			if($extra->native) {
				$out->add(" native=\"true\"");
			}
			if($extra->variableArgs) {
				$out->add(" variableArgs=\"true\"");
			}
			if($extra->argumentsDefined) {
				$out->add(" argumentsDefined=\"true\"");
			}
			if($extra->usesDXNS) {
				$out->add(" usesDXNS=\"true\"");
			}
			if($extra->newBlock) {
				$out->add(" newBlock=\"true\"");
			}
			if($extra->unused) {
				$out->add(" unused=\"true\"");
			}
			if($extra->debugName !== null && $__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName) !== "") {
				$out->add(" debugName=\"");
				$out->add($__hx__this->abcFile->get($__hx__this->abcFile->strings, $extra->debugName));
				$out->add("\"");
			}
			if($extra->defaultParameters !== null) {
				$str = new StringBuf();
				{
					$_g11 = 0; $_g4 = $extra->defaultParameters->length;
					while($_g11 < $_g4) {
						$i = $_g11++;
						$str->add(_hx_string_or_null($__hx__this->getDefaultValue($extra->defaultParameters[$i])) . ",");
						unset($i);
					}
				}
				$out->add(" defaultParameters=\"");
				$out->add(be_haxer_hxswfml_AbcReader_110($__hx__this, $__implements, $_args, $_class, $_extends, $_final, $_g, $_g1, $_g2, $_g3, $_implements, $_interface, $_k, $_m, $_name, $_ns, $_ret, $_sealed, $abcReader, $cargsStr, $clName, $cst, $data, $extra, $f, $f1, $field, $hasMethodBody, $infos, $isFinal, $isOverride, $k, $loopIndex, $name, $out, $ret, $returnType, $script_init, $script_init2, $st, $stargsStr, $str, $type, $xml));
				$out->add("\"");
			}
		}
		return $out->b;
	}
}
function be_haxer_hxswfml_AbcReader_87(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$f2, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$type, &$xml) {
	{
		$locals = $f2->locals;
		$out = "";
		$_locals = new _hx_array(array());
		{
			$_g11 = 0; $_g4 = $locals->length;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$l = $locals[$i];
				$slot = $l->slot;
				$__hx__t2 = ($l->kind);
				switch($__hx__t2->index) {
				case 0:
				$_const = $__hx__t2->params[2]; $value = $__hx__t2->params[1]; $type1 = $__hx__t2->params[0];
				{
					$str = "";
					$con = null;
					if($_const) {
						$con = "true";
					} else {
						$con = "false";
					}
					$str .= _hx_string_or_null($__hx__this->getName($l->name));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getName($type1));
					$str .= ":";
					$str .= _hx_string_or_null($__hx__this->getValue($value));
					$str .= ":";
					$str .= _hx_string_or_null($con);
					$_locals[$slot] = $str;
				}break;
				case 1:
				$isOverride1 = $__hx__t2->params[3]; $isFinal1 = $__hx__t2->params[2]; $k1 = $__hx__t2->params[1]; $type1 = $__hx__t2->params[0];
				{
					$_locals[$slot] = "FMethod";
				}break;
				case 2:
				$c = $__hx__t2->params[0];
				{
					$_locals[$slot] = "FClass";
				}break;
				case 3:
				$f3 = $__hx__t2->params[0];
				{
					$_locals[$slot] = "FFunction";
				}break;
				}
				unset($slot,$l,$i);
			}
		}
		{
			$_g11 = 1; $_g4 = $_locals->length;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$out .= _hx_string_or_null($_locals[$i]) . ",";
				unset($i);
			}
		}
		{
			$out1 = (($out === null) ? "" : $out);
			if($out !== null && _hx_last_index_of($out, ",", null) === strlen($out) - 1) {
				$out1 = _hx_substr($out, 0, strlen($out) - 1);
			}
			return $out1;
		}
		unset($out,$locals,$_locals);
	}
}
function be_haxer_hxswfml_AbcReader_88(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$f2, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$type, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g4 = $__hx__this->indentLevel;
			while($_g11 < $_g4) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_89(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$f, &$f1, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g11 = 0; $_g2 = $__hx__this->indentLevel;
			while($_g11 < $_g2) {
				$i = $_g11++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_90(&$__hx__this, &$abcReader, &$data, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$temp, &$xml) {
	{
		$str = new StringBuf();
		{
			$_g1 = 0; $_g = $__hx__this->indentLevel;
			while($_g1 < $_g) {
				$i = $_g1++;
				$str->add("\x09");
				unset($i);
			}
		}
		return $str->b;
	}
}
function be_haxer_hxswfml_AbcReader_91(&$__hx__this, &$kind, &$ns, &$out, &$value) {
	{
		$out1 = "";
		if($ns !== null) {
			$ns1 = $__hx__this->abcFile->get($__hx__this->abcFile->namespaces, $ns);
			$name = _hx_array_get(Type::enumParameters($ns1), 0);
			$_name = $__hx__this->abcFile->get($__hx__this->abcFile->strings, $name);
			if($_name === null) {
				$out1 = "";
			} else {
				$out1 = be_haxer_hxswfml_AbcReader_111($__hx__this, $_name, $kind, $name, $ns, $ns1, $out, $out1, $value);
			}
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_92(&$__hx__this, &$kind, &$ns, &$out, &$value) {
	{
		$out1 = "";
		if($ns !== null) {
			$ns1 = $__hx__this->abcFile->get($__hx__this->abcFile->namespaces, $ns);
			$name = _hx_array_get(Type::enumParameters($ns1), 0);
			$_name = $__hx__this->abcFile->get($__hx__this->abcFile->strings, $name);
			if($_name === null) {
				$out1 = "";
			} else {
				$out1 = be_haxer_hxswfml_AbcReader_112($__hx__this, $_name, $kind, $name, $ns, $ns1, $out, $out1, $value);
			}
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_93(&$__hx__this, &$__name, &$__namespace, &$_name, &$name, &$name1, &$name2, &$ns, &$ns1, &$out) {
	if($_name !== "") {
		return _hx_string_or_null($_name) . ".";
	} else {
		return $_name;
	}
}
function be_haxer_hxswfml_AbcReader_94(&$__hx__this, &$__name, &$__namespace, &$_name, &$id, &$index, &$name, &$name1, &$name2, &$ns, &$nset, &$nsset, &$out) {
	if($_name !== "") {
		return _hx_string_or_null($_name) . ".";
	} else {
		return $_name;
	}
}
function be_haxer_hxswfml_AbcReader_95(&$__hx__this, &$__name, &$__namespace, &$_g, &$_g1, &$_name, &$n, &$name, &$name1, &$name2, &$nname, &$nns, &$ns, &$nsset, &$out) {
	if($_name !== "") {
		return _hx_string_or_null($_name) . ".";
	} else {
		return $_name;
	}
}
function be_haxer_hxswfml_AbcReader_96(&$__hx__this, &$_args, &$_m, &$_name, &$_ret, &$extra, &$f, &$out, &$out1, &$str) {
	{
		$str1 = $str->b;
		$out2 = (($str1 === null) ? "" : $str1);
		if($str1 !== null && _hx_last_index_of($str1, ",", null) === strlen($str1) - 1) {
			$out2 = _hx_substr($str1, 0, strlen($str1) - 1);
		}
		return $out2;
	}
}
function be_haxer_hxswfml_AbcReader_97(&$__hx__this, &$_g, &$_name, &$buf, &$bytePos, &$ec, &$f, &$index, &$name, &$ns, &$op, &$ops, &$out, &$v) {
	if($_name !== "") {
		return _hx_string_or_null($_name) . ".";
	} else {
		return $_name;
	}
}
function be_haxer_hxswfml_AbcReader_98(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$name, &$op, &$ops, &$str, &$v) {
	{
		$out = _hx_explode("\x0D\x0A", $str)->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_AbcReader_99(&$__hx__this, &$_g, &$_g1, &$_g2, &$buf, &$bytePos, &$ec, &$f, &$i, &$index, &$name, &$op, &$ops, &$str, &$v) {
	{
		$out = _hx_explode("\x0D\x0A", $__hx__this->debugLines[$i])->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_AbcReader_100(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$name, &$op, &$ops, &$v) {
	if($__hx__this->debugFileName === "<null>") {
		return "";
	} else {
		return $__hx__this->debugFileName;
	}
}
function be_haxer_hxswfml_AbcReader_101(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$name, &$op, &$ops, &$str, &$v) {
	{
		$out = _hx_explode("\x0D\x0A", $str)->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_AbcReader_102(&$__hx__this, &$_g, &$_g1, &$_g2, &$buf, &$bytePos, &$ec, &$f, &$i, &$index, &$name, &$op, &$ops, &$str, &$v) {
	{
		$out = _hx_explode("\x0D\x0A", $__hx__this->debugLines[$i])->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_AbcReader_103(&$__hx__this, &$_g, &$buf, &$bytePos, &$ec, &$f, &$index, &$name, &$op, &$ops, &$v) {
	if($__hx__this->debugFileName === "<null>") {
		return "";
	} else {
		return $__hx__this->debugFileName;
	}
}
function be_haxer_hxswfml_AbcReader_104(&$__hx__this, &$_args, &$_g, &$_g1, &$_g2, &$_g3, &$_k, &$_m, &$_name, &$_ret, &$abcReader, &$data, &$extra, &$field, &$hasMethodBody, &$i, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$out, &$str, &$xml) {
	{
		$str1 = $str->b;
		$out1 = (($str1 === null) ? "" : $str1);
		if($str1 !== null && _hx_last_index_of($str1, ",", null) === strlen($str1) - 1) {
			$out1 = _hx_substr($str1, 0, strlen($str1) - 1);
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_105(&$__hx__this, &$__implements, &$_class, &$_extends, &$_g, &$_g1, &$_implements, &$_name, &$abcReader, &$clName, &$data, &$hasMethodBody, &$id, &$infos, &$loopIndex, &$name, &$name1, &$ns, &$out, &$xml) {
	if($_name !== "") {
		return _hx_string_or_null($_name) . ".";
	} else {
		return $_name;
	}
}
function be_haxer_hxswfml_AbcReader_106(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$clName, &$data, &$extra, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$out, &$ret, &$script_init, &$script_init2, &$stargsStr, &$str, &$xml) {
	{
		$str1 = $str->b;
		$out1 = (($str1 === null) ? "" : $str1);
		if($str1 !== null && _hx_last_index_of($str1, ",", null) === strlen($str1) - 1) {
			$out1 = _hx_substr($str1, 0, strlen($str1) - 1);
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_107(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$extra, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$out, &$returnType, &$script_init, &$script_init2, &$str, &$xml) {
	{
		$str1 = $str->b;
		$out1 = (($str1 === null) ? "" : $str1);
		if($str1 !== null && _hx_last_index_of($str1, ",", null) === strlen($str1) - 1) {
			$out1 = _hx_substr($str1, 0, strlen($str1) - 1);
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_108(&$__hx__this, &$__implements, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_implements, &$_interface, &$_ns, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$extra, &$f, &$hasMethodBody, &$infos, &$loopIndex, &$name, &$out, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$str, &$xml) {
	{
		$str1 = $str->b;
		$out1 = (($str1 === null) ? "" : $str1);
		if($str1 !== null && _hx_last_index_of($str1, ",", null) === strlen($str1) - 1) {
			$out1 = _hx_substr($str1, 0, strlen($str1) - 1);
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_109(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$extra, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$methodType, &$name, &$out, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$str, &$xml) {
	{
		$str1 = $str->b;
		$out1 = (($str1 === null) ? "" : $str1);
		if($str1 !== null && _hx_last_index_of($str1, ",", null) === strlen($str1) - 1) {
			$out1 = _hx_substr($str1, 0, strlen($str1) - 1);
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_110(&$__hx__this, &$__implements, &$_args, &$_class, &$_extends, &$_final, &$_g, &$_g1, &$_g2, &$_g3, &$_implements, &$_interface, &$_k, &$_m, &$_name, &$_ns, &$_ret, &$_sealed, &$abcReader, &$cargsStr, &$clName, &$cst, &$data, &$extra, &$f, &$f1, &$field, &$hasMethodBody, &$infos, &$isFinal, &$isOverride, &$k, &$loopIndex, &$name, &$out, &$ret, &$returnType, &$script_init, &$script_init2, &$st, &$stargsStr, &$str, &$type, &$xml) {
	{
		$str1 = $str->b;
		$out1 = (($str1 === null) ? "" : $str1);
		if($str1 !== null && _hx_last_index_of($str1, ",", null) === strlen($str1) - 1) {
			$out1 = _hx_substr($str1, 0, strlen($str1) - 1);
		}
		return $out1;
	}
}
function be_haxer_hxswfml_AbcReader_111(&$__hx__this, &$_name, &$kind, &$name, &$ns, &$ns1, &$out, &$out1, &$value) {
	if($_name !== "") {
		return _hx_string_or_null($_name) . ".";
	} else {
		return $_name;
	}
}
function be_haxer_hxswfml_AbcReader_112(&$__hx__this, &$_name, &$kind, &$name, &$ns, &$ns1, &$out, &$out1, &$value) {
	if($_name !== "") {
		return _hx_string_or_null($_name) . ".";
	} else {
		return $_name;
	}
}
