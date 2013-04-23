<?php
require_once './lib/php/Boot.class.php';
include "./lib/be/haxer/hxswfml/SwfWriter.class.php";
$content1 = file_get_contents('index1.xml');
$trimmed1 = trim($content1);
$hxswfml1 = &New be_haxer_hxswfml_SwfWriter(true);
$hxswfml1->write($trimmed1, true);
$bytes1 = $hxswfml1->getSWF();
file_put_contents('index1.swf', $bytes1->getData());

$content2 = file_get_contents('index2.xml');
$trimmed2 = trim($content2);
$hxswfml2 = &New be_haxer_hxswfml_SwfWriter(true);
$hxswfml2->write($trimmed2, true);
$bytes2 = $hxswfml2->getSWF();

file_put_contents('index2.swf', $bytes2->getData());
?>