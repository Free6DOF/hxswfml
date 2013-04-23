<?php

class format_ttf_Reader {
	public function __construct($i) {
		if(!php_Boot::$skip_constructor) {
		$this->input = $i;
		$this->input->set_bigEndian(true);
	}}
	public function readOS2Table($bytes) {
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		$os2Data = _hx_anonymous(array("version" => $input->readUInt16(), "xAvgCharWidth" => $input->readInt16(), "usWeightClass" => $input->readUInt16(), "usWidthClass" => $input->readUInt16(), "fsType" => $input->readInt16(), "ySubscriptXSize" => $input->readInt16(), "ySubscriptYSize" => $input->readInt16(), "ySubscriptXOffset" => $input->readInt16(), "ySubscriptYOffset" => $input->readInt16(), "ySuperscriptXSize" => $input->readInt16(), "ySuperscriptYSize" => $input->readInt16(), "ySuperscriptXOffset" => $input->readInt16(), "ySuperscriptYOffset" => $input->readInt16(), "yStrikeoutSize" => $input->readInt16(), "yStrikeoutPosition" => $input->readInt16(), "sFamilyClass" => $input->readInt16(), "bFamilyType" => $input->readByte(), "bSerifStyle" => $input->readByte(), "bWeight" => $input->readByte(), "bProportion" => $input->readByte(), "bContrast" => $input->readByte(), "bStrokeVariation" => $input->readByte(), "bArmStyle" => $input->readByte(), "bLetterform" => $input->readByte(), "bMidline" => $input->readByte(), "bXHeight" => $input->readByte(), "ulUnicodeRange1" => $input->readInt32(), "ulUnicodeRange2" => $input->readInt32(), "ulUnicodeRange3" => $input->readInt32(), "ulUnicodeRange4" => $input->readInt32(), "achVendorID" => $input->readInt32(), "fsSelection" => $input->readInt16(), "usFirstCharIndex" => $input->readUInt16(), "usLastCharIndex" => $input->readUInt16(), "sTypoAscender" => $input->readInt16(), "sTypoDescender" => $input->readInt16(), "sTypoLineGap" => $input->readInt16(), "usWinAscent" => $input->readUInt16(), "usWinDescent" => $input->readUInt16()));
		return $os2Data;
	}
	public function readNameTable($bytes) {
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		$_format = $input->readUInt16();
		$count = $input->readUInt16();
		$stringOffset = $input->readUInt16();
		$nameRecords = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $count) {
				$i = $_g++;
				$nameRecords->push(_hx_anonymous(array("platformId" => $input->readUInt16(), "platformSpecificId" => $input->readUInt16(), "languageID" => $input->readUInt16(), "nameID" => $input->readUInt16(), "length" => $input->readUInt16(), "offset" => $input->readUInt16(), "record" => "")));
				unset($i);
			}
		}
		$nameRecords->sort((isset($this->sortOnOffset16) ? $this->sortOnOffset16: array($this, "sortOnOffset16")));
		$fontNameRecord = null;
		{
			$_g = 0;
			while($_g < $count) {
				$i = $_g++;
				if(_hx_array_get($nameRecords, $i)->nameID === 4 && (_hx_array_get($nameRecords, $i)->platformId === 3 || _hx_array_get($nameRecords, $i)->platformId === 0)) {
					$fontNameRecord = $nameRecords[$i];
					break;
				}
				unset($i);
			}
		}
		if($fontNameRecord === null) {
			throw new HException("fontNameRecord not found");
		} else {
			$input->read($fontNameRecord->offset);
			{
				$_g1 = 0; $_g = Std::int(_hx_len($fontNameRecord) / 2);
				while($_g1 < $_g) {
					$i = $_g1++;
					$fontNameRecord->record .= _hx_string_or_null(chr($input->readUInt16()));
					unset($i);
				}
			}
		}
		$this->fontName = $fontNameRecord->record;
		return $nameRecords;
	}
	public function readPostTable($bytes) {
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		$postData = _hx_anonymous(array("version" => $input->readInt32(), "italicAngle" => $input->readInt32(), "underlinePosition" => $input->readInt16(), "underlineThickness" => $input->readInt16(), "isFixedPitch" => $input->readInt32(), "minMemType42" => $input->readInt32(), "maxMemType42" => $input->readInt32(), "minMemType1" => $input->readInt32(), "maxMemType1" => $input->readInt32(), "numGlyphs" => 0, "glyphNameIndex" => new _hx_array(array()), "psGlyphName" => new _hx_array(array())));
		if($postData->version === 131072) {
			$postData->numGlyphs = $input->readUInt16();
			{
				$_g1 = 0; $_g = $postData->numGlyphs;
				while($_g1 < $_g) {
					$i = $_g1++;
					$postData->glyphNameIndex[$i] = $input->readUInt16();
					unset($i);
				}
			}
			$high = 0;
			{
				$_g1 = 0; $_g = $postData->numGlyphs;
				while($_g1 < $_g) {
					$i = $_g1++;
					if($high < $postData->glyphNameIndex[$i]) {
						$high = $postData->glyphNameIndex[$i];
					}
					unset($i);
				}
			}
			if($high > 257) {
				$high -= 257;
				{
					$_g = 0;
					while($_g < $high) {
						$i = $_g++;
						$postData->psGlyphName[$i] = $input->readString($input->readByte());
						unset($i);
					}
				}
			}
		}
		return $postData;
	}
	public function readKernTable($bytes) {
		if($bytes === null) {
			return new _hx_array(array());
		}
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		$version = $input->readUInt16();
		$nTables = $input->readUInt16();
		$tables = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $nTables) {
				$i = $_g++;
				$version1 = $input->readUInt16();
				$length = $input->readUInt16();
				$coverage = $input->readUInt16();
				$_format = $coverage >> 8;
				switch($_format) {
				case 0:{
					$nPairs = $input->readUInt16();
					$searchRange = $input->readUInt16();
					$entrySelector = $input->readUInt16();
					$rangeShift = $input->readUInt16();
					$this->kerningPairs = new _hx_array(array());
					{
						$_g1 = 0;
						while($_g1 < $nPairs) {
							$i1 = $_g1++;
							$this->kerningPairs->push(_hx_anonymous(array("left" => $this->getCharCodeFromIndex($input->readUInt16()), "right" => $this->getCharCodeFromIndex($input->readUInt16()), "value" => $input->readInt16())));
							unset($i1);
						}
					}
					$tables->push(format_ttf_KernSubTable::KernSub0($this->kerningPairs));
				}break;
				case 2:{
					$rowWidth = $input->readUInt16();
					$leftOffsetTable = $input->readUInt16();
					$rightOffsetTable = $input->readUInt16();
					$array = $input->readUInt16();
					$firstGlyph = $input->readUInt16();
					$nGlyphs = $input->readUInt16();
					$offsets = new _hx_array(array());
					{
						$_g1 = 0;
						while($_g1 < $nGlyphs) {
							$i1 = $_g1++;
							$offsets->push($input->readUInt16());
							unset($i1);
						}
					}
					$tables->push(format_ttf_KernSubTable::KernSub1($offsets));
				}break;
				}
				unset($version1,$length,$i,$coverage,$_format);
			}
		}
		return $tables;
	}
	public function getCharCodeFromIndex($index) {
		{
			$_g1 = 0; $_g = $this->glyphIndexArray->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if($this->glyphIndexArray[$i] !== null && _hx_array_get($this->glyphIndexArray, $i)->index === $index) {
					return _hx_array_get($this->glyphIndexArray, $i)->charCode;
				}
				unset($i);
			}
		}
		return 0;
	}
	public function mapCharCode($charCode, $glyphIndices, $segCount, $startCodes, $endCodes, $idRangeOffsets, $idDeltas) {
		try {
			{
				$_g = 0;
				while($_g < $segCount) {
					$i = $_g++;
					if($endCodes->a[$i] >= $charCode) {
						if($startCodes->a[$i] <= $charCode) {
							if($idRangeOffsets->a[$i] > 0) {
								$index = Std::int($idRangeOffsets->a[$i] / 2 + $charCode - $startCodes[$i] - $segCount + $i);
								return $glyphIndices[$index];
								unset($index);
							} else {
								$index = Std::int(_hx_mod(($idDeltas->a[$i] + $charCode), 65536));
								return $index;
								unset($index);
							}
						} else {
							break;
						}
					}
					unset($i);
				}
			}
			return 0;
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return 0;
			}
		}
		return 0;
	}
	public function readSubTable($bytes, $entry) {
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		$input->read($entry->offset);
		$cmapFormat = $input->readUInt16();
		$length = $input->readUInt16();
		$language = $input->readUInt16();
		$cmapHeader = _hx_anonymous(array("platformId" => $entry->platformId, "platformSpecificId" => $entry->platformSpecificId, "offset" => $entry->offset, "format" => $cmapFormat, "language" => $language));
		$this->glyphIndexArray = new _hx_array(array());
		$this->allGlyphs = new _hx_array(array());
		if($cmapFormat === 0) {
			{
				$_g = 0;
				while($_g < 256) {
					$j = $_g++;
					$this->glyphIndexArray[$j] = _hx_anonymous(array("charCode" => $j, "index" => $input->readByte(), "char" => _hx_array_get(new _hx_array(array(".notdef", "null", "CR", "space", "exclam", "quotedbl", "numbersign", "dollar", "percent", "ampersand", "quotesingle", "parenleft", "parenright", "asterisk", "plus", "comma", "hyphen", "period", "slash", "zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "colon", "semicolon", "less", "equal", "greater", "question", "at", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "bracketleft", "backslash", "bracketright", "asciicircum", "underscore", "grave", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "braceleft", "bar", "braceright", "asciitilde", "Adieresis", "Aring", "Ccedilla", "Eacute", "Ntilde", "Odieresis", "Udieresis", "aacute", "agrave", "acircumflex", "adieresis", "atilde", "aring", "ccedilla", "eacute", "egrave", "ecircumflex", "edieresis", "iacute", "igrave", "icircumflex", "idieresis", "ntilde", "oacute", "ograve", "ocircumflex", "odieresis", "otilde", "uacute", "ugrave", "ucircumflex", "udieresis", "dagger", "degree", "cent", "sterling", "section", "bullet", "paragraph", "germandbls", "registered", "copyright", "trademark", "acute", "dieresis", "notequal", "AE", "Oslash", "infinity", "plusminus", "lessequal", "greaterequal", "yen", "mu", "partialdiff", "summation", "product", "pi", "integral'", "ordfeminine", "ordmasculine", "Omega", "ae", "oslash", "questiondown", "exclamdown", "logicalnot", "radical", "florin", "approxequal", "increment", "guillemotleft", "guillemotright", "ellipsis", "nbspace", "Agrave", "Atilde", "Otilde", "OE", "oe", "endash", "emdash", "quotedblleft", "quotedblright", "quoteleft", "quoteright", "divide", "lozenge", "ydieresis", "Ydieresis", "fraction", "currency", "guilsinglleft", "guilsinglright", "fi", "fl", "daggerdbl", "middot", "quotesinglbase", "quotedblbase", "perthousand", "Acircumflex", "Ecircumflex", "Aacute", "Edieresis", "Egrave", "Iacute", "Icircumflex", "Idieresis", "Igrave", "Oacute", "Ocircumflex", "", "Ograve", "Uacute", "Ucircumflex", "Ugrave", "dotlessi", "circumflex", "tilde", "overscore", "breve", "dotaccent", "ring", "cedilla", "hungarumlaut", "ogonek", "caron", "Lslash", "lslash", "Scaron", "scaron", "Zcaron", "zcaron", "brokenbar", "Eth", "eth", "Yacute", "yacute", "Thorn", "thorn", "minus", "multiply", "onesuperior", "twosuperior", "threesuperior", "onehalf", "onequarter", "threequarters", "franc", "Gbreve", "gbreve", "Idot", "Scedilla", "scedilla", "Cacute", "cacute", "Ccaron", "ccaron", "")), $j)));
					unset($j);
				}
			}
			return format_ttf_CmapSubTable::Cmap0($cmapHeader, $this->glyphIndexArray);
		} else {
			if($cmapFormat === 4) {
				$segCount2x = $input->readUInt16();
				$segCount = Std::int($segCount2x / 2);
				$searchRange = $input->readUInt16();
				$entrySelector = $input->readUInt16();
				$rangeShift = $input->readUInt16();
				$endCodes = new _hx_array(array());
				$startCodes = new _hx_array(array());
				$idDeltas = new _hx_array(array());
				$idRangeOffsets = new _hx_array(array());
				$glyphIndices = new _hx_array(array());
				{
					$_g = 0;
					while($_g < $segCount) {
						$i = $_g++;
						$endCodes->push($input->readUInt16());
						unset($i);
					}
				}
				$reserved = $input->readUInt16();
				{
					$_g = 0;
					while($_g < $segCount) {
						$i = $_g++;
						$startCodes->push($input->readUInt16());
						unset($i);
					}
				}
				{
					$_g = 0;
					while($_g < $segCount) {
						$i = $_g++;
						$idDeltas->push($input->readUInt16());
						unset($i);
					}
				}
				{
					$_g = 0;
					while($_g < $segCount) {
						$i = $_g++;
						$idRangeOffsets->push($input->readUInt16());
						unset($i);
					}
				}
				$count = Std::int(($length - (8 * $segCount + 16)) / 2);
				if($reserved !== 0) {
					$count = Std::int(($count - 6) / 2);
				}
				{
					$_g = 0;
					while($_g < $count) {
						$i = $_g++;
						$glyphIndices[$i] = $input->readUInt16();
						unset($i);
					}
				}
				$this->glyphIndexArray[0] = _hx_anonymous(array("charCode" => 0, "index" => 0, "char" => chr(0)));
				$this->glyphIndexArray[1] = _hx_anonymous(array("charCode" => 1, "index" => 1, "char" => "\x01"));
				$this->glyphIndexArray[2] = _hx_anonymous(array("charCode" => 2, "index" => 2, "char" => "\x02"));
				$this->allGlyphs->concat($this->glyphIndexArray);
				{
					$_g = 0;
					while($_g < $segCount) {
						$i = $_g++;
						{
							$_g2 = $startCodes[$i]; $_g1 = $endCodes->a[$i] + 1;
							while($_g2 < $_g1) {
								$j = $_g2++;
								$index = $this->mapCharCode($j, $glyphIndices, $segCount, $startCodes, $endCodes, $idRangeOffsets, $idDeltas);
								$glyphIndex = _hx_anonymous(array("charCode" => $j, "index" => $index, "char" => chr($j)));
								$this->glyphIndexArray[$j] = $glyphIndex;
								$this->allGlyphs->push($glyphIndex);
								unset($j,$index,$glyphIndex);
							}
							unset($_g2,$_g1);
						}
						unset($i);
					}
				}
				return format_ttf_CmapSubTable::Cmap4($cmapHeader, $this->glyphIndexArray);
			} else {
				if($cmapFormat === 6) {
					$firstCode = $input->readUInt16();
					$entryCount = $input->readUInt16();
					{
						$_g = 0;
						while($_g < $entryCount) {
							$j = $_g++;
							$glyphIndex = _hx_anonymous(array("charCode" => $j, "index" => $input->readUInt16(), "char" => _hx_array_get(new _hx_array(array(".notdef", "null", "CR", "space", "exclam", "quotedbl", "numbersign", "dollar", "percent", "ampersand", "quotesingle", "parenleft", "parenright", "asterisk", "plus", "comma", "hyphen", "period", "slash", "zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "colon", "semicolon", "less", "equal", "greater", "question", "at", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "bracketleft", "backslash", "bracketright", "asciicircum", "underscore", "grave", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "braceleft", "bar", "braceright", "asciitilde", "Adieresis", "Aring", "Ccedilla", "Eacute", "Ntilde", "Odieresis", "Udieresis", "aacute", "agrave", "acircumflex", "adieresis", "atilde", "aring", "ccedilla", "eacute", "egrave", "ecircumflex", "edieresis", "iacute", "igrave", "icircumflex", "idieresis", "ntilde", "oacute", "ograve", "ocircumflex", "odieresis", "otilde", "uacute", "ugrave", "ucircumflex", "udieresis", "dagger", "degree", "cent", "sterling", "section", "bullet", "paragraph", "germandbls", "registered", "copyright", "trademark", "acute", "dieresis", "notequal", "AE", "Oslash", "infinity", "plusminus", "lessequal", "greaterequal", "yen", "mu", "partialdiff", "summation", "product", "pi", "integral'", "ordfeminine", "ordmasculine", "Omega", "ae", "oslash", "questiondown", "exclamdown", "logicalnot", "radical", "florin", "approxequal", "increment", "guillemotleft", "guillemotright", "ellipsis", "nbspace", "Agrave", "Atilde", "Otilde", "OE", "oe", "endash", "emdash", "quotedblleft", "quotedblright", "quoteleft", "quoteright", "divide", "lozenge", "ydieresis", "Ydieresis", "fraction", "currency", "guilsinglleft", "guilsinglright", "fi", "fl", "daggerdbl", "middot", "quotesinglbase", "quotedblbase", "perthousand", "Acircumflex", "Ecircumflex", "Aacute", "Edieresis", "Egrave", "Iacute", "Icircumflex", "Idieresis", "Igrave", "Oacute", "Ocircumflex", "", "Ograve", "Uacute", "Ucircumflex", "Ugrave", "dotlessi", "circumflex", "tilde", "overscore", "breve", "dotaccent", "ring", "cedilla", "hungarumlaut", "ogonek", "caron", "Lslash", "lslash", "Scaron", "scaron", "Zcaron", "zcaron", "brokenbar", "Eth", "eth", "Yacute", "yacute", "Thorn", "thorn", "minus", "multiply", "onesuperior", "twosuperior", "threesuperior", "onehalf", "onequarter", "threequarters", "franc", "Gbreve", "gbreve", "Idot", "Scedilla", "scedilla", "Cacute", "cacute", "Ccaron", "ccaron", "")), $j)));
							$this->glyphIndexArray[$j] = $glyphIndex;
							unset($j,$glyphIndex);
						}
					}
					return format_ttf_CmapSubTable::Cmap6($cmapHeader, $this->glyphIndexArray, $firstCode);
				} else {
					return format_ttf_CmapSubTable::CmapUnk($cmapHeader, $bytes);
				}
			}
		}
	}
	public function readCmapTable($bytes) {
		if($bytes === null) {
			throw new HException("no cmap table found");
		}
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		$version = $input->readUInt16();
		$numberSubtables = $input->readUInt16();
		$directory = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $numberSubtables) {
				$i = $_g++;
				$directory->push(_hx_anonymous(array("platformId" => $input->readUInt16(), "platformSpecificId" => $input->readUInt16(), "offset" => $input->readInt32())));
				unset($i);
			}
		}
		$subTables = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $numberSubtables) {
				$i = $_g++;
				$subTables->push($this->readSubTable($bytes, $directory[$i]));
				unset($i);
			}
		}
		return $subTables;
	}
	public function readGlyfComposite($input, $len, $glyphIndex) {
		$components = new _hx_array(array());
		$comp = null;
		$firstIndex = 0;
		$firstContour = 0;
		$more = false;
		$flags = null;
		do {
			$desc = $glyphIndex;
			$flags = $input->readUInt16();
			$glyphIdx = $input->readUInt16();
			$len -= 4;
			$more = ($flags & 32) !== 0;
			$argument1 = null;
			$argument2 = null;
			$comp = _hx_anonymous(array("flags" => $flags, "glyphIndex" => $glyphIdx, "xtranslate" => null, "ytranslate" => null, "xscale" => null, "yscale" => null, "scale01" => null, "scale10" => null, "point1" => null, "point2" => null, "instructions" => null));
			if(($flags & 1) !== 0) {
				$argument1 = $input->readInt16();
				$argument2 = $input->readInt16();
				$len -= 4;
			} else {
				$argument1 = $input->readByte();
				$argument2 = $input->readByte();
				$len -= 2;
			}
			if(($flags & 2) !== 0) {
				$comp->xtranslate = $argument1;
				$comp->ytranslate = $argument2;
			} else {
				$comp->point1 = $argument1;
				$comp->point2 = $argument2;
			}
			if(($flags & 8) !== 0) {
				$s = $input->readInt16() / 16384;
				$comp->xscale = $s;
				$comp->yscale = $s;
				$len -= 2;
				unset($s);
			} else {
				if(($flags & 64) !== 0) {
					$comp->xscale = $input->readInt16() / 16384;
					$comp->yscale = $input->readInt16() / 16384;
					$len -= 4;
				} else {
					if(($flags & 128) !== 0) {
						$comp->xscale = $input->readInt16() / 16384;
						$comp->scale01 = $input->readInt16() / 16384;
						$comp->scale10 = $input->readInt16() / 16384;
						$comp->yscale = $input->readInt16() / 16384;
						$len -= 8;
					}
				}
			}
			$components->push($comp);
			unset($glyphIdx,$desc,$argument2,$argument1);
		} while($more);
		if(($flags & 256) !== 0) {
			$instructionLength = $input->readUInt16();
			$len -= 2;
			$instructions = new _hx_array(array());
			{
				$_g = 0;
				while($_g < $instructionLength) {
					$i = $_g++;
					$instructions[$i] = $input->readByte();
					$len -= 1;
					unset($i);
				}
			}
			_hx_array_get($components, $components->length - 1)->instructions = $instructions;
		}
		$input->read($len);
		return $components;
	}
	public function readGlyfSimple($numberOfContours, $input, $len) {
		$endPtsOfContours = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $numberOfContours) {
				$i = $_g++;
				$endPtsOfContours[$i] = $input->readUInt16();
				$len -= 2;
				unset($i);
			}
		}
		$count = $endPtsOfContours->a[$numberOfContours - 1] + 1;
		$instructionLength = $input->readUInt16();
		$len -= 2;
		$instructions = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $instructionLength) {
				$i = $_g++;
				$instructions[$i] = $input->readByte();
				$len -= 1;
				unset($i);
			}
		}
		$flags = new _hx_array(array());
		$iindex = 0;
		$jindex = 1;
		while(true) {
			if($iindex < $count) {
				$flags[$iindex] = $input->readByte();
				$len -= 1;
				if(($flags->a[$iindex] & 8) !== 0) {
					$repeats = $input->readByte();
					$len -= 1;
					$jindex = 1;
					while(true) {
						if($jindex < $repeats + 1) {
							$flags[$iindex + $jindex] = $flags[$iindex];
							$jindex++;
						} else {
							break;
						}
					}
					$iindex += $repeats;
					unset($repeats);
				}
				$iindex++;
			} else {
				break;
			}
		}
		$xCoordinates = new _hx_array(array());
		$xDeltas = new _hx_array(array());
		$x = 0;
		{
			$_g = 0;
			while($_g < $count) {
				$i = $_g++;
				$xDelta = 0;
				if(($flags->a[$i] & 16) !== 0) {
					if(($flags->a[$i] & 2) !== 0) {
						$xDelta = $input->readByte();
						$len -= 1;
						$x += $xDelta;
					}
				} else {
					if(($flags->a[$i] & 2) !== 0) {
						$xDelta = -$input->readByte();
						$len -= 1;
						$x += $xDelta;
					} else {
						$xDelta = $input->readInt16();
						$len -= 2;
						$x += $xDelta;
					}
				}
				$xCoordinates[$i] = $x;
				$xDeltas[$i] = $xDelta;
				unset($xDelta,$i);
			}
		}
		$yCoordinates = new _hx_array(array());
		$yDeltas = new _hx_array(array());
		$y = 0;
		{
			$_g = 0;
			while($_g < $count) {
				$i = $_g++;
				$yDelta = 0;
				if(($flags->a[$i] & 32) !== 0) {
					if(($flags->a[$i] & 4) !== 0) {
						$yDelta = $input->readByte();
						$len -= 1;
						$y += $yDelta;
					}
				} else {
					if(($flags->a[$i] & 4) !== 0) {
						$yDelta = -$input->readByte();
						$len -= 1;
						$y += $yDelta;
					} else {
						$yDelta = $input->readInt16();
						$len -= 2;
						$y += $yDelta;
					}
				}
				$yCoordinates[$i] = $y;
				$yDeltas[$i] = $yDelta;
				unset($yDelta,$i);
			}
		}
		$glyphSimple = _hx_anonymous(array("endPtsOfContours" => $endPtsOfContours, "flags" => $flags, "instructions" => $instructions, "xCoordinates" => $xCoordinates, "yCoordinates" => $yCoordinates, "xDeltas" => $xDeltas, "yDeltas" => $yDeltas));
		$input->read($len);
		return $glyphSimple;
	}
	public function readGlyf($glyphIndex, $input, $len) {
		if($len > 0) {
			$numberOfContours = $input->readInt16();
			$glyphHeader = _hx_anonymous(array("numberOfContours" => $numberOfContours, "xMin" => $input->readInt16(), "yMin" => $input->readInt16(), "xMax" => $input->readInt16(), "yMax" => $input->readInt16()));
			$len -= 10;
			if($numberOfContours >= 0) {
				return format_ttf_GlyfDescription::TGlyphSimple($glyphHeader, $this->readGlyfSimple($numberOfContours, $input, $len));
			} else {
				if($numberOfContours === -1) {
					return format_ttf_GlyfDescription::TGlyphComposite($glyphHeader, $this->readGlyfComposite($input, $len, $glyphIndex));
				} else {
					throw new HException("unknown GlyfDescription");
				}
			}
		} else {
			return format_ttf_GlyfDescription::$TGlyphNull;
		}
		return format_ttf_GlyfDescription::$TGlyphNull;
	}
	public function readGlyfTable($bytes, $maxp, $loca, $cmap, $hmtx) {
		if($bytes === null) {
			throw new HException("no glyf table found");
		}
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		$descriptions = new _hx_array(array());
		{
			$_g1 = 0; $_g = $maxp->numGlyphs;
			while($_g1 < $_g) {
				$i = $_g1++;
				$descriptions->push($this->readGlyf($i, $input, $loca->offsets->a[$i + 1] - $loca->offsets[$i]));
				unset($i);
			}
		}
		return $descriptions;
	}
	public function readHmtxTable($bytes, $maxp, $hhea) {
		if($bytes === null) {
			throw new HException("no hmtx table found");
		}
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		$metrics = new _hx_array(array());
		{
			$_g1 = 0; $_g = $hhea->numberOfHMetrics;
			while($_g1 < $_g) {
				$i = $_g1++;
				$metrics->push(_hx_anonymous(array("advanceWidth" => $input->readUInt16(), "leftSideBearing" => $input->readInt16())));
				unset($i);
			}
		}
		$len = $maxp->numGlyphs - $hhea->numberOfHMetrics;
		$lastAdvanceWidth = _hx_array_get($metrics, $metrics->length - 1)->advanceWidth;
		{
			$_g = 0;
			while($_g < $len) {
				$i = $_g++;
				$metrics->push(_hx_anonymous(array("advanceWidth" => $lastAdvanceWidth, "leftSideBearing" => $input->readInt16())));
				unset($i);
			}
		}
		return $metrics;
	}
	public function readLocaTable($bytes, $head, $maxp) {
		if($bytes === null) {
			throw new HException("no loca table found");
		}
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		$offsets = new _hx_array(array());
		if($head->indexToLocFormat === 0) {
			$_g1 = 0; $_g = $maxp->numGlyphs + 1;
			while($_g1 < $_g) {
				$i = $_g1++;
				$offsets[$i] = $input->readUInt16() * 2;
				unset($i);
			}
		} else {
			$_g1 = 0; $_g = $maxp->numGlyphs + 1;
			while($_g1 < $_g) {
				$i = $_g1++;
				$offsets[$i] = $input->readInt32();
				unset($i);
			}
		}
		return _hx_anonymous(array("factor" => (($head->indexToLocFormat === 0) ? 2 : 1), "offsets" => $offsets));
	}
	public function readMaxpTable($bytes) {
		if($bytes === null) {
			throw new HException("no maxp table found");
		}
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		return _hx_anonymous(array("versionNumber" => $input->readInt32(), "numGlyphs" => $input->readUInt16(), "maxPoints" => $input->readUInt16(), "maxContours" => $input->readUInt16(), "maxComponentPoints" => $input->readUInt16(), "maxComponentContours" => $input->readUInt16(), "maxZones" => $input->readUInt16(), "maxTwilightPoints" => $input->readUInt16(), "maxStorage" => $input->readUInt16(), "maxFunctionDefs" => $input->readUInt16(), "maxInstructionDefs" => $input->readUInt16(), "maxStackElements" => $input->readUInt16(), "maxSizeOfInstructions" => $input->readUInt16(), "maxComponentElements" => $input->readUInt16(), "maxComponentDepth" => $input->readUInt16()));
	}
	public function readHeadTable($bytes) {
		if($bytes === null) {
			throw new HException("no head table found");
		}
		$i = new haxe_io_BytesInput($bytes, null, null);
		$i->set_bigEndian(true);
		return _hx_anonymous(array("version" => $i->readInt32(), "fontRevision" => $i->readInt32(), "checkSumAdjustment" => $i->readInt32(), "magicNumber" => $i->readInt32(), "flags" => $i->readUInt16(), "unitsPerEm" => $i->readUInt16(), "created" => $i->readDouble(), "modified" => $i->readDouble(), "xMin" => $i->readInt16(), "yMin" => $i->readInt16(), "xMax" => $i->readInt16(), "yMax" => $i->readInt16(), "macStyle" => $i->readUInt16(), "lowestRecPPEM" => $i->readUInt16(), "fontDirectionHint" => $i->readInt16(), "indexToLocFormat" => $i->readInt16(), "glyphDataFormat" => $i->readInt16()));
	}
	public function readHheaTable($bytes) {
		if($bytes === null) {
			throw new HException("no hhea table found");
		}
		$input = new haxe_io_BytesInput($bytes, null, null);
		$input->set_bigEndian(true);
		return _hx_anonymous(array("version" => $input->readInt32(), "ascender" => $input->readInt16(), "descender" => $input->readInt16(), "lineGap" => $input->readInt16(), "advanceWidthMax" => $input->readUInt16(), "minLeftSideBearing" => $input->readInt16(), "minRightSideBearing" => $input->readInt16(), "xMaxExtent" => $input->readInt16(), "caretSlopeRise" => $input->readInt16(), "caretSlopeRun" => $input->readInt16(), "caretOffset" => $input->readInt16(), "reserved" => $input->read(8), "metricDataFormat" => $input->readInt16(), "numberOfHMetrics" => $input->readUInt16()));
	}
	public function sortOnOffset16($e1, $e2) {
		$x = $e1->offset;
		$y = $e2->offset;
		$result = 0;
		if($x < $y) {
			$result = -1;
		}
		if($x === $y) {
			$result = 0;
		}
		if($x > $y) {
			$result = 1;
		}
		return $result;
	}
	public function sortOnOffset32($e1, $e2) {
		$x = $e1->offset;
		$y = $e2->offset;
		$result = 0;
		if($x < $y) {
			$result = -1;
		}
		if($x === $y) {
			$result = 0;
		}
		if($x > $y) {
			$result = 1;
		}
		return $result;
	}
	public function readDirectory($header) {
		$this->tablesHash = new haxe_ds_StringMap();
		$directory = new _hx_array(array());
		{
			$_g1 = 0; $_g = $header->numTables;
			while($_g1 < $_g) {
				$i = $_g1++;
				$tableName = $this->input->readString(4);
				if($tableName === "name") {
					$tableName = "_name";
				}
				$directory[$i] = _hx_anonymous(array("tableName" => $tableName, "checksum" => $this->input->readInt32(), "offset" => $this->input->readInt32(), "length" => $this->input->readInt32()));
				unset($tableName,$i);
			}
		}
		$directory->sort((isset($this->sortOnOffset32) ? $this->sortOnOffset32: array($this, "sortOnOffset32")));
		{
			$_g1 = 0; $_g = $directory->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$entry = $directory[$i];
				$start = $entry->offset;
				$end = null;
				if($i === $directory->length - 1) {
					$end = $start + _hx_len($entry);
				} else {
					$end = _hx_array_get($directory, $i + 1)->offset;
				}
				$bytes = $this->input->read($end - $start);
				$this->tablesHash->set(_hx_explode("/", $entry->tableName)->join("_"), $bytes);
				unset($start,$i,$entry,$end,$bytes);
			}
		}
		return $directory;
	}
	public function readHeader() {
		return _hx_anonymous(array("majorVersion" => $this->input->readUInt16(), "minorVersion" => $this->input->readUInt16(), "numTables" => $this->input->readUInt16(), "searchRange" => $this->input->readUInt16(), "entrySelector" => $this->input->readUInt16(), "rangeShift" => $this->input->readUInt16()));
	}
	public function read() {
		$header = $this->readHeader();
		$directory = $this->readDirectory($header);
		$tables = new _hx_array(array());
		$hheaData = $this->readHheaTable($this->tablesHash->get("hhea"));
		$tables->push(format_ttf_Table::THhea($hheaData));
		$headData = $this->readHeadTable($this->tablesHash->get("head"));
		$tables->push(format_ttf_Table::THead($headData));
		$maxpData = $this->readMaxpTable($this->tablesHash->get("maxp"));
		$tables->push(format_ttf_Table::TMaxp($maxpData));
		$locaData = $this->readLocaTable($this->tablesHash->get("loca"), $headData, $maxpData);
		$tables->push(format_ttf_Table::TLoca($locaData));
		$hmtxData = $this->readHmtxTable($this->tablesHash->get("hmtx"), $maxpData, $hheaData);
		$tables->push(format_ttf_Table::THmtx($hmtxData));
		$cmapData = $this->readCmapTable($this->tablesHash->get("cmap"));
		$tables->push(format_ttf_Table::TCmap($cmapData));
		$glyfData = $this->readGlyfTable($this->tablesHash->get("glyf"), $maxpData, $locaData, $cmapData, $hmtxData);
		$tables->push(format_ttf_Table::TGlyf($glyfData));
		$kernData = $this->readKernTable($this->tablesHash->get("kern"));
		$tables->push(format_ttf_Table::TKern($kernData));
		$os2Data = $this->readOS2Table($this->tablesHash->get("OS_2"));
		$tables->push(format_ttf_Table::TOS2($os2Data));
		$nameData = $this->readNameTable($this->tablesHash->get("_name"));
		$tables->push(format_ttf_Table::TName($nameData));
		return _hx_anonymous(array("header" => $header, "directory" => $directory, "tables" => $tables));
	}
	public $allGlyphs;
	public $fontName;
	public $kerningPairs;
	public $glyphIndexArray;
	public $tablesHash;
	public $input;
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
	static function readOTF($i) {
		$input = $i;
		$input->set_bigEndian(true);
		$header = _hx_anonymous(array("sfntVersion" => $input->readInt32(), "numTables" => $input->readUInt16(), "searchRange" => $input->readUInt16(), "entrySelector" => $input->readUInt16(), "rangeShift" => $input->readUInt16()));
		$tables = new _hx_array(array());
		{
			$_g1 = 0; $_g = $header->numTables;
			while($_g1 < $_g) {
				$i1 = $_g1++;
				$tableName = $input->readString(4);
				if($tableName === "name") {
					$tableName = "_name";
				}
				$checksum = $input->readInt32();
				$offset = $input->readInt32();
				$length = $input->readInt32();
				$tables[$i1] = _hx_anonymous(array("tableName" => $tableName, "checksum" => $checksum, "offset" => $offset, "length" => $length, "bytes" => null));
				unset($tableName,$offset,$length,$i1,$checksum);
			}
		}
		return _hx_anonymous(array("header" => $header, "tables" => $tables));
	}
	function __toString() { return 'format.ttf.Reader'; }
}
