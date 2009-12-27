#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_JumpStyle
#include <format/abc/JumpStyle.h>
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
#ifndef INCLUDED_haxe_io_Eof
#include <haxe/io/Eof.h>
#endif
#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace format{
namespace abc{

Void OpReader_obj::__construct(haxe::io::Input i)
{
{
	this->i = i;
}
;
	return null();
}

OpReader_obj::~OpReader_obj() { }

Dynamic OpReader_obj::__CreateEmpty() { return  new OpReader_obj; }
hxObjectPtr<OpReader_obj > OpReader_obj::__new(haxe::io::Input i)
{  hxObjectPtr<OpReader_obj > result = new OpReader_obj();
	result->__construct(i);
	return result;}

Dynamic OpReader_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<OpReader_obj > result = new OpReader_obj();
	result->__construct(inArgs[0]);
	return result;}

int OpReader_obj::readInt( ){
	int a = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (a < 128)
		return a;
	hxAndEq(a,127);
	int b = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (b < 128)
		return int((int(b) << int(7))) | int(a);
	hxAndEq(b,127);
	int c = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (c < 128)
		return int(int((int(c) << int(14))) | int((int(b) << int(7)))) | int(a);
	hxAndEq(c,127);
	int d = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (d < 128)
		return int(int(int((int(d) << int(21))) | int((int(c) << int(14)))) | int((int(b) << int(7)))) | int(a);
	hxAndEq(d,127);
	int e = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (e > 15)
		hxThrow (STRING(L"assert",6));
	if (((int(e) & int(8)) == 0) != ((int(e) & int(4)) == 0))
		hxThrow (haxe::io::Error_obj::Overflow);
	return int(int(int(int((int(e) << int(28))) | int((int(d) << int(21)))) | int((int(c) << int(14)))) | int((int(b) << int(7)))) | int(a);
}


DEFINE_DYNAMIC_FUNC0(OpReader_obj,readInt,return )

format::abc::Index OpReader_obj::readIndex( ){
	return format::abc::Index_obj::Idx(this->readInt());
}


DEFINE_DYNAMIC_FUNC0(OpReader_obj,readIndex,return )

cpp::CppInt32__ OpReader_obj::readInt32( ){
	int a = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (a < 128)
		return cpp::CppInt32___obj::ofInt(a);
	hxAndEq(a,127);
	int b = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (b < 128)
		return cpp::CppInt32___obj::ofInt(int((int(b) << int(7))) | int(a));
	hxAndEq(b,127);
	int c = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (c < 128)
		return cpp::CppInt32___obj::ofInt(int(int((int(c) << int(14))) | int((int(b) << int(7)))) | int(a));
	hxAndEq(c,127);
	int d = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (d < 128)
		return cpp::CppInt32___obj::ofInt(int(int(int((int(d) << int(21))) | int((int(c) << int(14)))) | int((int(b) << int(7)))) | int(a));
	hxAndEq(d,127);
	int e = this->i->readByte();
	++format::abc::OpReader_obj::bytePos;
	if (e > 15)
		hxThrow (STRING(L"assert",6));
	cpp::CppInt32__ small = cpp::CppInt32___obj::ofInt(int(int(int((int(d) << int(21))) | int((int(c) << int(14)))) | int((int(b) << int(7)))) | int(a));
	cpp::CppInt32__ big = cpp::CppInt32___obj::shl(cpp::CppInt32___obj::ofInt(e),28);
	return cpp::CppInt32___obj::_or(big,small);
}


DEFINE_DYNAMIC_FUNC0(OpReader_obj,readInt32,return )

int OpReader_obj::reg( ){
	++format::abc::OpReader_obj::bytePos;
	return this->i->readByte();
}


DEFINE_DYNAMIC_FUNC0(OpReader_obj,reg,return )

format::abc::OpCode OpReader_obj::jmp( format::abc::JumpStyle j){
	format::abc::OpReader_obj::jumpNameIndex++;
	int offset = this->i->readInt24();
	++format::abc::OpReader_obj::bytePos;
	++format::abc::OpReader_obj::bytePos;
	++format::abc::OpReader_obj::bytePos;
	if (offset < 0){
		format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
		return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
	}
	else{
		if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
			format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
		format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
		format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
		return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
	}
}


