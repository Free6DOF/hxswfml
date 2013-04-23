package;
import flash.display.Sprite;
import flash.text.Font;
import flash.text.TextField;
import flash.text.TextFormat;
import flash.Lib;

class MyFontTTF extends Font{}

class Main extends Sprite
{
	//public var tf1:TextField;//see index.xml
	
	public static function main()
	{
		flash.Lib.current.addChild(new Main());
	}
	public function new()
	{
		super();

		var font = new MyFontTTF();
		//Font.registerFont(MyFontTTF);
		var textFormat = new TextFormat();
		textFormat.font = font.fontName;
		textFormat.size = 20;
		textFormat.leading = 10;
		
		var tf2 = new TextField();
		tf2.defaultTextFormat = textFormat;
		tf2.embedFonts = true;
		tf2.text = 'hello world 1234567890 abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ,;:+=<$^-)аз!и§("й&';
		//tf2.text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
		tf2.border=true;
		tf2.x=tf2.width=tf2.height=400;
		tf2.wordWrap=true;
		tf2.selectable=true;
		tf2.multiline=true;
		tf2.type=flash.text.TextFieldType.INPUT;
		addChild(tf2);
		//trace('trace test from haXe');
	}
}