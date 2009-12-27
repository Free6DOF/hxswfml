#include <hxObject.h>

#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_StringTools
#include <StringTools.h>
#endif
#ifndef INCLUDED_Type
#include <Type.h>
#endif
#ifndef INCLUDED_be_haxer_hxswfml_Hxvml
#include <be/haxer/hxswfml/Hxvml.h>
#endif
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_cpp_io_File
#include <cpp/io/File.h>
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
#ifndef INCLUDED_format_abc_JumpStyle
#include <format/abc/JumpStyle.h>
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
#ifndef INCLUDED_format_abc_OpCode
#include <format/abc/OpCode.h>
#endif
#ifndef INCLUDED_format_abc_OpReader
#include <format/abc/OpReader.h>
#endif
#ifndef INCLUDED_format_abc_Operation
#include <format/abc/Operation.h>
#endif
#ifndef INCLUDED_format_abc_Reader
#include <format/abc/Reader.h>
#endif
#ifndef INCLUDED_format_abc_Value
#include <format/abc/Value.h>
#endif
#ifndef INCLUDED_format_swf_Reader
#include <format/swf/Reader.h>
#endif
#ifndef INCLUDED_format_swf_SWFTag
#include <format/swf/SWFTag.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesInput
#include <haxe/io/BytesInput.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace be{
namespace haxer{
namespace hxswfml{

Void Hxvml_obj::__construct()
{
{
}
;
	return null();
}

Hxvml_obj::~Hxvml_obj() { }

Dynamic Hxvml_obj::__CreateEmpty() { return  new Hxvml_obj; }
hxObjectPtr<Hxvml_obj > Hxvml_obj::__new()
{  hxObjectPtr<Hxvml_obj > result = new Hxvml_obj();
	result->__construct();
	return result;}

Dynamic Hxvml_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Hxvml_obj > result = new Hxvml_obj();
	result->__construct();
	return result;}

String Hxvml_obj::abc2xml( String fileName){
	String xmll = STRING(L"<abcfiles>\n",11);
	if (StringTools_obj::endsWith(fileName,STRING(L".abc",4))){
		hxAddEq(xmll,this->abcToXml(cpp::io::File_obj::getBytes(fileName)));
	}
	else
		if (StringTools_obj::endsWith(fileName,STRING(L".swf",4))){
		haxe::io::Bytes swf = cpp::io::File_obj::getBytes(fileName);
		haxe::io::BytesInput swfBytesInput = haxe::io::BytesInput_obj::__new(swf,null(),null());
		format::swf::Reader swfReader = format::swf::Reader_obj::__new(swfBytesInput);
		Dynamic header = swfReader->readHeader();
		Array<format::swf::SWFTag > tags = swfReader->readTagList();
		swfBytesInput->close();
		{
			int _g = 0;
			while(_g < tags->length){
				format::swf::SWFTag tag = tags->__get(_g);
				++_g;
				format::swf::SWFTag _switch_1 = (tag);
				switch((_switch_1)->GetIndex()){
					case 13: {
						Dynamic ctx = _switch_1->__Param(1);
						haxe::io::Bytes data = _switch_1->__Param(0);
{
							hxAddEq(xmll,this->abcToXml(data));
						}
					}
					break;
					default: {
					}
				}
			}
		}
	}
;
;
	return xmll + STRING(L"</abcfiles>",11);
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,abc2xml,return )

String Hxvml_obj::abcToXml( haxe::io::Bytes data){
	format::abc::Reader abcReader = format::abc::Reader_obj::__new(haxe::io::BytesInput_obj::__new(data,null(),null()));
	this->abcFile = abcReader->read();
	this->functionClosures = Array_obj<String >::__new();
	this->indentLevel = 1;
	this->xml = this->indent() + STRING(L"<abcfile>\n",10);
	this->indentLevel++;
	bool hasMethodBody = false;
	{
		int _g = 0;
		Array<Dynamic > _g1 = this->abcFile->classes;
		while(_g < _g1->length){
			Dynamic _class = _g1->__get(_g);
			++_g;
			String clName = this->getName(_class->__Field(STRING(L"name",4)).Cast<format::abc::Index >());
			this->className = clName;
			String _extends = this->getName(_class->__Field(STRING(L"superclass",10)).Cast<format::abc::Index >());
			Array<format::abc::Index > _implements = _class->__Field(STRING(L"interfaces",10)).Cast<Array<format::abc::Index > >();
			String __implements = STRING(L"",0);
			{
				int _g2 = 0;
				while(_g2 < _implements->length){
					format::abc::Index i = _implements->__get(_g2);
					++_g2;
					hxAddEq(__implements,this->getName(i) + STRING(L",",1));
				}
			}
			String _ns = this->getNamespace(_class->__Field(STRING(L"namespace",9)).Cast<format::abc::Index >());
			bool _sealed = _class->__Field(STRING(L"isSealed",8)).Cast<bool >();
			bool _final = _class->__Field(STRING(L"isFinal",7)).Cast<bool >();
			bool _interface = _class->__Field(STRING(L"isInterface",11)).Cast<bool >();
			Dynamic script_init = null();
			{
				int _g2 = 0;
				Array<Dynamic > _g3 = this->abcFile->inits;
				while(_g2 < _g3->length){
					Dynamic i = _g3->__get(_g2);
					++_g2;
					{
						int _g4 = 0;
						Array<Dynamic > _g5 = i->__Field(STRING(L"fields",6)).Cast<Array<Dynamic > >();
						while(_g4 < _g5->length){
							Dynamic field = _g5->__get(_g4);
							++_g4;
							format::abc::FieldKind _switch_2 = (field->__Field(STRING(L"kind",4)).Cast<format::abc::FieldKind >());
							switch((_switch_2)->GetIndex()){
								case 2: {
									format::abc::Index c = _switch_2->__Param(0);
{
										if ((_class == this->abcFile->classes->__get(Type_obj::enumParameters(c)->__get(0)))){
											script_init = this->getMethod(i->__Field(STRING(L"method",6)).Cast<format::abc::Index >());
											break;
										}
									}
								}
								break;
								default: {
								}
							}
						}
					}
				}
			}
			if (script_init != null()){
				String stargsStr = STRING(L"",0);
				{
					int _g2 = 0;
					Array<format::abc::Index > _g3 = script_init->__Field(STRING(L"args",4)).Cast<Array<format::abc::Index > >();
					while(_g2 < _g3->length){
						format::abc::Index a = _g3->__get(_g2);
						++_g2;
						hxAddEq(stargsStr,this->getName(a) + STRING(L",",1));
					}
				}
				String ret = this->getName(script_init->__Field(STRING(L"ret",3)).Cast<format::abc::Index >());
				hxAddEq(this->xml,this->indent() + STRING(L"<init",5));
				hxAddEq(this->xml,STRING(L" name=\"",7) + clName + STRING(L"\"",1));
				if (stargsStr != STRING(L"",0))
					hxAddEq(this->xml,STRING(L" args=\"",7) + this->cutComma(stargsStr) + STRING(L"\"",1));
				hxAddEq(this->xml,STRING(L" return=\"",9) + ret + STRING(L"\"",1));
				hxAddEq(this->xml,this->parseMethodExtra(script_init->__Field(STRING(L"extra",5))));
				{
					int _g2 = 0;
					Array<Dynamic > _g3 = this->abcFile->functions;
					while(_g2 < _g3->length){
						Dynamic f = _g3->__get(_g2);
						++_g2;
						if (Type_obj::enumEq(this->getMethod(f->__Field(STRING(L"type",4)).Cast<format::abc::Index >()),script_init)){
							if (f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()->length != 0)
								hxAddEq(this->xml,STRING(L" locals=\"",9) + this->parseLocals(f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()) + STRING(L"\"",1));
							hxAddEq(this->xml,STRING(L" >\n",3));
							this->decodeToXML(format::abc::OpReader_obj::decode(haxe::io::BytesInput_obj::__new(f->__Field(STRING(L"code",4)).Cast<haxe::io::Bytes >(),null(),null())),f);
							hxAddEq(this->xml,this->indent() + STRING(L"</init>\n",8));
							break;
						}
					}
				}
			}
			hxAddEq(this->xml,this->indent() + STRING(L"<class ",7));
			hxAddEq(this->xml,STRING(L" name=\"",7) + clName + STRING(L"\"",1));
			if (bool(_extends != null()) && bool(_extends != STRING(L"",0)))
				hxAddEq(this->xml,STRING(L" extends=\"",10) + _extends + STRING(L"\"",1));
			if (__implements != STRING(L"",0))
				hxAddEq(this->xml,STRING(L" implements=\"",13) + this->cutComma(__implements) + STRING(L"\"",1));
			if (_sealed)
				hxAddEq(this->xml,STRING(L" sealed=\"",9) + _sealed + STRING(L"\"",1));
			if (_final)
				hxAddEq(this->xml,STRING(L" final=\"",8) + _final + STRING(L"\"",1));
			if (_interface)
				hxAddEq(this->xml,STRING(L" interface=\"",12) + _interface + STRING(L"\"",1));
			hxAddEq(this->xml,STRING(L">\n",2));
			this->indentLevel++;
			{
				int _g2 = 0;
				Array<Dynamic > _g3 = _class->__Field(STRING(L"fields",6)).Cast<Array<Dynamic > >();
				while(_g2 < _g3->length){
					Dynamic field = _g3->__get(_g2);
					++_g2;
					format::abc::FieldKind _switch_3 = (field->__Field(STRING(L"kind",4)).Cast<format::abc::FieldKind >());
					switch((_switch_3)->GetIndex()){
						case 0: {
							Dynamic const = _switch_3->__Param(2);
							format::abc::Value value = _switch_3->__Param(1);
							format::abc::Index type = _switch_3->__Param(0);
{
								String _type = this->getName(type);
								String _value = this->getValue(value);
								Dynamic _const = const;
								hxAddEq(this->xml,this->indent() + STRING(L"<var name=\"",11) + this->getFieldName(field->__Field(STRING(L"name",4)).Cast<format::abc::Index >()) + STRING(L"\"",1));
								if (bool(_type != null()) && bool(bool(_type != STRING(L"*",1)) && bool(_type != STRING(L"",0))))
									hxAddEq(this->xml,STRING(L" type=\"",7) + _type + STRING(L"\"",1));
								if (_value != STRING(L"",0))
									hxAddEq(this->xml,STRING(L" value=\"",8) + _value + STRING(L"\"",1));
								if (_const)
									hxAddEq(this->xml,STRING(L" const=\"",8) + _const + STRING(L"\"",1));
								hxAddEq(this->xml,STRING(L"/>\n",3));
							}
						}
						break;
						default: {
						}
					}
				}
			}
			{
				int _g2 = 0;
				Array<Dynamic > _g3 = _class->__Field(STRING(L"staticFields",12)).Cast<Array<Dynamic > >();
				while(_g2 < _g3->length){
					Dynamic field = _g3->__get(_g2);
					++_g2;
					format::abc::FieldKind _switch_4 = (field->__Field(STRING(L"kind",4)).Cast<format::abc::FieldKind >());
					switch((_switch_4)->GetIndex()){
						case 0: {
							Dynamic const = _switch_4->__Param(2);
							format::abc::Value value = _switch_4->__Param(1);
							format::abc::Index type = _switch_4->__Param(0);
{
								String _type = this->getName(type);
								String _value = this->getValue(value);
								Dynamic _const = const;
								hxAddEq(this->xml,this->indent() + STRING(L"<var name=\"",11) + this->getFieldName(field->__Field(STRING(L"name",4)).Cast<format::abc::Index >()) + STRING(L"\"",1));
								if (bool(_type != null()) && bool(bool(_type != STRING(L"*",1)) && bool(_type != STRING(L"",0))))
									hxAddEq(this->xml,STRING(L" type=\"",7) + _type + STRING(L"\"",1));
								if (_value != STRING(L"",0))
									hxAddEq(this->xml,STRING(L" value=\"",8) + _value + STRING(L"\"",1));
								if (_const)
									hxAddEq(this->xml,STRING(L" const=\"",8) + _const + STRING(L"\"",1));
								hxAddEq(this->xml,STRING(L" static=\"true\"",14));
								hxAddEq(this->xml,STRING(L"/>\n",3));
							}
						}
						break;
						default: {
						}
					}
				}
			}
			Dynamic cst = this->getMethod(_class->__Field(STRING(L"constructor",11)).Cast<format::abc::Index >());
			String cargsStr = STRING(L"",0);
			{
				int _g2 = 0;
				Array<format::abc::Index > _g3 = cst->__Field(STRING(L"args",4)).Cast<Array<format::abc::Index > >();
				while(_g2 < _g3->length){
					format::abc::Index a = _g3->__get(_g2);
					++_g2;
					hxAddEq(cargsStr,this->getName(a) + STRING(L",",1));
				}
			}
			String returnType = this->getName(cst->__Field(STRING(L"ret",3)).Cast<format::abc::Index >());
			hxAddEq(this->xml,this->indent() + STRING(L"<function",9));
			hxAddEq(this->xml,STRING(L" name=\"",7) + clName + STRING(L"\"",1));
			hxAddEq(this->xml,STRING(L" args=\"",7) + this->cutComma(cargsStr) + STRING(L"\"",1));
			hxAddEq(this->xml,STRING(L" return=\"",9) + returnType + STRING(L"\"",1));
			hxAddEq(this->xml,this->parseMethodExtra(cst->__Field(STRING(L"extra",5))));
			{
				int _g2 = 0;
				Array<Dynamic > _g3 = this->abcFile->functions;
				while(_g2 < _g3->length){
					Dynamic f = _g3->__get(_g2);
					++_g2;
					if (Type_obj::enumEq(f->__Field(STRING(L"type",4)).Cast<format::abc::Index >(),_class->__Field(STRING(L"constructor",11)).Cast<format::abc::Index >())){
						if (f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()->length != 0)
							hxAddEq(this->xml,STRING(L" locals=\"",9) + this->parseLocals(f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()) + STRING(L"\"",1));
						hxAddEq(this->xml,STRING(L" >\n",3));
						this->decodeToXML(format::abc::OpReader_obj::decode(haxe::io::BytesInput_obj::__new(f->__Field(STRING(L"code",4)).Cast<haxe::io::Bytes >(),null(),null())),f);
						break;
					}
				}
			}
			if (_interface)
				hxAddEq(this->xml,STRING(L" >\n",3) + this->indent() + STRING(L"</function>\n\n",13));
			else
				hxAddEq(this->xml,this->indent() + STRING(L"</function>\n\n",13));
;
			Dynamic st = this->getMethod(_class->__Field(STRING(L"statics",7)).Cast<format::abc::Index >());
			String stargsStr = STRING(L"",0);
			{
				int _g2 = 0;
				Array<format::abc::Index > _g3 = st->__Field(STRING(L"args",4)).Cast<Array<format::abc::Index > >();
				while(_g2 < _g3->length){
					format::abc::Index a = _g3->__get(_g2);
					++_g2;
					hxAddEq(stargsStr,this->getName(a) + STRING(L",",1));
				}
			}
			String ret = this->getName(st->__Field(STRING(L"ret",3)).Cast<format::abc::Index >());
			hxAddEq(this->xml,this->indent() + STRING(L"<function",9));
			hxAddEq(this->xml,STRING(L" name=\"",7) + this->getName(_class->__Field(STRING(L"name",4)).Cast<format::abc::Index >()) + STRING(L"\"",1));
			hxAddEq(this->xml,STRING(L" static=\"true\"",14));
			if (stargsStr != STRING(L"",0))
				hxAddEq(this->xml,STRING(L" args=\"",7) + this->cutComma(stargsStr) + STRING(L"\"",1));
			hxAddEq(this->xml,STRING(L" return=\"",9) + ret + STRING(L"\"",1));
			hxAddEq(this->xml,this->parseMethodExtra(st->__Field(STRING(L"extra",5))));
			{
				int _g2 = 0;
				Array<Dynamic > _g3 = this->abcFile->functions;
				while(_g2 < _g3->length){
					Dynamic f = _g3->__get(_g2);
					++_g2;
					if (Type_obj::enumEq(this->getMethod(f->__Field(STRING(L"type",4)).Cast<format::abc::Index >()),st)){
						if (f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()->length != 0)
							hxAddEq(this->xml,STRING(L" locals=\"",9) + this->parseLocals(f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()) + STRING(L"\"",1));
						hxAddEq(this->xml,STRING(L" >\n",3));
						this->decodeToXML(format::abc::OpReader_obj::decode(haxe::io::BytesInput_obj::__new(f->__Field(STRING(L"code",4)).Cast<haxe::io::Bytes >(),null(),null())),f);
						break;
					}
				}
			}
			hxAddEq(this->xml,this->indent() + STRING(L"</function>\n\n",13));
			{
				int _g2 = 0;
				Array<Dynamic > _g3 = _class->__Field(STRING(L"fields",6)).Cast<Array<Dynamic > >();
				while(_g2 < _g3->length){
					Dynamic field = _g3->__get(_g2);
					++_g2;
					format::abc::FieldKind _switch_5 = (field->__Field(STRING(L"kind",4)).Cast<format::abc::FieldKind >());
					switch((_switch_5)->GetIndex()){
						case 1: {
							Dynamic isOverride = _switch_5->__Param(3);
							Dynamic isFinal = _switch_5->__Param(2);
							format::abc::MethodKind k = _switch_5->__Param(1);
							format::abc::Index type = _switch_5->__Param(0);
{
								Dynamic _m = this->getMethod(type);
								String _args = STRING(L"",0);
								{
									int _g4 = 0;
									Array<format::abc::Index > _g5 = _m->__Field(STRING(L"args",4)).Cast<Array<format::abc::Index > >();
									while(_g4 < _g5->length){
										format::abc::Index a = _g5->__get(_g4);
										++_g4;
										hxAddEq(_args,this->getName(a) + STRING(L",",1));
									}
								}
								String _ret = this->getName(_m->__Field(STRING(L"ret",3)).Cast<format::abc::Index >());
								struct _Function_1{
									static String Block( format::abc::MethodKind &k)/* DEF (not block)(ret intern) */{
										format::abc::MethodKind _switch_6 = (k);
										switch((_switch_6)->GetIndex()){
											case 0: {
												return STRING(L"normal",6);
											}
											break;
											case 2: {
												return STRING(L"setter",6);
											}
											break;
											case 1: {
												return STRING(L"getter",6);
											}
											break;
											default: {
												return null();
											}
										}
									}
								};
								String _k = _Function_1::Block(k);
								String _name = this->getFieldName(field->__Field(STRING(L"name",4)).Cast<format::abc::Index >());
								hxAddEq(this->xml,this->indent() + STRING(L"<function",9));
								hxAddEq(this->xml,STRING(L" name=\"",7) + _name + STRING(L"\"",1));
								if (isOverride)
									hxAddEq(this->xml,STRING(L" override=\"",11) + isOverride + STRING(L"\"",1));
								if (isFinal)
									hxAddEq(this->xml,STRING(L" final=\"",8) + isFinal + STRING(L"\"",1));
								if (_k != STRING(L"normal",6))
									hxAddEq(this->xml,STRING(L" kind=\"",7) + _k + STRING(L"\"",1));
								hxAddEq(this->xml,STRING(L" args=\"",7) + this->cutComma(_args) + STRING(L"\"",1));
								hxAddEq(this->xml,STRING(L" return=\"",9) + _ret + STRING(L"\"",1));
								hxAddEq(this->xml,this->parseMethodExtra(_m->__Field(STRING(L"extra",5))));
								hasMethodBody = false;
								{
									int _g4 = 0;
									Array<Dynamic > _g5 = this->abcFile->functions;
									while(_g4 < _g5->length){
										Dynamic f = _g5->__get(_g4);
										++_g4;
										if (Type_obj::enumEq(f->__Field(STRING(L"type",4)).Cast<format::abc::Index >(),type)){
											hasMethodBody = true;
											if (f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()->length != 0)
												hxAddEq(this->xml,STRING(L" locals=\"",9) + this->parseLocals(f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()) + STRING(L"\"",1));
											hxAddEq(this->xml,STRING(L" >\n",3));
											this->decodeToXML(format::abc::OpReader_obj::decode(haxe::io::BytesInput_obj::__new(f->__Field(STRING(L"code",4)).Cast<haxe::io::Bytes >(),null(),null())),f);
											break;
										}
									}
								}
								if (!hasMethodBody)
									hxAddEq(this->xml,STRING(L" >\n",3));
								hxAddEq(this->xml,this->indent() + STRING(L"</function>\n\n",13));
							}
						}
						break;
						default: {
						}
					}
				}
			}
			{
				int _g2 = 0;
				Array<Dynamic > _g3 = _class->__Field(STRING(L"staticFields",12)).Cast<Array<Dynamic > >();
				while(_g2 < _g3->length){
					Dynamic field = _g3->__get(_g2);
					++_g2;
					format::abc::FieldKind _switch_7 = (field->__Field(STRING(L"kind",4)).Cast<format::abc::FieldKind >());
					switch((_switch_7)->GetIndex()){
						case 1: {
							Dynamic isOverride = _switch_7->__Param(3);
							Dynamic isFinal = _switch_7->__Param(2);
							format::abc::MethodKind k = _switch_7->__Param(1);
							format::abc::Index type = _switch_7->__Param(0);
{
								Dynamic _m = this->getMethod(type);
								String _args = STRING(L"",0);
								{
									int _g4 = 0;
									Array<format::abc::Index > _g5 = _m->__Field(STRING(L"args",4)).Cast<Array<format::abc::Index > >();
									while(_g4 < _g5->length){
										format::abc::Index a = _g5->__get(_g4);
										++_g4;
										hxAddEq(_args,this->getName(a) + STRING(L",",1));
									}
								}
								String _ret = this->getName(_m->__Field(STRING(L"ret",3)).Cast<format::abc::Index >());
								struct _Function_1{
									static String Block( format::abc::MethodKind &k)/* DEF (not block)(ret intern) */{
										format::abc::MethodKind _switch_8 = (k);
										switch((_switch_8)->GetIndex()){
											case 0: {
												return STRING(L"normal",6);
											}
											break;
											case 2: {
												return STRING(L"setter",6);
											}
											break;
											case 1: {
												return STRING(L"getter",6);
											}
											break;
											default: {
												return null();
											}
										}
									}
								};
								String _k = _Function_1::Block(k);
								String _name = this->getFieldName(field->__Field(STRING(L"name",4)).Cast<format::abc::Index >());
								hxAddEq(this->xml,this->indent() + STRING(L"<function ",10));
								hxAddEq(this->xml,STRING(L" name=\"",7) + _name + STRING(L"\"",1));
								hxAddEq(this->xml,STRING(L" static=\"true\"",14));
								if (isOverride)
									hxAddEq(this->xml,STRING(L" override=\"",11) + isOverride + STRING(L"\"",1));
								if (isFinal)
									hxAddEq(this->xml,STRING(L" final=\"",8) + isFinal + STRING(L"\"",1));
								if (_k != STRING(L"normal",6))
									hxAddEq(this->xml,STRING(L" kind=\"",7) + _k + STRING(L"\"",1));
								hxAddEq(this->xml,STRING(L" args=\"",7) + this->cutComma(_args) + STRING(L"\"",1));
								hxAddEq(this->xml,STRING(L" return=\"",9) + _ret + STRING(L"\"",1));
								hxAddEq(this->xml,this->parseMethodExtra(_m->__Field(STRING(L"extra",5))));
								hasMethodBody = false;
								{
									int _g4 = 0;
									Array<Dynamic > _g5 = this->abcFile->functions;
									while(_g4 < _g5->length){
										Dynamic f = _g5->__get(_g4);
										++_g4;
										if (Type_obj::enumEq(f->__Field(STRING(L"type",4)).Cast<format::abc::Index >(),type)){
											hasMethodBody = true;
											if (f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()->length != 0)
												hxAddEq(this->xml,STRING(L" locals=\"",9) + this->parseLocals(f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()) + STRING(L"\"",1));
											hxAddEq(this->xml,STRING(L" >\n",3));
											this->decodeToXML(format::abc::OpReader_obj::decode(haxe::io::BytesInput_obj::__new(f->__Field(STRING(L"code",4)).Cast<haxe::io::Bytes >(),null(),null())),f);
											break;
										}
									}
								}
								if (!hasMethodBody)
									hxAddEq(this->xml,STRING(L" >\n",3));
								hxAddEq(this->xml,this->indent() + STRING(L"</function>\n\n",13));
							}
						}
						break;
						default: {
						}
					}
				}
			}
			this->indentLevel--;
			hxAddEq(this->xml,this->indent() + STRING(L"</class>\n",9));
			hxAddEq(this->xml,this->indent() + STRING(L"<!--_________________________________________________________________-->\n",73));
		}
	}
	{
		int _g = 0;
		Array<String > _g1 = this->functionClosures;
		while(_g < _g1->length){
			String i = _g1->__get(_g);
			++_g;
			hxAddEq(this->xml,i);
		}
	}
	this->indentLevel--;
	hxAddEq(this->xml,this->indent() + STRING(L"</abcfile>\n",11));
	return this->xml;
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,abcToXml,return )

Void Hxvml_obj::decodeToXML( Array<format::abc::OpCode > ops,Dynamic f){
{
		this->indentLevel++;
		{
			int _g = 0;
			while(_g < ops->length){
				format::abc::OpCode op = ops->__get(_g);
				++_g;
				struct _Function_1{
					static String Block( be::haxer::hxswfml::Hxvml_obj *__this,format::abc::OpCode &op,Dynamic &f)/* DEF (not block)(ret intern) */{
						format::abc::OpCode _switch_9 = (op);
						switch((_switch_9)->GetIndex()){
							case 0: case 1: case 2: case 6: case 14: case 15: case 16: case 17: case 18: case 19: case 20: case 23: case 24: case 25: case 26: case 27: case 28: case 33: case 53: case 43: case 44: case 73: case 64: case 90: case 74: case 75: case 76: case 77: case 78: case 79: case 80: case 81: case 83: case 84: case 86: case 89: case 94: case 95: case 100: {
								return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" />\n",4);
							}
							break;
							case 5: case 98: {
								format::abc::Index v = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" v=\"",4) + __this->getString(v) + STRING(L"\" />\n",5);
								}
							}
							break;
							case 29: {
								format::abc::Index v = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" v=\"",4) + StringTools_obj::urlEncode(__this->getString(v)) + STRING(L"\" />\n",5);
								}
							}
							break;
							case 30: case 31: {
								format::abc::Index v = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" v=\"",4) + __this->getInt(v) + STRING(L"\" />\n",5);
								}
							}
							break;
							case 32: {
								format::abc::Index v = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" v=\"",4) + __this->getFloat(v) + STRING(L"\" />\n",5);
								}
							}
							break;
							case 34: {
								format::abc::Index v = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" v=\"",4) + __this->getNamespace(v) + STRING(L"\" />\n",5);
								}
							}
							break;
							case 54: {
								format::abc::Index c = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" c=\"",4) + __this->className + STRING(L"\" />\n",5);
								}
							}
							break;
							case 36: {
								format::abc::Index f1 = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" f=\"functionClosure_",20) + Type_obj::enumParameters(f1)->__get(0) + STRING(L"\" />\n",5) + __this->createFunctionClosure(f1);
								}
							}
							break;
							case 3: case 4: case 55: case 57: case 58: case 59: case 60: case 61: case 66: case 67: case 68: case 82: case 85: case 91: {
								format::abc::Index v = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" p=\"",4) + __this->getName(v) + STRING(L"\" />\n",5);
								}
							}
							break;
							case 41: case 42: case 46: case 47: case 48: case 49: {
								int nargs = _switch_9->__Param(1);
								format::abc::Index p = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" p=\"",4) + __this->getName(p) + STRING(L"\" nargs=\"",9) + nargs + STRING(L"\"/>\n",4);
								}
							}
							break;
							case 7: case 62: case 63: case 87: case 88: case 92: case 93: case 21: case 22: case 65: case 97: case 99: case 102: case 37: case 38: case 45: case 50: case 51: case 52: case 69: case 70: case 71: case 72: {
								int v = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" v=\"",4) + v + STRING(L"\" />\n",5);
								}
							}
							break;
							case 56: {
								int v = _switch_9->__Param(0);
{
									Dynamic _try = f->__Field(STRING(L"trys",4)).Cast<Array<Dynamic > >()->__get(v);
									int start = _try->__Field(STRING(L"start",5)).Cast<int >();
									int end = _try->__Field(STRING(L"end",3)).Cast<int >();
									int handle = _try->__Field(STRING(L"handle",6)).Cast<int >();
									String type = __this->getName(_try->__Field(STRING(L"type",4)).Cast<format::abc::Index >());
									String variable = __this->getName(_try->__Field(STRING(L"variable",8)).Cast<format::abc::Index >());
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" v=\"",4) + v + STRING(L"\" start=\"",9) + start + STRING(L"\" end=\"",7) + end + STRING(L"\" handle=\"",10) + handle + STRING(L"\" type=\"",8) + type + STRING(L"\" variable=\"",12) + variable + STRING(L"\" />\n",5);
								}
							}
							break;
							case 101: {
								format::abc::Operation o = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" op=\"",5) + Type_obj::enumConstructor(o) + STRING(L"\"/>\n",4);
								}
							}
							break;
							case 40: {
								int nargs = _switch_9->__Param(1);
								format::abc::Index s = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" s=\"",4) + s + STRING(L"\" nargs=\"",9) + nargs + STRING(L"\"/>\n",4);
								}
							}
							break;
							case 39: {
								int nargs = _switch_9->__Param(1);
								int s = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" s=\"",4) + s + STRING(L"\" nargs=\"",9) + nargs + STRING(L"\"/>\n",4);
								}
							}
							break;
							case 8: {
								return STRING(L"<!--<",5) + Type_obj::enumConstructor(op) + STRING(L"/>-->\n",6);
							}
							break;
							case 9: {
								String landingName = _switch_9->__Param(0);
{
									return STRING(L"<OLabel name=\"",14) + landingName + STRING(L"\"/>\n",4);
								}
							}
							break;
							case 10: {
								int offset = _switch_9->__Param(1);
								format::abc::JumpStyle jump = _switch_9->__Param(0);
{
									return STRING(L"<!--<",5) + Type_obj::enumConstructor(op) + STRING(L" jump=\"",7) + jump + STRING(L"\" offset=\"",10) + offset + STRING(L"\"/>-->\n",7);
								}
							}
							break;
							case 11: {
								int offset = _switch_9->__Param(2);
								String landingName = _switch_9->__Param(1);
								format::abc::JumpStyle jump = _switch_9->__Param(0);
{
									return offset >= 0 ? String( STRING(L"<",1) + Type_obj::enumConstructor(jump) + STRING(L" jump=\"",7) + landingName + STRING(L"\"/>\n",4) ) : String( offset < 0 ? String( STRING(L"<",1) + Type_obj::enumConstructor(jump) + STRING(L" label=\"",8) + landingName + STRING(L"\"/>\n",4) ) : String( null() ) );
								}
							}
							break;
							case 12: {
								String landingName = _switch_9->__Param(0);
{
									return STRING(L"<OJump name=\"",13) + landingName + STRING(L"\"/>\n",4);
								}
							}
							break;
							case 13: {
								Array<int > deltas = _switch_9->__Param(1);
								int def = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" def=\"",6) + def + STRING(L"\" deltas=\"",10) + deltas + STRING(L"\"/>\n",4);
								}
							}
							break;
							case 35: {
								int r2 = _switch_9->__Param(1);
								int r1 = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" r1=\"",5) + r1 + STRING(L"\" r2=\"",6) + r2 + STRING(L"\"/>\n",4);
								}
							}
							break;
							case 96: {
								int line = _switch_9->__Param(2);
								int r = _switch_9->__Param(1);
								format::abc::Index name = _switch_9->__Param(0);
{
									return STRING(L"<",1) + Type_obj::enumConstructor(op) + STRING(L" name=\"",7) + __this->getString(name) + STRING(L"\" r=\"",5) + r + STRING(L"\" line=\"",8) + line + STRING(L"\"/>\n",4);
								}
							}
							break;
							default: {
								return hxThrow ((op + STRING(L" Unknown opcode.",16)));
							}
						}
					}
				};
				hxAddEq(this->xml,this->indent() + _Function_1::Block(this,op,f));
			}
		}
		this->indentLevel--;
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Hxvml_obj,decodeToXML,(void))