DEFINE_DYNAMIC_FUNC1(OpReader_obj,jmp,return )

format::abc::OpCode OpReader_obj::readOp( int op){
	struct _Function_1{
		static format::abc::OpCode Block( int &op,format::abc::OpReader_obj *__this)/* DEF (not block)(ret intern) */{
			switch( (int)(op)){
				case 1: {
					return format::abc::OpCode_obj::OBreakPoint;
				}
				break;
				case 2: {
					return format::abc::OpCode_obj::ONop;
				}
				break;
				case 3: {
					return format::abc::OpCode_obj::OThrow;
				}
				break;
				case 4: {
					return format::abc::OpCode_obj::OGetSuper(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 5: {
					return format::abc::OpCode_obj::OSetSuper(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 6: {
					return format::abc::OpCode_obj::ODxNs(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 7: {
					return format::abc::OpCode_obj::ODxNsLate;
				}
				break;
				case 8: {
					struct _Function_2{
						static int Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							++format::abc::OpReader_obj::bytePos;
							return __this->i->readByte();
						}
					};
					return format::abc::OpCode_obj::ORegKill(_Function_2::Block(__this));
				}
				break;
				case 9: {
					format::abc::OpReader_obj::labelNameIndex++;
					format::abc::OpReader_obj::labels[format::abc::OpReader_obj::bytePos - 1] = STRING(L"label",5) + format::abc::OpReader_obj::labelNameIndex;
					format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OLabel);
					return format::abc::OpCode_obj::OLabel2(STRING(L"label",5) + format::abc::OpReader_obj::labelNameIndex);
				}
				break;
				case 12: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JNotLt;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 13: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JNotLte;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 14: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JNotGt;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 15: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JNotGte;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 16: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JAlways;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 17: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JTrue;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 18: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JFalse;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 19: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JEq;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 20: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JNeq;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 21: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JLt;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 22: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JLte;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 23: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JGt;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 24: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JGte;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 25: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JPhysEq;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 26: {
					struct _Function_2{
						static format::abc::OpCode Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							format::abc::JumpStyle j = format::abc::JumpStyle_obj::JPhysNeq;
							format::abc::OpReader_obj::jumpNameIndex++;
							int offset = __this->i->readInt24();
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							++format::abc::OpReader_obj::bytePos;
							struct _Function_3{
								static Dynamic Block( format::abc::JumpStyle &j,int &offset)/* DEF (ret block)(not intern) */{
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,format::abc::OpReader_obj::labels->__get(format::abc::OpReader_obj::bytePos + offset),offset);
								}
							};
							struct _Function_4{
								static Dynamic Block( int &offset,format::abc::JumpStyle &j)/* DEF (ret block)(not intern) */{
									if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos + offset) == null())
										format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset] = Array_obj<String >::__new();
									format::abc::OpReader_obj::jumps[format::abc::OpReader_obj::bytePos + offset]->push(STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex);
									format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump(j,offset));
									return format::abc::OpCode_obj::OJump2(j,STRING(L"j",1) + format::abc::OpReader_obj::jumpNameIndex,offset);
								}
							};
							return offset < 0 ? Void( _Function_3::Block(j,offset) ) : Void( _Function_4::Block(offset,j) );
						}
					};
					return _Function_2::Block(__this);
				}
				break;
				case 27: {
					hxAddEq(format::abc::OpReader_obj::bytePos,3);
					int def = __this->i->readInt24();
					Array<int > cases = Array_obj<int >::__new();
					{
						int _g1 = 0;
						int _g = __this->readInt() + 1;
						while(_g1 < _g){
							int _ = _g1++;
							hxAddEq(format::abc::OpReader_obj::bytePos,3);
							cases->push(__this->i->readInt24());
						}
					}
					return format::abc::OpCode_obj::OSwitch(def,cases);
				}
				break;
				case 28: {
					return format::abc::OpCode_obj::OPushWith;
				}
				break;
				case 29: {
					return format::abc::OpCode_obj::OPopScope;
				}
				break;
				case 30: {
					return format::abc::OpCode_obj::OForIn;
				}
				break;
				case 31: {
					return format::abc::OpCode_obj::OHasNext;
				}
				break;
				case 32: {
					return format::abc::OpCode_obj::ONull;
				}
				break;
				case 33: {
					return format::abc::OpCode_obj::OUndefined;
				}
				break;
				case 35: {
					return format::abc::OpCode_obj::OForEach;
				}
				break;
				case 36: {
					++format::abc::OpReader_obj::bytePos;
					return format::abc::OpCode_obj::OSmallInt(__this->i->readInt8());
				}
				break;
				case 37: {
					return format::abc::OpCode_obj::OInt(__this->readInt());
				}
				break;
				case 38: {
					return format::abc::OpCode_obj::OTrue;
				}
				break;
				case 39: {
					return format::abc::OpCode_obj::OFalse;
				}
				break;
				case 40: {
					return format::abc::OpCode_obj::ONaN;
				}
				break;
				case 41: {
					return format::abc::OpCode_obj::OPop;
				}
				break;
				case 42: {
					return format::abc::OpCode_obj::ODup;
				}
				break;
				case 43: {
					return format::abc::OpCode_obj::OSwap;
				}
				break;
				case 44: {
					return format::abc::OpCode_obj::OString(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 45: {
					return format::abc::OpCode_obj::OIntRef(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 46: {
					return format::abc::OpCode_obj::OUIntRef(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 47: {
					return format::abc::OpCode_obj::OFloat(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 48: {
					return format::abc::OpCode_obj::OScope;
				}
				break;
				case 49: {
					return format::abc::OpCode_obj::ONamespace(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 50: {
					int r1 = __this->readInt();
					int r2 = __this->readInt();
					return format::abc::OpCode_obj::ONext(r1,r2);
				}
				break;
				case 53: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemGet8);
				}
				break;
				case 54: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemGet16);
				}
				break;
				case 55: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemGet32);
				}
				break;
				case 56: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemGetFloat);
				}
				break;
				case 57: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemGetDouble);
				}
				break;
				case 58: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemSet8);
				}
				break;
				case 59: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemSet16);
				}
				break;
				case 60: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemSet32);
				}
				break;
				case 61: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemSetFloat);
				}
				break;
				case 62: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMemSetDouble);
				}
				break;
				case 64: {
					return format::abc::OpCode_obj::OFunction(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 65: {
					return format::abc::OpCode_obj::OCallStack(__this->readInt());
				}
				break;
				case 66: {
					return format::abc::OpCode_obj::OConstruct(__this->readInt());
				}
				break;
				case 67: {
					int s = __this->readInt();
					int n = __this->readInt();
					return format::abc::OpCode_obj::OCallMethod(s,n);
				}
				break;
				case 68: {
					format::abc::Index m = format::abc::Index_obj::Idx(__this->readInt());
					int n = __this->readInt();
					return format::abc::OpCode_obj::OCallStatic(m,n);
				}
				break;
				case 69: {
					format::abc::Index p = format::abc::Index_obj::Idx(__this->readInt());
					int n = __this->readInt();
					return format::abc::OpCode_obj::OCallSuper(p,n);
				}
				break;
				case 70: {
					format::abc::Index p = format::abc::Index_obj::Idx(__this->readInt());
					int n = __this->readInt();
					return format::abc::OpCode_obj::OCallProperty(p,n);
				}
				break;
				case 71: {
					return format::abc::OpCode_obj::ORetVoid;
				}
				break;
				case 72: {
					return format::abc::OpCode_obj::ORet;
				}
				break;
				case 73: {
					return format::abc::OpCode_obj::OConstructSuper(__this->readInt());
				}
				break;
				case 74: {
					format::abc::Index p = format::abc::Index_obj::Idx(__this->readInt());
					int n = __this->readInt();
					return format::abc::OpCode_obj::OConstructProperty(p,n);
				}
				break;
				case 76: {
					format::abc::Index p = format::abc::Index_obj::Idx(__this->readInt());
					int n = __this->readInt();
					return format::abc::OpCode_obj::OCallPropLex(p,n);
				}
				break;
				case 78: {
					format::abc::Index p = format::abc::Index_obj::Idx(__this->readInt());
					int n = __this->readInt();
					return format::abc::OpCode_obj::OCallSuperVoid(p,n);
				}
				break;
				case 79: {
					format::abc::Index p = format::abc::Index_obj::Idx(__this->readInt());
					int n = __this->readInt();
					return format::abc::OpCode_obj::OCallPropVoid(p,n);
				}
				break;
				case 80: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpSign1);
				}
				break;
				case 81: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpSign8);
				}
				break;
				case 82: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpSign16);
				}
				break;
				case 83: {
					return format::abc::OpCode_obj::OApplyType(__this->readInt());
				}
				break;
				case 85: {
					return format::abc::OpCode_obj::OObject(__this->readInt());
				}
				break;
				case 86: {
					return format::abc::OpCode_obj::OArray(__this->readInt());
				}
				break;
				case 87: {
					return format::abc::OpCode_obj::ONewBlock;
				}
				break;
				case 88: {
					return format::abc::OpCode_obj::OClassDef(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 89: {
					return format::abc::OpCode_obj::OGetDescendants(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 90: {
					return format::abc::OpCode_obj::OCatch(__this->readInt());
				}
				break;
				case 93: {
					return format::abc::OpCode_obj::OFindPropStrict(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 94: {
					return format::abc::OpCode_obj::OFindProp(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 95: {
					return format::abc::OpCode_obj::OFindDefinition(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 96: {
					return format::abc::OpCode_obj::OGetLex(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 97: {
					return format::abc::OpCode_obj::OSetProp(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 98: {
					struct _Function_2{
						static int Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							++format::abc::OpReader_obj::bytePos;
							return __this->i->readByte();
						}
					};
					return format::abc::OpCode_obj::OReg(_Function_2::Block(__this));
				}
				break;
				case 99: {
					struct _Function_2{
						static int Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							++format::abc::OpReader_obj::bytePos;
							return __this->i->readByte();
						}
					};
					return format::abc::OpCode_obj::OSetReg(_Function_2::Block(__this));
				}
				break;
				case 100: {
					return format::abc::OpCode_obj::OGetGlobalScope;
				}
				break;
				case 101: {
					++format::abc::OpReader_obj::bytePos;
					return format::abc::OpCode_obj::OGetScope(__this->i->readByte());
				}
				break;
				case 102: {
					return format::abc::OpCode_obj::OGetProp(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 104: {
					return format::abc::OpCode_obj::OInitProp(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 106: {
					return format::abc::OpCode_obj::ODeleteProp(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 108: {
					return format::abc::OpCode_obj::OGetSlot(__this->readInt());
				}
				break;
				case 109: {
					return format::abc::OpCode_obj::OSetSlot(__this->readInt());
				}
				break;
				case 110: {
					return format::abc::OpCode_obj::OGetGlobalSlot(__this->readInt());
				}
				break;
				case 111: {
					return format::abc::OpCode_obj::OSetGlobalSlot(__this->readInt());
				}
				break;
				case 112: {
					return format::abc::OpCode_obj::OToString;
				}
				break;
				case 113: {
					return format::abc::OpCode_obj::OToXml;
				}
				break;
				case 114: {
					return format::abc::OpCode_obj::OToXmlAttr;
				}
				break;
				case 115: {
					return format::abc::OpCode_obj::OToInt;
				}
				break;
				case 116: {
					return format::abc::OpCode_obj::OToUInt;
				}
				break;
				case 117: {
					return format::abc::OpCode_obj::OToNumber;
				}
				break;
				case 118: {
					return format::abc::OpCode_obj::OToBool;
				}
				break;
				case 119: {
					return format::abc::OpCode_obj::OToObject;
				}
				break;
				case 120: {
					return format::abc::OpCode_obj::OCheckIsXml;
				}
				break;
				case 128: {
					return format::abc::OpCode_obj::OCast(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 130: {
					return format::abc::OpCode_obj::OAsAny;
				}
				break;
				case 133: {
					return format::abc::OpCode_obj::OAsString;
				}
				break;
				case 134: {
					return format::abc::OpCode_obj::OAsType(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 135: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpAs);
				}
				break;
				case 137: {
					return format::abc::OpCode_obj::OAsObject;
				}
				break;
				case 144: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpNeg);
				}
				break;
				case 145: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpIncr);
				}
				break;
				case 146: {
					struct _Function_2{
						static int Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							++format::abc::OpReader_obj::bytePos;
							return __this->i->readByte();
						}
					};
					return format::abc::OpCode_obj::OIncrReg(_Function_2::Block(__this));
				}
				break;
				case 147: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpDecr);
				}
				break;
				case 148: {
					struct _Function_2{
						static int Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							++format::abc::OpReader_obj::bytePos;
							return __this->i->readByte();
						}
					};
					return format::abc::OpCode_obj::ODecrReg(_Function_2::Block(__this));
				}
				break;
				case 149: {
					return format::abc::OpCode_obj::OTypeof;
				}
				break;
				case 150: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpNot);
				}
				break;
				case 151: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpBitNot);
				}
				break;
				case 160: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpAdd);
				}
				break;
				case 161: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpSub);
				}
				break;
				case 162: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMul);
				}
				break;
				case 163: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpDiv);
				}
				break;
				case 164: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpMod);
				}
				break;
				case 165: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpShl);
				}
				break;
				case 166: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpShr);
				}
				break;
				case 167: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpUShr);
				}
				break;
				case 168: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpAnd);
				}
				break;
				case 169: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpOr);
				}
				break;
				case 170: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpXor);
				}
				break;
				case 171: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpEq);
				}
				break;
				case 172: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpPhysEq);
				}
				break;
				case 173: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpLt);
				}
				break;
				case 174: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpLte);
				}
				break;
				case 175: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpGt);
				}
				break;
				case 176: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpGte);
				}
				break;
				case 177: {
					return format::abc::OpCode_obj::OInstanceOf;
				}
				break;
				case 178: {
					return format::abc::OpCode_obj::OIsType(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 179: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpIs);
				}
				break;
				case 180: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpIn);
				}
				break;
				case 192: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpIIncr);
				}
				break;
				case 193: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpIDecr);
				}
				break;
				case 194: {
					struct _Function_2{
						static int Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							++format::abc::OpReader_obj::bytePos;
							return __this->i->readByte();
						}
					};
					return format::abc::OpCode_obj::OIncrIReg(_Function_2::Block(__this));
				}
				break;
				case 195: {
					struct _Function_2{
						static int Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							++format::abc::OpReader_obj::bytePos;
							return __this->i->readByte();
						}
					};
					return format::abc::OpCode_obj::ODecrIReg(_Function_2::Block(__this));
				}
				break;
				case 196: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpINeg);
				}
				break;
				case 197: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpIAdd);
				}
				break;
				case 198: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpISub);
				}
				break;
				case 199: {
					return format::abc::OpCode_obj::OOp(format::abc::Operation_obj::OpIMul);
				}
				break;
				case 208: {
					return format::abc::OpCode_obj::OThis;
				}
				break;
				case 209: {
					return format::abc::OpCode_obj::OReg(1);
				}
				break;
				case 210: {
					return format::abc::OpCode_obj::OReg(2);
				}
				break;
				case 211: {
					return format::abc::OpCode_obj::OReg(3);
				}
				break;
				case 212: {
					return format::abc::OpCode_obj::OSetThis;
				}
				break;
				case 213: {
					return format::abc::OpCode_obj::OSetReg(1);
				}
				break;
				case 214: {
					return format::abc::OpCode_obj::OSetReg(2);
				}
				break;
				case 215: {
					return format::abc::OpCode_obj::OSetReg(3);
				}
				break;
				case 239: {
					++format::abc::OpReader_obj::bytePos;
					if (__this->i->readByte() != 1)
						hxThrow (STRING(L"assert",6));
					format::abc::Index name = format::abc::Index_obj::Idx(__this->readInt());
					struct _Function_2{
						static int Block( format::abc::OpReader_obj *__this)/* DEF (ret block)(not intern) */{
							++format::abc::OpReader_obj::bytePos;
							return __this->i->readByte();
						}
					};
					int r = _Function_2::Block(__this);
					int line = __this->readInt();
					return format::abc::OpCode_obj::ODebugReg(name,r,line);
				}
				break;
				case 240: {
					return format::abc::OpCode_obj::ODebugLine(__this->readInt());
				}
				break;
				case 241: {
					return format::abc::OpCode_obj::ODebugFile(format::abc::Index_obj::Idx(__this->readInt()));
				}
				break;
				case 242: {
					return format::abc::OpCode_obj::OBreakPointLine(__this->readInt());
				}
				break;
				case 243: {
					return format::abc::OpCode_obj::OTimestamp;
				}
				break;
				default: {
					return format::abc::OpCode_obj::OUnknown(op);
				}
			}
		}
	};
	return _Function_1::Block(op,this);
}


