#include <hxObject.h>

#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_swf_BlendMode
#include <format/swf/BlendMode.h>
#endif
#ifndef INCLUDED_format_swf_ColorModel
#include <format/swf/ColorModel.h>
#endif
#ifndef INCLUDED_format_swf_FillStyle
#include <format/swf/FillStyle.h>
#endif
#ifndef INCLUDED_format_swf_Filter
#include <format/swf/Filter.h>
#endif
#ifndef INCLUDED_format_swf_FontData
#include <format/swf/FontData.h>
#endif
#ifndef INCLUDED_format_swf_FontInfoData
#include <format/swf/FontInfoData.h>
#endif
#ifndef INCLUDED_format_swf_GradRecord
#include <format/swf/GradRecord.h>
#endif
#ifndef INCLUDED_format_swf_InterpolationMode
#include <format/swf/InterpolationMode.h>
#endif
#ifndef INCLUDED_format_swf_JPEGData
#include <format/swf/JPEGData.h>
#endif
#ifndef INCLUDED_format_swf_LS2Fill
#include <format/swf/LS2Fill.h>
#endif
#ifndef INCLUDED_format_swf_LangCode
#include <format/swf/LangCode.h>
#endif
#ifndef INCLUDED_format_swf_LineCapStyle
#include <format/swf/LineCapStyle.h>
#endif
#ifndef INCLUDED_format_swf_LineJoinStyle
#include <format/swf/LineJoinStyle.h>
#endif
#ifndef INCLUDED_format_swf_LineStyleData
#include <format/swf/LineStyleData.h>
#endif
#ifndef INCLUDED_format_swf_Morph2LineStyle
#include <format/swf/Morph2LineStyle.h>
#endif
#ifndef INCLUDED_format_swf_MorphFillStyle
#include <format/swf/MorphFillStyle.h>
#endif
#ifndef INCLUDED_format_swf_MorphShapeData
#include <format/swf/MorphShapeData.h>
#endif
#ifndef INCLUDED_format_swf_PlaceObject
#include <format/swf/PlaceObject.h>
#endif
#ifndef INCLUDED_format_swf_Reader
#include <format/swf/Reader.h>
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
#ifndef INCLUDED_format_swf_SoundData
#include <format/swf/SoundData.h>
#endif
#ifndef INCLUDED_format_swf_SoundFormat
#include <format/swf/SoundFormat.h>
#endif
#ifndef INCLUDED_format_swf_SoundRate
#include <format/swf/SoundRate.h>
#endif
#ifndef INCLUDED_format_swf_SpreadMode
#include <format/swf/SpreadMode.h>
#endif
#ifndef INCLUDED_format_swf_Tools
#include <format/swf/Tools.h>
#endif
#ifndef INCLUDED_format_tools_BitsInput
#include <format/tools/BitsInput.h>
#endif
#ifndef INCLUDED_format_tools_Inflate
#include <format/tools/Inflate.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesBuffer
#include <haxe/io/BytesBuffer.h>
#endif
#ifndef INCLUDED_haxe_io_BytesInput
#include <haxe/io/BytesInput.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace format{
namespace swf{

Void Reader_obj::__construct(haxe::io::Input i)
{
{
	this->i = i;
}
;
	return null();
}

Reader_obj::~Reader_obj() { }

Dynamic Reader_obj::__CreateEmpty() { return  new Reader_obj; }
hxObjectPtr<Reader_obj > Reader_obj::__new(haxe::io::Input i)
{  hxObjectPtr<Reader_obj > result = new Reader_obj();
	result->__construct(i);
	return result;}

Dynamic Reader_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Reader_obj > result = new Reader_obj();
	result->__construct(inArgs[0]);
	return result;}

int Reader_obj::readFixed8( haxe::io::Input i){
	if (i == null())
		i = this->i;
	return i->readUInt16();
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readFixed8,return )

cpp::CppInt32__ Reader_obj::readFixed( ){
	return this->i->readInt32();
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readFixed,return )

haxe::io::Bytes Reader_obj::readUTF8Bytes( ){
	haxe::io::BytesBuffer b = haxe::io::BytesBuffer_obj::__new();
	while(true){
		int c = this->i->readByte();
		if (c == 0)
			break;
		b->b->push(c);
	}
	return b->getBytes();
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readUTF8Bytes,return )

Dynamic Reader_obj::readRect( ){
	this->bits->nbits = 0;
	int nbits = this->bits->readBits(5);
	return hxAnon_obj::Create()->Add( STRING(L"left",4) , format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits))->Add( STRING(L"right",5) , format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits))->Add( STRING(L"top",3) , format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits))->Add( STRING(L"bottom",6) , format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits));
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readRect,return )

Dynamic Reader_obj::readMatrixPart( ){
	int nbits = this->bits->readBits(5);
	return hxAnon_obj::Create()->Add( STRING(L"nbits",5) , nbits)->Add( STRING(L"x",1) , this->bits->readBits(nbits))->Add( STRING(L"y",1) , this->bits->readBits(nbits));
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readMatrixPart,return )

Dynamic Reader_obj::readMatrix( ){
	this->bits->nbits = 0;
	Dynamic scale = null();
	if (this->bits->read()){
		int nbits = this->bits->readBits(5);
		struct _Function_1{
			static double Block( format::swf::Reader_obj *__this,int &nbits)/* DEF (ret block)(not intern) */{
				int i = __this->bits->readBits(nbits);
				i = format::swf::Tools_obj::signExtend(i,nbits);
				return (int(i) >> int(16)) + double((int(i) & int(65535))) / double(65536.0);
			}
		};
		double _x = _Function_1::Block(this,nbits);
		struct _Function_2{
			static double Block( format::swf::Reader_obj *__this,int &nbits)/* DEF (ret block)(not intern) */{
				int i = __this->bits->readBits(nbits);
				i = format::swf::Tools_obj::signExtend(i,nbits);
				return (int(i) >> int(16)) + double((int(i) & int(65535))) / double(65536.0);
			}
		};
		double _y = _Function_2::Block(this,nbits);
		scale = hxAnon_obj::Create()->Add( STRING(L"x",1) , _x)->Add( STRING(L"y",1) , _y);
	}
	Dynamic rotate = null();
	if (this->bits->read()){
		int nbits = this->bits->readBits(5);
		struct _Function_1{
			static double Block( format::swf::Reader_obj *__this,int &nbits)/* DEF (ret block)(not intern) */{
				int i = __this->bits->readBits(nbits);
				i = format::swf::Tools_obj::signExtend(i,nbits);
				return (int(i) >> int(16)) + double((int(i) & int(65535))) / double(65536.0);
			}
		};
		double _rs0 = _Function_1::Block(this,nbits);
		struct _Function_2{
			static double Block( format::swf::Reader_obj *__this,int &nbits)/* DEF (ret block)(not intern) */{
				int i = __this->bits->readBits(nbits);
				i = format::swf::Tools_obj::signExtend(i,nbits);
				return (int(i) >> int(16)) + double((int(i) & int(65535))) / double(65536.0);
			}
		};
		double _rs1 = _Function_2::Block(this,nbits);
		rotate = hxAnon_obj::Create()->Add( STRING(L"rs0",3) , _rs0)->Add( STRING(L"rs1",3) , _rs1);
	}
	int nbits = this->bits->readBits(5);
	Dynamic translate = hxAnon_obj::Create()->Add( STRING(L"x",1) , format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits))->Add( STRING(L"y",1) , format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits));
	return hxAnon_obj::Create()->Add( STRING(L"scale",5) , scale)->Add( STRING(L"rotate",6) , rotate)->Add( STRING(L"translate",9) , translate);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readMatrix,return )

Dynamic Reader_obj::readRGBA( haxe::io::Input i){
	if (i == null())
		i = this->i;
	return hxAnon_obj::Create()->Add( STRING(L"r",1) , i->readByte())->Add( STRING(L"g",1) , i->readByte())->Add( STRING(L"b",1) , i->readByte())->Add( STRING(L"a",1) , i->readByte());
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readRGBA,return )

Dynamic Reader_obj::readRGB( haxe::io::Input i){
	if (i == null())
		i = this->i;
	return hxAnon_obj::Create()->Add( STRING(L"r",1) , i->readByte())->Add( STRING(L"g",1) , i->readByte())->Add( STRING(L"b",1) , i->readByte());
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readRGB,return )

Dynamic Reader_obj::readCXAColor( int nbits){
	return hxAnon_obj::Create()->Add( STRING(L"r",1) , this->bits->readBits(nbits))->Add( STRING(L"g",1) , this->bits->readBits(nbits))->Add( STRING(L"b",1) , this->bits->readBits(nbits))->Add( STRING(L"a",1) , this->bits->readBits(nbits));
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readCXAColor,return )

Dynamic Reader_obj::readCXA( ){
	this->bits->nbits = 0;
	bool add = this->bits->read();
	bool mult = this->bits->read();
	int nbits = this->bits->readBits(4);
	return hxAnon_obj::Create()->Add( STRING(L"nbits",5) , nbits)->Add( STRING(L"mult",4) , mult ? Dynamic( this->readCXAColor(nbits) ) : Dynamic( null() ))->Add( STRING(L"add",3) , add ? Dynamic( this->readCXAColor(nbits) ) : Dynamic( null() ));
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readCXA,return )

