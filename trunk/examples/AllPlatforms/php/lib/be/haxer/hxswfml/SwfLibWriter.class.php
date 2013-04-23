<?php

class be_haxer_hxswfml_SwfLibWriter {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->library = new haxe_ds_StringMap();
		$this->swcClasses = new _hx_array(array());
		$this->id = 0;
		$this->init();
	}}
	public function error($msg) {
		throw new HException($msg);
	}
	public function getLinkClass() {
		$classn = $this->getString("class", "", false);
		$linkn = (($classn !== "") ? $classn : $this->getString("link", "", false));
		if($linkn === "") {
			$this->error("ERROR: You must provide a link or a class attribute. " . _hx_string_or_null($this->currentTag->toString()));
		}
		return _hx_anonymous(array("linkn" => $linkn, "classn" => $classn));
	}
	public function createLinkedSymbol($id, $classn, $linkn, $basen = null) {
		$this->swcClasses->push(new _hx_array(array($linkn, $basen)));
		return (($classn === $linkn) ? new _hx_array(array(be_haxer_hxswfml_AbcWriter::createABC($classn, $basen), format_swf_SWFTag::TSymbolClass(new _hx_array(array(_hx_anonymous(array("cid" => $id, "className" => $linkn))))))) : new _hx_array(array(format_swf_SWFTag::TSymbolClass(new _hx_array(array(_hx_anonymous(array("cid" => $id, "className" => $linkn))))))));
	}
	public function isValidAttribute($a) {
		$validAttributes = $this->validElements->get(strtolower($this->currentTag->get_nodeName()));
		{
			$_g = 0;
			while($_g < $validAttributes->length) {
				$i = $validAttributes[$_g];
				++$_g;
				if($a === $i) {
					return true;
				}
				unset($i);
			}
		}
		return false;
	}
	public function setCurrentElement($tag) {
		$this->currentTag = $tag;
		if(!$this->validElements->exists(strtolower($this->currentTag->get_nodeName()))) {
			$this->error("ERROR: Unknown tag: " . _hx_string_or_null($this->currentTag->get_nodeName()));
		}
		if(null == $this->currentTag) throw new HException('null iterable');
		$__hx__it = $this->currentTag->attributes();
		while($__hx__it->hasNext()) {
			$a = $__hx__it->next();
			if(!$this->isValidAttribute($a)) {
				if(strtolower($this->currentTag->get_nodeName()) !== "swf") {
					$this->error("ERROR: Unknown attribute: " . _hx_string_or_null($a) . ". Valid attributes are: " . _hx_string_or_null($this->validElements->get(strtolower($this->currentTag->get_nodeName()))->toString()) . ". TAG: " . _hx_string_or_null($this->currentTag->toString()));
				}
			}
		}
	}
	public function checkFileExistence($file) {
		if(!file_exists($file)) {
			$this->error("ERROR: File: " . _hx_string_or_null($file) . " could not be found at the given location. TAG: " . _hx_string_or_null($this->currentTag->toString()));
		}
	}
	public function getString($att, $defaultValue, $required = null) {
		if($required === null) {
			$required = false;
		}
		if($required) {
			if(!$this->currentTag->exists($att)) {
				$this->error("ERROR: Required attribute " . _hx_string_or_null($att) . " is missing in tag: " . _hx_string_or_null($this->currentTag->toString()));
			}
		}
		return (($this->currentTag->exists($att)) ? $this->currentTag->get($att) : $defaultValue);
	}
	public function getFloat($att, $defaultValue, $required = null) {
		if($required === null) {
			$required = false;
		}
		if($this->currentTag->exists($att)) {
			if(Math::isNaN(Std::parseFloat($this->currentTag->get($att)))) {
				$this->error("ERROR: attribute " . _hx_string_or_null($att) . " must be a number: " . _hx_string_or_null($this->currentTag->toString()));
			}
		}
		if($required) {
			if(!$this->currentTag->exists($att)) {
				$this->error("ERROR: Required attribute " . _hx_string_or_null($att) . " is missing in tag: " . _hx_string_or_null($this->currentTag->toString()));
			}
		}
		return (($this->currentTag->exists($att)) ? Std::parseFloat($this->currentTag->get($att)) : $defaultValue);
	}
	public function getBool($att, $defaultValue, $required = null) {
		if($required === null) {
			$required = false;
		}
		if($required) {
			if(!$this->currentTag->exists($att)) {
				$this->error("ERROR: Required attribute " . _hx_string_or_null($att) . " is missing in tag: " . Std::string($this->currentTag));
			}
		}
		return (($this->currentTag->exists($att)) ? (($this->currentTag->get($att) === "true") ? true : false) : $defaultValue);
	}
	public function getInt($att, $defaultValue, $required = null, $uniqueId = null, $targetId = null) {
		if($targetId === null) {
			$targetId = false;
		}
		if($uniqueId === null) {
			$uniqueId = false;
		}
		if($required === null) {
			$required = false;
		}
		if($this->currentTag->exists($att)) {
			if(Math::isNaN(Std::parseInt($this->currentTag->get($att)))) {
				$this->error("ERROR: attribute " . _hx_string_or_null($att) . " must be an integer: " . _hx_string_or_null($this->currentTag->toString()));
			}
		}
		if($required) {
			if(!$this->currentTag->exists($att)) {
				$this->error("ERROR: Required attribute " . _hx_string_or_null($att) . " is missing in tag: " . _hx_string_or_null($this->currentTag->toString()));
			}
		}
		return (($this->currentTag->exists($att)) ? Std::parseInt($this->currentTag->get($att)) : $defaultValue);
	}
	public function getBytes($file) {
		$this->checkFileExistence($file);
		return sys_io_File::getBytes($file);
	}
	public function getContent($file) {
		$this->checkFileExistence($file);
		return sys_io_File::getContent($file);
	}
	public function placeobject($id) {
		$placeObject = new format_swf_PlaceObject();
		$placeObject->depth = 1;
		$placeObject->move = false;
		$placeObject->cid = $id;
		$placeObject->matrix = _hx_anonymous(array("scale" => null, "rotate" => null, "translate" => _hx_anonymous(array("x" => 0, "y" => 0))));
		$placeObject->color = null;
		$placeObject->ratio = null;
		$placeObject->instanceName = null;
		$placeObject->clipDepth = null;
		$placeObject->events = null;
		$placeObject->blendMode = null;
		$placeObject->bitmapCache = null;
		$placeObject->className = null;
		$placeObject->hasImage = false;
		$placeObject->filters = null;
		return format_swf_SWFTag::TPlaceObject2($placeObject);
	}
	public function createDefineShape($id, $bitmapId) {
		$width = $this->bitmapIds[$bitmapId]->a[0] * 20;
		$height = $this->bitmapIds[$bitmapId]->a[1] * 20;
		$shapeWithStyle = _hx_anonymous(array("fillStyles" => new _hx_array(array(format_swf_FillStyle::FSBitmap($bitmapId, _hx_anonymous(array("scale" => _hx_anonymous(array("x" => 20.0, "y" => 20.0)), "rotate" => _hx_anonymous(array("rs0" => 0.0, "rs1" => 0.0)), "translate" => _hx_anonymous(array("x" => 0, "y" => 0)))), false, false))), "lineStyles" => new _hx_array(array()), "shapeRecords" => new _hx_array(array(format_swf_ShapeRecord::SHRChange(_hx_anonymous(array("moveTo" => _hx_anonymous(array("dx" => $width, "dy" => 0)), "fillStyle0" => _hx_anonymous(array("idx" => 1)), "fillStyle1" => null, "lineStyle" => null, "newStyles" => null))), format_swf_ShapeRecord::SHREdge(0, $height), format_swf_ShapeRecord::SHREdge(-$width, 0), format_swf_ShapeRecord::SHREdge(0, -$height), format_swf_ShapeRecord::SHREdge($width, 0), format_swf_ShapeRecord::$SHREnd))));
		return format_swf_SWFTag::TShape($id, format_swf_ShapeData::SHDShape1(_hx_anonymous(array("left" => 0, "right" => $width, "top" => 0, "bottom" => $height)), $shapeWithStyle));
	}
	public function createDefineBitsJPEG($id) {
		$file = $this->getString("file", "", true);
		$bytes = $this->getBytes($file);
		$imageWriter = new be_haxer_hxswfml_ImageWriter();
		$imageWriter->write($bytes, $file, $this->currentTag);
		$this->bitmapIds[$id] = new _hx_array(array($imageWriter->width, $imageWriter->height));
		return $imageWriter->getTag($id, true);
	}
	public function frame() {
		return new _hx_array(array(format_swf_SWFTag::$TShowFrame));
	}
	public function abc() {
		$linkn = $this->getString("link", "", false);
		$file = $this->getString("file", "", true);
		$isBoot = $this->getBool("isBoot", false, null);
		$abcTag = null;
		$extension = strtolower(_hx_substr($file, _hx_last_index_of($file, ".", null) + 1, null));
		if($extension === "swf") {
			$swf = $this->getBytes($file);
			$swfBytesInput = new haxe_io_BytesInput($swf, null, null);
			$swfReader = new format_swf_Reader($swfBytesInput);
			$header = $swfReader->readHeader();
			$tags = $swfReader->readTagList(null);
			$swfBytesInput->close();
			{
				$_g = 0;
				while($_g < $tags->length) {
					$tag = $tags[$_g];
					++$_g;
					$__hx__t = ($tag);
					switch($__hx__t->index) {
					case 13:
					$context = $__hx__t->params[1]; $data = $__hx__t->params[0];
					{
						$abcTag = $tag;
						break 2;
					}break;
					default:{
					}break;
					}
					unset($tag);
				}
			}
			if($abcTag === null) {
				$this->error("ERROR: No script was found inside swf: " . _hx_string_or_null($file) . ", TAG: " . _hx_string_or_null($this->currentTag->toString()));
			}
			if($isBoot && $linkn === "") {
				$_g = 0;
				while($_g < $tags->length) {
					$tag = $tags[$_g];
					++$_g;
					$__hx__t = ($tag);
					switch($__hx__t->index) {
					case 14:
					$symbols = $__hx__t->params[0];
					{
						$_g1 = 0;
						while($_g1 < $symbols->length) {
							$s = $symbols[$_g1];
							++$_g1;
							if($s->cid === 0) {
								$linkn = $s->className;
							}
							unset($s);
						}
					}break;
					default:{
					}break;
					}
					unset($tag);
				}
			}
		}
		return _hx_deref(new _hx_array(array($abcTag)))->concat($this->createLinkedSymbol(0, "", $linkn, null));
	}
	public function button() {
		$this->id++;
		$lc = $this->getLinkClass();
		$file = $this->getString("file", "", true);
		$bytes = $this->getBytes($file);
		$imageWriter = new be_haxer_hxswfml_ImageWriter();
		$imageWriter->write($bytes, $file, $this->currentTag);
		$bitmapTag = $imageWriter->getTag($this->id, true);
		$width = $imageWriter->width * 20;
		$height = $imageWriter->height * 20;
		$shapeWithStyle = _hx_anonymous(array("fillStyles" => new _hx_array(array(format_swf_FillStyle::FSBitmap($this->id, _hx_anonymous(array("scale" => _hx_anonymous(array("x" => 20.0, "y" => 20.0)), "rotate" => _hx_anonymous(array("rs0" => 0.0, "rs1" => 0.0)), "translate" => _hx_anonymous(array("x" => 0, "y" => 0)))), false, false))), "lineStyles" => new _hx_array(array()), "shapeRecords" => new _hx_array(array(format_swf_ShapeRecord::SHRChange(_hx_anonymous(array("moveTo" => _hx_anonymous(array("dx" => $width, "dy" => 0)), "fillStyle0" => _hx_anonymous(array("idx" => 1)), "fillStyle1" => null, "lineStyle" => null, "newStyles" => null))), format_swf_ShapeRecord::SHREdge(0, $height), format_swf_ShapeRecord::SHREdge(-$width, 0), format_swf_ShapeRecord::SHREdge(0, -$height), format_swf_ShapeRecord::SHREdge($width, 0), format_swf_ShapeRecord::$SHREnd))));
		$this->id++;
		$shapeTag = format_swf_SWFTag::TShape($this->id, format_swf_ShapeData::SHDShape1(_hx_anonymous(array("left" => 0, "right" => $width, "top" => 0, "bottom" => $height)), $shapeWithStyle));
		$buttonRecords = new _hx_array(array(_hx_anonymous(array("hit" => true, "down" => true, "over" => true, "up" => true, "id" => $this->id, "depth" => 1, "matrix" => _hx_anonymous(array("scale" => null, "rotate" => null, "translate" => _hx_anonymous(array("x" => 0, "y" => 0))))))));
		$this->id++;
		$buttonTag = format_swf_SWFTag::TDefineButton2($this->id, $buttonRecords);
		return _hx_deref(new _hx_array(array($bitmapTag, $shapeTag, $buttonTag)))->concat($this->createLinkedSymbol($this->id, $lc->classn, $lc->linkn, "flash.display.SimpleButton"));
	}
	public function font() {
		$lc = $this->getLinkClass();
		$file = $this->getString("file", "", true);
		$fontTag = null;
		$extension = strtolower(_hx_substr($file, _hx_last_index_of($file, ".", null) + 1, null));
		if($extension === "swf") {
			$swf = $this->getBytes($file);
			$swfBytesInput = new haxe_io_BytesInput($swf, null, null);
			$swfReader = new format_swf_Reader($swfBytesInput);
			$header = $swfReader->readHeader();
			$tags = $swfReader->readTagList(null);
			$swfBytesInput->close();
			$_id = ++$this->id;
			{
				$_g = 0;
				while($_g < $tags->length) {
					$tag = $tags[$_g];
					++$_g;
					$__hx__t = ($tag);
					switch($__hx__t->index) {
					case 4:
					$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
					{
						$fontTag = format_swf_SWFTag::TFont($_id, $data);
						break 2;
					}break;
					default:{
					}break;
					}
					unset($tag);
				}
			}
			if($fontTag === null) {
				$this->error("ERROR: No Font definitions were found inside swf: " . _hx_string_or_null($file) . ", TAG: " . _hx_string_or_null($this->currentTag->toString()));
			}
		} else {
			if($extension === "ttf") {
				$bytes = $this->getBytes($file);
				$ranges = $this->getString("glyphs", "32-126", false);
				$fontName = $this->getString("name", null, false);
				$fontWriter = new be_haxer_hxswfml_FontWriter();
				$fontWriter->write($bytes, $ranges, "swf", $fontName);
				$fontTag = $fontWriter->getTag(++$this->id);
			} else {
				if($extension === "otf") {
					$bytes = $this->getBytes($file);
					$fontWriter = new be_haxer_hxswfml_FontWriter();
					$name = $this->getString("name", "", true);
					$fontTag = $fontWriter->writeOTF(++$this->id, $name, $bytes);
					if($fontTag === null) {
						$this->error("ERROR: Not a valid OTTO OTF font file: " . _hx_string_or_null($file) . ", TAG: " . _hx_string_or_null($this->currentTag->toString()));
					}
				} else {
					$this->error("ERROR: Not a valid font file:" . _hx_string_or_null($file) . ", TAG: " . _hx_string_or_null($this->currentTag->toString()) . "Valid file types are: .swf and .ttf");
				}
			}
		}
		return _hx_deref(new _hx_array(array($fontTag)))->concat($this->createLinkedSymbol($this->id, $lc->classn, $lc->linkn, "flash.text.Font"));
	}
	public function sound() {
		$lc = $this->getLinkClass();
		$file = $this->getString("file", "", true);
		$this->checkFileExistence($file);
		$mp3FileBytes = sys_io_File::read($file, true);
		$audioWriter = new be_haxer_hxswfml_AudioWriter();
		$audioWriter->write($mp3FileBytes, $this->currentTag);
		$soundId = ++$this->id;
		return _hx_deref(new _hx_array(array($audioWriter->getTag($soundId))))->concat($this->createLinkedSymbol($soundId, $lc->classn, $lc->linkn, "flash.media.Sound"));
	}
	public function bytearray() {
		$lc = $this->getLinkClass();
		$file = $this->getString("file", "", true);
		$bytes = $this->getBytes($file);
		$binId = ++$this->id;
		return _hx_deref(new _hx_array(array(format_swf_SWFTag::TBinaryData($binId, $bytes))))->concat($this->createLinkedSymbol($binId, $lc->classn, $lc->linkn, "flash.utils.ByteArray"));
	}
	public function movieclip() {
		$file = $this->getString("file", "", true);
		$lc = $this->getLinkClass();
		$extension = strtolower(_hx_substr($file, _hx_last_index_of($file, ".", null) + 1, null));
		if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "gif" && $extension !== "png") {
			$this->error("Invalid file format, must be gif, jpg, png");
		}
		$out = new _hx_array(array());
		$jpegId = ++$this->id;
		$defineBitsJpegTag = $this->createDefineBitsJPEG($jpegId);
		$shapeId = ++$this->id;
		$defineShapeTag = $this->createDefineShape($shapeId, $jpegId);
		$mc_tags = new _hx_array(array($this->placeobject($shapeId), format_swf_SWFTag::$TShowFrame));
		$mcId = ++$this->id;
		$out1 = _hx_deref(new _hx_array(array($defineBitsJpegTag, $defineShapeTag, format_swf_SWFTag::TClip($mcId, 1, $mc_tags))))->concat($this->createLinkedSymbol($mcId, $lc->classn, $lc->linkn, "flash.display.MovieClip"));
		return $out1;
	}
	public function sprite() {
		$file = $this->getString("file", "", true);
		$lc = $this->getLinkClass();
		$extension = strtolower(_hx_substr($file, _hx_last_index_of($file, ".", null) + 1, null));
		if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "gif" && $extension !== "png") {
			$this->error("Invalid file format, must be gif, jpg, png");
		}
		$jpegId = ++$this->id;
		$defineBitsJpegTag = $this->createDefineBitsJPEG($jpegId);
		$shapeId = ++$this->id;
		$defineShapeTag = $this->createDefineShape($shapeId, $jpegId);
		$mc_tags = new _hx_array(array($this->placeobject($shapeId), format_swf_SWFTag::$TShowFrame));
		$mcId = ++$this->id;
		$out = _hx_deref(new _hx_array(array($defineBitsJpegTag, $defineShapeTag, format_swf_SWFTag::TClip($mcId, 1, $mc_tags))))->concat($this->createLinkedSymbol($mcId, $lc->classn, $lc->linkn, "flash.display.Sprite"));
		return $out;
	}
	public function bitmap() {
		$lc = $this->getLinkClass();
		$jpegId = ++$this->id;
		return _hx_deref(new _hx_array(array($this->createDefineBitsJPEG($jpegId))))->concat($this->createLinkedSymbol($jpegId, $lc->classn, $lc->linkn, "flash.display.Bitmap"));
	}
	public function bitmapdata() {
		$lc = $this->getLinkClass();
		$jpegId = ++$this->id;
		return _hx_deref(new _hx_array(array($this->createDefineBitsJPEG($jpegId))))->concat($this->createLinkedSymbol($jpegId, $lc->classn, $lc->linkn, "flash.display.BitmapData"));
	}
	public function readTop() {
		return _hx_anonymous(array("header" => _hx_anonymous(array("version" => $this->getInt("version", 10, null, null, null), "compressed" => $this->getBool("compressed", false, null), "width" => $this->getInt("width", 800, null, null, null), "height" => $this->getInt("height", 600, null, null, null), "fps" => $this->getInt("fps", 30, null, null, null), "nframes" => $this->getInt("frameCount", 1, null, null, null))), "fileAttributes" => format_swf_SWFTag::TSandBox(_hx_anonymous(array("useDirectBlit" => $this->getBool("useDirectBlit", false, null), "useGPU" => $this->getBool("useGPU", false, null), "hasMetaData" => $this->getBool("hasMetaData", false, null), "actionscript3" => $this->getBool("actionscript3", true, null), "useNetWork" => $this->getBool("useNetwork", false, null)))), "setBackgroundColor" => format_swf_SWFTag::TBackgroundColor($this->getInt("backgroundcolor", 16777215, null, null, null))));
	}
	public function getSWC() {
		return _hx_deref(new be_haxer_hxswfml_SwcWriter())->write($this->swcClasses, $this->swfBytes);
	}
	public function getSWF() {
		return $this->swfBytes;
	}
	public function write($input) {
		$this->bitmapIds = new _hx_array(array());
		$xml = Xml::parse($input);
		$root = $xml->firstElement();
		$this->setCurrentElement($root);
		$top = $this->readTop();
		$tags = new _hx_array(array($top->fileAttributes, $top->setBackgroundColor));
		if(null == $root) throw new HException('null iterable');
		$__hx__it = $root->elements();
		while($__hx__it->hasNext()) {
			$e = $__hx__it->next();
			if(!$this->validElements->exists(strtolower($e->get_nodeName()))) {
				$this->error("ERROR: Unknown tag: " . _hx_string_or_null($e->get_nodeName()) . ":" . _hx_string_or_null($e->toString()) . ". Allowed elements are: " . _hx_string_or_null($this->validChildren->get("lib")->toString()));
			}
		}
		if(null == $root) throw new HException('null iterable');
		$__hx__it = $root->elements();
		while($__hx__it->hasNext()) {
			$e = $__hx__it->next();
			$this->setCurrentElement($e);
			$swftags = call_user_func(Reflect::field($this, strtolower($e->get_nodeName())));
			{
				$_g1 = 0; $_g = $swftags->length;
				while($_g1 < $_g) {
					$i = $_g1++;
					$tags->push($swftags[$i]);
					unset($i);
				}
				unset($_g1,$_g);
			}
			unset($swftags);
		}
		$tags->push(format_swf_SWFTag::$TShowFrame);
		$swfBytesOutput = new haxe_io_BytesOutput();
		$swfWriter = new format_swf_Writer($swfBytesOutput);
		$swfWriter->write(_hx_anonymous(array("header" => $top->header, "tags" => $tags)));
		$this->swfBytes = $swfBytesOutput->getBytes();
		return $this->swfBytes;
	}
	public function init() {
		$this->validElements = new haxe_ds_StringMap();
		$this->validElements->set("lib", new _hx_array(array("version", "compressed", "width", "height", "fps", "frameCount", "backgroundcolor", "useDirectBlit", "useGPU", "hasMetaData", "actionscript3", "useNetWork")));
		$this->validElements->set("bitmapdata", new _hx_array(array("file", "class", "link")));
		$this->validElements->set("bitmap", new _hx_array(array("file", "class", "link")));
		$this->validElements->set("shape", new _hx_array(array("file", "class", "link")));
		$this->validElements->set("sprite", new _hx_array(array("file", "class", "link")));
		$this->validElements->set("movieclip", new _hx_array(array("file", "class", "link")));
		$this->validElements->set("button", new _hx_array(array("file", "class", "link")));
		$this->validElements->set("bytearray", new _hx_array(array("file", "class", "link")));
		$this->validElements->set("font", new _hx_array(array("file", "glyphs", "class", "link", "name")));
		$this->validElements->set("sound", new _hx_array(array("file", "class", "link")));
		$this->validElements->set("abc", new _hx_array(array("file", "link", "isBoot")));
		$this->validElements->set("frame", new _hx_array(array()));
		$this->validChildren = new haxe_ds_StringMap();
		$this->validChildren->set("lib", new _hx_array(array("bitmapdata", "bitmap", "sprite", "movieclip", "bytearray", "font", "sound", "abc", "frame")));
	}
	public $id;
	public $currentTag;
	public $bitmapIds;
	public $validChildren;
	public $validElements;
	public $swcClasses;
	public $swfBytes;
	public $swf;
	public $library;
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
	function __toString() { return 'be.haxer.hxswfml.SwfLibWriter'; }
}
