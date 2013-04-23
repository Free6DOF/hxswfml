<?php

class format_mp3_MPEG {
	public function __construct(){}
	static $V1 = 3;
	static $V2 = 2;
	static $V25 = 0;
	static $Reserved = 1;
	static function enum2Num($m) {
		return format_mp3_MPEG_0($m);
	}
	static function num2Enum($m) {
		return format_mp3_MPEG_1($m);
	}
	static $V1_Bitrates;
	static $V2_Bitrates;
	static $SamplingRates;
	static function srNum2Enum($sr) {
		return format_mp3_MPEG_2($sr);
	}
	static function srEnum2Num($sr) {
		return format_mp3_MPEG_3($sr);
	}
	static function getBitrateIdx($br, $mpeg, $layer) {
		$arr = _hx_array_get((format_mp3_MPEG_4($br, $layer, $mpeg)), format_mp3_CLayer::enum2Num($layer));
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
		return format_mp3_MPEG_5($br);
	}
	static function bitrateNum2Enum($br) {
		return format_mp3_MPEG_6($br);
	}
	function __toString() { return 'format.mp3.MPEG'; }
}
format_mp3_MPEG::$V1_Bitrates = new _hx_array(array(new _hx_array(array(format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_40, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_320, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_320, format_mp3_Bitrate::$BR_384, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_288, format_mp3_Bitrate::$BR_320, format_mp3_Bitrate::$BR_352, format_mp3_Bitrate::$BR_384, format_mp3_Bitrate::$BR_416, format_mp3_Bitrate::$BR_448, format_mp3_Bitrate::$BR_Bad))));
format_mp3_MPEG::$V2_Bitrates = new _hx_array(array(new _hx_array(array(format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_8, format_mp3_Bitrate::$BR_16, format_mp3_Bitrate::$BR_24, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_40, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_144, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_8, format_mp3_Bitrate::$BR_16, format_mp3_Bitrate::$BR_24, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_40, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_144, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_Bad)), new _hx_array(array(format_mp3_Bitrate::$BR_Free, format_mp3_Bitrate::$BR_32, format_mp3_Bitrate::$BR_48, format_mp3_Bitrate::$BR_56, format_mp3_Bitrate::$BR_64, format_mp3_Bitrate::$BR_80, format_mp3_Bitrate::$BR_96, format_mp3_Bitrate::$BR_112, format_mp3_Bitrate::$BR_128, format_mp3_Bitrate::$BR_144, format_mp3_Bitrate::$BR_160, format_mp3_Bitrate::$BR_176, format_mp3_Bitrate::$BR_192, format_mp3_Bitrate::$BR_224, format_mp3_Bitrate::$BR_256, format_mp3_Bitrate::$BR_Bad))));
format_mp3_MPEG::$SamplingRates = new _hx_array(array(new _hx_array(array(format_mp3_SamplingRate::$SR_11025, format_mp3_SamplingRate::$SR_12000, format_mp3_SamplingRate::$SR_8000, format_mp3_SamplingRate::$SR_Bad)), new _hx_array(array(format_mp3_SamplingRate::$SR_Bad, format_mp3_SamplingRate::$SR_Bad, format_mp3_SamplingRate::$SR_Bad, format_mp3_SamplingRate::$SR_Bad)), new _hx_array(array(format_mp3_SamplingRate::$SR_22050, format_mp3_SamplingRate::$SR_24000, format_mp3_SamplingRate::$SR_12000, format_mp3_SamplingRate::$SR_Bad)), new _hx_array(array(format_mp3_SamplingRate::$SR_44100, format_mp3_SamplingRate::$SR_48000, format_mp3_SamplingRate::$SR_32000, format_mp3_SamplingRate::$SR_Bad))));
function format_mp3_MPEG_0(&$m) {
	$__hx__t = ($m);
	switch($__hx__t->index) {
	case 0:
	{
		return format_mp3_MPEG::$V1;
	}break;
	case 1:
	{
		return format_mp3_MPEG::$V2;
	}break;
	case 2:
	{
		return format_mp3_MPEG::$V25;
	}break;
	case 3:
	{
		return format_mp3_MPEG::$Reserved;
	}break;
	}
}
function format_mp3_MPEG_1(&$m) {
	switch($m) {
	case format_mp3_MPEG::$V1:{
		return format_mp3_MPEGVersion::$MPEG_V1;
	}break;
	case format_mp3_MPEG::$V2:{
		return format_mp3_MPEGVersion::$MPEG_V2;
	}break;
	case format_mp3_MPEG::$V25:{
		return format_mp3_MPEGVersion::$MPEG_V25;
	}break;
	default:{
		return format_mp3_MPEGVersion::$MPEG_Reserved;
	}break;
	}
}
function format_mp3_MPEG_2(&$sr) {
	switch($sr) {
	case 8000:{
		return format_mp3_SamplingRate::$SR_8000;
	}break;
	case 11025:{
		return format_mp3_SamplingRate::$SR_11025;
	}break;
	case 12000:{
		return format_mp3_SamplingRate::$SR_12000;
	}break;
	case 22050:{
		return format_mp3_SamplingRate::$SR_22050;
	}break;
	case 24000:{
		return format_mp3_SamplingRate::$SR_24000;
	}break;
	case 32000:{
		return format_mp3_SamplingRate::$SR_32000;
	}break;
	case 44100:{
		return format_mp3_SamplingRate::$SR_44100;
	}break;
	case 48000:{
		return format_mp3_SamplingRate::$SR_48000;
	}break;
	default:{
		return format_mp3_SamplingRate::$SR_Bad;
	}break;
	}
}
function format_mp3_MPEG_3(&$sr) {
	$__hx__t = ($sr);
	switch($__hx__t->index) {
	case 0:
	{
		return 8000;
	}break;
	case 1:
	{
		return 11025;
	}break;
	case 2:
	{
		return 12000;
	}break;
	case 3:
	{
		return 22050;
	}break;
	case 4:
	{
		return 24000;
	}break;
	case 5:
	{
		return 32000;
	}break;
	case 6:
	{
		return 44100;
	}break;
	case 7:
	{
		return 48000;
	}break;
	case 8:
	{
		return -1;
	}break;
	}
}
function format_mp3_MPEG_4(&$br, &$layer, &$mpeg) {
	if($mpeg === format_mp3_MPEGVersion::$MPEG_V1) {
		return format_mp3_MPEG::$V1_Bitrates;
	} else {
		return format_mp3_MPEG::$V2_Bitrates;
	}
}
function format_mp3_MPEG_5(&$br) {
	$__hx__t = ($br);
	switch($__hx__t->index) {
	case 25:
	{
		return -1;
	}break;
	case 24:
	{
		return 0;
	}break;
	case 0:
	{
		return 8;
	}break;
	case 1:
	{
		return 16;
	}break;
	case 2:
	{
		return 24;
	}break;
	case 3:
	{
		return 32;
	}break;
	case 4:
	{
		return 40;
	}break;
	case 5:
	{
		return 48;
	}break;
	case 6:
	{
		return 56;
	}break;
	case 7:
	{
		return 64;
	}break;
	case 8:
	{
		return 80;
	}break;
	case 9:
	{
		return 96;
	}break;
	case 10:
	{
		return 112;
	}break;
	case 11:
	{
		return 128;
	}break;
	case 12:
	{
		return 144;
	}break;
	case 13:
	{
		return 160;
	}break;
	case 14:
	{
		return 176;
	}break;
	case 15:
	{
		return 192;
	}break;
	case 16:
	{
		return 224;
	}break;
	case 17:
	{
		return 256;
	}break;
	case 18:
	{
		return 288;
	}break;
	case 19:
	{
		return 320;
	}break;
	case 20:
	{
		return 352;
	}break;
	case 21:
	{
		return 384;
	}break;
	case 22:
	{
		return 416;
	}break;
	case 23:
	{
		return 448;
	}break;
	}
}
function format_mp3_MPEG_6(&$br) {
	switch($br) {
	case 0:{
		return format_mp3_Bitrate::$BR_Free;
	}break;
	case 8:{
		return format_mp3_Bitrate::$BR_8;
	}break;
	case 16:{
		return format_mp3_Bitrate::$BR_16;
	}break;
	case 24:{
		return format_mp3_Bitrate::$BR_24;
	}break;
	case 32:{
		return format_mp3_Bitrate::$BR_32;
	}break;
	case 40:{
		return format_mp3_Bitrate::$BR_40;
	}break;
	case 48:{
		return format_mp3_Bitrate::$BR_48;
	}break;
	case 56:{
		return format_mp3_Bitrate::$BR_56;
	}break;
	case 64:{
		return format_mp3_Bitrate::$BR_64;
	}break;
	case 80:{
		return format_mp3_Bitrate::$BR_80;
	}break;
	case 96:{
		return format_mp3_Bitrate::$BR_96;
	}break;
	case 112:{
		return format_mp3_Bitrate::$BR_112;
	}break;
	case 128:{
		return format_mp3_Bitrate::$BR_128;
	}break;
	case 144:{
		return format_mp3_Bitrate::$BR_144;
	}break;
	case 160:{
		return format_mp3_Bitrate::$BR_160;
	}break;
	case 176:{
		return format_mp3_Bitrate::$BR_176;
	}break;
	case 192:{
		return format_mp3_Bitrate::$BR_192;
	}break;
	case 224:{
		return format_mp3_Bitrate::$BR_224;
	}break;
	case 256:{
		return format_mp3_Bitrate::$BR_256;
	}break;
	case 288:{
		return format_mp3_Bitrate::$BR_288;
	}break;
	case 320:{
		return format_mp3_Bitrate::$BR_320;
	}break;
	case 352:{
		return format_mp3_Bitrate::$BR_352;
	}break;
	case 384:{
		return format_mp3_Bitrate::$BR_384;
	}break;
	case 416:{
		return format_mp3_Bitrate::$BR_416;
	}break;
	case 448:{
		return format_mp3_Bitrate::$BR_448;
	}break;
	default:{
		return format_mp3_Bitrate::$BR_Bad;
	}break;
	}
}