Dynamic Reader_obj::readGradient( int ver){
	this->bits->nbits = 0;
	struct _Function_1{
		static format::swf::SpreadMode Block( format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(__this->bits->readBits(2))){
				case 0: {
					return format::swf::SpreadMode_obj::SMPad;
				}
				break;
				case 1: {
					return format::swf::SpreadMode_obj::SMReflect;
				}
				break;
				case 2: {
					return format::swf::SpreadMode_obj::SMRepeat;
				}
				break;
				case 3: {
					return format::swf::SpreadMode_obj::SMReserved;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	format::swf::SpreadMode spread = _Function_1::Block(this);
	struct _Function_2{
		static format::swf::InterpolationMode Block( format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(__this->bits->readBits(2))){
				case 0: {
					return format::swf::InterpolationMode_obj::IMNormalRGB;
				}
				break;
				case 1: {
					return format::swf::InterpolationMode_obj::IMLinearRGB;
				}
				break;
				case 2: {
					return format::swf::InterpolationMode_obj::IMReserved1;
				}
				break;
				case 3: {
					return format::swf::InterpolationMode_obj::IMReserved2;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	format::swf::InterpolationMode interp = _Function_2::Block(this);
	int nGrad = this->bits->readBits(4);
	Array<format::swf::GradRecord > arr = Array_obj<format::swf::GradRecord >::__new();
	{
		int _g = 0;
		while(_g < nGrad){
			int c = _g++;
			int pos = this->i->readByte();
			if (ver <= 2)
				arr->push(format::swf::GradRecord_obj::GRRGB(pos,this->readRGB(null())));
			else
				arr->push(format::swf::GradRecord_obj::GRRGBA(pos,this->readRGBA(null())));
;
		}
	}
	return hxAnon_obj::Create()->Add( STRING(L"spread",6) , spread)->Add( STRING(L"interpolate",11) , interp)->Add( STRING(L"data",4) , arr);
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readGradient,return )

format::swf::LineCapStyle Reader_obj::getLineCap( int t){
	struct _Function_1{
		static format::swf::LineCapStyle Block( int &t,format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(t)){
				case 0: {
					return format::swf::LineCapStyle_obj::LCRound;
				}
				break;
				case 1: {
					return format::swf::LineCapStyle_obj::LCNone;
				}
				break;
				case 2: {
					return format::swf::LineCapStyle_obj::LCSquare;
				}
				break;
				default: {
					return hxThrow (__this->error(STRING(L"invalid lineCap",15)));
				}
			}
		}
	};
	return _Function_1::Block(t,this);
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,getLineCap,return )

Array<Dynamic > Reader_obj::readLineStyles( int ver){
	int cnt = this->i->readByte();
	if (cnt == 255){
		if (ver == 1)
			hxThrow (this->error(STRING(L"invalid line count in line styles array",39)));
		cnt = this->i->readUInt16();
	}
	Array<Dynamic > arr = Array_obj<Dynamic >::__new();
	{
		int _g = 0;
		while(_g < cnt){
			int c = _g++;
			int width = this->i->readUInt16();
			struct _Function_1{
				static format::swf::LineStyleData Block( format::swf::Reader_obj *__this)/* DEF (ret block)(not intern) */{
					return format::swf::LineStyleData_obj::LSRGB(__this->readRGB(__this->i));
				}
			};
			struct _Function_2{
				static format::swf::LineStyleData Block( format::swf::Reader_obj *__this)/* DEF (ret block)(not intern) */{
					return format::swf::LineStyleData_obj::LSRGBA(__this->readRGBA(__this->i));
				}
			};
			struct _Function_3{
				static format::swf::LineStyleData Block( format::swf::Reader_obj *__this,int &ver)/* DEF (ret block)(not intern) */{
					__this->bits->nbits = 0;
					format::swf::LineCapStyle startCap = __this->getLineCap(__this->bits->readBits(2));
					int _join = __this->bits->readBits(2);
					bool _fill = __this->bits->read();
					bool noHScale = __this->bits->read();
					bool noVScale = __this->bits->read();
					bool pixelHinting = __this->bits->read();
					if (__this->bits->readBits(5) != 0)
						hxThrow (__this->error(STRING(L"invalid nbits in line style",27)));
					bool noClose = __this->bits->read();
					format::swf::LineCapStyle endCap = __this->getLineCap(__this->bits->readBits(2));
					struct _Function_4{
						static format::swf::LineJoinStyle Block( int &_join,format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
							switch( (int)(_join)){
								case 0: {
									return format::swf::LineJoinStyle_obj::LJRound;
								}
								break;
								case 1: {
									return format::swf::LineJoinStyle_obj::LJBevel;
								}
								break;
								case 2: {
									struct _Function_5{
										static int Block( format::swf::Reader_obj *__this)/* DEF (ret block)(not intern) */{
											haxe::io::Input i = null();
											if (i == null())
												i = __this->i;
											return i->readUInt16();
										}
									};
									return format::swf::LineJoinStyle_obj::LJMiter(_Function_5::Block(__this));
								}
								break;
								default: {
									return hxThrow (__this->error(STRING(L"invalid joint style in line style",33)));
								}
							}
						}
					};
					format::swf::LineJoinStyle join = _Function_4::Block(_join,__this);
					struct _Function_5{
						static format::swf::LS2Fill Block( bool &_fill,format::swf::Reader_obj *__this,int &ver)/* DEF (not block)(ret intern) */{
							bool _switch_1 = (_fill);
							if (  ( _switch_1==false)){
								return format::swf::LS2Fill_obj::LS2FColor(__this->readRGBA(__this->i));
							}
							else if (  ( _switch_1==true)){
								return format::swf::LS2Fill_obj::LS2FStyle(__this->readFillStyle(ver));
							}
							else  {
								return null();
							}
;
;
						}
					};
					format::swf::LS2Fill fill = _Function_5::Block(_fill,__this,ver);
					return format::swf::LineStyleData_obj::LS2(hxAnon_obj::Create()->Add( STRING(L"startCap",8) , startCap)->Add( STRING(L"join",4) , join)->Add( STRING(L"fill",4) , fill)->Add( STRING(L"noHScale",8) , noHScale)->Add( STRING(L"noVScale",8) , noVScale)->Add( STRING(L"pixelHinting",12) , pixelHinting)->Add( STRING(L"noClose",7) , noClose)->Add( STRING(L"endCap",6) , endCap));
				}
			};
			arr->push(hxAnon_obj::Create()->Add( STRING(L"width",5) , width)->Add( STRING(L"data",4) , ver <= 2 ? format::swf::LineStyleData( _Function_1::Block(this) ) : format::swf::LineStyleData( ver == 3 ? format::swf::LineStyleData( _Function_2::Block(this) ) : format::swf::LineStyleData( ver == 4 ? format::swf::LineStyleData( _Function_3::Block(this,ver) ) : format::swf::LineStyleData( hxThrow (this->error(STRING(L"invalid line style version",26))) ) ) )));
		}
	}
	return arr;
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readLineStyles,return )

format::swf::FillStyle Reader_obj::readFillStyle( int ver){
	int type = this->i->readByte();
	struct _Function_1{
		static format::swf::FillStyle Block( format::swf::Reader_obj *__this,int &type,int &ver)/* DEF (not block)(ret intern) */{
			switch( (int)(type)){
				case 0: {
					return (ver <= 2) ? format::swf::FillStyle( format::swf::FillStyle_obj::FSSolid(__this->readRGB(__this->i)) ) : format::swf::FillStyle( format::swf::FillStyle_obj::FSSolidAlpha(__this->readRGBA(__this->i)) );
				}
				break;
				case 16: case 18: case 19: {
					Dynamic mat = __this->readMatrix();
					Dynamic grad = __this->readGradient(ver);
					struct _Function_2{
						static format::swf::FillStyle Block( format::swf::Reader_obj *__this,Dynamic &mat,int &type,Dynamic &grad)/* DEF (not block)(ret intern) */{
							switch( (int)(type)){
								case 19: {
									struct _Function_3{
										static int Block( format::swf::Reader_obj *__this)/* DEF (ret block)(not intern) */{
											haxe::io::Input i = __this->i;
											if (i == null())
												i = __this->i;
											return i->readUInt16();
										}
									};
									return format::swf::FillStyle_obj::FSFocalGradient(mat,hxAnon_obj::Create()->Add( STRING(L"focalPoint",10) , _Function_3::Block(__this))->Add( STRING(L"data",4) , grad));
								}
								break;
								case 16: {
									return format::swf::FillStyle_obj::FSLinearGradient(mat,grad);
								}
								break;
								case 18: {
									return format::swf::FillStyle_obj::FSRadialGradient(mat,grad);
								}
								break;
								default: {
									return hxThrow (__this->error(STRING(L"invalid fill style type",23)));
								}
							}
						}
					};
					return _Function_2::Block(__this,mat,type,grad);
				}
				break;
				case 64: case 65: case 66: case 67: {
					int cid = __this->i->readUInt16();
					Dynamic mat = __this->readMatrix();
					bool isRepeat = (bool(type == 64) || bool(type == 66));
					bool isSmooth = (bool(type == 64) || bool(type == 65));
					return format::swf::FillStyle_obj::FSBitmap(cid,mat,isRepeat,isSmooth);
				}
				break;
				default: {
					return hxThrow (__this->error(null()) + STRING(L" code ",6) + type);
				}
			}
		}
	};
	return _Function_1::Block(this,type,ver);
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readFillStyle,return )

Array<format::swf::FillStyle > Reader_obj::readFillStyles( int ver){
	int cnt = this->i->readByte();
	if (bool(cnt == 255) && bool(ver > 1))
		cnt = this->i->readUInt16();
	Array<format::swf::FillStyle > arr = Array_obj<format::swf::FillStyle >::__new();
	{
		int _g = 0;
		while(_g < cnt){
			int c = _g++;
			format::swf::FillStyle fillStyle = this->readFillStyle(ver);
			arr->push(fillStyle);
		}
	}
	return arr;
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readFillStyles,return )

Dynamic Reader_obj::readShapeWithStyle( int ver){
	Array<format::swf::FillStyle > fillStyles = this->readFillStyles(ver);
	Array<Dynamic > lineStyles = this->readLineStyles(ver);
	return hxAnon_obj::Create()->Add( STRING(L"fillStyles",10) , fillStyles)->Add( STRING(L"lineStyles",10) , lineStyles)->Add( STRING(L"shapeRecords",12) , this->readShapeRecords(ver));
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readShapeWithStyle,return )

Dynamic Reader_obj::readShapeWithoutStyle( int ver){
	return hxAnon_obj::Create()->Add( STRING(L"shapeRecords",12) , this->readShapeRecords(ver));
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readShapeWithoutStyle,return )

Array<format::swf::ShapeRecord > Reader_obj::readShapeRecords( int ver){
	this->bits->nbits = 0;
	int fillBits = this->bits->readBits(4);
	int lineBits = this->bits->readBits(4);
	Array<format::swf::ShapeRecord > recs = Array_obj<format::swf::ShapeRecord >::__new();
	do{
		if (this->bits->read()){
			if (this->bits->read()){
				int nbits = this->bits->readBits(4) + 2;
				bool isGeneral = this->bits->read();
				bool isVertical = (!isGeneral) ? bool( this->bits->read() ) : bool( false );
				int dx = (bool(isGeneral) || bool(!isVertical)) ? int( format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits) ) : int( 0 );
				int dy = (bool(isGeneral) || bool(isVertical)) ? int( format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits) ) : int( 0 );
				recs->push(format::swf::ShapeRecord_obj::SHREdge(dx,dy));
			}
			else{
				int nbits = this->bits->readBits(4) + 2;
				int cdx = format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits);
				int cdy = format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits);
				int adx = format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits);
				int ady = format::swf::Tools_obj::signExtend(this->bits->readBits(nbits),nbits);
				recs->push(format::swf::ShapeRecord_obj::SHRCurvedEdge(cdx,cdy,adx,ady));
			}
		}
		else{
			int flags = this->bits->readBits(5);
			if (flags == 0){
				recs->push(format::swf::ShapeRecord_obj::SHREnd);
				break;
			}
			else{
				Dynamic cdata = hxAnon_obj::Create()->Add( STRING(L"moveTo",6) , null())->Add( STRING(L"fillStyle0",10) , null())->Add( STRING(L"fillStyle1",10) , null())->Add( STRING(L"lineStyle",9) , null())->Add( STRING(L"newStyles",9) , null());
				if (int(flags) & int(1) != 0){
					int mbits = this->bits->readBits(5);
					int dx = format::swf::Tools_obj::signExtend(this->bits->readBits(mbits),mbits);
					int dy = format::swf::Tools_obj::signExtend(this->bits->readBits(mbits),mbits);
					cdata.FieldRef(STRING(L"moveTo",6)) = hxAnon_obj::Create()->Add( STRING(L"dx",2) , dx)->Add( STRING(L"dy",2) , dy);
				}
				if (int(flags) & int(2) != 0){
					cdata.FieldRef(STRING(L"fillStyle0",10)) = hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->bits->readBits(fillBits));
				}
				if (int(flags) & int(4) != 0){
					cdata.FieldRef(STRING(L"fillStyle1",10)) = hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->bits->readBits(fillBits));
				}
				if (int(flags) & int(8) != 0){
					cdata.FieldRef(STRING(L"lineStyle",9)) = hxAnon_obj::Create()->Add( STRING(L"idx",3) , this->bits->readBits(lineBits));
				}
				if ((int(flags) & int(16) != 0)){
					Array<format::swf::FillStyle > fst = this->readFillStyles(ver);
					Array<Dynamic > lst = this->readLineStyles(ver);
					this->bits->nbits = 0;
					fillBits = this->bits->readBits(4);
					lineBits = this->bits->readBits(4);
					cdata.FieldRef(STRING(L"newStyles",9)) = hxAnon_obj::Create()->Add( STRING(L"fillStyles",10) , fst)->Add( STRING(L"lineStyles",10) , lst);
				}
				recs->push(format::swf::ShapeRecord_obj::SHRChange(cdata));
			}
		}
	}
while(true);
	return recs;
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readShapeRecords,return )

