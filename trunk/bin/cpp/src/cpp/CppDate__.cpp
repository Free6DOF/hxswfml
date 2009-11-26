#include <hxObject.h>

#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_cpp_CppDate__
#include <cpp/CppDate__.h>
#endif
namespace cpp{

Void CppDate___obj::__construct(int year,int month,int day,int hour,int min,int sec)
{
{
	this->mSeconds = ::__hxcpp_new_date(year,month,day,hour,min,sec);
}
;
	return null();
}

CppDate___obj::~CppDate___obj() { }

Dynamic CppDate___obj::__CreateEmpty() { return  new CppDate___obj; }
hxObjectPtr<CppDate___obj > CppDate___obj::__new(int year,int month,int day,int hour,int min,int sec)
{  hxObjectPtr<CppDate___obj > result = new CppDate___obj();
	result->__construct(year,month,day,hour,min,sec);
	return result;}

Dynamic CppDate___obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<CppDate___obj > result = new CppDate___obj();
	result->__construct(inArgs[0],inArgs[1],inArgs[2],inArgs[3],inArgs[4],inArgs[5]);
	return result;}

double CppDate___obj::getTime( ){
	return this->mSeconds * 1000.0;
}


DEFINE_DYNAMIC_FUNC0(CppDate___obj,getTime,return )

int CppDate___obj::getHours( ){
	return ::__hxcpp_get_hours(this->mSeconds);
}


DEFINE_DYNAMIC_FUNC0(CppDate___obj,getHours,return )

int CppDate___obj::getMinutes( ){
	return ::__hxcpp_get_minutes(this->mSeconds);
}


DEFINE_DYNAMIC_FUNC0(CppDate___obj,getMinutes,return )

int CppDate___obj::getSeconds( ){
	return ::__hxcpp_get_seconds(this->mSeconds);
}


DEFINE_DYNAMIC_FUNC0(CppDate___obj,getSeconds,return )

int CppDate___obj::getFullYear( ){
	return ::__hxcpp_get_year(this->mSeconds);
}


DEFINE_DYNAMIC_FUNC0(CppDate___obj,getFullYear,return )

int CppDate___obj::getMonth( ){
	return ::__hxcpp_get_month(this->mSeconds);
}


DEFINE_DYNAMIC_FUNC0(CppDate___obj,getMonth,return )

int CppDate___obj::getDate( ){
	return ::__hxcpp_get_date(this->mSeconds);
}


DEFINE_DYNAMIC_FUNC0(CppDate___obj,getDate,return )

int CppDate___obj::getDay( ){
	return ::__hxcpp_get_day(this->mSeconds);
}


DEFINE_DYNAMIC_FUNC0(CppDate___obj,getDay,return )

String CppDate___obj::toString( ){
	return ::__hxcpp_to_string(this->mSeconds);
}


DEFINE_DYNAMIC_FUNC0(CppDate___obj,toString,return )

cpp::CppDate__ CppDate___obj::now( ){
	return cpp::CppDate___obj::fromTime(::__hxcpp_date_now() * 1000.0);
}


STATIC_DEFINE_DYNAMIC_FUNC0(CppDate___obj,now,return )

cpp::CppDate__ CppDate___obj::fromTime( double t){
	cpp::CppDate__ result = cpp::CppDate___obj::__new(0,0,0,0,0,0);
	result->mSeconds = t * 0.001;
	return result;
}


STATIC_DEFINE_DYNAMIC_FUNC1(CppDate___obj,fromTime,return )

cpp::CppDate__ CppDate___obj::fromString( String s){
	switch( (int)(s.length)){
		case 8: {
			Array<String > k = s.split(STRING(L":",1));
			cpp::CppDate__ d = cpp::CppDate___obj::__new(0,0,0,Std_obj::parseInt(k->__get(0)),Std_obj::parseInt(k->__get(1)),Std_obj::parseInt(k->__get(2)));
			return d;
		}
		break;
		case 10: {
			Array<String > k = s.split(STRING(L"-",1));
			return cpp::CppDate___obj::__new(Std_obj::parseInt(k->__get(0)),Std_obj::parseInt(k->__get(1)) - 1,Std_obj::parseInt(k->__get(2)),0,0,0);
		}
		break;
		case 19: {
			Array<String > k = s.split(STRING(L" ",1));
			Array<String > y = k[0].split(STRING(L"-",1));
			Array<String > t = k[1].split(STRING(L":",1));
			return cpp::CppDate___obj::__new(Std_obj::parseInt(y->__get(0)),Std_obj::parseInt(y->__get(1)) - 1,Std_obj::parseInt(y->__get(2)),Std_obj::parseInt(t->__get(0)),Std_obj::parseInt(t->__get(1)),Std_obj::parseInt(t->__get(2)));
		}
		break;
		default: {
			hxThrow (STRING(L"Invalid date format : ",22) + s);
		}
	}
	return null();
}


