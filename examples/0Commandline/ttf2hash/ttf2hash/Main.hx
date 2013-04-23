import be.haxer.hxswfml.FontWriter;
import hxjson2.JSON;
import format.amf.Writer;
class Main
{
	public static function main() 
	{
		var inFile = "chopin.ttf";
		var ranges = "32-126";
		var fontWriter = new FontWriter();
		fontWriter.write(sys.io.File.getBytes(inFile), ranges, 'hash');
		var fontName = fontWriter.fontName;
		var font:Map<Int,GlyphData> = fontWriter.getHash(false);
		
		//json
		sys.io.File.write(fontName+'.json',false).writeString(JSON.encode(font));
		
		//serializer
		sys.io.File.write(fontName+'.hash',false).writeString(fontWriter.getHash(true));
		
		//svg
		var svg:StringBuf=new StringBuf();
		svg.add('<svg xmlns="http://www.w3.org/2000/svg">\n');
		for(key in font.keys())
		{
			var charCode = key;
			var glyph = font.get(charCode);
			svg.add('<!-- charCode:'+ charCode + ' char: ' + String.fromCharCode(charCode)+' -->\n');
			svg.add('<path stroke="black" fill="none" stroke-width="1" d="');
			var data = glyph.data;
			var commands = glyph.commands;
			var index=0;
			for(c in commands)
			{
				switch(c)
				{
					case 1: svg.add('M' + data[index++] + ',' + data[index++]);
					case 2: svg.add('L' + data[index++] + ',' + data[index++]);
					case 3: svg.add('Q' + data[index++] + ',' + data[index++] + ',' + data[index++] + ',' + data[index++]);
				}
			}
			svg.add('"/>\n');
		}
		svg.add('</svg>');
		sys.io.File.write(fontName+'.svg',false).writeString(svg.toString());
		
		//amf
		/*
		var out = new haxe.io.BytesOutput();
		var writer = new format.amf.Writer(out);
		writer.write(format.amf.Tools.encode(font), false);
		neko.io.File.write(fontName+'.amf', true).write(out.getBytes());
		*/
	}
}
typedef GlyphData=
{
	var charCode:Int;
	var ascent:Float;
	var descent:Float;
	var leading:Float;
	var advanceWidth:Float;
	var leftsideBearing:Float;
	var xMin:Float;
	var xMax:Float;
	var yMin:Float;
	var yMax:Float;
	var _width:Float;
	var _height:Float;
	var commands:Array<Int>;
	var data:Array<Float>;
}