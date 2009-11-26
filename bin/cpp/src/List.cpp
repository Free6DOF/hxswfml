#include <hxObject.h>

#ifndef INCLUDED_List
#include <List.h>
#endif
#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_StringBuf
#include <StringBuf.h>
#endif

Void List_obj::__construct()
{
{
	this->length = 0;
}
;
	return null();
}

List_obj::~List_obj() { }

Dynamic List_obj::__CreateEmpty() { return  new List_obj; }
hxObjectPtr<List_obj > List_obj::__new()
{  hxObjectPtr<List_obj > result = new List_obj();
	result->__construct();
	return result;}

Dynamic List_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<List_obj > result = new List_obj();
	result->__construct();
	return result;}

Void List_obj::add( Dynamic item){
{
		Array<Dynamic > x = Array_obj<Dynamic >::__new().Add(item);
		if (this->h == null())
			this->h = x;
		else
			this->q[1] = x;
;
		this->q = x;
		this->length++;
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(List_obj,add,(void))

Void List_obj::push( Dynamic item){
{
		Array<Dynamic > x = Array_obj<Dynamic >::__new().Add(item).Add(this->h);
		this->h = x;
		if (this->q == null())
			this->q = x;
		this->length++;
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(List_obj,push,(void))

Dynamic List_obj::first( ){
	return this->h == null() ? Dynamic( null() ) : Dynamic( this->h->__get(0) );
}


DEFINE_DYNAMIC_FUNC0(List_obj,first,return )

Dynamic List_obj::last( ){
	return this->q == null() ? Dynamic( null() ) : Dynamic( this->q->__get(0) );
}


DEFINE_DYNAMIC_FUNC0(List_obj,last,return )

Dynamic List_obj::pop( ){
	if (this->h == null())
		return null();
	Dynamic x = this->h->__get(0);
	this->h = this->h->__get(1);
	if (this->h == null())
		this->q = null();
	this->length--;
	return x;
}


DEFINE_DYNAMIC_FUNC0(List_obj,pop,return )

bool List_obj::isEmpty( ){
	return (this->h == null());
}


DEFINE_DYNAMIC_FUNC0(List_obj,isEmpty,return )

Void List_obj::clear( ){
{
		this->h = null();
		this->q = null();
		this->length = 0;
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(List_obj,clear,(void))

bool List_obj::remove( Dynamic v){
	Array<Dynamic > prev = null();
	Array<Dynamic > l = this->h;
	while(l != null()){
		if (l->__get(0) == v){
			if (prev == null())
				this->h = l->__get(1);
			else
				prev[1] = l->__get(1);
;
			if (this->q == l)
				this->q = prev;
			this->length--;
			return true;
		}
		prev = l;
		l = l->__get(1);
	}
	return false;
}


DEFINE_DYNAMIC_FUNC1(List_obj,remove,return )

Dynamic List_obj::iterator( ){

	BEGIN_LOCAL_FUNC0(_Function_1)
	Dynamic run(){
{
			return (__this->__Field(STRING(L"h",1)).Cast<Array<Dynamic > >() != null());
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC0(return)


	BEGIN_LOCAL_FUNC0(_Function_2)
	Dynamic run(){
{
			{
				if (__this->__Field(STRING(L"h",1)).Cast<Array<Dynamic > >() == null())
					return null();
				Dynamic x = __this->__Field(STRING(L"h",1)).Cast<Array<Dynamic > >()->__get(0);
				__this.FieldRef(STRING(L"h",1)) = __this->__Field(STRING(L"h",1)).Cast<Array<Dynamic > >()->__get(1);
				return x;
			}
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC0(return)

	return hxAnon_obj::Create()->Add( STRING(L"h",1) , this->h)->Add( STRING(L"hasNext",7) ,  Dynamic(new _Function_1()))->Add( STRING(L"next",4) ,  Dynamic(new _Function_2()));
}


DEFINE_DYNAMIC_FUNC0(List_obj,iterator,return )

String List_obj::toString( ){
	StringBuf s = StringBuf_obj::__new();
	bool first = true;
	Array<Dynamic > l = this->h;
	hxAddEq(s->b,STRING(L"{",1));
	while(l != null()){
		if (first)
			first = false;
		else
			hxAddEq(s->b,STRING(L", ",2));
;
		hxAddEq(s->b,Std_obj::string(l->__get(0)));
		l = l->__get(1);
	}
	hxAddEq(s->b,STRING(L"}",1));
	return s->b;
}


DEFINE_DYNAMIC_FUNC0(List_obj,toString,return )

String List_obj::join( String sep){
	StringBuf s = StringBuf_obj::__new();
	bool first = true;
	Array<Dynamic > l = this->h;
	while(l != null()){
		if (first)
			first = false;
		else
			hxAddEq(s->b,sep);
;
		hxAddEq(s->b,l->__get(0));
		l = l->__get(1);
	}
	return s->b;
}


DEFINE_DYNAMIC_FUNC1(List_obj,join,return )

List List_obj::filter( Dynamic f){
	List l2 = List_obj::__new();
	Array<Dynamic > l = this->h;
	while(l != null()){
		Dynamic v = l->__get(0);
		l = l->__get(1);
		if (f(v))
			l2->add(v);
	}
	return l2;
}


DEFINE_DYNAMIC_FUNC1(List_obj,filter,return )

List List_obj::map( Dynamic f){
	List b = List_obj::__new();
	Array<Dynamic > l = this->h;
	while(l != null()){
		Dynamic v = l->__get(0);
		l = l->__get(1);
		b->add(f(v));
	}
	return b;
}


DEFINE_DYNAMIC_FUNC1(List_obj,map,return )


List_obj::List_obj()
{
	InitMember(h);
	InitMember(q);
	InitMember(length);
}

void List_obj::__Mark()
{
	MarkMember(h);
	MarkMember(q);
	MarkMember(length);
}

Dynamic List_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"h",sizeof(wchar_t)*1) ) { return h; }
		if (!memcmp(inName.__s,L"q",sizeof(wchar_t)*1) ) { return q; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"add",sizeof(wchar_t)*3) ) { return add_dyn(); }
		if (!memcmp(inName.__s,L"pop",sizeof(wchar_t)*3) ) { return pop_dyn(); }
		if (!memcmp(inName.__s,L"map",sizeof(wchar_t)*3) ) { return map_dyn(); }
		break;
	case 4:
		if (!memcmp(inName.__s,L"push",sizeof(wchar_t)*4) ) { return push_dyn(); }
		if (!memcmp(inName.__s,L"last",sizeof(wchar_t)*4) ) { return last_dyn(); }
		if (!memcmp(inName.__s,L"join",sizeof(wchar_t)*4) ) { return join_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"first",sizeof(wchar_t)*5) ) { return first_dyn(); }
		if (!memcmp(inName.__s,L"clear",sizeof(wchar_t)*5) ) { return clear_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"length",sizeof(wchar_t)*6) ) { return length; }
		if (!memcmp(inName.__s,L"remove",sizeof(wchar_t)*6) ) { return remove_dyn(); }
		if (!memcmp(inName.__s,L"filter",sizeof(wchar_t)*6) ) { return filter_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"isEmpty",sizeof(wchar_t)*7) ) { return isEmpty_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"iterator",sizeof(wchar_t)*8) ) { return iterator_dyn(); }
		if (!memcmp(inName.__s,L"toString",sizeof(wchar_t)*8) ) { return toString_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_h = __hxcpp_field_to_id("h");
static int __id_q = __hxcpp_field_to_id("q");
static int __id_length = __hxcpp_field_to_id("length");
static int __id_add = __hxcpp_field_to_id("add");
static int __id_push = __hxcpp_field_to_id("push");
static int __id_first = __hxcpp_field_to_id("first");
static int __id_last = __hxcpp_field_to_id("last");
static int __id_pop = __hxcpp_field_to_id("pop");
static int __id_isEmpty = __hxcpp_field_to_id("isEmpty");
static int __id_clear = __hxcpp_field_to_id("clear");
static int __id_remove = __hxcpp_field_to_id("remove");
static int __id_iterator = __hxcpp_field_to_id("iterator");
static int __id_toString = __hxcpp_field_to_id("toString");
static int __id_join = __hxcpp_field_to_id("join");
static int __id_filter = __hxcpp_field_to_id("filter");
static int __id_map = __hxcpp_field_to_id("map");


Dynamic List_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_h) return h;
	if (inFieldID==__id_q) return q;
	if (inFieldID==__id_length) return length;
	if (inFieldID==__id_add) return add_dyn();
	if (inFieldID==__id_push) return push_dyn();
	if (inFieldID==__id_first) return first_dyn();
	if (inFieldID==__id_last) return last_dyn();
	if (inFieldID==__id_pop) return pop_dyn();
	if (inFieldID==__id_isEmpty) return isEmpty_dyn();
	if (inFieldID==__id_clear) return clear_dyn();
	if (inFieldID==__id_remove) return remove_dyn();
	if (inFieldID==__id_iterator) return iterator_dyn();
	if (inFieldID==__id_toString) return toString_dyn();
	if (inFieldID==__id_join) return join_dyn();
	if (inFieldID==__id_filter) return filter_dyn();
	if (inFieldID==__id_map) return map_dyn();
	return super::__IField(inFieldID);
}

Dynamic List_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"h",sizeof(wchar_t)*1) ) { h=inValue.Cast<Array<Dynamic > >();return inValue; }
		if (!memcmp(inName.__s,L"q",sizeof(wchar_t)*1) ) { q=inValue.Cast<Array<Dynamic > >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"length",sizeof(wchar_t)*6) ) { length=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void List_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"h",1));
	outFields->push(STRING(L"q",1));
	outFields->push(STRING(L"length",6));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"h",1),
	STRING(L"q",1),
	STRING(L"length",6),
	STRING(L"add",3),
	STRING(L"push",4),
	STRING(L"first",5),
	STRING(L"last",4),
	STRING(L"pop",3),
	STRING(L"isEmpty",7),
	STRING(L"clear",5),
	STRING(L"remove",6),
	STRING(L"iterator",8),
	STRING(L"toString",8),
	STRING(L"join",4),
	STRING(L"filter",6),
	STRING(L"map",3),
	String(null()) };

static void sMarkStatics() {
};

Class List_obj::__mClass;

void List_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"List",4), TCanCast<List_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void List_obj::__boot()
{
}

