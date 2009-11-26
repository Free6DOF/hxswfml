#include <hxObject.h>

#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesBuffer
#include <haxe/io/BytesBuffer.h>
#endif
#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
namespace haxe{
namespace io{

Void BytesBuffer_obj::__construct()
{
{
	this->b = Array_obj<unsigned char >::__new();
}
;
	return null();
}

BytesBuffer_obj::~BytesBuffer_obj() { }

Dynamic BytesBuffer_obj::__CreateEmpty() { return  new BytesBuffer_obj; }
hxObjectPtr<BytesBuffer_obj > BytesBuffer_obj::__new()
{  hxObjectPtr<BytesBuffer_obj > result = new BytesBuffer_obj();
	result->__construct();
	return result;}

Dynamic BytesBuffer_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<BytesBuffer_obj > result = new BytesBuffer_obj();
	result->__construct();
	return result;}

Void BytesBuffer_obj::addByte( int byte){
{
		this->b->push(byte);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(BytesBuffer_obj,addByte,(void))

Void BytesBuffer_obj::add( haxe::io::Bytes src){
{
		Array<unsigned char > b1 = this->b;
		Array<unsigned char > b2 = src->b;
		{
			int _g1 = 0;
			int _g = src->length;
			while(_g1 < _g){
				int i = _g1++;
				this->b->push(b2->__get(i));
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(BytesBuffer_obj,add,(void))

Void BytesBuffer_obj::addBytes( haxe::io::Bytes src,int pos,int len){
{
		if (bool(pos < 0) || bool(bool(len < 0) || bool(pos + len > src->length)))
			hxThrow (haxe::io::Error_obj::OutsideBounds);
		Array<unsigned char > b1 = this->b;
		Array<unsigned char > b2 = src->b;
		{
			int _g1 = pos;
			int _g = pos + len;
			while(_g1 < _g){
				int i = _g1++;
				this->b->push(b2->__get(i));
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(BytesBuffer_obj,addBytes,(void))

haxe::io::Bytes BytesBuffer_obj::getBytes( ){
	haxe::io::Bytes bytes = haxe::io::Bytes_obj::__new(this->b->length,this->b);
	this->b = null();
	return bytes;
}


DEFINE_DYNAMIC_FUNC0(BytesBuffer_obj,getBytes,return )


BytesBuffer_obj::BytesBuffer_obj()
{
	InitMember(b);
}

void BytesBuffer_obj::__Mark()
{
	MarkMember(b);
}

Dynamic BytesBuffer_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"b",sizeof(wchar_t)*1) ) { return b; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"add",sizeof(wchar_t)*3) ) { return add_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"addByte",sizeof(wchar_t)*7) ) { return addByte_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"addBytes",sizeof(wchar_t)*8) ) { return addBytes_dyn(); }
		if (!memcmp(inName.__s,L"getBytes",sizeof(wchar_t)*8) ) { return getBytes_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_b = __hxcpp_field_to_id("b");
static int __id_addByte = __hxcpp_field_to_id("addByte");
static int __id_add = __hxcpp_field_to_id("add");
static int __id_addBytes = __hxcpp_field_to_id("addBytes");
static int __id_getBytes = __hxcpp_field_to_id("getBytes");


Dynamic BytesBuffer_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_b) return b;
	if (inFieldID==__id_addByte) return addByte_dyn();
	if (inFieldID==__id_add) return add_dyn();
	if (inFieldID==__id_addBytes) return addBytes_dyn();
	if (inFieldID==__id_getBytes) return getBytes_dyn();
	return super::__IField(inFieldID);
}

Dynamic BytesBuffer_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"b",sizeof(wchar_t)*1) ) { b=inValue.Cast<Array<unsigned char > >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void BytesBuffer_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"b",1));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"b",1),
	STRING(L"addByte",7),
	STRING(L"add",3),
	STRING(L"addBytes",8),
	STRING(L"getBytes",8),
	String(null()) };

static void sMarkStatics() {
};

Class BytesBuffer_obj::__mClass;

void BytesBuffer_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"haxe.io.BytesBuffer",19), TCanCast<BytesBuffer_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void BytesBuffer_obj::__boot()
{
}

} // end namespace haxe
} // end namespace io
