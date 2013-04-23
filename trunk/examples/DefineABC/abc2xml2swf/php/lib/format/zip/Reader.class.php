<?php

class format_zip_Reader {
	public function __construct($i) {
		if(!php_Boot::$skip_constructor) {
		$this->i = $i;
	}}
	public function read() {
		$l = new HList();
		$buf = null;
		$tmp = null;
		while(true) {
			$e = $this->readEntryHeader();
			if($e === null) {
				break;
			}
			if($e->dataSize < 0) {
				$bufSize = 65536;
				if($tmp === null) {
					$tmp = haxe_io_Bytes::alloc($bufSize);
				}
				$out = new haxe_io_BytesBuffer();
				$z = new format_tools_InflateImpl($this->i, false, false);
				while(true) {
					$n = $z->readBytes($tmp, 0, $bufSize);
					{
						if($n < 0 || $n > $tmp->length) {
							throw new HException(haxe_io_Error::$OutsideBounds);
						}
						$out->b .= _hx_string_or_null(substr($tmp->b, 0, $n));
					}
					if($n < $bufSize) {
						break;
					}
					unset($n);
				}
				$e->data = $out->getBytes();
				$e->crc32 = $this->i->readInt32();
				if($e->crc32 === 134695760) {
					$e->crc32 = $this->i->readInt32();
				}
				$e->dataSize = $this->i->readInt32();
				$e->fileSize = $this->i->readInt32();
				$e->dataSize = $e->fileSize;
				$e->compressed = false;
				unset($z,$out,$bufSize);
			} else {
				$e->data = $this->i->read($e->dataSize);
			}
			$l->add($e);
			unset($e);
		}
		return $l;
	}
	public function readEntryData($e, $buf, $out) {
		format_tools_IO::copy($this->i, $out, $buf, $e->dataSize);
	}
	public function readEntryHeader() {
		$i = $this->i;
		$h = $i->readInt32();
		if($h === 33639248 || $h === 101010256) {
			return null;
		}
		if($h !== 67324752) {
			throw new HException("Invalid Zip Data");
		}
		$version = $i->readUInt16();
		$flags = $i->readUInt16();
		$utf8 = ($flags & 2048) !== 0;
		if(($flags & 63479) !== 0) {
			throw new HException("Unsupported flags " . _hx_string_rec($flags, ""));
		}
		$compression = $i->readUInt16();
		$compressed = $compression !== 0;
		if($compressed && $compression !== 8) {
			throw new HException("Unsupported compression " . _hx_string_rec($compression, ""));
		}
		$mtime = $this->readZipDate();
		$crc32 = $i->readInt32();
		$csize = $i->readInt32();
		$usize = $i->readInt32();
		$fnamelen = $i->readInt16();
		$elen = $i->readInt16();
		$fname = $i->readString($fnamelen);
		$fields = $this->readExtraFields($elen);
		if($utf8) {
			$fields->push(format_zip_ExtraField::$FUtf8);
		}
		$data = null;
		if(($flags & 8) !== 0) {
			$csize = -1;
		}
		return _hx_anonymous(array("fileName" => $fname, "fileSize" => $usize, "fileTime" => $mtime, "compressed" => $compressed, "dataSize" => $csize, "data" => $data, "crc32" => $crc32, "extraFields" => $fields));
	}
	public function readExtraFields($length) {
		$fields = new HList();
		while($length > 0) {
			if($length < 4) {
				throw new HException("Invalid extra fields data");
			}
			$tag = $this->i->readUInt16();
			$len = $this->i->readUInt16();
			if($length < $len) {
				throw new HException("Invalid extra fields data");
			}
			switch($tag) {
			case 28789:{
				$version = $this->i->readByte();
				if($version !== 1) {
					$data = new haxe_io_BytesBuffer();
					$data->b .= _hx_string_or_null(chr($version));
					$data->b .= _hx_string_or_null($this->i->read($len - 1)->b);
					$fields->add(format_zip_ExtraField::FUnknown($tag, $data->getBytes()));
				} else {
					$crc = $this->i->readInt32();
					$name = $this->i->read($len - 5)->toString();
					$fields->add(format_zip_ExtraField::FInfoZipUnicodePath($name, $crc));
				}
			}break;
			default:{
				$fields->add(format_zip_ExtraField::FUnknown($tag, $this->i->read($len)));
			}break;
			}
			$length -= 4 + $len;
			unset($tag,$len);
		}
		return $fields;
	}
	public function readZipDate() {
		$t = $this->i->readUInt16();
		$hour = $t >> 11 & 31;
		$min = $t >> 5 & 63;
		$sec = $t & 31;
		$d = $this->i->readUInt16();
		$year = $d >> 9;
		$month = $d >> 5 & 15;
		$day = $d & 31;
		return new Date($year + 1980, $month - 1, $day, $hour, $min, $sec << 1);
	}
	public $i;
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
	function __toString() { return 'format.zip.Reader'; }
}
