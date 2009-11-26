#include <hxObject.h>

#ifndef INCLUDED_Type
#include <Type.h>
#endif
#ifndef INCLUDED_ValueType
#include <ValueType.h>
#endif

Void Type_obj::__construct()
{
	return null();
}

Type_obj::~Type_obj() { }

Dynamic Type_obj::__CreateEmpty() { return  new Type_obj; }
hxObjectPtr<Type_obj > Type_obj::__new()
{  hxObjectPtr<Type_obj > result = new Type_obj();
	result->__construct();
	return result;}

Dynamic Type_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Type_obj > result = new Type_obj();
	result->__construct();
	return result;}

Class Type_obj::getClass( Dynamic o){
	return o->__GetClass();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,getClass,return )

Enum Type_obj::getEnum( Dynamic o){
	if (!o->__Field(STRING(L"__IsEnum",8))())
		return null();
	return o;
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,getEnum,return )

Class Type_obj::getSuperClass( Class c){
	return c->GetSuper();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,getSuperClass,return )

String Type_obj::getClassName( Class c){
	if (c == null())
		return null();
	return c->mName;
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,getClassName,return )

String Type_obj::getEnumName( Enum e){
	return e->__ToString();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,getEnumName,return )

Class Type_obj::resolveClass( String name){
	return Class_obj::Resolve(name);
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,resolveClass,return )

Enum Type_obj::resolveEnum( String name){
	return Class_obj::Resolve(name);
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,resolveEnum,return )

Dynamic Type_obj::createInstance( Class cl,Array<Dynamic > args){
	if (cl != null())
		return cl->mConstructArgs(args);
	return null();
}


STATIC_DEFINE_DYNAMIC_FUNC2(Type_obj,createInstance,return )

Dynamic Type_obj::createEmptyInstance( Class cl){
	return cl->mConstructEmpty();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,createEmptyInstance,return )

Dynamic Type_obj::createEnum( Enum e,String constr,Array<Dynamic > params){
	if (e->mConstructEnum != null())
		return e->mConstructEnum(constr,params);
	return null();
}


STATIC_DEFINE_DYNAMIC_FUNC3(Type_obj,createEnum,return )

Dynamic Type_obj::createEnumIndex( Enum e,int index,Array<Dynamic > params){
	String c = Type_obj::getEnumConstructs(e)->__get(index);
	if (c == null())
		hxThrow (index + STRING(L" is not a valid enum constructor index",38));
	return Type_obj::createEnum(e,c,params);
}


STATIC_DEFINE_DYNAMIC_FUNC3(Type_obj,createEnumIndex,return )

Array<String > Type_obj::getInstanceFields( Class c){
	return c->GetInstanceFields();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,getInstanceFields,return )

Array<String > Type_obj::getClassFields( Class c){
	return c->GetClassFields();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,getClassFields,return )

Array<String > Type_obj::getEnumConstructs( Enum e){
	return e->GetClassFields();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,getEnumConstructs,return )

ValueType Type_obj::_typeof( Dynamic v){
	if (v == null())
		return ValueType_obj::TNull;
	int t = v->__GetType();
	int _switch_1 = (t);
	if (  ( _switch_1==::vtBool)){
		return ValueType_obj::TBool;
	}
	else if (  ( _switch_1==::vtInt)){
		return ValueType_obj::TInt;
	}
	else if (  ( _switch_1==::vtFloat)){
		return ValueType_obj::TFloat;
	}
	else if (  ( _switch_1==::vtFunction)){
		return ValueType_obj::TFunction;
	}
	else if (  ( _switch_1==::vtObject)){
		return ValueType_obj::TObject;
	}
	else if (  ( _switch_1==::vtEnum)){
		return ValueType_obj::TEnum(v->__GetClass());
	}
	else  {
		return ValueType_obj::TClass(v->__GetClass());
	}
;
;
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,_typeof,return )

bool Type_obj::enumEq( Dynamic a,Dynamic b){
	if (a == b)
		return true;
	return a == b;
	return true;
}


STATIC_DEFINE_DYNAMIC_FUNC2(Type_obj,enumEq,return )

String Type_obj::enumConstructor( Dynamic e){
	return e->__Tag();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,enumConstructor,return )

Array<Dynamic > Type_obj::enumParameters( Dynamic e){
	return e->__EnumParams();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,enumParameters,return )

int Type_obj::enumIndex( Dynamic e){
	return e->__Index();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Type_obj,enumIndex,return )


Type_obj::Type_obj()
{
}

void Type_obj::__Mark()
{
}