DEFINE_DYNAMIC_FUNC1(OpReader_obj,readOp,return )

int OpReader_obj::bytePos;

Array<Array<String > > OpReader_obj::jumps;

int OpReader_obj::jumpNameIndex;

Array<String > OpReader_obj::labels;

int OpReader_obj::labelNameIndex;

Array<format::abc::OpCode > OpReader_obj::ops;

Array<format::abc::OpCode > OpReader_obj::decode( haxe::io::Input i){
	format::abc::OpReader_obj::bytePos = 0;
	format::abc::OpReader_obj::jumps = Array_obj<Array<String > >::__new();
	format::abc::OpReader_obj::jumpNameIndex = 0;
	format::abc::OpReader_obj::labels = Array_obj<String >::__new();
	format::abc::OpReader_obj::labelNameIndex = 0;
	format::abc::OpReader opr = format::abc::OpReader_obj::__new(i);
	format::abc::OpReader_obj::ops = Array_obj<format::abc::OpCode >::__new();
	while(true){
		int op;
		try{
			if (format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos) != null()){
				int _g = 0;
				Array<String > _g1 = format::abc::OpReader_obj::jumps->__get(format::abc::OpReader_obj::bytePos);
				while(_g < _g1->length){
					String s = _g1->__get(_g);
					++_g;
					format::abc::OpReader_obj::ops->push(format::abc::OpCode_obj::OJump3(s));
				}
			}
			op = i->readByte();
			++format::abc::OpReader_obj::bytePos;
		}
		catch(Dynamic __e){
			if (__e.IsClass<haxe::io::Eof >() ){
				haxe::io::Eof e = __e;{
					break;
				}
			}
			else throw(__e);
		}
		format::abc::OpReader_obj::ops->push(opr->readOp(op));
	}
	return format::abc::OpReader_obj::ops;
}


