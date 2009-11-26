#include <hxObject.h>

#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_StringBuf
#include <StringBuf.h>
#endif
#ifndef INCLUDED_StringTools
#include <StringTools.h>
#endif
#ifndef INCLUDED_Type
#include <Type.h>
#endif
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_swf_ColorModel
#include <format/swf/ColorModel.h>
#endif
#ifndef INCLUDED_format_swf_FontData
#include <format/swf/FontData.h>
#endif
#ifndef INCLUDED_format_swf_FontInfoData
#include <format/swf/FontInfoData.h>
#endif
#ifndef INCLUDED_format_swf_JPEGData
#include <format/swf/JPEGData.h>
#endif
#ifndef INCLUDED_format_swf_MorphShapeData
#include <format/swf/MorphShapeData.h>
#endif
#ifndef INCLUDED_format_swf_PlaceObject
#include <format/swf/PlaceObject.h>
#endif
#ifndef INCLUDED_format_swf_SWFTag
#include <format/swf/SWFTag.h>
#endif
#ifndef INCLUDED_format_swf_ShapeData
#include <format/swf/ShapeData.h>
#endif
#ifndef INCLUDED_format_swf_SoundFormat
#include <format/swf/SoundFormat.h>
#endif
#ifndef INCLUDED_format_swf_SoundRate
#include <format/swf/SoundRate.h>
#endif
#ifndef INCLUDED_format_swf_Tools
#include <format/swf/Tools.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
namespace format{
namespace swf{

Void Tools_obj::__construct()
{
	return null();
}

Tools_obj::~Tools_obj() { }

Dynamic Tools_obj::__CreateEmpty() { return  new Tools_obj; }
hxObjectPtr<Tools_obj > Tools_obj::__new()
{  hxObjectPtr<Tools_obj > result = new Tools_obj();
	result->__construct();
	return result;}

Dynamic Tools_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Tools_obj > result = new Tools_obj();
	result->__construct();
	return result;}

int Tools_obj::signExtend( int v,int nbits){
	int max = int(1) << int(nbits);
	if (int(v) & int((int(max) >> int(1))) != 0)
		return v - max;
	return v;
}


STATIC_DEFINE_DYNAMIC_FUNC2(Tools_obj,signExtend,return )

double Tools_obj::floatFixedBits( int i,int nbits){
	i = format::swf::Tools_obj::signExtend(i,nbits);
	return (int(i) >> int(16)) + double((int(i) & int(65535))) / double(65536.0);
}


STATIC_DEFINE_DYNAMIC_FUNC2(Tools_obj,floatFixedBits,return )

double Tools_obj::floatFixed( cpp::CppInt32__ i){
	return cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::shr(i,16)) + double(cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::_and(i,cpp::CppInt32___obj::ofInt(65535)))) / double(65536.0);
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,floatFixed,return )

double Tools_obj::floatFixed8( int i){
	return (int(i) >> int(8)) + double((int(i) & int(255))) / double(256.0);
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,floatFixed8,return )

int Tools_obj::toFixed8( double f){
	int i = Std_obj::toInt(f);
	if (((i > 0) ? int( i ) : int( -i )) >= 128)
		hxThrow (haxe::io::Error_obj::Overflow);
	if (i < 0)
		i = 256 - i;
	return int((int(i) << int(8))) | int(Std_obj::toInt((f - i) * 256.0));
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,toFixed8,return )

int Tools_obj::toFixed16( double f){
	int i = Std_obj::toInt(f);
	if (((i > 0) ? int( i ) : int( -i )) >= 32768)
		hxThrow (haxe::io::Error_obj::Overflow);
	if (i < 0)
		i = 65536 - i;
	return int((int(i) << int(16))) | int(Std_obj::toInt((f - i) * 65536.0));
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,toFixed16,return )

int Tools_obj::minBits( Array<int > values){
	int max_bits = 0;
	{
		int _g = 0;
		while(_g < values->length){
			int x = values->__get(_g);
			++_g;
			if (x < 0)
				x = -x;
			hxOrEq(x,(int(x) >> int(1)));
			hxOrEq(x,(int(x) >> int(2)));
			hxOrEq(x,(int(x) >> int(4)));
			hxOrEq(x,(int(x) >> int(8)));
			hxOrEq(x,(int(x) >> int(16)));
			hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
			x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
			x = (int(((int(x) >> int(4)) + x)) & int(252645135));
			hxAddEq(x,(int(x) >> int(8)));
			hxAddEq(x,(int(x) >> int(16)));
			hxAndEq(x,63);
			if (x > max_bits)
				max_bits = x;
		}
	}
	return max_bits;
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,minBits,return )

