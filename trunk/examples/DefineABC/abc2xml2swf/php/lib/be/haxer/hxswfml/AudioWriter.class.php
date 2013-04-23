<?php

class be_haxer_hxswfml_AudioWriter {
	public function __construct() {
		;
	}
	public function getSWF($id = null) {
		if($id === null) {
			$id = 1;
		}
		$swfFile = _hx_anonymous(array("header" => _hx_anonymous(array("version" => 10, "compressed" => true, "width" => 800, "height" => 600, "fps" => 30, "nframes" => 1)), "tags" => new _hx_array(array($this->getTag($id), format_swf_SWFTag::TStartSound($id, _hx_anonymous(array("syncStop" => false, "hasLoops" => false, "loopCount" => null))), format_swf_SWFTag::$TShowFrame))));
		$swfOutput = new haxe_io_BytesOutput();
		$writer = new format_swf_Writer($swfOutput);
		$writer->write($swfFile);
		return $swfOutput->getBytes();
	}
	public function getTag($id = null) {
		if($id === null) {
			$id = 1;
		}
		$this->soundData->sid = $id;
		return format_swf_SWFTag::TSound($this->soundData);
	}
	public function write($bytes, $currentTag = null) {
		$mp3Reader = new format_mp3_Reader($bytes);
		$mp3 = $mp3Reader->read();
		$mp3Frames = $mp3->frames;
		$mp3Header = _hx_array_get($mp3Frames, 0)->header;
		$output = new haxe_io_BytesOutput();
		$mp3Writer = new format_mp3_Writer($output);
		$mp3Writer->write($mp3, false);
		$samplingRate = be_haxer_hxswfml_AudioWriter_0($this, $bytes, $currentTag, $mp3, $mp3Frames, $mp3Header, $mp3Reader, $mp3Writer, $output);
		if($samplingRate === null) {
			throw new HException("ERROR: Unsupported MP3 SoundRate " . Std::string($mp3Header->samplingRate) . ". TAG: " . _hx_string_or_null(_hx_string_call($currentTag, "toString", array())));
		}
		$this->soundData = _hx_anonymous(array("sid" => 1, "format" => format_swf_SoundFormat::$SFMP3, "rate" => $samplingRate, "is16bit" => true, "isStereo" => be_haxer_hxswfml_AudioWriter_1($this, $bytes, $currentTag, $mp3, $mp3Frames, $mp3Header, $mp3Reader, $mp3Writer, $output, $samplingRate), "samples" => $mp3->sampleCount, "data" => format_swf_SoundData::SDMp3(0, $output->getBytes())));
	}
	public $soundData;
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
	function __toString() { return 'be.haxer.hxswfml.AudioWriter'; }
}
function be_haxer_hxswfml_AudioWriter_0(&$__hx__this, &$bytes, &$currentTag, &$mp3, &$mp3Frames, &$mp3Header, &$mp3Reader, &$mp3Writer, &$output) {
	$__hx__t = ($mp3Header->samplingRate);
	switch($__hx__t->index) {
	case 1:
	{
		return format_swf_SoundRate::$SR11k;
	}break;
	case 3:
	{
		return format_swf_SoundRate::$SR22k;
	}break;
	case 6:
	{
		return format_swf_SoundRate::$SR44k;
	}break;
	default:{
		return null;
	}break;
	}
}
function be_haxer_hxswfml_AudioWriter_1(&$__hx__this, &$bytes, &$currentTag, &$mp3, &$mp3Frames, &$mp3Header, &$mp3Reader, &$mp3Writer, &$output, &$samplingRate) {
	$__hx__t = ($mp3Header->channelMode);
	switch($__hx__t->index) {
	case 0:
	{
		return true;
	}break;
	case 1:
	{
		return true;
	}break;
	case 2:
	{
		return true;
	}break;
	case 3:
	{
		return false;
	}break;
	}
}
