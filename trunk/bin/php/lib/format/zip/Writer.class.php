<?php

class format_zip_Writer {
	public function __construct($o) {
		if( !php_Boot::$skip_constructor ) {
		$this->o = $o;
		$this->files = new HList();
	}}
	public $o;
	public $files;
	public function writeZipDate($date) {
		$hour = $date->getHours();
		$min = $date->getMinutes();
		$sec = $date->getSeconds() >> 1;
		$this->o->writeUInt16((($hour << 11) | ($min << 5)) | $sec);
		$year = $date->getFullYear() - 1980;
		$month = $date->getMonth() + 1;
		$day = $date->getDate();
		$this->o->writeUInt16((($year << 9) | ($month << 5)) | $day);
	}
	public function writeEntryHeader($f) {
		$o = $this->o;
		$o->writeUInt30(67324752);
		$o->writeUInt16(20);
		$o->writeUInt16(0);
		if($f->data === null) {
			$f->fileSize = 0;
			$f->dataSize = 0;
			$f->crc32 = 0;
			$f->compressed = false;
			$f->data = haxe_io_Bytes::alloc(0);
		}
		else {
			if(_hx_field($f, "crc32") === null) {
				if($f->compressed) {
					throw new HException("CRC32 must be processed before compression");
				}
				$f->crc32 = format_tools_CRC32::encode($f->data);
			}
			if(!$f->compressed) {
				$f->fileSize = $f->data->length;
			}
			$f->dataSize = $f->data->length;
		}
		$o->writeUInt16(($f->compressed ? 8 : 0));
		$this->writeZipDate($f->fileTime);
		$o->writeInt32($f->crc32);
		$o->writeUInt30($f->dataSize);
		$o->writeUInt30($f->fileSize);
		$o->writeUInt16(strlen($f->fileName));
		$e = new haxe_io_BytesOutput();
		if($f->extraFields !== null) {
			$»it = $f->extraFields->iterator();
			while($»it->hasNext()) {
			$f1 = $»it->next();
			{
				$»t = ($f1);
				switch($»t->index) {
				case 1:
				$crc = $»t->params[1]; $name = $»t->params[0];
				{
					$namebytes = haxe_io_Bytes::ofString($name);
					$e->writeUInt16(28789);
					$e->writeUInt16($namebytes->length + 5);
					$e->writeByte(1);
					$e->writeInt32($crc);
					$e->write($namebytes);
				}break;
				case 0:
				$bytes = $»t->params[1]; $tag = $»t->params[0];
				{
					$e->writeUInt16($tag);
					$e->writeUInt16($bytes->length);
					$e->write($bytes);
				}break;
				}
				unset($»t,$tag,$namebytes,$name,$crc,$bytes);
			}
			}
		}
		$ebytes = $e->getBytes();
		$o->writeUInt16($ebytes->length);
		$o->writeString($f->fileName);
		$o->write($ebytes);
		$this->files->add(_hx_anonymous(array("name" => $f->fileName, "compressed" => $f->compressed, "clen" => $f->data->length, "size" => $f->fileSize, "crc" => $f->crc32, "date" => $f->fileTime, "fields" => $ebytes)));
	}
	public function writeEntryData($e, $buf, $data) {
		format_tools_IO::copy($data, $this->o, $buf, $e->dataSize);
	}
	public function writeData($files) {
		$»it = $files->iterator();
		while($»it->hasNext()) {
		$f = $»it->next();
		{
			$this->writeEntryHeader($f);
			$this->o->writeFullBytes($f->data, 0, $f->data->length);
			;
		}
		}
		$this->writeCDR();
	}
	public function writeCDR() {
		$cdr_size = 0;
		$cdr_offset = 0;
		$»it = $this->files->iterator();
		while($»it->hasNext()) {
		$f = $»it->next();
		{
			$namelen = strlen($f->name);
			$extraFieldsLength = $f->fields->length;
			$this->o->writeUInt30(33639248);
			$this->o->writeUInt16(20);
			$this->o->writeUInt16(20);
			$this->o->writeUInt16(0);
			$this->o->writeUInt16(($f->compressed ? 8 : 0));
			$this->writeZipDate($f->date);
			$this->o->writeInt32($f->crc);
			$this->o->writeUInt30($f->clen);
			$this->o->writeUInt30($f->size);
			$this->o->writeUInt16($namelen);
			$this->o->writeUInt16($extraFieldsLength);
			$this->o->writeUInt16(0);
			$this->o->writeUInt16(0);
			$this->o->writeUInt16(0);
			$this->o->writeUInt30(0);
			$this->o->writeUInt30($cdr_offset);
			$this->o->writeString($f->name);
			$this->o->write($f->fields);
			$cdr_size += 46 + $namelen + $extraFieldsLength;
			$cdr_offset += 30 + $namelen + $extraFieldsLength + $f->clen;
			unset($namelen,$extraFieldsLength);
		}
		}
		$this->o->writeUInt30(101010256);
		$this->o->writeUInt16(0);
		$this->o->writeUInt16(0);
		$this->o->writeUInt16($this->files->length);
		$this->o->writeUInt16($this->files->length);
		$this->o->writeUInt30($cdr_size);
		$this->o->writeUInt30($cdr_offset);
		$this->o->writeUInt16(0);
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	static $CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE = 46;
	static $LOCAL_FILE_HEADER_FIELDS_SIZE = 30;
	function __toString() { return 'format.zip.Writer'; }
}