STATIC_DEFINE_DYNAMIC_FUNC1(CppDate___obj,fromString,return )


CppDate___obj::CppDate___obj()
{
	InitMember(mSeconds);
}

void CppDate___obj::__Mark()
{
	MarkMember(mSeconds);
}

Dynamic CppDate___obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"now",sizeof(wchar_t)*3) ) { return now_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"getDay",sizeof(wchar_t)*6) ) { return getDay_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"getTime",sizeof(wchar_t)*7) ) { return getTime_dyn(); }
		if (!memcmp(inName.__s,L"getDate",sizeof(wchar_t)*7) ) { return getDate_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"fromTime",sizeof(wchar_t)*8) ) { return fromTime_dyn(); }
		if (!memcmp(inName.__s,L"mSeconds",sizeof(wchar_t)*8) ) { return mSeconds; }
		if (!memcmp(inName.__s,L"getHours",sizeof(wchar_t)*8) ) { return getHours_dyn(); }
		if (!memcmp(inName.__s,L"getMonth",sizeof(wchar_t)*8) ) { return getMonth_dyn(); }
		if (!memcmp(inName.__s,L"toString",sizeof(wchar_t)*8) ) { return toString_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"fromString",sizeof(wchar_t)*10) ) { return fromString_dyn(); }
		if (!memcmp(inName.__s,L"getMinutes",sizeof(wchar_t)*10) ) { return getMinutes_dyn(); }
		if (!memcmp(inName.__s,L"getSeconds",sizeof(wchar_t)*10) ) { return getSeconds_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"getFullYear",sizeof(wchar_t)*11) ) { return getFullYear_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_now = __hxcpp_field_to_id("now");
static int __id_fromTime = __hxcpp_field_to_id("fromTime");
static int __id_fromString = __hxcpp_field_to_id("fromString");
static int __id_mSeconds = __hxcpp_field_to_id("mSeconds");
static int __id_getTime = __hxcpp_field_to_id("getTime");
static int __id_getHours = __hxcpp_field_to_id("getHours");
static int __id_getMinutes = __hxcpp_field_to_id("getMinutes");
static int __id_getSeconds = __hxcpp_field_to_id("getSeconds");
static int __id_getFullYear = __hxcpp_field_to_id("getFullYear");
static int __id_getMonth = __hxcpp_field_to_id("getMonth");
static int __id_getDate = __hxcpp_field_to_id("getDate");
static int __id_getDay = __hxcpp_field_to_id("getDay");
static int __id_toString = __hxcpp_field_to_id("toString");


Dynamic CppDate___obj::__IField(int inFieldID)
{
	if (inFieldID==__id_now) return now_dyn();
	if (inFieldID==__id_fromTime) return fromTime_dyn();
	if (inFieldID==__id_fromString) return fromString_dyn();
	if (inFieldID==__id_mSeconds) return mSeconds;
	if (inFieldID==__id_getTime) return getTime_dyn();
	if (inFieldID==__id_getHours) return getHours_dyn();
	if (inFieldID==__id_getMinutes) return getMinutes_dyn();
	if (inFieldID==__id_getSeconds) return getSeconds_dyn();
	if (inFieldID==__id_getFullYear) return getFullYear_dyn();
	if (inFieldID==__id_getMonth) return getMonth_dyn();
	if (inFieldID==__id_getDate) return getDate_dyn();
	if (inFieldID==__id_getDay) return getDay_dyn();
	if (inFieldID==__id_toString) return toString_dyn();
	return super::__IField(inFieldID);
}

Dynamic CppDate___obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 8:
		if (!memcmp(inName.__s,L"mSeconds",sizeof(wchar_t)*8) ) { mSeconds=inValue.Cast<double >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void CppDate___obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"mSeconds",8));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"now",3),
	STRING(L"fromTime",8),
	STRING(L"fromString",10),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"mSeconds",8),
	STRING(L"getTime",7),
	STRING(L"getHours",8),
	STRING(L"getMinutes",10),
	STRING(L"getSeconds",10),
	STRING(L"getFullYear",11),
	STRING(L"getMonth",8),
	STRING(L"getDate",7),
	STRING(L"getDay",6),
	STRING(L"toString",8),
	String(null()) };

static void sMarkStatics() {
};

Class CppDate___obj::__mClass;

void CppDate___obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"Date",4), TCanCast<CppDate___obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void CppDate___obj::__boot()
{
}

} // end namespace cpp
