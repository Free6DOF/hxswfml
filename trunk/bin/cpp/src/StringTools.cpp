#include <hxObject.h>

#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_StringTools
#include <StringTools.h>
#endif

Void StringTools_obj::__construct()
{
	return null();
}

StringTools_obj::~StringTools_obj() { }

Dynamic StringTools_obj::__CreateEmpty() { return  new StringTools_obj; }
hxObjectPtr<StringTools_obj > StringTools_obj::__new()
{  hxObjectPtr<StringTools_obj > result = new StringTools_obj();
	result->__construct();
	return result;}

Dynamic StringTools_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<StringTools_obj > result = new StringTools_obj();
	result->__construct();
	return result;}

String StringTools_obj::urlEncode( String s){
	return s.__URLEncode();
}


STATIC_DEFINE_DYNAMIC_FUNC1(StringTools_obj,urlEncode,return )

String StringTools_obj::urlDecode( String s){
	return s.__URLDecode();
}


STATIC_DEFINE_DYNAMIC_FUNC1(StringTools_obj,urlDecode,return )

String StringTools_obj::htmlEscape( String s){
	return s.split(STRING(L"&",1))->join(STRING(L"&amp;",5)).split(STRING(L"<",1))->join(STRING(L"&lt;",4)).split(STRING(L">",1))->join(STRING(L"&gt;",4));
}


STATIC_DEFINE_DYNAMIC_FUNC1(StringTools_obj,htmlEscape,return )

String StringTools_obj::htmlUnescape( String s){
	return s.split(STRING(L"&gt;",4))->join(STRING(L">",1)).split(STRING(L"&lt;",4))->join(STRING(L"<",1)).split(STRING(L"&amp;",5))->join(STRING(L"&",1));
}


STATIC_DEFINE_DYNAMIC_FUNC1(StringTools_obj,htmlUnescape,return )

bool StringTools_obj::startsWith( String s,String start){
	return (bool(s.length >= start.length) && bool(s.substr(0,start.length) == start));
}


STATIC_DEFINE_DYNAMIC_FUNC2(StringTools_obj,startsWith,return )

bool StringTools_obj::endsWith( String s,String end){
	int elen = end.length;
	int slen = s.length;
	return (bool(slen >= elen) && bool(s.substr(slen - elen,elen) == end));
}


STATIC_DEFINE_DYNAMIC_FUNC2(StringTools_obj,endsWith,return )

bool StringTools_obj::isSpace( String s,int pos){
	Dynamic c = s.charCodeAt(pos);
	return bool((bool(c >= 9) && bool(c <= 13))) || bool(c == 32);
}


STATIC_DEFINE_DYNAMIC_FUNC2(StringTools_obj,isSpace,return )

String StringTools_obj::ltrim( String s){
	int l = s.length;
	int r = 0;
	while(bool(r < l) && bool(StringTools_obj::isSpace(s,r))){
		r++;
	}
	if (r > 0)
		return s.substr(r,l - r);
	else
		return s;
;
}


STATIC_DEFINE_DYNAMIC_FUNC1(StringTools_obj,ltrim,return )

String StringTools_obj::rtrim( String s){
	int l = s.length;
	int r = 0;
	while(bool(r < l) && bool(StringTools_obj::isSpace(s,l - r - 1))){
		r++;
	}
	if (r > 0){
		return s.substr(0,l - r);
	}
	else{
		return s;
	}
}


STATIC_DEFINE_DYNAMIC_FUNC1(StringTools_obj,rtrim,return )

String StringTools_obj::trim( String s){
	return StringTools_obj::ltrim(StringTools_obj::rtrim(s));
}


STATIC_DEFINE_DYNAMIC_FUNC1(StringTools_obj,trim,return )

String StringTools_obj::rpad( String s,String c,int l){
	int sl = s.length;
	int cl = c.length;
	while(sl < l){
		if (l - sl < cl){
			hxAddEq(s,c.substr(0,l - sl));
			sl = l;
		}
		else{
			hxAddEq(s,c);
			hxAddEq(sl,cl);
		}
	}
	return s;
}


STATIC_DEFINE_DYNAMIC_FUNC3(StringTools_obj,rpad,return )

String StringTools_obj::lpad( String s,String c,int l){
	String ns = STRING(L"",0);
	int sl = s.length;
	if (sl >= l)
		return s;
	int cl = c.length;
	while(sl < l){
		if (l - sl < cl){
			hxAddEq(ns,c.substr(0,l - sl));
			sl = l;
		}
		else{
			hxAddEq(ns,c);
			hxAddEq(sl,cl);
		}
	}
	return ns + s;
}


STATIC_DEFINE_DYNAMIC_FUNC3(StringTools_obj,lpad,return )

String StringTools_obj::replace( String s,String sub,String by){
	return s.split(sub)->join(by);
}


STATIC_DEFINE_DYNAMIC_FUNC3(StringTools_obj,replace,return )

