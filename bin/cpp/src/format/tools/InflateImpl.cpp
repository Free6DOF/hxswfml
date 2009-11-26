#include <hxObject.h>

#ifndef INCLUDED_format_tools_Adler32
#include <format/tools/Adler32.h>
#endif
#ifndef INCLUDED_format_tools_HuffTools
#include <format/tools/HuffTools.h>
#endif
#ifndef INCLUDED_format_tools_Huffman
#include <format/tools/Huffman.h>
#endif
#ifndef INCLUDED_format_tools_InflateImpl
#include <format/tools/InflateImpl.h>
#endif
#ifndef INCLUDED_format_tools__InflateImpl_State
#include <format/tools/_InflateImpl/State.h>
#endif
#ifndef INCLUDED_format_tools__InflateImpl_Window
#include <format/tools/_InflateImpl/Window.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesBuffer
#include <haxe/io/BytesBuffer.h>
#endif
#ifndef INCLUDED_haxe_io_Error
#include <haxe/io/Error.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
namespace format{
namespace tools{

Void InflateImpl_obj::__construct(haxe::io::Input i,Dynamic __o_header)
{
bool header = __o_header.Default(true);
{
	this->final = false;
	this->htools = format::tools::HuffTools_obj::__new();
	this->huffman = this->buildFixedHuffman();
	this->huffdist = null();
	this->len = 0;
	this->dist = 0;
	this->state = header ? format::tools::_InflateImpl::State( format::tools::_InflateImpl::State_obj::Head ) : format::tools::_InflateImpl::State( format::tools::_InflateImpl::State_obj::Block );
	this->input = i;
	this->bits = 0;
	this->nbits = 0;
	this->needed = 0;
	this->output = null();
	this->outpos = 0;
	this->lengths = Array_obj<int >::__new();
	{
		int _g = 0;
		while(_g < 19){
			int i1 = _g++;
			this->lengths->push(-1);
		}
	}
	this->window = format::tools::_InflateImpl::Window_obj::__new();
}
;
	return null();
}

InflateImpl_obj::~InflateImpl_obj() { }

Dynamic InflateImpl_obj::__CreateEmpty() { return  new InflateImpl_obj; }
hxObjectPtr<InflateImpl_obj > InflateImpl_obj::__new(haxe::io::Input i,Dynamic __o_header)
{  hxObjectPtr<InflateImpl_obj > result = new InflateImpl_obj();
	result->__construct(i,__o_header);
	return result;}

Dynamic InflateImpl_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<InflateImpl_obj > result = new InflateImpl_obj();
	result->__construct(inArgs[0],inArgs[1]);
	return result;}

format::tools::Huffman InflateImpl_obj::buildFixedHuffman( ){
	if (format::tools::InflateImpl_obj::FIXED_HUFFMAN != null())
		return format::tools::InflateImpl_obj::FIXED_HUFFMAN;
	Array<int > a = Array_obj<int >::__new();
	{
		int _g = 0;
		while(_g < 288){
			int n = _g++;
			a->push(n <= 143 ? int( 8 ) : int( n <= 255 ? int( 9 ) : int( n <= 279 ? int( 7 ) : int( 8 ) ) ));
		}
	}
	format::tools::InflateImpl_obj::FIXED_HUFFMAN = this->htools->make(a,0,288,10);
	return format::tools::InflateImpl_obj::FIXED_HUFFMAN;
}


DEFINE_DYNAMIC_FUNC0(InflateImpl_obj,buildFixedHuffman,return )

int InflateImpl_obj::readBytes( haxe::io::Bytes b,int pos,int len){
	this->needed = len;
	this->outpos = pos;
	this->output = b;
	if (len > 0)
		while(this->inflateLoop()){
	}
	return len - this->needed;
}


DEFINE_DYNAMIC_FUNC3(InflateImpl_obj,readBytes,return )

int InflateImpl_obj::getBits( int n){
	while(this->nbits < n){
		hxOrEq(this->bits,int(this->input->readByte()) << int(this->nbits));
		hxAddEq(this->nbits,8);
	}
	int b = int(this->bits) & int(((int(1) << int(n)) - 1));
	hxSubEq(this->nbits,n);
	hxShrEq(this->bits,n);
	return b;
}


DEFINE_DYNAMIC_FUNC1(InflateImpl_obj,getBits,return )

bool InflateImpl_obj::getBit( ){
	if (this->nbits == 0){
		this->nbits = 8;
		this->bits = this->input->readByte();
	}
	bool b = int(this->bits) & int(1) == 1;
	this->nbits--;
	hxShrEq(this->bits,1);
	return b;
}


DEFINE_DYNAMIC_FUNC0(InflateImpl_obj,getBit,return )

int InflateImpl_obj::getRevBits( int n){
	return n == 0 ? int( 0 ) : int( this->getBit() ? int( int((int(1) << int((n - 1)))) | int(this->getRevBits(n - 1)) ) : int( this->getRevBits(n - 1) ) );
}


DEFINE_DYNAMIC_FUNC1(InflateImpl_obj,getRevBits,return )

Void InflateImpl_obj::resetBits( ){
{
		this->bits = 0;
		this->nbits = 0;
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(InflateImpl_obj,resetBits,(void))

Void InflateImpl_obj::addBytes( haxe::io::Bytes b,int p,int len){
{
		this->window->addBytes(b,p,len);
		this->output->blit(this->outpos,b,p,len);
		hxSubEq(this->needed,len);
		hxAddEq(this->outpos,len);
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(InflateImpl_obj,addBytes,(void))

Void InflateImpl_obj::addByte( int b){
{
		this->window->addByte(b);
		this->output->b[this->outpos] = b;
		this->needed--;
		this->outpos++;
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(InflateImpl_obj,addByte,(void))

Void InflateImpl_obj::addDistOne( int n){
{
		int c = this->window->getLastChar();
		{
			int _g = 0;
			while(_g < n){
				int i = _g++;
				this->addByte(c);
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(InflateImpl_obj,addDistOne,(void))

Void InflateImpl_obj::addDist( int d,int len){
{
		this->addBytes(this->window->buffer,this->window->pos - d,len);
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(InflateImpl_obj,addDist,(void))

int InflateImpl_obj::applyHuffman( format::tools::Huffman h){
	struct _Function_1{
		static int Block( format::tools::Huffman &h,format::tools::InflateImpl_obj *__this)/* DEF (not block)(ret intern) */{
			format::tools::Huffman _switch_1 = (h);
			switch((_switch_1)->GetIndex()){
				case 0: {
					int n = _switch_1->__Param(0);
{
						return n;
					}
				}
				break;
				case 1: {
					format::tools::Huffman b = _switch_1->__Param(1);
					format::tools::Huffman a = _switch_1->__Param(0);
{
						return __this->applyHuffman(__this->getBit() ? format::tools::Huffman( b ) : format::tools::Huffman( a ));
					}
				}
				break;
				case 2: {
					Array<format::tools::Huffman > tbl = _switch_1->__Param(1);
					int n = _switch_1->__Param(0);
{
						return __this->applyHuffman(tbl->__get(__this->getBits(n)));
					}
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return _Function_1::Block(h,this);
}


DEFINE_DYNAMIC_FUNC1(InflateImpl_obj,applyHuffman,return )

Void InflateImpl_obj::inflateLengths( Array<int > a,int max){
{
		int i = 0;
		int prev = 0;
		while(i < max){
			int n = this->applyHuffman(this->huffman);
			switch( (int)(n)){
				case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7: case 8: case 9: case 10: case 11: case 12: case 13: case 14: case 15: {
					prev = n;
					a[i] = n;
					i++;
				}
				break;
				case 16: {
					int end = i + 3 + this->getBits(2);
					if (end > max)
						hxThrow (STRING(L"Invalid data",12));
					while(i < end){
						a[i] = prev;
						i++;
					}
				}
				break;
				case 17: {
					hxAddEq(i,3 + this->getBits(3));
					if (i > max)
						hxThrow (STRING(L"Invalid data",12));
				}
				break;
				case 18: {
					hxAddEq(i,11 + this->getBits(7));
					if (i > max)
						hxThrow (STRING(L"Invalid data",12));
				}
				break;
				default: {
					hxThrow (STRING(L"Invalid data",12));
				}
			}
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(InflateImpl_obj,inflateLengths,(void))

bool InflateImpl_obj::inflateLoop( ){
	format::tools::_InflateImpl::State _switch_2 = (this->state);
	switch((_switch_2)->GetIndex()){
		case 0: {
			int cmf = this->input->readByte();
			int cm = int(cmf) & int(15);
			int cinfo = int(cmf) >> int(4);
			if (bool(cm != 8) || bool(cinfo != 7))
				hxThrow (STRING(L"Invalid data",12));
			int flg = this->input->readByte();
			bool fdict = int(flg) & int(32) != 0;
			if (hxMod(((int(cmf) << int(8)) + flg),31) != 0)
				hxThrow (STRING(L"Invalid data",12));
			if (fdict)
				hxThrow (STRING(L"Unsupported dictionary",22));
			this->state = format::tools::_InflateImpl::State_obj::Block;
			return true;
		}
		break;
		case 4: {
			format::tools::Adler32 calc = this->window->checksum();
			format::tools::Adler32 crc = format::tools::Adler32_obj::read(this->input);
			if (!calc->equals(crc))
				hxThrow (STRING(L"Invalid CRC",11));
			this->state = format::tools::_InflateImpl::State_obj::Done;
			return true;
		}
		break;
		case 7: {
			return false;
		}
		break;
		case 1: {
			this->final = this->getBit();
			switch( (int)(this->getBits(2))){
				case 0: {
					this->len = this->input->readUInt16();
					int nlen = this->input->readUInt16();
					if (nlen != 65535 - this->len)
						hxThrow (STRING(L"Invalid data",12));
					this->state = format::tools::_InflateImpl::State_obj::Flat;
					bool r = this->inflateLoop();
					this->resetBits();
					return r;
				}
				break;
				case 1: {
					this->huffman = this->buildFixedHuffman();
					this->huffdist = null();
					this->state = format::tools::_InflateImpl::State_obj::CData;
					return true;
				}
				break;
				case 2: {
					int hlit = this->getBits(5) + 257;
					int hdist = this->getBits(5) + 1;
					int hclen = this->getBits(4) + 4;
					{
						int _g = 0;
						while(_g < hclen){
							int i = _g++;
							this->lengths[format::tools::InflateImpl_obj::CODE_LENGTHS_POS->__get(i)] = this->getBits(3);
						}
					}
					{
						int _g = hclen;
						while(_g < 19){
							int i = _g++;
							this->lengths[format::tools::InflateImpl_obj::CODE_LENGTHS_POS->__get(i)] = 0;
						}
					}
					this->huffman = this->htools->make(this->lengths,0,19,8);
					Array<int > lengths = Array_obj<int >::__new();
					{
						int _g1 = 0;
						int _g = hlit + hdist;
						while(_g1 < _g){
							int i = _g1++;
							lengths->push(0);
						}
					}
					this->inflateLengths(lengths,hlit + hdist);
					this->huffdist = this->htools->make(lengths,hlit,hdist,16);
					this->huffman = this->htools->make(lengths,0,hlit,16);
					this->state = format::tools::_InflateImpl::State_obj::CData;
					return true;
				}
				break;
				default: {
					hxThrow (STRING(L"Invalid data",12));
				}
			}
		}
		break;
		case 3: {
			int rlen = (this->len < this->needed) ? int( this->len ) : int( this->needed );
			haxe::io::Bytes bytes = this->input->read(rlen);
			hxSubEq(this->len,rlen);
			this->addBytes(bytes,0,rlen);
			if (this->len == 0)
				this->state = this->final ? format::tools::_InflateImpl::State( format::tools::_InflateImpl::State_obj::Crc ) : format::tools::_InflateImpl::State( format::tools::_InflateImpl::State_obj::Block );
			return this->needed > 0;
		}
		break;
		case 6: {
			int rlen = (this->len < this->needed) ? int( this->len ) : int( this->needed );
			this->addDistOne(rlen);
			hxSubEq(this->len,rlen);
			if (this->len == 0)
				this->state = format::tools::_InflateImpl::State_obj::CData;
			return this->needed > 0;
		}
		break;
		case 5: {
			while(bool(this->len > 0) && bool(this->needed > 0)){
				int rdist = (this->len < this->dist) ? int( this->len ) : int( this->dist );
				int rlen = (this->needed < rdist) ? int( this->needed ) : int( rdist );
				this->addDist(this->dist,rlen);
				hxSubEq(this->len,rlen);
			}
			if (this->len == 0)
				this->state = format::tools::_InflateImpl::State_obj::CData;
			return this->needed > 0;
		}
		break;
		case 2: {
			int n = this->applyHuffman(this->huffman);
			if (n < 256){
				this->addByte(n);
				return this->needed > 0;
			}
			else
				if (n == 256){
				this->state = this->final ? format::tools::_InflateImpl::State( format::tools::_InflateImpl::State_obj::Crc ) : format::tools::_InflateImpl::State( format::tools::_InflateImpl::State_obj::Block );
				return true;
			}
			else{
				hxSubEq(n,257);
				int extra_bits = format::tools::InflateImpl_obj::LEN_EXTRA_BITS_TBL->__get(n);
				if (extra_bits == -1)
					hxThrow (STRING(L"Invalid data",12));
				this->len = format::tools::InflateImpl_obj::LEN_BASE_VAL_TBL->__get(n) + this->getBits(extra_bits);
				int dist_code = this->huffdist == null() ? int( this->getRevBits(5) ) : int( this->applyHuffman(this->huffdist) );
				extra_bits = format::tools::InflateImpl_obj::DIST_EXTRA_BITS_TBL->__get(dist_code);
				if (extra_bits == -1)
					hxThrow (STRING(L"Invalid data",12));
				this->dist = format::tools::InflateImpl_obj::DIST_BASE_VAL_TBL->__get(dist_code) + this->getBits(extra_bits);
				if (this->dist > this->window->available())
					hxThrow (STRING(L"Invalid data",12));
				this->state = (this->dist == 1) ? format::tools::_InflateImpl::State( format::tools::_InflateImpl::State_obj::DistOne ) : format::tools::_InflateImpl::State( format::tools::_InflateImpl::State_obj::Dist );
				return true;
			}
;
;
		}
		break;
	}
}


DEFINE_DYNAMIC_FUNC0(InflateImpl_obj,inflateLoop,return )

Array<int > InflateImpl_obj::LEN_EXTRA_BITS_TBL;

Array<int > InflateImpl_obj::LEN_BASE_VAL_TBL;

Array<int > InflateImpl_obj::DIST_EXTRA_BITS_TBL;

Array<int > InflateImpl_obj::DIST_BASE_VAL_TBL;

Array<int > InflateImpl_obj::CODE_LENGTHS_POS;

format::tools::Huffman InflateImpl_obj::FIXED_HUFFMAN;

haxe::io::Bytes InflateImpl_obj::run( haxe::io::Input i,Dynamic __o_bufsize){
int bufsize = __o_bufsize.Default(65536);
{
		haxe::io::Bytes buf = haxe::io::Bytes_obj::alloc(bufsize);
		haxe::io::BytesBuffer output = haxe::io::BytesBuffer_obj::__new();
		format::tools::InflateImpl inflate = format::tools::InflateImpl_obj::__new(i,null());
		while(true){
			int len = inflate->readBytes(buf,0,bufsize);
			{
				if (bool(len < 0) || bool(len > buf->length))
					hxThrow (haxe::io::Error_obj::OutsideBounds);
				Array<unsigned char > b1 = output->b;
				Array<unsigned char > b2 = buf->b;
				{
					int _g1 = 0;
					int _g2 = len;
					while(_g1 < _g2){
						int i1 = _g1++;
						output->b->push(b2->__get(i1));
					}
				}
			}
			if (len < bufsize)
				break;
		}
		return output->getBytes();
	}
}


STATIC_DEFINE_DYNAMIC_FUNC2(InflateImpl_obj,run,return )


InflateImpl_obj::InflateImpl_obj()
{
	InitMember(nbits);
	InitMember(bits);
	InitMember(state);
	InitMember(final);
	InitMember(huffman);
	InitMember(huffdist);
	InitMember(htools);
	InitMember(len);
	InitMember(dist);
	InitMember(needed);
	InitMember(output);
	InitMember(outpos);
	InitMember(input);
	InitMember(lengths);
	InitMember(window);
}

void InflateImpl_obj::__Mark()
{
	MarkMember(nbits);
	MarkMember(bits);
	MarkMember(state);
	MarkMember(final);
	MarkMember(huffman);
	MarkMember(huffdist);
	MarkMember(htools);
	MarkMember(len);
	MarkMember(dist);
	MarkMember(needed);
	MarkMember(output);
	MarkMember(outpos);
	MarkMember(input);
	MarkMember(lengths);
	MarkMember(window);
}

Dynamic InflateImpl_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"run",sizeof(wchar_t)*3) ) { return run_dyn(); }
		if (!memcmp(inName.__s,L"len",sizeof(wchar_t)*3) ) { return len; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { return bits; }
		if (!memcmp(inName.__s,L"dist",sizeof(wchar_t)*4) ) { return dist; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"nbits",sizeof(wchar_t)*5) ) { return nbits; }
		if (!memcmp(inName.__s,L"state",sizeof(wchar_t)*5) ) { return state; }
		if (!memcmp(inName.__s,L"final",sizeof(wchar_t)*5) ) { return final; }
		if (!memcmp(inName.__s,L"input",sizeof(wchar_t)*5) ) { return input; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"htools",sizeof(wchar_t)*6) ) { return htools; }
		if (!memcmp(inName.__s,L"needed",sizeof(wchar_t)*6) ) { return needed; }
		if (!memcmp(inName.__s,L"output",sizeof(wchar_t)*6) ) { return output; }
		if (!memcmp(inName.__s,L"outpos",sizeof(wchar_t)*6) ) { return outpos; }
		if (!memcmp(inName.__s,L"window",sizeof(wchar_t)*6) ) { return window; }
		if (!memcmp(inName.__s,L"getBit",sizeof(wchar_t)*6) ) { return getBit_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"huffman",sizeof(wchar_t)*7) ) { return huffman; }
		if (!memcmp(inName.__s,L"lengths",sizeof(wchar_t)*7) ) { return lengths; }
		if (!memcmp(inName.__s,L"getBits",sizeof(wchar_t)*7) ) { return getBits_dyn(); }
		if (!memcmp(inName.__s,L"addByte",sizeof(wchar_t)*7) ) { return addByte_dyn(); }
		if (!memcmp(inName.__s,L"addDist",sizeof(wchar_t)*7) ) { return addDist_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"huffdist",sizeof(wchar_t)*8) ) { return huffdist; }
		if (!memcmp(inName.__s,L"addBytes",sizeof(wchar_t)*8) ) { return addBytes_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"readBytes",sizeof(wchar_t)*9) ) { return readBytes_dyn(); }
		if (!memcmp(inName.__s,L"resetBits",sizeof(wchar_t)*9) ) { return resetBits_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"getRevBits",sizeof(wchar_t)*10) ) { return getRevBits_dyn(); }
		if (!memcmp(inName.__s,L"addDistOne",sizeof(wchar_t)*10) ) { return addDistOne_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"inflateLoop",sizeof(wchar_t)*11) ) { return inflateLoop_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"applyHuffman",sizeof(wchar_t)*12) ) { return applyHuffman_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"FIXED_HUFFMAN",sizeof(wchar_t)*13) ) { return FIXED_HUFFMAN; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"inflateLengths",sizeof(wchar_t)*14) ) { return inflateLengths_dyn(); }
		break;
	case 16:
		if (!memcmp(inName.__s,L"LEN_BASE_VAL_TBL",sizeof(wchar_t)*16) ) { return LEN_BASE_VAL_TBL; }
		if (!memcmp(inName.__s,L"CODE_LENGTHS_POS",sizeof(wchar_t)*16) ) { return CODE_LENGTHS_POS; }
		break;
	case 17:
		if (!memcmp(inName.__s,L"DIST_BASE_VAL_TBL",sizeof(wchar_t)*17) ) { return DIST_BASE_VAL_TBL; }
		if (!memcmp(inName.__s,L"buildFixedHuffman",sizeof(wchar_t)*17) ) { return buildFixedHuffman_dyn(); }
		break;
	case 18:
		if (!memcmp(inName.__s,L"LEN_EXTRA_BITS_TBL",sizeof(wchar_t)*18) ) { return LEN_EXTRA_BITS_TBL; }
		break;
	case 19:
		if (!memcmp(inName.__s,L"DIST_EXTRA_BITS_TBL",sizeof(wchar_t)*19) ) { return DIST_EXTRA_BITS_TBL; }
	}
	return super::__Field(inName);
}

static int __id_LEN_EXTRA_BITS_TBL = __hxcpp_field_to_id("LEN_EXTRA_BITS_TBL");
static int __id_LEN_BASE_VAL_TBL = __hxcpp_field_to_id("LEN_BASE_VAL_TBL");
static int __id_DIST_EXTRA_BITS_TBL = __hxcpp_field_to_id("DIST_EXTRA_BITS_TBL");
static int __id_DIST_BASE_VAL_TBL = __hxcpp_field_to_id("DIST_BASE_VAL_TBL");
static int __id_CODE_LENGTHS_POS = __hxcpp_field_to_id("CODE_LENGTHS_POS");
static int __id_FIXED_HUFFMAN = __hxcpp_field_to_id("FIXED_HUFFMAN");
static int __id_run = __hxcpp_field_to_id("run");
static int __id_nbits = __hxcpp_field_to_id("nbits");
static int __id_bits = __hxcpp_field_to_id("bits");
static int __id_state = __hxcpp_field_to_id("state");
static int __id_final = __hxcpp_field_to_id("final");
static int __id_huffman = __hxcpp_field_to_id("huffman");
static int __id_huffdist = __hxcpp_field_to_id("huffdist");
static int __id_htools = __hxcpp_field_to_id("htools");
static int __id_len = __hxcpp_field_to_id("len");
static int __id_dist = __hxcpp_field_to_id("dist");
static int __id_needed = __hxcpp_field_to_id("needed");
static int __id_output = __hxcpp_field_to_id("output");
static int __id_outpos = __hxcpp_field_to_id("outpos");
static int __id_input = __hxcpp_field_to_id("input");
static int __id_lengths = __hxcpp_field_to_id("lengths");
static int __id_window = __hxcpp_field_to_id("window");
static int __id_buildFixedHuffman = __hxcpp_field_to_id("buildFixedHuffman");
static int __id_readBytes = __hxcpp_field_to_id("readBytes");
static int __id_getBits = __hxcpp_field_to_id("getBits");
static int __id_getBit = __hxcpp_field_to_id("getBit");
static int __id_getRevBits = __hxcpp_field_to_id("getRevBits");
static int __id_resetBits = __hxcpp_field_to_id("resetBits");
static int __id_addBytes = __hxcpp_field_to_id("addBytes");
static int __id_addByte = __hxcpp_field_to_id("addByte");
static int __id_addDistOne = __hxcpp_field_to_id("addDistOne");
static int __id_addDist = __hxcpp_field_to_id("addDist");
static int __id_applyHuffman = __hxcpp_field_to_id("applyHuffman");
static int __id_inflateLengths = __hxcpp_field_to_id("inflateLengths");
static int __id_inflateLoop = __hxcpp_field_to_id("inflateLoop");


Dynamic InflateImpl_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_LEN_EXTRA_BITS_TBL) return LEN_EXTRA_BITS_TBL;
	if (inFieldID==__id_LEN_BASE_VAL_TBL) return LEN_BASE_VAL_TBL;
	if (inFieldID==__id_DIST_EXTRA_BITS_TBL) return DIST_EXTRA_BITS_TBL;
	if (inFieldID==__id_DIST_BASE_VAL_TBL) return DIST_BASE_VAL_TBL;
	if (inFieldID==__id_CODE_LENGTHS_POS) return CODE_LENGTHS_POS;
	if (inFieldID==__id_FIXED_HUFFMAN) return FIXED_HUFFMAN;
	if (inFieldID==__id_run) return run_dyn();
	if (inFieldID==__id_nbits) return nbits;
	if (inFieldID==__id_bits) return bits;
	if (inFieldID==__id_state) return state;
	if (inFieldID==__id_final) return final;
	if (inFieldID==__id_huffman) return huffman;
	if (inFieldID==__id_huffdist) return huffdist;
	if (inFieldID==__id_htools) return htools;
	if (inFieldID==__id_len) return len;
	if (inFieldID==__id_dist) return dist;
	if (inFieldID==__id_needed) return needed;
	if (inFieldID==__id_output) return output;
	if (inFieldID==__id_outpos) return outpos;
	if (inFieldID==__id_input) return input;
	if (inFieldID==__id_lengths) return lengths;
	if (inFieldID==__id_window) return window;
	if (inFieldID==__id_buildFixedHuffman) return buildFixedHuffman_dyn();
	if (inFieldID==__id_readBytes) return readBytes_dyn();
	if (inFieldID==__id_getBits) return getBits_dyn();
	if (inFieldID==__id_getBit) return getBit_dyn();
	if (inFieldID==__id_getRevBits) return getRevBits_dyn();
	if (inFieldID==__id_resetBits) return resetBits_dyn();
	if (inFieldID==__id_addBytes) return addBytes_dyn();
	if (inFieldID==__id_addByte) return addByte_dyn();
	if (inFieldID==__id_addDistOne) return addDistOne_dyn();
	if (inFieldID==__id_addDist) return addDist_dyn();
	if (inFieldID==__id_applyHuffman) return applyHuffman_dyn();
	if (inFieldID==__id_inflateLengths) return inflateLengths_dyn();
	if (inFieldID==__id_inflateLoop) return inflateLoop_dyn();
	return super::__IField(inFieldID);
}

Dynamic InflateImpl_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"len",sizeof(wchar_t)*3) ) { len=inValue.Cast<int >();return inValue; }
		break;
	case 4:
		if (!memcmp(inName.__s,L"bits",sizeof(wchar_t)*4) ) { bits=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"dist",sizeof(wchar_t)*4) ) { dist=inValue.Cast<int >();return inValue; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"nbits",sizeof(wchar_t)*5) ) { nbits=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"state",sizeof(wchar_t)*5) ) { state=inValue.Cast<format::tools::_InflateImpl::State >();return inValue; }
		if (!memcmp(inName.__s,L"final",sizeof(wchar_t)*5) ) { final=inValue.Cast<bool >();return inValue; }
		if (!memcmp(inName.__s,L"input",sizeof(wchar_t)*5) ) { input=inValue.Cast<haxe::io::Input >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"htools",sizeof(wchar_t)*6) ) { htools=inValue.Cast<format::tools::HuffTools >();return inValue; }
		if (!memcmp(inName.__s,L"needed",sizeof(wchar_t)*6) ) { needed=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"output",sizeof(wchar_t)*6) ) { output=inValue.Cast<haxe::io::Bytes >();return inValue; }
		if (!memcmp(inName.__s,L"outpos",sizeof(wchar_t)*6) ) { outpos=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"window",sizeof(wchar_t)*6) ) { window=inValue.Cast<format::tools::_InflateImpl::Window >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"huffman",sizeof(wchar_t)*7) ) { huffman=inValue.Cast<format::tools::Huffman >();return inValue; }
		if (!memcmp(inName.__s,L"lengths",sizeof(wchar_t)*7) ) { lengths=inValue.Cast<Array<int > >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"huffdist",sizeof(wchar_t)*8) ) { huffdist=inValue.Cast<format::tools::Huffman >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"FIXED_HUFFMAN",sizeof(wchar_t)*13) ) { FIXED_HUFFMAN=inValue.Cast<format::tools::Huffman >();return inValue; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"LEN_BASE_VAL_TBL",sizeof(wchar_t)*16) ) { LEN_BASE_VAL_TBL=inValue.Cast<Array<int > >();return inValue; }
		if (!memcmp(inName.__s,L"CODE_LENGTHS_POS",sizeof(wchar_t)*16) ) { CODE_LENGTHS_POS=inValue.Cast<Array<int > >();return inValue; }
		break;
	case 17:
		if (!memcmp(inName.__s,L"DIST_BASE_VAL_TBL",sizeof(wchar_t)*17) ) { DIST_BASE_VAL_TBL=inValue.Cast<Array<int > >();return inValue; }
		break;
	case 18:
		if (!memcmp(inName.__s,L"LEN_EXTRA_BITS_TBL",sizeof(wchar_t)*18) ) { LEN_EXTRA_BITS_TBL=inValue.Cast<Array<int > >();return inValue; }
		break;
	case 19:
		if (!memcmp(inName.__s,L"DIST_EXTRA_BITS_TBL",sizeof(wchar_t)*19) ) { DIST_EXTRA_BITS_TBL=inValue.Cast<Array<int > >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void InflateImpl_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"nbits",5));
	outFields->push(STRING(L"bits",4));
	outFields->push(STRING(L"state",5));
	outFields->push(STRING(L"final",5));
	outFields->push(STRING(L"huffman",7));
	outFields->push(STRING(L"huffdist",8));
	outFields->push(STRING(L"htools",6));
	outFields->push(STRING(L"len",3));
	outFields->push(STRING(L"dist",4));
	outFields->push(STRING(L"needed",6));
	outFields->push(STRING(L"output",6));
	outFields->push(STRING(L"outpos",6));
	outFields->push(STRING(L"input",5));
	outFields->push(STRING(L"lengths",7));
	outFields->push(STRING(L"window",6));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"LEN_EXTRA_BITS_TBL",18),
	STRING(L"LEN_BASE_VAL_TBL",16),
	STRING(L"DIST_EXTRA_BITS_TBL",19),
	STRING(L"DIST_BASE_VAL_TBL",17),
	STRING(L"CODE_LENGTHS_POS",16),
	STRING(L"FIXED_HUFFMAN",13),
	STRING(L"run",3),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"nbits",5),
	STRING(L"bits",4),
	STRING(L"state",5),
	STRING(L"final",5),
	STRING(L"huffman",7),
	STRING(L"huffdist",8),
	STRING(L"htools",6),
	STRING(L"len",3),
	STRING(L"dist",4),
	STRING(L"needed",6),
	STRING(L"output",6),
	STRING(L"outpos",6),
	STRING(L"input",5),
	STRING(L"lengths",7),
	STRING(L"window",6),
	STRING(L"buildFixedHuffman",17),
	STRING(L"readBytes",9),
	STRING(L"getBits",7),
	STRING(L"getBit",6),
	STRING(L"getRevBits",10),
	STRING(L"resetBits",9),
	STRING(L"addBytes",8),
	STRING(L"addByte",7),
	STRING(L"addDistOne",10),
	STRING(L"addDist",7),
	STRING(L"applyHuffman",12),
	STRING(L"inflateLengths",14),
	STRING(L"inflateLoop",11),
	String(null()) };

