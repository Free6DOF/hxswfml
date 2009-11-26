#include <hxObject.h>

#ifndef INCLUDED_format_mp3_CLayer
#include <format/mp3/CLayer.h>
#endif
#ifndef INCLUDED_format_mp3_Layer
#include <format/mp3/Layer.h>
#endif
namespace format{
namespace mp3{

Void CLayer_obj::__construct()
{
	return null();
}

CLayer_obj::~CLayer_obj() { }

Dynamic CLayer_obj::__CreateEmpty() { return  new CLayer_obj; }
hxObjectPtr<CLayer_obj > CLayer_obj::__new()
{  hxObjectPtr<CLayer_obj > result = new CLayer_obj();
	result->__construct();
	return result;}

Dynamic CLayer_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<CLayer_obj > result = new CLayer_obj();
	result->__construct();
	return result;}

int CLayer_obj::LReserved;

int CLayer_obj::LLayer3;

int CLayer_obj::LLayer2;

int CLayer_obj::LLayer1;

int CLayer_obj::enum2Num( format::mp3::Layer l){
	struct _Function_1{
		static int Block( format::mp3::Layer &l)/* DEF (not block)(ret intern) */{
			format::mp3::Layer _switch_1 = (l);
			switch((_switch_1)->GetIndex()){
				case 1: {
					return format::mp3::CLayer_obj::LLayer3;
				}
				break;
				case 2: {
					return format::mp3::CLayer_obj::LLayer2;
				}
				break;
				case 3: {
					return format::mp3::CLayer_obj::LLayer1;
				}
				break;
				case 0: {
					return format::mp3::CLayer_obj::LReserved;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(l);
}


STATIC_DEFINE_DYNAMIC_FUNC1(CLayer_obj,enum2Num,return )

format::mp3::Layer CLayer_obj::num2Enum( int l){
	struct _Function_1{
		static format::mp3::Layer Block( int &l)/* DEF (not block)(ret intern) */{
			int _switch_2 = (l);
			if (  ( _switch_2==format::mp3::CLayer_obj::LLayer3)){
				return format::mp3::Layer_obj::Layer3;
			}
			else if (  ( _switch_2==format::mp3::CLayer_obj::LLayer2)){
				return format::mp3::Layer_obj::Layer2;
			}
			else if (  ( _switch_2==format::mp3::CLayer_obj::LLayer1)){
				return format::mp3::Layer_obj::Layer1;
			}
			else  {
				return format::mp3::Layer_obj::LayerReserved;
			}
;
;
		}
	};
	return _Function_1::Block(l);
}


STATIC_DEFINE_DYNAMIC_FUNC1(CLayer_obj,num2Enum,return )


CLayer_obj::CLayer_obj()
{
}

void CLayer_obj::__Mark()
{
}

Dynamic CLayer_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 7:
		if (!memcmp(inName.__s,L"LLayer3",sizeof(wchar_t)*7) ) { return LLayer3; }
		if (!memcmp(inName.__s,L"LLayer2",sizeof(wchar_t)*7) ) { return LLayer2; }
		if (!memcmp(inName.__s,L"LLayer1",sizeof(wchar_t)*7) ) { return LLayer1; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"enum2Num",sizeof(wchar_t)*8) ) { return enum2Num_dyn(); }
		if (!memcmp(inName.__s,L"num2Enum",sizeof(wchar_t)*8) ) { return num2Enum_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"LReserved",sizeof(wchar_t)*9) ) { return LReserved; }
	}
	return super::__Field(inName);
}

static int __id_LReserved = __hxcpp_field_to_id("LReserved");
static int __id_LLayer3 = __hxcpp_field_to_id("LLayer3");
static int __id_LLayer2 = __hxcpp_field_to_id("LLayer2");
static int __id_LLayer1 = __hxcpp_field_to_id("LLayer1");
static int __id_enum2Num = __hxcpp_field_to_id("enum2Num");
static int __id_num2Enum = __hxcpp_field_to_id("num2Enum");


Dynamic CLayer_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_LReserved) return LReserved;
	if (inFieldID==__id_LLayer3) return LLayer3;
	if (inFieldID==__id_LLayer2) return LLayer2;
	if (inFieldID==__id_LLayer1) return LLayer1;
	if (inFieldID==__id_enum2Num) return enum2Num_dyn();
	if (inFieldID==__id_num2Enum) return num2Enum_dyn();
	return super::__IField(inFieldID);
}

Dynamic CLayer_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 7:
		if (!memcmp(inName.__s,L"LLayer3",sizeof(wchar_t)*7) ) { LLayer3=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"LLayer2",sizeof(wchar_t)*7) ) { LLayer2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"LLayer1",sizeof(wchar_t)*7) ) { LLayer1=inValue.Cast<int >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"LReserved",sizeof(wchar_t)*9) ) { LReserved=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void CLayer_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"LReserved",9),
	STRING(L"LLayer3",7),
	STRING(L"LLayer2",7),
	STRING(L"LLayer1",7),
	STRING(L"enum2Num",8),
	STRING(L"num2Enum",8),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
	MarkMember(CLayer_obj::LReserved);
	MarkMember(CLayer_obj::LLayer3);
	MarkMember(CLayer_obj::LLayer2);
	MarkMember(CLayer_obj::LLayer1);
};

Class CLayer_obj::__mClass;

void CLayer_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.mp3.CLayer",17), TCanCast<CLayer_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void CLayer_obj::__boot()
{
	Static(LReserved) = 0;
	Static(LLayer3) = 1;
	Static(LLayer2) = 2;
	Static(LLayer1) = 3;
}

} // end namespace format
} // end namespace mp3
