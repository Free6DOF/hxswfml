package;
import flash.display.Sprite;
import flash.display.Loader;
import flash.events.Event;
import flash.net.URLRequest;
import flash.system.ApplicationDomain;
import flash.text.Font;
import flash.text.TextField;
import flash.text.TextFieldType;
import flash.text.TextFormat;
import flash.Lib;

class ChopinFont extends Font{}

class Main extends Sprite
{
	public static function main()
	{
		flash.Lib.current.addChild(new Main());
	}
	public function new()
	{
		super();
		var loader:Loader = new Loader();
		loader.contentLoaderInfo.addEventListener(Event.COMPLETE, onLoadComplete);
		loader.load(new URLRequest('ChopinScript.swf'));
	}
	function onLoadComplete(event:Event):Void
	{
		//Font:
		Font.registerFont(ChopinFont);//-cmd hxswfml ttf2swf chopin.ttf ChopinFont > fontName.swf
		
		//TextFormat:
		var textFormat = new TextFormat();
		textFormat.font = "ChopinScript";// font.fontName;
		textFormat.size = 20;
		textFormat.leading = 10;
		
		//TextField:
		var tf = new TextField();
		tf.defaultTextFormat = textFormat;
		tf.embedFonts = true;//false;//
		tf.text = 'hello world 1234567890 abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ,;:+=<$^-)аз!и§("й&               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
		tf.border=true;
		tf.x=tf.y=100;
		tf.width=tf.height=400;
		tf.wordWrap=true;
		tf.multiline=true;
		tf.type=TextFieldType.INPUT;
		
		addChild(tf);
	}
}