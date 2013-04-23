<?php
require_once '../../../../bin/php/lib/php/Boot.class.php';
include "../../../../bin/php/lib/be/haxer/hxswfml/AbcReader.class.php";

$filename = "original.swf";
$handle = fopen($filename, "rb");
$bytes = fread($handle, filesize($filename));
fclose($handle);

$h = &New be_haxer_hxswfml_AbcReader();
$h->read('swf', $bytes);
$xml = $h->getXML();
file_put_contents('abc.xml', $xml);


$swfxml = file_get_contents("index.xml");
$h2 = &New be_haxer_hxswfml_SwfWriter(true);
$h2->write($swfxml, 'copy.swf');
$swfbytes = $h2->getSWF();
file_put_contents('copy.swf', $swfbytes);
?>