<?php

class format_zip_Writer {
	public function __construct($o) {
		if(!php_Boot::$skip_constructor) {
		$this->o = $o;
		$this->files = new HList();
	}}
	public function writeCDR() {
		$cdr_size = 0;
		$cdr_offset = 0;
		if(null == $this->files) throw new HException('null iterable');
		$__hx__it = $this->files->iterator();
		while($__hx__it->hasNext()) {
			$f = $__hx__it->next();
			$namelen = strlen($f->name);
			$extraFieldsLength = $f->fields->length;
			$this->o->writeInt32(33639248);
			$this->o->writeUInt16(20);
			$this->o->writeUInt16(20);
			$this->o->writeUInt16(0);
			$this->o->writeUInt16((($f->compressed) ? 8 : 0));
			$this->writeZipDate($f->date);
			$this->o->writeInt32($f->crc);
			$this->o->writeInt32($f->clen);
			$this->o->writeInt32($f->size);
			$this->o->writeUInt16($namelen);
			$this->o->writeUInt16($extraFieldsLength);
			$this->o->writeUInt16(0);
			$this->o->writeUInt16(0);
			$this->o->writeUInt16(0);
			$this->o->writeInt32(0);
			$this->o->writeInt32($cdr_offset);
			$this->o->writeString($f->name);
			$this->o->write($f->fields);
			$cdr_size += 46 + $namelen + $extraFieldsLength;
			$cdr_offset += 30 + $namelen + $extraFieldsLength + $f->clen;
			unset($namelen,$extraFieldsLength);
		}
		$this->o->writeInt32(101010256);
		$this->o->writeUInt16(0);
		$this->o->writeUInt16(0);
		$this->o->writeUInt16($this->files->length);
		$this->o->writeUInt16($this->files->length);
		$this->o->writeInt32($cdr_size);
		$this->o->writeInt32($cdr_offset);
		$this->o->writeUInt16(0);
	}
	public function writeData($files) {
		if(null == $files) throw new HException('null iterable');
		$__hx__it = $files->iterator();
		while($__hx__it->hasNext()) {
			$f = $__hx__it->next();
			$this->writeEntryHeader($f);
			$this->o->writeFullBytes($f->data, 0, $f->data->length);
		}
		$this->writeCDR();
	}
	public function writeEntryData($e, $buf, $data) {
		format_tools_IO::copy($data, $this->o, $buf, $e->dataSize);
	}
	public function writeEntryHeader($f) {
		$o = $this->o;
		$flags = 0;
		if(null == $f->extraFields) throw new HException('null iterable');
		$__hx__it = $f->extraFields->iterator();
		while($__hx__it->hasNext()) {
			$e = $__hx__it->next();
			$__hx__t = ($e);
			switch($__hx__t->index) {
			case 2:
			{
				$flags |= 2048;
			}break;
			default:{
			}break;
			}
		}
		$this->o->writeInt32(67324752);
		$o->writeUInt16(20);
		$o->writeUInt16($flags);
		if($f->data === null) {
			$f->fileSize = 0;
			$f->dataSize = 0;
			$f->crc32 = 0;
			$f->compressed = false;
			$f->data = haxe_io_Bytes::alloc(0);
		} else {
			if(!$f->compressed) {
				$f->fileSize = $f->data->length;
			}
			$f->dataSize = $f->data->length;
		}
		$o->writeUInt16((($f->compressed) ? 8 : 0));
		$this->writeZipDate($f->fileTime);
		$o->writeInt32($f->crc32);
		$this->o->writeInt32($f->dataSize);
		$this->o->writeInt32($f->fileSize);
		$o->writeUInt16(strlen($f->fileName));
		$e = new haxe_io_BytesOutput();
		if(null == $f->extraFields) throw new HException('null iterable');
		$__hx__it = $f->extraFields->iterator();
		while($__hx__it->hasNext()) {
			$f1 = $__hx__it->next();
			$__hx__t = ($f1);
			switch($__hx__t->index) {
			case 1:
			$crc = $__hx__t->params[1]; $name = $__hx__t->params[0];
			{
				$namebytes = haxe_io_Bytes::ofString($name);
				$e->writeUInt16(28789);
				$e->writeUInt16($namebytes->length + 5);
				$e->writeByte(1);
				$e->writeInt32($crc);
				$e->write($namebytes);
			}break;
			case 0:
			$bytes = $__hx__t->params[1]; $tag = $__hx__t->params[0];
			{
				$e->writeUInt16($tag);
				$e->writeUInt16($bytes->length);
				$e->write($bytes);
			}break;
			case 2:
			{
			}break;
			}
		}
		$ebytes = $e->getBytes();
		$o->writeUInt16($ebytes->length);
		$o->writeString($f->fileName);
		$o->write($ebytes);
		$this->files->add(_hx_anonymous(array("name" => $f->fileName, "compressed" => $f->compressed, "clen" => $f->data->length, "size" => $f->fileSize, "crc" => $f->crc32, "date" => $f->fileTime, "fields" => $ebytes)));
	}
	public function writeZipDate($date) {
		$hour = $date->getHours();
		$min = $date->getMinutes();
		$sec = $date->getSeconds() >> 1;
		$this->o->writeUInt16($hour << 11 | $min << 5 | $sec);
		$year = $date->getFullYear() - 1980;
		$month = $date->getMonth() + 1;
		$day = $date->getDate();
		$this->o->writeUInt16($year << 9 | $month << 5 | $day);
	}
	public function writeInt($v) {
		$this->o->writeInt32($v);
	}
	public $files;
	public $o;
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
	function __toString() { return 'format.zip.Writer'; }
}
