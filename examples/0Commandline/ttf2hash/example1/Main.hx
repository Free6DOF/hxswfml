package;
import flash.display.Sprite;
import flash.display.Shape;
import be.haxer.gui.text.Data;
import be.haxer.gui.text.Glyph;

class Main extends Sprite
{
	public function new()
	{
		super();
		var charHash:Map<Int,GlyphData> = haxe.Unserializer.run(haxe.Resource.getString("chopin"));
		var scale= 50/1024;
		var vSpace = 10;
		var hSpace = 10;
		var index=0;
		var container1 = new Sprite();
		var container2 = new Sprite();
		var charCodes:Array<Int> = [32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126];
		for(i in 0...charCodes.length)
		{
			var glyphData:GlyphData = charHash.get(charCodes[i]);
			var glyph1 = new Glyph(glyphData); 
			if(index%16==0) index=0;
			glyph1.x = index*(50+hSpace);
			glyph1.y = Std.int(i/16)*(50+vSpace);
			glyph1.scaleX = glyph1.scaleY=scale;
			container1.addChild(glyph1);
			
			var glyph2 = new Glyph(glyphData,true,true,true); 
			glyph2.x = glyph1.x;
			glyph2.y = glyph1.y;
			glyph2.scaleX = glyph2.scaleY=scale;
			container2.addChild(glyph2);
			index++;
		}
		
		container2.graphics.lineStyle(2,0);
		container2.graphics.drawRoundRect(-20,-20, container2.width+40, container2.height+40, 10);
		
		container1.graphics.lineStyle(2,0);
		container1.graphics.drawRoundRect(-20,-20, container2.width, container1.height+60, 10);
		
		container1.x=(1024-container1.width)/2+20;
		container1.y=40;
		
		container2.x=container1.x;
		container2.y=container1.y+container1.height+20;
		
		addChild(container1);
		addChild(container2);
	}
	public static function main()
	{
		flash.Lib.current.addChild(new Main());
	}
}