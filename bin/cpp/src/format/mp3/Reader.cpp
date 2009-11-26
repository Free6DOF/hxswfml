#include <hxObject.h>

#ifndef INCLUDED_format_mp3_Bitrate
#include <format/mp3/Bitrate.h>
#endif
#ifndef INCLUDED_format_mp3_CChannelMode
#include <format/mp3/CChannelMode.h>
#endif
#ifndef INCLUDED_format_mp3_CEmphasis
#include <format/mp3/CEmphasis.h>
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
#ifndef INCLUDED_format_mp3_FrameType
#include <format/mp3/FrameType.h>
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
#ifndef INCLUDED_format_mp3_Reader
#include <format/mp3/Reader.h>
#endif
#ifndef INCLUDED_format_mp3_SamplingRate
#include <format/mp3/SamplingRate.h>
#endif
#ifndef INCLUDED_format_mp3_Tools
#include <format/mp3/Tools.h>
#endif
#ifndef INCLUDED_format_tools_BitsInput
#include <format/tools/BitsInput.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Eof
#include <haxe/io/Eof.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace format{
namespace mp3{

Void Reader_obj::__construct(haxe::io::Input i)
{
{
	this->i = i;
	i->setEndian(true);
	this->bits = format::tools::BitsInput_obj::__new(i);
	this->samples = 0;
	this->sampleSize = 0;
	this->any_read = false;
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

Void Reader_obj::skipID3v2( ){
{
		this->id3v2_version = this->i->readUInt16();
		this->id3v2_flags = this->i->readByte();
		int size = int(this->i->readByte()) & int(127);
		size = int((int(size) << int(7))) | int((int(this->i->readByte()) & int(127)));
		size = int((int(size) << int(7))) | int((int(this->i->readByte()) & int(127)));
		size = int((int(size) << int(7))) | int((int(this->i->readByte()) & int(127)));
		this->id3v2_data = this->i->read(size);
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,skipID3v2,(void))

format::mp3::FrameType Reader_obj::seekFrame( ){
	bool found = false;
	try{
		int b;
		while(true){
			b = this->i->readByte();
			if (!this->any_read){
				this->any_read = true;
				if (b == 73){
					b = this->i->readByte();
					if (b == 68){
						b = this->i->readByte();
						if (b == 51){
							this->skipID3v2();
						}
					}
				}
			}
			if (b == 255){
				this->bits->nbits = 0;
				b = this->bits->readBits(3);
				if (b == 7){
					return format::mp3::FrameType_obj::FT_MP3;
				}
			}
		}
		return format::mp3::FrameType_obj::FT_NONE;
	}
	catch(Dynamic __e){
		if (__e.IsClass<haxe::io::Eof >() ){
			haxe::io::Eof ex = __e;{
				return format::mp3::FrameType_obj::FT_NONE;
			}
		}
		else throw(__e);
	}
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,seekFrame,return )

Array<Dynamic > Reader_obj::readFrames( ){
	Array<Dynamic > frames = Array_obj<Dynamic >::__new();
	format::mp3::FrameType ft;
	while((ft = this->seekFrame()) != format::mp3::FrameType_obj::FT_NONE){
		format::mp3::FrameType _switch_1 = (ft);
		switch((_switch_1)->GetIndex()){
			case 0: {
				Dynamic f = this->readFrame();
				if (f != null())
					frames->push(f);
			}
			break;
			case 1: {
			}
			break;
		}
	}
	return frames;
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readFrames,return )

Dynamic Reader_obj::readFrameHeader( ){
	int version = this->bits->readBits(2);
	int layer = this->bits->readBits(2);
	bool hasCrc = !this->bits->read();
	if (bool(version == format::mp3::MPEG_obj::Reserved) || bool(layer == format::mp3::CLayer_obj::LReserved))
		return null();
	int bitrateIdx = this->bits->readBits(4);
	format::mp3::Bitrate bitrate = format::mp3::Tools_obj::getBitrate(version,layer,bitrateIdx);
	int samplingRateIdx = this->bits->readBits(2);
	format::mp3::SamplingRate samplingRate = format::mp3::Tools_obj::getSamplingRate(version,samplingRateIdx);
	bool isPadded = this->bits->read();
	bool privateBit = this->bits->read();
	if (bool(bitrate == format::mp3::Bitrate_obj::BR_Bad) || bool(bool(bitrate == format::mp3::Bitrate_obj::BR_Free) || bool(samplingRate == format::mp3::SamplingRate_obj::SR_Bad)))
		return null();
	int channelMode = this->bits->readBits(2);
	bool isIntensityStereo = this->bits->read();
	bool isMSStereo = this->bits->read();
	bool isCopyrighted = this->bits->read();
	bool isOriginal = this->bits->read();
	int emphasis = this->bits->readBits(2);
	int crc16 = 0;
	if (hasCrc){
		crc16 = this->i->readUInt16();
	}
	return hxAnon_obj::Create()->Add( STRING(L"version",7) , format::mp3::MPEG_obj::num2Enum(version))->Add( STRING(L"layer",5) , format::mp3::CLayer_obj::num2Enum(layer))->Add( STRING(L"hasCrc",6) , hasCrc)->Add( STRING(L"crc16",5) , crc16)->Add( STRING(L"bitrate",7) , bitrate)->Add( STRING(L"samplingRate",12) , samplingRate)->Add( STRING(L"isPadded",8) , isPadded)->Add( STRING(L"privateBit",10) , privateBit)->Add( STRING(L"channelMode",11) , format::mp3::CChannelMode_obj::num2Enum(channelMode))->Add( STRING(L"isIntensityStereo",17) , isIntensityStereo)->Add( STRING(L"isMSStereo",10) , isMSStereo)->Add( STRING(L"isCopyrighted",13) , isCopyrighted)->Add( STRING(L"isOriginal",10) , isOriginal)->Add( STRING(L"emphasis",8) , format::mp3::CEmphasis_obj::num2Enum(emphasis));
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readFrameHeader,return )

Dynamic Reader_obj::readFrame( ){
	Dynamic header = this->readFrameHeader();
	if (bool(header == null()) || bool(format::mp3::Tools_obj::isInvalidFrameHeader(header)))
		return null();
	try{
		haxe::io::Bytes data = this->i->read(format::mp3::Tools_obj::getSampleDataSizeHdr(header));
		hxAddEq(this->samples,format::mp3::Tools_obj::getSampleCountHdr(header));
		hxAddEq(this->sampleSize,data->length);
		return hxAnon_obj::Create()->Add( STRING(L"header",6) , header)->Add( STRING(L"data",4) , data);
	}
	catch(Dynamic __e){
		if (__e.IsClass<haxe::io::Eof >() ){
			haxe::io::Eof e = __e;{
				return null();
			}
		}
		else throw(__e);
	}
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,readFrame,return )

Dynamic Reader_obj::read( ){
	Array<Dynamic > fs = this->readFrames();
	return hxAnon_obj::Create()->Add( STRING(L"frames",6) , fs)->Add( STRING(L"sampleCount",11) , this->samples)->Add( STRING(L"sampleSize",10) , this->sampleSize)->Add( STRING(L"id3v2",5) , (this->id3v2_data == null()) ? Dynamic( null() ) : Dynamic( hxAnon_obj::Create()->Add( STRING(L"versionBytes",12) , this->id3v2_version)->Add( STRING(L"flagByte",8) , this->id3v2_flags)->Add( STRING(L"data",4) , this->id3v2_data) ));
}


DEFINE_DYNAMIC_FUNC0(Reader_obj,read,return )


Reader_obj::Reader_obj()
{
	InitMember(i);
	InitMember(bits);
	InitMember(version);
	InitMember(samples);
	InitMember(sampleSize);
	InitMember(any_read);
	InitMember(id3v2_data);
	InitMember(id3v2_version);
	InitMember(id3v2_flags);
}

void Reader_obj::__Mark()
{
	MarkMember(i);
	MarkMember(bits);
	MarkMember(version);
	MarkMember(samples);
	MarkMember(sampleSize);
	MarkMember(any_read);
	MarkMember(id3v2_data);
	MarkMember(id3v2_version);
	MarkMember(id3v2_flags);
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
	case 7:
		if (!memcmp(inName.__s,L"version",sizeof(wchar_t)*7) ) { return version; }
		if (!memcmp(inName.__s,L"samples",sizeof(wchar_t)*7) ) { return samples; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"any_read",sizeof(wchar_t)*8) ) { return any_read; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"skipID3v2",sizeof(wchar_t)*9) ) { return skipID3v2_dyn(); }
		if (!memcmp(inName.__s,L"seekFrame",sizeof(wchar_t)*9) ) { return seekFrame_dyn(); }
		if (!memcmp(inName.__s,L"readFrame",sizeof(wchar_t)*9) ) { return readFrame_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"sampleSize",sizeof(wchar_t)*10) ) { return sampleSize; }
		if (!memcmp(inName.__s,L"id3v2_data",sizeof(wchar_t)*10) ) { return id3v2_data; }
		if (!memcmp(inName.__s,L"readFrames",sizeof(wchar_t)*10) ) { return readFrames_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"id3v2_flags",sizeof(wchar_t)*11) ) { return id3v2_flags; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"id3v2_version",sizeof(wchar_t)*13) ) { return id3v2_version; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"readFrameHeader",sizeof(wchar_t)*15) ) { return readFrameHeader_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_i = __hxcpp_field_to_id("i");
static int __id_bits = __hxcpp_field_to_id("bits");
static int __id_version = __hxcpp_field_to_id("version");
static int __id_samples = __hxcpp_field_to_id("samples");
static int __id_sampleSize = __hxcpp_field_to_id("sampleSize");
static int __id_any_read = __hxcpp_field_to_id("any_read");
static int __id_id3v2_data = __hxcpp_field_to_id("id3v2_data");
static int __id_id3v2_version = __hxcpp_field_to_id("id3v2_version");
static int __id_id3v2_flags = __hxcpp_field_to_id("id3v2_flags");
static int __id_skipID3v2 = __hxcpp_field_to_id("skipID3v2");
static int __id_seekFrame = __hxcpp_field_to_id("seekFrame");
static int __id_readFrames = __hxcpp_field_to_id("readFrames");
static int __id_readFrameHeader = __hxcpp_field_to_id("readFrameHeader");
static int __id_readFrame = __hxcpp_field_to_id("readFrame");
static int __id_read = __hxcpp_field_to_id("read");


Dynamic Reader_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_i) return i;
	if (inFieldID==__id_bits) return bits;
	if (inFieldID==__id_version) return version;
	if (inFieldID==__id_samples) return samples;
	if (inFieldID==__id_sampleSize) return sampleSize;
	if (inFieldID==__id_any_read) return any_read;
	if (inFieldID==__id_id3v2_data) return id3v2_data;
	if (inFieldID==__id_id3v2_version) return id3v2_version;
	if (inFieldID==__id_id3v2_flags) return id3v2_flags;
	if (inFieldID==__id_skipID3v2) return skipID3v2_dyn();
	if (inFieldID==__id_seekFrame) return seekFrame_dyn();
	if (inFieldID==__id_readFrames) return readFrames_dyn();
	if (inFieldID==__id_readFrameHeader) return readFrameHeader_dyn();
	if (inFieldID==__id_readFrame) return readFrame_dyn();
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
		if (!memcmp(inName.__s,L"samples",sizeof(wchar_t)*7) ) { samples=inValue.Cast<int >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"any_read",sizeof(wchar_t)*8) ) { any_read=inValue.Cast<bool >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"sampleSize",sizeof(wchar_t)*10) ) { sampleSize=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"id3v2_data",sizeof(wchar_t)*10) ) { id3v2_data=inValue.Cast<haxe::io::Bytes >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"id3v2_flags",sizeof(wchar_t)*11) ) { id3v2_flags=inValue.Cast<int >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"id3v2_version",sizeof(wchar_t)*13) ) { id3v2_version=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Reader_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"i",1));
	outFields->push(STRING(L"bits",4));
	outFields->push(STRING(L"version",7));
	outFields->push(STRING(L"samples",7));
	outFields->push(STRING(L"sampleSize",10));
	outFields->push(STRING(L"any_read",8));
	outFields->push(STRING(L"id3v2_data",10));
	outFields->push(STRING(L"id3v2_version",13));
	outFields->push(STRING(L"id3v2_flags",11));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"i",1),
	STRING(L"bits",4),
	STRING(L"version",7),
	STRING(L"samples",7),
	STRING(L"sampleSize",10),
	STRING(L"any_read",8),
	STRING(L"id3v2_data",10),
	STRING(L"id3v2_version",13),
	STRING(L"id3v2_flags",11),
	STRING(L"skipID3v2",9),
	STRING(L"seekFrame",9),
	STRING(L"readFrames",10),
	STRING(L"readFrameHeader",15),
	STRING(L"readFrame",9),
	STRING(L"read",4),
	String(null()) };

static void sMarkStatics() {
};

Class Reader_obj::__mClass;

void Reader_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.mp3.Reader",17), TCanCast<Reader_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Reader_obj::__boot()
{
}

} // end namespace format
} // end namespace mp3
