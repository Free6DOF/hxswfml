#include <hxObject.h>

#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
#ifndef INCLUDED_cpp_io_File
#include <cpp/io/File.h>
#endif
#ifndef INCLUDED_cpp_io_FileInput
#include <cpp/io/FileInput.h>
#endif
#ifndef INCLUDED_cpp_io_FileOutput
#include <cpp/io/FileOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace cpp{
namespace io{

Void File_obj::__construct()
{
	return null();
}

File_obj::~File_obj() { }

Dynamic File_obj::__CreateEmpty() { return  new File_obj; }
hxObjectPtr<File_obj > File_obj::__new()
{  hxObjectPtr<File_obj > result = new File_obj();
	result->__construct();
	return result;}

Dynamic File_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<File_obj > result = new File_obj();
	result->__construct();
	return result;}

String File_obj::getContent( String path){
	haxe::io::Bytes b = cpp::io::File_obj::getBytes(path);
	return b->toString();
}


STATIC_DEFINE_DYNAMIC_FUNC1(File_obj,getContent,return )

haxe::io::Bytes File_obj::getBytes( String path){
	Array<unsigned char > data = cpp::io::File_obj::file_contents(path);
	return haxe::io::Bytes_obj::ofData(data);
}


STATIC_DEFINE_DYNAMIC_FUNC1(File_obj,getBytes,return )

cpp::io::FileInput File_obj::read( String path,bool binary){
	return cpp::io::FileInput_obj::__new(cpp::io::File_obj::file_open(path,(binary ? String( STRING(L"rb",2) ) : String( STRING(L"r",1) ))));
}


STATIC_DEFINE_DYNAMIC_FUNC2(File_obj,read,return )

cpp::io::FileOutput File_obj::write( String path,bool binary){
	return cpp::io::FileOutput_obj::__new(cpp::io::File_obj::file_open(path.__s,(binary ? String( STRING(L"wb",2) ) : String( STRING(L"w",1) ))));
}


STATIC_DEFINE_DYNAMIC_FUNC2(File_obj,write,return )

cpp::io::FileOutput File_obj::append( String path,bool binary){
	return cpp::io::FileOutput_obj::__new(cpp::io::File_obj::file_open(path.__s,(binary ? String( STRING(L"ab",2) ) : String( STRING(L"a",1) ))));
}


STATIC_DEFINE_DYNAMIC_FUNC2(File_obj,append,return )

Void File_obj::copy( String src,String dst){
{
		cpp::io::FileInput s = cpp::io::File_obj::read(src,true);
		cpp::io::FileOutput d = cpp::io::File_obj::write(dst,true);
		d->writeInput(s,null());
		s->close();
		d->close();
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC2(File_obj,copy,(void))

cpp::io::FileInput File_obj::_stdin( ){
	return cpp::io::FileInput_obj::__new(cpp::io::File_obj::file_stdin());
}


STATIC_DEFINE_DYNAMIC_FUNC0(File_obj,_stdin,return )

cpp::io::FileOutput File_obj::_stdout( ){
	return cpp::io::FileOutput_obj::__new(cpp::io::File_obj::file_stdout());
}


STATIC_DEFINE_DYNAMIC_FUNC0(File_obj,_stdout,return )

cpp::io::FileOutput File_obj::_stderr( ){
	return cpp::io::FileOutput_obj::__new(cpp::io::File_obj::file_stderr());
}


STATIC_DEFINE_DYNAMIC_FUNC0(File_obj,_stderr,return )

int File_obj::getChar( bool echo){
	return cpp::io::File_obj::getch(echo);
}


STATIC_DEFINE_DYNAMIC_FUNC1(File_obj,getChar,return )

Dynamic File_obj::file_stdin;

Dynamic File_obj::file_stdout;

Dynamic File_obj::file_stderr;

Dynamic File_obj::file_contents;

Dynamic File_obj::file_open;

Dynamic File_obj::getch;


File_obj::File_obj()
{
}

void File_obj::__Mark()
{
}

Dynamic File_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 4:
		if (!memcmp(inName.__s,L"read",sizeof(wchar_t)*4) ) { return read_dyn(); }
		if (!memcmp(inName.__s,L"copy",sizeof(wchar_t)*4) ) { return copy_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"write",sizeof(wchar_t)*5) ) { return write_dyn(); }
		if (!memcmp(inName.__s,L"stdin",sizeof(wchar_t)*5) ) { return _stdin_dyn(); }
		if (!memcmp(inName.__s,L"getch",sizeof(wchar_t)*5) ) { return getch; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"append",sizeof(wchar_t)*6) ) { return append_dyn(); }
		if (!memcmp(inName.__s,L"stdout",sizeof(wchar_t)*6) ) { return _stdout_dyn(); }
		if (!memcmp(inName.__s,L"stderr",sizeof(wchar_t)*6) ) { return _stderr_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"getChar",sizeof(wchar_t)*7) ) { return getChar_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"getBytes",sizeof(wchar_t)*8) ) { return getBytes_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"file_open",sizeof(wchar_t)*9) ) { return file_open; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"getContent",sizeof(wchar_t)*10) ) { return getContent_dyn(); }
		if (!memcmp(inName.__s,L"file_stdin",sizeof(wchar_t)*10) ) { return file_stdin; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"file_stdout",sizeof(wchar_t)*11) ) { return file_stdout; }
		if (!memcmp(inName.__s,L"file_stderr",sizeof(wchar_t)*11) ) { return file_stderr; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"file_contents",sizeof(wchar_t)*13) ) { return file_contents; }
	}
	return super::__Field(inName);
}