Dynamic Type_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 6:
		if (!memcmp(inName.__s,L"typeof",sizeof(wchar_t)*6) ) { return _typeof_dyn(); }
		if (!memcmp(inName.__s,L"enumEq",sizeof(wchar_t)*6) ) { return enumEq_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"getEnum",sizeof(wchar_t)*7) ) { return getEnum_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"getClass",sizeof(wchar_t)*8) ) { return getClass_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"enumIndex",sizeof(wchar_t)*9) ) { return enumIndex_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"createEnum",sizeof(wchar_t)*10) ) { return createEnum_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"getEnumName",sizeof(wchar_t)*11) ) { return getEnumName_dyn(); }
		if (!memcmp(inName.__s,L"resolveEnum",sizeof(wchar_t)*11) ) { return resolveEnum_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"getClassName",sizeof(wchar_t)*12) ) { return getClassName_dyn(); }
		if (!memcmp(inName.__s,L"resolveClass",sizeof(wchar_t)*12) ) { return resolveClass_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"getSuperClass",sizeof(wchar_t)*13) ) { return getSuperClass_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"createInstance",sizeof(wchar_t)*14) ) { return createInstance_dyn(); }
		if (!memcmp(inName.__s,L"getClassFields",sizeof(wchar_t)*14) ) { return getClassFields_dyn(); }
		if (!memcmp(inName.__s,L"enumParameters",sizeof(wchar_t)*14) ) { return enumParameters_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"createEnumIndex",sizeof(wchar_t)*15) ) { return createEnumIndex_dyn(); }
		if (!memcmp(inName.__s,L"enumConstructor",sizeof(wchar_t)*15) ) { return enumConstructor_dyn(); }
		break;
	case 17:
		if (!memcmp(inName.__s,L"getInstanceFields",sizeof(wchar_t)*17) ) { return getInstanceFields_dyn(); }
		if (!memcmp(inName.__s,L"getEnumConstructs",sizeof(wchar_t)*17) ) { return getEnumConstructs_dyn(); }
		break;
	case 19:
		if (!memcmp(inName.__s,L"createEmptyInstance",sizeof(wchar_t)*19) ) { return createEmptyInstance_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_getClass = __hxcpp_field_to_id("getClass");
static int __id_getEnum = __hxcpp_field_to_id("getEnum");
static int __id_getSuperClass = __hxcpp_field_to_id("getSuperClass");
static int __id_getClassName = __hxcpp_field_to_id("getClassName");
static int __id_getEnumName = __hxcpp_field_to_id("getEnumName");
static int __id_resolveClass = __hxcpp_field_to_id("resolveClass");
static int __id_resolveEnum = __hxcpp_field_to_id("resolveEnum");
static int __id_createInstance = __hxcpp_field_to_id("createInstance");
static int __id_createEmptyInstance = __hxcpp_field_to_id("createEmptyInstance");
static int __id_createEnum = __hxcpp_field_to_id("createEnum");
static int __id_createEnumIndex = __hxcpp_field_to_id("createEnumIndex");
static int __id_getInstanceFields = __hxcpp_field_to_id("getInstanceFields");
static int __id_getClassFields = __hxcpp_field_to_id("getClassFields");
static int __id_getEnumConstructs = __hxcpp_field_to_id("getEnumConstructs");
static int __id__typeof = __hxcpp_field_to_id("typeof");
static int __id_enumEq = __hxcpp_field_to_id("enumEq");
static int __id_enumConstructor = __hxcpp_field_to_id("enumConstructor");
static int __id_enumParameters = __hxcpp_field_to_id("enumParameters");
static int __id_enumIndex = __hxcpp_field_to_id("enumIndex");


Dynamic Type_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_getClass) return getClass_dyn();
	if (inFieldID==__id_getEnum) return getEnum_dyn();
	if (inFieldID==__id_getSuperClass) return getSuperClass_dyn();
	if (inFieldID==__id_getClassName) return getClassName_dyn();
	if (inFieldID==__id_getEnumName) return getEnumName_dyn();
	if (inFieldID==__id_resolveClass) return resolveClass_dyn();
	if (inFieldID==__id_resolveEnum) return resolveEnum_dyn();
	if (inFieldID==__id_createInstance) return createInstance_dyn();
	if (inFieldID==__id_createEmptyInstance) return createEmptyInstance_dyn();
	if (inFieldID==__id_createEnum) return createEnum_dyn();
	if (inFieldID==__id_createEnumIndex) return createEnumIndex_dyn();
	if (inFieldID==__id_getInstanceFields) return getInstanceFields_dyn();
	if (inFieldID==__id_getClassFields) return getClassFields_dyn();
	if (inFieldID==__id_getEnumConstructs) return getEnumConstructs_dyn();
	if (inFieldID==__id__typeof) return _typeof_dyn();
	if (inFieldID==__id_enumEq) return enumEq_dyn();
	if (inFieldID==__id_enumConstructor) return enumConstructor_dyn();
	if (inFieldID==__id_enumParameters) return enumParameters_dyn();
	if (inFieldID==__id_enumIndex) return enumIndex_dyn();
	return super::__IField(inFieldID);
}

Dynamic Type_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	return super::__SetField(inName,inValue);
}

void Type_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"getClass",8),
	STRING(L"getEnum",7),
	STRING(L"getSuperClass",13),
	STRING(L"getClassName",12),
	STRING(L"getEnumName",11),
	STRING(L"resolveClass",12),
	STRING(L"resolveEnum",11),
	STRING(L"createInstance",14),
	STRING(L"createEmptyInstance",19),
	STRING(L"createEnum",10),
	STRING(L"createEnumIndex",15),
	STRING(L"getInstanceFields",17),
	STRING(L"getClassFields",14),
	STRING(L"getEnumConstructs",17),
	STRING(L"typeof",6),
	STRING(L"enumEq",6),
	STRING(L"enumConstructor",15),
	STRING(L"enumParameters",14),
	STRING(L"enumIndex",9),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
};

Class Type_obj::__mClass;

void Type_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"Type",4), TCanCast<Type_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Type_obj::__boot()
{
}

