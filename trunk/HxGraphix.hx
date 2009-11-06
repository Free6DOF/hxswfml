package ;
import format.swf.Writer;
import format.swf.Data;
import haxe.io.Bytes;
/**
 * ...
 * @author jan j.
 */

class HxGraphix
{
	var _xMin:Float;
	var _yMin:Float;
	var _xMax:Float;
	var _yMax:Float;
	
	var _fillStyles:Array<FillStyle>;
	var _lineStyles:Array<LineStyle>;
	var _shapeRecords:Array<ShapeRecord>;
	
	var _lastX:Float;
	var _lastY:Float;
	var _stateFillStyle:Bool;
	var _stateLineStyle:Bool;
	
	public function new()
	{
		_xMin= 0.0;
		_yMin= 0.0;
		_xMax= 0.0;
		_yMax= 0.0;
		
		_fillStyles = new Array();
		_lineStyles = new Array();
		_shapeRecords = new Array();
		
		_stateFillStyle = false;
		_stateLineStyle = false;
		
		_lastX = 0.0;
		_lastY = 0.0;
	}
	
	public function beginFill(color:Int=0x000000, alpha:Float=1.0):Void
	{
		_stateFillStyle = true;
		_fillStyles.push(FSSolidAlpha(hexToRgba(color, alpha)));
		var _shapeChangeRec = 
		{
			moveTo : null,
			fillStyle0 :{ idx:_fillStyles.length },
			fillStyle1 : null,
			lineStyle :_stateLineStyle? {idx:_lineStyles.length} : null,
			newStyles : null
		}
		_shapeRecords.push( SHRChange(_shapeChangeRec) );
	}
	public function lineStyle(width:Float=1.0, color:Int=0x000000, alpha:Float=1.0):Void 
	{
		_stateLineStyle = true;
		if (width > 255.0) width = 255.0;
		if (width <= 0.0) width = 0.05;

		_lineStyles.push({ width:Std.int(toFloat5(width)*20), data:LSRGBA(hexToRgba(color, alpha)) });
		var _shapeChangeRec = 
		{
			moveTo : null,
			fillStyle0 :_stateFillStyle? {idx:_fillStyles.length} : null,
			fillStyle1 :null,
			lineStyle :{idx:_lineStyles.length},
			newStyles : null
		}
		_shapeRecords.push( SHRChange(_shapeChangeRec) );
	}
	public function lineTo(x:Float, y:Float):Void 
	{
		var x:Float = toFloat5(x);
		var y:Float = toFloat5(y);
		
		var dx:Float = x - _lastX;
		var dy:Float = y - _lastY; 
		
		_lastX = x;
		_lastY = y;
		
		if(x<_xMin) _xMin=x;
		if(x>_xMax) _xMax=x;
		if(y<_yMin) _yMin=y;
		if(y>_yMax) _yMax=y;
		
		_shapeRecords.push( SHREdge(Std.int(dx*20), Std.int(dy*20)) );
	}
	public function moveTo(x:Float, y:Float):Void 
	{
		var x:Float = toFloat5(x);
		var y:Float = toFloat5(y);
		
		_lastX = x;
		_lastY = y;
		
		if(x<_xMin) _xMin=x;
		if(x>_xMax) _xMax=x;
		if(y<_yMin) _yMin=y;
		if(y>_yMax) _yMax=y;
		
		var _shapeChangeRec = 
		{
			moveTo : {dx:Std.int(x*20), dy:Std.int(y*20)},
			fillStyle0 : _stateFillStyle? {idx:_fillStyles.length}:null,
			fillStyle1 : null,
			lineStyle : _stateLineStyle? {idx:_lineStyles.length} : null,
			newStyles : null
		}
		_shapeRecords.push( SHRChange(_shapeChangeRec) );
	}

