#include <hxObject.h>

#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
#ifndef INCLUDED_cpp_io_FileInput
#include <cpp/io/FileInput.h>
#endif
#ifndef INCLUDED_cpp_io_FileSeek
#include <cpp/io/FileSeek.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Eof
#include <haxe/io/Eof.h>
#endif
#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace cpp{
namespace io{

Void FileInput_obj::__construct(Dynamic f)
{
{
	this->__f = f;
}
;
	return null();
}

FileInput_obj::~FileInput_obj() { }

Dynamic FileInput_obj::__CreateEmpty() { return  new FileInput_obj; }
hxObjectPtr<FileInput_obj > FileInput_obj::__new(Dynamic f)
{  hxObjectPtr<FileInput_obj > result = new FileInput_obj();
	result->__construct(f);
	return result;}

Dynamic FileInput_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<FileInput_obj > result = new FileInput_obj();
	result->__construct(inArgs[0]);
	return result;}

int FileInput_obj::readByte( ){
	struct _Function_1{
		static int Block( cpp::io::FileInput_obj *__this)/* DEF (not block)(ret intern) */{
			try{
				return cpp::io::FileInput_obj::file_read_char(__this->__f);
			}
			catch(Dynamic __e){
				{
					Dynamic e = __e;{
						return e->__IsArray() ? int( hxThrow (haxe::io::Eof_obj::__new()) ) : int( hxThrow (haxe::io::Error_obj::Custom(e)) );
					}
				}
			}
		}
	};
	return _Function_1::Block(this);
}


DEFINE_DYNAMIC_FUNC0(FileInput_obj,readByte,return )

int FileInput_obj::readBytes( haxe::io::Bytes s,int p,int l){
	struct _Function_1{
		static int Block( cpp::io::FileInput_obj *__this,haxe::io::Bytes &s,int &p,int &l)/* DEF (not block)(ret intern) */{
			try{
				return cpp::io::FileInput_obj::file_read(__this->__f,s->b,p,l);
			}
			catch(Dynamic __e){
				{
					Dynamic e = __e;{
						return e->__IsArray() ? int( hxThrow (haxe::io::Eof_obj::__new()) ) : int( hxThrow (haxe::io::Error_obj::Custom(e)) );
					}
				}
			}
		}
	};
	return _Function_1::Block(this,s,p,l);
}


DEFINE_DYNAMIC_FUNC3(FileInput_obj,readBytes,return )

Void FileInput_obj::close( ){
{
		this->super::close();
		cpp::io::FileInput_obj::file_close(this->__f);
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(FileInput_obj,close,(void))

Void FileInput_obj::seek( int p,cpp::io::FileSeek pos){
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
		cpp::io::FileInput_obj::file_seek(this->__f,p,_Function_1::Block(pos));
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(FileInput_obj,seek,(void))

int FileInput_obj::tell( ){
	return cpp::io::FileInput_obj::file_tell(this->__f);
}


DEFINE_DYNAMIC_FUNC0(FileInput_obj,tell,return )

bool FileInput_obj::eof( ){
	return cpp::io::FileInput_obj::file_eof(this->__f);
}


DEFINE_DYNAMIC_FUNC0(FileInput_obj,eof,return )

Dynamic FileInput_obj::file_eof;

Dynamic FileInput_obj::file_read;

Dynamic FileInput_obj::file_read_char;

Dynamic FileInput_obj::file_close;

Dynamic FileInput_obj::file_seek;

Dynamic FileInput_obj::file_tell;


FileInput_obj::FileInput_obj()
{
	InitMember(__f);
}

void FileInput_obj::__Mark()
{
	MarkMember(__f);
	super::__Mark();
}

Dynamic FileInput_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"__f",sizeof(wchar_t)*3) ) { return __f; }
		if (!memcmp(inName.__s,L"eof",sizeof(wchar_t)*3) ) { return eof_dyn(); }
		break;
	case 4:
		if (!memcmp(inName.__s,L"seek",sizeof(wchar_t)*4) ) { return seek_dyn(); }
		if (!memcmp(inName.__s,L"tell",sizeof(wchar_t)*4) ) { return tell_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"close",sizeof(wchar_t)*5) ) { return close_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"file_eof",sizeof(wchar_t)*8) ) { return file_eof; }
		if (!memcmp(inName.__s,L"readByte",sizeof(wchar_t)*8) ) { return readByte_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"file_read",sizeof(wchar_t)*9) ) { return file_read; }
		if (!memcmp(inName.__s,L"file_seek",sizeof(wchar_t)*9) ) { return file_seek; }
		if (!memcmp(inName.__s,L"file_tell",sizeof(wchar_t)*9) ) { return file_tell; }
		if (!memcmp(inName.__s,L"readBytes",sizeof(wchar_t)*9) ) { return readBytes_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"file_close",sizeof(wchar_t)*10) ) { return file_close; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"file_read_char",sizeof(wchar_t)*14) ) { return file_read_char; }
	}
	return super::__Field(inName);
}

