#include <hxObject.h>

#ifndef INCLUDED_hxMath
#include <hxMath.h>
#endif
#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_be_haxer_hxgraphix_HxGraphix
#include <be/haxer/hxgraphix/HxGraphix.h>
#endif
#ifndef INCLUDED_format_swf_FillStyle
#include <format/swf/FillStyle.h>
#endif
#ifndef INCLUDED_format_swf_GradRecord
#include <format/swf/GradRecord.h>
#endif
#ifndef INCLUDED_format_swf_InterpolationMode
#include <format/swf/InterpolationMode.h>
#endif
#ifndef INCLUDED_format_swf_LineStyleData
#include <format/swf/LineStyleData.h>
#endif
#ifndef INCLUDED_format_swf_SWFTag
#include <format/swf/SWFTag.h>
#endif
#ifndef INCLUDED_format_swf_ShapeData
#include <format/swf/ShapeData.h>
#endif
#ifndef INCLUDED_format_swf_ShapeRecord
#include <format/swf/ShapeRecord.h>
#endif
#ifndef INCLUDED_format_swf_SpreadMode
#include <format/swf/SpreadMode.h>
#endif
namespace be{
namespace haxer{
namespace hxgraphix{

Void HxGraphix_obj::__construct()
{
{
	this->_xMin = 0.0;
	this->_yMin = 0.0;
	this->_xMax = 0.0;
	this->_yMax = 0.0;
	this->_fillStyles = Array_obj<format::swf::FillStyle >::__new();
	this->_lineStyles = Array_obj<Dynamic >::__new();
	this->_shapeRecords = Array_obj<format::swf::ShapeRecord >::__new();
	this->_stateFillStyle = false;
	this->_stateLineStyle = false;
	this->_lastX = 0.0;
	this->_lastY = 0.0;
}
;
	return null();
}

HxGraphix_obj::~HxGraphix_obj() { }

Dynamic HxGraphix_obj::__CreateEmpty() { return  new HxGraphix_obj; }
hxObjectPtr<HxGraphix_obj > HxGraphix_obj::__new()
{  hxObjectPtr<HxGraphix_obj > result = new HxGraphix_obj();
	result->__construct();
	return result;}

Dynamic HxGraphix_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<HxGraphix_obj > result = new HxGraphix_obj();
	result->__construct();
	return result;}

Void HxGraphix_obj::beginFill( Dynamic __o_color,Dynamic __o_alpha){
int color = __o_color.Default(0);
double alpha = __o_alpha.Default(1.0);
{
		this->_stateFillStyle = true;
		this->_fillStyles->push(format::swf::FillStyle_obj::FSSolidAlpha(this->hexToRgba(color,alpha)));
		Dynamic _shapeChangeRec = hxAnon_obj::Create()->Add( STRING(L"moveTo",6) , null())->Add( STRING(L"fillStyle0",10) , hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_fillStyles->length))->Add( STRING(L"fillStyle1",10) , null())->Add( STRING(L"lineStyle",9) , this->_stateLineStyle ? Dynamic( hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_lineStyles->length) ) : Dynamic( null() ))->Add( STRING(L"newStyles",9) , null());
		this->_shapeRecords->push(format::swf::ShapeRecord_obj::SHRChange(_shapeChangeRec));
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(HxGraphix_obj,beginFill,(void))

Void HxGraphix_obj::beginGradientFill( Dynamic __o_type,Array<Dynamic > colors,Array<Dynamic > alphas,Array<Dynamic > ratios,double x,double y,double scaleX,double scaleY,Dynamic __o_rotate0,Dynamic __o_rotate1){
String type = __o_type.Default(STRING(L"linear",6));
double rotate0 = __o_rotate0.Default(0);
double rotate1 = __o_rotate1.Default(0);
{
		this->_stateFillStyle = true;
		Array<format::swf::GradRecord > data = Array_obj<format::swf::GradRecord >::__new();
		{
			int _g1 = 0;
			int _g = colors->length;
			while(_g1 < _g){
				int i = _g1++;
				Dynamic pos = Std_obj::parseInt(ratios->__get(i));
				Dynamic color = Std_obj::parseInt(colors->__get(i));
				double alpha = Std_obj::parseFloat(alphas->__get(i));
				data->push(format::swf::GradRecord_obj::GRRGBA(pos,this->hexToRgba(color,alpha)));
			}
		}
		Dynamic matrix = hxAnon_obj::Create()->Add( STRING(L"scale",5) , hxAnon_obj::Create()->Add( STRING(L"x",1) , scaleX)->Add( STRING(L"y",1) , scaleY))->Add( STRING(L"rotate",6) , hxAnon_obj::Create()->Add( STRING(L"rs0",3) , rotate0)->Add( STRING(L"rs1",3) , rotate1))->Add( STRING(L"translate",9) , hxAnon_obj::Create()->Add( STRING(L"x",1) , Std_obj::toInt(this->toFloat5(x)) * 20)->Add( STRING(L"y",1) , Std_obj::toInt(this->toFloat5(y)) * 20));
		Dynamic gradient = hxAnon_obj::Create()->Add( STRING(L"spread",6) , format::swf::SpreadMode_obj::SMPad)->Add( STRING(L"interpolate",11) , format::swf::InterpolationMode_obj::IMNormalRGB)->Add( STRING(L"data",4) , data);
		String _switch_1 = (type);
		if (  ( _switch_1==STRING(L"linear",6))){
			this->_fillStyles->push(format::swf::FillStyle_obj::FSLinearGradient(matrix,gradient));
		}
		else if (  ( _switch_1==STRING(L"radial",6))){
			this->_fillStyles->push(format::swf::FillStyle_obj::FSRadialGradient(matrix,gradient));
		}
		else  {
			hxThrow (STRING(L"Unsupported gradient type",25));
		}
;
;
		Dynamic _shapeChangeRec = hxAnon_obj::Create()->Add( STRING(L"moveTo",6) , null())->Add( STRING(L"fillStyle0",10) , hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_fillStyles->length))->Add( STRING(L"fillStyle1",10) , null())->Add( STRING(L"lineStyle",9) , this->_stateLineStyle ? Dynamic( hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_lineStyles->length) ) : Dynamic( null() ))->Add( STRING(L"newStyles",9) , null());
		this->_shapeRecords->push(format::swf::ShapeRecord_obj::SHRChange(_shapeChangeRec));
	}
return null();
}


