#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_abc_ABCData
#include <format/abc/ABCData.h>
#endif
#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_Name
#include <format/abc/Name.h>
#endif
#ifndef INCLUDED_format_abc_Namespace
#include <format/abc/Namespace.h>
#endif
namespace format{
namespace abc{

Void ABCData_obj::__construct()
{
{
}
;
	return null();
}

ABCData_obj::~ABCData_obj() { }

Dynamic ABCData_obj::__CreateEmpty() { return  new ABCData_obj; }
hxObjectPtr<ABCData_obj > ABCData_obj::__new()
{  hxObjectPtr<ABCData_obj > result = new ABCData_obj();
	result->__construct();
	return result;}

Dynamic ABCData_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<ABCData_obj > result = new ABCData_obj();
	result->__construct();
	return result;}

Dynamic ABCData_obj::get( Array<Dynamic > t,format::abc::Index i){
	struct _Function_1{
		static Dynamic Block( format::abc::Index &i,Array<Dynamic > &t)/* DEF (not block)(ret intern) */{
			format::abc::Index _switch_1 = (i);
			switch((_switch_1)->GetIndex()){
				case 0: {
					int n = _switch_1->__Param(0);
{
						return t->__get(n - 1);
					}
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(i,t);
}


DEFINE_DYNAMIC_FUNC2(ABCData_obj,get,return )


ABCData_obj::ABCData_obj()
{
	InitMember(ints);
	InitMember(uints);
	InitMember(floats);
	InitMember(strings);
	InitMember(namespaces);
	InitMember(nssets);
	InitMember(names);
	InitMember(methodTypes);
	InitMember(metadatas);
	InitMember(classes);
	InitMember(inits);
	InitMember(functions);
}

void ABCData_obj::__Mark()
{
	MarkMember(ints);
	MarkMember(uints);
	MarkMember(floats);
	MarkMember(strings);
	MarkMember(namespaces);
	MarkMember(nssets);
	MarkMember(names);
	MarkMember(methodTypes);
	MarkMember(metadatas);
	MarkMember(classes);
	MarkMember(inits);
	MarkMember(functions);
}

Dynamic ABCData_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"get",sizeof(wchar_t)*3) ) { return get_dyn(); }
		break;
	case 4:
		if (!memcmp(inName.__s,L"ints",sizeof(wchar_t)*4) ) { return ints; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"uints",sizeof(wchar_t)*5) ) { return uints; }
		if (!memcmp(inName.__s,L"names",sizeof(wchar_t)*5) ) { return names; }
		if (!memcmp(inName.__s,L"inits",sizeof(wchar_t)*5) ) { return inits; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"floats",sizeof(wchar_t)*6) ) { return floats; }
		if (!memcmp(inName.__s,L"nssets",sizeof(wchar_t)*6) ) { return nssets; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"strings",sizeof(wchar_t)*7) ) { return strings; }
		if (!memcmp(inName.__s,L"classes",sizeof(wchar_t)*7) ) { return classes; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"metadatas",sizeof(wchar_t)*9) ) { return metadatas; }
		if (!memcmp(inName.__s,L"functions",sizeof(wchar_t)*9) ) { return functions; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"namespaces",sizeof(wchar_t)*10) ) { return namespaces; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"methodTypes",sizeof(wchar_t)*11) ) { return methodTypes; }
	}
	return super::__Field(inName);
}

static int __id_ints = __hxcpp_field_to_id("ints");
static int __id_uints = __hxcpp_field_to_id("uints");
static int __id_floats = __hxcpp_field_to_id("floats");
static int __id_strings = __hxcpp_field_to_id("strings");
static int __id_namespaces = __hxcpp_field_to_id("namespaces");
static int __id_nssets = __hxcpp_field_to_id("nssets");
static int __id_names = __hxcpp_field_to_id("names");
static int __id_methodTypes = __hxcpp_field_to_id("methodTypes");
static int __id_metadatas = __hxcpp_field_to_id("metadatas");
static int __id_classes = __hxcpp_field_to_id("classes");
static int __id_inits = __hxcpp_field_to_id("inits");
static int __id_functions = __hxcpp_field_to_id("functions");
static int __id_get = __hxcpp_field_to_id("get");


