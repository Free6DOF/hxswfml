<?php
require_once '../../bin/php/lib/php/Boot.class.php';
include "../../bin/php/lib/HXswfML.class.php";
$content1 = file_get_contents('swf1.xml');
$trimmed1 = trim($content1);
$hxswfml1 = &New HXswfML;
$bytes1 = $hxswfml1->xml2swf($trimmed1, 'php_test1.swf');
file_put_contents('php_test1.swf', $bytes1->getData());

$content2 = file_get_contents('swf2.xml');
$trimmed2 = trim($content2);
$hxswfml2 = &New HXswfML;
$bytes2 = $hxswfml2->xml2swf($trimmed2, 'php_test2.swf');
file_put_contents('php_test2.swf', $bytes2->getData());
?>