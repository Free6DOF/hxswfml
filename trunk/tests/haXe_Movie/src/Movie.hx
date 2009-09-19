package;
import flash.display.Bitmap;
import flash.display.MovieClip;
import flash.display.Sprite;
import flash.display.Loader;
import flash.display.PixelSnapping;
import flash.events.MouseEvent;
import flash.events.Event;
import flash.media.Sound;
import flash.utils.ByteArray;
import flash.text.Font;
import flash.text.TextField;
import flash.text.TextFormat;


class MyBitmap extends Bitmap{}
class MyMovieClip extends MovieClip{}
class MySoundMP3 extends Sound{}
class MyFontTTF extends Font{}
class MyVideo extends MovieClip{}
class MyByteArrayTXT extends ByteArray{}
class MyByteArraySWF extends ByteArray{}

class Movie extends Sprite
{
	public static function main()
	{
		flash.Lib.current.addChild(new Movie());
	}
	public function new()
	{
		super();
		
		//BITMAP
		var bmp = new MyBitmap(null,PixelSnapping.AUTO,true);
		bmp.x=400;
		addChild(bmp);
		
		
		//MOVIECLIP
		var mc = new MyMovieClip();
		mc.buttonMode=true;
		mc.y=200;
		addChild(mc);
		
		//BYTEARRAY (swf)
		var loader:Loader=new Loader();
		loader.loadBytes(new MyByteArraySWF());
		loader.x = 300;
		loader.y = 200;
		addChild(loader);
		
		//FONT
		var font = new MyFontTTF();
		//Font.registerFont(MyFontTTF);
		
		//BYTEARRAY (txt)
		var textFormat = new TextFormat();
		textFormat.font = font.fontName;
		var tf:TextField=new TextField();
		tf.defaultTextFormat= textFormat;
		tf.embedFonts=true;
		tf.text = '\n'+Std.string(new MyByteArrayTXT());
		tf.border=true;
		tf.x=tf.width=300;
		tf.y=tf.height=300;
		addChild(tf);
		
		//AUDIO:MP3		
		var snd = new MySoundMP3();
		snd.play();

		trace('trace test from haXe');
	}
}