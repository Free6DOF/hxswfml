<?php

class be_haxer_hxswfml_AbcWriter {
	public function __construct() {
		;
	}
	public function logStack($msg) {
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
		}break;
		case 3:
		$v = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			++$this->currentStack;
		}break;
		case 4:
		$v = $__hx__t->params[0];
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
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
		}break;
		case 17:
		{
			if(--$this->currentScopeStack < 0) {
				$this->scopeStackError($opc, 0);
			}
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
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 21:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 22:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 23:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 24:
		$v = $__hx__t->params[0];
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
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
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
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 29:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 30:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack += 2;
		}break;
		case 31:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 32:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 33:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 34:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 35:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentScopeStack++;
			$this->maxScopeStack++;
		}break;
		case 36:
		$v = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 37:
		$r2 = $__hx__t->params[1]; $r1 = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 38:
		$f = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 39:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 40:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 41:
		$n = $__hx__t->params[1]; $s = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 42:
		$n = $__hx__t->params[1]; $m = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 43:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 44:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 45:
		{
		}break;
		case 46:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 47:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 48:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 49:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 50:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 51:
		$n = $__hx__t->params[1]; $p = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n + 1) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 52:
		$n = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 53:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n * 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 54:
		$n = $__hx__t->params[0];
		{
			if(($this->currentStack -= $n) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 55:
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 56:
		$c = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 57:
		$i = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 58:
		$c = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 59:
		$p = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 60:
		$p = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
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
		}break;
		case 64:
		$r = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
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
		}break;
		case 67:
		$n = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
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
		}break;
		case 69:
		$p = $__hx__t->params[0];
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 70:
		$p = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 71:
		$s = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 72:
		$s = $__hx__t->params[0];
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
		}break;
		case 73:
		$s = $__hx__t->params[0];
		{
			if(++$this->currentStack > $this->maxStack) {
				$this->maxStack++;
			}
		}break;
		case 74:
		$s = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
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
		$t = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 85:
		{
			if($this->currentStack === 0) {
			} else {
				if(--$this->currentStack < 0) {
					$this->stackError($opc, 0);
				}
			}
			$this->currentStack++;
		}break;
		case 86:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 87:
		$t = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
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
		}break;
		case 92:
		{
			if(($this->currentStack -= 2) < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
		}break;
		case 93:
		$t = $__hx__t->params[0];
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
			$this->currentStack++;
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
		}break;
		case 97:
		{
			if(--$this->currentStack < 0) {
				$this->stackError($opc, 0);
			}
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
			$this->logStack("bytepos:" . _hx_string_rec(($this->ctx->bytepos->n - $this->lastBytepos), ""));
			$this->logStack(Std::string($opc));
			$this->logStack("currentStack= " . _hx_string_rec($this->currentStack, "") . ", maxStack= " . _hx_string_rec($this->maxStack, "") . "\x0AcurrentScopeStack= " . _hx_string_rec($this->currentScopeStack, "") . ", maxScopeStack= " . _hx_string_rec($this->maxScopeStack, "") . "\x0A\x0A");
		}
	}
	public function urlDecode($str) {
		return _hx_explode("\\u001b", _hx_explode("\\n", _hx_explode("\\r", _hx_explode("\\t", _hx_explode("&lt;", _hx_explode("&quot;", _hx_explode("&amp;", $str)->join("&"))->join("\""))->join("<"))->join("\x09"))->join("\x0D"))->join("\x0A"))->join("\x1B");
	}
	public function scopeStackError($op, $type) {
		$o = Type::getEnum($op);
		$msg = be_haxer_hxswfml_AbcWriter_0($this, $o, $op, $type);
		if($this->strict) {
			throw new HException($msg);
		}
		if($this->log) {
			$this->logStack($msg);
		}
	}
	public function stackError($op, $type) {
		$o = Type::getEnum($op);
		$msg = be_haxer_hxswfml_AbcWriter_1($this, $o, $op, $type);
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
	public function NamespaceType($ns) {
		return $this->ctx->_namespace(be_haxer_hxswfml_AbcWriter_2($this, $ns));
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
				$this->logStack("------------------------------------------------\x0Afunction= " . _hx_string_or_null($this->functionClosureName) . "\x0AcurrentStack= " . _hx_string_rec($this->currentStack, "") . ", maxStack= " . _hx_string_rec($this->maxStack, "") . "\x0AcurrentScopeStack= " . _hx_string_rec($this->currentScopeStack, "") . ", maxScopeStack= " . _hx_string_rec($this->maxScopeStack, "") . "\x0A\x0A");
			} else {
				$this->logStack("------------------------------------------------\x0Acurrent class= " . _hx_string_or_null($this->className) . ", method= " . _hx_string_or_null($member->get("name")) . "\x0AcurrentStack= " . _hx_string_rec($this->currentStack, "") . ", maxStack= " . _hx_string_rec($this->maxStack, "") . "\x0AcurrentScopeStack= " . _hx_string_rec($this->currentScopeStack, "") . ", maxScopeStack= " . _hx_string_rec($this->maxScopeStack, "") . "\x0A\x0A");
			}
		}
		$this->lastBytepos = $this->ctx->bytepos->n;
		if(null == $member) throw new HException('null iterable');
		$__hx__it = $member->elements();
		while($__hx__it->hasNext()) {
			$o = $__hx__it->next();
			$op = null;
			$op = be_haxer_hxswfml_AbcWriter_3($this, $f, $member, $o, $op);
			if($op !== null) {
				$this->updateStacks($op);
				$this->ctx->op($op);
			}
			unset($op);
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
		if($_args === null || $_args === "") {
			$args = new _hx_array(array());
		} else {
			$_g = 0; $_g1 = _hx_explode(",", $_args);
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				$args->push($this->ctx->type($this->getImport($i)));
				unset($i);
			}
		}
		$_return = (($node->get("return") === "" || $node->get("return") === null) ? $this->ctx->type("*") : $this->ctx->type($this->getImport($node->get("return"))));
		$_defaultParameters = null;
		$defaultParameters = $node->get("defaultParameters");
		if($defaultParameters !== null) {
			$values = _hx_explode(",", $defaultParameters);
			$_defaultParameters = new _hx_array(array());
			{
				$_g1 = 0; $_g = $values->length;
				while($_g1 < $_g) {
					$v = $_g1++;
					if($values[$v] === "") {
						$_defaultParameters->push(null);
					} else {
						$pair = _hx_explode(":", $values[$v]);
						$v1 = $pair[0];
						$t = $pair[1];
						$_value = be_haxer_hxswfml_AbcWriter_4($this, $_args, $_defaultParameters, $_g, $_g1, $_return, $args, $defaultParameters, $functionType, $isInterface, $node, $pair, $t, $v, $v1, $values);
						$_defaultParameters->push($_value);
						unset($v1,$t,$pair,$_value);
					}
					unset($v);
				}
			}
		}
		$extra = _hx_anonymous(array("native" => $node->get("native") === "true", "variableArgs" => $node->get("variableArgs") === "true", "argumentsDefined" => $node->get("argumentsDefined") === "true", "usesDXNS" => $node->get("usesDXNS") === "true", "newBlock" => $node->get("newBlock") === "true", "unused" => $node->get("unused") === "true", "debugName" => (($node->get("debugName") === null) ? $this->ctx->string(null) : $this->ctx->string($node->get("debugName"))), "defaultParameters" => $_defaultParameters, "paramNames" => null));
		$ns = $this->NamespaceType($node->get("ns"));
		$f = null;
		if($functionType === "function") {
			$this->ctx->beginFunction($args, $_return, $extra);
			$f = $this->ctx->curFunction->f;
			$name = $node->get("f");
			$this->functionClosureName = $name;
			$this->functionClosures->set($name, $f->type);
		} else {
			if($functionType === "method") {
				$_static = $node->get("static") === "true";
				$_override = $node->get("override") === "true";
				$_final = $node->get("final") === "true";
				$_later = $node->get("later") === "true";
				$kind = be_haxer_hxswfml_AbcWriter_5($this, $_args, $_defaultParameters, $_final, $_later, $_override, $_return, $_static, $args, $defaultParameters, $extra, $f, $functionType, $isInterface, $node, $ns);
				if($node->get("name") === $this->className) {
					if($_static === true) {
						$this->ctx->beginFunction($args, $_return, $extra);
						$f = $this->ctx->curFunction->f;
						$this->curClass->statics = $f->type;
					} else {
						if($isInterface) {
							$f = $this->ctx->beginInterfaceMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, true, $kind, $extra, $ns);
							$this->curClass->constructor = $f->type;
							return $f;
						} else {
							$f = $this->ctx->beginMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, true, $kind, $extra, $ns);
							$this->curClass->constructor = $f->type;
						}
					}
				} else {
					if($isInterface) {
						$f1 = $this->ctx->beginInterfaceMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, $_later, $kind, $extra, $ns);
						return $f1;
					} else {
						$f = $this->ctx->beginMethod($this->getImport($node->get("name")), $args, $_return, $_static, $_override, $_final, $_later, $kind, $extra, $ns);
					}
				}
			} else {
				if($functionType === "init") {
					$this->ctx->beginFunction($args, $_return, $extra);
					$f = $this->ctx->curFunction->f;
					$name = $this->getImport($node->get("name"));
					$this->inits->set($name, $f->type);
				}
			}
		}
		if($node->get("locals") !== null) {
			$locals = $this->parseLocals($node->get("locals"));
			if($locals->length !== 0) {
				$f->locals = $locals;
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
		if($node->get("nRegs") !== null) {
			$f->nRegs = Std::parseInt($node->get("nRegs"));
		}
		if($this->currentStack > 0) {
			$this->nonEmptyStack($node->get("name"));
		}
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
		$this->functionClosures = new haxe_ds_StringMap();
		$this->inits = new haxe_ds_StringMap();
		$this->classDefs = new haxe_ds_StringMap();
		$this->classNames = new _hx_array(array());
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
		if(null == $ctx_xml) throw new HException('null iterable');
		$__hx__it = $ctx_xml->elements();
		while($__hx__it->hasNext()) {
			$_classNode = $__hx__it->next();
			switch(strtolower($_classNode->get_nodeName())) {
			case "import":{
				$n = $_classNode->get("name");
				$cn = _hx_explode(".", $n)->pop();
				$this->imports->set($cn, $n);
			}break;
			case "function":case "init":{
			}break;
			case "class":case "interface":{
				$this->className = $_classNode->get("name");
				$this->classNames->push($this->className);
				$cl = $ctx->beginClass($this->className, $_classNode->get("interface") === "true");
				$this->curClass = $cl;
				$this->classDefs->set($this->className, $ctx->getClass($cl));
				$this->curClassName = _hx_explode(".", $this->className)->pop();
				if($_classNode->get("implements") !== null) {
					$cl->interfaces = new _hx_array(array());
					{
						$_g = 0; $_g1 = _hx_explode(",", $_classNode->get("implements"));
						while($_g < $_g1->length) {
							$i = $_g1[$_g];
							++$_g;
							$cl->interfaces->push($ctx->type($this->getImport($i)));
							unset($i);
						}
					}
				}
				$cl->isFinal = $_classNode->get("final") === "true";
				$cl->isInterface = $_classNode->get("interface") === "true";
				$cl->isSealed = $_classNode->get("sealed") === "true";
				$_extends = $_classNode->get("extends");
				$ctx->isExtending = false;
				if($_extends !== null) {
					if($_extends !== "Object") {
						$ctx->isExtending = true;
					}
					$cl->superclass = $ctx->type($this->getImport($_extends));
					$ctx->addClassSuper($this->getImport($_extends));
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
						$ns = $this->NamespaceType($member->get("ns"));
						$slot = Std::parseInt($member->get("slot"));
						$_value = be_haxer_hxswfml_AbcWriter_6($this, $_classNode, $_const, $_extends, $cl, $ctx, $ctx_xml, $isStatic, $member, $name, $ns, $slot, $statics, $type, $value, $xml);
						$ctx->defineField($name, $ctx->type($this->getImport($type)), $isStatic, $_value, $_const, $ns, $slot);
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
					$ctx->endClass(false);
				} else {
					$ctx->endClass(null);
				}
			}break;
			default:{
				throw new HException("<" . _hx_string_or_null($_classNode->get_nodeName()) . "> Must be <function>, <init>, <import> or <class [<var>], [<function>]>.");
			}break;
			}
		}
		$abcOutput = new haxe_io_BytesOutput();
		$abcWriter = new format_abc_Writer($abcOutput);
		$abcWriter->write($ctx->getData());
		return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => _hx_explode(".", $this->className)->join("/"))));
	}
	public function abc2swf($data) {
		$abcReader = new format_abc_Reader(new haxe_io_BytesInput($data, null, null));
		$abcFile = $abcReader->read();
		$inits = $abcFile->inits;
		$init = $inits->pop();
		$fields = $init->fields;
		$className = "";
		{
			$_g = 0;
			while($_g < $fields->length) {
				$f = $fields[$_g];
				++$_g;
				$__hx__t = ($f->kind);
				switch($__hx__t->index) {
				case 2:
				$c = $__hx__t->params[0];
				{
					$iName = _hx_array_get($abcFile->classes, _hx_array_get(Type::enumParameters($c), 0))->name;
					$name = $abcFile->get($abcFile->names, $iName);
					$__hx__t2 = ($name);
					switch($__hx__t2->index) {
					case 0:
					$ns = $__hx__t2->params[1]; $id = $__hx__t2->params[0];
					{
						$this->classNames = new _hx_array(array($abcFile->get($abcFile->strings, $id)));
					}break;
					default:{
					}break;
					}
				}break;
				default:{
				}break;
				}
				unset($f);
			}
		}
		$this->swfTags = new _hx_array(array(format_swf_SWFTag::TActionScript3($data, _hx_anonymous(array("id" => 1, "label" => $className)))));
	}
	public function getSWC($className = null) {
		$swfFile = _hx_anonymous(array("header" => _hx_anonymous(array("version" => 10, "compressed" => true, "width" => 500, "height" => 400, "fps" => 30, "nframes" => 1)), "tags" => new _hx_array(array())));
		$swfFile->tags->push(format_swf_SWFTag::TSandBox(_hx_anonymous(array("useDirectBlit" => false, "useGPU" => false, "hasMetaData" => false, "actionscript3" => true, "useNetWork" => false))));
		{
			$_g = 0; $_g1 = $this->swfTags;
			while($_g < $_g1->length) {
				$t = $_g1[$_g];
				++$_g;
				$swfFile->tags->push($t);
				unset($t);
			}
		}
		$swfFile->tags->push(format_swf_SWFTag::TSymbolClass(new _hx_array(array(_hx_anonymous(array("cid" => 0, "className" => (($className !== null) ? $className : $this->classNames->pop())))))));
		$swfFile->tags->push(format_swf_SWFTag::$TShowFrame);
		$swfOutput = new haxe_io_BytesOutput();
		$writer = new format_swf_Writer($swfOutput);
		$writer->write($swfFile);
		$library = $swfOutput->getBytes();
		$swcWriter = new be_haxer_hxswfml_SwcWriter();
		$swcWriter->write($this->swcClasses, $library);
		$swc = $swcWriter->getSWC();
		return $swc;
	}
	public function getSWF($className = null, $version = null, $compressed = null, $width = null, $height = null, $fps = null, $nframes = null) {
		if($nframes === null) {
			$nframes = 1;
		}
		if($fps === null) {
			$fps = 30;
		}
		if($height === null) {
			$height = 600;
		}
		if($width === null) {
			$width = 800;
		}
		if($compressed === null) {
			$compressed = true;
		}
		if($version === null) {
			$version = 10;
		}
		$swfFile = _hx_anonymous(array("header" => _hx_anonymous(array("version" => $version, "compressed" => $compressed, "width" => $width, "height" => $height, "fps" => $fps, "nframes" => $nframes)), "tags" => new _hx_array(array())));
		$swfFile->tags->push(format_swf_SWFTag::TSandBox(_hx_anonymous(array("useDirectBlit" => false, "useGPU" => false, "hasMetaData" => false, "actionscript3" => true, "useNetWork" => false))));
		$swfFile->tags->push(format_swf_SWFTag::TScriptLimits(1000, 60));
		{
			$_g = 0; $_g1 = $this->swfTags;
			while($_g < $_g1->length) {
				$t = $_g1[$_g];
				++$_g;
				$swfFile->tags->push($t);
				unset($t);
			}
		}
		$swfFile->tags->push(format_swf_SWFTag::TSymbolClass(new _hx_array(array(_hx_anonymous(array("cid" => 0, "className" => (($className !== null) ? $className : $this->classNames->pop())))))));
		$swfFile->tags->push(format_swf_SWFTag::$TShowFrame);
		$swfOutput = new haxe_io_BytesOutput();
		$writer = new format_swf_Writer($swfOutput);
		$writer->write($swfFile);
		return $swfOutput->getBytes();
	}
	public function getABC() {
		if($this->swfTags->length > 1) {
			return _hx_array_get(Type::enumParameters($this->swfTags[0]), 0);
		} else {
			return _hx_array_get(Type::enumParameters($this->swfTags[0]), 0);
		}
	}
	public function getTags() {
		return $this->swfTags;
	}
	public function write($xml) {
		$this->swfTags = new _hx_array(array());
		$this->swcClasses = new _hx_array(array());
		$this->lastBytepos = 0;
		$root = Xml::parse($xml);
		if($root === null) {
			throw new HException("Invalid input xml");
		}
		$abcfiles = $root->firstElement();
		if($abcfiles === null) {
			throw new HException("Invalid input xml");
		}
		if(strtolower($abcfiles->get_nodeName()) === "abcfile") {
			$this->swfTags->push($this->xml2abc($abcfiles));
		} else {
			if(strtolower($abcfiles->get_nodeName()) === "abcfiles") {
				if(null == $abcfiles) throw new HException('null iterable');
				$__hx__it = $abcfiles->elements();
				while($__hx__it->hasNext()) {
					$abcfile = $__hx__it->next();
					$this->swfTags->push($this->xml2abc($abcfile));
				}
			} else {
				throw new HException("Invalid element. Expecting <abcfile> or <abcfiles>");
			}
		}
		return _hx_array_get(Type::enumParameters($this->swfTags[0]), 0);
	}
	public $currentScopeStack;
	public $currentStack;
	public $maxScopeStack;
	public $maxStack;
	public $lastBytepos;
	public $functionClosureName;
	public $swcClasses;
	public $classNames;
	public $curClass;
	public $curClassName;
	public $className;
	public $swfTags;
	public $abcFile;
	public $classDefs;
	public $inits;
	public $functionClosures;
	public $imports;
	public $labels;
	public $switches;
	public $jumps;
	public $ctx;
	public $name;
	public $strict;
	public $log;
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
	static function createABC($className, $baseClass) {
		$ctx = new format_abc_Context();
		$c = $ctx->beginClass($className, false);
		$c->superclass = $ctx->type($baseClass);
		switch($baseClass) {
		case "flash.display.MovieClip":{
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.display.DisplayObject");
			$ctx->addClassSuper("flash.display.InteractiveObject");
			$ctx->addClassSuper("flash.display.DisplayObjectContainer");
			$ctx->addClassSuper("flash.display.Sprite");
			$ctx->addClassSuper("flash.display.MovieClip");
		}break;
		case "flash.display.Sprite":{
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.display.DisplayObject");
			$ctx->addClassSuper("flash.display.InteractiveObject");
			$ctx->addClassSuper("flash.display.DisplayObjectContainer");
			$ctx->addClassSuper("flash.display.Sprite");
		}break;
		case "flash.display.SimpleButton":{
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.display.DisplayObject");
			$ctx->addClassSuper("flash.display.InteractiveObject");
			$ctx->addClassSuper("flash.display.SimpleButton");
		}break;
		case "flash.display.Bitmap":{
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.display.DisplayObject");
			$ctx->addClassSuper("flash.display.Bitmap");
		}break;
		case "flash.media.Sound":{
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.media.Sound");
		}break;
		case "flash.display.BitmapData":{
			$ctx->addClassSuper("flash.display.BitmapData");
		}break;
		case "flash.text.Font":{
			$ctx->addClassSuper("flash.text.Font");
		}break;
		case "flash.utils.ByteArray":{
			$ctx->addClassSuper("flash.utils.ByteArray");
		}break;
		}
		$m = (($baseClass !== "flash.display.BitmapData") ? $ctx->beginMethod($className, new _hx_array(array()), null, false, false, false, true, null, null, null) : $ctx->beginMethod($className, new _hx_array(array($ctx->type("Number"), $ctx->type("Number"))), null, false, false, false, true, null, null, null));
		$m->maxStack = 3;
		$m->maxScope = 1;
		$c->constructor = $m->type;
		$ctx->ops((($baseClass !== "flash.display.BitmapData") ? new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::$OScope, format_abc_OpCode::$OThis, format_abc_OpCode::OConstructSuper(0), format_abc_OpCode::$ORetVoid)) : new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::$OScope, format_abc_OpCode::$OThis, format_abc_OpCode::OReg(1), format_abc_OpCode::OReg(2), format_abc_OpCode::OConstructSuper(2), format_abc_OpCode::$ORetVoid))));
		$ctx->endClass(null);
		$abcOutput = new haxe_io_BytesOutput();
		$abcWriter = new format_abc_Writer($abcOutput);
		$abcWriter->write($ctx->getData());
		return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => $className)));
	}
	function __toString() { return 'be.haxer.hxswfml.AbcWriter'; }
}
function be_haxer_hxswfml_AbcWriter_0(&$__hx__this, &$o, &$op, &$type) {
	if($type === 0) {
		return "!Possible error: scopeStack underflow: " . Std::string($op);
	} else {
		return "!Possible error: scopeStack overflow: " . Std::string($op);
	}
}
function be_haxer_hxswfml_AbcWriter_1(&$__hx__this, &$o, &$op, &$type) {
	if($type === 0) {
		return "!Possible error: stack underflow: " . Std::string($op);
	} else {
		return "!Possible error: stack overflow: " . Std::string($op);
	}
}
function be_haxer_hxswfml_AbcWriter_2(&$__hx__this, &$ns) {
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
	case "Namespace":{
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
function be_haxer_hxswfml_AbcWriter_3(&$__hx__this, &$f, &$member, &$o, &$op) {
	switch($o->get_nodeName()) {
	case "OBreakPoint":case "ONop":case "OThrow":case "ODxNsLate":case "OPushWith":case "OPopScope":case "OForIn":case "OHasNext":case "ONull":case "OUndefined":case "OForEach":case "OTrue":case "OFalse":case "ONaN":case "OPop":case "ODup":case "OSwap":case "OScope":case "ONewBlock":case "ORetVoid":case "ORet":case "OToString":case "OGetGlobalScope":case "OInstanceOf":case "OToXml":case "OToXmlAttr":case "OToInt":case "OToUInt":case "OToNumber":case "OToBool":case "OToObject":case "OCheckIsXml":case "OAsAny":case "OAsString":case "OAsObject":case "OTypeof":case "OThis":case "OSetThis":case "OTimestamp":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), null);
	}break;
	case "ODxNs":case "ODebugFile":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->string($o->get("v")))));
	}break;
	case "OString":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->string($__hx__this->urlDecode($o->get("v"))))));
	}break;
	case "OIntRef":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->int(Std::parseInt($o->get("v"))))));
	}break;
	case "OUIntRef":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->uint(Std::parseInt($o->get("v"))))));
	}break;
	case "OFloat":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->float(Std::parseFloat($o->get("v"))))));
	}break;
	case "ONamespace":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->type($o->get("v")))));
	}break;
	case "OClassDef":{
		if(!$__hx__this->classDefs->exists($o->get("v"))) {
			throw new HException(_hx_string_or_null($o->get("v")) . " must be created as class before referencing it here.");
		} else {
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->classDefs->get($o->get("v")))));
		}
	}break;
	case "OFunction":{
		if(!$__hx__this->functionClosures->exists($o->get("v"))) {
			throw new HException(_hx_string_or_null($o->get("v")) . " must be created as function (closure) before referencing it here.");
		} else {
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->functionClosures->get($o->get("v")))));
		}
	}break;
	case "OGetSuper":case "OSetSuper":case "OGetDescendants":case "OFindPropStrict":case "OFindProp":case "OFindDefinition":case "OGetLex":case "OSetProp":case "OGetProp":case "OInitProp":case "ODeleteProp":case "OCast":case "OAsType":case "OIsType":{
		$v = $o->get("v");
		if($v === "#arrayProp") {
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->arrayProp)));
		} else {
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->type($__hx__this->getImport($v)))));
		}
		unset($v);
	}break;
	case "OCallSuper":case "OCallProperty":case "OConstructProperty":case "OCallPropLex":case "OCallSuperVoid":case "OCallPropVoid":{
		$p = $o->get("v");
		$nargs = Std::parseInt($o->get("nargs"));
		if($p === "#arrayProp") {
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->arrayProp, $nargs)));
		} else {
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->type($__hx__this->getImport($p)), $nargs)));
		}
		unset($p,$nargs);
	}break;
	case "ORegKill":case "OReg":case "OIncrReg":case "ODecrReg":case "OIncrIReg":case "ODecrIReg":case "OSmallInt":case "OInt":case "OGetScope":case "ODebugLine":case "OBreakPointLine":case "OUnknown":case "OCallStack":case "OConstruct":case "OConstructSuper":case "OApplyType":case "OObject":case "OArray":case "OGetSlot":case "OSetSlot":case "OGetGlobalSlot":case "OSetGlobalSlot":{
		$v = Std::parseInt($o->get("v"));
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($v)));
	}break;
	case "OCatch":{
		$start = Std::parseInt($o->get("start"));
		$end = Std::parseInt($o->get("end"));
		$handle = Std::parseInt($o->get("handle"));
		$type = $__hx__this->ctx->type($__hx__this->getImport($o->get("type")));
		$variable = $__hx__this->ctx->type($__hx__this->getImport($o->get("variable")));
		$f->trys->push(_hx_anonymous(array("start" => $start, "end" => $end, "handle" => $handle, "type" => $type, "variable" => $variable)));
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array(_hx_len($f->trys) - 1)));
	}break;
	case "OSetReg":{
		$__hx__this->ctx->allocRegister();
		$v = Std::parseInt($o->get("v"));
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($v)));
	}break;
	case "OpAs":case "OpNeg":case "OpIncr":case "OpDecr":case "OpNot":case "OpBitNot":case "OpAdd":case "OpSub":case "OpMul":case "OpDiv":case "OpMod":case "OpShl":case "OpShr":case "OpUShr":case "OpAnd":case "OpOr":case "OpXor":case "OpEq":case "OpPhysEq":case "OpLt":case "OpLte":case "OpGt":case "OpGte":case "OpIs":case "OpIn":case "OpIIncr":case "OpIDecr":case "OpINeg":case "OpIAdd":case "OpISub":case "OpIMul":case "OpMemGet8":case "OpMemGet16":case "OpMemGet32":case "OpMemGetFloat":case "OpMemGetDouble":case "OpMemSet8":case "OpMemSet16":case "OpMemSet32":case "OpMemSetFloat":case "OpMemSetDouble":case "OpSign1":case "OpSign8":case "OpSign16":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), "OOp", new _hx_array(array(Type::createEnum(_hx_qtype("format.abc.Operation"), $o->get_nodeName(), null))));
	}break;
	case "OOp":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), "OOp", new _hx_array(array(Type::createEnum(_hx_qtype("format.abc.Operation"), $o->get("v"), null))));
	}break;
	case "OCallStatic":{
		$meth = format_abc_Index::Idx(Std::parseInt($o->get("v")));
		$nargs = Std::parseInt($o->get("nargs"));
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($meth, $nargs)));
	}break;
	case "OCallMethod":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array(Std::parseInt($o->get("v")), Std::parseInt($o->get("nargs")))));
	}break;
	case "JNotLt":case "JNotLte":case "JNotGt":case "JNotGte":case "JAlways":case "JTrue":case "JFalse":case "JEq":case "JNeq":case "JLt":case "JLte":case "JGt":case "JGte":case "JPhysEq":case "JPhysNeq":{
		$jump = Type::createEnum(_hx_qtype("format.abc.JumpStyle"), $o->get_nodeName(), null);
		$jumpName = $o->get("jump");
		$labelName = $o->get("label");
		$out = null;
		if($jumpName !== null) {
			$__hx__this->jumps->set($jumpName, $__hx__this->ctx->jump($jump));
		} else {
			if($labelName !== null) {
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
			return null;
		} else {
			return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array()));
		}
	}break;
	case "OJump":{
		$jumpName = $o->get("name");
		$out = null;
		if($jumpName !== null) {
			$jumpFunc = $__hx__this->jumps->get($jumpName);
			call_user_func($jumpFunc);
			if($__hx__this->log) {
				$__hx__this->logStack("OJump name=" . _hx_string_or_null($jumpName));
			}
		} else {
			$j = Type::createEnum(_hx_qtype("format.abc.JumpStyle"), $o->get("jump"), new _hx_array(array()));
			$offset = Std::parseInt($o->get("offset"));
			$out = Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($j, $offset)));
		}
		return $out;
	}break;
	case "OSwitch":{
		$def = Std::parseInt($o->get("default"));
		$arr = _hx_explode(",", _hx_explode(" ", _hx_explode("]", _hx_explode("[", $o->get("deltas"))->join(""))->join(""))->join(""));
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
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($def, $deltas)));
	}break;
	case "OSwitch2":{
		$def = $o->get("default");
		$_def = 0;
		if(StringTools::startsWith($def, "label")) {
			$_def = call_user_func_array($__hx__this->labels->get($def), array(null));
		} else {
			$__hx__this->switches->set($def, $__hx__this->ctx->switchDefault());
		}
		$arr = _hx_explode(",", _hx_explode(" ", _hx_explode("]", _hx_explode("[", $o->get("deltas"))->join(""))->join(""))->join(""));
		$offsets = new _hx_array(array());
		{
			$_g1 = 0; $_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(StringTools::startsWith($arr[$i], "label")) {
					$offsets->push(call_user_func_array($__hx__this->labels->get($arr[$i]), array(null)));
				} else {
					$__hx__this->switches->set($arr[$i], $__hx__this->ctx->switchCase($i));
					$offsets->push(0);
				}
				unset($i);
			}
		}
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), "OSwitch", new _hx_array(array($_def, $offsets)));
	}break;
	case "OCase":{
		$out = null;
		$jumpName = $o->get("name");
		$jumpFunc = $__hx__this->switches->get($jumpName);
		call_user_func($jumpFunc);
		return $out;
	}break;
	case "ONext":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array(Std::parseInt($o->get("v1")), Std::parseInt($o->get("v2")))));
	}break;
	case "ODebugReg":{
		return Type::createEnum(_hx_qtype("format.abc.OpCode"), $o->get_nodeName(), new _hx_array(array($__hx__this->ctx->string($o->get("name")), Std::parseInt($o->get("r")), Std::parseInt($o->get("line")))));
	}break;
	default:{
		throw new HException(_hx_string_or_null($o->get_nodeName()) . " Unknown opcode.");
	}break;
	}
}
function be_haxer_hxswfml_AbcWriter_4(&$__hx__this, &$_args, &$_defaultParameters, &$_g, &$_g1, &$_return, &$args, &$defaultParameters, &$functionType, &$isInterface, &$node, &$pair, &$t, &$v, &$v1, &$values) {
	switch($t) {
	case "String":{
		return format_abc_Value::VString($__hx__this->ctx->string($v1));
	}break;
	case "int":{
		return format_abc_Value::VInt($__hx__this->ctx->int(Std::parseInt($v1)));
	}break;
	case "uint":{
		return format_abc_Value::VUInt($__hx__this->ctx->uint(Std::parseInt($v1)));
	}break;
	case "Number":{
		return format_abc_Value::VFloat($__hx__this->ctx->float(Std::parseFloat($v1)));
	}break;
	case "Boolean":{
		return format_abc_Value::VBool($v1 === "true");
	}break;
	default:{
		return null;
	}break;
	}
}
function be_haxer_hxswfml_AbcWriter_5(&$__hx__this, &$_args, &$_defaultParameters, &$_final, &$_later, &$_override, &$_return, &$_static, &$args, &$defaultParameters, &$extra, &$f, &$functionType, &$isInterface, &$node, &$ns) {
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
function be_haxer_hxswfml_AbcWriter_6(&$__hx__this, &$_classNode, &$_const, &$_extends, &$cl, &$ctx, &$ctx_xml, &$isStatic, &$member, &$name, &$ns, &$slot, &$statics, &$type, &$value, &$xml) {
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