String Hxvml_obj::createFunctionClosure( format::abc::Index f){
	int start = this->xml.length;
	Dynamic _m = this->getMethod(f);
	String _args = STRING(L"",0);
	{
		int _g = 0;
		Array<format::abc::Index > _g1 = _m->__Field(STRING(L"args",4)).Cast<Array<format::abc::Index > >();
		while(_g < _g1->length){
			format::abc::Index a = _g1->__get(_g);
			++_g;
			hxAddEq(_args,this->getName(a) + STRING(L",",1));
		}
	}
	String _ret = this->getName(_m->__Field(STRING(L"ret",3)).Cast<format::abc::Index >());
	String _name = STRING(L"functionClosure_",16) + Type_obj::enumParameters(f)->__get(0);
	hxAddEq(this->xml,this->indent() + STRING(L"<function",9));
	hxAddEq(this->xml,STRING(L" name=\"",7) + _name + STRING(L"\"",1));
	hxAddEq(this->xml,STRING(L" kind=\"KFunction\"",17));
	hxAddEq(this->xml,STRING(L" args=\"",7) + this->cutComma(_args) + STRING(L"\"",1));
	if (_ret != STRING(L"",0))
		hxAddEq(this->xml,STRING(L" return=\"",9) + _ret + STRING(L"\"",1));
	hxAddEq(this->xml,this->parseMethodExtra(_m->__Field(STRING(L"extra",5))));
	{
		int _g = 0;
		Array<Dynamic > _g1 = this->abcFile->functions;
		while(_g < _g1->length){
			Dynamic _f = _g1->__get(_g);
			++_g;
			if (Type_obj::enumEq(_f->__Field(STRING(L"type",4)).Cast<format::abc::Index >(),f)){
				if (_f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()->length != 0)
					hxAddEq(this->xml,STRING(L" locals=\"",9) + this->parseLocals(_f->__Field(STRING(L"locals",6)).Cast<Array<Dynamic > >()) + STRING(L"\"",1));
				hxAddEq(this->xml,STRING(L" >\n",3));
				this->decodeToXML(format::abc::OpReader_obj::decode(haxe::io::BytesInput_obj::__new(_f->__Field(STRING(L"code",4)).Cast<haxe::io::Bytes >(),null(),null())),_f);
				hxAddEq(this->xml,this->indent() + STRING(L"</function>\n\n",13));
				break;
			}
		}
	}
	this->functionClosures->push(this->xml.substr(start,null()));
	return STRING(L"",0);
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,createFunctionClosure,return )

