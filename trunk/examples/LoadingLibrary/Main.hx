package;
import flash.display.Bitmap;
import flash.display.BitmapData;
import flash.display.Loader;
import flash.display.MovieClip;
import flash.display.Sprite;
import flash.events.Event;
import flash.utils.ByteArray;
import flash.net.URLRequest;
import flash.Lib;

class MyBitmapData extends BitmapData{public function new (){	super(100,100);}}
class MyBitmap extends Bitmap{public function new (){	super();}}
class MyByteArray extends ByteArray{}
class MySprite extends Sprite{}
class MyMovieClip extends MovieClip{}

class Main extends Sprite
{
	private var loader:Loader;
	
	public function new()
	{
		super();
		loader=new Loader();
		loader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoadComplete);
		loader.load(new URLRequest('library.swf'));
	}
	private function onLoadComplete(event:Event):Void
	{

		//png as ByteArray
		var loader =  new Loader();
		loader.loadBytes(new MyByteArray());
		addChild(loader);
		
		//png as MovieClip
		var mc:MovieClip = new MyMovieClip();
		mc.x=100;
		addChild(mc);
		
		//png as Sprite
		var s:Sprite = new MySprite();
		s.x=200;
		addChild(s);
		
		//png as BitmapData
		var bmd:BitmapData = new MyBitmapData();
		var bmp1:Bitmap = new Bitmap(bmd);
		bmp1.x=300;
		addChild(bmp1);
		
		//png as Bitmap
		var bmp2:Bitmap = new MyBitmap();
		bmp2.x=400;
		addChild(bmp2);
	}
	public static function main()
	{
		Lib.current.addChild(new Main());
	}
}