String Tools_obj::hex( haxe::io::Bytes b,Dynamic max){
	Array<int > hex = Array_obj<int >::__new().Add(48).Add(49).Add(50).Add(51).Add(52).Add(53).Add(54).Add(55).Add(56).Add(57).Add(65).Add(66).Add(67).Add(68).Add(69).Add(70);
	Dynamic count = bool(max == null()) || bool(b->length <= max) ? Dynamic( b->length ) : Dynamic( max );
	StringBuf buf = StringBuf_obj::__new();
	{
		int _g = 0;
		while(_g < count){
			int i = _g++;
			int v = b->b->__get(i);
			hxAddEq(buf->b,String::fromCharCode(hex->__get(int(v) >> int(4))));
			hxAddEq(buf->b,String::fromCharCode(hex->__get(int(v) & int(15))));
		}
	}
	if (count < b->length)
		hxAddEq(buf->b,STRING(L"...",3));
	return buf->b;
}


STATIC_DEFINE_DYNAMIC_FUNC2(Tools_obj,hex,return )

String Tools_obj::bin( haxe::io::Bytes b,Dynamic maxBytes){
	StringBuf buf = StringBuf_obj::__new();
	Dynamic cnt = (maxBytes == null()) ? Dynamic( b->length ) : Dynamic( (maxBytes > b->length ? Dynamic( b->length ) : Dynamic( maxBytes )) );
	{
		int _g = 0;
		while(_g < cnt){
			int i = _g++;
			int v = b->b->__get(i);
			{
				int _g1 = 0;
				while(_g1 < 8){
					int j = _g1++;
					hxAddEq(buf->b,(int((int(v) >> int((7 - j)))) & int(1) == 1) ? String( STRING(L"1",1) ) : String( STRING(L"0",1) ));
					if (j == 3)
						hxAddEq(buf->b,STRING(L" ",1));
				}
			}
			hxAddEq(buf->b,STRING(L"  ",2));
		}
	}
	return buf->b;
}


STATIC_DEFINE_DYNAMIC_FUNC2(Tools_obj,bin,return )