String Hxvml_obj::parseMethodExtra( Dynamic extra){
	if (extra == null())
		return STRING(L"",0);
	String out = STRING(L"",0);
	if (extra->__Field(STRING(L"native",6)).Cast<bool >())
		hxAddEq(out,STRING(L" native=\"",9) + extra->__Field(STRING(L"native",6)).Cast<bool >() + STRING(L"\"",1));
	if (extra->__Field(STRING(L"variableArgs",12)).Cast<bool >())
		hxAddEq(out,STRING(L" variableArgs=\"",15) + extra->__Field(STRING(L"variableArgs",12)).Cast<bool >() + STRING(L"\"",1));
	if (extra->__Field(STRING(L"argumentsDefined",16)).Cast<bool >())
		hxAddEq(out,STRING(L" argumentsDefined=\"",19) + extra->__Field(STRING(L"argumentsDefined",16)).Cast<bool >() + STRING(L"\"",1));
	if (extra->__Field(STRING(L"usesDXNS",8)).Cast<bool >())
		hxAddEq(out,STRING(L" usesDXNS=\"",11) + extra->__Field(STRING(L"usesDXNS",8)).Cast<bool >() + STRING(L"\"",1));
	if (extra->__Field(STRING(L"newBlock",8)).Cast<bool >())
		hxAddEq(out,STRING(L" newBlock=\"",11) + extra->__Field(STRING(L"newBlock",8)).Cast<bool >() + STRING(L"\"",1));
	if (extra->__Field(STRING(L"unused",6)).Cast<bool >())
		hxAddEq(out,STRING(L" unused=\"",9) + extra->__Field(STRING(L"unused",6)).Cast<bool >() + STRING(L"\"",1));
	if (bool(extra->__Field(STRING(L"debugName",9)).Cast<format::abc::Index >() != null()) && bool(this->getString(extra->__Field(STRING(L"debugName",9)).Cast<format::abc::Index >()) != STRING(L"",0)))
		hxAddEq(out,STRING(L" debugName=\"",12) + this->getString(extra->__Field(STRING(L"debugName",9)).Cast<format::abc::Index >()) + STRING(L"\"",1));
	if (extra->__Field(STRING(L"defaultParameters",17)).Cast<Array<format::abc::Value > >() != null()){
		String str = STRING(L"",0);
		{
			int _g1 = 0;
			int _g = extra->__Field(STRING(L"defaultParameters",17)).Cast<Array<format::abc::Value > >()->length;
			while(_g1 < _g){
				int i = _g1++;
				hxAddEq(str,STRING(L"null,",5));
			}
		}
		hxAddEq(out,STRING(L" defaultParameters=\"",20) + this->cutComma(str) + STRING(L"\"",1));
	}
	return out;
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,parseMethodExtra,return )

