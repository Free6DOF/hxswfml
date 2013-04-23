<?php

class be_haxer_hxswfml_SwfWriter {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->tagIndex = 0;
		$this->library = new haxe_ds_StringMap();
		$this->init();
	}}
	public function error($msg) {
		throw new HException($msg);
	}
	public function toRGBA($c) {
		return _hx_anonymous(array("r" => Std::parseInt("0x" . _hx_string_or_null(_hx_substr($c, 2, 2))), "g" => Std::parseInt("0x" . _hx_string_or_null(_hx_substr($c, 4, 2))), "b" => Std::parseInt("0x" . _hx_string_or_null(_hx_substr($c, 6, 2))), "a" => Std::parseInt("0x" . _hx_string_or_null(_hx_substr($c, 8, 2)))));
	}
	public function toRGB($i) {
		return _hx_anonymous(array("r" => ($i & 16711680) >> 16, "g" => ($i & 65280) >> 8, "b" => $i & 255));
	}
	public function isValidBaseClass($c) {
		{
			$_g = 0; $_g1 = $this->validBaseClasses;
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				if($c === $i) {
					return true;
				}
				unset($i);
			}
		}
		return false;
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
	public function checkTargetId($id) {
		if($this->strict) {
			if($id !== 0 && $this->dictionary[$id] === null) {
				$this->error("ERROR: The target id " . _hx_string_rec($id, "") . " does not exist. TAG: " . _hx_string_or_null($this->currentTag->toString()));
			} else {
				if(strtolower($this->currentTag->get_nodeName()) === "placeobject" || strtolower($this->currentTag->get_nodeName()) === "buttonstate") {
					switch($this->dictionary[$id]) {
					case "definebitsjpeg":case "definebitslossless":case "defineshape":case "definebutton":case "definesprite":case "defineedittext":{
					}break;
					default:{
						$this->error("ERROR: The target id " . _hx_string_rec($id, "") . " must be a reference to a DefineShape, DefineBitsJPEG, DefineBitsLossless, DefineButton, DefineSprite or DefineEditText tag. TAG: " . _hx_string_or_null($this->currentTag->toString()));
					}break;
					}
				} else {
					if(strtolower($this->currentTag->get_nodeName()) === "definescalinggrid") {
						switch($this->dictionary[$id]) {
						case "definebutton":case "definesprite":{
						}break;
						default:{
							$this->error("ERROR: The target id " . _hx_string_rec($id, "") . " must be a reference to a DefineButton or DefineSprite tag. TAG: " . _hx_string_or_null($this->currentTag->toString()));
						}break;
						}
					} else {
						if(strtolower($this->currentTag->get_nodeName()) === "startsound") {
							if($this->dictionary[$id] !== "definesound") {
								$this->error("ERROR: The target id " . _hx_string_rec($id, "") . " must be a reference to a DefineSound tag. TAG: " . _hx_string_or_null($this->currentTag->toString()));
							}
						} else {
							if($id !== 0 && strtolower($this->currentTag->get_nodeName()) === "symbolclass") {
								$tag = $this->dictionary[$id];
								switch($tag) {
								case "definebutton":case "definesprite":case "definebinarydata":case "definefont":case "defineabc":case "definesound":case "definebitsjpeg":case "definebitslossless":{
								}break;
								default:{
									$this->error("ERROR: The target id " . _hx_string_rec($id, "") . " must be a reference to a DefineButton, DefineSprite, DefineBinaryData, DefineFont, DefineABC, DefineSound, DefineBitsJPEG or DefineBitsLossless tag. TAG: " . _hx_string_or_null($this->currentTag->toString()));
								}break;
								}
							}
						}
					}
				}
			}
		}
	}
	public function checkDictionary($id) {
		if($this->strict) {
			if($this->dictionary[$id] !== null) {
				$this->error("ERROR: You are overwriting an existing id: " . _hx_string_rec($id, "") . ". TAG: " . _hx_string_or_null($this->currentTag->toString()));
			}
			if($id === 0 && strtolower($this->currentTag->get_nodeName()) !== "symbolclass") {
				$this->error("ERROR: id 0 used outside symbol class. Index 0 can only be used for the SymbolClass tag that references the DefineABC tag which holds your document class/main entry point. Tag: " . _hx_string_or_null($this->currentTag->toString()));
			}
		}
		$this->dictionary[$id] = strtolower($this->currentTag->get_nodeName());
	}
	public function getMatrix() {
		$scale = null; $rotate = null; $translate = null;
		$scaleX = $this->getFloat("scaleX", null, null);
		$scaleY = $this->getFloat("scaleY", null, null);
		$scale = (($scaleX === null && $scaleY === null) ? null : _hx_anonymous(array("x" => (($scaleX === null) ? 1.0 : $scaleX), "y" => (($scaleY === null) ? 1.0 : $scaleY))));
		$rs0 = $this->getFloat("rotate0", null, null);
		$rs1 = $this->getFloat("rotate1", null, null);
		$rotate = (($rs0 === null && $rs1 === null) ? null : _hx_anonymous(array("rs0" => (($rs0 === null) ? 0.0 : $rs0), "rs1" => (($rs1 === null) ? 0.0 : $rs1))));
		$x = $this->getInt("x", 0, null, null, null) * 20;
		$y = $this->getInt("y", 0, null, null, null) * 20;
		$translate = _hx_anonymous(array("x" => $x, "y" => $y));
		return _hx_anonymous(array("scale" => $scale, "rotate" => $rotate, "translate" => $translate));
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
		if($uniqueId) {
			$this->checkDictionary(Std::parseInt($this->currentTag->get($att)));
		}
		if($targetId) {
			$this->checkTargetId(Std::parseInt($this->currentTag->get($att)));
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
	public function defineswf() {
		$tags = new _hx_array(array());
		$data = null;
		$file = $this->getString("file", "", false);
		if($file === "") {
			$str = $this->getString("data", "", true);
			$arr = _hx_explode(",", $str);
			$buffer = new haxe_io_BytesBuffer();
			{
				$_g1 = 0; $_g = $arr->length;
				while($_g1 < $_g) {
					$i = $_g1++;
					$buffer->b .= _hx_string_or_null(chr(Std::parseInt($arr[$i])));
					unset($i);
				}
			}
			$data = $buffer->getBytes();
		} else {
			if(!StringTools::endsWith($file, ".swf")) {
				$this->error("ERROR: " . _hx_string_or_null($this->currentTag->get_nodeName()) . " can only be used with swf files. TAG: " . _hx_string_or_null($this->currentTag->toString()));
			}
			$data = $this->getBytes($file);
		}
		$swfBytesInput = new haxe_io_BytesInput($data, null, null);
		$swfReader = new format_swf_Reader($swfBytesInput);
		$header = $swfReader->readHeader();
		$tags1 = $swfReader->readTagList(true);
		$swfBytesInput->close();
		return $tags1;
	}
	public function custom() {
		$tagId = $this->getInt("tagId", null, false, null, null);
		$data = null;
		$file = $this->getString("file", "", false);
		if($file === "") {
			$str = $this->getString("data", "", true);
			$arr = _hx_explode(",", $str);
			$buffer = new haxe_io_BytesBuffer();
			{
				$_g1 = 0; $_g = $arr->length;
				while($_g1 < $_g) {
					$i = $_g1++;
					$buffer->b .= _hx_string_or_null(chr(Std::parseInt($arr[$i])));
					unset($i);
				}
			}
			$data = $buffer->getBytes();
		} else {
			$data = $this->getBytes($file);
		}
		return format_swf_SWFTag::TUnknown($tagId, $data);
	}
	public function endframe() {
		return format_swf_SWFTag::$TEnd;
	}
	public function showframe() {
		$showFrames = new _hx_array(array());
		$count = $this->getInt("count", null, false, null, null);
		if($count === null) {
			return new _hx_array(array(format_swf_SWFTag::$TShowFrame));
		} else {
			$_g = 0;
			while($_g < $count) {
				$i = $_g++;
				$showFrames->push(format_swf_SWFTag::$TShowFrame);
				unset($i);
			}
		}
		return $showFrames;
	}
	public function framelabel() {
		$label = $this->getString("name", "", true);
		$anchor = $this->getBool("anchor", false, null);
		return format_swf_SWFTag::TFrameLabel($label, $anchor);
	}
	public function exportassets() {
		$cid = $this->getInt("id", null, true, false, true);
		$className = $this->getString("class", "", true);
		$symbols = new _hx_array(array(_hx_anonymous(array("cid" => $cid, "className" => $className))));
		return new _hx_array(array(format_swf_SWFTag::TExportAssets($symbols)));
	}
	public function symbolclass() {
		$cid = $this->getInt("id", null, true, false, true);
		$className = $this->getString("class", "", true);
		$symbols = new _hx_array(array(_hx_anonymous(array("cid" => $cid, "className" => $className))));
		$baseClass = $this->getString("base", "", null);
		$tags = new _hx_array(array());
		if($baseClass !== "") {
			if($this->isValidBaseClass($baseClass)) {
				$this->swcClasses->push(new _hx_array(array($className, $baseClass)));
				$tags = new _hx_array(array(be_haxer_hxswfml_AbcWriter::createABC($className, $baseClass), format_swf_SWFTag::TSymbolClass($symbols)));
			} else {
				$this->error("ERROR: Invalid base class: " . _hx_string_or_null($baseClass) . ". Valid base classes are: " . _hx_string_or_null($this->validBaseClasses->toString()) . ". TAG: " . _hx_string_or_null($this->currentTag->toString()));
			}
		} else {
			$tags = new _hx_array(array(format_swf_SWFTag::TSymbolClass($symbols)));
		}
		return $tags;
	}
	public function importassets() {
		$url = $this->getString("url", "", true);
		return format_swf_SWFTag::TImportAssets($url);
	}
	public function startsound() {
		$id = $this->getInt("id", null, true, false, true);
		$stop = $this->getBool("stop", false, null);
		$loopCount = $this->getInt("loopCount", 0, null, null, null);
		$hasLoops = (($loopCount === 0) ? false : true);
		return format_swf_SWFTag::TStartSound($id, _hx_anonymous(array("syncStop" => $stop, "hasLoops" => $hasLoops, "loopCount" => $loopCount)));
	}
	public function removeobject() {
		$depth = $this->getInt("depth", null, true, null, null);
		return format_swf_SWFTag::TRemoveObject2($depth);
	}
	public function tween() {
		$depth = $this->getInt("depth", null, true, null, null);
		$frameCount = $this->getInt("frameCount", null, true, null, null);
		$startX = null;
		$startY = null;
		$endX = null;
		$endY = null;
		$startScaleX = null;
		$startScaleY = null;
		$endScaleX = null;
		$endScaleY = null;
		$startRotateO = null;
		$startRotate1 = null;
		$endRotateO = null;
		$endRotate1 = null;
		if(null == $this->currentTag) throw new HException('null iterable');
		$__hx__it = $this->currentTag->elements();
		while($__hx__it->hasNext()) {
			$tagNode = $__hx__it->next();
			$this->setCurrentElement($tagNode);
			switch(strtolower($this->currentTag->get_nodeName())) {
			case "tw":{
				$prop = $this->getString("prop", "", null);
				$startxy = null;
				$endxy = null;
				$start = null;
				$end = null;
				if($prop === "x" || $prop === "y") {
					$startxy = $this->getInt("start", 0, true, null, null);
					$endxy = $this->getInt("end", 0, true, null, null);
				} else {
					$start = $this->getFloat("start", null, true);
					$end = $this->getFloat("end", null, true);
				}
				switch($prop) {
				case "x":{
					$startX = $startxy;
					$endX = $endxy;
				}break;
				case "y":{
					$startY = $startxy;
					$endY = $endxy;
				}break;
				case "scaleX":{
					$startScaleX = $start;
					$endScaleX = $end;
				}break;
				case "scaleY":{
					$startScaleY = $start;
					$endScaleY = $end;
				}break;
				case "rotate0":{
					$startRotateO = $start;
					$endRotateO = $end;
				}break;
				case "rotate1":{
					$startRotate1 = $start;
					$endRotate1 = $end;
				}break;
				default:{
					$this->error("ERROR: Unsupported " . _hx_string_or_null($prop) . " in TW element. Tweenable properties are: x, y, scaleX, scaleY, rotateO, rotate1. TAG: " . _hx_string_or_null($this->currentTag->toString()));
				}break;
				}
			}break;
			default:{
				$this->error("ERROR: " . _hx_string_or_null($this->currentTag->get_nodeName()) . " is not allowed inside a Tween element.  Valid children are: " . _hx_string_or_null($this->validChildren->get("tween")->toString()) . ". TAG: " . _hx_string_or_null($this->currentTag->toString()));
			}break;
			}
		}
		$tags = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $frameCount) {
				$i = $_g++;
				$dx = (($startX === null || $endX === null) ? 0 : Std::int($startX + ($endX - $startX) * $i / $frameCount));
				$dy = (($startY === null || $endY === null) ? 0 : Std::int($startY + ($endY - $startY) * $i / $frameCount));
				$dsx = be_haxer_hxswfml_SwfWriter_0($this, $_g, $depth, $dx, $dy, $endRotate1, $endRotateO, $endScaleX, $endScaleY, $endX, $endY, $frameCount, $i, $startRotate1, $startRotateO, $startScaleX, $startScaleY, $startX, $startY, $tags);
				$dsy = be_haxer_hxswfml_SwfWriter_1($this, $_g, $depth, $dsx, $dx, $dy, $endRotate1, $endRotateO, $endScaleX, $endScaleY, $endX, $endY, $frameCount, $i, $startRotate1, $startRotateO, $startScaleX, $startScaleY, $startX, $startY, $tags);
				$drs0 = be_haxer_hxswfml_SwfWriter_2($this, $_g, $depth, $dsx, $dsy, $dx, $dy, $endRotate1, $endRotateO, $endScaleX, $endScaleY, $endX, $endY, $frameCount, $i, $startRotate1, $startRotateO, $startScaleX, $startScaleY, $startX, $startY, $tags);
				$drs1 = be_haxer_hxswfml_SwfWriter_3($this, $_g, $depth, $drs0, $dsx, $dsy, $dx, $dy, $endRotate1, $endRotateO, $endScaleX, $endScaleY, $endX, $endY, $frameCount, $i, $startRotate1, $startRotateO, $startScaleX, $startScaleY, $startX, $startY, $tags);
				$tags->push($this->moveObject($depth, $dx * 20, $dy * 20, $dsx, $dsy, $drs0, $drs1));
				$tags->push(_hx_array_get($this->showframe(), 0));
				unset($i,$dy,$dx,$dsy,$dsx,$drs1,$drs0);
			}
		}
		return $tags;
	}
	public function moveObject($depth, $x, $y, $scaleX, $scaleY, $rs0, $rs1) {
		$id = null;
		$depth1 = $depth;
		$name = "";
		$move = true;
		$scale = null;
		if($scaleX === null && $scaleY === null) {
			$scale = null;
		} else {
			if($scaleX === null && $scaleY !== null) {
				$scale = _hx_anonymous(array("x" => 1.0, "y" => $scaleY));
			} else {
				if($scaleX !== null && $scaleY === null) {
					$scale = _hx_anonymous(array("x" => $scaleX, "y" => 1.0));
				} else {
					$scale = _hx_anonymous(array("x" => $scaleX, "y" => $scaleY));
				}
			}
		}
		$rotate = null;
		if($rs0 === null && $rs1 === null) {
			$rotate = null;
		} else {
			if($rs0 === null && $rs1 !== null) {
				$rotate = _hx_anonymous(array("rs0" => 0.0, "rs1" => $rs1));
			} else {
				if($rs0 !== null && $rs1 === null) {
					$rotate = _hx_anonymous(array("rs0" => $rs0, "rs1" => 0.0));
				} else {
					$rotate = _hx_anonymous(array("rs0" => $rs0, "rs1" => $rs1));
				}
			}
		}
		$translate = _hx_anonymous(array("x" => $x, "y" => $y));
		$placeObject = new format_swf_PlaceObject();
		$placeObject->depth = $depth1;
		$placeObject->move = $move;
		$placeObject->cid = $id;
		$placeObject->matrix = _hx_anonymous(array("scale" => $scale, "rotate" => $rotate, "translate" => $translate));
		$placeObject->color = null;
		$placeObject->ratio = null;
		$placeObject->instanceName = (($name === "") ? null : $name);
		$placeObject->clipDepth = null;
		$placeObject->events = null;
		$placeObject->filters = null;
		$placeObject->blendMode = null;
		$placeObject->bitmapCache = null;
		return format_swf_SWFTag::TPlaceObject2($placeObject);
	}
	public function readFilterColors($v = null) {
		if($v === null) {
			$v = "0:0xFFFFFF00,255:0x000000FF";
		}
		$arr = _hx_explode(",", $this->getString("colors", $v, false));
		$colors = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $arr->length) {
				$i = $arr[$_g];
				++$_g;
				$pair = _hx_explode(":", $i);
				$colors->push(_hx_anonymous(array("position" => Std::parseInt($pair[0]), "color" => $this->toRGBA($pair[1]))));
				unset($pair,$i);
			}
		}
		return $colors;
	}
	public function readFilterFlags($b1 = null, $b2 = null, $b3 = null, $v = null) {
		if($v === null) {
			$v = 1;
		}
		if($b3 === null) {
			$b3 = false;
		}
		if($b2 === null) {
			$b2 = false;
		}
		if($b1 === null) {
			$b1 = false;
		}
		return _hx_anonymous(array("inner" => $this->getBool("inner", $b1, false), "knockout" => $this->getBool("knockout", $b2, false), "ontop" => $this->getBool("ontop", $b3, false), "passes" => $this->getInt("passes", $v, false, null, null)));
	}
	public function readColorMatrix() {
		$arr = _hx_explode(",", $this->getString("data", "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1", false));
		$data = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $arr->length) {
				$i = $arr[$_g];
				++$_g;
				$data->push(Std::parseFloat($i));
				unset($i);
			}
		}
		return $data;
	}
	public function readGradientBevel() {
		return _hx_anonymous(array("colors" => $this->readFilterColors("0:0xFFFFFFFF,128:0xFF000000,255:0x000000FF"), "data" => _hx_anonymous(array("color" => null, "color2" => null, "blurX" => be_haxer_hxswfml_SwfWriter_4($this), "blurY" => be_haxer_hxswfml_SwfWriter_5($this), "angle" => be_haxer_hxswfml_SwfWriter_6($this), "distance" => be_haxer_hxswfml_SwfWriter_7($this), "strength" => be_haxer_hxswfml_SwfWriter_8($this), "flags" => $this->readFilterFlags(true, false, false, 1)))));
	}
	public function readGradientGlow() {
		return _hx_anonymous(array("colors" => $this->readFilterColors(null), "data" => _hx_anonymous(array("color" => null, "color2" => null, "blurX" => be_haxer_hxswfml_SwfWriter_9($this), "blurY" => be_haxer_hxswfml_SwfWriter_10($this), "angle" => be_haxer_hxswfml_SwfWriter_11($this), "distance" => be_haxer_hxswfml_SwfWriter_12($this), "strength" => be_haxer_hxswfml_SwfWriter_13($this), "flags" => $this->readFilterFlags(null, null, null, null)))));
	}
	public function readDropShadow() {
		return _hx_anonymous(array("color" => $this->toRGBA($this->getString("color1", "0x000000FF", false)), "color2" => null, "blurX" => be_haxer_hxswfml_SwfWriter_14($this), "blurY" => be_haxer_hxswfml_SwfWriter_15($this), "angle" => be_haxer_hxswfml_SwfWriter_16($this), "distance" => be_haxer_hxswfml_SwfWriter_17($this), "strength" => be_haxer_hxswfml_SwfWriter_18($this), "flags" => $this->readFilterFlags(null, null, null, null)));
	}
	public function readBevel() {
		return _hx_anonymous(array("color" => $this->toRGBA($this->getString("color1", "0xFFFFFFFF", false)), "color2" => $this->toRGBA($this->getString("color2", "0x000000FF", false)), "blurX" => be_haxer_hxswfml_SwfWriter_19($this), "blurY" => be_haxer_hxswfml_SwfWriter_20($this), "angle" => be_haxer_hxswfml_SwfWriter_21($this), "distance" => be_haxer_hxswfml_SwfWriter_22($this), "strength" => be_haxer_hxswfml_SwfWriter_23($this), "flags" => $this->readFilterFlags(true, false, false, 1)));
	}
	public function readGlow() {
		return _hx_anonymous(array("color" => $this->toRGBA($this->getString("color", "0xFF0000FF", false)), "color2" => null, "blurX" => be_haxer_hxswfml_SwfWriter_24($this), "blurY" => be_haxer_hxswfml_SwfWriter_25($this), "angle" => 0, "distance" => 0, "strength" => be_haxer_hxswfml_SwfWriter_26($this), "flags" => $this->readFilterFlags(null, null, null, null)));
	}
	public function readBlur() {
		return _hx_anonymous(array("blurX" => be_haxer_hxswfml_SwfWriter_27($this), "blurY" => be_haxer_hxswfml_SwfWriter_28($this), "passes" => $this->getInt("passes", 1, false, null, null)));
	}
	public function placeobject() {
		$id = $this->getInt("id", null, null, null, null);
		if($id !== null) {
			$this->checkTargetId($id);
		}
		$depth = $this->getInt("depth", null, true, null, null);
		$name = $this->getString("name", "", null);
		$move = $this->getBool("move", false, null);
		$bm = strtolower($this->getString("blendMode", "", null));
		$blendMode = be_haxer_hxswfml_SwfWriter_29($this, $bm, $depth, $id, $move, $name);
		$placeObject = new format_swf_PlaceObject();
		$placeObject->depth = $depth;
		$placeObject->move = $move;
		$placeObject->cid = $id;
		$placeObject->matrix = $this->getMatrix();
		$placeObject->color = null;
		$placeObject->ratio = null;
		$placeObject->instanceName = (($name === "") ? null : $name);
		$placeObject->clipDepth = null;
		$placeObject->events = null;
		$placeObject->blendMode = $blendMode;
		$placeObject->bitmapCache = $this->getInt("bitmapCache", null, false, null, null);
		$placeObject->className = $this->getString("className", null, false);
		$placeObject->hasImage = $this->getBool("hasImage", false, false);
		$filters = null;
		if($this->currentTag->elements()->hasNext()) {
			$filters = new _hx_array(array());
		}
		if(null == $this->currentTag) throw new HException('null iterable');
		$__hx__it = $this->currentTag->elements();
		while($__hx__it->hasNext()) {
			$tag = $__hx__it->next();
			$this->setCurrentElement($tag);
			switch(strtolower($this->currentTag->get_nodeName())) {
			case "blur":{
				$filters->push(format_swf_Filter::FBlur($this->readBlur()));
			}break;
			case "glow":{
				$filters->push(format_swf_Filter::FGlow($this->readGlow()));
			}break;
			case "bevel":{
				$filters->push(format_swf_Filter::FBevel($this->readBevel()));
			}break;
			case "dropshadow":{
				$filters->push(format_swf_Filter::FDropShadow($this->readDropShadow()));
			}break;
			case "gradientglow":{
				$filters->push(format_swf_Filter::FGradientGlow($this->readGradientGlow()));
			}break;
			case "gradientbevel":{
				$filters->push(format_swf_Filter::FGradientBevel($this->readGradientBevel()));
			}break;
			case "colormatrix":{
				$filters->push(format_swf_Filter::FColorMatrix($this->readColorMatrix()));
			}break;
			default:{
				$this->error("ERROR: " . _hx_string_or_null($this->currentTag->get_nodeName()) . " is not allowed inside a PlaceObject element. Valid children are: " . _hx_string_or_null($this->validChildren->get("placeobject")->toString()) . ". TAG: " . _hx_string_or_null($this->currentTag->toString()));
			}break;
			}
		}
		$placeObject->filters = $filters;
		return format_swf_SWFTag::TPlaceObject3($placeObject);
	}
	public function definescalinggrid() {
		$id = $this->getInt("id", null, true, false, true);
		$x = $this->getInt("x", null, true, null, null) * 20;
		$y = $this->getInt("y", null, true, null, null) * 20;
		$width = $this->getInt("width", null, true, null, null) * 20;
		$height = $this->getInt("height", null, true, null, null) * 20;
		$splitter = _hx_anonymous(array("left" => $x, "right" => $x + $width, "top" => $y, "bottom" => $y + $height));
		return format_swf_SWFTag::TDefineScalingGrid($id, $splitter);
	}
	public function defineabc() {
		$abcTags = new _hx_array(array());
		$name = $this->getString("name", null, false);
		$remap = $this->getString("remap", "", null);
		$file = null;
		if($this->currentTag->elements()->hasNext()) {
			$abcWriter = new be_haxer_hxswfml_AbcWriter();
			$abcWriter->name = $name;
			$abcWriter->write($this->currentTag->elements()->next()->toString());
			$abcTags = $abcWriter->getTags();
		} else {
			$file = $this->getString("file", "", true);
			if(StringTools::endsWith($file, ".abc")) {
				$abc = $this->getBytes($file);
				$abcTags->push(format_swf_SWFTag::TActionScript3($abc, (($name === null) ? null : _hx_anonymous(array("id" => 1, "label" => $name)))));
			} else {
				if(StringTools::endsWith($file, ".swf")) {
					$addDocumentClassSymbol = $this->getBool("isBoot", false, false);
					$docClass = null;
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
							$ctx = $__hx__t->params[1]; $data = $__hx__t->params[0];
							{
								$abcTags->push(format_swf_SWFTag::TActionScript3($data, $ctx));
							}break;
							case 14:
							$symbols = $__hx__t->params[0];
							{
								if($addDocumentClassSymbol) {
									$_g1 = 0;
									while($_g1 < $symbols->length) {
										$s = $symbols[$_g1];
										++$_g1;
										if($s->cid === 0) {
											$docClass = format_swf_SWFTag::TSymbolClass(new _hx_array(array(_hx_anonymous(array("cid" => 0, "className" => $s->className)))));
										}
										unset($s);
									}
								}
							}break;
							default:{
							}break;
							}
							unset($tag);
						}
					}
					if($abcTags->length === 0) {
						$this->error("ERROR: No ABC files were found inside the given file " . _hx_string_or_null($file) . ". TAG : " . _hx_string_or_null($this->currentTag->toString()));
					}
					if($addDocumentClassSymbol) {
						if($docClass === null) {
							$this->error("ERROR: isBoot=\"true\" but no document class was found inside the given file " . _hx_string_or_null($file) . ". TAG : " . _hx_string_or_null($this->currentTag->toString()));
						}
						$abcTags->push($docClass);
					}
				} else {
					if(StringTools::endsWith($file, ".xml")) {
						$xml = $this->getContent($file);
						$abcWriter = new be_haxer_hxswfml_AbcWriter();
						$abcWriter->name = $name;
						$abcWriter->write($xml);
						$abcTags = $abcWriter->getTags();
					}
				}
			}
		}
		return $abcTags;
	}
	public function defineedittext() {
		$id = $this->getInt("id", null, true, true, null);
		$fontID = $this->getInt("fontID", null, null, null, null);
		if($this->strict && $fontID !== null && $this->dictionary[$fontID] !== "definefont") {
			$this->error("ERROR: The id " . _hx_string_rec($fontID, "") . " must be a reference to a DefineFont tag. TAG: " . _hx_string_or_null($this->currentTag->toString()));
		}
		$textColor = $this->getInt("textColor", 0, null, null, null);
		$alpha = Std::int(Math::round($this->getFloat("alpha", 1.0, false) * 255));
		if($alpha > 255 || $alpha < 0) {
			$this->error("ERROR: The valid alpha range is 0 - 1.0 TAG: " . _hx_string_or_null($this->currentTag->toString()));
		}
		return format_swf_SWFTag::TDefineEditText($id, _hx_anonymous(array("bounds" => _hx_anonymous(array("left" => 0, "right" => $this->getInt("width", 100, null, null, null) * 20, "top" => 0, "bottom" => $this->getInt("height", 100, null, null, null) * 20)), "hasText" => (($this->getString("initialText", "", null) !== "") ? true : false), "hasTextColor" => true, "hasMaxLength" => (($this->getInt("maxLength", 0, null, null, null) !== 0) ? true : false), "hasFont" => (($this->getInt("fontID", 0, null, null, null) !== 0) ? true : false), "hasFontClass" => (($this->getString("fontClass", "", null) !== "") ? true : false), "hasLayout" => (($this->getInt("align", 0, null, null, null) !== 0 || $this->getInt("leftMargin", 0, null, null, null) * 20 !== 0 || $this->getInt("rightMargin", 0, null, null, null) * 20 !== 0 || $this->getInt("indent", 0, null, null, null) * 20 !== 0 || $this->getInt("leading", 0, null, null, null) * 20 !== 0) ? true : false), "wordWrap" => $this->getBool("wordWrap", true, null), "multiline" => $this->getBool("multiline", true, null), "password" => $this->getBool("password", false, null), "input" => !$this->getBool("input", false, null), "autoSize" => $this->getBool("autoSize", false, null), "selectable" => !$this->getBool("selectable", false, null), "border" => $this->getBool("border", false, null), "wasStatic" => $this->getBool("wasStatic", false, null), "html" => $this->getBool("html", false, null), "useOutlines" => $this->getBool("useOutlines", false, null), "fontID" => $this->getInt("fontID", null, null, null, null), "fontClass" => $this->getString("fontClass", "", null), "fontHeight" => $this->getInt("fontHeight", 12, null, null, null) * 20, "textColor" => _hx_anonymous(array("r" => ($textColor & 16711680) >> 16, "g" => ($textColor & 65280) >> 8, "b" => $textColor & 255, "a" => $alpha)), "maxLength" => $this->getInt("maxLength", 0, null, null, null), "align" => $this->getInt("align", 0, null, null, null), "leftMargin" => $this->getInt("leftMargin", 0, null, null, null) * 20, "rightMargin" => $this->getInt("rightMargin", 0, null, null, null) * 20, "indent" => $this->getInt("indent", 0, null, null, null) * 20, "leading" => $this->getInt("leading", 0, null, null, null) * 20, "variableName" => $this->getString("variableName", "", null), "initialText" => $this->getString("initialText", "", null))));
	}
	public function definefont() {
		$_id = $this->getInt("id", null, true, true, null);
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
				$ranges = $this->getString("charCodes", "32-125", false);
				$fontName = $this->getString("name", null, false);
				$fontWriter = new be_haxer_hxswfml_FontWriter();
				$fontWriter->write($bytes, $ranges, "swf", $fontName);
				$fontTag = $fontWriter->getTag($_id);
			} else {
				if($extension === "otf") {
					$bytes = $this->getBytes($file);
					$fontWriter = new be_haxer_hxswfml_FontWriter();
					$name = $this->getString("name", "", true);
					$fontTag = $fontWriter->writeOTF($_id, $name, $bytes);
					if($fontTag === null) {
						$this->error("ERROR: Not a valid OTTO OTF font file: " . _hx_string_or_null($file) . ", TAG: " . _hx_string_or_null($this->currentTag->toString()));
					}
				} else {
					$this->error("ERROR: Not a valid font file:" . _hx_string_or_null($file) . ", TAG: " . _hx_string_or_null($this->currentTag->toString()) . "Valid file types are: .swf and .ttf");
				}
			}
		}
		return $fontTag;
	}
	public function definebinarydata() {
		$id = $this->getInt("id", null, true, true, null);
		$file = $this->getString("file", "", true);
		$bytes = $this->getBytes($file);
		return format_swf_SWFTag::TBinaryData($id, $bytes);
	}
	public function definesound() {
		$file = $this->getString("file", "", true);
		$sid = $this->getInt("id", null, true, true, null);
		$this->checkFileExistence($file);
		$mp3FileBytes = sys_io_File::read($file, true);
		$audioWriter = new be_haxer_hxswfml_AudioWriter();
		$audioWriter->write($mp3FileBytes, $this->currentTag);
		return $audioWriter->getTag($sid);
	}
	public function definebutton() {
		$id = $this->getInt("id", null, true, true, null);
		$buttonRecords = new _hx_array(array());
		if(null == $this->currentTag) throw new HException('null iterable');
		$__hx__it = $this->currentTag->elements();
		while($__hx__it->hasNext()) {
			$buttonRecord = $__hx__it->next();
			$this->setCurrentElement($buttonRecord);
			switch(strtolower($this->currentTag->get_nodeName())) {
			case "buttonstate":{
				$hit = $this->getBool("hit", false, null);
				$down = $this->getBool("down", false, null);
				$over = $this->getBool("over", false, null);
				$up = $this->getBool("up", false, null);
				if($hit === false && $down === false && $over === false && $up === false) {
					$this->error("ERROR: You need to set at least one button state to true. TAG: " . _hx_string_or_null($this->currentTag->toString()));
				}
				$id1 = $this->getInt("id", null, true, false, true);
				$depth = $this->getInt("depth", null, true, null, null);
				$buttonRecords->push(_hx_anonymous(array("hit" => $hit, "down" => $down, "over" => $over, "up" => $up, "id" => $id1, "depth" => $depth, "matrix" => $this->getMatrix())));
			}break;
			default:{
				$this->error("ERROR: " . _hx_string_or_null($this->currentTag->get_nodeName()) . " is not allowed inside a DefineButton element. Valid children are: " . _hx_string_or_null($this->validChildren->get("definebutton")->toString()) . ". TAG: " . _hx_string_or_null($this->currentTag->toString()));
			}break;
			}
		}
		if($buttonRecords->length === 0) {
			$this->error("ERROR: You need to supply at least one buttonstate element. TAG: " . _hx_string_or_null($this->currentTag->toString()));
		}
		return format_swf_SWFTag::TDefineButton2($id, $buttonRecords);
	}
	public function definesprite() {
		$id = $this->getInt("id", null, true, true, null);
		$file = $this->getString("file", "", false);
		if($file !== "") {
			$fps = $this->getInt("fps", null, false, false, null);
			if($fps === null) {
				$fps = 12;
			}
			$w = $this->getInt("width", null, false, false, null);
			if($w === null) {
				$w = 320;
			}
			$h = $this->getInt("height", null, false, false, null);
			if($h === null) {
				$h = 240;
			}
			$bytes = $this->getBytes($file);
			$videoWriter = new be_haxer_hxswfml_VideoWriter();
			$videoWriter->write($bytes, $id, $fps, $w, $h);
			return $videoWriter->getTags();
		} else {
			$frameCount = $this->getInt("frameCount", 1, null, null, null);
			$tags = new _hx_array(array());
			if(null == $this->currentTag) throw new HException('null iterable');
			$__hx__it = $this->currentTag->elements();
			while($__hx__it->hasNext()) {
				$tag = $__hx__it->next();
				$this->setCurrentElement($tag);
				switch(strtolower($this->currentTag->get_nodeName())) {
				case "placeobject":{
					$tags->push($this->placeobject());
				}break;
				case "removeobject":{
					$tags->push($this->removeobject());
				}break;
				case "startsound":{
					$tags->push($this->startsound());
				}break;
				case "framelabel":{
					$tags->push($this->framelabel());
				}break;
				case "showframe":{
					$showFrames = $this->showframe();
					{
						$_g = 0;
						while($_g < $showFrames->length) {
							$tag1 = $showFrames[$_g];
							++$_g;
							$tags->push($tag1);
							unset($tag1);
						}
					}
				}break;
				case "endframe":{
					$tags->push($this->endframe());
				}break;
				case "tween":{
					$_g = 0; $_g1 = $this->tween();
					while($_g < $_g1->length) {
						$tag1 = $_g1[$_g];
						++$_g;
						$tags->push($tag1);
						unset($tag1);
					}
				}break;
				default:{
					$this->error("ERROR: " . _hx_string_or_null($this->currentTag->get_nodeName()) . " is not allowed inside a DefineSprite element. Valid children are: " . _hx_string_or_null($this->validChildren->get("definesprite")->toString()) . ". TAG: " . _hx_string_or_null($this->currentTag->toString()));
				}break;
				}
			}
			return new _hx_array(array(format_swf_SWFTag::TClip($id, $frameCount, $tags)));
		}
	}
	public function defineshape() {
		$id = $this->getInt("id", null, true, true, null);
		$bounds = null;
		$shapeWithStyle = null;
		if($this->currentTag->exists("bitmapId")) {
			$bitmapId = $this->getInt("bitmapId", null, null, null, null);
			if($this->strict && !($this->dictionary[$bitmapId] === "definebitsjpeg" || $this->dictionary[$bitmapId] === "definebitslossless")) {
				$this->error("ERROR: bitmapId " . _hx_string_rec($bitmapId, "") . " must be a reference to a DefineBitsJPEG or DefineBitsLossless tag. TAG: " . _hx_string_or_null($this->currentTag->toString()));
			}
			$width = $this->bitmapIds[$bitmapId]->a[0] * 20;
			$height = $this->bitmapIds[$bitmapId]->a[1] * 20;
			$scaleX = $this->getFloat("scaleX", 1.0, null) * 20;
			$scaleY = $this->getFloat("scaleY", 1.0, null) * 20;
			$scale = _hx_anonymous(array("x" => $scaleX, "y" => $scaleY));
			$rotate0 = $this->getFloat("rotate0", 0.0, null);
			$rotate1 = $this->getFloat("rotate1", 0.0, null);
			$rotate = _hx_anonymous(array("rs0" => $rotate0, "rs1" => $rotate1));
			$x = $this->getInt("x", 0, null, null, null) * 20;
			$y = $this->getInt("y", 0, null, null, null) * 20;
			$translate = _hx_anonymous(array("x" => $x, "y" => $y));
			$repeat = $this->getBool("repeat", false, null);
			$smooth = $this->getBool("smooth", false, null);
			$bounds = _hx_anonymous(array("left" => $x, "right" => $x + $width, "top" => $y, "bottom" => $y + $height));
			$shapeWithStyle = _hx_anonymous(array("fillStyles" => new _hx_array(array(format_swf_FillStyle::FSBitmap($bitmapId, _hx_anonymous(array("scale" => $scale, "rotate" => $rotate, "translate" => $translate)), $repeat, $smooth))), "lineStyles" => new _hx_array(array()), "shapeRecords" => new _hx_array(array(format_swf_ShapeRecord::SHRChange(_hx_anonymous(array("moveTo" => _hx_anonymous(array("dx" => $x + $width, "dy" => $y)), "fillStyle0" => _hx_anonymous(array("idx" => 1)), "fillStyle1" => null, "lineStyle" => null, "newStyles" => null))), format_swf_ShapeRecord::SHREdge($x, $y + $height), format_swf_ShapeRecord::SHREdge($x - $width, $y), format_swf_ShapeRecord::SHREdge($x, $y - $height), format_swf_ShapeRecord::SHREdge($x + $width, $y), format_swf_ShapeRecord::$SHREnd))));
			return format_swf_SWFTag::TShape($id, format_swf_ShapeData::SHDShape1($bounds, $shapeWithStyle));
		} else {
			$shapeType = $this->getInt("shapeType", 4, false, false, false);
			$shapeWriter = new be_haxer_hxswfml_ShapeWriter($shapeType < 4);
			$shapeWriter->shapeType = $shapeType;
			if(null == $this->currentTag) throw new HException('null iterable');
			$__hx__it = $this->currentTag->elements();
			while($__hx__it->hasNext()) {
				$cmd = $__hx__it->next();
				$this->setCurrentElement($cmd);
				switch(strtolower($this->currentTag->get_nodeName())) {
				case "beginfill":{
					$color = $this->getInt("color", 0, null, null, null);
					$alpha = $this->getFloat("alpha", 1.0, null);
					$shapeWriter->beginFill($color, $alpha);
				}break;
				case "begingradientfill":{
					$type = $this->getString("type", "", true);
					switch($type) {
					case "linear":case "radial":{
						$colors = _hx_explode(",", $this->getString("colors", "", true));
						$alphas = _hx_explode(",", $this->getString("alphas", "", true));
						$ratios = _hx_explode(",", $this->getString("ratios", "", true));
						$x = $this->getFloat("x", 0.0, null);
						$y = $this->getFloat("y", 0.0, null);
						$scaleX = $this->getFloat("scaleX", 1.0, null);
						$scaleY = $this->getFloat("scaleY", 1.0, null);
						$rotate0 = $this->getFloat("rotate0", 0.0, null);
						$rotate1 = $this->getFloat("rotate1", 0.0, null);
						$shapeWriter->beginGradientFill($type, $colors, $alphas, $ratios, $x, $y, $scaleX, $scaleY, $rotate0, $rotate1);
					}break;
					default:{
						$this->error("ERROR! Invalid gradient type " . _hx_string_or_null($type) . ". Valid types are: radial,linear. TAG: " . _hx_string_or_null($this->currentTag->toString()));
					}break;
					}
				}break;
				case "beginbitmapfill":{
					$bitmapId = $this->getInt("bitmapId", null, true, null, null);
					if($this->strict && !($this->dictionary[$bitmapId] === "definebitsjpeg" || $this->dictionary[$bitmapId] === "definebitslossless")) {
						$this->error("ERROR: bitmapId " . _hx_string_rec($bitmapId, "") . " must be a reference to a DefineBitsJPEG or DefineBitsLossless tag. TAG: " . _hx_string_or_null($this->currentTag->toString()));
					}
					$scaleX = $this->getFloat("scaleX", 1.0, null);
					$scaleY = $this->getFloat("scaleY", 1.0, null);
					$scale = _hx_anonymous(array("x" => $scaleX, "y" => $scaleY));
					$rotate0 = $this->getFloat("rotate0", 0.0, null);
					$rotate1 = $this->getFloat("rotate1", 0.0, null);
					$rotate = _hx_anonymous(array("rs0" => $rotate0, "rs1" => $rotate1));
					$x = $this->getInt("x", 0, null, null, null);
					$y = $this->getInt("y", 0, null, null, null);
					$translate = _hx_anonymous(array("x" => $x, "y" => $y));
					$repeat = $this->getBool("repeat", false, null);
					$smooth = $this->getBool("smooth", false, null);
					$shapeWriter->beginBitmapFill($bitmapId, $x, $y, $scaleX, $scaleY, $rotate0, $rotate1, $repeat, $smooth);
				}break;
				case "linestyle":{
					$width = $this->getFloat("width", 1.0, null);
					$color = $this->getInt("color", 0, null, null, null);
					$alpha = $this->getFloat("alpha", 1.0, null);
					$pixelHinting = $this->getBool("pixelHinting", null, null);
					$scaleMode = $this->getString("scaleMode", null, null);
					$caps = $this->getString("caps", null, null);
					$joints = $this->getString("joints", null, null);
					$miterLimit = $this->getInt("miterLimit", null, null, null, null);
					$noClose = $this->getBool("noClose", null, null);
					$shapeWriter->lineStyle($width, $color, $alpha, $pixelHinting, $scaleMode, $caps, $joints, $miterLimit, $noClose);
				}break;
				case "moveto":{
					$x = $this->getFloat("x", 0.0, null);
					$y = $this->getFloat("y", 0.0, null);
					$shapeWriter->moveTo($x, $y);
				}break;
				case "lineto":{
					$x = $this->getFloat("x", 0.0, null);
					$y = $this->getFloat("y", 0.0, null);
					$shapeWriter->lineTo($x, $y);
				}break;
				case "curveto":{
					$cx = $this->getFloat("cx", 0.0, null);
					$cy = $this->getFloat("cy", 0.0, null);
					$ax = $this->getFloat("ax", 0.0, null);
					$ay = $this->getFloat("ay", 0.0, null);
					$shapeWriter->curveTo($cx, $cy, $ax, $ay);
				}break;
				case "endfill":{
					$shapeWriter->endFill();
				}break;
				case "endline":{
					$shapeWriter->endLine();
				}break;
				case "clear":{
					$shapeWriter->clear();
				}break;
				case "drawcircle":{
					$x = $this->getFloat("x", 0.0, null);
					$y = $this->getFloat("y", 0.0, null);
					$r = $this->getFloat("r", 0.0, null);
					$sections = $this->getInt("sections", 16, null, null, null);
					$shapeWriter->drawCircle($x, $y, $r, $sections);
				}break;
				case "drawellipse":{
					$x = $this->getFloat("x", 0.0, null);
					$y = $this->getFloat("y", 0.0, null);
					$w = $this->getFloat("width", 0.0, null);
					$h = $this->getFloat("height", 0.0, null);
					$shapeWriter->drawEllipse($x, $y, $w, $h);
				}break;
				case "drawrect":{
					$x = $this->getFloat("x", 0.0, null);
					$y = $this->getFloat("y", 0.0, null);
					$w = $this->getFloat("width", 0.0, null);
					$h = $this->getFloat("height", 0.0, null);
					$shapeWriter->drawRect($x, $y, $w, $h);
				}break;
				case "drawroundrect":{
					$x = $this->getFloat("x", 0.0, null);
					$y = $this->getFloat("y", 0.0, null);
					$w = $this->getFloat("width", 0.0, null);
					$h = $this->getFloat("height", 0.0, null);
					$r = $this->getFloat("r", 0.0, null);
					$shapeWriter->drawRoundRect($x, $y, $w, $h, $r);
				}break;
				case "drawroundrectcomplex":{
					$x = $this->getFloat("x", 0.0, null);
					$y = $this->getFloat("y", 0.0, null);
					$w = $this->getFloat("width", 0.0, null);
					$h = $this->getFloat("height", 0.0, null);
					$rtl = $this->getFloat("rtl", 0.0, null);
					$rtr = $this->getFloat("rtr", 0.0, null);
					$rbl = $this->getFloat("rbl", 0.0, null);
					$rbr = $this->getFloat("rbr", 0.0, null);
					$shapeWriter->drawRoundRectComplex($x, $y, $w, $h, $rtl, $rtr, $rbl, $rbr);
				}break;
				default:{
					$this->error("ERROR: " . _hx_string_or_null($this->currentTag->get_nodeName()) . " is not allowed inside a DefineShape element. Valid children are: " . _hx_string_or_null($this->validChildren->get("defineshape")->toString()) . ". TAG: " . _hx_string_or_null($this->currentTag->toString()));
				}break;
				}
			}
			return $shapeWriter->getTag($id, null, null, null);
		}
	}
	public function definebitslossless() {
		$id = $this->getInt("id", null, true, true, null);
		$file = $this->getString("file", "", true);
		$bytes = $this->getBytes($file);
		$imageWriter = new be_haxer_hxswfml_ImageWriter();
		$imageWriter->write($bytes, $file, $this->currentTag);
		$this->bitmapIds[$id] = new _hx_array(array($imageWriter->width, $imageWriter->height));
		return $imageWriter->getTag($id, true);
	}
	public function definebitsjpeg() {
		$id = $this->getInt("id", null, true, true, null);
		$file = $this->getString("file", "", true);
		$bytes = $this->getBytes($file);
		$imageWriter = new be_haxer_hxswfml_ImageWriter();
		$imageWriter->write($bytes, $file, $this->currentTag);
		$this->bitmapIds[$id] = new _hx_array(array($imageWriter->width, $imageWriter->height));
		return $imageWriter->getTag($id, false);
	}
	public function metadata() {
		$file = $this->getString("file", "", true);
		$data = $this->getContent($file);
		return format_swf_SWFTag::TMetadata($data);
	}
	public function scriptlimits() {
		$maxRecursion = $this->getInt("maxRecursionDepth", 256, null, null, null);
		$timeoutSeconds = $this->getInt("scriptTimeoutSeconds", 15, null, null, null);
		return format_swf_SWFTag::TScriptLimits($maxRecursion, $timeoutSeconds);
	}
	public function setbackgroundcolor() {
		return format_swf_SWFTag::TBackgroundColor($this->getInt("color", 16777215, null, null, null));
	}
	public function fileattributes() {
		if($this->strict && $this->tagIndex !== 0) {
			$this->error("ERROR: The FileAttributes tag must be the first tag. TAG: " . _hx_string_or_null($this->currentTag->toString()));
		}
		return format_swf_SWFTag::TSandBox(_hx_anonymous(array("useDirectBlit" => $this->getBool("useDirectBlit", false, null), "useGPU" => $this->getBool("useGPU", false, null), "hasMetaData" => $this->getBool("hasMetaData", false, null), "actionscript3" => $this->getBool("actionscript3", true, null), "useNetWork" => $this->getBool("useNetwork", false, null))));
	}
	public function header() {
		return _hx_anonymous(array("version" => $this->getInt("version", 10, null, null, null), "compressed" => $this->getBool("compressed", true, null), "width" => $this->getInt("width", 800, null, null, null), "height" => $this->getInt("height", 600, null, null, null), "fps" => $this->getInt("fps", 30, null, null, null), "nframes" => $this->getInt("frameCount", 1, null, null, null)));
	}
	public function init() {
		$this->validElements = new haxe_ds_StringMap();
		$this->validElements->set("swf", new _hx_array(array("width", "height", "fps", "version", "compressed", "frameCount")));
		$this->validElements->set("fileattributes", new _hx_array(array("actionscript3", "useNetwork", "useDirectBlit", "useGPU", "hasMetaData")));
		$this->validElements->set("setbackgroundcolor", new _hx_array(array("color")));
		$this->validElements->set("scriptlimits", new _hx_array(array("maxRecursionDepth", "scriptTimeoutSeconds")));
		$this->validElements->set("definebitsjpeg", new _hx_array(array("id", "file")));
		$this->validElements->set("definebitslossless", new _hx_array(array("id", "file")));
		$this->validElements->set("defineshape", new _hx_array(array("id", "bitmapId", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1", "repeat", "smooth", "shapeType")));
		$this->validElements->set("beginfill", new _hx_array(array("color", "alpha")));
		$this->validElements->set("begingradientfill", new _hx_array(array("colors", "alphas", "ratios", "type", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1")));
		$this->validElements->set("beginbitmapfill", new _hx_array(array("bitmapId", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1", "repeat", "smooth")));
		$this->validElements->set("linestyle", new _hx_array(array("width", "color", "alpha", "pixelHinting", "scaleMode", "caps", "joints", "miterLimit", "noClose")));
		$this->validElements->set("moveto", new _hx_array(array("x", "y")));
		$this->validElements->set("lineto", new _hx_array(array("x", "y")));
		$this->validElements->set("curveto", new _hx_array(array("cx", "cy", "ax", "ay")));
		$this->validElements->set("endfill", new _hx_array(array()));
		$this->validElements->set("endline", new _hx_array(array()));
		$this->validElements->set("clear", new _hx_array(array()));
		$this->validElements->set("drawcircle", new _hx_array(array("x", "y", "r", "sections")));
		$this->validElements->set("drawellipse", new _hx_array(array("x", "y", "width", "height")));
		$this->validElements->set("drawrect", new _hx_array(array("x", "y", "width", "height")));
		$this->validElements->set("drawroundrect", new _hx_array(array("x", "y", "width", "height", "r")));
		$this->validElements->set("drawroundrectcomplex", new _hx_array(array("x", "y", "width", "height", "rtl", "rtr", "rbl", "rbr")));
		$this->validElements->set("definesprite", new _hx_array(array("id", "frameCount", "file", "fps", "width", "height")));
		$this->validElements->set("definebutton", new _hx_array(array("id")));
		$this->validElements->set("buttonstate", new _hx_array(array("id", "depth", "hit", "down", "over", "up", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1")));
		$this->validElements->set("definebinarydata", new _hx_array(array("id", "file")));
		$this->validElements->set("definesound", new _hx_array(array("id", "file")));
		$this->validElements->set("definefont", new _hx_array(array("id", "file", "charCodes", "name")));
		$this->validElements->set("defineedittext", new _hx_array(array("id", "initialText", "fontID", "useOutlines", "width", "height", "wordWrap", "multiline", "password", "input", "autoSize", "selectable", "border", "wasStatic", "html", "fontClass", "fontHeight", "textColor", "alpha", "maxLength", "align", "leftMargin", "rightMargin", "indent", "leading", "variableName", "file")));
		$this->validElements->set("defineabc", new _hx_array(array("file", "name", "isBoot")));
		$this->validElements->set("definescalinggrid", new _hx_array(array("id", "x", "width", "y", "height")));
		$this->validElements->set("placeobject", new _hx_array(array("id", "depth", "name", "move", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1", "blendMode", "bitmapCache", "className", "hasImage")));
		$this->validElements->set("removeobject", new _hx_array(array("depth")));
		$this->validElements->set("startsound", new _hx_array(array("id", "stop", "loopCount")));
		$this->validElements->set("symbolclass", new _hx_array(array("id", "class", "base")));
		$this->validElements->set("exportassets", new _hx_array(array("id", "class")));
		$this->validElements->set("importassets", new _hx_array(array("url")));
		$this->validElements->set("metadata", new _hx_array(array("file")));
		$this->validElements->set("framelabel", new _hx_array(array("name", "anchor")));
		$this->validElements->set("showframe", new _hx_array(array("count")));
		$this->validElements->set("endframe", new _hx_array(array()));
		$this->validElements->set("tween", new _hx_array(array("depth", "frameCount")));
		$this->validElements->set("tw", new _hx_array(array("prop", "start", "end")));
		$this->validElements->set("blur", new _hx_array(array("blurX", "blurY", "passes")));
		$this->validElements->set("colormatrix", new _hx_array(array("data")));
		$this->validElements->set("glow", new _hx_array(array("color", "blurX", "blurY", "strength", "inner", "knockout", "passes")));
		$this->validElements->set("dropshadow", new _hx_array(array("color", "blurX", "blurY", "angle", "distance", "strength", "inner", "knockout", "passes")));
		$this->validElements->set("bevel", new _hx_array(array("color1", "color2", "blurX", "blurY", "angle", "distance", "strength", "inner", "knockout", "ontop", "passes")));
		$this->validElements->set("gradientglow", new _hx_array(array("colors", "blurX", "blurY", "angle", "distance", "strength", "inner", "knockout", "ontop", "passes")));
		$this->validElements->set("gradientbevel", new _hx_array(array("colors", "blurX", "blurY", "angle", "distance", "strength", "inner", "knockout", "ontop", "passes")));
		$this->validElements->set("custom", new _hx_array(array("tagId", "file", "data", "comment")));
		$this->validElements->set("defineswf", new _hx_array(array("file", "data")));
		$this->validChildren = new haxe_ds_StringMap();
		$this->validChildren->set("swf", new _hx_array(array("fileattributes", "setbackgroundcolor", "scriptlimits", "definebitsjpeg", "definebitslossless", "defineshape", "definesprite", "definebutton", "definebinarydata", "definesound", "definefont", "defineedittext", "defineabc", "definescalinggrid", "placeobject", "removeobject", "startsound", "symbolclass", "exportassets", "metadata", "framelabel", "showframe", "endframe", "custom", "defineswf")));
		$this->validChildren->set("defineshape", new _hx_array(array("beginfill", "begingradientfill", "beginbitmapfill", "linestyle", "moveto", "lineto", "curveto", "endfill", "endline", "clear", "drawcircle", "drawellipse", "drawrect", "drawroundrect", "drawroundrectcomplex", "custom")));
		$this->validChildren->set("definesprite", new _hx_array(array("placeobject", "removeobject", "startsound", "framelabel", "showframe", "endframe", "tween", "custom")));
		$this->validChildren->set("definebutton", new _hx_array(array("buttonstate", "custom")));
		$this->validChildren->set("placeobject", new _hx_array(array("dropshadow", "blur", "glow", "bevel", "gradientglow", "colormatrix", "gradientbevel")));
		$this->validChildren->set("tween", new _hx_array(array("tw", "custom")));
		$this->validBaseClasses = new _hx_array(array("flash.display.MovieClip", "flash.display.Sprite", "flash.display.SimpleButton", "flash.display.Bitmap", "flash.display.BitmapData", "flash.media.Sound", "flash.text.Font", "flash.utils.ByteArray"));
	}
	public function getTags() {
		return $this->swf->tags;
	}
	public function getSWC() {
		return _hx_deref(new be_haxer_hxswfml_SwcWriter())->write($this->swcClasses, $this->swfBytes);
	}
	public function getSWF() {
		return $this->swfBytes;
	}
	public function write($input, $strict = null) {
		if($strict === null) {
			$strict = true;
		}
		$this->bitmapIds = new _hx_array(array());
		$this->dictionary = new _hx_array(array());
		$this->swcClasses = new _hx_array(array());
		$this->strict = $strict;
		$xml = Xml::parse($input);
		$root = $xml->firstElement();
		$this->setCurrentElement($root);
		$header = $this->header();
		$tags = new _hx_array(array());
		if(null == $root) throw new HException('null iterable');
		$__hx__it = $root->elements();
		while($__hx__it->hasNext()) {
			$e = $__hx__it->next();
			$this->setCurrentElement($e);
			$obj = call_user_func(Reflect::field($this, strtolower($e->get_nodeName())));
			$__hx__t = (Type::typeof($obj));
			switch($__hx__t->index) {
			case 6:
			$Array = $__hx__t->params[0];
			{
				$_g1 = 0; $_g = _hx_len($obj);
				while($_g1 < $_g) {
					$i = $_g1++;
					$tags->push($obj[$i]);
					unset($i);
				}
			}break;
			default:{
				$tags->push($obj);
			}break;
			}
			$this->tagIndex++;
			unset($obj);
		}
		$swfBytesOutput = new haxe_io_BytesOutput();
		$swfWriter = new format_swf_Writer($swfBytesOutput);
		$swfWriter->write(_hx_anonymous(array("header" => $header, "tags" => $tags)));
		$this->swfBytes = $swfBytesOutput->getBytes();
		return $this->swfBytes;
	}
	public $library;
	public $strict;
	public $tagIndex;
	public $currentTag;
	public $swcClasses;
	public $dictionary;
	public $bitmapIds;
	public $validBaseClasses;
	public $validChildren;
	public $validElements;
	public $swfBytes;
	public $swf;
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
	static function main() {
		new be_haxer_hxswfml_SwfWriter();
	}
	function __toString() { return 'be.haxer.hxswfml.SwfWriter'; }
}
function be_haxer_hxswfml_SwfWriter_0(&$__hx__this, &$_g, &$depth, &$dx, &$dy, &$endRotate1, &$endRotateO, &$endScaleX, &$endScaleY, &$endX, &$endY, &$frameCount, &$i, &$startRotate1, &$startRotateO, &$startScaleX, &$startScaleY, &$startX, &$startY, &$tags) {
	if($startScaleX === null || $endScaleX === null) {
		return null;
	} else {
		return $startScaleX + ($endScaleX - $startScaleX) * $i / $frameCount;
	}
}
function be_haxer_hxswfml_SwfWriter_1(&$__hx__this, &$_g, &$depth, &$dsx, &$dx, &$dy, &$endRotate1, &$endRotateO, &$endScaleX, &$endScaleY, &$endX, &$endY, &$frameCount, &$i, &$startRotate1, &$startRotateO, &$startScaleX, &$startScaleY, &$startX, &$startY, &$tags) {
	if($startScaleY === null || $endScaleY === null) {
		return null;
	} else {
		return $startScaleY + ($endScaleY - $startScaleY) * $i / $frameCount;
	}
}
function be_haxer_hxswfml_SwfWriter_2(&$__hx__this, &$_g, &$depth, &$dsx, &$dsy, &$dx, &$dy, &$endRotate1, &$endRotateO, &$endScaleX, &$endScaleY, &$endX, &$endY, &$frameCount, &$i, &$startRotate1, &$startRotateO, &$startScaleX, &$startScaleY, &$startX, &$startY, &$tags) {
	if($startRotateO === null || $endRotateO === null) {
		return null;
	} else {
		return $startRotateO + ($endRotateO - $startRotateO) * $i / $frameCount;
	}
}
function be_haxer_hxswfml_SwfWriter_3(&$__hx__this, &$_g, &$depth, &$drs0, &$dsx, &$dsy, &$dx, &$dy, &$endRotate1, &$endRotateO, &$endScaleX, &$endScaleY, &$endX, &$endY, &$frameCount, &$i, &$startRotate1, &$startRotateO, &$startScaleX, &$startScaleY, &$startX, &$startY, &$tags) {
	if($startRotate1 === null || $endRotate1 === null) {
		return null;
	} else {
		return $startRotate1 + ($endRotate1 - $startRotate1) * $i / $frameCount;
	}
}
function be_haxer_hxswfml_SwfWriter_4(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurX", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_5(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurY", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_6(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("angle", 45.0, false) * Math::$PI / 180;
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_7(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("distance", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_8(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("strength", 1.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 128) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 256 - $i;
		}
		return $i << 8 | Std::int(($f - $i) * 256.0);
	}
}
function be_haxer_hxswfml_SwfWriter_9(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurX", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_10(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurY", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_11(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("angle", 45.0, false) * Math::$PI / 180;
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_12(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("distance", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_13(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("strength", 1.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 128) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 256 - $i;
		}
		return $i << 8 | Std::int(($f - $i) * 256.0);
	}
}
function be_haxer_hxswfml_SwfWriter_14(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurX", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_15(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurY", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_16(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("angle", 45.0, false) * Math::$PI / 180;
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_17(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("distance", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_18(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("strength", 1.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 128) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 256 - $i;
		}
		return $i << 8 | Std::int(($f - $i) * 256.0);
	}
}
function be_haxer_hxswfml_SwfWriter_19(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurX", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_20(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurY", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_21(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("angle", 45.0, false) * Math::$PI / 180;
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_22(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("distance", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_23(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("strength", 1.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 128) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 256 - $i;
		}
		return $i << 8 | Std::int(($f - $i) * 256.0);
	}
}
function be_haxer_hxswfml_SwfWriter_24(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurX", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_25(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurY", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_26(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("strength", 1.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 128) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 256 - $i;
		}
		return $i << 8 | Std::int(($f - $i) * 256.0);
	}
}
function be_haxer_hxswfml_SwfWriter_27(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurX", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_28(&$__hx__this) {
	{
		$f = $__hx__this->getFloat("blurY", 4.0, false);
		$i = Std::int($f);
		if(((($i > 0) ? $i : -$i)) >= 32768) {
			throw new HException(haxe_io_Error::$Overflow);
		}
		if($i < 0) {
			$i = 65536 - $i;
		}
		return $i << 16 | Std::int(($f - $i) * 65536.0);
	}
}
function be_haxer_hxswfml_SwfWriter_29(&$__hx__this, &$bm, &$depth, &$id, &$move, &$name) {
	switch($bm) {
	case "normal":{
		return format_swf_BlendMode::$BNormal;
	}break;
	case "layer":{
		return format_swf_BlendMode::$BLayer;
	}break;
	case "multiply":{
		return format_swf_BlendMode::$BMultiply;
	}break;
	case "screen":{
		return format_swf_BlendMode::$BScreen;
	}break;
	case "lighten":{
		return format_swf_BlendMode::$BLighten;
	}break;
	case "darken":{
		return format_swf_BlendMode::$BDarken;
	}break;
	case "add":{
		return format_swf_BlendMode::$BAdd;
	}break;
	case "subtract":{
		return format_swf_BlendMode::$BSubtract;
	}break;
	case "difference":{
		return format_swf_BlendMode::$BDifference;
	}break;
	case "invert":{
		return format_swf_BlendMode::$BInvert;
	}break;
	case "alpha":{
		return format_swf_BlendMode::$BAlpha;
	}break;
	case "erase":{
		return format_swf_BlendMode::$BErase;
	}break;
	case "overlay":{
		return format_swf_BlendMode::$BOverlay;
	}break;
	case "hardlight":{
		return format_swf_BlendMode::$BHardLight;
	}break;
	case "":{
		return null;
	}break;
	default:{
		throw new HException("ERROR: Unsupported blendMode" . _hx_string_or_null($bm) . " in PlaceObject element. Valid blendModes are: normal, layer, multiply, screen, lighten, darken, add, subtract, difference, invert, alpha, erase, overlay, hardlight. TAG: " . _hx_string_or_null($__hx__this->currentTag->toString()));
	}break;
	}
}
