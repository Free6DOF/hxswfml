#include <hxObject.h>

#ifndef INCLUDED_Reflect
#include <Reflect.h>
#endif
#ifndef INCLUDED_StringBuf
#include <StringBuf.h>
#endif
#ifndef INCLUDED_cpp_CppXml__
#include <cpp/CppXml__.h>
#endif
#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
namespace cpp{

Void CppXml___obj::__construct()
{
{
}
;
	return null();
}

CppXml___obj::~CppXml___obj() { }

Dynamic CppXml___obj::__CreateEmpty() { return  new CppXml___obj; }
hxObjectPtr<CppXml___obj > CppXml___obj::__new()
{  hxObjectPtr<CppXml___obj > result = new CppXml___obj();
	result->__construct();
	return result;}

Dynamic CppXml___obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<CppXml___obj > result = new CppXml___obj();
	result->__construct();
	return result;}

void CppXml___obj::__init__(){
	cpp::CppXml___obj::Element = STRING(L"element",7);
	cpp::CppXml___obj::PCData = STRING(L"pcdata",6);
	cpp::CppXml___obj::CData = STRING(L"cdata",5);
	cpp::CppXml___obj::Comment = STRING(L"comment",7);
	cpp::CppXml___obj::DocType = STRING(L"doctype",7);
	cpp::CppXml___obj::Prolog = STRING(L"prolog",6);
	cpp::CppXml___obj::Document = STRING(L"document",8);
}


String CppXml___obj::getNodeName( ){
	if (this->nodeType != cpp::CppXml___obj::Element)
		hxThrow (STRING(L"bad nodeType",12));
	return this->_nodeName;
}


DEFINE_DYNAMIC_FUNC0(CppXml___obj,getNodeName,return )

String CppXml___obj::setNodeName( String n){
	if (this->nodeType != cpp::CppXml___obj::Element)
		hxThrow (STRING(L"bad nodeType",12));
	return this->_nodeName = n;
}


DEFINE_DYNAMIC_FUNC1(CppXml___obj,setNodeName,return )

String CppXml___obj::getNodeValue( ){
	if (bool(this->nodeType == cpp::CppXml___obj::Element) || bool(this->nodeType == cpp::CppXml___obj::Document))
		hxThrow (STRING(L"bad nodeType",12));
	return this->_nodeValue;
}


DEFINE_DYNAMIC_FUNC0(CppXml___obj,getNodeValue,return )

String CppXml___obj::setNodeValue( String v){
	if (bool(this->nodeType == cpp::CppXml___obj::Element) || bool(this->nodeType == cpp::CppXml___obj::Document))
		hxThrow (STRING(L"bad nodeType",12));
	return this->_nodeValue = v;
}


DEFINE_DYNAMIC_FUNC1(CppXml___obj,setNodeValue,return )

cpp::CppXml__ CppXml___obj::getParent( ){
	return this->_parent;
}


DEFINE_DYNAMIC_FUNC0(CppXml___obj,getParent,return )

String CppXml___obj::get( String att){
	if (this->nodeType != cpp::CppXml___obj::Element)
		hxThrow (STRING(L"bad nodeType",12));
	return this->_attributes->__Field(att);
}


DEFINE_DYNAMIC_FUNC1(CppXml___obj,get,return )

