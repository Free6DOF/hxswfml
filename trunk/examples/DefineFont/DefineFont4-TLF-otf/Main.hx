package;
import flash.display.Sprite;
import flash.text.Font;
import flash.text.TextField;
import flash.text.TextFormat;
import flash.Lib;
import flash.display.Sprite;
import flash.text.engine.FontDescription;
import flash.text.engine.FontPosture;
import flash.text.engine.FontLookup;
import flash.text.engine.RenderingMode;
import flash.text.engine.ElementFormat;
import flash.text.engine.TextBlock;
import flash.text.engine.TextElement;

extern class FileFont extends Font{}

class Main extends Sprite
{
	public static function main()
	{
		flash.Lib.current.addChild(new Main());
	}
	public function new()
	{
		super();
		var font = new FileFont();
		trace("fontName:" + font.fontName);//"File"
		trace("fontType:" + font.fontType);//embeddedCFF
		trace("fontStyle:" + font.fontStyle);//regular
		
		var fontDescr = new FontDescription();
		fontDescr.fontName = font.fontName;
		fontDescr.fontPosture = FontPosture.NORMAL; 
		fontDescr.fontLookup = FontLookup.EMBEDDED_CFF; 
		//fontDesc.fontLookup = flash.text.engine.FontLookup.DEVICE;
		fontDescr.renderingMode=RenderingMode.CFF;
		//fontDesc.renderingMode=flash.text.engine.RenderingMode.NORMAL;

        var fmt = new ElementFormat();
		fmt.fontDescription = fontDescr;
        fmt.fontSize = 30;
        fmt.color = 0xFF0000;
            
        var str = "Hello haxe world 0123456789";
        var textBlock = new TextBlock();
        var textElement = new TextElement(str, fmt);
        textBlock.content = textElement;
        var line = textBlock.createTextLine(null, 800);
		line.x = line.y = 200;
        addChild(line);
	}
}