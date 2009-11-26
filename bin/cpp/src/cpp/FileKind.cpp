#include <hxObject.h>

#ifndef INCLUDED_cpp_FileKind
#include <cpp/FileKind.h>
#endif
namespace cpp{

FileKind FileKind_obj::kdir;

FileKind FileKind_obj::kfile;

FileKind  FileKind_obj::kother(String k)
	{ return CreateEnum<FileKind_obj >(STRING(L"kother",6),2,DynamicArray(0,1).Add(k)); }

DEFINE_CREATE_ENUM(FileKind_obj)

int FileKind_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"kdir",4)) return 0;
	if (inName==STRING(L"kfile",5)) return 1;
	if (inName==STRING(L"kother",6)) return 2;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC1(FileKind_obj,kother,return)

int FileKind_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"kdir",4)) return 0;
	if (inName==STRING(L"kfile",5)) return 0;
	if (inName==STRING(L"kother",6)) return 1;
	return super::__FindArgCount(inName);
}

Dynamic FileKind_obj::__Field(const String &inName)
{
	if (inName==STRING(L"kdir",4)) return kdir;
	if (inName==STRING(L"kfile",5)) return kfile;
	if (inName==STRING(L"kother",6)) return kother_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"kdir",4),
	STRING(L"kfile",5),
	STRING(L"kother",6),
	String(null()) };

static void sMarkStatics() {
	MarkMember(FileKind_obj::kdir);
	MarkMember(FileKind_obj::kfile);
};

static String sMemberFields[] = { String(null()) };
Class FileKind_obj::__mClass;

Dynamic __Create_FileKind_obj() { return new FileKind_obj; }

void FileKind_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"cpp.FileKind",12), TCanCast<FileKind_obj >,sStaticFields,sMemberFields,
	&__Create_FileKind_obj, &__Create,
	&super::__SGetClass(), &CreateFileKind_obj, sMarkStatics);
}

void FileKind_obj::__boot()
{
Static(kdir) = CreateEnum<FileKind_obj >(STRING(L"kdir",4),0);
Static(kfile) = CreateEnum<FileKind_obj >(STRING(L"kfile",5),1);
}


} // end namespace cpp