STATIC_DEFINE_DYNAMIC_FUNC1(OpReader_obj,decode,return )


OpReader_obj::OpReader_obj()
{
	InitMember(i);
}

void OpReader_obj::__Mark()
{
	MarkMember(i);
}

Dynamic OpReader_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"i",sizeof(wchar_t)*1) ) { return i; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"ops",sizeof(wchar_t)*3) ) { return ops; }
		if (!memcmp(inName.__s,L"reg",sizeof(wchar_t)*3) ) { return reg_dyn(); }
		if (!memcmp(inName.__s,L"jmp",sizeof(wchar_t)*3) ) { return jmp_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"jumps",sizeof(wchar_t)*5) ) { return jumps; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"labels",sizeof(wchar_t)*6) ) { return labels; }
		if (!memcmp(inName.__s,L"decode",sizeof(wchar_t)*6) ) { return decode_dyn(); }
		if (!memcmp(inName.__s,L"readOp",sizeof(wchar_t)*6) ) { return readOp_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"bytePos",sizeof(wchar_t)*7) ) { return bytePos; }
		if (!memcmp(inName.__s,L"readInt",sizeof(wchar_t)*7) ) { return readInt_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"readIndex",sizeof(wchar_t)*9) ) { return readIndex_dyn(); }
		if (!memcmp(inName.__s,L"readInt32",sizeof(wchar_t)*9) ) { return readInt32_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"jumpNameIndex",sizeof(wchar_t)*13) ) { return jumpNameIndex; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"labelNameIndex",sizeof(wchar_t)*14) ) { return labelNameIndex; }
	}
	return super::__Field(inName);
}

