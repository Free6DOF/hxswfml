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
		var tf= new flash.text.TextField();
		tf.text = "Hello world!";
		tf.x = 200;
		tf.y = 200;
		addChild(tf);
		
		trace(["width:", Math.round(tf.width), "height:", Math.round(tf.height)]);
	}
	public static function main()
	{
		#if (flash || js)
			flash.Lib.current.addChild(new Test());
		#else
			flash.Lib.create(function(){new Test();},1024,768,30,0xffffff,(1* flash.Lib.HARDWARE) | flash.Lib.RESIZABLE);
		#end
		
	}
}