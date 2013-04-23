typedef TextFormat=
{
	var font:Map<Int,GlyphData>;
	var size:Float;
	var color:Int;
	var outlines:Bool;
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