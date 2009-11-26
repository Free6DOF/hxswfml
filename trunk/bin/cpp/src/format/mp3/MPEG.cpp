#include <hxObject.h>

#ifndef INCLUDED_format_mp3_Bitrate
#include <format/mp3/Bitrate.h>
#endif
#ifndef INCLUDED_format_mp3_CLayer
#include <format/mp3/CLayer.h>
#endif
#ifndef INCLUDED_format_mp3_Layer
#include <format/mp3/Layer.h>
#endif
#ifndef INCLUDED_format_mp3_MPEG
#include <format/mp3/MPEG.h>
#endif
#ifndef INCLUDED_format_mp3_MPEGVersion
#include <format/mp3/MPEGVersion.h>
#endif
#ifndef INCLUDED_format_mp3_SamplingRate
#include <format/mp3/SamplingRate.h>
#endif
namespace format{
namespace mp3{

Void MPEG_obj::__construct()
{
	return null();
}

MPEG_obj::~MPEG_obj() { }

Dynamic MPEG_obj::__CreateEmpty() { return  new MPEG_obj; }
hxObjectPtr<MPEG_obj > MPEG_obj::__new()
{  hxObjectPtr<MPEG_obj > result = new MPEG_obj();
	result->__construct();
	return result;}

Dynamic MPEG_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<MPEG_obj > result = new MPEG_obj();
	result->__construct();
	return result;}

int MPEG_obj::V1;

int MPEG_obj::V2;

int MPEG_obj::V25;

int MPEG_obj::Reserved;

int MPEG_obj::enum2Num( format::mp3::MPEGVersion m){
	struct _Function_1{
		static int Block( format::mp3::MPEGVersion &m)/* DEF (not block)(ret intern) */{
			format::mp3::MPEGVersion _switch_1 = (m);
			switch((_switch_1)->GetIndex()){
				case 0: {
					return format::mp3::MPEG_obj::V1;
				}
				break;
				case 1: {
					return format::mp3::MPEG_obj::V2;
				}
				break;
				case 2: {
					return format::mp3::MPEG_obj::V25;
				}
				break;
				case 3: {
					return format::mp3::MPEG_obj::Reserved;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(m);
}


STATIC_DEFINE_DYNAMIC_FUNC1(MPEG_obj,enum2Num,return )

format::mp3::MPEGVersion MPEG_obj::num2Enum( int m){
	struct _Function_1{
		static format::mp3::MPEGVersion Block( int &m)/* DEF (not block)(ret intern) */{
			int _switch_2 = (m);
			if (  ( _switch_2==format::mp3::MPEG_obj::V1)){
				return format::mp3::MPEGVersion_obj::MPEG_V1;
			}
			else if (  ( _switch_2==format::mp3::MPEG_obj::V2)){
				return format::mp3::MPEGVersion_obj::MPEG_V2;
			}
			else if (  ( _switch_2==format::mp3::MPEG_obj::V25)){
				return format::mp3::MPEGVersion_obj::MPEG_V25;
			}
			else  {
				return format::mp3::MPEGVersion_obj::MPEG_Reserved;
			}
;
;
		}
	};
	return _Function_1::Block(m);
}


STATIC_DEFINE_DYNAMIC_FUNC1(MPEG_obj,num2Enum,return )

Array<Array<format::mp3::Bitrate > > MPEG_obj::V1_Bitrates;

Array<Array<format::mp3::Bitrate > > MPEG_obj::V2_Bitrates;

Array<Array<format::mp3::SamplingRate > > MPEG_obj::SamplingRates;

format::mp3::SamplingRate MPEG_obj::srNum2Enum( int sr){
	struct _Function_1{
		static format::mp3::SamplingRate Block( int &sr)/* DEF (not block)(ret intern) */{
			switch( (int)(sr)){
				case 8000: {
					return format::mp3::SamplingRate_obj::SR_8000;
				}
				break;
				case 11025: {
					return format::mp3::SamplingRate_obj::SR_11025;
				}
				break;
				case 12000: {
					return format::mp3::SamplingRate_obj::SR_12000;
				}
				break;
				case 22050: {
					return format::mp3::SamplingRate_obj::SR_22050;
				}
				break;
				case 24000: {
					return format::mp3::SamplingRate_obj::SR_24000;
				}
				break;
				case 32000: {
					return format::mp3::SamplingRate_obj::SR_32000;
				}
				break;
				case 44100: {
					return format::mp3::SamplingRate_obj::SR_44100;
				}
				break;
				case 48000: {
					return format::mp3::SamplingRate_obj::SR_48000;
				}
				break;
				default: {
					return format::mp3::SamplingRate_obj::SR_Bad;
				}
			}
		}
	};
	return _Function_1::Block(sr);
}


STATIC_DEFINE_DYNAMIC_FUNC1(MPEG_obj,srNum2Enum,return )

int MPEG_obj::srEnum2Num( format::mp3::SamplingRate sr){
	struct _Function_1{
		static int Block( format::mp3::SamplingRate &sr)/* DEF (not block)(ret intern) */{
			format::mp3::SamplingRate _switch_3 = (sr);
			switch((_switch_3)->GetIndex()){
				case 0: {
					return 8000;
				}
				break;
				case 1: {
					return 11025;
				}
				break;
				case 2: {
					return 12000;
				}
				break;
				case 3: {
					return 22050;
				}
				break;
				case 4: {
					return 24000;
				}
				break;
				case 5: {
					return 32000;
				}
				break;
				case 6: {
					return 44100;
				}
				break;
				case 7: {
					return 48000;
				}
				break;
				case 8: {
					return -1;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(sr);
}


STATIC_DEFINE_DYNAMIC_FUNC1(MPEG_obj,srEnum2Num,return )

int MPEG_obj::getBitrateIdx( format::mp3::Bitrate br,format::mp3::MPEGVersion mpeg,format::mp3::Layer layer){
	Array<format::mp3::Bitrate > arr = ((mpeg == format::mp3::MPEGVersion_obj::MPEG_V1) ? Array<Array<format::mp3::Bitrate > >( format::mp3::MPEG_obj::V1_Bitrates ) : Array<Array<format::mp3::Bitrate > >( format::mp3::MPEG_obj::V2_Bitrates ))->__get(format::mp3::CLayer_obj::enum2Num(layer));
	{
		int _g = 0;
		while(_g < 16){
			int i = _g++;
			if (arr->__get(i) == br)
				return i;
		}
	}
	hxThrow (STRING(L"Bitrate index not found",23));
}


STATIC_DEFINE_DYNAMIC_FUNC3(MPEG_obj,getBitrateIdx,return )

int MPEG_obj::getSamplingRateIdx( format::mp3::SamplingRate sr,format::mp3::MPEGVersion mpeg){
	Array<format::mp3::SamplingRate > arr = format::mp3::MPEG_obj::SamplingRates->__get(format::mp3::MPEG_obj::enum2Num(mpeg));
	{
		int _g = 0;
		while(_g < 4){
			int i = _g++;
			if (arr->__get(i) == sr)
				return i;
		}
	}
	hxThrow (STRING(L"Sampling rate index not found",29));
}


STATIC_DEFINE_DYNAMIC_FUNC2(MPEG_obj,getSamplingRateIdx,return )

int MPEG_obj::bitrateEnum2Num( format::mp3::Bitrate br){
	struct _Function_1{
		static int Block( format::mp3::Bitrate &br)/* DEF (not block)(ret intern) */{
			format::mp3::Bitrate _switch_4 = (br);
			switch((_switch_4)->GetIndex()){
				case 25: {
					return -1;
				}
				break;
				case 24: {
					return 0;
				}
				break;
				case 0: {
					return 8;
				}
				break;
				case 1: {
					return 16;
				}
				break;
				case 2: {
					return 24;
				}
				break;
				case 3: {
					return 32;
				}
				break;
				case 4: {
					return 40;
				}
				break;
				case 5: {
					return 48;
				}
				break;
				case 6: {
					return 56;
				}
				break;
				case 7: {
					return 64;
				}
				break;
				case 8: {
					return 80;
				}
				break;
				case 9: {
					return 96;
				}
				break;
				case 10: {
					return 112;
				}
				break;
				case 11: {
					return 128;
				}
				break;
				case 12: {
					return 144;
				}
				break;
				case 13: {
					return 160;
				}
				break;
				case 14: {
					return 176;
				}
				break;
				case 15: {
					return 192;
				}
				break;
				case 16: {
					return 224;
				}
				break;
				case 17: {
					return 256;
				}
				break;
				case 18: {
					return 288;
				}
				break;
				case 19: {
					return 320;
				}
				break;
				case 20: {
					return 352;
				}
				break;
				case 21: {
					return 384;
				}
				break;
				case 22: {
					return 416;
				}
				break;
				case 23: {
					return 448;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(br);
}


STATIC_DEFINE_DYNAMIC_FUNC1(MPEG_obj,bitrateEnum2Num,return )

format::mp3::Bitrate MPEG_obj::bitrateNum2Enum( int br){
	struct _Function_1{
		static format::mp3::Bitrate Block( int &br)/* DEF (not block)(ret intern) */{
			switch( (int)(br)){
				case 0: {
					return format::mp3::Bitrate_obj::BR_Free;
				}
				break;
				case 8: {
					return format::mp3::Bitrate_obj::BR_8;
				}
				break;
				case 16: {
					return format::mp3::Bitrate_obj::BR_16;
				}
				break;
				case 24: {
					return format::mp3::Bitrate_obj::BR_24;
				}
				break;
				case 32: {
					return format::mp3::Bitrate_obj::BR_32;
				}
				break;
				case 40: {
					return format::mp3::Bitrate_obj::BR_40;
				}
				break;
				case 48: {
					return format::mp3::Bitrate_obj::BR_48;
				}
				break;
				case 56: {
					return format::mp3::Bitrate_obj::BR_56;
				}
				break;
				case 64: {
					return format::mp3::Bitrate_obj::BR_64;
				}
				break;
				case 80: {
					return format::mp3::Bitrate_obj::BR_80;
				}
				break;
				case 96: {
					return format::mp3::Bitrate_obj::BR_96;
				}
				break;
				case 112: {
					return format::mp3::Bitrate_obj::BR_112;
				}
				break;
				case 128: {
					return format::mp3::Bitrate_obj::BR_128;
				}
				break;
				case 144: {
					return format::mp3::Bitrate_obj::BR_144;
				}
				break;
				case 160: {
					return format::mp3::Bitrate_obj::BR_160;
				}
				break;
				case 176: {
					return format::mp3::Bitrate_obj::BR_176;
				}
				break;
				case 192: {
					return format::mp3::Bitrate_obj::BR_192;
				}
				break;
				case 224: {
					return format::mp3::Bitrate_obj::BR_224;
				}
				break;
				case 256: {
					return format::mp3::Bitrate_obj::BR_256;
				}
				break;
				case 288: {
					return format::mp3::Bitrate_obj::BR_288;
				}
				break;
				case 320: {
					return format::mp3::Bitrate_obj::BR_320;
				}
				break;
				case 352: {
					return format::mp3::Bitrate_obj::BR_352;
				}
				break;
				case 384: {
					return format::mp3::Bitrate_obj::BR_384;
				}
				break;
				case 416: {
					return format::mp3::Bitrate_obj::BR_416;
				}
				break;
				case 448: {
					return format::mp3::Bitrate_obj::BR_448;
				}
				break;
				default: {
					return format::mp3::Bitrate_obj::BR_Bad;
				}
			}
		}
	};
	return _Function_1::Block(br);
}


STATIC_DEFINE_DYNAMIC_FUNC1(MPEG_obj,bitrateNum2Enum,return )


MPEG_obj::MPEG_obj()
{
}

void MPEG_obj::__Mark()
{
}

Dynamic MPEG_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 2:
		if (!memcmp(inName.__s,L"V1",sizeof(wchar_t)*2) ) { return V1; }
		if (!memcmp(inName.__s,L"V2",sizeof(wchar_t)*2) ) { return V2; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"V25",sizeof(wchar_t)*3) ) { return V25; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"Reserved",sizeof(wchar_t)*8) ) { return Reserved; }
		if (!memcmp(inName.__s,L"enum2Num",sizeof(wchar_t)*8) ) { return enum2Num_dyn(); }
		if (!memcmp(inName.__s,L"num2Enum",sizeof(wchar_t)*8) ) { return num2Enum_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"srNum2Enum",sizeof(wchar_t)*10) ) { return srNum2Enum_dyn(); }
		if (!memcmp(inName.__s,L"srEnum2Num",sizeof(wchar_t)*10) ) { return srEnum2Num_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"V1_Bitrates",sizeof(wchar_t)*11) ) { return V1_Bitrates; }
		if (!memcmp(inName.__s,L"V2_Bitrates",sizeof(wchar_t)*11) ) { return V2_Bitrates; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"SamplingRates",sizeof(wchar_t)*13) ) { return SamplingRates; }
		if (!memcmp(inName.__s,L"getBitrateIdx",sizeof(wchar_t)*13) ) { return getBitrateIdx_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"bitrateEnum2Num",sizeof(wchar_t)*15) ) { return bitrateEnum2Num_dyn(); }
		if (!memcmp(inName.__s,L"bitrateNum2Enum",sizeof(wchar_t)*15) ) { return bitrateNum2Enum_dyn(); }
		break;
	case 18:
		if (!memcmp(inName.__s,L"getSamplingRateIdx",sizeof(wchar_t)*18) ) { return getSamplingRateIdx_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_V1 = __hxcpp_field_to_id("V1");
static int __id_V2 = __hxcpp_field_to_id("V2");
static int __id_V25 = __hxcpp_field_to_id("V25");
static int __id_Reserved = __hxcpp_field_to_id("Reserved");
static int __id_enum2Num = __hxcpp_field_to_id("enum2Num");
static int __id_num2Enum = __hxcpp_field_to_id("num2Enum");
static int __id_V1_Bitrates = __hxcpp_field_to_id("V1_Bitrates");
static int __id_V2_Bitrates = __hxcpp_field_to_id("V2_Bitrates");
static int __id_SamplingRates = __hxcpp_field_to_id("SamplingRates");
static int __id_srNum2Enum = __hxcpp_field_to_id("srNum2Enum");
static int __id_srEnum2Num = __hxcpp_field_to_id("srEnum2Num");
static int __id_getBitrateIdx = __hxcpp_field_to_id("getBitrateIdx");
static int __id_getSamplingRateIdx = __hxcpp_field_to_id("getSamplingRateIdx");
static int __id_bitrateEnum2Num = __hxcpp_field_to_id("bitrateEnum2Num");
static int __id_bitrateNum2Enum = __hxcpp_field_to_id("bitrateNum2Enum");


Dynamic MPEG_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_V1) return V1;
	if (inFieldID==__id_V2) return V2;
	if (inFieldID==__id_V25) return V25;
	if (inFieldID==__id_Reserved) return Reserved;
	if (inFieldID==__id_enum2Num) return enum2Num_dyn();
	if (inFieldID==__id_num2Enum) return num2Enum_dyn();
	if (inFieldID==__id_V1_Bitrates) return V1_Bitrates;
	if (inFieldID==__id_V2_Bitrates) return V2_Bitrates;
	if (inFieldID==__id_SamplingRates) return SamplingRates;
	if (inFieldID==__id_srNum2Enum) return srNum2Enum_dyn();
	if (inFieldID==__id_srEnum2Num) return srEnum2Num_dyn();
	if (inFieldID==__id_getBitrateIdx) return getBitrateIdx_dyn();
	if (inFieldID==__id_getSamplingRateIdx) return getSamplingRateIdx_dyn();
	if (inFieldID==__id_bitrateEnum2Num) return bitrateEnum2Num_dyn();
	if (inFieldID==__id_bitrateNum2Enum) return bitrateNum2Enum_dyn();
	return super::__IField(inFieldID);
}

Dynamic MPEG_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 2:
		if (!memcmp(inName.__s,L"V1",sizeof(wchar_t)*2) ) { V1=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"V2",sizeof(wchar_t)*2) ) { V2=inValue.Cast<int >();return inValue; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"V25",sizeof(wchar_t)*3) ) { V25=inValue.Cast<int >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"Reserved",sizeof(wchar_t)*8) ) { Reserved=inValue.Cast<int >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"V1_Bitrates",sizeof(wchar_t)*11) ) { V1_Bitrates=inValue.Cast<Array<Array<format::mp3::Bitrate > > >();return inValue; }
		if (!memcmp(inName.__s,L"V2_Bitrates",sizeof(wchar_t)*11) ) { V2_Bitrates=inValue.Cast<Array<Array<format::mp3::Bitrate > > >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"SamplingRates",sizeof(wchar_t)*13) ) { SamplingRates=inValue.Cast<Array<Array<format::mp3::SamplingRate > > >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void MPEG_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"V1",2),
	STRING(L"V2",2),
	STRING(L"V25",3),
	STRING(L"Reserved",8),
	STRING(L"enum2Num",8),
	STRING(L"num2Enum",8),
	STRING(L"V1_Bitrates",11),
	STRING(L"V2_Bitrates",11),
	STRING(L"SamplingRates",13),
	STRING(L"srNum2Enum",10),
	STRING(L"srEnum2Num",10),
	STRING(L"getBitrateIdx",13),
	STRING(L"getSamplingRateIdx",18),
	STRING(L"bitrateEnum2Num",15),
	STRING(L"bitrateNum2Enum",15),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
	MarkMember(MPEG_obj::V1);
	MarkMember(MPEG_obj::V2);
	MarkMember(MPEG_obj::V25);
	MarkMember(MPEG_obj::Reserved);
	MarkMember(MPEG_obj::V1_Bitrates);
	MarkMember(MPEG_obj::V2_Bitrates);
	MarkMember(MPEG_obj::SamplingRates);
};

