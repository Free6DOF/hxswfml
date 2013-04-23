<?php

class format_ttf_Tools {
	public function __construct(){}
	static $limit;
	static $buf;
	static function dumpTable($table, $lim = null) {
		if($lim === null) {
			$lim = -1;
		}
		format_ttf_Tools::$buf = new StringBuf();
		format_ttf_Tools::$limit = $lim;
		return format_ttf_Tools_0($lim, $table);
	}
	static function dumpTHmtx($metrics) {
		format_ttf_Tools::$buf->add("\x0A================================= hmtx table =================================\x0A");
		{
			$_g1 = 0; $_g = $metrics->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(format_ttf_Tools::$limit !== -1 && $i > format_ttf_Tools::$limit) {
					break;
				}
				format_ttf_Tools::$buf->add("\x0Ametrics[");
				format_ttf_Tools::$buf->add($i);
				format_ttf_Tools::$buf->add("]: advanceWidth: ");
				format_ttf_Tools::$buf->add(_hx_array_get($metrics, $i)->advanceWidth);
				format_ttf_Tools::$buf->add(", leftSideBearing:");
				format_ttf_Tools::$buf->add(_hx_array_get($metrics, $i)->leftSideBearing);
				unset($i);
			}
		}
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTCmap($subtables) {
		format_ttf_Tools::$buf->add("================================= cmap table =================================\x0A");
		format_ttf_Tools::$buf->add("Number of subtables: ");
		format_ttf_Tools::$buf->add($subtables->length);
		format_ttf_Tools::$buf->add("\x0A");
		{
			$_g1 = 0; $_g = $subtables->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$subtable = $subtables[$i];
				format_ttf_Tools::$buf->add("=================================\x0A");
				format_ttf_Tools::$buf->add("Subtable ");
				format_ttf_Tools::$buf->add($i);
				format_ttf_Tools::$buf->add("  ");
				format_ttf_Tools::$buf->add(Type::enumConstructor($subtable));
				format_ttf_Tools::$buf->add("\x0A");
				$header = _hx_array_get(Type::enumParameters($subtable), 0);
				$platformId = $header->platformId;
				$platformSpecificId = $header->platformSpecificId;
				format_ttf_Tools::$buf->add("platformId: ");
				format_ttf_Tools::$buf->add($platformId);
				format_ttf_Tools::$buf->add(" = ");
				format_ttf_Tools::$buf->add(_hx_array_get(Type::getEnumConstructs(_hx_qtype("format.ttf.Platform")), $platformId));
				format_ttf_Tools::$buf->add("\x0AplatformSpecificId: ");
				format_ttf_Tools::$buf->add($platformSpecificId);
				format_ttf_Tools::$buf->add(" = ");
				format_ttf_Tools::$buf->add(format_ttf_Tools_1($_g, $_g1, $header, $i, $platformId, $platformSpecificId, $subtable, $subtables));
				format_ttf_Tools::$buf->add("\x0Aoffset: ");
				format_ttf_Tools::$buf->add($header->offset);
				format_ttf_Tools::$buf->add("\x0Aformat: ");
				format_ttf_Tools::$buf->add($header->format);
				format_ttf_Tools::$buf->add("\x0Alanguage: ");
				format_ttf_Tools::$buf->add($header->language);
				format_ttf_Tools::$buf->add("\x0A");
				$__hx__t = ($subtable);
				switch($__hx__t->index) {
				case 0:
				$glyphIndexArray = $__hx__t->params[1]; $header1 = $__hx__t->params[0];
				{
					$_g2 = 0;
					while($_g2 < 256) {
						$j = $_g2++;
						format_ttf_Tools::$buf->add("macintosh CharCode :");
						format_ttf_Tools::$buf->add($j);
						format_ttf_Tools::$buf->add(", index = ");
						format_ttf_Tools::$buf->add(_hx_array_get($glyphIndexArray, $j)->index);
						format_ttf_Tools::$buf->add(", char: ");
						format_ttf_Tools::$buf->add(chr(_hx_array_get($glyphIndexArray, $j)->charCode));
						format_ttf_Tools::$buf->add("\x0A");
						unset($j);
					}
				}break;
				case 2:
				$glyphIndexArray = $__hx__t->params[1]; $header1 = $__hx__t->params[0];
				{
					$_g3 = 0; $_g2 = $glyphIndexArray->length;
					while($_g3 < $_g2) {
						$j = $_g3++;
						if($glyphIndexArray[$j] !== null) {
							format_ttf_Tools::$buf->add("unicode charCode: ");
							format_ttf_Tools::$buf->add($j);
							format_ttf_Tools::$buf->add(", index = ");
							format_ttf_Tools::$buf->add(_hx_array_get($glyphIndexArray, $j)->index);
							format_ttf_Tools::$buf->add(", char: ");
							format_ttf_Tools::$buf->add(chr(_hx_array_get($glyphIndexArray, $j)->charCode));
							format_ttf_Tools::$buf->add("\x0A");
						}
						unset($j);
					}
				}break;
				default:{
					format_ttf_Tools::$buf->add("not supported yet\x0A");
				}break;
				}
				unset($subtable,$platformSpecificId,$platformId,$i,$header);
			}
		}
		return format_ttf_Tools::$buf->b;
	}
	static function dympTGlyf($descriptions) {
		format_ttf_Tools::$buf->add("\x0A================================= glyf table =================================\x0A");
		{
			$_g1 = 0; $_g = $descriptions->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(format_ttf_Tools::$limit !== -1 && $i > format_ttf_Tools::$limit) {
					break;
				}
				$desc = $descriptions[$i];
				format_ttf_Tools::$buf->add("Glyph description: ");
				format_ttf_Tools::$buf->add($i);
				format_ttf_Tools::$buf->add("\x0A");
				$__hx__t = ($desc);
				switch($__hx__t->index) {
				case 0:
				$data = $__hx__t->params[1]; $header = $__hx__t->params[0];
				{
					format_ttf_Tools::$buf->add("\x0Aheader: xMax: ");
					format_ttf_Tools::$buf->add($header->xMax);
					format_ttf_Tools::$buf->add(", yMax:");
					format_ttf_Tools::$buf->add($header->yMax);
					format_ttf_Tools::$buf->add(", xMin:");
					format_ttf_Tools::$buf->add($header->xMin);
					format_ttf_Tools::$buf->add(", yMin:");
					format_ttf_Tools::$buf->add($header->yMin);
					format_ttf_Tools::$buf->add("\x0AendPtsOfContours:");
					format_ttf_Tools::$buf->add($data->endPtsOfContours);
					format_ttf_Tools::$buf->add("\x0Ainstructions:");
					format_ttf_Tools::$buf->add($data->instructions);
					format_ttf_Tools::$buf->add("\x0Aflags:");
					format_ttf_Tools::$buf->add($data->flags);
					format_ttf_Tools::$buf->add("\x0AxCoordinates:");
					format_ttf_Tools::$buf->add($data->xCoordinates);
					format_ttf_Tools::$buf->add("\x0AyCoordinates:");
					format_ttf_Tools::$buf->add($data->yCoordinates);
				}break;
				case 1:
				$components = $__hx__t->params[1]; $header = $__hx__t->params[0];
				{
					format_ttf_Tools::$buf->add("\x0Aheader: xMax: ");
					format_ttf_Tools::$buf->add($header->xMax);
					format_ttf_Tools::$buf->add(", yMax:");
					format_ttf_Tools::$buf->add($header->yMax);
					format_ttf_Tools::$buf->add(", xMin:");
					format_ttf_Tools::$buf->add($header->xMin);
					format_ttf_Tools::$buf->add(", yMin:");
					format_ttf_Tools::$buf->add($header->yMin);
					format_ttf_Tools::$buf->add("\x0Acomponents: ");
					format_ttf_Tools::$buf->add($components);
				}break;
				case 2:
				{
					format_ttf_Tools::$buf->add("\x0ATGlyphNull");
				}break;
				}
				format_ttf_Tools::$buf->add("\x0A\x0A");
				unset($i,$desc);
			}
		}
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTKern($kerning) {
		format_ttf_Tools::$buf->add("\x0A================================= kern table =================================\x0A");
		format_ttf_Tools::$buf->add("Number of subtables:");
		format_ttf_Tools::$buf->add($kerning->length);
		format_ttf_Tools::$buf->add("\x0A");
		$idx = 0;
		{
			$_g1 = 0; $_g = $kerning->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				$table = $kerning[$i];
				format_ttf_Tools::$buf->add("Kerning subtable:");
				format_ttf_Tools::$buf->add($i);
				format_ttf_Tools::$buf->add("\x0A");
				$__hx__t = ($table);
				switch($__hx__t->index) {
				case 0:
				$kerningPairs = $__hx__t->params[0];
				{
					format_ttf_Tools::$buf->add("Format: 0");
					{
						$_g3 = 0; $_g2 = $kerningPairs->length;
						while($_g3 < $_g2) {
							$j = $_g3++;
							if(format_ttf_Tools::$limit !== -1 && $j > format_ttf_Tools::$limit) {
								break;
							}
							format_ttf_Tools::$buf->add("\x0Asubtables[");
							format_ttf_Tools::$buf->add($i);
							format_ttf_Tools::$buf->add("].kerningPairs[");
							format_ttf_Tools::$buf->add($j);
							format_ttf_Tools::$buf->add("].left =");
							format_ttf_Tools::$buf->add(_hx_array_get($kerningPairs, $j)->left);
							format_ttf_Tools::$buf->add("\x0Asubtables[");
							format_ttf_Tools::$buf->add($i);
							format_ttf_Tools::$buf->add("].kerningPairs[");
							format_ttf_Tools::$buf->add($j);
							format_ttf_Tools::$buf->add("].right =");
							format_ttf_Tools::$buf->add(_hx_array_get($kerningPairs, $j)->right);
							format_ttf_Tools::$buf->add("\x0Asubtables[");
							format_ttf_Tools::$buf->add($i);
							format_ttf_Tools::$buf->add("].kerningPairs[");
							format_ttf_Tools::$buf->add($j);
							format_ttf_Tools::$buf->add("].value =");
							format_ttf_Tools::$buf->add(_hx_array_get($kerningPairs, $j)->value);
							unset($j);
						}
					}
				}break;
				case 1:
				$array = $__hx__t->params[0];
				{
					format_ttf_Tools::$buf->add("KernSub1\x0A");
				}break;
				}
				unset($table,$i);
			}
		}
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTName($records) {
		format_ttf_Tools::$buf->add("\x0A================================= name table =================================\x0A");
		{
			$_g = 0;
			while($_g < $records->length) {
				$rec = $records[$_g];
				++$_g;
				format_ttf_Tools::$buf->add("platformId: ");
				format_ttf_Tools::$buf->add($rec->platformId);
				format_ttf_Tools::$buf->add("\x0AplatformSpecificId: ");
				format_ttf_Tools::$buf->add($rec->platformSpecificId);
				format_ttf_Tools::$buf->add("\x0AlanguageID: ");
				format_ttf_Tools::$buf->add($rec->languageID);
				format_ttf_Tools::$buf->add("\x0AnameID: ");
				format_ttf_Tools::$buf->add($rec->nameID);
				format_ttf_Tools::$buf->add("\x0Alength: ");
				format_ttf_Tools::$buf->add(_hx_len($rec));
				format_ttf_Tools::$buf->add("\x0Aoffset: ");
				format_ttf_Tools::$buf->add($rec->offset);
				format_ttf_Tools::$buf->add("\x0Arecord: ");
				format_ttf_Tools::$buf->add($rec->record);
				format_ttf_Tools::$buf->add("\x0A\x0A");
				unset($rec);
			}
		}
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTPost($data) {
		format_ttf_Tools::$buf->add("\x0A================================= post table =================================\x0A");
		format_ttf_Tools::$buf->add("version : ");
		format_ttf_Tools::$buf->add($data->version);
		format_ttf_Tools::$buf->add("\x0AitalicAngle : ");
		format_ttf_Tools::$buf->add($data->italicAngle);
		format_ttf_Tools::$buf->add("\x0AunderlinePosition : ");
		format_ttf_Tools::$buf->add($data->underlinePosition);
		format_ttf_Tools::$buf->add("\x0AunderlineThickness : ");
		format_ttf_Tools::$buf->add($data->underlineThickness);
		format_ttf_Tools::$buf->add("\x0AisFixedPitch : ");
		format_ttf_Tools::$buf->add($data->isFixedPitch);
		format_ttf_Tools::$buf->add("\x0AminMemType42 : ");
		format_ttf_Tools::$buf->add($data->minMemType42);
		format_ttf_Tools::$buf->add("\x0AmaxMemType42 : ");
		format_ttf_Tools::$buf->add($data->maxMemType42);
		format_ttf_Tools::$buf->add("\x0AminMemType1 : ");
		format_ttf_Tools::$buf->add($data->minMemType1);
		format_ttf_Tools::$buf->add("\x0AmaxMemType1 : ");
		format_ttf_Tools::$buf->add($data->maxMemType1);
		format_ttf_Tools::$buf->add("\x0AnumGlyphs : ");
		format_ttf_Tools::$buf->add($data->numGlyphs);
		format_ttf_Tools::$buf->add("\x0A");
		$idx = 0;
		{
			$_g = 0; $_g1 = $data->glyphNameIndex;
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				format_ttf_Tools::$buf->add("glyphNameIndex: ");
				format_ttf_Tools::$buf->add($idx++);
				format_ttf_Tools::$buf->add(" : ");
				format_ttf_Tools::$buf->add($i);
				format_ttf_Tools::$buf->add("\x0A");
				unset($i);
			}
		}
		$idx = 0;
		{
			$_g = 0; $_g1 = $data->psGlyphName;
			while($_g < $_g1->length) {
				$i = $_g1[$_g];
				++$_g;
				format_ttf_Tools::$buf->add("psGlyphNameIndex: ");
				format_ttf_Tools::$buf->add($idx++);
				format_ttf_Tools::$buf->add(" : ");
				format_ttf_Tools::$buf->add($i);
				format_ttf_Tools::$buf->add("\x0A");
				unset($i);
			}
		}
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTHhea($data) {
		format_ttf_Tools::$buf->add("\x0A================================= hhea table =================================\x0A");
		format_ttf_Tools::$buf->add("version: ");
		format_ttf_Tools::$buf->add($data->version);
		format_ttf_Tools::$buf->add("\x0Aascender: ");
		format_ttf_Tools::$buf->add($data->ascender);
		format_ttf_Tools::$buf->add("\x0Adescender: ");
		format_ttf_Tools::$buf->add($data->descender);
		format_ttf_Tools::$buf->add("\x0AlineGap: ");
		format_ttf_Tools::$buf->add($data->lineGap);
		format_ttf_Tools::$buf->add("\x0AadvanceWidthMax: ");
		format_ttf_Tools::$buf->add($data->advanceWidthMax);
		format_ttf_Tools::$buf->add("\x0AminLeftSideBearing: ");
		format_ttf_Tools::$buf->add($data->minLeftSideBearing);
		format_ttf_Tools::$buf->add("\x0AminRightSideBearing: ");
		format_ttf_Tools::$buf->add($data->minRightSideBearing);
		format_ttf_Tools::$buf->add("\x0AxMaxExtent: ");
		format_ttf_Tools::$buf->add($data->xMaxExtent);
		format_ttf_Tools::$buf->add("\x0AcaretSlopeRise: ");
		format_ttf_Tools::$buf->add($data->caretSlopeRise);
		format_ttf_Tools::$buf->add("\x0AcaretSlopeRun: ");
		format_ttf_Tools::$buf->add($data->caretSlopeRun);
		format_ttf_Tools::$buf->add("\x0AcaretOffset: ");
		format_ttf_Tools::$buf->add($data->caretSlopeRun);
		format_ttf_Tools::$buf->add("\x0AmetricDataFormat: ");
		format_ttf_Tools::$buf->add($data->metricDataFormat);
		format_ttf_Tools::$buf->add("\x0AnumberOfHMetrics: ");
		format_ttf_Tools::$buf->add($data->numberOfHMetrics);
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTHead($data) {
		format_ttf_Tools::$buf->add("\x0A================================= head table =================================\x0A");
		format_ttf_Tools::$buf->add("version: ");
		format_ttf_Tools::$buf->add($data->version);
		format_ttf_Tools::$buf->add("\x0AfontRevision : ");
		format_ttf_Tools::$buf->add($data->fontRevision);
		format_ttf_Tools::$buf->add("\x0AcheckSumAdjustment :");
		format_ttf_Tools::$buf->add($data->checkSumAdjustment);
		format_ttf_Tools::$buf->add("\x0AmagicNumber:");
		format_ttf_Tools::$buf->add($data->magicNumber);
		format_ttf_Tools::$buf->add("\x0Aflags:");
		format_ttf_Tools::$buf->add($data->flags);
		format_ttf_Tools::$buf->add("\x0AunitsPerEm: ");
		format_ttf_Tools::$buf->add($data->unitsPerEm);
		format_ttf_Tools::$buf->add("\x0Acreated:");
		format_ttf_Tools::$buf->add($data->created);
		format_ttf_Tools::$buf->add("\x0Amodified:");
		format_ttf_Tools::$buf->add($data->modified);
		format_ttf_Tools::$buf->add("\x0AxMin: ");
		format_ttf_Tools::$buf->add($data->xMin);
		format_ttf_Tools::$buf->add("\x0AyMin: ");
		format_ttf_Tools::$buf->add($data->yMin);
		format_ttf_Tools::$buf->add("\x0AxMax: ");
		format_ttf_Tools::$buf->add($data->xMax);
		format_ttf_Tools::$buf->add("\x0AyMax: ");
		format_ttf_Tools::$buf->add($data->yMax);
		format_ttf_Tools::$buf->add("\x0AmacStyle: ");
		format_ttf_Tools::$buf->add($data->indexToLocFormat);
		format_ttf_Tools::$buf->add("\x0AlowestRecPPEM:");
		format_ttf_Tools::$buf->add($data->lowestRecPPEM);
		format_ttf_Tools::$buf->add("\x0AfontDirectionHint: ");
		format_ttf_Tools::$buf->add($data->fontDirectionHint);
		format_ttf_Tools::$buf->add("\x0AindexToLocFormat: ");
		format_ttf_Tools::$buf->add($data->indexToLocFormat);
		format_ttf_Tools::$buf->add("\x0AglyphDataFormat: ");
		format_ttf_Tools::$buf->add($data->glyphDataFormat);
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTMaxp($data) {
		format_ttf_Tools::$buf->add("\x0A================================= maxp table =================================\x0A");
		format_ttf_Tools::$buf->add("versionNumber:");
		format_ttf_Tools::$buf->add($data->versionNumber);
		format_ttf_Tools::$buf->add("\x0AnumGlyphs:");
		format_ttf_Tools::$buf->add($data->numGlyphs);
		format_ttf_Tools::$buf->add("\x0AmaxPoints:");
		format_ttf_Tools::$buf->add($data->maxPoints);
		format_ttf_Tools::$buf->add("\x0AmaxContours:");
		format_ttf_Tools::$buf->add($data->maxContours);
		format_ttf_Tools::$buf->add("\x0AmaxComponentPoints:");
		format_ttf_Tools::$buf->add($data->maxComponentPoints);
		format_ttf_Tools::$buf->add("\x0AmaxComponentContours:");
		format_ttf_Tools::$buf->add($data->maxComponentContours);
		format_ttf_Tools::$buf->add("\x0AmaxZones:");
		format_ttf_Tools::$buf->add($data->maxZones);
		format_ttf_Tools::$buf->add("\x0AmaxTwilightPoints:");
		format_ttf_Tools::$buf->add($data->maxTwilightPoints);
		format_ttf_Tools::$buf->add("\x0AmaxStorage:");
		format_ttf_Tools::$buf->add($data->maxStorage);
		format_ttf_Tools::$buf->add("\x0AmaxFunctionDefs:");
		format_ttf_Tools::$buf->add($data->maxFunctionDefs);
		format_ttf_Tools::$buf->add("\x0AmaxInstructionDefs:");
		format_ttf_Tools::$buf->add($data->maxInstructionDefs);
		format_ttf_Tools::$buf->add("\x0AmaxStackElements:");
		format_ttf_Tools::$buf->add($data->maxStackElements);
		format_ttf_Tools::$buf->add("\x0AmaxSizeOfInstructions:");
		format_ttf_Tools::$buf->add($data->maxSizeOfInstructions);
		format_ttf_Tools::$buf->add("\x0AmaxComponentElements:");
		format_ttf_Tools::$buf->add($data->maxComponentElements);
		format_ttf_Tools::$buf->add("\x0AmaxComponentDepth:");
		format_ttf_Tools::$buf->add($data->maxComponentDepth);
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTLoca($data) {
		format_ttf_Tools::$buf->add("\x0A================================= loca table =================================\x0A");
		format_ttf_Tools::$buf->add("factor: ");
		format_ttf_Tools::$buf->add($data->factor);
		format_ttf_Tools::$buf->add("\x0A");
		{
			$_g1 = 0; $_g = $data->offsets->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(format_ttf_Tools::$limit !== -1 && $i > format_ttf_Tools::$limit) {
					break;
				}
				format_ttf_Tools::$buf->add("offsets[");
				format_ttf_Tools::$buf->add($i);
				format_ttf_Tools::$buf->add("]: ");
				format_ttf_Tools::$buf->add($data->offsets[$i]);
				format_ttf_Tools::$buf->add("\x0A");
				unset($i);
			}
		}
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTOS2($data) {
		format_ttf_Tools::$buf->add("\x0A================================= os/2 table =================================\x0A");
		format_ttf_Tools::$buf->add("version: ");
		format_ttf_Tools::$buf->add($data->version);
		format_ttf_Tools::$buf->add("\x0AxAvgCharWidth : ");
		format_ttf_Tools::$buf->add($data->xAvgCharWidth);
		format_ttf_Tools::$buf->add("\x0AusWeightClass : ");
		format_ttf_Tools::$buf->add($data->usWeightClass);
		format_ttf_Tools::$buf->add("\x0AusWidthClass : ");
		format_ttf_Tools::$buf->add($data->usWidthClass);
		format_ttf_Tools::$buf->add("\x0AfsType : ");
		format_ttf_Tools::$buf->add($data->fsType);
		format_ttf_Tools::$buf->add("\x0AySubscriptXSize : ");
		format_ttf_Tools::$buf->add($data->ySubscriptXSize);
		format_ttf_Tools::$buf->add("\x0AySubscriptYSize : ");
		format_ttf_Tools::$buf->add($data->ySubscriptYSize);
		format_ttf_Tools::$buf->add("\x0AySubscriptXOffset : ");
		format_ttf_Tools::$buf->add($data->ySubscriptXOffset);
		format_ttf_Tools::$buf->add("\x0AySubscriptYOffset : ");
		format_ttf_Tools::$buf->add($data->ySubscriptYOffset);
		format_ttf_Tools::$buf->add("\x0AySuperscriptXSize : ");
		format_ttf_Tools::$buf->add($data->ySuperscriptXSize);
		format_ttf_Tools::$buf->add("\x0AySuperscriptYSize : ");
		format_ttf_Tools::$buf->add($data->ySuperscriptYSize);
		format_ttf_Tools::$buf->add("\x0AySuperscriptXOffset : ");
		format_ttf_Tools::$buf->add($data->ySuperscriptXOffset);
		format_ttf_Tools::$buf->add("\x0AySuperscriptYOffset : ");
		format_ttf_Tools::$buf->add($data->ySuperscriptYOffset);
		format_ttf_Tools::$buf->add("\x0AyStrikeoutSize : ");
		format_ttf_Tools::$buf->add($data->yStrikeoutSize);
		format_ttf_Tools::$buf->add("\x0AyStrikeoutPosition : ");
		format_ttf_Tools::$buf->add($data->yStrikeoutPosition);
		format_ttf_Tools::$buf->add("\x0AsFamilyClass : ");
		format_ttf_Tools::$buf->add($data->sFamilyClass);
		format_ttf_Tools::$buf->add("\x0AbFamilyType : ");
		format_ttf_Tools::$buf->add($data->bFamilyType);
		format_ttf_Tools::$buf->add("\x0AbSerifStyle : ");
		format_ttf_Tools::$buf->add($data->bSerifStyle);
		format_ttf_Tools::$buf->add("\x0AbWeight : ");
		format_ttf_Tools::$buf->add($data->bWeight);
		format_ttf_Tools::$buf->add("\x0AbProportion : ");
		format_ttf_Tools::$buf->add($data->bProportion);
		format_ttf_Tools::$buf->add("\x0AbContrast : ");
		format_ttf_Tools::$buf->add($data->bContrast);
		format_ttf_Tools::$buf->add("\x0AbStrokeVariation : ");
		format_ttf_Tools::$buf->add($data->bStrokeVariation);
		format_ttf_Tools::$buf->add("\x0AbArmStyle : ");
		format_ttf_Tools::$buf->add($data->bArmStyle);
		format_ttf_Tools::$buf->add("\x0AbLetterform : ");
		format_ttf_Tools::$buf->add($data->bLetterform);
		format_ttf_Tools::$buf->add("\x0AbMidline : ");
		format_ttf_Tools::$buf->add($data->bMidline);
		format_ttf_Tools::$buf->add("\x0AbXHeight : ");
		format_ttf_Tools::$buf->add($data->bXHeight);
		format_ttf_Tools::$buf->add("\x0AulUnicodeRange1 : ");
		format_ttf_Tools::$buf->add($data->ulUnicodeRange1);
		format_ttf_Tools::$buf->add("\x0AulUnicodeRange2 : ");
		format_ttf_Tools::$buf->add($data->ulUnicodeRange2);
		format_ttf_Tools::$buf->add("\x0AulUnicodeRange3 : ");
		format_ttf_Tools::$buf->add($data->ulUnicodeRange3);
		format_ttf_Tools::$buf->add("\x0AulUnicodeRange4 : ");
		format_ttf_Tools::$buf->add($data->ulUnicodeRange4);
		format_ttf_Tools::$buf->add("\x0AachVendorID : ");
		format_ttf_Tools::$buf->add($data->achVendorID);
		format_ttf_Tools::$buf->add("\x0AfsSelection : ");
		format_ttf_Tools::$buf->add($data->fsSelection);
		format_ttf_Tools::$buf->add("\x0AusFirstCharIndex : ");
		format_ttf_Tools::$buf->add($data->usFirstCharIndex);
		format_ttf_Tools::$buf->add("\x0AusLastCharIndex : ");
		format_ttf_Tools::$buf->add($data->usLastCharIndex);
		format_ttf_Tools::$buf->add("\x0AsTypoAscender : ");
		format_ttf_Tools::$buf->add($data->sTypoAscender);
		format_ttf_Tools::$buf->add("\x0AsTypoDescender : ");
		format_ttf_Tools::$buf->add($data->sTypoDescender);
		format_ttf_Tools::$buf->add("\x0AsTypoLineGap : ");
		format_ttf_Tools::$buf->add($data->sTypoLineGap);
		format_ttf_Tools::$buf->add("\x0AusWinAscent : ");
		format_ttf_Tools::$buf->add($data->usWinAscent);
		format_ttf_Tools::$buf->add("\x0AusWinDescent : ");
		format_ttf_Tools::$buf->add($data->usWinDescent);
		return format_ttf_Tools::$buf->b;
	}
	static function dumpTUnk($bytes) {
		return "\x0A================================= unknown table =================================\x0A";
	}
	static function dumpComponent($comp, $glyphIndex, $flags, $glyphIdx) {
		haxe_Log::trace("composite glyphIndex : " . _hx_string_rec($glyphIndex, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 345, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("flags : " . _hx_string_rec($flags, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 346, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("glyphIdx : " . _hx_string_rec($glyphIdx, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 347, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		if(($flags & 1) !== 0) {
			haxe_Log::trace("ARG_1_AND_2_ARE_WORDS", _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 348, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		}
		if(($flags & 2) !== 0) {
			haxe_Log::trace("ARGS_ARE_XY_VALUES", _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 349, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		}
		if(($flags & 4) !== 0) {
			haxe_Log::trace("ROUND_XY_TO_GRID", _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 350, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		}
		if(($flags & 8) !== 0) {
			haxe_Log::trace("WE_HAVE_A_SCALE", _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 351, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		}
		if(($flags & 32) !== 0) {
			haxe_Log::trace("MORE_COMPONENTS", _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 352, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		}
		if(($flags & 64) !== 0) {
			haxe_Log::trace("WE_HAVE_AN_X_AND_Y_SCALE", _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 353, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		}
		if(($flags & 128) !== 0) {
			haxe_Log::trace("WE_HAVE_A_TWO_BY_TWO", _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 354, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		}
		if(($flags & 256) !== 0) {
			haxe_Log::trace("WE_HAVE_INSTRUCTIONS", _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 355, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		}
		if(($flags & 512) !== 0) {
			haxe_Log::trace("USE_MY_METRICS", _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 356, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		}
		haxe_Log::trace("flags:" . _hx_string_rec($comp->flags, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 357, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("glyphIndex:" . _hx_string_rec($comp->glyphIndex, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 358, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("xtranslate:" . _hx_string_rec($comp->xtranslate, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 359, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("ytranslate:" . _hx_string_rec($comp->ytranslate, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 360, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("xscale:" . _hx_string_rec($comp->xscale, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 361, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("yscale:" . _hx_string_rec($comp->yscale, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 362, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("scale01 :" . _hx_string_rec($comp->scale01, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 363, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("scale10 :" . _hx_string_rec($comp->scale10, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 364, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("point1 :" . _hx_string_rec($comp->point1, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 365, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("point2 :" . _hx_string_rec($comp->point2, ""), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 366, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
		haxe_Log::trace("instructions:" . Std::string($comp->instructions), _hx_anonymous(array("fileName" => "Tools.hx", "lineNumber" => 367, "className" => "format.ttf.Tools", "methodName" => "dumpComponent")));
	}
	function __toString() { return 'format.ttf.Tools'; }
}
function format_ttf_Tools_0(&$lim, &$table) {
	$__hx__t = ($table);
	switch($__hx__t->index) {
	case 1:
	$metrics = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTHmtx($metrics);
	}break;
	case 2:
	$subtables = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTCmap($subtables);
	}break;
	case 0:
	$descriptions = $__hx__t->params[0];
	{
		return format_ttf_Tools::dympTGlyf($descriptions);
	}break;
	case 3:
	$kerning = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTKern($kerning);
	}break;
	case 4:
	$records = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTName($records);
	}break;
	case 9:
	$data = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTPost($data);
	}break;
	case 6:
	$data = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTHhea($data);
	}break;
	case 5:
	$data = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTHead($data);
	}break;
	case 8:
	$data = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTMaxp($data);
	}break;
	case 7:
	$data = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTLoca($data);
	}break;
	case 10:
	$data = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTOS2($data);
	}break;
	case 11:
	$bytes = $__hx__t->params[0];
	{
		return format_ttf_Tools::dumpTUnk($bytes);
	}break;
	}
}
function format_ttf_Tools_1(&$_g, &$_g1, &$header, &$i, &$platformId, &$platformSpecificId, &$subtable, &$subtables) {
	switch($platformSpecificId) {
	case 0:{
		return _hx_array_get(Type::getEnumConstructs(_hx_qtype("format.ttf.LangUnicode")), $platformSpecificId);
	}break;
	case 1:{
		return _hx_array_get(Type::getEnumConstructs(_hx_qtype("format.ttf.LangMacintosh")), $platformSpecificId);
	}break;
	case 3:{
		return _hx_array_get(Type::getEnumConstructs(_hx_qtype("format.ttf.LangMicrosoft")), $platformSpecificId);
	}break;
	}
}
