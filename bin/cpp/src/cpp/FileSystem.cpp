#include <hxObject.h>

#ifndef INCLUDED_cpp_CppDate__
#include <cpp/CppDate__.h>
#endif
#ifndef INCLUDED_cpp_FileKind
#include <cpp/FileKind.h>
#endif
#ifndef INCLUDED_cpp_FileSystem
#include <cpp/FileSystem.h>
#endif
#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
namespace cpp{

Void FileSystem_obj::__construct()
{
	return null();
}

FileSystem_obj::~FileSystem_obj() { }

Dynamic FileSystem_obj::__CreateEmpty() { return  new FileSystem_obj; }
hxObjectPtr<FileSystem_obj > FileSystem_obj::__new()
{  hxObjectPtr<FileSystem_obj > result = new FileSystem_obj();
	result->__construct();
	return result;}

Dynamic FileSystem_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<FileSystem_obj > result = new FileSystem_obj();
	result->__construct();
	return result;}

bool FileSystem_obj::exists( String path){
	return cpp::FileSystem_obj::sys_exists(path);
}


STATIC_DEFINE_DYNAMIC_FUNC1(FileSystem_obj,exists,return )

Void FileSystem_obj::rename( String path,String newpath){
{
		cpp::FileSystem_obj::sys_rename(path.__s,newpath.__s);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC2(FileSystem_obj,rename,(void))

Dynamic FileSystem_obj::stat( String path){
	Dynamic s = cpp::FileSystem_obj::sys_stat(path);
	s.FieldRef(STRING(L"atime",5)) = cpp::CppDate___obj::fromTime(1000.0 * (s->__Field(STRING(L"atime",5)).Cast<double >()));
	s.FieldRef(STRING(L"mtime",5)) = cpp::CppDate___obj::fromTime(1000.0 * (s->__Field(STRING(L"mtime",5)).Cast<double >()));
	s.FieldRef(STRING(L"ctime",5)) = cpp::CppDate___obj::fromTime(1000.0 * (s->__Field(STRING(L"ctime",5)).Cast<double >()));
	return s;
}


STATIC_DEFINE_DYNAMIC_FUNC1(FileSystem_obj,stat,return )

String FileSystem_obj::fullPath( String relpath){
	return String(cpp::FileSystem_obj::file_full_path(relpath));
}


STATIC_DEFINE_DYNAMIC_FUNC1(FileSystem_obj,fullPath,return )

cpp::FileKind FileSystem_obj::kind( String path){
	String k = cpp::FileSystem_obj::sys_file_type(path);
	struct _Function_1{
		static cpp::FileKind Block( String &k)/* DEF (not block)(ret intern) */{
			String _switch_1 = (k);
			if (  ( _switch_1==STRING(L"file",4))){
				return cpp::FileKind_obj::kfile;
			}
			else if (  ( _switch_1==STRING(L"dir",3))){
				return cpp::FileKind_obj::kdir;
			}
			else  {
				return cpp::FileKind_obj::kother(k);
			}
;
;
		}
	};
	return _Function_1::Block(k);
}


STATIC_DEFINE_DYNAMIC_FUNC1(FileSystem_obj,kind,return )

bool FileSystem_obj::isDirectory( String path){
	return cpp::FileSystem_obj::kind(path) == cpp::FileKind_obj::kdir;
}


STATIC_DEFINE_DYNAMIC_FUNC1(FileSystem_obj,isDirectory,return )

Void FileSystem_obj::createDirectory( String path){
{
		cpp::FileSystem_obj::sys_create_dir(path,493);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC1(FileSystem_obj,createDirectory,(void))

Void FileSystem_obj::deleteFile( String path){
{
		cpp::FileSystem_obj::file_delete(path);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC1(FileSystem_obj,deleteFile,(void))

Void FileSystem_obj::deleteDirectory( String path){
{
		cpp::FileSystem_obj::sys_remove_dir(path);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC1(FileSystem_obj,deleteDirectory,(void))

Array<String > FileSystem_obj::readDirectory( String path){
	return cpp::FileSystem_obj::sys_read_dir(path);
}


STATIC_DEFINE_DYNAMIC_FUNC1(FileSystem_obj,readDirectory,return )

Dynamic FileSystem_obj::sys_exists;

Dynamic FileSystem_obj::file_delete;

Dynamic FileSystem_obj::sys_rename;

Dynamic FileSystem_obj::sys_stat;

Dynamic FileSystem_obj::sys_file_type;

Dynamic FileSystem_obj::sys_create_dir;

Dynamic FileSystem_obj::sys_remove_dir;

Dynamic FileSystem_obj::sys_read_dir;

Dynamic FileSystem_obj::file_full_path;


FileSystem_obj::FileSystem_obj()
{
}

void FileSystem_obj::__Mark()
{
}

Dynamic FileSystem_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 4:
		if (!memcmp(inName.__s,L"stat",sizeof(wchar_t)*4) ) { return stat_dyn(); }
		if (!memcmp(inName.__s,L"kind",sizeof(wchar_t)*4) ) { return kind_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"exists",sizeof(wchar_t)*6) ) { return exists_dyn(); }
		if (!memcmp(inName.__s,L"rename",sizeof(wchar_t)*6) ) { return rename_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"fullPath",sizeof(wchar_t)*8) ) { return fullPath_dyn(); }
		if (!memcmp(inName.__s,L"sys_stat",sizeof(wchar_t)*8) ) { return sys_stat; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"deleteFile",sizeof(wchar_t)*10) ) { return deleteFile_dyn(); }
		if (!memcmp(inName.__s,L"sys_exists",sizeof(wchar_t)*10) ) { return sys_exists; }
		if (!memcmp(inName.__s,L"sys_rename",sizeof(wchar_t)*10) ) { return sys_rename; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"isDirectory",sizeof(wchar_t)*11) ) { return isDirectory_dyn(); }
		if (!memcmp(inName.__s,L"file_delete",sizeof(wchar_t)*11) ) { return file_delete; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"sys_read_dir",sizeof(wchar_t)*12) ) { return sys_read_dir; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"readDirectory",sizeof(wchar_t)*13) ) { return readDirectory_dyn(); }
		if (!memcmp(inName.__s,L"sys_file_type",sizeof(wchar_t)*13) ) { return sys_file_type; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"sys_create_dir",sizeof(wchar_t)*14) ) { return sys_create_dir; }
		if (!memcmp(inName.__s,L"sys_remove_dir",sizeof(wchar_t)*14) ) { return sys_remove_dir; }
		if (!memcmp(inName.__s,L"file_full_path",sizeof(wchar_t)*14) ) { return file_full_path; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"createDirectory",sizeof(wchar_t)*15) ) { return createDirectory_dyn(); }
		if (!memcmp(inName.__s,L"deleteDirectory",sizeof(wchar_t)*15) ) { return deleteDirectory_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_exists = __hxcpp_field_to_id("exists");
static int __id_rename = __hxcpp_field_to_id("rename");
static int __id_stat = __hxcpp_field_to_id("stat");
static int __id_fullPath = __hxcpp_field_to_id("fullPath");
static int __id_kind = __hxcpp_field_to_id("kind");
static int __id_isDirectory = __hxcpp_field_to_id("isDirectory");
static int __id_createDirectory = __hxcpp_field_to_id("createDirectory");
static int __id_deleteFile = __hxcpp_field_to_id("deleteFile");
static int __id_deleteDirectory = __hxcpp_field_to_id("deleteDirectory");
static int __id_readDirectory = __hxcpp_field_to_id("readDirectory");
static int __id_sys_exists = __hxcpp_field_to_id("sys_exists");
static int __id_file_delete = __hxcpp_field_to_id("file_delete");
static int __id_sys_rename = __hxcpp_field_to_id("sys_rename");
static int __id_sys_stat = __hxcpp_field_to_id("sys_stat");
static int __id_sys_file_type = __hxcpp_field_to_id("sys_file_type");
static int __id_sys_create_dir = __hxcpp_field_to_id("sys_create_dir");
static int __id_sys_remove_dir = __hxcpp_field_to_id("sys_remove_dir");
static int __id_sys_read_dir = __hxcpp_field_to_id("sys_read_dir");
static int __id_file_full_path = __hxcpp_field_to_id("file_full_path");


Dynamic FileSystem_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_exists) return exists_dyn();
	if (inFieldID==__id_rename) return rename_dyn();
	if (inFieldID==__id_stat) return stat_dyn();
	if (inFieldID==__id_fullPath) return fullPath_dyn();
	if (inFieldID==__id_kind) return kind_dyn();
	if (inFieldID==__id_isDirectory) return isDirectory_dyn();
	if (inFieldID==__id_createDirectory) return createDirectory_dyn();
	if (inFieldID==__id_deleteFile) return deleteFile_dyn();
	if (inFieldID==__id_deleteDirectory) return deleteDirectory_dyn();
	if (inFieldID==__id_readDirectory) return readDirectory_dyn();
	if (inFieldID==__id_sys_exists) return sys_exists;
	if (inFieldID==__id_file_delete) return file_delete;
	if (inFieldID==__id_sys_rename) return sys_rename;
	if (inFieldID==__id_sys_stat) return sys_stat;
	if (inFieldID==__id_sys_file_type) return sys_file_type;
	if (inFieldID==__id_sys_create_dir) return sys_create_dir;
	if (inFieldID==__id_sys_remove_dir) return sys_remove_dir;
	if (inFieldID==__id_sys_read_dir) return sys_read_dir;
	if (inFieldID==__id_file_full_path) return file_full_path;
	return super::__IField(inFieldID);
}

