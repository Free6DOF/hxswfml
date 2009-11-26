#include <hxObject.h>

#ifndef INCLUDED_format_swf_Bitrate
#include <format/swf/Bitrate.h>
#endif
namespace format{
namespace swf{

Bitrate Bitrate_obj::BR_112;

Bitrate Bitrate_obj::BR_128;

Bitrate Bitrate_obj::BR_144;

Bitrate Bitrate_obj::BR_16;

Bitrate Bitrate_obj::BR_160;

Bitrate Bitrate_obj::BR_176;

Bitrate Bitrate_obj::BR_192;

Bitrate Bitrate_obj::BR_224;

Bitrate Bitrate_obj::BR_24;

Bitrate Bitrate_obj::BR_256;

Bitrate Bitrate_obj::BR_288;

Bitrate Bitrate_obj::BR_32;

Bitrate Bitrate_obj::BR_320;

Bitrate Bitrate_obj::BR_352;

Bitrate Bitrate_obj::BR_384;

Bitrate Bitrate_obj::BR_40;

Bitrate Bitrate_obj::BR_416;

Bitrate Bitrate_obj::BR_448;

Bitrate Bitrate_obj::BR_48;

Bitrate Bitrate_obj::BR_56;

Bitrate Bitrate_obj::BR_64;

Bitrate Bitrate_obj::BR_8;

Bitrate Bitrate_obj::BR_80;

Bitrate Bitrate_obj::BR_96;

Bitrate Bitrate_obj::BR_Bad;

Bitrate Bitrate_obj::BR_Free;

DEFINE_CREATE_ENUM(Bitrate_obj)

int Bitrate_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"BR_112",6)) return 10;
	if (inName==STRING(L"BR_128",6)) return 11;
	if (inName==STRING(L"BR_144",6)) return 12;
	if (inName==STRING(L"BR_16",5)) return 1;
	if (inName==STRING(L"BR_160",6)) return 13;
	if (inName==STRING(L"BR_176",6)) return 14;
	if (inName==STRING(L"BR_192",6)) return 15;
	if (inName==STRING(L"BR_224",6)) return 16;
	if (inName==STRING(L"BR_24",5)) return 2;
	if (inName==STRING(L"BR_256",6)) return 17;
	if (inName==STRING(L"BR_288",6)) return 18;
	if (inName==STRING(L"BR_32",5)) return 3;
	if (inName==STRING(L"BR_320",6)) return 19;
	if (inName==STRING(L"BR_352",6)) return 20;
	if (inName==STRING(L"BR_384",6)) return 21;
	if (inName==STRING(L"BR_40",5)) return 4;
	if (inName==STRING(L"BR_416",6)) return 22;
	if (inName==STRING(L"BR_448",6)) return 23;
	if (inName==STRING(L"BR_48",5)) return 5;
	if (inName==STRING(L"BR_56",5)) return 6;
	if (inName==STRING(L"BR_64",5)) return 7;
	if (inName==STRING(L"BR_8",4)) return 0;
	if (inName==STRING(L"BR_80",5)) return 8;
	if (inName==STRING(L"BR_96",5)) return 9;
	if (inName==STRING(L"BR_Bad",6)) return 25;
	if (inName==STRING(L"BR_Free",7)) return 24;
	return super::__FindIndex(inName);
}