String Hxvml_obj::parseLocals( Array<Dynamic > locals){
	String out = STRING(L"",0);
	{
		int _g = 0;
		while(_g < locals->length){
			Dynamic l = locals->__get(_g);
			++_g;
			format::abc::FieldKind _switch_10 = (l->__Field(STRING(L"kind",4)).Cast<format::abc::FieldKind >());
			switch((_switch_10)->GetIndex()){
				case 0: {
					Dynamic const = _switch_10->__Param(2);
					format::abc::Value value = _switch_10->__Param(1);
					format::abc::Index type = _switch_10->__Param(0);
{
						hxAddEq(out,this->getName(l->__Field(STRING(L"name",4)).Cast<format::abc::Index >()) + STRING(L":",1) + this->getName(type) + STRING(L":",1) + this->getValue(value) + STRING(L":",1) + const + STRING(L",",1));
					}
				}
				break;
				case 1: {
					Dynamic isOverride = _switch_10->__Param(3);
					Dynamic isFinal = _switch_10->__Param(2);
					format::abc::MethodKind k = _switch_10->__Param(1);
					format::abc::Index type = _switch_10->__Param(0);
{
						hxAddEq(out,STRING(L"FMethod",7));
					}
				}
				break;
				case 2: {
					format::abc::Index c = _switch_10->__Param(0);
{
						hxAddEq(out,STRING(L"FClass",6));
					}
				}
				break;
				case 3: {
					format::abc::Index f = _switch_10->__Param(0);
{
						hxAddEq(out,STRING(L"FFunction",9));
					}
				}
				break;
			}
		}
	}
	return this->cutComma(out);
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,parseLocals,return )

