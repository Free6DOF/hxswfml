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
#ifndef INCLUDED_format_mp3_Writer
#include <format/mp3/Writer.h>
#endif
#ifndef INCLUDED_format_tools_BitsOutput
#include <format/tools/BitsOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace format{
namespace mp3{

Void Writer_obj::__construct(haxe::io::Output output)
{
{
	this->o = output;
	this->o->setEndian(true);
	this->bits = format::tools::BitsOutput_obj::__new(this->o);
}
;
	return null();
}

Writer_obj::~Writer_obj() { }

Dynamic Writer_obj::__CreateEmpty() { return  new Writer_obj; }
hxObjectPtr<Writer_obj > Writer_obj::__new(haxe::io::Output output)
{  hxObjectPtr<Writer_obj > result = new Writer_obj();
	result->__construct(output);
	return result;}

Dynamic Writer_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Writer_obj > result = new Writer_obj();
	result->__construct(inArgs[0]);
	return result;}

Void Writer_obj::write( Dynamic mp3,Dynamic __o_writeId3v2){
bool writeId3v2 = __o_writeId3v2.Default(true);
{
		if (bool(writeId3v2) && bool(mp3->__Field(STRING(L"id3v2",5)) != null()))
			this->writeID3v2(mp3->__Field(STRING(L"id3v2",5)));
		{
			int _g = 0;
			Array<Dynamic > _g1 = mp3->__Field(STRING(L"frames",6)).Cast<Array<Dynamic > >();
			while(_g < _g1->length){
				Dynamic f = _g1->__get(_g);
				++_g;
				this->writeFrame(f);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,write,(void))

Void Writer_obj::writeID3v2( Dynamic id3v2){
{
		this->o->writeString(STRING(L"ID3",3));
		this->o->writeUInt16(id3v2->__Field(STRING(L"versionBytes",12)).Cast<int >());
		this->o->writeByte(id3v2->__Field(STRING(L"flagByte",8)).Cast<int >());
		Array<int > arr = Array_obj<int >::__new();
		int l = id3v2->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >()->length;
		{
			int _g = 0;
			while(_g < 4){
				int i = _g++;
				arr->push(int(l) & int(127));
				hxShrEq(l,7);
			}
		}
		{
			int _g = 0;
			while(_g < 4){
				int i = _g++;
				this->bits->writeBit(false);
				this->bits->writeBits(7,arr->__get(3 - i));
			}
		}
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		this->o->write(id3v2->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeID3v2,(void))

Void Writer_obj::writeFrame( Dynamic f){
{
		this->o->writeByte(255);
		this->bits->writeBits(3,7);
		Dynamic h = f->__Field(STRING(L"header",6));
		this->bits->writeBits(2,format::mp3::MPEG_obj::enum2Num(h->__Field(STRING(L"version",7)).Cast<format::mp3::MPEGVersion >()));
		this->bits->writeBits(2,format::mp3::CLayer_obj::enum2Num(h->__Field(STRING(L"layer",5)).Cast<format::mp3::Layer >()));
		this->bits->writeBit(!h.FieldRef(STRING(L"hasCrc",6)));
		this->bits->writeBits(4,format::mp3::MPEG_obj::getBitrateIdx(h->__Field(STRING(L"bitrate",7)).Cast<format::mp3::Bitrate >(),h->__Field(STRING(L"version",7)).Cast<format::mp3::MPEGVersion >(),h->__Field(STRING(L"layer",5)).Cast<format::mp3::Layer >()));
		this->bits->writeBits(2,format::mp3::MPEG_obj::getSamplingRateIdx(h->__Field(STRING(L"samplingRate",12)).Cast<format::mp3::SamplingRate >(),h->__Field(STRING(L"version",7)).Cast<format::mp3::MPEGVersion >()));
		this->bits->writeBit(h->__Field(STRING(L"isPadded",8)).Cast<bool >());
		this->bits->writeBit(h->__Field(STRING(L"privateBit",10)).Cast<bool >());
		this->bits->writeBits(2,format::mp3::CChannelMode_obj::enum2Num(h->__Field(STRING(L"channelMode",11)).Cast<format::mp3::ChannelMode >()));
		this->bits->writeBit(h->__Field(STRING(L"isIntensityStereo",17)).Cast<bool >());
		this->bits->writeBit(h->__Field(STRING(L"isMSStereo",10)).Cast<bool >());
		this->bits->writeBit(h->__Field(STRING(L"isCopyrighted",13)).Cast<bool >());
		this->bits->writeBit(h->__Field(STRING(L"isOriginal",10)).Cast<bool >());
		this->bits->writeBits(2,format::mp3::CEmphasis_obj::enum2Num(h->__Field(STRING(L"emphasis",8)).Cast<format::mp3::Emphasis >()));
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		if (h->__Field(STRING(L"hasCrc",6)).Cast<bool >()){
			this->o->writeUInt16(h->__Field(STRING(L"crc16",5)).Cast<int >());
		}
		this->o->write(f->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFrame,(void))

bool Writer_obj::WRITE_ID3V2;

bool Writer_obj::DONT_WRITE_ID3V2;


Writer_obj::Writer_obj()
{
	InitMember(o);
	InitMember(bits);
}

void Writer_obj::__Mark()
{
	MarkMember(o);
	MarkMember(bits);
}

Dynamic Writer_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { return o; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { return bits; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"write",sizeof(wchar_t)*5) ) { return write_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"writeID3v2",sizeof(wchar_t)*10) ) { return writeID3v2_dyn(); }
		if (!memcmp(inName.__s,L"writeFrame",sizeof(wchar_t)*10) ) { return writeFrame_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"WRITE_ID3V2",sizeof(wchar_t)*11) ) { return WRITE_ID3V2; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"DONT_WRITE_ID3V2",sizeof(wchar_t)*16) ) { return DONT_WRITE_ID3V2; }
	}
	return super::__Field(inName);
}

static int __id_WRITE_ID3V2 = __hxcpp_field_to_id("WRITE_ID3V2");
static int __id_DONT_WRITE_ID3V2 = __hxcpp_field_to_id("DONT_WRITE_ID3V2");
static int __id_o = __hxcpp_field_to_id("o");
static int __id_bits = __hxcpp_field_to_id("bits");
static int __id_write = __hxcpp_field_to_id("write");
static int __id_writeID3v2 = __hxcpp_field_to_id("writeID3v2");
static int __id_writeFrame = __hxcpp_field_to_id("writeFrame");


Dynamic Writer_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_WRITE_ID3V2) return WRITE_ID3V2;
	if (inFieldID==__id_DONT_WRITE_ID3V2) return DONT_WRITE_ID3V2;
	if (inFieldID==__id_o) return o;
	if (inFieldID==__id_bits) return bits;
	if (inFieldID==__id_write) return write_dyn();
	if (inFieldID==__id_writeID3v2) return writeID3v2_dyn();
	if (inFieldID==__id_writeFrame) return writeFrame_dyn();
	return super::__IField(inFieldID);
}

Dynamic Writer_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { o=inValue.Cast<haxe::io::Output >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { bits=inValue.Cast<format::tools::BitsOutput >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"WRITE_ID3V2",sizeof(wchar_t)*11) ) { WRITE_ID3V2=inValue.Cast<bool >();return inValue; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"DONT_WRITE_ID3V2",sizeof(wchar_t)*16) ) { DONT_WRITE_ID3V2=inValue.Cast<bool >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Writer_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"o",1));
	outFields->push(STRING(L"bits",4));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"WRITE_ID3V2",11),
	STRING(L"DONT_WRITE_ID3V2",16),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"o",1),
	STRING(L"bits",4),
	STRING(L"write",5),
	STRING(L"writeID3v2",10),
	STRING(L"writeFrame",10),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Writer_obj::WRITE_ID3V2);
	MarkMember(Writer_obj::DONT_WRITE_ID3V2);
};

Class Writer_obj::__mClass;

void Writer_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.mp3.Writer",17), TCanCast<Writer_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Writer_obj::__boot()
{
	Static(WRITE_ID3V2) = true;
	Static(DONT_WRITE_ID3V2) = false;
}

} // end namespace format
} // end namespace mp3
