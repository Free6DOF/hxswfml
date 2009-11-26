import flash.display.Sprite;
import flash.text.TextField;
import flash.net.FileReference;
import flash.utils.ByteArray;
import flash.events.MouseEvent;
import flash.Lib;

import be.haxer.hxswfml.HXswfML;

class Example extends Sprite
{
	var xml:String;
	var swf:ByteArray;
	public function new()
	{
		super();
		xml = '<swf>';
		xml += '<Header frameCount="1" fps="30" width="900" height="300" />';
		xml += '<DefineShape id="1">';
			xml += '<LineStyle width="4" color="0x0000FF" alpha="1.0" />';
			xml += '<BeginFill color="0xFF0000" alpha="0.6" />';
			xml += '<DrawRoundRectComplex x="0" y="0" width="100" height="100" rtl="25" rtr="0" rbl="0" rbr="25" />';
		xml += '</DefineShape>';
		xml += '<PlaceObject id="1" depth="1" x="400" y="100" />';
		xml += '<ShowFrame />';
		xml += '</swf>';

		var label:TextField=new TextField();
		label.text = 'save swf';
		
		var btn:Sprite = new Sprite();
		btn.graphics.beginFill(0xFF0000,1.0);
		btn.graphics.drawRect(0,0,100,20);
		btn.addEventListener(MouseEvent.CLICK, onBtnClick);
		btn.mouseChildren=false;
		btn.buttonMode=true;
		btn.addChild(label);
		addChild(btn);
		
		var hxswfml = new HXswfML();
		var bytes = hxswfml.xml2swf(xml, 'name.swf');//compiler needs to know if it should generate swf or swc.
		swf = bytes.getData();
	}
	function onBtnClick(event:MouseEvent):Void
	{
		new FileReference().save(swf, 'output.swf');
	}
	public static function main()
	{
		Lib.current.addChild(new Example());
	}
}