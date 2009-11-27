#include <hxObject.h>

#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_swf_BlendMode
#include <format/swf/BlendMode.h>
#endif
#ifndef INCLUDED_format_swf_ColorModel
#include <format/swf/ColorModel.h>
#endif
#ifndef INCLUDED_format_swf_FillStyle
#include <format/swf/FillStyle.h>
#endif
#ifndef INCLUDED_format_swf_Filter
#include <format/swf/Filter.h>
#endif
#ifndef INCLUDED_format_swf_FontData
#include <format/swf/FontData.h>
#endif
#ifndef INCLUDED_format_swf_FontInfoData
#include <format/swf/FontInfoData.h>
#endif
#ifndef INCLUDED_format_swf_GradRecord
#include <format/swf/GradRecord.h>
#endif
#ifndef INCLUDED_format_swf_InterpolationMode
#include <format/swf/InterpolationMode.h>
#endif
#ifndef INCLUDED_format_swf_JPEGData
#include <format/swf/JPEGData.h>
#endif
#ifndef INCLUDED_format_swf_LS2Fill
#include <format/swf/LS2Fill.h>
#endif
#ifndef INCLUDED_format_swf_LangCode
#include <format/swf/LangCode.h>
#endif
#ifndef INCLUDED_format_swf_LineCapStyle
#include <format/swf/LineCapStyle.h>
#endif
#ifndef INCLUDED_format_swf_LineJoinStyle
#include <format/swf/LineJoinStyle.h>
#endif
#ifndef INCLUDED_format_swf_LineStyleData
#include <format/swf/LineStyleData.h>
#endif
#ifndef INCLUDED_format_swf_Morph2LineStyle
#include <format/swf/Morph2LineStyle.h>
#endif
#ifndef INCLUDED_format_swf_MorphFillStyle
#include <format/swf/MorphFillStyle.h>
#endif
#ifndef INCLUDED_format_swf_MorphShapeData
#include <format/swf/MorphShapeData.h>
#endif
#ifndef INCLUDED_format_swf_PlaceObject
#include <format/swf/PlaceObject.h>
#endif
#ifndef INCLUDED_format_swf_SWFTag
#include <format/swf/SWFTag.h>
#endif
#ifndef INCLUDED_format_swf_ShapeData
#include <format/swf/ShapeData.h>
#endif
#ifndef INCLUDED_format_swf_ShapeRecord
#include <format/swf/ShapeRecord.h>
#endif
#ifndef INCLUDED_format_swf_SoundData
#include <format/swf/SoundData.h>
#endif
#ifndef INCLUDED_format_swf_SoundFormat
#include <format/swf/SoundFormat.h>
#endif
#ifndef INCLUDED_format_swf_SoundRate
#include <format/swf/SoundRate.h>
#endif
#ifndef INCLUDED_format_swf_SpreadMode
#include <format/swf/SpreadMode.h>
#endif
#ifndef INCLUDED_format_swf_Tools
#include <format/swf/Tools.h>
#endif
#ifndef INCLUDED_format_swf_Writer
#include <format/swf/Writer.h>
#endif
#ifndef INCLUDED_format_tools_BitsOutput
#include <format/tools/BitsOutput.h>
#endif
#ifndef INCLUDED_format_tools_Deflate
#include <format/tools/Deflate.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesOutput
#include <haxe/io/BytesOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace format{
namespace swf{

Void Writer_obj::__construct(haxe::io::Output o)
{
{
	this->output = o;
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

Void Writer_obj::write( Dynamic s){
{
		this->writeHeader(s->__Field(STRING(L"header",6)));
		{
			int _g = 0;
			Array<format::swf::SWFTag > _g1 = s->__Field(STRING(L"tags",4)).Cast<Array<format::swf::SWFTag > >();
			while(_g < _g1->length){
				format::swf::SWFTag t = _g1->__get(_g);
				++_g;
				this->writeTag(t);
			}
		}
		this->writeEnd();
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,write,(void))

Void Writer_obj::writeRect( Dynamic r){
{
		struct _Function_1{
			static int Block( Dynamic &r)/* DEF (ret block)(not intern) */{
				Dynamic _g = hxClassOf<format::swf::Tools >();
				Array<int > values = Array_obj<int >::__new().Add(r->__Field(STRING(L"left",4)).Cast<int >()).Add(r->__Field(STRING(L"right",5)).Cast<int >()).Add(r->__Field(STRING(L"top",3)).Cast<int >()).Add(r->__Field(STRING(L"bottom",6)).Cast<int >());
				int max_bits = 0;
				{
					int _g1 = 0;
					while(_g1 < values->length){
						int x = values->__get(_g1);
						++_g1;
						if (x < 0)
							x = -x;
						hxOrEq(x,(int(x) >> int(1)));
						hxOrEq(x,(int(x) >> int(2)));
						hxOrEq(x,(int(x) >> int(4)));
						hxOrEq(x,(int(x) >> int(8)));
						hxOrEq(x,(int(x) >> int(16)));
						hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
						x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
						x = (int(((int(x) >> int(4)) + x)) & int(252645135));
						hxAddEq(x,(int(x) >> int(8)));
						hxAddEq(x,(int(x) >> int(16)));
						hxAndEq(x,63);
						if (x > max_bits)
							max_bits = x;
					}
				}
				return max_bits;
			}
		};
		int nbits = _Function_1::Block(r) + 1;
		this->bits->writeBits(5,nbits);
		this->bits->writeBits(nbits,r->__Field(STRING(L"left",4)).Cast<int >());
		this->bits->writeBits(nbits,r->__Field(STRING(L"right",5)).Cast<int >());
		this->bits->writeBits(nbits,r->__Field(STRING(L"top",3)).Cast<int >());
		this->bits->writeBits(nbits,r->__Field(STRING(L"bottom",6)).Cast<int >());
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeRect,(void))

Void Writer_obj::writeFixed8( int v){
{
		this->o->writeUInt16(v);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFixed8,(void))

Void Writer_obj::writeFixed( cpp::CppInt32__ v){
{
		this->o->writeInt32(v);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFixed,(void))

haxe::io::BytesOutput Writer_obj::openTMP( ){
	haxe::io::BytesOutput old = this->o;
	this->o = haxe::io::BytesOutput_obj::__new();
	this->bits->o = this->o;
	return old;
}


DEFINE_DYNAMIC_FUNC0(Writer_obj,openTMP,return )

haxe::io::Bytes Writer_obj::closeTMP( haxe::io::BytesOutput old){
	haxe::io::Bytes bytes = this->o->getBytes();
	this->o = old;
	this->bits->o = old;
	return bytes;
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,closeTMP,return )

Void Writer_obj::writeHeader( Dynamic h){
{
		this->compressed = false;
		this->output->writeString(this->compressed ? String( STRING(L"CWS",3) ) : String( STRING(L"FWS",3) ));
		this->output->writeByte(h->__Field(STRING(L"version",7)).Cast<int >());
		this->o = haxe::io::BytesOutput_obj::__new();
		this->bits = format::tools::BitsOutput_obj::__new(this->o);
		this->writeRect(hxAnon_obj::Create()->Add( STRING(L"left",4) , 0)->Add( STRING(L"top",3) , 0)->Add( STRING(L"right",5) , h->__Field(STRING(L"width",5)).Cast<int >() * 20)->Add( STRING(L"bottom",6) , h->__Field(STRING(L"height",6)).Cast<int >() * 20));
		this->o->writeByte(0);
		this->o->writeByte(h->__Field(STRING(L"fps",3)).Cast<int >());
		this->o->writeUInt16(h->__Field(STRING(L"nframes",7)).Cast<int >());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeHeader,(void))

Void Writer_obj::writeRGB( Dynamic c){
{
		this->o->writeByte(c->__Field(STRING(L"r",1)).Cast<int >());
		this->o->writeByte(c->__Field(STRING(L"g",1)).Cast<int >());
		this->o->writeByte(c->__Field(STRING(L"b",1)).Cast<int >());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeRGB,(void))

Void Writer_obj::writeRGBA( Dynamic c){
{
		this->o->writeByte(c->__Field(STRING(L"r",1)).Cast<int >());
		this->o->writeByte(c->__Field(STRING(L"g",1)).Cast<int >());
		this->o->writeByte(c->__Field(STRING(L"b",1)).Cast<int >());
		this->o->writeByte(c->__Field(STRING(L"a",1)).Cast<int >());
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeRGBA,(void))

Void Writer_obj::writeMatrix( Dynamic m){
{
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		if (m->__Field(STRING(L"scale",5)) != null()){
			this->bits->writeBit(true);
			struct _Function_1{
				static int Block( Dynamic &m)/* DEF (ret block)(not intern) */{
					double f = m->__Field(STRING(L"scale",5))->__Field(STRING(L"x",1)).Cast<double >();
					int i = Std_obj::toInt(f);
					if (((i > 0) ? int( i ) : int( -i )) >= 32768)
						hxThrow (haxe::io::Error_obj::Overflow);
					if (i < 0)
						i = 65536 - i;
					return int((int(i) << int(16))) | int(Std_obj::toInt((f - i) * 65536.0));
				}
			};
			int sx = _Function_1::Block(m);
			struct _Function_2{
				static int Block( Dynamic &m)/* DEF (ret block)(not intern) */{
					double f = m->__Field(STRING(L"scale",5))->__Field(STRING(L"y",1)).Cast<double >();
					int i = Std_obj::toInt(f);
					if (((i > 0) ? int( i ) : int( -i )) >= 32768)
						hxThrow (haxe::io::Error_obj::Overflow);
					if (i < 0)
						i = 65536 - i;
					return int((int(i) << int(16))) | int(Std_obj::toInt((f - i) * 65536.0));
				}
			};
			int sy = _Function_2::Block(m);
			struct _Function_3{
				static int Block( int &sx,int &sy)/* DEF (ret block)(not intern) */{
					Dynamic _g = hxClassOf<format::swf::Tools >();
					Array<int > values = Array_obj<int >::__new().Add(sx).Add(sy);
					int max_bits = 0;
					{
						int _g1 = 0;
						while(_g1 < values->length){
							int x = values->__get(_g1);
							++_g1;
							if (x < 0)
								x = -x;
							hxOrEq(x,(int(x) >> int(1)));
							hxOrEq(x,(int(x) >> int(2)));
							hxOrEq(x,(int(x) >> int(4)));
							hxOrEq(x,(int(x) >> int(8)));
							hxOrEq(x,(int(x) >> int(16)));
							hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
							x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
							x = (int(((int(x) >> int(4)) + x)) & int(252645135));
							hxAddEq(x,(int(x) >> int(8)));
							hxAddEq(x,(int(x) >> int(16)));
							hxAndEq(x,63);
							if (x > max_bits)
								max_bits = x;
						}
					}
					return max_bits;
				}
			};
			int nbits = _Function_3::Block(sx,sy) + 1;
			this->bits->writeBits(5,nbits);
			this->bits->writeBits(nbits,sx);
			this->bits->writeBits(nbits,sy);
		}
		else
			this->bits->writeBit(false);
;
		if (m->__Field(STRING(L"rotate",6)) != null()){
			this->bits->writeBit(true);
			struct _Function_1{
				static int Block( Dynamic &m)/* DEF (ret block)(not intern) */{
					double f = m->__Field(STRING(L"rotate",6))->__Field(STRING(L"rs0",3)).Cast<double >();
					int i = Std_obj::toInt(f);
					if (((i > 0) ? int( i ) : int( -i )) >= 32768)
						hxThrow (haxe::io::Error_obj::Overflow);
					if (i < 0)
						i = 65536 - i;
					return int((int(i) << int(16))) | int(Std_obj::toInt((f - i) * 65536.0));
				}
			};
			int rs0 = _Function_1::Block(m);
			struct _Function_2{
				static int Block( Dynamic &m)/* DEF (ret block)(not intern) */{
					double f = m->__Field(STRING(L"rotate",6))->__Field(STRING(L"rs1",3)).Cast<double >();
					int i = Std_obj::toInt(f);
					if (((i > 0) ? int( i ) : int( -i )) >= 32768)
						hxThrow (haxe::io::Error_obj::Overflow);
					if (i < 0)
						i = 65536 - i;
					return int((int(i) << int(16))) | int(Std_obj::toInt((f - i) * 65536.0));
				}
			};
			int rs1 = _Function_2::Block(m);
			struct _Function_3{
				static int Block( int &rs0,int &rs1)/* DEF (ret block)(not intern) */{
					Dynamic _g = hxClassOf<format::swf::Tools >();
					Array<int > values = Array_obj<int >::__new().Add(rs0).Add(rs1);
					int max_bits = 0;
					{
						int _g1 = 0;
						while(_g1 < values->length){
							int x = values->__get(_g1);
							++_g1;
							if (x < 0)
								x = -x;
							hxOrEq(x,(int(x) >> int(1)));
							hxOrEq(x,(int(x) >> int(2)));
							hxOrEq(x,(int(x) >> int(4)));
							hxOrEq(x,(int(x) >> int(8)));
							hxOrEq(x,(int(x) >> int(16)));
							hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
							x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
							x = (int(((int(x) >> int(4)) + x)) & int(252645135));
							hxAddEq(x,(int(x) >> int(8)));
							hxAddEq(x,(int(x) >> int(16)));
							hxAndEq(x,63);
							if (x > max_bits)
								max_bits = x;
						}
					}
					return max_bits;
				}
			};
			int nbits = _Function_3::Block(rs0,rs1) + 1;
			this->bits->writeBits(5,nbits);
			this->bits->writeBits(nbits,rs0);
			this->bits->writeBits(nbits,rs1);
		}
		else
			this->bits->writeBit(false);
;
		struct _Function_1{
			static int Block( Dynamic &m)/* DEF (ret block)(not intern) */{
				Dynamic _g = hxClassOf<format::swf::Tools >();
				Array<int > values = Array_obj<int >::__new().Add(m->__Field(STRING(L"translate",9))->__Field(STRING(L"x",1)).Cast<int >()).Add(m->__Field(STRING(L"translate",9))->__Field(STRING(L"y",1)).Cast<int >());
				int max_bits = 0;
				{
					int _g1 = 0;
					while(_g1 < values->length){
						int x = values->__get(_g1);
						++_g1;
						if (x < 0)
							x = -x;
						hxOrEq(x,(int(x) >> int(1)));
						hxOrEq(x,(int(x) >> int(2)));
						hxOrEq(x,(int(x) >> int(4)));
						hxOrEq(x,(int(x) >> int(8)));
						hxOrEq(x,(int(x) >> int(16)));
						hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
						x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
						x = (int(((int(x) >> int(4)) + x)) & int(252645135));
						hxAddEq(x,(int(x) >> int(8)));
						hxAddEq(x,(int(x) >> int(16)));
						hxAndEq(x,63);
						if (x > max_bits)
							max_bits = x;
					}
				}
				return max_bits;
			}
		};
		int nbits = _Function_1::Block(m) + 1;
		this->bits->writeBits(5,nbits);
		this->bits->writeBits(nbits,m->__Field(STRING(L"translate",9))->__Field(STRING(L"x",1)).Cast<int >());
		this->bits->writeBits(nbits,m->__Field(STRING(L"translate",9))->__Field(STRING(L"y",1)).Cast<int >());
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeMatrix,(void))

Void Writer_obj::writeCXAColor( Dynamic c,int nbits){
{
		this->bits->writeBits(nbits,c->__Field(STRING(L"r",1)).Cast<int >());
		this->bits->writeBits(nbits,c->__Field(STRING(L"g",1)).Cast<int >());
		this->bits->writeBits(nbits,c->__Field(STRING(L"b",1)).Cast<int >());
		this->bits->writeBits(nbits,c->__Field(STRING(L"a",1)).Cast<int >());
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeCXAColor,(void))

Void Writer_obj::writeCXA( Dynamic c){
{
		this->bits->writeBit(c->__Field(STRING(L"add",3)) != null());
		this->bits->writeBit(c->__Field(STRING(L"mult",4)) != null());
		this->bits->writeBits(4,c->__Field(STRING(L"nbits",5)).Cast<int >());
		if (c->__Field(STRING(L"mult",4)) != null())
			this->writeCXAColor(c->__Field(STRING(L"mult",4)),c->__Field(STRING(L"nbits",5)).Cast<int >());
		if (c->__Field(STRING(L"add",3)) != null())
			this->writeCXAColor(c->__Field(STRING(L"add",3)),c->__Field(STRING(L"nbits",5)).Cast<int >());
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeCXA,(void))

Void Writer_obj::writeClipEvents( Array<Dynamic > events){
{
		this->o->writeUInt16(0);
		int all = 0;
		{
			int _g = 0;
			while(_g < events->length){
				Dynamic e = events->__get(_g);
				++_g;
				hxOrEq(all,e->__Field(STRING(L"eventsFlags",11)).Cast<int >());
			}
		}
		this->o->writeUInt30(all);
		{
			int _g = 0;
			while(_g < events->length){
				Dynamic e = events->__get(_g);
				++_g;
				this->o->writeUInt30(e->__Field(STRING(L"eventsFlags",11)).Cast<int >());
				this->o->writeUInt30(e->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >()->length);
				this->o->write(e->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >());
			}
		}
		this->o->writeUInt16(0);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeClipEvents,(void))

Void Writer_obj::writeFilterFlags( Dynamic f,bool top){
{
		int flags = 32;
		if (f->__Field(STRING(L"inner",5)).Cast<bool >())
			hxOrEq(flags,128);
		if (f->__Field(STRING(L"knockout",8)).Cast<bool >())
			hxOrEq(flags,64);
		if (f->__Field(STRING(L"ontop",5)).Cast<bool >())
			hxOrEq(flags,16);
		hxOrEq(flags,f->__Field(STRING(L"passes",6)).Cast<int >());
		this->o->writeByte(flags);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeFilterFlags,(void))

Void Writer_obj::writeFilterGradient( Dynamic f){
{
		this->o->writeByte(f->__Field(STRING(L"colors",6)).Cast<Array<Dynamic > >()->length);
		{
			int _g = 0;
			Array<Dynamic > _g1 = f->__Field(STRING(L"colors",6)).Cast<Array<Dynamic > >();
			while(_g < _g1->length){
				Dynamic c = _g1->__get(_g);
				++_g;
				this->writeRGBA(c->__Field(STRING(L"color",5)));
			}
		}
		{
			int _g = 0;
			Array<Dynamic > _g1 = f->__Field(STRING(L"colors",6)).Cast<Array<Dynamic > >();
			while(_g < _g1->length){
				Dynamic c = _g1->__get(_g);
				++_g;
				this->o->writeByte(c->__Field(STRING(L"position",8)).Cast<int >());
			}
		}
		Dynamic d = f->__Field(STRING(L"data",4));
		this->o->writeInt32(d->__Field(STRING(L"blurX",5)).Cast<cpp::CppInt32__ >());
		this->o->writeInt32(d->__Field(STRING(L"blurY",5)).Cast<cpp::CppInt32__ >());
		this->o->writeInt32(d->__Field(STRING(L"angle",5)).Cast<cpp::CppInt32__ >());
		this->o->writeInt32(d->__Field(STRING(L"distance",8)).Cast<cpp::CppInt32__ >());
		this->o->writeUInt16(d->__Field(STRING(L"strength",8)).Cast<int >());
		this->writeFilterFlags(d->__Field(STRING(L"flags",5)),true);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFilterGradient,(void))

Void Writer_obj::writeFilter( format::swf::Filter f){
{
		format::swf::Filter _switch_1 = (f);
		switch((_switch_1)->GetIndex()){
			case 0: {
				Dynamic d = _switch_1->__Param(0);
{
					this->o->writeByte(0);
					this->writeRGBA(d->__Field(STRING(L"color",5)));
					this->o->writeInt32(d->__Field(STRING(L"blurX",5)).Cast<cpp::CppInt32__ >());
					this->o->writeInt32(d->__Field(STRING(L"blurY",5)).Cast<cpp::CppInt32__ >());
					this->o->writeInt32(d->__Field(STRING(L"angle",5)).Cast<cpp::CppInt32__ >());
					this->o->writeInt32(d->__Field(STRING(L"distance",8)).Cast<cpp::CppInt32__ >());
					this->o->writeUInt16(d->__Field(STRING(L"strength",8)).Cast<int >());
					this->writeFilterFlags(d->__Field(STRING(L"flags",5)),false);
				}
			}
			break;
			case 1: {
				Dynamic d = _switch_1->__Param(0);
{
					this->o->writeByte(1);
					this->o->writeInt32(d->__Field(STRING(L"blurX",5)).Cast<cpp::CppInt32__ >());
					this->o->writeInt32(d->__Field(STRING(L"blurY",5)).Cast<cpp::CppInt32__ >());
					this->o->writeByte(int(d->__Field(STRING(L"passes",6)).Cast<int >()) << int(3));
				}
			}
			break;
			case 2: {
				Dynamic d = _switch_1->__Param(0);
{
					this->o->writeByte(2);
					this->writeRGBA(d->__Field(STRING(L"color",5)));
					this->o->writeInt32(d->__Field(STRING(L"blurX",5)).Cast<cpp::CppInt32__ >());
					this->o->writeInt32(d->__Field(STRING(L"blurY",5)).Cast<cpp::CppInt32__ >());
					this->o->writeUInt16(d->__Field(STRING(L"strength",8)).Cast<int >());
					this->writeFilterFlags(d->__Field(STRING(L"flags",5)),false);
				}
			}
			break;
			case 3: {
				Dynamic d = _switch_1->__Param(0);
{
					this->o->writeByte(3);
					this->writeRGBA(d->__Field(STRING(L"color",5)));
					this->writeRGBA(d->__Field(STRING(L"color2",6)));
					this->o->writeInt32(d->__Field(STRING(L"blurX",5)).Cast<cpp::CppInt32__ >());
					this->o->writeInt32(d->__Field(STRING(L"blurY",5)).Cast<cpp::CppInt32__ >());
					this->o->writeInt32(d->__Field(STRING(L"angle",5)).Cast<cpp::CppInt32__ >());
					this->o->writeInt32(d->__Field(STRING(L"distance",8)).Cast<cpp::CppInt32__ >());
					this->o->writeUInt16(d->__Field(STRING(L"strength",8)).Cast<int >());
					this->writeFilterFlags(d->__Field(STRING(L"flags",5)),true);
				}
			}
			break;
			case 4: {
				Dynamic d = _switch_1->__Param(0);
{
					this->o->writeByte(5);
					this->writeFilterGradient(d);
				}
			}
			break;
			case 5: {
				Array<double > d = _switch_1->__Param(0);
{
					this->o->writeByte(6);
					{
						int _g = 0;
						while(_g < d->length){
							double f1 = d->__get(_g);
							++_g;
							this->o->writeFloat(f1);
						}
					}
				}
			}
			break;
			case 6: {
				Dynamic d = _switch_1->__Param(0);
{
					this->o->writeByte(7);
					this->writeFilterGradient(d);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFilter,(void))

Void Writer_obj::writeFilters( Array<format::swf::Filter > filters){
{
		this->o->writeByte(filters->length);
		{
			int _g = 0;
			while(_g < filters->length){
				format::swf::Filter f = filters->__get(_g);
				++_g;
				this->writeFilter(f);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFilters,(void))

Void Writer_obj::writeBlendMode( format::swf::BlendMode b){
{
		this->o->writeByte(b->__Index() + 1);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeBlendMode,(void))

Void Writer_obj::writePlaceObject( format::swf::PlaceObject po,bool v3){
{
		int f = 0;
		int f2 = 0;
		if (po->move)
			hxOrEq(f,1);
		if (po->cid != null())
			hxOrEq(f,2);
		if (po->matrix != null())
			hxOrEq(f,4);
		if (po->color != null())
			hxOrEq(f,8);
		if (po->ratio != null())
			hxOrEq(f,16);
		if (po->instanceName != null())
			hxOrEq(f,32);
		if (po->clipDepth != null())
			hxOrEq(f,64);
		if (po->events != null())
			hxOrEq(f,128);
		if (po->filters != null())
			hxOrEq(f2,1);
		if (po->blendMode != null())
			hxOrEq(f2,2);
		if (po->bitmapCache)
			hxOrEq(f2,4);
		this->o->writeByte(f);
		if (v3)
			this->o->writeByte(f2);
		else
			if (f2 != 0)
			hxThrow (STRING(L"Invalid place object version",28));
;
		this->o->writeUInt16(po->depth);
		if (po->cid != null())
			this->o->writeUInt16(po->cid);
		if (po->matrix != null())
			this->writeMatrix(po->matrix);
		if (po->color != null())
			this->writeCXA(po->color);
		if (po->ratio != null())
			this->o->writeUInt16(po->ratio);
		if (po->instanceName != null()){
			this->o->writeString(po->instanceName);
			this->o->writeByte(0);
		}
		if (po->clipDepth != null())
			this->o->writeUInt16(po->clipDepth);
		if (po->filters != null())
			this->writeFilters(po->filters);
		if (po->blendMode != null())
			this->writeBlendMode(po->blendMode);
		if (po->events != null())
			this->writeClipEvents(po->events);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writePlaceObject,(void))

Void Writer_obj::writeTID( int id,int len){
{
		int h = (int(id) << int(6));
		if (len < 63)
			this->o->writeUInt16(int(h) | int(len));
		else{
			this->o->writeUInt16(int(h) | int(63));
			this->o->writeUInt30(len);
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeTID,(void))

Void Writer_obj::writeTIDExt( int id,int len){
{
		this->o->writeUInt16(int((int(id) << int(6))) | int(63));
		this->o->writeUInt30(len);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeTIDExt,(void))

Void Writer_obj::writeSymbols( Array<Dynamic > sl,int tagid){
{
		int len = 2;
		{
			int _g = 0;
			while(_g < sl->length){
				Dynamic s = sl->__get(_g);
				++_g;
				hxAddEq(len,2 + s->__Field(STRING(L"className",9)).Cast<String >().length + 1);
			}
		}
		this->writeTID(tagid,len);
		this->o->writeUInt16(sl->length);
		{
			int _g = 0;
			while(_g < sl->length){
				Dynamic s = sl->__get(_g);
				++_g;
				this->o->writeUInt16(s->__Field(STRING(L"cid",3)).Cast<int >());
				this->o->writeString(s->__Field(STRING(L"className",9)).Cast<String >());
				this->o->writeByte(0);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeSymbols,(void))

Void Writer_obj::writeSound( Dynamic s){
{
		struct _Function_1{
			static int Block( Dynamic &s)/* DEF (not block)(ret intern) */{
				format::swf::SoundData _switch_2 = (s->__Field(STRING(L"data",4)).Cast<format::swf::SoundData >());
				switch((_switch_2)->GetIndex()){
					case 0: {
						haxe::io::Bytes data = _switch_2->__Param(1);
{
							return data->length + 2;
						}
					}
					break;
					case 1: {
						haxe::io::Bytes data = _switch_2->__Param(0);
{
							return data->length;
						}
					}
					break;
					case 2: {
						haxe::io::Bytes data = _switch_2->__Param(0);
{
							return data->length;
						}
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		int len = 7 + _Function_1::Block(s);
		this->writeTIDExt(14,len);
		this->o->writeUInt16(s->__Field(STRING(L"sid",3)).Cast<int >());
		struct _Function_2{
			static int Block( Dynamic &s)/* DEF (not block)(ret intern) */{
				format::swf::SoundFormat _switch_3 = (s->__Field(STRING(L"format",6)).Cast<format::swf::SoundFormat >());
				switch((_switch_3)->GetIndex()){
					case 0: {
						return 0;
					}
					break;
					case 1: {
						return 1;
					}
					break;
					case 2: {
						return 2;
					}
					break;
					case 3: {
						return 3;
					}
					break;
					case 4: {
						return 4;
					}
					break;
					case 5: {
						return 5;
					}
					break;
					case 6: {
						return 6;
					}
					break;
					case 7: {
						return 11;
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		this->bits->writeBits(4,_Function_2::Block(s));
		struct _Function_3{
			static int Block( Dynamic &s)/* DEF (not block)(ret intern) */{
				format::swf::SoundRate _switch_4 = (s->__Field(STRING(L"rate",4)).Cast<format::swf::SoundRate >());
				switch((_switch_4)->GetIndex()){
					case 0: {
						return 0;
					}
					break;
					case 1: {
						return 1;
					}
					break;
					case 2: {
						return 2;
					}
					break;
					case 3: {
						return 3;
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		this->bits->writeBits(2,_Function_3::Block(s));
		this->bits->writeBit(s->__Field(STRING(L"is16bit",7)).Cast<bool >());
		this->bits->writeBit(s->__Field(STRING(L"isStereo",8)).Cast<bool >());
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		this->o->writeInt32(s->__Field(STRING(L"samples",7)).Cast<cpp::CppInt32__ >());
		format::swf::SoundData _switch_5 = (s->__Field(STRING(L"data",4)).Cast<format::swf::SoundData >());
		switch((_switch_5)->GetIndex()){
			case 0: {
				haxe::io::Bytes data = _switch_5->__Param(1);
				int seek = _switch_5->__Param(0);
{
					this->o->writeInt16(seek);
					this->o->write(data);
				}
			}
			break;
			case 1: {
				haxe::io::Bytes data = _switch_5->__Param(0);
{
					this->o->write(data);
				}
			}
			break;
			case 2: {
				haxe::io::Bytes data = _switch_5->__Param(0);
{
					this->o->write(data);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeSound,(void))

Void Writer_obj::writeGradRecord( int ver,format::swf::GradRecord grad_record){
{
		format::swf::GradRecord _switch_6 = (grad_record);
		switch((_switch_6)->GetIndex()){
			case 0: {
				Dynamic col = _switch_6->__Param(1);
				int pos = _switch_6->__Param(0);
{
					if (ver > 2)
						hxThrow (STRING(L"Shape versions higher than 2 require alpha channel in gradient control points!",78));
					this->o->writeByte(pos);
					this->writeRGB(col);
				}
			}
			break;
			case 1: {
				Dynamic col = _switch_6->__Param(1);
				int pos = _switch_6->__Param(0);
{
					if (ver < 3)
						hxThrow (STRING(L"Shape versions lower than 3 don't support alpha channel in gradient control points!",83));
					this->o->writeByte(pos);
					this->writeRGBA(col);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeGradRecord,(void))

Void Writer_obj::writeGradient( int ver,Dynamic grad){
{
		struct _Function_1{
			static int Block( Dynamic &grad)/* DEF (not block)(ret intern) */{
				format::swf::SpreadMode _switch_7 = (grad->__Field(STRING(L"spread",6)).Cast<format::swf::SpreadMode >());
				switch((_switch_7)->GetIndex()){
					case 0: {
						return 0;
					}
					break;
					case 1: {
						return 1;
					}
					break;
					case 2: {
						return 2;
					}
					break;
					case 3: {
						return 3;
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		int spread_mode = _Function_1::Block(grad);
		struct _Function_2{
			static int Block( Dynamic &grad)/* DEF (not block)(ret intern) */{
				format::swf::InterpolationMode _switch_8 = (grad->__Field(STRING(L"interpolate",11)).Cast<format::swf::InterpolationMode >());
				switch((_switch_8)->GetIndex()){
					case 0: {
						return 0;
					}
					break;
					case 1: {
						return 1;
					}
					break;
					case 2: {
						return 2;
					}
					break;
					case 3: {
						return 3;
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		int interpolation_mode = _Function_2::Block(grad);
		if (bool(ver < 4) && bool((bool(spread_mode != 0) || bool(interpolation_mode != 0))))
			hxThrow (STRING(L"Spread must be Pad and interpolation mode must be Normal RGB in gradient specification when shape version is lower than 4!",122));
		int num_records = grad->__Field(STRING(L"data",4)).Cast<Array<format::swf::GradRecord > >()->length;
		if (ver < 4){
			if (num_records > 8)
				hxThrow (STRING(L"Gradient supports at most 8 control points (",44) + num_records + STRING(L" has bee given) when shape verison is lower than 4!",51));
		}
		else
			if (num_records > 15)
			hxThrow (STRING(L"Gradient supports at most 15 control points (",45) + num_records + STRING(L" has been given) at shape version 4!",36));
;
		this->bits->writeBits(2,spread_mode);
		this->bits->writeBits(2,interpolation_mode);
		this->bits->writeBits(4,num_records);
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		{
			int _g = 0;
			Array<format::swf::GradRecord > _g1 = grad->__Field(STRING(L"data",4)).Cast<Array<format::swf::GradRecord > >();
			while(_g < _g1->length){
				format::swf::GradRecord grad_record = _g1->__get(_g);
				++_g;
				this->writeGradRecord(ver,grad_record);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeGradient,(void))

Void Writer_obj::writeFocalGradient( int ver,Dynamic grad){
{
		if (ver < 4)
			hxThrow (STRING(L"Focal gradient only supported in shape versions higher than 3!",62));
		this->writeGradient(ver,grad->__Field(STRING(L"data",4)));
		this->o->writeUInt16(grad->__Field(STRING(L"focalPoint",10)).Cast<int >());
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeFocalGradient,(void))

Void Writer_obj::writeFillStyle( int ver,format::swf::FillStyle fill_style){
{
		format::swf::FillStyle _switch_9 = (fill_style);
		switch((_switch_9)->GetIndex()){
			case 0: {
				Dynamic rgb = _switch_9->__Param(0);
{
					if (ver > 2)
						hxThrow (STRING(L"Fill styles with Shape versions higher than 2 reqire alhpa channel!",67));
					this->o->writeByte(0);
					this->writeRGB(rgb);
				}
			}
			break;
			case 1: {
				Dynamic rgba = _switch_9->__Param(0);
{
					if (ver < 3)
						hxThrow (STRING(L"Fill styles with Shape versions lower than 3 doesn't support alhpa channel!",75));
					this->o->writeByte(0);
					this->writeRGBA(rgba);
				}
			}
			break;
			case 2: {
				Dynamic grad = _switch_9->__Param(1);
				Dynamic mat = _switch_9->__Param(0);
{
					this->o->writeByte(16);
					this->writeMatrix(mat);
					this->writeGradient(ver,grad);
				}
			}
			break;
			case 3: {
				Dynamic grad = _switch_9->__Param(1);
				Dynamic mat = _switch_9->__Param(0);
{
					this->o->writeByte(18);
					this->writeMatrix(mat);
					this->writeGradient(ver,grad);
				}
			}
			break;
			case 4: {
				Dynamic grad = _switch_9->__Param(1);
				Dynamic mat = _switch_9->__Param(0);
{
					if (ver > 3)
						hxThrow (STRING(L"Focal gradient fill style only supported with Shape versions higher than 3!",75));
					this->o->writeByte(19);
					this->writeMatrix(mat);
					this->writeFocalGradient(ver,grad);
				}
			}
			break;
			case 5: {
				bool smooth = _switch_9->__Param(3);
				bool repeat = _switch_9->__Param(2);
				Dynamic mat = _switch_9->__Param(1);
				int cid = _switch_9->__Param(0);
{
					struct _Function_1{
						static int Block( bool &smooth)/* DEF (ret block)(not intern) */{
							return smooth ? int( 64 ) : int( 66 );
						}
					};
					struct _Function_2{
						static int Block( bool &smooth)/* DEF (ret block)(not intern) */{
							return smooth ? int( 65 ) : int( 67 );
						}
					};
					this->o->writeByte(repeat ? int( _Function_1::Block(smooth) ) : int( _Function_2::Block(smooth) ));
					this->o->writeUInt16(cid);
					this->writeMatrix(mat);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeFillStyle,(void))

Void Writer_obj::writeFillStyles( int ver,Array<format::swf::FillStyle > fill_styles){
{
		int num_styles = fill_styles->length;
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		if (num_styles > 254){
			if (ver >= 2){
				this->o->writeByte(255);
				this->o->writeUInt16(num_styles);
			}
			else
				if (num_styles == 255)
				this->o->writeByte(255);
			else
				hxThrow (STRING(L"Too much fill styles (",22) + num_styles + STRING(L") for Shape version 1",21));
;
;
		}
		else
			this->o->writeByte(num_styles);
;
		{
			int _g = 0;
			while(_g < fill_styles->length){
				format::swf::FillStyle style = fill_styles->__get(_g);
				++_g;
				this->writeFillStyle(ver,style);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeFillStyles,(void))

Void Writer_obj::writeLineStyle( int ver,Dynamic line_style){
{
		this->o->writeUInt16(line_style->__Field(STRING(L"width",5)).Cast<int >());
		format::swf::LineStyleData _switch_10 = (line_style->__Field(STRING(L"data",4)).Cast<format::swf::LineStyleData >());
		switch((_switch_10)->GetIndex()){
			case 0: {
				Dynamic rgb = _switch_10->__Param(0);
{
					if (ver > 2)
						hxThrow (STRING(L"Line styles with Shape versions higher than 2 reqire alhpa channel!",67));
					this->writeRGB(rgb);
				}
			}
			break;
			case 1: {
				Dynamic rgba = _switch_10->__Param(0);
{
					if (ver < 3)
						hxThrow (STRING(L"Line styles with Shape versions lower than 3 doesn't support alhpa channel!",75));
					this->writeRGBA(rgba);
				}
			}
			break;
			case 2: {
				Dynamic data = _switch_10->__Param(0);
{
					if (ver < 4)
						hxThrow (STRING(L"LineStyle version 2 only supported in shape versions higher than 3!",67));
					struct _Function_1{
						static int Block( Dynamic &data)/* DEF (not block)(ret intern) */{
							format::swf::LineCapStyle _switch_11 = (data->__Field(STRING(L"startCap",8)).Cast<format::swf::LineCapStyle >());
							switch((_switch_11)->GetIndex()){
								case 0: {
									return 0;
								}
								break;
								case 1: {
									return 1;
								}
								break;
								case 2: {
									return 2;
								}
								break;
								default: {
									return null();
								}
							}
						}
					};
					this->bits->writeBits(2,_Function_1::Block(data));
					struct _Function_2{
						static int Block( Dynamic &data)/* DEF (not block)(ret intern) */{
							format::swf::LineJoinStyle _switch_12 = (data->__Field(STRING(L"join",4)).Cast<format::swf::LineJoinStyle >());
							switch((_switch_12)->GetIndex()){
								case 0: {
									return 0;
								}
								break;
								case 1: {
									return 1;
								}
								break;
								case 2: {
									int limitFactor = _switch_12->__Param(0);
{
										return 2;
									}
								}
								break;
								default: {
									return null();
								}
							}
						}
					};
					this->bits->writeBits(2,_Function_2::Block(data));
					struct _Function_3{
						static bool Block( Dynamic &data)/* DEF (not block)(ret intern) */{
							format::swf::LS2Fill _switch_13 = (data->__Field(STRING(L"fill",4)).Cast<format::swf::LS2Fill >());
							switch((_switch_13)->GetIndex()){
								case 0: {
									Dynamic color = _switch_13->__Param(0);
{
										return false;
									}
								}
								break;
								case 1: {
									format::swf::FillStyle style = _switch_13->__Param(0);
{
										return true;
									}
								}
								break;
								default: {
									return null();
								}
							}
						}
					};
					this->bits->writeBit(_Function_3::Block(data));
					this->bits->writeBit(data->__Field(STRING(L"noHScale",8)).Cast<bool >());
					this->bits->writeBit(data->__Field(STRING(L"noVScale",8)).Cast<bool >());
					this->bits->writeBit(data->__Field(STRING(L"pixelHinting",12)).Cast<bool >());
					this->bits->writeBits(5,0);
					this->bits->writeBit(data->__Field(STRING(L"noClose",7)).Cast<bool >());
					struct _Function_4{
						static int Block( Dynamic &data)/* DEF (not block)(ret intern) */{
							format::swf::LineCapStyle _switch_14 = (data->__Field(STRING(L"endCap",6)).Cast<format::swf::LineCapStyle >());
							switch((_switch_14)->GetIndex()){
								case 0: {
									return 0;
								}
								break;
								case 1: {
									return 1;
								}
								break;
								case 2: {
									return 2;
								}
								break;
								default: {
									return null();
								}
							}
						}
					};
					this->bits->writeBits(2,_Function_4::Block(data));
					format::swf::LineJoinStyle _switch_15 = (data->__Field(STRING(L"join",4)).Cast<format::swf::LineJoinStyle >());
					switch((_switch_15)->GetIndex()){
						case 2: {
							int limitFactor = _switch_15->__Param(0);
{
								this->o->writeUInt16(limitFactor);
							}
						}
						break;
						default: {
						}
					}
					format::swf::LS2Fill _switch_16 = (data->__Field(STRING(L"fill",4)).Cast<format::swf::LS2Fill >());
					switch((_switch_16)->GetIndex()){
						case 0: {
							Dynamic color = _switch_16->__Param(0);
{
								this->writeRGBA(color);
							}
						}
						break;
						case 1: {
							format::swf::FillStyle style = _switch_16->__Param(0);
{
								this->writeFillStyle(ver,style);
							}
						}
						break;
					}
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeLineStyle,(void))

Void Writer_obj::writeLineStyles( int ver,Array<Dynamic > line_styles){
{
		int num_styles = line_styles->length;
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		if (num_styles > 254){
			if (ver >= 2){
				this->o->writeByte(255);
				this->o->writeUInt16(num_styles);
			}
			else
				if (num_styles == 255)
				this->o->writeByte(255);
			else
				hxThrow (STRING(L"Too much line styles (",22) + num_styles + STRING(L") for Shape version 1",21));
;
;
		}
		else
			this->o->writeByte(num_styles);
;
		{
			int _g = 0;
			while(_g < line_styles->length){
				Dynamic style = line_styles->__get(_g);
				++_g;
				this->writeLineStyle(ver,style);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeLineStyles,(void))

Void Writer_obj::writeShapeRecord( int ver,Dynamic style_info,format::swf::ShapeRecord shape_record){
{
		format::swf::ShapeRecord _switch_17 = (shape_record);
		switch((_switch_17)->GetIndex()){
			case 0: {
				this->bits->writeBit(false);
				this->bits->writeBits(5,0);
			}
			break;
			case 1: {
				Dynamic data = _switch_17->__Param(0);
{
					this->bits->writeBit(false);
					if (data->__Field(STRING(L"newStyles",9)) != null()){
						if (bool(ver == 2) || bool(ver == 3))
							this->bits->writeBit(true);
						else
							hxThrow (STRING(L"Defining new fill and line style arrays are only supported in shape version 2 and 3!",84));
;
					}
					else
						this->bits->writeBit(false);
;
					this->bits->writeBit(data->__Field(STRING(L"lineStyle",9)) != null());
					this->bits->writeBit(data->__Field(STRING(L"fillStyle1",10)) != null());
					this->bits->writeBit(data->__Field(STRING(L"fillStyle0",10)) != null());
					this->bits->writeBit(data->__Field(STRING(L"moveTo",6)) != null());
					if (data->__Field(STRING(L"moveTo",6)) != null()){
						struct _Function_1{
							static int Block( Dynamic &data)/* DEF (ret block)(not intern) */{
								Dynamic _g = hxClassOf<format::swf::Tools >();
								Array<int > values = Array_obj<int >::__new().Add(data->__Field(STRING(L"moveTo",6))->__Field(STRING(L"dx",2)).Cast<int >()).Add(data->__Field(STRING(L"moveTo",6))->__Field(STRING(L"dy",2)).Cast<int >());
								int max_bits = 0;
								{
									int _g1 = 0;
									while(_g1 < values->length){
										int x = values->__get(_g1);
										++_g1;
										if (x < 0)
											x = -x;
										hxOrEq(x,(int(x) >> int(1)));
										hxOrEq(x,(int(x) >> int(2)));
										hxOrEq(x,(int(x) >> int(4)));
										hxOrEq(x,(int(x) >> int(8)));
										hxOrEq(x,(int(x) >> int(16)));
										hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
										x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
										x = (int(((int(x) >> int(4)) + x)) & int(252645135));
										hxAddEq(x,(int(x) >> int(8)));
										hxAddEq(x,(int(x) >> int(16)));
										hxAndEq(x,63);
										if (x > max_bits)
											max_bits = x;
									}
								}
								return max_bits;
							}
						};
						int mb = _Function_1::Block(data) + 1;
						this->bits->writeBits(5,mb);
						this->bits->writeBits(mb,data->__Field(STRING(L"moveTo",6))->__Field(STRING(L"dx",2)).Cast<int >());
						this->bits->writeBits(mb,data->__Field(STRING(L"moveTo",6))->__Field(STRING(L"dy",2)).Cast<int >());
					}
					if (data->__Field(STRING(L"fillStyle0",10)) != null()){
						this->bits->writeBits(style_info->__Field(STRING(L"fillBits",8)).Cast<int >(),data->__Field(STRING(L"fillStyle0",10))->__Field(STRING(L"idx",3)).Cast<int >());
					}
					if (data->__Field(STRING(L"fillStyle1",10)) != null()){
						this->bits->writeBits(style_info->__Field(STRING(L"fillBits",8)).Cast<int >(),data->__Field(STRING(L"fillStyle1",10))->__Field(STRING(L"idx",3)).Cast<int >());
					}
					if (data->__Field(STRING(L"lineStyle",9)) != null()){
						this->bits->writeBits(style_info->__Field(STRING(L"lineBits",8)).Cast<int >(),data->__Field(STRING(L"lineStyle",9))->__Field(STRING(L"idx",3)).Cast<int >());
					}
					if (data->__Field(STRING(L"newStyles",9)) != null()){
						this->writeFillStyles(ver,data->__Field(STRING(L"newStyles",9))->__Field(STRING(L"fillStyles",10)).Cast<Array<format::swf::FillStyle > >());
						this->writeLineStyles(ver,data->__Field(STRING(L"newStyles",9))->__Field(STRING(L"lineStyles",10)).Cast<Array<Dynamic > >());
						hxAddEq(style_info.FieldRef(STRING(L"numFillStyles",13)),data->__Field(STRING(L"newStyles",9))->__Field(STRING(L"fillStyles",10)).Cast<Array<format::swf::FillStyle > >()->length);
						hxAddEq(style_info.FieldRef(STRING(L"numLineStyles",13)),data->__Field(STRING(L"newStyles",9))->__Field(STRING(L"lineStyles",10)).Cast<Array<Dynamic > >()->length);
						struct _Function_1{
							static int Block( Dynamic &style_info)/* DEF (ret block)(not intern) */{
								Dynamic _g = hxClassOf<format::swf::Tools >();
								Array<int > values = Array_obj<int >::__new().Add(style_info->__Field(STRING(L"numFillStyles",13)).Cast<int >());
								int max_bits = 0;
								{
									int _g1 = 0;
									while(_g1 < values->length){
										int x = values->__get(_g1);
										++_g1;
										if (x < 0)
											x = -x;
										hxOrEq(x,(int(x) >> int(1)));
										hxOrEq(x,(int(x) >> int(2)));
										hxOrEq(x,(int(x) >> int(4)));
										hxOrEq(x,(int(x) >> int(8)));
										hxOrEq(x,(int(x) >> int(16)));
										hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
										x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
										x = (int(((int(x) >> int(4)) + x)) & int(252645135));
										hxAddEq(x,(int(x) >> int(8)));
										hxAddEq(x,(int(x) >> int(16)));
										hxAndEq(x,63);
										if (x > max_bits)
											max_bits = x;
									}
								}
								return max_bits;
							}
						};
						style_info.FieldRef(STRING(L"fillBits",8)) = _Function_1::Block(style_info);
						struct _Function_2{
							static int Block( Dynamic &style_info)/* DEF (ret block)(not intern) */{
								Dynamic _g = hxClassOf<format::swf::Tools >();
								Array<int > values = Array_obj<int >::__new().Add(style_info->__Field(STRING(L"numLineStyles",13)).Cast<int >());
								int max_bits = 0;
								{
									int _g1 = 0;
									while(_g1 < values->length){
										int x = values->__get(_g1);
										++_g1;
										if (x < 0)
											x = -x;
										hxOrEq(x,(int(x) >> int(1)));
										hxOrEq(x,(int(x) >> int(2)));
										hxOrEq(x,(int(x) >> int(4)));
										hxOrEq(x,(int(x) >> int(8)));
										hxOrEq(x,(int(x) >> int(16)));
										hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
										x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
										x = (int(((int(x) >> int(4)) + x)) & int(252645135));
										hxAddEq(x,(int(x) >> int(8)));
										hxAddEq(x,(int(x) >> int(16)));
										hxAndEq(x,63);
										if (x > max_bits)
											max_bits = x;
									}
								}
								return max_bits;
							}
						};
						style_info.FieldRef(STRING(L"lineBits",8)) = _Function_2::Block(style_info);
						this->bits->writeBits(4,style_info->__Field(STRING(L"fillBits",8)).Cast<int >());
						this->bits->writeBits(4,style_info->__Field(STRING(L"lineBits",8)).Cast<int >());
					}
				}
			}
			break;
			case 2: {
				int dy = _switch_17->__Param(1);
				int dx = _switch_17->__Param(0);
{
					this->bits->writeBit(true);
					this->bits->writeBit(true);
					struct _Function_1{
						static int Block( int &dx,int &dy)/* DEF (ret block)(not intern) */{
							Dynamic _g = hxClassOf<format::swf::Tools >();
							Array<int > values = Array_obj<int >::__new().Add(dx).Add(dy);
							int max_bits = 0;
							{
								int _g1 = 0;
								while(_g1 < values->length){
									int x = values->__get(_g1);
									++_g1;
									if (x < 0)
										x = -x;
									hxOrEq(x,(int(x) >> int(1)));
									hxOrEq(x,(int(x) >> int(2)));
									hxOrEq(x,(int(x) >> int(4)));
									hxOrEq(x,(int(x) >> int(8)));
									hxOrEq(x,(int(x) >> int(16)));
									hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
									x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
									x = (int(((int(x) >> int(4)) + x)) & int(252645135));
									hxAddEq(x,(int(x) >> int(8)));
									hxAddEq(x,(int(x) >> int(16)));
									hxAndEq(x,63);
									if (x > max_bits)
										max_bits = x;
								}
							}
							return max_bits;
						}
					};
					int mb = _Function_1::Block(dx,dy) + 1;
					mb = mb < 2 ? int( 0 ) : int( mb - 2 );
					this->bits->writeBits(4,mb);
					hxAddEq(mb,2);
					bool is_general = bool((dx != 0)) && bool((dy != 0));
					this->bits->writeBit(is_general);
					if (!is_general){
						bool is_vertical = (dx == 0);
						this->bits->writeBit(is_vertical);
						if (is_vertical)
							this->bits->writeBits(mb,dy);
						else
							this->bits->writeBits(mb,dx);
;
					}
					else{
						this->bits->writeBits(mb,dx);
						this->bits->writeBits(mb,dy);
					}
				}
			}
			break;
			case 3: {
				int ady = _switch_17->__Param(3);
				int adx = _switch_17->__Param(2);
				int cdy = _switch_17->__Param(1);
				int cdx = _switch_17->__Param(0);
{
					this->bits->writeBit(true);
					this->bits->writeBit(false);
					struct _Function_1{
						static int Block( int &cdy,int &adx,int &cdx,int &ady)/* DEF (ret block)(not intern) */{
							Dynamic _g = hxClassOf<format::swf::Tools >();
							Array<int > values = Array_obj<int >::__new().Add(cdx).Add(cdy).Add(adx).Add(ady);
							int max_bits = 0;
							{
								int _g1 = 0;
								while(_g1 < values->length){
									int x = values->__get(_g1);
									++_g1;
									if (x < 0)
										x = -x;
									hxOrEq(x,(int(x) >> int(1)));
									hxOrEq(x,(int(x) >> int(2)));
									hxOrEq(x,(int(x) >> int(4)));
									hxOrEq(x,(int(x) >> int(8)));
									hxOrEq(x,(int(x) >> int(16)));
									hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
									x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
									x = (int(((int(x) >> int(4)) + x)) & int(252645135));
									hxAddEq(x,(int(x) >> int(8)));
									hxAddEq(x,(int(x) >> int(16)));
									hxAndEq(x,63);
									if (x > max_bits)
										max_bits = x;
								}
							}
							return max_bits;
						}
					};
					int mb = _Function_1::Block(cdy,adx,cdx,ady) + 1;
					mb = mb < 2 ? int( 0 ) : int( mb - 2 );
					this->bits->writeBits(4,mb);
					hxAddEq(mb,2);
					this->bits->writeBits(mb,cdx);
					this->bits->writeBits(mb,cdy);
					this->bits->writeBits(mb,adx);
					this->bits->writeBits(mb,ady);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(Writer_obj,writeShapeRecord,(void))

Void Writer_obj::writeShapeWithoutStyle( int ver,Dynamic data){
{
		Dynamic style_info = hxAnon_obj::Create()->Add( STRING(L"numFillStyles",13) , 0)->Add( STRING(L"fillBits",8) , 1)->Add( STRING(L"numLineStyles",13) , 0)->Add( STRING(L"lineBits",8) , 1);
		this->bits->writeBits(4,style_info->__Field(STRING(L"fillBits",8)).Cast<int >());
		this->bits->writeBits(4,style_info->__Field(STRING(L"lineBits",8)).Cast<int >());
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		{
			int _g = 0;
			Array<format::swf::ShapeRecord > _g1 = data->__Field(STRING(L"shapeRecords",12)).Cast<Array<format::swf::ShapeRecord > >();
			while(_g < _g1->length){
				format::swf::ShapeRecord shr = _g1->__get(_g);
				++_g;
				this->writeShapeRecord(ver,style_info,shr);
			}
		}
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeShapeWithoutStyle,(void))

Void Writer_obj::writeShapeWithStyle( int ver,Dynamic data){
{
		this->writeFillStyles(ver,data->__Field(STRING(L"fillStyles",10)).Cast<Array<format::swf::FillStyle > >());
		this->writeLineStyles(ver,data->__Field(STRING(L"lineStyles",10)).Cast<Array<Dynamic > >());
		struct _Function_1{
			static int Block( Dynamic &data)/* DEF (ret block)(not intern) */{
				Dynamic _g = hxClassOf<format::swf::Tools >();
				Array<int > values = Array_obj<int >::__new().Add(data->__Field(STRING(L"fillStyles",10)).Cast<Array<format::swf::FillStyle > >()->length);
				int max_bits = 0;
				{
					int _g1 = 0;
					while(_g1 < values->length){
						int x = values->__get(_g1);
						++_g1;
						if (x < 0)
							x = -x;
						hxOrEq(x,(int(x) >> int(1)));
						hxOrEq(x,(int(x) >> int(2)));
						hxOrEq(x,(int(x) >> int(4)));
						hxOrEq(x,(int(x) >> int(8)));
						hxOrEq(x,(int(x) >> int(16)));
						hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
						x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
						x = (int(((int(x) >> int(4)) + x)) & int(252645135));
						hxAddEq(x,(int(x) >> int(8)));
						hxAddEq(x,(int(x) >> int(16)));
						hxAndEq(x,63);
						if (x > max_bits)
							max_bits = x;
					}
				}
				return max_bits;
			}
		};
		struct _Function_2{
			static int Block( Dynamic &data)/* DEF (ret block)(not intern) */{
				Dynamic _g = hxClassOf<format::swf::Tools >();
				Array<int > values = Array_obj<int >::__new().Add(data->__Field(STRING(L"lineStyles",10)).Cast<Array<Dynamic > >()->length);
				int max_bits = 0;
				{
					int _g1 = 0;
					while(_g1 < values->length){
						int x = values->__get(_g1);
						++_g1;
						if (x < 0)
							x = -x;
						hxOrEq(x,(int(x) >> int(1)));
						hxOrEq(x,(int(x) >> int(2)));
						hxOrEq(x,(int(x) >> int(4)));
						hxOrEq(x,(int(x) >> int(8)));
						hxOrEq(x,(int(x) >> int(16)));
						hxSubEq(x,(int((int(x) >> int(1))) & int(1431655765)));
						x = ((int((int(x) >> int(2))) & int(858993459)) + (int(x) & int(858993459)));
						x = (int(((int(x) >> int(4)) + x)) & int(252645135));
						hxAddEq(x,(int(x) >> int(8)));
						hxAddEq(x,(int(x) >> int(16)));
						hxAndEq(x,63);
						if (x > max_bits)
							max_bits = x;
					}
				}
				return max_bits;
			}
		};
		Dynamic style_info = hxAnon_obj::Create()->Add( STRING(L"numFillStyles",13) , data->__Field(STRING(L"fillStyles",10)).Cast<Array<format::swf::FillStyle > >()->length)->Add( STRING(L"fillBits",8) , _Function_1::Block(data))->Add( STRING(L"numLineStyles",13) , data->__Field(STRING(L"lineStyles",10)).Cast<Array<Dynamic > >()->length)->Add( STRING(L"lineBits",8) , _Function_2::Block(data));
		this->bits->writeBits(4,style_info->__Field(STRING(L"fillBits",8)).Cast<int >());
		this->bits->writeBits(4,style_info->__Field(STRING(L"lineBits",8)).Cast<int >());
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		{
			int _g = 0;
			Array<format::swf::ShapeRecord > _g1 = data->__Field(STRING(L"shapeRecords",12)).Cast<Array<format::swf::ShapeRecord > >();
			while(_g < _g1->length){
				format::swf::ShapeRecord shr = _g1->__get(_g);
				++_g;
				this->writeShapeRecord(ver,style_info,shr);
			}
		}
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeShapeWithStyle,(void))

Void Writer_obj::writeShape( int id,format::swf::ShapeData data){
{
		haxe::io::BytesOutput old = this->openTMP();
		this->o->writeUInt16(id);
		format::swf::ShapeData _switch_18 = (data);
		switch((_switch_18)->GetIndex()){
			case 0: {
				Dynamic shapes = _switch_18->__Param(1);
				Dynamic bounds = _switch_18->__Param(0);
{
					this->writeRect(bounds);
					this->writeShapeWithStyle(1,shapes);
				}
			}
			break;
			case 1: {
				Dynamic shapes = _switch_18->__Param(1);
				Dynamic bounds = _switch_18->__Param(0);
{
					this->writeRect(bounds);
					this->writeShapeWithStyle(2,shapes);
				}
			}
			break;
			case 2: {
				Dynamic shapes = _switch_18->__Param(1);
				Dynamic bounds = _switch_18->__Param(0);
{
					this->writeRect(bounds);
					this->writeShapeWithStyle(3,shapes);
				}
			}
			break;
			case 3: {
				Dynamic data1 = _switch_18->__Param(0);
{
					this->writeRect(data1->__Field(STRING(L"shapeBounds",11)));
					this->writeRect(data1->__Field(STRING(L"edgeBounds",10)));
					this->bits->writeBits(5,0);
					this->bits->writeBit(data1->__Field(STRING(L"useWinding",10)).Cast<bool >());
					this->bits->writeBit(data1->__Field(STRING(L"useNonScalingStroke",19)).Cast<bool >());
					this->bits->writeBit(data1->__Field(STRING(L"useScalingStroke",16)).Cast<bool >());
					{
						format::tools::BitsOutput _g = this->bits;
						if (_g->nbits > 0){
							_g->writeBits(8 - _g->nbits,0);
							_g->nbits = 0;
						}
					}
					this->writeShapeWithStyle(4,data1->__Field(STRING(L"shapes",6)));
				}
			}
			break;
		}
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		haxe::io::Bytes shape_data = this->closeTMP(old);
		format::swf::ShapeData _switch_19 = (data);
		switch((_switch_19)->GetIndex()){
			case 0: {
				Dynamic shapes = _switch_19->__Param(1);
				Dynamic bounds = _switch_19->__Param(0);
{
					this->writeTID(2,shape_data->length);
				}
			}
			break;
			case 1: {
				Dynamic shapes = _switch_19->__Param(1);
				Dynamic bounds = _switch_19->__Param(0);
{
					this->writeTID(22,shape_data->length);
				}
			}
			break;
			case 2: {
				Dynamic shapes = _switch_19->__Param(1);
				Dynamic bounds = _switch_19->__Param(0);
{
					this->writeTID(32,shape_data->length);
				}
			}
			break;
			case 3: {
				Dynamic data1 = _switch_19->__Param(0);
{
					this->writeTID(83,shape_data->length);
				}
			}
			break;
		}
		this->o->write(shape_data);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeShape,(void))

Void Writer_obj::writeMorphGradient( int ver,Dynamic g){
{
		this->o->writeByte(g->__Field(STRING(L"startRatio",10)).Cast<int >());
		this->writeRGBA(g->__Field(STRING(L"startColor",10)));
		this->o->writeByte(g->__Field(STRING(L"endRatio",8)).Cast<int >());
		this->writeRGBA(g->__Field(STRING(L"endColor",8)));
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeMorphGradient,(void))

Void Writer_obj::writeMorphGradients( int ver,Array<Dynamic > gradients){
{
		int num = gradients->length;
		if (bool(num < 1) || bool(num > 8))
			hxThrow (STRING(L"Number of specified morph gradients (",37) + num + STRING(L") must be in range 1..8",23));
		{
			int _g = 0;
			while(_g < gradients->length){
				Dynamic grad = gradients->__get(_g);
				++_g;
				this->writeMorphGradient(ver,grad);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeMorphGradients,(void))

Void Writer_obj::writeMorphFillStyle( int ver,format::swf::MorphFillStyle fill_style){
{
		format::swf::MorphFillStyle _switch_20 = (fill_style);
		switch((_switch_20)->GetIndex()){
			case 0: {
				Dynamic endColor = _switch_20->__Param(1);
				Dynamic startColor = _switch_20->__Param(0);
{
					this->o->writeByte(0);
					this->writeRGBA(startColor);
					this->writeRGBA(endColor);
				}
			}
			break;
			case 1: {
				Array<Dynamic > gradients = _switch_20->__Param(2);
				Dynamic endMatrix = _switch_20->__Param(1);
				Dynamic startMatrix = _switch_20->__Param(0);
{
					this->o->writeByte(16);
					this->writeMatrix(startMatrix);
					this->writeMatrix(endMatrix);
					this->writeMorphGradients(ver,gradients);
				}
			}
			break;
			case 2: {
				Array<Dynamic > gradients = _switch_20->__Param(2);
				Dynamic endMatrix = _switch_20->__Param(1);
				Dynamic startMatrix = _switch_20->__Param(0);
{
					this->o->writeByte(16);
					this->writeMatrix(startMatrix);
					this->writeMatrix(endMatrix);
					this->writeMorphGradients(ver,gradients);
				}
			}
			break;
			case 3: {
				bool smooth = _switch_20->__Param(4);
				bool repeat = _switch_20->__Param(3);
				Dynamic endMatrix = _switch_20->__Param(2);
				Dynamic startMatrix = _switch_20->__Param(1);
				int cid = _switch_20->__Param(0);
{
					struct _Function_1{
						static int Block( bool &smooth)/* DEF (ret block)(not intern) */{
							return smooth ? int( 64 ) : int( 66 );
						}
					};
					struct _Function_2{
						static int Block( bool &smooth)/* DEF (ret block)(not intern) */{
							return smooth ? int( 65 ) : int( 67 );
						}
					};
					this->o->writeByte(repeat ? int( _Function_1::Block(smooth) ) : int( _Function_2::Block(smooth) ));
					this->o->writeUInt16(cid);
					this->writeMatrix(startMatrix);
					this->writeMatrix(endMatrix);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeMorphFillStyle,(void))

Void Writer_obj::writeMorphFillStyles( int ver,Array<format::swf::MorphFillStyle > fill_styles){
{
		int num_styles = fill_styles->length;
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		if (num_styles > 254){
			this->o->writeByte(255);
			this->o->writeUInt16(num_styles);
		}
		else
			this->o->writeByte(num_styles);
;
		{
			int _g = 0;
			while(_g < fill_styles->length){
				format::swf::MorphFillStyle style = fill_styles->__get(_g);
				++_g;
				this->writeMorphFillStyle(ver,style);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeMorphFillStyles,(void))

Void Writer_obj::writeMorph1LineStyle( Dynamic s){
{
		this->o->writeUInt16(s->__Field(STRING(L"startWidth",10)).Cast<int >());
		this->o->writeUInt16(s->__Field(STRING(L"endWidth",8)).Cast<int >());
		this->writeRGBA(s->__Field(STRING(L"startColor",10)));
		this->writeRGBA(s->__Field(STRING(L"endColor",8)));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeMorph1LineStyle,(void))

Void Writer_obj::writeMorph1LineStyles( Array<Dynamic > line_styles){
{
		int num_styles = line_styles->length;
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		if (num_styles > 254){
			this->o->writeByte(255);
			this->o->writeUInt16(num_styles);
		}
		else
			this->o->writeByte(num_styles);
;
		{
			int _g = 0;
			while(_g < line_styles->length){
				Dynamic style = line_styles->__get(_g);
				++_g;
				this->writeMorph1LineStyle(style);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeMorph1LineStyles,(void))

Void Writer_obj::writeMorph2LineStyle( format::swf::Morph2LineStyle style){
{
		Dynamic m2data;
		format::swf::Morph2LineStyle _switch_21 = (style);
		switch((_switch_21)->GetIndex()){
			case 0: {
				Dynamic data = _switch_21->__Param(2);
				Dynamic endColor = _switch_21->__Param(1);
				Dynamic startColor = _switch_21->__Param(0);
{
					m2data = data;
				}
			}
			break;
			case 1: {
				Dynamic data = _switch_21->__Param(1);
				format::swf::MorphFillStyle fill = _switch_21->__Param(0);
{
					m2data = data;
				}
			}
			break;
		}
		this->o->writeUInt16(m2data->__Field(STRING(L"startWidth",10)).Cast<int >());
		this->o->writeUInt16(m2data->__Field(STRING(L"endWidth",8)).Cast<int >());
		struct _Function_1{
			static int Block( Dynamic &m2data)/* DEF (not block)(ret intern) */{
				format::swf::LineCapStyle _switch_22 = (m2data->__Field(STRING(L"startCapStyle",13)).Cast<format::swf::LineCapStyle >());
				switch((_switch_22)->GetIndex()){
					case 0: {
						return 0;
					}
					break;
					case 1: {
						return 1;
					}
					break;
					case 2: {
						return 2;
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		this->bits->writeBits(2,_Function_1::Block(m2data));
		struct _Function_2{
			static int Block( Dynamic &m2data)/* DEF (not block)(ret intern) */{
				format::swf::LineJoinStyle _switch_23 = (m2data->__Field(STRING(L"joinStyle",9)).Cast<format::swf::LineJoinStyle >());
				switch((_switch_23)->GetIndex()){
					case 0: {
						return 0;
					}
					break;
					case 1: {
						return 1;
					}
					break;
					case 2: {
						int limitFactor = _switch_23->__Param(0);
{
							return 2;
						}
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		this->bits->writeBits(2,_Function_2::Block(m2data));
		format::swf::Morph2LineStyle _switch_24 = (style);
		switch((_switch_24)->GetIndex()){
			case 0: {
				Dynamic data = _switch_24->__Param(2);
				Dynamic endColor = _switch_24->__Param(1);
				Dynamic startColor = _switch_24->__Param(0);
{
					this->bits->writeBit(false);
				}
			}
			break;
			case 1: {
				Dynamic data = _switch_24->__Param(1);
				format::swf::MorphFillStyle fill = _switch_24->__Param(0);
{
					this->bits->writeBit(true);
				}
			}
			break;
		}
		this->bits->writeBit(m2data->__Field(STRING(L"noHScale",8)).Cast<bool >());
		this->bits->writeBit(m2data->__Field(STRING(L"noVScale",8)).Cast<bool >());
		this->bits->writeBit(m2data->__Field(STRING(L"pixelHinting",12)).Cast<bool >());
		this->bits->writeBits(5,0);
		this->bits->writeBit(m2data->__Field(STRING(L"noClose",7)).Cast<bool >());
		struct _Function_3{
			static int Block( Dynamic &m2data)/* DEF (not block)(ret intern) */{
				format::swf::LineCapStyle _switch_25 = (m2data->__Field(STRING(L"endCapStyle",11)).Cast<format::swf::LineCapStyle >());
				switch((_switch_25)->GetIndex()){
					case 0: {
						return 0;
					}
					break;
					case 1: {
						return 1;
					}
					break;
					case 2: {
						return 2;
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		this->bits->writeBits(2,_Function_3::Block(m2data));
		format::swf::LineJoinStyle _switch_26 = (m2data->__Field(STRING(L"joinStyle",9)).Cast<format::swf::LineJoinStyle >());
		switch((_switch_26)->GetIndex()){
			case 2: {
				int limitFactor = _switch_26->__Param(0);
{
					this->o->writeUInt16(limitFactor);
				}
			}
			break;
			default: {
			}
		}
		format::swf::Morph2LineStyle _switch_27 = (style);
		switch((_switch_27)->GetIndex()){
			case 0: {
				Dynamic data = _switch_27->__Param(2);
				Dynamic endColor = _switch_27->__Param(1);
				Dynamic startColor = _switch_27->__Param(0);
{
					this->writeRGBA(startColor);
					this->writeRGBA(endColor);
				}
			}
			break;
			case 1: {
				Dynamic data = _switch_27->__Param(1);
				format::swf::MorphFillStyle fill = _switch_27->__Param(0);
{
					this->writeMorphFillStyle(2,fill);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeMorph2LineStyle,(void))

Void Writer_obj::writeMorph2LineStyles( Array<format::swf::Morph2LineStyle > line_styles){
{
		int num_styles = line_styles->length;
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		if (num_styles > 254){
			this->o->writeByte(255);
			this->o->writeUInt16(num_styles);
		}
		else
			this->o->writeByte(num_styles);
;
		{
			int _g = 0;
			while(_g < line_styles->length){
				format::swf::Morph2LineStyle style = line_styles->__get(_g);
				++_g;
				this->writeMorph2LineStyle(style);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeMorph2LineStyles,(void))

Void Writer_obj::writeMorphShape( int id,format::swf::MorphShapeData data){
{
		haxe::io::BytesOutput old = this->openTMP();
		this->o->writeUInt16(id);
		format::swf::MorphShapeData _switch_28 = (data);
		switch((_switch_28)->GetIndex()){
			case 0: {
				Dynamic sh1data = _switch_28->__Param(0);
{
					this->writeRect(sh1data->__Field(STRING(L"startBounds",11)));
					this->writeRect(sh1data->__Field(STRING(L"endBounds",9)));
					haxe::io::BytesOutput old1 = this->openTMP();
					this->writeMorphFillStyles(1,sh1data->__Field(STRING(L"fillStyles",10)).Cast<Array<format::swf::MorphFillStyle > >());
					this->writeMorph1LineStyles(sh1data->__Field(STRING(L"lineStyles",10)).Cast<Array<Dynamic > >());
					this->writeShapeWithoutStyle(3,sh1data->__Field(STRING(L"startEdges",10)));
					{
						format::tools::BitsOutput _g = this->bits;
						if (_g->nbits > 0){
							_g->writeBits(8 - _g->nbits,0);
							_g->nbits = 0;
						}
					}
					haxe::io::Bytes part_data = this->closeTMP(old1);
					this->o->writeUInt30(part_data->length);
					this->o->write(part_data);
					this->writeShapeWithoutStyle(3,sh1data->__Field(STRING(L"endEdges",8)));
				}
			}
			break;
			case 1: {
				Dynamic sh2data = _switch_28->__Param(0);
{
					this->writeRect(sh2data->__Field(STRING(L"startBounds",11)));
					this->writeRect(sh2data->__Field(STRING(L"endBounds",9)));
					this->writeRect(sh2data->__Field(STRING(L"startEdgeBounds",15)));
					this->writeRect(sh2data->__Field(STRING(L"endEdgeBounds",13)));
					this->bits->writeBits(6,0);
					this->bits->writeBit(sh2data->__Field(STRING(L"useNonScalingStrokes",20)).Cast<bool >());
					this->bits->writeBit(sh2data->__Field(STRING(L"useScalingStrokes",17)).Cast<bool >());
					{
						format::tools::BitsOutput _g = this->bits;
						if (_g->nbits > 0){
							_g->writeBits(8 - _g->nbits,0);
							_g->nbits = 0;
						}
					}
					haxe::io::BytesOutput old1 = this->openTMP();
					this->writeMorphFillStyles(1,sh2data->__Field(STRING(L"fillStyles",10)).Cast<Array<format::swf::MorphFillStyle > >());
					this->writeMorph2LineStyles(sh2data->__Field(STRING(L"lineStyles",10)).Cast<Array<format::swf::Morph2LineStyle > >());
					this->writeShapeWithoutStyle(4,sh2data->__Field(STRING(L"startEdges",10)));
					{
						format::tools::BitsOutput _g = this->bits;
						if (_g->nbits > 0){
							_g->writeBits(8 - _g->nbits,0);
							_g->nbits = 0;
						}
					}
					haxe::io::Bytes part_data = this->closeTMP(old1);
					this->o->writeUInt30(part_data->length);
					this->o->write(part_data);
					this->writeShapeWithoutStyle(4,sh2data->__Field(STRING(L"endEdges",8)));
				}
			}
			break;
		}
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		haxe::io::Bytes morph_shape_data = this->closeTMP(old);
		format::swf::MorphShapeData _switch_29 = (data);
		switch((_switch_29)->GetIndex()){
			case 0: {
				Dynamic sh1data = _switch_29->__Param(0);
{
					this->writeTID(46,morph_shape_data->length);
				}
			}
			break;
			case 1: {
				Dynamic sh2data = _switch_29->__Param(0);
{
					this->writeTID(84,morph_shape_data->length);
				}
			}
			break;
		}
		this->o->write(morph_shape_data);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeMorphShape,(void))

Array<int > Writer_obj::writeFontGlyphs( Array<Dynamic > glyphs){
	haxe::io::BytesOutput old = this->openTMP();
	Array<int > offsets = Array_obj<int >::__new();
	int offs = 0;
	{
		int _g = 0;
		while(_g < glyphs->length){
			Dynamic shape = glyphs->__get(_g);
			++_g;
			offsets->push(offs);
			haxe::io::BytesOutput old1 = this->openTMP();
			this->writeShapeWithoutStyle(1,shape);
			{
				format::tools::BitsOutput _g1 = this->bits;
				if (_g1->nbits > 0){
					_g1->writeBits(8 - _g1->nbits,0);
					_g1->nbits = 0;
				}
			}
			haxe::io::Bytes shape_data = this->closeTMP(old1);
			this->o->write(shape_data);
			hxAddEq(offs,shape_data->length);
		}
	}
	haxe::io::Bytes glyph_data = this->closeTMP(old);
	this->o->write(glyph_data);
	return offsets;
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFontGlyphs,return )

Void Writer_obj::writeFont1( Dynamic data){
{
		haxe::io::BytesOutput old = this->openTMP();
		Array<int > offset_table = this->writeFontGlyphs(data->__Field(STRING(L"glyphs",6)).Cast<Array<Dynamic > >());
		if (offset_table->length * 2 + offset_table->__get(offset_table->length - 1) > 65535)
			hxThrow (STRING(L"Font version 1 only supports font sizes up to 64kB!",51));
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		haxe::io::Bytes shape_data = this->closeTMP(old);
		int first_glyph_offset = offset_table->length * 2;
		{
			int _g = 0;
			while(_g < offset_table->length){
				int offset = offset_table->__get(_g);
				++_g;
				this->o->writeUInt16(first_glyph_offset + offset);
			}
		}
		this->o->write(shape_data);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFont1,(void))

Void Writer_obj::writeFont2( bool hasWideChars,Dynamic data){
{
		Array<Dynamic > glyphs = Array_obj<Dynamic >::__new();
		int num_glyphs = data->__Field(STRING(L"glyphs",6)).Cast<Array<Dynamic > >()->length;
		{
			int _g = 0;
			Array<Dynamic > _g1 = data->__Field(STRING(L"glyphs",6)).Cast<Array<Dynamic > >();
			while(_g < _g1->length){
				Dynamic glyph = _g1->__get(_g);
				++_g;
				glyphs->push(glyph->__Field(STRING(L"shape",5)));
			}
		}
		haxe::io::BytesOutput old = this->openTMP();
		Array<int > offset_table = this->writeFontGlyphs(glyphs);
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		haxe::io::Bytes shape_data = this->closeTMP(old);
		bool hasWideOffsets = offset_table->length * 2 + 2 + shape_data->length > 65535;
		this->bits->writeBit(data->__Field(STRING(L"layout",6)) != null());
		this->bits->writeBit(data->__Field(STRING(L"shiftJIS",8)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"isSmall",7)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"isANSI",6)).Cast<bool >());
		this->bits->writeBit(hasWideOffsets);
		this->bits->writeBit(hasWideChars);
		this->bits->writeBit(data->__Field(STRING(L"isItalic",8)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"isBold",6)).Cast<bool >());
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		struct _Function_1{
			static int Block( Dynamic &data)/* DEF (not block)(ret intern) */{
				format::swf::LangCode _switch_30 = (data->__Field(STRING(L"language",8)).Cast<format::swf::LangCode >());
				switch((_switch_30)->GetIndex()){
					case 0: {
						return 0;
					}
					break;
					case 1: {
						return 1;
					}
					break;
					case 2: {
						return 2;
					}
					break;
					case 3: {
						return 3;
					}
					break;
					case 4: {
						return 4;
					}
					break;
					case 5: {
						return 5;
					}
					break;
					default: {
						return null();
					}
				}
			}
		};
		this->o->writeByte(_Function_1::Block(data));
		this->o->writeByte(data->__Field(STRING(L"name",4)).Cast<String >().length);
		this->o->writeString(data->__Field(STRING(L"name",4)).Cast<String >());
		this->o->writeUInt16(num_glyphs);
		if (hasWideOffsets){
			int first_glyph_offset = num_glyphs * 4 + 4;
			{
				int _g = 0;
				while(_g < offset_table->length){
					int offset = offset_table->__get(_g);
					++_g;
					this->o->writeUInt30(first_glyph_offset + offset);
				}
			}
			this->o->writeUInt30(first_glyph_offset + shape_data->length);
		}
		else{
			int first_glyph_offset = num_glyphs * 2 + 2;
			{
				int _g = 0;
				while(_g < offset_table->length){
					int offset = offset_table->__get(_g);
					++_g;
					this->o->writeUInt16(first_glyph_offset + offset);
				}
			}
			this->o->writeUInt16(first_glyph_offset + shape_data->length);
		}
		this->o->write(shape_data);
		if (hasWideChars){
			{
				int _g = 0;
				Array<Dynamic > _g1 = data->__Field(STRING(L"glyphs",6)).Cast<Array<Dynamic > >();
				while(_g < _g1->length){
					Dynamic glyph = _g1->__get(_g);
					++_g;
					this->o->writeUInt16(glyph->__Field(STRING(L"charCode",8)).Cast<int >());
				}
			}
		}
		else{
			{
				int _g = 0;
				Array<Dynamic > _g1 = data->__Field(STRING(L"glyphs",6)).Cast<Array<Dynamic > >();
				while(_g < _g1->length){
					Dynamic glyph = _g1->__get(_g);
					++_g;
					this->o->writeByte(glyph->__Field(STRING(L"charCode",8)).Cast<int >());
				}
			}
		}
		if (data->__Field(STRING(L"layout",6)) != null()){
			this->o->writeInt16(data->__Field(STRING(L"layout",6))->__Field(STRING(L"ascent",6)).Cast<int >());
			this->o->writeInt16(data->__Field(STRING(L"layout",6))->__Field(STRING(L"descent",7)).Cast<int >());
			this->o->writeInt16(data->__Field(STRING(L"layout",6))->__Field(STRING(L"leading",7)).Cast<int >());
			{
				int _g = 0;
				Array<Dynamic > _g1 = data->__Field(STRING(L"layout",6))->__Field(STRING(L"glyphs",6)).Cast<Array<Dynamic > >();
				while(_g < _g1->length){
					Dynamic g = _g1->__get(_g);
					++_g;
					this->o->writeInt16(g->__Field(STRING(L"advance",7)).Cast<int >());
				}
			}
			{
				int _g = 0;
				Array<Dynamic > _g1 = data->__Field(STRING(L"layout",6))->__Field(STRING(L"glyphs",6)).Cast<Array<Dynamic > >();
				while(_g < _g1->length){
					Dynamic g = _g1->__get(_g);
					++_g;
					this->writeRect(g->__Field(STRING(L"bounds",6)));
				}
			}
			this->o->writeUInt16(data->__Field(STRING(L"layout",6))->__Field(STRING(L"kerning",7)).Cast<Array<Dynamic > >()->length);
			if (hasWideChars){
				{
					int _g = 0;
					Array<Dynamic > _g1 = data->__Field(STRING(L"layout",6))->__Field(STRING(L"kerning",7)).Cast<Array<Dynamic > >();
					while(_g < _g1->length){
						Dynamic k = _g1->__get(_g);
						++_g;
						this->o->writeUInt16(k->__Field(STRING(L"charCode1",9)).Cast<int >());
						this->o->writeUInt16(k->__Field(STRING(L"charCode2",9)).Cast<int >());
						this->o->writeInt16(k->__Field(STRING(L"adjust",6)).Cast<int >());
					}
				}
			}
			else{
				{
					int _g = 0;
					Array<Dynamic > _g1 = data->__Field(STRING(L"layout",6))->__Field(STRING(L"kerning",7)).Cast<Array<Dynamic > >();
					while(_g < _g1->length){
						Dynamic k = _g1->__get(_g);
						++_g;
						this->o->writeByte(k->__Field(STRING(L"charCode1",9)).Cast<int >());
						this->o->writeByte(k->__Field(STRING(L"charCode2",9)).Cast<int >());
						this->o->writeInt16(k->__Field(STRING(L"adjust",6)).Cast<int >());
					}
				}
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeFont2,(void))

Void Writer_obj::writeFont( int id,format::swf::FontData data){
{
		haxe::io::BytesOutput old = this->openTMP();
		this->o->writeUInt16(id);
		format::swf::FontData _switch_31 = (data);
		switch((_switch_31)->GetIndex()){
			case 0: {
				Dynamic data1 = _switch_31->__Param(0);
{
					this->writeFont1(data1);
				}
			}
			break;
			case 1: {
				Dynamic data1 = _switch_31->__Param(1);
				bool hasWideChars = _switch_31->__Param(0);
{
					this->writeFont2(hasWideChars,data1);
				}
			}
			break;
			case 2: {
				Dynamic data1 = _switch_31->__Param(0);
{
					this->writeFont2(true,data1);
				}
			}
			break;
		}
		{
			format::tools::BitsOutput _g = this->bits;
			if (_g->nbits > 0){
				_g->writeBits(8 - _g->nbits,0);
				_g->nbits = 0;
			}
		}
		haxe::io::Bytes font_data = this->closeTMP(old);
		format::swf::FontData _switch_32 = (data);
		switch((_switch_32)->GetIndex()){
			case 0: {
				Dynamic data1 = _switch_32->__Param(0);
{
					this->writeTID(10,font_data->length);
				}
			}
			break;
			case 1: {
				Dynamic data1 = _switch_32->__Param(1);
				bool hasWideChars = _switch_32->__Param(0);
{
					this->writeTID(48,font_data->length);
				}
			}
			break;
			case 2: {
				Dynamic data1 = _switch_32->__Param(0);
{
					this->writeTID(75,font_data->length);
				}
			}
			break;
		}
		this->o->write(font_data);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeFont,(void))

Void Writer_obj::writeFontInfo( int id,format::swf::FontInfoData data){
{
		format::swf::FontInfoData _switch_33 = (data);
		switch((_switch_33)->GetIndex()){
			case 0: {
				Dynamic data1 = _switch_33->__Param(3);
				bool hasWideCodes = _switch_33->__Param(2);
				bool isANSI = _switch_33->__Param(1);
				bool shiftJIS = _switch_33->__Param(0);
{
					int data_length = hasWideCodes ? int( 4 + data1->__Field(STRING(L"name",4)).Cast<String >().length + data1->__Field(STRING(L"codeTable",9)).Cast<Array<int > >()->length * 2 ) : int( 4 + data1->__Field(STRING(L"name",4)).Cast<String >().length + data1->__Field(STRING(L"codeTable",9)).Cast<Array<int > >()->length );
					this->writeTID(13,data_length);
					this->o->writeUInt16(id);
					this->o->writeByte(data1->__Field(STRING(L"name",4)).Cast<String >().length);
					this->o->writeString(data1->__Field(STRING(L"name",4)).Cast<String >());
					this->bits->writeBits(2,0);
					this->bits->writeBit(data1->__Field(STRING(L"isSmall",7)).Cast<bool >());
					this->bits->writeBit(shiftJIS);
					this->bits->writeBit(isANSI);
					this->bits->writeBit(data1->__Field(STRING(L"isItalic",8)).Cast<bool >());
					this->bits->writeBit(data1->__Field(STRING(L"isBold",6)).Cast<bool >());
					this->bits->writeBit(hasWideCodes);
					if (hasWideCodes){
						{
							int _g = 0;
							Array<int > _g1 = data1->__Field(STRING(L"codeTable",9)).Cast<Array<int > >();
							while(_g < _g1->length){
								int code = _g1->__get(_g);
								++_g;
								this->o->writeUInt16(code);
							}
						}
					}
					else{
						{
							int _g = 0;
							Array<int > _g1 = data1->__Field(STRING(L"codeTable",9)).Cast<Array<int > >();
							while(_g < _g1->length){
								int code = _g1->__get(_g);
								++_g;
								this->o->writeByte(code);
							}
						}
					}
				}
			}
			break;
			case 1: {
				Dynamic data1 = _switch_33->__Param(1);
				format::swf::LangCode language = _switch_33->__Param(0);
{
					this->writeTID(13,5 + data1->__Field(STRING(L"name",4)).Cast<String >().length + data1->__Field(STRING(L"codeTable",9)).Cast<Array<int > >()->length * 2);
					this->o->writeUInt16(id);
					this->o->writeByte(data1->__Field(STRING(L"name",4)).Cast<String >().length);
					this->o->writeString(data1->__Field(STRING(L"name",4)).Cast<String >());
					this->bits->writeBits(2,0);
					this->bits->writeBit(data1->__Field(STRING(L"isSmall",7)).Cast<bool >());
					this->bits->writeBit(false);
					this->bits->writeBit(false);
					this->bits->writeBit(data1->__Field(STRING(L"isItalic",8)).Cast<bool >());
					this->bits->writeBit(data1->__Field(STRING(L"isBold",6)).Cast<bool >());
					this->bits->writeBit(true);
					struct _Function_1{
						static int Block( format::swf::LangCode &language)/* DEF (not block)(ret intern) */{
							format::swf::LangCode _switch_34 = (language);
							switch((_switch_34)->GetIndex()){
								case 0: {
									return 0;
								}
								break;
								case 1: {
									return 1;
								}
								break;
								case 2: {
									return 2;
								}
								break;
								case 3: {
									return 3;
								}
								break;
								case 4: {
									return 4;
								}
								break;
								case 5: {
									return 5;
								}
								break;
								default: {
									return null();
								}
							}
						}
					};
					this->o->writeByte(_Function_1::Block(language));
					{
						int _g = 0;
						Array<int > _g1 = data1->__Field(STRING(L"codeTable",9)).Cast<Array<int > >();
						while(_g < _g1->length){
							int code = _g1->__get(_g);
							++_g;
							this->o->writeUInt16(code);
						}
					}
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Writer_obj,writeFontInfo,(void))

Void Writer_obj::writeSoundInfo( Dynamic info){
{
		this->bits->writeBits(2,0);
		this->bits->writeBit(info->__Field(STRING(L"syncStop",8)).Cast<bool >());
		this->bits->writeBit(false);
		this->bits->writeBit(false);
		this->bits->writeBit(info->__Field(STRING(L"hasLoops",8)).Cast<bool >());
		this->bits->writeBit(false);
		this->bits->writeBit(false);
		if (info->__Field(STRING(L"hasLoops",8)).Cast<bool >())
			this->o->writeUInt16(info->__Field(STRING(L"loopCount",9)));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeSoundInfo,(void))

Void Writer_obj::writeEnvelopeRecords( Array<Dynamic > soundEnvelopes){
{
		{
			int _g1 = 0;
			int _g = soundEnvelopes->length;
			while(_g1 < _g){
				int env = _g1++;
				this->o->writeUInt30(soundEnvelopes[env]->__Field(STRING(L"pos44",5)).Cast<int >());
				this->o->writeUInt16(soundEnvelopes[env]->__Field(STRING(L"leftLevel",9)).Cast<int >());
				this->o->writeUInt16(soundEnvelopes[env]->__Field(STRING(L"rightLevel",10)).Cast<int >());
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeEnvelopeRecords,(void))

Void Writer_obj::writeFileAttributes( Dynamic att){
{
		this->bits->writeBit(false);
		this->bits->writeBit(att->__Field(STRING(L"useDirectBlit",13)).Cast<bool >());
		this->bits->writeBit(att->__Field(STRING(L"useGPU",6)).Cast<bool >());
		this->bits->writeBit(att->__Field(STRING(L"hasMetaData",11)).Cast<bool >());
		this->bits->writeBit(att->__Field(STRING(L"actionscript3",13)).Cast<bool >());
		this->bits->writeBits(2,0);
		this->bits->writeBit(att->__Field(STRING(L"useNetWork",10)).Cast<bool >());
		this->bits->writeBits(24,0);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeFileAttributes,(void))

Void Writer_obj::writeButtonRecord( Dynamic btnRec){
{
		this->bits->writeBits(4,0);
		this->bits->writeBit(btnRec->__Field(STRING(L"hit",3)).Cast<bool >());
		this->bits->writeBit(btnRec->__Field(STRING(L"down",4)).Cast<bool >());
		this->bits->writeBit(btnRec->__Field(STRING(L"over",4)).Cast<bool >());
		this->bits->writeBit(btnRec->__Field(STRING(L"up",2)).Cast<bool >());
		this->o->writeUInt16(btnRec->__Field(STRING(L"id",2)).Cast<int >());
		this->o->writeUInt16(btnRec->__Field(STRING(L"depth",5)).Cast<int >());
		this->writeMatrix(btnRec->__Field(STRING(L"matrix",6)));
		this->o->writeByte(0);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeButtonRecord,(void))

Void Writer_obj::writeDefineEditText( Dynamic data){
{
		this->writeRect(data->__Field(STRING(L"bounds",6)));
		this->bits->writeBit(data->__Field(STRING(L"hasText",7)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"wordWrap",8)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"multiline",9)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"password",8)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"input",5)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"hasTextColor",12)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"hasMaxLength",12)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"hasFont",7)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"hasFontClass",12)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"autoSize",8)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"hasLayout",9)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"selectable",10)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"border",6)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"wasStatic",9)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"html",4)).Cast<bool >());
		this->bits->writeBit(data->__Field(STRING(L"useOutlines",11)).Cast<bool >());
		if (data->__Field(STRING(L"hasFont",7)).Cast<bool >())
			this->o->writeUInt16(data->__Field(STRING(L"fontID",6)).Cast<int >());
		if (data->__Field(STRING(L"hasFontClass",12)).Cast<bool >())
			this->o->writeString(data->__Field(STRING(L"fontClass",9)).Cast<String >());
		this->o->writeUInt16(data->__Field(STRING(L"fontHeight",10)).Cast<int >());
		if (data->__Field(STRING(L"hasTextColor",12)).Cast<bool >())
			this->writeRGBA(data->__Field(STRING(L"textColor",9)));
		if (data->__Field(STRING(L"hasMaxLength",12)).Cast<bool >())
			this->o->writeUInt16(data->__Field(STRING(L"maxLength",9)).Cast<int >());
		if (data->__Field(STRING(L"hasLayout",9)).Cast<bool >()){
			this->o->writeByte(data->__Field(STRING(L"align",5)).Cast<int >());
			this->o->writeUInt16(data->__Field(STRING(L"leftMargin",10)).Cast<int >());
			this->o->writeUInt16(data->__Field(STRING(L"rightMargin",11)).Cast<int >());
			this->o->writeUInt16(data->__Field(STRING(L"indent",6)).Cast<int >());
			this->o->writeInt16(data->__Field(STRING(L"leading",7)).Cast<int >());
		}
		this->o->writeString(data->__Field(STRING(L"variableName",12)).Cast<String >());
		this->o->writeByte(0);
		if (data->__Field(STRING(L"hasText",7)).Cast<bool >())
			this->o->writeString(data->__Field(STRING(L"initialText",11)).Cast<String >());
		this->o->writeByte(0);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeDefineEditText,(void))

Void Writer_obj::writeTag( format::swf::SWFTag t){
{
		format::swf::SWFTag _switch_35 = (t);
		switch((_switch_35)->GetIndex()){
			case 30: {
				haxe::io::Bytes data = _switch_35->__Param(1);
				Dynamic id = _switch_35->__Param(0);
{
					if (id == null()){
						this->o->write(data);
					}
					else{
						this->writeTID(id,data->length);
						this->o->write(data);
					}
				}
			}
			break;
			case 0: {
				this->writeTID(1,0);
			}
			break;
			case 1: {
				this->writeTID(0,0);
			}
			break;
			case 2: {
				format::swf::ShapeData sdata = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					this->writeShape(id,sdata);
				}
			}
			break;
			case 3: {
				format::swf::MorphShapeData data = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					this->writeMorphShape(id,data);
				}
			}
			break;
			case 4: {
				format::swf::FontData data = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					this->writeFont(id,data);
				}
			}
			break;
			case 5: {
				format::swf::FontInfoData data = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					this->writeFontInfo(id,data);
				}
			}
			break;
			case 21: {
				haxe::io::Bytes data = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					this->writeTID(87,data->length + 6);
					this->o->writeUInt16(id);
					this->o->writeUInt30(0);
					this->o->write(data);
				}
			}
			break;
			case 6: {
				int color = _switch_35->__Param(0);
{
					this->writeTID(9,3);
					this->o->setEndian(true);
					this->o->writeUInt24(color);
					this->o->setEndian(false);
				}
			}
			break;
			case 8: {
				format::swf::PlaceObject po = _switch_35->__Param(0);
{
					haxe::io::BytesOutput t1 = this->openTMP();
					this->writePlaceObject(po,false);
					haxe::io::Bytes bytes = this->closeTMP(t1);
					this->writeTID(26,bytes->length);
					this->o->write(bytes);
				}
			}
			break;
			case 9: {
				format::swf::PlaceObject po = _switch_35->__Param(0);
{
					haxe::io::BytesOutput t1 = this->openTMP();
					this->writePlaceObject(po,true);
					haxe::io::Bytes bytes = this->closeTMP(t1);
					this->writeTID(70,bytes->length);
					this->o->write(bytes);
				}
			}
			break;
			case 10: {
				int depth = _switch_35->__Param(0);
{
					this->writeTID(28,2);
					this->o->writeUInt16(depth);
				}
			}
			break;
			case 11: {
				bool anchor = _switch_35->__Param(1);
				String label = _switch_35->__Param(0);
{
					int length = label.length + 1 + (anchor ? int( 1 ) : int( 0 ));
					this->writeTIDExt(43,length);
					this->o->writeString(label);
					this->o->writeByte(0);
					if (anchor)
						this->o->writeByte(1);
				}
			}
			break;
			case 7: {
				Array<format::swf::SWFTag > tags = _switch_35->__Param(2);
				int frames = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					haxe::io::BytesOutput t1 = this->openTMP();
					{
						int _g = 0;
						while(_g < tags->length){
							format::swf::SWFTag t2 = tags->__get(_g);
							++_g;
							this->writeTag(t2);
						}
					}
					haxe::io::Bytes bytes = this->closeTMP(t1);
					this->writeTIDExt(39,bytes->length + 6);
					this->o->writeUInt16(id);
					this->o->writeUInt16(frames);
					this->o->write(bytes);
					this->o->writeUInt16(0);
				}
			}
			break;
			case 12: {
				haxe::io::Bytes data = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					this->writeTID(59,data->length + 2);
					this->o->writeUInt16(id);
					this->o->write(data);
				}
			}
			break;
			case 13: {
				Dynamic ctx = _switch_35->__Param(1);
				haxe::io::Bytes data = _switch_35->__Param(0);
{
					if (ctx == null())
						this->writeTID(72,data->length);
					else{
						int len = data->length + 4 + ctx->__Field(STRING(L"label",5)).Cast<String >().length + 1;
						this->writeTID(82,len);
						this->o->writeUInt30(ctx->__Field(STRING(L"id",2)).Cast<int >());
						this->o->writeString(ctx->__Field(STRING(L"label",5)).Cast<String >());
						this->o->writeByte(0);
					}
					this->o->write(data);
				}
			}
			break;
			case 14: {
				Array<Dynamic > sl = _switch_35->__Param(0);
{
					this->writeSymbols(sl,76);
				}
			}
			break;
			case 15: {
				Array<Dynamic > sl = _switch_35->__Param(0);
{
					this->writeSymbols(sl,56);
				}
			}
			break;
			case 16: {
				Dynamic v = _switch_35->__Param(0);
{
					this->writeTID(69,4);
					this->writeFileAttributes(v);
				}
			}
			break;
			case 17: {
				Dynamic l = _switch_35->__Param(0);
{
					struct _Function_1{
						static Dynamic Block( Dynamic &l)/* DEF (not block)(ret intern) */{
							format::swf::ColorModel _switch_36 = (l->__Field(STRING(L"color",5)).Cast<format::swf::ColorModel >());
							switch((_switch_36)->GetIndex()){
								case 0: {
									int n = _switch_36->__Param(0);
{
										return n;
									}
								}
								break;
								default: {
									return null();
								}
							}
						}
					};
					Dynamic cbits = _Function_1::Block(l);
					this->writeTIDExt(20,l->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >()->length + ((cbits == null()) ? int( 8 ) : int( 7 )));
					this->o->writeUInt16(l->__Field(STRING(L"cid",3)).Cast<int >());
					format::swf::ColorModel _switch_37 = (l->__Field(STRING(L"color",5)).Cast<format::swf::ColorModel >());
					switch((_switch_37)->GetIndex()){
						case 0: {
{
								this->o->writeByte(3);
							}
						}
						break;
						case 1: {
							this->o->writeByte(4);
						}
						break;
						case 2: {
							this->o->writeByte(5);
						}
						break;
						default: {
							hxThrow (STRING(L"assert",6));
						}
					}
					this->o->writeUInt16(l->__Field(STRING(L"width",5)).Cast<int >());
					this->o->writeUInt16(l->__Field(STRING(L"height",6)).Cast<int >());
					if (cbits != null())
						this->o->writeByte(cbits);
					this->o->write(l->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >());
				}
			}
			break;
			case 18: {
				Dynamic l = _switch_35->__Param(0);
{
					struct _Function_1{
						static Dynamic Block( Dynamic &l)/* DEF (not block)(ret intern) */{
							format::swf::ColorModel _switch_38 = (l->__Field(STRING(L"color",5)).Cast<format::swf::ColorModel >());
							switch((_switch_38)->GetIndex()){
								case 0: {
									int n = _switch_38->__Param(0);
{
										return n;
									}
								}
								break;
								default: {
									return null();
								}
							}
						}
					};
					Dynamic cbits = _Function_1::Block(l);
					this->writeTIDExt(36,l->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >()->length + ((cbits == null()) ? int( 7 ) : int( 8 )));
					this->o->writeUInt16(l->__Field(STRING(L"cid",3)).Cast<int >());
					format::swf::ColorModel _switch_39 = (l->__Field(STRING(L"color",5)).Cast<format::swf::ColorModel >());
					switch((_switch_39)->GetIndex()){
						case 0: {
{
								this->o->writeByte(3);
							}
						}
						break;
						case 1: {
							this->o->writeByte(4);
						}
						break;
						case 3: {
							this->o->writeByte(5);
						}
						break;
						default: {
							hxThrow (STRING(L"assert",6));
						}
					}
					this->o->writeUInt16(l->__Field(STRING(L"width",5)).Cast<int >());
					this->o->writeUInt16(l->__Field(STRING(L"height",6)).Cast<int >());
					if (cbits != null())
						this->o->writeByte(cbits);
					this->o->write(l->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >());
				}
			}
			break;
			case 20: {
				haxe::io::Bytes data = _switch_35->__Param(0);
{
					this->writeTIDExt(8,data->length);
					this->o->write(data);
				}
			}
			break;
			case 19: {
				format::swf::JPEGData jdata = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					format::swf::JPEGData _switch_40 = (jdata);
					switch((_switch_40)->GetIndex()){
						case 0: {
							haxe::io::Bytes data = _switch_40->__Param(0);
{
								this->writeTIDExt(6,data->length + 2);
								this->o->writeUInt16(id);
								this->o->write(data);
							}
						}
						break;
						case 1: {
							haxe::io::Bytes data = _switch_40->__Param(0);
{
								this->writeTIDExt(21,data->length + 2);
								this->o->writeUInt16(id);
								this->o->write(data);
							}
						}
						break;
						case 2: {
							haxe::io::Bytes mask = _switch_40->__Param(1);
							haxe::io::Bytes data = _switch_40->__Param(0);
{
								this->writeTIDExt(35,data->length + mask->length + 6);
								this->o->writeUInt16(id);
								this->o->writeUInt30(data->length);
								this->o->write(data);
								this->o->write(mask);
							}
						}
						break;
					}
				}
			}
			break;
			case 22: {
				Dynamic data = _switch_35->__Param(0);
{
					this->writeSound(data);
				}
			}
			break;
			case 23: {
				Dynamic soundInfo = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					if (soundInfo->__Field(STRING(L"hasLoops",8)).Cast<bool >())
						this->writeTID(15,5);
					else
						this->writeTID(15,3);
;
					this->o->writeUInt16(id);
					this->writeSoundInfo(soundInfo);
				}
			}
			break;
			case 24: {
				haxe::io::Bytes data = _switch_35->__Param(0);
{
					this->writeTID(12,data->length);
					this->o->write(data);
				}
			}
			break;
			case 25: {
				int timeoutseconds = _switch_35->__Param(1);
				int maxRecursion = _switch_35->__Param(0);
{
					this->writeTID(65,4);
					this->o->writeUInt16(maxRecursion);
					this->o->writeUInt16(timeoutseconds);
				}
			}
			break;
			case 26: {
				Array<Dynamic > buttonRecords = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					haxe::io::BytesOutput t1 = this->openTMP();
					{
						int _g = 0;
						while(_g < buttonRecords->length){
							Dynamic t2 = buttonRecords->__get(_g);
							++_g;
							this->writeButtonRecord(t2);
						}
					}
					haxe::io::Bytes bytes = this->closeTMP(t1);
					this->writeTID(34,bytes->length + 6);
					this->o->writeUInt16(id);
					this->o->writeByte(0);
					this->o->writeUInt16(0);
					this->o->write(bytes);
					this->o->writeByte(0);
				}
			}
			break;
			case 27: {
				Dynamic data = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					haxe::io::BytesOutput t1 = this->openTMP();
					this->writeDefineEditText(data);
					haxe::io::Bytes bytes = this->closeTMP(t1);
					this->writeTID(37,bytes->length + 2);
					this->o->writeUInt16(id);
					this->o->write(bytes);
				}
			}
			break;
			case 28: {
				String data = _switch_35->__Param(0);
{
					this->writeTID(77,data.length + 1);
					this->o->writeString(data);
					this->o->writeByte(0);
				}
			}
			break;
			case 29: {
				Dynamic splitter = _switch_35->__Param(1);
				int id = _switch_35->__Param(0);
{
					haxe::io::BytesOutput t1 = this->openTMP();
					this->writeRect(splitter);
					haxe::io::Bytes bytes = this->closeTMP(t1);
					this->writeTID(78,bytes->length + 2);
					this->o->writeUInt16(id);
					this->o->write(bytes);
				}
			}
			break;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeTag,(void))

Void Writer_obj::writeEnd( ){
{
		this->o->writeUInt16(0);
		haxe::io::Bytes bytes = this->o->getBytes();
		int size = bytes->length;
		if (this->compressed)
			bytes = format::tools::Deflate_obj::run(bytes);
		this->output->writeUInt30(size + 8);
		this->output->write(bytes);
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Writer_obj,writeEnd,(void))


Writer_obj::Writer_obj()
{
	InitMember(output);
	InitMember(o);
	InitMember(compressed);
	InitMember(bits);
}

void Writer_obj::__Mark()
{
	MarkMember(output);
	MarkMember(o);
	MarkMember(compressed);
	MarkMember(bits);
}

Dynamic Writer_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { return o; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { return bits; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"write",sizeof(wchar_t)*5) ) { return write_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"output",sizeof(wchar_t)*6) ) { return output; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"openTMP",sizeof(wchar_t)*7) ) { return openTMP_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"closeTMP",sizeof(wchar_t)*8) ) { return closeTMP_dyn(); }
		if (!memcmp(inName.__s,L"writeRGB",sizeof(wchar_t)*8) ) { return writeRGB_dyn(); }
		if (!memcmp(inName.__s,L"writeCXA",sizeof(wchar_t)*8) ) { return writeCXA_dyn(); }
		if (!memcmp(inName.__s,L"writeTID",sizeof(wchar_t)*8) ) { return writeTID_dyn(); }
		if (!memcmp(inName.__s,L"writeTag",sizeof(wchar_t)*8) ) { return writeTag_dyn(); }
		if (!memcmp(inName.__s,L"writeEnd",sizeof(wchar_t)*8) ) { return writeEnd_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"writeRect",sizeof(wchar_t)*9) ) { return writeRect_dyn(); }
		if (!memcmp(inName.__s,L"writeRGBA",sizeof(wchar_t)*9) ) { return writeRGBA_dyn(); }
		if (!memcmp(inName.__s,L"writeFont",sizeof(wchar_t)*9) ) { return writeFont_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"compressed",sizeof(wchar_t)*10) ) { return compressed; }
		if (!memcmp(inName.__s,L"writeFixed",sizeof(wchar_t)*10) ) { return writeFixed_dyn(); }
		if (!memcmp(inName.__s,L"writeSound",sizeof(wchar_t)*10) ) { return writeSound_dyn(); }
		if (!memcmp(inName.__s,L"writeShape",sizeof(wchar_t)*10) ) { return writeShape_dyn(); }
		if (!memcmp(inName.__s,L"writeFont1",sizeof(wchar_t)*10) ) { return writeFont1_dyn(); }
		if (!memcmp(inName.__s,L"writeFont2",sizeof(wchar_t)*10) ) { return writeFont2_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"writeFixed8",sizeof(wchar_t)*11) ) { return writeFixed8_dyn(); }
		if (!memcmp(inName.__s,L"writeHeader",sizeof(wchar_t)*11) ) { return writeHeader_dyn(); }
		if (!memcmp(inName.__s,L"writeMatrix",sizeof(wchar_t)*11) ) { return writeMatrix_dyn(); }
		if (!memcmp(inName.__s,L"writeFilter",sizeof(wchar_t)*11) ) { return writeFilter_dyn(); }
		if (!memcmp(inName.__s,L"writeTIDExt",sizeof(wchar_t)*11) ) { return writeTIDExt_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"writeFilters",sizeof(wchar_t)*12) ) { return writeFilters_dyn(); }
		if (!memcmp(inName.__s,L"writeSymbols",sizeof(wchar_t)*12) ) { return writeSymbols_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"writeCXAColor",sizeof(wchar_t)*13) ) { return writeCXAColor_dyn(); }
		if (!memcmp(inName.__s,L"writeGradient",sizeof(wchar_t)*13) ) { return writeGradient_dyn(); }
		if (!memcmp(inName.__s,L"writeFontInfo",sizeof(wchar_t)*13) ) { return writeFontInfo_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"writeBlendMode",sizeof(wchar_t)*14) ) { return writeBlendMode_dyn(); }
		if (!memcmp(inName.__s,L"writeFillStyle",sizeof(wchar_t)*14) ) { return writeFillStyle_dyn(); }
		if (!memcmp(inName.__s,L"writeLineStyle",sizeof(wchar_t)*14) ) { return writeLineStyle_dyn(); }
		if (!memcmp(inName.__s,L"writeSoundInfo",sizeof(wchar_t)*14) ) { return writeSoundInfo_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"writeClipEvents",sizeof(wchar_t)*15) ) { return writeClipEvents_dyn(); }
		if (!memcmp(inName.__s,L"writeGradRecord",sizeof(wchar_t)*15) ) { return writeGradRecord_dyn(); }
		if (!memcmp(inName.__s,L"writeFillStyles",sizeof(wchar_t)*15) ) { return writeFillStyles_dyn(); }
		if (!memcmp(inName.__s,L"writeLineStyles",sizeof(wchar_t)*15) ) { return writeLineStyles_dyn(); }
		if (!memcmp(inName.__s,L"writeMorphShape",sizeof(wchar_t)*15) ) { return writeMorphShape_dyn(); }
		if (!memcmp(inName.__s,L"writeFontGlyphs",sizeof(wchar_t)*15) ) { return writeFontGlyphs_dyn(); }
		break;
	case 16:
		if (!memcmp(inName.__s,L"writeFilterFlags",sizeof(wchar_t)*16) ) { return writeFilterFlags_dyn(); }
		if (!memcmp(inName.__s,L"writePlaceObject",sizeof(wchar_t)*16) ) { return writePlaceObject_dyn(); }
		if (!memcmp(inName.__s,L"writeShapeRecord",sizeof(wchar_t)*16) ) { return writeShapeRecord_dyn(); }
		break;
	case 17:
		if (!memcmp(inName.__s,L"writeButtonRecord",sizeof(wchar_t)*17) ) { return writeButtonRecord_dyn(); }
		break;
	case 18:
		if (!memcmp(inName.__s,L"writeFocalGradient",sizeof(wchar_t)*18) ) { return writeFocalGradient_dyn(); }
		if (!memcmp(inName.__s,L"writeMorphGradient",sizeof(wchar_t)*18) ) { return writeMorphGradient_dyn(); }
		break;
	case 19:
		if (!memcmp(inName.__s,L"writeFilterGradient",sizeof(wchar_t)*19) ) { return writeFilterGradient_dyn(); }
		if (!memcmp(inName.__s,L"writeShapeWithStyle",sizeof(wchar_t)*19) ) { return writeShapeWithStyle_dyn(); }
		if (!memcmp(inName.__s,L"writeMorphGradients",sizeof(wchar_t)*19) ) { return writeMorphGradients_dyn(); }
		if (!memcmp(inName.__s,L"writeMorphFillStyle",sizeof(wchar_t)*19) ) { return writeMorphFillStyle_dyn(); }
		if (!memcmp(inName.__s,L"writeFileAttributes",sizeof(wchar_t)*19) ) { return writeFileAttributes_dyn(); }
		if (!memcmp(inName.__s,L"writeDefineEditText",sizeof(wchar_t)*19) ) { return writeDefineEditText_dyn(); }
		break;
	case 20:
		if (!memcmp(inName.__s,L"writeMorphFillStyles",sizeof(wchar_t)*20) ) { return writeMorphFillStyles_dyn(); }
		if (!memcmp(inName.__s,L"writeMorph1LineStyle",sizeof(wchar_t)*20) ) { return writeMorph1LineStyle_dyn(); }
		if (!memcmp(inName.__s,L"writeMorph2LineStyle",sizeof(wchar_t)*20) ) { return writeMorph2LineStyle_dyn(); }
		if (!memcmp(inName.__s,L"writeEnvelopeRecords",sizeof(wchar_t)*20) ) { return writeEnvelopeRecords_dyn(); }
		break;
	case 21:
		if (!memcmp(inName.__s,L"writeMorph1LineStyles",sizeof(wchar_t)*21) ) { return writeMorph1LineStyles_dyn(); }
		if (!memcmp(inName.__s,L"writeMorph2LineStyles",sizeof(wchar_t)*21) ) { return writeMorph2LineStyles_dyn(); }
		break;
	case 22:
		if (!memcmp(inName.__s,L"writeShapeWithoutStyle",sizeof(wchar_t)*22) ) { return writeShapeWithoutStyle_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_output = __hxcpp_field_to_id("output");
static int __id_o = __hxcpp_field_to_id("o");
static int __id_compressed = __hxcpp_field_to_id("compressed");
static int __id_bits = __hxcpp_field_to_id("bits");
static int __id_write = __hxcpp_field_to_id("write");
static int __id_writeRect = __hxcpp_field_to_id("writeRect");
static int __id_writeFixed8 = __hxcpp_field_to_id("writeFixed8");
static int __id_writeFixed = __hxcpp_field_to_id("writeFixed");
static int __id_openTMP = __hxcpp_field_to_id("openTMP");
static int __id_closeTMP = __hxcpp_field_to_id("closeTMP");
static int __id_writeHeader = __hxcpp_field_to_id("writeHeader");
static int __id_writeRGB = __hxcpp_field_to_id("writeRGB");
static int __id_writeRGBA = __hxcpp_field_to_id("writeRGBA");
static int __id_writeMatrix = __hxcpp_field_to_id("writeMatrix");
static int __id_writeCXAColor = __hxcpp_field_to_id("writeCXAColor");
static int __id_writeCXA = __hxcpp_field_to_id("writeCXA");
static int __id_writeClipEvents = __hxcpp_field_to_id("writeClipEvents");
static int __id_writeFilterFlags = __hxcpp_field_to_id("writeFilterFlags");
static int __id_writeFilterGradient = __hxcpp_field_to_id("writeFilterGradient");
static int __id_writeFilter = __hxcpp_field_to_id("writeFilter");
static int __id_writeFilters = __hxcpp_field_to_id("writeFilters");
static int __id_writeBlendMode = __hxcpp_field_to_id("writeBlendMode");
static int __id_writePlaceObject = __hxcpp_field_to_id("writePlaceObject");
static int __id_writeTID = __hxcpp_field_to_id("writeTID");
static int __id_writeTIDExt = __hxcpp_field_to_id("writeTIDExt");
static int __id_writeSymbols = __hxcpp_field_to_id("writeSymbols");
static int __id_writeSound = __hxcpp_field_to_id("writeSound");
static int __id_writeGradRecord = __hxcpp_field_to_id("writeGradRecord");
static int __id_writeGradient = __hxcpp_field_to_id("writeGradient");
static int __id_writeFocalGradient = __hxcpp_field_to_id("writeFocalGradient");
static int __id_writeFillStyle = __hxcpp_field_to_id("writeFillStyle");
static int __id_writeFillStyles = __hxcpp_field_to_id("writeFillStyles");
static int __id_writeLineStyle = __hxcpp_field_to_id("writeLineStyle");
static int __id_writeLineStyles = __hxcpp_field_to_id("writeLineStyles");
static int __id_writeShapeRecord = __hxcpp_field_to_id("writeShapeRecord");
static int __id_writeShapeWithoutStyle = __hxcpp_field_to_id("writeShapeWithoutStyle");
static int __id_writeShapeWithStyle = __hxcpp_field_to_id("writeShapeWithStyle");
static int __id_writeShape = __hxcpp_field_to_id("writeShape");
static int __id_writeMorphGradient = __hxcpp_field_to_id("writeMorphGradient");
static int __id_writeMorphGradients = __hxcpp_field_to_id("writeMorphGradients");
static int __id_writeMorphFillStyle = __hxcpp_field_to_id("writeMorphFillStyle");
static int __id_writeMorphFillStyles = __hxcpp_field_to_id("writeMorphFillStyles");
static int __id_writeMorph1LineStyle = __hxcpp_field_to_id("writeMorph1LineStyle");
static int __id_writeMorph1LineStyles = __hxcpp_field_to_id("writeMorph1LineStyles");
static int __id_writeMorph2LineStyle = __hxcpp_field_to_id("writeMorph2LineStyle");
static int __id_writeMorph2LineStyles = __hxcpp_field_to_id("writeMorph2LineStyles");
static int __id_writeMorphShape = __hxcpp_field_to_id("writeMorphShape");
static int __id_writeFontGlyphs = __hxcpp_field_to_id("writeFontGlyphs");
static int __id_writeFont1 = __hxcpp_field_to_id("writeFont1");
static int __id_writeFont2 = __hxcpp_field_to_id("writeFont2");
static int __id_writeFont = __hxcpp_field_to_id("writeFont");
static int __id_writeFontInfo = __hxcpp_field_to_id("writeFontInfo");
static int __id_writeSoundInfo = __hxcpp_field_to_id("writeSoundInfo");
static int __id_writeEnvelopeRecords = __hxcpp_field_to_id("writeEnvelopeRecords");
static int __id_writeFileAttributes = __hxcpp_field_to_id("writeFileAttributes");
static int __id_writeButtonRecord = __hxcpp_field_to_id("writeButtonRecord");
static int __id_writeDefineEditText = __hxcpp_field_to_id("writeDefineEditText");
static int __id_writeTag = __hxcpp_field_to_id("writeTag");
static int __id_writeEnd = __hxcpp_field_to_id("writeEnd");


Dynamic Writer_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_output) return output;
	if (inFieldID==__id_o) return o;
	if (inFieldID==__id_compressed) return compressed;
	if (inFieldID==__id_bits) return bits;
	if (inFieldID==__id_write) return write_dyn();
	if (inFieldID==__id_writeRect) return writeRect_dyn();
	if (inFieldID==__id_writeFixed8) return writeFixed8_dyn();
	if (inFieldID==__id_writeFixed) return writeFixed_dyn();
	if (inFieldID==__id_openTMP) return openTMP_dyn();
	if (inFieldID==__id_closeTMP) return closeTMP_dyn();
	if (inFieldID==__id_writeHeader) return writeHeader_dyn();
	if (inFieldID==__id_writeRGB) return writeRGB_dyn();
	if (inFieldID==__id_writeRGBA) return writeRGBA_dyn();
	if (inFieldID==__id_writeMatrix) return writeMatrix_dyn();
	if (inFieldID==__id_writeCXAColor) return writeCXAColor_dyn();
	if (inFieldID==__id_writeCXA) return writeCXA_dyn();
	if (inFieldID==__id_writeClipEvents) return writeClipEvents_dyn();
	if (inFieldID==__id_writeFilterFlags) return writeFilterFlags_dyn();
	if (inFieldID==__id_writeFilterGradient) return writeFilterGradient_dyn();
	if (inFieldID==__id_writeFilter) return writeFilter_dyn();
	if (inFieldID==__id_writeFilters) return writeFilters_dyn();
	if (inFieldID==__id_writeBlendMode) return writeBlendMode_dyn();
	if (inFieldID==__id_writePlaceObject) return writePlaceObject_dyn();
	if (inFieldID==__id_writeTID) return writeTID_dyn();
	if (inFieldID==__id_writeTIDExt) return writeTIDExt_dyn();
	if (inFieldID==__id_writeSymbols) return writeSymbols_dyn();
	if (inFieldID==__id_writeSound) return writeSound_dyn();
	if (inFieldID==__id_writeGradRecord) return writeGradRecord_dyn();
	if (inFieldID==__id_writeGradient) return writeGradient_dyn();
	if (inFieldID==__id_writeFocalGradient) return writeFocalGradient_dyn();
	if (inFieldID==__id_writeFillStyle) return writeFillStyle_dyn();
	if (inFieldID==__id_writeFillStyles) return writeFillStyles_dyn();
	if (inFieldID==__id_writeLineStyle) return writeLineStyle_dyn();
	if (inFieldID==__id_writeLineStyles) return writeLineStyles_dyn();
	if (inFieldID==__id_writeShapeRecord) return writeShapeRecord_dyn();
	if (inFieldID==__id_writeShapeWithoutStyle) return writeShapeWithoutStyle_dyn();
	if (inFieldID==__id_writeShapeWithStyle) return writeShapeWithStyle_dyn();
	if (inFieldID==__id_writeShape) return writeShape_dyn();
	if (inFieldID==__id_writeMorphGradient) return writeMorphGradient_dyn();
	if (inFieldID==__id_writeMorphGradients) return writeMorphGradients_dyn();
	if (inFieldID==__id_writeMorphFillStyle) return writeMorphFillStyle_dyn();
	if (inFieldID==__id_writeMorphFillStyles) return writeMorphFillStyles_dyn();
	if (inFieldID==__id_writeMorph1LineStyle) return writeMorph1LineStyle_dyn();
	if (inFieldID==__id_writeMorph1LineStyles) return writeMorph1LineStyles_dyn();
	if (inFieldID==__id_writeMorph2LineStyle) return writeMorph2LineStyle_dyn();
	if (inFieldID==__id_writeMorph2LineStyles) return writeMorph2LineStyles_dyn();
	if (inFieldID==__id_writeMorphShape) return writeMorphShape_dyn();
	if (inFieldID==__id_writeFontGlyphs) return writeFontGlyphs_dyn();
	if (inFieldID==__id_writeFont1) return writeFont1_dyn();
	if (inFieldID==__id_writeFont2) return writeFont2_dyn();
	if (inFieldID==__id_writeFont) return writeFont_dyn();
	if (inFieldID==__id_writeFontInfo) return writeFontInfo_dyn();
	if (inFieldID==__id_writeSoundInfo) return writeSoundInfo_dyn();
	if (inFieldID==__id_writeEnvelopeRecords) return writeEnvelopeRecords_dyn();
	if (inFieldID==__id_writeFileAttributes) return writeFileAttributes_dyn();
	if (inFieldID==__id_writeButtonRecord) return writeButtonRecord_dyn();
	if (inFieldID==__id_writeDefineEditText) return writeDefineEditText_dyn();
	if (inFieldID==__id_writeTag) return writeTag_dyn();
	if (inFieldID==__id_writeEnd) return writeEnd_dyn();
	return super::__IField(inFieldID);
}

Dynamic Writer_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { o=inValue.Cast<haxe::io::BytesOutput >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { bits=inValue.Cast<format::tools::BitsOutput >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"output",sizeof(wchar_t)*6) ) { output=inValue.Cast<haxe::io::Output >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"compressed",sizeof(wchar_t)*10) ) { compressed=inValue.Cast<bool >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Writer_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"output",6));
	outFields->push(STRING(L"o",1));
	outFields->push(STRING(L"compressed",10));
	outFields->push(STRING(L"bits",4));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"output",6),
	STRING(L"o",1),
	STRING(L"compressed",10),
	STRING(L"bits",4),
	STRING(L"write",5),
	STRING(L"writeRect",9),
	STRING(L"writeFixed8",11),
	STRING(L"writeFixed",10),
	STRING(L"openTMP",7),
	STRING(L"closeTMP",8),
	STRING(L"writeHeader",11),
	STRING(L"writeRGB",8),
	STRING(L"writeRGBA",9),
	STRING(L"writeMatrix",11),
	STRING(L"writeCXAColor",13),
	STRING(L"writeCXA",8),
	STRING(L"writeClipEvents",15),
	STRING(L"writeFilterFlags",16),
	STRING(L"writeFilterGradient",19),
	STRING(L"writeFilter",11),
	STRING(L"writeFilters",12),
	STRING(L"writeBlendMode",14),
	STRING(L"writePlaceObject",16),
	STRING(L"writeTID",8),
	STRING(L"writeTIDExt",11),
	STRING(L"writeSymbols",12),
	STRING(L"writeSound",10),
	STRING(L"writeGradRecord",15),
	STRING(L"writeGradient",13),
	STRING(L"writeFocalGradient",18),
	STRING(L"writeFillStyle",14),
	STRING(L"writeFillStyles",15),
	STRING(L"writeLineStyle",14),
	STRING(L"writeLineStyles",15),
	STRING(L"writeShapeRecord",16),
	STRING(L"writeShapeWithoutStyle",22),
	STRING(L"writeShapeWithStyle",19),
	STRING(L"writeShape",10),
	STRING(L"writeMorphGradient",18),
	STRING(L"writeMorphGradients",19),
	STRING(L"writeMorphFillStyle",19),
	STRING(L"writeMorphFillStyles",20),
	STRING(L"writeMorph1LineStyle",20),
	STRING(L"writeMorph1LineStyles",21),
	STRING(L"writeMorph2LineStyle",20),
	STRING(L"writeMorph2LineStyles",21),
	STRING(L"writeMorphShape",15),
	STRING(L"writeFontGlyphs",15),
	STRING(L"writeFont1",10),
	STRING(L"writeFont2",10),
	STRING(L"writeFont",9),
	STRING(L"writeFontInfo",13),
	STRING(L"writeSoundInfo",14),
	STRING(L"writeEnvelopeRecords",20),
	STRING(L"writeFileAttributes",19),
	STRING(L"writeButtonRecord",17),
	STRING(L"writeDefineEditText",19),
	STRING(L"writeTag",8),
	STRING(L"writeEnd",8),
	String(null()) };

static void sMarkStatics() {
};

Class Writer_obj::__mClass;

void Writer_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.swf.Writer",17), TCanCast<Writer_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Writer_obj::__boot()
{
}

} // end namespace format
} // end namespace swf