DEFINE_DYNAMIC_FUNC10(HxGraphix_obj,beginGradientFill,(void))

Void HxGraphix_obj::beginBitmapFill( int bitmapId,Dynamic __o_x,Dynamic __o_y,Dynamic __o_scaleX,Dynamic __o_scaleY,Dynamic __o_rotate0,Dynamic __o_rotate1,Dynamic __o_repeat,Dynamic __o_smooth){
double x = __o_x.Default(0);
double y = __o_y.Default(0);
double scaleX = __o_scaleX.Default(1.0);
double scaleY = __o_scaleY.Default(1.0);
double rotate0 = __o_rotate0.Default(0.0);
double rotate1 = __o_rotate1.Default(0.0);
bool repeat = __o_repeat.Default(false);
bool smooth = __o_smooth.Default(false);
{
		this->_stateFillStyle = true;
		Dynamic matrix = hxAnon_obj::Create()->Add( STRING(L"scale",5) , hxAnon_obj::Create()->Add( STRING(L"x",1) , this->toFloat5(scaleX) * 20)->Add( STRING(L"y",1) , this->toFloat5(scaleY) * 20))->Add( STRING(L"rotate",6) , hxAnon_obj::Create()->Add( STRING(L"rs0",3) , rotate0)->Add( STRING(L"rs1",3) , rotate1))->Add( STRING(L"translate",9) , hxAnon_obj::Create()->Add( STRING(L"x",1) , Std_obj::toInt(this->toFloat5(x)) * 20)->Add( STRING(L"y",1) , Std_obj::toInt(this->toFloat5(y)) * 20));
		this->_fillStyles->push(format::swf::FillStyle_obj::FSBitmap(bitmapId,matrix,repeat,smooth));
		Dynamic _shapeChangeRec = hxAnon_obj::Create()->Add( STRING(L"moveTo",6) , null())->Add( STRING(L"fillStyle0",10) , hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_fillStyles->length))->Add( STRING(L"fillStyle1",10) , null())->Add( STRING(L"lineStyle",9) , this->_stateLineStyle ? Dynamic( hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_lineStyles->length) ) : Dynamic( null() ))->Add( STRING(L"newStyles",9) , null());
		this->_shapeRecords->push(format::swf::ShapeRecord_obj::SHRChange(_shapeChangeRec));
	}