String Tools_obj::dumpTag( format::swf::SWFTag t,Dynamic max){
	struct _Function_1{
		static Array<Dynamic > Block( format::swf::SWFTag &t,Dynamic &max)/* DEF (not block)(ret intern) */{
			format::swf::SWFTag _switch_1 = (t);
			switch((_switch_1)->GetIndex()){
				case 0: {
					return Array_obj<String >::__new();
				}
				break;
				case 1: {
					return Array_obj<String >::__new();
				}
				break;
				case 6: {
					int color = _switch_1->__Param(0);
{
						return Array_obj<String >::__new().Add(StringTools_obj::hex(color,6));
					}
				}
				break;
				case 2: {
					format::swf::ShapeData sdata = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id);
					}
				}
				break;
				case 3: {
					format::swf::MorphShapeData data = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id);
					}
				}
				break;
				case 4: {
					format::swf::FontData data = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id);
					}
				}
				break;
				case 5: {
					format::swf::FontInfoData data = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id);
					}
				}
				break;
				case 21: {
					haxe::io::Bytes data = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"data",4)).Add(format::swf::Tools_obj::hex(data,max));
					}
				}
				break;
				case 7: {
					Array<format::swf::SWFTag > tags = _switch_1->__Param(2);
					int frames = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"frames",6)).Add(frames);
					}
				}
				break;
				case 8: {
					format::swf::PlaceObject po = _switch_1->__Param(0);
{
						return Array_obj<String >::__new().Add(Std_obj::string(po));
					}
				}
				break;
				case 9: {
					format::swf::PlaceObject po = _switch_1->__Param(0);
{
						return Array_obj<String >::__new().Add(Std_obj::string(po));
					}
				}
				break;
				case 10: {
					int d = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"depth",5)).Add(d);
					}
				}
				break;
				case 11: {
					bool anchor = _switch_1->__Param(1);
					String label = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"label",5)).Add(label).Add(STRING(L"anchor",6)).Add(anchor);
					}
				}
				break;
				case 12: {
					haxe::io::Bytes data = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"data",4)).Add(format::swf::Tools_obj::hex(data,max));
					}
				}
				break;
				case 13: {
					Dynamic context = _switch_1->__Param(1);
					haxe::io::Bytes data = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"context",7)).Add(context).Add(STRING(L"data",4)).Add(format::swf::Tools_obj::hex(data,max));
					}
				}
				break;
				case 14: {
					Array<Dynamic > symbols = _switch_1->__Param(0);
{
						return Array_obj<String >::__new().Add(Std_obj::string(symbols));
					}
				}
				break;
				case 15: {
					Array<Dynamic > symbols = _switch_1->__Param(0);
{
						return Array_obj<String >::__new().Add(Std_obj::string(symbols));
					}
				}
				break;
				case 16: {
					Dynamic v = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(v);
					}
				}
				break;
				case 17: case 18: {
					Dynamic l = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(l->__Field(STRING(L"cid",3)).Cast<int >()).Add(STRING(L"color",5)).Add(l->__Field(STRING(L"color",5)).Cast<format::swf::ColorModel >()).Add(STRING(L"width",5)).Add(l->__Field(STRING(L"width",5)).Cast<int >()).Add(STRING(L"height",6)).Add(l->__Field(STRING(L"height",6)).Cast<int >()).Add(STRING(L"data",4)).Add(format::swf::Tools_obj::hex(l->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >(),max));
					}
				}
				break;
				case 20: {
					haxe::io::Bytes data = _switch_1->__Param(0);
{
						return Array_obj<String >::__new().Add(STRING(L"data",4)).Add(format::swf::Tools_obj::hex(data,max));
					}
				}
				break;
				case 19: {
					format::swf::JPEGData jdata = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						struct _Function_2{
							static Array<Dynamic > Block( Dynamic &max,int &id,format::swf::JPEGData &jdata)/* DEF (not block)(ret intern) */{
								format::swf::JPEGData _switch_2 = (jdata);
								switch((_switch_2)->GetIndex()){
									case 0: {
										haxe::io::Bytes data = _switch_2->__Param(0);
{
											return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"ver",3)).Add(1).Add(STRING(L"data",4)).Add(format::swf::Tools_obj::hex(data,max));
										}
									}
									break;
									case 1: {
										haxe::io::Bytes data = _switch_2->__Param(0);
{
											return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"ver",3)).Add(2).Add(STRING(L"data",4)).Add(format::swf::Tools_obj::hex(data,max));
										}
									}
									break;
									case 2: {
										haxe::io::Bytes mask = _switch_2->__Param(1);
										haxe::io::Bytes data = _switch_2->__Param(0);
{
											return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"ver",3)).Add(3).Add(STRING(L"data",4)).Add(format::swf::Tools_obj::hex(data,max)).Add(STRING(L"mask",4)).Add(format::swf::Tools_obj::hex(mask,max));
										}
									}
									break;
									default: {
										return null();
									}
								}
							}
						};
						return _Function_2::Block(max,id,jdata);
					}
				}
				break;
				case 22: {
					Dynamic data = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"sid",3)).Add(data->__Field(STRING(L"sid",3)).Cast<int >()).Add(STRING(L"format",6)).Add(data->__Field(STRING(L"format",6)).Cast<format::swf::SoundFormat >()).Add(STRING(L"rate",4)).Add(data->__Field(STRING(L"rate",4)).Cast<format::swf::SoundRate >());
					}
				}
				break;
				case 23: {
					Dynamic soundInfo = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"syncStop",8)).Add(soundInfo->__Field(STRING(L"syncStop",8)).Cast<bool >()).Add(STRING(L"hasLoops",8)).Add(soundInfo->__Field(STRING(L"hasLoops",8)).Cast<bool >()).Add(STRING(L"loopCount",9)).Add(soundInfo->__Field(STRING(L"loopCount",9)));
					}
				}
				break;
				case 24: {
					haxe::io::Bytes data = _switch_1->__Param(0);
{
						return Array_obj<String >::__new().Add(format::swf::Tools_obj::hex(data,max));
					}
				}
				break;
				case 25: {
					int timeoutSeconds = _switch_1->__Param(1);
					int maxRecursion = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"maxRecursion",12)).Add(maxRecursion).Add(STRING(L"timeoutSeconds",14)).Add(timeoutSeconds);
					}
				}
				break;
				case 26: {
					Array<Dynamic > records = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"records",7)).Add(records);
					}
				}
				break;
				case 27: {
					Dynamic data = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id);
					}
				}
				break;
				case 28: {
					String data = _switch_1->__Param(0);
{
						return Array_obj<String >::__new().Add(STRING(L"metadata",8)).Add(data);
					}
				}
				break;
				case 29: {
					Dynamic splitter = _switch_1->__Param(1);
					int id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"splitter",8)).Add(STRING(L"todo",4));
					}
				}
				break;
				case 30: {
					haxe::io::Bytes data = _switch_1->__Param(1);
					Dynamic id = _switch_1->__Param(0);
{
						return Array_obj<Dynamic >::__new().Add(STRING(L"id",2)).Add(id).Add(STRING(L"data",4)).Add(format::swf::Tools_obj::hex(data,max));
					}
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	Array<Dynamic > infos = _Function_1::Block(t,max);
	StringBuf b = StringBuf_obj::__new();
	hxAddEq(b->b,Type_obj::enumConstructor(t));
	hxAddEq(b->b,STRING(L"(",1));
	while(infos->length > 0){
		hxAddEq(b->b,infos->shift());
		if (infos->length == 0)
			break;
		hxAddEq(b->b,STRING(L":",1));
		hxAddEq(b->b,infos->shift());
		if (infos->length == 0)
			break;
		hxAddEq(b->b,STRING(L",",1));
	}
	hxAddEq(b->b,STRING(L")",1));
	return b->b;
}


