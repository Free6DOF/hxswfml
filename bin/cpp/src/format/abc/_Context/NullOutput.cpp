#include <hxObject.h>

#ifndef INCLUDED_format_abc__Context_NullOutput
#include <format/abc/_Context/NullOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace format{
namespace abc{
namespace _Context{

Void NullOutput_obj::__construct()
{
{
	this->n = 0;
}
;
	return null();
}

NullOutput_obj::~NullOutput_obj() { }

Dynamic NullOutput_obj::__CreateEmpty() { return  new NullOutput_obj; }
hxObjectPtr<NullOutput_obj > NullOutput_obj::__new()
{  hxObjectPtr<NullOutput_obj > result = new NullOutput_obj();
	result->__construct();
	return result;}

Dynamic NullOutput_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<NullOutput_obj > result = new NullOutput_obj();
	result->__construct();
	return result;}

Void NullOutput_obj::writeByte( int c){
{
		this->n++;
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(NullOutput_obj,writeByte,(void))

int NullOutput_obj::writeBytes( haxe::io::Bytes b,int pos,int len){
	hxAddEq(this->n,len);
	return len;
}


DEFINE_DYNAMIC_FUNC3(NullOutput_obj,writeBytes,return )


NullOutput_obj::NullOutput_obj()
{
	InitMember(n);
}

void NullOutput_obj::__Mark()
{
	MarkMember(n);
	super::__Mark();
}

Dynamic NullOutput_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"n",sizeof(wchar_t)*1) ) { return n; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"writeByte",sizeof(wchar_t)*9) ) { return writeByte_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"writeBytes",sizeof(wchar_t)*10) ) { return writeBytes_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_n = __hxcpp_field_to_id("n");
static int __id_writeByte = __hxcpp_field_to_id("writeByte");
static int __id_writeBytes = __hxcpp_field_to_id("writeBytes");


Dynamic NullOutput_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_n) return n;
	if (inFieldID==__id_writeByte) return writeByte_dyn();
	if (inFieldID==__id_writeBytes) return writeBytes_dyn();
	return super::__IField(inFieldID);
}

Dynamic NullOutput_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"n",sizeof(wchar_t)*1) ) { n=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void NullOutput_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"n",1));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"n",1),
	STRING(L"writeByte",9),
	STRING(L"writeBytes",10),
	String(null()) };

static void sMarkStatics() {
};

Class NullOutput_obj::__mClass;

void NullOutput_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.abc._Context.NullOutput",30), TCanCast<NullOutput_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void NullOutput_obj::__boot()
{
}

} // end namespace format
} // end namespace abc
} // end namespace _Context
