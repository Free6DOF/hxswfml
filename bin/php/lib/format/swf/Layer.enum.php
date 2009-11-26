<?php

class format_swf_Layer extends Enum {
		public static $Layer1;
		public static $Layer2;
		public static $Layer3;
		public static $LayerReserved;
	}
	format_swf_Layer::$Layer1 = new format_swf_Layer("Layer1", 3);
	format_swf_Layer::$Layer2 = new format_swf_Layer("Layer2", 2);
	format_swf_Layer::$Layer3 = new format_swf_Layer("Layer3", 1);
	format_swf_Layer::$LayerReserved = new format_swf_Layer("LayerReserved", 0);