return null();
}


DEFINE_DYNAMIC_FUNC9(HxGraphix_obj,beginBitmapFill,(void))

Void HxGraphix_obj::lineStyle( Dynamic __o_width,Dynamic __o_color,Dynamic __o_alpha){
double width = __o_width.Default(1.0);
int color = __o_color.Default(0);
double alpha = __o_alpha.Default(1.0);
{
		this->_stateLineStyle = true;
		if (width > 255.0)
			width = 255.0;
		if (width <= 0.0)
			width = 0.05;
		this->_lineStyles->push(hxAnon_obj::Create()->Add( STRING(L"width",5) , Std_obj::toInt(this->toFloat5(width) * 20))->Add( STRING(L"data",4) , format::swf::LineStyleData_obj::LSRGBA(this->hexToRgba(color,alpha))));
		Dynamic _shapeChangeRec = hxAnon_obj::Create()->Add( STRING(L"moveTo",6) , null())->Add( STRING(L"fillStyle0",10) , this->_stateFillStyle ? Dynamic( hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_fillStyles->length) ) : Dynamic( null() ))->Add( STRING(L"fillStyle1",10) , null())->Add( STRING(L"lineStyle",9) , hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_lineStyles->length))->Add( STRING(L"newStyles",9) , null());
		this->_shapeRecords->push(format::swf::ShapeRecord_obj::SHRChange(_shapeChangeRec));
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(HxGraphix_obj,lineStyle,(void))