Array<Dynamic > Reader_obj::readClipEvents( ){
	if (this->i->readUInt16() != 0)
		hxThrow (this->error(STRING(L"invalid clip events",19)));
	this->i->readUInt30();
	Array<Dynamic > a = Array_obj<Dynamic >::__new();
	while(true){
		int code = this->i->readUInt30();
		if (code == 0)
			break;
		haxe::io::Bytes data = this->i->read(this->i->readUInt30());
		a->push(hxAnon_obj::Create()->Add( STRING(L"eventsFlags",11) , code)->Add( STRING(L"data",4) , data));
	}
	return a;
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readClipEvents,return )

Dynamic Reader_obj::readFilterFlags( bool top){
	int flags = this->i->readByte();
	return hxAnon_obj::Create()->Add( STRING(L"inner",5) , int(flags) & int(128) != 0)->Add( STRING(L"knockout",8) , int(flags) & int(64) != 0)->Add( STRING(L"ontop",5) , top ? bool( (int(flags) & int(16) != 0) ) : bool( false ))->Add( STRING(L"passes",6) , int(flags) & int((top ? int( 15 ) : int( 31 ))));
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readFilterFlags,return )

Dynamic Reader_obj::readFilterGradient( ){
	int ncolors = this->i->readByte();
	Array<Dynamic > colors = Array_obj<Dynamic >::__new();
	{
		int _g = 0;
		while(_g < ncolors){
			int i = _g++;
			colors->push(hxAnon_obj::Create()->Add( STRING(L"color",5) , this->readRGBA(null()))->Add( STRING(L"position",8) , 0));
		}
	}
	{
		int _g = 0;
		while(_g < colors->length){
			Dynamic c = colors->__get(_g);
			++_g;
			c.FieldRef(STRING(L"position",8)) = this->i->readByte();
		}
	}
	struct _Function_1{
		static int Block( format::swf::Reader_obj *__this)/* DEF (ret block)(not intern) */{
			haxe::io::Input i = null();
			if (i == null())
				i = __this->i;
			return i->readUInt16();
		}
	};
	Dynamic data = hxAnon_obj::Create()->Add( STRING(L"color",5) , null())->Add( STRING(L"color2",6) , null())->Add( STRING(L"blurX",5) , this->i->readInt32())->Add( STRING(L"blurY",5) , this->i->readInt32())->Add( STRING(L"angle",5) , this->i->readInt32())->Add( STRING(L"distance",8) , this->i->readInt32())->Add( STRING(L"strength",8) , _Function_1::Block(this))->Add( STRING(L"flags",5) , this->readFilterFlags(true));
	return hxAnon_obj::Create()->Add( STRING(L"colors",6) , colors)->Add( STRING(L"data",4) , data);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readFilterGradient,return )

format::swf::Filter Reader_obj::readFilter( ){
	int n = this->i->readByte();
	struct _Function_1{
		static format::swf::Filter Block( int &n,format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(n)){
				case 0: {
					struct _Function_2{
						static int Block( format::swf::Reader_obj *__this)/* DEF (ret block)(not intern) */{
							haxe::io::Input i = null();
							if (i == null())
								i = __this->i;
							return i->readUInt16();
						}
					};
					return format::swf::Filter_obj::FDropShadow(hxAnon_obj::Create()->Add( STRING(L"color",5) , __this->readRGBA(null()))->Add( STRING(L"color2",6) , null())->Add( STRING(L"blurX",5) , __this->i->readInt32())->Add( STRING(L"blurY",5) , __this->i->readInt32())->Add( STRING(L"angle",5) , __this->i->readInt32())->Add( STRING(L"distance",8) , __this->i->readInt32())->Add( STRING(L"strength",8) , _Function_2::Block(__this))->Add( STRING(L"flags",5) , __this->readFilterFlags(false)));
				}
				break;
				case 1: {
					return format::swf::Filter_obj::FBlur(hxAnon_obj::Create()->Add( STRING(L"blurX",5) , __this->i->readInt32())->Add( STRING(L"blurY",5) , __this->i->readInt32())->Add( STRING(L"passes",6) , int(__this->i->readByte()) >> int(3)));
				}
				break;
				case 2: {
					struct _Function_2{
						static int Block( format::swf::Reader_obj *__this)/* DEF (ret block)(not intern) */{
							haxe::io::Input i = null();
							if (i == null())
								i = __this->i;
							return i->readUInt16();
						}
					};
					return format::swf::Filter_obj::FGlow(hxAnon_obj::Create()->Add( STRING(L"color",5) , __this->readRGBA(null()))->Add( STRING(L"color2",6) , null())->Add( STRING(L"blurX",5) , __this->i->readInt32())->Add( STRING(L"blurY",5) , __this->i->readInt32())->Add( STRING(L"angle",5) , cpp::CppInt32___obj::ofInt(0))->Add( STRING(L"distance",8) , cpp::CppInt32___obj::ofInt(0))->Add( STRING(L"strength",8) , _Function_2::Block(__this))->Add( STRING(L"flags",5) , __this->readFilterFlags(false)));
				}
				break;
				case 3: {
					struct _Function_2{
						static int Block( format::swf::Reader_obj *__this)/* DEF (ret block)(not intern) */{
							haxe::io::Input i = null();
							if (i == null())
								i = __this->i;
							return i->readUInt16();
						}
					};
					return format::swf::Filter_obj::FBevel(hxAnon_obj::Create()->Add( STRING(L"color",5) , __this->readRGBA(null()))->Add( STRING(L"color2",6) , __this->readRGBA(null()))->Add( STRING(L"blurX",5) , __this->i->readInt32())->Add( STRING(L"blurY",5) , __this->i->readInt32())->Add( STRING(L"angle",5) , __this->i->readInt32())->Add( STRING(L"distance",8) , __this->i->readInt32())->Add( STRING(L"strength",8) , _Function_2::Block(__this))->Add( STRING(L"flags",5) , __this->readFilterFlags(true)));
				}
				break;
				case 5: {
					return hxThrow (__this->error(STRING(L"convolution filter not supported",32)));
				}
				break;
				case 4: {
					return format::swf::Filter_obj::FGradientGlow(__this->readFilterGradient());
				}
				break;
				case 6: {
					Array<double > a = Array_obj<double >::__new();
					{
						int _g = 0;
						while(_g < 20){
							int n1 = _g++;
							a->push(__this->i->readFloat());
						}
					}
					return format::swf::Filter_obj::FColorMatrix(a);
				}
				break;
				case 7: {
					return format::swf::Filter_obj::FGradientBevel(__this->readFilterGradient());
				}
				break;
				default: {
					hxThrow (__this->error(STRING(L"unknown filter",14)));
					return null();
				}
			}
		}
	};
	return _Function_1::Block(n,this);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readFilter,return )

Array<format::swf::Filter > Reader_obj::readFilters( ){
	Array<format::swf::Filter > filters = Array_obj<format::swf::Filter >::__new();
	{
		int _g1 = 0;
		int _g = this->i->readByte();
		while(_g1 < _g){
			int i = _g1++;
			filters->push(this->readFilter());
		}
	}
	return filters;
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readFilters,return )

String Reader_obj::error( Dynamic __o_msg){
String msg = __o_msg.Default(STRING(L"",0));
{
		return STRING(L"Invalid SWF: ",13) + msg;
	}
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,error,return )

Dynamic Reader_obj::readHeader( ){
	String tag = this->i->readString(3);
	bool compressed;
	if (tag == STRING(L"CWS",3))
		compressed = true;
	else
		if (tag == STRING(L"FWS",3))
		compressed = false;
	else
		hxThrow (this->error(STRING(L"invalid file signature",22)));
;
;
	this->version = this->i->readByte();
	int size = this->i->readUInt30();
	if (compressed){
		haxe::io::Bytes bytes = format::tools::Inflate_obj::run(this->i->readAll(null()));
		if (bytes->length + 8 != size)
			hxThrow (this->error(STRING(L"wrong bytes length after decompression",38)));
		this->i = haxe::io::BytesInput_obj::__new(bytes,null(),null());
	}
	this->bits = format::tools::BitsInput_obj::__new(this->i);
	Dynamic r = this->readRect();
	if (bool(r->__Field(STRING(L"left",4)).Cast<int >() != 0) || bool(bool(r->__Field(STRING(L"top",3)).Cast<int >() != 0) || bool(bool(hxMod(r->__Field(STRING(L"right",5)).Cast<int >(),20) != 0) || bool(hxMod(r->__Field(STRING(L"bottom",6)).Cast<int >(),20) != 0))))
		hxThrow (this->error(STRING(L"invalid swf width or height",27)));
	this->i->readByte();
	int fps = this->i->readByte();
	int nframes = this->i->readUInt16();
	return hxAnon_obj::Create()->Add( STRING(L"version",7) , this->version)->Add( STRING(L"compressed",10) , compressed)->Add( STRING(L"width",5) , Std_obj::toInt(double(r->__Field(STRING(L"right",5)).Cast<int >()) / double(20)))->Add( STRING(L"height",6) , Std_obj::toInt(double(r->__Field(STRING(L"bottom",6)).Cast<int >()) / double(20)))->Add( STRING(L"fps",3) , fps)->Add( STRING(L"nframes",7) , nframes);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readHeader,return )

Array<format::swf::SWFTag > Reader_obj::readTagList( ){
	Array<format::swf::SWFTag > a = Array_obj<format::swf::SWFTag >::__new();
	while(true){
		format::swf::SWFTag t = this->readTag();
		if (t == null())
			break;
		a->push(t);
	}
	return a;
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readTagList,return )

format::swf::SWFTag Reader_obj::readShape( int len,int ver){
	int id = this->i->readUInt16();
	if (ver <= 3){
		Dynamic bounds = this->readRect();
		Dynamic sws = this->readShapeWithStyle(ver);
		struct _Function_1{
			static format::swf::ShapeData Block( format::swf::Reader_obj *__this,Dynamic &sws,int &ver,Dynamic &bounds)/* DEF (not block)(ret intern) */{
				switch( (int)(ver)){
					case 1: {
						return format::swf::ShapeData_obj::SHDShape1(bounds,sws);
					}
					break;
					case 2: {
						return format::swf::ShapeData_obj::SHDShape2(bounds,sws);
					}
					break;
					case 3: {
						return format::swf::ShapeData_obj::SHDShape3(bounds,sws);
					}
					break;
					default: {
						return hxThrow (__this->error(STRING(L"invalid shape type",18)));
					}
				}
			}
		};
		return format::swf::SWFTag_obj::TShape(id,_Function_1::Block(this,sws,ver,bounds));
	}
	Dynamic shapeBounds = this->readRect();
	Dynamic edgeBounds = this->readRect();
	this->bits->readBits(5);
	bool useWinding = this->bits->read();
	bool useNonScalingStroke = this->bits->read();
	bool useScalingStroke = this->bits->read();
	Dynamic shapes = this->readShapeWithStyle(ver);
	return format::swf::SWFTag_obj::TShape(id,format::swf::ShapeData_obj::SHDShape4(hxAnon_obj::Create()->Add( STRING(L"shapeBounds",11) , shapeBounds)->Add( STRING(L"edgeBounds",10) , edgeBounds)->Add( STRING(L"useWinding",10) , useWinding)->Add( STRING(L"useNonScalingStroke",19) , useNonScalingStroke)->Add( STRING(L"useScalingStroke",16) , useScalingStroke)->Add( STRING(L"shapes",6) , shapes)));
}


DEFINE_DYNAMIC_FUNC2(Reader_obj,readShape,return )

Dynamic Reader_obj::readMorphGradient( int ver){
	int sr = this->i->readByte();
	Dynamic sc = this->readRGBA(this->i);
	int er = this->i->readByte();
	Dynamic ec = this->readRGBA(this->i);
	return hxAnon_obj::Create()->Add( STRING(L"startRatio",10) , sr)->Add( STRING(L"startColor",10) , sc)->Add( STRING(L"endRatio",8) , er)->Add( STRING(L"endColor",8) , ec);
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readMorphGradient,return )

