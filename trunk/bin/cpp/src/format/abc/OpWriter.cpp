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
#ifndef INCLUDED_format_abc_OpWriter
#include <format/abc/OpWriter.h>
#endif
#ifndef INCLUDED_format_abc_Operation
#include <format/abc/Operation.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace format{
namespace abc{

Void OpWriter_obj::__construct(haxe::io::Output o)
{
{
	this->o = o;
}
;
	return null();
}

OpWriter_obj::~OpWriter_obj() { }

Dynamic OpWriter_obj::__CreateEmpty() { return  new OpWriter_obj; }
hxObjectPtr<OpWriter_obj > OpWriter_obj::__new(haxe::io::Output o)
{  hxObjectPtr<OpWriter_obj > result = new OpWriter_obj();
	result->__construct(o);
	return result;}

Dynamic OpWriter_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<OpWriter_obj > result = new OpWriter_obj();
	result->__construct(inArgs[0]);
	return result;}

Void OpWriter_obj::writeInt( int n){
{
		int e = hxUShr(n,28);
		int d = int((int(n) >> int(21))) & int(127);
		int c = int((int(n) >> int(14))) & int(127);
		int b = int((int(n) >> int(7))) & int(127);
		int a = int(n) & int(127);
		if (bool(b != 0) || bool(bool(c != 0) || bool(bool(d != 0) || bool(e != 0)))){
			this->o->writeByte(int(a) | int(128));
			if (bool(c != 0) || bool(bool(d != 0) || bool(e != 0))){
				this->o->writeByte(int(b) | int(128));
				if (bool(d != 0) || bool(e != 0)){
					this->o->writeByte(int(c) | int(128));
					if (e != 0){
						this->o->writeByte(int(d) | int(128));
						this->o->writeByte(e);
					}
					else
						this->o->writeByte(d);
;
				}
				else
					this->o->writeByte(c);
;
			}
			else
				this->o->writeByte(b);
;
		}
		else
			this->o->writeByte(a);
;
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(OpWriter_obj,writeInt,(void))

Void OpWriter_obj::writeInt32( cpp::CppInt32__ n){
{
		int e = cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::ushr(n,28));
		int n1 = cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::_and(n,cpp::CppInt32___obj::ofInt(268435455)));
		int d = int((int(n1) >> int(21))) & int(127);
		int c = int((int(n1) >> int(14))) & int(127);
		int b = int((int(n1) >> int(7))) & int(127);
		int a = int(n1) & int(127);
		if (bool(b != 0) || bool(bool(c != 0) || bool(bool(d != 0) || bool(e != 0)))){
			this->o->writeByte(int(a) | int(128));
			if (bool(c != 0) || bool(bool(d != 0) || bool(e != 0))){
				this->o->writeByte(int(b) | int(128));
				if (bool(d != 0) || bool(e != 0)){
					this->o->writeByte(int(c) | int(128));
					if (e != 0){
						this->o->writeByte(int(d) | int(128));
						this->o->writeByte(e);
					}
					else
						this->o->writeByte(d);
;
				}
				else
					this->o->writeByte(c);
;
			}
			else
				this->o->writeByte(b);
;
		}
		else
			this->o->writeByte(a);
;
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(OpWriter_obj,writeInt32,(void))

Void OpWriter_obj::toInt( int i){
{
		this->writeInt(i);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(OpWriter_obj,toInt,(void))

Void OpWriter_obj::b( int v){
{
		this->o->writeByte(v);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(OpWriter_obj,b,(void))

Void OpWriter_obj::reg( int v){
{
		this->o->writeByte(v);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(OpWriter_obj,reg,(void))

Void OpWriter_obj::idx( format::abc::Index i){
{
		format::abc::Index _switch_1 = (i);
		switch((_switch_1)->GetIndex()){
			case 0: {
				int i1 = _switch_1->__Param(0);
{
					this->toInt(i1);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(OpWriter_obj,idx,(void))

int OpWriter_obj::jumpCode( format::abc::JumpStyle j){
	struct _Function_1{
		static int Block( format::abc::JumpStyle &j)/* DEF (not block)(ret intern) */{
			format::abc::JumpStyle _switch_2 = (j);
			switch((_switch_2)->GetIndex()){
				case 0: {
					return 12;
				}
				break;
				case 1: {
					return 13;
				}
				break;
				case 2: {
					return 14;
				}
				break;
				case 3: {
					return 15;
				}
				break;
				case 4: {
					return 16;
				}
				break;
				case 5: {
					return 17;
				}
				break;
				case 6: {
					return 18;
				}
				break;
				case 7: {
					return 19;
				}
				break;
				case 8: {
					return 20;
				}
				break;
				case 9: {
					return 21;
				}
				break;
				case 10: {
					return 22;
				}
				break;
				case 11: {
					return 23;
				}
				break;
				case 12: {
					return 24;
				}
				break;
				case 13: {
					return 25;
				}
				break;
				case 14: {
					return 26;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(j);
}


DEFINE_DYNAMIC_FUNC1(OpWriter_obj,jumpCode,return )

int OpWriter_obj::operationCode( format::abc::Operation o){
	struct _Function_1{
		static int Block( format::abc::Operation &o)/* DEF (not block)(ret intern) */{
			format::abc::Operation _switch_3 = (o);
			switch((_switch_3)->GetIndex()){
				case 0: {
					return 135;
				}
				break;
				case 1: {
					return 144;
				}
				break;
				case 2: {
					return 145;
				}
				break;
				case 3: {
					return 147;
				}
				break;
				case 4: {
					return 150;
				}
				break;
				case 5: {
					return 151;
				}
				break;
				case 6: {
					return 160;
				}
				break;
				case 7: {
					return 161;
				}
				break;
				case 8: {
					return 162;
				}
				break;
				case 9: {
					return 163;
				}
				break;
				case 10: {
					return 164;
				}
				break;
				case 11: {
					return 165;
				}
				break;
				case 12: {
					return 166;
				}
				break;
				case 13: {
					return 167;
				}
				break;
				case 14: {
					return 168;
				}
				break;
				case 15: {
					return 169;
				}
				break;
				case 16: {
					return 170;
				}
				break;
				case 17: {
					return 171;
				}
				break;
				case 18: {
					return 172;
				}
				break;
				case 19: {
					return 173;
				}
				break;
				case 20: {
					return 174;
				}
				break;
				case 21: {
					return 175;
				}
				break;
				case 22: {
					return 176;
				}
				break;
				case 23: {
					return 179;
				}
				break;
				case 24: {
					return 180;
				}
				break;
				case 25: {
					return 192;
				}
				break;
				case 26: {
					return 193;
				}
				break;
				case 27: {
					return 196;
				}
				break;
				case 28: {
					return 197;
				}
				break;
				case 29: {
					return 198;
				}
				break;
				case 30: {
					return 199;
				}
				break;
				case 31: {
					return 53;
				}
				break;
				case 32: {
					return 54;
				}
				break;
				case 33: {
					return 55;
				}
				break;
				case 34: {
					return 56;
				}
				break;
				case 35: {
					return 57;
				}
				break;
				case 36: {
					return 58;
				}
				break;
				case 37: {
					return 59;
				}
				break;
				case 38: {
					return 60;
				}
				break;
				case 39: {
					return 61;
				}
				break;
				case 40: {
					return 62;
				}
				break;
				case 41: {
					return 80;
				}
				break;
				case 42: {
					return 81;
				}
				break;
				case 43: {
					return 82;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(o);
}


DEFINE_DYNAMIC_FUNC1(OpWriter_obj,operationCode,return )

Void OpWriter_obj::write( format::abc::OpCode op){
{
		format::abc::OpCode _switch_4 = (op);
		switch((_switch_4)->GetIndex()){
			case 0: {
				this->o->writeByte(1);
			}
			break;
			case 1: {
				this->o->writeByte(2);
			}
			break;
			case 2: {
				this->o->writeByte(3);
			}
			break;
			case 3: {
				format::abc::Index v = _switch_4->__Param(0);
{
					this->o->writeByte(4);
					this->idx(v);
				}
			}
			break;
			case 4: {
				format::abc::Index v = _switch_4->__Param(0);
{
					this->o->writeByte(5);
					this->idx(v);
				}
			}
			break;
			case 5: {
				format::abc::Index i = _switch_4->__Param(0);
{
					this->o->writeByte(6);
					this->idx(i);
				}
			}
			break;
			case 6: {
				this->o->writeByte(7);
			}
			break;
			case 7: {
				int r = _switch_4->__Param(0);
{
					this->o->writeByte(8);
					this->reg(r);
				}
			}
			break;
			case 8: {
				this->o->writeByte(9);
			}
			break;
			case 9: {
				int delta = _switch_4->__Param(1);
				format::abc::JumpStyle j = _switch_4->__Param(0);
{
					this->o->writeByte(this->jumpCode(j));
					this->o->writeInt24(delta);
				}
			}
			break;
			case 10: {
				Array<int > deltas = _switch_4->__Param(1);
				int def = _switch_4->__Param(0);
{
					this->o->writeByte(27);
					this->o->writeInt24(def);
					this->toInt(deltas->length - 1);
					{
						int _g = 0;
						while(_g < deltas->length){
							int d = deltas->__get(_g);
							++_g;
							this->o->writeInt24(d);
						}
					}
				}
			}
			break;
			case 11: {
				this->o->writeByte(28);
			}
			break;
			case 12: {
				this->o->writeByte(29);
			}
			break;
			case 13: {
				this->o->writeByte(30);
			}
			break;
			case 14: {
				this->o->writeByte(31);
			}
			break;
			case 15: {
				this->o->writeByte(32);
			}
			break;
			case 16: {
				this->o->writeByte(33);
			}
			break;
			case 17: {
				this->o->writeByte(35);
			}
			break;
			case 18: {
				int v = _switch_4->__Param(0);
{
					this->o->writeByte(36);
					this->o->writeInt8(v);
				}
			}
			break;
			case 19: {
				int v = _switch_4->__Param(0);
{
					this->o->writeByte(37);
					this->toInt(v);
				}
			}
			break;
			case 20: {
				this->o->writeByte(38);
			}
			break;
			case 21: {
				this->o->writeByte(39);
			}
			break;
			case 22: {
				this->o->writeByte(40);
			}
			break;
			case 23: {
				this->o->writeByte(41);
			}
			break;
			case 24: {
				this->o->writeByte(42);
			}
			break;
			case 25: {
				this->o->writeByte(43);
			}
			break;
			case 26: {
				format::abc::Index v = _switch_4->__Param(0);
{
					this->o->writeByte(44);
					this->idx(v);
				}
			}
			break;
			case 27: {
				format::abc::Index v = _switch_4->__Param(0);
{
					this->o->writeByte(45);
					this->idx(v);
				}
			}
			break;
			case 28: {
				format::abc::Index v = _switch_4->__Param(0);
{
					this->o->writeByte(46);
					this->idx(v);
				}
			}
			break;
			case 29: {
				format::abc::Index v = _switch_4->__Param(0);
{
					this->o->writeByte(47);
					this->idx(v);
				}
			}
			break;
			case 30: {
				this->o->writeByte(48);
			}
			break;
			case 31: {
				format::abc::Index v = _switch_4->__Param(0);
{
					this->o->writeByte(49);
					this->idx(v);
				}
			}
			break;
			case 32: {
				int r2 = _switch_4->__Param(1);
				int r1 = _switch_4->__Param(0);
{
					this->o->writeByte(50);
					this->toInt(r1);
					this->toInt(r2);
				}
			}
			break;
			case 33: {
				format::abc::Index f = _switch_4->__Param(0);
{
					this->o->writeByte(64);
					this->idx(f);
				}
			}
			break;
			case 34: {
				int n = _switch_4->__Param(0);
{
					this->o->writeByte(65);
					this->toInt(n);
				}
			}
			break;
			case 35: {
				int n = _switch_4->__Param(0);
{
					this->o->writeByte(66);
					this->toInt(n);
				}
			}
			break;
			case 36: {
				int n = _switch_4->__Param(1);
				int s = _switch_4->__Param(0);
{
					this->o->writeByte(67);
					this->toInt(s);
					this->toInt(n);
				}
			}
			break;
			case 37: {
				int n = _switch_4->__Param(1);
				format::abc::Index m = _switch_4->__Param(0);
{
					this->o->writeByte(68);
					this->idx(m);
					this->toInt(n);
				}
			}
			break;
			case 38: {
				int n = _switch_4->__Param(1);
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(69);
					this->idx(p);
					this->toInt(n);
				}
			}
			break;
			case 39: {
				int n = _switch_4->__Param(1);
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(70);
					this->idx(p);
					this->toInt(n);
				}
			}
			break;
			case 40: {
				this->o->writeByte(71);
			}
			break;
			case 41: {
				this->o->writeByte(72);
			}
			break;
			case 42: {
				int n = _switch_4->__Param(0);
{
					this->o->writeByte(73);
					this->toInt(n);
				}
			}
			break;
			case 43: {
				int n = _switch_4->__Param(1);
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(74);
					this->idx(p);
					this->toInt(n);
				}
			}
			break;
			case 44: {
				int n = _switch_4->__Param(1);
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(76);
					this->idx(p);
					this->toInt(n);
				}
			}
			break;
			case 45: {
				int n = _switch_4->__Param(1);
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(78);
					this->idx(p);
					this->toInt(n);
				}
			}
			break;
			case 46: {
				int n = _switch_4->__Param(1);
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(79);
					this->idx(p);
					this->toInt(n);
				}
			}
			break;
			case 47: {
				int n = _switch_4->__Param(0);
{
					this->o->writeByte(83);
					this->toInt(n);
				}
			}
			break;
			case 48: {
				int n = _switch_4->__Param(0);
{
					this->o->writeByte(85);
					this->toInt(n);
				}
			}
			break;
			case 49: {
				int n = _switch_4->__Param(0);
{
					this->o->writeByte(86);
					this->toInt(n);
				}
			}
			break;
			case 50: {
				this->o->writeByte(87);
			}
			break;
			case 51: {
				format::abc::Index c = _switch_4->__Param(0);
{
					this->o->writeByte(88);
					this->idx(c);
				}
			}
			break;
			case 52: {
				format::abc::Index i = _switch_4->__Param(0);
{
					this->o->writeByte(89);
					this->idx(i);
				}
			}
			break;
			case 53: {
				int c = _switch_4->__Param(0);
{
					this->o->writeByte(90);
					this->toInt(c);
				}
			}
			break;
			case 54: {
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(93);
					this->idx(p);
				}
			}
			break;
			case 55: {
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(94);
					this->idx(p);
				}
			}
			break;
			case 56: {
				format::abc::Index d = _switch_4->__Param(0);
{
					this->o->writeByte(95);
					this->idx(d);
				}
			}
			break;
			case 57: {
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(96);
					this->idx(p);
				}
			}
			break;
			case 58: {
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(97);
					this->idx(p);
				}
			}
			break;
			case 59: {
				int r = _switch_4->__Param(0);
{
					switch( (int)(r)){
						case 0: {
							this->o->writeByte(208);
						}
						break;
						case 1: {
							this->o->writeByte(209);
						}
						break;
						case 2: {
							this->o->writeByte(210);
						}
						break;
						case 3: {
							this->o->writeByte(211);
						}
						break;
						default: {
							this->o->writeByte(98);
							this->reg(r);
						}
					}
				}
			}
			break;
			case 60: {
				int r = _switch_4->__Param(0);
{
					switch( (int)(r)){
						case 0: {
							this->o->writeByte(212);
						}
						break;
						case 1: {
							this->o->writeByte(213);
						}
						break;
						case 2: {
							this->o->writeByte(214);
						}
						break;
						case 3: {
							this->o->writeByte(215);
						}
						break;
						default: {
							this->o->writeByte(99);
							this->reg(r);
						}
					}
				}
			}
			break;
			case 61: {
				this->o->writeByte(100);
			}
			break;
			case 62: {
				int n = _switch_4->__Param(0);
{
					this->o->writeByte(101);
					this->o->writeByte(n);
				}
			}
			break;
			case 63: {
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(102);
					this->idx(p);
				}
			}
			break;
			case 64: {
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(104);
					this->idx(p);
				}
			}
			break;
			case 65: {
				format::abc::Index p = _switch_4->__Param(0);
{
					this->o->writeByte(106);
					this->idx(p);
				}
			}
			break;
			case 66: {
				int s = _switch_4->__Param(0);
{
					this->o->writeByte(108);
					this->toInt(s);
				}
			}
			break;
			case 67: {
				int s = _switch_4->__Param(0);
{
					this->o->writeByte(109);
					this->toInt(s);
				}
			}
			break;
			case 68: {
				this->o->writeByte(112);
			}
			break;
			case 69: {
				this->o->writeByte(113);
			}
			break;
			case 70: {
				this->o->writeByte(114);
			}
			break;
			case 71: {
				this->o->writeByte(115);
			}
			break;
			case 72: {
				this->o->writeByte(116);
			}
			break;
			case 73: {
				this->o->writeByte(117);
			}
			break;
			case 74: {
				this->o->writeByte(118);
			}
			break;
			case 75: {
				this->o->writeByte(119);
			}
			break;
			case 76: {
				this->o->writeByte(120);
			}
			break;
			case 77: {
				format::abc::Index t = _switch_4->__Param(0);
{
					this->o->writeByte(128);
					this->idx(t);
				}
			}
			break;
			case 78: {
				this->o->writeByte(130);
			}
			break;
			case 79: {
				this->o->writeByte(133);
			}
			break;
			case 80: {
				format::abc::Index t = _switch_4->__Param(0);
{
					this->o->writeByte(134);
					this->idx(t);
				}
			}
			break;
			case 81: {
				this->o->writeByte(137);
			}
			break;
			case 82: {
				int r = _switch_4->__Param(0);
{
					this->o->writeByte(146);
					this->reg(r);
				}
			}
			break;
			case 83: {
				int r = _switch_4->__Param(0);
{
					this->o->writeByte(148);
					this->reg(r);
				}
			}
			break;
			case 84: {
				this->o->writeByte(149);
			}
			break;
			case 85: {
				this->o->writeByte(177);
			}
			break;
			case 86: {
				format::abc::Index t = _switch_4->__Param(0);
{
					this->o->writeByte(178);
					this->idx(t);
				}
			}
			break;
			case 87: {
				int r = _switch_4->__Param(0);
{
					this->o->writeByte(194);
					this->reg(r);
				}
			}
			break;
			case 88: {
				int r = _switch_4->__Param(0);
{
					this->o->writeByte(195);
					this->reg(r);
				}
			}
			break;
			case 89: {
				this->o->writeByte(208);
			}
			break;
			case 90: {
				this->o->writeByte(212);
			}
			break;
			case 91: {
				int line = _switch_4->__Param(2);
				int r = _switch_4->__Param(1);
				format::abc::Index name = _switch_4->__Param(0);
{
					this->o->writeByte(239);
					this->o->writeByte(1);
					this->idx(name);
					this->reg(r);
					this->toInt(line);
				}
			}
			break;
			case 92: {
				int line = _switch_4->__Param(0);
{
					this->o->writeByte(240);
					this->toInt(line);
				}
			}
			break;
			case 93: {
				format::abc::Index file = _switch_4->__Param(0);
{
					this->o->writeByte(241);
					this->idx(file);
				}
			}
			break;
			case 94: {
				int n = _switch_4->__Param(0);
{
					this->o->writeByte(242);
					this->toInt(n);
				}
			}
			break;
			case 95: {
				this->o->writeByte(243);
			}
			break;
			case 96: {
				format::abc::Operation op1 = _switch_4->__Param(0);
{
					this->o->writeByte(this->operationCode(op1));
				}
			}
			break;
			case 97: {
				int byte = _switch_4->__Param(0);
{
					this->o->writeByte(byte);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(OpWriter_obj,write,(void))


OpWriter_obj::OpWriter_obj()
{
	InitMember(o);
}

void OpWriter_obj::__Mark()
{
	MarkMember(o);
}

Dynamic OpWriter_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { return o; }
		if (!memcmp(inName.__s,L"b",sizeof(wchar_t)*1) ) { return b_dyn(); }
		break;
	case 3:
		if (!memcmp(inName.__s,L"int",sizeof(wchar_t)*3) ) { return toInt_dyn(); }
		if (!memcmp(inName.__s,L"reg",sizeof(wchar_t)*3) ) { return reg_dyn(); }
		if (!memcmp(inName.__s,L"idx",sizeof(wchar_t)*3) ) { return idx_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"write",sizeof(wchar_t)*5) ) { return write_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"writeInt",sizeof(wchar_t)*8) ) { return writeInt_dyn(); }
		if (!memcmp(inName.__s,L"jumpCode",sizeof(wchar_t)*8) ) { return jumpCode_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"writeInt32",sizeof(wchar_t)*10) ) { return writeInt32_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"operationCode",sizeof(wchar_t)*13) ) { return operationCode_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_o = __hxcpp_field_to_id("o");
static int __id_writeInt = __hxcpp_field_to_id("writeInt");
static int __id_writeInt32 = __hxcpp_field_to_id("writeInt32");
static int __id_toInt = __hxcpp_field_to_id("int");
static int __id_b = __hxcpp_field_to_id("b");
static int __id_reg = __hxcpp_field_to_id("reg");
static int __id_idx = __hxcpp_field_to_id("idx");
static int __id_jumpCode = __hxcpp_field_to_id("jumpCode");
static int __id_operationCode = __hxcpp_field_to_id("operationCode");
static int __id_write = __hxcpp_field_to_id("write");


Dynamic OpWriter_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_o) return o;
	if (inFieldID==__id_writeInt) return writeInt_dyn();
	if (inFieldID==__id_writeInt32) return writeInt32_dyn();
	if (inFieldID==__id_toInt) return toInt_dyn();
	if (inFieldID==__id_b) return b_dyn();
	if (inFieldID==__id_reg) return reg_dyn();
	if (inFieldID==__id_idx) return idx_dyn();
	if (inFieldID==__id_jumpCode) return jumpCode_dyn();
	if (inFieldID==__id_operationCode) return operationCode_dyn();
	if (inFieldID==__id_write) return write_dyn();
	return super::__IField(inFieldID);
}

Dynamic OpWriter_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { o=inValue.Cast<haxe::io::Output >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void OpWriter_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"o",1));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"o",1),
	STRING(L"writeInt",8),
	STRING(L"writeInt32",10),
	STRING(L"int",3),
	STRING(L"b",1),
	STRING(L"reg",3),
	STRING(L"idx",3),
	STRING(L"jumpCode",8),
	STRING(L"operationCode",13),
	STRING(L"write",5),
	String(null()) };

static void sMarkStatics() {
};

Class OpWriter_obj::__mClass;

void OpWriter_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.abc.OpWriter",19), TCanCast<OpWriter_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void OpWriter_obj::__boot()
{
}

} // end namespace format
} // end namespace abc
