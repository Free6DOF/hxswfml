#include <hxObject.h>

#ifndef INCLUDED_format_mp3_CEmphasis
#include <format/mp3/CEmphasis.h>
#endif
#ifndef INCLUDED_format_mp3_Emphasis
#include <format/mp3/Emphasis.h>
#endif
namespace format{
namespace mp3{

Void CEmphasis_obj::__construct()
{
	return null();
}

CEmphasis_obj::~CEmphasis_obj() { }

Dynamic CEmphasis_obj::__CreateEmpty() { return  new CEmphasis_obj; }
hxObjectPtr<CEmphasis_obj > CEmphasis_obj::__new()
{  hxObjectPtr<CEmphasis_obj > result = new CEmphasis_obj();
	result->__construct();
	return result;}

Dynamic CEmphasis_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<CEmphasis_obj > result = new CEmphasis_obj();
	result->__construct();
	return result;}

int CEmphasis_obj::ENone;

int CEmphasis_obj::EMs50_15;

int CEmphasis_obj::EReserved;

int CEmphasis_obj::ECCIT_J17;

int CEmphasis_obj::enum2Num( format::mp3::Emphasis c){
	struct _Function_1{
		static int Block( format::mp3::Emphasis &c)/* DEF (not block)(ret intern) */{
			format::mp3::Emphasis _switch_1 = (c);
			switch((_switch_1)->GetIndex()){
				case 0: {
					return 0;
				}
				break;
				case 1: {
					return 1;
				}
				break;
				case 2: {
					return 3;
				}
				break;
				case 3: {
					return 2;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(c);
}


STATIC_DEFINE_DYNAMIC_FUNC1(CEmphasis_obj,enum2Num,return )

format::mp3::Emphasis CEmphasis_obj::num2Enum( int c){
	struct _Function_1{
		static format::mp3::Emphasis Block( int &c)/* DEF (not block)(ret intern) */{
			switch( (int)(c)){
				case 0: {
					return format::mp3::Emphasis_obj::NoEmphasis;
				}
				break;
				case 1: {
					return format::mp3::Emphasis_obj::Ms50_15;
				}
				break;
				case 3: {
					return format::mp3::Emphasis_obj::CCIT_J17;
				}
				break;
				case 2: {
					return format::mp3::Emphasis_obj::InvalidEmphasis;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(c);
}


STATIC_DEFINE_DYNAMIC_FUNC1(CEmphasis_obj,num2Enum,return )


CEmphasis_obj::CEmphasis_obj()
{
}

void CEmphasis_obj::__Mark()
{
}

Dynamic CEmphasis_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"ENone",sizeof(wchar_t)*5) ) { return ENone; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"EMs50_15",sizeof(wchar_t)*8) ) { return EMs50_15; }
		if (!memcmp(inName.__s,L"enum2Num",sizeof(wchar_t)*8) ) { return enum2Num_dyn(); }
		if (!memcmp(inName.__s,L"num2Enum",sizeof(wchar_t)*8) ) { return num2Enum_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"EReserved",sizeof(wchar_t)*9) ) { return EReserved; }
		if (!memcmp(inName.__s,L"ECCIT_J17",sizeof(wchar_t)*9) ) { return ECCIT_J17; }
	}
	return super::__Field(inName);
}

static int __id_ENone = __hxcpp_field_to_id("ENone");
static int __id_EMs50_15 = __hxcpp_field_to_id("EMs50_15");
static int __id_EReserved = __hxcpp_field_to_id("EReserved");
static int __id_ECCIT_J17 = __hxcpp_field_to_id("ECCIT_J17");
static int __id_enum2Num = __hxcpp_field_to_id("enum2Num");
static int __id_num2Enum = __hxcpp_field_to_id("num2Enum");


Dynamic CEmphasis_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_ENone) return ENone;
	if (inFieldID==__id_EMs50_15) return EMs50_15;
	if (inFieldID==__id_EReserved) return EReserved;
	if (inFieldID==__id_ECCIT_J17) return ECCIT_J17;
	if (inFieldID==__id_enum2Num) return enum2Num_dyn();
	if (inFieldID==__id_num2Enum) return num2Enum_dyn();
	return super::__IField(inFieldID);
}

Dynamic CEmphasis_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"ENone",sizeof(wchar_t)*5) ) { ENone=inValue.Cast<int >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"EMs50_15",sizeof(wchar_t)*8) ) { EMs50_15=inValue.Cast<int >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"EReserved",sizeof(wchar_t)*9) ) { EReserved=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"ECCIT_J17",sizeof(wchar_t)*9) ) { ECCIT_J17=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void CEmphasis_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"ENone",5),
	STRING(L"EMs50_15",8),
	STRING(L"EReserved",9),
	STRING(L"ECCIT_J17",9),
	STRING(L"enum2Num",8),
	STRING(L"num2Enum",8),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
	MarkMember(CEmphasis_obj::ENone);
	MarkMember(CEmphasis_obj::EMs50_15);
	MarkMember(CEmphasis_obj::EReserved);
	MarkMember(CEmphasis_obj::ECCIT_J17);
};

Class CEmphasis_obj::__mClass;

void CEmphasis_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.mp3.CEmphasis",20), TCanCast<CEmphasis_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void CEmphasis_obj::__boot()
{
	Static(ENone) = 0;
	Static(EMs50_15) = 1;
	Static(EReserved) = 2;
	Static(ECCIT_J17) = 3;
}

} // end namespace format
} // end namespace mp3