String Hxvml_obj::indent( ){
	String str = STRING(L"",0);
	{
		int _g1 = 0;
		int _g = this->indentLevel;
		while(_g1 < _g){
			int i = _g1++;
			hxAddEq(str,STRING(L"\t",1));
		}
	}
	return str;
}


DEFINE_DYNAMIC_FUNC0(Hxvml_obj,indent,return )

String Hxvml_obj::getString( format::abc::Index id){
	return this->abcFile->get(this->abcFile->strings,id).Cast<String >();
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getString,return )

String Hxvml_obj::getInt( format::abc::Index id){
	return this->abcFile->get(this->abcFile->ints,id).Cast<String >();
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getInt,return )

String Hxvml_obj::getUInt( format::abc::Index id){
	return this->abcFile->get(this->abcFile->uints,id).Cast<String >();
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getUInt,return )

String Hxvml_obj::getFloat( format::abc::Index id){
	return this->abcFile->get(this->abcFile->floats,id).Cast<String >();
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getFloat,return )

String Hxvml_obj::getNamespace( format::abc::Index id){
	if (id == null())
		return STRING(L"",0);
	else{
		format::abc::Namespace ns = this->abcFile->get(this->abcFile->namespaces,id).Cast<format::abc::Namespace >();
		format::abc::Index name = Type_obj::enumParameters(ns)->__get(0);
		String _name = this->getString(name);
		if (_name == null())
			return STRING(L"",0);
		return (_name != STRING(L"",0)) ? String( _name + STRING(L".",1) ) : String( _name );
	}
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getNamespace,return )