Void HxGraphix_obj::lineTo( double x,double y){
{
		double x1 = this->toFloat5(x);
		double y1 = this->toFloat5(y);
		double dx = x1 - this->_lastX;
		double dy = y1 - this->_lastY;
		this->_lastX = x1;
		this->_lastY = y1;
		if (x1 < this->_xMin)
			this->_xMin = x1;
		if (x1 > this->_xMax)
			this->_xMax = x1;
		if (y1 < this->_yMin)
			this->_yMin = y1;
		if (y1 > this->_yMax)
			this->_yMax = y1;
		this->_shapeRecords->push(format::swf::ShapeRecord_obj::SHREdge(Std_obj::toInt(dx * 20),Std_obj::toInt(dy * 20)));
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(HxGraphix_obj,lineTo,(void))

Void HxGraphix_obj::moveTo( double x,double y){
{
		double x1 = this->toFloat5(x);
		double y1 = this->toFloat5(y);
		this->_lastX = x1;
		this->_lastY = y1;
		if (x1 < this->_xMin)
			this->_xMin = x1;
		if (x1 > this->_xMax)
			this->_xMax = x1;
		if (y1 < this->_yMin)
			this->_yMin = y1;
		if (y1 > this->_yMax)
			this->_yMax = y1;
		Dynamic _shapeChangeRec = hxAnon_obj::Create()->Add( STRING(L"moveTo",6) , hxAnon_obj::Create()->Add( STRING(L"dx",2) , Std_obj::toInt(x1 * 20))->Add( STRING(L"dy",2) , Std_obj::toInt(y1 * 20)))->Add( STRING(L"fillStyle0",10) , this->_stateFillStyle ? Dynamic( hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_fillStyles->length) ) : Dynamic( null() ))->Add( STRING(L"fillStyle1",10) , null())->Add( STRING(L"lineStyle",9) , this->_stateLineStyle ? Dynamic( hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->_lineStyles->length) ) : Dynamic( null() ))->Add( STRING(L"newStyles",9) , null());
		this->_shapeRecords->push(format::swf::ShapeRecord_obj::SHRChange(_shapeChangeRec));
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(HxGraphix_obj,moveTo,(void))

Void HxGraphix_obj::curveTo( double cx,double cy,double ax,double ay){
{
		double cx1 = this->toFloat5(cx);
		double cy1 = this->toFloat5(cy);
		double ax1 = this->toFloat5(ax);
		double ay1 = this->toFloat5(ay);
		double dcx = cx1 - this->_lastX;
		double dcy = cy1 - this->_lastY;
		double dax = ax1 - cx1;
		double day = ay1 - cy1;
		this->_lastX = ax1;
		this->_lastY = ay1;
		if (ax1 < this->_xMin)
			this->_xMin = ax1;
		if (ax1 > this->_xMax)
			this->_xMax = ax1;
		if (ay1 < this->_yMin)
			this->_yMin = ay1;
		if (ay1 > this->_yMax)
			this->_yMax = ay1;
		this->_shapeRecords->push(format::swf::ShapeRecord_obj::SHRCurvedEdge(Std_obj::toInt(dcx * 20),Std_obj::toInt(dcy * 20),Std_obj::toInt(dax * 20),Std_obj::toInt(day * 20)));
	}
return null();
}


DEFINE_DYNAMIC_FUNC4(HxGraphix_obj,curveTo,(void))

Void HxGraphix_obj::endFill( ){
{
		this->_stateFillStyle = false;
		this->beginFill(0,0);
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(HxGraphix_obj,endFill,(void))

Void HxGraphix_obj::endLine( ){
{
		this->_stateLineStyle = false;
		this->lineStyle(0,0,0);
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(HxGraphix_obj,endLine,(void))

Void HxGraphix_obj::clear( ){
{
		this->_shapeRecords = Array_obj<format::swf::ShapeRecord >::__new();
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(HxGraphix_obj,clear,(void))

Void HxGraphix_obj::drawRect( double x,double y,double width,double height){
{
		this->moveTo(x,y);
		this->lineTo(x + width,y);
		this->lineTo(x + width,y + height);
		this->lineTo(x,y + height);
		this->lineTo(x,y);
	}
return null();
}


DEFINE_DYNAMIC_FUNC4(HxGraphix_obj,drawRect,(void))

Void HxGraphix_obj::drawRoundRect( double x,double y,double w,double h,double r){
{
		this->drawRoundRectComplex(x,y,w,h,r,r,r,r);
	}
return null();
}


DEFINE_DYNAMIC_FUNC5(HxGraphix_obj,drawRoundRect,(void))

Void HxGraphix_obj::drawRoundRectComplex( double x,double y,double w,double h,double rtl,double rtr,double rbl,double rbr){
{
		this->moveTo(rtl + x,y);
		this->lineTo(w - rtr + x,y);
		this->curveTo(w + x,y,w + x,y + rtr);
		this->lineTo(w + x,h - rbr + y);
		this->curveTo(w + x,h + y,w - rbr + x,h + y);
		this->lineTo(rbl + x,h + y);
		this->curveTo(x,h + y,x,h - rbl + y);
		this->lineTo(x,rtl + y);
		this->curveTo(x,y,rtl + x,y);
	}
return null();
}


DEFINE_DYNAMIC_FUNC8(HxGraphix_obj,drawRoundRectComplex,(void))

Void HxGraphix_obj::drawCircle( double x,double y,double r,Dynamic __o_sections){
int sections = __o_sections.Default(16);
{
		if (sections < 3)
			sections = 3;
		if (sections > 360)
			sections = 360;
		double span = double(Math_obj::PI) / double(sections);
		double controlRadius = double(r) / double(Math_obj::cos(span));
		double anchorAngle = 0.0;
		double controlAngle = 0.0;
		double startPosX = x + Math_obj::cos(anchorAngle) * r;
		double startPosY = y + Math_obj::sin(anchorAngle) * r;
		this->moveTo(startPosX,startPosY);
		{
			int _g = 0;
			while(_g < sections){
				int i = _g++;
				controlAngle = anchorAngle + span;
				anchorAngle = controlAngle + span;
				double cx = x + Math_obj::cos(controlAngle) * controlRadius;
				double cy = y + Math_obj::sin(controlAngle) * controlRadius;
				double ax = x + Math_obj::cos(anchorAngle) * r;
				double ay = y + Math_obj::sin(anchorAngle) * r;
				this->curveTo(cx,cy,ax,ay);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC4(HxGraphix_obj,drawCircle,(void))

Void HxGraphix_obj::drawEllipse( double x,double y,double w,double h){
{
		this->moveTo(x,y + double(h) / double(2));
		this->curveTo(x,y,x + double(w) / double(2),y);
		this->curveTo(x + w,y,x + w,y + double(h) / double(2));
		this->curveTo(x + w,y + h,x + double(w) / double(2),y + h);
		this->curveTo(x,y + h,x,y + double(h) / double(2));
	}
return null();
}


DEFINE_DYNAMIC_FUNC4(HxGraphix_obj,drawEllipse,(void))

format::swf::SWFTag HxGraphix_obj::getTag( int id){
	this->_shapeRecords->push(format::swf::ShapeRecord_obj::SHREnd);
	Dynamic _rect = hxAnon_obj::Create()->Add( STRING(L"left",4) , Std_obj::toInt(this->_xMin * 20))->Add( STRING(L"right",5) , Std_obj::toInt(this->_xMax * 20))->Add( STRING(L"top",3) , Std_obj::toInt(this->_yMin * 20))->Add( STRING(L"bottom",6) , Std_obj::toInt(this->_yMax * 20));
	Dynamic _shapeWithStyleData = hxAnon_obj::Create()->Add( STRING(L"fillStyles",10) , this->_fillStyles)->Add( STRING(L"lineStyles",10) , this->_lineStyles)->Add( STRING(L"shapeRecords",12) , this->_shapeRecords);
	return format::swf::SWFTag_obj::TShape(id,format::swf::ShapeData_obj::SHDShape3(_rect,_shapeWithStyleData));
}


DEFINE_DYNAMIC_FUNC1(HxGraphix_obj,getTag,return )

Dynamic HxGraphix_obj::hexToRgba( int color,double alpha){
	if (alpha < 0)
		alpha = 0.0;
	if (alpha > 1)
		alpha = 1.0;
	if (color > 16777215)
		color = 16777215;
	return hxAnon_obj::Create()->Add( STRING(L"r",1) , int((int(color) & int(16711680))) >> int(16))->Add( STRING(L"g",1) , int((int(color) & int(65280))) >> int(8))->Add( STRING(L"b",1) , (int(color) & int(255)))->Add( STRING(L"a",1) , Std_obj::toInt(alpha * 255));
}


DEFINE_DYNAMIC_FUNC2(HxGraphix_obj,hexToRgba,return )

double HxGraphix_obj::toFloat5( double _float){
	int temp1 = Std_obj::toInt(_float * 100);
	int diff = hxMod(temp1,5);
	int temp2 = diff < 3 ? int( temp1 - diff ) : int( temp1 + (5 - diff) );
	double temp3 = double(temp2) / double(100);
	return temp3;
}


DEFINE_DYNAMIC_FUNC1(HxGraphix_obj,toFloat5,return )


HxGraphix_obj::HxGraphix_obj()
{
	InitMember(_xMin);
	InitMember(_yMin);
	InitMember(_xMax);
	InitMember(_yMax);
	InitMember(_fillStyles);
	InitMember(_lineStyles);
	InitMember(_shapeRecords);
	InitMember(_lastX);
	InitMember(_lastY);
	InitMember(_stateFillStyle);
	InitMember(_stateLineStyle);
}

void HxGraphix_obj::__Mark()
{
	MarkMember(_xMin);
	MarkMember(_yMin);
	MarkMember(_xMax);
	MarkMember(_yMax);
	MarkMember(_fillStyles);
	MarkMember(_lineStyles);
	MarkMember(_shapeRecords);
	MarkMember(_lastX);
	MarkMember(_lastY);
	MarkMember(_stateFillStyle);
	MarkMember(_stateLineStyle);
}

Dynamic HxGraphix_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"_xMin",sizeof(wchar_t)*5) ) { return _xMin; }
		if (!memcmp(inName.__s,L"_yMin",sizeof(wchar_t)*5) ) { return _yMin; }
		if (!memcmp(inName.__s,L"_xMax",sizeof(wchar_t)*5) ) { return _xMax; }
		if (!memcmp(inName.__s,L"_yMax",sizeof(wchar_t)*5) ) { return _yMax; }
		if (!memcmp(inName.__s,L"clear",sizeof(wchar_t)*5) ) { return clear_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"_lastX",sizeof(wchar_t)*6) ) { return _lastX; }
		if (!memcmp(inName.__s,L"_lastY",sizeof(wchar_t)*6) ) { return _lastY; }
		if (!memcmp(inName.__s,L"lineTo",sizeof(wchar_t)*6) ) { return lineTo_dyn(); }
		if (!memcmp(inName.__s,L"moveTo",sizeof(wchar_t)*6) ) { return moveTo_dyn(); }
		if (!memcmp(inName.__s,L"getTag",sizeof(wchar_t)*6) ) { return getTag_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"curveTo",sizeof(wchar_t)*7) ) { return curveTo_dyn(); }
		if (!memcmp(inName.__s,L"endFill",sizeof(wchar_t)*7) ) { return endFill_dyn(); }
		if (!memcmp(inName.__s,L"endLine",sizeof(wchar_t)*7) ) { return endLine_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"drawRect",sizeof(wchar_t)*8) ) { return drawRect_dyn(); }
		if (!memcmp(inName.__s,L"toFloat5",sizeof(wchar_t)*8) ) { return toFloat5_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"beginFill",sizeof(wchar_t)*9) ) { return beginFill_dyn(); }
		if (!memcmp(inName.__s,L"lineStyle",sizeof(wchar_t)*9) ) { return lineStyle_dyn(); }
		if (!memcmp(inName.__s,L"hexToRgba",sizeof(wchar_t)*9) ) { return hexToRgba_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"drawCircle",sizeof(wchar_t)*10) ) { return drawCircle_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"_fillStyles",sizeof(wchar_t)*11) ) { return _fillStyles; }
		if (!memcmp(inName.__s,L"_lineStyles",sizeof(wchar_t)*11) ) { return _lineStyles; }
		if (!memcmp(inName.__s,L"drawEllipse",sizeof(wchar_t)*11) ) { return drawEllipse_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"_shapeRecords",sizeof(wchar_t)*13) ) { return _shapeRecords; }
		if (!memcmp(inName.__s,L"drawRoundRect",sizeof(wchar_t)*13) ) { return drawRoundRect_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"_stateFillStyle",sizeof(wchar_t)*15) ) { return _stateFillStyle; }
		if (!memcmp(inName.__s,L"_stateLineStyle",sizeof(wchar_t)*15) ) { return _stateLineStyle; }
		if (!memcmp(inName.__s,L"beginBitmapFill",sizeof(wchar_t)*15) ) { return beginBitmapFill_dyn(); }
		break;
	case 17:
		if (!memcmp(inName.__s,L"beginGradientFill",sizeof(wchar_t)*17) ) { return beginGradientFill_dyn(); }
		break;
	case 20:
		if (!memcmp(inName.__s,L"drawRoundRectComplex",sizeof(wchar_t)*20) ) { return drawRoundRectComplex_dyn(); }
	}
	return super::__Field(inName);
}