Void CppXml___obj::set( String att,String value){
{
		if (this->nodeType != cpp::CppXml___obj::Element)
			hxThrow (STRING(L"bad nodeType",12));
		this->_attributes->__SetField(att,value);
		return null();
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(CppXml___obj,set,(void))

Void CppXml___obj::remove( String att){
{
		if (this->nodeType != cpp::CppXml___obj::Element)
			hxThrow (STRING(L"bad nodeType",12));
		Reflect_obj::deleteField(this->_attributes,att);
		return null();
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(CppXml___obj,remove,(void))

bool CppXml___obj::exists( String att){
	if (this->nodeType != cpp::CppXml___obj::Element)
		hxThrow (STRING(L"bad nodeType",12));
	return Reflect_obj::hasField(this->_attributes,att);
}


DEFINE_DYNAMIC_FUNC1(CppXml___obj,exists,return )

Dynamic CppXml___obj::attributes( ){
	if (this->nodeType != cpp::CppXml___obj::Element)
		hxThrow (STRING(L"bad nodeType",12));
	return Reflect_obj::fields(this->_attributes)->iterator();
}


DEFINE_DYNAMIC_FUNC0(CppXml___obj,attributes,return )

Dynamic CppXml___obj::iterator( ){
	if (this->_children == null())
		hxThrow (STRING(L"bad nodetype",12));
	return this->_children->iterator();
}


DEFINE_DYNAMIC_FUNC0(CppXml___obj,iterator,return )

Dynamic CppXml___obj::elements( ){
	if (this->_children == null())
		hxThrow (STRING(L"bad nodetype",12));
	Array<Array<Dynamic > > children = Array_obj<Array<Dynamic > >::__new().Add(this->_children);

	BEGIN_LOCAL_FUNC1(_Function_1,Array<Array<Dynamic > >,children)
	bool run(){
{
			int k = __this->__Field(STRING(L"cur",3)).Cast<int >();
			int l = children[0]->length;
			while(k < l){
				if (children->__get(0)[k]->__Field(STRING(L"nodeType",8)).Cast<String >() == cpp::CppXml___obj::Element)
					break;
				hxAddEq(k,1);
			}
			__this.FieldRef(STRING(L"cur",3)) = k;
			return k < l;
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC0(return)


	BEGIN_LOCAL_FUNC1(_Function_2,Array<Array<Dynamic > >,children)
	Dynamic run(){
{
			int k = __this->__Field(STRING(L"cur",3)).Cast<int >();
			int l = children[0]->length;
			while(k < l){
				Dynamic n = children->__get(0)->__get(k);
				hxAddEq(k,1);
				if (n->__Field(STRING(L"nodeType",8)).Cast<String >() == cpp::CppXml___obj::Element){
					__this.FieldRef(STRING(L"cur",3)) = k;
					return n;
				}
			}
			return null();
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC0(return)

	return hxAnon_obj::Create()->Add( STRING(L"cur",3) , 0)->Add( STRING(L"hasNext",7) ,  Dynamic(new _Function_1(children)))->Add( STRING(L"next",4) ,  Dynamic(new _Function_2(children)));
}


DEFINE_DYNAMIC_FUNC0(CppXml___obj,elements,return )

Dynamic CppXml___obj::elementsNamed( String $t1){
	Array<String > name = Array_obj<String >::__new().Add($t1);
	if (this->_children == null())
		hxThrow (STRING(L"bad nodetype",12));
	Array<Array<Dynamic > > children = Array_obj<Array<Dynamic > >::__new().Add(this->_children);

	BEGIN_LOCAL_FUNC2(_Function_1,Array<Array<Dynamic > >,children,Array<String >,name)
	bool run(){
{
			int k = __this->__Field(STRING(L"cur",3)).Cast<int >();
			int l = children[0]->length;
			while(k < l){
				Dynamic n = children->__get(0)->__get(k);
				if (bool(n->__Field(STRING(L"nodeType",8)).Cast<String >() == cpp::CppXml___obj::Element) && bool(n->__Field(STRING(L"_nodeName",9)).Cast<String >() == name->__get(0)))
					break;
				k++;
			}
			__this.FieldRef(STRING(L"cur",3)) = k;
			return k < l;
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC0(return)


	BEGIN_LOCAL_FUNC2(_Function_2,Array<Array<Dynamic > >,children,Array<String >,name)
	Dynamic run(){
{
			int k = __this->__Field(STRING(L"cur",3)).Cast<int >();
			int l = children[0]->length;
			while(k < l){
				Dynamic n = children->__get(0)->__get(k);
				k++;
				if (bool(n->__Field(STRING(L"nodeType",8)).Cast<String >() == cpp::CppXml___obj::Element) && bool(n->__Field(STRING(L"_nodeName",9)).Cast<String >() == name->__get(0))){
					__this.FieldRef(STRING(L"cur",3)) = k;
					return n;
				}
			}
			return null();
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC0(return)

	return hxAnon_obj::Create()->Add( STRING(L"cur",3) , 0)->Add( STRING(L"hasNext",7) ,  Dynamic(new _Function_1(children,name)))->Add( STRING(L"next",4) ,  Dynamic(new _Function_2(children,name)));
}


DEFINE_DYNAMIC_FUNC1(CppXml___obj,elementsNamed,return )

cpp::CppXml__ CppXml___obj::firstChild( ){
	if (this->_children == null())
		hxThrow (STRING(L"bad nodetype",12));
	return this->_children->__get(0);
}


DEFINE_DYNAMIC_FUNC0(CppXml___obj,firstChild,return )

cpp::CppXml__ CppXml___obj::firstElement( ){
	if (this->_children == null())
		hxThrow (STRING(L"bad nodetype",12));
	{
		int _g1 = 0;
		int _g = this->_children->length;
		while(_g1 < _g){
			int cur = _g1++;
			cpp::CppXml__ n = this->_children->__get(cur);
			if (n->nodeType == cpp::CppXml___obj::Element)
				return n;
		}
	}
	return null();
}


DEFINE_DYNAMIC_FUNC0(CppXml___obj,firstElement,return )

Void CppXml___obj::addChild( cpp::CppXml__ x_){
{
		cpp::CppXml__ x = x_;
		if (this->_children == null())
			hxThrow (STRING(L"bad nodetype",12));
		if (x->_parent != null())
			x->_parent->_children->remove(x);
		x->_parent = this;
		this->_children->push(x);
		return null();
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(CppXml___obj,addChild,(void))

bool CppXml___obj::removeChild( cpp::CppXml__ x_){
	cpp::CppXml__ x = x_;
	if (this->_children == null())
		hxThrow (STRING(L"bad nodetype",12));
	bool b = this->_children->remove(x);
	if (b)
		x->_parent = null();
	return b;
}


DEFINE_DYNAMIC_FUNC1(CppXml___obj,removeChild,return )

Void CppXml___obj::insertChild( cpp::CppXml__ x_,int pos){
{
		cpp::CppXml__ x = x_;
		if (this->_children == null())
			hxThrow (STRING(L"bad nodetype",12));
		if (x->_parent != null())
			x->_parent->_children->remove(x);
		x->_parent = this;
		this->_children->insert(pos,x);
		return null();
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(CppXml___obj,insertChild,(void))

String CppXml___obj::toString( ){
	if (this->nodeType == cpp::CppXml___obj::PCData)
		return this->_nodeValue;
	if (this->nodeType == cpp::CppXml___obj::CData)
		return STRING(L"<![CDATA[",9) + this->_nodeValue + STRING(L"]]>",3);
	if (bool(this->nodeType == cpp::CppXml___obj::Comment) || bool(bool(this->nodeType == cpp::CppXml___obj::DocType) || bool(this->nodeType == cpp::CppXml___obj::Prolog)))
		return this->_nodeValue;
	StringBuf s = StringBuf_obj::__new();
	if (this->nodeType == cpp::CppXml___obj::Element){
		hxAddEq(s->b,STRING(L"<",1));
		hxAddEq(s->b,this->_nodeName);
		{
			int _g = 0;
			Array<String > _g1 = Reflect_obj::fields(this->_attributes);
			while(_g < _g1->length){
				String k = _g1->__get(_g);
				++_g;
				hxAddEq(s->b,STRING(L" ",1));
				hxAddEq(s->b,k);
				hxAddEq(s->b,STRING(L"=\"",2));
				hxAddEq(s->b,this->_attributes->__Field(k));
				hxAddEq(s->b,STRING(L"\"",1));
			}
		}
		if (this->_children->length == 0){
			hxAddEq(s->b,STRING(L"/>",2));
			return s->b;
		}
		hxAddEq(s->b,STRING(L">",1));
	}
	for(Dynamic __it = this->iterator();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ x = __it->__Field(STRING(L"next",4))();
		hxAddEq(s->b,x);
	}
	if (this->nodeType == cpp::CppXml___obj::Element){
		hxAddEq(s->b,STRING(L"</",2));
		hxAddEq(s->b,this->_nodeName);
		hxAddEq(s->b,STRING(L">",1));
	}
	return s->b;
}


DEFINE_DYNAMIC_FUNC0(CppXml___obj,toString,return )

String CppXml___obj::Element;

String CppXml___obj::PCData;

String CppXml___obj::CData;

String CppXml___obj::Comment;

String CppXml___obj::DocType;

String CppXml___obj::Prolog;

String CppXml___obj::Document;

Dynamic CppXml___obj::_parse;

cpp::CppXml__ CppXml___obj::parse( String xmlData){
	cpp::CppXml__ x = cpp::CppXml___obj::__new();
	x->_children = Array_obj<Dynamic >::__new();

	BEGIN_LOCAL_FUNC0(_Function_1)
	Void run(String name,Dynamic att){
{
			Dynamic x1 = cpp::CppXml___obj::__new();
			x1.FieldRef(STRING(L"_parent",7)) = __this->__Field(STRING(L"cur",3));
			x1.FieldRef(STRING(L"nodeType",8)) = cpp::CppXml___obj::Element;
			x1.FieldRef(STRING(L"_nodeName",9)) = String(name);
			x1.FieldRef(STRING(L"_attributes",11)) = att;
			x1.FieldRef(STRING(L"_children",9)) = Array_obj<Dynamic >::__new();
			{
				int i = 0;
				__this->__Field(STRING(L"cur",3))->__Field(STRING(L"addChild",8))(x1);
				__this.FieldRef(STRING(L"cur",3)) = x1;
			}
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC2((void))


	BEGIN_LOCAL_FUNC0(_Function_2)
	Void run(String text){
{
			cpp::CppXml__ x1 = cpp::CppXml___obj::__new();
			x1->_parent = __this->__Field(STRING(L"cur",3)).Cast<cpp::CppXml__ >();
			x1->nodeType = cpp::CppXml___obj::CData;
			x1->_nodeValue = String(text);
			__this->__Field(STRING(L"cur",3))->__Field(STRING(L"addChild",8))(x1);
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC1((void))


	BEGIN_LOCAL_FUNC0(_Function_3)
	Void run(String text){
{
			cpp::CppXml__ x1 = cpp::CppXml___obj::__new();
			x1->_parent = __this->__Field(STRING(L"cur",3)).Cast<cpp::CppXml__ >();
			x1->nodeType = cpp::CppXml___obj::PCData;
			x1->_nodeValue = String(text);
			__this->__Field(STRING(L"cur",3))->__Field(STRING(L"addChild",8))(x1);
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC1((void))


	BEGIN_LOCAL_FUNC0(_Function_4)
	Void run(String text){
{
			cpp::CppXml__ x1 = cpp::CppXml___obj::__new();
			x1->_parent = __this->__Field(STRING(L"cur",3)).Cast<cpp::CppXml__ >();
			if (text.cca(0) == 63){
				x1->nodeType = cpp::CppXml___obj::Prolog;
				text = STRING(L"<",1) + String(text) + STRING(L">",1);
			}
			else{
				x1->nodeType = cpp::CppXml___obj::Comment;
				text = STRING(L"<!--",4) + String(text) + STRING(L"-->",3);
			}
			x1->_nodeValue = text;
			__this->__Field(STRING(L"cur",3))->__Field(STRING(L"addChild",8))(x1);
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC1((void))


	BEGIN_LOCAL_FUNC0(_Function_5)
	Void run(String text){
{
			cpp::CppXml__ x1 = cpp::CppXml___obj::__new();
			x1->_parent = __this->__Field(STRING(L"cur",3)).Cast<cpp::CppXml__ >();
			x1->nodeType = cpp::CppXml___obj::DocType;
			x1->_nodeValue = STRING(L"<!DOCTYPE",9) + String(text) + STRING(L">",1);
			__this->__Field(STRING(L"cur",3))->__Field(STRING(L"addChild",8))(x1);
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC1((void))


	BEGIN_LOCAL_FUNC0(_Function_6)
	Void run(){
{
			__this.FieldRef(STRING(L"cur",3)) = __this->__Field(STRING(L"cur",3))->__Field(STRING(L"_parent",7));
		}
		return null();
	}
	Dynamic __this;
	void __SetThis(Dynamic inThis) { __this = inThis; }
	END_LOCAL_FUNC0((void))

	Dynamic parser = hxAnon_obj::Create()->Add( STRING(L"cur",3) , x)->Add( STRING(L"xml",3) ,  Dynamic(new _Function_1()))->Add( STRING(L"cdata",5) ,  Dynamic(new _Function_2()))->Add( STRING(L"pcdata",6) ,  Dynamic(new _Function_3()))->Add( STRING(L"comment",7) ,  Dynamic(new _Function_4()))->Add( STRING(L"doctype",7) ,  Dynamic(new _Function_5()))->Add( STRING(L"done",4) ,  Dynamic(new _Function_6()));
	cpp::CppXml___obj::_parse(xmlData.__s,parser);
	x->nodeType = cpp::CppXml___obj::Document;
	return x;
}


STATIC_DEFINE_DYNAMIC_FUNC1(CppXml___obj,parse,return )

cpp::CppXml__ CppXml___obj::createElement( String name){
	cpp::CppXml__ r = cpp::CppXml___obj::__new();
	r->nodeType = cpp::CppXml___obj::Element;
	r->_nodeName = name;
	r->_attributes = null();
	r->_children = Array_obj<Dynamic >::__new();
	return r;
}


STATIC_DEFINE_DYNAMIC_FUNC1(CppXml___obj,createElement,return )

cpp::CppXml__ CppXml___obj::createPCData( String data){
	cpp::CppXml__ r = cpp::CppXml___obj::__new();
	r->nodeType = cpp::CppXml___obj::PCData;
	r->_nodeValue = data;
	return r;
}


STATIC_DEFINE_DYNAMIC_FUNC1(CppXml___obj,createPCData,return )

cpp::CppXml__ CppXml___obj::createCData( String data){
	cpp::CppXml__ r = cpp::CppXml___obj::__new();
	r->nodeType = cpp::CppXml___obj::CData;
	r->_nodeValue = data;
	return r;
}


STATIC_DEFINE_DYNAMIC_FUNC1(CppXml___obj,createCData,return )

cpp::CppXml__ CppXml___obj::createComment( String data){
	cpp::CppXml__ r = cpp::CppXml___obj::__new();
	r->nodeType = cpp::CppXml___obj::Comment;
	r->_nodeValue = data;
	return r;
}


STATIC_DEFINE_DYNAMIC_FUNC1(CppXml___obj,createComment,return )

cpp::CppXml__ CppXml___obj::createDocType( String data){
	cpp::CppXml__ r = cpp::CppXml___obj::__new();
	r->nodeType = cpp::CppXml___obj::DocType;
	r->_nodeValue = data;
	return r;
}


STATIC_DEFINE_DYNAMIC_FUNC1(CppXml___obj,createDocType,return )

cpp::CppXml__ CppXml___obj::createProlog( String data){
	cpp::CppXml__ r = cpp::CppXml___obj::__new();
	r->nodeType = cpp::CppXml___obj::Prolog;
	r->_nodeValue = data;
	return r;
}


STATIC_DEFINE_DYNAMIC_FUNC1(CppXml___obj,createProlog,return )

cpp::CppXml__ CppXml___obj::createDocument( ){
	cpp::CppXml__ r = cpp::CppXml___obj::__new();
	r->nodeType = cpp::CppXml___obj::Document;
	r->_children = Array_obj<Dynamic >::__new();
	return r;
}


STATIC_DEFINE_DYNAMIC_FUNC0(CppXml___obj,createDocument,return )


CppXml___obj::CppXml___obj()
{
	InitMember(_nodeName);
	InitMember(_nodeValue);
	InitMember(_attributes);
	InitMember(_children);
	InitMember(_parent);
	InitMember(nodeType);
	InitMember(nodeName);
	InitMember(nodeValue);
}

void CppXml___obj::__Mark()
{
	MarkMember(_nodeName);
	MarkMember(_nodeValue);
	MarkMember(_attributes);
	MarkMember(_children);
	MarkMember(_parent);
	MarkMember(nodeType);
	MarkMember(nodeName);
	MarkMember(nodeValue);
}

Dynamic CppXml___obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"get",sizeof(wchar_t)*3) ) { return get_dyn(); }
		if (!memcmp(inName.__s,L"set",sizeof(wchar_t)*3) ) { return set_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"CData",sizeof(wchar_t)*5) ) { return CData; }
		if (!memcmp(inName.__s,L"parse",sizeof(wchar_t)*5) ) { return parse_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"PCData",sizeof(wchar_t)*6) ) { return PCData; }
		if (!memcmp(inName.__s,L"Prolog",sizeof(wchar_t)*6) ) { return Prolog; }
		if (!memcmp(inName.__s,L"_parse",sizeof(wchar_t)*6) ) { return _parse; }
		if (!memcmp(inName.__s,L"remove",sizeof(wchar_t)*6) ) { return remove_dyn(); }
		if (!memcmp(inName.__s,L"exists",sizeof(wchar_t)*6) ) { return exists_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"Element",sizeof(wchar_t)*7) ) { return Element; }
		if (!memcmp(inName.__s,L"Comment",sizeof(wchar_t)*7) ) { return Comment; }
		if (!memcmp(inName.__s,L"DocType",sizeof(wchar_t)*7) ) { return DocType; }
		if (!memcmp(inName.__s,L"_parent",sizeof(wchar_t)*7) ) { return _parent; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"Document",sizeof(wchar_t)*8) ) { return Document; }
		if (!memcmp(inName.__s,L"nodeType",sizeof(wchar_t)*8) ) { return nodeType; }
		if (!memcmp(inName.__s,L"nodeName",sizeof(wchar_t)*8) ) { return nodeName; }
		if (!memcmp(inName.__s,L"iterator",sizeof(wchar_t)*8) ) { return iterator_dyn(); }
		if (!memcmp(inName.__s,L"elements",sizeof(wchar_t)*8) ) { return elements_dyn(); }
		if (!memcmp(inName.__s,L"addChild",sizeof(wchar_t)*8) ) { return addChild_dyn(); }
		if (!memcmp(inName.__s,L"toString",sizeof(wchar_t)*8) ) { return toString_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"_nodeName",sizeof(wchar_t)*9) ) { return _nodeName; }
		if (!memcmp(inName.__s,L"_children",sizeof(wchar_t)*9) ) { return _children; }
		if (!memcmp(inName.__s,L"nodeValue",sizeof(wchar_t)*9) ) { return nodeValue; }
		if (!memcmp(inName.__s,L"getParent",sizeof(wchar_t)*9) ) { return getParent_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"_nodeValue",sizeof(wchar_t)*10) ) { return _nodeValue; }
		if (!memcmp(inName.__s,L"attributes",sizeof(wchar_t)*10) ) { return attributes_dyn(); }
		if (!memcmp(inName.__s,L"firstChild",sizeof(wchar_t)*10) ) { return firstChild_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"createCData",sizeof(wchar_t)*11) ) { return createCData_dyn(); }
		if (!memcmp(inName.__s,L"_attributes",sizeof(wchar_t)*11) ) { return _attributes; }
		if (!memcmp(inName.__s,L"getNodeName",sizeof(wchar_t)*11) ) { return getNodeName_dyn(); }
		if (!memcmp(inName.__s,L"setNodeName",sizeof(wchar_t)*11) ) { return setNodeName_dyn(); }
		if (!memcmp(inName.__s,L"removeChild",sizeof(wchar_t)*11) ) { return removeChild_dyn(); }
		if (!memcmp(inName.__s,L"insertChild",sizeof(wchar_t)*11) ) { return insertChild_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"createPCData",sizeof(wchar_t)*12) ) { return createPCData_dyn(); }
		if (!memcmp(inName.__s,L"createProlog",sizeof(wchar_t)*12) ) { return createProlog_dyn(); }
		if (!memcmp(inName.__s,L"getNodeValue",sizeof(wchar_t)*12) ) { return getNodeValue_dyn(); }
		if (!memcmp(inName.__s,L"setNodeValue",sizeof(wchar_t)*12) ) { return setNodeValue_dyn(); }
		if (!memcmp(inName.__s,L"firstElement",sizeof(wchar_t)*12) ) { return firstElement_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"createElement",sizeof(wchar_t)*13) ) { return createElement_dyn(); }
		if (!memcmp(inName.__s,L"createComment",sizeof(wchar_t)*13) ) { return createComment_dyn(); }
		if (!memcmp(inName.__s,L"createDocType",sizeof(wchar_t)*13) ) { return createDocType_dyn(); }
		if (!memcmp(inName.__s,L"elementsNamed",sizeof(wchar_t)*13) ) { return elementsNamed_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"createDocument",sizeof(wchar_t)*14) ) { return createDocument_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_Element = __hxcpp_field_to_id("Element");
static int __id_PCData = __hxcpp_field_to_id("PCData");
static int __id_CData = __hxcpp_field_to_id("CData");
static int __id_Comment = __hxcpp_field_to_id("Comment");
static int __id_DocType = __hxcpp_field_to_id("DocType");
static int __id_Prolog = __hxcpp_field_to_id("Prolog");
static int __id_Document = __hxcpp_field_to_id("Document");
static int __id__parse = __hxcpp_field_to_id("_parse");
static int __id_parse = __hxcpp_field_to_id("parse");
static int __id_createElement = __hxcpp_field_to_id("createElement");
static int __id_createPCData = __hxcpp_field_to_id("createPCData");
static int __id_createCData = __hxcpp_field_to_id("createCData");
static int __id_createComment = __hxcpp_field_to_id("createComment");
static int __id_createDocType = __hxcpp_field_to_id("createDocType");
static int __id_createProlog = __hxcpp_field_to_id("createProlog");
static int __id_createDocument = __hxcpp_field_to_id("createDocument");
static int __id__nodeName = __hxcpp_field_to_id("_nodeName");
static int __id__nodeValue = __hxcpp_field_to_id("_nodeValue");
static int __id__attributes = __hxcpp_field_to_id("_attributes");
static int __id__children = __hxcpp_field_to_id("_children");
static int __id__parent = __hxcpp_field_to_id("_parent");
static int __id_nodeType = __hxcpp_field_to_id("nodeType");
static int __id_nodeName = __hxcpp_field_to_id("nodeName");
static int __id_nodeValue = __hxcpp_field_to_id("nodeValue");
static int __id_getNodeName = __hxcpp_field_to_id("getNodeName");
static int __id_setNodeName = __hxcpp_field_to_id("setNodeName");
static int __id_getNodeValue = __hxcpp_field_to_id("getNodeValue");
static int __id_setNodeValue = __hxcpp_field_to_id("setNodeValue");
static int __id_getParent = __hxcpp_field_to_id("getParent");
static int __id_get = __hxcpp_field_to_id("get");
static int __id_set = __hxcpp_field_to_id("set");
static int __id_remove = __hxcpp_field_to_id("remove");
static int __id_exists = __hxcpp_field_to_id("exists");
static int __id_attributes = __hxcpp_field_to_id("attributes");
static int __id_iterator = __hxcpp_field_to_id("iterator");
static int __id_elements = __hxcpp_field_to_id("elements");
static int __id_elementsNamed = __hxcpp_field_to_id("elementsNamed");
static int __id_firstChild = __hxcpp_field_to_id("firstChild");
static int __id_firstElement = __hxcpp_field_to_id("firstElement");
static int __id_addChild = __hxcpp_field_to_id("addChild");
static int __id_removeChild = __hxcpp_field_to_id("removeChild");
static int __id_insertChild = __hxcpp_field_to_id("insertChild");
static int __id_toString = __hxcpp_field_to_id("toString");


Dynamic CppXml___obj::__IField(int inFieldID)
{
	if (inFieldID==__id_Element) return Element;
	if (inFieldID==__id_PCData) return PCData;
	if (inFieldID==__id_CData) return CData;
	if (inFieldID==__id_Comment) return Comment;
	if (inFieldID==__id_DocType) return DocType;
	if (inFieldID==__id_Prolog) return Prolog;
	if (inFieldID==__id_Document) return Document;
	if (inFieldID==__id__parse) return _parse;
	if (inFieldID==__id_parse) return parse_dyn();
	if (inFieldID==__id_createElement) return createElement_dyn();
	if (inFieldID==__id_createPCData) return createPCData_dyn();
	if (inFieldID==__id_createCData) return createCData_dyn();
	if (inFieldID==__id_createComment) return createComment_dyn();
	if (inFieldID==__id_createDocType) return createDocType_dyn();
	if (inFieldID==__id_createProlog) return createProlog_dyn();
	if (inFieldID==__id_createDocument) return createDocument_dyn();
	if (inFieldID==__id__nodeName) return _nodeName;
	if (inFieldID==__id__nodeValue) return _nodeValue;
	if (inFieldID==__id__attributes) return _attributes;
	if (inFieldID==__id__children) return _children;
	if (inFieldID==__id__parent) return _parent;
	if (inFieldID==__id_nodeType) return nodeType;
	if (inFieldID==__id_nodeName) return nodeName;
	if (inFieldID==__id_nodeValue) return nodeValue;
	if (inFieldID==__id_getNodeName) return getNodeName_dyn();
	if (inFieldID==__id_setNodeName) return setNodeName_dyn();
	if (inFieldID==__id_getNodeValue) return getNodeValue_dyn();
	if (inFieldID==__id_setNodeValue) return setNodeValue_dyn();
	if (inFieldID==__id_getParent) return getParent_dyn();
	if (inFieldID==__id_get) return get_dyn();
	if (inFieldID==__id_set) return set_dyn();
	if (inFieldID==__id_remove) return remove_dyn();
	if (inFieldID==__id_exists) return exists_dyn();
	if (inFieldID==__id_attributes) return attributes_dyn();
	if (inFieldID==__id_iterator) return iterator_dyn();
	if (inFieldID==__id_elements) return elements_dyn();
	if (inFieldID==__id_elementsNamed) return elementsNamed_dyn();
	if (inFieldID==__id_firstChild) return firstChild_dyn();
	if (inFieldID==__id_firstElement) return firstElement_dyn();
	if (inFieldID==__id_addChild) return addChild_dyn();
	if (inFieldID==__id_removeChild) return removeChild_dyn();
	if (inFieldID==__id_insertChild) return insertChild_dyn();
	if (inFieldID==__id_toString) return toString_dyn();
	return super::__IField(inFieldID);
}

Dynamic CppXml___obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"CData",sizeof(wchar_t)*5) ) { CData=inValue.Cast<String >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"PCData",sizeof(wchar_t)*6) ) { PCData=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"Prolog",sizeof(wchar_t)*6) ) { Prolog=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"_parse",sizeof(wchar_t)*6) ) { _parse=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"Element",sizeof(wchar_t)*7) ) { Element=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"Comment",sizeof(wchar_t)*7) ) { Comment=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"DocType",sizeof(wchar_t)*7) ) { DocType=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"_parent",sizeof(wchar_t)*7) ) { _parent=inValue.Cast<cpp::CppXml__ >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"Document",sizeof(wchar_t)*8) ) { Document=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"nodeType",sizeof(wchar_t)*8) ) { nodeType=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"nodeName",sizeof(wchar_t)*8) ) { nodeName=inValue.Cast<String >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"_nodeName",sizeof(wchar_t)*9) ) { _nodeName=inValue.Cast<String >();return inValue; }
		if (!memcmp(inName.__s,L"_children",sizeof(wchar_t)*9) ) { _children=inValue.Cast<Array<Dynamic > >();return inValue; }
		if (!memcmp(inName.__s,L"nodeValue",sizeof(wchar_t)*9) ) { nodeValue=inValue.Cast<String >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"_nodeValue",sizeof(wchar_t)*10) ) { _nodeValue=inValue.Cast<String >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"_attributes",sizeof(wchar_t)*11) ) { _attributes=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void CppXml___obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"_nodeName",9));
	outFields->push(STRING(L"_nodeValue",10));
	outFields->push(STRING(L"_attributes",11));
	outFields->push(STRING(L"_children",9));
	outFields->push(STRING(L"_parent",7));
	outFields->push(STRING(L"nodeType",8));
	outFields->push(STRING(L"nodeName",8));
	outFields->push(STRING(L"nodeValue",9));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"Element",7),
	STRING(L"PCData",6),
	STRING(L"CData",5),
	STRING(L"Comment",7),
	STRING(L"DocType",7),
	STRING(L"Prolog",6),
	STRING(L"Document",8),
	STRING(L"_parse",6),
	STRING(L"parse",5),
	STRING(L"createElement",13),
	STRING(L"createPCData",12),
	STRING(L"createCData",11),
	STRING(L"createComment",13),
	STRING(L"createDocType",13),
	STRING(L"createProlog",12),
	STRING(L"createDocument",14),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"_nodeName",9),
	STRING(L"_nodeValue",10),
	STRING(L"_attributes",11),
	STRING(L"_children",9),
	STRING(L"_parent",7),
	STRING(L"nodeType",8),
	STRING(L"nodeName",8),
	STRING(L"nodeValue",9),
	STRING(L"getNodeName",11),
	STRING(L"setNodeName",11),
	STRING(L"getNodeValue",12),
	STRING(L"setNodeValue",12),
	STRING(L"getParent",9),
	STRING(L"get",3),
	STRING(L"set",3),
	STRING(L"remove",6),
	STRING(L"exists",6),
	STRING(L"attributes",10),
	STRING(L"iterator",8),
	STRING(L"elements",8),
	STRING(L"elementsNamed",13),
	STRING(L"firstChild",10),
	STRING(L"firstElement",12),
	STRING(L"addChild",8),
	STRING(L"removeChild",11),
	STRING(L"insertChild",11),
	STRING(L"toString",8),
	String(null()) };

static void sMarkStatics() {
	MarkMember(CppXml___obj::Element);
	MarkMember(CppXml___obj::PCData);
	MarkMember(CppXml___obj::CData);
	MarkMember(CppXml___obj::Comment);
	MarkMember(CppXml___obj::DocType);
	MarkMember(CppXml___obj::Prolog);
	MarkMember(CppXml___obj::Document);
	MarkMember(CppXml___obj::_parse);
};

Class CppXml___obj::__mClass;

void CppXml___obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"Xml",3), TCanCast<CppXml___obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void CppXml___obj::__boot()
{
	Static(Element);
	Static(PCData);
	Static(CData);
	Static(Comment);
	Static(DocType);
	Static(Prolog);
	Static(Document);
	Static(_parse) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"parse_xml",9),2);
}

} // end namespace cpp