int Bitrate_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"BR_112",6)) return 0;
	if (inName==STRING(L"BR_128",6)) return 0;
	if (inName==STRING(L"BR_144",6)) return 0;
	if (inName==STRING(L"BR_16",5)) return 0;
	if (inName==STRING(L"BR_160",6)) return 0;
	if (inName==STRING(L"BR_176",6)) return 0;
	if (inName==STRING(L"BR_192",6)) return 0;
	if (inName==STRING(L"BR_224",6)) return 0;
	if (inName==STRING(L"BR_24",5)) return 0;
	if (inName==STRING(L"BR_256",6)) return 0;
	if (inName==STRING(L"BR_288",6)) return 0;
	if (inName==STRING(L"BR_32",5)) return 0;
	if (inName==STRING(L"BR_320",6)) return 0;
	if (inName==STRING(L"BR_352",6)) return 0;
	if (inName==STRING(L"BR_384",6)) return 0;
	if (inName==STRING(L"BR_40",5)) return 0;
	if (inName==STRING(L"BR_416",6)) return 0;
	if (inName==STRING(L"BR_448",6)) return 0;
	if (inName==STRING(L"BR_48",5)) return 0;
	if (inName==STRING(L"BR_56",5)) return 0;
	if (inName==STRING(L"BR_64",5)) return 0;
	if (inName==STRING(L"BR_8",4)) return 0;
	if (inName==STRING(L"BR_80",5)) return 0;
	if (inName==STRING(L"BR_96",5)) return 0;
	if (inName==STRING(L"BR_Bad",6)) return 0;
	if (inName==STRING(L"BR_Free",7)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic Bitrate_obj::__Field(const String &inName)
{
	if (inName==STRING(L"BR_112",6)) return BR_112;
	if (inName==STRING(L"BR_128",6)) return BR_128;
	if (inName==STRING(L"BR_144",6)) return BR_144;
	if (inName==STRING(L"BR_16",5)) return BR_16;
	if (inName==STRING(L"BR_160",6)) return BR_160;
	if (inName==STRING(L"BR_176",6)) return BR_176;
	if (inName==STRING(L"BR_192",6)) return BR_192;
	if (inName==STRING(L"BR_224",6)) return BR_224;
	if (inName==STRING(L"BR_24",5)) return BR_24;
	if (inName==STRING(L"BR_256",6)) return BR_256;
	if (inName==STRING(L"BR_288",6)) return BR_288;
	if (inName==STRING(L"BR_32",5)) return BR_32;
	if (inName==STRING(L"BR_320",6)) return BR_320;
	if (inName==STRING(L"BR_352",6)) return BR_352;
	if (inName==STRING(L"BR_384",6)) return BR_384;
	if (inName==STRING(L"BR_40",5)) return BR_40;
	if (inName==STRING(L"BR_416",6)) return BR_416;
	if (inName==STRING(L"BR_448",6)) return BR_448;
	if (inName==STRING(L"BR_48",5)) return BR_48;
	if (inName==STRING(L"BR_56",5)) return BR_56;
	if (inName==STRING(L"BR_64",5)) return BR_64;
	if (inName==STRING(L"BR_8",4)) return BR_8;
	if (inName==STRING(L"BR_80",5)) return BR_80;
	if (inName==STRING(L"BR_96",5)) return BR_96;
	if (inName==STRING(L"BR_Bad",6)) return BR_Bad;
	if (inName==STRING(L"BR_Free",7)) return BR_Free;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"BR_112",6),
	STRING(L"BR_128",6),
	STRING(L"BR_144",6),
	STRING(L"BR_16",5),
	STRING(L"BR_160",6),
	STRING(L"BR_176",6),
	STRING(L"BR_192",6),
	STRING(L"BR_224",6),
	STRING(L"BR_24",5),
	STRING(L"BR_256",6),
	STRING(L"BR_288",6),
	STRING(L"BR_32",5),
	STRING(L"BR_320",6),
	STRING(L"BR_352",6),
	STRING(L"BR_384",6),
	STRING(L"BR_40",5),
	STRING(L"BR_416",6),
	STRING(L"BR_448",6),
	STRING(L"BR_48",5),
	STRING(L"BR_56",5),
	STRING(L"BR_64",5),
	STRING(L"BR_8",4),
	STRING(L"BR_80",5),
	STRING(L"BR_96",5),
	STRING(L"BR_Bad",6),
	STRING(L"BR_Free",7),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Bitrate_obj::BR_112);
	MarkMember(Bitrate_obj::BR_128);
	MarkMember(Bitrate_obj::BR_144);
	MarkMember(Bitrate_obj::BR_16);
	MarkMember(Bitrate_obj::BR_160);
	MarkMember(Bitrate_obj::BR_176);
	MarkMember(Bitrate_obj::BR_192);
	MarkMember(Bitrate_obj::BR_224);
	MarkMember(Bitrate_obj::BR_24);
	MarkMember(Bitrate_obj::BR_256);
	MarkMember(Bitrate_obj::BR_288);
	MarkMember(Bitrate_obj::BR_32);
	MarkMember(Bitrate_obj::BR_320);
	MarkMember(Bitrate_obj::BR_352);
	MarkMember(Bitrate_obj::BR_384);
	MarkMember(Bitrate_obj::BR_40);
	MarkMember(Bitrate_obj::BR_416);
	MarkMember(Bitrate_obj::BR_448);
	MarkMember(Bitrate_obj::BR_48);
	MarkMember(Bitrate_obj::BR_56);
	MarkMember(Bitrate_obj::BR_64);
	MarkMember(Bitrate_obj::BR_8);
	MarkMember(Bitrate_obj::BR_80);
	MarkMember(Bitrate_obj::BR_96);
	MarkMember(Bitrate_obj::BR_Bad);
	MarkMember(Bitrate_obj::BR_Free);
};

