#include <hxObject.h>

#ifndef INCLUDED_format_swf_FillStyleTypeId
#include <format/swf/FillStyleTypeId.h>
#endif
namespace format{
namespace swf{

Void FillStyleTypeId_obj::__construct()
{
	return null();
}

FillStyleTypeId_obj::~FillStyleTypeId_obj() { }

Dynamic FillStyleTypeId_obj::__CreateEmpty() { return  new FillStyleTypeId_obj; }
hxObjectPtr<FillStyleTypeId_obj > FillStyleTypeId_obj::__new()
{  hxObjectPtr<FillStyleTypeId_obj > result = new FillStyleTypeId_obj();
	result->__construct();
	return result;}

Dynamic FillStyleTypeId_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<FillStyleTypeId_obj > result = new FillStyleTypeId_obj();
	result->__construct();
	return result;}

int FillStyleTypeId_obj::Solid;

int FillStyleTypeId_obj::LinearGradient;

int FillStyleTypeId_obj::RadialGradient;

int FillStyleTypeId_obj::FocalRadialGradient;

int FillStyleTypeId_obj::RepeatingBitmap;

int FillStyleTypeId_obj::ClippedBitmap;

int FillStyleTypeId_obj::NonSmoothedRepeatingBitmap;

int FillStyleTypeId_obj::NonSmoothedClippedBitmap;


FillStyleTypeId_obj::FillStyleTypeId_obj()
{
}

void FillStyleTypeId_obj::__Mark()
{
}

Dynamic FillStyleTypeId_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"Solid",sizeof(wchar_t)*5) ) { return Solid; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"ClippedBitmap",sizeof(wchar_t)*13) ) { return ClippedBitmap; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"LinearGradient",sizeof(wchar_t)*14) ) { return LinearGradient; }
		if (!memcmp(inName.__s,L"RadialGradient",sizeof(wchar_t)*14) ) { return RadialGradient; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"RepeatingBitmap",sizeof(wchar_t)*15) ) { return RepeatingBitmap; }
		break;
	case 19:
		if (!memcmp(inName.__s,L"FocalRadialGradient",sizeof(wchar_t)*19) ) { return FocalRadialGradient; }
		break;
	case 24:
		if (!memcmp(inName.__s,L"NonSmoothedClippedBitmap",sizeof(wchar_t)*24) ) { return NonSmoothedClippedBitmap; }
		break;
	case 26:
		if (!memcmp(inName.__s,L"NonSmoothedRepeatingBitmap",sizeof(wchar_t)*26) ) { return NonSmoothedRepeatingBitmap; }
	}
	return super::__Field(inName);
}

static int __id_Solid = __hxcpp_field_to_id("Solid");
static int __id_LinearGradient = __hxcpp_field_to_id("LinearGradient");
static int __id_RadialGradient = __hxcpp_field_to_id("RadialGradient");
static int __id_FocalRadialGradient = __hxcpp_field_to_id("FocalRadialGradient");
static int __id_RepeatingBitmap = __hxcpp_field_to_id("RepeatingBitmap");
static int __id_ClippedBitmap = __hxcpp_field_to_id("ClippedBitmap");
static int __id_NonSmoothedRepeatingBitmap = __hxcpp_field_to_id("NonSmoothedRepeatingBitmap");
static int __id_NonSmoothedClippedBitmap = __hxcpp_field_to_id("NonSmoothedClippedBitmap");


Dynamic FillStyleTypeId_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_Solid) return Solid;
	if (inFieldID==__id_LinearGradient) return LinearGradient;
	if (inFieldID==__id_RadialGradient) return RadialGradient;
	if (inFieldID==__id_FocalRadialGradient) return FocalRadialGradient;
	if (inFieldID==__id_RepeatingBitmap) return RepeatingBitmap;
	if (inFieldID==__id_ClippedBitmap) return ClippedBitmap;
	if (inFieldID==__id_NonSmoothedRepeatingBitmap) return NonSmoothedRepeatingBitmap;
	if (inFieldID==__id_NonSmoothedClippedBitmap) return NonSmoothedClippedBitmap;
	return super::__IField(inFieldID);
}

Dynamic FillStyleTypeId_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"Solid",sizeof(wchar_t)*5) ) { Solid=inValue.Cast<int >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"ClippedBitmap",sizeof(wchar_t)*13) ) { ClippedBitmap=inValue.Cast<int >();return inValue; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"LinearGradient",sizeof(wchar_t)*14) ) { LinearGradient=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"RadialGradient",sizeof(wchar_t)*14) ) { RadialGradient=inValue.Cast<int >();return inValue; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"RepeatingBitmap",sizeof(wchar_t)*15) ) { RepeatingBitmap=inValue.Cast<int >();return inValue; }
		break;
	case 19:
		if (!memcmp(inName.__s,L"FocalRadialGradient",sizeof(wchar_t)*19) ) { FocalRadialGradient=inValue.Cast<int >();return inValue; }
		break;
	case 24:
		if (!memcmp(inName.__s,L"NonSmoothedClippedBitmap",sizeof(wchar_t)*24) ) { NonSmoothedClippedBitmap=inValue.Cast<int >();return inValue; }
		break;
	case 26:
		if (!memcmp(inName.__s,L"NonSmoothedRepeatingBitmap",sizeof(wchar_t)*26) ) { NonSmoothedRepeatingBitmap=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void FillStyleTypeId_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"Solid",5),
	STRING(L"LinearGradient",14),
	STRING(L"RadialGradient",14),
	STRING(L"FocalRadialGradient",19),
	STRING(L"RepeatingBitmap",15),
	STRING(L"ClippedBitmap",13),
	STRING(L"NonSmoothedRepeatingBitmap",26),
	STRING(L"NonSmoothedClippedBitmap",24),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
	MarkMember(FillStyleTypeId_obj::Solid);
	MarkMember(FillStyleTypeId_obj::LinearGradient);
	MarkMember(FillStyleTypeId_obj::RadialGradient);
	MarkMember(FillStyleTypeId_obj::FocalRadialGradient);
	MarkMember(FillStyleTypeId_obj::RepeatingBitmap);
	MarkMember(FillStyleTypeId_obj::ClippedBitmap);
	MarkMember(FillStyleTypeId_obj::NonSmoothedRepeatingBitmap);
	MarkMember(FillStyleTypeId_obj::NonSmoothedClippedBitmap);
};

Class FillStyleTypeId_obj::__mClass;

void FillStyleTypeId_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.swf.FillStyleTypeId",26), TCanCast<FillStyleTypeId_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void FillStyleTypeId_obj::__boot()
{
	Static(Solid) = 0;
	Static(LinearGradient) = 16;
	Static(RadialGradient) = 18;
	Static(FocalRadialGradient) = 19;
	Static(RepeatingBitmap) = 64;
	Static(ClippedBitmap) = 65;
	Static(NonSmoothedRepeatingBitmap) = 66;
	Static(NonSmoothedClippedBitmap) = 67;
}

} // end namespace format
} // end namespace swf
