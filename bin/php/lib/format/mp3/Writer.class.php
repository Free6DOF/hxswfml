<?php

class format_mp3_Writer {
	public function __construct($output) {
		if( !php_Boot::$skip_constructor ) {
		$this->o = $output;
		$this->o->setEndian(true);
		$this->bits = new format_tools_BitsOutput($this->o);
	}}
	public $o;
	public $bits;
	public function write($mp3, $writeId3v2) {
		if($writeId3v2 === null) {
			$writeId3v2 = true;
		}
		if($writeId3v2 && _hx_field($mp3, "id3v2") !== null) {
			$this->writeID3v2($mp3->id3v2);
		}
		{
			$_g = 0; $_g1 = $mp3->frames;
			while($_g < $_g1->length) {
				$f = $_g1[$_g];
				++$_g;
				$this->writeFrame($f);
				unset($f);
			}
		}
	}
	public function writeID3v2($id3v2) {
		$this->o->writeString("ID3");
		$this->o->writeUInt16($id3v2->versionBytes);
		$this->o->writeByte($id3v2->flagByte);
		$arr = new _hx_array(array());
		$l = $id3v2->data->length;
		{
			$_g = 0;
			while($_g < 4) {
				$i = $_g++;
				$arr->push($l & 127);
				$l >>= 7;
				unset($i);
			}
		}
		{
			$_g2 = 0;
			while($_g2 < 4) {
				$i2 = $_g2++;
				$this->bits->writeBit(false);
				$this->bits->writeBits(7, $arr[3 - $i2]);
				unset($i2);
			}
		}
		{
			$_g3 = $this->bits;
			if($_g3->nbits > 0) {
				$_g3->writeBits(8 - $_g3->nbits, 0);
				$_g3->nbits = 0;
			}
		}
		$this->o->write($id3v2->data);
	}
	public function writeFrame($f) {
		$this->o->writeByte(255);
		$this->bits->writeBits(3, 7);
		$h = $f->header;
		$this->bits->writeBits(2, format_mp3_MPEG::enum2Num($h->version));
		$this->bits->writeBits(2, format_mp3_CLayer::enum2Num($h->layer));
		$this->bits->writeBit(!$h->hasCrc);
		$this->bits->writeBits(4, format_mp3_MPEG::getBitrateIdx($h->bitrate, $h->version, $h->layer));
		$this->bits->writeBits(2, format_mp3_MPEG::getSamplingRateIdx($h->samplingRate, $h->version));
		$this->bits->writeBit($h->isPadded);
		$this->bits->writeBit($h->privateBit);
		$this->bits->writeBits(2, format_mp3_CChannelMode::enum2Num($h->channelMode));
		$this->bits->writeBit($h->isIntensityStereo);
		$this->bits->writeBit($h->isMSStereo);
		$this->bits->writeBit($h->isCopyrighted);
		$this->bits->writeBit($h->isOriginal);
		$this->bits->writeBits(2, format_mp3_CEmphasis::enum2Num($h->emphasis));
		{
			$_g = $this->bits;
			if($_g->nbits > 0) {
				$_g->writeBits(8 - $_g->nbits, 0);
				$_g->nbits = 0;
			}
		}
		if($h->hasCrc) {
			$this->o->writeUInt16($h->crc16);
		}
		$this->o->write($f->data);
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	static $WRITE_ID3V2 = true;
	static $DONT_WRITE_ID3V2 = false;
	function __toString() { return 'format.mp3.Writer'; }
}
