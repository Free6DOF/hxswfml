<?php

class format_mp3_Layer extends Enum {
		public static $Layer1;
		public static $Layer2;
		public static $Layer3;
		public static $LayerReserved;
	}
	format_mp3_Layer::$Layer1 = new format_mp3_Layer("Layer1", 3);
	format_mp3_Layer::$Layer2 = new format_mp3_Layer("Layer2", 2);
	format_mp3_Layer::$Layer3 = new format_mp3_Layer("Layer3", 1);
	format_mp3_Layer::$LayerReserved = new format_mp3_Layer("LayerReserved", 0);
