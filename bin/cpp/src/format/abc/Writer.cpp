#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_abc_ABCData
#include <format/abc/ABCData.h>
#endif
#ifndef INCLUDED_format_abc_FieldKind
#include <format/abc/FieldKind.h>
#endif
#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_MethodKind
#include <format/abc/MethodKind.h>
#endif
#ifndef INCLUDED_format_abc_Name
#include <format/abc/Name.h>
#endif
#ifndef INCLUDED_format_abc_Namespace
#include <format/abc/Namespace.h>
#endif
#ifndef INCLUDED_format_abc_OpWriter
#include <format/abc/OpWriter.h>
#endif
#ifndef INCLUDED_format_abc_Value
#include <format/abc/Value.h>
#endif
#ifndef INCLUDED_format_abc_Writer
#include <format/abc/Writer.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace format{
namespace abc{

Void Writer_obj::__construct(haxe::io::Output o)
{
{
	this->o = o;
	this->opw = format::abc::OpWriter_obj::__new(o);
}
;
	return null();
}

Writer_obj::~Writer_obj() { }

Dynamic Writer_obj::__CreateEmpty() { return  new Writer_obj; }
hxObjectPtr<Writer_obj > Writer_obj::__new(haxe::io::Output o)
{  hxObjectPtr<Writer_obj > result = new Writer_obj();
	result->__construct(o);
	return result;}

Dynamic Writer_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Writer_obj > result = new Writer_obj();
	result->__construct(inArgs[0]);
	return result;}

