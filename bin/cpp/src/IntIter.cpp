#include <hxObject.h>

#ifndef INCLUDED_IntIter
#include <IntIter.h>
#endif

Void IntIter_obj::__construct(int min,int max)
{
{
	this->min = min;
	this->max = max;
}
;
	return null();
}

IntIter_obj::~IntIter_obj() { }

Dynamic IntIter_obj::__CreateEmpty() { return  new IntIter_obj; }
hxObjectPtr<IntIter_obj > IntIter_obj::__new(int min,int max)
{  hxObjectPtr<IntIter_obj > result = new IntIter_obj();
	result->__construct(min,max);
	return result;}

Dynamic IntIter_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<IntIter_obj > result = new IntIter_obj();
	result->__construct(inArgs[0],inArgs[1]);
	return result;}

bool IntIter_obj::hasNext( ){
	return this->min < this->max;
}


DEFINE_DYNAMIC_FUNC0(IntIter_obj,hasNext,return )

int IntIter_obj::next( ){
	return this->min++;
}


DEFINE_DYNAMIC_FUNC0(IntIter_obj,next,return )


IntIter_obj::IntIter_obj()
{
	InitMember(min);
	InitMember(max);
}

void IntIter_obj::__Mark()
{
	MarkMember(min);
	MarkMember(max);
}

Dynamic IntIter_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"min",sizeof(wchar_t)*3) ) { return min; }
		if (!memcmp(inName.__s,L"max",sizeof(wchar_t)*3) ) { return max; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"next",sizeof(wchar_t)*4) ) { return next_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"hasNext",sizeof(wchar_t)*7) ) { return hasNext_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_min = __hxcpp_field_to_id("min");
static int __id_max = __hxcpp_field_to_id("max");
static int __id_hasNext = __hxcpp_field_to_id("hasNext");
static int __id_next = __hxcpp_field_to_id("next");


Dynamic IntIter_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_min) return min;
	if (inFieldID==__id_max) return max;
	if (inFieldID==__id_hasNext) return hasNext_dyn();
	if (inFieldID==__id_next) return next_dyn();
	return super::__IField(inFieldID);
}

Dynamic IntIter_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"min",sizeof(wchar_t)*3) ) { min=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"max",sizeof(wchar_t)*3) ) { max=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void IntIter_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"min",3));
	outFields->push(STRING(L"max",3));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"min",3),
	STRING(L"max",3),
	STRING(L"hasNext",7),
	STRING(L"next",4),
	String(null()) };

static void sMarkStatics() {
};

Class IntIter_obj::__mClass;

void IntIter_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"IntIter",7), TCanCast<IntIter_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void IntIter_obj::__boot()
{
}