static void sMarkStatics() {
	MarkMember(InflateImpl_obj::LEN_EXTRA_BITS_TBL);
	MarkMember(InflateImpl_obj::LEN_BASE_VAL_TBL);
	MarkMember(InflateImpl_obj::DIST_EXTRA_BITS_TBL);
	MarkMember(InflateImpl_obj::DIST_BASE_VAL_TBL);
	MarkMember(InflateImpl_obj::CODE_LENGTHS_POS);
	MarkMember(InflateImpl_obj::FIXED_HUFFMAN);
};

Class InflateImpl_obj::__mClass;

void InflateImpl_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.tools.InflateImpl",24), TCanCast<InflateImpl_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void InflateImpl_obj::__boot()
{
	Static(LEN_EXTRA_BITS_TBL) = Array_obj<int >::__new().Add(0).Add(0).Add(0).Add(0).Add(0).Add(0).Add(0).Add(0).Add(1).Add(1).Add(1).Add(1).Add(2).Add(2).Add(2).Add(2).Add(3).Add(3).Add(3).Add(3).Add(4).Add(4).Add(4).Add(4).Add(5).Add(5).Add(5).Add(5).Add(0).Add(-1).Add(-1);
	Static(LEN_BASE_VAL_TBL) = Array_obj<int >::__new().Add(3).Add(4).Add(5).Add(6).Add(7).Add(8).Add(9).Add(10).Add(11).Add(13).Add(15).Add(17).Add(19).Add(23).Add(27).Add(31).Add(35).Add(43).Add(51).Add(59).Add(67).Add(83).Add(99).Add(115).Add(131).Add(163).Add(195).Add(227).Add(258);
	Static(DIST_EXTRA_BITS_TBL) = Array_obj<int >::__new().Add(0).Add(0).Add(0).Add(0).Add(1).Add(1).Add(2).Add(2).Add(3).Add(3).Add(4).Add(4).Add(5).Add(5).Add(6).Add(6).Add(7).Add(7).Add(8).Add(8).Add(9).Add(9).Add(10).Add(10).Add(11).Add(11).Add(12).Add(12).Add(13).Add(13).Add(-1).Add(-1);
	Static(DIST_BASE_VAL_TBL) = Array_obj<int >::__new().Add(1).Add(2).Add(3).Add(4).Add(5).Add(7).Add(9).Add(13).Add(17).Add(25).Add(33).Add(49).Add(65).Add(97).Add(129).Add(193).Add(257).Add(385).Add(513).Add(769).Add(1025).Add(1537).Add(2049).Add(3073).Add(4097).Add(6145).Add(8193).Add(12289).Add(16385).Add(24577);
	Static(CODE_LENGTHS_POS) = Array_obj<int >::__new().Add(16).Add(17).Add(18).Add(0).Add(8).Add(7).Add(9).Add(6).Add(10).Add(5).Add(11).Add(4).Add(12).Add(3).Add(13).Add(2).Add(14).Add(1).Add(15);
	Static(FIXED_HUFFMAN) = null();
}

} // end namespace format
} // end namespace tools
