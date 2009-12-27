#include <hxObject.h>

#ifndef INCLUDED_be_haxer_hxswfml_HXswfML
#include <be/haxer/hxswfml/HXswfML.h>
#endif
#ifndef INCLUDED_be_haxer_hxswfml_Hxvml
#include <be/haxer/hxswfml/Hxvml.h>
#endif
#ifndef INCLUDED_be_haxer_hxswfml_Main
#include <be/haxer/hxswfml/Main.h>
#endif
#ifndef INCLUDED_cpp_FileSystem
#include <cpp/FileSystem.h>
#endif
#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
#ifndef INCLUDED_cpp_Sys
#include <cpp/Sys.h>
#endif
#ifndef INCLUDED_cpp_io_File
#include <cpp/io/File.h>
#endif
#ifndef INCLUDED_cpp_io_FileOutput
#include <cpp/io/FileOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace be{
namespace haxer{
namespace hxswfml{

Void Main_obj::__construct()
{
	return null();
}

Main_obj::~Main_obj() { }

Dynamic Main_obj::__CreateEmpty() { return  new Main_obj; }
hxObjectPtr<Main_obj > Main_obj::__new()
{  hxObjectPtr<Main_obj > result = new Main_obj();
	result->__construct();
	return result;}

Dynamic Main_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Main_obj > result = new Main_obj();
	result->__construct();
	return result;}

Void Main_obj::main( ){
{
		Array<String > args = cpp::Sys_obj::args();
		if (args->length < 2){
			if (args->__get(0) == STRING(L"abc2xml",7)){
				cpp::Lib_obj::println(STRING(L"Usage : hxswfml abc2xml inputfile outputfile",44));
				cpp::Lib_obj::println(STRING(L"inputfile : swf file containing actionscript bytecode",53));
				cpp::Lib_obj::println(STRING(L"outputfile : xml file",21));
				cpp::Sys_obj::exit(1);
			}
			else{
				cpp::Lib_obj::println(STRING(L"Usage : hxswfml inputfile outputfile [true|false]",49));
				cpp::Lib_obj::println(STRING(L"inputfile : text file containing xml",36));
				cpp::Lib_obj::println(STRING(L"outputfile : swf or swc file",28));
				cpp::Lib_obj::println(STRING(L"[true|false] : set to false to bypass checks. Default is true",61));
				cpp::Sys_obj::exit(1);
			}
		}
		else{
			if (args->__get(0) == STRING(L"abc2xml",7)){
				if (!cpp::FileSystem_obj::exists(args->__get(1))){
					cpp::Lib_obj::println(STRING(L"!ERROR: File ",13) + args->__get(1) + STRING(L" could not be found at the given location.",42));
					cpp::Sys_obj::exit(1);
				}
				else{
					be::haxer::hxswfml::Hxvml hxvml = be::haxer::hxswfml::Hxvml_obj::__new();
					String xml = hxvml->abc2xml(args->__get(1));
					cpp::io::FileOutput file = cpp::io::File_obj::write(args->__get(2),false);
					file->writeString(xml);
					file->close();
				}
			}
			else{
				if (cpp::FileSystem_obj::exists(args->__get(0))){
					bool strict = true;
					if (bool(args->__get(2) != null()) && bool(args->__get(2) != STRING(L"true",4)))
						strict = false;
					be::haxer::hxswfml::HXswfML hxswfml = be::haxer::hxswfml::HXswfML_obj::__new(strict);
					haxe::io::Bytes swf = hxswfml->xml2swf(cpp::io::File_obj::getContent(args->__get(0)),args->__get(1));
					cpp::io::FileOutput file = cpp::io::File_obj::write(args->__get(1),true);
					file->write(swf);
					file->close();
				}
				else{
					cpp::Lib_obj::println(STRING(L"!ERROR: File ",13) + args->__get(0) + STRING(L" could not be found at the given location.",42));
					cpp::Sys_obj::exit(1);
				}
			}
		}
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC0(Main_obj,main,(void))


Main_obj::Main_obj()
{
}

void Main_obj::__Mark()
{
}

Dynamic Main_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 4:
		if (!memcmp(inName.__s,L"main",sizeof(wchar_t)*4) ) { return main_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_main = __hxcpp_field_to_id("main");


Dynamic Main_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_main) return main_dyn();
	return super::__IField(inFieldID);
}

Dynamic Main_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void Main_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"main",4),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
};

Class Main_obj::__mClass;

void Main_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"be.haxer.hxswfml.Main",21), TCanCast<Main_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Main_obj::__boot()
{
}

} // end namespace be
} // end namespace haxer
} // end namespace hxswfml
