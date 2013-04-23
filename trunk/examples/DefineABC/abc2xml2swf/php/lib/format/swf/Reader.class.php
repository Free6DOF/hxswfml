<?php

class format_swf_Reader {
	public function __construct($i) {
		if(!php_Boot::$skip_constructor) {
		$this->i = $i;
	}}
	public function read() {
		return _hx_anonymous(array("header" => $this->readHeader(), "tags" => $this->readTagList(null)));
	}
	public function readTag($light = null) {
		if($light === null) {
			$light = false;
		}
		$h = $this->i->readUInt16();
		$id = $h >> 6;
		$tlen = $h & 63;
		$len = $tlen;
		$ext = false;
		if($tlen === 63) {
			$len = $this->i->readInt32();
			if($len < 63) {
				$ext = true;
			}
		}
		if($light) {
			return format_swf_Reader_0($this, $ext, $h, $id, $len, $light, $tlen);
		} else {
			return format_swf_Reader_1($this, $ext, $h, $id, $len, $light, $tlen);
		}
	}
	public function readTagList($light = null) {
		if($light === null) {
			$light = false;
		}
		$a = new _hx_array(array());
		while(true) {
			$t = $this->readTag($light);
			if($t === null) {
				break;
			}
			$a->push($t);
			unset($t);
		}
		return $a;
	}
	public function readHeader() {
		$tag = $this->i->readString(3);
		$compressed = null;
		if($tag === "CWS") {
			$compressed = true;
		} else {
			if($tag === "FWS") {
				$compressed = false;
			} else {
				throw new HException($this->error("invalid file signature"));
			}
		}
		$this->version = $this->i->readByte();
		$size = $this->i->readInt32();
		if($compressed) {
			$bytes = format_tools_Inflate::run($this->i->readAll(null));
			if($bytes->length + 8 !== $size) {
				throw new HException($this->error("wrong bytes length after decompression"));
			}
			$this->i = new haxe_io_BytesInput($bytes, null, null);
		}
		$this->bits = new format_tools_BitsInput($this->i);
		$r = $this->readRect();
		if($r->left !== 0 || $r->top !== 0) {
			throw new HException($this->error("invalid swf width or height"));
		}
		$this->i->readByte();
		$fps = $this->i->readByte();
		$nframes = $this->i->readUInt16();
		return _hx_anonymous(array("version" => $this->version, "compressed" => $compressed, "width" => Std::int($r->right / 20), "height" => Std::int($r->bottom / 20), "fps" => $fps, "nframes" => $nframes));
	}
	public function readInt() {
		return $this->i->readInt32();
	}
	public function error($msg = null) {
		if($msg === null) {
			$msg = "";
		}
		return "Invalid SWF: " . _hx_string_or_null($msg);
	}
	public function readFileAttributes() {
		$this->bits->nbits = 0;
		$this->bits->readBits(1);
		$useDirectBlit = (($this->bits->readBits(1) === 1) ? true : false);
		$useGPU = (($this->bits->readBits(1) === 1) ? true : false);
		$hasMetaData = (($this->bits->readBits(1) === 1) ? true : false);
		$actionscript3 = (($this->bits->readBits(1) === 1) ? true : false);
		$this->bits->readBits(2);
		$useNetWork = (($this->bits->readBits(1) === 1) ? true : false);
		$this->bits->readBits(24);
		return _hx_anonymous(array("useDirectBlit" => $useDirectBlit, "useGPU" => $useGPU, "hasMetaData" => $hasMetaData, "actionscript3" => $actionscript3, "useNetWork" => $useNetWork));
	}
	public function readEnvelopeRecords($count) {
		$envelopeRecords = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $count) {
				$env = $_g++;
				$envelopeRecords->push(_hx_anonymous(array("pos44" => $this->i->readInt32(), "leftLevel" => $this->i->readUInt16(), "rightLevel" => $this->i->readUInt16())));
				unset($env);
			}
		}
		return $envelopeRecords;
	}
	public function readSoundInfo() {
		$this->bits->nbits = 0;
		$this->bits->readBits(2);
		$syncStop = (($this->bits->readBits(1) === 1) ? true : false);
		$syncNoMultiple = $this->bits->readBits(1);
		$hasEnvelope = $this->bits->readBits(1);
		$hasLoops = (($this->bits->readBits(1) === 1) ? true : false);
		$hasOutPoint = $this->bits->readBits(1);
		$hasInPoint = $this->bits->readBits(1);
		$inPoint = null;
		$outPoint = null;
		$loopCount = null;
		$envPoints = null;
		$envelopeRecords = null;
		if($hasInPoint === 1) {
			$inPoint = $this->i->readInt32();
		}
		if($hasOutPoint === 1) {
			$outPoint = $this->i->readInt32();
		}
		if($hasLoops) {
			$loopCount = $this->i->readUInt16();
		}
		if($hasEnvelope === 1) {
			$envPoints = $this->i->readByte();
			$envelopeRecords = $this->readEnvelopeRecords($envPoints);
		}
		return _hx_anonymous(array("syncStop" => $syncStop, "hasLoops" => $hasLoops, "loopCount" => (($hasLoops) ? $loopCount : null)));
	}
	public function readFontInfo($len, $ver) {
		$cid = $this->i->readUInt16();
		$name = $this->i->readString($this->i->readByte());
		$this->bits->nbits = 0;
		$this->bits->readBits(2);
		$isSmall = $this->bits->readBit();
		$shiftJIS = $this->bits->readBit();
		$isANSI = $this->bits->readBit();
		$isItalic = $this->bits->readBit();
		$isBold = $this->bits->readBit();
		$hasWideCodes = $this->bits->readBit();
		$language = (($ver === 2) ? $this->readLanguage() : format_swf_LangCode::$LCNone);
		$num_glyphs = $len - 4 - strlen($name);
		$code_table = new _hx_array(array());
		if($hasWideCodes) {
			$num_glyphs >>= 1;
			{
				$_g = 0;
				while($_g < $num_glyphs) {
					$j = $_g++;
					$code_table->push($this->i->readUInt16());
					unset($j);
				}
			}
		} else {
			$_g = 0;
			while($_g < $num_glyphs) {
				$j = $_g++;
				$code_table->push($this->i->readByte());
				unset($j);
			}
		}
		$fi_data = _hx_anonymous(array("name" => $name, "isSmall" => $isSmall, "isItalic" => $isItalic, "isBold" => $isBold, "codeTable" => $code_table));
		return format_swf_SWFTag::TFontInfo($cid, format_swf_Reader_2($this, $cid, $code_table, $fi_data, $hasWideCodes, $isANSI, $isBold, $isItalic, $isSmall, $language, $len, $name, $num_glyphs, $shiftJIS, $ver));
	}
	public function readFont($len, $ver) {
		$cid = $this->i->readUInt16();
		return format_swf_SWFTag::TFont($cid, format_swf_Reader_3($this, $cid, $len, $ver));
	}
	public function readFont2Data($ver) {
		$this->bits->nbits = 0;
		$hasLayout = $this->bits->readBit();
		$shiftJIS = $this->bits->readBit();
		$isSmall = $this->bits->readBit();
		$isANSI = $this->bits->readBit();
		$hasWideOffsets = $this->bits->readBit();
		$hasWideCodes = $this->bits->readBit();
		$isItalic = $this->bits->readBit();
		$isBold = $this->bits->readBit();
		$language = $this->readLanguage();
		$name = $this->i->readString($this->i->readByte());
		$num_glyphs = $this->i->readUInt16();
		$offset_table = new _hx_array(array());
		$glyphs = new _hx_array(array());
		if($num_glyphs !== 0) {
			$shape_data_length = 0;
			if($hasWideOffsets) {
				$first_glyph_offset = $num_glyphs * 4 + 4;
				{
					$_g = 0;
					while($_g < $num_glyphs) {
						$j = $_g++;
						$offset_table->push($this->i->readInt32() - $first_glyph_offset);
						unset($j);
					}
				}
				$code_table_offset = $this->i->readInt32();
				$shape_data_length = $code_table_offset - $first_glyph_offset;
			} else {
				$first_glyph_offset = $num_glyphs * 2 + 2;
				{
					$_g = 0;
					while($_g < $num_glyphs) {
						$j = $_g++;
						$offs = $this->i->readUInt16();
						$offset_table->push($offs - $first_glyph_offset);
						unset($offs,$j);
					}
				}
				$code_table_offset = $this->i->readUInt16();
				$shape_data_length = $code_table_offset - $first_glyph_offset;
			}
			$glyph_shapes = $this->readGlyphs($shape_data_length, $offset_table);
			if($hasWideCodes) {
				$_g = 0;
				while($_g < $num_glyphs) {
					$j = $_g++;
					$glyphs->push(_hx_anonymous(array("charCode" => $this->i->readUInt16(), "shape" => $glyph_shapes[$j])));
					unset($j);
				}
			} else {
				$_g = 0;
				while($_g < $num_glyphs) {
					$j = $_g++;
					$glyphs->push(_hx_anonymous(array("charCode" => $this->i->readByte(), "shape" => $glyph_shapes[$j])));
					unset($j);
				}
			}
		}
		$layout = null;
		if($hasLayout) {
			$ascent = $this->i->readInt16();
			$descent = $this->i->readInt16();
			$leading = $this->i->readInt16();
			$advance_table = new _hx_array(array());
			{
				$_g = 0;
				while($_g < $num_glyphs) {
					$j = $_g++;
					$advance_table->push($this->i->readInt16());
					unset($j);
				}
			}
			$glyph_layout = new _hx_array(array());
			{
				$_g = 0;
				while($_g < $num_glyphs) {
					$j = $_g++;
					$bounds = $this->readRect();
					$glyph_layout->push(_hx_anonymous(array("advance" => $advance_table[$j], "bounds" => $bounds)));
					unset($j,$bounds);
				}
			}
			$num_kerning = $this->i->readUInt16();
			$kerning = new _hx_array(array());
			{
				$_g = 0;
				while($_g < $num_kerning) {
					$i = $_g++;
					$kerning->push($this->readKerningRecord($hasWideCodes));
					unset($i);
				}
			}
			$layout = _hx_anonymous(array("ascent" => $ascent, "descent" => $descent, "leading" => $leading, "glyphs" => $glyph_layout, "kerning" => $kerning));
		}
		$f2data = _hx_anonymous(array("shiftJIS" => $shiftJIS, "isSmall" => $isSmall, "isANSI" => $isANSI, "isItalic" => $isItalic, "isBold" => $isBold, "language" => $language, "name" => $name, "glyphs" => $glyphs, "layout" => $layout));
		return format_swf_Reader_4($this, $f2data, $glyphs, $hasLayout, $hasWideCodes, $hasWideOffsets, $isANSI, $isBold, $isItalic, $isSmall, $language, $layout, $name, $num_glyphs, $offset_table, $shiftJIS, $ver);
	}
	public function readFont1Data($len) {
		$offs1 = $this->i->readUInt16();
		$num_glyphs = $offs1 >> 1;
		$offset_table = new _hx_array(array());
		$offset_table->push(0);
		{
			$_g = 1;
			while($_g < $num_glyphs) {
				$j = $_g++;
				$offset_table->push($this->i->readUInt16() - $offs1);
				unset($j);
			}
		}
		return format_swf_FontData::FDFont1(_hx_anonymous(array("glyphs" => $this->readGlyphs($len - 2 - $num_glyphs * 2, $offset_table))));
	}
	public function readKerningRecord($hasWideCodes) {
		return _hx_anonymous(array("charCode1" => (($hasWideCodes) ? $this->i->readUInt16() : $this->i->readByte()), "charCode2" => (($hasWideCodes) ? $this->i->readUInt16() : $this->i->readByte()), "adjust" => $this->i->readInt16()));
	}
	public function readGlyphs($len, $offsets) {
		$shape_data = $this->i->read($len);
		$glyphs = new _hx_array(array());
		if($offsets->length === 0) {
			return $glyphs;
		}
		{
			$_g = 0;
			while($_g < $offsets->length) {
				$offs = $offsets[$_g];
				++$_g;
				$old_i = $this->i;
				$old_bits = $this->bits;
				$this->i = new haxe_io_BytesInput($shape_data, $offs, null);
				$this->bits = new format_tools_BitsInput($this->i);
				$glyphs->push($this->readShapeWithoutStyle(1));
				$this->i = $old_i;
				$this->bits = $old_bits;
				unset($old_i,$old_bits,$offs);
			}
		}
		return $glyphs;
	}
	public function readLanguage() {
		return format_swf_Reader_5($this);
	}
	public function readSound($len) {
		$sid = $this->i->readUInt16();
		$this->bits->nbits = 0;
		$soundFormat = format_swf_Reader_6($this, $len, $sid);
		$soundRate = format_swf_Reader_7($this, $len, $sid, $soundFormat);
		$is16bit = $this->bits->readBit();
		$isStereo = $this->bits->readBit();
		$soundSamples = $this->i->readInt32();
		$sdata = format_swf_Reader_8($this, $is16bit, $isStereo, $len, $sid, $soundFormat, $soundRate, $soundSamples);
		return format_swf_SWFTag::TSound(_hx_anonymous(array("sid" => $sid, "format" => $soundFormat, "rate" => $soundRate, "is16bit" => $is16bit, "isStereo" => $isStereo, "samples" => $soundSamples, "data" => $sdata)));
	}
	public function readSymbols() {
		$sl = new _hx_array(array());
		{
			$_g1 = 0; $_g = $this->i->readUInt16();
			while($_g1 < $_g) {
				$n = $_g1++;
				$id = $this->i->readUInt16();
				$name = $this->i->readUntil(0);
				$sl->push(_hx_anonymous(array("cid" => $id, "className" => $name)));
				unset($name,$n,$id);
			}
		}
		return $sl;
	}
	public function readLossless($len, $v2) {
		$cid = $this->i->readUInt16();
		$bits = $this->i->readByte();
		return _hx_anonymous(array("cid" => $cid, "width" => $this->i->readUInt16(), "height" => $this->i->readUInt16(), "color" => format_swf_Reader_9($this, $bits, $cid, $len, $v2), "data" => $this->i->read($len - ((($bits === 3) ? 8 : 7)))));
	}
	public function readPlaceObject($v3) {
		$f = $this->i->readByte();
		$f2 = (($v3) ? $this->i->readByte() : 0);
		if($f2 >> 5 !== 0) {
			throw new HException($this->error("unsupported bit flags in place object"));
		}
		$po = new format_swf_PlaceObject();
		$po->depth = $this->i->readUInt16();
		if(($f2 & 8) !== 0 || ($f2 & 16) !== 0 && ($f & 2) !== 0) {
			$po->className = $this->readUTF8Bytes()->toString();
		}
		if(($f & 1) !== 0) {
			$po->move = true;
		}
		if(($f & 2) !== 0) {
			$po->cid = $this->i->readUInt16();
		}
		if(($f & 4) !== 0) {
			$po->matrix = $this->readMatrix();
		}
		if(($f & 8) !== 0) {
			$po->color = $this->readCXA();
		}
		if(($f & 16) !== 0) {
			$po->ratio = $this->i->readUInt16();
		}
		if(($f & 32) !== 0) {
			$po->instanceName = $this->readUTF8Bytes()->toString();
		}
		if(($f & 64) !== 0) {
			$po->clipDepth = $this->i->readUInt16();
		}
		if(($f2 & 1) !== 0) {
			$po->filters = $this->readFilters();
		}
		if(($f2 & 2) !== 0) {
			$po->blendMode = $this->readBlendMode();
		}
		if(($f2 & 4) !== 0) {
			$po->bitmapCache = $this->i->readByte();
		}
		if(($f2 & 16) !== 0) {
			$po->hasImage = true;
		}
		if(($f & 128) !== 0) {
			$po->events = $this->readClipEvents();
		}
		return $po;
	}
	public function readBlendMode() {
		return format_swf_Reader_10($this);
	}
	public function readMorphShape($ver) {
		$id = $this->i->readUInt16();
		$startBounds = $this->readRect();
		$endBounds = $this->readRect();
		switch($ver) {
		case 1:{
			$this->i->readInt32();
			$fillStyles = $this->readMorphFillStyles($ver);
			$lineStyles = $this->readMorph1LineStyles();
			$startEdges = $this->readShapeWithoutStyle(3);
			$this->bits->nbits = 0;
			$endEdges = $this->readShapeWithoutStyle(3);
			return format_swf_SWFTag::TMorphShape($id, format_swf_MorphShapeData::MSDShape1(_hx_anonymous(array("startBounds" => $startBounds, "endBounds" => $endBounds, "fillStyles" => $fillStyles, "lineStyles" => $lineStyles, "startEdges" => $startEdges, "endEdges" => $endEdges))));
		}break;
		case 2:{
			$startEdgeBounds = $this->readRect();
			$endEdgeBounds = $this->readRect();
			$this->bits->nbits = 0;
			$this->bits->readBits(6);
			$useNonScalingStrokes = $this->bits->readBit();
			$useScalingStrokes = $this->bits->readBit();
			$this->bits->nbits = 0;
			$this->i->readInt32();
			$fillStyles = $this->readMorphFillStyles($ver);
			$lineStyles = $this->readMorph2LineStyles();
			$startEdges = $this->readShapeWithoutStyle(4);
			$this->bits->nbits = 0;
			$endEdges = $this->readShapeWithoutStyle(4);
			return format_swf_SWFTag::TMorphShape($id, format_swf_MorphShapeData::MSDShape2(_hx_anonymous(array("startBounds" => $startBounds, "endBounds" => $endBounds, "startEdgeBounds" => $startEdgeBounds, "endEdgeBounds" => $endEdgeBounds, "useNonScalingStrokes" => $useNonScalingStrokes, "useScalingStrokes" => $useScalingStrokes, "fillStyles" => $fillStyles, "lineStyles" => $lineStyles, "startEdges" => $startEdges, "endEdges" => $endEdges))));
		}break;
		default:{
			throw new HException("Unsupported morph fill style version!");
		}break;
		}
	}
	public function readMorph2LineStyles() {
		$len = $this->i->readByte();
		if($len === 255) {
			$len = $this->i->readUInt16();
		}
		$styles = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $len) {
				$i = $_g++;
				$styles->push($this->readMorph2LineStyle());
				unset($i);
			}
		}
		return $styles;
	}
	public function readMorph1LineStyles() {
		$len = $this->i->readByte();
		if($len === 255) {
			$len = $this->i->readUInt16();
		}
		$styles = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $len) {
				$i = $_g++;
				$styles->push($this->readMorph1LineStyle());
				unset($i);
			}
		}
		return $styles;
	}
	public function readMorph2LineStyle() {
		$startWidth = $this->i->readUInt16();
		$endWidth = $this->i->readUInt16();
		$this->bits->nbits = 0;
		$startCapStyle = $this->bits->readBits(2);
		$joinStyle = $this->bits->readBits(2);
		$hasFill = $this->bits->readBit();
		$noHScale = $this->bits->readBit();
		$noVScale = $this->bits->readBit();
		$pixelHinting = $this->bits->readBit();
		$this->bits->readBits(5);
		$noClose = $this->bits->readBit();
		$endCapStyle = $this->bits->readBits(2);
		$this->bits->nbits = 0;
		$morphData = _hx_anonymous(array("startWidth" => $startWidth, "endWidth" => $endWidth, "startCapStyle" => format_swf_Reader_11($this, $endCapStyle, $endWidth, $hasFill, $joinStyle, $noClose, $noHScale, $noVScale, $pixelHinting, $startCapStyle, $startWidth), "joinStyle" => format_swf_Reader_12($this, $endCapStyle, $endWidth, $hasFill, $joinStyle, $noClose, $noHScale, $noVScale, $pixelHinting, $startCapStyle, $startWidth), "noHScale" => $noHScale, "noVScale" => $noVScale, "pixelHinting" => $pixelHinting, "noClose" => $noClose, "endCapStyle" => format_swf_Reader_13($this, $endCapStyle, $endWidth, $hasFill, $joinStyle, $noClose, $noHScale, $noVScale, $pixelHinting, $startCapStyle, $startWidth)));
		if($hasFill) {
			return format_swf_Morph2LineStyle::M2LSFill($this->readMorphFillStyle(2), $morphData);
		}
		$startColor = $this->readRGBA($this->i);
		$endColor = $this->readRGBA($this->i);
		return format_swf_Morph2LineStyle::M2LSNoFill($startColor, $endColor, $morphData);
	}
	public function readMorph1LineStyle() {
		$sw = $this->i->readUInt16();
		$ew = $this->i->readUInt16();
		$sc = $this->readRGBA($this->i);
		$ec = $this->readRGBA($this->i);
		return _hx_anonymous(array("startWidth" => $sw, "endWidth" => $ew, "startColor" => $sc, "endColor" => $ec));
	}
	public function readMorphFillStyles($ver) {
		$len = $this->i->readByte();
		if($len === 255) {
			$len = $this->i->readUInt16();
		}
		$fill_styles = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $len) {
				$i = $_g++;
				$fill_styles->push($this->readMorphFillStyle($ver));
				unset($i);
			}
		}
		return $fill_styles;
	}
	public function readMorphFillStyle($ver) {
		$type = $this->i->readByte();
		return format_swf_Reader_14($this, $type, $ver);
	}
	public function readMorphGradients($ver) {
		$num = $this->i->readByte();
		if($num < 1 || $num > 8) {
			throw new HException("Invalid number of morph gradients (" . _hx_string_rec($num, "") . "). Should be in range 1..8!");
		}
		$grads = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $num) {
				$i = $_g++;
				$grads->push($this->readMorphGradient($ver));
				unset($i);
			}
		}
		return $grads;
	}
	public function readMorphGradient($ver) {
		$sr = $this->i->readByte();
		$sc = $this->readRGBA($this->i);
		$er = $this->i->readByte();
		$ec = $this->readRGBA($this->i);
		return _hx_anonymous(array("startRatio" => $sr, "startColor" => $sc, "endRatio" => $er, "endColor" => $ec));
	}
	public function readShape($len, $ver) {
		$id = $this->i->readUInt16();
		if($ver <= 3) {
			$bounds = $this->readRect();
			$sws = $this->readShapeWithStyle($ver);
			return format_swf_SWFTag::TShape($id, format_swf_Reader_15($this, $bounds, $id, $len, $sws, $ver));
		}
		$shapeBounds = $this->readRect();
		$edgeBounds = $this->readRect();
		$this->bits->readBits(5);
		$useWinding = $this->bits->readBit();
		$useNonScalingStroke = $this->bits->readBit();
		$useScalingStroke = $this->bits->readBit();
		$shapes = $this->readShapeWithStyle($ver);
		return format_swf_SWFTag::TShape($id, format_swf_ShapeData::SHDShape4(_hx_anonymous(array("shapeBounds" => $shapeBounds, "edgeBounds" => $edgeBounds, "useWinding" => $useWinding, "useNonScalingStroke" => $useNonScalingStroke, "useScalingStroke" => $useScalingStroke, "shapes" => $shapes))));
	}
	public function readFilters() {
		$filters = new _hx_array(array());
		{
			$_g1 = 0; $_g = $this->i->readByte();
			while($_g1 < $_g) {
				$i = $_g1++;
				$filters->push($this->readFilter());
				unset($i);
			}
		}
		return $filters;
	}
	public function readFilter() {
		$n = $this->i->readByte();
		return format_swf_Reader_16($this, $n);
	}
	public function readFilterGradient() {
		$ncolors = $this->i->readByte();
		$colors = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $ncolors) {
				$i = $_g++;
				$colors->push(_hx_anonymous(array("color" => $this->readRGBA(null), "position" => 0)));
				unset($i);
			}
		}
		{
			$_g = 0;
			while($_g < $colors->length) {
				$c = $colors[$_g];
				++$_g;
				$c->position = $this->i->readByte();
				unset($c);
			}
		}
		$data = _hx_anonymous(array("color" => null, "color2" => null, "blurX" => $this->i->readInt32(), "blurY" => $this->i->readInt32(), "angle" => $this->i->readInt32(), "distance" => $this->i->readInt32(), "strength" => format_swf_Reader_17($this, $colors, $ncolors), "flags" => $this->readFilterFlags(true)));
		return _hx_anonymous(array("colors" => $colors, "data" => $data));
	}
	public function readFilterFlags($top) {
		$flags = $this->i->readByte();
		return _hx_anonymous(array("inner" => ($flags & 128) !== 0, "knockout" => ($flags & 64) !== 0, "ontop" => format_swf_Reader_18($this, $flags, $top), "passes" => $flags & ((($top) ? 15 : 31))));
	}
	public function readClipEvents() {
		if($this->i->readUInt16() !== 0) {
			throw new HException($this->error("invalid clip events"));
		}
		$this->i->readInt32();
		$a = new _hx_array(array());
		while(true) {
			$code = $this->i->readInt32();
			if($code === 0) {
				break;
			}
			$data = $this->i->read($this->i->readInt32());
			$a->push(_hx_anonymous(array("eventsFlags" => $code, "data" => $data)));
			unset($data,$code);
		}
		return $a;
	}
	public function readShapeRecords($ver) {
		$this->bits->nbits = 0;
		$fillBits = $this->bits->readBits(4);
		$lineBits = $this->bits->readBits(4);
		$recs = new _hx_array(array());
		do {
			if($this->bits->readBit()) {
				if($this->bits->readBit()) {
					$nbits = $this->bits->readBits(4) + 2;
					$isGeneral = $this->bits->readBit();
					$isVertical = ((!$isGeneral) ? $this->bits->readBit() : false);
					$dx = (($isGeneral || !$isVertical) ? format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits) : 0);
					$dy = (($isGeneral || $isVertical) ? format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits) : 0);
					$recs->push(format_swf_ShapeRecord::SHREdge($dx, $dy));
					unset($nbits,$isVertical,$isGeneral,$dy,$dx);
				} else {
					$nbits = $this->bits->readBits(4) + 2;
					$cdx = format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits);
					$cdy = format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits);
					$adx = format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits);
					$ady = format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits);
					$recs->push(format_swf_ShapeRecord::SHRCurvedEdge($cdx, $cdy, $adx, $ady));
					unset($nbits,$cdy,$cdx,$ady,$adx);
				}
			} else {
				$flags = $this->bits->readBits(5);
				if($flags === 0) {
					$recs->push(format_swf_ShapeRecord::$SHREnd);
					break;
				} else {
					$cdata = _hx_anonymous(array("moveTo" => null, "fillStyle0" => null, "fillStyle1" => null, "lineStyle" => null, "newStyles" => null));
					if(($flags & 1) !== 0) {
						$mbits = $this->bits->readBits(5);
						$dx = format_swf_Tools::signExtend($this->bits->readBits($mbits), $mbits);
						$dy = format_swf_Tools::signExtend($this->bits->readBits($mbits), $mbits);
						$cdata->moveTo = _hx_anonymous(array("dx" => $dx, "dy" => $dy));
						unset($mbits,$dy,$dx);
					}
					if(($flags & 2) !== 0) {
						$cdata->fillStyle0 = _hx_anonymous(array("idx" => $this->bits->readBits($fillBits)));
					}
					if(($flags & 4) !== 0) {
						$cdata->fillStyle1 = _hx_anonymous(array("idx" => $this->bits->readBits($fillBits)));
					}
					if(($flags & 8) !== 0) {
						$cdata->lineStyle = _hx_anonymous(array("idx" => $this->bits->readBits($lineBits)));
					}
					if(($flags & 16) !== 0) {
						$fst = $this->readFillStyles($ver);
						$lst = $this->readLineStyles($ver);
						$this->bits->nbits = 0;
						$fillBits = $this->bits->readBits(4);
						$lineBits = $this->bits->readBits(4);
						$cdata->newStyles = _hx_anonymous(array("fillStyles" => $fst, "lineStyles" => $lst));
						unset($lst,$fst);
					}
					$recs->push(format_swf_ShapeRecord::SHRChange($cdata));
					unset($cdata);
				}
				unset($flags);
			}
		} while(true);
		return $recs;
	}
	public function readShapeWithoutStyle($ver) {
		return _hx_anonymous(array("shapeRecords" => $this->readShapeRecords($ver)));
	}
	public function readShapeWithStyle($ver) {
		$fillStyles = $this->readFillStyles($ver);
		$lineStyles = $this->readLineStyles($ver);
		return _hx_anonymous(array("fillStyles" => $fillStyles, "lineStyles" => $lineStyles, "shapeRecords" => $this->readShapeRecords($ver)));
	}
	public function readFillStyles($ver) {
		$cnt = $this->i->readByte();
		if($cnt === 255 && $ver > 1) {
			$cnt = $this->i->readUInt16();
		}
		$arr = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $cnt) {
				$c = $_g++;
				$fillStyle = $this->readFillStyle($ver);
				$arr->push($fillStyle);
				unset($fillStyle,$c);
			}
		}
		return $arr;
	}
	public function readFillStyle($ver) {
		$type = $this->i->readByte();
		return format_swf_Reader_19($this, $type, $ver);
	}
	public function readLineStyles($ver) {
		$cnt = $this->i->readByte();
		if($cnt === 255) {
			if($ver === 1) {
				throw new HException($this->error("invalid line count in line styles array"));
			}
			$cnt = $this->i->readUInt16();
		}
		$arr = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $cnt) {
				$c = $_g++;
				$width = $this->i->readUInt16();
				$arr->push(_hx_anonymous(array("width" => $width, "data" => format_swf_Reader_20($this, $_g, $arr, $c, $cnt, $ver, $width))));
				unset($width,$c);
			}
		}
		return $arr;
	}
	public function getLineCap($t) {
		return format_swf_Reader_21($this, $t);
	}
	public function readGradient($ver) {
		$this->bits->nbits = 0;
		$spread = format_swf_Reader_22($this, $ver);
		$interp = format_swf_Reader_23($this, $spread, $ver);
		$nGrad = $this->bits->readBits(4);
		$arr = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $nGrad) {
				$c = $_g++;
				$pos = $this->i->readByte();
				if($ver <= 2) {
					$arr->push(format_swf_GradRecord::GRRGB($pos, $this->readRGB(null)));
				} else {
					$arr->push(format_swf_GradRecord::GRRGBA($pos, $this->readRGBA(null)));
				}
				unset($pos,$c);
			}
		}
		return _hx_anonymous(array("spread" => $spread, "interpolate" => $interp, "data" => $arr));
	}
	public function readCXA() {
		$this->bits->nbits = 0;
		$add = $this->bits->readBit();
		$mult = $this->bits->readBit();
		$nbits = $this->bits->readBits(4);
		return _hx_anonymous(array("nbits" => $nbits, "mult" => (($mult) ? $this->readCXAColor($nbits) : null), "add" => (($add) ? $this->readCXAColor($nbits) : null)));
	}
	public function readCXAColor($nbits) {
		return _hx_anonymous(array("r" => $this->bits->readBits($nbits), "g" => $this->bits->readBits($nbits), "b" => $this->bits->readBits($nbits), "a" => $this->bits->readBits($nbits)));
	}
	public function readRGB($i = null) {
		if($i === null) {
			$i = $this->i;
		}
		return _hx_anonymous(array("r" => $i->readByte(), "g" => $i->readByte(), "b" => $i->readByte()));
	}
	public function readRGBA($i = null) {
		if($i === null) {
			$i = $this->i;
		}
		return _hx_anonymous(array("r" => $i->readByte(), "g" => $i->readByte(), "b" => $i->readByte(), "a" => $i->readByte()));
	}
	public function readMatrix() {
		$this->bits->nbits = 0;
		$scale = null;
		if($this->bits->readBit()) {
			$nbits = $this->bits->readBits(5);
			$_x = format_swf_Reader_24($this, $nbits, $scale);
			$_y = format_swf_Reader_25($this, $_x, $nbits, $scale);
			$scale = _hx_anonymous(array("x" => $_x, "y" => $_y));
		}
		$rotate = null;
		if($this->bits->readBit()) {
			$nbits = $this->bits->readBits(5);
			$_rs0 = format_swf_Reader_26($this, $nbits, $rotate, $scale);
			$_rs1 = format_swf_Reader_27($this, $_rs0, $nbits, $rotate, $scale);
			$rotate = _hx_anonymous(array("rs0" => $_rs0, "rs1" => $_rs1));
		}
		$nbits = $this->bits->readBits(5);
		$translate = _hx_anonymous(array("x" => format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits), "y" => format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits)));
		return _hx_anonymous(array("scale" => $scale, "rotate" => $rotate, "translate" => $translate));
	}
	public function readMatrixPart() {
		$nbits = $this->bits->readBits(5);
		return _hx_anonymous(array("nbits" => $nbits, "x" => $this->bits->readBits($nbits), "y" => $this->bits->readBits($nbits)));
	}
	public function readRect() {
		$this->bits->nbits = 0;
		$nbits = $this->bits->readBits(5);
		$left = format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits);
		$right = format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits);
		$top = format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits);
		$bottom = format_swf_Tools::signExtend($this->bits->readBits($nbits), $nbits);
		return _hx_anonymous(array("left" => $left, "right" => $right, "top" => $top, "bottom" => $bottom));
	}
	public function readUTF8Bytes() {
		$b = new haxe_io_BytesBuffer();
		while(true) {
			$c = $this->i->readByte();
			if($c === 0) {
				break;
			}
			$b->b .= _hx_string_or_null(chr($c));
			unset($c);
		}
		return $b->getBytes();
	}
	public function readFixed() {
		return $this->i->readInt32();
	}
	public function readFixed8($i = null) {
		if($i === null) {
			$i = $this->i;
		}
		return $i->readUInt16();
	}
	public $bitsRead;
	public $version;
	public $bits;
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
	function __toString() { return 'format.swf.Reader'; }
}
function format_swf_Reader_0(&$__hx__this, &$ext, &$h, &$id, &$len, &$light, &$tlen) {
	switch($id) {
	case 0:{
		return null;
	}break;
	default:{
		$output = new haxe_io_BytesOutput();
		$output->set_bigEndian(false);
		$output->writeUInt16($h);
		if($tlen === 63) {
			$output->writeInt32($len);
		}
		$output->write($__hx__this->i->read($len));
		return format_swf_SWFTag::TUnknown(null, $output->getBytes());
	}break;
	}
}
function format_swf_Reader_1(&$__hx__this, &$ext, &$h, &$id, &$len, &$light, &$tlen) {
	switch($id) {
	case 1:{
		return format_swf_SWFTag::$TShowFrame;
	}break;
	case 2:{
		return $__hx__this->readShape($len, 1);
	}break;
	case 22:{
		return $__hx__this->readShape($len, 2);
	}break;
	case 32:{
		return $__hx__this->readShape($len, 3);
	}break;
	case 83:{
		return $__hx__this->readShape($len, 4);
	}break;
	case 46:{
		return $__hx__this->readMorphShape(1);
	}break;
	case 84:{
		return $__hx__this->readMorphShape(2);
	}break;
	case 10:{
		return $__hx__this->readFont($len, 1);
	}break;
	case 48:{
		return $__hx__this->readFont($len, 2);
	}break;
	case 75:{
		return $__hx__this->readFont($len, 3);
	}break;
	case 13:{
		return $__hx__this->readFontInfo($len, 1);
	}break;
	case 62:{
		return $__hx__this->readFontInfo($len, 2);
	}break;
	case 9:{
		$__hx__this->i->set_bigEndian(true);
		$color = $__hx__this->i->readUInt24();
		$__hx__this->i->set_bigEndian(false);
		return format_swf_SWFTag::TBackgroundColor($color);
	}break;
	case 20:{
		return format_swf_SWFTag::TBitsLossless($__hx__this->readLossless($len, false));
	}break;
	case 36:{
		return format_swf_SWFTag::TBitsLossless2($__hx__this->readLossless($len, true));
	}break;
	case 8:{
		return format_swf_SWFTag::TJPEGTables($__hx__this->i->read($len));
	}break;
	case 6:{
		$cid = $__hx__this->i->readUInt16();
		return format_swf_SWFTag::TBitsJPEG($cid, format_swf_JPEGData::JDJPEG1($__hx__this->i->read($len - 2)));
	}break;
	case 21:{
		$cid = $__hx__this->i->readUInt16();
		return format_swf_SWFTag::TBitsJPEG($cid, format_swf_JPEGData::JDJPEG2($__hx__this->i->read($len - 2)));
	}break;
	case 35:{
		$cid = $__hx__this->i->readUInt16();
		$dataSize = $__hx__this->i->readInt32();
		$data = $__hx__this->i->read($dataSize);
		$mask = $__hx__this->i->read($len - $dataSize - 6);
		return format_swf_SWFTag::TBitsJPEG($cid, format_swf_JPEGData::JDJPEG3($data, $mask));
	}break;
	case 26:{
		return format_swf_SWFTag::TPlaceObject2($__hx__this->readPlaceObject(false));
	}break;
	case 70:{
		return format_swf_SWFTag::TPlaceObject3($__hx__this->readPlaceObject(true));
	}break;
	case 28:{
		return format_swf_SWFTag::TRemoveObject2($__hx__this->i->readUInt16());
	}break;
	case 39:{
		$cid = $__hx__this->i->readUInt16();
		$fcount = $__hx__this->i->readUInt16();
		$tags = $__hx__this->readTagList(null);
		return format_swf_SWFTag::TClip($cid, $fcount, $tags);
	}break;
	case 43:{
		$label = $__hx__this->readUTF8Bytes();
		$anchor = format_swf_Reader_28($__hx__this, $ext, $h, $id, $label, $len, $light, $tlen);
		return format_swf_SWFTag::TFrameLabel($label->toString(), $anchor);
	}break;
	case 59:{
		$cid = $__hx__this->i->readUInt16();
		return format_swf_SWFTag::TDoInitActions($cid, $__hx__this->i->read($len - 2));
	}break;
	case 69:{
		return format_swf_SWFTag::TSandBox($__hx__this->readFileAttributes());
	}break;
	case 72:{
		return format_swf_SWFTag::TActionScript3($__hx__this->i->read($len), null);
	}break;
	case 76:{
		return format_swf_SWFTag::TSymbolClass($__hx__this->readSymbols());
	}break;
	case 71:{
		$url = $__hx__this->i->readUntil(0);
		return format_swf_SWFTag::TImportAssets($url);
	}break;
	case 56:{
		return format_swf_SWFTag::TExportAssets($__hx__this->readSymbols());
	}break;
	case 82:{
		$infos = _hx_anonymous(array("id" => $__hx__this->i->readInt32(), "label" => $__hx__this->i->readUntil(0)));
		$len -= 4 + strlen($infos->label) + 1;
		return format_swf_SWFTag::TActionScript3($__hx__this->i->read($len), $infos);
	}break;
	case 87:{
		$id1 = $__hx__this->i->readUInt16();
		if($__hx__this->i->readInt32() !== 0) {
			throw new HException($__hx__this->error("invalid binary data tag"));
		}
		return format_swf_SWFTag::TBinaryData($id1, $__hx__this->i->read($len - 6));
	}break;
	case 14:{
		return $__hx__this->readSound($len);
	}break;
	case 12:{
		return format_swf_SWFTag::TDoAction($__hx__this->i->read($len));
	}break;
	case 65:{
		$maxRecursion = $__hx__this->i->readUInt16();
		$timeoutSeconds = $__hx__this->i->readUInt16();
		return format_swf_SWFTag::TScriptLimits($maxRecursion, $timeoutSeconds);
	}break;
	case 15:{
		$id1 = $__hx__this->i->readUInt16();
		return format_swf_SWFTag::TStartSound($id1, $__hx__this->readSoundInfo());
	}break;
	case 34:{
		$data = $__hx__this->i->read($len);
		return format_swf_SWFTag::TUnknown($id, $data);
	}break;
	case 37:{
		$data = $__hx__this->i->read($len);
		return format_swf_SWFTag::TUnknown($id, $data);
	}break;
	case 77:{
		$data = $__hx__this->i->readString($len);
		return format_swf_SWFTag::TMetadata($data);
	}break;
	case 78:{
		$id1 = $__hx__this->i->readUInt16();
		$splitter = $__hx__this->readRect();
		return format_swf_SWFTag::TDefineScalingGrid($id1, $splitter);
	}break;
	case 0:{
		return null;
	}break;
	default:{
		$data = $__hx__this->i->read($len);
		return format_swf_SWFTag::TUnknown($id, $data);
	}break;
	}
}
function format_swf_Reader_2(&$__hx__this, &$cid, &$code_table, &$fi_data, &$hasWideCodes, &$isANSI, &$isBold, &$isItalic, &$isSmall, &$language, &$len, &$name, &$num_glyphs, &$shiftJIS, &$ver) {
	switch($ver) {
	case 1:{
		return format_swf_FontInfoData::FIDFont1($shiftJIS, $isANSI, $hasWideCodes, $fi_data);
	}break;
	case 2:{
		return format_swf_FontInfoData::FIDFont2($language, $fi_data);
	}break;
	}
}
function format_swf_Reader_3(&$__hx__this, &$cid, &$len, &$ver) {
	switch($ver) {
	case 1:{
		return $__hx__this->readFont1Data($len);
	}break;
	case 2:{
		return $__hx__this->readFont2Data($ver);
	}break;
	case 3:{
		return $__hx__this->readFont2Data($ver);
	}break;
	}
}
function format_swf_Reader_4(&$__hx__this, &$f2data, &$glyphs, &$hasLayout, &$hasWideCodes, &$hasWideOffsets, &$isANSI, &$isBold, &$isItalic, &$isSmall, &$language, &$layout, &$name, &$num_glyphs, &$offset_table, &$shiftJIS, &$ver) {
	switch($ver) {
	case 2:{
		return format_swf_FontData::FDFont2($hasWideCodes, $f2data);
	}break;
	case 3:{
		return format_swf_FontData::FDFont3($f2data);
	}break;
	}
}
function format_swf_Reader_5(&$__hx__this) {
	switch($__hx__this->i->readByte()) {
	case 0:{
		return format_swf_LangCode::$LCNone;
	}break;
	case 1:{
		return format_swf_LangCode::$LCLatin;
	}break;
	case 2:{
		return format_swf_LangCode::$LCJapanese;
	}break;
	case 3:{
		return format_swf_LangCode::$LCKorean;
	}break;
	case 4:{
		return format_swf_LangCode::$LCSimplifiedChinese;
	}break;
	case 5:{
		return format_swf_LangCode::$LCTraditionalChinese;
	}break;
	default:{
		throw new HException("Unknown language code!");
	}break;
	}
}
function format_swf_Reader_6(&$__hx__this, &$len, &$sid) {
	switch($__hx__this->bits->readBits(4)) {
	case 0:{
		return format_swf_SoundFormat::$SFNativeEndianUncompressed;
	}break;
	case 1:{
		return format_swf_SoundFormat::$SFADPCM;
	}break;
	case 2:{
		return format_swf_SoundFormat::$SFMP3;
	}break;
	case 3:{
		return format_swf_SoundFormat::$SFLittleEndianUncompressed;
	}break;
	case 4:{
		return format_swf_SoundFormat::$SFNellymoser16k;
	}break;
	case 5:{
		return format_swf_SoundFormat::$SFNellymoser8k;
	}break;
	case 6:{
		return format_swf_SoundFormat::$SFNellymoser;
	}break;
	case 11:{
		return format_swf_SoundFormat::$SFSpeex;
	}break;
	default:{
		throw new HException($__hx__this->error("invalid sound format"));
	}break;
	}
}
function format_swf_Reader_7(&$__hx__this, &$len, &$sid, &$soundFormat) {
	switch($__hx__this->bits->readBits(2)) {
	case 0:{
		return format_swf_SoundRate::$SR5k;
	}break;
	case 1:{
		return format_swf_SoundRate::$SR11k;
	}break;
	case 2:{
		return format_swf_SoundRate::$SR22k;
	}break;
	case 3:{
		return format_swf_SoundRate::$SR44k;
	}break;
	default:{
		throw new HException($__hx__this->error("invalid sound rate"));
	}break;
	}
}
function format_swf_Reader_8(&$__hx__this, &$is16bit, &$isStereo, &$len, &$sid, &$soundFormat, &$soundRate, &$soundSamples) {
	$__hx__t = ($soundFormat);
	switch($__hx__t->index) {
	case 2:
	{
		$seek = $__hx__this->i->readInt16();
		return format_swf_SoundData::SDMp3($seek, $__hx__this->i->read($len - 9));
	}break;
	case 3:
	{
		return format_swf_SoundData::SDRaw($__hx__this->i->read($len - 7));
	}break;
	default:{
		return format_swf_SoundData::SDOther($__hx__this->i->read($len - 7));
	}break;
	}
}
function format_swf_Reader_9(&$__hx__this, &$bits, &$cid, &$len, &$v2) {
	switch($bits) {
	case 3:{
		return format_swf_ColorModel::CM8Bits($__hx__this->i->readByte());
	}break;
	case 4:{
		return format_swf_ColorModel::$CM15Bits;
	}break;
	case 5:{
		if($v2) {
			return format_swf_ColorModel::$CM32Bits;
		} else {
			return format_swf_ColorModel::$CM24Bits;
		}
	}break;
	default:{
		throw new HException($__hx__this->error("invalid lossless bits"));
	}break;
	}
}
function format_swf_Reader_10(&$__hx__this) {
	switch($__hx__this->i->readByte()) {
	case 0:case 1:{
		return format_swf_BlendMode::$BNormal;
	}break;
	case 2:{
		return format_swf_BlendMode::$BLayer;
	}break;
	case 3:{
		return format_swf_BlendMode::$BMultiply;
	}break;
	case 4:{
		return format_swf_BlendMode::$BScreen;
	}break;
	case 5:{
		return format_swf_BlendMode::$BLighten;
	}break;
	case 6:{
		return format_swf_BlendMode::$BDarken;
	}break;
	case 7:{
		return format_swf_BlendMode::$BDifference;
	}break;
	case 8:{
		return format_swf_BlendMode::$BAdd;
	}break;
	case 9:{
		return format_swf_BlendMode::$BSubtract;
	}break;
	case 10:{
		return format_swf_BlendMode::$BInvert;
	}break;
	case 11:{
		return format_swf_BlendMode::$BAlpha;
	}break;
	case 12:{
		return format_swf_BlendMode::$BErase;
	}break;
	case 13:{
		return format_swf_BlendMode::$BOverlay;
	}break;
	case 14:{
		return format_swf_BlendMode::$BHardLight;
	}break;
	default:{
		throw new HException($__hx__this->error("invalid blend mode"));
	}break;
	}
}
function format_swf_Reader_11(&$__hx__this, &$endCapStyle, &$endWidth, &$hasFill, &$joinStyle, &$noClose, &$noHScale, &$noVScale, &$pixelHinting, &$startCapStyle, &$startWidth) {
	switch($startCapStyle) {
	case 0:{
		return format_swf_LineCapStyle::$LCRound;
	}break;
	case 1:{
		return format_swf_LineCapStyle::$LCNone;
	}break;
	case 2:{
		return format_swf_LineCapStyle::$LCSquare;
	}break;
	}
}
function format_swf_Reader_12(&$__hx__this, &$endCapStyle, &$endWidth, &$hasFill, &$joinStyle, &$noClose, &$noHScale, &$noVScale, &$pixelHinting, &$startCapStyle, &$startWidth) {
	switch($joinStyle) {
	case 0:{
		return format_swf_LineJoinStyle::$LJRound;
	}break;
	case 1:{
		return format_swf_LineJoinStyle::$LJBevel;
	}break;
	case 2:{
		return format_swf_LineJoinStyle::LJMiter(format_swf_Reader_29($__hx__this, $endCapStyle, $endWidth, $hasFill, $joinStyle, $noClose, $noHScale, $noVScale, $pixelHinting, $startCapStyle, $startWidth));
	}break;
	}
}
function format_swf_Reader_13(&$__hx__this, &$endCapStyle, &$endWidth, &$hasFill, &$joinStyle, &$noClose, &$noHScale, &$noVScale, &$pixelHinting, &$startCapStyle, &$startWidth) {
	switch($endCapStyle) {
	case 0:{
		return format_swf_LineCapStyle::$LCRound;
	}break;
	case 1:{
		return format_swf_LineCapStyle::$LCNone;
	}break;
	case 2:{
		return format_swf_LineCapStyle::$LCSquare;
	}break;
	}
}
function format_swf_Reader_14(&$__hx__this, &$type, &$ver) {
	switch($type) {
	case 0:{
		$startColor = $__hx__this->readRGBA($__hx__this->i);
		$endColor = $__hx__this->readRGBA($__hx__this->i);
		return format_swf_MorphFillStyle::MFSSolid($startColor, $endColor);
	}break;
	case 16:case 18:case 19:{
		$startMatrix = $__hx__this->readMatrix();
		$endMatrix = $__hx__this->readMatrix();
		$grads = $__hx__this->readMorphGradients($ver);
		switch($type) {
		case 16:{
			return format_swf_MorphFillStyle::MFSLinearGradient($startMatrix, $endMatrix, $grads);
		}break;
		case 18:{
			return format_swf_MorphFillStyle::MFSRadialGradient($startMatrix, $endMatrix, $grads);
		}break;
		default:{
			throw new HException($__hx__this->error("invalid filltype in morphshape"));
		}break;
		}
		unset($startMatrix,$grads,$endMatrix);
	}break;
	case 64:case 65:case 66:case 67:{
		$cid = $__hx__this->i->readUInt16();
		$startMatrix = $__hx__this->readMatrix();
		$endMatrix = $__hx__this->readMatrix();
		$isRepeat = $type === 64 || $type === 66;
		$isSmooth = $type === 64 || $type === 65;
		return format_swf_MorphFillStyle::MFSBitmap($cid, $startMatrix, $endMatrix, $isRepeat, $isSmooth);
	}break;
	default:{
		throw new HException(_hx_string_or_null($__hx__this->error(null)) . " code " . _hx_string_rec($type, ""));
	}break;
	}
}
function format_swf_Reader_15(&$__hx__this, &$bounds, &$id, &$len, &$sws, &$ver) {
	switch($ver) {
	case 1:{
		return format_swf_ShapeData::SHDShape1($bounds, $sws);
	}break;
	case 2:{
		return format_swf_ShapeData::SHDShape2($bounds, $sws);
	}break;
	case 3:{
		return format_swf_ShapeData::SHDShape3($bounds, $sws);
	}break;
	default:{
		throw new HException($__hx__this->error("invalid shape type"));
	}break;
	}
}
function format_swf_Reader_16(&$__hx__this, &$n) {
	switch($n) {
	case 0:{
		return format_swf_Filter::FDropShadow(_hx_anonymous(array("color" => $__hx__this->readRGBA(null), "color2" => null, "blurX" => $__hx__this->i->readInt32(), "blurY" => $__hx__this->i->readInt32(), "angle" => $__hx__this->i->readInt32(), "distance" => $__hx__this->i->readInt32(), "strength" => format_swf_Reader_30($__hx__this, $n), "flags" => $__hx__this->readFilterFlags(false))));
	}break;
	case 1:{
		return format_swf_Filter::FBlur(_hx_anonymous(array("blurX" => $__hx__this->i->readInt32(), "blurY" => $__hx__this->i->readInt32(), "passes" => $__hx__this->i->readByte() >> 3)));
	}break;
	case 2:{
		return format_swf_Filter::FGlow(_hx_anonymous(array("color" => $__hx__this->readRGBA(null), "color2" => null, "blurX" => $__hx__this->i->readInt32(), "blurY" => $__hx__this->i->readInt32(), "angle" => 0, "distance" => 0, "strength" => format_swf_Reader_31($__hx__this, $n), "flags" => $__hx__this->readFilterFlags(false))));
	}break;
	case 3:{
		return format_swf_Filter::FBevel(_hx_anonymous(array("color" => $__hx__this->readRGBA(null), "color2" => $__hx__this->readRGBA(null), "blurX" => $__hx__this->i->readInt32(), "blurY" => $__hx__this->i->readInt32(), "angle" => $__hx__this->i->readInt32(), "distance" => $__hx__this->i->readInt32(), "strength" => format_swf_Reader_32($__hx__this, $n), "flags" => $__hx__this->readFilterFlags(true))));
	}break;
	case 4:{
		return format_swf_Filter::FGradientGlow($__hx__this->readFilterGradient());
	}break;
	case 5:{
		throw new HException($__hx__this->error("convolution filter not supported"));
	}break;
	case 6:{
		$a = new _hx_array(array());
		{
			$_g = 0;
			while($_g < 20) {
				$n1 = $_g++;
				$a->push($__hx__this->i->readFloat());
				unset($n1);
			}
		}
		return format_swf_Filter::FColorMatrix($a);
	}break;
	case 7:{
		return format_swf_Filter::FGradientBevel($__hx__this->readFilterGradient());
	}break;
	default:{
		throw new HException($__hx__this->error("unknown filter"));
		return null;
	}break;
	}
}
function format_swf_Reader_17(&$__hx__this, &$colors, &$ncolors) {
	{
		$i = null;
		if($i === null) {
			$i = $__hx__this->i;
		}
		return $i->readUInt16();
	}
}
function format_swf_Reader_18(&$__hx__this, &$flags, &$top) {
	if($top) {
		return ($flags & 16) !== 0;
	} else {
		return false;
	}
}
function format_swf_Reader_19(&$__hx__this, &$type, &$ver) {
	switch($type) {
	case 0:{
		if($ver <= 2) {
			return format_swf_FillStyle::FSSolid($__hx__this->readRGB($__hx__this->i));
		} else {
			return format_swf_FillStyle::FSSolidAlpha($__hx__this->readRGBA($__hx__this->i));
		}
	}break;
	case 16:case 18:case 19:{
		$mat = $__hx__this->readMatrix();
		$grad = $__hx__this->readGradient($ver);
		switch($type) {
		case 19:{
			return format_swf_FillStyle::FSFocalGradient($mat, _hx_anonymous(array("focalPoint" => format_swf_Reader_33($__hx__this, $grad, $mat, $type, $ver), "data" => $grad)));
		}break;
		case 16:{
			return format_swf_FillStyle::FSLinearGradient($mat, $grad);
		}break;
		case 18:{
			return format_swf_FillStyle::FSRadialGradient($mat, $grad);
		}break;
		default:{
			throw new HException($__hx__this->error("invalid fill style type"));
		}break;
		}
		unset($mat,$grad);
	}break;
	case 64:case 65:case 66:case 67:{
		$cid = $__hx__this->i->readUInt16();
		$mat = $__hx__this->readMatrix();
		$isRepeat = $type === 64 || $type === 66;
		$isSmooth = $type === 64 || $type === 65;
		return format_swf_FillStyle::FSBitmap($cid, $mat, $isRepeat, $isSmooth);
	}break;
	default:{
		throw new HException(_hx_string_or_null($__hx__this->error(null)) . " code " . _hx_string_rec($type, ""));
	}break;
	}
}
function format_swf_Reader_20(&$__hx__this, &$_g, &$arr, &$c, &$cnt, &$ver, &$width) {
	if($ver <= 2) {
		return format_swf_LineStyleData::LSRGB($__hx__this->readRGB($__hx__this->i));
	} else {
		if($ver === 3) {
			return format_swf_LineStyleData::LSRGBA($__hx__this->readRGBA($__hx__this->i));
		} else {
			if($ver === 4) {
				$__hx__this->bits->nbits = 0;
				$startCap = $__hx__this->getLineCap($__hx__this->bits->readBits(2));
				$_join = $__hx__this->bits->readBits(2);
				$_fill = $__hx__this->bits->readBit();
				$noHScale = $__hx__this->bits->readBit();
				$noVScale = $__hx__this->bits->readBit();
				$pixelHinting = $__hx__this->bits->readBit();
				if($__hx__this->bits->readBits(5) !== 0) {
					throw new HException($__hx__this->error("invalid nbits in line style"));
				}
				$noClose = $__hx__this->bits->readBit();
				$endCap = $__hx__this->getLineCap($__hx__this->bits->readBits(2));
				$join = format_swf_Reader_34($__hx__this, $_fill, $_g, $_join, $arr, $c, $cnt, $endCap, $noClose, $noHScale, $noVScale, $pixelHinting, $startCap, $ver, $width);
				$fill = format_swf_Reader_35($__hx__this, $_fill, $_g, $_join, $arr, $c, $cnt, $endCap, $join, $noClose, $noHScale, $noVScale, $pixelHinting, $startCap, $ver, $width);
				return format_swf_LineStyleData::LS2(_hx_anonymous(array("startCap" => $startCap, "join" => $join, "fill" => $fill, "noHScale" => $noHScale, "noVScale" => $noVScale, "pixelHinting" => $pixelHinting, "noClose" => $noClose, "endCap" => $endCap)));
			} else {
				throw new HException($__hx__this->error("invalid line style version"));
			}
		}
	}
}
function format_swf_Reader_21(&$__hx__this, &$t) {
	switch($t) {
	case 0:{
		return format_swf_LineCapStyle::$LCRound;
	}break;
	case 1:{
		return format_swf_LineCapStyle::$LCNone;
	}break;
	case 2:{
		return format_swf_LineCapStyle::$LCSquare;
	}break;
	default:{
		throw new HException($__hx__this->error("invalid lineCap"));
	}break;
	}
}
function format_swf_Reader_22(&$__hx__this, &$ver) {
	switch($__hx__this->bits->readBits(2)) {
	case 0:{
		return format_swf_SpreadMode::$SMPad;
	}break;
	case 1:{
		return format_swf_SpreadMode::$SMReflect;
	}break;
	case 2:{
		return format_swf_SpreadMode::$SMRepeat;
	}break;
	case 3:{
		return format_swf_SpreadMode::$SMReserved;
	}break;
	}
}
function format_swf_Reader_23(&$__hx__this, &$spread, &$ver) {
	switch($__hx__this->bits->readBits(2)) {
	case 0:{
		return format_swf_InterpolationMode::$IMNormalRGB;
	}break;
	case 1:{
		return format_swf_InterpolationMode::$IMLinearRGB;
	}break;
	case 2:{
		return format_swf_InterpolationMode::$IMReserved1;
	}break;
	case 3:{
		return format_swf_InterpolationMode::$IMReserved2;
	}break;
	}
}
function format_swf_Reader_24(&$__hx__this, &$nbits, &$scale) {
	{
		$i = $__hx__this->bits->readBits($nbits);
		$i = format_swf_Tools::signExtend($i, $nbits);
		return ($i >> 16) + ($i & 65535) / 65536.0;
	}
}
function format_swf_Reader_25(&$__hx__this, &$_x, &$nbits, &$scale) {
	{
		$i = $__hx__this->bits->readBits($nbits);
		$i = format_swf_Tools::signExtend($i, $nbits);
		return ($i >> 16) + ($i & 65535) / 65536.0;
	}
}
function format_swf_Reader_26(&$__hx__this, &$nbits, &$rotate, &$scale) {
	{
		$i = $__hx__this->bits->readBits($nbits);
		$i = format_swf_Tools::signExtend($i, $nbits);
		return ($i >> 16) + ($i & 65535) / 65536.0;
	}
}
function format_swf_Reader_27(&$__hx__this, &$_rs0, &$nbits, &$rotate, &$scale) {
	{
		$i = $__hx__this->bits->readBits($nbits);
		$i = format_swf_Tools::signExtend($i, $nbits);
		return ($i >> 16) + ($i & 65535) / 65536.0;
	}
}
function format_swf_Reader_28(&$__hx__this, &$ext, &$h, &$id, &$label, &$len, &$light, &$tlen) {
	if($len === $label->length + 2) {
		return $__hx__this->i->readByte() === 1;
	} else {
		return false;
	}
}
function format_swf_Reader_29(&$__hx__this, &$endCapStyle, &$endWidth, &$hasFill, &$joinStyle, &$noClose, &$noHScale, &$noVScale, &$pixelHinting, &$startCapStyle, &$startWidth) {
	{
		$i = $__hx__this->i;
		if($i === null) {
			$i = $__hx__this->i;
		}
		return $i->readUInt16();
	}
}
function format_swf_Reader_30(&$__hx__this, &$n) {
	{
		$i = null;
		if($i === null) {
			$i = $__hx__this->i;
		}
		return $i->readUInt16();
	}
}
function format_swf_Reader_31(&$__hx__this, &$n) {
	{
		$i = null;
		if($i === null) {
			$i = $__hx__this->i;
		}
		return $i->readUInt16();
	}
}
function format_swf_Reader_32(&$__hx__this, &$n) {
	{
		$i = null;
		if($i === null) {
			$i = $__hx__this->i;
		}
		return $i->readUInt16();
	}
}
function format_swf_Reader_33(&$__hx__this, &$grad, &$mat, &$type, &$ver) {
	{
		$i = $__hx__this->i;
		if($i === null) {
			$i = $__hx__this->i;
		}
		return $i->readUInt16();
	}
}
function format_swf_Reader_34(&$__hx__this, &$_fill, &$_g, &$_join, &$arr, &$c, &$cnt, &$endCap, &$noClose, &$noHScale, &$noVScale, &$pixelHinting, &$startCap, &$ver, &$width) {
	switch($_join) {
	case 0:{
		return format_swf_LineJoinStyle::$LJRound;
	}break;
	case 1:{
		return format_swf_LineJoinStyle::$LJBevel;
	}break;
	case 2:{
		return format_swf_LineJoinStyle::LJMiter(format_swf_Reader_36($__hx__this, $_fill, $_g, $_join, $arr, $c, $cnt, $endCap, $noClose, $noHScale, $noVScale, $pixelHinting, $startCap, $ver, $width));
	}break;
	default:{
		throw new HException($__hx__this->error("invalid joint style in line style"));
	}break;
	}
}
function format_swf_Reader_35(&$__hx__this, &$_fill, &$_g, &$_join, &$arr, &$c, &$cnt, &$endCap, &$join, &$noClose, &$noHScale, &$noVScale, &$pixelHinting, &$startCap, &$ver, &$width) {
	switch($_fill) {
	case false:{
		return format_swf_LS2Fill::LS2FColor($__hx__this->readRGBA($__hx__this->i));
	}break;
	case true:{
		return format_swf_LS2Fill::LS2FStyle($__hx__this->readFillStyle($ver));
	}break;
	}
}
function format_swf_Reader_36(&$__hx__this, &$_fill, &$_g, &$_join, &$arr, &$c, &$cnt, &$endCap, &$noClose, &$noHScale, &$noVScale, &$pixelHinting, &$startCap, &$ver, &$width) {
	{
		$i = null;
		if($i === null) {
			$i = $__hx__this->i;
		}
		return $i->readUInt16();
	}
}