static int __id__xMin = __hxcpp_field_to_id("_xMin");
static int __id__yMin = __hxcpp_field_to_id("_yMin");
static int __id__xMax = __hxcpp_field_to_id("_xMax");
static int __id__yMax = __hxcpp_field_to_id("_yMax");
static int __id__fillStyles = __hxcpp_field_to_id("_fillStyles");
static int __id__lineStyles = __hxcpp_field_to_id("_lineStyles");
static int __id__shapeRecords = __hxcpp_field_to_id("_shapeRecords");
static int __id__lastX = __hxcpp_field_to_id("_lastX");
static int __id__lastY = __hxcpp_field_to_id("_lastY");
static int __id__stateFillStyle = __hxcpp_field_to_id("_stateFillStyle");
static int __id__stateLineStyle = __hxcpp_field_to_id("_stateLineStyle");
static int __id_beginFill = __hxcpp_field_to_id("beginFill");
static int __id_beginGradientFill = __hxcpp_field_to_id("beginGradientFill");
static int __id_beginBitmapFill = __hxcpp_field_to_id("beginBitmapFill");
static int __id_lineStyle = __hxcpp_field_to_id("lineStyle");
static int __id_lineTo = __hxcpp_field_to_id("lineTo");
static int __id_moveTo = __hxcpp_field_to_id("moveTo");
static int __id_curveTo = __hxcpp_field_to_id("curveTo");
static int __id_endFill = __hxcpp_field_to_id("endFill");
static int __id_endLine = __hxcpp_field_to_id("endLine");
static int __id_clear = __hxcpp_field_to_id("clear");
static int __id_drawRect = __hxcpp_field_to_id("drawRect");
static int __id_drawRoundRect = __hxcpp_field_to_id("drawRoundRect");
static int __id_drawRoundRectComplex = __hxcpp_field_to_id("drawRoundRectComplex");
static int __id_drawCircle = __hxcpp_field_to_id("drawCircle");
static int __id_drawEllipse = __hxcpp_field_to_id("drawEllipse");
static int __id_getTag = __hxcpp_field_to_id("getTag");
static int __id_hexToRgba = __hxcpp_field_to_id("hexToRgba");
static int __id_toFloat5 = __hxcpp_field_to_id("toFloat5");


