package be.haxer.gui.text;
import be.haxer.gui.text.Data;

class Glyph extends flash.display.Sprite
{
	public var glyphData:GlyphData;
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
	
	var drawEM:Bool;
	var drawBbox:Bool;
	var noFill:Bool;
	var color:Int;
	
	public function new(data:GlyphData, ?drawEM:Bool=false, ?drawBbox:Bool=false, ?noFill:Bool=false)
	{
		super();
		setData(data);
		this.drawEM = drawEM;
		this.drawBbox = drawBbox;
		this.noFill = noFill;
		this.color=0;
		var me=this;
		#if (flash || neko || cpp)
			#if flash 
			this.buttonMode=true;
			#end
		this.addEventListener("mouseDown", function(_)me.startDrag());
		flash.Lib.current.stage.addEventListener("mouseUp", function(_)me.stopDrag());
		#end
		
		render();
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
	function render()
	{
		graphics.clear();
		noFill?
			graphics.lineStyle(1, 0)
			:graphics.beginFill(color, 1);
		var index=0;
		
		#if flash
		graphics.drawPath(flash.Vector.ofArray(commands), flash.Vector.ofArray(data), flash.display.GraphicsPathWinding.EVEN_ODD);
		#elseif (js||neko)
		for(c in commands)
		{
			switch(c)
			{
				case 0: //no op
				case 1: graphics.moveTo(data[index++], data[index++]);
				case 2: graphics.lineTo(data[index++], data[index++]);
				case 3: graphics.curveTo(data[index++], data[index++], data[index++], data[index++]);
			}
		}
		#elseif(cpp)
		var x;
		var y;
		var cx;
		var cy;
		var _x;
		var _y;
		var _cx;
		var _cy;

		for(c in commands)
		{
			switch(c)
			{
				case 0: //no op
				
				case 1: 
				x=index++;
				y=index++;
				_x=data[x];
				_y=data[y];
				graphics.moveTo(_x, _y);
				
				case 2: 
				x=index++;
				y=index++;
				_x=data[x];
				_y=data[y];
				graphics.lineTo(_x, _y);
				
				case 3: 
				x=index++;
				y=index++;
				cx=index++;
				cy=index++;
				_x=data[x];
				_y=data[y];
				_cx=data[cx];
				_cy=data[cy];
				graphics.curveTo(_x,_y,_cx, _cy);
			}
		}
		#end
		graphics.endFill();
		if(drawEM)
		{
			graphics.lineStyle(1, 0);
			graphics.lineStyle(1, 0xEEEEEE);
			graphics.moveTo(0,(1024-ascent)/2);
			graphics.lineTo(1024, (1024-ascent)/2);
			
			graphics.moveTo(0,1024-(1024-ascent)/2-descent);
			graphics.lineTo(1024, 1024-(1024-ascent)/2-descent);

			graphics.lineStyle(1, 0x0000FF);
			graphics.drawRect(0, 0, 1024, 1024);
			
			graphics.lineStyle(1, 0x00FF00);
			graphics.moveTo(xMin+advanceWidth, 0);
			graphics.lineTo(xMin+advanceWidth, 1024);
		}
		if(drawBbox)
		{
			graphics.lineStyle(1, 0);
			graphics.lineStyle(1, 0xFF0000);
			graphics.drawRect(xMin, 1024-yMax, xMax-xMin, yMax-yMin);
		}
	}
}