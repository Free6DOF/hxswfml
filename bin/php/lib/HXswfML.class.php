<?php

class HXswfML {
	public function __construct() {
		if( !php_Boot::$skip_constructor ) {
		$this->bitmapIds = new _hx_array(array());
		$this->dictionary = new _hx_array(array());
		$this->swcClasses = new _hx_array(array());
		$this->library = new Hash();
		$this->setup();
	}}
	public $currentTag;
	public $validBaseClasses;
	public $validElements;
	public $validChildren;
	public $swcClasses;
	public $bitmapIds;
	public $dictionary;
	public $library;
	public function xml2swf($input, $fileOut) {
		$xml = Xml::parse($input);
		$swfBytesOutput = new haxe_io_BytesOutput();
		$swfWriter = new format_swf_Writer($swfBytesOutput);
		$this->createSWF($xml, $swfWriter);
		$swfBytes = $swfBytesOutput->getBytes();
		if(StringTools::endsWith($fileOut, ".swf")) {
			return $swfBytes;
		}
		else {
			if(StringTools::endsWith($fileOut, ".swc")) {
				$date = Date::now();
				$mod = $date->getTime();
				$xmlBytesOutput = new haxe_io_BytesOutput();
				$xmlBytesOutput->write(haxe_io_Bytes::ofString($this->createXML($mod)));
				$xmlBytes = $xmlBytesOutput->getBytes();
				$zipBytesOutput = new haxe_io_BytesOutput();
				$zipWriter = new format_zip_Writer($zipBytesOutput);
				$data = new HList();
				$data->push(_hx_anonymous(array("fileName" => "catalog.xml", "fileSize" => $xmlBytes->length, "fileTime" => $date, "compressed" => false, "dataSize" => $xmlBytes->length, "data" => $xmlBytes, "crc32" => format_tools_CRC32::encode($xmlBytes), "extraFields" => null)));
				$data->push(_hx_anonymous(array("fileName" => "library.swf", "fileSize" => $swfBytes->length, "fileTime" => $date, "compressed" => false, "dataSize" => $swfBytes->length, "data" => $swfBytes, "crc32" => format_tools_CRC32::encode($swfBytes), "extraFields" => null)));
				$zipWriter->writeData($data);
				return $zipBytesOutput->getBytes();
			}
			else {
				$this->error("!ERROR: Supported file formats for output are .swf and .swc");
				return null;
			}
		}
	}
	public function createSWF($xml, $swfWriter) {
		$swf = $xml->firstElement();
		$»it = $swf->elements();
		while($»it->hasNext()) {
		$tag = $»it->next();
		{
			$this->currentTag = $tag;
			$this->checkUnknownAttributes();
			switch(strtolower($this->currentTag->getNodeName())) {
			case "header":{
				$swfWriter->writeHeader($this->header());
			}break;
			case "fileattributes":{
				$swfWriter->writeTag($this->fileAttributes());
			}break;
			case "setbackgroundcolor":{
				$swfWriter->writeTag($this->setBackgroundColor());
			}break;
			case "scriptlimits":{
				$swfWriter->writeTag($this->scriptLimits());
			}break;
			case "definebitsjpeg":{
				$swfWriter->writeTag($this->defineBitsJPEG());
			}break;
			case "defineshape":{
				$swfWriter->writeTag($this->defineShape());
			}break;
			case "definesprite":{
				$swfWriter->writeTag($this->defineSprite());
			}break;
			case "definebutton":{
				$swfWriter->writeTag($this->defineButton2());
			}break;
			case "definebinarydata":{
				$swfWriter->writeTag($this->defineBinaryData());
			}break;
			case "definesound":{
				$swfWriter->writeTag($this->defineSound());
			}break;
			case "definefont":{
				$swfWriter->writeTag($this->defineFont());
			}break;
			case "defineedittext":{
				$swfWriter->writeTag($this->defineEditText());
			}break;
			case "defineabc":{
				{
					$_g = 0; $_g1 = $this->defineABC();
					while($_g < $_g1->length) {
						$tag1 = $_g1[$_g];
						++$_g;
						$swfWriter->writeTag($tag1);
						unset($tag1);
					}
				}
			}break;
			case "definescalinggrid":{
				$swfWriter->writeTag($this->defineScalingGrid());
			}break;
			case "placeobject":{
				$swfWriter->writeTag($this->placeObject2());
			}break;
			case "removeobject":{
				$swfWriter->writeTag($this->removeObject2());
			}break;
			case "startsound":{
				$swfWriter->writeTag($this->startSound());
			}break;
			case "symbolclass":{
				{
					$_g2 = 0; $_g12 = $this->symbolClass();
					while($_g2 < $_g12->length) {
						$tag12 = $_g12[$_g2];
						++$_g2;
						$swfWriter->writeTag($tag12);
						unset($tag12);
					}
				}
			}break;
			case "metadata":{
				$swfWriter->writeTag($this->metadata());
			}break;
			case "framelabel":{
				$swfWriter->writeTag($this->frameLabel());
			}break;
			case "showframe":{
				$swfWriter->writeTag($this->showFrame());
			}break;
			case "endframe":{
				$swfWriter->writeTag($this->endFrame());
			}break;
			case "tween":{
				{
					$_g3 = 0; $_g13 = $this->tween();
					while($_g3 < $_g13->length) {
						$tag13 = $_g13[$_g3];
						++$_g3;
						$swfWriter->writeTag($tag13);
						unset($tag13);
					}
				}
			}break;
			case "custom":{
				$swfWriter->writeTag($this->custom());
			}break;
			default:{
				$this->error("!ERROR: " . $this->currentTag->getNodeName() . " is not allowed inside an swf element. Valid children are: " . $this->validChildren->get("swf")->toString() . ". TAG: " . $this->currentTag->toString());
			}break;
			}
			unset($tag13,$tag12,$tag1,$_g3,$_g2,$_g13,$_g12,$_g1,$_g);
		}
		}
		$swfWriter->writeEnd();
	}
	public function header() {
		return _hx_anonymous(array("version" => $this->getInt("version", 10, null, null, null), "compressed" => $this->getBool("compressed", true, null), "width" => $this->getInt("width", 800, null, null, null), "height" => $this->getInt("height", 600, null, null, null), "fps" => $this->getInt("fps", 30, null, null, null), "nframes" => $this->getInt("frameCount", 1, null, null, null)));
	}
	public function fileAttributes() {
		return format_swf_SWFTag::TSandBox(_hx_anonymous(array("useDirectBlit" => $this->getBool("useDirectBlit", false, null), "useGPU" => $this->getBool("useGPU", false, null), "hasMetaData" => $this->getBool("hasMetaData", false, null), "actionscript3" => $this->getBool("actionscript3", true, null), "useNetWork" => $this->getBool("useNetwork", false, null))));
	}
	public function setBackgroundColor() {
		return format_swf_SWFTag::TBackgroundColor($this->getInt("color", 16777215, null, null, null));
	}
	public function scriptLimits() {
		$maxRecursion = $this->getInt("maxRecursionDepth", 256, null, null, null);
		$timeoutSeconds = $this->getInt("scriptTimeoutSeconds", 15, null, null, null);
		return format_swf_SWFTag::TScriptLimits($maxRecursion, $timeoutSeconds);
	}
	public function defineBitsJPEG() {
		$id = $this->getInt("id", null, true, true, null);
		$file = $this->getString("file", "", true);
		$bytes = $this->getBytes($file);
		$this->storeWidthHeight($id, $file, $bytes);
		return format_swf_SWFTag::TBitsJPEG($id, format_swf_JPEGData::JDJPEG2($bytes));
	}
	public function defineShape() {
		$id = $this->getInt("id", null, true, true, null);
		$bounds = null;
		$shapeWithStyle = null;
		if($this->currentTag->exists("bitmapId")) {
			$bitmapId = $this->getInt("bitmapId", null, null, null, null);
			if($this->dictionary[$bitmapId] != "definebitsjpeg") {
				$this->error("!ERROR: bitmapId " . $bitmapId . " must be a reference to a DefineBitsJPEG tag. TAG: " . $this->currentTag->toString());
			}
			$width = $this->bitmapIds[$bitmapId]->»a[0] * 20;
			$height = $this->bitmapIds[$bitmapId]->»a[1] * 20;
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
		}
		else {
			$hxg = new HxGraphix();
			$»it = $this->currentTag->elements();
			while($»it->hasNext()) {
			$cmd = $»it->next();
			{
				$this->currentTag = $cmd;
				$this->checkUnknownAttributes();
				switch(strtolower($this->currentTag->getNodeName())) {
				case "beginfill":{
					$color = $this->getInt("color", 0, null, null, null);
					$alpha = $this->getFloat("alpha", 1.0, null);
					$hxg->beginFill($color, $alpha);
				}break;
				case "begingradientfill":{
					$type = $this->getString("type", "", true);
					switch($type) {
					case "linear":case "radial":{
						$colors = _hx_explode(",", $this->getString("colors", "", true));
						$alphas = _hx_explode(",", $this->getString("alphas", "", true));
						$ratios = _hx_explode(",", $this->getString("ratios", "", true));
						$x2 = $this->getFloat("x", 0.0, null);
						$y2 = $this->getFloat("y", 0.0, null);
						$scaleX2 = $this->getFloat("scaleX", 1.0, null);
						$scaleY2 = $this->getFloat("scaleY", 1.0, null);
						$rotate02 = $this->getFloat("rotate0", 0.0, null);
						$rotate12 = $this->getFloat("rotate1", 0.0, null);
						$hxg->beginGradientFill($type, $colors, $alphas, $ratios, $x2, $y2, $scaleX2, $scaleY2, $rotate02, $rotate12);
					}break;
					default:{
						$this->error("ERROR! Invalid gradient type " . $type . ". Valid types are: radial,linear. TAG: " . $this->currentTag->toString());
					}break;
					}
				}break;
				case "beginbitmapfill":{
					$bitmapId2 = $this->getInt("bitmapId", null, true, null, null);
					if($this->dictionary[$bitmapId2] != "definebitsjpeg") {
						$this->error("!ERROR: bitmapId " . $bitmapId2 . " must be a reference to a DefineBitsJPEG tag. TAG: " . $this->currentTag->toString());
					}
					$scaleX3 = $this->getFloat("scaleX", 1.0, null);
					$scaleY3 = $this->getFloat("scaleY", 1.0, null);
					$scale2 = _hx_anonymous(array("x" => $scaleX3, "y" => $scaleY3));
					$rotate03 = $this->getFloat("rotate0", 0.0, null);
					$rotate13 = $this->getFloat("rotate1", 0.0, null);
					$rotate2 = _hx_anonymous(array("rs0" => $rotate03, "rs1" => $rotate13));
					$x3 = $this->getInt("x", 0, null, null, null);
					$y3 = $this->getInt("y", 0, null, null, null);
					$translate2 = _hx_anonymous(array("x" => $x3, "y" => $y3));
					$repeat2 = $this->getBool("repeat", false, null);
					$smooth2 = $this->getBool("smooth", false, null);
					$hxg->beginBitmapFill($bitmapId2, $x3, $y3, $scaleX3, $scaleY3, $rotate03, $rotate13, $repeat2, $smooth2);
				}break;
				case "linestyle":{
					$width2 = $this->getFloat("width", 1.0, null);
					$color2 = $this->getInt("color", 0, null, null, null);
					$alpha2 = $this->getFloat("alpha", 1.0, null);
					$hxg->lineStyle($width2, $color2, $alpha2);
				}break;
				case "moveto":{
					$x4 = $this->getFloat("x", 0.0, null);
					$y4 = $this->getFloat("y", 0.0, null);
					$hxg->moveTo($x4, $y4);
				}break;
				case "lineto":{
					$x5 = $this->getFloat("x", 0.0, null);
					$y5 = $this->getFloat("y", 0.0, null);
					$hxg->lineTo($x5, $y5);
				}break;
				case "curveto":{
					$cx = $this->getFloat("cx", 0.0, null);
					$cy = $this->getFloat("cy", 0.0, null);
					$ax = $this->getFloat("ax", 0.0, null);
					$ay = $this->getFloat("ay", 0.0, null);
					$hxg->curveTo($cx, $cy, $ax, $ay);
				}break;
				case "endfill":{
					$hxg->endFill();
				}break;
				case "endline":{
					$hxg->endLine();
				}break;
				case "clear":{
					$hxg->clear();
				}break;
				case "drawcircle":{
					$x6 = $this->getFloat("x", 0.0, null);
					$y6 = $this->getFloat("y", 0.0, null);
					$r = $this->getFloat("r", 0.0, null);
					$sections = $this->getInt("sections", 16, null, null, null);
					$hxg->drawCircle($x6, $y6, $r, $sections);
				}break;
				case "drawellipse":{
					$x7 = $this->getFloat("x", 0.0, null);
					$y7 = $this->getFloat("y", 0.0, null);
					$w = $this->getFloat("width", 0.0, null);
					$h = $this->getFloat("height", 0.0, null);
					$hxg->drawEllipse($x7, $y7, $w, $h);
				}break;
				case "drawrect":{
					$x8 = $this->getFloat("x", 0.0, null);
					$y8 = $this->getFloat("y", 0.0, null);
					$w2 = $this->getFloat("width", 0.0, null);
					$h2 = $this->getFloat("height", 0.0, null);
					$hxg->drawRect($x8, $y8, $w2, $h2);
				}break;
				case "drawroundrect":{
					$x9 = $this->getFloat("x", 0.0, null);
					$y9 = $this->getFloat("y", 0.0, null);
					$w3 = $this->getFloat("width", 0.0, null);
					$h3 = $this->getFloat("height", 0.0, null);
					$r2 = $this->getFloat("r", 0.0, null);
					$hxg->drawRoundRect($x9, $y9, $w3, $h3, $r2);
				}break;
				case "drawroundrectcomplex":{
					$x10 = $this->getFloat("x", 0.0, null);
					$y10 = $this->getFloat("y", 0.0, null);
					$w4 = $this->getFloat("width", 0.0, null);
					$h4 = $this->getFloat("height", 0.0, null);
					$rtl = $this->getFloat("rtl", 0.0, null);
					$rtr = $this->getFloat("rtr", 0.0, null);
					$rbl = $this->getFloat("rbl", 0.0, null);
					$rbr = $this->getFloat("rbr", 0.0, null);
					$hxg->drawRoundRectComplex($x10, $y10, $w4, $h4, $rtl, $rtr, $rbl, $rbr);
				}break;
				default:{
					$this->error("!ERROR: " . $this->currentTag->getNodeName() . " is not allowed inside a DefineShape element. Valid children are: " . $this->validChildren->get("defineshape")->toString() . ". TAG: " . $this->currentTag->toString());
				}break;
				}
				unset($y9,$y8,$y7,$y6,$y5,$y4,$y3,$y2,$y10,$x9,$x8,$x7,$x6,$x5,$x4,$x3,$x2,$x10,$width2,$w4,$w3,$w2,$w,$type,$translate2,$smooth2,$sections,$scaleY3,$scaleY2,$scaleX3,$scaleX2,$scale2,$rtr,$rtl,$rotate2,$rotate13,$rotate12,$rotate03,$rotate02,$repeat2,$rbr,$rbl,$ratios,$r2,$r,$h4,$h3,$h2,$h,$cy,$cx,$colors,$color2,$color,$bitmapId2,$ay,$ax,$alphas,$alpha2,$alpha);
			}
			}
			return $hxg->getTag($id);
		}
	}
	public function defineSprite() {
		$id = $this->getInt("id", null, true, true, null);
		$frames = $this->getInt("frameCount", 1, null, null, null);
		$showFrameCount = 0;
		$tags = new _hx_array(array());
		$spriteTag = $this->currentTag;
		$»it = $this->currentTag->elements();
		while($»it->hasNext()) {
		$tag = $»it->next();
		{
			$this->currentTag = $tag;
			$this->checkUnknownAttributes();
			switch(strtolower($this->currentTag->getNodeName())) {
			case "placeobject":{
				$tags->push($this->placeObject2());
			}break;
			case "removeobject":{
				$tags->push($this->removeObject2());
			}break;
			case "startsound":{
				$tags->push($this->startSound());
			}break;
			case "framelabel":{
				$tags->push($this->frameLabel());
			}break;
			case "showframe":{
				$showFrameCount++;
				$tags->push($this->showFrame());
			}break;
			case "endframe":{
				$tags->push($this->endFrame());
			}break;
			case "tween":{
				{
					$_g = 0; $_g1 = $this->tween();
					while($_g < $_g1->length) {
						$tag1 = $_g1[$_g];
						++$_g;
						$tags->push($tag1);
						unset($tag1);
					}
				}
			}break;
			default:{
				$this->error("!ERROR: " . $this->currentTag->getNodeName() . " is not allowed inside a DefineSprite element. Valid children are: " . $this->validChildren->get("definesprite")->toString() . ". TAG: " . $this->currentTag->toString());
			}break;
			}
			unset($tag1,$_g1,$_g);
		}
		}
		return format_swf_SWFTag::TClip($id, $frames, $tags);
	}
	public function defineButton2() {
		$id = $this->getInt("id", null, true, true, null);
		$buttonRecords = new _hx_array(array());
		$»it = $this->currentTag->elements();
		while($»it->hasNext()) {
		$buttonRecord = $»it->next();
		{
			$this->currentTag = $buttonRecord;
			$this->checkUnknownAttributes();
			switch(strtolower($this->currentTag->getNodeName())) {
			case "buttonstate":{
				$hit = $this->getBool("hit", false, null);
				$down = $this->getBool("down", false, null);
				$over = $this->getBool("over", false, null);
				$up = $this->getBool("up", false, null);
				if($hit === false && $down === false && $over === false && $up === false) {
					$this->error("!ERROR: You need to set at least one button state to true. TAG: " . $this->currentTag->toString());
				}
				$id1 = $this->getInt("id", null, true, false, true);
				$depth = $this->getInt("depth", null, true, null, null);
				$buttonRecords->push(_hx_anonymous(array("hit" => $hit, "down" => $down, "over" => $over, "up" => $up, "id" => $id1, "depth" => $depth, "matrix" => $this->getMatrix())));
			}break;
			default:{
				$this->error("!ERROR: " . $this->currentTag->getNodeName() . " is not allowed inside a DefineButton element. Valid children are: " . $this->validChildren->get("definebutton")->toString() . ". TAG: " . $this->currentTag->toString());
			}break;
			}
			unset($up,$over,$id1,$hit,$down,$depth);
		}
		}
		if($buttonRecords->length === 0) {
			$this->error("!ERROR: You need to supply at least one buttonstate element. TAG: " . $this->currentTag->toString());
		}
		return format_swf_SWFTag::TDefineButton2($id, $buttonRecords);
	}
	public function defineSound() {
		$file = $this->getString("file", "", true);
		$mp3FileBytes = new haxe_io_BytesInput($this->getBytes($file), null, null);
		$mp3Reader = new format_mp3_Reader($mp3FileBytes);
		$mp3 = $mp3Reader->read();
		$mp3Frames = $mp3->frames;
		$mp3Header = _hx_array_get($mp3Frames, 0)->header;
		$dataBytesOutput = new haxe_io_BytesOutput();
		$mp3Writer = new format_mp3_Writer($dataBytesOutput);
		$mp3Writer->write($mp3, false);
		$sid = $this->getInt("id", null, true, true, null);
		$samplingRate = eval("if(isset(\$this)) \$»this =& \$this;\$»t = (\$mp3Header->samplingRate);
			switch(\$»t->index) {
			case 1:
			{
				\$»r = format_swf_SoundRate::\$SR11k;
			}break;
			case 3:
			{
				\$»r = format_swf_SoundRate::\$SR22k;
			}break;
			case 6:
			{
				\$»r = format_swf_SoundRate::\$SR44k;
			}break;
			default:{
				\$»r = null;
			}break;
			}
			return \$»r;
		");
		if($samplingRate === null) {
			$this->error("!ERROR: Unsupported MP3 SoundRate " . $mp3Header->samplingRate . " in " . $file . ". TAG: " . $this->currentTag->toString());
		}
		return format_swf_SWFTag::TSound(_hx_anonymous(array("sid" => $sid, "format" => format_swf_SoundFormat::$SFMP3, "rate" => $samplingRate, "is16bit" => true, "isStereo" => eval("if(isset(\$this)) \$»this =& \$this;\$»t2 = (\$mp3Header->channelMode);
			switch(\$»t2->index) {
			case 0:
			{
				\$»r2 = true;
			}break;
			case 1:
			{
				\$»r2 = true;
			}break;
			case 2:
			{
				\$»r2 = true;
			}break;
			case 3:
			{
				\$»r2 = false;
			}break;
			default:{
				\$»r2 = null;
			}break;
			}
			return \$»r2;
		"), "samples" => $mp3->sampleCount, "data" => format_swf_SoundData::SDMp3(0, $dataBytesOutput->getBytes()))));
	}
	public function defineBinaryData() {
		$id = $this->getInt("id", null, true, true, null);
		$file = $this->getString("file", "", true);
		$bytes = $this->getBytes($file);
		return format_swf_SWFTag::TBinaryData($id, $bytes);
	}
	public function defineFont() {
		$_id = $this->getInt("id", null, true, true, null);
		$file = $this->getString("file", "", true);
		$swf = $this->getBytes($file);
		$swfBytesInput = new haxe_io_BytesInput($swf, null, null);
		$swfReader = new format_swf_Reader($swfBytesInput);
		$header = $swfReader->readHeader();
		$tags = $swfReader->readTagList();
		$swfBytesInput->close();
		$fontTag = null;
		{
			$_g = 0;
			while($_g < $tags->length) {
				$tag = $tags[$_g];
				++$_g;
				$»t = ($tag);
				switch($»t->index) {
				case 4:
				$data = $»t->params[1]; $id = $»t->params[0];
				{
					$fontTag = format_swf_SWFTag::TFont($_id, $data);
				}break;
				default:{
					;
				}break;
				}
				unset($»t,$tag,$id,$data);
			}
		}
		if($fontTag === null) {
			$this->error("!ERROR: No Font definitions were found inside swf: " . $file . ", TAG: " . $this->currentTag->toString());
		}
		return $fontTag;
	}
	public function defineEditText() {
		$id = $this->getInt("id", null, true, true, null);
		$fontID = $this->getInt("fontID", null, null, null, null);
		if($fontID !== null && $this->dictionary[$fontID] != "definefont") {
			$this->error("!ERROR: The id " . $fontID . " must be a reference to a DefineFont tag. TAG: " . $this->currentTag->toString());
		}
		$textColor = $this->getInt("textColor", 255, null, null, null);
		return format_swf_SWFTag::TDefineEditText($id, _hx_anonymous(array("bounds" => _hx_anonymous(array("left" => 0, "right" => $this->getInt("width", 100, null, null, null) * 20, "top" => 0, "bottom" => $this->getInt("height", 100, null, null, null) * 20)), "hasText" => (($this->getString("initialText", "", null) != "") ? true : false), "hasTextColor" => true, "hasMaxLength" => (($this->getInt("maxLength", 0, null, null, null) !== 0) ? true : false), "hasFont" => (($this->getInt("fontID", 0, null, null, null) !== 0) ? true : false), "hasFontClass" => (($this->getString("fontClass", "", null) != "") ? true : false), "hasLayout" => (($this->getInt("align", 0, null, null, null) !== 0 || $this->getInt("leftMargin", 0, null, null, null) * 20 !== 0 || $this->getInt("rightMargin", 0, null, null, null) * 20 !== 0 || $this->getInt("indent", 0, null, null, null) * 20 !== 0 || $this->getInt("leading", 0, null, null, null) * 20 !== 0) ? true : false), "wordWrap" => $this->getBool("wordWrap", true, null), "multiline" => $this->getBool("multiline", true, null), "password" => $this->getBool("password", false, null), "input" => !$this->getBool("input", false, null), "autoSize" => $this->getBool("autoSize", false, null), "selectable" => !$this->getBool("selectable", false, null), "border" => $this->getBool("border", false, null), "wasStatic" => $this->getBool("wasStatic", false, null), "html" => $this->getBool("html", false, null), "useOutlines" => $this->getBool("useOutlines", false, null), "fontID" => $this->getInt("fontID", null, null, null, null), "fontClass" => $this->getString("fontClass", "", null), "fontHeight" => $this->getInt("fontHeight", 12, null, null, null) * 20, "textColor" => _hx_anonymous(array("r" => ($textColor & -16777216) >> 24, "g" => ($textColor & 16711680) >> 16, "b" => ($textColor & 65280) >> 8, "a" => ($textColor & 255))), "maxLength" => $this->getInt("maxLength", 0, null, null, null), "align" => $this->getInt("align", 0, null, null, null), "leftMargin" => $this->getInt("leftMargin", 0, null, null, null) * 20, "rightMargin" => $this->getInt("rightMargin", 0, null, null, null) * 20, "indent" => $this->getInt("indent", 0, null, null, null) * 20, "leading" => $this->getInt("leading", 0, null, null, null) * 20, "variableName" => $this->getString("variableName", "", null), "initialText" => $this->getString("initialText", "", null))));
	}
	public function defineABC() {
		$remap = $this->getString("remap", "", null);
		$file = $this->getString("file", "", true);
		$swf = $this->getBytes($file);
		$swfBytesInput = new haxe_io_BytesInput($swf, null, null);
		$swfReader = new format_swf_Reader($swfBytesInput);
		$header = $swfReader->readHeader();
		$tags = $swfReader->readTagList();
		$swfBytesInput->close();
		$abcTags = new _hx_array(array());
		$lookupStrings = new _hx_array(array("Boot", "Lib", "Type"));
		{
			$_g = 0;
			while($_g < $tags->length) {
				$tag = $tags[$_g];
				++$_g;
				$»t = ($tag);
				switch($»t->index) {
				case 13:
				$ctx = $»t->params[1]; $data = $»t->params[0];
				{
					if($remap == "") {
						$abcTags->push(format_swf_SWFTag::TActionScript3($data, $ctx));
					}
					else {
						$abcReader = new format_abc_Reader(new haxe_io_BytesInput($data, null, null));
						$abcFile = $abcReader->read();
						$cpoolStrings = $abcFile->strings;
						{
							$_g2 = 0; $_g1 = $cpoolStrings->length;
							while($_g2 < $_g1) {
								$i = $_g2++;
								{
									$_g3 = 0;
									while($_g3 < $lookupStrings->length) {
										$s = $lookupStrings[$_g3];
										++$_g3;
										$regex = new EReg("\\b" . $s . "\\b", "");
										$str = $cpoolStrings[$i];
										if($regex->match($str)) {
											$this->inform("<-" . $cpoolStrings[$i]);
											$cpoolStrings[$i] = $regex->replace($str, $s . $remap);
											$this->inform("->" . $cpoolStrings[$i]);
										}
										unset($str,$s,$regex);
									}
								}
								unset($str,$s,$regex,$i,$_g3);
							}
						}
						$abcOutput = new haxe_io_BytesOutput();
						format_abc_Writer::write($abcOutput, $abcFile);
						$abcBytes = $abcOutput->getBytes();
						$abcTags->push(format_swf_SWFTag::TActionScript3($abcBytes, $ctx));
					}
				}break;
				default:{
					;
				}break;
				}
				unset($»t,$tag,$str,$s,$regex,$i,$data,$ctx,$cpoolStrings,$abcReader,$abcOutput,$abcFile,$abcBytes,$_g3,$_g2,$_g1);
			}
		}
		if($abcTags->length === 0) {
			$this->error("!ERROR: No ABC files were found inside the given file " . $file . ". TAG : " . $this->currentTag->toString());
		}
		return $abcTags;
	}
	public function defineScalingGrid() {
		$id = $this->getInt("id", null, true, false, true);
		$x = $this->getInt("x", null, true, null, null) * 20;
		$y = $this->getInt("y", null, true, null, null) * 20;
		$width = $this->getInt("width", null, true, null, null) * 20;
		$height = $this->getInt("height", null, true, null, null) * 20;
		$splitter = _hx_anonymous(array("left" => $x, "right" => $x + $width, "top" => $y, "bottom" => $y + $height));
		return format_swf_SWFTag::TDefineScalingGrid($id, $splitter);
	}
	public function placeObject2() {
		$id = $this->getInt("id", null, null, null, null);
		if($id !== null) {
			$this->checkTargetId($id);
		}
		$depth = $this->getInt("depth", null, true, null, null);
		$name = $this->getString("name", "", null);
		$move = $this->getBool("move", false, null);
		$placeObject = new format_swf_PlaceObject();
		$placeObject->depth = $depth;
		$placeObject->move = !($move ? null : true);
		$placeObject->cid = $id;
		$placeObject->matrix = $this->getMatrix();
		$placeObject->color = null;
		$placeObject->ratio = null;
		$placeObject->instanceName = ($name == "" ? null : $name);
		$placeObject->clipDepth = null;
		$placeObject->events = null;
		$placeObject->filters = null;
		$placeObject->blendMode = null;
		$placeObject->bitmapCache = false;
		return format_swf_SWFTag::TPlaceObject2($placeObject);
	}
	public function moveObject($depth, $x, $y, $scaleX, $scaleY, $rs0, $rs1) {
		$id = null;
		$depth1 = $depth;
		$name = "";
		$move = true;
		$scale = null;
		if($scaleX === null && $scaleY === null) {
			$scale = null;
		}
		else {
			if($scaleX === null && $scaleY !== null) {
				$scale = _hx_anonymous(array("x" => 1.0, "y" => $scaleY));
			}
			else {
				if($scaleX !== null && $scaleY === null) {
					$scale = _hx_anonymous(array("x" => $scaleX, "y" => 1.0));
				}
				else {
					$scale = _hx_anonymous(array("x" => $scaleX, "y" => $scaleY));
				}
			}
		}
		$rotate = null;
		if($rs0 === null && $rs1 === null) {
			$rotate = null;
		}
		else {
			if($rs0 === null && $rs1 !== null) {
				$rotate = _hx_anonymous(array("rs0" => 0.0, "rs1" => $rs1));
			}
			else {
				if($rs0 !== null && $rs1 === null) {
					$rotate = _hx_anonymous(array("rs0" => $rs0, "rs1" => 0.0));
				}
				else {
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
		$placeObject->instanceName = ($name == "" ? null : $name);
		$placeObject->clipDepth = null;
		$placeObject->events = null;
		$placeObject->filters = null;
		$placeObject->blendMode = null;
		$placeObject->bitmapCache = false;
		return format_swf_SWFTag::TPlaceObject2($placeObject);
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
		$»it = $this->currentTag->elements();
		while($»it->hasNext()) {
		$tagNode = $»it->next();
		{
			$this->currentTag = $tagNode;
			$this->checkUnknownAttributes();
			switch(strtolower($this->currentTag->getNodeName())) {
			case "tw":{
				$prop = $this->getString("prop", "", null);
				$startxy = null;
				$endxy = null;
				$start = null;
				$end = null;
				if($prop == "x" || $prop == "y") {
					$startxy = $this->getInt("start", 0, true, null, null);
					$endxy = $this->getInt("end", 0, true, null, null);
				}
				else {
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
					$this->error("!ERROR: Unsupported " . $prop . " in TW element. Tweenable properties are: x, y, scaleX, scaleY, rotateO, rotate1. TAG: " . $this->currentTag->toString());
				}break;
				}
			}break;
			default:{
				$this->error("!ERROR: " . $this->currentTag->getNodeName() . " is not allowed inside a Tween element.  Valid children are: " . $this->validChildren->get("tween")->toString() . ". TAG: " . $this->currentTag->toString());
			}break;
			}
			unset($startxy,$start,$prop,$endxy,$end);
		}
		}
		$tags = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $frameCount) {
				$i = $_g++;
				$dx = (($startX === null || $endX === null) ? 0 : intval($startX + (($endX - $startX) * $i) / $frameCount));
				$dy = (($startY === null || $endY === null) ? 0 : intval($startY + (($endY - $startY) * $i) / $frameCount));
				$dsx = (($startScaleX === null || $endScaleX === null) ? null : $startScaleX + (($endScaleX - $startScaleX) * $i) / $frameCount);
				$dsy = (($startScaleY === null || $endScaleY === null) ? null : $startScaleY + (($endScaleY - $startScaleY) * $i) / $frameCount);
				$drs0 = (($startRotateO === null || $endRotateO === null) ? null : $startRotateO + (($endRotateO - $startRotateO) * $i) / $frameCount);
				$drs1 = (($startRotate1 === null || $endRotate1 === null) ? null : $startRotate1 + (($endRotate1 - $startRotate1) * $i) / $frameCount);
				$tags->push($this->moveObject($depth, $dx * 20, $dy * 20, $dsx, $dsy, $drs0, $drs1));
				$tags->push($this->showFrame());
				unset($i,$dy,$dx,$dsy,$dsx,$drs1,$drs0);
			}
		}
		return $tags;
	}
	public function removeObject2() {
		$depth = $this->getInt("depth", null, true, null, null);
		return format_swf_SWFTag::TRemoveObject2($depth);
	}
	public function startSound() {
		$id = $this->getInt("id", null, true, false, true);
		$stop = $this->getBool("stop", false, null);
		$loopCount = $this->getInt("loopCount", 0, null, null, null);
		$hasLoops = ($loopCount === 0 ? false : true);
		return format_swf_SWFTag::TStartSound($id, _hx_anonymous(array("syncStop" => $stop, "hasLoops" => $hasLoops, "loopCount" => $loopCount)));
	}
	public function symbolClass() {
		$cid = $this->getInt("id", null, true, false, true);
		$className = $this->getString("class", "", true);
		$symbols = new _hx_array(array(_hx_anonymous(array("cid" => $cid, "className" => $className))));
		$baseClass = $this->getString("base", "", null);
		$tags = new _hx_array(array());
		if($baseClass != "") {
			$abcTag = $this->createABC($className, $baseClass);
			if($abcTag === null) {
				$this->error("!ERROR: Invalid base class: " . $baseClass . ". Valid base classes are: " . $this->validBaseClasses->toString() . ". TAG: " . $this->currentTag->toString());
			}
			$tags = new _hx_array(array($abcTag, format_swf_SWFTag::TSymbolClass($symbols)));
		}
		else {
			$tags = new _hx_array(array(format_swf_SWFTag::TSymbolClass($symbols)));
		}
		return $tags;
	}
	public function metadata() {
		$file = $this->getString("file", "", true);
		$data = $this->getContent($file);
		return format_swf_SWFTag::TMetadata($data);
	}
	public function frameLabel() {
		$label = $this->getString("name", "", true);
		$anchor = $this->getBool("anchor", false, null);
		return format_swf_SWFTag::TFrameLabel($label, $anchor);
	}
	public function showFrame() {
		return format_swf_SWFTag::$TShowFrame;
	}
	public function endFrame() {
		return format_swf_SWFTag::$TEnd;
	}
	public function custom() {
		$tagId = $this->getInt("tagId", null, true, null, null);
		$comment = $this->getString("comment", "", false);
		$data = null;
		$file = $this->getString("file", "", false);
		if($file == "") {
			$str = $this->getString("data", "", true);
			$arr = _hx_explode(",", $str);
			$buffer = new haxe_io_BytesBuffer();
			{
				$_g1 = 0; $_g = $arr->length;
				while($_g1 < $_g) {
					$i = $_g1++;
					$buffer->b .= chr(Std::parseInt($arr[$i]));
					unset($i);
				}
			}
			$data = $buffer->getBytes();
		}
		else {
			$data = $this->getBytes($file);
		}
		return format_swf_SWFTag::TUnknown($tagId, $data);
	}
	public function storeWidthHeight($id, $fileName, $b) {
		$extension = strtolower(_hx_substr($fileName, _hx_last_index_of($fileName, ".", null) + 1, null));
		$height = 0;
		$width = 0;
		$bytes = new haxe_io_BytesInput($b, null, null);
		if($extension == "jpg" || $extension == "jpeg") {
			if($bytes->readByte() !== 255 || $bytes->readByte() !== 216) {
				$this->error("!ERROR: in image file: " . $fileName . ". SOI (Start Of Image) marker 0xff 0xd8 missing , TAG: " . $this->currentTag->toString());
			}
			$marker = null;
			$len = null;
			while($bytes->readByte() === 255) {
				$marker = $bytes->readByte();
				$len = ($bytes->readByte() << 8 | $bytes->readByte());
				if($marker === 192) {
					$bytes->readByte();
					$height = ($bytes->readByte() << 8 | $bytes->readByte());
					$width = ($bytes->readByte() << 8 | $bytes->readByte());
					break;
				}
				$bytes->read($len - 2);
				;
			}
		}
		else {
			if(strtolower($extension) == "png") {
				$bytes->setEndian(true);
				$bytes->readInt32();
				$bytes->readInt32();
				$bytes->readInt32();
				$bytes->readInt32();
				$width = $bytes->readUInt30();
				$height = $bytes->readUInt30();
			}
			else {
				if(strtolower($extension) == "gif") {
					$bytes->setEndian(false);
					$bytes->readInt32();
					$bytes->readUInt16();
					$width = $bytes->readUInt16();
					$height = $bytes->readUInt16();
				}
			}
		}
		$this->bitmapIds[$id] = new _hx_array(array($width, $height));
	}
	public function createABC($className, $baseClass) {
		$ctx = new format_abc_Context();
		$abcOutput = new haxe_io_BytesOutput();
		$this->swcClasses->push(new _hx_array(array($className, $baseClass)));
		switch($baseClass) {
		case "flash.display.MovieClip":{
			$c = $ctx->beginClass($className);
			$c->superclass = $ctx->type("flash.display.MovieClip");
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.display.DisplayObject");
			$ctx->addClassSuper("flash.display.InteractiveObject");
			$ctx->addClassSuper("flash.display.DisplayObjectContainer");
			$ctx->addClassSuper("flash.display.Sprite");
			$ctx->addClassSuper("flash.display.MovieClip");
			$m = $ctx->beginMethod($className, new _hx_array(array()), null, false, false, false, true);
			$m->maxStack = 2;
			$c->constructor = $m->type;
			$ctx->ops(new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::OConstructSuper(0), format_abc_OpCode::$ORetVoid)));
			$ctx->finalize();
			format_abc_Writer::write($abcOutput, $ctx->getData());
			return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => $className)));
		}break;
		case "flash.display.Sprite":{
			$c2 = $ctx->beginClass($className);
			$c2->superclass = $ctx->type("flash.display.Sprite");
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.display.DisplayObject");
			$ctx->addClassSuper("flash.display.InteractiveObject");
			$ctx->addClassSuper("flash.display.DisplayObjectContainer");
			$ctx->addClassSuper("flash.display.Sprite");
			$m2 = $ctx->beginMethod($className, new _hx_array(array()), null, false, false, false, true);
			$m2->maxStack = 2;
			$c2->constructor = $m2->type;
			$ctx->ops(new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::OConstructSuper(0), format_abc_OpCode::$ORetVoid)));
			$ctx->finalize();
			format_abc_Writer::write($abcOutput, $ctx->getData());
			return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => $className)));
		}break;
		case "flash.display.SimpleButton":{
			$c3 = $ctx->beginClass($className);
			$c3->superclass = $ctx->type("flash.display.SimpleButton");
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.display.DisplayObject");
			$ctx->addClassSuper("flash.display.InteractiveObject");
			$ctx->addClassSuper("flash.display.SimpleButton");
			$m3 = $ctx->beginMethod($className, new _hx_array(array()), null, false, false, false, true);
			$m3->maxStack = 2;
			$c3->constructor = $m3->type;
			$ctx->ops(new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::OConstructSuper(0), format_abc_OpCode::$ORetVoid)));
			$ctx->finalize();
			format_abc_Writer::write($abcOutput, $ctx->getData());
			return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => $className)));
		}break;
		case "flash.display.Bitmap":{
			$c4 = $ctx->beginClass($className);
			$c4->superclass = $ctx->type("flash.display.Bitmap");
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.display.DisplayObject");
			$ctx->addClassSuper("flash.display.Bitmap");
			$m4 = $ctx->beginMethod($className, new _hx_array(array()), null, false, false, false, true);
			$m4->maxStack = 2;
			$c4->constructor = $m4->type;
			$ctx->ops(new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::OConstructSuper(0), format_abc_OpCode::$ORetVoid)));
			$ctx->finalize();
			format_abc_Writer::write($abcOutput, $ctx->getData());
			return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => $className)));
		}break;
		case "flash.media.Sound":{
			$c5 = $ctx->beginClass($className);
			$c5->superclass = $ctx->type("flash.media.Sound");
			$ctx->addClassSuper("flash.events.EventDispatcher");
			$ctx->addClassSuper("flash.media.Sound");
			$m5 = $ctx->beginMethod($className, new _hx_array(array()), null, false, false, false, true);
			$m5->maxStack = 2;
			$c5->constructor = $m5->type;
			$ctx->ops(new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::OConstructSuper(0), format_abc_OpCode::$ORetVoid)));
			$ctx->finalize();
			format_abc_Writer::write($abcOutput, $ctx->getData());
			return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => $className)));
		}break;
		case "flash.text.Font":{
			$c6 = $ctx->beginClass($className);
			$c6->superclass = $ctx->type("flash.text.Font");
			$ctx->addClassSuper("flash.text.Font");
			$m6 = $ctx->beginMethod($className, new _hx_array(array()), null, false, false, false, true);
			$m6->maxStack = 2;
			$c6->constructor = $m6->type;
			$ctx->ops(new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::OConstructSuper(0), format_abc_OpCode::$ORetVoid)));
			$ctx->finalize();
			format_abc_Writer::write($abcOutput, $ctx->getData());
			return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => $className)));
		}break;
		case "flash.utils.ByteArray":{
			$c7 = $ctx->beginClass($className);
			$c7->superclass = $ctx->type("flash.utils.ByteArray");
			$ctx->addClassSuper("flash.utils.ByteArray");
			$m7 = $ctx->beginMethod($className, new _hx_array(array()), null, false, false, false, true);
			$m7->maxStack = 2;
			$c7->constructor = $m7->type;
			$ctx->ops(new _hx_array(array(format_abc_OpCode::$OThis, format_abc_OpCode::OConstructSuper(0), format_abc_OpCode::$ORetVoid)));
			$ctx->finalize();
			format_abc_Writer::write($abcOutput, $ctx->getData());
			return format_swf_SWFTag::TActionScript3($abcOutput->getBytes(), _hx_anonymous(array("id" => 1, "label" => $className)));
		}break;
		default:{
			return null;
		}break;
		}
	}
	public function getContent($file) {
		$this->checkFileExistence($file);
		return php_io_File::getContent($file);
	}
	public function getBytes($file) {
		$this->checkFileExistence($file);
		return php_io_File::getBytes($file);
	}
	public function getInt($att, $defaultValue, $required, $uniqueId, $targetId) {
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
				$this->error("!ERROR: attribute " . $att . " must be an integer: " . $this->currentTag->toString());
			}
		}
		if($required) {
			if(!$this->currentTag->exists($att)) {
				$this->error("!ERROR: Required attribute " . $att . " is missing in tag: " . $this->currentTag->toString());
			}
		}
		if($uniqueId) {
			$this->checkDictionary(Std::parseInt($this->currentTag->get($att)));
		}
		if($targetId) {
			$this->checkTargetId(Std::parseInt($this->currentTag->get($att)));
		}
		return ($this->currentTag->exists($att) ? Std::parseInt($this->currentTag->get($att)) : $defaultValue);
	}
	public function getBool($att, $defaultValue, $required) {
		if($required === null) {
			$required = false;
		}
		if($required) {
			if(!$this->currentTag->exists($att)) {
				$this->error("!ERROR: Required attribute " . $att . " is missing in tag: " . $this->currentTag);
			}
		}
		return ($this->currentTag->exists($att) ? (($this->currentTag->get($att) == "true" ? true : false)) : $defaultValue);
	}
	public function getFloat($att, $defaultValue, $required) {
		if($required === null) {
			$required = false;
		}
		if($this->currentTag->exists($att)) {
			if(Math::isNaN(Std::parseFloat($this->currentTag->get($att)))) {
				$this->error("!ERROR: attribute " . $att . " must be a number: " . $this->currentTag->toString());
			}
		}
		if($required) {
			if(!$this->currentTag->exists($att)) {
				$this->error("!ERROR: Required attribute " . $att . " is missing in tag: " . $this->currentTag->toString());
			}
		}
		return ($this->currentTag->exists($att) ? Std::parseFloat($this->currentTag->get($att)) : $defaultValue);
	}
	public function getString($att, $defaultValue, $required) {
		if($required === null) {
			$required = false;
		}
		if($required) {
			if(!$this->currentTag->exists($att)) {
				$this->error("!ERROR: Required attribute " . $att . " is missing in tag: " . $this->currentTag->toString());
			}
		}
		return ($this->currentTag->exists($att) ? $this->currentTag->get($att) : $defaultValue);
	}
	public function getMatrix() {
		$scale = null; $rotate = null; $translate = null;
		$scaleX = $this->getFloat("scaleX", null, null);
		$scaleY = $this->getFloat("scaleY", null, null);
		$scale = (($scaleX === null && $scaleY === null) ? null : _hx_anonymous(array("x" => ($scaleX === null ? 1.0 : $scaleX), "y" => ($scaleY === null ? 1.0 : $scaleY))));
		$rs0 = $this->getFloat("rotate0", null, null);
		$rs1 = $this->getFloat("rotate1", null, null);
		$rotate = (($rs0 === null && $rs1 === null) ? null : _hx_anonymous(array("rs0" => ($rs0 === null ? 0.0 : $rs0), "rs1" => ($rs1 === null ? 0.0 : $rs1))));
		$x = $this->getInt("x", 0, null, null, null) * 20;
		$y = $this->getInt("y", 0, null, null, null) * 20;
		$translate = _hx_anonymous(array("x" => $x, "y" => $y));
		return _hx_anonymous(array("scale" => $scale, "rotate" => $rotate, "translate" => $translate));
	}
	public function checkDictionary($id) {
		if($this->dictionary[$id] !== null) {
			$this->error("!ERROR: You are overwriting an existing id: " . $id . ". TAG: " . $this->currentTag->toString());
		}
		if($id === 0 && strtolower($this->currentTag->getNodeName()) != "symbolclass") {
			$this->error("!ERROR: id 0 used outside symbol class. Index 0 can only be used for the SymbolClass tag that references the DefineABC tag which holds your document class/main entry point. Tag: " . $this->currentTag->toString());
		}
		$this->dictionary[$id] = strtolower($this->currentTag->getNodeName());
	}
	public function checkTargetId($id) {
		if($id !== 0 && $this->dictionary[$id] === null) {
			$this->error("!ERROR: The target id " . $id . " does not exist. TAG: " . $this->currentTag->toString());
		}
		else {
			if(strtolower($this->currentTag->getNodeName()) == "placeobject" || strtolower($this->currentTag->getNodeName()) == "buttonstate") {
				switch($this->dictionary[$id]) {
				case "defineshape":case "definebutton":case "definesprite":case "defineedittext":{
					;
				}break;
				default:{
					$this->error("!ERROR: The target id " . $id . " must be a reference to a DefineShape, DefineButton, DefineSprite or DefineEditText tag. TAG: " . $this->currentTag->toString());
				}break;
				}
			}
			else {
				if(strtolower($this->currentTag->getNodeName()) == "definescalinggrid") {
					switch($this->dictionary[$id]) {
					case "definebutton":case "definesprite":{
						;
					}break;
					default:{
						$this->error("!ERROR: The target id " . $id . " must be a reference to a DefineButton or DefineSprite tag. TAG: " . $this->currentTag->toString());
					}break;
					}
				}
				else {
					if(strtolower($this->currentTag->getNodeName()) == "startsound") {
						if($this->dictionary[$id] != "definesound") {
							$this->error("!ERROR: The target id " . $id . " must be a reference to a DefineSound tag. TAG: " . $this->currentTag->toString());
						}
					}
					else {
						if($id !== 0 && strtolower($this->currentTag->getNodeName()) == "symbolclass") {
							switch($this->dictionary[$id]) {
							case "definebutton":case "definesprite":case "definebinarydata":case "definefont":case "defineabc":case "definesound":case "definebitsjpeg":{
								;
							}break;
							default:{
								$this->error("!ERROR: The target id " . $id . " must be a reference to a DefineButton, DefineSprite, DefineBinaryData, DefineFont, DefineABC, DefineSound or DefineBitsJPEG tag. TAG: " . $this->currentTag->toString());
							}break;
							}
						}
					}
				}
			}
		}
	}
	public function checkFileExistence($file) {
		if(!file_exists($file)) {
			$this->error("!ERROR: File: " . $file . " could not be found at the given location. TAG: " . $this->currentTag->toString());
		}
	}
	public function setup() {
		$this->validChildren = new Hash();
		$this->validChildren->set("swf", new _hx_array(array("header", "fileattributes", "setbackgroundcolor", "scriptlimits", "definebitsjpeg", "defineshape", "definesprite", "definebutton", "definebinarydata", "definesound", "definefont", "defineedittext", "defineabc", "definescalinggrid", "placeobject", "removeobject", "startsound", "symbolclass", "metadata", "framelabel", "showframe", "endframe", "custom")));
		$this->validChildren->set("defineshape", new _hx_array(array("beginfill", "begingradientfill", "beginbitmapfill", "linestyle", "moveto", "lineto", "curveto", "endfill", "endline", "clear", "drawcircle", "drawellipse", "drawrect", "drawroundrect", "drawroundrectcomplex", "custom")));
		$this->validChildren->set("definesprite", new _hx_array(array("placeobject", "removeobject", "startsound", "framelabel", "showframe", "endframe", "tween", "custom")));
		$this->validChildren->set("definebutton", new _hx_array(array("buttonstate", "custom")));
		$this->validChildren->set("tween", new _hx_array(array("tw", "custom")));
		$this->validElements = new Hash();
		$this->validElements->set("swf", new _hx_array(array()));
		$this->validElements->set("header", new _hx_array(array("width", "height", "fps", "version", "compressed", "frameCount")));
		$this->validElements->set("fileattributes", new _hx_array(array("actionscript3", "useNetwork", "useDirectBlit", "useGPU", "hasMetaData")));
		$this->validElements->set("setbackgroundcolor", new _hx_array(array("color")));
		$this->validElements->set("scriptlimits", new _hx_array(array("maxRecursionDepth", "scriptTimeoutSeconds")));
		$this->validElements->set("definebitsjpeg", new _hx_array(array("id", "file")));
		$this->validElements->set("defineshape", new _hx_array(array("id", "bitmapId", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1", "repeat", "smooth")));
		$this->validElements->set("beginfill", new _hx_array(array("color", "alpha")));
		$this->validElements->set("begingradientfill", new _hx_array(array("colors", "alphas", "ratios", "type", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1")));
		$this->validElements->set("beginbitmapfill", new _hx_array(array("bitmapId", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1", "repeat", "smooth")));
		$this->validElements->set("linestyle", new _hx_array(array("width", "color", "alpha")));
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
		$this->validElements->set("definesprite", new _hx_array(array("id", "frameCount")));
		$this->validElements->set("definebutton", new _hx_array(array("id")));
		$this->validElements->set("buttonstate", new _hx_array(array("id", "depth", "hit", "down", "over", "up", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1")));
		$this->validElements->set("definebinarydata", new _hx_array(array("id", "file")));
		$this->validElements->set("definesound", new _hx_array(array("id", "file")));
		$this->validElements->set("definefont", new _hx_array(array("id", "file")));
		$this->validElements->set("defineedittext", new _hx_array(array("id", "initialText", "fontID", "useOutlines", "width", "height", "wordWrap", "multiline", "password", "input", "autoSize", "selectable", "border", "wasStatic", "html", "fontClass", "fontHeight", "textColor", "maxLength", "align", "leftMargin", "rightMargin", "indent", "leading", "variableName", "file")));
		$this->validElements->set("defineabc", new _hx_array(array("file")));
		$this->validElements->set("definescalinggrid", new _hx_array(array("id", "x", "width", "y", "height")));
		$this->validElements->set("placeobject", new _hx_array(array("id", "depth", "name", "move", "x", "y", "scaleX", "scaleY", "rotate0", "rotate1")));
		$this->validElements->set("removeobject", new _hx_array(array("depth")));
		$this->validElements->set("startsound", new _hx_array(array("id", "stop", "loopCount")));
		$this->validElements->set("symbolclass", new _hx_array(array("id", "class", "base")));
		$this->validElements->set("metadata", new _hx_array(array("file")));
		$this->validElements->set("framelabel", new _hx_array(array("name", "anchor")));
		$this->validElements->set("showframe", new _hx_array(array()));
		$this->validElements->set("endframe", new _hx_array(array()));
		$this->validElements->set("tween", new _hx_array(array("depth", "frameCount")));
		$this->validElements->set("tw", new _hx_array(array("prop", "start", "end")));
		$this->validElements->set("custom", new _hx_array(array("tagId", "file", "data", "comment")));
		$this->validBaseClasses = new _hx_array(array("flash.display.MovieClip", "flash.display.Sprite", "flash.display.SimpleButton", "flash.display.Bitmap", "flash.media.Sound", "flash.text.Font", "flash.utils.ByteArray"));
	}
	public function checkUnknownAttributes() {
		if(!$this->validElements->exists(strtolower($this->currentTag->getNodeName()))) {
			$this->error("!ERROR: Unknown tag: " . $this->currentTag->getNodeName());
		}
		$»it = $this->currentTag->attributes();
		while($»it->hasNext()) {
		$a = $»it->next();
		{
			if(!$this->checkValidAttribute($a)) {
				$this->error("!ERROR: Unknown attribute: " . $a . ". Valid attributes are: " . $this->validElements->get(strtolower($this->currentTag->getNodeName()))->toString() . ". TAG: " . $this->currentTag->toString());
			}
			;
		}
		}
	}
	public function checkValidAttribute($a) {
		$validAttributes = $this->validElements->get(strtolower($this->currentTag->getNodeName()));
		{
			$_g = 0;
			while($_g < $validAttributes->length) {
				$i = $validAttributes[$_g];
				++$_g;
				if($a == $i) {
					return true;
				}
				unset($i);
			}
		}
		return false;
	}
	public function createXML($mod) {
		$xmlString = "";
		$xmlString .= "<?xml version=\"1.0\" encoding =\"utf-8\"?>";
		$xmlString .= "<swc xmlns=\"http://www.adobe.com/flash/swccatalog/9\">";
		$xmlString .= "<versions>";
		$xmlString .= "<swc version=\"1.2\"/>";
		$xmlString .= "<haxe version=\"2.04\"/>";
		$xmlString .= "</versions>";
		$xmlString .= "<features>";
		$xmlString .= "<feature-script-deps/>";
		$xmlString .= "<feature-files/>";
		$xmlString .= "</features>";
		$xmlString .= "<libraries>";
		$xmlString .= "<library path=\"library.swf\">";
		{
			$_g = 0; $_g1 = $this->swcClasses;
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				$dep = _hx_explode(".", $i[1]);
				$xmlString .= "<script name=\"" . $i[0] . "\" mod=\"0\" >";
				$xmlString .= "<def id=\"" . $i[0] . "\" />";
				$xmlString .= "<dep id=\"" . $dep[0] . "." . $dep[1] . ":" . $dep[2] . "\" type=\"i\" />";
				$xmlString .= "<dep id=\"AS3\" type=\"n\" />";
				$xmlString .= "</script>";
				unset($i,$dep);
			}
		}
		$xmlString .= "</library>";
		$xmlString .= "</libraries>";
		$xmlString .= "<files>";
		$xmlString .= "</files>";
		$xmlString .= "</swc>";
		return $xmlString;
	}
	public function error($msg) {
		throw new HException($msg);
	}
	public function inform($msg) {
		php_Lib::println($msg);
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	static function main() {
		new HXswfML();
	}
	function __toString() { return 'HXswfML'; }
}
