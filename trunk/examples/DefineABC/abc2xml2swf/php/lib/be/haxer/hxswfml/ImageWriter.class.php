<?php

class be_haxer_hxswfml_ImageWriter {
	public function __construct() {
		;
	}
	public function getShape($id) {
		$width = $this->width * 20;
		$height = $this->height * 20;
		return format_swf_SWFTag::TShape($id, format_swf_ShapeData::SHDShape1(_hx_anonymous(array("left" => 0, "right" => $width, "top" => 0, "bottom" => $height)), _hx_anonymous(array("fillStyles" => new _hx_array(array(format_swf_FillStyle::FSBitmap($id, _hx_anonymous(array("scale" => null, "rotate" => null, "translate" => _hx_anonymous(array("x" => 0, "y" => 0)))), false, false))), "lineStyles" => new _hx_array(array()), "shapeRecords" => new _hx_array(array(format_swf_ShapeRecord::SHRChange(_hx_anonymous(array("moveTo" => _hx_anonymous(array("dx" => $width, "dy" => 0)), "fillStyle0" => _hx_anonymous(array("idx" => 1)), "fillStyle1" => null, "lineStyle" => null, "newStyles" => null))), format_swf_ShapeRecord::SHREdge(0, $height), format_swf_ShapeRecord::SHREdge(-$width, 0), format_swf_ShapeRecord::SHREdge(0, -$height), format_swf_ShapeRecord::SHREdge($width, 0), format_swf_ShapeRecord::$SHREnd))))));
	}
	public function getSWF($id = null) {
		if($id === null) {
			$id = 1;
		}
		$placeObject2 = new format_swf_PlaceObject();
		$placeObject2->depth = 1;
		$placeObject2->move = false;
		$placeObject2->cid = $id;
		$placeObject2->bitmapCache = null;
		$swfFile = _hx_anonymous(array("header" => _hx_anonymous(array("version" => 10, "compressed" => true, "width" => $this->width, "height" => $this->height, "fps" => 30, "nframes" => 1)), "tags" => new _hx_array(array($this->getTag($id, true), $this->getShape($id), format_swf_SWFTag::TPlaceObject2($placeObject2), format_swf_SWFTag::$TShowFrame))));
		$swfOutput = new haxe_io_BytesOutput();
		$writer = new format_swf_Writer($swfOutput);
		$writer->write($swfFile);
		return $swfOutput->getBytes();
	}
	public function getTag($id = null, $lossless = null) {
		if($lossless === null) {
			$lossless = false;
		}
		if($id === null) {
			$id = 1;
		}
		$tag = null;
		if(!$lossless) {
			$tag = format_swf_SWFTag::TBitsJPEG($id, format_swf_JPEGData::JDJPEG2($this->bytes));
		} else {
			$tag = format_swf_SWFTag::TBitsJPEG($id, format_swf_JPEGData::JDJPEG2($this->bytes));
		}
		return $tag;
	}
	public function write($bytes, $fileName, $currentTag = null) {
		$this->bytes = $bytes;
		$this->extension = strtolower(_hx_substr($fileName, _hx_last_index_of($fileName, ".", null) + 1, null));
		$this->height = 0;
		$this->width = 0;
		$input = new haxe_io_BytesInput($bytes, null, null);
		if($this->extension === "jpg" || $this->extension === "jpeg") {
			if($input->readByte() !== 255 || $input->readByte() !== 216) {
				throw new HException("ERROR: in image file: " . _hx_string_or_null($fileName) . ". SOI (Start Of Image) marker 0xff 0xd8 missing , TAG: " . _hx_string_or_null($currentTag->toString()));
			}
			$marker = null;
			$len = null;
			while($input->readByte() === 255) {
				$marker = $input->readByte();
				$len = $input->readByte() << 8 | $input->readByte();
				if($marker === 192) {
					$input->readByte();
					$this->height = $input->readByte() << 8 | $input->readByte();
					$this->width = $input->readByte() << 8 | $input->readByte();
					break;
				}
				$input->read($len - 2);
			}
		} else {
			if($this->extension === "png") {
				$input->set_bigEndian(true);
				$input->readInt32();
				$input->readInt32();
				$input->readInt32();
				$input->readInt32();
				$this->width = $input->readInt32();
				$this->height = $input->readInt32();
			} else {
				if($this->extension === "gif") {
					$input->set_bigEndian(false);
					$input->readInt32();
					$input->readUInt16();
					$this->width = $input->readUInt16();
					$this->height = $input->readUInt16();
				}
			}
		}
	}
	public $extension;
	public $bytes;
	public $height;
	public $width;
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
	function __toString() { return 'be.haxer.hxswfml.ImageWriter'; }
}
