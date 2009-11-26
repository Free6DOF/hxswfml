#include <hxObject.h>

#ifndef INCLUDED_cpp_io_FileSeek
#include <cpp/io/FileSeek.h>
#endif
namespace cpp{
namespace io{

FileSeek FileSeek_obj::SeekBegin;

FileSeek FileSeek_obj::SeekCur;

FileSeek FileSeek_obj::SeekEnd;

DEFINE_CREATE_ENUM(FileSeek_obj)

int FileSeek_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"SeekBegin",9)) return 0;
	if (inName==STRING(L"SeekCur",7)) return 1;
	if (inName==STRING(L"SeekEnd",7)) return 2;
	return super::__FindIndex(inName);
}

int FileSeek_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"SeekBegin",9)) return 0;
	if (inName==STRING(L"SeekCur",7)) return 0;
	if (inName==STRING(L"SeekEnd",7)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic FileSeek_obj::__Field(const String &inName)
{
	if (inName==STRING(L"SeekBegin",9)) return SeekBegin;
	if (inName==STRING(L"SeekCur",7)) return SeekCur;
	if (inName==STRING(L"SeekEnd",7)) return SeekEnd;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"SeekBegin",9),
	STRING(L"SeekCur",7),
	STRING(L"SeekEnd",7),
	String(null()) };

static void sMarkStatics() {
	MarkMember(FileSeek_obj::SeekBegin);
	MarkMember(FileSeek_obj::SeekCur);
	MarkMember(FileSeek_obj::SeekEnd);
};

static String sMemberFields[] = { String(null()) };
Class FileSeek_obj::__mClass;

Dynamic __Create_FileSeek_obj() { return new FileSeek_obj; }

void FileSeek_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"cpp.io.FileSeek",15), TCanCast<FileSeek_obj >,sStaticFields,sMemberFields,
	&__Create_FileSeek_obj, &__Create,
	&super::__SGetClass(), &CreateFileSeek_obj, sMarkStatics);
}

void FileSeek_obj::__boot()
{
Static(SeekBegin) = CreateEnum<FileSeek_obj >(STRING(L"SeekBegin",9),0);
Static(SeekCur) = CreateEnum<FileSeek_obj >(STRING(L"SeekCur",7),1);
Static(SeekEnd) = CreateEnum<FileSeek_obj >(STRING(L"SeekEnd",7),2);
}


} // end namespace cpp
} // end namespace io
