import be.haxer.gui.text.TextField;
class Test extends flash.display.Sprite
{
	public function new()
	{
		super();
		var textFormat=
		{
			font:haxe.Unserializer.run(haxe.Resource.getString("chopin")),
			size:100.0,
			color:0x000000,
			outlines:false
		}
		var tf1= new be.haxer.gui.text.TextField(textFormat, "Hello world!");
		tf1.x = 200;
		tf1.y = 200;
		addChild(tf1);
		tf1.cacheAsBitmap=true;
		
		textFormat.outlines=true;
		var tf2= new be.haxer.gui.text.TextField(textFormat, "Hello world!");
		tf2.x = 200;
		tf2.y = 400;
		addChild(tf2);
		tf2.cacheAsBitmap=true;
		flash.Lib.current.stage.addChild(this);
		
		trace(["width:", Math.round(tf1.width), "height:", Math.round(tf1.height)]);
	}
	public static function main()
	{
		#if (flash || js)
			new Test();
		#else
			flash.Lib.create(function(){new Test();},1024,768,30,0xffffff,(1* flash.Lib.HARDWARE) | flash.Lib.RESIZABLE);
		#end
		
	}
}