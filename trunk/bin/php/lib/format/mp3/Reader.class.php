<?php

class format_mp3_Reader {
	public function __construct($i) {
		if( !php_Boot::$skip_constructor ) {
		$this->i = $i;
		$i->setEndian(true);
		$this->bits = new format_tools_BitsInput($i);
		$this->samples = 0;
		$this->sampleSize = 0;
		$this->any_read = false;
	}}
	public $i;
	public $bits;
	public $version;
	public $samples;
	public $sampleSize;
	public $any_read;
	public $id3v2_data;
	public $id3v2_version;
	public $id3v2_flags;
	public function skipID3v2() {
		$this->id3v2_version = $this->i->readUInt16();
		$this->id3v2_flags = $this->i->readByte();
		$size = $this->i->readByte() & 127;
		$size = (($size << 7) | ($this->i->readByte() & 127));
		$size = (($size << 7) | ($this->i->readByte() & 127));
		$size = (($size << 7) | ($this->i->readByte() & 127));
		$this->id3v2_data = $this->i->read($size);
	}
	public function seekFrame() {
		$found = false;
		try {
			$b = null;
			while(true) {
				$b = $this->i->readByte();
				if(!$this->any_read) {
					$this->any_read = true;
					if($b === 73) {
						$b = $this->i->readByte();
						if($b === 68) {
							$b = $this->i->readByte();
							if($b === 51) {
								$this->skipID3v2();
							}
						}
					}
				}
				if($b === 255) {
					$this->bits->nbits = 0;
					$b = $this->bits->readBits(3);
					if($b === 7) {
						return format_mp3_FrameType::$FT_MP3;
					}
				}
				;
			}
			return format_mp3_FrameType::$FT_NONE;
		}catch(Exception $»e) {
		$_ex_ = ($»e instanceof HException) ? $»e->e : $»e;
		;
		if(($ex = $_ex_) instanceof haxe_io_Eof){
			return format_mp3_FrameType::$FT_NONE;
		} else throw $»e; }
	}
	public function readFrames() {
		$frames = new _hx_array(array());
		$ft = null;
		while(($ft = $this->seekFrame()) != format_mp3_FrameType::$FT_NONE) {
			$»t = ($ft);
			switch($»t->index) {
			case 0:
			{
				$f = $this->readFrame();
				if($f !== null) {
					$frames->push($f);
				}
			}break;
			case 1:
			{
				;
			}break;
			}
			unset($»t,$f);
		}
		return $frames;
	}
	public function readFrameHeader() {
		$version = $this->bits->readBits(2);
		$layer = $this->bits->readBits(2);
		$hasCrc = !$this->bits->read();
		if($version === format_mp3_MPEG::$Reserved || $layer === format_mp3_CLayer::$LReserved) {
			return null;
		}
		$bitrateIdx = $this->bits->readBits(4);
		$bitrate = format_mp3_Tools::getBitrate($version, $layer, $bitrateIdx);
		$samplingRateIdx = $this->bits->readBits(2);
		$samplingRate = format_mp3_Tools::getSamplingRate($version, $samplingRateIdx);
		$isPadded = $this->bits->read();
		$privateBit = $this->bits->read();
		if($bitrate === format_mp3_Bitrate::$BR_Bad || $bitrate === format_mp3_Bitrate::$BR_Free || $samplingRate === format_mp3_SamplingRate::$SR_Bad) {
			return null;
		}
		$channelMode = $this->bits->readBits(2);
		$isIntensityStereo = $this->bits->read();
		$isMSStereo = $this->bits->read();
		$isCopyrighted = $this->bits->read();
		$isOriginal = $this->bits->read();
		$emphasis = $this->bits->readBits(2);
		$crc16 = 0;
		if($hasCrc) {
			$crc16 = $this->i->readUInt16();
		}
		return _hx_anonymous(array("version" => format_mp3_MPEG::num2Enum($version), "layer" => format_mp3_CLayer::num2Enum($layer), "hasCrc" => $hasCrc, "crc16" => $crc16, "bitrate" => $bitrate, "samplingRate" => $samplingRate, "isPadded" => $isPadded, "privateBit" => $privateBit, "channelMode" => format_mp3_CChannelMode::num2Enum($channelMode), "isIntensityStereo" => $isIntensityStereo, "isMSStereo" => $isMSStereo, "isCopyrighted" => $isCopyrighted, "isOriginal" => $isOriginal, "emphasis" => format_mp3_CEmphasis::num2Enum($emphasis)));
	}
	public function readFrame() {
		$header = $this->readFrameHeader();
		if($header === null || format_mp3_Tools::isInvalidFrameHeader($header)) {
			return null;
		}
		try {
			$data = $this->i->read(format_mp3_Tools::getSampleDataSizeHdr($header));
			$this->samples += format_mp3_Tools::getSampleCountHdr($header);
			$this->sampleSize += $data->length;
			return _hx_anonymous(array("header" => $header, "data" => $data));
		}catch(Exception $»e) {
		$_ex_ = ($»e instanceof HException) ? $»e->e : $»e;
		;
		if(($e = $_ex_) instanceof haxe_io_Eof){
			return null;
		} else throw $»e; }
	}
	public function read() {
		$fs = $this->readFrames();
		return _hx_anonymous(array("frames" => $fs, "sampleCount" => $this->samples, "sampleSize" => $this->sampleSize, "id3v2" => (($this->id3v2_data === null) ? null : _hx_anonymous(array("versionBytes" => $this->id3v2_version, "flagByte" => $this->id3v2_flags, "data" => $this->id3v2_data)))));
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	function __toString() { return 'format.mp3.Reader'; }
}
