import Data;
class SVGGlyph
{
	public var glyphData:GlyphData;
	public var svg:String;
	var commands:Array<Int>;
	var data:Array<Float>;
	var ascent:Float;
	var descent:Float;
	var leading:Float;
	var advanceWidth:Float;
	var leftsideBearing:Float;

	var xMin :Float;
	var xMax :Float;
	var yMin :Float;
	var yMax :Float;

	var _width :Float;
	var _height :Float;

	var noFill:Bool;
	var color:Int;

	public function new(data:GlyphData, ?noFill:Bool=false)
	{
		setData(data);
		this.noFill = noFill;
		this.color=0x000000;
		svg = render();
	}
	function render()
	{
		var fill:String = noFill?"none":"black";
		var svg:StringBuf=new StringBuf();
		svg.add('<!-- charCode:'+ glyphData.charCode + ' char: ' + String.fromCharCode(glyphData.charCode)+' -->\n');
		svg.add('<svg:path stroke="black" fill="'+fill+'" stroke-width="1" d="');
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
		return svg.toString();
	}
	function setData(data:GlyphData)
	{
		this.glyphData=data;
		this.commands = data.commands;
		this.data = data.data;
		this.ascent = data.ascent;
		this.descent = data.descent;
		this.leading = data.leading;
		this.advanceWidth = data.advanceWidth;
		this.leftsideBearing = data.leftsideBearing;
		this.xMin = data.xMin;
		this.xMax = data.xMax;
		this.yMin = data.yMin;
		this.yMax = data.yMax;
		this._width = data._width;
		this._height = data._height;
	}
}