#include <hxObject.h>

#ifndef INCLUDED_format_mp3_CChannelMode
#include <format/mp3/CChannelMode.h>
#endif
#ifndef INCLUDED_format_mp3_ChannelMode
#include <format/mp3/ChannelMode.h>
#endif
namespace format{
namespace mp3{

Void CChannelMode_obj::__construct()
{
	return null();
}

CChannelMode_obj::~CChannelMode_obj() { }

Dynamic CChannelMode_obj::__CreateEmpty() { return  new CChannelMode_obj; }
hxObjectPtr<CChannelMode_obj > CChannelMode_obj::__new()
{  hxObjectPtr<CChannelMode_obj > result = new CChannelMode_obj();
	result->__construct();
	return result;}

Dynamic CChannelMode_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<CChannelMode_obj > result = new CChannelMode_obj();
	result->__construct();
	return result;}

int CChannelMode_obj::CStereo;

int CChannelMode_obj::CJointStereo;

int CChannelMode_obj::CDualChannel;

int CChannelMode_obj::CMono;

int CChannelMode_obj::enum2Num( format::mp3::ChannelMode c){
	struct _Function_1{
		static int Block( format::mp3::ChannelMode &c)/* DEF (not block)(ret intern) */{
			format::mp3::ChannelMode _switch_1 = (c);
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
					return format::mp3::CChannelMode_obj::CDualChannel;
				}
				break;
				case 3: {
					return format::mp3::CChannelMode_obj::CMono;
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


STATIC_DEFINE_DYNAMIC_FUNC1(CChannelMode_obj,enum2Num,return )

format::mp3::ChannelMode CChannelMode_obj::num2Enum( int c){
	struct _Function_1{
		static format::mp3::ChannelMode Block( int &c)/* DEF (not block)(ret intern) */{
			int _switch_2 = (c);
			if (  ( _switch_2==0)){
				return format::mp3::ChannelMode_obj::Stereo;
			}
			else if (  ( _switch_2==1)){
				return format::mp3::ChannelMode_obj::JointStereo;
			}
			else if (  ( _switch_2==format::mp3::CChannelMode_obj::CDualChannel)){
				return format::mp3::ChannelMode_obj::DualChannel;
			}
			else if (  ( _switch_2==format::mp3::CChannelMode_obj::CMono)){
				return format::mp3::ChannelMode_obj::Mono;
			}
			else  {
				return null();
			}
;
;
		}
	};
	return _Function_1::Block(c);
}


STATIC_DEFINE_DYNAMIC_FUNC1(CChannelMode_obj,num2Enum,return )


CChannelMode_obj::CChannelMode_obj()
{
}

void CChannelMode_obj::__Mark()
{
}

Dynamic CChannelMode_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"CMono",sizeof(wchar_t)*5) ) { return CMono; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"CStereo",sizeof(wchar_t)*7) ) { return CStereo; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"enum2Num",sizeof(wchar_t)*8) ) { return enum2Num_dyn(); }
		if (!memcmp(inName.__s,L"num2Enum",sizeof(wchar_t)*8) ) { return num2Enum_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"CJointStereo",sizeof(wchar_t)*12) ) { return CJointStereo; }
		if (!memcmp(inName.__s,L"CDualChannel",sizeof(wchar_t)*12) ) { return CDualChannel; }
	}
	return super::__Field(inName);
}

static int __id_CStereo = __hxcpp_field_to_id("CStereo");
static int __id_CJointStereo = __hxcpp_field_to_id("CJointStereo");
static int __id_CDualChannel = __hxcpp_field_to_id("CDualChannel");
static int __id_CMono = __hxcpp_field_to_id("CMono");
static int __id_enum2Num = __hxcpp_field_to_id("enum2Num");
static int __id_num2Enum = __hxcpp_field_to_id("num2Enum");


Dynamic CChannelMode_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_CStereo) return CStereo;
	if (inFieldID==__id_CJointStereo) return CJointStereo;
	if (inFieldID==__id_CDualChannel) return CDualChannel;
	if (inFieldID==__id_CMono) return CMono;
	if (inFieldID==__id_enum2Num) return enum2Num_dyn();
	if (inFieldID==__id_num2Enum) return num2Enum_dyn();
	return super::__IField(inFieldID);
}

Dynamic CChannelMode_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"CMono",sizeof(wchar_t)*5) ) { CMono=inValue.Cast<int >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"CStereo",sizeof(wchar_t)*7) ) { CStereo=inValue.Cast<int >();return inValue; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"CJointStereo",sizeof(wchar_t)*12) ) { CJointStereo=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"CDualChannel",sizeof(wchar_t)*12) ) { CDualChannel=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void CChannelMode_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"CStereo",7),
	STRING(L"CJointStereo",12),
	STRING(L"CDualChannel",12),
	STRING(L"CMono",5),
	STRING(L"enum2Num",8),
	STRING(L"num2Enum",8),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
	MarkMember(CChannelMode_obj::CStereo);
	MarkMember(CChannelMode_obj::CJointStereo);
	MarkMember(CChannelMode_obj::CDualChannel);
	MarkMember(CChannelMode_obj::CMono);
};

Class CChannelMode_obj::__mClass;

void CChannelMode_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.mp3.CChannelMode",23), TCanCast<CChannelMode_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void CChannelMode_obj::__boot()
{
	Static(CStereo) = 0;
	Static(CJointStereo) = 1;
	Static(CDualChannel) = 2;
	Static(CMono) = 3;
}

} // end namespace format
} // end namespace mp3