String StringTools_obj::hex( int n,Dynamic digits){
	bool neg = false;
	if (n < 0){
		neg = true;
		n = -n;
	}
	String s = STRING(L"",0);
	String hexChars = STRING(L"0123456789ABCDEF",16);
	do{
		s = hexChars.charAt(hxMod(n,16)) + s;
		n = Std_obj::toInt(double(n) / double(16));
	}
while(n > 0);
	if (digits != null())
		while(s.length < digits)s = STRING(L"0",1) + s;
	if (neg)
		s = STRING(L"-",1) + s;
	return s;
}


STATIC_DEFINE_DYNAMIC_FUNC2(StringTools_obj,hex,return )


StringTools_obj::StringTools_obj()
{
}

void StringTools_obj::__Mark()
{
}

Dynamic StringTools_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"hex",sizeof(wchar_t)*3) ) { return hex_dyn(); }
		break;
	case 4:
		if (!memcmp(inName.__s,L"trim",sizeof(wchar_t)*4) ) { return trim_dyn(); }
		if (!memcmp(inName.__s,L"rpad",sizeof(wchar_t)*4) ) { return rpad_dyn(); }
		if (!memcmp(inName.__s,L"lpad",sizeof(wchar_t)*4) ) { return lpad_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"ltrim",sizeof(wchar_t)*5) ) { return ltrim_dyn(); }
		if (!memcmp(inName.__s,L"rtrim",sizeof(wchar_t)*5) ) { return rtrim_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"isSpace",sizeof(wchar_t)*7) ) { return isSpace_dyn(); }
		if (!memcmp(inName.__s,L"replace",sizeof(wchar_t)*7) ) { return replace_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"endsWith",sizeof(wchar_t)*8) ) { return endsWith_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"urlEncode",sizeof(wchar_t)*9) ) { return urlEncode_dyn(); }
		if (!memcmp(inName.__s,L"urlDecode",sizeof(wchar_t)*9) ) { return urlDecode_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"htmlEscape",sizeof(wchar_t)*10) ) { return htmlEscape_dyn(); }
		if (!memcmp(inName.__s,L"startsWith",sizeof(wchar_t)*10) ) { return startsWith_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"htmlUnescape",sizeof(wchar_t)*12) ) { return htmlUnescape_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_urlEncode = __hxcpp_field_to_id("urlEncode");
static int __id_urlDecode = __hxcpp_field_to_id("urlDecode");
static int __id_htmlEscape = __hxcpp_field_to_id("htmlEscape");
static int __id_htmlUnescape = __hxcpp_field_to_id("htmlUnescape");
static int __id_startsWith = __hxcpp_field_to_id("startsWith");
static int __id_endsWith = __hxcpp_field_to_id("endsWith");
static int __id_isSpace = __hxcpp_field_to_id("isSpace");
static int __id_ltrim = __hxcpp_field_to_id("ltrim");
static int __id_rtrim = __hxcpp_field_to_id("rtrim");
static int __id_trim = __hxcpp_field_to_id("trim");
static int __id_rpad = __hxcpp_field_to_id("rpad");
static int __id_lpad = __hxcpp_field_to_id("lpad");
static int __id_replace = __hxcpp_field_to_id("replace");
static int __id_hex = __hxcpp_field_to_id("hex");


Dynamic StringTools_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_urlEncode) return urlEncode_dyn();
	if (inFieldID==__id_urlDecode) return urlDecode_dyn();
	if (inFieldID==__id_htmlEscape) return htmlEscape_dyn();
	if (inFieldID==__id_htmlUnescape) return htmlUnescape_dyn();
	if (inFieldID==__id_startsWith) return startsWith_dyn();
	if (inFieldID==__id_endsWith) return endsWith_dyn();
	if (inFieldID==__id_isSpace) return isSpace_dyn();
	if (inFieldID==__id_ltrim) return ltrim_dyn();
	if (inFieldID==__id_rtrim) return rtrim_dyn();
	if (inFieldID==__id_trim) return trim_dyn();
	if (inFieldID==__id_rpad) return rpad_dyn();
	if (inFieldID==__id_lpad) return lpad_dyn();
	if (inFieldID==__id_replace) return replace_dyn();
	if (inFieldID==__id_hex) return hex_dyn();
	return super::__IField(inFieldID);
}

Dynamic StringTools_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void StringTools_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"urlEncode",9),
	STRING(L"urlDecode",9),
	STRING(L"htmlEscape",10),
	STRING(L"htmlUnescape",12),
	STRING(L"startsWith",10),
	STRING(L"endsWith",8),
	STRING(L"isSpace",7),
	STRING(L"ltrim",5),
	STRING(L"rtrim",5),
	STRING(L"trim",4),
	STRING(L"rpad",4),
	STRING(L"lpad",4),
	STRING(L"replace",7),
	STRING(L"hex",3),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
};

Class StringTools_obj::__mClass;

void StringTools_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"StringTools",11), TCanCast<StringTools_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void StringTools_obj::__boot()
{
}

