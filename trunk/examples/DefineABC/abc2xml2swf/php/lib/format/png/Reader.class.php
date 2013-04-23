<?php

class format_png_Reader {
	public function __construct($i) {
		if(!php_Boot::$skip_constructor) {
		$this->i = $i;
		$i->set_bigEndian(true);
		$this->checkCRC = true;
	}}
	public function readChunk() {
		$dataLen = $this->i->readInt32();
		$id = $this->i->readString(4);
		$data = $this->i->read($dataLen);
		$crc = $this->i->readInt32();
		if($this->checkCRC) {
			$b = haxe_io_Bytes::alloc(4);
			{
				$_g = 0;
				while($_g < 4) {
					$i = $_g++;
					$b->b[$i] = chr(_hx_char_code_at($id, $i));
					unset($i);
				}
			}
			if(haxe_crypto_Crc32::make($b) !== $crc) {
				throw new HException("CRC check failure");
			}
		}
		return format_png_Reader_0($this, $crc, $data, $dataLen, $id);
	}
	public function readHeader($i) {
		$i->set_bigEndian(true);
		$width = $i->readInt32();
		$height = $i->readInt32();
		$colbits = $i->readByte();
		$color = $i->readByte();
		$color1 = format_png_Reader_1($this, $colbits, $color, $height, $i, $width);
		$compress = $i->readByte();
		$filter = $i->readByte();
		if($compress !== 0 || $filter !== 0) {
			throw new HException("Invalid header");
		}
		$interlace = $i->readByte();
		if($interlace !== 0 && $interlace !== 1) {
			throw new HException("Invalid header");
		}
		return _hx_anonymous(array("width" => $width, "height" => $height, "colbits" => $colbits, "color" => $color1, "interlaced" => $interlace === 1));
	}
	public function read() {
		{
			$_g = 0; $_g1 = new _hx_array(array(137, 80, 78, 71, 13, 10, 26, 10));
			while($_g < $_g1->length) {
				$b = $_g1[$_g];
				++$_g;
				if($this->i->readByte() !== $b) {
					throw new HException("Invalid header");
				}
				unset($b);
			}
		}
		$l = new HList();
		while(true) {
			$c = $this->readChunk();
			$l->add($c);
			if($c === format_png_Chunk::$CEnd) {
				break;
			}
			unset($c);
		}
		return $l;
	}
	public $checkCRC;
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
	function __toString() { return 'format.png.Reader'; }
}
function format_png_Reader_0(&$__hx__this, &$crc, &$data, &$dataLen, &$id) {
	switch($id) {
	case "IEND":{
		return format_png_Chunk::$CEnd;
	}break;
	case "IHDR":{
		return format_png_Chunk::CHeader($__hx__this->readHeader(new haxe_io_BytesInput($data, null, null)));
	}break;
	case "IDAT":{
		return format_png_Chunk::CData($data);
	}break;
	case "PLTE":{
		return format_png_Chunk::CPalette($data);
	}break;
	default:{
		return format_png_Chunk::CUnknown($id, $data);
	}break;
	}
}
function format_png_Reader_1(&$__hx__this, &$colbits, &$color, &$height, &$i, &$width) {
	switch($color) {
	case 0:{
		return format_png_Color::ColGrey(false);
	}break;
	case 2:{
		return format_png_Color::ColTrue(false);
	}break;
	case 3:{
		return format_png_Color::$ColIndexed;
	}break;
	case 4:{
		return format_png_Color::ColGrey(true);
	}break;
	case 6:{
		return format_png_Color::ColTrue(true);
	}break;
	default:{
		throw new HException("Unknown color model " . _hx_string_rec($color, "") . ":" . _hx_string_rec($colbits, ""));
	}break;
	}
}