Array<Dynamic > Reader_obj::readMorphGradients( int ver){
	int num = this->i->readByte();
	if (bool(num < 1) || bool(num > 8))
		hxThrow (STRING(L"Invalid number of morph gradients (",35) + num + STRING(L"). Should be in range 1..8!",27));
	Array<Dynamic > grads = Array_obj<Dynamic >::__new();
	{
		int _g = 0;
		while(_g < num){
			int i = _g++;
			grads->push(this->readMorphGradient(ver));
		}
	}
	return grads;
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readMorphGradients,return )

format::swf::MorphFillStyle Reader_obj::readMorphFillStyle( int ver){
	int type = this->i->readByte();
	struct _Function_1{
		static format::swf::MorphFillStyle Block( format::swf::Reader_obj *__this,int &type,int &ver)/* DEF (not block)(ret intern) */{
			switch( (int)(type)){
				case 0: {
					Dynamic startColor = __this->readRGBA(__this->i);
					Dynamic endColor = __this->readRGBA(__this->i);
					return format::swf::MorphFillStyle_obj::MFSSolid(startColor,endColor);
				}
				break;
				case 16: case 18: case 19: {
					Dynamic startMatrix = __this->readMatrix();
					Dynamic endMatrix = __this->readMatrix();
					Array<Dynamic > grads = __this->readMorphGradients(ver);
					struct _Function_2{
						static format::swf::MorphFillStyle Block( format::swf::Reader_obj *__this,Dynamic &startMatrix,Array<Dynamic > &grads,int &type,Dynamic &endMatrix)/* DEF (not block)(ret intern) */{
							switch( (int)(type)){
								case 16: {
									return format::swf::MorphFillStyle_obj::MFSLinearGradient(startMatrix,endMatrix,grads);
								}
								break;
								case 18: {
									return format::swf::MorphFillStyle_obj::MFSRadialGradient(startMatrix,endMatrix,grads);
								}
								break;
								default: {
									return hxThrow (__this->error(STRING(L"invalid filltype in morphshape",30)));
								}
							}
						}
					};
					return _Function_2::Block(__this,startMatrix,grads,type,endMatrix);
				}
				break;
				case 64: case 65: case 66: case 67: {
					int cid = __this->i->readUInt16();
					Dynamic startMatrix = __this->readMatrix();
					Dynamic endMatrix = __this->readMatrix();
					bool isRepeat = (bool(type == 64) || bool(type == 66));
					bool isSmooth = (bool(type == 64) || bool(type == 65));
					return format::swf::MorphFillStyle_obj::MFSBitmap(cid,startMatrix,endMatrix,isRepeat,isSmooth);
				}
				break;
				default: {
					return hxThrow (__this->error(null()) + STRING(L" code ",6) + type);
				}
			}
		}
	};
	return _Function_1::Block(this,type,ver);
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readMorphFillStyle,return )

Array<format::swf::MorphFillStyle > Reader_obj::readMorphFillStyles( int ver){
	int len = this->i->readByte();
	if (len == 255)
		len = this->i->readUInt16();
	Array<format::swf::MorphFillStyle > fill_styles = Array_obj<format::swf::MorphFillStyle >::__new();
	{
		int _g = 0;
		while(_g < len){
			int i = _g++;
			fill_styles->push(this->readMorphFillStyle(ver));
		}
	}
	return fill_styles;
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readMorphFillStyles,return )

Dynamic Reader_obj::readMorph1LineStyle( ){
	int sw = this->i->readUInt16();
	int ew = this->i->readUInt16();
	Dynamic sc = this->readRGBA(this->i);
	Dynamic ec = this->readRGBA(this->i);
	return hxAnon_obj::Create()->Add( STRING(L"startWidth",10) , sw)->Add( STRING(L"endWidth",8) , ew)->Add( STRING(L"startColor",10) , sc)->Add( STRING(L"endColor",8) , ec);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readMorph1LineStyle,return )

