<?php

class format_mp3_MPEG {
	public function __construct(){}
	static $V1 = 3;
	static $V2 = 2;
	static $V25 = 0;
	static $Reserved = 1;
	static function enum2Num($m) {
		return eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$m);
			switch(\$�t->index) {
			case 0:
			{
				\$�r = format_mp3_MPEG::\$V1;
			}break;
			case 1:
			{
				\$�r = format_mp3_MPEG::\$V2;
			}break;
			case 2:
			{
				\$�r = format_mp3_MPEG::\$V25;
			}break;
			case 3:
			{
				\$�r = format_mp3_MPEG::\$Reserved;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	static function num2Enum($m) {
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$m) {
			case format_mp3_MPEG::\$V1:{
				\$�r = format_mp3_MPEGVersion::\$MPEG_V1;
			}break;
			case format_mp3_MPEG::\$V2:{
				\$�r = format_mp3_MPEGVersion::\$MPEG_V2;
			}break;
			case format_mp3_MPEG::\$V25:{
				\$�r = format_mp3_MPEGVersion::\$MPEG_V25;
			}break;
			default:{
				\$�r = format_mp3_MPEGVersion::\$MPEG_Reserved;
			}break;
			}
			return \$�r;
		");
	}
	static $V1_Bitrates;
	static $V2_Bitrates;
	static $SamplingRates;
	static function srNum2Enum($sr) {
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$sr) {
			case 8000:{
				\$�r = format_mp3_SamplingRate::\$SR_8000;
			}break;
			case 11025:{
				\$�r = format_mp3_SamplingRate::\$SR_11025;
			}break;
			case 12000:{
				\$�r = format_mp3_SamplingRate::\$SR_12000;
			}break;
			case 22050:{
				\$�r = format_mp3_SamplingRate::\$SR_22050;
			}break;
			case 24000:{
				\$�r = format_mp3_SamplingRate::\$SR_24000;
			}break;
			case 32000:{
				\$�r = format_mp3_SamplingRate::\$SR_32000;
			}break;
			case 44100:{
				\$�r = format_mp3_SamplingRate::\$SR_44100;
			}break;
			case 48000:{
				\$�r = format_mp3_SamplingRate::\$SR_48000;
			}break;
			default:{
				\$�r = format_mp3_SamplingRate::\$SR_Bad;
			}break;
			}
			return \$�r;
		");
	}
	static function srEnum2Num($sr) {
		return eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$sr);
			switch(\$�t->index) {
			case 0:
			{
				\$�r = 8000;
			}break;
			case 1:
			{
				\$�r = 11025;
			}break;
			case 2:
			{
				\$�r = 12000;
			}break;
			case 3:
			{
				\$�r = 22050;
			}break;
			case 4:
			{
				\$�r = 24000;
			}break;
			case 5:
			{
				\$�r = 32000;
			}break;
			case 6:
			{
				\$�r = 44100;
			}break;
			case 7:
			{
				\$�r = 48000;
			}break;
			case 8:
			{
				\$�r = -1;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
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
		return eval("if(isset(\$this)) \$�this =& \$this;\$�t = (\$br);
			switch(\$�t->index) {
			case 25:
			{
				\$�r = -1;
			}break;
			case 24:
			{
				\$�r = 0;
			}break;
			case 0:
			{
				\$�r = 8;
			}break;
			case 1:
			{
				\$�r = 16;
			}break;
			case 2:
			{
				\$�r = 24;
			}break;
			case 3:
			{
				\$�r = 32;
			}break;
			case 4:
			{
				\$�r = 40;
			}break;
			case 5:
			{
				\$�r = 48;
			}break;
			case 6:
			{
				\$�r = 56;
			}break;
			case 7:
			{
				\$�r = 64;
			}break;
			case 8:
			{
				\$�r = 80;
			}break;
			case 9:
			{
				\$�r = 96;
			}break;
			case 10:
			{
				\$�r = 112;
			}break;
			case 11:
			{
				\$�r = 128;
			}break;
			case 12:
			{
				\$�r = 144;
			}break;
			case 13:
			{
				\$�r = 160;
			}break;
			case 14:
			{
				\$�r = 176;
			}break;
			case 15:
			{
				\$�r = 192;
			}break;
			case 16:
			{
				\$�r = 224;
			}break;
			case 17:
			{
				\$�r = 256;
			}break;
			case 18:
			{
				\$�r = 288;
			}break;
			case 19:
			{
				\$�r = 320;
			}break;
			case 20:
			{
				\$�r = 352;
			}break;
			case 21:
			{
				\$�r = 384;
			}break;
			case 22:
			{
				\$�r = 416;
			}break;
			case 23:
			{
				\$�r = 448;
			}break;
			default:{
				\$�r = null;
			}break;
			}
			return \$�r;
		");
	}
	static function bitrateNum2Enum($br) {
		return eval("if(isset(\$this)) \$�this =& \$this;switch(\$br) {
			case 0:{
				\$�r = format_mp3_Bitrate::\$BR_Free;
			}break;
			case 8:{
				\$�r = format_mp3_Bitrate::\$BR_8;
			}break;
			case 16:{
				\$�r = format_mp3_Bitrate::\$BR_16;
			}break;
			case 24:{
				\$�r = format_mp3_Bitrate::\$BR_24;
			}break;
			case 32:{
				\$�r = format_mp3_Bitrate::\$BR_32;
			}break;
			case 40:{
				\$�r = format_mp3_Bitrate::\$BR_40;
			}break;
			case 48:{
				\$�r = format_mp3_Bitrate::\$BR_48;
			}break;
			case 56:{
				\$�r = format_mp3_Bitrate::\$BR_56;
			}break;
			case 64:{
				\$�r = format_mp3_Bitrate::\$BR_64;
			}break;
			case 80:{
				\$�r = format_mp3_Bitrate::\$BR_80;
			}break;
			case 96:{
				\$�r = format_mp3_Bitrate::\$BR_96;
			}break;
			case 112:{
				\$�r = format_mp3_Bitrate::\$BR_112;
			}break;
			case 128:{
				\$�r = format_mp3_Bitrate::\$BR_128;
			}break;
			case 144:{
				\$�r = format_mp3_Bitrate::\$BR_144;
			}break;
			case 160:{
				\$�r = format_mp3_Bitrate::\$BR_160;
			}break;
			case 176:{
				\$�r = format_mp3_Bitrate::\$BR_176;
			}break;
			case 192:{
				\$�r = format_mp3_Bitrate::\$BR_192;
			}break;
			case 224:{
				\$�r = format_mp3_Bitrate::\$BR_224;
			}break;
			case 256:{
				\$�r = format_mp3_Bitrate::\$BR_256;
			}break;
			case 288:{
				\$�r = format_mp3_Bitrate::\$BR_288;
			}break;
			case 320:{
				\$�r = format_mp3_Bitrate::\$BR_320;
			}break;
			case 352:{
				\$�r = format_mp3_Bitrate::\$BR_352;
			}break;
			case 384:{
				\$�r = format_mp3_Bitrate::\$BR_384;
			}break;
			case 416:{
				\$�r = format_mp3_Bitrate::\$BR_416;
			}break;
			case 448:{
				\$�r = format_mp3_Bitrate::\$BR_448;
			}break;
			default:{
				\$�r = format_mp3_Bitrate::\$BR_Bad;
			}break;
			}
			return \$�r;
		");
	}
	function __toString() { return 'format.mp3.MPEG'; }
}
format_mp3_MPEG::$V1_Bitrates = new _hx_array(array(new _hx_array(array(format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_40, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_320, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_320, format_mp3_Bitrate::$BR_384, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_288, format_mp3_Bitrate::$BR_320, format_mp3_Bitrate::$BR_352, format_mp3_Bitrate::$BR_384, format_mp3_Bitrate::$BR_416, format_mp3_Bitrate::$BR_448, format_mp3_Bitrate::$BR_Bad))));
format_mp3_MPEG::$V2_Bitrates = new _hx_array(array(new _hx_array(array(format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_8, format_mp3_Bitrate::$BR_16, format_mp3_Bitrate::$BR_24, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_40, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_144, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_8, format_mp3_Bitrate::$BR_16, format_mp3_Bitrate::$BR_24, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_40, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_144, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_144, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_176, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_Bad))));
format_mp3_MPEG::$SamplingRates = new _hx_array(array(new _hx_array(array(format_mp3_SamplingRate::$SR_11025, format_mp3_SamplingRate::$SR_12000, format_mp3_SamplingRate::$SR_8000, format_mp3_SamplingRate::$SR_Bad)), new _hx_array(array(format_mp3_SamplingRate::$SR_Bad, format_mp3_SamplingRate::$SR_Bad, format_mp3_SamplingRate::$SR_Bad, format_mp3_SamplingRate::$SR_Bad)), new _hx_array(array(format_mp3_SamplingRate::$SR_22050, format_mp3_SamplingRate::$SR_24000, format_mp3_SamplingRate::$SR_12000, format_mp3_SamplingRate::$SR_Bad)), new _hx_array(array(format_mp3_SamplingRate::$SR_44100, format_mp3_SamplingRate::$SR_48000, format_mp3_SamplingRate::$SR_32000, format_mp3_SamplingRate::$SR_Bad))));
