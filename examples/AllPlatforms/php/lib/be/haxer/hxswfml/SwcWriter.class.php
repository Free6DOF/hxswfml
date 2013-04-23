<?php

class be_haxer_hxswfml_SwcWriter {
	public function __construct() {
		;
	}
	public function createXML($mod, $classes) {
		$xmlString = "";
		$xmlString .= "<?xml version=\"1.0\" encoding =\"utf-8\"?>\x0A";
		$xmlString .= "<swc xmlns=\"http://www.adobe.com/flash/swccatalog/9\">\x0A";
		$xmlString .= "\x09<versions>\x0A";
		$xmlString .= "\x09\x09<swc version=\"1.2\"/>\x0A";
		$xmlString .= "\x09\x09<haxe version=\"2.09\"/>\x0A";
		$xmlString .= "\x09</versions>\x0A";
		$xmlString .= "\x09<features>\x0A";
		$xmlString .= "\x09\x09<feature-script-deps/>\x0A";
		$xmlString .= "\x09\x09<feature-files/>\x0A";
		$xmlString .= "\x09</features>\x0A";
		$xmlString .= "\x09<libraries>\x0A";
		$xmlString .= "\x09\x09<library path=\"library.swf\">\x0A";
		{
			$_g = 0;
			while($_g < $classes->length) {
				$i = $classes[$_g];
				++$_g;
				$xmlString .= "\x09\x09\x09<script name=\"" . _hx_string_or_null(_hx_explode(".", $i[0])->join("/")) . "\" mod=\"0\" >\x0A";
				$def = _hx_explode(".", $i[0]);
				if($def->length === 1) {
					$xmlString .= "\x09\x09\x09\x09<def id=\"" . _hx_string_or_null($def[0]) . "\"/>\x0A";
				} else {
					if($def->length === 2) {
						$xmlString .= "\x09\x09\x09\x09<dep id=\"" . _hx_string_or_null($def[0]) . ":" . _hx_string_or_null($def[1]) . "\"/>\x0A";
					} else {
						if($def->length > 2) {
							$xmlString .= "\x09\x09\x09\x09<def id=\"" . _hx_string_or_null($def[0]);
							{
								$_g2 = 1; $_g1 = $def->length - 1;
								while($_g2 < $_g1) {
									$j = $_g2++;
									$xmlString .= "." . _hx_string_or_null($def[$j]);
									unset($j);
								}
								unset($_g2,$_g1);
							}
							$xmlString .= ":" . _hx_string_or_null($def[$def->length - 1]) . "\" />\x0A";
						}
					}
				}
				$dep = _hx_explode(".", $i[1]);
				if($dep->length === 1) {
					$xmlString .= "\x09\x09\x09\x09<dep id=\"" . _hx_string_or_null($dep[0]) . "\" type=\"i\" />\x0A";
				} else {
					if($dep->length === 2) {
						$xmlString .= "\x09\x09\x09\x09<dep id=\"" . _hx_string_or_null($dep[0]) . ":" . _hx_string_or_null($dep[1]) . "\" type=\"i\" />\x0A";
					} else {
						if($dep->length > 2) {
							$xmlString .= "\x09\x09\x09\x09<dep id=\"" . _hx_string_or_null($dep[0]);
							{
								$_g2 = 1; $_g1 = $dep->length - 1;
								while($_g2 < $_g1) {
									$j = $_g2++;
									$xmlString .= "." . _hx_string_or_null($dep[$j]);
									unset($j);
								}
								unset($_g2,$_g1);
							}
							$xmlString .= ":" . _hx_string_or_null($dep[$dep->length - 1]) . "\" type=\"i\" />\x0A";
						}
					}
				}
				$xmlString .= "\x09\x09\x09\x09<dep id=\"AS3\" type=\"n\" />\x0A";
				$xmlString .= "\x09\x09\x09</script>\x0A";
				unset($i,$dep,$def);
			}
		}
		$xmlString .= "\x09\x09</library>\x0A";
		$xmlString .= "\x09</libraries>\x0A";
		$xmlString .= "\x09<files>\x0A";
		$xmlString .= "\x09</files>\x0A";
		$xmlString .= "</swc>\x0A";
		return $xmlString;
	}
	public function getSWC() {
		return $this->swc;
	}
	public function write($classes, $library) {
		$date = Date::now();
		$mod = $date->getTime();
		$xmlString = $this->createXML($mod, $classes);
		$xmlBytes = haxe_io_Bytes::ofString($xmlString);
		$zipBytesOutput = new haxe_io_BytesOutput();
		$zipWriter = new format_zip_Writer($zipBytesOutput);
		$data = new HList();
		$data->push(_hx_anonymous(array("fileName" => "catalog.xml", "fileSize" => $xmlBytes->length, "fileTime" => $date, "compressed" => false, "dataSize" => $xmlBytes->length, "data" => $xmlBytes, "crc32" => format_tools_CRC32::encode($xmlBytes), "extraFields" => new HList())));
		$data->push(_hx_anonymous(array("fileName" => "library.swf", "fileSize" => $library->length, "fileTime" => $date, "compressed" => false, "dataSize" => $library->length, "data" => $library, "crc32" => format_tools_CRC32::encode($library), "extraFields" => new HList())));
		$zipWriter->writeData($data);
		$this->swc = $zipBytesOutput->getBytes();
		return $this->swc;
	}
	public $swc;
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
	function __toString() { return 'be.haxer.hxswfml.SwcWriter'; }
}
