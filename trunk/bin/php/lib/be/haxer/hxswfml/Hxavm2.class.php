<?php

class be_haxer_hxswfml_Hxavm2 {
	public function __construct() {
		if( !php_Boot::$skip_constructor ) {
		$this->throwsErrors = false;
		$this->log = true;
	}}
	public $log;
	public $throwsErrors;
	public $name;
	public $ctx;
	public $className;
	public $curClassName;
	public $curClass;
	public $maxStack;
	public $maxScopeStack;
	public $currentStack;
	public $currentScopeStack;
	public $imports;
	public $functionClosures;
	public $inits;
	public $classDefs;
	public $jumps;
	public $labels;
	public function xml2abc($xml) {
		$swfTags = new _hx_array(array());
		$abcfiles = Xml::parse($xml)->firstElement();
		if(strtolower($abcfiles->getNodeName()) == "abcfile") {
			$swfTags->push($this->xmlToabc($abcfiles));
		}
		else {
			$�it = $abcfiles->elements();
			while($�it->hasNext()) {
			$abcfile = $�it->next();
			{
				$swfTags->push($this->xmlToabc($abcfile));
				;
			}
			}
		}
		return $swfTags;
	}
	public function xmlToabc($xml) {
		$ctx_xml = $xml;
		$this->ctx = new format_abc_Context();
		$this->jumps = new Hash();
		$this->labels = new Hash();
		$this->curClassName = "";
		$statics = new _hx_array(array());
		$this->imports = new Hash();
		$this->functionClosures = new Hash();
		$this->inits = new Hash();
		$this->classDefs = new Hash();
		$ctx = $this->ctx;
		$�it = $ctx_xml->elements();
		while($�it->hasNext()) {
		$_classNode = $�it->next();
		{
			switch($_classNode->getNodeName()) {
			case "function":{
				$this->createFunction($_classNode, "function", null);
			}break;
			default:{
				;
			}break;
			}
			;
		}
		}
		$�it2 = $ctx_xml->elements();
		while($�it2->hasNext()) {
		$_classNode2 = $�it2->next();
		{
			switch(strtolower($_classNode2->getNodeName())) {
			case "function":{
				;
			}break;
			case "init":{
				;
			}break;
			case "import":{
				$n = $_classNode2->get("class");
				$cn = _hx_explode(".", $n)->pop();
				$this->imports->set($cn, $n);
			}break;
			case "class":case "interface":{
				$this->className = $_classNode2->get("name");
				$cl = $ctx->beginClass($this->className, $_classNode2->get("interface") == "true");
				$this->curClass = $cl;
				$this->classDefs->set($this->className, $ctx->getClass($cl));
				$this->curClassName = _hx_explode(".", $this->className)->pop();
				if($_classNode2->get("implements") !== null) {
					$cl->interfaces = new _hx_array(array());
					{
						$_g = 0; $_g1 = _hx_explode(",", $_classNode2->get("implements"));
						while($_g < $_g1->length) {
							$i = $_g1[$_g];
							++$_g;
							$cl->interfaces->push($ctx->type($this->getImport($i)));
							unset($i);
						}
					}
				}
				$cl->isFinal = $_classNode2->get("final") == "true";
				$cl->isInterface = $_classNode2->get("interface") == "true";
				$cl->isSealed = $_classNode2->get("sealed") == "true";
				$_extends = $_classNode2->get("extends");
				if($_extends !== null) {
					$cl->superclass = $ctx->type($this->getImport($_extends));
					$ctx->addClassSuper($this->getImport($_extends));
				}
				$�it3 = $_classNode2->elements();
				while($�it3->hasNext()) {
				$member = $�it3->next();
				{
					switch($member->getNodeName()) {
					case "field":case "var":{
						$name = $member->get("name");
						$type = $member->get("type");
						if($type === null || $type == "") {
							$type = "*";
						}
						$isStatic = $member->get("static") == "true";
						$value = $member->get("value");
						$const = $member->get("const") == "true";
						$ns = $this->namespaceType($member->get("ns"));
						$_value = (($value === null) ? null : eval("if(isset(\$this)) \$�this =& \$this;switch(\$type) {
							case \"String\":{
								\$�r = format_abc_Value::VString(\$ctx->string(\$value));
							}break;
							case \"int\":{
								\$�r = format_abc_Value::VInt(\$ctx->int(Std::parseInt(\$value)));
							}break;
							case \"uint\":{
								\$�r = format_abc_Value::VUInt(\$ctx->uint(Std::parseInt(\$value)));
							}break;
							case \"Number\":{
								\$�r = format_abc_Value::VFloat(\$ctx->float(Std::parseFloat(\$value)));
							}break;
							case \"Boolean\":{
								\$�r = format_abc_Value::VBool(\$value == \"true\");
							}break;
							default:{
								\$�r = null;
							}break;
							}
							return \$�r;
						"));
						$ctx->defineField($name, $ctx->type($this->getImport($type)), $isStatic, $_value, $const, $ns);
					}break;
					case "method":case "function":{
						$this->createFunction($member, "method", $cl->isInterface);
					}break;
					default:{
						throw new HException(($member->getNodeName() . " Must be <method/> or <var/>."));
					}break;
					}
					unset($�r,$value,$type,$ns,$name,$isStatic,$const,$_value);
				}
				}
				$�it4 = $ctx_xml->elements();
				while($�it4->hasNext()) {
				$_classNode1 = $�it4->next();
				{
					switch($_classNode1->getNodeName()) {
					case "init":{
						if($_classNode1->get("name") == $this->className) {
							$this->createFunction($_classNode1, "init", null);
						}
					}break;
					default:{
						;
					}break;
					}
					;
				}
				}
				if($this->inits->exists($this->className)) {
					_hx_array_get($ctx->getData()->inits, $ctx->getData()->inits->length - 1)->method = $this->inits->get($this->className);
					$ctx->endClass(false);
				}
				else {
					$ctx->endClass(null);
				}
			}break;
			default:{
				throw new HException(("<" . $_classNode2->getNodeName() . "> Must be <function>, <init>, <import> or <class [<var>], [<method>]>."));
			}break;
			}
			unset($�r,$�it4,$�it3,$value,$type,$ns,$name,$n,$member,$isStatic,$i,$const,$cn,$cl,$_value,$_g1,$_g,$_extends,$_classNode1);
		}
		}
		$abcFile = $ctx->getData();
		$abcOutput = new haxe_io_BytesOutput();
		format_abc_Writer::write($abcOutput, $abcFile);
		return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => $this->className)));
	}
	public function createFunction($node, $functionType, $isInterface) {
		if($isInterface === null) {
			$isInterface = false;
		}
		$this->maxStack = 0;
		$this->currentStack = 0;
		$this->maxScopeStack = 0;
		$this->currentScopeStack = 0;
		$args = new _hx_array(array());
		$_args = $node->get("args");
		if($_args === null || $_args == "") {
			$args = new _hx_array(array());
		}
		else {
			$_g = 0; $_g1 = _hx_explode(",", $_args);
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				$args->push($this->ctx->type($this->getImport($i)));
				unset($i);
			}
		}
		$_return = (($node->get("return") == "" || $node->get("return") === null) ? $this->ctx->type("*") : $this->ctx->type($this->getImport($node->get("return"))));
		$_defaultParameters = null;
		$defaultParameters = $node->get("defaultParameters");
		if($defaultParameters !== null) {
			$values = _hx_explode(",", $defaultParameters);
			$_defaultParameters = new _hx_array(array());
			{
				$_g2 = 0;
				while($_g2 < $values->length) {
					$v = $values[$_g2];
					++$_g2;
					$_defaultParameters->push(null);
					unset($v);
				}
			}
		}
		$extra = _hx_anonymous(array("native" => $node->get("native") == "true", "variableArgs" => $node->get("variableArgs") == "true", "argumentsDefined" => $node->get("argumentsDefined") == "true", "usesDXNS" => $node->get("usesDXNS") == "true", "newBlock" => $node->get("newBlock") == "true", "unused" => $node->get("unused") == "true", "debugName" => $this->ctx->string(($node->get("debugName") === null ? "" : $node->get("debugName"))), "defaultParameters" => $_defaultParameters, "paramNames" => null));
		$ns = $this->namespaceType($node->get("ns"));
		$f = null;
		if($functionType == "function") {
			$this->ctx->beginFunction($args, $_return, $extra);
			$f = $this->ctx->curFunction->f;
			$name = $node->get("name");
			$this->functionClosures->set($name, $f->type);
		}
		else {
			if($functionType == "method") {
				$_static = $node->get("static") == "true";
				$_override = $node->get("override") == "true";
				$_final = $node->get("final") == "true";
				$_later = $node->get("later") == "true";
				$kind = eval("if(isset(\$this)) \$�this =& \$this;switch(\$node->get(\"kind\")) {
					case \"normal\":{
						\$�r = format_abc_MethodKind::\$KNormal;
					}break;
					case \"set\":case \"setter\":{
						\$�r = format_abc_MethodKind::\$KSetter;
					}break;
					case \"get\":case \"getter\":{
						\$�r = format_abc_MethodKind::\$KGetter;
					}break;
					default:{
						\$�r = format_abc_MethodKind::\$KNormal;
					}break;
					}
					return \$�r;
				");
				if($node->get("name") == $this->className) {
					if($_static === true) {
						$this->ctx->beginFunction($args, $_return, $extra);
						$f = $this->ctx->curFunction->f;
						$this->curClass->statics = $f->type;
					}
					else {
						if($isInterface) {
							$f = $this->ctx->beginInterfaceMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, true, $kind, $extra, $ns);
							$this->curClass->constructor = $f->type;
							return $f;
						}
						else {
							$f = $this->ctx->beginMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, true, $kind, $extra, $ns);
							$this->curClass->constructor = $f->type;
						}
					}
				}
				else {
					if($isInterface) {
						$f1 = $this->ctx->beginInterfaceMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, $_later, $kind, $extra, $ns);
						return $f1;
					}
					else {
						$f = $this->ctx->beginMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, $_later, $kind, $extra, $ns);
					}
				}
			}
			else {
				if($functionType == "init") {
					$this->ctx->beginFunction($args, $_return, $extra);
					$f = $this->ctx->curFunction->f;
					$name2 = $this->getImport($node->get("name"));
					$this->inits->set($name2, $f->type);
				}
			}
		}
		if($node->get("locals") !== null) {
			$locals = $this->parseLocals($node->get("locals"));
			if($locals->length !== 0) {
				$f->locals = $locals;
			}
		}
		$result = $this->writeCodeBlock($node, $f);
		if($node->get("maxStack") !== null) {
			$f->maxStack = Std::parseInt($node->get("maxStack"));
		}
		else {
			$f->maxStack = $this->maxStack + $f->trys->length;
		}
		if($node->get("maxScope") !== null) {
			$f->maxScope = Std::parseInt($node->get("maxScope"));
		}
		else {
			$f->maxScope = $this->maxScopeStack;
		}
		if($this->currentStack > 0) {
			$this->nonEmptyStack($node->get("name"));
		}
		return $f;
	}
	public function writeCodeBlock($member, $f) {
		if($this->log) {
			$this->logStack("------------------------------------------------\x0Acurrent class= " . $this->className . ", method= " . $member->get("name") . "\x0AcurrentStack= " . $this->currentStack . ", maxStack= " . $this->maxStack . "\x0AcurrentScopeStack= " . $this->currentScopeStack . ", maxScopeStack= " . $this->maxScopeStack . "\x0A\x0A");
		}
		$�it = $member->elements();
		while($�it->hasNext()) {
		$o = $�it->next();
		{
			$op = eval("if(isset(\$this)) \$�this =& \$this;switch(\$o->getNodeName()) {
				case \"OBreakPoint\":case \"ONop\":case \"OThrow\":case \"ODxNsLate\":case \"OPushWith\":case \"OPopScope\":case \"OForIn\":case \"OHasNext\":case \"ONull\":case \"OUndefined\":case \"OForEach\":case \"OTrue\":case \"OFalse\":case \"ONaN\":case \"OPop\":case \"ODup\":case \"OSwap\":case \"OScope\":case \"ONewBlock\":case \"ORetVoid\":case \"ORet\":case \"OToString\":case \"OGetGlobalScope\":case \"OInstanceOf\":case \"OToXml\":case \"OToXmlAttr\":case \"OToInt\":case \"OToUInt\":case \"OToNumber\":case \"OToBool\":case \"OToObject\":case \"OCheckIsXml\":case \"OAsAny\":case \"OAsString\":case \"OAsObject\":case \"OTypeof\":case \"OThis\":case \"OSetThis\":case \"OTimestamp\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), null);
				}break;
				case \"ODxNs\":case \"ODebugFile\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(\$�this->ctx->string(\$�this->getAnyAttribute(\$o, new _hx_array(array(\"v\", \"file\")))))));
				}break;
				case \"OString\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(\$�this->ctx->string(urldecode(\$�this->getAnyAttribute(\$o, new _hx_array(array(\"v\", \"file\"))))))));
				}break;
				case \"OIntRef\":case \"OUIntRef\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(\$�this->ctx->int(Std::parseInt(\$o->get(\"v\"))))));
				}break;
				case \"OFloat\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(\$�this->ctx->float(Std::parseFloat(\$o->get(\"v\"))))));
				}break;
				case \"ONamespace\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(\$�this->ctx->type(\$o->get(\"v\")))));
				}break;
				case \"OClassDef\":{
					\$�r = (!\$�this->classDefs->exists(\$o->get(\"c\")) ? eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$o->get(\\\"c\\\") . \\\" must be created as class before referencing it here.\\\");
						return \\\$�r2;
					\") : Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(\$�this->classDefs->get(\$o->get(\"c\"))))));
				}break;
				case \"OFunction\":{
					\$�r = (!\$�this->functionClosures->exists(\$o->get(\"f\")) ? eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException(\\\$o->get(\\\"f\\\") . \\\" must be created as function (closure) before referencing it here.\\\");
						return \\\$�r3;
					\") : Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(\$�this->functionClosures->get(\$o->get(\"f\"))))));
				}break;
				case \"OGetSuper\":case \"OSetSuper\":case \"OGetDescendants\":case \"OFindPropStrict\":case \"OFindProp\":case \"OFindDefinition\":case \"OGetLex\":case \"OSetProp\":case \"OGetProp\":case \"OInitProp\":case \"ODeleteProp\":case \"OCast\":case \"OAsType\":case \"OIsType\":{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$v = \\\$�this->getAnyAttribute(\\\$o, new _hx_array(array(\\\"v\\\", \\\"c\\\", \\\"cast\\\", \\\"p\\\", \\\"d\\\", \\\"t\\\")));
						\\\$�r4 = (\\\$v == \\\"#arrayProp\\\" ? Type::createEnum(_hx_qtype(\\\"format.abc.OpCode\\\"), \\\$o->getNodeName(), new _hx_array(array(\\\$�this->ctx->arrayProp))) : Type::createEnum(_hx_qtype(\\\"format.abc.OpCode\\\"), \\\$o->getNodeName(), new _hx_array(array(\\\$�this->ctx->type(\\\$�this->getImport(\\\$v))))));
						return \\\$�r4;
					\");
				}break;
				case \"OCallSuper\":case \"OCallProperty\":case \"OConstructProperty\":case \"OCallPropLex\":case \"OCallSuperVoid\":case \"OCallPropVoid\":{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$p = \\\$�this->getAnyAttribute(\\\$o, new _hx_array(array(\\\"type\\\", \\\"name\\\", \\\"p\\\")));
						\\\$nargs = Std::parseInt(\\\$o->get(\\\"nargs\\\"));
						\\\$�r5 = (\\\$p == \\\"#arrayProp\\\" ? Type::createEnum(_hx_qtype(\\\"format.abc.OpCode\\\"), \\\$o->getNodeName(), new _hx_array(array(\\\$�this->ctx->arrayProp, \\\$nargs))) : Type::createEnum(_hx_qtype(\\\"format.abc.OpCode\\\"), \\\$o->getNodeName(), new _hx_array(array(\\\$�this->ctx->type(\\\$�this->getImport(\\\$p)), \\\$nargs))));
						return \\\$�r5;
					\");
				}break;
				case \"ORegKill\":case \"OReg\":case \"OIncrReg\":case \"ODecrReg\":case \"OIncrIReg\":case \"ODecrIReg\":case \"OSmallInt\":case \"OInt\":case \"OGetScope\":case \"ODebugLine\":case \"OBreakPointLine\":case \"OUnknown\":case \"OCallStack\":case \"OConstruct\":case \"OConstructSuper\":case \"OApplyType\":case \"OObject\":case \"OArray\":case \"OGetSlot\":case \"OSetSlot\":case \"OGetGlobalSlot\":case \"OSetGlobalSlot\":{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$v2 = Std::parseInt(\\\$�this->getAnyAttribute(\\\$o, new _hx_array(array(\\\"c\\\", \\\"r\\\", \\\"v\\\", \\\"n\\\", \\\"s\\\", \\\"line\\\", \\\"byte\\\", \\\"nargs\\\", \\\"nfields\\\", \\\"nvalues\\\"))));
						\\\$�r6 = Type::createEnum(_hx_qtype(\\\"format.abc.OpCode\\\"), \\\$o->getNodeName(), new _hx_array(array(\\\$v2)));
						return \\\$�r6;
					\");
				}break;
				case \"OCatch\":{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$_try = _hx_anonymous(array(\\\"start\\\" => Std::parseInt(\\\$o->get(\\\"start\\\")), \\\"end\\\" => Std::parseInt(\\\$o->get(\\\"end\\\")), \\\"handle\\\" => Std::parseInt(\\\$o->get(\\\"handle\\\")), \\\"type\\\" => \\\$�this->ctx->type(\\\$�this->getImport(\\\$o->get(\\\"type\\\"))), \\\"variable\\\" => \\\$�this->ctx->type(\\\$�this->getImport(\\\$o->get(\\\"variable\\\")))));
						\\\$f->trys->push(\\\$_try);
						\\\$�r7 = Type::createEnum(_hx_qtype(\\\"format.abc.OpCode\\\"), \\\$o->getNodeName(), new _hx_array(array(_hx_len(\\\$f->trys) - 1)));
						return \\\$�r7;
					\");
				}break;
				case \"OSetReg\":{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$�this->ctx->allocRegister();
						\\\$v3 = Std::parseInt(\\\$�this->getAnyAttribute(\\\$o, new _hx_array(array(\\\"r\\\", \\\"v\\\"))));
						\\\$�r8 = Type::createEnum(_hx_qtype(\\\"format.abc.OpCode\\\"), \\\$o->getNodeName(), new _hx_array(array(\\\$v3)));
						return \\\$�r8;
					\");
				}break;
				case \"OpAs\":case \"OpNeg\":case \"OpIncr\":case \"OpDecr\":case \"OpNot\":case \"OpBitNot\":case \"OpAdd\":case \"OpSub\":case \"OpMul\":case \"OpDiv\":case \"OpMod\":case \"OpShl\":case \"OpShr\":case \"OpUShr\":case \"OpAnd\":case \"OpOr\":case \"OpXor\":case \"OpEq\":case \"OpPhysEq\":case \"OpLt\":case \"OpLte\":case \"OpGt\":case \"OpGte\":case \"OpIs\":case \"OpIn\":case \"OpIIncr\":case \"OpIDecr\":case \"OpINeg\":case \"OpIAdd\":case \"OpISub\":case \"OpIMul\":case \"OpMemGet8\":case \"OpMemGet16\":case \"OpMemGet32\":case \"OpMemGetFloat\":case \"OpMemGetDouble\":case \"OpMemSet8\":case \"OpMemSet16\":case \"OpMemSet32\":case \"OpMemSetFloat\":case \"OpMemSetDouble\":case \"OpSign1\":case \"OpSign8\":case \"OpSign16\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \"OOp\", new _hx_array(array(Type::createEnum(_hx_qtype(\"format.abc.Operation\"), \$o->getNodeName(), null))));
				}break;
				case \"OOp\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \"OOp\", new _hx_array(array(Type::createEnum(_hx_qtype(\"format.abc.Operation\"), \$�this->getAnyAttribute(\$o, new _hx_array(array(\"type\", \"op\", \"args\"))), null))));
				}break;
				case \"OCallStatic\":{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$meth = format_abc_Index::Idx(Std::parseInt(\\\$o->get(\\\"meth\\\")));
						\\\$nargs2 = Std::parseInt(\\\$o->get(\\\"nargs\\\"));
						\\\$�r9 = Type::createEnum(_hx_qtype(\\\"format.abc.OpCode\\\"), \\\$o->getNodeName(), new _hx_array(array(\\\$meth, \\\$nargs2)));
						return \\\$�r9;
					\");
				}break;
				case \"OCallMethod\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(Std::parseInt(\$o->get(\"s\")), Std::parseInt(\$o->get(\"nargs\")))));
				}break;
				case \"OJump\":{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$jumpName = \\\$o->get(\\\"name\\\");
						\\\$�r10 = (\\\$jumpName !== null ? eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;call_user_func_array(\\\\\$�this->jumps->get(\\\\\$jumpName), array());
							if(\\\\\$�this->log) {
								\\\\\$�this->logStack(\\\\\"OJump name=\\\\\" . \\\\\$jumpName);
							}
							\\\\\$�r11 = null;
							return \\\\\$�r11;
						\\\") : eval(\\\"if(isset(\\\\\$this)) \\\\\$�this =& \\\\\$this;\\\\\$j = Type::createEnum(_hx_qtype(\\\\\"format.abc.JumpStyle\\\\\"), \\\\\$o->get(\\\\\"jump\\\\\"), new _hx_array(array()));
							\\\\\$offset = Std::parseInt(\\\\\$o->get(\\\\\"offset\\\\\"));
							\\\\\$�r12 = Type::createEnum(_hx_qtype(\\\\\"format.abc.OpCode\\\\\"), \\\\\$o->getNodeName(), new _hx_array(array(\\\\\$j, \\\\\$offset)));
							return \\\\\$�r12;
						\\\"));
						return \\\$�r10;
					\");
				}break;
				case \"JNotLt\":case \"JNotLte\":case \"JNotGt\":case \"JNotGte\":case \"JAlways\":case \"JTrue\":case \"JFalse\":case \"JEq\":case \"JNeq\":case \"JLt\":case \"JLte\":case \"JGt\":case \"JGte\":case \"JPhysEq\":case \"JPhysNeq\":{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$jump = Type::createEnum(_hx_qtype(\\\"format.abc.JumpStyle\\\"), \\\$o->getNodeName(), null);
						\\\$jumpName2 = \\\$o->get(\\\"jump\\\");
						\\\$labelName = \\\$o->get(\\\"label\\\");
						if(\\\$jumpName2 !== null) {
							\\\$�this->jumps->set(\\\$jumpName2, \\\$�this->ctx->jump(\\\$jump));
						}
						else {
							if(\\\$labelName !== null) {
								call_user_func_array(\\\$�this->labels->get(\\\$labelName), array(\\\$jump));
							}
						}
						\\\$�this->updateStacks(format_abc_OpCode::OJump(\\\$jump, 0));
						\\\$�r13 = null;
						return \\\$�r13;
					\");
				}break;
				case \"OLabel\":{
					\$�r = (\$o->get(\"name\") !== null ? eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;if(\\\$�this->log) {
							\\\$�this->logStack(\\\"OLabel name=\\\" . \\\$o->get(\\\"name\\\"));
						}
						\\\$�this->updateStacks(format_abc_OpCode::\\\$OLabel);
						\\\$�this->labels->set(\\\$o->get(\\\"name\\\"), \\\$�this->ctx->backwardJump());
						\\\$�r14 = null;
						return \\\$�r14;
					\") : Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array())));
				}break;
				case \"OSwitch\":{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;\\\$arr = _hx_explode(\\\",\\\", \\\$o->get(\\\"deltas\\\"));
						\\\$deltas = new _hx_array(array());
						{
							\\\$_g = 0;
							while(\\\$_g < \\\$arr->length) {
								\\\$i = \\\$arr[\\\$_g];
								++\\\$_g;
								\\\$deltas->push(Std::parseInt(\\\$i));
								unset(\\\$i);
							}
						}
						\\\$�r15 = Type::createEnum(_hx_qtype(\\\"format.abc.OpCode\\\"), \\\$o->getNodeName(), new _hx_array(array(Std::parseInt(\\\$o->get(\\\"def\\\")), \\\$deltas)));
						return \\\$�r15;
					\");
				}break;
				case \"ONext\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(Std::parseInt(\$o->get(\"r1\")), Std::parseInt(\$o->get(\"r2\")))));
				}break;
				case \"ODebugReg\":{
					\$�r = Type::createEnum(_hx_qtype(\"format.abc.OpCode\"), \$o->getNodeName(), new _hx_array(array(\$�this->ctx->string(\$o->get(\"name\")), Std::parseInt(\$o->get(\"r\")), Std::parseInt(\$o->get(\"line\")))));
				}break;
				default:{
					\$�r = eval(\"if(isset(\\\$this)) \\\$�this =& \\\$this;throw new HException((\\\$o->getNodeName() . \\\" Unknown opcode.\\\"));
						return \\\$�r16;
					\");
				}break;
				}
				return \$�r;
			");
			if($op !== null) {
				$this->updateStacks($op);
				$this->ctx->op($op);
			}
			unset($�r9,$�r8,$�r7,$�r6,$�r5,$�r4,$�r3,$�r2,$�r16,$�r15,$�r14,$�r13,$�r12,$�r11,$�r10,$�r,$v3,$v2,$v,$p,$op,$offset,$nargs2,$nargs,$meth,$labelName,$jumpName2,$jumpName,$jump,$j,$i,$deltas,$arr,$_try,$_g);
		}
		}
		return true;
	}
	public function abc2xml($abc) {
		return "";
	}
	public function getImport($name) {
		if($this->imports->exists($name)) {
			return $this->imports->get($name);
		}
		return $name;
	}
	public function namespaceType($ns) {
		return $this->ctx->namespace(eval("if(isset(\$this)) \$�this =& \$this;switch(\$ns) {
			case \"public\":{
				\$�r = format_abc_Namespace::NPublic(\$�this->ctx->string(\"\"));
			}break;
			case \"private\":{
				\$�r = format_abc_Namespace::NPrivate(\$�this->ctx->string(\"*\"));
			}break;
			case \"protected\":{
				\$�r = format_abc_Namespace::NProtected(\$�this->ctx->string(\$�this->curClassName));
			}break;
			case \"internal\":{
				\$�r = format_abc_Namespace::NInternal(\$�this->ctx->string(\"\"));
			}break;
			case \"namespace\":{
				\$�r = format_abc_Namespace::NNamespace(\$�this->ctx->string(\$�this->curClassName));
			}break;
			case \"explicit\":{
				\$�r = format_abc_Namespace::NExplicit(\$�this->ctx->string(\"\"));
			}break;
			case \"staticProtected\":{
				\$�r = format_abc_Namespace::NStaticProtected(\$�this->ctx->string(\$�this->curClassName));
			}break;
			default:{
				\$�r = format_abc_Namespace::NPublic(\$�this->ctx->string(\"\"));
			}break;
			}
			return \$�r;
		"));
	}
	public function getAnyAttribute($element, $arr) {
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if($element->get($arr[$i]) !== null) {
					return $element->get($arr[$i]);
				}
				unset($i);
			}
		}
		throw new HException(("Missing attribute on element. Valid attributes are:" . $arr->toString()));
	}
	public function parseLocals($locals) {
		$locs = _hx_explode(",", $locals);
		$out = new _hx_array(array());
		$index = 1;
		{
			$_g = 0;
			while($_g < $locs->length) {
				$l = $locs[$_g];
				++$_g;
				$props = _hx_explode(":", $l);
				$out->push(_hx_anonymous(array("name" => $this->ctx->type($this->getImport($props[0])), "slot" => $index, "kind" => $this->parseFieldKind($l), "metadatas" => null)));
				$index++;
				unset($props,$l);
			}
		}
		return $out;
	}
	public function parseFieldKind($fld) {
		return format_abc_FieldKind::FVar(null, null, null);
	}
	public function nonEmptyStack($fname) {
		$msg = "!Possible error: Function " . $fname . " did not end with empty stack. current stack: " . $this->currentStack;
		if($this->throwsErrors) {
			throw new HException(($msg));
		}
		if($this->log) {
			$this->logStack($msg);
		}
	}
	public function stackError($op, $type) {
		$o = Type::getEnum($op);
		$msg = ($type === 0 ? "!Possible error: stack underflow: " . $op : "!Possible error: stack overflow: " . $op);
		if($this->throwsErrors) {
			throw new HException(($msg));
		}
		if($this->log) {
			$this->logStack($msg);
		}
	}
	public function scopeStackError($op, $type) {
		$o = Type::getEnum($op);
		$msg = ($type === 0 ? "!Possible error: scopeStack underflow: " . $op : "!Possible error: scopeStack overflow: " . $op);
		if($this->throwsErrors) {
			throw new HException(($msg));
		}
		if($this->log) {
			$this->logStack($msg);
		}
	}
	public function logStack($msg) {
		haxe_Log::trace($msg, _hx_anonymous(array("fileName" => "Hxavm2.hx", "lineNumber" => 564, "className" => "be.haxer.hxswfml.Hxavm2", "methodName" => "logStack")));
	}
	public function updateStacks($opc) {
		if($this->log) {
			$this->logStack($opc);
		}
		$�t = ($opc);
		switch($�t->index) {
		case 0:
		{
			;
		}break;
		case 1:
		{
			;
		}break;
		case 2:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 3:
		$v = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			++$this->currentStack;
		}break;
		case 4:
		$v2 = $�t->params[0];
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 5:
		$i = $�t->params[0];
		{
			;
		}break;
		case 6:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 7:
		$r = $�t->params[0];
		{
			;
		}break;
		case 8:
		{
			;
		}break;
		case 9:
		$name = $�t->params[0];
		{
			;
		}break;
		case 10:
		$delta = $�t->params[1]; $j = $�t->params[0];
		{
			$�t2 = ($j);
			switch($�t2->index) {
			case 4:
			{
				;
			}break;
			case 5:
			case 6:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
			}break;
			case 0:
			case 1:
			case 2:
			case 3:
			case 7:
			case 8:
			case 9:
			case 10:
			case 11:
			case 12:
			case 13:
			case 14:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
			}break;
			}
		}break;
		case 11:
		$offset = $�t->params[2]; $landingName = $�t->params[1]; $j2 = $�t->params[0];
		{
			;
		}break;
		case 12:
		$landingName2 = $�t->params[0];
		{
			;
		}break;
		case 13:
		$deltas = $�t->params[1]; $def = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 14:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->maxScopeStack++;
		}break;
		case 15:
		{
			if(--$this->currentScopeStack < 0) {
				$this->scopeStackError($opc, 0);
			}
		}break;
		case 16:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 17:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 18:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 19:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 20:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 21:
		$v3 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 22:
		$v4 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 23:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 24:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 25:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 26:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 27:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 28:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack += 2;
		}break;
		case 29:
		$v5 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 30:
		$v6 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 31:
		$v7 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 32:
		$v8 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 33:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentScopeStack++;
			$this->maxScopeStack++;
		}break;
		case 34:
		$v9 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 35:
		$r2 = $�t->params[1]; $r1 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 36:
		$f = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 37:
		$n = $�t->params[0];
		{
			if(($this->currentStack -= ($n + 2)) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 38:
		$n2 = $�t->params[0];
		{
			if(($this->currentStack -= ($n2 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 39:
		$n3 = $�t->params[1]; $s = $�t->params[0];
		{
			if(($this->currentStack -= ($n3 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 40:
		$n4 = $�t->params[1]; $m = $�t->params[0];
		{
			if(($this->currentStack -= ($n4 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 41:
		$n5 = $�t->params[1]; $p = $�t->params[0];
		{
			if(($this->currentStack -= ($n5 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 42:
		$n6 = $�t->params[1]; $p2 = $�t->params[0];
		{
			if(($this->currentStack -= ($n6 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 43:
		{
			;
		}break;
		case 44:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 45:
		$n7 = $�t->params[0];
		{
			if(($this->currentStack -= ($n7 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 46:
		$n8 = $�t->params[1]; $p3 = $�t->params[0];
		{
			if(($this->currentStack -= ($n8 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 47:
		$n9 = $�t->params[1]; $p4 = $�t->params[0];
		{
			if(($this->currentStack -= ($n9 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 48:
		$n10 = $�t->params[1]; $p5 = $�t->params[0];
		{
			if(($this->currentStack -= ($n10 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 49:
		$n11 = $�t->params[1]; $p6 = $�t->params[0];
		{
			if(($this->currentStack -= ($n11 + 1)) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 50:
		$n12 = $�t->params[0];
		{
			;
		}break;
		case 51:
		$n13 = $�t->params[0];
		{
			if(($this->currentStack -= ($n13 * 2)) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 52:
		$n14 = $�t->params[0];
		{
			if(($this->currentStack -= $n14) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 53:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 54:
		$c = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 55:
		$i2 = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 56:
		$c2 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 57:
		$p7 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 58:
		$p8 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 59:
		$d = $�t->params[0];
		{
			;
		}break;
		case 60:
		$p9 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 61:
		$p10 = $�t->params[0];
		{
			$popCount = 2;
			if($p10 === $this->ctx->arrayProp) {
				$popCount = 3;
			}
			if(($this->currentStack -= $popCount) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 62:
		$r3 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			switch($r3) {
			case 0:{
				;
			}break;
			case 1:{
				;
			}break;
			case 2:{
				;
			}break;
			case 3:{
				;
			}break;
			default:{
				;
			}break;
			}
		}break;
		case 63:
		$r4 = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			switch($r4) {
			case 0:{
				;
			}break;
			case 1:{
				;
			}break;
			case 2:{
				;
			}break;
			case 3:{
				;
			}break;
			default:{
				;
			}break;
			}
		}break;
		case 64:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 65:
		$n15 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 66:
		$p11 = $�t->params[0];
		{
			if($p11 === $this->ctx->arrayProp) {
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
			}
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 67:
		$p12 = $�t->params[0];
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 68:
		$p13 = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 69:
		$s2 = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 70:
		$s3 = $�t->params[0];
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 71:
		$s4 = $�t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 72:
		$s5 = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 73:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 74:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 75:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 76:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 77:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 78:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 79:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 80:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 81:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 82:
		$t = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 83:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 84:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 85:
		$t2 = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 86:
		{
			;
		}break;
		case 87:
		$r5 = $�t->params[0];
		{
			;
		}break;
		case 88:
		$r6 = $�t->params[0];
		{
			;
		}break;
		case 89:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 90:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 91:
		$t3 = $�t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 92:
		$r7 = $�t->params[0];
		{
			;
		}break;
		case 93:
		$r8 = $�t->params[0];
		{
			;
		}break;
		case 94:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 95:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 96:
		$line = $�t->params[2]; $r9 = $�t->params[1]; $name2 = $�t->params[0];
		{
			;
		}break;
		case 97:
		$line2 = $�t->params[0];
		{
			;
		}break;
		case 98:
		$file = $�t->params[0];
		{
			;
		}break;
		case 99:
		$n16 = $�t->params[0];
		{
			;
		}break;
		case 100:
		{
			;
		}break;
		case 101:
		$op = $�t->params[0];
		{
			$�t3 = ($op);
			switch($�t3->index) {
			case 0:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 1:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 2:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 3:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 4:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 5:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 6:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 7:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 8:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 9:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 10:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 11:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 12:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 13:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 14:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 15:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 16:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 17:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 18:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 19:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 20:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 21:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 22:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 23:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 24:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 25:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 26:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 27:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 28:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 29:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 30:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
			}break;
			case 31:
			{
				;
			}break;
			case 32:
			{
				;
			}break;
			case 33:
			{
				;
			}break;
			case 34:
			{
				;
			}break;
			case 35:
			{
				;
			}break;
			case 36:
			{
				;
			}break;
			case 37:
			{
				;
			}break;
			case 38:
			{
				;
			}break;
			case 39:
			{
				;
			}break;
			case 40:
			{
				;
			}break;
			case 41:
			{
				;
			}break;
			case 42:
			{
				;
			}break;
			case 43:
			{
				;
			}break;
			}
		}break;
		case 102:
		$byte = $�t->params[0];
		{
			;
		}break;
		}
		if($this->log) {
			$this->logStack("currentStack= " . $this->currentStack . ", maxStack= " . $this->maxStack . "\x0AcurrentScopeStack= " . $this->currentScopeStack . ", maxScopeStack= " . $this->maxScopeStack . "\x0A\x0A");
		}
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->�dynamics[$m]) && is_callable($this->�dynamics[$m]))
			return call_user_func_array($this->�dynamics[$m], $a);
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	function __toString() { return 'be.haxer.hxswfml.Hxavm2'; }
}