Void Writer_obj::beginTag( int id,int len){
{
		if (len >= 63){
			this->o->writeUInt16(int((int(id) << int(6))) | int(63));
			this->o->writeUInt30(len);
		}
		else
			this->o->writeUInt16(int((int(id) << int(6))) | int(len));
;
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,beginTag,(void))

Void Writer_obj::writeInt( int n){
{
		this->opw->writeInt(n);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeInt,(void))

Void Writer_obj::writeUInt( int n){
{
		this->opw->writeInt(n);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeUInt,(void))

Void Writer_obj::writeList( Array<Dynamic > a,Dynamic write){
{
		if (a->length == 0){
			this->opw->writeInt(0);
			return null();
		}
		this->opw->writeInt(a->length + 1);
		{
			int _g1 = 0;
			int _g = a->length;
			while(_g1 < _g){
				int i = _g1++;
				write(a->__get(i));
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeList,(void))

Void Writer_obj::writeList2( Array<Dynamic > a,Dynamic write){
{
		this->opw->writeInt(a->length);
		{
			int _g1 = 0;
			int _g = a->length;
			while(_g1 < _g){
				int i = _g1++;
				write(a->__get(i));
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeList2,(void))

Void Writer_obj::writeString( String s){
{
		this->opw->writeInt(s.length);
		this->o->writeString(s);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeString,(void))

Void Writer_obj::writeIndex( format::abc::Index i){
{
		format::abc::Index _switch_1 = (i);
		switch((_switch_1)->GetIndex()){
			case 0: {
				int n = _switch_1->__Param(0);
{
					this->opw->writeInt(n);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeIndex,(void))

Void Writer_obj::writeIndexOpt( format::abc::Index i){
{
		if (i == null()){
			this->o->writeByte(0);
			return null();
		}
		this->writeIndex(i);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeIndexOpt,(void))

Void Writer_obj::writeNamespace( format::abc::Namespace n){
{
		format::abc::Namespace _switch_2 = (n);
		switch((_switch_2)->GetIndex()){
			case 0: {
				format::abc::Index id = _switch_2->__Param(0);
{
					this->o->writeByte(5);
					this->writeIndex(id);
				}
			}
			break;
			case 1: {
				format::abc::Index ns = _switch_2->__Param(0);
{
					this->o->writeByte(8);
					this->writeIndex(ns);
				}
			}
			break;
			case 2: {
				format::abc::Index id = _switch_2->__Param(0);
{
					this->o->writeByte(22);
					this->writeIndex(id);
				}
			}
			break;
			case 3: {
				format::abc::Index id = _switch_2->__Param(0);
{
					this->o->writeByte(23);
					this->writeIndex(id);
				}
			}
			break;
			case 4: {
				format::abc::Index id = _switch_2->__Param(0);
{
					this->o->writeByte(24);
					this->writeIndex(id);
				}
			}
			break;
			case 5: {
				format::abc::Index id = _switch_2->__Param(0);
{
					this->o->writeByte(25);
					this->writeIndex(id);
				}
			}
			break;
			case 6: {
				format::abc::Index id = _switch_2->__Param(0);
{
					this->o->writeByte(26);
					this->writeIndex(id);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeNamespace,(void))

Void Writer_obj::writeNsSet( Array<format::abc::Index > n){
{
		this->o->writeByte(n->length);
		{
			int _g = 0;
			while(_g < n->length){
				format::abc::Index i = n->__get(_g);
				++_g;
				this->writeIndex(i);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeNsSet,(void))

Void Writer_obj::writeNameByte( int k,int n){
{
		this->o->writeByte((k < 0) ? int( n ) : int( k ));
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeNameByte,(void))

Void Writer_obj::writeName( Dynamic __o_k,format::abc::Name n){
int k = __o_k.Default(-1);
{
		format::abc::Name _switch_3 = (n);
		switch((_switch_3)->GetIndex()){
			case 0: {
				format::abc::Index ns = _switch_3->__Param(1);
				format::abc::Index id = _switch_3->__Param(0);
{
					this->o->writeByte((k < 0) ? int( 7 ) : int( k ));
					this->writeIndex(ns);
					this->writeIndex(id);
				}
			}
			break;
			case 1: {
				format::abc::Index ns = _switch_3->__Param(1);
				format::abc::Index id = _switch_3->__Param(0);
{
					this->o->writeByte((k < 0) ? int( 9 ) : int( k ));
					this->writeIndex(id);
					this->writeIndex(ns);
				}
			}
			break;
			case 2: {
				format::abc::Index n1 = _switch_3->__Param(0);
{
					this->o->writeByte((k < 0) ? int( 15 ) : int( k ));
					this->writeIndex(n1);
				}
			}
			break;
			case 3: {
				this->o->writeByte((k < 0) ? int( 17 ) : int( k ));
			}
			break;
			case 4: {
				format::abc::Index ns = _switch_3->__Param(0);
{
					this->o->writeByte((k < 0) ? int( 27 ) : int( k ));
					this->writeIndex(ns);
				}
			}
			break;
			case 5: {
				format::abc::Name n1 = _switch_3->__Param(0);
{
					struct _Function_1{
						static int Block( format::abc::Name &n1)/* DEF (not block)(ret intern) */{
							format::abc::Name _switch_4 = (n1);
							switch((_switch_4)->GetIndex()){
								case 0: {
{
										return 13;
									}
								}
								break;
								case 1: {
{
										return 14;
									}
								}
								break;
								case 2: {
{
										return 16;
									}
								}
								break;
								case 3: {
									return 18;
								}
								break;
								case 4: {
{
										return 28;
									}
								}
								break;
								case 5: case 6: {
{
										return hxThrow (STRING(L"assert",6));
									}
								}
								break;
								default: {
									return null();
								}
							}
						}
					};
					this->writeName(_Function_1::Block(n1),n1);
				}
			}
			break;
			case 6: {
				Array<format::abc::Index > params = _switch_3->__Param(1);
				format::abc::Index n1 = _switch_3->__Param(0);
{
					this->o->writeByte((k < 0) ? int( 29 ) : int( k ));
					this->writeIndex(n1);
					this->o->writeByte(params->length);
					{
						int _g = 0;
						while(_g < params->length){
							format::abc::Index i = params->__get(_g);
							++_g;
							this->writeIndex(i);
						}
					}
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeName,(void))

Void Writer_obj::writeValue( bool extra,format::abc::Value v){
{
		if (v == null()){
			if (extra)
				this->o->writeByte(0);
			this->o->writeByte(0);
			return null();
		}
		format::abc::Value _switch_5 = (v);
		switch((_switch_5)->GetIndex()){
			case 0: {
				this->o->writeByte(12);
				this->o->writeByte(12);
			}
			break;
			case 1: {
				bool b = _switch_5->__Param(0);
{
					int c = b ? int( 11 ) : int( 10 );
					this->o->writeByte(c);
					this->o->writeByte(c);
				}
			}
			break;
			case 2: {
				format::abc::Index i = _switch_5->__Param(0);
{
					this->writeIndex(i);
					this->o->writeByte(1);
				}
			}
			break;
			case 3: {
				format::abc::Index i = _switch_5->__Param(0);
{
					this->writeIndex(i);
					this->o->writeByte(3);
				}
			}
			break;
			case 4: {
				format::abc::Index i = _switch_5->__Param(0);
{
					this->writeIndex(i);
					this->o->writeByte(4);
				}
			}
			break;
			case 5: {
				format::abc::Index i = _switch_5->__Param(0);
{
					this->writeIndex(i);
					this->o->writeByte(6);
				}
			}
			break;
			case 6: {
				format::abc::Index i = _switch_5->__Param(1);
				int n = _switch_5->__Param(0);
{
					this->writeIndex(i);
					this->o->writeByte(n);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeValue,(void))

Void Writer_obj::writeField( Dynamic f){
{
		this->writeIndex(f->__Field(STRING(L"name",4)).Cast<format::abc::Index >());
		int flags = 0;
		if (f->__Field(STRING(L"metadatas",9)).Cast<Array<format::abc::Index > >() != null())
			hxOrEq(flags,64);
		format::abc::FieldKind _switch_6 = (f->__Field(STRING(L"kind",4)).Cast<format::abc::FieldKind >());
		switch((_switch_6)->GetIndex()){
			case 0: {
				Dynamic _const = _switch_6->__Param(2);
				format::abc::Value v = _switch_6->__Param(1);
				format::abc::Index t = _switch_6->__Param(0);
{
					this->o->writeByte(int((_const ? int( 6 ) : int( 0 ))) | int(flags));
					this->opw->writeInt(f->__Field(STRING(L"slot",4)).Cast<int >());
					this->writeIndexOpt(t);
					this->writeValue(false,v);
				}
			}
			break;
			case 1: {
				Dynamic isOverride = _switch_6->__Param(3);
				Dynamic isFinal = _switch_6->__Param(2);
				format::abc::MethodKind k = _switch_6->__Param(1);
				format::abc::Index t = _switch_6->__Param(0);
{
					if (isFinal)
						hxOrEq(flags,16);
					if (isOverride)
						hxOrEq(flags,32);
					format::abc::MethodKind _switch_7 = (k);
					switch((_switch_7)->GetIndex()){
						case 0: {
							hxOrEq(flags,1);
						}
						break;
						case 1: {
							hxOrEq(flags,2);
						}
						break;
						case 2: {
							hxOrEq(flags,3);
						}
						break;
					}
					this->o->writeByte(flags);
					this->opw->writeInt(f->__Field(STRING(L"slot",4)).Cast<int >());
					this->writeIndex(t);
				}
			}
			break;
			case 2: {
				format::abc::Index c = _switch_6->__Param(0);
{
					this->o->writeByte(int(4) | int(flags));
					this->opw->writeInt(f->__Field(STRING(L"slot",4)).Cast<int >());
					this->writeIndex(c);
				}
			}
			break;
			case 3: {
				format::abc::Index i = _switch_6->__Param(0);
{
					this->o->writeByte(int(5) | int(flags));
					this->opw->writeInt(f->__Field(STRING(L"slot",4)).Cast<int >());
					this->writeIndex(i);
				}
			}
			break;
		}
		if (f->__Field(STRING(L"metadatas",9)).Cast<Array<format::abc::Index > >() != null())
			this->writeList2(f->__Field(STRING(L"metadatas",9)).Cast<Array<format::abc::Index > >(),this->writeIndex_dyn());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeField,(void))

Void Writer_obj::writeMethodType( Dynamic m){
{
		this->o->writeByte(m->__Field(STRING(L"args",4)).Cast<Array<format::abc::Index > >()->length);
		this->writeIndexOpt(m->__Field(STRING(L"ret",3)).Cast<format::abc::Index >());
		{
			int _g = 0;
			Array<format::abc::Index > _g1 = m->__Field(STRING(L"args",4)).Cast<Array<format::abc::Index > >();
			while(_g < _g1->length){
				format::abc::Index a = _g1->__get(_g);
				++_g;
				this->writeIndexOpt(a);
			}
		}
		Dynamic x = m->__Field(STRING(L"extra",5));
		if (x == null()){
			this->writeIndexOpt(null());
			this->o->writeByte(0);
			return null();
		}
		this->writeIndexOpt(x->__Field(STRING(L"debugName",9)).Cast<format::abc::Index >());
		int flags = 0;
		if (x->__Field(STRING(L"argumentsDefined",16)).Cast<bool >())
			hxOrEq(flags,1);
		if (x->__Field(STRING(L"newBlock",8)).Cast<bool >())
			hxOrEq(flags,2);
		if (x->__Field(STRING(L"variableArgs",12)).Cast<bool >())
			hxOrEq(flags,4);
		if (x->__Field(STRING(L"defaultParameters",17)).Cast<Array<format::abc::Value > >() != null())
			hxOrEq(flags,8);
		if (x->__Field(STRING(L"unused",6)).Cast<bool >())
			hxOrEq(flags,16);
		if (x->__Field(STRING(L"native",6)).Cast<bool >())
			hxOrEq(flags,32);
		if (x->__Field(STRING(L"usesDXNS",8)).Cast<bool >())
			hxOrEq(flags,64);
		if (x->__Field(STRING(L"paramNames",10)).Cast<Array<format::abc::Index > >() != null())
			hxOrEq(flags,128);
		this->o->writeByte(flags);
		if (x->__Field(STRING(L"defaultParameters",17)).Cast<Array<format::abc::Value > >() != null()){
			this->o->writeByte(x->__Field(STRING(L"defaultParameters",17)).Cast<Array<format::abc::Value > >()->length);
			{
				int _g = 0;
				Array<format::abc::Value > _g1 = x->__Field(STRING(L"defaultParameters",17)).Cast<Array<format::abc::Value > >();
				while(_g < _g1->length){
					format::abc::Value v = _g1->__get(_g);
					++_g;
					this->writeValue(true,v);
				}
			}
		}
		if (x->__Field(STRING(L"paramNames",10)).Cast<Array<format::abc::Index > >() != null()){
			if (x->__Field(STRING(L"paramNames",10)).Cast<Array<format::abc::Index > >()->length != m->__Field(STRING(L"args",4)).Cast<Array<format::abc::Index > >()->length)
				hxThrow (STRING(L"assert",6));
			{
				int _g = 0;
				Array<format::abc::Index > _g1 = x->__Field(STRING(L"paramNames",10)).Cast<Array<format::abc::Index > >();
				while(_g < _g1->length){
					format::abc::Index i = _g1->__get(_g);
					++_g;
					this->writeIndexOpt(i);
				}
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeMethodType,(void))

Void Writer_obj::writeMetadata( Dynamic m){
{
		this->writeIndex(m->__Field(STRING(L"name",4)).Cast<format::abc::Index >());
		this->opw->writeInt(m->__Field(STRING(L"data",4)).Cast<Array<Dynamic > >()->length);
		{
			int _g = 0;
			Array<Dynamic > _g1 = m->__Field(STRING(L"data",4)).Cast<Array<Dynamic > >();
			while(_g < _g1->length){
				Dynamic d = _g1->__get(_g);
				++_g;
				this->writeIndex(d->__Field(STRING(L"n",1)).Cast<format::abc::Index >());
			}
		}
		{
			int _g = 0;
			Array<Dynamic > _g1 = m->__Field(STRING(L"data",4)).Cast<Array<Dynamic > >();
			while(_g < _g1->length){
				Dynamic d = _g1->__get(_g);
				++_g;
				this->writeIndex(d->__Field(STRING(L"v",1)).Cast<format::abc::Index >());
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeMetadata,(void))

Void Writer_obj::writeClass( Dynamic c){
{
		this->writeIndex(c->__Field(STRING(L"name",4)).Cast<format::abc::Index >());
		this->writeIndexOpt(c->__Field(STRING(L"superclass",10)).Cast<format::abc::Index >());
		int flags = 0;
		if (c->__Field(STRING(L"isSealed",8)).Cast<bool >())
			hxOrEq(flags,1);
		if (c->__Field(STRING(L"isFinal",7)).Cast<bool >())
			hxOrEq(flags,2);
		if (c->__Field(STRING(L"isInterface",11)).Cast<bool >())
			hxOrEq(flags,4);
		if (c->__Field(STRING(L"_namespace",10)).Cast<format::abc::Index >() != null())
			hxOrEq(flags,8);
		this->o->writeByte(flags);
		if (c->__Field(STRING(L"_namespace",10)).Cast<format::abc::Index >() != null())
			this->writeIndex(c->__Field(STRING(L"_namespace",10)).Cast<format::abc::Index >());
		this->writeList2(c->__Field(STRING(L"interfaces",10)).Cast<Array<format::abc::Index > >(),this->writeIndex_dyn());
		this->writeIndex(c->__Field(STRING(L"constructor",11)).Cast<format::abc::Index >());
		this->writeList2(c->__Field(STRING(L"fields",6)).Cast<Array<Dynamic > >(),this->writeField_dyn());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeClass,(void))

Void Writer_obj::writeInit( Dynamic i){
{
		this->writeIndex(i->__Field(STRING(L"method",6)).Cast<format::abc::Index >());
		this->writeList2(i->__Field(STRING(L"fields",6)).Cast<Array<Dynamic > >(),this->writeField_dyn());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeInit,(void))

Void Writer_obj::writeTryCatch( Dynamic t){
{
		this->opw->writeInt(t->__Field(STRING(L"start",5)).Cast<int >());
		this->opw->writeInt(t->__Field(STRING(L"end",3)).Cast<int >());
		this->opw->writeInt(t->__Field(STRING(L"handle",6)).Cast<int >());
		this->writeIndexOpt(t->__Field(STRING(L"type",4)).Cast<format::abc::Index >());
		this->writeIndexOpt(t->__Field(STRING(L"variable",8)).Cast<format::abc::Index >());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeTryCatch,(void))

Void Writer_obj::writeFunction( Dynamic f){
{
		this->writeIndex(f->__Field(STRING(L"type",4)).Cast<format::abc::Index >());
		this->opw->writeInt(f->__Field(STRING(L"maxStack",8)).Cast<int >());
		this->opw->writeInt(f->__Field(STRING(L"nRegs",5)).Cast<int >());
		this->opw->writeInt(f->__Field(STRING(L"initScope",9)).Cast<int >());
		this->opw->writeInt(f->__Field(STRING(L"maxScope",8)).Cast<int >());
		this->opw->writeInt(f->__Field(STRING(L"code",4)).Cast<haxe::io::Bytes >()->length);
		this->o->write(f->__Field(STRING(L"code",4)).Cast<haxe::io::Bytes >());
		this->writeList2(f->__Field(STRING(L"trys",4)).Cast<Array<Dynamic > >(),this->writeTryCatch_dyn());
		this->writeList2(f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >(),this->writeField_dyn());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFunction,(void))

Void Writer_obj::writeABC( format::abc::ABCData d){
{
		this->o->writeInt31(3014672);
		this->writeList(d->ints,this->opw->writeInt32_dyn());
		this->writeList(d->uints,this->opw->writeInt32_dyn());
		this->writeList(d->floats,this->o->writeDouble_dyn());
		this->writeList(d->strings,this->writeString_dyn());
		this->writeList(d->namespaces,this->writeNamespace_dyn());
		this->writeList(d->nssets,this->writeNsSet_dyn());

		BEGIN_LOCAL_FUNC0(_Function_1)
		Dynamic run(Dynamic $t1,int $t2){
{
				Array<int > a1 = Array_obj<int >::__new().Add($t2);
				Array<Dynamic > f = Array_obj<Dynamic >::__new().Add($t1);

				BEGIN_LOCAL_FUNC2(_Function_2,Array<Dynamic >,f,Array<int >,a1)
				Void run(format::abc::Name a2){
					f->__get(0)(a1->__get(0),a2);
					return null();
				}
				END_LOCAL_FUNC1((void))

				return  Dynamic(new _Function_2(f,a1));
			}
			return null();
		}
		END_LOCAL_FUNC2(return)

		this->writeList(d->names, Dynamic(new _Function_1())(this->writeName_dyn(),-1));
		this->writeList2(d->methodTypes,this->writeMethodType_dyn());
		this->writeList2(d->metadatas,this->writeMetadata_dyn());
		this->writeList2(d->classes,this->writeClass_dyn());
		{
			int _g = 0;
			Array<Dynamic > _g1 = d->classes;
			while(_g < _g1->length){
				Dynamic c = _g1->__get(_g);
				++_g;
				this->writeIndex(c->__Field(STRING(L"statics",7)).Cast<format::abc::Index >());
				this->writeList2(c->__Field(STRING(L"staticFields",12)).Cast<Array<Dynamic > >(),this->writeField_dyn());
			}
		}
		this->writeList2(d->inits,this->writeInit_dyn());
		this->writeList2(d->functions,this->writeFunction_dyn());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeABC,(void))

Void Writer_obj::write( haxe::io::Output out,format::abc::ABCData data){
{
		format::abc::Writer w = format::abc::Writer_obj::__new(out);
		w->writeABC(data);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC2(Writer_obj,write,(void))


Writer_obj::Writer_obj()
{
	InitMember(o);
	InitMember(opw);
}

void Writer_obj::__Mark()
{
	MarkMember(o);
	MarkMember(opw);
}

Dynamic Writer_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { return o; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"opw",sizeof(wchar_t)*3) ) { return opw; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"write",sizeof(wchar_t)*5) ) { return write_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"beginTag",sizeof(wchar_t)*8) ) { return beginTag_dyn(); }
		if (!memcmp(inName.__s,L"writeInt",sizeof(wchar_t)*8) ) { return writeInt_dyn(); }
		if (!memcmp(inName.__s,L"writeABC",sizeof(wchar_t)*8) ) { return writeABC_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"writeUInt",sizeof(wchar_t)*9) ) { return writeUInt_dyn(); }
		if (!memcmp(inName.__s,L"writeList",sizeof(wchar_t)*9) ) { return writeList_dyn(); }
		if (!memcmp(inName.__s,L"writeName",sizeof(wchar_t)*9) ) { return writeName_dyn(); }
		if (!memcmp(inName.__s,L"writeInit",sizeof(wchar_t)*9) ) { return writeInit_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"writeList2",sizeof(wchar_t)*10) ) { return writeList2_dyn(); }
		if (!memcmp(inName.__s,L"writeIndex",sizeof(wchar_t)*10) ) { return writeIndex_dyn(); }
		if (!memcmp(inName.__s,L"writeNsSet",sizeof(wchar_t)*10) ) { return writeNsSet_dyn(); }
		if (!memcmp(inName.__s,L"writeValue",sizeof(wchar_t)*10) ) { return writeValue_dyn(); }
		if (!memcmp(inName.__s,L"writeField",sizeof(wchar_t)*10) ) { return writeField_dyn(); }
		if (!memcmp(inName.__s,L"writeClass",sizeof(wchar_t)*10) ) { return writeClass_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"writeString",sizeof(wchar_t)*11) ) { return writeString_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"writeIndexOpt",sizeof(wchar_t)*13) ) { return writeIndexOpt_dyn(); }
		if (!memcmp(inName.__s,L"writeNameByte",sizeof(wchar_t)*13) ) { return writeNameByte_dyn(); }
		if (!memcmp(inName.__s,L"writeMetadata",sizeof(wchar_t)*13) ) { return writeMetadata_dyn(); }
		if (!memcmp(inName.__s,L"writeTryCatch",sizeof(wchar_t)*13) ) { return writeTryCatch_dyn(); }
		if (!memcmp(inName.__s,L"writeFunction",sizeof(wchar_t)*13) ) { return writeFunction_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"writeNamespace",sizeof(wchar_t)*14) ) { return writeNamespace_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"writeMethodType",sizeof(wchar_t)*15) ) { return writeMethodType_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_write = __hxcpp_field_to_id("write");
static int __id_o = __hxcpp_field_to_id("o");
static int __id_opw = __hxcpp_field_to_id("opw");
static int __id_beginTag = __hxcpp_field_to_id("beginTag");
static int __id_writeInt = __hxcpp_field_to_id("writeInt");
static int __id_writeUInt = __hxcpp_field_to_id("writeUInt");
static int __id_writeList = __hxcpp_field_to_id("writeList");
static int __id_writeList2 = __hxcpp_field_to_id("writeList2");
static int __id_writeString = __hxcpp_field_to_id("writeString");
static int __id_writeIndex = __hxcpp_field_to_id("writeIndex");
static int __id_writeIndexOpt = __hxcpp_field_to_id("writeIndexOpt");
static int __id_writeNamespace = __hxcpp_field_to_id("writeNamespace");
static int __id_writeNsSet = __hxcpp_field_to_id("writeNsSet");
static int __id_writeNameByte = __hxcpp_field_to_id("writeNameByte");
static int __id_writeName = __hxcpp_field_to_id("writeName");
static int __id_writeValue = __hxcpp_field_to_id("writeValue");
static int __id_writeField = __hxcpp_field_to_id("writeField");
static int __id_writeMethodType = __hxcpp_field_to_id("writeMethodType");
static int __id_writeMetadata = __hxcpp_field_to_id("writeMetadata");
static int __id_writeClass = __hxcpp_field_to_id("writeClass");
static int __id_writeInit = __hxcpp_field_to_id("writeInit");
static int __id_writeTryCatch = __hxcpp_field_to_id("writeTryCatch");
static int __id_writeFunction = __hxcpp_field_to_id("writeFunction");
static int __id_writeABC = __hxcpp_field_to_id("writeABC");


Dynamic Writer_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_write) return write_dyn();
	if (inFieldID==__id_o) return o;
	if (inFieldID==__id_opw) return opw;
	if (inFieldID==__id_beginTag) return beginTag_dyn();
	if (inFieldID==__id_writeInt) return writeInt_dyn();
	if (inFieldID==__id_writeUInt) return writeUInt_dyn();
	if (inFieldID==__id_writeList) return writeList_dyn();
	if (inFieldID==__id_writeList2) return writeList2_dyn();
	if (inFieldID==__id_writeString) return writeString_dyn();
	if (inFieldID==__id_writeIndex) return writeIndex_dyn();
	if (inFieldID==__id_writeIndexOpt) return writeIndexOpt_dyn();
	if (inFieldID==__id_writeNamespace) return writeNamespace_dyn();
	if (inFieldID==__id_writeNsSet) return writeNsSet_dyn();
	if (inFieldID==__id_writeNameByte) return writeNameByte_dyn();
	if (inFieldID==__id_writeName) return writeName_dyn();
	if (inFieldID==__id_writeValue) return writeValue_dyn();
	if (inFieldID==__id_writeField) return writeField_dyn();
	if (inFieldID==__id_writeMethodType) return writeMethodType_dyn();
	if (inFieldID==__id_writeMetadata) return writeMetadata_dyn();
	if (inFieldID==__id_writeClass) return writeClass_dyn();
	if (inFieldID==__id_writeInit) return writeInit_dyn();
	if (inFieldID==__id_writeTryCatch) return writeTryCatch_dyn();
	if (inFieldID==__id_writeFunction) return writeFunction_dyn();
	if (inFieldID==__id_writeABC) return writeABC_dyn();
	return super::__IField(inFieldID);
}

Dynamic Writer_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { o=inValue.Cast<haxe::io::Output >();return inValue; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"opw",sizeof(wchar_t)*3) ) { opw=inValue.Cast<format::abc::OpWriter >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Writer_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"o",1));
	outFields->push(STRING(L"opw",3));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"write",5),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"o",1),
	STRING(L"opw",3),
	STRING(L"beginTag",8),
	STRING(L"writeInt",8),
	STRING(L"writeUInt",9),
	STRING(L"writeList",9),
	STRING(L"writeList2",10),
	STRING(L"writeString",11),
	STRING(L"writeIndex",10),
	STRING(L"writeIndexOpt",13),
	STRING(L"writeNamespace",14),
	STRING(L"writeNsSet",10),
	STRING(L"writeNameByte",13),
	STRING(L"writeName",9),
	STRING(L"writeValue",10),
	STRING(L"writeField",10),
	STRING(L"writeMethodType",15),
	STRING(L"writeMetadata",13),
	STRING(L"writeClass",10),
	STRING(L"writeInit",9),
	STRING(L"writeTryCatch",13),
	STRING(L"writeFunction",13),
	STRING(L"writeABC",8),
	String(null()) };

static void sMarkStatics() {
};

Class Writer_obj::__mClass;

void Writer_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.abc.Writer",17), TCanCast<Writer_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Writer_obj::__boot()
{
}

} // end namespace format
} // end namespace abc