Class MPEG_obj::__mClass;

void MPEG_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.mp3.MPEG",15), TCanCast<MPEG_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void MPEG_obj::__boot()
{
	Static(V1) = 3;
	Static(V2) = 2;
	Static(V25) = 0;
	Static(Reserved) = 1;
	Static(V1_Bitrates) = Array_obj<Array<format::mp3::Bitrate > >::__new().Add(Array_obj<format::mp3::Bitrate >::__new().Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad)).Add(Array_obj<format::mp3::Bitrate >::__new().Add(format::mp3::Bitrate_obj::BR_Free).Add(format::mp3::Bitrate_obj::BR_32).Add(format::mp3::Bitrate_obj::BR_40).Add(format::mp3::Bitrate_obj::BR_48).Add(format::mp3::Bitrate_obj::BR_56).Add(format::mp3::Bitrate_obj::BR_64).Add(format::mp3::Bitrate_obj::BR_80).Add(format::mp3::Bitrate_obj::BR_96).Add(format::mp3::Bitrate_obj::BR_112).Add(format::mp3::Bitrate_obj::BR_128).Add(format::mp3::Bitrate_obj::BR_160).Add(format::mp3::Bitrate_obj::BR_192).Add(format::mp3::Bitrate_obj::BR_224).Add(format::mp3::Bitrate_obj::BR_256).Add(format::mp3::Bitrate_obj::BR_320).Add(format::mp3::Bitrate_obj::BR_Bad)).Add(Array_obj<format::mp3::Bitrate >::__new().Add(format::mp3::Bitrate_obj::BR_Free).Add(format::mp3::Bitrate_obj::BR_32).Add(format::mp3::Bitrate_obj::BR_48).Add(format::mp3::Bitrate_obj::BR_56).Add(format::mp3::Bitrate_obj::BR_64).Add(format::mp3::Bitrate_obj::BR_80).Add(format::mp3::Bitrate_obj::BR_96).Add(format::mp3::Bitrate_obj::BR_112).Add(format::mp3::Bitrate_obj::BR_128).Add(format::mp3::Bitrate_obj::BR_160).Add(format::mp3::Bitrate_obj::BR_192).Add(format::mp3::Bitrate_obj::BR_224).Add(format::mp3::Bitrate_obj::BR_256).Add(format::mp3::Bitrate_obj::BR_320).Add(format::mp3::Bitrate_obj::BR_384).Add(format::mp3::Bitrate_obj::BR_Bad)).Add(Array_obj<format::mp3::Bitrate >::__new().Add(format::mp3::Bitrate_obj::BR_Free).Add(format::mp3::Bitrate_obj::BR_32).Add(format::mp3::Bitrate_obj::BR_64).Add(format::mp3::Bitrate_obj::BR_96).Add(format::mp3::Bitrate_obj::BR_128).Add(format::mp3::Bitrate_obj::BR_160).Add(format::mp3::Bitrate_obj::BR_192).Add(format::mp3::Bitrate_obj::BR_224).Add(format::mp3::Bitrate_obj::BR_256).Add(format::mp3::Bitrate_obj::BR_288).Add(format::mp3::Bitrate_obj::BR_320).Add(format::mp3::Bitrate_obj::BR_352).Add(format::mp3::Bitrate_obj::BR_384).Add(format::mp3::Bitrate_obj::BR_416).Add(format::mp3::Bitrate_obj::BR_448).Add(format::mp3::Bitrate_obj::BR_Bad));
	Static(V2_Bitrates) = Array_obj<Array<format::mp3::Bitrate > >::__new().Add(Array_obj<format::mp3::Bitrate >::__new().Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad).Add(format::mp3::Bitrate_obj::BR_Bad)).Add(Array_obj<format::mp3::Bitrate >::__new().Add(format::mp3::Bitrate_obj::BR_Free).Add(format::mp3::Bitrate_obj::BR_8).Add(format::mp3::Bitrate_obj::BR_16).Add(format::mp3::Bitrate_obj::BR_24).Add(format::mp3::Bitrate_obj::BR_32).Add(format::mp3::Bitrate_obj::BR_40).Add(format::mp3::Bitrate_obj::BR_48).Add(format::mp3::Bitrate_obj::BR_56).Add(format::mp3::Bitrate_obj::BR_64).Add(format::mp3::Bitrate_obj::BR_80).Add(format::mp3::Bitrate_obj::BR_96).Add(format::mp3::Bitrate_obj::BR_112).Add(format::mp3::Bitrate_obj::BR_128).Add(format::mp3::Bitrate_obj::BR_144).Add(format::mp3::Bitrate_obj::BR_160).Add(format::mp3::Bitrate_obj::BR_Bad)).Add(Array_obj<format::mp3::Bitrate >::__new().Add(format::mp3::Bitrate_obj::BR_Free).Add(format::mp3::Bitrate_obj::BR_8).Add(format::mp3::Bitrate_obj::BR_16).Add(format::mp3::Bitrate_obj::BR_24).Add(format::mp3::Bitrate_obj::BR_32).Add(format::mp3::Bitrate_obj::BR_40).Add(format::mp3::Bitrate_obj::BR_48).Add(format::mp3::Bitrate_obj::BR_56).Add(format::mp3::Bitrate_obj::BR_64).Add(format::mp3::Bitrate_obj::BR_80).Add(format::mp3::Bitrate_obj::BR_96).Add(format::mp3::Bitrate_obj::BR_112).Add(format::mp3::Bitrate_obj::BR_128).Add(format::mp3::Bitrate_obj::BR_144).Add(format::mp3::Bitrate_obj::BR_160).Add(format::mp3::Bitrate_obj::BR_Bad)).Add(Array_obj<format::mp3::Bitrate >::__new().Add(format::mp3::Bitrate_obj::BR_Free).Add(format::mp3::Bitrate_obj::BR_32).Add(format::mp3::Bitrate_obj::BR_48).Add(format::mp3::Bitrate_obj::BR_56).Add(format::mp3::Bitrate_obj::BR_64).Add(format::mp3::Bitrate_obj::BR_80).Add(format::mp3::Bitrate_obj::BR_96).Add(format::mp3::Bitrate_obj::BR_112).Add(format::mp3::Bitrate_obj::BR_128).Add(format::mp3::Bitrate_obj::BR_144).Add(format::mp3::Bitrate_obj::BR_160).Add(format::mp3::Bitrate_obj::BR_176).Add(format::mp3::Bitrate_obj::BR_192).Add(format::mp3::Bitrate_obj::BR_224).Add(format::mp3::Bitrate_obj::BR_256).Add(format::mp3::Bitrate_obj::BR_Bad));
	Static(SamplingRates) = Array_obj<Array<format::mp3::SamplingRate > >::__new().Add(Array_obj<format::mp3::SamplingRate >::__new().Add(format::mp3::SamplingRate_obj::SR_11025).Add(format::mp3::SamplingRate_obj::SR_12000).Add(format::mp3::SamplingRate_obj::SR_8000).Add(format::mp3::SamplingRate_obj::SR_Bad)).Add(Array_obj<format::mp3::SamplingRate >::__new().Add(format::mp3::SamplingRate_obj::SR_Bad).Add(format::mp3::SamplingRate_obj::SR_Bad).Add(format::mp3::SamplingRate_obj::SR_Bad).Add(format::mp3::SamplingRate_obj::SR_Bad)).Add(Array_obj<format::mp3::SamplingRate >::__new().Add(format::mp3::SamplingRate_obj::SR_22050).Add(format::mp3::SamplingRate_obj::SR_24000).Add(format::mp3::SamplingRate_obj::SR_12000).Add(format::mp3::SamplingRate_obj::SR_Bad)).Add(Array_obj<format::mp3::SamplingRate >::__new().Add(format::mp3::SamplingRate_obj::SR_44100).Add(format::mp3::SamplingRate_obj::SR_48000).Add(format::mp3::SamplingRate_obj::SR_32000).Add(format::mp3::SamplingRate_obj::SR_Bad));
}

} // end namespace format
} // end namespace mp3