	public function curveTo( cx : Float, cy : Float, ax : Float, ay : Float ):Void
	{
		var cx:Float = toFloat5(cx);
		var cy:Float = toFloat5(cy);
		var ax:Float = toFloat5(ax);
		var ay:Float = toFloat5(ay);
		
		var dcx:Float = cx - _lastX; 
		var dcy:Float = cy - _lastY; 
		
		_lastX = cx;
		_lastY = cy;
		
		var dax:Float = ax - _lastX; 
		var day:Float = ay - _lastY; 
		
		_lastX = ax;
		_lastY = ay;
		
		if(ax<_xMin) _xMin=ax;
		if(ax>_xMax) _xMax=ax;
		if(ay<_yMin) _yMin=ay;
		if(ay>_yMax) _yMax=ay;

		_shapeRecords.push(SHRCurvedEdge( Std.int(dcx*20), Std.int(dcy*20), Std.int(dax*20), Std.int(day*20)));
	}
	public function endFill():Void
	{
		_stateFillStyle = false;
		beginFill(0,0);//hack!
		/*
		var _shapeChangeRec = 
		{
			moveTo : null,
			fillStyle0 :null,
			fillStyle1 : null,
			lineStyle : null,//_lineStyles.length==0? null : {idx:_lineStyles.length},
			newStyles : null
		}
		_shapeRecords.push( SHRChange(_shapeChangeRec) );
		*/
	}
	public function endLine():Void
	{
		_stateLineStyle = false;
		lineStyle(0,0,0);//hack!
		/*
		var _shapeChangeRec = 
		{
			moveTo : null,
			fillStyle0 :_fillStyles.length==0? null : {idx:_fillStyles.length},
			fillStyle1 : null,
			lineStyle :null,
			newStyles : null
		}
		_shapeRecords.push( SHRChange(_shapeChangeRec) );
		*/
	}
	public function clear():Void
	{
		_shapeRecords = new Array();
	}
	public function drawRect(x:Float, y:Float, width:Float, height:Float):Void
	{
		moveTo(x, y);
		lineTo(x + width, y);
		lineTo(x + width, y + height);
		lineTo(x, y + height);
		lineTo(x, y );
	}
	public function drawRoundRect(x:Float, y:Float, w:Float, h:Float, r:Float):Void 
	{
		drawRoundRectComplex(x, y, w, h, r, r, r, r);
	}
	public function drawRoundRectComplex(x:Float, y:Float, w:Float, h:Float, rtl:Float, rtr:Float, rbl:Float, rbr:Float):Void 
	{
		moveTo(rtl + x, y);//0 TL
		lineTo(w - rtr + x, y);//1 T
		curveTo(w +x, y, w + x, y + rtr);//2 TR
		lineTo(w + x, h - rbr + y);//3 R
		curveTo(w + x, h + y, w - rbr + x, h + y);//4 BR
		lineTo(rbl + x, h + y);//5 B
		curveTo(x, h + y, x, h - rbl + y);//6 BL
		lineTo(x, rtl + y);//7 L
		curveTo(x, y, rtl + x, y); //TL
	}
	public function drawCircle(x:Float, y:Float, r:Float, sections:Int=16)
	{
		if (sections < 3) sections = 3;
		if (sections > 360) sections = 360;
		
		var span:Float = Math.PI / sections;
		var controlRadius:Float = r / Math.cos(span);
		var anchorAngle:Float = 0.0;
		var controlAngle:Float = 0.0;
		var startPosX:Float = x + Math.cos(anchorAngle) * r;
		var startPosY:Float = y + Math.sin(anchorAngle) * r;
		
		moveTo(startPosX, startPosY);
		
		for (i in 0...sections)
		{
			controlAngle = anchorAngle + span;
			anchorAngle = controlAngle + span;
			var cx:Float = x + Math.cos(controlAngle) * controlRadius;
			var cy:Float = y + Math.sin(controlAngle) * controlRadius;
			var ax:Float = x + Math.cos(anchorAngle) * r;
			var ay:Float = y + Math.sin(anchorAngle) * r;
			curveTo(cx, cy, ax, ay);
		}
	}
	public function drawEllipse(x:Float, y:Float, w:Float, h:Float):Void
	{
		moveTo(x, y+ h / 2);//1
		curveTo(x, y, x + w / 2, y);//2
		curveTo(x + w, y, x + w, y + h / 2);//3
		curveTo(x + w, y + h, x + w / 2, y + h);//4
		curveTo(x, y+h, x, y+h/2);
	}
	public function getTag(id:Int)
	{
		_shapeRecords.push(SHREnd);
		//-------------DEFINESHAPE3
		var _rect = { left:Std.int(_xMin * 20), right:Std.int(_xMax * 20), top:Std.int(_yMin * 20), bottom:Std.int(_yMax * 20) };
		var _shapeWithStyleData = { fillStyles:_fillStyles, lineStyles:_lineStyles, shapeRecords:_shapeRecords };
		return TShape(id, SHDShape3(_rect, _shapeWithStyleData));
	}	
	
	private function hexToRgba(color:Int, alpha:Float) 
	{
		if (alpha < 0) alpha = 0.0;
		if (alpha > 1) alpha = 1.0;
		if (color > 0xffffff) color = 0xffffff;
		return { r:(color & 0xff0000) >> 16,     g:(color & 0x00ff00) >> 8,     b:(color & 0x0000ff),     a:Std.int(alpha*255) }
	}
	private function toFloat5(float:Float):Float
	{
		var temp1:Int = Std.int(float * 100);
		var diff:Int = temp1 % 5;
		var temp2:Int = diff < 3? temp1 - diff : temp1 + (5 - diff);
		var temp3:Float = temp2 / 100;
		return temp3;
	}
}