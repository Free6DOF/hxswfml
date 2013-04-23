package;
@:bitmap("../../../assets/image2.jpg") class MyBitmap extends flash.display.Bitmap { public function new() super();}
class Movie extends flash.display.MovieClip
{
	public function new()
	{
		super();
		addChild(new MyBitmap());
	}
	public static function main()
	{
		flash.Lib.current.addChild(new Movie());
	}
}