static int __id_file_eof = __hxcpp_field_to_id("file_eof");
static int __id_file_read = __hxcpp_field_to_id("file_read");
static int __id_file_read_char = __hxcpp_field_to_id("file_read_char");
static int __id_file_close = __hxcpp_field_to_id("file_close");
static int __id_file_seek = __hxcpp_field_to_id("file_seek");
static int __id_file_tell = __hxcpp_field_to_id("file_tell");
static int __id___f = __hxcpp_field_to_id("__f");
static int __id_readByte = __hxcpp_field_to_id("readByte");
static int __id_readBytes = __hxcpp_field_to_id("readBytes");
static int __id_close = __hxcpp_field_to_id("close");
static int __id_seek = __hxcpp_field_to_id("seek");
static int __id_tell = __hxcpp_field_to_id("tell");
static int __id_eof = __hxcpp_field_to_id("eof");


Dynamic FileInput_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_file_eof) return file_eof;
	if (inFieldID==__id_file_read) return file_read;
	if (inFieldID==__id_file_read_char) return file_read_char;
	if (inFieldID==__id_file_close) return file_close;
	if (inFieldID==__id_file_seek) return file_seek;
	if (inFieldID==__id_file_tell) return file_tell;
	if (inFieldID==__id___f) return __f;
	if (inFieldID==__id_readByte) return readByte_dyn();
	if (inFieldID==__id_readBytes) return readBytes_dyn();
	if (inFieldID==__id_close) return close_dyn();
	if (inFieldID==__id_seek) return seek_dyn();
	if (inFieldID==__id_tell) return tell_dyn();
	if (inFieldID==__id_eof) return eof_dyn();
	return super::__IField(inFieldID);
}

Dynamic FileInput_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"__f",sizeof(wchar_t)*3) ) { __f=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"file_eof",sizeof(wchar_t)*8) ) { file_eof=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"file_read",sizeof(wchar_t)*9) ) { file_read=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"file_seek",sizeof(wchar_t)*9) ) { file_seek=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"file_tell",sizeof(wchar_t)*9) ) { file_tell=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"file_close",sizeof(wchar_t)*10) ) { file_close=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"file_read_char",sizeof(wchar_t)*14) ) { file_read_char=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void FileInput_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"__f",3));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"file_eof",8),
	STRING(L"file_read",9),
	STRING(L"file_read_char",14),
	STRING(L"file_close",10),
	STRING(L"file_seek",9),
	STRING(L"file_tell",9),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"__f",3),
	STRING(L"readByte",8),
	STRING(L"readBytes",9),
	STRING(L"close",5),
	STRING(L"seek",4),
	STRING(L"tell",4),
	STRING(L"eof",3),
	String(null()) };

static void sMarkStatics() {
	MarkMember(FileInput_obj::file_eof);
	MarkMember(FileInput_obj::file_read);
	MarkMember(FileInput_obj::file_read_char);
	MarkMember(FileInput_obj::file_close);
	MarkMember(FileInput_obj::file_seek);
	MarkMember(FileInput_obj::file_tell);
};

Class FileInput_obj::__mClass;

void FileInput_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"cpp.io.FileInput",16), TCanCast<FileInput_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void FileInput_obj::__boot()
{
	Static(file_eof) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_eof",8),1);
	Static(file_read) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_read",9),4);
	Static(file_read_char) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_read_char",14),1);
	Static(file_close) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_close",10),1);
	Static(file_seek) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_seek",9),3);
	Static(file_tell) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"file_tell",9),1);
}

} // end namespace cpp
} // end namespace io
