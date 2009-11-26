#include <hxObject.h>

#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesBuffer
#include <haxe/io/BytesBuffer.h>
#endif
#ifndef INCLUDED_haxe_io_BytesOutput
#include <haxe/io/BytesOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace haxe{
namespace io{

Void BytesOutput_obj::__construct()
{
{
	this->b = haxe::io::BytesBuffer_obj::__new();
}
;
	return null();
}

BytesOutput_obj::~BytesOutput_obj() { }

Dynamic BytesOutput_obj::__CreateEmpty() { return  new BytesOutput_obj; }
hxObjectPtr<BytesOutput_obj > BytesOutput_obj::__new()
{  hxObjectPtr<BytesOutput_obj > result = new BytesOutput_obj();
	result->__construct();
	return result;}

Dynamic BytesOutput_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<BytesOutput_obj > result = new BytesOutput_obj();
	result->__construct();
	return result;}

Void BytesOutput_obj::writeByte( int c){
{
		this->b->b->push(c);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(BytesOutput_obj,writeByte,(void))

int BytesOutput_obj::writeBytes( haxe::io::Bytes buf,int pos,int len){
	{
		haxe::io::BytesBuffer _g = this->b;
		if (bool(pos < 0) || bool(bool(len < 0) || bool(pos + len > buf->length)))
			hxThrow (haxe::io::Error_obj::OutsideBounds);
		Array<unsigned char > b1 = _g->b;
		Array<unsigned char > b2 = buf->b;
		{
			int _g1 = pos;
			int _g2 = pos + len;
			while(_g1 < _g2){
				int i = _g1++;
				_g->b->push(b2->__get(i));
			}
		}
	}
	return len;
}


DEFINE_DYNAMIC_FUNC3(BytesOutput_obj,writeBytes,return )

haxe::io::Bytes BytesOutput_obj::getBytes( ){
	return this->b->getBytes();
}


DEFINE_DYNAMIC_FUNC0(BytesOutput_obj,getBytes,return )


BytesOutput_obj::BytesOutput_obj()
{
	InitMember(b);
}

void BytesOutput_obj::__Mark()
{
	MarkMember(b);
	super::__Mark();
}

Dynamic BytesOutput_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"b",sizeof(wchar_t)*1) ) { return b; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"getBytes",sizeof(wchar_t)*8) ) { return getBytes_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"writeByte",sizeof(wchar_t)*9) ) { return writeByte_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"writeBytes",sizeof(wchar_t)*10) ) { return writeBytes_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_b = __hxcpp_field_to_id("b");
static int __id_writeByte = __hxcpp_field_to_id("writeByte");
static int __id_writeBytes = __hxcpp_field_to_id("writeBytes");
static int __id_getBytes = __hxcpp_field_to_id("getBytes");


Dynamic BytesOutput_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_b) return b;
	if (inFieldID==__id_writeByte) return writeByte_dyn();
	if (inFieldID==__id_writeBytes) return writeBytes_dyn();
	if (inFieldID==__id_getBytes) return getBytes_dyn();
	return super::__IField(inFieldID);
}

Dynamic BytesOutput_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"b",sizeof(wchar_t)*1) ) { b=inValue.Cast<haxe::io::BytesBuffer >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void BytesOutput_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"b",1));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"b",1),
	STRING(L"writeByte",9),
	STRING(L"writeBytes",10),
	STRING(L"getBytes",8),
	String(null()) };

static void sMarkStatics() {
};

Class BytesOutput_obj::__mClass;

void BytesOutput_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"haxe.io.BytesOutput",19), TCanCast<BytesOutput_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void BytesOutput_obj::__boot()
{
}

} // end namespace haxe
} // end namespace io
