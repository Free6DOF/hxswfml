<?php

class format_mp3_Tools {
	public function __construct(){}
	static function getBitrate($mpegVersion, $layerIdx, $bitrateIdx) {
		if($mpegVersion === format_mp3_MPEG::$Reserved || $layerIdx === format_mp3_CLayer::$LReserved) {
			return format_mp3_Bitrate::$BR_Bad;
		}
		return _hx_array_get((format_mp3_Tools_0($bitrateIdx, $layerIdx, $mpegVersion)), $layerIdx)[$bitrateIdx];
	}
	static function getSamplingRate($mpegVersion, $samplingRateIdx) {
		return format_mp3_MPEG::$SamplingRates[$mpegVersion][$samplingRateIdx];
	}
	static function isInvalidFrameHeader($hdr) {
		return $hdr->version == format_mp3_MPEGVersion::$MPEG_Reserved || $hdr->layer == format_mp3_Layer::$LayerReserved || $hdr->bitrate == format_mp3_Bitrate::$BR_Bad || $hdr->bitrate == format_mp3_Bitrate::$BR_Free || $hdr->samplingRate == format_mp3_SamplingRate::$SR_Bad;
	}
	static function getSampleDataSize($mpegVersion, $bitrate, $samplingRate, $isPadded, $hasCrc) {
		return Std::int(((($mpegVersion === format_mp3_MPEG::$V1) ? 144 : 72)) * $bitrate * 1000 / $samplingRate) + ((($isPadded) ? 1 : 0)) - ((($hasCrc) ? 2 : 0)) - 4;
	}
	static function getSampleDataSizeHdr($hdr) {
		return format_mp3_Tools::getSampleDataSize(format_mp3_MPEG::enum2Num($hdr->version), format_mp3_MPEG::bitrateEnum2Num($hdr->bitrate), format_mp3_MPEG::srEnum2Num($hdr->samplingRate), $hdr->isPadded, $hdr->hasCrc);
	}
	static function getSampleCount($mpegVersion) {
		return (($mpegVersion === format_mp3_MPEG::$V1) ? 1152 : 576);
	}
	static function getSampleCountHdr($hdr) {
		return format_mp3_Tools::getSampleCount(format_mp3_MPEG::enum2Num($hdr->version));
	}
	static function getFrameInfo($fr) {
		return Std::string($fr->header->version) . ", " . Std::string($fr->header->layer) . ", " . Std::string($fr->header->channelMode) . ", " . Std::string($fr->header->samplingRate) . " Hz, " . Std::string($fr->header->bitrate) . " kbps " . "Emphasis: " . Std::string($fr->header->emphasis) . ", " . _hx_string_or_null(((($fr->header->hasCrc) ? "(CRC) " : ""))) . _hx_string_or_null(((($fr->header->isPadded) ? "(Padded) " : ""))) . _hx_string_or_null(((($fr->header->isIntensityStereo) ? "(Intensity Stereo) " : ""))) . _hx_string_or_null(((($fr->header->isMSStereo) ? "(MS Stereo) " : ""))) . _hx_string_or_null(((($fr->header->isCopyrighted) ? "(Copyrighted) " : ""))) . _hx_string_or_null(((($fr->header->isOriginal) ? "(Original) " : "")));
	}
	function __toString() { return 'format.mp3.Tools'; }
}
function format_mp3_Tools_0(&$bitrateIdx, &$layerIdx, &$mpegVersion) {
	if($mpegVersion === format_mp3_MPEG::$V1) {
		return format_mp3_MPEG::$V1_Bitrates;
	} else {
		return format_mp3_MPEG::$V2_Bitrates;
	}
}
