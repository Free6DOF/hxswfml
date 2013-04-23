<?php

class be_haxer_hxswfml_HxmWriter {
	public function __construct() {
		;
	}
	public function lineSplitter($str) {
		$out = _hx_explode("\x0D\x0A", $str)->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
	public function fileToLines($fileName) {
		$this->debugFileName = _hx_explode(";;", _hx_explode("\\", $fileName)->join("/"))->join("/");
		$this->debugLines = new _hx_array(array());
		if($this->sourceInfo) {
			if(file_exists($this->debugFileName)) {
				$str = sys_io_File::getContent($this->debugFileName);
				$str = be_haxer_hxswfml_HxmWriter_0($this, $fileName, $str);
				$this->debugLines = _hx_explode("\x0A", $str);
				{
					$_g1 = 0; $_g = $this->debugLines->length;
					while($_g1 < $_g) {
						$i = $_g1++;
						$this->debugLines[$i] = _hx_explode("\x0A", (be_haxer_hxswfml_HxmWriter_1($this, $_g, $_g1, $fileName, $i, $str)))->join("");
						unset($i);
					}
				}
			} else {
			}
		}
		$out = be_haxer_hxswfml_HxmWriter_2($this, $fileName);
		return $out;
	}
	public function logStack($msg) {
		$this->buf->add("//" . _hx_string_or_null($msg) . "\x0A");
	}
	public function updateStacks($opc) {
		$__hx__t = ($opc);
		switch($__hx__t->index) {
		case 0:
		{
		}break;
		case 1:
		{
		}break;
		case 2:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
		}break;
		case 3:
		$v = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			++$this->currentStack;
			$this->opStack->pop();
			$this->opStack->push("OGetSuper(" . Std::string($v) . ")");
		}break;
		case 4:
		$v = $__hx__t->params[0];
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
			$this->opStack->pop();
		}break;
		case 5:
		$i = $__hx__t->params[0];
		{
		}break;
		case 6:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
		}break;
		case 7:
		$r = $__hx__t->params[0];
		{
		}break;
		case 8:
		{
		}break;
		case 9:
		$name = $__hx__t->params[0];
		{
		}break;
		case 10:
		$delta = $__hx__t->params[1]; $j = $__hx__t->params[0];
		{
			$__hx__t2 = ($j);
			switch($__hx__t2->index) {
			case 4:
			{
			}break;
			case 5:
			case 6:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->opStack->pop();
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
				$this->opStack->pop();
				$this->opStack->pop();
			}break;
			}
		}break;
		case 11:
		$offset = $__hx__t->params[2]; $landingName = $__hx__t->params[1]; $j = $__hx__t->params[0];
		{
		}break;
		case 12:
		$landingName = $__hx__t->params[0];
		{
		}break;
		case 13:
		$deltas = $__hx__t->params[1]; $def = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
		}break;
		case 14:
		$offsets = $__hx__t->params[2]; $landingNames = $__hx__t->params[1]; $landingName = $__hx__t->params[0];
		{
		}break;
		case 15:
		$landingName = $__hx__t->params[0];
		{
		}break;
		case 16:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->maxScopeStack++;
			$this->opStack->pop();
			$this->scStack->push("OPushWith" . _hx_string_or_null($this->opStack->pop()));
		}break;
		case 17:
		{
			if(--$this->currentScopeStack < 0) {
				$this->scopeStackError($opc, 0);
			}
			$this->scStack->pop();
		}break;
		case 18:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->pop();
			$this->opStack->push("OForIn");
		}break;
		case 19:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->pop();
			$this->opStack->push("OHasNext");
		}break;
		case 20:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("ONull");
		}break;
		case 21:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OUndefined");
		}break;
		case 22:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
			$this->opStack->pop();
			$this->currentStack++;
			$this->opStack->push("OForEach");
		}break;
		case 23:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OSmallInt(" . _hx_string_rec($v, "") . ")");
		}break;
		case 24:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OInt(" . _hx_string_rec($v, "") . ")");
		}break;
		case 25:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OTrue");
		}break;
		case 26:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OFalse");
		}break;
		case 27:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("ONaN");
		}break;
		case 28:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
		}break;
		case 29:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push($this->opStack[$this->opStack->length - 1]);
		}break;
		case 30:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack += 2;
			$t0 = $this->opStack[$this->opStack->length - 1];
			$t1 = $this->opStack[$this->opStack->length - 2];
			$this->opStack[$this->opStack->length - 1] = $t1;
			$this->opStack[$this->opStack->length - 2] = $t0;
		}break;
		case 31:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OString(" . Std::string($v) . ")");
		}break;
		case 32:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OIntRef(" . Std::string($v) . ")");
		}break;
		case 33:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OUIntRef(" . Std::string($v) . ")");
		}break;
		case 34:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OFloat(" . Std::string($v) . ")");
		}break;
		case 35:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentScopeStack++;
			if($this->currentScopeStack > $this->maxScopeStack) {
				$this->maxScopeStack = $this->currentScopeStack;
			}
			$this->scStack->push($this->opStack->pop());
		}break;
		case 36:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("ONamespace(" . Std::string($v) . ")");
		}break;
		case 37:
		$r2 = $__hx__t->params[1]; $r1 = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("ONext(" . _hx_string_rec($r1, "") . ", " . _hx_string_rec($r2, "") . ")");
		}break;
		case 38:
		$f = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OFunction(" . Std::string($f) . ")");
		}break;
		case 39:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n + 2;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OCallStack(" . _hx_string_or_null($temp) . ")");
		}break;
		case 40:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OConstruct(" . _hx_string_or_null($temp) . ")");
		}break;
		case 41:
		$n = $__hx__t->params[1]; $s = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OCallMethod(" . _hx_string_or_null($temp) . ")");
		}break;
		case 42:
		$n = $__hx__t->params[1]; $m = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OCallStatic(" . _hx_string_or_null($temp) . ")");
		}break;
		case 43:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OCallSuper(" . _hx_string_or_null($temp) . ")");
		}break;
		case 44:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OCallProperty(" . _hx_string_or_null($temp) . ")");
		}break;
		case 45:
		{
		}break;
		case 46:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
		}break;
		case 47:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$this->opStack->pop();
					unset($i);
				}
			}
		}break;
		case 48:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OConstructProperty(" . _hx_string_or_null($temp) . ")");
		}break;
		case 49:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OCallPropLex(" . _hx_string_or_null($temp) . ")");
		}break;
		case 50:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$this->opStack->pop();
					unset($i);
				}
			}
		}break;
		case 51:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$this->opStack->pop();
					unset($i);
				}
			}
		}break;
		case 52:
		$n = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			{
				$_g1 = 0; $_g = $n + 1;
				while($_g1 < $_g) {
					$i = $_g1++;
					$this->opStack->pop();
					unset($i);
				}
			}
		}break;
		case 53:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n * 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n * 2;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OObject(" . _hx_string_or_null($temp) . ")");
		}break;
		case 54:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$temp = "";
			{
				$_g1 = 0; $_g = $n;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OArray(" . _hx_string_or_null($temp) . ")");
		}break;
		case 55:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("ONewBlock");
		}break;
		case 56:
		$c = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OClassDef(" . Std::string($c) . ")");
		}break;
		case 57:
		$i = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
		}break;
		case 58:
		$c = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OCatch(" . _hx_string_rec($c, "") . ")");
		}break;
		case 59:
		$p = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OFindPropStrict(" . Std::string($p) . ")");
		}break;
		case 60:
		$p = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OFindProp(" . Std::string($p) . ")");
		}break;
		case 61:
		$d = $__hx__t->params[0];
		{
		}break;
		case 62:
		$p = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OGetLex(" . Std::string($p) . ")");
		}break;
		case 63:
		$p = $__hx__t->params[0];
		{
			$popCount = 2;
			if($p === $this->ctx->arrayProp) {
				$popCount = 3;
			}
			if(($this->currentStack -= $popCount) < 0) {
				$this->stackError($opc, 0);
			}
			$temp = "";
			{
				$_g1 = 0; $_g = $popCount;
				while($_g1 < $_g) {
					$i = $_g1++;
					$temp .= _hx_string_or_null($this->opStack->pop());
					unset($i);
				}
			}
			$this->opStack->push("OSetProp(" . _hx_string_or_null($temp) . ")");
		}break;
		case 64:
		$r = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OReg(" . _hx_string_rec($r, "") . ")");
			switch($r) {
			case 0:{
			}break;
			case 1:{
			}break;
			case 2:{
			}break;
			case 3:{
			}break;
			default:{
			}break;
			}
		}break;
		case 65:
		$r = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
			$this->opStack->push("OSetReg(" . _hx_string_rec($r, "") . ")");
			switch($r) {
			case 0:{
			}break;
			case 1:{
			}break;
			case 2:{
			}break;
			case 3:{
			}break;
			default:{
			}break;
			}
		}break;
		case 66:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OGetGlobalScope");
		}break;
		case 67:
		$n = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OGetScope(" . _hx_string_rec($n, "") . ")");
		}break;
		case 68:
		$p = $__hx__t->params[0];
		{
			if($p === $this->ctx->arrayProp) {
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
			}
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OGetProp(" . Std::string($p) . ")");
		}break;
		case 69:
		$p = $__hx__t->params[0];
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
			$this->opStack->pop();
			$this->opStack->push("OGetProp(" . Std::string($p) . ")");
		}break;
		case 70:
		$p = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("ODeleteProp(" . Std::string($p) . ")");
		}break;
		case 71:
		$s = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OGetSlot(" . _hx_string_rec($s, "") . ")");
		}break;
		case 72:
		$s = $__hx__t->params[0];
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
			$this->opStack->pop();
			$this->opStack->push("OSetSlot(" . _hx_string_rec($s, "") . ")");
		}break;
		case 73:
		$s = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OGetGlobalSlot(" . _hx_string_rec($s, "") . ")");
		}break;
		case 74:
		$s = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
			$this->opStack->push("OSetGlobalSlot(" . _hx_string_rec($s, "") . ")");
		}break;
		case 75:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OToString");
		}break;
		case 76:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OToXml");
		}break;
		case 77:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OToXmlAttr");
		}break;
		case 78:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OToInt");
		}break;
		case 79:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OToUInt");
		}break;
		case 80:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OToNumber");
		}break;
		case 81:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OToBool");
		}break;
		case 82:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OToObject");
		}break;
		case 83:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OCheckIsXml");
		}break;
		case 84:
		$t = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OCast(" . Std::string($t) . ")");
		}break;
		case 85:
		{
			if($this->currentStack === 0) {
			} else {
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->opStack->pop();
			}
			$this->currentStack++;
			$this->opStack->push("OAsAny");
		}break;
		case 86:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OAsString");
		}break;
		case 87:
		$t = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OAsType(" . Std::string($t) . ")");
		}break;
		case 88:
		{
		}break;
		case 89:
		$r = $__hx__t->params[0];
		{
		}break;
		case 90:
		$r = $__hx__t->params[0];
		{
		}break;
		case 91:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OTypeof");
		}break;
		case 92:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->pop();
			$this->opStack->push("OInstanceOf");
		}break;
		case 93:
		$t = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
			$this->opStack->pop();
			$this->opStack->push("OIsType(" . Std::string($t) . ")");
		}break;
		case 94:
		$r = $__hx__t->params[0];
		{
		}break;
		case 95:
		$r = $__hx__t->params[0];
		{
		}break;
		case 96:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
			$this->opStack->push("OThis");
		}break;
		case 97:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->opStack->pop();
			$this->opStack->push("OSetThis");
		}break;
		case 98:
		$line = $__hx__t->params[2]; $r = $__hx__t->params[1]; $name = $__hx__t->params[0];
		{
		}break;
		case 99:
		$line = $__hx__t->params[0];
		{
		}break;
		case 100:
		$file = $__hx__t->params[0];
		{
		}break;
		case 101:
		$n = $__hx__t->params[0];
		{
		}break;
		case 102:
		{
		}break;
		case 103:
		$op = $__hx__t->params[0];
		{
			$__hx__t2 = ($op);
			switch($__hx__t2->index) {
			case 0:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpAs");
			}break;
			case 1:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->push("OpNeg");
			}break;
			case 2:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->push("OpIncr");
			}break;
			case 3:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->push("OpDecr");
			}break;
			case 4:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->push("OpNot");
			}break;
			case 5:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->push("OpBitNot");
			}break;
			case 6:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpAdd");
			}break;
			case 7:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpSub");
			}break;
			case 8:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpMul");
			}break;
			case 9:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpDiv");
			}break;
			case 10:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpMod");
			}break;
			case 11:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpShl");
			}break;
			case 12:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpShr");
			}break;
			case 13:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpUShr");
			}break;
			case 14:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpAnd");
			}break;
			case 15:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpOr");
			}break;
			case 16:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpXor");
			}break;
			case 17:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpEq");
			}break;
			case 18:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpPhysEq");
			}break;
			case 19:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpLt");
			}break;
			case 20:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpLte");
			}break;
			case 21:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpGt");
			}break;
			case 22:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpGte");
			}break;
			case 23:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpIs");
			}break;
			case 24:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpIn");
			}break;
			case 25:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->push("OpIIncr");
			}break;
			case 26:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->push("OpIDecr");
			}break;
			case 27:
			{
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->push("OpINeg");
			}break;
			case 28:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpIAdd");
			}break;
			case 29:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpISub");
			}break;
			case 30:
			{
				if(($this->currentStack -= 2) < 0) {
					$this->stackError($opc, 0);
				}
				$this->currentStack++;
				$this->opStack->pop();
				$this->opStack->pop();
				$this->opStack->push("OpIMul");
			}break;
			case 31:
			{
			}break;
			case 32:
			{
			}break;
			case 33:
			{
			}break;
			case 34:
			{
			}break;
			case 35:
			{
			}break;
			case 36:
			{
			}break;
			case 37:
			{
			}break;
			case 38:
			{
			}break;
			case 39:
			{
			}break;
			case 40:
			{
			}break;
			case 41:
			{
			}break;
			case 42:
			{
			}break;
			case 43:
			{
			}break;
			}
		}break;
		case 104:
		$byte = $__hx__t->params[0];
		{
		}break;
		}
		if($this->log) {
			$this->logStack(Std::string($opc));
			$this->logStack("currentStack= " . _hx_string_rec($this->currentStack, "") . ", maxStack= " . _hx_string_rec($this->maxStack, "") . "\x0A//currentScopeStack= " . _hx_string_rec($this->currentScopeStack, "") . ", maxScopeStack= " . _hx_string_rec($this->maxScopeStack, ""));
		}
	}
	public function urlDecode($str) {
		return _hx_explode("'", _hx_explode("\\", _hx_explode("&lt;", _hx_explode("&quot;", $str)->join("\""))->join("<"))->join("\\\\"))->join("\\'");
	}
	public function scopeStackError($op, $type) {
		$o = Type::getEnum($op);
		$msg = be_haxer_hxswfml_HxmWriter_3($this, $o, $op, $type);
		if($this->strict) {
			throw new HException($msg);
		}
		if($this->log) {
			$this->logStack($msg);
		}
	}
	public function stackError($op, $type) {
		$o = Type::getEnum($op);
		$msg = be_haxer_hxswfml_HxmWriter_4($this, $o, $op, $type);
		if($this->strict) {
			throw new HException($msg);
		}
		if($this->log) {
			$this->logStack($msg);
		}
	}
	public function nonEmptyStack($fname) {
		$msg = "!Possible error: Function " . _hx_string_or_null($fname) . " did not end with empty stack. current stack: " . _hx_string_rec($this->currentStack, "");
		if($this->strict) {
			throw new HException($msg);
		}
		if($this->log) {
			$this->logStack($msg);
		}
	}
	public function parseFieldKind($fld) {
		return format_abc_FieldKind::FVar(null, null, null);
	}
	public function __parseLocals($locals) {
		$locs = _hx_explode(",", $locals);
		$out = new _hx_array(array());
		$index = 1;
		{
			$_g = 0;
			while($_g < $locs->length) {
				$l = $locs[$_g];
				++$_g;
				$props = _hx_explode(":", $l);
				$out->push("{" . "name : ctx.type(\"" . _hx_string_or_null($this->getImport($props[0])) . "\")," . "slot : " . _hx_string_rec($index, "") . "," . "kind : FVar()," . "metadatas : null" . "}");
				$index++;
				unset($props,$l);
			}
		}
		return $out;
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
	public function __namespaceType($ns) {
		$s = be_haxer_hxswfml_HxmWriter_5($this, $ns);
		return "ctx._namespace(" . _hx_string_or_null($s) . ")";
	}
	public function namespaceType($ns) {
		return $this->ctx->_namespace(be_haxer_hxswfml_HxmWriter_6($this, $ns));
	}
	public function getImport($name) {
		if($this->imports->exists($name)) {
			return $this->imports->get($name);
		}
		return $name;
	}
	public function writeCodeBlock($member, $f) {
		if($this->log) {
			if($this->className === null) {
				$this->logStack("------------------------------------------------\x0A//function= " . _hx_string_or_null($this->functionClosureName) . "\x0A//currentStack= " . _hx_string_rec($this->currentStack, "") . ", maxStack= " . _hx_string_rec($this->maxStack, "") . "\x0A//currentScopeStack= " . _hx_string_rec($this->currentScopeStack, "") . ", maxScopeStack= " . _hx_string_rec($this->maxScopeStack, ""));
			} else {
				$this->logStack("------------------------------------------------\x0A//current class= " . _hx_string_or_null($this->className) . ", method= " . _hx_string_or_null($member->get("name")) . "\x0A//currentStack= " . _hx_string_rec($this->currentStack, "") . ", maxStack= " . _hx_string_rec($this->maxStack, "") . "\x0A//currentScopeStack= " . _hx_string_rec($this->currentScopeStack, "") . ", maxScopeStack= " . _hx_string_rec($this->maxScopeStack, ""));
			}
		}
		$this->opStack = new _hx_array(array());
		$this->scStack = new _hx_array(array());
		$this->lastBytepos = $this->ctx->bytepos->n;
		if(null == $member) throw new HException('null iterable');
		$__hx__it = $member->elements();
		while($__hx__it->hasNext()) {
			$o = $__hx__it->next();
			$op = null;
			$__op = null;
			$op = be_haxer_hxswfml_HxmWriter_7($this, $__op, $f, $member, $o, $op);
			if($op !== null) {
				if($this->showBytePos) {
					$this->buf->add("//" . _hx_string_rec(($this->ctx->bytepos->n - $this->lastBytepos), "") . " : \x0A");
				}
				$this->updateStacks($op);
				$this->ctx->op($op);
				$this->buf->add("\x09\x09\x09ctx.op(" . _hx_string_or_null($__op) . ");\x0A");
			}
			if($this->log) {
				$this->buf->add("\x0A//Operand Stack: " . _hx_string_or_null($this->opStack->toString()) . "\x0A");
				$this->buf->add("//Scope Stack: " . _hx_string_or_null($this->scStack->toString()) . "\x0A");
			}
			unset($op,$__op);
		}
	}
	public function createFunction($node, $functionType, $isInterface = null) {
		if($isInterface === null) {
			$isInterface = false;
		}
		$this->maxStack = 0;
		$this->currentStack = 0;
		$this->maxScopeStack = 0;
		$this->currentScopeStack = 0;
		$args = new _hx_array(array());
		$_args = $node->get("args");
		$__args = new _hx_array(array());
		if($_args === null || $_args === "") {
			$args = new _hx_array(array());
		} else {
			$_g = 0; $_g1 = _hx_explode(",", $_args);
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				$args->push($this->ctx->type($this->getImport($i)));
				$__args->push("ctx.type('" . _hx_string_or_null($this->getImport($i)) . "')");
				unset($i);
			}
		}
		$_return = (($node->get("return") === "" || $node->get("return") === null) ? $this->ctx->type("*") : $this->ctx->type($this->getImport($node->get("return"))));
		$__return = be_haxer_hxswfml_HxmWriter_8($this, $__args, $_args, $_return, $args, $functionType, $isInterface, $node);
		$defaultParameters = $node->get("defaultParameters");
		$_defaultParameters = null;
		$__defaultParameters = new _hx_array(array());
		if($defaultParameters !== null) {
			$values = _hx_explode(",", $defaultParameters);
			$_defaultParameters = new _hx_array(array());
			$__defaultParameters = new _hx_array(array());
			{
				$_g = 0;
				while($_g < $values->length) {
					$v = $values[$_g];
					++$_g;
					$_defaultParameters->push(null);
					$__defaultParameters->push("null");
					unset($v);
				}
			}
		}
		$___defaultParameters = be_haxer_hxswfml_HxmWriter_9($this, $__args, $__defaultParameters, $__return, $_args, $_defaultParameters, $_return, $args, $defaultParameters, $functionType, $isInterface, $node);
		$extra = _hx_anonymous(array("native" => $node->get("native") === "true", "variableArgs" => $node->get("variableArgs") === "true", "argumentsDefined" => $node->get("argumentsDefined") === "true", "usesDXNS" => $node->get("usesDXNS") === "true", "newBlock" => $node->get("newBlock") === "true", "unused" => $node->get("unused") === "true", "debugName" => $this->ctx->string((($node->get("debugName") === null) ? "" : $node->get("debugName"))), "defaultParameters" => $_defaultParameters, "paramNames" => null));
		$__debugName = (($node->get("debugName") === null) ? "\"\"" : $node->get("debugName"));
		$__extra = "{" . "native:" . Std::string($node->get("native") === "true") . ", " . "variableArgs:" . Std::string($node->get("variableArgs") === "true") . ", " . "argumentsDefined : " . Std::string($node->get("argumentsDefined") === "true") . ", " . "usesDXNS:" . Std::string($node->get("usesDXNS") === "true") . ", " . "newBlock:" . Std::string($node->get("newBlock") === "true") . ", " . "unused:" . Std::string($node->get("unused") === "true") . ", " . "debugName:ctx.string('" . _hx_string_or_null($__debugName) . "'), " . "defaultParameters:" . _hx_string_or_null($___defaultParameters) . ", " . "paramNames:null" . "}";
		$ns = $this->namespaceType($node->get("ns"));
		$__ns = $this->__namespaceType($node->get("ns"));
		$f = null;
		if($functionType === "function") {
			$this->ctx->beginFunction($args, $_return, $extra);
			$this->buf->add("\x0A\x09\x09ctx.beginFunction([" . _hx_string_or_null($__args->join(",")) . "], " . _hx_string_or_null($__return) . ", " . _hx_string_or_null($__extra) . ");\x0A");
			$this->buf->add("\x09\x09{\x0A");
			$f = $this->ctx->curFunction->f;
			$this->buf->add("\x09\x09f = ctx.curFunction.f;\x0A");
			$name = $node->get("f");
			$this->functionClosureName = $name;
			$this->functionClosures->set($name, $f->type);
			$this->buf->add("\x09\x09localFunctions.set('" . _hx_string_or_null($name) . "', f.type);\x0A");
		} else {
			if($functionType === "method") {
				$_static = $node->get("static") === "true";
				$_override = $node->get("override") === "true";
				$_final = $node->get("final") === "true";
				$_later = $node->get("later") === "true";
				$kind = be_haxer_hxswfml_HxmWriter_10($this, $___defaultParameters, $__args, $__debugName, $__defaultParameters, $__extra, $__ns, $__return, $_args, $_defaultParameters, $_final, $_later, $_override, $_return, $_static, $args, $defaultParameters, $extra, $f, $functionType, $isInterface, $node, $ns);
				if($node->get("name") === $this->className) {
					if($_static === true) {
						$this->ctx->beginFunction($args, $_return, $extra);
						$this->buf->add("\x0A\x09\x09ctx.beginFunction([" . _hx_string_or_null($__args->join(",")) . "], " . _hx_string_or_null($__return) . ", " . _hx_string_or_null($__extra) . ");\x0A");
						$this->buf->add("\x09\x09{\x0A");
						$f = $this->ctx->curFunction->f;
						$this->buf->add("\x09\x09f = ctx.curFunction.f;\x0A");
						$this->curClass->statics = $f->type;
						$this->buf->add("\x09\x09cl.statics = f.type;\x0A");
					} else {
						if($isInterface) {
							$f = $this->ctx->beginInterfaceMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, true, $kind, $extra, $ns);
							$this->buf->add("\x0A\x09\x09f=ctx.beginInterfaceMethod('" . _hx_string_or_null($this->getImport($node->get("name"))) . "', [" . _hx_string_or_null($__args->join(",")) . "], " . _hx_string_or_null($__return) . ", " . Std::string($_static) . ", " . Std::string($_override) . ", " . Std::string($_final) . ", true, " . Std::string($kind) . ", " . _hx_string_or_null($__extra) . ", " . _hx_string_or_null($__ns) . ");\x0A");
							$this->curClass->constructor = $f->type;
							$this->buf->add("\x09\x09cl.constructor = f.type;\x0A");
							return $f;
						} else {
							$f = $this->ctx->beginMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, true, $kind, $extra, $ns);
							$this->buf->add("\x0A\x09\x09f=ctx.beginMethod('" . _hx_string_or_null($this->getImport($node->get("name"))) . "', [" . _hx_string_or_null($__args->join(",")) . "], " . _hx_string_or_null($__return) . ", " . Std::string($_static) . ", " . Std::string($_override) . ", " . Std::string($_final) . ", true, " . Std::string($kind) . ", " . _hx_string_or_null($__extra) . ", " . _hx_string_or_null($__ns) . ");\x0A");
							$this->curClass->constructor = $f->type;
							$this->buf->add("\x09\x09{\x0A");
							$this->buf->add("\x09\x09cl.constructor = f.type;\x0A");
						}
					}
				} else {
					if($isInterface) {
						$f1 = $this->ctx->beginInterfaceMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, $_later, $kind, $extra, $ns);
						$this->buf->add("\x0A\x09\x09f=ctx.beginInterfaceMethod('" . _hx_string_or_null($this->getImport($node->get("name"))) . "', [" . _hx_string_or_null($__args->join(",")) . "], " . _hx_string_or_null($__return) . ", " . Std::string($_static) . ", " . Std::string($_override) . ", " . Std::string($_final) . ", " . Std::string($_later) . ", " . Std::string($kind) . ", " . _hx_string_or_null($__extra) . ", " . _hx_string_or_null($__ns) . ");\x0A");
						return $f1;
					} else {
						$f = $this->ctx->beginMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, $_later, $kind, $extra, $ns);
					}
					$this->buf->add("\x0A\x09\x09f=ctx.beginMethod('" . _hx_string_or_null($this->getImport($node->get("name"))) . "', [" . _hx_string_or_null($__args->join(",")) . "], " . _hx_string_or_null($__return) . ", " . Std::string($_static) . ", " . Std::string($_override) . ", " . Std::string($_final) . ", " . Std::string($_later) . ", " . Std::string($kind) . ", " . _hx_string_or_null($__extra) . ", " . _hx_string_or_null($__ns) . ");\x0A");
					$this->buf->add("\x09\x09{\x0A");
				}
			} else {
				if($functionType === "init") {
					$this->ctx->beginFunction($args, $_return, $extra);
					$this->buf->add("\x0A\x09\x09ctx.beginFunction([" . _hx_string_or_null($__args->join(",")) . "], " . _hx_string_or_null($__return) . "," . _hx_string_or_null($__extra) . ");\x0A");
					$f = $this->ctx->curFunction->f;
					$this->buf->add("\x09\x09{\x0A");
					$this->buf->add("\x09\x09f = ctx.curFunction.f;\x0A");
					$name = $this->getImport($node->get("name"));
					$this->inits->set($name, $f->type);
					$this->buf->add("\x09\x09inits.set('" . _hx_string_or_null($name) . "', f.type);\x0A");
				}
			}
		}
		if($node->get("locals") !== null) {
			$locals = $this->parseLocals($node->get("locals"));
			$__locals = $this->__parseLocals($node->get("locals"));
			if($locals->length !== 0) {
				$f->locals = $locals;
				$this->buf->add("\x09\x09f.locals = [" . _hx_string_or_null($__locals->join(",")) . "];\x0A");
			}
		}
		$this->writeCodeBlock($node, $f);
		if($node->get("maxStack") !== null) {
			$f->maxStack = Std::parseInt($node->get("maxStack"));
		} else {
			$f->maxStack = $this->maxStack + $f->trys->length;
		}
		if($node->get("maxScope") !== null) {
			$f->maxScope = Std::parseInt($node->get("maxScope"));
		} else {
			$f->maxScope = $this->maxScopeStack;
		}
		$this->buf->add("\x09\x09f.maxStack = " . _hx_string_rec($f->maxStack, "") . ";\x0A");
		$this->buf->add("\x09\x09f.maxScope = " . _hx_string_rec($f->maxScope, "") . ";\x0A");
		$this->buf->add("\x09\x09//f.nRegs = " . _hx_string_rec($f->nRegs, "") . ";\x0A");
		if($this->currentStack > 0) {
			$this->nonEmptyStack($node->get("name"));
		}
		$this->buf->add("\x09\x09}\x0A");
		return $f;
	}
	public function xml2abc($xml) {
		$ctx_xml = $xml;
		$this->ctx = new format_abc_Context();
		$this->jumps = new haxe_ds_StringMap();
		$this->labels = new haxe_ds_StringMap();
		$this->switches = new haxe_ds_StringMap();
		$this->curClassName = "";
		$statics = new _hx_array(array());
		$this->imports = new haxe_ds_StringMap();
		$this->opStack = new _hx_array(array());
		$this->scStack = new _hx_array(array());
		$this->functionClosures = new haxe_ds_StringMap();
		$this->inits = new haxe_ds_StringMap();
		$this->classDefs = new haxe_ds_StringMap();
		$this->classNames = new _hx_array(array());
		$this->swcClasses = new _hx_array(array());
		$ctx = $this->ctx;
		if(null == $ctx_xml) throw new HException('null iterable');
		$__hx__it = $ctx_xml->elements();
		while($__hx__it->hasNext()) {
			$_classNode = $__hx__it->next();
			switch($_classNode->get_nodeName()) {
			case "function":{
				$this->createFunction($_classNode, "function", null);
			}break;
			default:{
			}break;
			}
		}
		$this->localFunctions = $this->buf->b;
		if(null == $ctx_xml) throw new HException('null iterable');
		$__hx__it = $ctx_xml->elements();
		while($__hx__it->hasNext()) {
			$_classNode = $__hx__it->next();
			switch(strtolower($_classNode->get_nodeName())) {
			case "function":{
			}break;
			case "init":{
			}break;
			case "import":{
				$n = $_classNode->get("name");
				$cn = _hx_explode(".", $n)->pop();
				$this->imports->set($cn, $n);
			}break;
			case "class":case "interface":{
				$this->buf = new StringBuf();
				$this->className = $_classNode->get("name");
				$this->classNames->push($this->className);
				$isI = $_classNode->get("interface") === "true";
				$cl = $ctx->beginClass($this->className, $isI);
				$this->buf->add("\x09\x09//\x0A");
				$this->buf->add("\x09\x09//\x09\x09" . _hx_string_or_null($this->className) . "\x0A");
				$this->buf->add("\x09\x09//\x0A");
				$this->buf->add("\x09\x09var f = null;\x0A");
				$this->buf->add("\x09\x09var cl = ctx.beginClass('" . _hx_string_or_null($this->className) . "', " . Std::string($isI) . ");\x0A");
				$this->buf->add("\x09\x09{\x0A");
				$this->curClass = $cl;
				$this->classDefs->set($this->className, $ctx->getClass($cl));
				$this->buf->add("\x09\x09classes.set(\"" . _hx_string_or_null($this->className) . "\", ctx.getClass(cl));\x0A");
				$this->curClassName = _hx_explode(".", $this->className)->pop();
				if($_classNode->get("implements") !== null) {
					$cl->interfaces = new _hx_array(array());
					$this->buf->add("\x09\x09cl.interfaces = [];\x0A");
					{
						$_g = 0; $_g1 = _hx_explode(",", $_classNode->get("implements"));
						while($_g < $_g1->length) {
							$i = $_g1[$_g];
							++$_g;
							$cl->interfaces->push($ctx->type($this->getImport($i)));
							$this->buf->add("\x09\x09cl.interfaces.push(ctx.type('" . _hx_string_or_null($this->getImport($i)) . "'));\x0A");
							unset($i);
						}
					}
				}
				$cl->isFinal = $_classNode->get("final") === "true";
				$this->buf->add("\x09\x09cl.isFinal = " . Std::string($cl->isFinal) . ";\x0A");
				$cl->isInterface = $_classNode->get("interface") === "true";
				$this->buf->add("\x09\x09cl.isInterface = " . Std::string($cl->isInterface) . ";\x0A");
				$cl->isSealed = $_classNode->get("sealed") === "true";
				$this->buf->add("\x09\x09cl.isSealed = " . Std::string($cl->isSealed) . ";\x0A");
				$this->buf->add("\x09\x09//cl.namespace = ctx._namespace(NProtected(ctx.string('" . _hx_string_or_null($this->curClassName) . "')));\x0A");
				$_extends = $_classNode->get("extends");
				if($_extends !== null) {
					$cl->superclass = $ctx->type($this->getImport($_extends));
					$this->buf->add("\x09\x09cl.superclass = ctx.type('" . _hx_string_or_null($this->getImport($_extends)) . "');\x0A");
					$ctx->addClassSuper($this->getImport($_extends));
					$this->buf->add("\x09\x09ctx.addClassSuper('" . _hx_string_or_null($this->getImport($_extends)) . "');\x0A");
				}
				$this->swcClasses->push(new _hx_array(array($this->className, (($_extends === null) ? "Object" : $_extends))));
				if(null == $_classNode) throw new HException('null iterable');
				$__hx__it2 = $_classNode->elements();
				while($__hx__it2->hasNext()) {
					$member = $__hx__it2->next();
					switch($member->get_nodeName()) {
					case "var":{
						$name = $member->get("name");
						$type = $member->get("type");
						if($type === null || $type === "") {
							$type = "*";
						}
						$isStatic = $member->get("static") === "true";
						$value = $member->get("value");
						$_const = $member->get("const") === "true";
						$ns = $this->namespaceType($member->get("ns"));
						$slot = $member->get("slot");
						$_value = be_haxer_hxswfml_HxmWriter_11($this, $_classNode, $_const, $_extends, $cl, $ctx, $ctx_xml, $isI, $isStatic, $member, $name, $ns, $slot, $statics, $type, $value, $xml);
						$_svalue = be_haxer_hxswfml_HxmWriter_12($this, $_classNode, $_const, $_extends, $_value, $cl, $ctx, $ctx_xml, $isI, $isStatic, $member, $name, $ns, $slot, $statics, $type, $value, $xml);
						$ctx->defineField($name, $ctx->type($this->getImport($type)), $isStatic, $_value, $_const, $ns, Std::parseInt($slot));
						$this->buf->add("\x09\x09ctx.defineField('" . _hx_string_or_null($name) . "', ctx.type('" . _hx_string_or_null($this->getImport($type)) . "'), " . Std::string($isStatic) . ", " . _hx_string_or_null($_svalue) . ", " . Std::string($_const) . ", ctx._namespace(NPublic(ctx.string(\"\")))," . _hx_string_or_null($slot) . ");\x0A");
					}break;
					case "function":{
						$this->createFunction($member, "method", $cl->isInterface);
					}break;
					default:{
						throw new HException(_hx_string_or_null($member->get_nodeName()) . " Must be <function/> or <var/>.");
					}break;
					}
				}
				if(null == $ctx_xml) throw new HException('null iterable');
				$__hx__it2 = $ctx_xml->elements();
				while($__hx__it2->hasNext()) {
					$_classNode1 = $__hx__it2->next();
					switch($_classNode1->get_nodeName()) {
					case "init":{
						if($_classNode1->get("name") === $this->className) {
							$this->createFunction($_classNode1, "init", null);
						}
					}break;
					default:{
					}break;
					}
				}
				if($this->inits->exists($this->className)) {
					_hx_array_get($ctx->getData()->inits, $ctx->getData()->inits->length - 1)->method = $this->inits->get($this->className);
					$this->buf->add("\x09\x09ctx.getData().inits[(ctx.getData().inits.length - 1)].method = inits.get('" . _hx_string_or_null($this->className) . "');\x0A");
					$ctx->endClass(false);
					$this->buf->add("\x09\x09ctx.endClass(false);\x0A");
				} else {
					$ctx->endClass(null);
					$this->buf->add("\x09\x09ctx.endClass();\x0A");
				}
				$this->buf->add("\x09\x09}\x0A");
				$this->packages->push(new _hx_array(array($this->className, $this->buf->b)));
			}break;
			default:{
				throw new HException("<" . _hx_string_or_null($_classNode->get_nodeName()) . "> Must be <function>, <init>, <import> or <class [<var>], [<function>]>.");
			}break;
			}
		}
	}
	public function getZIP($initName) {
		$zipdata = new HList();
		$zip = null;
		if(!$this->useFolders) {
			$start = "import format.abc.Data;\x0A" . "import format.swf.Data;\x0A" . "import neko.Sys;\x0A" . "import neko.Lib;\x0A" . "import neko.FileSystem;\x0A" . "import neko.io.File;\x0A" . "class GenSWF\x0A" . "{\x0A" . "\x09public static function main()\x0A" . "\x09{\x0A" . "\x09\x09new GenSWF();\x0A" . "\x09}\x0A" . "\x09public function new()\x0A" . "\x09{\x0A" . "\x09\x09var inits:Hash<Index<MethodType>> = new Hash();\x0A" . "\x09\x09var classes:Hash<Index<ClassDef>> = new Hash();\x0A" . "\x09\x09var ctx:format.abc.Context = new format.abc.Context();\x0A" . "\x09\x09var localFunctions:Hash<Index<MethodType>>=new Hash();\x0A" . "\x09\x09//------------------\x0A" . "\x09\x09initLocalFunctions(localFunctions, ctx, classes);\x0A" . "\x09\x09//------------------\x0A";
			$middle = "";
			{
				$_g = 0; $_g1 = $this->packages;
				while($_g < $_g1->length) {
					$i = $_g1[$_g];
					++$_g;
					$path = $i[0];
					$txt = $i[1];
					$middle .= _hx_string_or_null($txt);
					unset($txt,$path,$i);
				}
			}
			$end = "\x09\x09//------------------\x0A" . "\x09\x09var abcOutput = new haxe.io.BytesOutput();\x0A" . "\x09\x09var abcWriter = new format.abc.Writer(abcOutput);\x0A" . "\x09\x09abcWriter.write(ctx.getData());\x0A" . "\x09\x09//------------------\x0A" . "\x09\x09var swfFile = \x0A" . "\x09\x09{\x0A" . "\x09\x09\x09header: {version:10, compressed:false, width:800, height:600, fps:30, nframes:1},\x0A" . "\x09\x09\x09tags:\x0A" . "\x09\x09\x09[\x0A" . "\x09\x09\x09\x09TSandBox({useDirectBlit :false, useGPU:false, hasMetaData:false, actionscript3:true, useNetWork:false}),\x0A" . "\x09\x09\x09\x09TActionScript3(abcOutput.getBytes(), { id : 1, label : \"" . _hx_string_or_null($initName) . "\" } ),\x0A" . "\x09\x09\x09\x09TSymbolClass([{cid:0, className:\"" . _hx_string_or_null($initName) . "\"}]),\x0A" . "\x09\x09\x09\x09TShowFrame\x0A" . "\x09\x09\x09]\x0A" . "\x09\x09};\x0A" . "\x09\x09//------------------\x0A" . "\x09\x09var swfOutput:haxe.io.BytesOutput = new haxe.io.BytesOutput();\x0A" . "\x09\x09var writer = new format.swf.Writer(swfOutput);\x0A" . "\x09\x09writer.write(swfFile);\x0A" . "\x09\x09var file = File.write(\"" . "Main" . ".swf\",true);\x0A" . "\x09\x09file.write(swfOutput.getBytes());\x0A" . "\x09\x09file.close();\x0A" . "\x09}\x0A" . "\x09function initLocalFunctions(localFunctions, ctx:format.abc.Context, classes)\x0A" . "\x09{\x0A" . "\x09\x09\x09var f = null;\x0A" . "\x09\x09\x09" . _hx_string_or_null($this->localFunctions) . "\x0A" . "\x09}\x0A" . "}";
			$buildFile = "-main GenSWF\x0A" . "#replace with path to the format lib of hxswfml\x0A" . "-cp ../../../../../src\x0A" . "-x gen_swf";
			$data1 = haxe_io_Bytes::ofString($buildFile);
			$data2 = haxe_io_Bytes::ofString(_hx_string_or_null($start) . _hx_string_or_null($middle) . _hx_string_or_null($end));
			$zipdata->add(_hx_anonymous(array("fileName" => "build.hxml", "fileSize" => $data1->length, "fileTime" => Date::now(), "compressed" => false, "dataSize" => $data1->length, "data" => $data1, "crc32" => format_tools_CRC32::encode($data1), "extraFields" => new HList())));
			$zipdata->add(_hx_anonymous(array("fileName" => "GenSWF.hx", "fileSize" => $data2->length, "fileTime" => Date::now(), "compressed" => false, "dataSize" => $data2->length, "data" => $data2, "crc32" => format_tools_CRC32::encode($data2), "extraFields" => new HList())));
			$zipBytesOutput = new haxe_io_BytesOutput();
			$zipWriter = new format_zip_Writer($zipBytesOutput);
			$zipWriter->writeData($zipdata);
			$zip = $zipBytesOutput->getBytes();
		} else {
			$zipFileSystem = new haxe_ds_StringMap();
			$start = "import format.abc.Data;\x0A" . "import format.swf.Data;\x0A" . "import neko.Sys;\x0A" . "import neko.Lib;\x0A" . "import neko.FileSystem;\x0A" . "import neko.io.File;\x0A" . "class GenSWF\x0A" . "{\x0A" . "\x09public static function main()\x0A" . "\x09{\x0A" . "\x09\x09new GenSWF();\x0A" . "\x09}\x0A" . "\x09public function new()\x0A" . "\x09{\x0A" . "\x09\x09var inits:Hash<Index<MethodType>> = new Hash();\x0A" . "\x09\x09var classes:Hash<Index<ClassDef>> = new Hash();\x0A" . "\x09\x09var ctx:format.abc.Context = new format.abc.Context();\x0A" . "\x09\x09var localFunctions:Hash<Index<MethodType>>=new Hash();\x0A\x09\x09//------------------\x0A" . "\x09\x09LocalFunctions_abc.write(ctx, inits,classes, localFunctions);\x0A";
			{
				$_g = 0; $_g1 = $this->packages;
				while($_g < $_g1->length) {
					$i = $_g1[$_g];
					++$_g;
					$fo = $this->outputFolder;
					$path = $i[0];
					$txt = $i[1];
					$folders = _hx_explode(".", _hx_explode("@", $path)->join("A_"));
					$cn = $folders->pop();
					$p1 = be_haxer_hxswfml_HxmWriter_13($this, $_g, $_g1, $cn, $fo, $folders, $i, $initName, $path, $start, $txt, $zip, $zipFileSystem, $zipdata);
					$start .= "\x09\x09" . _hx_string_or_null($p1) . _hx_string_or_null($cn) . "_abc.write(ctx, inits,classes, localFunctions);\x0A";
					$cf = $fo;
					{
						$_g2 = 0;
						while($_g2 < $folders->length) {
							$f = $folders[$_g2];
							++$_g2;
							if(!$zipFileSystem->exists(_hx_string_or_null($cf) . _hx_string_or_null($f) . "_")) {
								$zipFileSystem->set(_hx_string_or_null($cf) . _hx_string_or_null($f) . "_/", "");
								$zipdata->add(_hx_anonymous(array("fileName" => _hx_string_or_null($cf) . _hx_string_or_null($f) . "_/", "fileSize" => 0, "fileTime" => Date::now(), "compressed" => false, "dataSize" => 0, "data" => null, "crc32" => 0, "extraFields" => new HList())));
								$cf .= "/" . _hx_string_or_null($f) . "_" . "/";
							}
							unset($f);
						}
						unset($_g2);
					}
					$p2 = be_haxer_hxswfml_HxmWriter_14($this, $_g, $_g1, $cf, $cn, $fo, $folders, $i, $initName, $p1, $path, $start, $txt, $zip, $zipFileSystem, $zipdata);
					$p3 = be_haxer_hxswfml_HxmWriter_15($this, $_g, $_g1, $cf, $cn, $fo, $folders, $i, $initName, $p1, $p2, $path, $start, $txt, $zip, $zipFileSystem, $zipdata);
					$pre = "" . "package " . _hx_string_or_null($p3) . ";\x0A" . "import format.abc.Data;\x0A" . "class " . _hx_string_or_null($cn) . "_abc\x0A" . "{\x0A" . "\x09public static function write(ctx:format.abc.Context, inits:Hash<Index<MethodType>>,classes:Hash<Index<ClassDef>>, localFunctions:Hash<Index<MethodType>>):Void\x0A" . "\x09{\x0A";
					$post = "" . "\x09}\x0A" . "}\x0A";
					$data3 = haxe_io_Bytes::ofString(_hx_string_or_null($pre) . _hx_string_or_null($txt) . _hx_string_or_null($post));
					$zipdata->add(_hx_anonymous(array("fileName" => _hx_string_or_null($fo) . _hx_string_or_null($p2) . _hx_string_or_null($cn) . "_abc.hx", "fileSize" => $data3->length, "fileTime" => Date::now(), "compressed" => false, "dataSize" => $data3->length, "data" => $data3, "crc32" => format_tools_CRC32::encode($data3), "extraFields" => new HList())));
					unset($txt,$pre,$post,$path,$p3,$p2,$p1,$i,$folders,$fo,$data3,$cn,$cf);
				}
			}
			$txt = "package;\x0A" . "import format.abc.Data;\x0A" . "class LocalFunctions_abc\x0A" . "{\x0A" . "\x09public static function write(ctx:format.abc.Context, inits:Hash<Index<MethodType>>,classes:Hash<Index<ClassDef>>, localFunctions:Hash<Index<MethodType>>):Void\x0A" . "\x09{\x0A" . "\x09\x09var f = null;\x0A" . _hx_string_or_null($this->localFunctions) . "\x09}\x0A" . "}\x0A";
			$data4 = haxe_io_Bytes::ofString($txt);
			$zipdata->add(_hx_anonymous(array("fileName" => _hx_string_or_null($this->outputFolder) . "LocalFunctions_abc.hx", "fileSize" => $data4->length, "fileTime" => Date::now(), "compressed" => false, "dataSize" => $data4->length, "data" => $data4, "crc32" => format_tools_CRC32::encode($data4), "extraFields" => new HList())));
			$end = "\x09\x09//------------------\x0A" . "\x09\x09var abcOutput = new haxe.io.BytesOutput();\x0A" . "\x09\x09var abcWriter = new format.abc.Writer(abcOutput);\x0A" . "\x09\x09abcWriter.write(ctx.getData());\x0A" . "\x09\x09//------------------\x0A" . "\x09\x09var swfFile = \x0A" . "\x09\x09{\x0A" . "\x09\x09\x09header: {version:10, compressed:false, width:800, height:600, fps:30, nframes:1},\x0A" . "\x09\x09\x09tags:\x0A" . "\x09\x09\x09[\x0A" . "\x09\x09\x09\x09TSandBox({useDirectBlit :false, useGPU:false, hasMetaData:false, actionscript3:true, useNetWork:false}),\x0A" . "\x09\x09\x09\x09TActionScript3(abcOutput.getBytes(), { id : 1, label : \"" . _hx_string_or_null($initName) . "\" } ),\x0A" . "\x09\x09\x09\x09TSymbolClass([{cid:0, className:\"" . _hx_string_or_null($initName) . "\"}]),\x0A" . "\x09\x09\x09\x09TShowFrame\x0A" . "\x09\x09\x09]\x0A" . "\x09\x09};\x0A" . "\x09\x09//------------------\x0A" . "\x09\x09var swfOutput:haxe.io.BytesOutput = new haxe.io.BytesOutput();\x0A" . "\x09\x09var writer = new format.swf.Writer(swfOutput);\x0A" . "\x09\x09writer.write(swfFile);\x0A" . "\x09\x09var file = File.write(\"" . "Main" . ".swf\",true);\x0A" . "\x09\x09file.write(swfOutput.getBytes());\x0A" . "\x09\x09file.close();\x0A" . "\x09}\x0A" . "}";
			$buildFile = "-main GenSWF\x0A" . "#replace with path to the format lib of hxswfml\x0A" . "-cp ../../../../../src\x0A" . "-x gen_swf";
			$data1 = haxe_io_Bytes::ofString($buildFile);
			$zipdata->add(_hx_anonymous(array("fileName" => "build.hxml", "fileSize" => $data1->length, "fileTime" => Date::now(), "compressed" => false, "dataSize" => $data1->length, "data" => $data1, "crc32" => format_tools_CRC32::encode($data1), "extraFields" => new HList())));
			$data2 = haxe_io_Bytes::ofString(_hx_string_or_null($start) . _hx_string_or_null($end));
			$zipdata->add(_hx_anonymous(array("fileName" => "GenSWF.hx", "fileSize" => $data2->length, "fileTime" => Date::now(), "compressed" => false, "dataSize" => $data2->length, "data" => $data2, "crc32" => format_tools_CRC32::encode($data2), "extraFields" => new HList())));
			$zipBytesOutput = new haxe_io_BytesOutput();
			$zipWriter = new format_zip_Writer($zipBytesOutput);
			$zipWriter->writeData($zipdata);
			$zip = $zipBytesOutput->getBytes();
		}
		return $zip;
	}
	public function write($xml) {
		$this->swfTags = new _hx_array(array());
		$this->buf = new StringBuf();
		$this->packages = new _hx_array(array());
		$this->lastBytepos = 0;
		$this->debugInfo = true;
		$abcfiles = Xml::parse($xml)->firstElement();
		if(strtolower($abcfiles->get_nodeName()) === "abcfile") {
			$this->xml2abc($abcfiles);
		} else {
			if(null == $abcfiles) throw new HException('null iterable');
			$__hx__it = $abcfiles->elements();
			while($__hx__it->hasNext()) {
				$abcfile = $__hx__it->next();
				$this->xml2abc($abcfile);
			}
		}
	}
	public $packages;
	public $scStack;
	public $opStack;
	public $lastBytepos;
	public $debugFileName;
	public $debugFile;
	public $debugLines;
	public $localFunctions;
	public $buf;
	public $swcClasses;
	public $classNames;
	public $swfTags;
	public $abcFile;
	public $labels;
	public $switches;
	public $jumps;
	public $classDefs;
	public $inits;
	public $functionClosures;
	public $imports;
	public $currentScopeStack;
	public $currentStack;
	public $maxScopeStack;
	public $maxStack;
	public $curClass;
	public $curClassName;
	public $functionClosureName;
	public $className;
	public $ctx;
	public $zip;
	public $outputFolder;
	public $log;
	public $strict;
	public $showBytePos;
	public $useFolders;
	public $sourceInfo;
	public $debugInfo;
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
	function __toString() { return 'be.haxer.hxswfml.HxmWriter'; }
}
function be_haxer_hxswfml_HxmWriter_0(&$__hx__this, &$fileName, &$str) {
	{
		$out = _hx_explode("\x0D\x0A", $str)->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_HxmWriter_1(&$__hx__this, &$_g, &$_g1, &$fileName, &$i, &$str) {
	{
		$out = _hx_explode("\x0D\x0A", $__hx__this->debugLines[$i])->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_HxmWriter_2(&$__hx__this, &$fileName) {
	if($__hx__this->debugFileName === "<null>") {
		return "";
	} else {
		return $__hx__this->debugFileName;
	}
}
function be_haxer_hxswfml_HxmWriter_3(&$__hx__this, &$o, &$op, &$type) {
	if($type === 0) {
		return "!Possible error: scopeStack underflow: " . Std::string($op);
	} else {
		return "!Possible error: scopeStack overflow: " . Std::string($op);
	}
}
function be_haxer_hxswfml_HxmWriter_4(&$__hx__this, &$o, &$op, &$type) {
	if($type === 0) {
		return "!Possible error: stack underflow: " . Std::string($op);
	} else {
		return "!Possible error: stack overflow: " . Std::string($op);
	}
}
function be_haxer_hxswfml_HxmWriter_5(&$__hx__this, &$ns) {
	switch($ns) {
	case "public":{
		return "NPublic(ctx.string(" . "\"\"" . "))";
	}break;
	case "private":{
		return "NPrivate(ctx.string(" . "\"*\"" . "))";
	}break;
	case "protected":{
		return "NProtected(ctx.string(" . _hx_string_or_null($__hx__this->curClassName) . "))";
	}break;
	case "internal":{
		return "NInternal(ctx.string(" . "\"\"" . "))";
	}break;
	case "namespace":{
		return "NNamespace(ctx.string(" . _hx_string_or_null($__hx__this->curClassName) . "))";
	}break;
	case "explicit":{
		return "NExplicit(ctx.string(" . "''" . "))";
	}break;
	case "staticProtected":{
		return "NStaticProtected(ctx.string(" . _hx_string_or_null($__hx__this->curClassName) . "))";
	}break;
	default:{
		return "NPublic(ctx.string(" . "\"\"" . "))";
	}break;
	}
}
function be_haxer_hxswfml_HxmWriter_6(&$__hx__this, &$ns) {
	switch($ns) {
	case "public":{
		return format_abc_Namespace::NPublic($__hx__this->ctx->string(""));
	}break;
	case "private":{
		return format_abc_Namespace::NPrivate($__hx__this->ctx->string("*"));
	}break;
	case "protected":{
		return format_abc_Namespace::NProtected($__hx__this->ctx->string($__hx__this->curClassName));
	}break;
	case "internal":{
		return format_abc_Namespace::NInternal($__hx__this->ctx->string(""));
	}break;
	case "namespace":{
		return format_abc_Namespace::NNamespace($__hx__this->ctx->string($__hx__this->curClassName));
	}break;
	case "explicit":{
		return format_abc_Namespace::NExplicit($__hx__this->ctx->string(""));
	}break;
	case "staticProtected":{
		return format_abc_Namespace::NStaticProtected($__hx__this->ctx->string($__hx__this->curClassName));
	}break;
	default:{
		return format_abc_Namespace::NPublic($__hx__this->ctx->string(""));
	}break;
	}
}
function be_haxer_hxswfml_HxmWriter_7(&$__hx__this, &$__op, &$f, &$member, &$o, &$op) {
	switch($o->get_nodeName()) {
	case "OBreakPoint":case "ONop":case "OThrow":case "ODxNsLate":case "OPushWith":case "OPopScope":case "OForIn":case "OHasNext":case "ONull":case "OUndefined":case "OForEach":case "OTrue":case "OFalse":case "ONaN":case "OPop":case "ODup":case "OSwap":case "OScope":case "ONewBlock":case "ORetVoid":case "ORet":case "OToString":case "OGetGlobalScope":case "OInstanceOf":case "OToXml":case "OToXmlAttr":case "OToInt":case "OToUInt":case "OToNumber":case "OToBool":case "OToObject":case "OCheckIsXml":case "OAsAny":case "OAsString":case "OAsObject":case "OTypeof":case "OThis":case "OSetThis":case "OTimestamp":{
		$__op = $o->get_nodeName();
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), null);
	}break;
	case "ODxNs":{
		$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.string('" . _hx_string_or_null($o->get("v")) . "'))";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->string($o->get("v")))));
	}break;
	case "OString":{
		$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.string('" . _hx_string_or_null($__hx__this->urlDecode($o->get("v"))) . "'))";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->string($__hx__this->urlDecode($o->get("v"))))));
	}break;
	case "OIntRef":case "OUIntRef":{
		$v = Std::parseInt($o->get("v"));
		$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.int(" . _hx_string_rec($v, "") . "))";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->int(Std::parseInt($o->get("v"))))));
	}break;
	case "OFloat":{
		$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.float(Std.parseFloat('" . _hx_string_or_null($o->get("v")) . "')))";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->float(Std::parseFloat($o->get("v"))))));
	}break;
	case "ONamespace":{
		$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.type('" . _hx_string_or_null($o->get("v")) . "'))";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->type($o->get("v")))));
	}break;
	case "OClassDef":{
		if(!$__hx__this->classDefs->exists($o->get("v"))) {
			throw new HException(_hx_string_or_null($o->get("v")) . " must be created as class before referencing it here.");
		} else {
			$__op = _hx_string_or_null($o->get_nodeName()) . "(classes.get('" . _hx_string_or_null($o->get("v")) . "'))";
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->classDefs->get($o->get("v")))));
		}
	}break;
	case "OFunction":{
		if(!$__hx__this->functionClosures->exists($o->get("v"))) {
			throw new HException(_hx_string_or_null($o->get("v")) . " must be created as function (closure) before referencing it here.");
		} else {
			$__op = _hx_string_or_null($o->get_nodeName()) . "(localFunctions.get('" . _hx_string_or_null($o->get("v")) . "'))";
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->functionClosures->get($o->get("v")))));
		}
	}break;
	case "OGetSuper":case "OSetSuper":case "OGetDescendants":case "OFindPropStrict":case "OFindProp":case "OFindDefinition":case "OGetLex":case "OSetProp":case "OGetProp":case "OInitProp":case "ODeleteProp":case "OCast":case "OAsType":case "OIsType":{
		$v = $o->get("v");
		if($v === "#arrayProp") {
			$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.arrayProp)";
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->arrayProp)));
		} else {
			$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.type('" . _hx_string_or_null($__hx__this->getImport($v)) . "'))";
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->type($__hx__this->getImport($v)))));
		}
		unset($v);
	}break;
	case "OCallSuper":case "OCallProperty":case "OConstructProperty":case "OCallPropLex":case "OCallSuperVoid":case "OCallPropVoid":{
		$p = $o->get("v");
		$nargs = Std::parseInt($o->get("nargs"));
		if($p === "#arrayProp") {
			$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.arrayProp, " . _hx_string_rec($nargs, "") . ")";
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->arrayProp, $nargs)));
		} else {
			$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.type('" . _hx_string_or_null($__hx__this->getImport($p)) . "')," . _hx_string_rec($nargs, "") . ")";
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->type($__hx__this->getImport($p)), $nargs)));
		}
		unset($p,$nargs);
	}break;
	case "ODebugFile":{
		$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.string('" . _hx_string_or_null($o->get("v")) . "'))";
		if($__hx__this->debugLines === null || $o->get("v") !== $__hx__this->debugFile) {
			$__hx__this->debugFile = $o->get("v");
			$__hx__this->debugFileName = be_haxer_hxswfml_HxmWriter_16($__hx__this, $__op, $f, $member, $o, $op);
		}
		if($__hx__this->sourceInfo) {
			$__hx__this->debugFile = $o->get("v");
			$__hx__this->debugFileName = be_haxer_hxswfml_HxmWriter_17($__hx__this, $__op, $f, $member, $o, $op);
		}
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->string($o->get("v")))));
	}break;
	case "ODebugLine":{
		$v = Std::parseInt($o->get("v"));
		$out = null;
		if($__hx__this->sourceInfo && $__hx__this->debugLines[$v - 1] !== null) {
			$__hx__this->buf->add("\x09\x09\x09//" . _hx_string_or_null($__hx__this->debugLines[$v - 1]) . "\x0A");
		}
		if($__hx__this->debugInfo) {
			$__op = _hx_string_or_null($o->get_nodeName()) . "(" . _hx_string_rec($v, "") . ")";
			$out = Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($v)));
		}
		return $out;
	}break;
	case "OReg":case "OIncrReg":case "ODecrReg":case "OIncrIReg":case "ODecrIReg":case "OSmallInt":case "OInt":case "OGetScope":case "OBreakPointLine":case "OUnknown":case "OCallStack":case "OConstruct":case "OConstructSuper":case "OApplyType":case "OObject":case "OArray":case "OGetSlot":case "OSetSlot":case "OGetGlobalSlot":case "OSetGlobalSlot":{
		$v = Std::parseInt($o->get("v"));
		$__op = _hx_string_or_null($o->get_nodeName()) . "(" . _hx_string_rec($v, "") . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($v)));
	}break;
	case "ORegKill":{
		$v = Std::parseInt($o->get("v"));
		$__op = _hx_string_or_null($o->get_nodeName()) . "(" . _hx_string_rec($v, "") . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($v)));
	}break;
	case "OSetReg":{
		if($__hx__this->showBytePos) {
			$__hx__this->buf->add("//" . _hx_string_rec(($__hx__this->ctx->bytepos->n - $__hx__this->lastBytepos), "") . " : \x0A");
		}
		$__hx__this->buf->add("\x09\x09\x09ctx.allocRegister();\x0A");
		$v = Std::parseInt($o->get("v"));
		$__op = _hx_string_or_null($o->get_nodeName()) . "(" . _hx_string_rec($v, "") . ")";
		$__hx__this->ctx->allocRegister();
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($v)));
	}break;
	case "OpAs":case "OpNeg":case "OpIncr":case "OpDecr":case "OpNot":case "OpBitNot":case "OpAdd":case "OpSub":case "OpMul":case "OpDiv":case "OpMod":case "OpShl":case "OpShr":case "OpUShr":case "OpAnd":case "OpOr":case "OpXor":case "OpEq":case "OpPhysEq":case "OpLt":case "OpLte":case "OpGt":case "OpGte":case "OpIs":case "OpIn":case "OpIIncr":case "OpIDecr":case "OpINeg":case "OpIAdd":case "OpISub":case "OpIMul":case "OpMemGet8":case "OpMemGet16":case "OpMemGet32":case "OpMemGetFloat":case "OpMemGetDouble":case "OpMemSet8":case "OpMemSet16":case "OpMemSet32":case "OpMemSetFloat":case "OpMemSetDouble":case "OpSign1":case "OpSign8":case "OpSign16":{
		$__op = "OOp(" . _hx_string_or_null($o->get_nodeName()) . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), "OOp", new _hx_array(array(Type::createEnum(_hx_qtype("format.abc.Operation"), $o->get_nodeName(), null))));
	}break;
	case "OOp":{
		$__op = "OOp(" . _hx_string_or_null($o->get("v")) . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), "OOp", new _hx_array(array(Type::createEnum(_hx_qtype("format.abc.Operation"), $o->get("v"), null))));
	}break;
	case "OCallStatic":{
		$meth = format_abc_Index::Idx(Std::parseInt($o->get("v")));
		$nargs = Std::parseInt($o->get("nargs"));
		$__op = _hx_string_or_null($o->get_nodeName()) . "(Idx(" . _hx_string_rec(Std::parseInt($o->get("v")), "") . "), " . _hx_string_rec($nargs, "") . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($meth, $nargs)));
	}break;
	case "OCallMethod":{
		$__op = _hx_string_or_null($o->get_nodeName()) . "(Idx(" . _hx_string_rec(Std::parseInt($o->get("v")), "") . ")), " . _hx_string_rec(Std::parseInt($o->get("nargs")), "") . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array(Std::parseInt($o->get("v")), Std::parseInt($o->get("nargs")))));
	}break;
	case "OCatch":{
		$start = Std::parseInt($o->get("start"));
		$end = Std::parseInt($o->get("end"));
		$handle = Std::parseInt($o->get("handle"));
		$type = $__hx__this->ctx->type($__hx__this->getImport($o->get("type")));
		$variable = $__hx__this->ctx->type($__hx__this->getImport($o->get("variable")));
		$f->trys->push(_hx_anonymous(array("start" => $start, "end" => $end, "handle" => $handle, "type" => $type, "variable" => $variable)));
		$__hx__this->buf->add("\x09\x09\x09f.trys.push( { start:" . _hx_string_rec($start, "") . ", end:" . _hx_string_rec($end, "") . ", handle:" . _hx_string_rec($handle, "") . ",  type:ctx.type(\"" . _hx_string_or_null($__hx__this->getImport($o->get("type"))) . "\"), variable:ctx.type(\"" . _hx_string_or_null($__hx__this->getImport($o->get("variable"))) . "\")});\x0A");
		$__op = _hx_string_or_null($o->get_nodeName()) . "(" . _hx_string_rec((_hx_len($f->trys) - 1), "") . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array(_hx_len($f->trys) - 1)));
	}break;
	case "OJump":{
		$jumpName = $o->get("name");
		$out = null;
		if($jumpName !== null) {
			$jumpFunc = $__hx__this->jumps->get($jumpName);
			call_user_func($jumpFunc);
			if($__hx__this->showBytePos) {
				$__hx__this->buf->add("//" . _hx_string_rec(($__hx__this->ctx->bytepos->n - $__hx__this->lastBytepos), "") . " : \x0A");
			}
			$__hx__this->buf->add("\x09\x09\x09" . _hx_string_or_null($jumpName) . "();\x0A");
			if($__hx__this->log) {
				$__hx__this->logStack("OJump name=" . _hx_string_or_null($jumpName));
			}
		} else {
			$j = Type::createEnum(_hx_qtype("format.abc.JumpStyle"), $o->get("jump"), new _hx_array(array()));
			$offset = Std::parseInt($o->get("offset"));
			$__op = _hx_string_or_null($o->get_nodeName()) . "(" . _hx_string_or_null($o->get("jump")) . "," . _hx_string_rec($offset, "") . ")";
			$out = Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($j, $offset)));
		}
		return $out;
	}break;
	case "JNotLt":case "JNotLte":case "JNotGt":case "JNotGte":case "JAlways":case "JTrue":case "JFalse":case "JEq":case "JNeq":case "JLt":case "JLte":case "JGt":case "JGte":case "JPhysEq":case "JPhysNeq":{
		$jump = Type::createEnum(_hx_qtype("format.abc.JumpStyle"), $o->get_nodeName(), null);
		$__op = $o->get_nodeName();
		$jumpName = $o->get("jump");
		$labelName = $o->get("label");
		$out = null;
		if($jumpName !== null) {
			if($__hx__this->showBytePos) {
				$__hx__this->buf->add("//" . _hx_string_rec(($__hx__this->ctx->bytepos->n - $__hx__this->lastBytepos), "") . " : \x0A");
			}
			$__hx__this->buf->add("\x09\x09\x09var " . _hx_string_or_null($jumpName) . " = ctx.jump(" . _hx_string_or_null($__op) . ");\x0A");
			$__hx__this->jumps->set($jumpName, $__hx__this->ctx->jump($jump));
		} else {
			if($labelName !== null) {
				if($__hx__this->showBytePos) {
					$__hx__this->buf->add("//" . _hx_string_rec(($__hx__this->ctx->bytepos->n - $__hx__this->lastBytepos), "") . " : \x0A");
				}
				$__hx__this->buf->add("\x09\x09\x09" . _hx_string_or_null($labelName) . "(" . _hx_string_or_null($__op) . ");\x0A");
				call_user_func_array($__hx__this->labels->get($labelName), array($jump));
			}
		}
		$__hx__this->updateStacks(format_abc_OpCode::OJump($jump, 0));
		return $out;
	}break;
	case "OLabel":{
		if($o->get("name") !== null) {
			if($__hx__this->log) {
				$__hx__this->logStack("OLabel name=" . _hx_string_or_null($o->get("name")));
				$__hx__this->updateStacks(format_abc_OpCode::$OLabel);
			}
			$__hx__this->labels->set($o->get("name"), $__hx__this->ctx->backwardJump());
			if($__hx__this->showBytePos) {
				$__hx__this->buf->add("//" . _hx_string_rec(($__hx__this->ctx->bytepos->n - $__hx__this->lastBytepos), "") . " : \x0A");
			}
			$__hx__this->buf->add("\x09\x09\x09var " . _hx_string_or_null($o->get("name")) . "= ctx.backwardJump();\x0A");
			return null;
		} else {
			$__op = $o->get_nodeName();
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array()));
		}
	}break;
	case "OSwitch":{
		$arr = _hx_explode(",", _hx_explode("]", _hx_explode("[", $o->get("deltas"))->join(""))->join(""));
		$deltas = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $arr->length) {
				$i = $arr[$_g];
				++$_g;
				$deltas->push(Std::parseInt($i));
				unset($i);
			}
		}
		$__deltas = $deltas->toString();
		$__op = _hx_string_or_null($o->get_nodeName()) . "(" . _hx_string_rec(Std::parseInt($o->get("default")), "") . ", " . _hx_string_or_null($__deltas) . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array(Std::parseInt($o->get("default")), $deltas)));
	}break;
	case "OSwitch2":{
		$def = $o->get("default");
		$_def = 0;
		$__def = "";
		if(StringTools::startsWith($def, "label")) {
			$_def = call_user_func_array($__hx__this->labels->get($def), array(null));
			$__def = _hx_string_or_null($def) . "()";
		} else {
			$__hx__this->switches->set($def, $__hx__this->ctx->switchDefault());
			$__hx__this->buf->add("\x09\x09\x09var " . _hx_string_or_null($def) . " = ctx.switchDefault();\x0A");
			$__def = $_def;
		}
		$arr = _hx_explode(",", _hx_explode(" ", _hx_explode("]", _hx_explode("[", $o->get("deltas"))->join(""))->join(""))->join(""));
		$offsets = new _hx_array(array());
		$__offsets = new _hx_array(array());
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(StringTools::startsWith($arr[$i], "label")) {
					$offsets->push(call_user_func_array($__hx__this->labels->get($arr[$i]), array(null)));
					$__offsets->push(_hx_string_or_null($arr[$i]) . "()");
				} else {
					$__hx__this->buf->add("\x09\x09\x09var " . _hx_string_or_null($arr[$i]) . " = ctx.switchCase(" . _hx_string_rec($i, "") . ");\x0A");
					$__hx__this->switches->set($arr[$i], $__hx__this->ctx->switchCase($i));
					$offsets->push(0);
					$__offsets->push($_def);
				}
				unset($i);
			}
		}
		$__op = "OSwitch(" . Std::string($__def) . "," . Std::string($__offsets) . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), "OSwitch", new _hx_array(array($_def, $offsets)));
	}break;
	case "OCase":{
		$out = null;
		$jumpName = $o->get("name");
		$jumpFunc = $__hx__this->switches->get($jumpName);
		call_user_func($jumpFunc);
		$__hx__this->buf->add("\x09\x09\x09" . _hx_string_or_null($jumpName) . "();\x0A");
		return $out;
	}break;
	case "ONext":{
		$__op = _hx_string_or_null($o->get_nodeName()) . "(" . _hx_string_rec(Std::parseInt($o->get("v1")), "") . "," . _hx_string_rec(Std::parseInt($o->get("v2")), "") . ")";
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array(Std::parseInt($o->get("v1")), Std::parseInt($o->get("v2")))));
	}break;
	case "ODebugReg":{
		if($__hx__this->debugInfo) {
			$__op = _hx_string_or_null($o->get_nodeName()) . "(ctx.string('" . _hx_string_or_null($o->get("name")) . "')," . _hx_string_rec(Std::parseInt($o->get("r")), "") . "," . _hx_string_rec(Std::parseInt($o->get("line")), "") . ")";
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->string($o->get("name")), Std::parseInt($o->get("r")), Std::parseInt($o->get("line")))));
		}
	}break;
	default:{
		throw new HException(_hx_string_or_null($o->get_nodeName()) . " Unknown opcode.");
	}break;
	}
}
function be_haxer_hxswfml_HxmWriter_8(&$__hx__this, &$__args, &$_args, &$_return, &$args, &$functionType, &$isInterface, &$node) {
	if($node->get("return") === "" || $node->get("return") === null) {
		return "ctx.type('*')";
	} else {
		return "ctx.type('" . _hx_string_or_null($__hx__this->getImport($node->get("return"))) . "')";
	}
}
function be_haxer_hxswfml_HxmWriter_9(&$__hx__this, &$__args, &$__defaultParameters, &$__return, &$_args, &$_defaultParameters, &$_return, &$args, &$defaultParameters, &$functionType, &$isInterface, &$node) {
	if($__defaultParameters->length === 0) {
		return "null";
	} else {
		return "[" . _hx_string_or_null($__defaultParameters->join(",")) . "]";
	}
}
function be_haxer_hxswfml_HxmWriter_10(&$__hx__this, &$___defaultParameters, &$__args, &$__debugName, &$__defaultParameters, &$__extra, &$__ns, &$__return, &$_args, &$_defaultParameters, &$_final, &$_later, &$_override, &$_return, &$_static, &$args, &$defaultParameters, &$extra, &$f, &$functionType, &$isInterface, &$node, &$ns) {
	switch($node->get("kind")) {
	case "normal":{
		return format_abc_MethodKind::$KNormal;
	}break;
	case "set":case "setter":{
		return format_abc_MethodKind::$KSetter;
	}break;
	case "get":case "getter":{
		return format_abc_MethodKind::$KGetter;
	}break;
	default:{
		return format_abc_MethodKind::$KNormal;
	}break;
	}
}
function be_haxer_hxswfml_HxmWriter_11(&$__hx__this, &$_classNode, &$_const, &$_extends, &$cl, &$ctx, &$ctx_xml, &$isI, &$isStatic, &$member, &$name, &$ns, &$slot, &$statics, &$type, &$value, &$xml) {
	if($value === null) {
		return null;
	} else {
		switch($type) {
		case "String":{
			return format_abc_Value::VString($ctx->string($value));
		}break;
		case "int":{
			return format_abc_Value::VInt($ctx->int(Std::parseInt($value)));
		}break;
		case "uint":{
			return format_abc_Value::VUInt($ctx->uint(Std::parseInt($value)));
		}break;
		case "Number":{
			return format_abc_Value::VFloat($ctx->float(Std::parseFloat($value)));
		}break;
		case "Boolean":{
			return format_abc_Value::VBool($value === "true");
		}break;
		default:{
			return null;
		}break;
		}
	}
}
function be_haxer_hxswfml_HxmWriter_12(&$__hx__this, &$_classNode, &$_const, &$_extends, &$_value, &$cl, &$ctx, &$ctx_xml, &$isI, &$isStatic, &$member, &$name, &$ns, &$slot, &$statics, &$type, &$value, &$xml) {
	if($value === null) {
		return "null";
	} else {
		switch($type) {
		case "String":{
			return "VString(ctx.string('" . _hx_string_or_null($value) . "'))";
		}break;
		case "int":{
			return "VInt(ctx.int(" . _hx_string_rec(Std::parseInt($value), "") . "))";
		}break;
		case "uint":{
			return "VUInt(ctx.uint(" . _hx_string_rec(Std::parseInt($value), "") . "))";
		}break;
		case "Number":{
			return "VFloat(ctx.float(" . _hx_string_rec(Std::parseFloat($value), "") . "))";
		}break;
		case "Boolean":{
			return "VBool(" . Std::string($value === "true") . ")";
		}break;
		default:{
			return "null";
		}break;
		}
	}
}
function be_haxer_hxswfml_HxmWriter_13(&$__hx__this, &$_g, &$_g1, &$cn, &$fo, &$folders, &$i, &$initName, &$path, &$start, &$txt, &$zip, &$zipFileSystem, &$zipdata) {
	if($folders->length === 0) {
		return "";
	} else {
		return _hx_string_or_null($folders->join("_.")) . "_.";
	}
}
function be_haxer_hxswfml_HxmWriter_14(&$__hx__this, &$_g, &$_g1, &$cf, &$cn, &$fo, &$folders, &$i, &$initName, &$p1, &$path, &$start, &$txt, &$zip, &$zipFileSystem, &$zipdata) {
	if($folders->length === 0) {
		return "";
	} else {
		return _hx_string_or_null($folders->join("_/")) . "_/";
	}
}
function be_haxer_hxswfml_HxmWriter_15(&$__hx__this, &$_g, &$_g1, &$cf, &$cn, &$fo, &$folders, &$i, &$initName, &$p1, &$p2, &$path, &$start, &$txt, &$zip, &$zipFileSystem, &$zipdata) {
	if($folders->length === 0) {
		return "";
	} else {
		return _hx_string_or_null($folders->join("_.")) . "_";
	}
}
function be_haxer_hxswfml_HxmWriter_16(&$__hx__this, &$__op, &$f, &$member, &$o, &$op) {
	{
		$__hx__this->debugFileName = _hx_explode(";;", _hx_explode("\\", $o->get("v"))->join("/"))->join("/");
		$__hx__this->debugLines = new _hx_array(array());
		if($__hx__this->sourceInfo) {
			if(file_exists($__hx__this->debugFileName)) {
				$str = sys_io_File::getContent($__hx__this->debugFileName);
				$str = be_haxer_hxswfml_HxmWriter_18($__hx__this, $__op, $f, $member, $o, $op, $str);
				$__hx__this->debugLines = _hx_explode("\x0A", $str);
				{
					$_g1 = 0; $_g = $__hx__this->debugLines->length;
					while($_g1 < $_g) {
						$i = $_g1++;
						$__hx__this->debugLines[$i] = _hx_explode("\x0A", (be_haxer_hxswfml_HxmWriter_19($__hx__this, $__op, $_g, $_g1, $f, $i, $member, $o, $op, $str)))->join("");
						unset($i);
					}
				}
			} else {
			}
		}
		$out = be_haxer_hxswfml_HxmWriter_20($__hx__this, $__op, $f, $member, $o, $op);
		return $out;
	}
}
function be_haxer_hxswfml_HxmWriter_17(&$__hx__this, &$__op, &$f, &$member, &$o, &$op) {
	{
		$__hx__this->debugFileName = _hx_explode(";;", _hx_explode("\\", $o->get("v"))->join("/"))->join("/");
		$__hx__this->debugLines = new _hx_array(array());
		if($__hx__this->sourceInfo) {
			if(file_exists($__hx__this->debugFileName)) {
				$str = sys_io_File::getContent($__hx__this->debugFileName);
				$str = be_haxer_hxswfml_HxmWriter_21($__hx__this, $__op, $f, $member, $o, $op, $str);
				$__hx__this->debugLines = _hx_explode("\x0A", $str);
				{
					$_g1 = 0; $_g = $__hx__this->debugLines->length;
					while($_g1 < $_g) {
						$i = $_g1++;
						$__hx__this->debugLines[$i] = _hx_explode("\x0A", (be_haxer_hxswfml_HxmWriter_22($__hx__this, $__op, $_g, $_g1, $f, $i, $member, $o, $op, $str)))->join("");
						unset($i);
					}
				}
			} else {
			}
		}
		$out = be_haxer_hxswfml_HxmWriter_23($__hx__this, $__op, $f, $member, $o, $op);
		return $out;
	}
}
function be_haxer_hxswfml_HxmWriter_18(&$__hx__this, &$__op, &$f, &$member, &$o, &$op, &$str) {
	{
		$out = _hx_explode("\x0D\x0A", $str)->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_HxmWriter_19(&$__hx__this, &$__op, &$_g, &$_g1, &$f, &$i, &$member, &$o, &$op, &$str) {
	{
		$out = _hx_explode("\x0D\x0A", $__hx__this->debugLines[$i])->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_HxmWriter_20(&$__hx__this, &$__op, &$f, &$member, &$o, &$op) {
	if($__hx__this->debugFileName === "<null>") {
		return "";
	} else {
		return $__hx__this->debugFileName;
	}
}
function be_haxer_hxswfml_HxmWriter_21(&$__hx__this, &$__op, &$f, &$member, &$o, &$op, &$str) {
	{
		$out = _hx_explode("\x0D\x0A", $str)->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_HxmWriter_22(&$__hx__this, &$__op, &$_g, &$_g1, &$f, &$i, &$member, &$o, &$op, &$str) {
	{
		$out = _hx_explode("\x0D\x0A", $__hx__this->debugLines[$i])->join("\x0A");
		return _hx_explode("\x0D", $out)->join("\x0A");
	}
}
function be_haxer_hxswfml_HxmWriter_23(&$__hx__this, &$__op, &$f, &$member, &$o, &$op) {
	if($__hx__this->debugFileName === "<null>") {
		return "";
	} else {
		return $__hx__this->debugFileName;
	}
}
