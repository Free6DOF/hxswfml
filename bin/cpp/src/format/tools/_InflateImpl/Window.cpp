#include <hxObject.h>

#ifndef INCLUDED_format_tools_Adler32
#include <format/tools/Adler32.h>
#endif
#ifndef INCLUDED_format_tools__InflateImpl_Window
#include <format/tools/_InflateImpl/Window.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
namespace format{
namespace tools{
namespace _InflateImpl{

Void Window_obj::__construct()
{
{
	this->buffer = haxe::io::Bytes_obj::alloc(65536);
	this->pos = 0;
	this->crc = format::tools::Adler32_obj::__new();
}
;
	return null();
}

Window_obj::~Window_obj() { }

Dynamic Window_obj::__CreateEmpty() { return  new Window_obj; }
hxObjectPtr<Window_obj > Window_obj::__new()
{  hxObjectPtr<Window_obj > result = new Window_obj();
	result->__construct();
	return result;}

Dynamic Window_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Window_obj > result = new Window_obj();
	result->__construct();
	return result;}

Void Window_obj::slide( ){
{
		this->crc->update(this->buffer,0,32768);
		haxe::io::Bytes b = haxe::io::Bytes_obj::alloc(65536);
		hxSubEq(this->pos,32768);
		b->blit(0,this->buffer,32768,this->pos);
		this->buffer = b;
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Window_obj,slide,(void))

Void Window_obj::addBytes( haxe::io::Bytes b,int p,int len){
{
		if (this->pos + len > 65536)
			this->slide();
		this->buffer->blit(this->pos,b,p,len);
		hxAddEq(this->pos,len);
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(Window_obj,addBytes,(void))

Void Window_obj::addByte( int c){
{
		if (this->pos == 65536)
			this->slide();
		this->buffer->b[this->pos] = c;
		this->pos++;
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Window_obj,addByte,(void))

int Window_obj::getLastChar( ){
	return this->buffer->b->__get(this->pos - 1);
}


DEFINE_DYNAMIC_FUNC0(Window_obj,getLastChar,return )

int Window_obj::available( ){
	return this->pos;
}


DEFINE_DYNAMIC_FUNC0(Window_obj,available,return )

format::tools::Adler32 Window_obj::checksum( ){
	this->crc->update(this->buffer,0,this->pos);
	return this->crc;
}


DEFINE_DYNAMIC_FUNC0(Window_obj,checksum,return )

int Window_obj::SIZE;

int Window_obj::BUFSIZE;


Window_obj::Window_obj()
{
	InitMember(buffer);
	InitMember(pos);
	InitMember(crc);
}

void Window_obj::__Mark()
{
	MarkMember(buffer);
	MarkMember(pos);
	MarkMember(crc);
}

Dynamic Window_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"pos",sizeof(wchar_t)*3) ) { return pos; }
		if (!memcmp(inName.__s,L"crc",sizeof(wchar_t)*3) ) { return crc; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"SIZE",sizeof(wchar_t)*4) ) { return SIZE; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"slide",sizeof(wchar_t)*5) ) { return slide_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"buffer",sizeof(wchar_t)*6) ) { return buffer; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"BUFSIZE",sizeof(wchar_t)*7) ) { return BUFSIZE; }
		if (!memcmp(inName.__s,L"addByte",sizeof(wchar_t)*7) ) { return addByte_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"addBytes",sizeof(wchar_t)*8) ) { return addBytes_dyn(); }
		if (!memcmp(inName.__s,L"checksum",sizeof(wchar_t)*8) ) { return checksum_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"available",sizeof(wchar_t)*9) ) { return available_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"getLastChar",sizeof(wchar_t)*11) ) { return getLastChar_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_SIZE = __hxcpp_field_to_id("SIZE");
static int __id_BUFSIZE = __hxcpp_field_to_id("BUFSIZE");
static int __id_buffer = __hxcpp_field_to_id("buffer");
static int __id_pos = __hxcpp_field_to_id("pos");
static int __id_crc = __hxcpp_field_to_id("crc");
static int __id_slide = __hxcpp_field_to_id("slide");
static int __id_addBytes = __hxcpp_field_to_id("addBytes");
static int __id_addByte = __hxcpp_field_to_id("addByte");
static int __id_getLastChar = __hxcpp_field_to_id("getLastChar");
static int __id_available = __hxcpp_field_to_id("available");
static int __id_checksum = __hxcpp_field_to_id("checksum");


Dynamic Window_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_SIZE) return SIZE;
	if (inFieldID==__id_BUFSIZE) return BUFSIZE;
	if (inFieldID==__id_buffer) return buffer;
	if (inFieldID==__id_pos) return pos;
	if (inFieldID==__id_crc) return crc;
	if (inFieldID==__id_slide) return slide_dyn();
	if (inFieldID==__id_addBytes) return addBytes_dyn();
	if (inFieldID==__id_addByte) return addByte_dyn();
	if (inFieldID==__id_getLastChar) return getLastChar_dyn();
	if (inFieldID==__id_available) return available_dyn();
	if (inFieldID==__id_checksum) return checksum_dyn();
	return super::__IField(inFieldID);
}

Dynamic Window_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"pos",sizeof(wchar_t)*3) ) { pos=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"crc",sizeof(wchar_t)*3) ) { crc=inValue.Cast<format::tools::Adler32 >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"SIZE",sizeof(wchar_t)*4) ) { SIZE=inValue.Cast<int >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"buffer",sizeof(wchar_t)*6) ) { buffer=inValue.Cast<haxe::io::Bytes >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"BUFSIZE",sizeof(wchar_t)*7) ) { BUFSIZE=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Window_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"buffer",6));
	outFields->push(STRING(L"pos",3));
	outFields->push(STRING(L"crc",3));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"SIZE",4),
	STRING(L"BUFSIZE",7),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"buffer",6),
	STRING(L"pos",3),
	STRING(L"crc",3),
	STRING(L"slide",5),
	STRING(L"addBytes",8),
	STRING(L"addByte",7),
	STRING(L"getLastChar",11),
	STRING(L"available",9),
	STRING(L"checksum",8),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Window_obj::SIZE);
	MarkMember(Window_obj::BUFSIZE);
};

Class Window_obj::__mClass;

void Window_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools._InflateImpl.Window",32), TCanCast<Window_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Window_obj::__boot()
{
	Static(SIZE) = 32768;
	Static(BUFSIZE) = 65536;
}

} // end namespace format
} // end namespace tools
} // end namespace _InflateImpl