STATIC_DEFINE_DYNAMIC_FUNC2(Tools_obj,dumpTag,return )


Tools_obj::Tools_obj()
{
}

void Tools_obj::__Mark()
{
}

Dynamic Tools_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"hex",sizeof(wchar_t)*3) ) { return hex_dyn(); }
		if (!memcmp(inName.__s,L"bin",sizeof(wchar_t)*3) ) { return bin_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"minBits",sizeof(wchar_t)*7) ) { return minBits_dyn(); }
		if (!memcmp(inName.__s,L"dumpTag",sizeof(wchar_t)*7) ) { return dumpTag_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"toFixed8",sizeof(wchar_t)*8) ) { return toFixed8_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"toFixed16",sizeof(wchar_t)*9) ) { return toFixed16_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"signExtend",sizeof(wchar_t)*10) ) { return signExtend_dyn(); }
		if (!memcmp(inName.__s,L"floatFixed",sizeof(wchar_t)*10) ) { return floatFixed_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"floatFixed8",sizeof(wchar_t)*11) ) { return floatFixed8_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"floatFixedBits",sizeof(wchar_t)*14) ) { return floatFixedBits_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_signExtend = __hxcpp_field_to_id("signExtend");
static int __id_floatFixedBits = __hxcpp_field_to_id("floatFixedBits");
static int __id_floatFixed = __hxcpp_field_to_id("floatFixed");
static int __id_floatFixed8 = __hxcpp_field_to_id("floatFixed8");
static int __id_toFixed8 = __hxcpp_field_to_id("toFixed8");
static int __id_toFixed16 = __hxcpp_field_to_id("toFixed16");
static int __id_minBits = __hxcpp_field_to_id("minBits");
static int __id_hex = __hxcpp_field_to_id("hex");
static int __id_bin = __hxcpp_field_to_id("bin");
static int __id_dumpTag = __hxcpp_field_to_id("dumpTag");


Dynamic Tools_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_signExtend) return signExtend_dyn();
	if (inFieldID==__id_floatFixedBits) return floatFixedBits_dyn();
	if (inFieldID==__id_floatFixed) return floatFixed_dyn();
	if (inFieldID==__id_floatFixed8) return floatFixed8_dyn();
	if (inFieldID==__id_toFixed8) return toFixed8_dyn();
	if (inFieldID==__id_toFixed16) return toFixed16_dyn();
	if (inFieldID==__id_minBits) return minBits_dyn();
	if (inFieldID==__id_hex) return hex_dyn();
	if (inFieldID==__id_bin) return bin_dyn();
	if (inFieldID==__id_dumpTag) return dumpTag_dyn();
	return super::__IField(inFieldID);
}

Dynamic Tools_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void Tools_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"signExtend",10),
	STRING(L"floatFixedBits",14),
	STRING(L"floatFixed",10),
	STRING(L"floatFixed8",11),
	STRING(L"toFixed8",8),
	STRING(L"toFixed16",9),
	STRING(L"minBits",7),
	STRING(L"hex",3),
	STRING(L"bin",3),
	STRING(L"dumpTag",7),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
};

Class Tools_obj::__mClass;

void Tools_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.swf.Tools",16), TCanCast<Tools_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Tools_obj::__boot()
{
}

} // end namespace format
} // end namespace swf
