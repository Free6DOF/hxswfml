#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_tools_CRC32
#include <format/tools/CRC32.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
namespace format{
namespace tools{

Void CRC32_obj::__construct()
{
{
	this->crc = cpp::CppInt32___obj::make(65535,65535);
}
;
	return null();
}

CRC32_obj::~CRC32_obj() { }

Dynamic CRC32_obj::__CreateEmpty() { return  new CRC32_obj; }
hxObjectPtr<CRC32_obj > CRC32_obj::__new()
{  hxObjectPtr<CRC32_obj > result = new CRC32_obj();
	result->__construct();
	return result;}

Dynamic CRC32_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<CRC32_obj > result = new CRC32_obj();
	result->__construct();
	return result;}

Void CRC32_obj::run( haxe::io::Bytes b){
{
		cpp::CppInt32__ crc = this->crc;
		cpp::CppInt32__ polynom = cpp::CppInt32___obj::make(60856,33568);
		{
			int _g1 = 0;
			int _g = b->length;
			while(_g1 < _g){
				int i = _g1++;
				cpp::CppInt32__ tmp = cpp::CppInt32___obj::_and(cpp::CppInt32___obj::_xor(crc,cpp::CppInt32___obj::ofInt(b->b->__get(i))),cpp::CppInt32___obj::ofInt(255));
				{
					int _g2 = 0;
					while(_g2 < 8){
						int j = _g2++;
						if (cpp::CppInt32___obj::_and(tmp,cpp::CppInt32___obj::ofInt(1)) == cpp::CppInt32___obj::ofInt(1))
							tmp = cpp::CppInt32___obj::_xor(cpp::CppInt32___obj::ushr(tmp,1),polynom);
						else
							tmp = cpp::CppInt32___obj::ushr(tmp,1);
;
					}
				}
				crc = cpp::CppInt32___obj::_xor(cpp::CppInt32___obj::ushr(crc,8),tmp);
			}
		}
		this->crc = crc;
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(CRC32_obj,run,(void))

Void CRC32_obj::byte( int b){
{
		cpp::CppInt32__ polynom = cpp::CppInt32___obj::make(60856,33568);
		cpp::CppInt32__ tmp = cpp::CppInt32___obj::_and(cpp::CppInt32___obj::_xor(this->crc,cpp::CppInt32___obj::ofInt(b)),cpp::CppInt32___obj::ofInt(255));
		{
			int _g = 0;
			while(_g < 8){
				int j = _g++;
				if (cpp::CppInt32___obj::_and(tmp,cpp::CppInt32___obj::ofInt(1)) == cpp::CppInt32___obj::ofInt(1))
					tmp = cpp::CppInt32___obj::_xor(cpp::CppInt32___obj::ushr(tmp,1),polynom);
				else
					tmp = cpp::CppInt32___obj::ushr(tmp,1);
;
			}
		}
		this->crc = cpp::CppInt32___obj::_xor(cpp::CppInt32___obj::ushr(this->crc,8),tmp);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(CRC32_obj,byte,(void))

cpp::CppInt32__ CRC32_obj::get( ){
	return cpp::CppInt32___obj::_xor(this->crc,cpp::CppInt32___obj::make(65535,65535));
}


DEFINE_DYNAMIC_FUNC0(CRC32_obj,get,return )

cpp::CppInt32__ CRC32_obj::POLYNOM;

cpp::CppInt32__ CRC32_obj::encode( haxe::io::Bytes b){
	format::tools::CRC32 c = format::tools::CRC32_obj::__new();
	c->run(b);
	return c->get();
}


STATIC_DEFINE_DYNAMIC_FUNC1(CRC32_obj,encode,return )


CRC32_obj::CRC32_obj()
{
	InitMember(crc);
}

void CRC32_obj::__Mark()
{
	MarkMember(crc);
}

Dynamic CRC32_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"crc",sizeof(wchar_t)*3) ) { return crc; }
		if (!memcmp(inName.__s,L"run",sizeof(wchar_t)*3) ) { return run_dyn(); }
		if (!memcmp(inName.__s,L"get",sizeof(wchar_t)*3) ) { return get_dyn(); }
		break;
	case 4:
		if (!memcmp(inName.__s,L"byte",sizeof(wchar_t)*4) ) { return byte_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"encode",sizeof(wchar_t)*6) ) { return encode_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"POLYNOM",sizeof(wchar_t)*7) ) { return POLYNOM; }
	}
	return super::__Field(inName);
}

static int __id_POLYNOM = __hxcpp_field_to_id("POLYNOM");
static int __id_encode = __hxcpp_field_to_id("encode");
static int __id_crc = __hxcpp_field_to_id("crc");
static int __id_run = __hxcpp_field_to_id("run");
static int __id_byte = __hxcpp_field_to_id("byte");
static int __id_get = __hxcpp_field_to_id("get");


Dynamic CRC32_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_POLYNOM) return POLYNOM;
	if (inFieldID==__id_encode) return encode_dyn();
	if (inFieldID==__id_crc) return crc;
	if (inFieldID==__id_run) return run_dyn();
	if (inFieldID==__id_byte) return byte_dyn();
	if (inFieldID==__id_get) return get_dyn();
	return super::__IField(inFieldID);
}

Dynamic CRC32_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"crc",sizeof(wchar_t)*3) ) { crc=inValue.Cast<cpp::CppInt32__ >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"POLYNOM",sizeof(wchar_t)*7) ) { POLYNOM=inValue.Cast<cpp::CppInt32__ >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void CRC32_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"crc",3));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"POLYNOM",7),
	STRING(L"encode",6),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"crc",3),
	STRING(L"run",3),
	STRING(L"byte",4),
	STRING(L"get",3),
	String(null()) };

static void sMarkStatics() {
	MarkMember(CRC32_obj::POLYNOM);
};

Class CRC32_obj::__mClass;

void CRC32_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools.CRC32",18), TCanCast<CRC32_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void CRC32_obj::__boot()
{
	Static(POLYNOM) = cpp::CppInt32___obj::make(60856,33568);
}

} // end namespace format
} // end namespace tools