static int __id_getContent = __hxcpp_field_to_id("getContent");
static int __id_getBytes = __hxcpp_field_to_id("getBytes");
static int __id_read = __hxcpp_field_to_id("read");
static int __id_write = __hxcpp_field_to_id("write");
static int __id_append = __hxcpp_field_to_id("append");
static int __id_copy = __hxcpp_field_to_id("copy");
static int __id__stdin = __hxcpp_field_to_id("stdin");
static int __id__stdout = __hxcpp_field_to_id("stdout");
static int __id__stderr = __hxcpp_field_to_id("stderr");
static int __id_getChar = __hxcpp_field_to_id("getChar");
static int __id_file_stdin = __hxcpp_field_to_id("file_stdin");
static int __id_file_stdout = __hxcpp_field_to_id("file_stdout");
static int __id_file_stderr = __hxcpp_field_to_id("file_stderr");
static int __id_file_contents = __hxcpp_field_to_id("file_contents");
static int __id_file_open = __hxcpp_field_to_id("file_open");
static int __id_getch = __hxcpp_field_to_id("getch");


Dynamic File_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_getContent) return getContent_dyn();
	if (inFieldID==__id_getBytes) return getBytes_dyn();
	if (inFieldID==__id_read) return read_dyn();
	if (inFieldID==__id_write) return write_dyn();
	if (inFieldID==__id_append) return append_dyn();
	if (inFieldID==__id_copy) return copy_dyn();
	if (inFieldID==__id__stdin) return _stdin_dyn();
	if (inFieldID==__id__stdout) return _stdout_dyn();
	if (inFieldID==__id__stderr) return _stderr_dyn();
	if (inFieldID==__id_getChar) return getChar_dyn();
	if (inFieldID==__id_file_stdin) return file_stdin;
	if (inFieldID==__id_file_stdout) return file_stdout;
	if (inFieldID==__id_file_stderr) return file_stderr;
	if (inFieldID==__id_file_contents) return file_contents;
	if (inFieldID==__id_file_open) return file_open;
	if (inFieldID==__id_getch) return getch;
	return super::__IField(inFieldID);
}

Dynamic File_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"getch",sizeof(wchar_t)*5) ) { getch=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"file_open",sizeof(wchar_t)*9) ) { file_open=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"file_stdin",sizeof(wchar_t)*10) ) { file_stdin=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"file_stdout",sizeof(wchar_t)*11) ) { file_stdout=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"file_stderr",sizeof(wchar_t)*11) ) { file_stderr=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"file_contents",sizeof(wchar_t)*13) ) { file_contents=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void File_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"getContent",10),
	STRING(L"getBytes",8),
	STRING(L"read",4),
	STRING(L"write",5),
	STRING(L"append",6),
	STRING(L"copy",4),
	STRING(L"stdin",5),
	STRING(L"stdout",6),
	STRING(L"stderr",6),
	STRING(L"getChar",7),
	STRING(L"file_stdin",10),
	STRING(L"file_stdout",11),
	STRING(L"file_stderr",11),
	STRING(L"file_contents",13),
	STRING(L"file_open",9),
	STRING(L"getch",5),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
	MarkMember(File_obj::file_stdin);
	MarkMember(File_obj::file_stdout);
	MarkMember(File_obj::file_stderr);
	MarkMember(File_obj::file_contents);
	MarkMember(File_obj::file_open);
	MarkMember(File_obj::getch);
};

Class File_obj::__mClass;

void File_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"cpp.io.File",11), TCanCast<File_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void File_obj::__boot()
{
	Static(file_stdin) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_stdin",10),0);
	Static(file_stdout) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_stdout",11),0);
	Static(file_stderr) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_stderr",11),0);
	Static(file_contents) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_contents",13),1);
	Static(file_open) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_open",9),2);
	Static(getch) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_getch",9),1);
}

} // end namespace cpp
} // end namespace io