Dynamic HxGraphix_obj::__IField(int inFieldID)
{
	if (inFieldID==__id__xMin) return _xMin;
	if (inFieldID==__id__yMin) return _yMin;
	if (inFieldID==__id__xMax) return _xMax;
	if (inFieldID==__id__yMax) return _yMax;
	if (inFieldID==__id__fillStyles) return _fillStyles;
	if (inFieldID==__id__lineStyles) return _lineStyles;
	if (inFieldID==__id__shapeRecords) return _shapeRecords;
	if (inFieldID==__id__lastX) return _lastX;
	if (inFieldID==__id__lastY) return _lastY;
	if (inFieldID==__id__stateFillStyle) return _stateFillStyle;
	if (inFieldID==__id__stateLineStyle) return _stateLineStyle;
	if (inFieldID==__id_beginFill) return beginFill_dyn();
	if (inFieldID==__id_beginGradientFill) return beginGradientFill_dyn();
	if (inFieldID==__id_beginBitmapFill) return beginBitmapFill_dyn();
	if (inFieldID==__id_lineStyle) return lineStyle_dyn();
	if (inFieldID==__id_lineTo) return lineTo_dyn();
	if (inFieldID==__id_moveTo) return moveTo_dyn();
	if (inFieldID==__id_curveTo) return curveTo_dyn();
	if (inFieldID==__id_endFill) return endFill_dyn();
	if (inFieldID==__id_endLine) return endLine_dyn();
	if (inFieldID==__id_clear) return clear_dyn();
	if (inFieldID==__id_drawRect) return drawRect_dyn();
	if (inFieldID==__id_drawRoundRect) return drawRoundRect_dyn();
	if (inFieldID==__id_drawRoundRectComplex) return drawRoundRectComplex_dyn();
	if (inFieldID==__id_drawCircle) return drawCircle_dyn();
	if (inFieldID==__id_drawEllipse) return drawEllipse_dyn();
	if (inFieldID==__id_getTag) return getTag_dyn();
	if (inFieldID==__id_hexToRgba) return hexToRgba_dyn();
	if (inFieldID==__id_toFloat5) return toFloat5_dyn();
	return super::__IField(inFieldID);
}

