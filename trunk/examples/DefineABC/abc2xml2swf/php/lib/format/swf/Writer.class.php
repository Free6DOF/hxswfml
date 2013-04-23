<?php

class format_swf_Writer {
	public function __construct($o) {
		if(!php_Boot::$skip_constructor) {
		$this->output = $o;
	}}
	public function writeEnd() {
		$this->o->writeUInt16(0);
		$bytes = $this->o->getBytes();
		$size = $bytes->length;
		if($this->compressed) {
			$bytes = format_tools_Deflate::run($bytes);
		}
		$this->output->writeInt32($size + 8);
		$this->output->write($bytes);
	}
	public function writeTag($t) {
		$__hx__t = ($t);
		switch($__hx__t->index) {
		case 35:
		$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			if($id === null) {
				$this->o->write($data);
			} else {
				$this->writeTID($id, $data->length);
				$this->o->write($data);
			}
		}break;
		case 0:
		{
			$this->writeTID(1, 0);
		}break;
		case 1:
		{
			$this->writeTID(0, 0);
		}break;
		case 2:
		$sdata = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->writeShape($id, $sdata);
		}break;
		case 3:
		$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->writeMorphShape($id, $data);
		}break;
		case 4:
		$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->writeFont($id, $data);
		}break;
		case 5:
		$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->writeFontInfo($id, $data);
		}break;
		case 22:
		$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->writeTID(87, $data->length + 6);
			$this->o->writeUInt16($id);
			$this->o->writeInt32(0);
			$this->o->write($data);
		}break;
		case 6:
		$color = $__hx__t->params[0];
		{
			$this->writeTID(9, 3);
			$this->o->set_bigEndian(true);
			$this->o->writeUInt24($color);
			$this->o->set_bigEndian(false);
		}break;
		case 8:
		$po = $__hx__t->params[0];
		{
			$t1 = $this->openTMP();
			$this->writePlaceObject($po, false);
			$bytes = $this->closeTMP($t1);
			$this->writeTID(26, $bytes->length);
			$this->o->write($bytes);
		}break;
		case 9:
		$po = $__hx__t->params[0];
		{
			$t1 = $this->openTMP();
			$this->writePlaceObject($po, true);
			$bytes = $this->closeTMP($t1);
			$this->writeTIDExt(70, $bytes->length);
			$this->o->write($bytes);
		}break;
		case 10:
		$depth = $__hx__t->params[0];
		{
			$this->writeTID(28, 2);
			$this->o->writeUInt16($depth);
		}break;
		case 11:
		$anchor = $__hx__t->params[1]; $label = $__hx__t->params[0];
		{
			$length = strlen($label) + 1 + ((($anchor) ? 1 : 0));
			$this->writeTIDExt(43, $length);
			$this->o->writeString($label);
			$this->o->writeByte(0);
			if($anchor) {
				$this->o->writeByte(1);
			}
		}break;
		case 7:
		$tags = $__hx__t->params[2]; $frames = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$t1 = $this->openTMP();
			{
				$_g = 0;
				while($_g < $tags->length) {
					$t2 = $tags[$_g];
					++$_g;
					$this->writeTag($t2);
					unset($t2);
				}
			}
			$bytes = $this->closeTMP($t1);
			$this->writeTIDExt(39, $bytes->length + 6);
			$this->o->writeUInt16($id);
			$this->o->writeUInt16($frames);
			$this->o->write($bytes);
			$this->o->writeUInt16(0);
		}break;
		case 12:
		$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->writeTID(59, $data->length + 2);
			$this->o->writeUInt16($id);
			$this->o->write($data);
		}break;
		case 13:
		$ctx = $__hx__t->params[1]; $data = $__hx__t->params[0];
		{
			if($ctx === null) {
				$this->writeTID(72, $data->length);
			} else {
				$len = $data->length + 4 + strlen($ctx->label) + 1;
				$this->writeTID(82, $len);
				$this->o->writeInt32($ctx->id);
				$this->o->writeString($ctx->label);
				$this->o->writeByte(0);
			}
			$this->o->write($data);
		}break;
		case 14:
		$sl = $__hx__t->params[0];
		{
			$this->writeSymbols($sl, 76);
		}break;
		case 15:
		$url = $__hx__t->params[0];
		{
			$t1 = $this->openTMP();
			$this->writeImportAssets2($url);
			$bytes = $this->closeTMP($t1);
			$this->writeTIDExt(71, $bytes->length);
			$this->o->write($bytes);
		}break;
		case 16:
		$sl = $__hx__t->params[0];
		{
			$this->writeSymbols($sl, 56);
		}break;
		case 17:
		$v = $__hx__t->params[0];
		{
			$this->writeTID(69, 4);
			$this->writeFileAttributes($v);
		}break;
		case 18:
		$l = $__hx__t->params[0];
		{
			$cbits = format_swf_Writer_0($this, $l, $t);
			$this->writeTIDExt(20, $l->data->length + ((($cbits !== null) ? 8 : 7)));
			$this->o->writeUInt16($l->cid);
			$__hx__t2 = ($l->color);
			switch($__hx__t2->index) {
			case 0:
			{
				$this->o->writeByte(3);
			}break;
			case 1:
			{
				$this->o->writeByte(4);
			}break;
			case 2:
			{
				$this->o->writeByte(5);
			}break;
			default:{
				throw new HException("assert");
			}break;
			}
			$this->o->writeUInt16($l->width);
			$this->o->writeUInt16($l->height);
			if($cbits !== null) {
				$this->o->writeByte($cbits);
			}
			$this->o->write($l->data);
		}break;
		case 19:
		$l = $__hx__t->params[0];
		{
			$cbits = format_swf_Writer_1($this, $l, $t);
			$this->writeTIDExt(36, $l->data->length + ((($cbits !== null) ? 8 : 7)));
			$this->o->writeUInt16($l->cid);
			$__hx__t2 = ($l->color);
			switch($__hx__t2->index) {
			case 0:
			{
				$this->o->writeByte(3);
			}break;
			case 1:
			{
				$this->o->writeByte(4);
			}break;
			case 3:
			{
				$this->o->writeByte(5);
			}break;
			default:{
				throw new HException("assert");
			}break;
			}
			$this->o->writeUInt16($l->width);
			$this->o->writeUInt16($l->height);
			if($cbits !== null) {
				$this->o->writeByte($cbits);
			}
			$this->o->write($l->data);
		}break;
		case 21:
		$data = $__hx__t->params[0];
		{
			$this->writeTIDExt(8, $data->length);
			$this->o->write($data);
		}break;
		case 20:
		$jdata = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$__hx__t2 = ($jdata);
			switch($__hx__t2->index) {
			case 0:
			$data = $__hx__t2->params[0];
			{
				$this->writeTIDExt(6, $data->length + 2);
				$this->o->writeUInt16($id);
				$this->o->write($data);
			}break;
			case 1:
			$data = $__hx__t2->params[0];
			{
				$this->writeTIDExt(21, $data->length + 2);
				$this->o->writeUInt16($id);
				$this->o->write($data);
			}break;
			case 2:
			$mask = $__hx__t2->params[1]; $data = $__hx__t2->params[0];
			{
				$this->writeTIDExt(35, $data->length + $mask->length + 6);
				$this->o->writeUInt16($id);
				$this->o->writeInt32($data->length);
				$this->o->write($data);
				$this->o->write($mask);
			}break;
			}
		}break;
		case 23:
		$data = $__hx__t->params[0];
		{
			$this->writeSound($data);
		}break;
		case 28:
		$soundInfo = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			if($soundInfo->hasLoops) {
				$this->writeTID(15, 5);
			} else {
				$this->writeTID(15, 3);
			}
			$this->o->writeUInt16($id);
			$this->writeSoundInfo($soundInfo);
		}break;
		case 29:
		$data = $__hx__t->params[0];
		{
			$this->writeTID(12, $data->length);
			$this->o->write($data);
		}break;
		case 30:
		$timeoutseconds = $__hx__t->params[1]; $maxRecursion = $__hx__t->params[0];
		{
			$this->writeTID(65, 4);
			$this->o->writeUInt16($maxRecursion);
			$this->o->writeUInt16($timeoutseconds);
		}break;
		case 31:
		$buttonRecords = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$t1 = $this->openTMP();
			{
				$_g = 0;
				while($_g < $buttonRecords->length) {
					$t2 = $buttonRecords[$_g];
					++$_g;
					$this->writeButtonRecord($t2);
					unset($t2);
				}
			}
			$bytes = $this->closeTMP($t1);
			$this->writeTID(34, $bytes->length + 6);
			$this->o->writeUInt16($id);
			$this->o->writeByte(0);
			$this->o->writeUInt16(0);
			$this->o->write($bytes);
			$this->o->writeByte(0);
		}break;
		case 32:
		$data = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$t1 = $this->openTMP();
			$this->writeDefineEditText($data);
			$bytes = $this->closeTMP($t1);
			$this->writeTID(37, $bytes->length + 2);
			$this->o->writeUInt16($id);
			$this->o->write($bytes);
		}break;
		case 33:
		$data = $__hx__t->params[0];
		{
			$this->writeTID(77, strlen($data) + 1);
			$this->o->writeString($data);
			$this->o->writeByte(0);
		}break;
		case 34:
		$splitter = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$t1 = $this->openTMP();
			$this->writeRect($splitter);
			$bytes = $this->closeTMP($t1);
			$this->writeTID(78, $bytes->length + 2);
			$this->o->writeUInt16($id);
			$this->o->write($bytes);
		}break;
		case 26:
		$videoData = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->writeTID(60, 10);
			$this->o->writeUInt16($id);
			$this->o->writeUInt16($videoData->numFrames);
			$this->o->writeUInt16($videoData->width);
			$this->o->writeUInt16($videoData->height);
			$this->bits->writeBits(4, 0);
			$this->bits->writeBits(3, 0);
			$this->bits->writeBit($videoData->smoothing);
			$this->o->writeByte($videoData->codecId);
		}break;
		case 27:
		$data = $__hx__t->params[2]; $frameNum = $__hx__t->params[1]; $id = $__hx__t->params[0];
		{
			$this->writeTID(61, 4 + $data->length);
			$this->o->writeUInt16($id);
			$this->o->writeUInt16($frameNum);
			$this->o->write($data);
		}break;
		case 25:
		$data = $__hx__t->params[0];
		{
			$this->writeTID(45, (($data->streamSoundCompression === 2) ? 6 : 4));
			$this->bits->writeBits(4, 0);
			$this->bits->writeBits(2, $data->playbackSoundRate);
			$this->bits->writeBit(true);
			$this->bits->writeBit($data->playbackSoundType);
			$this->bits->writeBits(4, $data->streamSoundCompression);
			$this->bits->writeBits(2, $data->streamSoundRate);
			$this->bits->writeBit(true);
			$this->bits->writeBit($data->streamSoundType);
			$this->o->writeUInt16($data->streamSoundSampleCount);
			if($data->streamSoundCompression === 2) {
				$this->o->writeInt16($data->latencySeek);
			}
		}break;
		case 24:
		$data = $__hx__t->params[2]; $seekSamples = $__hx__t->params[1]; $samplesCount = $__hx__t->params[0];
		{
			$this->writeTID(19, 4 + $data->length);
			$this->o->writeUInt16($samplesCount);
			$this->o->writeInt16($seekSamples);
			$this->o->write($data);
		}break;
		}
	}
	public function writeImportAssets2($url) {
		$this->o->writeString($url);
		$this->o->writeByte(0);
		$this->o->writeByte(1);
		$this->o->writeByte(0);
		$count = 0;
		$this->o->writeUInt16($count);
		{
			$_g = 0;
			while($_g < $count) {
				$i = $_g++;
				unset($i);
			}
		}
	}
	public function writeDefineEditText($data) {
		$this->writeRect($data->bounds);
		$this->bits->writeBit($data->hasText);
		$this->bits->writeBit($data->wordWrap);
		$this->bits->writeBit($data->multiline);
		$this->bits->writeBit($data->password);
		$this->bits->writeBit($data->input);
		$this->bits->writeBit($data->hasTextColor);
		$this->bits->writeBit($data->hasMaxLength);
		$this->bits->writeBit($data->hasFont);
		$this->bits->writeBit($data->hasFontClass);
		$this->bits->writeBit($data->autoSize);
		$this->bits->writeBit($data->hasLayout);
		$this->bits->writeBit($data->selectable);
		$this->bits->writeBit($data->border);
		$this->bits->writeBit($data->wasStatic);
		$this->bits->writeBit($data->html);
		$this->bits->writeBit($data->useOutlines);
		if($data->hasFont) {
			$this->o->writeUInt16($data->fontID);
			$this->o->writeUInt16($data->fontHeight);
		} else {
			if($data->hasFontClass) {
				$this->o->writeString($data->fontClass);
				$this->o->writeByte(0);
			}
		}
		if($data->hasTextColor) {
			$this->writeRGBA($data->textColor);
		}
		if($data->hasMaxLength) {
			$this->o->writeUInt16($data->maxLength);
		}
		if($data->hasLayout) {
			$this->o->writeByte($data->align);
			$this->o->writeUInt16($data->leftMargin);
			$this->o->writeUInt16($data->rightMargin);
			$this->o->writeUInt16($data->indent);
			$this->o->writeInt16($data->leading);
		}
		$this->o->writeString($data->variableName);
		$this->o->writeByte(0);
		if($data->hasText) {
			$this->o->writeString($data->initialText);
			$this->o->writeByte(0);
		}
	}
	public function writeButtonRecord($btnRec) {
		$this->bits->writeBits(4, 0);
		$this->bits->writeBit($btnRec->hit);
		$this->bits->writeBit($btnRec->down);
		$this->bits->writeBit($btnRec->over);
		$this->bits->writeBit($btnRec->up);
		$this->o->writeUInt16($btnRec->id);
		$this->o->writeUInt16($btnRec->depth);
		$this->writeMatrix($btnRec->matrix);
		$this->o->writeByte(0);
	}
	public function writeFileAttributes($att) {
		$this->bits->writeBit(false);
		$this->bits->writeBit($att->useDirectBlit);
		$this->bits->writeBit($att->useGPU);
		$this->bits->writeBit($att->hasMetaData);
		$this->bits->writeBit($att->actionscript3);
		$this->bits->writeBits(2, 0);
		$this->bits->writeBit($att->useNetWork);
		$this->bits->writeBits(24, 0);
	}
	public function writeEnvelopeRecords($soundEnvelopes) {
		$_g1 = 0; $_g = $soundEnvelopes->length;
		while($_g1 < $_g) {
			$env = $_g1++;
			$this->o->writeInt32(_hx_array_get($soundEnvelopes, $env)->pos44);
			$this->o->writeUInt16(_hx_array_get($soundEnvelopes, $env)->leftLevel);
			$this->o->writeUInt16(_hx_array_get($soundEnvelopes, $env)->rightLevel);
			unset($env);
		}
	}
	public function writeSoundInfo($info) {
		$this->bits->writeBits(2, 0);
		$this->bits->writeBit($info->syncStop);
		$this->bits->writeBit(false);
		$this->bits->writeBit(false);
		$this->bits->writeBit($info->hasLoops);
		$this->bits->writeBit(false);
		$this->bits->writeBit(false);
		if($info->hasLoops) {
			$this->o->writeUInt16($info->loopCount);
		}
	}
	public function writeFontInfo($id, $data) {
		$__hx__t = ($data);
		switch($__hx__t->index) {
		case 0:
		$data1 = $__hx__t->params[3]; $hasWideCodes = $__hx__t->params[2]; $isANSI = $__hx__t->params[1]; $shiftJIS = $__hx__t->params[0];
		{
			$data_length = format_swf_Writer_2($this, $data, $data1, $hasWideCodes, $id, $isANSI, $shiftJIS);
			$this->writeTID(13, $data_length);
			$this->o->writeUInt16($id);
			$this->o->writeByte(strlen($data1->name));
			$this->o->writeString($data1->name);
			$this->bits->writeBits(2, 0);
			$this->bits->writeBit($data1->isSmall);
			$this->bits->writeBit($shiftJIS);
			$this->bits->writeBit($isANSI);
			$this->bits->writeBit($data1->isItalic);
			$this->bits->writeBit($data1->isBold);
			$this->bits->writeBit($hasWideCodes);
			if($hasWideCodes) {
				$_g = 0; $_g1 = $data1->codeTable;
				while($_g < $_g1->length) {
					$code = $_g1[$_g];
					++$_g;
					$this->o->writeUInt16($code);
					unset($code);
				}
			} else {
				$_g = 0; $_g1 = $data1->codeTable;
				while($_g < $_g1->length) {
					$code = $_g1[$_g];
					++$_g;
					$this->o->writeByte($code);
					unset($code);
				}
			}
		}break;
		case 1:
		$data1 = $__hx__t->params[1]; $language = $__hx__t->params[0];
		{
			$this->writeTID(13, 5 + strlen($data1->name) + $data1->codeTable->length * 2);
			$this->o->writeUInt16($id);
			$this->o->writeByte(strlen($data1->name));
			$this->o->writeString($data1->name);
			$this->bits->writeBits(2, 0);
			$this->bits->writeBit($data1->isSmall);
			$this->bits->writeBit(false);
			$this->bits->writeBit(false);
			$this->bits->writeBit($data1->isItalic);
			$this->bits->writeBit($data1->isBold);
			$this->bits->writeBit(true);
			$this->o->writeByte(format_swf_Writer_3($this, $data, $data1, $id, $language));
			{
				$_g = 0; $_g1 = $data1->codeTable;
				while($_g < $_g1->length) {
					$code = $_g1[$_g];
					++$_g;
					$this->o->writeUInt16($code);
					unset($code);
				}
			}
		}break;
		}
	}
	public function writeFont($id, $data) {
		$old = $this->openTMP();
		$this->o->writeUInt16($id);
		$__hx__t = ($data);
		switch($__hx__t->index) {
		case 0:
		$data1 = $__hx__t->params[0];
		{
			$this->writeFont1($data1);
		}break;
		case 1:
		$data1 = $__hx__t->params[1]; $hasWideChars = $__hx__t->params[0];
		{
			$this->writeFont2($hasWideChars, $data1);
		}break;
		case 2:
		$data1 = $__hx__t->params[0];
		{
			$this->writeFont2(true, $data1);
		}break;
		case 3:
		$data1 = $__hx__t->params[0];
		{
			$this->writeFont4($data1);
		}break;
		}
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		$font_data = $this->closeTMP($old);
		$__hx__t = ($data);
		switch($__hx__t->index) {
		case 0:
		$data1 = $__hx__t->params[0];
		{
			$this->writeTID(10, $font_data->length);
		}break;
		case 1:
		$data1 = $__hx__t->params[1]; $hasWideChars = $__hx__t->params[0];
		{
			$this->writeTID(48, $font_data->length);
		}break;
		case 2:
		$data1 = $__hx__t->params[0];
		{
			$this->writeTID(75, $font_data->length);
		}break;
		case 3:
		$data1 = $__hx__t->params[0];
		{
			$this->writeTID(91, $font_data->length);
		}break;
		}
		$this->o->write($font_data);
	}
	public function writeFont2($hasWideChars, $data) {
		$glyphs = new _hx_array(array());
		$num_glyphs = $data->glyphs->length;
		{
			$_g = 0; $_g1 = $data->glyphs;
			while($_g < $_g1->length) {
				$glyph = $_g1[$_g];
				++$_g;
				$glyphs->push($glyph->shape);
				unset($glyph);
			}
		}
		$old = $this->openTMP();
		$offset_table = $this->writeFontGlyphs($glyphs);
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		$shape_data = $this->closeTMP($old);
		$hasWideOffsets = $offset_table->length * 2 + 2 + $shape_data->length > 65535;
		$this->bits->writeBit(_hx_field($data, "layout") !== null);
		$this->bits->writeBit($data->shiftJIS);
		$this->bits->writeBit($data->isSmall);
		$this->bits->writeBit($data->isANSI);
		$this->bits->writeBit($hasWideOffsets);
		$this->bits->writeBit($hasWideChars);
		$this->bits->writeBit($data->isItalic);
		$this->bits->writeBit($data->isBold);
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		$this->o->writeByte(format_swf_Writer_4($this, $data, $glyphs, $hasWideChars, $hasWideOffsets, $num_glyphs, $offset_table, $old, $shape_data));
		$this->o->writeByte(strlen($data->name));
		$this->o->writeString($data->name);
		$this->o->writeUInt16($num_glyphs);
		if($hasWideOffsets) {
			$first_glyph_offset = $num_glyphs * 4 + 4;
			{
				$_g = 0;
				while($_g < $offset_table->length) {
					$offset = $offset_table[$_g];
					++$_g;
					$this->o->writeInt32($first_glyph_offset + $offset);
					unset($offset);
				}
			}
			$this->o->writeInt32($first_glyph_offset + $shape_data->length);
		} else {
			$first_glyph_offset = $num_glyphs * 2 + 2;
			{
				$_g = 0;
				while($_g < $offset_table->length) {
					$offset = $offset_table[$_g];
					++$_g;
					$this->o->writeUInt16($first_glyph_offset + $offset);
					unset($offset);
				}
			}
			$this->o->writeUInt16($first_glyph_offset + $shape_data->length);
		}
		$this->o->write($shape_data);
		if($hasWideChars) {
			$_g = 0; $_g1 = $data->glyphs;
			while($_g < $_g1->length) {
				$glyph = $_g1[$_g];
				++$_g;
				$this->o->writeUInt16($glyph->charCode);
				unset($glyph);
			}
		} else {
			$_g = 0; $_g1 = $data->glyphs;
			while($_g < $_g1->length) {
				$glyph = $_g1[$_g];
				++$_g;
				$this->o->writeByte($glyph->charCode);
				unset($glyph);
			}
		}
		if(_hx_field($data, "layout") !== null) {
			$this->o->writeInt16($data->layout->ascent);
			$this->o->writeInt16($data->layout->descent);
			$this->o->writeInt16($data->layout->leading);
			{
				$_g = 0; $_g1 = $data->layout->glyphs;
				while($_g < $_g1->length) {
					$g = $_g1[$_g];
					++$_g;
					$this->o->writeUInt16($g->advance);
					unset($g);
				}
			}
			{
				$_g = 0; $_g1 = $data->layout->glyphs;
				while($_g < $_g1->length) {
					$g = $_g1[$_g];
					++$_g;
					$this->writeRect($g->bounds);
					unset($g);
				}
			}
			$this->o->writeUInt16($data->layout->kerning->length);
			if($hasWideChars) {
				$_g = 0; $_g1 = $data->layout->kerning;
				while($_g < $_g1->length) {
					$k = $_g1[$_g];
					++$_g;
					$this->o->writeUInt16($k->charCode1);
					$this->o->writeUInt16($k->charCode2);
					$this->o->writeInt16($k->adjust);
					unset($k);
				}
			} else {
				$_g = 0; $_g1 = $data->layout->kerning;
				while($_g < $_g1->length) {
					$k = $_g1[$_g];
					++$_g;
					$this->o->writeByte($k->charCode1);
					$this->o->writeByte($k->charCode2);
					$this->o->writeInt16($k->adjust);
					unset($k);
				}
			}
		}
	}
	public function writeFont4($data) {
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		$this->bits->writeBits(5, 0);
		$this->bits->writeBit($data->hasSFNT);
		$this->bits->writeBit($data->isItalic);
		$this->bits->writeBit($data->isBold);
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		$this->o->writeString($data->name);
		$this->o->writeByte(0);
		$this->o->write($data->bytes);
	}
	public function writeFont1($data) {
		$old = $this->openTMP();
		$offset_table = $this->writeFontGlyphs($data->glyphs);
		if($offset_table->length * 2 + $offset_table[$offset_table->length - 1] > 65535) {
			throw new HException("Font version 1 only supports font sizes up to 64kB!");
		}
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		$shape_data = $this->closeTMP($old);
		$first_glyph_offset = $offset_table->length * 2;
		{
			$_g = 0;
			while($_g < $offset_table->length) {
				$offset = $offset_table[$_g];
				++$_g;
				$this->o->writeUInt16($first_glyph_offset + $offset);
				unset($offset);
			}
		}
		$this->o->write($shape_data);
	}
	public function writeFontGlyphs($glyphs) {
		$old = $this->openTMP();
		$offsets = new _hx_array(array());
		$offs = 0;
		{
			$_g = 0;
			while($_g < $glyphs->length) {
				$shape = $glyphs[$_g];
				++$_g;
				$offsets->push($offs);
				$old1 = $this->openTMP();
				$isFont = true;
				$this->writeShapeWithoutStyle(1, $shape, $isFont);
				{
					$_this = $this->bits;
					if($_this->nbits > 0) {
						$_this->writeBits(8 - $_this->nbits, 0);
						$_this->nbits = 0;
					}
					unset($_this);
				}
				$shape_data = $this->closeTMP($old1);
				$this->o->write($shape_data);
				$offs += $shape_data->length;
				unset($shape_data,$shape,$old1,$isFont);
			}
		}
		$glyph_data = $this->closeTMP($old);
		$this->o->write($glyph_data);
		return $offsets;
	}
	public function writeMorphShape($id, $data) {
		$old = $this->openTMP();
		$this->o->writeUInt16($id);
		$__hx__t = ($data);
		switch($__hx__t->index) {
		case 0:
		$sh1data = $__hx__t->params[0];
		{
			$this->writeRect($sh1data->startBounds);
			$this->writeRect($sh1data->endBounds);
			$old1 = $this->openTMP();
			$this->writeMorphFillStyles(1, $sh1data->fillStyles);
			$this->writeMorph1LineStyles($sh1data->lineStyles);
			$this->writeShapeWithoutStyle(3, $sh1data->startEdges, null);
			{
				$_this = $this->bits;
				if($_this->nbits > 0) {
					$_this->writeBits(8 - $_this->nbits, 0);
					$_this->nbits = 0;
				}
			}
			$part_data = $this->closeTMP($old1);
			$this->o->writeInt32($part_data->length);
			$this->o->write($part_data);
			$this->writeShapeWithoutStyle(3, $sh1data->endEdges, null);
		}break;
		case 1:
		$sh2data = $__hx__t->params[0];
		{
			$this->writeRect($sh2data->startBounds);
			$this->writeRect($sh2data->endBounds);
			$this->writeRect($sh2data->startEdgeBounds);
			$this->writeRect($sh2data->endEdgeBounds);
			$this->bits->writeBits(6, 0);
			$this->bits->writeBit($sh2data->useNonScalingStrokes);
			$this->bits->writeBit($sh2data->useScalingStrokes);
			{
				$_this = $this->bits;
				if($_this->nbits > 0) {
					$_this->writeBits(8 - $_this->nbits, 0);
					$_this->nbits = 0;
				}
			}
			$old1 = $this->openTMP();
			$this->writeMorphFillStyles(1, $sh2data->fillStyles);
			$this->writeMorph2LineStyles($sh2data->lineStyles);
			$this->writeShapeWithoutStyle(4, $sh2data->startEdges, null);
			{
				$_this = $this->bits;
				if($_this->nbits > 0) {
					$_this->writeBits(8 - $_this->nbits, 0);
					$_this->nbits = 0;
				}
			}
			$part_data = $this->closeTMP($old1);
			$this->o->writeInt32($part_data->length);
			$this->o->write($part_data);
			$this->writeShapeWithoutStyle(4, $sh2data->endEdges, null);
		}break;
		}
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		$morph_shape_data = $this->closeTMP($old);
		$__hx__t = ($data);
		switch($__hx__t->index) {
		case 0:
		$sh1data = $__hx__t->params[0];
		{
			$this->writeTID(46, $morph_shape_data->length);
		}break;
		case 1:
		$sh2data = $__hx__t->params[0];
		{
			$this->writeTID(84, $morph_shape_data->length);
		}break;
		}
		$this->o->write($morph_shape_data);
	}
	public function writeMorph2LineStyles($line_styles) {
		$num_styles = $line_styles->length;
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		if($num_styles > 254) {
			$this->o->writeByte(255);
			$this->o->writeUInt16($num_styles);
		} else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g = 0;
			while($_g < $line_styles->length) {
				$style = $line_styles[$_g];
				++$_g;
				$this->writeMorph2LineStyle($style);
				unset($style);
			}
		}
	}
	public function writeMorph2LineStyle($style) {
		$m2data = null;
		$__hx__t = ($style);
		switch($__hx__t->index) {
		case 0:
		$data = $__hx__t->params[2]; $endColor = $__hx__t->params[1]; $startColor = $__hx__t->params[0];
		{
			$m2data = $data;
		}break;
		case 1:
		$data = $__hx__t->params[1]; $fill = $__hx__t->params[0];
		{
			$m2data = $data;
		}break;
		}
		$this->o->writeUInt16($m2data->startWidth);
		$this->o->writeUInt16($m2data->endWidth);
		$this->bits->writeBits(2, format_swf_Writer_5($this, $m2data, $style));
		$this->bits->writeBits(2, format_swf_Writer_6($this, $m2data, $style));
		$__hx__t = ($style);
		switch($__hx__t->index) {
		case 0:
		$data = $__hx__t->params[2]; $endColor = $__hx__t->params[1]; $startColor = $__hx__t->params[0];
		{
			$this->bits->writeBit(false);
		}break;
		case 1:
		$data = $__hx__t->params[1]; $fill = $__hx__t->params[0];
		{
			$this->bits->writeBit(true);
		}break;
		}
		$this->bits->writeBit($m2data->noHScale);
		$this->bits->writeBit($m2data->noVScale);
		$this->bits->writeBit($m2data->pixelHinting);
		$this->bits->writeBits(5, 0);
		$this->bits->writeBit($m2data->noClose);
		$this->bits->writeBits(2, format_swf_Writer_7($this, $m2data, $style));
		$__hx__t = ($m2data->joinStyle);
		switch($__hx__t->index) {
		case 2:
		$limitFactor = $__hx__t->params[0];
		{
			$this->o->writeUInt16($limitFactor);
		}break;
		default:{
		}break;
		}
		$__hx__t = ($style);
		switch($__hx__t->index) {
		case 0:
		$data = $__hx__t->params[2]; $endColor = $__hx__t->params[1]; $startColor = $__hx__t->params[0];
		{
			$this->writeRGBA($startColor);
			$this->writeRGBA($endColor);
		}break;
		case 1:
		$data = $__hx__t->params[1]; $fill = $__hx__t->params[0];
		{
			$this->writeMorphFillStyle(2, $fill);
		}break;
		}
	}
	public function writeMorph1LineStyles($line_styles) {
		$num_styles = $line_styles->length;
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		if($num_styles > 254) {
			$this->o->writeByte(255);
			$this->o->writeUInt16($num_styles);
		} else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g = 0;
			while($_g < $line_styles->length) {
				$style = $line_styles[$_g];
				++$_g;
				$this->writeMorph1LineStyle($style);
				unset($style);
			}
		}
	}
	public function writeMorph1LineStyle($s) {
		$this->o->writeUInt16($s->startWidth);
		$this->o->writeUInt16($s->endWidth);
		$this->writeRGBA($s->startColor);
		$this->writeRGBA($s->endColor);
	}
	public function writeMorphFillStyles($ver, $fill_styles) {
		$num_styles = $fill_styles->length;
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		if($num_styles > 254) {
			$this->o->writeByte(255);
			$this->o->writeUInt16($num_styles);
		} else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g = 0;
			while($_g < $fill_styles->length) {
				$style = $fill_styles[$_g];
				++$_g;
				$this->writeMorphFillStyle($ver, $style);
				unset($style);
			}
		}
	}
	public function writeMorphFillStyle($ver, $fill_style) {
		$__hx__t = ($fill_style);
		switch($__hx__t->index) {
		case 0:
		$endColor = $__hx__t->params[1]; $startColor = $__hx__t->params[0];
		{
			$this->o->writeByte(0);
			$this->writeRGBA($startColor);
			$this->writeRGBA($endColor);
		}break;
		case 1:
		$gradients = $__hx__t->params[2]; $endMatrix = $__hx__t->params[1]; $startMatrix = $__hx__t->params[0];
		{
			$this->o->writeByte(16);
			$this->writeMatrix($startMatrix);
			$this->writeMatrix($endMatrix);
			$this->writeMorphGradients($ver, $gradients);
		}break;
		case 2:
		$gradients = $__hx__t->params[2]; $endMatrix = $__hx__t->params[1]; $startMatrix = $__hx__t->params[0];
		{
			$this->o->writeByte(16);
			$this->writeMatrix($startMatrix);
			$this->writeMatrix($endMatrix);
			$this->writeMorphGradients($ver, $gradients);
		}break;
		case 3:
		$smooth = $__hx__t->params[4]; $repeat = $__hx__t->params[3]; $endMatrix = $__hx__t->params[2]; $startMatrix = $__hx__t->params[1]; $cid = $__hx__t->params[0];
		{
			$this->o->writeByte((($repeat) ? (($smooth) ? 64 : 66) : (($smooth) ? 65 : 67)));
			$this->o->writeUInt16($cid);
			$this->writeMatrix($startMatrix);
			$this->writeMatrix($endMatrix);
		}break;
		}
	}
	public function writeMorphGradients($ver, $gradients) {
		$num = $gradients->length;
		if($num < 1 || $num > 8) {
			throw new HException("Number of specified morph gradients (" . _hx_string_rec($num, "") . ") must be in range 1..8");
		}
		{
			$_g = 0;
			while($_g < $gradients->length) {
				$grad = $gradients[$_g];
				++$_g;
				$this->writeMorphGradient($ver, $grad);
				unset($grad);
			}
		}
	}
	public function writeMorphGradient($ver, $g) {
		$this->o->writeByte($g->startRatio);
		$this->writeRGBA($g->startColor);
		$this->o->writeByte($g->endRatio);
		$this->writeRGBA($g->endColor);
	}
	public function writeShape($id, $data) {
		$old = $this->openTMP();
		$this->o->writeUInt16($id);
		$__hx__t = ($data);
		switch($__hx__t->index) {
		case 0:
		$shapes = $__hx__t->params[1]; $bounds = $__hx__t->params[0];
		{
			$this->writeRect($bounds);
			$this->writeShapeWithStyle(1, $shapes);
		}break;
		case 1:
		$shapes = $__hx__t->params[1]; $bounds = $__hx__t->params[0];
		{
			$this->writeRect($bounds);
			$this->writeShapeWithStyle(2, $shapes);
		}break;
		case 2:
		$shapes = $__hx__t->params[1]; $bounds = $__hx__t->params[0];
		{
			$this->writeRect($bounds);
			$this->writeShapeWithStyle(3, $shapes);
		}break;
		case 3:
		$data1 = $__hx__t->params[0];
		{
			$this->writeRect($data1->shapeBounds);
			$this->writeRect($data1->edgeBounds);
			$this->bits->writeBits(5, 0);
			$this->bits->writeBit($data1->useWinding);
			$this->bits->writeBit($data1->useNonScalingStroke);
			$this->bits->writeBit($data1->useScalingStroke);
			{
				$_this = $this->bits;
				if($_this->nbits > 0) {
					$_this->writeBits(8 - $_this->nbits, 0);
					$_this->nbits = 0;
				}
			}
			$this->writeShapeWithStyle(4, $data1->shapes);
		}break;
		}
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		$shape_data = $this->closeTMP($old);
		$__hx__t = ($data);
		switch($__hx__t->index) {
		case 0:
		$shapes = $__hx__t->params[1]; $bounds = $__hx__t->params[0];
		{
			$this->writeTID(2, $shape_data->length);
		}break;
		case 1:
		$shapes = $__hx__t->params[1]; $bounds = $__hx__t->params[0];
		{
			$this->writeTID(22, $shape_data->length);
		}break;
		case 2:
		$shapes = $__hx__t->params[1]; $bounds = $__hx__t->params[0];
		{
			$this->writeTID(32, $shape_data->length);
		}break;
		case 3:
		$data1 = $__hx__t->params[0];
		{
			$this->writeTID(83, $shape_data->length);
		}break;
		}
		$this->o->write($shape_data);
	}
	public function writeShapeWithStyle($ver, $data) {
		$this->writeFillStyles($ver, $data->fillStyles);
		$this->writeLineStyles($ver, $data->lineStyles);
		$style_info = _hx_anonymous(array("numFillStyles" => $data->fillStyles->length, "fillBits" => format_swf_Tools::minBits(new _hx_array(array($data->fillStyles->length))), "numLineStyles" => $data->lineStyles->length, "lineBits" => format_swf_Tools::minBits(new _hx_array(array($data->lineStyles->length)))));
		$this->bits->writeBits(4, $style_info->fillBits);
		$this->bits->writeBits(4, $style_info->lineBits);
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		{
			$_g = 0; $_g1 = $data->shapeRecords;
			while($_g < $_g1->length) {
				$shr = $_g1[$_g];
				++$_g;
				$this->writeShapeRecord($ver, $style_info, $shr);
				unset($shr);
			}
		}
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
	}
	public function writeShapeWithoutStyle($ver, $data, $isFont = null) {
		if($isFont === null) {
			$isFont = false;
		}
		$style_info = _hx_anonymous(array("numFillStyles" => 0, "fillBits" => 1, "numLineStyles" => 0, "lineBits" => (($isFont) ? 0 : 1)));
		$this->bits->writeBits(4, $style_info->fillBits);
		$this->bits->writeBits(4, $style_info->lineBits);
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		{
			$_g = 0; $_g1 = $data->shapeRecords;
			while($_g < $_g1->length) {
				$shr = $_g1[$_g];
				++$_g;
				$this->writeShapeRecord($ver, $style_info, $shr);
				unset($shr);
			}
		}
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
	}
	public function writeShapeRecord($ver, $style_info, $shape_record) {
		$__hx__t = ($shape_record);
		switch($__hx__t->index) {
		case 0:
		{
			$this->bits->writeBit(false);
			$this->bits->writeBits(5, 0);
		}break;
		case 1:
		$data = $__hx__t->params[0];
		{
			$this->bits->writeBit(false);
			if(_hx_field($data, "newStyles") !== null) {
				if($ver > 1) {
					$this->bits->writeBit(true);
				} else {
					throw new HException("Defining new fill and line style arrays are only supported in shape versions higher than 1!");
				}
			} else {
				$this->bits->writeBit(false);
				$this->bits->writeBit(_hx_field($data, "lineStyle") !== null);
				$this->bits->writeBit(_hx_field($data, "fillStyle1") !== null);
				$this->bits->writeBit(_hx_field($data, "fillStyle0") !== null);
				$this->bits->writeBit(_hx_field($data, "moveTo") !== null);
			}
			if(_hx_field($data, "moveTo") !== null) {
				$mb = format_swf_Tools::minBits(new _hx_array(array($data->moveTo->dx, $data->moveTo->dy))) + 1;
				$this->bits->writeBits(5, $mb);
				$this->bits->writeBits($mb, $data->moveTo->dx);
				$this->bits->writeBits($mb, $data->moveTo->dy);
			}
			if(_hx_field($data, "fillStyle0") !== null) {
				$this->bits->writeBits($style_info->fillBits, $data->fillStyle0->idx);
			}
			if(_hx_field($data, "fillStyle1") !== null) {
				$this->bits->writeBits($style_info->fillBits, $data->fillStyle1->idx);
			}
			if(_hx_field($data, "lineStyle") !== null) {
				$this->bits->writeBits($style_info->lineBits, $data->lineStyle->idx);
			}
			if(_hx_field($data, "newStyles") !== null) {
				$this->writeFillStyles($ver, $data->newStyles->fillStyles);
				$this->writeLineStyles($ver, $data->newStyles->lineStyles);
				$style_info->numFillStyles += $data->newStyles->fillStyles->length;
				$style_info->numLineStyles += $data->newStyles->lineStyles->length;
				$style_info->fillBits = format_swf_Tools::minBits(new _hx_array(array($style_info->numFillStyles)));
				$style_info->lineBits = format_swf_Tools::minBits(new _hx_array(array($style_info->numLineStyles)));
				$this->bits->writeBits(4, $style_info->fillBits);
				$this->bits->writeBits(4, $style_info->lineBits);
			}
		}break;
		case 2:
		$dy = $__hx__t->params[1]; $dx = $__hx__t->params[0];
		{
			$this->bits->writeBit(true);
			$this->bits->writeBit(true);
			$mb = format_swf_Tools::minBits(new _hx_array(array($dx, $dy))) + 1;
			$mb = format_swf_Writer_8($this, $dx, $dy, $mb, $shape_record, $style_info, $ver);
			$this->bits->writeBits(4, $mb);
			$mb += 2;
			$is_general = $dx !== 0 && $dy !== 0;
			$this->bits->writeBit($is_general);
			if(!$is_general) {
				$is_vertical = $dx === 0;
				$this->bits->writeBit($is_vertical);
				if($is_vertical) {
					$this->bits->writeBits($mb, $dy);
				} else {
					$this->bits->writeBits($mb, $dx);
				}
			} else {
				$this->bits->writeBits($mb, $dx);
				$this->bits->writeBits($mb, $dy);
			}
		}break;
		case 3:
		$ady = $__hx__t->params[3]; $adx = $__hx__t->params[2]; $cdy = $__hx__t->params[1]; $cdx = $__hx__t->params[0];
		{
			$this->bits->writeBit(true);
			$this->bits->writeBit(false);
			$mb = format_swf_Tools::minBits(new _hx_array(array($cdx, $cdy, $adx, $ady))) + 1;
			$mb = format_swf_Writer_9($this, $adx, $ady, $cdx, $cdy, $mb, $shape_record, $style_info, $ver);
			$this->bits->writeBits(4, $mb);
			$mb += 2;
			$this->bits->writeBits($mb, $cdx);
			$this->bits->writeBits($mb, $cdy);
			$this->bits->writeBits($mb, $adx);
			$this->bits->writeBits($mb, $ady);
		}break;
		}
	}
	public function writeLineStyles($ver, $line_styles) {
		$num_styles = $line_styles->length;
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		if($num_styles > 254) {
			if($ver >= 2) {
				$this->o->writeByte(255);
				$this->o->writeUInt16($num_styles);
			} else {
				if($num_styles === 255) {
					$this->o->writeByte(255);
				} else {
					throw new HException("Too much line styles (" . _hx_string_rec($num_styles, "") . ") for Shape version 1");
				}
			}
		} else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g = 0;
			while($_g < $line_styles->length) {
				$style = $line_styles[$_g];
				++$_g;
				$this->writeLineStyle($ver, $style);
				unset($style);
			}
		}
	}
	public function writeLineStyle($ver, $line_style) {
		$this->o->writeUInt16($line_style->width);
		$__hx__t = ($line_style->data);
		switch($__hx__t->index) {
		case 0:
		$rgb = $__hx__t->params[0];
		{
			if($ver > 2) {
				throw new HException("Line styles with Shape versions higher than 2 reqire alhpa channel!");
			}
			$this->writeRGB($rgb);
		}break;
		case 1:
		$rgba = $__hx__t->params[0];
		{
			if($ver < 3) {
				throw new HException("Line styles with Shape versions lower than 3 doesn't support alhpa channel!");
			}
			$this->writeRGBA($rgba);
		}break;
		case 2:
		$data = $__hx__t->params[0];
		{
			if($ver < 4) {
				throw new HException("LineStyle version 2 only supported in shape versions higher than 3!");
			}
			$this->bits->writeBits(2, format_swf_Writer_10($this, $data, $line_style, $ver));
			$this->bits->writeBits(2, format_swf_Writer_11($this, $data, $line_style, $ver));
			$this->bits->writeBit(format_swf_Writer_12($this, $data, $line_style, $ver));
			$this->bits->writeBit($data->noHScale);
			$this->bits->writeBit($data->noVScale);
			$this->bits->writeBit($data->pixelHinting);
			$this->bits->writeBits(5, 0);
			$this->bits->writeBit($data->noClose);
			$this->bits->writeBits(2, format_swf_Writer_13($this, $data, $line_style, $ver));
			$__hx__t2 = ($data->join);
			switch($__hx__t2->index) {
			case 2:
			$limitFactor = $__hx__t2->params[0];
			{
				$this->o->writeUInt16($limitFactor);
			}break;
			default:{
			}break;
			}
			$__hx__t2 = ($data->fill);
			switch($__hx__t2->index) {
			case 0:
			$color = $__hx__t2->params[0];
			{
				$this->writeRGBA($color);
			}break;
			case 1:
			$style = $__hx__t2->params[0];
			{
				$this->writeFillStyle($ver, $style);
			}break;
			}
		}break;
		}
	}
	public function writeFillStyles($ver, $fill_styles) {
		$num_styles = $fill_styles->length;
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		if($num_styles > 254) {
			if($ver >= 2) {
				$this->o->writeByte(255);
				$this->o->writeUInt16($num_styles);
			} else {
				if($num_styles === 255) {
					$this->o->writeByte(255);
				} else {
					throw new HException("Too much fill styles (" . _hx_string_rec($num_styles, "") . ") for Shape version 1");
				}
			}
		} else {
			$this->o->writeByte($num_styles);
		}
		{
			$_g = 0;
			while($_g < $fill_styles->length) {
				$style = $fill_styles[$_g];
				++$_g;
				$this->writeFillStyle($ver, $style);
				unset($style);
			}
		}
	}
	public function writeFillStyle($ver, $fill_style) {
		$__hx__t = ($fill_style);
		switch($__hx__t->index) {
		case 0:
		$rgb = $__hx__t->params[0];
		{
			if($ver > 2) {
				throw new HException("Fill styles with Shape versions higher than 2 reqire alhpa channel!");
			}
			$this->o->writeByte(0);
			$this->writeRGB($rgb);
		}break;
		case 1:
		$rgba = $__hx__t->params[0];
		{
			if($ver < 3) {
				throw new HException("Fill styles with Shape versions lower than 3 doesn't support alhpa channel!");
			}
			$this->o->writeByte(0);
			$this->writeRGBA($rgba);
		}break;
		case 2:
		$grad = $__hx__t->params[1]; $mat = $__hx__t->params[0];
		{
			$this->o->writeByte(16);
			$this->writeMatrix($mat);
			$this->writeGradient($ver, $grad);
		}break;
		case 3:
		$grad = $__hx__t->params[1]; $mat = $__hx__t->params[0];
		{
			$this->o->writeByte(18);
			$this->writeMatrix($mat);
			$this->writeGradient($ver, $grad);
		}break;
		case 4:
		$grad = $__hx__t->params[1]; $mat = $__hx__t->params[0];
		{
			if($ver > 3) {
				throw new HException("Focal gradient fill style only supported with Shape versions higher than 3!");
			}
			$this->o->writeByte(19);
			$this->writeMatrix($mat);
			$this->writeFocalGradient($ver, $grad);
		}break;
		case 5:
		$smooth = $__hx__t->params[3]; $repeat = $__hx__t->params[2]; $mat = $__hx__t->params[1]; $cid = $__hx__t->params[0];
		{
			$this->o->writeByte((($repeat) ? (($smooth) ? 64 : 66) : (($smooth) ? 65 : 67)));
			$this->o->writeUInt16($cid);
			$this->writeMatrix($mat);
		}break;
		}
	}
	public function writeFocalGradient($ver, $grad) {
		if($ver < 4) {
			throw new HException("Focal gradient only supported in shape versions higher than 3!");
		}
		$this->writeGradient($ver, $grad->data);
		$this->o->writeUInt16($grad->focalPoint);
	}
	public function writeGradient($ver, $grad) {
		$spread_mode = format_swf_Writer_14($this, $grad, $ver);
		$interpolation_mode = format_swf_Writer_15($this, $grad, $spread_mode, $ver);
		if($ver < 4 && ($spread_mode !== 0 || $interpolation_mode !== 0)) {
			throw new HException("Spread must be Pad and interpolation mode must be Normal RGB in gradient specification when shape version is lower than 4!");
		}
		$num_records = $grad->data->length;
		if($ver < 4) {
			if($num_records > 8) {
				throw new HException("Gradient supports at most 8 control points (" . _hx_string_rec($num_records, "") . " has bee given) when shape verison is lower than 4!");
			}
		} else {
			if($num_records > 15) {
				throw new HException("Gradient supports at most 15 control points (" . _hx_string_rec($num_records, "") . " has been given) at shape version 4!");
			}
		}
		$this->bits->writeBits(2, $spread_mode);
		$this->bits->writeBits(2, $interpolation_mode);
		$this->bits->writeBits(4, $num_records);
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		{
			$_g = 0; $_g1 = $grad->data;
			while($_g < $_g1->length) {
				$grad_record = $_g1[$_g];
				++$_g;
				$this->writeGradRecord($ver, $grad_record);
				unset($grad_record);
			}
		}
	}
	public function writeGradRecord($ver, $grad_record) {
		$__hx__t = ($grad_record);
		switch($__hx__t->index) {
		case 0:
		$col = $__hx__t->params[1]; $pos = $__hx__t->params[0];
		{
			if($ver > 2) {
				throw new HException("Shape versions higher than 2 require alpha channel in gradient control points!");
			}
			$this->o->writeByte($pos);
			$this->writeRGB($col);
		}break;
		case 1:
		$col = $__hx__t->params[1]; $pos = $__hx__t->params[0];
		{
			if($ver < 3) {
				throw new HException("Shape versions lower than 3 don't support alpha channel in gradient control points!");
			}
			$this->o->writeByte($pos);
			$this->writeRGBA($col);
		}break;
		}
	}
	public function writeSound($s) {
		$len = 7 + format_swf_Writer_16($this, $s);
		$this->writeTIDExt(14, $len);
		$this->o->writeUInt16($s->sid);
		$this->bits->writeBits(4, format_swf_Writer_17($this, $len, $s));
		$this->bits->writeBits(2, format_swf_Writer_18($this, $len, $s));
		$this->bits->writeBit($s->is16bit);
		$this->bits->writeBit($s->isStereo);
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		$this->o->writeInt32($s->samples);
		$__hx__t = ($s->data);
		switch($__hx__t->index) {
		case 0:
		$data = $__hx__t->params[1]; $seek = $__hx__t->params[0];
		{
			$this->o->writeInt16($seek);
			$this->o->write($data);
		}break;
		case 1:
		$data = $__hx__t->params[0];
		{
			$this->o->write($data);
		}break;
		case 2:
		$data = $__hx__t->params[0];
		{
			$this->o->write($data);
		}break;
		}
	}
	public function writeSymbols($sl, $tagid) {
		$len = 2;
		{
			$_g = 0;
			while($_g < $sl->length) {
				$s = $sl[$_g];
				++$_g;
				$len += 2 + strlen($s->className) + 1;
				unset($s);
			}
		}
		$this->writeTID($tagid, $len);
		$this->o->writeUInt16($sl->length);
		{
			$_g = 0;
			while($_g < $sl->length) {
				$s = $sl[$_g];
				++$_g;
				$this->o->writeUInt16($s->cid);
				$this->o->writeString($s->className);
				$this->o->writeByte(0);
				unset($s);
			}
		}
	}
	public function writeTIDExt($id, $len) {
		$this->o->writeUInt16($id << 6 | 63);
		$this->o->writeInt32($len);
	}
	public function writeTID($id, $len) {
		$h = $id << 6;
		if($len < 63) {
			$this->o->writeUInt16($h | $len);
		} else {
			$this->o->writeUInt16($h | 63);
			$this->o->writeInt32($len);
		}
	}
	public function writeInt($v) {
		$this->o->writeInt32($v);
	}
	public function writePlaceObject($po, $v3) {
		$f = 0; $f2 = 0;
		if($po->move) {
			$f |= 1;
		}
		if($po->cid !== null) {
			$f |= 2;
		}
		if(_hx_field($po, "matrix") !== null) {
			$f |= 4;
		}
		if(_hx_field($po, "color") !== null) {
			$f |= 8;
		}
		if($po->ratio !== null) {
			$f |= 16;
		}
		if($po->instanceName !== null) {
			$f |= 32;
		}
		if($po->clipDepth !== null) {
			$f |= 64;
		}
		if($po->events !== null) {
			$f |= 128;
		}
		if($po->filters !== null) {
			$f2 |= 1;
		}
		if($po->blendMode !== null) {
			$f2 |= 2;
		}
		if($po->bitmapCache !== null) {
			$f2 |= 4;
		}
		if($po->className !== null) {
			$f2 |= 8;
		}
		if($po->hasImage) {
			$f2 |= 16;
		}
		$this->o->writeByte($f);
		if($v3) {
			$this->o->writeByte($f2);
		} else {
			if($f2 !== 0) {
				throw new HException("Invalid place object version");
			}
		}
		$this->o->writeUInt16($po->depth);
		if($po->className !== null) {
			$this->o->writeString($po->className);
			$this->o->writeByte(0);
		}
		if($po->cid !== null) {
			$this->o->writeUInt16($po->cid);
		}
		if(_hx_field($po, "matrix") !== null) {
			$this->writeMatrix($po->matrix);
		}
		if(_hx_field($po, "color") !== null) {
			$this->writeCXA($po->color);
		}
		if($po->ratio !== null) {
			$this->o->writeUInt16($po->ratio);
		}
		if($po->instanceName !== null) {
			$this->o->writeString($po->instanceName);
			$this->o->writeByte(0);
		}
		if($po->clipDepth !== null) {
			$this->o->writeUInt16($po->clipDepth);
		}
		if($po->filters !== null) {
			$this->writeFilters($po->filters);
		}
		if($po->blendMode !== null) {
			$this->writeBlendMode($po->blendMode);
		}
		if($po->bitmapCache !== null) {
			$this->o->writeByte($po->bitmapCache);
		}
		if($po->events !== null) {
			$this->writeClipEvents($po->events);
		}
	}
	public function writeBlendMode($b) {
		$this->o->writeByte($b->index + 1);
	}
	public function writeFilters($filters) {
		$this->o->writeByte($filters->length);
		{
			$_g = 0;
			while($_g < $filters->length) {
				$f = $filters[$_g];
				++$_g;
				$this->writeFilter($f);
				unset($f);
			}
		}
	}
	public function writeFilter($f) {
		$__hx__t = ($f);
		switch($__hx__t->index) {
		case 0:
		$d = $__hx__t->params[0];
		{
			$this->o->writeByte(0);
			$this->writeRGBA($d->color);
			$this->o->writeInt32($d->blurX);
			$this->o->writeInt32($d->blurY);
			$this->o->writeInt32($d->angle);
			$this->o->writeInt32($d->distance);
			$this->o->writeUInt16($d->strength);
			$this->bits->writeBit($d->flags->inner);
			$this->bits->writeBit($d->flags->knockout);
			$this->bits->writeBit(true);
			$this->bits->writeBits(5, $d->flags->passes);
		}break;
		case 1:
		$d = $__hx__t->params[0];
		{
			$this->o->writeByte(1);
			$this->o->writeInt32($d->blurX);
			$this->o->writeInt32($d->blurY);
			$this->bits->writeBits(5, $d->passes);
			$this->bits->writeBits(3, 0);
		}break;
		case 2:
		$d = $__hx__t->params[0];
		{
			$this->o->writeByte(2);
			$this->writeRGBA($d->color);
			$this->o->writeInt32($d->blurX);
			$this->o->writeInt32($d->blurY);
			$this->o->writeUInt16($d->strength);
			$this->bits->writeBit($d->flags->inner);
			$this->bits->writeBit($d->flags->knockout);
			$this->bits->writeBit(true);
			$this->bits->writeBits(5, $d->flags->passes);
		}break;
		case 3:
		$d = $__hx__t->params[0];
		{
			$this->o->writeByte(3);
			$this->writeRGBA($d->color);
			$this->writeRGBA($d->color2);
			$this->o->writeInt32($d->blurX);
			$this->o->writeInt32($d->blurY);
			$this->o->writeInt32($d->angle);
			$this->o->writeInt32($d->distance);
			$this->o->writeUInt16($d->strength);
			$this->bits->writeBit($d->flags->inner);
			$this->bits->writeBit($d->flags->knockout);
			$this->bits->writeBit(true);
			$this->bits->writeBit($d->flags->ontop);
			$this->bits->writeBits(4, $d->flags->passes);
		}break;
		case 4:
		$d = $__hx__t->params[0];
		{
			$this->o->writeByte(4);
			$this->writeFilterGradient($d);
		}break;
		case 5:
		$d = $__hx__t->params[0];
		{
			$this->o->writeByte(6);
			{
				$_g = 0;
				while($_g < $d->length) {
					$f1 = $d[$_g];
					++$_g;
					$this->o->writeFloat($f1);
					unset($f1);
				}
			}
		}break;
		case 6:
		$d = $__hx__t->params[0];
		{
			$this->o->writeByte(7);
			$this->writeFilterGradient($d);
		}break;
		}
	}
	public function writeFilterGradient($f) {
		$this->o->writeByte($f->colors->length);
		{
			$_g = 0; $_g1 = $f->colors;
			while($_g < $_g1->length) {
				$c = $_g1[$_g];
				++$_g;
				$this->writeRGBA($c->color);
				unset($c);
			}
		}
		{
			$_g = 0; $_g1 = $f->colors;
			while($_g < $_g1->length) {
				$c = $_g1[$_g];
				++$_g;
				$this->o->writeByte($c->position);
				unset($c);
			}
		}
		$d = $f->data;
		$this->o->writeInt32($d->blurX);
		$this->o->writeInt32($d->blurY);
		$this->o->writeInt32($d->angle);
		$this->o->writeInt32($d->distance);
		$this->o->writeUInt16($d->strength);
		$this->bits->writeBit($d->flags->inner);
		$this->bits->writeBit($d->flags->knockout);
		$this->bits->writeBit(true);
		$this->bits->writeBit($d->flags->ontop);
		$this->bits->writeBits(4, $d->flags->passes);
	}
	public function writeClipEvents($events) {
		$this->o->writeUInt16(0);
		$all = 0;
		{
			$_g = 0;
			while($_g < $events->length) {
				$e = $events[$_g];
				++$_g;
				$all |= $e->eventsFlags;
				unset($e);
			}
		}
		$this->o->writeInt32($all);
		{
			$_g = 0;
			while($_g < $events->length) {
				$e = $events[$_g];
				++$_g;
				$this->o->writeInt32($e->eventsFlags);
				$this->o->writeInt32($e->data->length);
				$this->o->write($e->data);
				unset($e);
			}
		}
		$this->o->writeInt32(0);
	}
	public function writeCXA($c) {
		$this->bits->writeBit(_hx_field($c, "add") !== null);
		$this->bits->writeBit(_hx_field($c, "mult") !== null);
		$this->bits->writeBits(4, $c->nbits);
		if(_hx_field($c, "mult") !== null) {
			$this->writeCXAColor($c->mult, $c->nbits);
		}
		if(_hx_field($c, "add") !== null) {
			$this->writeCXAColor($c->add, $c->nbits);
		}
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
	}
	public function writeCXAColor($c, $nbits) {
		$this->bits->writeBits($nbits, $c->r);
		$this->bits->writeBits($nbits, $c->g);
		$this->bits->writeBits($nbits, $c->b);
		$this->bits->writeBits($nbits, $c->a);
	}
	public function writeMatrix($m) {
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
		if(_hx_field($m, "scale") !== null) {
			$this->bits->writeBit(true);
			$sx = format_swf_Writer_19($this, $m);
			$sy = format_swf_Writer_20($this, $m, $sx);
			$nbits = format_swf_Tools::minBits(new _hx_array(array($sx, $sy))) + 1;
			$this->bits->writeBits(5, $nbits);
			$this->bits->writeBits($nbits, $sx);
			$this->bits->writeBits($nbits, $sy);
		} else {
			$this->bits->writeBit(false);
		}
		if(_hx_field($m, "rotate") !== null) {
			$this->bits->writeBit(true);
			$rs0 = format_swf_Writer_21($this, $m);
			$rs1 = format_swf_Writer_22($this, $m, $rs0);
			$nbits = format_swf_Tools::minBits(new _hx_array(array($rs0, $rs1))) + 1;
			$this->bits->writeBits(5, $nbits);
			$this->bits->writeBits($nbits, $rs0);
			$this->bits->writeBits($nbits, $rs1);
		} else {
			$this->bits->writeBit(false);
		}
		$nbits = format_swf_Tools::minBits(new _hx_array(array($m->translate->x, $m->translate->y))) + 1;
		if($nbits !== 1) {
			$this->bits->writeBits(5, $nbits);
			$this->bits->writeBits($nbits, $m->translate->x);
			$this->bits->writeBits($nbits, $m->translate->y);
		}
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
	}
	public function writeRGBA($c) {
		$this->o->writeByte($c->r);
		$this->o->writeByte($c->g);
		$this->o->writeByte($c->b);
		$this->o->writeByte($c->a);
	}
	public function writeRGB($c) {
		$this->o->writeByte($c->r);
		$this->o->writeByte($c->g);
		$this->o->writeByte($c->b);
	}
	public function writeHeader($h) {
		$this->compressed = false;
		$this->output->writeString((($this->compressed) ? "CWS" : "FWS"));
		$this->output->writeByte($h->version);
		$this->o = new haxe_io_BytesOutput();
		$this->bits = new format_tools_BitsOutput($this->o);
		$this->writeRect(_hx_anonymous(array("left" => 0, "top" => 0, "right" => $h->width * 20, "bottom" => $h->height * 20)));
		$this->o->writeByte(0);
		$this->o->writeByte($h->fps);
		$this->o->writeUInt16($h->nframes);
	}
	public function closeTMP($old) {
		$bytes = $this->o->getBytes();
		$this->o = $old;
		$this->bits->o = $old;
		return $bytes;
	}
	public function openTMP() {
		$old = $this->o;
		$this->o = new haxe_io_BytesOutput();
		$this->bits->o = $this->o;
		return $old;
	}
	public function writeFixed($v) {
		$this->o->writeInt32($v);
	}
	public function writeFixed8($v) {
		$this->o->writeUInt16($v);
	}
	public function writeRect($r) {
		$lr = format_swf_Writer_23($this, $r);
		$bt = format_swf_Writer_24($this, $lr, $r);
		$max = (($lr > $bt) ? $lr : $bt);
		$nbits = 1;
		while($max > 0) {
			$max >>= 1;
			$nbits++;
		}
		$this->bits->writeBits(5, $nbits);
		$this->bits->writeBits($nbits, $r->left);
		$this->bits->writeBits($nbits, $r->right);
		$this->bits->writeBits($nbits, $r->top);
		$this->bits->writeBits($nbits, $r->bottom);
		{
			$_this = $this->bits;
			if($_this->nbits > 0) {
				$_this->writeBits(8 - $_this->nbits, 0);
				$_this->nbits = 0;
			}
		}
	}
	public function write($s) {
		$this->writeHeader($s->header);
		{
			$_g = 0; $_g1 = $s->tags;
			while($_g < $_g1->length) {
				$t = $_g1[$_g];
				++$_g;
				$this->writeTag($t);
				unset($t);
			}
		}
		$this->writeEnd();
	}
	public $bits;
	public $compressed;
	public $o;
	public $output;
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
	function __toString() { return 'format.swf.Writer'; }
}
function format_swf_Writer_0(&$__hx__this, &$l, &$t) {
	$__hx__t2 = ($l->color);
	switch($__hx__t2->index) {
	case 0:
	$n = $__hx__t2->params[0];
	{
		return $n;
	}break;
	default:{
		return null;
	}break;
	}
}
function format_swf_Writer_1(&$__hx__this, &$l, &$t) {
	$__hx__t2 = ($l->color);
	switch($__hx__t2->index) {
	case 0:
	$n = $__hx__t2->params[0];
	{
		return $n;
	}break;
	default:{
		return null;
	}break;
	}
}
function format_swf_Writer_2(&$__hx__this, &$data, &$data1, &$hasWideCodes, &$id, &$isANSI, &$shiftJIS) {
	if($hasWideCodes) {
		return 4 + strlen($data1->name) + $data1->codeTable->length * 2;
	} else {
		return 4 + strlen($data1->name) + $data1->codeTable->length;
	}
}
function format_swf_Writer_3(&$__hx__this, &$data, &$data1, &$id, &$language) {
	$__hx__t2 = ($language);
	switch($__hx__t2->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	case 3:
	{
		return 3;
	}break;
	case 4:
	{
		return 4;
	}break;
	case 5:
	{
		return 5;
	}break;
	}
}
function format_swf_Writer_4(&$__hx__this, &$data, &$glyphs, &$hasWideChars, &$hasWideOffsets, &$num_glyphs, &$offset_table, &$old, &$shape_data) {
	$__hx__t = ($data->language);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	case 3:
	{
		return 3;
	}break;
	case 4:
	{
		return 4;
	}break;
	case 5:
	{
		return 5;
	}break;
	}
}
function format_swf_Writer_5(&$__hx__this, &$m2data, &$style) {
	$__hx__t = ($m2data->startCapStyle);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	}
}
function format_swf_Writer_6(&$__hx__this, &$m2data, &$style) {
	$__hx__t = ($m2data->joinStyle);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	$limitFactor = $__hx__t->params[0];
	{
		return 2;
	}break;
	}
}
function format_swf_Writer_7(&$__hx__this, &$m2data, &$style) {
	$__hx__t = ($m2data->endCapStyle);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	}
}
function format_swf_Writer_8(&$__hx__this, &$dx, &$dy, &$mb, &$shape_record, &$style_info, &$ver) {
	if($mb < 2) {
		return 0;
	} else {
		return $mb - 2;
	}
}
function format_swf_Writer_9(&$__hx__this, &$adx, &$ady, &$cdx, &$cdy, &$mb, &$shape_record, &$style_info, &$ver) {
	if($mb < 2) {
		return 0;
	} else {
		return $mb - 2;
	}
}
function format_swf_Writer_10(&$__hx__this, &$data, &$line_style, &$ver) {
	$__hx__t2 = ($data->startCap);
	switch($__hx__t2->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	}
}
function format_swf_Writer_11(&$__hx__this, &$data, &$line_style, &$ver) {
	$__hx__t2 = ($data->join);
	switch($__hx__t2->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	$limitFactor = $__hx__t2->params[0];
	{
		return 2;
	}break;
	}
}
function format_swf_Writer_12(&$__hx__this, &$data, &$line_style, &$ver) {
	$__hx__t2 = ($data->fill);
	switch($__hx__t2->index) {
	case 0:
	$color = $__hx__t2->params[0];
	{
		return false;
	}break;
	case 1:
	$style = $__hx__t2->params[0];
	{
		return true;
	}break;
	}
}
function format_swf_Writer_13(&$__hx__this, &$data, &$line_style, &$ver) {
	$__hx__t2 = ($data->endCap);
	switch($__hx__t2->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	}
}
function format_swf_Writer_14(&$__hx__this, &$grad, &$ver) {
	$__hx__t = ($grad->spread);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	case 3:
	{
		return 3;
	}break;
	}
}
function format_swf_Writer_15(&$__hx__this, &$grad, &$spread_mode, &$ver) {
	$__hx__t = ($grad->interpolate);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	case 3:
	{
		return 3;
	}break;
	}
}
function format_swf_Writer_16(&$__hx__this, &$s) {
	$__hx__t = ($s->data);
	switch($__hx__t->index) {
	case 0:
	$data = $__hx__t->params[1];
	{
		return $data->length + 2;
	}break;
	case 1:
	$data = $__hx__t->params[0];
	{
		return $data->length;
	}break;
	case 2:
	$data = $__hx__t->params[0];
	{
		return $data->length;
	}break;
	}
}
function format_swf_Writer_17(&$__hx__this, &$len, &$s) {
	$__hx__t = ($s->format);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	case 3:
	{
		return 3;
	}break;
	case 4:
	{
		return 4;
	}break;
	case 5:
	{
		return 5;
	}break;
	case 6:
	{
		return 6;
	}break;
	case 7:
	{
		return 11;
	}break;
	}
}
function format_swf_Writer_18(&$__hx__this, &$len, &$s) {
	$__hx__t = ($s->rate);
	switch($__hx__t->index) {
	case 0:
	{
		return 0;
	}break;
	case 1:
	{
		return 1;
	}break;
	case 2:
	{
		return 2;
	}break;
	case 3:
	{
		return 3;
	}break;
	}
}
function format_swf_Writer_19(&$__hx__this, &$m) {
	{
		$f = $m->scale->x;
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
function format_swf_Writer_20(&$__hx__this, &$m, &$sx) {
	{
		$f = $m->scale->y;
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
function format_swf_Writer_21(&$__hx__this, &$m) {
	{
		$f = $m->rotate->rs0;
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
function format_swf_Writer_22(&$__hx__this, &$m, &$rs0) {
	{
		$f = $m->rotate->rs1;
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
function format_swf_Writer_23(&$__hx__this, &$r) {
	if($r->left > $r->right) {
		return $r->left;
	} else {
		return $r->right;
	}
}
function format_swf_Writer_24(&$__hx__this, &$lr, &$r) {
	if($r->top > $r->bottom) {
		return $r->top;
	} else {
		return $r->bottom;
	}
}
