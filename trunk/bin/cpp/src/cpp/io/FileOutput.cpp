#include <hxObject.h>

#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
#ifndef INCLUDED_cpp_io_FileOutput
#include <cpp/io/FileOutput.h>
#endif
#ifndef INCLUDED_cpp_io_FileSeek
#include <cpp/io/FileSeek.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace cpp{
namespace io{

Void FileOutput_obj::__construct(Dynamic f)
{
{
	this->__f = f;
}
;
	return null();
}

FileOutput_obj::~FileOutput_obj() { }

Dynamic FileOutput_obj::__CreateEmpty() { return  new FileOutput_obj; }
hxObjectPtr<FileOutput_obj > FileOutput_obj::__new(Dynamic f)
{  hxObjectPtr<FileOutput_obj > result = new FileOutput_obj();
	result->__construct(f);
	return result;}

Dynamic FileOutput_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<FileOutput_obj > result = new FileOutput_obj();
	result->__construct(inArgs[0]);
	return result;}

Void FileOutput_obj::writeByte( int c){
{
		try{
			cpp::io::FileOutput_obj::file_write_char(this->__f,c);
		}
		catch(Dynamic __e){
			{
				Dynamic e = __e;{
					hxThrow (haxe::io::Error_obj::Custom(e));
				}
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(FileOutput_obj,writeByte,(void))

int FileOutput_obj::writeBytes( haxe::io::Bytes s,int p,int l){
	struct _Function_1{
		static int Block( cpp::io::FileOutput_obj *__this,haxe::io::Bytes &s,int &p,int &l)/* DEF (not block)(ret intern) */{
			try{
				return cpp::io::FileOutput_obj::file_write(__this->__f,s->b,p,l);
			}
			catch(Dynamic __e){
				{
					Dynamic e = __e;{
						return hxThrow (haxe::io::Error_obj::Custom(e));
					}
				}
			}
		}
	};
	return _Function_1::Block(this,s,p,l);
}


DEFINE_DYNAMIC_FUNC3(FileOutput_obj,writeBytes,return )

Void FileOutput_obj::flush( ){
{
		cpp::io::FileOutput_obj::file_flush(this->__f);
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(FileOutput_obj,flush,(void))

Void FileOutput_obj::close( ){
{
		this->super::close();
		cpp::io::FileOutput_obj::file_close(this->__f);
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(FileOutput_obj,close,(void))

Void FileOutput_obj::seek( int p,cpp::io::FileSeek pos){
{
		struct _Function_1{
			static int Block( cpp::io::FileSeek &pos)/* DEF (not block)(ret intern) */{
				cpp::io::FileSeek _switch_1 = (pos);
				switch((_switch_1)->GetIndex()){
					case 0: {
						return 0;
					}
					break;
					case 1: {
						return 1;
					}
					break;
					case 2: {
						return 2;
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		cpp::io::FileOutput_obj::file_seek(this->__f,p,_Function_1::Block(pos));
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(FileOutput_obj,seek,(void))

int FileOutput_obj::tell( ){
	return cpp::io::FileOutput_obj::file_tell(this->__f);
}


DEFINE_DYNAMIC_FUNC0(FileOutput_obj,tell,return )

Dynamic FileOutput_obj::file_close;

Dynamic FileOutput_obj::file_seek;

Dynamic FileOutput_obj::file_tell;

Dynamic FileOutput_obj::file_flush;

Dynamic FileOutput_obj::file_write;

Dynamic FileOutput_obj::file_write_char;


FileOutput_obj::FileOutput_obj()
{
	InitMember(__f);
}

void FileOutput_obj::__Mark()
{
	MarkMember(__f);
	super::__Mark();
}

Dynamic FileOutput_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"__f",sizeof(wchar_t)*3) ) { return __f; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"seek",sizeof(wchar_t)*4) ) { return seek_dyn(); }
		if (!memcmp(inName.__s,L"tell",sizeof(wchar_t)*4) ) { return tell_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"flush",sizeof(wchar_t)*5) ) { return flush_dyn(); }
		if (!memcmp(inName.__s,L"close",sizeof(wchar_t)*5) ) { return close_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"file_seek",sizeof(wchar_t)*9) ) { return file_seek; }
		if (!memcmp(inName.__s,L"file_tell",sizeof(wchar_t)*9) ) { return file_tell; }
		if (!memcmp(inName.__s,L"writeByte",sizeof(wchar_t)*9) ) { return writeByte_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"file_close",sizeof(wchar_t)*10) ) { return file_close; }
		if (!memcmp(inName.__s,L"file_flush",sizeof(wchar_t)*10) ) { return file_flush; }
		if (!memcmp(inName.__s,L"file_write",sizeof(wchar_t)*10) ) { return file_write; }
		if (!memcmp(inName.__s,L"writeBytes",sizeof(wchar_t)*10) ) { return writeBytes_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"file_write_char",sizeof(wchar_t)*15) ) { return file_write_char; }
	}
	return super::__Field(inName);
}

static int __id_file_close = __hxcpp_field_to_id("file_close");
static int __id_file_seek = __hxcpp_field_to_id("file_seek");
static int __id_file_tell = __hxcpp_field_to_id("file_tell");
static int __id_file_flush = __hxcpp_field_to_id("file_flush");
static int __id_file_write = __hxcpp_field_to_id("file_write");
static int __id_file_write_char = __hxcpp_field_to_id("file_write_char");
static int __id___f = __hxcpp_field_to_id("__f");
static int __id_writeByte = __hxcpp_field_to_id("writeByte");
static int __id_writeBytes = __hxcpp_field_to_id("writeBytes");
static int __id_flush = __hxcpp_field_to_id("flush");
static int __id_close = __hxcpp_field_to_id("close");
static int __id_seek = __hxcpp_field_to_id("seek");
static int __id_tell = __hxcpp_field_to_id("tell");


Dynamic FileOutput_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_file_close) return file_close;
	if (inFieldID==__id_file_seek) return file_seek;
	if (inFieldID==__id_file_tell) return file_tell;
	if (inFieldID==__id_file_flush) return file_flush;
	if (inFieldID==__id_file_write) return file_write;
	if (inFieldID==__id_file_write_char) return file_write_char;
	if (inFieldID==__id___f) return __f;
	if (inFieldID==__id_writeByte) return writeByte_dyn();
	if (inFieldID==__id_writeBytes) return writeBytes_dyn();
	if (inFieldID==__id_flush) return flush_dyn();
	if (inFieldID==__id_close) return close_dyn();
	if (inFieldID==__id_seek) return seek_dyn();
	if (inFieldID==__id_tell) return tell_dyn();
	return super::__IField(inFieldID);
}

Dynamic FileOutput_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"__f",sizeof(wchar_t)*3) ) { __f=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"file_seek",sizeof(wchar_t)*9) ) { file_seek=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"file_tell",sizeof(wchar_t)*9) ) { file_tell=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"file_close",sizeof(wchar_t)*10) ) { file_close=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"file_flush",sizeof(wchar_t)*10) ) { file_flush=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"file_write",sizeof(wchar_t)*10) ) { file_write=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"file_write_char",sizeof(wchar_t)*15) ) { file_write_char=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void FileOutput_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"__f",3));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"file_close",10),
	STRING(L"file_seek",9),
	STRING(L"file_tell",9),
	STRING(L"file_flush",10),
	STRING(L"file_write",10),
	STRING(L"file_write_char",15),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"__f",3),
	STRING(L"writeByte",9),
	STRING(L"writeBytes",10),
	STRING(L"flush",5),
	STRING(L"close",5),
	STRING(L"seek",4),
	STRING(L"tell",4),
	String(null()) };

static void sMarkStatics() {
	MarkMember(FileOutput_obj::file_close);
	MarkMember(FileOutput_obj::file_seek);
	MarkMember(FileOutput_obj::file_tell);
	MarkMember(FileOutput_obj::file_flush);
	MarkMember(FileOutput_obj::file_write);
	MarkMember(FileOutput_obj::file_write_char);
};

Class FileOutput_obj::__mClass;

void FileOutput_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"cpp.io.FileOutput",17), TCanCast<FileOutput_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void FileOutput_obj::__boot()
{
	Static(file_close) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_close",10),1);
	Static(file_seek) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_seek",9),3);
	Static(file_tell) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_tell",9),1);
	Static(file_flush) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_flush",10),1);
	Static(file_write) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_write",10),4);
	Static(file_write_char) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_write_char",15),2);
}

} // end namespace cpp
} // end namespace io
