<?php

class format_tools_ArcFour {
	public function __construct($key) {
		if(!php_Boot::$skip_constructor) {
		$s = haxe_io_Bytes::alloc(256);
		{
			$_g = 0;
			while($_g < 256) {
				$i = $_g++;
				$s->b[$i] = chr($i);
				unset($i);
			}
		}
		$j = 0;
		$klen = $key->length;
		{
			$_g = 0;
			while($_g < 256) {
				$i = $_g++;
				$j = $j + ord($s->b[$i]) + ord($key->b[_hx_mod($i, $klen)]) & 255;
				$tmp = ord($s->b[$i]);
				$s->b[$i] = chr(ord($s->b[$j]));
				$s->b[$j] = chr($tmp);
				unset($tmp,$i);
			}
		}
		$this->sbase = $s;
		$this->s = $this->sbase->sub(0, 256);
		$this->i = 0;
		$this->j = 0;
	}}
	public function run($input, $ipos, $length, $output, $opos) {
		$i = $this->i;
		$j = $this->j;
		$s = $this->s;
		{
			$_g = 0;
			while($_g < $length) {
				$p = $_g++;
				$i = $i + 1 & 255;
				$a = ord($s->b[$i]);
				$j = $j + $a & 255;
				$b = ord($s->b[$j]);
				$s->b[$i] = chr($b);
				$s->b[$j] = chr($a);
				$output->b[$opos + $p] = chr(ord($input->b[$ipos + $p]) ^ ord($s->b[$a + $b & 255]));
				unset($p,$b,$a);
			}
		}
		$this->i = $i;
		$this->j = $j;
	}
	public function reset() {
		$this->i = 0;
		$this->j = 0;
		$this->s->blit(0, $this->sbase, 0, 256);
	}
	public $j;
	public $i;
	public $sbase;
	public $s;
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
	function __toString() { return 'format.tools.ArcFour'; }
}
