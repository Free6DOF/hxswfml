#include <hxObject.h>

#ifndef INCLUDED_format_swf_Layer
#include <format/swf/Layer.h>
#endif
namespace format{
namespace swf{

Layer Layer_obj::Layer1;

Layer Layer_obj::Layer2;

Layer Layer_obj::Layer3;

Layer Layer_obj::LayerReserved;

DEFINE_CREATE_ENUM(Layer_obj)

int Layer_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"Layer1",6)) return 3;
	if (inName==STRING(L"Layer2",6)) return 2;
	if (inName==STRING(L"Layer3",6)) return 1;
	if (inName==STRING(L"LayerReserved",13)) return 0;
	return super::__FindIndex(inName);
}

int Layer_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"Layer1",6)) return 0;
	if (inName==STRING(L"Layer2",6)) return 0;
	if (inName==STRING(L"Layer3",6)) return 0;
	if (inName==STRING(L"LayerReserved",13)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic Layer_obj::__Field(const String &inName)
{
	if (inName==STRING(L"Layer1",6)) return Layer1;
	if (inName==STRING(L"Layer2",6)) return Layer2;
	if (inName==STRING(L"Layer3",6)) return Layer3;
	if (inName==STRING(L"LayerReserved",13)) return LayerReserved;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"Layer1",6),
	STRING(L"Layer2",6),
	STRING(L"Layer3",6),
	STRING(L"LayerReserved",13),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Layer_obj::Layer1);
	MarkMember(Layer_obj::Layer2);
	MarkMember(Layer_obj::Layer3);
	MarkMember(Layer_obj::LayerReserved);
};

static String sMemberFields[] = { String(null()) };
Class Layer_obj::__mClass;

Dynamic __Create_Layer_obj() { return new Layer_obj; }

void Layer_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.Layer",16), TCanCast<Layer_obj >,sStaticFields,sMemberFields,
	&__Create_Layer_obj, &__Create,
	&super::__SGetClass(), &CreateLayer_obj, sMarkStatics);
}

void Layer_obj::__boot()
{
Static(Layer1) = CreateEnum<Layer_obj >(STRING(L"Layer1",6),3);
Static(Layer2) = CreateEnum<Layer_obj >(STRING(L"Layer2",6),2);
Static(Layer3) = CreateEnum<Layer_obj >(STRING(L"Layer3",6),1);
Static(LayerReserved) = CreateEnum<Layer_obj >(STRING(L"LayerReserved",13),0);
}


} // end namespace format
} // end namespace swf