Dynamic FileSystem_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 8:
		if (!memcmp(inName.__s,L"sys_stat",sizeof(wchar_t)*8) ) { sys_stat=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"sys_exists",sizeof(wchar_t)*10) ) { sys_exists=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"sys_rename",sizeof(wchar_t)*10) ) { sys_rename=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"file_delete",sizeof(wchar_t)*11) ) { file_delete=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"sys_read_dir",sizeof(wchar_t)*12) ) { sys_read_dir=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"sys_file_type",sizeof(wchar_t)*13) ) { sys_file_type=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"sys_create_dir",sizeof(wchar_t)*14) ) { sys_create_dir=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"sys_remove_dir",sizeof(wchar_t)*14) ) { sys_remove_dir=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"file_full_path",sizeof(wchar_t)*14) ) { file_full_path=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void FileSystem_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"exists",6),
	STRING(L"rename",6),
	STRING(L"stat",4),
	STRING(L"fullPath",8),
	STRING(L"kind",4),
	STRING(L"isDirectory",11),
	STRING(L"createDirectory",15),
	STRING(L"deleteFile",10),
	STRING(L"deleteDirectory",15),
	STRING(L"readDirectory",13),
	STRING(L"sys_exists",10),
	STRING(L"file_delete",11),
	STRING(L"sys_rename",10),
	STRING(L"sys_stat",8),
	STRING(L"sys_file_type",13),
	STRING(L"sys_create_dir",14),
	STRING(L"sys_remove_dir",14),
	STRING(L"sys_read_dir",12),
	STRING(L"file_full_path",14),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
	MarkMember(FileSystem_obj::sys_exists);
	MarkMember(FileSystem_obj::file_delete);
	MarkMember(FileSystem_obj::sys_rename);
	MarkMember(FileSystem_obj::sys_stat);
	MarkMember(FileSystem_obj::sys_file_type);
	MarkMember(FileSystem_obj::sys_create_dir);
	MarkMember(FileSystem_obj::sys_remove_dir);
	MarkMember(FileSystem_obj::sys_read_dir);
	MarkMember(FileSystem_obj::file_full_path);
};

Class FileSystem_obj::__mClass;

void FileSystem_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"cpp.FileSystem",14), TCanCast<FileSystem_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void FileSystem_obj::__boot()
{
	Static(sys_exists) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_exists",10),1);
	Static(file_delete) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_delete",11),1);
	Static(sys_rename) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_rename",10),2);
	Static(sys_stat) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_stat",8),1);
	Static(sys_file_type) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_file_type",13),1);
	Static(sys_create_dir) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_create_dir",14),2);
	Static(sys_remove_dir) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_remove_dir",14),1);
	Static(sys_read_dir) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_read_dir",12),1);
	Static(file_full_path) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_full_path",14),1);
}

} // end namespace cpp
