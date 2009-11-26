#include <hxObject.h>

#ifndef INCLUDED_format_tools__InflateImpl_State
#include <format/tools/_InflateImpl/State.h>
#endif
namespace format{
namespace tools{
namespace _InflateImpl{

State State_obj::Block;

State State_obj::CData;

State State_obj::Crc;

State State_obj::Dist;

State State_obj::DistOne;

State State_obj::Done;

State State_obj::Flat;

State State_obj::Head;

DEFINE_CREATE_ENUM(State_obj)

int State_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"Block",5)) return 1;
	if (inName==STRING(L"CData",5)) return 2;
	if (inName==STRING(L"Crc",3)) return 4;
	if (inName==STRING(L"Dist",4)) return 5;
	if (inName==STRING(L"DistOne",7)) return 6;
	if (inName==STRING(L"Done",4)) return 7;
	if (inName==STRING(L"Flat",4)) return 3;
	if (inName==STRING(L"Head",4)) return 0;
	return super::__FindIndex(inName);
}

int State_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"Block",5)) return 0;
	if (inName==STRING(L"CData",5)) return 0;
	if (inName==STRING(L"Crc",3)) return 0;
	if (inName==STRING(L"Dist",4)) return 0;
	if (inName==STRING(L"DistOne",7)) return 0;
	if (inName==STRING(L"Done",4)) return 0;
	if (inName==STRING(L"Flat",4)) return 0;
	if (inName==STRING(L"Head",4)) return 0;
	return super::__FindArgCount(inName);
}

Dynamic State_obj::__Field(const String &inName)
{
	if (inName==STRING(L"Block",5)) return Block;
	if (inName==STRING(L"CData",5)) return CData;
	if (inName==STRING(L"Crc",3)) return Crc;
	if (inName==STRING(L"Dist",4)) return Dist;
	if (inName==STRING(L"DistOne",7)) return DistOne;
	if (inName==STRING(L"Done",4)) return Done;
	if (inName==STRING(L"Flat",4)) return Flat;
	if (inName==STRING(L"Head",4)) return Head;
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"Block",5),
	STRING(L"CData",5),
	STRING(L"Crc",3),
	STRING(L"Dist",4),
	STRING(L"DistOne",7),
	STRING(L"Done",4),
	STRING(L"Flat",4),
	STRING(L"Head",4),
	String(null()) };

static void sMarkStatics() {
	MarkMember(State_obj::Block);
	MarkMember(State_obj::CData);
	MarkMember(State_obj::Crc);
	MarkMember(State_obj::Dist);
	MarkMember(State_obj::DistOne);
	MarkMember(State_obj::Done);
	MarkMember(State_obj::Flat);
	MarkMember(State_obj::Head);
};

static String sMemberFields[] = { String(null()) };
Class State_obj::__mClass;

Dynamic __Create_State_obj() { return new State_obj; }

void State_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.tools._InflateImpl.State",31), TCanCast<State_obj >,sStaticFields,sMemberFields,
	&__Create_State_obj, &__Create,
	&super::__SGetClass(), &CreateState_obj, sMarkStatics);
}

void State_obj::__boot()
{
Static(Block) = CreateEnum<State_obj >(STRING(L"Block",5),1);
Static(CData) = CreateEnum<State_obj >(STRING(L"CData",5),2);
Static(Crc) = CreateEnum<State_obj >(STRING(L"Crc",3),4);
Static(Dist) = CreateEnum<State_obj >(STRING(L"Dist",4),5);
Static(DistOne) = CreateEnum<State_obj >(STRING(L"DistOne",7),6);
Static(Done) = CreateEnum<State_obj >(STRING(L"Done",4),7);
Static(Flat) = CreateEnum<State_obj >(STRING(L"Flat",4),3);
Static(Head) = CreateEnum<State_obj >(STRING(L"Head",4),0);
}


} // end namespace format
} // end namespace tools
} // end namespace _InflateImpl