static String sMemberFields[] = { String(null()) };
Class Bitrate_obj::__mClass;

Dynamic __Create_Bitrate_obj() { return new Bitrate_obj; }

void Bitrate_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.Bitrate",18), TCanCast<Bitrate_obj >,sStaticFields,sMemberFields,
	&__Create_Bitrate_obj, &__Create,
	&super::__SGetClass(), &CreateBitrate_obj, sMarkStatics);
}

void Bitrate_obj::__boot()
{
Static(BR_112) = CreateEnum<Bitrate_obj >(STRING(L"BR_112",6),10);
Static(BR_128) = CreateEnum<Bitrate_obj >(STRING(L"BR_128",6),11);
Static(BR_144) = CreateEnum<Bitrate_obj >(STRING(L"BR_144",6),12);
Static(BR_16) = CreateEnum<Bitrate_obj >(STRING(L"BR_16",5),1);
Static(BR_160) = CreateEnum<Bitrate_obj >(STRING(L"BR_160",6),13);
Static(BR_176) = CreateEnum<Bitrate_obj >(STRING(L"BR_176",6),14);
Static(BR_192) = CreateEnum<Bitrate_obj >(STRING(L"BR_192",6),15);
Static(BR_224) = CreateEnum<Bitrate_obj >(STRING(L"BR_224",6),16);
Static(BR_24) = CreateEnum<Bitrate_obj >(STRING(L"BR_24",5),2);
Static(BR_256) = CreateEnum<Bitrate_obj >(STRING(L"BR_256",6),17);
Static(BR_288) = CreateEnum<Bitrate_obj >(STRING(L"BR_288",6),18);
Static(BR_32) = CreateEnum<Bitrate_obj >(STRING(L"BR_32",5),3);
Static(BR_320) = CreateEnum<Bitrate_obj >(STRING(L"BR_320",6),19);
Static(BR_352) = CreateEnum<Bitrate_obj >(STRING(L"BR_352",6),20);
Static(BR_384) = CreateEnum<Bitrate_obj >(STRING(L"BR_384",6),21);
Static(BR_40) = CreateEnum<Bitrate_obj >(STRING(L"BR_40",5),4);
Static(BR_416) = CreateEnum<Bitrate_obj >(STRING(L"BR_416",6),22);
Static(BR_448) = CreateEnum<Bitrate_obj >(STRING(L"BR_448",6),23);
Static(BR_48) = CreateEnum<Bitrate_obj >(STRING(L"BR_48",5),5);
Static(BR_56) = CreateEnum<Bitrate_obj >(STRING(L"BR_56",5),6);
Static(BR_64) = CreateEnum<Bitrate_obj >(STRING(L"BR_64",5),7);
Static(BR_8) = CreateEnum<Bitrate_obj >(STRING(L"BR_8",4),0);
Static(BR_80) = CreateEnum<Bitrate_obj >(STRING(L"BR_80",5),8);
Static(BR_96) = CreateEnum<Bitrate_obj >(STRING(L"BR_96",5),9);
Static(BR_Bad) = CreateEnum<Bitrate_obj >(STRING(L"BR_Bad",6),25);
Static(BR_Free) = CreateEnum<Bitrate_obj >(STRING(L"BR_Free",7),24);
}


} // end namespace format
} // end namespace swf
