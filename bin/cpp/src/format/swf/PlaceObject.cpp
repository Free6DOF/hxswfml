#include <hxObject.h>

#ifndef INCLUDED_format_swf_BlendMode
#include <format/swf/BlendMode.h>
#endif
#ifndef INCLUDED_format_swf_Filter
#include <format/swf/Filter.h>
#endif
#ifndef INCLUDED_format_swf_PlaceObject
#include <format/swf/PlaceObject.h>
#endif
namespace format{
namespace swf{

Void PlaceObject_obj::__construct()
{
{
}
;
	return null();
}

PlaceObject_obj::~PlaceObject_obj() { }

Dynamic PlaceObject_obj::__CreateEmpty() { return  new PlaceObject_obj; }
hxObjectPtr<PlaceObject_obj > PlaceObject_obj::__new()
{  hxObjectPtr<PlaceObject_obj > result = new PlaceObject_obj();
	result->__construct();
	return result;}

Dynamic PlaceObject_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<PlaceObject_obj > result = new PlaceObject_obj();
	result->__construct();
	return result;}


PlaceObject_obj::PlaceObject_obj()
{
	InitMember(depth);
	InitMember(move);
	InitMember(cid);
	InitMember(matrix);
	InitMember(color);
	InitMember(ratio);
	InitMember(instanceName);
	InitMember(clipDepth);
	InitMember(events);
	InitMember(filters);
	InitMember(blendMode);
	InitMember(bitmapCache);
}

void PlaceObject_obj::__Mark()
{
	MarkMember(depth);
	MarkMember(move);
	MarkMember(cid);
	MarkMember(matrix);
	MarkMember(color);
	MarkMember(ratio);
	MarkMember(instanceName);
	MarkMember(clipDepth);
	MarkMember(events);
	MarkMember(filters);
	MarkMember(blendMode);
	MarkMember(bitmapCache);
}

Dynamic PlaceObject_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"cid",sizeof(wchar_t)*3) ) { return cid; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"move",sizeof(wchar_t)*4) ) { return move; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"depth",sizeof(wchar_t)*5) ) { return depth; }
		if (!memcmp(inName.__s,L"color",sizeof(wchar_t)*5) ) { return color; }
		if (!memcmp(inName.__s,L"ratio",sizeof(wchar_t)*5) ) { return ratio; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"matrix",sizeof(wchar_t)*6) ) { return matrix; }
		if (!memcmp(inName.__s,L"events",sizeof(wchar_t)*6) ) { return events; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"filters",sizeof(wchar_t)*7) ) { return filters; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"clipDepth",sizeof(wchar_t)*9) ) { return clipDepth; }
		if (!memcmp(inName.__s,L"blendMode",sizeof(wchar_t)*9) ) { return blendMode; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"bitmapCache",sizeof(wchar_t)*11) ) { return bitmapCache; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"instanceName",sizeof(wchar_t)*12) ) { return instanceName; }
	}
	return super::__Field(inName);
}

static int __id_depth = __hxcpp_field_to_id("depth");
static int __id_move = __hxcpp_field_to_id("move");
static int __id_cid = __hxcpp_field_to_id("cid");
static int __id_matrix = __hxcpp_field_to_id("matrix");
static int __id_color = __hxcpp_field_to_id("color");
static int __id_ratio = __hxcpp_field_to_id("ratio");
static int __id_instanceName = __hxcpp_field_to_id("instanceName");
static int __id_clipDepth = __hxcpp_field_to_id("clipDepth");
static int __id_events = __hxcpp_field_to_id("events");
static int __id_filters = __hxcpp_field_to_id("filters");
static int __id_blendMode = __hxcpp_field_to_id("blendMode");
static int __id_bitmapCache = __hxcpp_field_to_id("bitmapCache");


Dynamic PlaceObject_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_depth) return depth;
	if (inFieldID==__id_move) return move;
	if (inFieldID==__id_cid) return cid;
	if (inFieldID==__id_matrix) return matrix;
	if (inFieldID==__id_color) return color;
	if (inFieldID==__id_ratio) return ratio;
	if (inFieldID==__id_instanceName) return instanceName;
	if (inFieldID==__id_clipDepth) return clipDepth;
	if (inFieldID==__id_events) return events;
	if (inFieldID==__id_filters) return filters;
	if (inFieldID==__id_blendMode) return blendMode;
	if (inFieldID==__id_bitmapCache) return bitmapCache;
	return super::__IField(inFieldID);
}

Dynamic PlaceObject_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"cid",sizeof(wchar_t)*3) ) { cid=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"move",sizeof(wchar_t)*4) ) { move=inValue.Cast<bool >();return inValue; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"depth",sizeof(wchar_t)*5) ) { depth=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"color",sizeof(wchar_t)*5) ) { color=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"ratio",sizeof(wchar_t)*5) ) { ratio=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"matrix",sizeof(wchar_t)*6) ) { matrix=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"events",sizeof(wchar_t)*6) ) { events=inValue.Cast<Array<Dynamic > >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"filters",sizeof(wchar_t)*7) ) { filters=inValue.Cast<Array<format::swf::Filter > >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"clipDepth",sizeof(wchar_t)*9) ) { clipDepth=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"blendMode",sizeof(wchar_t)*9) ) { blendMode=inValue.Cast<format::swf::BlendMode >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"bitmapCache",sizeof(wchar_t)*11) ) { bitmapCache=inValue.Cast<bool >();return inValue; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"instanceName",sizeof(wchar_t)*12) ) { instanceName=inValue.Cast<String >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void PlaceObject_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"depth",5));
	outFields->push(STRING(L"move",4));
	outFields->push(STRING(L"cid",3));
	outFields->push(STRING(L"matrix",6));
	outFields->push(STRING(L"color",5));
	outFields->push(STRING(L"ratio",5));
	outFields->push(STRING(L"instanceName",12));
	outFields->push(STRING(L"clipDepth",9));
	outFields->push(STRING(L"events",6));
	outFields->push(STRING(L"filters",7));
	outFields->push(STRING(L"blendMode",9));
	outFields->push(STRING(L"bitmapCache",11));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"depth",5),
	STRING(L"move",4),
	STRING(L"cid",3),
	STRING(L"matrix",6),
	STRING(L"color",5),
	STRING(L"ratio",5),
	STRING(L"instanceName",12),
	STRING(L"clipDepth",9),
	STRING(L"events",6),
	STRING(L"filters",7),
	STRING(L"blendMode",9),
	STRING(L"bitmapCache",11),
	String(null()) };

static void sMarkStatics() {
};

Class PlaceObject_obj::__mClass;

void PlaceObject_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.swf.PlaceObject",22), TCanCast<PlaceObject_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void PlaceObject_obj::__boot()
{
}

} // end namespace format
} // end namespace swf