format::swf::Morph2LineStyle Reader_obj::readMorph2LineStyle( ){
	int startWidth = this->i->readUInt16();
	int endWidth = this->i->readUInt16();
	this->bits->nbits = 0;
	int startCapStyle = this->bits->readBits(2);
	int joinStyle = this->bits->readBits(2);
	bool hasFill = this->bits->read();
	bool noHScale = this->bits->read();
	bool noVScale = this->bits->read();
	bool pixelHinting = this->bits->read();
	this->bits->readBits(5);
	bool noClose = this->bits->read();
	int endCapStyle = this->bits->readBits(2);
	this->bits->nbits = 0;
	struct _Function_1{
		static format::swf::LineCapStyle Block( int &startCapStyle)/* DEF (not block)(ret intern) */{
			switch( (int)(startCapStyle)){
				case 0: {
					return format::swf::LineCapStyle_obj::LCRound;
				}
				break;
				case 1: {
					return format::swf::LineCapStyle_obj::LCNone;
				}
				break;
				case 2: {
					return format::swf::LineCapStyle_obj::LCSquare;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	struct _Function_2{
		static format::swf::LineJoinStyle Block( int &joinStyle,format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(joinStyle)){
				case 0: {
					return format::swf::LineJoinStyle_obj::LJRound;
				}
				break;
				case 1: {
					return format::swf::LineJoinStyle_obj::LJBevel;
				}
				break;
				case 2: {
					struct _Function_3{
						static int Block( format::swf::Reader_obj *__this)/* DEF (ret block)(not intern) */{
							haxe::io::Input i = __this->i;
							if (i == null())
								i = __this->i;
							return i->readUInt16();
						}
					};
					return format::swf::LineJoinStyle_obj::LJMiter(_Function_3::Block(__this));
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	struct _Function_3{
		static format::swf::LineCapStyle Block( int &endCapStyle)/* DEF (not block)(ret intern) */{
			switch( (int)(endCapStyle)){
				case 0: {
					return format::swf::LineCapStyle_obj::LCRound;
				}
				break;
				case 1: {
					return format::swf::LineCapStyle_obj::LCNone;
				}
				break;
				case 2: {
					return format::swf::LineCapStyle_obj::LCSquare;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	Dynamic morphData = hxAnon_obj::Create()->Add( STRING(L"startWidth",10) , startWidth)->Add( STRING(L"endWidth",8) , endWidth)->Add( STRING(L"startCapStyle",13) , _Function_1::Block(startCapStyle))->Add( STRING(L"joinStyle",9) , _Function_2::Block(joinStyle,this))->Add( STRING(L"noHScale",8) , noHScale)->Add( STRING(L"noVScale",8) , noVScale)->Add( STRING(L"pixelHinting",12) , pixelHinting)->Add( STRING(L"noClose",7) , noClose)->Add( STRING(L"endCapStyle",11) , _Function_3::Block(endCapStyle));
	if (hasFill)
		return format::swf::Morph2LineStyle_obj::M2LSFill(this->readMorphFillStyle(2),morphData);
	Dynamic startColor = this->readRGBA(this->i);
	Dynamic endColor = this->readRGBA(this->i);
	return format::swf::Morph2LineStyle_obj::M2LSNoFill(startColor,endColor,morphData);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readMorph2LineStyle,return )

Array<Dynamic > Reader_obj::readMorph1LineStyles( ){
	int len = this->i->readByte();
	if (len == 255)
		len = this->i->readUInt16();
	Array<Dynamic > styles = Array_obj<Dynamic >::__new();
	{
		int _g = 0;
		while(_g < len){
			int i = _g++;
			styles->push(this->readMorph1LineStyle());
		}
	}
	return styles;
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readMorph1LineStyles,return )

Array<format::swf::Morph2LineStyle > Reader_obj::readMorph2LineStyles( ){
	int len = this->i->readByte();
	if (len == 255)
		len = this->i->readUInt16();
	Array<format::swf::Morph2LineStyle > styles = Array_obj<format::swf::Morph2LineStyle >::__new();
	{
		int _g = 0;
		while(_g < len){
			int i = _g++;
			styles->push(this->readMorph2LineStyle());
		}
	}
	return styles;
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readMorph2LineStyles,return )

format::swf::SWFTag Reader_obj::readMorphShape( int ver){
	int id = this->i->readUInt16();
	Dynamic startBounds = this->readRect();
	Dynamic endBounds = this->readRect();
	switch( (int)(ver)){
		case 1: {
			this->i->readUInt30();
			Array<format::swf::MorphFillStyle > fillStyles = this->readMorphFillStyles(ver);
			Array<Dynamic > lineStyles = this->readMorph1LineStyles();
			Dynamic startEdges = this->readShapeWithoutStyle(3);
			this->bits->nbits = 0;
			Dynamic endEdges = this->readShapeWithoutStyle(3);
			return format::swf::SWFTag_obj::TMorphShape(id,format::swf::MorphShapeData_obj::MSDShape1(hxAnon_obj::Create()->Add( STRING(L"startBounds",11) , startBounds)->Add( STRING(L"endBounds",9) , endBounds)->Add( STRING(L"fillStyles",10) , fillStyles)->Add( STRING(L"lineStyles",10) , lineStyles)->Add( STRING(L"startEdges",10) , startEdges)->Add( STRING(L"endEdges",8) , endEdges)));
		}
		break;
		case 2: {
			Dynamic startEdgeBounds = this->readRect();
			Dynamic endEdgeBounds = this->readRect();
			this->bits->nbits = 0;
			this->bits->readBits(6);
			bool useNonScalingStrokes = this->bits->read();
			bool useScalingStrokes = this->bits->read();
			this->bits->nbits = 0;
			this->i->readUInt30();
			Array<format::swf::MorphFillStyle > fillStyles = this->readMorphFillStyles(ver);
			Array<format::swf::Morph2LineStyle > lineStyles = this->readMorph2LineStyles();
			Dynamic startEdges = this->readShapeWithoutStyle(4);
			this->bits->nbits = 0;
			Dynamic endEdges = this->readShapeWithoutStyle(4);
			return format::swf::SWFTag_obj::TMorphShape(id,format::swf::MorphShapeData_obj::MSDShape2(hxAnon_obj::Create()->Add( STRING(L"startBounds",11) , startBounds)->Add( STRING(L"endBounds",9) , endBounds)->Add( STRING(L"startEdgeBounds",15) , startEdgeBounds)->Add( STRING(L"endEdgeBounds",13) , endEdgeBounds)->Add( STRING(L"useNonScalingStrokes",20) , useNonScalingStrokes)->Add( STRING(L"useScalingStrokes",17) , useScalingStrokes)->Add( STRING(L"fillStyles",10) , fillStyles)->Add( STRING(L"lineStyles",10) , lineStyles)->Add( STRING(L"startEdges",10) , startEdges)->Add( STRING(L"endEdges",8) , endEdges)));
		}
		break;
		default: {
			hxThrow (STRING(L"Unsupported morph fill style version!",37));
		}
	}
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readMorphShape,return )

format::swf::BlendMode Reader_obj::readBlendMode( ){
	struct _Function_1{
		static format::swf::BlendMode Block( format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(__this->i->readByte())){
				case 0: case 1: {
					return format::swf::BlendMode_obj::BNormal;
				}
				break;
				case 2: {
					return format::swf::BlendMode_obj::BLayer;
				}
				break;
				case 3: {
					return format::swf::BlendMode_obj::BMultiply;
				}
				break;
				case 4: {
					return format::swf::BlendMode_obj::BScreen;
				}
				break;
				case 5: {
					return format::swf::BlendMode_obj::BLighten;
				}
				break;
				case 6: {
					return format::swf::BlendMode_obj::BDarken;
				}
				break;
				case 7: {
					return format::swf::BlendMode_obj::BAdd;
				}
				break;
				case 8: {
					return format::swf::BlendMode_obj::BSubtract;
				}
				break;
				case 9: {
					return format::swf::BlendMode_obj::BDifference;
				}
				break;
				case 10: {
					return format::swf::BlendMode_obj::BInvert;
				}
				break;
				case 11: {
					return format::swf::BlendMode_obj::BAlpha;
				}
				break;
				case 12: {
					return format::swf::BlendMode_obj::BErase;
				}
				break;
				case 13: {
					return format::swf::BlendMode_obj::BOverlay;
				}
				break;
				case 14: {
					return format::swf::BlendMode_obj::BHardLight;
				}
				break;
				default: {
					return hxThrow (__this->error(STRING(L"invalid blend mode",18)));
				}
			}
		}
	};
	return _Function_1::Block(this);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readBlendMode,return )

format::swf::PlaceObject Reader_obj::readPlaceObject( bool v3){
	int f = this->i->readByte();
	int f2 = v3 ? int( this->i->readByte() ) : int( 0 );
	if (int(f2) >> int(3) != 0)
		hxThrow (this->error(STRING(L"unsupported bit flags in place object",37)));
	format::swf::PlaceObject po = format::swf::PlaceObject_obj::__new();
	po->depth = this->i->readUInt16();
	if (int(f) & int(1) != 0)
		po->move = true;
	if (int(f) & int(2) != 0)
		po->cid = this->i->readUInt16();
	if (int(f) & int(4) != 0)
		po->matrix = this->readMatrix();
	if (int(f) & int(8) != 0)
		po->color = this->readCXA();
	if (int(f) & int(16) != 0)
		po->ratio = this->i->readUInt16();
	if (int(f) & int(32) != 0)
		po->instanceName = this->readUTF8Bytes()->toString();
	if (int(f) & int(64) != 0)
		po->clipDepth = this->i->readUInt16();
	if (int(f2) & int(1) != 0)
		po->filters = this->readFilters();
	if (int(f2) & int(2) != 0)
		po->blendMode = this->readBlendMode();
	if (int(f2) & int(4) != 0)
		po->bitmapCache = true;
	if (int(f) & int(128) != 0)
		po->events = this->readClipEvents();
	return po;
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readPlaceObject,return )

Dynamic Reader_obj::readLossless( int len,bool v2){
	int cid = this->i->readUInt16();
	int bits = this->i->readByte();
	struct _Function_1{
		static format::swf::ColorModel Block( int &bits,format::swf::Reader_obj *__this,bool &v2)/* DEF (not block)(ret intern) */{
			switch( (int)(bits)){
				case 3: {
					return format::swf::ColorModel_obj::CM8Bits(__this->i->readByte());
				}
				break;
				case 4: {
					return format::swf::ColorModel_obj::CM15Bits;
				}
				break;
				case 5: {
					return v2 ? format::swf::ColorModel( format::swf::ColorModel_obj::CM32Bits ) : format::swf::ColorModel( format::swf::ColorModel_obj::CM24Bits );
				}
				break;
				default: {
					return hxThrow (__this->error(STRING(L"invalid lossless bits",21)));
				}
			}
		}
	};
	return hxAnon_obj::Create()->Add( STRING(L"cid",3) , cid)->Add( STRING(L"width",5) , this->i->readUInt16())->Add( STRING(L"height",6) , this->i->readUInt16())->Add( STRING(L"color",5) , _Function_1::Block(bits,this,v2))->Add( STRING(L"data",4) , this->i->read(len - (bits == 3 ? int( 8 ) : int( 7 ))));
}


DEFINE_DYNAMIC_FUNC2(Reader_obj,readLossless,return )

Array<Dynamic > Reader_obj::readSymbols( ){
	Array<Dynamic > sl = Array_obj<Dynamic >::__new();
	{
		int _g1 = 0;
		int _g = this->i->readUInt16();
		while(_g1 < _g){
			int n = _g1++;
			sl->push(hxAnon_obj::Create()->Add( STRING(L"cid",3) , this->i->readUInt16())->Add( STRING(L"className",9) , this->i->readUntil(0)));
		}
	}
	return sl;
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readSymbols,return )

format::swf::SWFTag Reader_obj::readSound( int len){
	int sid = this->i->readUInt16();
	this->bits->nbits = 0;
	struct _Function_1{
		static format::swf::SoundFormat Block( format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(__this->bits->readBits(4))){
				case 0: {
					return format::swf::SoundFormat_obj::SFNativeEndianUncompressed;
				}
				break;
				case 1: {
					return format::swf::SoundFormat_obj::SFADPCM;
				}
				break;
				case 2: {
					return format::swf::SoundFormat_obj::SFMP3;
				}
				break;
				case 3: {
					return format::swf::SoundFormat_obj::SFLittleEndianUncompressed;
				}
				break;
				case 4: {
					return format::swf::SoundFormat_obj::SFNellymoser16k;
				}
				break;
				case 5: {
					return format::swf::SoundFormat_obj::SFNellymoser8k;
				}
				break;
				case 6: {
					return format::swf::SoundFormat_obj::SFNellymoser;
				}
				break;
				case 11: {
					return format::swf::SoundFormat_obj::SFSpeex;
				}
				break;
				default: {
					return hxThrow (__this->error(STRING(L"invalid sound format",20)));
				}
			}
		}
	};
	format::swf::SoundFormat soundFormat = _Function_1::Block(this);
	struct _Function_2{
		static format::swf::SoundRate Block( format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(__this->bits->readBits(2))){
				case 0: {
					return format::swf::SoundRate_obj::SR5k;
				}
				break;
				case 1: {
					return format::swf::SoundRate_obj::SR11k;
				}
				break;
				case 2: {
					return format::swf::SoundRate_obj::SR22k;
				}
				break;
				case 3: {
					return format::swf::SoundRate_obj::SR44k;
				}
				break;
				default: {
					return hxThrow (__this->error(STRING(L"invalid sound rate",18)));
				}
			}
		}
	};
	format::swf::SoundRate soundRate = _Function_2::Block(this);
	bool is16bit = this->bits->read();
	bool isStereo = this->bits->read();
	cpp::CppInt32__ soundSamples = this->i->readInt32();
	struct _Function_3{
		static format::swf::SoundData Block( format::swf::Reader_obj *__this,format::swf::SoundFormat &soundFormat,int &len)/* DEF (not block)(ret intern) */{
			format::swf::SoundFormat _switch_2 = (soundFormat);
			switch((_switch_2)->GetIndex()){
				case 2: {
					int seek = __this->i->readInt16();
					return format::swf::SoundData_obj::SDMp3(seek,__this->i->read(len - 9));
				}
				break;
				case 3: {
					return format::swf::SoundData_obj::SDRaw(__this->i->read(len - 7));
				}
				break;
				default: {
					return format::swf::SoundData_obj::SDOther(__this->i->read(len - 7));
				}
			}
		}
	};
	format::swf::SoundData sdata = _Function_3::Block(this,soundFormat,len);
	return format::swf::SWFTag_obj::TSound(hxAnon_obj::Create()->Add( STRING(L"sid",3) , sid)->Add( STRING(L"format",6) , soundFormat)->Add( STRING(L"rate",4) , soundRate)->Add( STRING(L"is16bit",7) , is16bit)->Add( STRING(L"isStereo",8) , isStereo)->Add( STRING(L"samples",7) , soundSamples)->Add( STRING(L"data",4) , sdata));
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readSound,return )

format::swf::LangCode Reader_obj::readLanguage( ){
	struct _Function_1{
		static format::swf::LangCode Block( format::swf::Reader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(__this->i->readByte())){
				case 0: {
					return format::swf::LangCode_obj::LCNone;
				}
				break;
				case 1: {
					return format::swf::LangCode_obj::LCLatin;
				}
				break;
				case 2: {
					return format::swf::LangCode_obj::LCJapanese;
				}
				break;
				case 3: {
					return format::swf::LangCode_obj::LCKorean;
				}
				break;
				case 4: {
					return format::swf::LangCode_obj::LCSimplifiedChinese;
				}
				break;
				case 5: {
					return format::swf::LangCode_obj::LCTraditionalChinese;
				}
				break;
				default: {
					return hxThrow (STRING(L"Unknown language code!",22));
				}
			}
		}
	};
	return _Function_1::Block(this);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readLanguage,return )

Array<Dynamic > Reader_obj::readGlyphs( int len,Array<int > offsets){
	haxe::io::Bytes shape_data = this->i->read(len);
	Array<Dynamic > glyphs = Array_obj<Dynamic >::__new();
	if (offsets->length == 0)
		return glyphs;
	{
		int _g = 0;
		while(_g < offsets->length){
			int offs = offsets->__get(_g);
			++_g;
			haxe::io::Input old_i = this->i;
			format::tools::BitsInput old_bits = this->bits;
			this->i = haxe::io::BytesInput_obj::__new(shape_data,offs,null());
			this->bits = format::tools::BitsInput_obj::__new(this->i);
			glyphs->push(this->readShapeWithoutStyle(1));
			this->i = old_i;
			this->bits = old_bits;
		}
	}
	return glyphs;
}


DEFINE_DYNAMIC_FUNC2(Reader_obj,readGlyphs,return )

Dynamic Reader_obj::readKerningRecord( bool hasWideCodes){
	return hxAnon_obj::Create()->Add( STRING(L"charCode1",9) , hasWideCodes ? int( this->i->readUInt16() ) : int( this->i->readByte() ))->Add( STRING(L"charCode2",9) , hasWideCodes ? int( this->i->readUInt16() ) : int( this->i->readByte() ))->Add( STRING(L"adjust",6) , this->i->readInt16());
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readKerningRecord,return )

format::swf::FontData Reader_obj::readFont1Data( int len){
	int offs1 = this->i->readUInt16();
	int num_glyphs = int(offs1) >> int(1);
	Array<int > offset_table = Array_obj<int >::__new();
	offset_table->push(0);
	{
		int _g = 1;
		while(_g < num_glyphs){
			int j = _g++;
			offset_table->push(this->i->readUInt16() - offs1);
		}
	}
	return format::swf::FontData_obj::FDFont1(hxAnon_obj::Create()->Add( STRING(L"glyphs",6) , this->readGlyphs(len - 2 - num_glyphs * 2,offset_table)));
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readFont1Data,return )

format::swf::FontData Reader_obj::readFont2Data( int ver){
	this->bits->nbits = 0;
	bool hasLayout = this->bits->read();
	bool shiftJIS = this->bits->read();
	bool isSmall = this->bits->read();
	bool isANSI = this->bits->read();
	bool hasWideOffsets = this->bits->read();
	bool hasWideCodes = this->bits->read();
	bool isItalic = this->bits->read();
	bool isBold = this->bits->read();
	format::swf::LangCode language = this->readLanguage();
	String name = this->i->readString(this->i->readByte());
	int num_glyphs = this->i->readUInt16();
	Array<int > offset_table = Array_obj<int >::__new();
	int shape_data_length = 0;
	if (hasWideOffsets){
		int first_glyph_offset = num_glyphs * 4 + 4;
		{
			int _g = 0;
			while(_g < num_glyphs){
				int j = _g++;
				offset_table->push(this->i->readUInt30() - first_glyph_offset);
			}
		}
		int code_table_offset = this->i->readUInt30();
		shape_data_length = code_table_offset - first_glyph_offset;
	}
	else{
		int first_glyph_offset = num_glyphs * 2 + 2;
		{
			int _g = 0;
			while(_g < num_glyphs){
				int j = _g++;
				int offs = this->i->readUInt16();
				offset_table->push(offs - first_glyph_offset);
			}
		}
		int code_table_offset = this->i->readUInt16();
		shape_data_length = code_table_offset - first_glyph_offset;
	}
	Array<Dynamic > glyph_shapes = this->readGlyphs(shape_data_length,offset_table);
	Array<Dynamic > glyphs = Array_obj<Dynamic >::__new();
	if (hasWideCodes){
		{
			int _g = 0;
			while(_g < num_glyphs){
				int j = _g++;
				glyphs->push(hxAnon_obj::Create()->Add( STRING(L"charCode",8) , this->i->readUInt16())->Add( STRING(L"shape",5) , glyph_shapes->__get(j)));
			}
		}
	}
	else{
		{
			int _g = 0;
			while(_g < num_glyphs){
				int j = _g++;
				glyphs->push(hxAnon_obj::Create()->Add( STRING(L"charCode",8) , this->i->readByte())->Add( STRING(L"shape",5) , glyph_shapes->__get(j)));
			}
		}
	}
	Dynamic layout = null();
	if (hasLayout){
		int ascent = this->i->readInt16();
		int descent = this->i->readInt16();
		int leading = this->i->readInt16();
		Array<int > advance_table = Array_obj<int >::__new();
		{
			int _g = 0;
			while(_g < num_glyphs){
				int j = _g++;
				advance_table->push(this->i->readInt16());
			}
		}
		Array<Dynamic > glyph_layout = Array_obj<Dynamic >::__new();
		{
			int _g = 0;
			while(_g < num_glyphs){
				int j = _g++;
				Dynamic bounds = this->readRect();
				glyph_layout->push(hxAnon_obj::Create()->Add( STRING(L"advance",7) , advance_table->__get(j))->Add( STRING(L"bounds",6) , bounds));
			}
		}
		int num_kerning = this->i->readUInt16();
		Array<Dynamic > kerning = Array_obj<Dynamic >::__new();
		{
			int _g = 0;
			while(_g < num_kerning){
				int i = _g++;
				kerning->push(this->readKerningRecord(hasWideCodes));
			}
		}
		layout = hxAnon_obj::Create()->Add( STRING(L"ascent",6) , ascent)->Add( STRING(L"descent",7) , descent)->Add( STRING(L"leading",7) , leading)->Add( STRING(L"glyphs",6) , glyph_layout)->Add( STRING(L"kerning",7) , kerning);
	}
	Dynamic f2data = hxAnon_obj::Create()->Add( STRING(L"shiftJIS",8) , shiftJIS)->Add( STRING(L"isSmall",7) , isSmall)->Add( STRING(L"isANSI",6) , isANSI)->Add( STRING(L"isItalic",8) , isItalic)->Add( STRING(L"isBold",6) , isBold)->Add( STRING(L"language",8) , language)->Add( STRING(L"name",4) , name)->Add( STRING(L"glyphs",6) , glyphs)->Add( STRING(L"layout",6) , layout);
	struct _Function_1{
		static format::swf::FontData Block( bool &hasWideCodes,Dynamic &f2data,int &ver)/* DEF (not block)(ret intern) */{
			switch( (int)(ver)){
				case 2: {
					return format::swf::FontData_obj::FDFont2(hasWideCodes,f2data);
				}
				break;
				case 3: {
					return format::swf::FontData_obj::FDFont3(f2data);
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(hasWideCodes,f2data,ver);
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readFont2Data,return )

format::swf::SWFTag Reader_obj::readFont( int len,int ver){
	int cid = this->i->readUInt16();
	struct _Function_1{
		static format::swf::FontData Block( format::swf::Reader_obj *__this,int &len,int &ver)/* DEF (not block)(ret intern) */{
			switch( (int)(ver)){
				case 1: {
					return __this->readFont1Data(len);
				}
				break;
				case 2: {
					return __this->readFont2Data(ver);
				}
				break;
				case 3: {
					return __this->readFont2Data(ver);
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return format::swf::SWFTag_obj::TFont(cid,_Function_1::Block(this,len,ver));
}


DEFINE_DYNAMIC_FUNC2(Reader_obj,readFont,return )

format::swf::SWFTag Reader_obj::readFontInfo( int len,int ver){
	int cid = this->i->readUInt16();
	String name = this->i->readString(this->i->readByte());
	this->bits->nbits = 0;
	this->bits->readBits(2);
	bool isSmall = this->bits->read();
	bool shiftJIS = this->bits->read();
	bool isANSI = this->bits->read();
	bool isItalic = this->bits->read();
	bool isBold = this->bits->read();
	bool hasWideCodes = this->bits->read();
	format::swf::LangCode language = ver == 2 ? format::swf::LangCode( this->readLanguage() ) : format::swf::LangCode( format::swf::LangCode_obj::LCNone );
	int num_glyphs = len - 4 - name.length;
	Array<int > code_table = Array_obj<int >::__new();
	if (hasWideCodes){
		hxShrEq(num_glyphs,1);
		{
			int _g = 0;
			while(_g < num_glyphs){
				int j = _g++;
				code_table->push(this->i->readUInt16());
			}
		}
	}
	else{
		{
			int _g = 0;
			while(_g < num_glyphs){
				int j = _g++;
				code_table->push(this->i->readByte());
			}
		}
	}
	Dynamic fi_data = hxAnon_obj::Create()->Add( STRING(L"name",4) , name)->Add( STRING(L"isSmall",7) , isSmall)->Add( STRING(L"isItalic",8) , isItalic)->Add( STRING(L"isBold",6) , isBold)->Add( STRING(L"codeTable",9) , code_table);
	struct _Function_1{
		static format::swf::FontInfoData Block( bool &hasWideCodes,format::swf::LangCode &language,int &ver,bool &shiftJIS,bool &isANSI,Dynamic &fi_data)/* DEF (not block)(ret intern) */{
			switch( (int)(ver)){
				case 1: {
					return format::swf::FontInfoData_obj::FIDFont1(shiftJIS,isANSI,hasWideCodes,fi_data);
				}
				break;
				case 2: {
					return format::swf::FontInfoData_obj::FIDFont2(language,fi_data);
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return format::swf::SWFTag_obj::TFontInfo(cid,_Function_1::Block(hasWideCodes,language,ver,shiftJIS,isANSI,fi_data));
}


DEFINE_DYNAMIC_FUNC2(Reader_obj,readFontInfo,return )

Dynamic Reader_obj::readSoundInfo( ){
	this->bits->nbits = 0;
	this->bits->readBits(2);
	bool syncStop = this->bits->readBits(1) == 1 ? bool( true ) : bool( false );
	int syncNoMultiple = this->bits->readBits(1);
	int hasEnvelope = this->bits->readBits(1);
	bool hasLoops = this->bits->readBits(1) == 1 ? bool( true ) : bool( false );
	int hasOutPoint = this->bits->readBits(1);
	int hasInPoint = this->bits->readBits(1);
	int inPoint;
	int outPoint;
	Dynamic loopCount = null();
	int envPoints;
	Array<Dynamic > envelopeRecords;
	if (hasInPoint == 1)
		inPoint = this->i->readUInt30();
	if (hasOutPoint == 1)
		outPoint = this->i->readUInt30();
	if (hasLoops)
		loopCount = this->i->readUInt16();
	if (hasEnvelope == 1){
		envPoints = this->i->readByte();
		envelopeRecords = this->readEnvelopeRecords(envPoints);
	}
	return hxAnon_obj::Create()->Add( STRING(L"syncStop",8) , syncStop)->Add( STRING(L"hasLoops",8) , hasLoops)->Add( STRING(L"loopCount",9) , hasLoops ? Dynamic( loopCount ) : Dynamic( null() ));
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readSoundInfo,return )

Array<Dynamic > Reader_obj::readEnvelopeRecords( int count){
	Array<Dynamic > envelopeRecords = Array_obj<Dynamic >::__new();
	{
		int _g = 0;
		while(_g < count){
			int env = _g++;
			envelopeRecords->push(hxAnon_obj::Create()->Add( STRING(L"pos44",5) , this->i->readUInt30())->Add( STRING(L"leftLevel",9) , this->i->readUInt16())->Add( STRING(L"rightLevel",10) , this->i->readUInt16()));
		}
	}
	return envelopeRecords;
}


DEFINE_DYNAMIC_FUNC1(Reader_obj,readEnvelopeRecords,return )

Dynamic Reader_obj::readFileAttributes( ){
	this->bits->nbits = 0;
	this->bits->readBits(1);
	bool useDirectBlit = this->bits->readBits(1) == 1 ? bool( true ) : bool( false );
	bool useGPU = this->bits->readBits(1) == 1 ? bool( true ) : bool( false );
	bool hasMetaData = this->bits->readBits(1) == 1 ? bool( true ) : bool( false );
	bool actionscript3 = this->bits->readBits(1) == 1 ? bool( true ) : bool( false );
	this->bits->readBits(2);
	bool useNetWork = this->bits->readBits(1) == 1 ? bool( true ) : bool( false );
	this->bits->readBits(24);
	return hxAnon_obj::Create()->Add( STRING(L"useDirectBlit",13) , useDirectBlit)->Add( STRING(L"useGPU",6) , useGPU)->Add( STRING(L"hasMetaData",11) , hasMetaData)->Add( STRING(L"actionscript3",13) , actionscript3)->Add( STRING(L"useNetWork",10) , useNetWork);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readFileAttributes,return )

format::swf::SWFTag Reader_obj::readTag( ){
	int h = this->i->readUInt16();
	int id = int(h) >> int(6);
	int len = int(h) & int(63);
	bool ext = false;
	if (len == 63){
		len = this->i->readUInt30();
		if (len < 63)
			ext = true;
	}
	struct _Function_1{
		static format::swf::SWFTag Block( format::swf::Reader_obj *__this,int &id,int &len)/* DEF (not block)(ret intern) */{
			switch( (int)(id)){
				case 0: {
					return null();
				}
				break;
				case 1: {
					return format::swf::SWFTag_obj::TShowFrame;
				}
				break;
				case 2: {
					return __this->readShape(len,1);
				}
				break;
				case 22: {
					return __this->readShape(len,2);
				}
				break;
				case 32: {
					return __this->readShape(len,3);
				}
				break;
				case 83: {
					return __this->readShape(len,4);
				}
				break;
				case 46: {
					return __this->readMorphShape(1);
				}
				break;
				case 84: {
					return __this->readMorphShape(2);
				}
				break;
				case 10: {
					return __this->readFont(len,1);
				}
				break;
				case 48: {
					return __this->readFont(len,2);
				}
				break;
				case 75: {
					return __this->readFont(len,3);
				}
				break;
				case 13: {
					return __this->readFontInfo(len,1);
				}
				break;
				case 62: {
					return __this->readFontInfo(len,2);
				}
				break;
				case 9: {
					__this->i->setEndian(true);
					int color = __this->i->readUInt24();
					__this->i->setEndian(false);
					return format::swf::SWFTag_obj::TBackgroundColor(color);
				}
				break;
				case 20: {
					return format::swf::SWFTag_obj::TBitsLossless(__this->readLossless(len,false));
				}
				break;
				case 36: {
					return format::swf::SWFTag_obj::TBitsLossless2(__this->readLossless(len,true));
				}
				break;
				case 8: {
					return format::swf::SWFTag_obj::TJPEGTables(__this->i->read(len));
				}
				break;
				case 6: {
					int cid = __this->i->readUInt16();
					return format::swf::SWFTag_obj::TBitsJPEG(cid,format::swf::JPEGData_obj::JDJPEG1(__this->i->read(len - 2)));
				}
				break;
				case 21: {
					int cid = __this->i->readUInt16();
					return format::swf::SWFTag_obj::TBitsJPEG(cid,format::swf::JPEGData_obj::JDJPEG2(__this->i->read(len - 2)));
				}
				break;
				case 35: {
					int cid = __this->i->readUInt16();
					int dataSize = __this->i->readUInt30();
					haxe::io::Bytes data = __this->i->read(dataSize);
					haxe::io::Bytes mask = __this->i->read(len - dataSize - 6);
					return format::swf::SWFTag_obj::TBitsJPEG(cid,format::swf::JPEGData_obj::JDJPEG3(data,mask));
				}
				break;
				case 26: {
					return format::swf::SWFTag_obj::TPlaceObject2(__this->readPlaceObject(false));
				}
				break;
				case 70: {
					return format::swf::SWFTag_obj::TPlaceObject3(__this->readPlaceObject(true));
				}
				break;
				case 28: {
					return format::swf::SWFTag_obj::TRemoveObject2(__this->i->readUInt16());
				}
				break;
				case 39: {
					int cid = __this->i->readUInt16();
					int fcount = __this->i->readUInt16();
					Array<format::swf::SWFTag > tags = __this->readTagList();
					return format::swf::SWFTag_obj::TClip(cid,fcount,tags);
				}
				break;
				case 43: {
					haxe::io::Bytes label = __this->readUTF8Bytes();
					bool anchor = len == label->length + 2 ? bool( __this->i->readByte() == 1 ) : bool( false );
					return format::swf::SWFTag_obj::TFrameLabel(label->toString(),anchor);
				}
				break;
				case 59: {
					int cid = __this->i->readUInt16();
					return format::swf::SWFTag_obj::TDoInitActions(cid,__this->i->read(len - 2));
				}
				break;
				case 69: {
					return format::swf::SWFTag_obj::TSandBox(__this->readFileAttributes());
				}
				break;
				case 72: {
					return format::swf::SWFTag_obj::TActionScript3(__this->i->read(len),null());
				}
				break;
				case 76: {
					return format::swf::SWFTag_obj::TSymbolClass(__this->readSymbols());
				}
				break;
				case 56: {
					return format::swf::SWFTag_obj::TExportAssets(__this->readSymbols());
				}
				break;
				case 82: {
					Dynamic infos = hxAnon_obj::Create()->Add( STRING(L"id",2) , __this->i->readUInt30())->Add( STRING(L"label",5) , __this->i->readUntil(0));
					hxSubEq(len,4 + infos->__Field(STRING(L"label",5)).Cast<String >().length + 1);
					return format::swf::SWFTag_obj::TActionScript3(__this->i->read(len),infos);
				}
				break;
				case 87: {
					int id1 = __this->i->readUInt16();
					if (__this->i->readUInt30() != 0)
						hxThrow (__this->error(STRING(L"invalid binary data tag",23)));
					return format::swf::SWFTag_obj::TBinaryData(id1,__this->i->read(len - 6));
				}
				break;
				case 14: {
					return __this->readSound(len);
				}
				break;
				case 12: {
					return format::swf::SWFTag_obj::TDoAction(__this->i->read(len));
				}
				break;
				case 65: {
					int maxRecursion = __this->i->readUInt16();
					int timeoutSeconds = __this->i->readUInt16();
					return format::swf::SWFTag_obj::TScriptLimits(maxRecursion,timeoutSeconds);
				}
				break;
				case 15: {
					int id1 = __this->i->readUInt16();
					return format::swf::SWFTag_obj::TStartSound(id1,__this->readSoundInfo());
				}
				break;
				case 34: {
					int cid = __this->i->readUInt16();
					haxe::io::Bytes data = __this->i->read(len - 2);
					return format::swf::SWFTag_obj::TUnknown(id,data);
				}
				break;
				case 37: {
					int cid = __this->i->readUInt16();
					haxe::io::Bytes data = __this->i->read(len - 2);
					return format::swf::SWFTag_obj::TUnknown(id,data);
				}
				break;
				case 77: {
					String data = __this->i->readString(len);
					return format::swf::SWFTag_obj::TMetadata(data);
				}
				break;
				case 78: {
					int id1 = __this->i->readUInt16();
					Dynamic splitter = __this->readRect();
					return format::swf::SWFTag_obj::TDefineScalingGrid(id1,splitter);
				}
				break;
				default: {
					haxe::io::Bytes data = __this->i->read(len);
					return format::swf::SWFTag_obj::TUnknown(id,data);
				}
			}
		}
	};
	return _Function_1::Block(this,id,len);
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readTag,return )

Dynamic Reader_obj::read( ){
	return hxAnon_obj::Create()->Add( STRING(L"header",6) , this->readHeader())->Add( STRING(L"tags",4) , this->readTagList());
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,read,return )


Reader_obj::Reader_obj()
{
	InitMember(i);
	InitMember(bits);
	InitMember(version);
	InitMember(bitsRead);
}

void Reader_obj::__Mark()
{
	MarkMember(i);
	MarkMember(bits);
	MarkMember(version);
	MarkMember(bitsRead);
}

Dynamic Reader_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"i",sizeof(wchar_t)*1) ) { return i; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { return bits; }
		if (!memcmp(inName.__s,L"read",sizeof(wchar_t)*4) ) { return read_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"error",sizeof(wchar_t)*5) ) { return error_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"version",sizeof(wchar_t)*7) ) { return version; }
		if (!memcmp(inName.__s,L"readRGB",sizeof(wchar_t)*7) ) { return readRGB_dyn(); }
		if (!memcmp(inName.__s,L"readCXA",sizeof(wchar_t)*7) ) { return readCXA_dyn(); }
		if (!memcmp(inName.__s,L"readTag",sizeof(wchar_t)*7) ) { return readTag_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"bitsRead",sizeof(wchar_t)*8) ) { return bitsRead; }
		if (!memcmp(inName.__s,L"readRect",sizeof(wchar_t)*8) ) { return readRect_dyn(); }
		if (!memcmp(inName.__s,L"readRGBA",sizeof(wchar_t)*8) ) { return readRGBA_dyn(); }
		if (!memcmp(inName.__s,L"readFont",sizeof(wchar_t)*8) ) { return readFont_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"readFixed",sizeof(wchar_t)*9) ) { return readFixed_dyn(); }
		if (!memcmp(inName.__s,L"readShape",sizeof(wchar_t)*9) ) { return readShape_dyn(); }
		if (!memcmp(inName.__s,L"readSound",sizeof(wchar_t)*9) ) { return readSound_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"readFixed8",sizeof(wchar_t)*10) ) { return readFixed8_dyn(); }
		if (!memcmp(inName.__s,L"readMatrix",sizeof(wchar_t)*10) ) { return readMatrix_dyn(); }
		if (!memcmp(inName.__s,L"getLineCap",sizeof(wchar_t)*10) ) { return getLineCap_dyn(); }
		if (!memcmp(inName.__s,L"readFilter",sizeof(wchar_t)*10) ) { return readFilter_dyn(); }
		if (!memcmp(inName.__s,L"readHeader",sizeof(wchar_t)*10) ) { return readHeader_dyn(); }
		if (!memcmp(inName.__s,L"readGlyphs",sizeof(wchar_t)*10) ) { return readGlyphs_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"readFilters",sizeof(wchar_t)*11) ) { return readFilters_dyn(); }
		if (!memcmp(inName.__s,L"readTagList",sizeof(wchar_t)*11) ) { return readTagList_dyn(); }
		if (!memcmp(inName.__s,L"readSymbols",sizeof(wchar_t)*11) ) { return readSymbols_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"readCXAColor",sizeof(wchar_t)*12) ) { return readCXAColor_dyn(); }
		if (!memcmp(inName.__s,L"readGradient",sizeof(wchar_t)*12) ) { return readGradient_dyn(); }
		if (!memcmp(inName.__s,L"readLossless",sizeof(wchar_t)*12) ) { return readLossless_dyn(); }
		if (!memcmp(inName.__s,L"readLanguage",sizeof(wchar_t)*12) ) { return readLanguage_dyn(); }
		if (!memcmp(inName.__s,L"readFontInfo",sizeof(wchar_t)*12) ) { return readFontInfo_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"readUTF8Bytes",sizeof(wchar_t)*13) ) { return readUTF8Bytes_dyn(); }
		if (!memcmp(inName.__s,L"readFillStyle",sizeof(wchar_t)*13) ) { return readFillStyle_dyn(); }
		if (!memcmp(inName.__s,L"readBlendMode",sizeof(wchar_t)*13) ) { return readBlendMode_dyn(); }
		if (!memcmp(inName.__s,L"readFont1Data",sizeof(wchar_t)*13) ) { return readFont1Data_dyn(); }
		if (!memcmp(inName.__s,L"readFont2Data",sizeof(wchar_t)*13) ) { return readFont2Data_dyn(); }
		if (!memcmp(inName.__s,L"readSoundInfo",sizeof(wchar_t)*13) ) { return readSoundInfo_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"readMatrixPart",sizeof(wchar_t)*14) ) { return readMatrixPart_dyn(); }
		if (!memcmp(inName.__s,L"readLineStyles",sizeof(wchar_t)*14) ) { return readLineStyles_dyn(); }
		if (!memcmp(inName.__s,L"readFillStyles",sizeof(wchar_t)*14) ) { return readFillStyles_dyn(); }
		if (!memcmp(inName.__s,L"readClipEvents",sizeof(wchar_t)*14) ) { return readClipEvents_dyn(); }
		if (!memcmp(inName.__s,L"readMorphShape",sizeof(wchar_t)*14) ) { return readMorphShape_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"readFilterFlags",sizeof(wchar_t)*15) ) { return readFilterFlags_dyn(); }
		if (!memcmp(inName.__s,L"readPlaceObject",sizeof(wchar_t)*15) ) { return readPlaceObject_dyn(); }
		break;
	case 16:
		if (!memcmp(inName.__s,L"readShapeRecords",sizeof(wchar_t)*16) ) { return readShapeRecords_dyn(); }
		break;
	case 17:
		if (!memcmp(inName.__s,L"readMorphGradient",sizeof(wchar_t)*17) ) { return readMorphGradient_dyn(); }
		if (!memcmp(inName.__s,L"readKerningRecord",sizeof(wchar_t)*17) ) { return readKerningRecord_dyn(); }
		break;
	case 18:
		if (!memcmp(inName.__s,L"readShapeWithStyle",sizeof(wchar_t)*18) ) { return readShapeWithStyle_dyn(); }
		if (!memcmp(inName.__s,L"readFilterGradient",sizeof(wchar_t)*18) ) { return readFilterGradient_dyn(); }
		if (!memcmp(inName.__s,L"readMorphGradients",sizeof(wchar_t)*18) ) { return readMorphGradients_dyn(); }
		if (!memcmp(inName.__s,L"readMorphFillStyle",sizeof(wchar_t)*18) ) { return readMorphFillStyle_dyn(); }
		if (!memcmp(inName.__s,L"readFileAttributes",sizeof(wchar_t)*18) ) { return readFileAttributes_dyn(); }
		break;
	case 19:
		if (!memcmp(inName.__s,L"readMorphFillStyles",sizeof(wchar_t)*19) ) { return readMorphFillStyles_dyn(); }
		if (!memcmp(inName.__s,L"readMorph1LineStyle",sizeof(wchar_t)*19) ) { return readMorph1LineStyle_dyn(); }
		if (!memcmp(inName.__s,L"readMorph2LineStyle",sizeof(wchar_t)*19) ) { return readMorph2LineStyle_dyn(); }
		if (!memcmp(inName.__s,L"readEnvelopeRecords",sizeof(wchar_t)*19) ) { return readEnvelopeRecords_dyn(); }
		break;
	case 20:
		if (!memcmp(inName.__s,L"readMorph1LineStyles",sizeof(wchar_t)*20) ) { return readMorph1LineStyles_dyn(); }
		if (!memcmp(inName.__s,L"readMorph2LineStyles",sizeof(wchar_t)*20) ) { return readMorph2LineStyles_dyn(); }
		break;
	case 21:
		if (!memcmp(inName.__s,L"readShapeWithoutStyle",sizeof(wchar_t)*21) ) { return readShapeWithoutStyle_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_i = __hxcpp_field_to_id("i");
static int __id_bits = __hxcpp_field_to_id("bits");
static int __id_version = __hxcpp_field_to_id("version");
static int __id_bitsRead = __hxcpp_field_to_id("bitsRead");
static int __id_readFixed8 = __hxcpp_field_to_id("readFixed8");
static int __id_readFixed = __hxcpp_field_to_id("readFixed");
static int __id_readUTF8Bytes = __hxcpp_field_to_id("readUTF8Bytes");
static int __id_readRect = __hxcpp_field_to_id("readRect");
static int __id_readMatrixPart = __hxcpp_field_to_id("readMatrixPart");
static int __id_readMatrix = __hxcpp_field_to_id("readMatrix");
static int __id_readRGBA = __hxcpp_field_to_id("readRGBA");
static int __id_readRGB = __hxcpp_field_to_id("readRGB");
static int __id_readCXAColor = __hxcpp_field_to_id("readCXAColor");
static int __id_readCXA = __hxcpp_field_to_id("readCXA");
static int __id_readGradient = __hxcpp_field_to_id("readGradient");
static int __id_getLineCap = __hxcpp_field_to_id("getLineCap");
static int __id_readLineStyles = __hxcpp_field_to_id("readLineStyles");
static int __id_readFillStyle = __hxcpp_field_to_id("readFillStyle");
static int __id_readFillStyles = __hxcpp_field_to_id("readFillStyles");
static int __id_readShapeWithStyle = __hxcpp_field_to_id("readShapeWithStyle");
static int __id_readShapeWithoutStyle = __hxcpp_field_to_id("readShapeWithoutStyle");
static int __id_readShapeRecords = __hxcpp_field_to_id("readShapeRecords");
static int __id_readClipEvents = __hxcpp_field_to_id("readClipEvents");
static int __id_readFilterFlags = __hxcpp_field_to_id("readFilterFlags");
static int __id_readFilterGradient = __hxcpp_field_to_id("readFilterGradient");
static int __id_readFilter = __hxcpp_field_to_id("readFilter");
static int __id_readFilters = __hxcpp_field_to_id("readFilters");
static int __id_error = __hxcpp_field_to_id("error");
static int __id_readHeader = __hxcpp_field_to_id("readHeader");
static int __id_readTagList = __hxcpp_field_to_id("readTagList");
static int __id_readShape = __hxcpp_field_to_id("readShape");
static int __id_readMorphGradient = __hxcpp_field_to_id("readMorphGradient");
static int __id_readMorphGradients = __hxcpp_field_to_id("readMorphGradients");
static int __id_readMorphFillStyle = __hxcpp_field_to_id("readMorphFillStyle");
static int __id_readMorphFillStyles = __hxcpp_field_to_id("readMorphFillStyles");
static int __id_readMorph1LineStyle = __hxcpp_field_to_id("readMorph1LineStyle");
static int __id_readMorph2LineStyle = __hxcpp_field_to_id("readMorph2LineStyle");
static int __id_readMorph1LineStyles = __hxcpp_field_to_id("readMorph1LineStyles");
static int __id_readMorph2LineStyles = __hxcpp_field_to_id("readMorph2LineStyles");
static int __id_readMorphShape = __hxcpp_field_to_id("readMorphShape");
static int __id_readBlendMode = __hxcpp_field_to_id("readBlendMode");
static int __id_readPlaceObject = __hxcpp_field_to_id("readPlaceObject");
static int __id_readLossless = __hxcpp_field_to_id("readLossless");
static int __id_readSymbols = __hxcpp_field_to_id("readSymbols");
static int __id_readSound = __hxcpp_field_to_id("readSound");
static int __id_readLanguage = __hxcpp_field_to_id("readLanguage");
static int __id_readGlyphs = __hxcpp_field_to_id("readGlyphs");
static int __id_readKerningRecord = __hxcpp_field_to_id("readKerningRecord");
static int __id_readFont1Data = __hxcpp_field_to_id("readFont1Data");
static int __id_readFont2Data = __hxcpp_field_to_id("readFont2Data");
static int __id_readFont = __hxcpp_field_to_id("readFont");
static int __id_readFontInfo = __hxcpp_field_to_id("readFontInfo");
static int __id_readSoundInfo = __hxcpp_field_to_id("readSoundInfo");
static int __id_readEnvelopeRecords = __hxcpp_field_to_id("readEnvelopeRecords");
static int __id_readFileAttributes = __hxcpp_field_to_id("readFileAttributes");
static int __id_readTag = __hxcpp_field_to_id("readTag");
static int __id_read = __hxcpp_field_to_id("read");


Dynamic Reader_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_i) return i;
	if (inFieldID==__id_bits) return bits;
	if (inFieldID==__id_version) return version;
	if (inFieldID==__id_bitsRead) return bitsRead;
	if (inFieldID==__id_readFixed8) return readFixed8_dyn();
	if (inFieldID==__id_readFixed) return readFixed_dyn();
	if (inFieldID==__id_readUTF8Bytes) return readUTF8Bytes_dyn();
	if (inFieldID==__id_readRect) return readRect_dyn();
	if (inFieldID==__id_readMatrixPart) return readMatrixPart_dyn();
	if (inFieldID==__id_readMatrix) return readMatrix_dyn();
	if (inFieldID==__id_readRGBA) return readRGBA_dyn();
	if (inFieldID==__id_readRGB) return readRGB_dyn();
	if (inFieldID==__id_readCXAColor) return readCXAColor_dyn();
	if (inFieldID==__id_readCXA) return readCXA_dyn();
	if (inFieldID==__id_readGradient) return readGradient_dyn();
	if (inFieldID==__id_getLineCap) return getLineCap_dyn();
	if (inFieldID==__id_readLineStyles) return readLineStyles_dyn();
	if (inFieldID==__id_readFillStyle) return readFillStyle_dyn();
	if (inFieldID==__id_readFillStyles) return readFillStyles_dyn();
	if (inFieldID==__id_readShapeWithStyle) return readShapeWithStyle_dyn();
	if (inFieldID==__id_readShapeWithoutStyle) return readShapeWithoutStyle_dyn();
	if (inFieldID==__id_readShapeRecords) return readShapeRecords_dyn();
	if (inFieldID==__id_readClipEvents) return readClipEvents_dyn();
	if (inFieldID==__id_readFilterFlags) return readFilterFlags_dyn();
	if (inFieldID==__id_readFilterGradient) return readFilterGradient_dyn();
	if (inFieldID==__id_readFilter) return readFilter_dyn();
	if (inFieldID==__id_readFilters) return readFilters_dyn();
	if (inFieldID==__id_error) return error_dyn();
	if (inFieldID==__id_readHeader) return readHeader_dyn();
	if (inFieldID==__id_readTagList) return readTagList_dyn();
	if (inFieldID==__id_readShape) return readShape_dyn();
	if (inFieldID==__id_readMorphGradient) return readMorphGradient_dyn();
	if (inFieldID==__id_readMorphGradients) return readMorphGradients_dyn();
	if (inFieldID==__id_readMorphFillStyle) return readMorphFillStyle_dyn();
	if (inFieldID==__id_readMorphFillStyles) return readMorphFillStyles_dyn();
	if (inFieldID==__id_readMorph1LineStyle) return readMorph1LineStyle_dyn();
	if (inFieldID==__id_readMorph2LineStyle) return readMorph2LineStyle_dyn();
	if (inFieldID==__id_readMorph1LineStyles) return readMorph1LineStyles_dyn();
	if (inFieldID==__id_readMorph2LineStyles) return readMorph2LineStyles_dyn();
	if (inFieldID==__id_readMorphShape) return readMorphShape_dyn();
	if (inFieldID==__id_readBlendMode) return readBlendMode_dyn();
	if (inFieldID==__id_readPlaceObject) return readPlaceObject_dyn();
	if (inFieldID==__id_readLossless) return readLossless_dyn();
	if (inFieldID==__id_readSymbols) return readSymbols_dyn();
	if (inFieldID==__id_readSound) return readSound_dyn();
	if (inFieldID==__id_readLanguage) return readLanguage_dyn();
	if (inFieldID==__id_readGlyphs) return readGlyphs_dyn();
	if (inFieldID==__id_readKerningRecord) return readKerningRecord_dyn();
	if (inFieldID==__id_readFont1Data) return readFont1Data_dyn();
	if (inFieldID==__id_readFont2Data) return readFont2Data_dyn();
	if (inFieldID==__id_readFont) return readFont_dyn();
	if (inFieldID==__id_readFontInfo) return readFontInfo_dyn();
	if (inFieldID==__id_readSoundInfo) return readSoundInfo_dyn();
	if (inFieldID==__id_readEnvelopeRecords) return readEnvelopeRecords_dyn();
	if (inFieldID==__id_readFileAttributes) return readFileAttributes_dyn();
	if (inFieldID==__id_readTag) return readTag_dyn();
	if (inFieldID==__id_read) return read_dyn();
	return super::__IField(inFieldID);
}

Dynamic Reader_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"i",sizeof(wchar_t)*1) ) { i=inValue.Cast<haxe::io::Input >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { bits=inValue.Cast<format::tools::BitsInput >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"version",sizeof(wchar_t)*7) ) { version=inValue.Cast<int >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"bitsRead",sizeof(wchar_t)*8) ) { bitsRead=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Reader_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"i",1));
	outFields->push(STRING(L"bits",4));
	outFields->push(STRING(L"version",7));
	outFields->push(STRING(L"bitsRead",8));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"i",1),
	STRING(L"bits",4),
	STRING(L"version",7),
	STRING(L"bitsRead",8),
	STRING(L"readFixed8",10),
	STRING(L"readFixed",9),
	STRING(L"readUTF8Bytes",13),
	STRING(L"readRect",8),
	STRING(L"readMatrixPart",14),
	STRING(L"readMatrix",10),
	STRING(L"readRGBA",8),
	STRING(L"readRGB",7),
	STRING(L"readCXAColor",12),
	STRING(L"readCXA",7),
	STRING(L"readGradient",12),
	STRING(L"getLineCap",10),
	STRING(L"readLineStyles",14),
	STRING(L"readFillStyle",13),
	STRING(L"readFillStyles",14),
	STRING(L"readShapeWithStyle",18),
	STRING(L"readShapeWithoutStyle",21),
	STRING(L"readShapeRecords",16),
	STRING(L"readClipEvents",14),
	STRING(L"readFilterFlags",15),
	STRING(L"readFilterGradient",18),
	STRING(L"readFilter",10),
	STRING(L"readFilters",11),
	STRING(L"error",5),
	STRING(L"readHeader",10),
	STRING(L"readTagList",11),
	STRING(L"readShape",9),
	STRING(L"readMorphGradient",17),
	STRING(L"readMorphGradients",18),
	STRING(L"readMorphFillStyle",18),
	STRING(L"readMorphFillStyles",19),
	STRING(L"readMorph1LineStyle",19),
	STRING(L"readMorph2LineStyle",19),
	STRING(L"readMorph1LineStyles",20),
	STRING(L"readMorph2LineStyles",20),
	STRING(L"readMorphShape",14),
	STRING(L"readBlendMode",13),
	STRING(L"readPlaceObject",15),
	STRING(L"readLossless",12),
	STRING(L"readSymbols",11),
	STRING(L"readSound",9),
	STRING(L"readLanguage",12),
	STRING(L"readGlyphs",10),
	STRING(L"readKerningRecord",17),
	STRING(L"readFont1Data",13),
	STRING(L"readFont2Data",13),
	STRING(L"readFont",8),
	STRING(L"readFontInfo",12),
	STRING(L"readSoundInfo",13),
	STRING(L"readEnvelopeRecords",19),
	STRING(L"readFileAttributes",18),
	STRING(L"readTag",7),
	STRING(L"read",4),
	String(null()) };

static void sMarkStatics() {
};

Class Reader_obj::__mClass;

void Reader_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.swf.Reader",17), TCanCast<Reader_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Reader_obj::__boot()
{
}

} // end namespace format
} // end namespace swf
