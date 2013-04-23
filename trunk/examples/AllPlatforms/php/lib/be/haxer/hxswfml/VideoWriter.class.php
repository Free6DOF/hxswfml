<?php

class be_haxer_hxswfml_VideoWriter {
	public function __construct() {
		;
	}
	public function findActualWidthHeight() {
		$tagBytes = _hx_array_get($this->videoInfo->tags, 0)->data;
		$input = new haxe_io_BytesInput($tagBytes, null, null);
		$dim_y = 0;
		$dim_x = 0;
		$render_y = 0;
		$render_x = 0;
		$this->actualWidth = $this->defaultWidth;
		$this->actualHeight = $this->defaultHeight;
		if($this->videoInfo->codecId === 5) {
			$input->readByte();
			$input->readByte();
			$input->readByte();
			$input->readByte();
			$input->readByte();
			$input->readByte();
			$input->readByte();
			$dim_y = $input->readByte();
			$dim_x = $input->readByte();
			$render_y = $input->readByte();
			$render_x = $input->readByte();
			$this->actualWidth = 16 * $dim_x;
			$this->actualHeight = 16 * $dim_y;
		} else {
			if($this->videoInfo->codecId === 4) {
				$input->readByte();
				$input->readByte();
				$input->readByte();
				$input->readByte();
				$dim_y = $input->readByte();
				$dim_x = $input->readByte();
				$render_y = $input->readByte();
				$render_x = $input->readByte();
				$this->actualWidth = 16 * $dim_x;
				$this->actualHeight = 16 * $dim_y;
			}
		}
		return new _hx_array(array($this->actualWidth, $this->actualHeight));
	}
	public function findVideoInfo($flvTags) {
		$this->videoInfo = _hx_anonymous(array("frameType" => 0, "codecId" => 0, "tags" => new _hx_array(array())));
		$tags = new _hx_array(array());
		{
			$_g1 = 1; $_g = $flvTags->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(_hx_array_get($flvTags, $i)->type === "video") {
					$tags->push($flvTags[$i]);
				}
				unset($i);
			}
		}
		if($tags->length !== 0) {
			$this->videoInfo->frameType = _hx_array_get($tags, 0)->frameType;
			$this->videoInfo->codecId = _hx_array_get($tags, 0)->codecId;
			$this->videoInfo->tags = $tags;
			$this->findActualWidthHeight();
		} else {
			throw new HException("No video tags found in the flv");
		}
		return $this->videoInfo;
	}
	public function findSoundInfo($flvTags) {
		$this->soundInfo = _hx_anonymous(array("tags" => new _hx_array(array()), "soundFormat" => 0, "soundRate" => 0, "is16bit" => false, "isStereo" => false));
		$tags = new _hx_array(array());
		{
			$_g1 = 1; $_g = $flvTags->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(_hx_array_get($flvTags, $i)->type === "audio") {
					$tags->push($flvTags[$i]);
				}
				unset($i);
			}
		}
		$this->soundInfo->tags = $tags;
		$this->soundInfo->soundFormat = _hx_array_get($tags, 0)->soundFormat;
		$this->soundInfo->soundRate = _hx_array_get($tags, 0)->soundRate;
		$this->soundInfo->is16bit = _hx_array_get($tags, 0)->is16bit;
		$this->soundInfo->isStereo = _hx_array_get($tags, 0)->isStereo;
		return $this->soundInfo;
	}
	public function findMetaInfo($flvTags) {
		$metaInfoObj = null;
		{
			$_g1 = 1; $_g = $flvTags->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(_hx_array_get($flvTags, $i)->type === "meta") {
					$metaInfoObj = $flvTags[$i];
					break;
				}
				unset($i);
			}
		}
		return $metaInfoObj;
	}
	public function setCorrectHeaderInfo($flvTags) {
		$this->flvHeader->hasAudio = false;
		$this->flvHeader->hasVideo = false;
		$this->flvHeader->hasMeta = false;
		{
			$_g1 = 1; $_g = $flvTags->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(_hx_array_get($flvTags, $i)->type === "audio") {
					$this->flvHeader->hasAudio = true;
					break;
				}
				unset($i);
			}
		}
		{
			$_g1 = 1; $_g = $flvTags->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(_hx_array_get($flvTags, $i)->type === "video") {
					$this->flvHeader->hasVideo = true;
					break;
				}
				unset($i);
			}
		}
		{
			$_g1 = 1; $_g = $flvTags->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(_hx_array_get($flvTags, $i)->type === "meta") {
					$this->flvHeader->hasMeta = true;
				}
				unset($i);
			}
		}
	}
	public function handleNoMetaData() {
	}
	public function write($flv, $id = null, $defaultFPS = null, $defaultWidth = null, $defaultHeight = null) {
		if($defaultHeight === null) {
			$defaultHeight = 240;
		}
		if($defaultWidth === null) {
			$defaultWidth = 320;
		}
		if($defaultFPS === null) {
			$defaultFPS = 12;
		}
		if($id === null) {
			$id = 1;
		}
		$soundFormats = new _hx_array(array("Linear PCM", "ADPCM", "MP3", "Linear PCM, little endian", "Nellymoser 16-kHz mono", "Nellymoser 8-kHz mono", "Nellymoser", "G.711 A-law logarithmic PCM", "G.711 mu-law logarithmic PCM", "reserved", "AAC", "Speex", "MP3 8-Khz", "Device-specific sound"));
		$videoFormats = new _hx_array(array("", "", "Sorenson H.263", "Screen video", "VP6", "VP6 video with alpha channel"));
		$soundRates = new _hx_array(array(5510, 11025, 22050, 44100));
		$this->defaultFPS = $defaultFPS;
		$this->defaultWidth = $defaultWidth;
		$this->defaultHeight = $defaultHeight;
		$flvTags = $this->parse($flv);
		$this->flvHeader = $flvTags[0];
		$this->setCorrectHeaderInfo($flvTags);
		if($this->flvHeader->hasAudio) {
			$this->soundInfo = $this->findSoundInfo($flvTags);
			if($this->soundInfo->soundFormat !== 2) {
				throw new HException("Error: The flv contains an unsupported audio codec: " . _hx_string_rec($this->soundInfo->soundFormat, "") . ". Currently only MP3 can be transcoded.");
			}
		}
		if($this->flvHeader->hasVideo) {
			$this->videoInfo = $this->findVideoInfo($flvTags);
			if($this->videoInfo->codecId === 4 || $this->videoInfo->codecId === 5 || $this->videoInfo->codecId === 2) {
			} else {
				throw new HException("Error: This flv contains an unsupported video codec: " . _hx_string_rec($this->videoInfo->codecId, "") . "(" . _hx_string_or_null($videoFormats[$this->videoInfo->codecId]) . "). Currently only VP6 and VP6 with alpha can be transcoded.");
			}
		}
		$this->metaInfoObj = $this->findMetaInfo($flvTags);
		if(_hx_field($this, "metaInfoObj") === null) {
			$this->metaInfoObj = _hx_anonymous(array("width" => $this->actualWidth, "height" => $this->actualHeight, "framerate" => $defaultFPS));
		}
		if(_hx_equal($this->metaInfoObj->framerate, 0)) {
			$this->metaInfoObj->framerate = $defaultFPS;
		}
		if(_hx_equal($this->metaInfoObj->width, 0)) {
			$this->metaInfoObj->width = $this->actualWidth;
		}
		if(_hx_equal($this->metaInfoObj->height, 0)) {
			$this->metaInfoObj->height = $this->actualHeight;
		}
		if(_hx_equal($this->metaInfoObj->width, 0) || _hx_equal($this->metaInfoObj->height, 0)) {
			$this->metaInfoObj->width = $defaultWidth;
			$this->metaInfoObj->height = $defaultHeight;
		}
		$this->outTags = new _hx_array(array());
		$defineVideoStreamTag = null;
		if($this->flvHeader->hasVideo) {
			$videoStreamdata = _hx_anonymous(array("numFrames" => $this->videoInfo->tags->length, "width" => Std::int($this->metaInfoObj->width), "height" => Std::int($this->metaInfoObj->height), "deblocking" => false, "smoothing" => false, "codecId" => $this->videoInfo->codecId));
			$defineVideoStreamTag = format_swf_SWFTag::TDefineVideoStream($id + 5000, $videoStreamdata);
			$this->outTags->push($defineVideoStreamTag);
		}
		$controlTags = new _hx_array(array());
		$videoIndex = 0;
		$audioIndex = 0;
		$swfFrameSamplesCount = 0;
		$mp3FrameSamplesCount = 0;
		$currentMp3SamplesTotal = 0;
		$currentSwfSamplesTotal = 0;
		if($this->flvHeader->hasAudio) {
			$mp3FrameSamplesCount = (($soundRates->a[$this->soundInfo->soundRate] > 22050) ? 1152 : 576);
			$swfFrameSamplesCount = Std::int($soundRates->a[$this->soundInfo->soundRate] / $this->metaInfoObj->framerate);
			$currentMp3SamplesTotal = 0;
			$currentSwfSamplesTotal = 0;
			$soundStreamHead2 = _hx_anonymous(array("streamSoundCompression" => $this->soundInfo->soundFormat, "playbackSoundRate" => $this->soundInfo->soundRate, "playbackSoundType" => $this->soundInfo->isStereo, "streamSoundRate" => $this->soundInfo->soundRate, "streamSoundType" => $this->soundInfo->isStereo, "streamSoundSampleCount" => $swfFrameSamplesCount, "latencySeek" => 0));
			$controlTags->push(format_swf_SWFTag::TSoundStreamHead2($soundStreamHead2));
		}
		{
			$_g1 = 0; $_g = $this->videoInfo->tags->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if($this->flvHeader->hasVideo) {
					$placeObject = new format_swf_PlaceObject();
					$placeObject->depth = 1;
					$placeObject->move = $i !== 0;
					$placeObject->ratio = (($i === 0) ? null : $i);
					$placeObject->cid = $id + 5000;
					$placeObject->bitmapCache = null;
					$controlTags->push(format_swf_SWFTag::TPlaceObject2($placeObject));
					$controlTags->push(format_swf_SWFTag::TDefineVideoFrame($id + 5000, $videoIndex, _hx_array_get($this->videoInfo->tags, $videoIndex)->data));
					$videoIndex++;
					unset($placeObject);
				}
				if($this->flvHeader->hasAudio) {
					$seekSamples = $swfFrameSamplesCount * ($videoIndex - 1) - $currentMp3SamplesTotal;
					$neededMP3Frames = Std::int(($swfFrameSamplesCount * $videoIndex - $currentMp3SamplesTotal) / $mp3FrameSamplesCount);
					$currentMp3SamplesTotal += $neededMP3Frames * $mp3FrameSamplesCount;
					$bytesOutput = new haxe_io_BytesOutput();
					{
						$_g2 = 0;
						while($_g2 < $neededMP3Frames) {
							$l = $_g2++;
							if($audioIndex < $this->soundInfo->tags->length - 1) {
								$bytesOutput->write(_hx_array_get($this->soundInfo->tags, $audioIndex)->data);
								$audioIndex++;
							}
							unset($l);
						}
						unset($_g2);
					}
					$samplesCount = $neededMP3Frames * $mp3FrameSamplesCount;
					$bytes = $bytesOutput->getBytes();
					if($bytes->length === 0) {
						$samplesCount = $seekSamples = 0;
					}
					$controlTags->push(format_swf_SWFTag::TSoundStreamBlock($samplesCount, $seekSamples, $bytes));
					unset($seekSamples,$samplesCount,$neededMP3Frames,$bytesOutput,$bytes);
				}
				$controlTags->push(format_swf_SWFTag::$TShowFrame);
				unset($i);
			}
		}
		$controlTags->push(format_swf_SWFTag::$TEnd);
		$placeObject2 = new format_swf_PlaceObject();
		$placeObject2->depth = 1;
		$placeObject2->move = false;
		$placeObject2->cid = $id;
		$placeObject2->bitmapCache = null;
		$swfFile = _hx_anonymous(array("header" => _hx_anonymous(array("version" => 10, "compressed" => true, "width" => Std::int($this->metaInfoObj->width), "height" => Std::int($this->metaInfoObj->height), "fps" => Std::int($this->metaInfoObj->framerate), "nframes" => 1)), "tags" => new _hx_array(array(format_swf_SWFTag::TSandBox(_hx_anonymous(array("useDirectBlit" => false, "useGPU" => false, "hasMetaData" => false, "actionscript3" => true, "useNetWork" => false))), format_swf_SWFTag::TBackgroundColor(16777215), $defineVideoStreamTag, format_swf_SWFTag::TClip($id, $this->videoInfo->tags->length, $controlTags), format_swf_SWFTag::TPlaceObject2($placeObject2), format_swf_SWFTag::$TShowFrame))));
		$this->outTags->push(format_swf_SWFTag::TClip($id, $this->videoInfo->tags->length, $controlTags));
		$swfOutput = new haxe_io_BytesOutput();
		$writer = new format_swf_Writer($swfOutput);
		$writer->write($swfFile);
		$this->swf = $swfOutput->getBytes();
	}
	public function getSWF() {
		return $this->swf;
	}
	public function getTags() {
		return $this->outTags;
	}
	public function parse($bytes) {
		$flvReader = new format_flv_Reader(new haxe_io_BytesInput($bytes, null, null));
		$header = $flvReader->readHeader();
		$flvTags = new _hx_array(array(_hx_anonymous(array("type" => "header", "hasAudio" => $header->hasAudio, "hasVideo" => $header->hasVideo, "hasMeta" => $header->hasMeta))));
		while(true) {
			$flvTag = $flvReader->readChunk();
			if($flvTag === null) {
				break;
			}
			$__hx__t = ($flvTag);
			switch($__hx__t->index) {
			case 0:
			$time = $__hx__t->params[1]; $bytes1 = $__hx__t->params[0];
			{
				$input = new haxe_io_BytesInput($bytes1, null, null);
				$input->set_bigEndian(true);
				$bits = new format_tools_BitsInput($input);
				$flvTags->push(_hx_anonymous(array("time" => $time, "type" => "audio", "soundFormat" => $bits->readBits(4), "soundRate" => $bits->readBits(2), "is16bit" => $bits->readBits(1) === 1, "isStereo" => $bits->readBits(1) === 1, "data" => $input->read($bytes1->length - 1))));
			}break;
			case 1:
			$time = $__hx__t->params[1]; $bytes1 = $__hx__t->params[0];
			{
				$input = new haxe_io_BytesInput($bytes1, null, null);
				$input->set_bigEndian(true);
				$bits = new format_tools_BitsInput($input);
				$frameType = $bits->readBits(4);
				$codecId = $bits->readBits(4);
				$alphaOffset = 0;
				$adjustment = 0;
				$videoData = null;
				switch($codecId) {
				case 4:{
					$adjustment = $input->readByte();
					$videoData = $input->read($bytes1->length - 2);
				}break;
				case 5:{
					$adjustment = $input->readByte();
					$alphaOffset = $input->readUInt24();
					$videoData = $input->read($bytes1->length - 5);
				}break;
				default:{
					$videoData = $input->read($bytes1->length - 1);
				}break;
				}
				$flvTags->push(_hx_anonymous(array("time" => $time, "type" => "video", "frameType" => $frameType, "codecId" => $codecId, "adjustment" => $adjustment, "alphaOffset" => $alphaOffset, "data" => $videoData)));
			}break;
			case 2:
			$time = $__hx__t->params[1]; $bytes1 = $__hx__t->params[0];
			{
				$input = new haxe_io_BytesInput($bytes1, null, null);
				$input->set_bigEndian(true);
				$metaDataObject = _hx_anonymous(array("type" => "meta", "time" => $time, "framerate" => 0, "width" => 0, "height" => 0));
				if($input->readByte() === 2 && $input->readString($input->readUInt16()) === "onMetaData") {
					$ECMAType = $input->readByte();
					$len = null;
					if($ECMAType === 8) {
						$len = $input->readInt32();
					}
					while(true) {
						$l = $input->readUInt16();
						$key = $input->readString($l);
						$valueType = $input->readByte();
						if($l === 0) {
							break;
						}
						$val = null;
						switch($valueType) {
						case 0:{
							$val = $input->readDouble();
						}break;
						case 1:{
							$val = $input->readByte() === 1;
						}break;
						case 2:{
							$val = $input->readString($input->readUInt16());
						}break;
						}
						$metaDataObject->{$key} = $val;
						unset($valueType,$val,$l,$key);
					}
				}
				$flvTags->push($metaDataObject);
			}break;
			}
			unset($flvTag);
		}
		return $flvTags;
	}
	public $swf;
	public $outTags;
	public $defaultHeight;
	public $defaultWidth;
	public $defaultFPS;
	public $actualHeight;
	public $actualWidth;
	public $metaInfoObj;
	public $videoInfo;
	public $soundInfo;
	public $flvHeader;
	public $flvTags;
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
	function __toString() { return 'be.haxer.hxswfml.VideoWriter'; }
}
