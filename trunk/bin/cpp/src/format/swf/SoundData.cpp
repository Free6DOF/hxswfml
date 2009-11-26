#include <hxObject.h>

#ifndef INCLUDED_format_swf_SoundData
#include <format/swf/SoundData.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
namespace format{
namespace swf{

SoundData  SoundData_obj::SDMp3(int seek,haxe::io::Bytes data)
	{ return CreateEnum<SoundData_obj >(STRING(L"SDMp3",5),0,DynamicArray(0,2).Add(seek).Add(data)); }

SoundData  SoundData_obj::SDOther(haxe::io::Bytes data)
	{ return CreateEnum<SoundData_obj >(STRING(L"SDOther",7),2,DynamicArray(0,1).Add(data)); }

SoundData  SoundData_obj::SDRaw(haxe::io::Bytes data)
	{ return CreateEnum<SoundData_obj >(STRING(L"SDRaw",5),1,DynamicArray(0,1).Add(data)); }

DEFINE_CREATE_ENUM(SoundData_obj)

int SoundData_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"SDMp3",5)) return 0;
	if (inName==STRING(L"SDOther",7)) return 2;
	if (inName==STRING(L"SDRaw",5)) return 1;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC2(SoundData_obj,SDMp3,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SoundData_obj,SDOther,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SoundData_obj,SDRaw,return)

int SoundData_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"SDMp3",5)) return 2;
	if (inName==STRING(L"SDOther",7)) return 1;
	if (inName==STRING(L"SDRaw",5)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic SoundData_obj::__Field(const String &inName)
{
	if (inName==STRING(L"SDMp3",5)) return SDMp3_dyn();
	if (inName==STRING(L"SDOther",7)) return SDOther_dyn();
	if (inName==STRING(L"SDRaw",5)) return SDRaw_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"SDMp3",5),
	STRING(L"SDOther",7),
	STRING(L"SDRaw",5),
	String(null()) };

static void sMarkStatics() {
};

static String sMemberFields[] = { String(null()) };
Class SoundData_obj::__mClass;

Dynamic __Create_SoundData_obj() { return new SoundData_obj; }

void SoundData_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.SoundData",20), TCanCast<SoundData_obj >,sStaticFields,sMemberFields,
	&__Create_SoundData_obj, &__Create,
	&super::__SGetClass(), &CreateSoundData_obj, sMarkStatics);
}

void SoundData_obj::__boot()
{
}


} // end namespace format
} // end namespace swf
