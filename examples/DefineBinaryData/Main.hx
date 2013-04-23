class Main extends flash.display.MovieClip
{
	public static function main()
	{
		var bytes:flash.utils.ByteArray = new MyBinData();
		var loader=new flash.display.Loader();
		loader.loadBytes(bytes);
		flash.Lib.current.addChild(loader);
		
		trace(bytes.length);
	}
}

class MyBinData extends flash.utils.ByteArray{}