static int __id_bytePos = __hxcpp_field_to_id("bytePos");
static int __id_jumps = __hxcpp_field_to_id("jumps");
static int __id_jumpNameIndex = __hxcpp_field_to_id("jumpNameIndex");
static int __id_labels = __hxcpp_field_to_id("labels");
static int __id_labelNameIndex = __hxcpp_field_to_id("labelNameIndex");
static int __id_ops = __hxcpp_field_to_id("ops");
static int __id_decode = __hxcpp_field_to_id("decode");
static int __id_i = __hxcpp_field_to_id("i");
static int __id_readInt = __hxcpp_field_to_id("readInt");
static int __id_readIndex = __hxcpp_field_to_id("readIndex");
static int __id_readInt32 = __hxcpp_field_to_id("readInt32");
static int __id_reg = __hxcpp_field_to_id("reg");
static int __id_jmp = __hxcpp_field_to_id("jmp");
static int __id_readOp = __hxcpp_field_to_id("readOp");


Dynamic OpReader_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_bytePos) return bytePos;
	if (inFieldID==__id_jumps) return jumps;
	if (inFieldID==__id_jumpNameIndex) return jumpNameIndex;
	if (inFieldID==__id_labels) return labels;
	if (inFieldID==__id_labelNameIndex) return labelNameIndex;
	if (inFieldID==__id_ops) return ops;
	if (inFieldID==__id_decode) return decode_dyn();
	if (inFieldID==__id_i) return i;
	if (inFieldID==__id_readInt) return readInt_dyn();
	if (inFieldID==__id_readIndex) return readIndex_dyn();
	if (inFieldID==__id_readInt32) return readInt32_dyn();
	if (inFieldID==__id_reg) return reg_dyn();
	if (inFieldID==__id_jmp) return jmp_dyn();
	if (inFieldID==__id_readOp) return readOp_dyn();
	return super::__IField(inFieldID);
}

