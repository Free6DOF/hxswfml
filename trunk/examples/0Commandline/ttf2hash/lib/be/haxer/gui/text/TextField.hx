package be.haxer.gui.text;
import be.haxer.gui.text.Data;

class TextField extends flash.display.Sprite
{
	var format:TextFormat;
	var text:String;
	public function new(format:TextFormat, text:String)
	{
		super();
		this.format=format;
		setText(text);
	}
	function setText(txt:String)
	{
		this.text=txt;
		while(this.numChildren!=0)
		{
			removeChildAt(0);
		}
		var posX:Float=0;
		var me=this;
		for(glyph in Lambda.map(txt.split(''), function (letter)return new Glyph(me.format.font.get(letter.charCodeAt(0)), false, false, me.format.outlines )))
		{
			glyph.scaleX = glyph.scaleY = format.size/1024;
			glyph.x = posX;
			posX += glyph.glyphData._width*format.size/1024;
			addChild(glyph);
		}
	}
}