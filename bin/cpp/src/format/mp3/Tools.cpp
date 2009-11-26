#include <hxObject.h>

#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_format_mp3_Bitrate
#include <format/mp3/Bitrate.h>
#endif
#ifndef INCLUDED_format_mp3_CLayer
#include <format/mp3/CLayer.h>
#endif
#ifndef INCLUDED_format_mp3_ChannelMode
#include <format/mp3/ChannelMode.h>
#endif
#ifndef INCLUDED_format_mp3_Emphasis
#include <format/mp3/Emphasis.h>
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
#ifndef INCLUDED_format_mp3_Tools
#include <format/mp3/Tools.h>
#endif
namespace format{
namespace mp3{

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

format::mp3::Bitrate Tools_obj::getBitrate( int mpegVersion,int layerIdx,int bitrateIdx){
	if (bool(mpegVersion == format::mp3::MPEG_obj::Reserved) || bool(layerIdx == format::mp3::CLayer_obj::LReserved))
		return format::mp3::Bitrate_obj::BR_Bad;
	return (mpegVersion == format::mp3::MPEG_obj::V1 ? Array<Array<format::mp3::Bitrate > >( format::mp3::MPEG_obj::V1_Bitrates ) : Array<Array<format::mp3::Bitrate > >( format::mp3::MPEG_obj::V2_Bitrates ))->__get(layerIdx)->__get(bitrateIdx);
}


STATIC_DEFINE_DYNAMIC_FUNC3(Tools_obj,getBitrate,return )

format::mp3::SamplingRate Tools_obj::getSamplingRate( int mpegVersion,int samplingRateIdx){
	return format::mp3::MPEG_obj::SamplingRates->__get(mpegVersion)->__get(samplingRateIdx);
}


STATIC_DEFINE_DYNAMIC_FUNC2(Tools_obj,getSamplingRate,return )

bool Tools_obj::isInvalidFrameHeader( Dynamic hdr){
	return bool(hdr->__Field(STRING(L"version",7)).Cast<format::mp3::MPEGVersion >() == format::mp3::MPEGVersion_obj::MPEG_Reserved) || bool(bool(hdr->__Field(STRING(L"layer",5)).Cast<format::mp3::Layer >() == format::mp3::Layer_obj::LayerReserved) || bool(bool(hdr->__Field(STRING(L"bitrate",7)).Cast<format::mp3::Bitrate >() == format::mp3::Bitrate_obj::BR_Bad) || bool(bool(hdr->__Field(STRING(L"bitrate",7)).Cast<format::mp3::Bitrate >() == format::mp3::Bitrate_obj::BR_Free) || bool(hdr->__Field(STRING(L"samplingRate",12)).Cast<format::mp3::SamplingRate >() == format::mp3::SamplingRate_obj::SR_Bad))));
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,isInvalidFrameHeader,return )

int Tools_obj::getSampleDataSize( int mpegVersion,int bitrate,int samplingRate,bool isPadded,bool hasCrc){
	return Std_obj::toInt(double(((mpegVersion == format::mp3::MPEG_obj::V1 ? int( 144 ) : int( 72 )) * bitrate * 1000)) / double(samplingRate)) + (isPadded ? int( 1 ) : int( 0 )) - (hasCrc ? int( 2 ) : int( 0 )) - 4;
}


STATIC_DEFINE_DYNAMIC_FUNC5(Tools_obj,getSampleDataSize,return )

int Tools_obj::getSampleDataSizeHdr( Dynamic hdr){
	return format::mp3::Tools_obj::getSampleDataSize(format::mp3::MPEG_obj::enum2Num(hdr->__Field(STRING(L"version",7)).Cast<format::mp3::MPEGVersion >()),format::mp3::MPEG_obj::bitrateEnum2Num(hdr->__Field(STRING(L"bitrate",7)).Cast<format::mp3::Bitrate >()),format::mp3::MPEG_obj::srEnum2Num(hdr->__Field(STRING(L"samplingRate",12)).Cast<format::mp3::SamplingRate >()),hdr->__Field(STRING(L"isPadded",8)).Cast<bool >(),hdr->__Field(STRING(L"hasCrc",6)).Cast<bool >());
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,getSampleDataSizeHdr,return )

int Tools_obj::getSampleCount( int mpegVersion){
	return mpegVersion == format::mp3::MPEG_obj::V1 ? int( 1152 ) : int( 576 );
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,getSampleCount,return )

int Tools_obj::getSampleCountHdr( Dynamic hdr){
	return format::mp3::Tools_obj::getSampleCount(format::mp3::MPEG_obj::enum2Num(hdr->__Field(STRING(L"version",7)).Cast<format::mp3::MPEGVersion >()));
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,getSampleCountHdr,return )

String Tools_obj::getFrameInfo( Dynamic fr){
	return Std_obj::string(fr->__Field(STRING(L"header",6))->__Field(STRING(L"version",7)).Cast<format::mp3::MPEGVersion >()) + STRING(L", ",2) + Std_obj::string(fr->__Field(STRING(L"header",6))->__Field(STRING(L"layer",5)).Cast<format::mp3::Layer >()) + STRING(L", ",2) + Std_obj::string(fr->__Field(STRING(L"header",6))->__Field(STRING(L"channelMode",11)).Cast<format::mp3::ChannelMode >()) + STRING(L", ",2) + fr->__Field(STRING(L"header",6))->__Field(STRING(L"samplingRate",12)).Cast<format::mp3::SamplingRate >() + STRING(L" Hz, ",5) + fr->__Field(STRING(L"header",6))->__Field(STRING(L"bitrate",7)).Cast<format::mp3::Bitrate >() + STRING(L" kbps ",6) + STRING(L"Emphasis: ",10) + Std_obj::string(fr->__Field(STRING(L"header",6))->__Field(STRING(L"emphasis",8)).Cast<format::mp3::Emphasis >()) + STRING(L", ",2) + (fr->__Field(STRING(L"header",6))->__Field(STRING(L"hasCrc",6)).Cast<bool >() ? String( STRING(L"(CRC) ",6) ) : String( STRING(L"",0) )) + (fr->__Field(STRING(L"header",6))->__Field(STRING(L"isPadded",8)).Cast<bool >() ? String( STRING(L"(Padded) ",9) ) : String( STRING(L"",0) )) + (fr->__Field(STRING(L"header",6))->__Field(STRING(L"isIntensityStereo",17)).Cast<bool >() ? String( STRING(L"(Intensity Stereo) ",19) ) : String( STRING(L"",0) )) + (fr->__Field(STRING(L"header",6))->__Field(STRING(L"isMSStereo",10)).Cast<bool >() ? String( STRING(L"(MS Stereo) ",12) ) : String( STRING(L"",0) )) + (fr->__Field(STRING(L"header",6))->__Field(STRING(L"isCopyrighted",13)).Cast<bool >() ? String( STRING(L"(Copyrighted) ",14) ) : String( STRING(L"",0) )) + (fr->__Field(STRING(L"header",6))->__Field(STRING(L"isOriginal",10)).Cast<bool >() ? String( STRING(L"(Original) ",11) ) : String( STRING(L"",0) ));
}


STATIC_DEFINE_DYNAMIC_FUNC1(Tools_obj,getFrameInfo,return )


Tools_obj::Tools_obj()
{
}

void Tools_obj::__Mark()
{
}

Dynamic Tools_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 10:
		if (!memcmp(inName.__s,L"getBitrate",sizeof(wchar_t)*10) ) { return getBitrate_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"getFrameInfo",sizeof(wchar_t)*12) ) { return getFrameInfo_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"getSampleCount",sizeof(wchar_t)*14) ) { return getSampleCount_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"getSamplingRate",sizeof(wchar_t)*15) ) { return getSamplingRate_dyn(); }
		break;
	case 17:
		if (!memcmp(inName.__s,L"getSampleDataSize",sizeof(wchar_t)*17) ) { return getSampleDataSize_dyn(); }
		if (!memcmp(inName.__s,L"getSampleCountHdr",sizeof(wchar_t)*17) ) { return getSampleCountHdr_dyn(); }
		break;
	case 20:
		if (!memcmp(inName.__s,L"isInvalidFrameHeader",sizeof(wchar_t)*20) ) { return isInvalidFrameHeader_dyn(); }
		if (!memcmp(inName.__s,L"getSampleDataSizeHdr",sizeof(wchar_t)*20) ) { return getSampleDataSizeHdr_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_getBitrate = __hxcpp_field_to_id("getBitrate");
static int __id_getSamplingRate = __hxcpp_field_to_id("getSamplingRate");
static int __id_isInvalidFrameHeader = __hxcpp_field_to_id("isInvalidFrameHeader");
static int __id_getSampleDataSize = __hxcpp_field_to_id("getSampleDataSize");
static int __id_getSampleDataSizeHdr = __hxcpp_field_to_id("getSampleDataSizeHdr");
static int __id_getSampleCount = __hxcpp_field_to_id("getSampleCount");
static int __id_getSampleCountHdr = __hxcpp_field_to_id("getSampleCountHdr");
static int __id_getFrameInfo = __hxcpp_field_to_id("getFrameInfo");


Dynamic Tools_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_getBitrate) return getBitrate_dyn();
	if (inFieldID==__id_getSamplingRate) return getSamplingRate_dyn();
	if (inFieldID==__id_isInvalidFrameHeader) return isInvalidFrameHeader_dyn();
	if (inFieldID==__id_getSampleDataSize) return getSampleDataSize_dyn();
	if (inFieldID==__id_getSampleDataSizeHdr) return getSampleDataSizeHdr_dyn();
	if (inFieldID==__id_getSampleCount) return getSampleCount_dyn();
	if (inFieldID==__id_getSampleCountHdr) return getSampleCountHdr_dyn();
	if (inFieldID==__id_getFrameInfo) return getFrameInfo_dyn();
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
	STRING(L"getBitrate",10),
	STRING(L"getSamplingRate",15),
	STRING(L"isInvalidFrameHeader",20),
	STRING(L"getSampleDataSize",17),
	STRING(L"getSampleDataSizeHdr",20),
	STRING(L"getSampleCount",14),
	STRING(L"getSampleCountHdr",17),
	STRING(L"getFrameInfo",12),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
};

Class Tools_obj::__mClass;

void Tools_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.mp3.Tools",16), TCanCast<Tools_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Tools_obj::__boot()
{
}

} // end namespace format
} // end namespace mp3