String Hxvml_obj::getName( format::abc::Index id){
	if (id == null()){
		return STRING(L"*",1);
	}
	else{
		format::abc::Name name = this->abcFile->get(this->abcFile->names,id).Cast<format::abc::Name >();
		return this->getNameType(name);
	}
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getName,return )

String Hxvml_obj::getNameType( format::abc::Name name){
	String __namespace = STRING(L"",0);
	String __name = STRING(L"",0);
	format::abc::Name _switch_11 = (name);
	switch((_switch_11)->GetIndex()){
		case 0: {
			format::abc::Index ns = _switch_11->__Param(1);
			format::abc::Index name1 = _switch_11->__Param(0);
{
				__name = this->getString(name1);
				__namespace = this->getNamespace(ns);
			}
		}
		break;
		case 1: {
			format::abc::Index nset = _switch_11->__Param(1);
			format::abc::Index name1 = _switch_11->__Param(0);
{
				__name = this->getString(name1);
			}
		}
		break;
		case 2: {
			format::abc::Index name1 = _switch_11->__Param(0);
{
				__name = this->getString(name1);
			}
		}
		break;
		case 3: {
			__name = STRING(L"#arrayProp",10);
		}
		break;
		case 4: {
			format::abc::Index nset = _switch_11->__Param(0);
{
				__name = STRING(L"#arrayProp",10);
			}
		}
		break;
		case 5: {
			format::abc::Name n = _switch_11->__Param(0);
{
				__name = this->getNameType(n);
			}
		}
		break;
		case 6: {
			Array<format::abc::Index > params = _switch_11->__Param(1);
			format::abc::Index n = _switch_11->__Param(0);
{
				hxAddEq(__name,this->getName(n) + STRING(L" params:",8));
				{
					int _g = 0;
					while(_g < params->length){
						format::abc::Index i = params->__get(_g);
						++_g;
						hxAddEq(__name,this->getName(i) + STRING(L",",1));
					}
				}
			}
		}
		break;
	}
	return __namespace + this->cutComma(__name);
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getNameType,return )

