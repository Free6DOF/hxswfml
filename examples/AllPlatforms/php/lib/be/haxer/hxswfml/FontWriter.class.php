<?php

class be_haxer_hxswfml_FontWriter {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->init();
	}}
	public function init() {
		$this->precision = 3;
		$this->zipResources_charClass = "\x0D\x0Apackage;\x0D\x0A// this is character: #C\x0D\x0Aclass Char#0 extends flash.display.Shape\x0D\x0A{\x0D\x0A\x09public static inline function commands():Array<Int>{return #commands;}\x0D\x0A\x09public static inline function data():Array<Float>{return #datas;}\x0D\x0A\x0D\x0A#1\x0D\x0A\x09\x0D\x0A\x09public function new(color:Int=0, drawEM:Bool=false, drawBbox:Bool=false, newApi:Bool=false, noFill:Bool=false)\x0D\x0A\x09{\x0D\x0A\x09\x09super();\x0D\x0A\x09\x09noFill?graphics.lineStyle(1, 0):graphics.beginFill(color, 1);\x0D\x0A\x09\x09#if !flash newApi=false; #end\x0D\x0A\x09\x09if(newApi)\x0D\x0A\x09\x09{\x0D\x0A\x09\x09\x09#if flash\x0D\x0A\x09\x09\x09graphics.drawPath(flash.Vector.ofArray(commands()), flash.Vector.ofArray(data()), flash.display.GraphicsPathWinding.EVEN_ODD);\x0D\x0A\x09\x09\x09#end\x0D\x0A\x09\x09}\x0D\x0A\x09\x09else\x0D\x0A\x09\x09{\x0D\x0A#2\x09\x09}\x0D\x0A\x09\x09graphics.endFill();\x0D\x0A\x09\x09\x0D\x0A\x09\x09graphics.lineStyle(1, 0);\x0D\x0A\x09\x09if(drawEM)\x0D\x0A\x09\x09{\x0D\x0A\x09\x09\x09graphics.lineStyle(1, 0xEEEEEE);\x0D\x0A\x09\x09\x09graphics.moveTo(0,(1024-ascent)/2);\x0D\x0A\x09\x09\x09graphics.lineTo(1024, (1024-ascent)/2);\x0D\x0A\x09\x09\x09\x0D\x0A\x09\x09\x09graphics.moveTo(0,1024-(1024-ascent)/2-descent);\x0D\x0A\x09\x09\x09graphics.lineTo(1024, 1024-(1024-ascent)/2-descent);\x0D\x0A\x0D\x0A\x09\x09\x09graphics.lineStyle(1, 0x0000FF);\x0D\x0A\x09\x09\x09graphics.drawRect(0, 0, 1024, 1024);\x0D\x0A\x09\x09\x09\x0D\x0A\x09\x09\x09graphics.lineStyle(1, 0x00FF00);\x0D\x0A\x09\x09\x09graphics.moveTo(xMin+advanceWidth, 0);\x0D\x0A\x09\x09\x09graphics.lineTo(xMin+advanceWidth, 1024);\x0D\x0A\x09\x09}\x0D\x0A\x09\x09if(drawBbox)\x0D\x0A\x09\x09{\x0D\x0A\x09\x09\x09graphics.lineStyle(1, 0xFF0000);\x0D\x0A\x09\x09\x09graphics.drawRect(xMin, 1024-yMax, xMax-xMin, yMax-yMin);\x0D\x0A\x09\x09}\x0D\x0A\x09\x09\x0D\x0A\x09}\x0D\x0A}";
		$this->zipResources_mainClass = "\x0D\x0Apackage;\x0D\x0Aimport flash.display.Sprite;\x0D\x0Aimport flash.display.Shape;\x0D\x0A#1\x0D\x0Aclass Main extends Sprite\x0D\x0A{\x0D\x0A\x09public function new()\x0D\x0A\x09{\x0D\x0A\x09\x09super();\x0D\x0A\x09\x09var charCodes:Array<Int> = #0;\x0D\x0A\x09\x09var scale= 50/1024;\x0D\x0A\x09\x09var vSpace = 10;\x0D\x0A\x09\x09var hSpace = 10;\x0D\x0A\x09\x09var index=0;\x0D\x0A\x09\x09\x0D\x0A\x09\x09var container1 = new Sprite();\x0D\x0A\x09\x09var container2 = new Sprite();\x0D\x0A\x09\x09addChild(container1);\x0D\x0A\x09\x09addChild(container2);\x0D\x0A\x09\x09\x0D\x0A\x09\x09for(i in 0...charCodes.length)\x0D\x0A\x09\x09{\x0D\x0A\x09\x09\x09var glyph1:Shape = Type.createInstance(Type.resolveClass(\"Char\"+charCodes[i]),[0,false,false,true,false]); \x0D\x0A\x09\x09\x09if(index%16==0) index=0;\x0D\x0A\x09\x09\x09glyph1.x = index*(50+hSpace);\x0D\x0A\x09\x09\x09glyph1.y = Std.int(i/16)*(50+vSpace);\x0D\x0A\x09\x09\x09glyph1.scaleX = glyph1.scaleY=scale;\x0D\x0A\x09\x09\x09container1.addChild(glyph1);\x0D\x0A\x09\x09\x09\x0D\x0A\x09\x09\x09var glyph2:Shape = Type.createInstance(Type.resolveClass(\"Char\"+charCodes[i]),[0,true,true,true,true]);\x0D\x0A\x09\x09\x09glyph2.x = glyph1.x;\x0D\x0A\x09\x09\x09glyph2.y = glyph1.y;\x0D\x0A\x09\x09\x09glyph2.scaleX = glyph2.scaleY=scale;\x0D\x0A\x09\x09\x09container2.addChild(glyph2);\x0D\x0A\x09\x09\x09index++;\x0D\x0A\x09\x09}\x0D\x0A\x09\x09container2.graphics.lineStyle(2,0);\x0D\x0A\x09\x09container2.graphics.drawRoundRect(-20,-20, container2.width+40, container2.height+40, 10);\x0D\x0A\x09\x09container1.graphics.lineStyle(2,0);\x0D\x0A\x09\x09container1.graphics.drawRoundRect(-20,-20, container2.width, container1.height+60, 10);\x0D\x0A\x09\x09container1.x=(1024-container1.width)/2+20;\x0D\x0A\x09\x09container1.y=40;\x0D\x0A\x09\x09container2.x=container1.x;\x0D\x0A\x09\x09container2.y=container1.y+container1.height+20;\x0D\x0A\x09}\x0D\x0A\x09public static function main()\x0D\x0A\x09{\x0D\x0A\x09\x09flash.Lib.current.addChild(new Main());\x0D\x0A\x09}\x0D\x0A}\x0D\x0A";
		$this->zipResources_buildFile = "\x0D\x0A-main Main\x0D\x0A-swf #0.swf\x0D\x0A-swf-header 1024:900:30:FFFFFF\x0D\x0A-swf-version 10";
	}
	public function makePath($p1, $p2, $arr, $flags, $xCoordinates, $yCoordinates, $isEndPoint) {
		$p1OnCurve = ($flags->a[$p1] & 1) !== 0;
		$p2OnCurve = ($flags->a[$p2] & 1) !== 0;
		if($p1OnCurve && $p2OnCurve) {
			$arr->push(_hx_anonymous(array("type" => 1, "x" => $xCoordinates[$p2], "y" => $yCoordinates[$p2], "cx" => null, "cy" => null)));
		} else {
			if(!$p1OnCurve && !$p2OnCurve) {
				if($this->implicitStart) {
					$this->implicitStart = false;
					$arr->push(_hx_anonymous(array("type" => 0, "x" => ($xCoordinates->a[$p1] + $xCoordinates[$p2]) / 2, "y" => ($yCoordinates->a[$p1] + $yCoordinates[$p2]) / 2, "cx" => null, "cy" => null)));
					$this->startPoint = _hx_anonymous(array("x" => ($xCoordinates->a[$p1] + $xCoordinates[$p2]) / 2, "y" => ($yCoordinates->a[$p1] + $yCoordinates[$p2]) / 2));
				} else {
					$arr->push(_hx_anonymous(array("type" => 2, "x" => ($xCoordinates->a[$p1] + $xCoordinates[$p2]) / 2, "y" => ($yCoordinates->a[$p1] + $yCoordinates[$p2]) / 2, "cx" => $this->qCpoint->x, "cy" => $this->qCpoint->y)));
				}
				$this->qCpoint = _hx_anonymous(array("x" => $xCoordinates[$p2], "y" => $yCoordinates[$p2], "cx" => null, "cy" => null, "type" => null));
				if($isEndPoint && $this->implicitEnd) {
					$this->implicitEnd = false;
					$arr->push(_hx_anonymous(array("type" => 2, "x" => $this->startPoint->x, "y" => $this->startPoint->y, "cx" => $this->implicitCP->x, "cy" => $this->implicitCP->y)));
				}
			} else {
				if($p1OnCurve && !$p2OnCurve) {
					$this->qCpoint = _hx_anonymous(array("type" => null, "x" => $xCoordinates[$p2], "y" => $yCoordinates[$p2], "cx" => null, "cy" => null));
					if($isEndPoint && $this->implicitEnd) {
						$this->implicitEnd = false;
						$arr->push(_hx_anonymous(array("type" => 2, "x" => $this->startPoint->x, "y" => $this->startPoint->y, "cx" => $this->implicitCP->x, "cy" => $this->implicitCP->y)));
					}
				} else {
					if(!$p1OnCurve && $p2OnCurve) {
						if($this->implicitStart) {
							$this->implicitStart = false;
							$arr->push(_hx_anonymous(array("type" => 0, "x" => $xCoordinates[$p2], "y" => $yCoordinates[$p2], "cx" => null, "cy" => null)));
							$this->startPoint = _hx_anonymous(array("x" => $xCoordinates[$p2], "y" => $yCoordinates[$p2]));
						} else {
							$arr->push(_hx_anonymous(array("type" => 2, "x" => $xCoordinates[$p2], "y" => $yCoordinates[$p2], "cx" => $this->qCpoint->x, "cy" => $this->qCpoint->y)));
						}
						if($isEndPoint && $this->implicitEnd) {
							$this->implicitEnd = false;
							$arr->push(_hx_anonymous(array("type" => 2, "x" => $this->startPoint->x, "y" => $this->startPoint->y, "cx" => $this->implicitCP->x, "cy" => $this->implicitCP->y)));
						}
					}
				}
			}
		}
	}
	public function buildPaths($data) {
		$len = $data->endPtsOfContours->length;
		$xCoordinates = new _hx_array(array());
		{
			$_g = 0; $_g1 = $data->xCoordinates;
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				$xCoordinates->push($i);
				unset($i);
			}
		}
		$yCoordinates = new _hx_array(array());
		{
			$_g = 0; $_g1 = $data->yCoordinates;
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				$yCoordinates->push($i);
				unset($i);
			}
		}
		$cp = 0;
		$start = 0;
		$end = 0;
		$arr = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $len) {
				$i = $_g++;
				$start = $cp;
				$end = $data->endPtsOfContours[$i];
				$this->qCpoint = _hx_anonymous(array("type" => null, "x" => $xCoordinates[$cp], "y" => $yCoordinates[$cp], "cx" => null, "cy" => null));
				if((($data->flags->a[$start] & 1) !== 0) === false) {
					$this->implicitStart = true;
					$this->implicitEnd = true;
					$this->implicitCP = _hx_anonymous(array("x" => $xCoordinates[$cp], "y" => $yCoordinates[$cp]));
				} else {
					$this->implicitStart = false;
					$this->implicitEnd = false;
					$arr->push(_hx_anonymous(array("type" => 0, "x" => $xCoordinates[$cp], "y" => $yCoordinates[$cp], "cx" => null, "cy" => null)));
				}
				{
					$_g2 = 0; $_g1 = $end - $start;
					while($_g2 < $_g1) {
						$j = $_g2++;
						$this->makePath($cp, $cp + 1, $arr, $data->flags, $xCoordinates, $yCoordinates, false);
						$cp++;
						unset($j);
					}
					unset($_g2,$_g1);
				}
				$this->makePath($end, $start, $arr, $data->flags, $xCoordinates, $yCoordinates, true);
				$cp++;
				unset($i);
			}
		}
		return $arr;
	}
	public $implicitCP;
	public $startPoint;
	public $implicitEnd;
	public $implicitStart;
	public $qCpoint;
	public function getSWF($id = null, $className = null, $version = null, $compressed = null, $width = null, $height = null, $fps = null, $nframes = null) {
		if($nframes === null) {
			$nframes = 1;
		}
		if($fps === null) {
			$fps = 30;
		}
		if($height === null) {
			$height = 1000;
		}
		if($width === null) {
			$width = 1000;
		}
		if($compressed === null) {
			$compressed = false;
		}
		if($version === null) {
			$version = 10;
		}
		if($className === null) {
			$className = "MyFont";
		}
		if($id === null) {
			$id = 1;
		}
		$initialText = "";
		$textColor = 255;
		{
			$_g1 = 0; $_g = $this->chars->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$initialText .= _hx_string_or_null(chr($this->chars[$i]));
				unset($i);
			}
		}
		$initialText .= " Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
		$defineEditTextTag = format_swf_SWFTag::TDefineEditText($id + 1, _hx_anonymous(array("bounds" => _hx_anonymous(array("left" => 0, "right" => 20480, "top" => 0, "bottom" => 20480)), "hasText" => true, "hasTextColor" => true, "hasMaxLength" => false, "hasFont" => true, "hasFontClass" => false, "hasLayout" => true, "wordWrap" => true, "multiline" => true, "password" => false, "input" => false, "autoSize" => false, "selectable" => false, "border" => true, "wasStatic" => false, "html" => false, "useOutlines" => true, "fontID" => $id, "fontClass" => "", "fontHeight" => 480, "textColor" => _hx_anonymous(array("r" => ($textColor & -16777216) >> 24, "g" => ($textColor & 16711680) >> 16, "b" => ($textColor & 65280) >> 8, "a" => $textColor & 255)), "maxLength" => 0, "align" => 0, "leftMargin" => 0, "rightMargin" => 0, "indent" => 0, "leading" => Std::int($this->leading / 20), "variableName" => "", "initialText" => $initialText)));
		$placeObject = new format_swf_PlaceObject();
		$placeObject->depth = 1;
		$placeObject->move = false;
		$placeObject->cid = $id + 1;
		$placeObject->matrix = _hx_anonymous(array("scale" => null, "rotate" => null, "translate" => _hx_anonymous(array("x" => 0, "y" => 2000))));
		$placeObject->color = null;
		$placeObject->ratio = null;
		$placeObject->instanceName = "tf";
		$placeObject->clipDepth = null;
		$placeObject->events = null;
		$placeObject->filters = null;
		$placeObject->blendMode = null;
		$placeObject->bitmapCache = null;
		$swfFile = _hx_anonymous(array("header" => _hx_anonymous(array("version" => $version, "compressed" => $compressed, "width" => $width, "height" => $height, "fps" => $fps, "nframes" => $nframes)), "tags" => new _hx_array(array(format_swf_SWFTag::TSandBox(_hx_anonymous(array("useDirectBlit" => false, "useGPU" => false, "hasMetaData" => false, "actionscript3" => true, "useNetWork" => false))), format_swf_SWFTag::TBackgroundColor(16777215), format_swf_SWFTag::TFont($id, $this->fontData3), format_swf_SWFTag::TSymbolClass(new _hx_array(array(_hx_anonymous(array("cid" => $id, "className" => $className))))), $defineEditTextTag, format_swf_SWFTag::TPlaceObject2($placeObject), be_haxer_hxswfml_AbcWriter::createABC($className, "flash.text.Font"), format_swf_SWFTag::$TShowFrame))));
		$swfOutput = new haxe_io_BytesOutput();
		$writer = new format_swf_Writer($swfOutput);
		$writer->write($swfFile);
		$swfBytes = $swfOutput->getBytes();
		return $swfBytes;
	}
	public function getTag($id) {
		return format_swf_SWFTag::TFont($id, $this->fontData3);
	}
	public function getHash($serialize = null) {
		if($serialize === null) {
			$serialize = false;
		}
		if($serialize) {
			return haxe_Serializer::run($this->hash);
		}
		return $this->hash;
	}
	public function getZip() {
		return $this->zip;
	}
	public function getPath() {
		return $this->path;
	}
	public function writePaths($arr) {
		$outputType = $arr[0];
		$paths = $arr[1];
		$shapeWriter = $arr[2];
		$scale = $arr[3];
		$prec = $arr[4];
		$graphicsBuf = $arr[5];
		$commands = $arr[6];
		$datas = $arr[7];
		$shapeRecords = $arr[8];
		$glyphs = $arr[9];
		$charCode = $arr[10];
		$glyphLayouts = $arr[11];
		$advanceWidth = $arr[12];
		if($outputType === "swf") {
			$shapeWriter->beginFill(0, 1);
		}
		{
			$_g1 = 0; $_g = $paths->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$path = $paths[$i];
				switch($path->type) {
				case 0:{
					switch($outputType) {
					case "zip":{
						$x = Std::int($path->x * $scale * $prec) / $prec;
						$y = Std::int((1024 - $path->y * $scale) * $prec) / $prec;
						$graphicsBuf->add("\x09\x09\x09graphics.moveTo(");
						$graphicsBuf->add(Std::string($x));
						$graphicsBuf->add(", ");
						$graphicsBuf->add(Std::string($y));
						$graphicsBuf->add(");\x0A");
						$commands->push(1);
						$datas->push($x);
						$datas->push($y);
					}break;
					case "path":case "hash":{
						$x = Std::int($path->x * $scale * $prec) / $prec;
						$y = Std::int((1024 - $path->y * $scale) * $prec) / $prec;
						$commands->push(1);
						$datas->push($x);
						$datas->push($y);
					}break;
					case "swf":{
						$shapeWriter->moveTo($path->x * $scale, -1 * $path->y * $scale);
					}break;
					}
				}break;
				case 1:{
					switch($outputType) {
					case "zip":{
						$x = Std::int($path->x * $scale * $prec) / $prec;
						$y = Std::int((1024 - $path->y * $scale) * $prec) / $prec;
						$graphicsBuf->add("\x09\x09\x09graphics.lineTo(");
						$graphicsBuf->add(Std::string($x));
						$graphicsBuf->add(", ");
						$graphicsBuf->add(Std::string($y));
						$graphicsBuf->add(");\x0A");
						$commands->push(2);
						$datas->push($x);
						$datas->push($y);
					}break;
					case "path":case "hash":{
						$x = Std::int($path->x * $scale * $prec) / $prec;
						$y = Std::int((1024 - $path->y * $scale) * $prec) / $prec;
						$commands->push(2);
						$datas->push($x);
						$datas->push($y);
					}break;
					case "swf":{
						$shapeWriter->lineTo($path->x * $scale, -1 * $path->y * $scale);
					}break;
					}
				}break;
				case 2:{
					switch($outputType) {
					case "zip":{
						$cx = Std::int($path->cx * $scale * $prec) / $prec;
						$cy = Std::int((1024 - $path->cy * $scale) * $prec) / $prec;
						$x = Std::int($path->x * $scale * $prec) / $prec;
						$y = Std::int((1024 - $path->y * $scale) * $prec) / $prec;
						$graphicsBuf->add("\x09\x09\x09graphics.curveTo(");
						$graphicsBuf->add(Std::string($cx));
						$graphicsBuf->add(", ");
						$graphicsBuf->add(Std::string($cy));
						$graphicsBuf->add(", ");
						$graphicsBuf->add(Std::string($x));
						$graphicsBuf->add(", ");
						$graphicsBuf->add(Std::string($y));
						$graphicsBuf->add(");\x0A");
						$commands->push(3);
						$datas->push($cx);
						$datas->push($cy);
						$datas->push($x);
						$datas->push($y);
					}break;
					case "path":case "hash":{
						$cx = Std::int($path->cx * $scale * $prec) / $prec;
						$cy = Std::int((1024 - $path->cy * $scale) * $prec) / $prec;
						$x = Std::int($path->x * $scale * $prec) / $prec;
						$y = Std::int((1024 - $path->y * $scale) * $prec) / $prec;
						$commands->push(3);
						$datas->push($cx);
						$datas->push($cy);
						$datas->push($x);
						$datas->push($y);
					}break;
					case "swf":{
						$shapeWriter->curveTo($path->cx * $scale, -1 * $path->cy * $scale, $path->x * $scale, -1 * $path->y * $scale);
					}break;
					}
				}break;
				}
				unset($path,$i);
			}
		}
		$shapeRecs = $shapeWriter->getShapeRecords();
		{
			$_g1 = 0; $_g = $shapeRecs->length;
			while($_g1 < $_g) {
				$s = $_g1++;
				$shapeRecords->push($shapeRecs[$s]);
				unset($s);
			}
		}
		$shapeRecords->push(format_swf_ShapeRecord::$SHREnd);
		$glyphs->push(_hx_anonymous(array("charCode" => $charCode, "shape" => _hx_anonymous(array("shapeRecords" => $shapeRecords)))));
		$glyphLayouts->push(_hx_anonymous(array("advance" => Std::int($advanceWidth * $scale * 20), "bounds" => _hx_anonymous(array("left" => 0, "right" => 0, "top" => 0, "bottom" => 0)))));
		$shapeWriter->reset(false);
	}
	public function write($bytes, $rangesStr, $outType = null, $fontName = null) {
		if($outType === null) {
			$outType = "swf";
		}
		$input = new haxe_io_BytesInput($bytes, null, null);
		$reader = new format_ttf_Reader($input);
		$ttf = $reader->read();
		$this->chars = new _hx_array(array());
		$header = $ttf->header;
		$tables = $ttf->tables;
		$glyfData = null;
		$hmtxData = null;
		$cmapData = null;
		$kernData = null;
		$hheaData = null;
		$headData = null;
		$os2Data = null;
		{
			$_g = 0;
			while($_g < $tables->length) {
				$table = $tables[$_g];
				++$_g;
				$__hx__t = ($table);
				switch($__hx__t->index) {
				case 0:
				$descriptions = $__hx__t->params[0];
				{
					$glyfData = $descriptions;
				}break;
				case 1:
				$metrics = $__hx__t->params[0];
				{
					$hmtxData = $metrics;
				}break;
				case 2:
				$subtables = $__hx__t->params[0];
				{
					$cmapData = $subtables;
				}break;
				case 3:
				$kerning = $__hx__t->params[0];
				{
					$kernData = $kerning;
				}break;
				case 6:
				$data = $__hx__t->params[0];
				{
					$hheaData = $data;
				}break;
				case 5:
				$data = $__hx__t->params[0];
				{
					$headData = $data;
				}break;
				case 10:
				$data = $__hx__t->params[0];
				{
					$os2Data = $data;
				}break;
				default:{
				}break;
				}
				unset($table);
			}
		}
		$this->fontName = be_haxer_hxswfml_FontWriter_0($this, $bytes, $cmapData, $fontName, $glyfData, $headData, $header, $hheaData, $hmtxData, $input, $kernData, $os2Data, $outType, $rangesStr, $reader, $tables, $ttf);
		$scale = 1024 / $headData->unitsPerEm;
		$glyphIndexArray = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $cmapData->length) {
				$s = $cmapData[$_g];
				++$_g;
				$__hx__t = ($s);
				switch($__hx__t->index) {
				case 2:
				$array = $__hx__t->params[1]; $header1 = $__hx__t->params[0];
				{
					$glyphIndexArray = $array;
					break 2;
				}break;
				default:{
				}break;
				}
				unset($s);
			}
		}
		if($glyphIndexArray->length === 0) {
			throw new HException("Cmap4 encoding table not found");
		}
		$charCodes = new _hx_array(array());
		$ranges = new _hx_array(array());
		if($rangesStr === "all") {
			$ranges->push(_hx_anonymous(array("start" => 0, "end" => $glyphIndexArray->length - 1)));
		} else {
			$parts = _hx_explode(",", _hx_explode(" ", _hx_explode("]", _hx_explode("[", $rangesStr)->join(""))->join(""))->join(""));
			{
				$_g1 = 0; $_g = $parts->length;
				while($_g1 < $_g) {
					$i = $_g1++;
					if(_hx_index_of($parts[$i], "-", null) === -1) {
						$ranges->push(_hx_anonymous(array("start" => Std::parseInt($parts[$i]), "end" => Std::parseInt($parts[$i]))));
					} else {
						$ranges->push(_hx_anonymous(array("start" => Std::parseInt(_hx_array_get(_hx_explode("-", $parts[$i]), 0)), "end" => Std::parseInt(_hx_array_get(_hx_explode("-", $parts[$i]), 1)))));
					}
					unset($i);
				}
			}
		}
		switch($outType) {
		case "swf":case "zip":case "path":case "hash":{
			$this->outputType = $outType;
		}break;
		default:{
			throw new HException("Unknown output type");
		}break;
		}
		$zipBytesOutput = new haxe_io_BytesOutput();
		$zipWriter = new format_zip_Writer($zipBytesOutput);
		$zipdata = new HList();
		$glyphs = new _hx_array(array());
		$glyphLayouts = new _hx_array(array());
		$kerning = new _hx_array(array());
		$lastCharCode = 0;
		$charObjects = new _hx_array(array());
		$charHash = new haxe_ds_IntMap();
		$importsBuf = new StringBuf();
		$graphicsBuf = new StringBuf();
		$varsBuf = new StringBuf();
		$commands = null;
		$datas = null;
		{
			$_g1 = 0; $_g = $ranges->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(_hx_array_get($ranges, $i)->start > _hx_array_get($ranges, $i)->end) {
					throw new HException("Character ranges must be ascending and non overlapping, " . _hx_string_rec(_hx_array_get($ranges, $i)->start, "") . " should be lower than " . _hx_string_rec(_hx_array_get($ranges, $i)->end, ""));
				}
				if($ranges[$i - 1] !== null && _hx_array_get($ranges, $i)->start <= _hx_array_get($ranges, $i - 1)->end) {
					throw new HException("Character ranges must be ascending and non overlapping, " . _hx_string_rec(_hx_array_get($ranges, $i)->start, "") . " should be higher than " . _hx_string_rec(_hx_array_get($ranges, $i - 1)->end, ""));
				}
				{
					$_g3 = _hx_array_get($ranges, $i)->start; $_g2 = _hx_array_get($ranges, $i)->end + 1;
					while($_g3 < $_g2) {
						$j = $_g3++;
						$commands = new _hx_array(array());
						$datas = new _hx_array(array());
						$graphicsBuf = new StringBuf();
						$varsBuf = new StringBuf();
						$charCode = $j;
						$this->chars->push($j);
						$glyphIndex = null;
						$idx = $glyphIndexArray[$j];
						$glyphIndex = 0;
						if($idx !== null) {
							$glyphIndex = $idx->index;
						}
						$advanceWidth = be_haxer_hxswfml_FontWriter_1($this, $_g, $_g1, $_g2, $_g3, $bytes, $charCode, $charCodes, $charHash, $charObjects, $cmapData, $commands, $datas, $fontName, $glyfData, $glyphIndex, $glyphIndexArray, $glyphLayouts, $glyphs, $graphicsBuf, $headData, $header, $hheaData, $hmtxData, $i, $idx, $importsBuf, $input, $j, $kernData, $kerning, $lastCharCode, $os2Data, $outType, $ranges, $rangesStr, $reader, $scale, $tables, $ttf, $varsBuf, $zipBytesOutput, $zipWriter, $zipdata);
						$leftSideBearing = be_haxer_hxswfml_FontWriter_2($this, $_g, $_g1, $_g2, $_g3, $advanceWidth, $bytes, $charCode, $charCodes, $charHash, $charObjects, $cmapData, $commands, $datas, $fontName, $glyfData, $glyphIndex, $glyphIndexArray, $glyphLayouts, $glyphs, $graphicsBuf, $headData, $header, $hheaData, $hmtxData, $i, $idx, $importsBuf, $input, $j, $kernData, $kerning, $lastCharCode, $os2Data, $outType, $ranges, $rangesStr, $reader, $scale, $tables, $ttf, $varsBuf, $zipBytesOutput, $zipWriter, $zipdata);
						$shapeRecords = new _hx_array(array());
						$shapeWriter = new be_haxer_hxswfml_ShapeWriter(false);
						$header1 = null;
						$prec = Std::int(Math::pow(10, Std::int($this->precision)));
						$__hx__t = ($glyfData[$glyphIndex]);
						switch($__hx__t->index) {
						case 2:
						{
							$glyphs->push(_hx_anonymous(array("charCode" => $charCode, "shape" => _hx_anonymous(array("shapeRecords" => new _hx_array(array(format_swf_ShapeRecord::$SHREnd)))))));
							$glyphLayouts->push(_hx_anonymous(array("advance" => Std::int($advanceWidth * $scale * 20), "bounds" => _hx_anonymous(array("left" => 0, "right" => 0, "top" => 0, "bottom" => 0)))));
							$shapeWriter->reset(false);
						}break;
						case 1:
						$data = $__hx__t->params[1]; $_header = $__hx__t->params[0];
						{
							$paths1 = new _hx_array(array());
							$paths2 = new _hx_array(array());
							if(!($data[0] === null && $data[1] === null)) {
								$header1 = $_header;
								if($data[0] !== null) {
									$c1 = $data[0];
									$part1 = $glyfData[$c1->glyphIndex];
									$dat1 = _hx_array_get(Type::enumParameters($part1), 1);
									$dat1bis = _hx_anonymous(array("endPtsOfContours" => new _hx_array(array()), "instructions" => new _hx_array(array()), "xCoordinates" => new _hx_array(array()), "yCoordinates" => new _hx_array(array()), "flags" => $dat1->flags, "xDeltas" => new _hx_array(array()), "yDeltas" => new _hx_array(array())));
									if($dat1->endPtsOfContours !== null) {
										$_g4 = 0; $_g5 = $dat1->endPtsOfContours;
										while($_g4 < $_g5->length) {
											$i1 = $_g5[$_g4];
											++$_g4;
											$dat1bis->endPtsOfContours->push($i1);
											unset($i1);
										}
									}
									if($dat1->instructions !== null) {
										$_g4 = 0; $_g5 = $dat1->instructions;
										while($_g4 < $_g5->length) {
											$i1 = $_g5[$_g4];
											++$_g4;
											$dat1bis->instructions->push($i1);
											unset($i1);
										}
									}
									if($dat1->xCoordinates !== null) {
										$_g4 = 0; $_g5 = $dat1->xCoordinates;
										while($_g4 < $_g5->length) {
											$i1 = $_g5[$_g4];
											++$_g4;
											$dat1bis->xCoordinates->push(be_haxer_hxswfml_FontWriter_3($this, $_g, $_g1, $_g2, $_g3, $_g4, $_g5, $_header, $advanceWidth, $bytes, $c1, $charCode, $charCodes, $charHash, $charObjects, $cmapData, $commands, $dat1, $dat1bis, $data, $datas, $fontName, $glyfData, $glyphIndex, $glyphIndexArray, $glyphLayouts, $glyphs, $graphicsBuf, $headData, $header, $header1, $hheaData, $hmtxData, $i, $i1, $idx, $importsBuf, $input, $j, $kernData, $kerning, $lastCharCode, $leftSideBearing, $os2Data, $outType, $part1, $paths1, $paths2, $prec, $ranges, $rangesStr, $reader, $scale, $shapeRecords, $shapeWriter, $tables, $ttf, $varsBuf, $zipBytesOutput, $zipWriter, $zipdata));
											unset($i1);
										}
									}
									if($dat1->yCoordinates !== null) {
										$_g4 = 0; $_g5 = $dat1->yCoordinates;
										while($_g4 < $_g5->length) {
											$i1 = $_g5[$_g4];
											++$_g4;
											$dat1bis->yCoordinates->push(be_haxer_hxswfml_FontWriter_4($this, $_g, $_g1, $_g2, $_g3, $_g4, $_g5, $_header, $advanceWidth, $bytes, $c1, $charCode, $charCodes, $charHash, $charObjects, $cmapData, $commands, $dat1, $dat1bis, $data, $datas, $fontName, $glyfData, $glyphIndex, $glyphIndexArray, $glyphLayouts, $glyphs, $graphicsBuf, $headData, $header, $header1, $hheaData, $hmtxData, $i, $i1, $idx, $importsBuf, $input, $j, $kernData, $kerning, $lastCharCode, $leftSideBearing, $os2Data, $outType, $part1, $paths1, $paths2, $prec, $ranges, $rangesStr, $reader, $scale, $shapeRecords, $shapeWriter, $tables, $ttf, $varsBuf, $zipBytesOutput, $zipWriter, $zipdata));
											unset($i1);
										}
									}
									$paths1 = $this->buildPaths($dat1bis);
								}
								if($data->length > 1 && $data[1] !== null) {
									$c2 = $data[1];
									$part2 = $glyfData[$c2->glyphIndex];
									$dat2 = _hx_array_get(Type::enumParameters($part2), 1);
									$dat2bis = _hx_anonymous(array("endPtsOfContours" => new _hx_array(array()), "instructions" => new _hx_array(array()), "xCoordinates" => new _hx_array(array()), "yCoordinates" => new _hx_array(array()), "flags" => $dat2->flags, "xDeltas" => new _hx_array(array()), "yDeltas" => new _hx_array(array())));
									{
										$_g4 = 0; $_g5 = $dat2->endPtsOfContours;
										while($_g4 < $_g5->length) {
											$i1 = $_g5[$_g4];
											++$_g4;
											$dat2bis->endPtsOfContours->push($i1);
											unset($i1);
										}
									}
									{
										$_g4 = 0; $_g5 = $dat2->instructions;
										while($_g4 < $_g5->length) {
											$i1 = $_g5[$_g4];
											++$_g4;
											$dat2bis->instructions->push($i1);
											unset($i1);
										}
									}
									{
										$_g4 = 0; $_g5 = $dat2->xCoordinates;
										while($_g4 < $_g5->length) {
											$i1 = $_g5[$_g4];
											++$_g4;
											$dat2bis->xCoordinates->push(be_haxer_hxswfml_FontWriter_5($this, $_g, $_g1, $_g2, $_g3, $_g4, $_g5, $_header, $advanceWidth, $bytes, $c2, $charCode, $charCodes, $charHash, $charObjects, $cmapData, $commands, $dat2, $dat2bis, $data, $datas, $fontName, $glyfData, $glyphIndex, $glyphIndexArray, $glyphLayouts, $glyphs, $graphicsBuf, $headData, $header, $header1, $hheaData, $hmtxData, $i, $i1, $idx, $importsBuf, $input, $j, $kernData, $kerning, $lastCharCode, $leftSideBearing, $os2Data, $outType, $part2, $paths1, $paths2, $prec, $ranges, $rangesStr, $reader, $scale, $shapeRecords, $shapeWriter, $tables, $ttf, $varsBuf, $zipBytesOutput, $zipWriter, $zipdata));
											unset($i1);
										}
									}
									{
										$_g4 = 0; $_g5 = $dat2->yCoordinates;
										while($_g4 < $_g5->length) {
											$i1 = $_g5[$_g4];
											++$_g4;
											$dat2bis->yCoordinates->push(be_haxer_hxswfml_FontWriter_6($this, $_g, $_g1, $_g2, $_g3, $_g4, $_g5, $_header, $advanceWidth, $bytes, $c2, $charCode, $charCodes, $charHash, $charObjects, $cmapData, $commands, $dat2, $dat2bis, $data, $datas, $fontName, $glyfData, $glyphIndex, $glyphIndexArray, $glyphLayouts, $glyphs, $graphicsBuf, $headData, $header, $header1, $hheaData, $hmtxData, $i, $i1, $idx, $importsBuf, $input, $j, $kernData, $kerning, $lastCharCode, $leftSideBearing, $os2Data, $outType, $part2, $paths1, $paths2, $prec, $ranges, $rangesStr, $reader, $scale, $shapeRecords, $shapeWriter, $tables, $ttf, $varsBuf, $zipBytesOutput, $zipWriter, $zipdata));
											unset($i1);
										}
									}
									$paths2 = $this->buildPaths($dat2bis);
								}
								$paths = $paths1->concat($paths2);
								$this->writePaths(new _hx_array(array($this->outputType, $paths, $shapeWriter, $scale, $prec, $graphicsBuf, $commands, $datas, $shapeRecords, $glyphs, $charCode, $glyphLayouts, $advanceWidth)));
							}
						}break;
						case 0:
						$data = $__hx__t->params[1]; $_header = $__hx__t->params[0];
						{
							$header1 = $_header;
							$paths = $this->buildPaths($data);
							$this->writePaths(new _hx_array(array($this->outputType, $paths, $shapeWriter, $scale, $prec, $graphicsBuf, $commands, $datas, $shapeRecords, $glyphs, $charCode, $glyphLayouts, $advanceWidth)));
						}break;
						}
						if($header1 === null) {
							$header1 = _hx_anonymous(array("numberOfContours" => 0, "xMin" => 0, "xMax" => 0, "yMin" => 0, "yMax" => 0));
						}
						if($this->outputType === "path" || $this->outputType === "hash") {
							$charObj = _hx_anonymous(array("charCode" => $j, "ascent" => Std::int($os2Data->usWinAscent * $scale * $prec) / $prec, "descent" => Std::int($os2Data->usWinDescent * $scale * $prec) / $prec, "leading" => Std::int(($os2Data->usWinAscent + $os2Data->usWinDescent - $headData->unitsPerEm) * $scale * $prec) / $prec, "advanceWidth" => Std::int($advanceWidth * $scale * $prec) / $prec, "leftsideBearing" => Std::int($leftSideBearing * $scale * $prec) / $prec, "xMin" => Std::int($header1->xMin * $scale * $prec) / $prec, "xMax" => Std::int($header1->xMax * $scale * $prec) / $prec, "yMin" => Std::int($header1->yMin * $scale * $prec) / $prec, "yMax" => Std::int($header1->yMax * $scale * $prec) / $prec, "_width" => Std::int($advanceWidth * $scale * $prec) / $prec, "_height" => Std::int(($header1->yMax - $header1->xMin) * $scale * $prec) / $prec, "commands" => $commands, "data" => $datas));
							$charObjects->push($charObj);
							$charHash->set(Std::int($j), $charObj);
							unset($charObj);
						}
						if($this->outputType === "zip") {
							$charCodes->push($j);
							$importsBuf->add("import Char");
							$importsBuf->add($j);
							$importsBuf->add(";\x0A");
							$varsBuf->add("\x09public static inline var ascent = ");
							$varsBuf->add(Std::int($os2Data->usWinAscent * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A\x09public static inline var descent = ");
							$varsBuf->add(Std::int($os2Data->usWinDescent * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A\x09public static inline var leading = ");
							$varsBuf->add(Std::int(($os2Data->usWinAscent + $os2Data->usWinDescent - $headData->unitsPerEm) * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A\x09public static inline var advanceWidth = ");
							$varsBuf->add(Std::int($advanceWidth * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A\x09public static inline var leftsideBearing = ");
							$varsBuf->add(Std::int($leftSideBearing * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A");
							$varsBuf->add("\x0A\x09public static inline var xMin = ");
							$varsBuf->add(Std::int($header1->xMin * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A\x09public static inline var xMax = ");
							$varsBuf->add(Std::int($header1->xMax * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A\x09public static inline var yMin = ");
							$varsBuf->add(Std::int($header1->yMin * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A\x09public static inline var yMax = ");
							$varsBuf->add(Std::int($header1->yMax * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A");
							$varsBuf->add("\x0A\x09public static inline var _width = ");
							$varsBuf->add(Std::int($advanceWidth * $scale * $prec) / $prec);
							$varsBuf->add(";\x0A\x09public static inline var _height = ");
							$varsBuf->add(Std::int(($header1->yMax - $header1->xMin) * $scale * $prec) / $prec);
							$varsBuf->add(";");
							$charClass = $this->zipResources_charClass;
							$charClass = _hx_explode("#C", $charClass)->join(chr($j));
							$charClass = _hx_explode("#0", $charClass)->join(Std::string($j));
							$charClass = _hx_explode("#commands", $charClass)->join($commands->toString());
							$charClass = _hx_explode("#datas", $charClass)->join($datas->toString());
							$charClass = _hx_explode("#1", $charClass)->join($varsBuf->b);
							$charClass = _hx_explode("#2", $charClass)->join($graphicsBuf->b);
							$zipdata->add(_hx_anonymous(array("fileName" => "Char" . _hx_string_rec($j, "") . ".hx", "fileSize" => strlen($charClass), "fileTime" => Date::now(), "compressed" => false, "dataSize" => strlen($charClass), "data" => haxe_io_Bytes::ofString($charClass), "crc32" => format_tools_CRC32::encode(haxe_io_Bytes::ofString($charClass)), "extraFields" => new HList())));
							unset($charClass);
						}
						unset($shapeWriter,$shapeRecords,$prec,$leftSideBearing,$j,$idx,$header1,$glyphIndex,$charCode,$advanceWidth);
					}
					unset($_g3,$_g2);
				}
				$lastCharCode = _hx_array_get($ranges, $i)->end;
				unset($i);
			}
		}
		$kerning1 = new _hx_array(array());
		{
			$_g1 = 0; $_g = $kernData->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$table = $kernData[$i];
				$__hx__t = ($table);
				switch($__hx__t->index) {
				case 0:
				$kerningPairs = $__hx__t->params[0];
				{
					$_g2 = 0;
					while($_g2 < $kerningPairs->length) {
						$pair = $kerningPairs[$_g2];
						++$_g2;
						$kerning1->push(_hx_anonymous(array("charCode1" => $pair->left, "charCode2" => $pair->right, "adjust" => Std::int($pair->value * $scale * 20))));
						unset($pair);
					}
				}break;
				default:{
				}break;
				}
				unset($table,$i);
			}
		}
		$this->leading = Std::int(($os2Data->usWinAscent + $os2Data->usWinDescent - $headData->unitsPerEm) * $scale * 20);
		$fontLayoutData = _hx_anonymous(array("ascent" => Std::int($os2Data->usWinAscent * $scale * 20), "descent" => Std::int($os2Data->usWinDescent * $scale * 20), "leading" => $this->leading, "glyphs" => $glyphLayouts, "kerning" => $kerning1));
		$font2Data = _hx_anonymous(array("shiftJIS" => false, "isSmall" => false, "isANSI" => false, "isItalic" => false, "isBold" => false, "language" => format_swf_LangCode::$LCNone, "name" => $this->fontName, "glyphs" => $glyphs, "layout" => $fontLayoutData));
		$hasWideChars = true;
		$this->fontData3 = format_swf_FontData::FDFont3($font2Data);
		$this->defineFont3SWFTag = format_swf_SWFTag::TFont(1, format_swf_FontData::FDFont3($font2Data));
		if($this->outputType === "zip") {
			$mainClass = $this->zipResources_mainClass;
			$mainClass = _hx_explode("#0", $mainClass)->join($charCodes->toString());
			$mainClass = _hx_explode("#1", $mainClass)->join($importsBuf->b);
			$zipdata->add(_hx_anonymous(array("fileName" => "Main.hx", "fileSize" => strlen($mainClass), "fileTime" => Date::now(), "compressed" => false, "dataSize" => strlen($mainClass), "data" => haxe_io_Bytes::ofString($mainClass), "crc32" => format_tools_CRC32::encode(haxe_io_Bytes::ofString($mainClass)), "extraFields" => new HList())));
			$buildFile = $this->zipResources_buildFile;
			$buildFile = _hx_explode("#0", $buildFile)->join($this->fontName);
			$zipdata->add(_hx_anonymous(array("fileName" => "build.hxml", "fileSize" => strlen($buildFile), "fileTime" => Date::now(), "compressed" => false, "dataSize" => strlen($buildFile), "data" => haxe_io_Bytes::ofString($buildFile), "crc32" => format_tools_CRC32::encode(haxe_io_Bytes::ofString($buildFile)), "extraFields" => new HList())));
			$zipWriter->writeData($zipdata);
			$this->zip = $zipBytesOutput->getBytes();
		}
		if($this->outputType === "path") {
			$index = 0;
			$buf = new StringBuf();
			$buf->add("//Usage: see example below \x0A\x0A");
			$buf->add("var ");
			$buf->add($this->fontName);
			$buf->add("=\x0A{\x0A");
			{
				$_g = 0;
				while($_g < $charObjects->length) {
					$char = $charObjects[$_g];
					++$_g;
					$buf->add("\x09char");
					$buf->add($char->charCode);
					$buf->add(":\x09/* ");
					$buf->add(chr($char->charCode));
					$buf->add(" */");
					$buf->add("\x0A\x09{\x0A\x09\x09ascent:");
					$buf->add($char->ascent);
					$buf->add(", descent:");
					$buf->add($char->descent);
					$buf->add(", advanceWidth:");
					$buf->add($char->advanceWidth);
					$buf->add(", leftsideBearing:");
					$buf->add($char->leftsideBearing);
					$buf->add(", xMin:");
					$buf->add($char->xMin);
					$buf->add(", xMax:");
					$buf->add($char->xMax);
					$buf->add(", yMin:");
					$buf->add($char->yMin);
					$buf->add(", yMax:");
					$buf->add($char->yMax);
					$buf->add(", _width:");
					$buf->add($char->_width);
					$buf->add(", _height:");
					$buf->add($char->_height);
					$buf->add(",\x0A\x09\x09commands:");
					$buf->add(_hx_string_call($char->commands, "toString", array()));
					$buf->add(",\x0A\x09\x09data:");
					$buf->add(_hx_string_call($char->data, "toString", array()));
					if($index++ < $charObjects->length - 1) {
						$buf->add("\x0A\x09},\x0A");
					} else {
						$buf->add("\x0A\x09}\x0A");
					}
					unset($char);
				}
			}
			$buf->add("}\x0A");
			$buf->add("//-------------------------------------------------------------------------\x0A");
			$buf->add("//Example:\x0A");
			$buf->add("var s=new Sprite();\x0A");
			$buf->add("s.graphics.lineStyle(2,1);//s.graphics.beginFill(0,1);\x0A");
			$buf->add("s.graphics.drawPath(Vector.<int>(");
			$buf->add($this->fontName);
			$buf->add(".char35.commands), Vector.<Number>(");
			$buf->add($this->fontName);
			$buf->add(".char35.data), flash.display.GraphicsPathWinding.EVEN_ODD);\x0A");
			$buf->add("s.scaleX=s.scaleY = 0.1;\x0A");
			$buf->add("addChild(s);");
			$this->path = $buf->b;
		}
		if($this->outputType === "hash") {
			$this->hash = $charHash;
		}
	}
	public function writeOTF($id, $name, $bytes) {
		$input = new haxe_io_BytesInput($bytes, null, null);
		$otf = format_ttf_Reader::readOTF($input);
		$header = $otf->header;
		$tables = $otf->tables;
		$cffFound = false;
		{
			$_g = 0;
			while($_g < $tables->length) {
				$t = $tables[$_g];
				++$_g;
				$t->bytes = $bytes->sub($t->offset, _hx_len($t));
				if($t->tableName === "CFF ") {
					$cffFound = true;
				}
				unset($t);
			}
		}
		if($cffFound === false) {
			return null;
		}
		$output = new haxe_io_BytesOutput();
		{
			$_g = 0;
			while($_g < $tables->length) {
				$t = $tables[$_g];
				++$_g;
				switch($t->tableName) {
				case "CFF ":case "cmap":case "head":case "maxp":case "OS/2":case "post":case "hhea":case "hmtx":case "vhea":case "vmtx":case "VORG":case "GSUB":case "GPOS":case "GDEF":case "BASE":{
					$output->write($t->bytes);
				}break;
				default:{
				}break;
				}
				unset($t);
			}
		}
		$font4Data = _hx_anonymous(array("hasSFNT" => true, "isItalic" => false, "isBold" => false, "name" => $name, "bytes" => $bytes));
		return format_swf_SWFTag::TFont($id, format_swf_FontData::FDFont4($font4Data));
	}
	public function listGlyphs($bytes) {
		$input = new haxe_io_BytesInput($bytes, null, null);
		$reader = new format_ttf_Reader($input);
		$ttf = $reader->read();
		$tables = $ttf->tables;
		$cmapData = null;
		$glyfData = null;
		$dump = new StringBuf();
		{
			$_g = 0;
			while($_g < $tables->length) {
				$table = $tables[$_g];
				++$_g;
				$__hx__t = ($table);
				switch($__hx__t->index) {
				case 0:
				$descriptions = $__hx__t->params[0];
				{
					$glyfData = $descriptions;
				}break;
				case 2:
				$subtables = $__hx__t->params[0];
				{
					$cmapData = $subtables;
				}break;
				default:{
				}break;
				}
				unset($table);
			}
		}
		$dump->add("fontName = ");
		$dump->add($reader->fontName);
		$dump->add("\x0A\x0A");
		$glyphIndexArray = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $cmapData->length) {
				$s = $cmapData[$_g];
				++$_g;
				$__hx__t = ($s);
				switch($__hx__t->index) {
				case 2:
				$array = $__hx__t->params[1]; $header = $__hx__t->params[0];
				{
					$glyphIndexArray = $array;
					break 2;
				}break;
				default:{
				}break;
				}
				unset($s);
			}
		}
		if($glyphIndexArray->length === 0) {
			throw new HException("ERROR: Cmap4 encoding table not found");
		}
		{
			$_g1 = 0; $_g = $glyphIndexArray->length - 1;
			while($_g1 < $_g) {
				$i = $_g1++;
				if($glyphIndexArray[$i] !== null) {
					$index = _hx_array_get($glyphIndexArray, $i)->index;
					$dump->add("\x0AglyphIndexArray[");
					$dump->add($i);
					$dump->add("]= charCode= ");
					$dump->add(_hx_array_get($glyphIndexArray, $i)->charCode);
					$dump->add(" char= ");
					$dump->add(_hx_array_get($glyphIndexArray, $i)->char);
					$dump->add("\x0A");
					$dump->add("index= ");
					$dump->add(_hx_array_get($glyphIndexArray, $i)->index);
					$dump->add(" = glyfData[");
					$dump->add($index);
					$dump->add("]= ");
					$dump->add($glyfData[$index]);
					$dump->add("\x0A");
					unset($index);
				}
				unset($i);
			}
		}
		return $dump->b;
	}
	public $zipResources_buildFile;
	public $zipResources_mainClass;
	public $zipResources_charClass;
	public $precision;
	public $leading;
	public $defineFont3SWFTag;
	public $fontData3;
	public $outputType;
	public $chars;
	public $hash;
	public $path;
	public $swf;
	public $zip;
	public $fontName;
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
	function __toString() { return 'be.haxer.hxswfml.FontWriter'; }
}
function be_haxer_hxswfml_FontWriter_0(&$__hx__this, &$bytes, &$cmapData, &$fontName, &$glyfData, &$headData, &$header, &$hheaData, &$hmtxData, &$input, &$kernData, &$os2Data, &$outType, &$rangesStr, &$reader, &$tables, &$ttf) {
	if($fontName !== null) {
		return $fontName;
	} else {
		return $reader->fontName;
	}
}
function be_haxer_hxswfml_FontWriter_1(&$__hx__this, &$_g, &$_g1, &$_g2, &$_g3, &$bytes, &$charCode, &$charCodes, &$charHash, &$charObjects, &$cmapData, &$commands, &$datas, &$fontName, &$glyfData, &$glyphIndex, &$glyphIndexArray, &$glyphLayouts, &$glyphs, &$graphicsBuf, &$headData, &$header, &$hheaData, &$hmtxData, &$i, &$idx, &$importsBuf, &$input, &$j, &$kernData, &$kerning, &$lastCharCode, &$os2Data, &$outType, &$ranges, &$rangesStr, &$reader, &$scale, &$tables, &$ttf, &$varsBuf, &$zipBytesOutput, &$zipWriter, &$zipdata) {
	if($hmtxData[$glyphIndex] === null) {
		return _hx_array_get($hmtxData, 0)->advanceWidth;
	} else {
		return _hx_array_get($hmtxData, $glyphIndex)->advanceWidth;
	}
}
function be_haxer_hxswfml_FontWriter_2(&$__hx__this, &$_g, &$_g1, &$_g2, &$_g3, &$advanceWidth, &$bytes, &$charCode, &$charCodes, &$charHash, &$charObjects, &$cmapData, &$commands, &$datas, &$fontName, &$glyfData, &$glyphIndex, &$glyphIndexArray, &$glyphLayouts, &$glyphs, &$graphicsBuf, &$headData, &$header, &$hheaData, &$hmtxData, &$i, &$idx, &$importsBuf, &$input, &$j, &$kernData, &$kerning, &$lastCharCode, &$os2Data, &$outType, &$ranges, &$rangesStr, &$reader, &$scale, &$tables, &$ttf, &$varsBuf, &$zipBytesOutput, &$zipWriter, &$zipdata) {
	if($hmtxData[$glyphIndex] === null) {
		return _hx_array_get($hmtxData, 0)->leftSideBearing;
	} else {
		return _hx_array_get($hmtxData, $glyphIndex)->leftSideBearing;
	}
}
function be_haxer_hxswfml_FontWriter_3(&$__hx__this, &$_g, &$_g1, &$_g2, &$_g3, &$_g4, &$_g5, &$_header, &$advanceWidth, &$bytes, &$c1, &$charCode, &$charCodes, &$charHash, &$charObjects, &$cmapData, &$commands, &$dat1, &$dat1bis, &$data, &$datas, &$fontName, &$glyfData, &$glyphIndex, &$glyphIndexArray, &$glyphLayouts, &$glyphs, &$graphicsBuf, &$headData, &$header, &$header1, &$hheaData, &$hmtxData, &$i, &$i1, &$idx, &$importsBuf, &$input, &$j, &$kernData, &$kerning, &$lastCharCode, &$leftSideBearing, &$os2Data, &$outType, &$part1, &$paths1, &$paths2, &$prec, &$ranges, &$rangesStr, &$reader, &$scale, &$shapeRecords, &$shapeWriter, &$tables, &$ttf, &$varsBuf, &$zipBytesOutput, &$zipWriter, &$zipdata) {
	if($c1->xtranslate !== null) {
		return $i1 + $c1->xtranslate;
	} else {
		return $i1;
	}
}
function be_haxer_hxswfml_FontWriter_4(&$__hx__this, &$_g, &$_g1, &$_g2, &$_g3, &$_g4, &$_g5, &$_header, &$advanceWidth, &$bytes, &$c1, &$charCode, &$charCodes, &$charHash, &$charObjects, &$cmapData, &$commands, &$dat1, &$dat1bis, &$data, &$datas, &$fontName, &$glyfData, &$glyphIndex, &$glyphIndexArray, &$glyphLayouts, &$glyphs, &$graphicsBuf, &$headData, &$header, &$header1, &$hheaData, &$hmtxData, &$i, &$i1, &$idx, &$importsBuf, &$input, &$j, &$kernData, &$kerning, &$lastCharCode, &$leftSideBearing, &$os2Data, &$outType, &$part1, &$paths1, &$paths2, &$prec, &$ranges, &$rangesStr, &$reader, &$scale, &$shapeRecords, &$shapeWriter, &$tables, &$ttf, &$varsBuf, &$zipBytesOutput, &$zipWriter, &$zipdata) {
	if($c1->ytranslate !== null) {
		return $i1 + $c1->ytranslate;
	} else {
		return $i1;
	}
}
function be_haxer_hxswfml_FontWriter_5(&$__hx__this, &$_g, &$_g1, &$_g2, &$_g3, &$_g4, &$_g5, &$_header, &$advanceWidth, &$bytes, &$c2, &$charCode, &$charCodes, &$charHash, &$charObjects, &$cmapData, &$commands, &$dat2, &$dat2bis, &$data, &$datas, &$fontName, &$glyfData, &$glyphIndex, &$glyphIndexArray, &$glyphLayouts, &$glyphs, &$graphicsBuf, &$headData, &$header, &$header1, &$hheaData, &$hmtxData, &$i, &$i1, &$idx, &$importsBuf, &$input, &$j, &$kernData, &$kerning, &$lastCharCode, &$leftSideBearing, &$os2Data, &$outType, &$part2, &$paths1, &$paths2, &$prec, &$ranges, &$rangesStr, &$reader, &$scale, &$shapeRecords, &$shapeWriter, &$tables, &$ttf, &$varsBuf, &$zipBytesOutput, &$zipWriter, &$zipdata) {
	if($c2->xtranslate !== null) {
		return $i1 + $c2->xtranslate;
	} else {
		return $i1;
	}
}
function be_haxer_hxswfml_FontWriter_6(&$__hx__this, &$_g, &$_g1, &$_g2, &$_g3, &$_g4, &$_g5, &$_header, &$advanceWidth, &$bytes, &$c2, &$charCode, &$charCodes, &$charHash, &$charObjects, &$cmapData, &$commands, &$dat2, &$dat2bis, &$data, &$datas, &$fontName, &$glyfData, &$glyphIndex, &$glyphIndexArray, &$glyphLayouts, &$glyphs, &$graphicsBuf, &$headData, &$header, &$header1, &$hheaData, &$hmtxData, &$i, &$i1, &$idx, &$importsBuf, &$input, &$j, &$kernData, &$kerning, &$lastCharCode, &$leftSideBearing, &$os2Data, &$outType, &$part2, &$paths1, &$paths2, &$prec, &$ranges, &$rangesStr, &$reader, &$scale, &$shapeRecords, &$shapeWriter, &$tables, &$ttf, &$varsBuf, &$zipBytesOutput, &$zipWriter, &$zipdata) {
	if($c2->ytranslate !== null) {
		return $i1 + $c2->ytranslate;
	} else {
		return $i1;
	}
}
