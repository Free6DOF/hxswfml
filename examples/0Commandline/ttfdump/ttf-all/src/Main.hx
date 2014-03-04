import flash.display.Sprite;
import flash.text.Font;
import flash.text.TextField;
import flash.text.TextFieldAutoSize;
import flash.text.TextFormatAlign;
import flash.text.TextFormat;

class Main extends Sprite
{
	//available charcodes in Chopin.ttf (use dump-chopin.bat in the lib folder)
	var charCodes = "[32,33-59,61,63-122,162,168,176,180,224-226,228,231-239,242-244,246,249-252,305,339,710,8208,8211-8212,8216-8217,8220-8221,8226,8230,8260,61441-61442]";

	var tf:TextField;
	
	var fmt1:TextFormat;
	var fmt2:TextFormat;
	
	public function new()
	{
		super();
		
		var font1 = new CalibriFont();
		var font2 = new ChopinFont();

		fmt1 = new TextFormat();
		fmt1.font = font1.fontName;
		fmt1.size = 24;
		
		fmt2 = new TextFormat();
		fmt2.font = font2.fontName;
		fmt2.size = fmt1.size;
		
		tf = new TextField();
		tf.embedFonts = true;
		tf.border=true;
		tf.selectable=true;
		tf.multiline=true;
		tf.width = 200;
		addChild(tf);
		
		addCharCodesText();

		tf.height = flash.Lib.current.stage.stageHeight;
	}
	var beginIndex=0;
	function addCharCodesText()
	{
		var charCodes = charCodes.split("[").join("").split("]").join("").split(",");
		for(c in charCodes)
		{
			var range = c.split("-");
			if(range.length==1)
			{
				tf.appendText(c + " : " + String.fromCharCode(Std.parseInt(c)) +  "\n");
				
				tf.setTextFormat(fmt1, beginIndex, c.length + 3);
				beginIndex += c.length + 3;
				
				tf.setTextFormat(fmt2, beginIndex, beginIndex+1);
				beginIndex += 2;
			}
			else
			{
				for(d in Std.parseInt(range[0]) ... Std.parseInt(range[1])+1)
				{
					tf.appendText(d + " : " + String.fromCharCode(d) +  "\n");
					
					tf.setTextFormat(fmt1, beginIndex, Std.string(d).length + 3);
					beginIndex += Std.string(d).length + 3;
					
					tf.setTextFormat(fmt2, beginIndex, beginIndex+1);
					beginIndex += 2;
				}
			}
		}
	}
	public static function main()
	{
		flash.Lib.current.addChild(new Main());
	}
}