Dynamic HxGraphix_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"_xMin",sizeof(wchar_t)*5) ) { _xMin=inValue.Cast<double >();return inValue; }
		if (!memcmp(inName.__s,L"_yMin",sizeof(wchar_t)*5) ) { _yMin=inValue.Cast<double >();return inValue; }
		if (!memcmp(inName.__s,L"_xMax",sizeof(wchar_t)*5) ) { _xMax=inValue.Cast<double >();return inValue; }
		if (!memcmp(inName.__s,L"_yMax",sizeof(wchar_t)*5) ) { _yMax=inValue.Cast<double >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"_lastX",sizeof(wchar_t)*6) ) { _lastX=inValue.Cast<double >();return inValue; }
		if (!memcmp(inName.__s,L"_lastY",sizeof(wchar_t)*6) ) { _lastY=inValue.Cast<double >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"_fillStyles",sizeof(wchar_t)*11) ) { _fillStyles=inValue.Cast<Array<format::swf::FillStyle > >();return inValue; }
		if (!memcmp(inName.__s,L"_lineStyles",sizeof(wchar_t)*11) ) { _lineStyles=inValue.Cast<Array<Dynamic > >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"_shapeRecords",sizeof(wchar_t)*13) ) { _shapeRecords=inValue.Cast<Array<format::swf::ShapeRecord > >();return inValue; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"_stateFillStyle",sizeof(wchar_t)*15) ) { _stateFillStyle=inValue.Cast<bool >();return inValue; }
		if (!memcmp(inName.__s,L"_stateLineStyle",sizeof(wchar_t)*15) ) { _stateLineStyle=inValue.Cast<bool >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void HxGraphix_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"_xMin",5));
	outFields->push(STRING(L"_yMin",5));
	outFields->push(STRING(L"_xMax",5));
	outFields->push(STRING(L"_yMax",5));
	outFields->push(STRING(L"_fillStyles",11));
	outFields->push(STRING(L"_lineStyles",11));
	outFields->push(STRING(L"_shapeRecords",13));
	outFields->push(STRING(L"_lastX",6));
	outFields->push(STRING(L"_lastY",6));
	outFields->push(STRING(L"_stateFillStyle",15));
	outFields->push(STRING(L"_stateLineStyle",15));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"_xMin",5),
	STRING(L"_yMin",5),
	STRING(L"_xMax",5),
	STRING(L"_yMax",5),
	STRING(L"_fillStyles",11),
	STRING(L"_lineStyles",11),
	STRING(L"_shapeRecords",13),
	STRING(L"_lastX",6),
	STRING(L"_lastY",6),
	STRING(L"_stateFillStyle",15),
	STRING(L"_stateLineStyle",15),
	STRING(L"beginFill",9),
	STRING(L"beginGradientFill",17),
	STRING(L"beginBitmapFill",15),
	STRING(L"lineStyle",9),
	STRING(L"lineTo",6),
	STRING(L"moveTo",6),
	STRING(L"curveTo",7),
	STRING(L"endFill",7),
	STRING(L"endLine",7),
	STRING(L"clear",5),
	STRING(L"drawRect",8),
	STRING(L"drawRoundRect",13),
	STRING(L"drawRoundRectComplex",20),
	STRING(L"drawCircle",10),
	STRING(L"drawEllipse",11),
	STRING(L"getTag",6),
	STRING(L"hexToRgba",9),
	STRING(L"toFloat5",8),
	String(null()) };

static void sMarkStatics() {
};

Class HxGraphix_obj::__mClass;

void HxGraphix_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"be.haxer.hxgraphix.HxGraphix",28), TCanCast<HxGraphix_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void HxGraphix_obj::__boot()
{
}

} // end namespace be
} // end namespace haxer
} // end namespace hxgraphix