Dynamic OpReader_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"i",sizeof(wchar_t)*1) ) { i=inValue.Cast<haxe::io::Input >();return inValue; }
		break;
	case 3:
		if (!memcmp(inName.__s,L"ops",sizeof(wchar_t)*3) ) { ops=inValue.Cast<Array<format::abc::OpCode > >();return inValue; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"jumps",sizeof(wchar_t)*5) ) { jumps=inValue.Cast<Array<Array<String > > >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"labels",sizeof(wchar_t)*6) ) { labels=inValue.Cast<Array<String > >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"bytePos",sizeof(wchar_t)*7) ) { bytePos=inValue.Cast<int >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"jumpNameIndex",sizeof(wchar_t)*13) ) { jumpNameIndex=inValue.Cast<int >();return inValue; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"labelNameIndex",sizeof(wchar_t)*14) ) { labelNameIndex=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void OpReader_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"i",1));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"bytePos",7),
	STRING(L"jumps",5),
	STRING(L"jumpNameIndex",13),
	STRING(L"labels",6),
	STRING(L"labelNameIndex",14),
	STRING(L"ops",3),
	STRING(L"decode",6),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"i",1),
	STRING(L"readInt",7),
	STRING(L"readIndex",9),
	STRING(L"readInt32",9),
	STRING(L"reg",3),
	STRING(L"jmp",3),
	STRING(L"readOp",6),
	String(null()) };

static void sMarkStatics() {
	MarkMember(OpReader_obj::bytePos);
	MarkMember(OpReader_obj::jumps);
	MarkMember(OpReader_obj::jumpNameIndex);
	MarkMember(OpReader_obj::labels);
	MarkMember(OpReader_obj::labelNameIndex);
	MarkMember(OpReader_obj::ops);
};

Class OpReader_obj::__mClass;

void OpReader_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.abc.OpReader",19), TCanCast<OpReader_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void OpReader_obj::__boot()
{
	Static(bytePos) = 0;
	Static(jumps);
	Static(jumpNameIndex);
	Static(labels);
	Static(labelNameIndex);
	Static(ops);
}

} // end namespace format
} // end namespace abc