String Hxvml_obj::getFieldName( format::abc::Index id){
	return this->getName(id);
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getFieldName,return )

Dynamic Hxvml_obj::getMethod( format::abc::Index id){
	return this->abcFile->methodTypes->__get(Type_obj::enumParameters(id)->__get(0));
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getMethod,return )

Dynamic Hxvml_obj::getClass( format::abc::Index id){
	return this->abcFile->classes->__get(Type_obj::enumParameters(id)->__get(0));
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getClass,return )

String Hxvml_obj::cutComma( String str){
	if (str.lastIndexOf(STRING(L",",1),null()) == str.length - 1)
		return str.substr(0,str.length - 1);
	else
		return str;
;
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,cutComma,return )

String Hxvml_obj::getValue( format::abc::Value value){
	if (value == null())
		return STRING(L"",0);
	struct _Function_1{
		static String Block( format::abc::Value &value,be::haxer::hxswfml::Hxvml_obj *__this)/* DEF (not block)(ret intern) */{
			format::abc::Value _switch_12 = (value);
			switch((_switch_12)->GetIndex()){
				case 0: {
					return STRING(L"",0);
				}
				break;
				case 2: {
					format::abc::Index v = _switch_12->__Param(0);
{
						return __this->getString(v);
					}
				}
				break;
				case 3: {
					format::abc::Index v = _switch_12->__Param(0);
{
						return __this->getInt(v);
					}
				}
				break;
				case 4: {
					format::abc::Index v = _switch_12->__Param(0);
{
						return __this->getUInt(v);
					}
				}
				break;
				case 5: {
					format::abc::Index v = _switch_12->__Param(0);
{
						return __this->getFloat(v);
					}
				}
				break;
				case 1: {
					bool v = _switch_12->__Param(0);
{
						return Std_obj::string(v);
					}
				}
				break;
				case 6: {
					format::abc::Index ns = _switch_12->__Param(1);
					int kind = _switch_12->__Param(0);
{
						return kind + __this->getNamespace(ns);
					}
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(value,this);
}


DEFINE_DYNAMIC_FUNC1(Hxvml_obj,getValue,return )

String Hxvml_obj::getAnyAttribute( Dynamic element,Array<String > arr){
	{
		int _g1 = 0;
		int _g = arr->length;
		while(_g1 < _g){
			int i = _g1++;
			if (element->__Field(STRING(L"get",3))(arr->__get(i)) != null())
				return element->__Field(STRING(L"get",3))(arr->__get(i));
		}
	}
	return STRING(L"",0);
}


DEFINE_DYNAMIC_FUNC2(Hxvml_obj,getAnyAttribute,return )


Hxvml_obj::Hxvml_obj()
{
	InitMember(abcFile);
	InitMember(xml);
	InitMember(indentLevel);
	InitMember(functionClosures);
	InitMember(className);
}

void Hxvml_obj::__Mark()
{
	MarkMember(abcFile);
	MarkMember(xml);
	MarkMember(indentLevel);
	MarkMember(functionClosures);
	MarkMember(className);
}

Dynamic Hxvml_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"xml",sizeof(wchar_t)*3) ) { return xml; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"indent",sizeof(wchar_t)*6) ) { return indent_dyn(); }
		if (!memcmp(inName.__s,L"getInt",sizeof(wchar_t)*6) ) { return getInt_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"abcFile",sizeof(wchar_t)*7) ) { return abcFile; }
		if (!memcmp(inName.__s,L"abc2xml",sizeof(wchar_t)*7) ) { return abc2xml_dyn(); }
		if (!memcmp(inName.__s,L"getUInt",sizeof(wchar_t)*7) ) { return getUInt_dyn(); }
		if (!memcmp(inName.__s,L"getName",sizeof(wchar_t)*7) ) { return getName_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"abcToXml",sizeof(wchar_t)*8) ) { return abcToXml_dyn(); }
		if (!memcmp(inName.__s,L"getFloat",sizeof(wchar_t)*8) ) { return getFloat_dyn(); }
		if (!memcmp(inName.__s,L"getClass",sizeof(wchar_t)*8) ) { return getClass_dyn(); }
		if (!memcmp(inName.__s,L"cutComma",sizeof(wchar_t)*8) ) { return cutComma_dyn(); }
		if (!memcmp(inName.__s,L"getValue",sizeof(wchar_t)*8) ) { return getValue_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"className",sizeof(wchar_t)*9) ) { return className; }
		if (!memcmp(inName.__s,L"getString",sizeof(wchar_t)*9) ) { return getString_dyn(); }
		if (!memcmp(inName.__s,L"getMethod",sizeof(wchar_t)*9) ) { return getMethod_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"indentLevel",sizeof(wchar_t)*11) ) { return indentLevel; }
		if (!memcmp(inName.__s,L"decodeToXML",sizeof(wchar_t)*11) ) { return decodeToXML_dyn(); }
		if (!memcmp(inName.__s,L"parseLocals",sizeof(wchar_t)*11) ) { return parseLocals_dyn(); }
		if (!memcmp(inName.__s,L"getNameType",sizeof(wchar_t)*11) ) { return getNameType_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"getNamespace",sizeof(wchar_t)*12) ) { return getNamespace_dyn(); }
		if (!memcmp(inName.__s,L"getFieldName",sizeof(wchar_t)*12) ) { return getFieldName_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"getAnyAttribute",sizeof(wchar_t)*15) ) { return getAnyAttribute_dyn(); }
		break;
	case 16:
		if (!memcmp(inName.__s,L"functionClosures",sizeof(wchar_t)*16) ) { return functionClosures; }
		if (!memcmp(inName.__s,L"parseMethodExtra",sizeof(wchar_t)*16) ) { return parseMethodExtra_dyn(); }
		break;
	case 21:
		if (!memcmp(inName.__s,L"createFunctionClosure",sizeof(wchar_t)*21) ) { return createFunctionClosure_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_abcFile = __hxcpp_field_to_id("abcFile");
static int __id_xml = __hxcpp_field_to_id("xml");
static int __id_indentLevel = __hxcpp_field_to_id("indentLevel");
static int __id_functionClosures = __hxcpp_field_to_id("functionClosures");
static int __id_className = __hxcpp_field_to_id("className");
static int __id_abc2xml = __hxcpp_field_to_id("abc2xml");
static int __id_abcToXml = __hxcpp_field_to_id("abcToXml");
static int __id_decodeToXML = __hxcpp_field_to_id("decodeToXML");
static int __id_createFunctionClosure = __hxcpp_field_to_id("createFunctionClosure");
static int __id_parseMethodExtra = __hxcpp_field_to_id("parseMethodExtra");
static int __id_parseLocals = __hxcpp_field_to_id("parseLocals");
static int __id_indent = __hxcpp_field_to_id("indent");
static int __id_getString = __hxcpp_field_to_id("getString");
static int __id_getInt = __hxcpp_field_to_id("getInt");
static int __id_getUInt = __hxcpp_field_to_id("getUInt");
static int __id_getFloat = __hxcpp_field_to_id("getFloat");
static int __id_getNamespace = __hxcpp_field_to_id("getNamespace");
static int __id_getName = __hxcpp_field_to_id("getName");
static int __id_getNameType = __hxcpp_field_to_id("getNameType");
static int __id_getFieldName = __hxcpp_field_to_id("getFieldName");
static int __id_getMethod = __hxcpp_field_to_id("getMethod");
static int __id_getClass = __hxcpp_field_to_id("getClass");
static int __id_cutComma = __hxcpp_field_to_id("cutComma");
static int __id_getValue = __hxcpp_field_to_id("getValue");
static int __id_getAnyAttribute = __hxcpp_field_to_id("getAnyAttribute");


Dynamic Hxvml_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_abcFile) return abcFile;
	if (inFieldID==__id_xml) return xml;
	if (inFieldID==__id_indentLevel) return indentLevel;
	if (inFieldID==__id_functionClosures) return functionClosures;
	if (inFieldID==__id_className) return className;
	if (inFieldID==__id_abc2xml) return abc2xml_dyn();
	if (inFieldID==__id_abcToXml) return abcToXml_dyn();
	if (inFieldID==__id_decodeToXML) return decodeToXML_dyn();
	if (inFieldID==__id_createFunctionClosure) return createFunctionClosure_dyn();
	if (inFieldID==__id_parseMethodExtra) return parseMethodExtra_dyn();
	if (inFieldID==__id_parseLocals) return parseLocals_dyn();
	if (inFieldID==__id_indent) return indent_dyn();
	if (inFieldID==__id_getString) return getString_dyn();
	if (inFieldID==__id_getInt) return getInt_dyn();
	if (inFieldID==__id_getUInt) return getUInt_dyn();
	if (inFieldID==__id_getFloat) return getFloat_dyn();
	if (inFieldID==__id_getNamespace) return getNamespace_dyn();
	if (inFieldID==__id_getName) return getName_dyn();
	if (inFieldID==__id_getNameType) return getNameType_dyn();
	if (inFieldID==__id_getFieldName) return getFieldName_dyn();
	if (inFieldID==__id_getMethod) return getMethod_dyn();
	if (inFieldID==__id_getClass) return getClass_dyn();
	if (inFieldID==__id_cutComma) return cutComma_dyn();
	if (inFieldID==__id_getValue) return getValue_dyn();
	if (inFieldID==__id_getAnyAttribute) return getAnyAttribute_dyn();
	return super::__IField(inFieldID);
}