Dynamic ABCData_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_ints) return ints;
	if (inFieldID==__id_uints) return uints;
	if (inFieldID==__id_floats) return floats;
	if (inFieldID==__id_strings) return strings;
	if (inFieldID==__id_namespaces) return namespaces;
	if (inFieldID==__id_nssets) return nssets;
	if (inFieldID==__id_names) return names;
	if (inFieldID==__id_methodTypes) return methodTypes;
	if (inFieldID==__id_metadatas) return metadatas;
	if (inFieldID==__id_classes) return classes;
	if (inFieldID==__id_inits) return inits;
	if (inFieldID==__id_functions) return functions;
	if (inFieldID==__id_get) return get_dyn();
	return super::__IField(inFieldID);
}

Dynamic ABCData_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 4:
		if (!memcmp(inName.__s,L"ints",sizeof(wchar_t)*4) ) { ints=inValue.Cast<Array<cpp::CppInt32__ > >();return inValue; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"uints",sizeof(wchar_t)*5) ) { uints=inValue.Cast<Array<cpp::CppInt32__ > >();return inValue; }
		if (!memcmp(inName.__s,L"names",sizeof(wchar_t)*5) ) { names=inValue.Cast<Array<format::abc::Name > >();return inValue; }
		if (!memcmp(inName.__s,L"inits",sizeof(wchar_t)*5) ) { inits=inValue.Cast<Array<Dynamic > >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"floats",sizeof(wchar_t)*6) ) { floats=inValue.Cast<Array<double > >();return inValue; }
		if (!memcmp(inName.__s,L"nssets",sizeof(wchar_t)*6) ) { nssets=inValue.Cast<Array<Array<format::abc::Index > > >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"strings",sizeof(wchar_t)*7) ) { strings=inValue.Cast<Array<String > >();return inValue; }
		if (!memcmp(inName.__s,L"classes",sizeof(wchar_t)*7) ) { classes=inValue.Cast<Array<Dynamic > >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"metadatas",sizeof(wchar_t)*9) ) { metadatas=inValue.Cast<Array<Dynamic > >();return inValue; }
		if (!memcmp(inName.__s,L"functions",sizeof(wchar_t)*9) ) { functions=inValue.Cast<Array<Dynamic > >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"namespaces",sizeof(wchar_t)*10) ) { namespaces=inValue.Cast<Array<format::abc::Namespace > >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"methodTypes",sizeof(wchar_t)*11) ) { methodTypes=inValue.Cast<Array<Dynamic > >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void ABCData_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"ints",4));
	outFields->push(STRING(L"uints",5));
	outFields->push(STRING(L"floats",6));
	outFields->push(STRING(L"strings",7));
	outFields->push(STRING(L"namespaces",10));
	outFields->push(STRING(L"nssets",6));
	outFields->push(STRING(L"names",5));
	outFields->push(STRING(L"methodTypes",11));
	outFields->push(STRING(L"metadatas",9));
	outFields->push(STRING(L"classes",7));
	outFields->push(STRING(L"inits",5));
	outFields->push(STRING(L"functions",9));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"ints",4),
	STRING(L"uints",5),
	STRING(L"floats",6),
	STRING(L"strings",7),
	STRING(L"namespaces",10),
	STRING(L"nssets",6),
	STRING(L"names",5),
	STRING(L"methodTypes",11),
	STRING(L"metadatas",9),
	STRING(L"classes",7),
	STRING(L"inits",5),
	STRING(L"functions",9),
	STRING(L"get",3),
	String(null()) };

static void sMarkStatics() {
};

Class ABCData_obj::__mClass;

void ABCData_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.abc.ABCData",18), TCanCast<ABCData_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void ABCData_obj::__boot()
{
}

} // end namespace format
} // end namespace abc
