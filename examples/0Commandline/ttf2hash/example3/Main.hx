import Data;
class Main 
{
	static function main() 
	{
		var id = "tf";
		var txt = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
		
		var div = js.Browser.document.getElementById(id);
        if( div == null )
            js.Lib.alert("Unknown element : "+id);
			
		var font = haxe.Unserializer.run(haxe.Resource.getString("chopin"));
		var format =
		{
			font:font,
			outlines:false,
			size:50.0,
			color:0x00000
		}
        div.innerHTML = getSVGText(format, txt);
    }
	static function getSVGText(format:TextFormat, txt:String):String
	{
		var posX:Float=0;
		var buf:StringBuf=new StringBuf();
		buf.add('<svg:svg version="1.1" baseProfile="full" width="2000px" height="1000px">');
		for(glyph in Lambda.map(txt.split(''), function (letter)return new SVGGlyph(format.font.get(letter.charCodeAt(0)), format.outlines )))
		{
			buf.add('<svg:g transform="translate('+posX+' 0) scale('+format.size/1024+', '+format.size/1024+')">');
			buf.add(glyph.svg);
			buf.add('</svg:g>');
			posX += glyph.glyphData._width * format.size / 1024;
		}
		buf.add('</svg:svg>');
		return buf.toString();
	}
}