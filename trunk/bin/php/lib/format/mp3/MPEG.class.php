<?php

class format_mp3_MPEG {
	public function __construct(){}
	static $V1 = 3;
	static $V2 = 2;
	static $V25 = 0;
	static $Reserved = 1;
	static function enum2Num($m) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$m);
			switch(\$퍁->index) {
			case 0:
			{
				\$팿 = format_mp3_MPEG::\$V1;
			}break;
			case 1:
			{
				\$팿 = format_mp3_MPEG::\$V2;
			}break;
			case 2:
			{
				\$팿 = format_mp3_MPEG::\$V25;
			}break;
			case 3:
			{
				\$팿 = format_mp3_MPEG::\$Reserved;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
	}
	static function num2Enum($m) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$m) {
			case format_mp3_MPEG::\$V1:{
				\$팿 = format_mp3_MPEGVersion::\$MPEG_V1;
			}break;
			case format_mp3_MPEG::\$V2:{
				\$팿 = format_mp3_MPEGVersion::\$MPEG_V2;
			}break;
			case format_mp3_MPEG::\$V25:{
				\$팿 = format_mp3_MPEGVersion::\$MPEG_V25;
			}break;
			default:{
				\$팿 = format_mp3_MPEGVersion::\$MPEG_Reserved;
			}break;
			}
			return \$팿;
		");
	}
	static $V1_Bitrates;
	static $V2_Bitrates;
	static $SamplingRates;
	static function srNum2Enum($sr) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$sr) {
			case 8000:{
				\$팿 = format_mp3_SamplingRate::\$SR_8000;
			}break;
			case 11025:{
				\$팿 = format_mp3_SamplingRate::\$SR_11025;
			}break;
			case 12000:{
				\$팿 = format_mp3_SamplingRate::\$SR_12000;
			}break;
			case 22050:{
				\$팿 = format_mp3_SamplingRate::\$SR_22050;
			}break;
			case 24000:{
				\$팿 = format_mp3_SamplingRate::\$SR_24000;
			}break;
			case 32000:{
				\$팿 = format_mp3_SamplingRate::\$SR_32000;
			}break;
			case 44100:{
				\$팿 = format_mp3_SamplingRate::\$SR_44100;
			}break;
			case 48000:{
				\$팿 = format_mp3_SamplingRate::\$SR_48000;
			}break;
			default:{
				\$팿 = format_mp3_SamplingRate::\$SR_Bad;
			}break;
			}
			return \$팿;
		");
	}
	static function srEnum2Num($sr) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$sr);
			switch(\$퍁->index) {
			case 0:
			{
				\$팿 = 8000;
			}break;
			case 1:
			{
				\$팿 = 11025;
			}break;
			case 2:
			{
				\$팿 = 12000;
			}break;
			case 3:
			{
				\$팿 = 22050;
			}break;
			case 4:
			{
				\$팿 = 24000;
			}break;
			case 5:
			{
				\$팿 = 32000;
			}break;
			case 6:
			{
				\$팿 = 44100;
			}break;
			case 7:
			{
				\$팿 = 48000;
			}break;
			case 8:
			{
				\$팿 = -1;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
	}
	static function getBitrateIdx($br, $mpeg, $layer) {
		$arr = ((($mpeg === format_mp3_MPEGVersion::$MPEG_V1) ? format_mp3_MPEG::$V1_Bitrates : format_mp3_MPEG::$V2_Bitrates))[format_mp3_CLayer::enum2Num($layer)];
		{
			$_g = 0;
			while($_g < 16) {
				$i = $_g++;
				if($arr[$i] === $br) {
					return $i;
				}
				unset($i);
			}
		}
		throw new HException("Bitrate index not found");
	}
	static function getSamplingRateIdx($sr, $mpeg) {
		$arr = format_mp3_MPEG::$SamplingRates[format_mp3_MPEG::enum2Num($mpeg)];
		{
			$_g = 0;
			while($_g < 4) {
				$i = $_g++;
				if($arr[$i] === $sr) {
					return $i;
				}
				unset($i);
			}
		}
		throw new HException("Sampling rate index not found");
	}
	static function bitrateEnum2Num($br) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;\$퍁 = (\$br);
			switch(\$퍁->index) {
			case 25:
			{
				\$팿 = -1;
			}break;
			case 24:
			{
				\$팿 = 0;
			}break;
			case 0:
			{
				\$팿 = 8;
			}break;
			case 1:
			{
				\$팿 = 16;
			}break;
			case 2:
			{
				\$팿 = 24;
			}break;
			case 3:
			{
				\$팿 = 32;
			}break;
			case 4:
			{
				\$팿 = 40;
			}break;
			case 5:
			{
				\$팿 = 48;
			}break;
			case 6:
			{
				\$팿 = 56;
			}break;
			case 7:
			{
				\$팿 = 64;
			}break;
			case 8:
			{
				\$팿 = 80;
			}break;
			case 9:
			{
				\$팿 = 96;
			}break;
			case 10:
			{
				\$팿 = 112;
			}break;
			case 11:
			{
				\$팿 = 128;
			}break;
			case 12:
			{
				\$팿 = 144;
			}break;
			case 13:
			{
				\$팿 = 160;
			}break;
			case 14:
			{
				\$팿 = 176;
			}break;
			case 15:
			{
				\$팿 = 192;
			}break;
			case 16:
			{
				\$팿 = 224;
			}break;
			case 17:
			{
				\$팿 = 256;
			}break;
			case 18:
			{
				\$팿 = 288;
			}break;
			case 19:
			{
				\$팿 = 320;
			}break;
			case 20:
			{
				\$팿 = 352;
			}break;
			case 21:
			{
				\$팿 = 384;
			}break;
			case 22:
			{
				\$팿 = 416;
			}break;
			case 23:
			{
				\$팿 = 448;
			}break;
			default:{
				\$팿 = null;
			}break;
			}
			return \$팿;
		");
	}
	static function bitrateNum2Enum($br) {
		return eval("if(isset(\$this)) \$퍁his =& \$this;switch(\$br) {
			case 0:{
				\$팿 = format_mp3_Bitrate::\$BR_Free;
			}break;
			case 8:{
				\$팿 = format_mp3_Bitrate::\$BR_8;
			}break;
			case 16:{
				\$팿 = format_mp3_Bitrate::\$BR_16;
			}break;
			case 24:{
				\$팿 = format_mp3_Bitrate::\$BR_24;
			}break;
			case 32:{
				\$팿 = format_mp3_Bitrate::\$BR_32;
			}break;
			case 40:{
				\$팿 = format_mp3_Bitrate::\$BR_40;
			}break;
			case 48:{
				\$팿 = format_mp3_Bitrate::\$BR_48;
			}break;
			case 56:{
				\$팿 = format_mp3_Bitrate::\$BR_56;
			}break;
			case 64:{
				\$팿 = format_mp3_Bitrate::\$BR_64;
			}break;
			case 80:{
				\$팿 = format_mp3_Bitrate::\$BR_80;
			}break;
			case 96:{
				\$팿 = format_mp3_Bitrate::\$BR_96;
			}break;
			case 112:{
				\$팿 = format_mp3_Bitrate::\$BR_112;
			}break;
			case 128:{
				\$팿 = format_mp3_Bitrate::\$BR_128;
			}break;
			case 144:{
				\$팿 = format_mp3_Bitrate::\$BR_144;
			}break;
			case 160:{
				\$팿 = format_mp3_Bitrate::\$BR_160;
			}break;
			case 176:{
				\$팿 = format_mp3_Bitrate::\$BR_176;
			}break;
			case 192:{
				\$팿 = format_mp3_Bitrate::\$BR_192;
			}break;
			case 224:{
				\$팿 = format_mp3_Bitrate::\$BR_224;
			}break;
			case 256:{
				\$팿 = format_mp3_Bitrate::\$BR_256;
			}break;
			case 288:{
				\$팿 = format_mp3_Bitrate::\$BR_288;
			}break;
			case 320:{
				\$팿 = format_mp3_Bitrate::\$BR_320;
			}break;
			case 352:{
				\$팿 = format_mp3_Bitrate::\$BR_352;
			}break;
			case 384:{
				\$팿 = format_mp3_Bitrate::\$BR_384;
			}break;
			case 416:{
				\$팿 = format_mp3_Bitrate::\$BR_416;
			}break;
			case 448:{
				\$팿 = format_mp3_Bitrate::\$BR_448;
			}break;
			default:{
				\$팿 = format_mp3_Bitrate::\$BR_Bad;
			}break;
			}
			return \$팿;
		");
	}
	function __toString() { return 'format.mp3.MPEG'; }
}
format_mp3_MPEG::$V1_Bitrates = new _hx_array(array(new _hx_array(array(format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_40, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_320, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_320, format_mp3_Bitrate::$BR_384, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_288, format_mp3_Bitrate::$BR_320, format_mp3_Bitrate::$BR_352, format_mp3_Bitrate::$BR_384, format_mp3_Bitrate::$BR_416, format_mp3_Bitrate::$BR_448, format_mp3_Bitrate::$BR_Bad))));
format_mp3_MPEG::$V2_Bitrates = new _hx_array(array(new _hx_array(array(format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_8, format_mp3_Bitrate::$BR_16, format_mp3_Bitrate::$BR_24, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_40, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_144, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_8, format_mp3_Bitrate::$BR_16, format_mp3_Bitrate::$BR_24, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_40, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_144, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_144, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_176, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_Bad))));
format_mp3_MPEG::$SamplingRates = new _hx_array(array(new _hx_array(array(format_mp3_SamplingRate::$SR_11025, format_mp3_SamplingRate::$SR_12000, format_mp3_SamplingRate::$SR_8000, format_mp3_SamplingRate::$SR_Bad)), new _hx_array(array(format_mp3_SamplingRate::$SR_Bad, format_mp3_SamplingRate::$SR_Bad, format_mp3_SamplingRate::$SR_Bad, format_mp3_SamplingRate::$SR_Bad)), new _hx_array(array(format_mp3_SamplingRate::$SR_22050, format_mp3_SamplingRate::$SR_24000, format_mp3_SamplingRate::$SR_12000, format_mp3_SamplingRate::$SR_Bad)), new _hx_array(array(format_mp3_SamplingRate::$SR_44100, format_mp3_SamplingRate::$SR_48000, format_mp3_SamplingRate::$SR_32000, format_mp3_SamplingRate::$SR_Bad))));
