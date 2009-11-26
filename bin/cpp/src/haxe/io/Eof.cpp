#include <hxObject.h>

#ifndef INCLUDED_haxe_io_Eof
#include <haxe/io/Eof.h>
#endif
namespace haxe{
namespace io{

Void Eof_obj::__construct()
{
{
}
;
	return null();
}

Eof_obj::~Eof_obj() { }

Dynamic Eof_obj::__CreateEmpty() { return  new Eof_obj; }
hxObjectPtr<Eof_obj > Eof_obj::__new()
{  hxObjectPtr<Eof_obj > result = new Eof_obj();
	result->__construct();
	return result;}

Dynamic Eof_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Eof_obj > result = new Eof_obj();
	result->__construct();
	return result;}

String Eof_obj::toString( ){
	return STRING(L"Eof",3);
}


DEFINE_DYNAMIC_FUNC0(Eof_obj,toString,return )


Eof_obj::Eof_obj()
{
}

void Eof_obj::__Mark()
{
}

Dynamic Eof_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 8:
		if (!memcmp(inName.__s,L"toString",sizeof(wchar_t)*8) ) { return toString_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_toString = __hxcpp_field_to_id("toString");


Dynamic Eof_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_toString) return toString_dyn();
	return super::__IField(inFieldID);
}

Dynamic Eof_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void Eof_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"toString",8),
	String(null()) };

static void sMarkStatics() {
};

Class Eof_obj::__mClass;

void Eof_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"haxe.io.Eof",11), TCanCast<Eof_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Eof_obj::__boot()
{
}

} // end namespace haxe
} // end namespace io
