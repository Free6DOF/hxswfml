#include <hxObject.h>

#ifndef INCLUDED_format_swf_ShapeRecord
#include <format/swf/ShapeRecord.h>
#endif
namespace format{
namespace swf{

ShapeRecord  ShapeRecord_obj::SHRChange(Dynamic data)
	{ return CreateEnum<ShapeRecord_obj >(STRING(L"SHRChange",9),1,DynamicArray(0,1).Add(data)); }

ShapeRecord  ShapeRecord_obj::SHRCurvedEdge(int cdx,int cdy,int adx,int ady)
	{ return CreateEnum<ShapeRecord_obj >(STRING(L"SHRCurvedEdge",13),3,DynamicArray(0,4).Add(cdx).Add(cdy).Add(adx).Add(ady)); }

ShapeRecord  ShapeRecord_obj::SHREdge(int dx,int dy)
	{ return CreateEnum<ShapeRecord_obj >(STRING(L"SHREdge",7),2,DynamicArray(0,2).Add(dx).Add(dy)); }

ShapeRecord ShapeRecord_obj::SHREnd;

DEFINE_CREATE_ENUM(ShapeRecord_obj)

int ShapeRecord_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"SHRChange",9)) return 1;
	if (inName==STRING(L"SHRCurvedEdge",13)) return 3;
	if (inName==STRING(L"SHREdge",7)) return 2;
	if (inName==STRING(L"SHREnd",6)) return 0;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(ShapeRecord_obj,SHRChange,return)

STATIC_DEFINE_DYNAMIC_FUNC4(ShapeRecord_obj,SHRCurvedEdge,return)

STATIC_DEFINE_DYNAMIC_FUNC2(ShapeRecord_obj,SHREdge,return)

int ShapeRecord_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"SHRChange",9)) return 1;
	if (inName==STRING(L"SHRCurvedEdge",13)) return 4;
	if (inName==STRING(L"SHREdge",7)) return 2;
	if (inName==STRING(L"SHREnd",6)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic ShapeRecord_obj::__Field(const String &inName)
{
	if (inName==STRING(L"SHRChange",9)) return SHRChange_dyn();
	if (inName==STRING(L"SHRCurvedEdge",13)) return SHRCurvedEdge_dyn();
	if (inName==STRING(L"SHREdge",7)) return SHREdge_dyn();
	if (inName==STRING(L"SHREnd",6)) return SHREnd;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"SHRChange",9),
	STRING(L"SHRCurvedEdge",13),
	STRING(L"SHREdge",7),
	STRING(L"SHREnd",6),
	String(null()) };

static void sMarkStatics() {
	MarkMember(ShapeRecord_obj::SHREnd);
};

static String sMemberFields[] = { String(null()) };
Class ShapeRecord_obj::__mClass;

Dynamic __Create_ShapeRecord_obj() { return new ShapeRecord_obj; }

void ShapeRecord_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.ShapeRecord",22), TCanCast<ShapeRecord_obj >,sStaticFields,sMemberFields,
	&__Create_ShapeRecord_obj, &__Create,
	&super::__SGetClass(), &CreateShapeRecord_obj, sMarkStatics);
}

void ShapeRecord_obj::__boot()
{
Static(SHREnd) = CreateEnum<ShapeRecord_obj >(STRING(L"SHREnd",6),0);
}


} // end namespace format
} // end namespace swf