Dynamic Hxvml_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"xml",sizeof(wchar_t)*3) ) { xml=inValue.Cast<String >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"abcFile",sizeof(wchar_t)*7) ) { abcFile=inValue.Cast<format::abc::ABCData >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"className",sizeof(wchar_t)*9) ) { className=inValue.Cast<String >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"indentLevel",sizeof(wchar_t)*11) ) { indentLevel=inValue.Cast<int >();return inValue; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"functionClosures",sizeof(wchar_t)*16) ) { functionClosures=inValue.Cast<Array<String > >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Hxvml_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"abcFile",7));
	outFields->push(STRING(L"xml",3));
	outFields->push(STRING(L"indentLevel",11));
	outFields->push(STRING(L"functionClosures",16));
	outFields->push(STRING(L"className",9));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"abcFile",7),
	STRING(L"xml",3),
	STRING(L"indentLevel",11),
	STRING(L"functionClosures",16),
	STRING(L"className",9),
	STRING(L"abc2xml",7),
	STRING(L"abcToXml",8),
	STRING(L"decodeToXML",11),
	STRING(L"createFunctionClosure",21),
	STRING(L"parseMethodExtra",16),
	STRING(L"parseLocals",11),
	STRING(L"indent",6),
	STRING(L"getString",9),
	STRING(L"getInt",6),
	STRING(L"getUInt",7),
	STRING(L"getFloat",8),
	STRING(L"getNamespace",12),
	STRING(L"getName",7),
	STRING(L"getNameType",11),
	STRING(L"getFieldName",12),
	STRING(L"getMethod",9),
	STRING(L"getClass",8),
	STRING(L"cutComma",8),
	STRING(L"getValue",8),
	STRING(L"getAnyAttribute",15),
	String(null()) };

static void sMarkStatics() {
};

Class Hxvml_obj::__mClass;

void Hxvml_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"be.haxer.hxswfml.Hxvml",22), TCanCast<Hxvml_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Hxvml_obj::__boot()
{
}

} // end namespace be
} // end namespace haxer
} // end namespace hxswfml
