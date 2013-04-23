<?php

class be_haxer_hxswfml_Main {
	public function __construct(){}
	static $args;
	static function main() {
		be_haxer_hxswfml_Main::$args = Sys::args();
		if(be_haxer_hxswfml_Main::$args->length < 2) {
			be_haxer_hxswfml_Main::printUsage();
		} else {
			$op = be_haxer_hxswfml_Main::$args[0];
			switch($op) {
			case "xml2swf":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$strict = !be_haxer_hxswfml_Main::argExists("-no-strict");
				$str = sys_io_File::getContent($inFile);
				$swfWriter = new be_haxer_hxswfml_SwfWriter();
				$bytes = $swfWriter->write($str, $strict);
				$handle = sys_io_File::write($outFile, true);
				$handle->write($bytes);
				$handle->close();
			}break;
			case "xml2lib":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$str = sys_io_File::getContent($inFile);
				$libWriter = new be_haxer_hxswfml_SwfLibWriter();
				$bytes = $libWriter->write($str);
				$handle = sys_io_File::write($outFile, true);
				$handle->write($bytes);
				$handle->close();
			}break;
			case "lib2swc":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$str = sys_io_File::getContent($inFile);
				$libWriter = new be_haxer_hxswfml_SwfLibWriter();
				$libWriter->write($str);
				$bytes = $libWriter->getSWC();
				$handle = sys_io_File::write($outFile, true);
				$handle->write($bytes);
				$handle->close();
			}break;
			case "xml2swc":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$strict = !be_haxer_hxswfml_Main::argExists("-no-strict");
				$swfWriter = new be_haxer_hxswfml_SwfWriter();
				$swfWriter->write(sys_io_File::getContent($inFile), $strict);
				sys_io_File::write($outFile, true)->write($swfWriter->getSWC());
			}break;
			case "xml2abc":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$abcWriter = new be_haxer_hxswfml_AbcWriter();
				$abcWriter->log = be_haxer_hxswfml_Main::argExists("-stack");
				$abcWriter->strict = be_haxer_hxswfml_Main::argExists("-strict");
				sys_io_File::write($outFile, true)->write($abcWriter->write(sys_io_File::getContent($inFile)));
			}break;
			case "abc2swf":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$main = be_haxer_hxswfml_Main::getArgValue("-main");
				$log = be_haxer_hxswfml_Main::argExists("-stack");
				$strict = be_haxer_hxswfml_Main::argExists("-strict");
				$extension = strtolower(_hx_substr($inFile, _hx_last_index_of($inFile, ".", null) + 1, null));
				$abcWriter = new be_haxer_hxswfml_AbcWriter();
				$abcWriter->log = $log;
				$abcWriter->strict = $strict;
				switch($extension) {
				case "xml":{
					$abcWriter->write(sys_io_File::getContent($inFile));
				}break;
				case "abc":{
					$abcWriter->abc2swf(sys_io_File::getBytes($inFile));
				}break;
				default:{
				}break;
				}
				sys_io_File::write($outFile, true)->write($abcWriter->getSWF($main, null, null, null, null, null, null));
			}break;
			case "abc2swc":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$main = be_haxer_hxswfml_Main::getArgValue("-main");
				$log = be_haxer_hxswfml_Main::argExists("-stack");
				$strict = be_haxer_hxswfml_Main::argExists("-strict");
				$extension = strtolower(_hx_substr($inFile, _hx_last_index_of($inFile, ".", null) + 1, null));
				$abcWriter = new be_haxer_hxswfml_AbcWriter();
				$abcWriter->log = $log;
				$abcWriter->strict = $strict;
				switch($extension) {
				case "xml":{
					$abcWriter->write(sys_io_File::getContent($inFile));
				}break;
				default:{
				}break;
				}
				sys_io_File::write($outFile, true)->write($abcWriter->getSWC($main));
			}break;
			case "abc2xml":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$debug = !be_haxer_hxswfml_Main::argExists("-no-debug");
				$source = be_haxer_hxswfml_Main::argExists("-source");
				$extension = strtolower(_hx_substr($inFile, _hx_last_index_of($inFile, ".", null) + 1, null));
				$abcReader = new be_haxer_hxswfml_AbcReader();
				$abcReader->debugInfo = $debug;
				$abcReader->sourceInfo = $source;
				$abcReader->read($extension, sys_io_File::getBytes($inFile));
				sys_io_File::write($outFile, false)->writeString($abcReader->getXML());
			}break;
			case "abc2hxm":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$mainClass = be_haxer_hxswfml_Main::getArgValue("-main");
				if($mainClass === null) {
					throw new HException("Missing class for -main");
				}
				$useFolders = be_haxer_hxswfml_Main::argExists("-folders");
				$debugInfo = !be_haxer_hxswfml_Main::argExists("-no-debug");
				$sourceInfo = be_haxer_hxswfml_Main::argExists("-source");
				$showBytePos = be_haxer_hxswfml_Main::argExists("-bytepos");
				$log = be_haxer_hxswfml_Main::argExists("-stack");
				$strict = be_haxer_hxswfml_Main::argExists("-strict");
				$extension = strtolower(_hx_substr($inFile, _hx_last_index_of($inFile, ".", null) + 1, null));
				$abcReader = new be_haxer_hxswfml_AbcReader();
				$abcReader->debugInfo = true;
				$abcReader->sourceInfo = false;
				$abcReader->read($extension, sys_io_File::getBytes($inFile));
				$xml = $abcReader->getXML();
				$hxmWriter = new be_haxer_hxswfml_HxmWriter();
				$hxmWriter->debugInfo = true;
				$hxmWriter->sourceInfo = $sourceInfo;
				$hxmWriter->useFolders = $useFolders;
				$hxmWriter->showBytePos = $showBytePos;
				$hxmWriter->strict = $strict;
				$hxmWriter->log = $log;
				$hxmWriter->outputFolder = "";
				$hxmWriter->write($xml);
				$zip = $hxmWriter->getZIP($mainClass);
				sys_io_File::write($outFile, true)->write($zip);
			}break;
			case "ttf2swf":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$className = be_haxer_hxswfml_Main::getArgValue("-class");
				if($className === null) {
					throw new HException("Missing class name for font");
				}
				$ranges = be_haxer_hxswfml_Main::getArgValue("-glyphs");
				if($ranges === null) {
					$ranges = "32-126";
				}
				$fontWriter = new be_haxer_hxswfml_FontWriter();
				$fontWriter->write(sys_io_File::getBytes($inFile), $ranges, "swf", null);
				sys_io_File::write($outFile, true)->write($fontWriter->getSWF(1, $className, 10, true, 1024, 1024, 30, 1));
			}break;
			case "dumpttf":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				sys_io_File::write($outFile, false)->writeString(_hx_deref(new be_haxer_hxswfml_FontWriter())->listGlyphs(sys_io_File::getBytes($inFile)));
			}break;
			case "ttf2hx":{
				if(be_haxer_hxswfml_Main::$args->length < 2) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$ranges = be_haxer_hxswfml_Main::getArgValue("-glyphs");
				if($ranges === null) {
					$ranges = "32-126";
				}
				$precision = be_haxer_hxswfml_Main::getArgValue("-precision");
				$fontWriter = new be_haxer_hxswfml_FontWriter();
				if($precision !== null) {
					$fontWriter->precision = Std::parseInt($precision);
				}
				$fontWriter->write(sys_io_File::getBytes($inFile), $ranges, "zip", null);
				sys_io_File::write(_hx_string_or_null($fontWriter->fontName) . ".zip", true)->write($fontWriter->getZip());
			}break;
			case "ttf2path":{
				if(be_haxer_hxswfml_Main::$args->length < 2) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$ranges = be_haxer_hxswfml_Main::getArgValue("-glyphs");
				if($ranges === null) {
					$ranges = "32-126";
				}
				$precision = be_haxer_hxswfml_Main::getArgValue("-precision");
				$fontWriter = new be_haxer_hxswfml_FontWriter();
				if($precision !== null) {
					$fontWriter->precision = Std::parseInt($precision);
				}
				$fontWriter->write(sys_io_File::getBytes($inFile), $ranges, "path", null);
				sys_io_File::write(_hx_string_or_null($fontWriter->fontName) . ".path", false)->writeString($fontWriter->getPath());
			}break;
			case "ttf2hash":{
				if(be_haxer_hxswfml_Main::$args->length < 2) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$ranges = be_haxer_hxswfml_Main::getArgValue("-glyphs");
				if($ranges === null) {
					$ranges = "32-126";
				}
				$precision = be_haxer_hxswfml_Main::getArgValue("-precision");
				$fontWriter = new be_haxer_hxswfml_FontWriter();
				if($precision !== null) {
					$fontWriter->precision = Std::parseInt($precision);
				}
				$fontWriter->write(sys_io_File::getBytes($inFile), $ranges, "hash", null);
				sys_io_File::write(_hx_string_or_null($inFile) . ".hash", false)->writeString($fontWriter->getHash(true));
			}break;
			case "flv2swf":{
				if(be_haxer_hxswfml_Main::$args->length < 3) {
					be_haxer_hxswfml_Main::printUsage();
				}
				$inFile = be_haxer_hxswfml_Main::$args[1];
				$outFile = be_haxer_hxswfml_Main::$args[2];
				$fps = be_haxer_hxswfml_Main::getArgValue("-fps");
				if($fps === null) {
					$fps = "24";
				}
				$width = be_haxer_hxswfml_Main::getArgValue("-width");
				if($width === null) {
					$width = "320";
				}
				$height = be_haxer_hxswfml_Main::getArgValue("-height");
				if($height === null) {
					$height = "320";
				}
				$videoWriter = new be_haxer_hxswfml_VideoWriter();
				$videoWriter->write(sys_io_File::getBytes($inFile), Std::parseInt($fps), Std::parseInt($width), Std::parseInt($height), null);
				sys_io_File::write($outFile, true)->write($videoWriter->getSWF());
			}break;
			default:{
				Sys::println("Unknown operation: " . _hx_string_or_null(be_haxer_hxswfml_Main::$args[0]));
				be_haxer_hxswfml_Main::printUsage();
			}break;
			}
		}
	}
	static function printUsage() {
		Sys::println("hxswfml " . "- XML based swf and abc assembler. 2009-2013");
		Sys::println("Usage: hxswfml <operation> input-file output-file [args] [options]");
		Sys::println("");
		Sys::println("xml2swf");
		Sys::println("  in : xml file");
		Sys::println("  out : swf file");
		Sys::println("  options : -no-strict");
		Sys::println("");
		Sys::println("xml2lib");
		Sys::println("  in : xml file");
		Sys::println("  out : swf file");
		Sys::println("");
		Sys::println("lib2swc");
		Sys::println("  in : xml file");
		Sys::println("  out : swc file");
		Sys::println("");
		Sys::println("xml2swc");
		Sys::println("  in : xml file");
		Sys::println("  out: swc file");
		Sys::println("  options : -no-strict");
		Sys::println("");
		Sys::println("xml2abc");
		Sys::println("  in : xml file");
		Sys::println("  out : abc file");
		Sys::println("  options : -strict, -stack");
		Sys::println("");
		Sys::println("abc2swf");
		Sys::println("  in : xml or abc file");
		Sys::println("  out : swf file");
		Sys::println("  args : -main");
		Sys::println("  options : -strict, -stack");
		Sys::println("");
		Sys::println("abc2swc");
		Sys::println("  in : xml file");
		Sys::println("  out : swc file");
		Sys::println("  args : -main");
		Sys::println("  options : -strict, -stack");
		Sys::println("");
		Sys::println("abc2xml");
		Sys::println("  in : swf, swc or abc file");
		Sys::println("  out : xml file");
		Sys::println("  options : -no-debug, -source");
		Sys::println("");
		Sys::println("abc2hxm");
		Sys::println("  in : swf, swc or abc file");
		Sys::println("  out : zip file name");
		Sys::println("  args : -main");
		Sys::println("  options : -no-debug, -source, -folders");
		Sys::println("");
		Sys::println("ttf2swf");
		Sys::println("  in : ttf file");
		Sys::println("  out : swf file");
		Sys::println("  args : -class");
		Sys::println("  options : -glyphs");
		Sys::println("");
		Sys::println("ttf2hx");
		Sys::println("  in : ttf file");
		Sys::println("  options : -glyphs, -precision");
		Sys::println("");
		Sys::println("ttf2path");
		Sys::println("  in : ttf file");
		Sys::println("  options : -glyphs, -precision");
		Sys::println("");
		Sys::println("ttf2hash");
		Sys::println("  in : ttf file");
		Sys::println("  options : -glyphs, -precision");
		Sys::println("");
		Sys::println("flv2swf");
		Sys::println("  in : flv file (audioCodecs:mp3, videoCodecs: VP6, VP6+alpha, Sorenson H.263)");
		Sys::println("  out : swf file");
		Sys::println("  options : -fps, -width, -height");
		Sys::println("");
		Sys::hexit(1);
	}
	static function checkFile($p) {
		if(!file_exists(be_haxer_hxswfml_Main::$args[1])) {
			Sys::println("ERROR: File " . _hx_string_or_null(be_haxer_hxswfml_Main::$args[1]) . " could not be found.");
			Sys::hexit(1);
		}
	}
	static function argExists($v) {
		{
			$_g = 0; $_g1 = be_haxer_hxswfml_Main::$args;
			while($_g < $_g1->length) {
				$arg = $_g1[$_g];
				++$_g;
				if($arg === $v) {
					return true;
				}
				unset($arg);
			}
		}
		return false;
	}
	static function getArgValue($v) {
		{
			$_g1 = 0; $_g = be_haxer_hxswfml_Main::$args->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				if(be_haxer_hxswfml_Main::$args[$i] === $v) {
					return be_haxer_hxswfml_Main::$args[$i + 1];
				}
				unset($i);
			}
		}
		return null;
	}
	function __toString() { return 'be.haxer.hxswfml.Main'; }
}
