package;

@:bitmap("../../assets/image2.jpg")
class MyImage2 extends flash.display.Bitmap{ public function new() super();}

class Movie extends flash.display.Sprite
{
	public static function main()
	{
		flash.Lib.current.addChild(new Movie());
	}
	public function new()
	{
		super();
		var img = new MyImage2();
		addChild(img);
	}
}