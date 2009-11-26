#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
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
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace haxe{
namespace io{

Void Output_obj::__construct()
{
	return null();
}

Output_obj::~Output_obj() { }

Dynamic Output_obj::__CreateEmpty() { return  new Output_obj; }
hxObjectPtr<Output_obj > Output_obj::__new()
{  hxObjectPtr<Output_obj > result = new Output_obj();
	result->__construct();
	return result;}

Dynamic Output_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Output_obj > result = new Output_obj();
	result->__construct();
	return result;}

Void Output_obj::writeByte( int c){
{
		hxThrow (STRING(L"Not implemented",15));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeByte,(void))

int Output_obj::writeBytes( haxe::io::Bytes s,int pos,int len){
	int k = len;
	Array<unsigned char > b = s->b;
	if (bool(pos < 0) || bool(bool(len < 0) || bool(pos + len > s->length)))
		hxThrow (haxe::io::Error_obj::OutsideBounds);
	while(k > 0){
		this->writeByte(b->__get(pos));
		pos++;
		k--;
	}
	return len;
}


DEFINE_DYNAMIC_FUNC3(Output_obj,writeBytes,return )

Void Output_obj::flush( ){
{
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Output_obj,flush,(void))

Void Output_obj::close( ){
{
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Output_obj,close,(void))

bool Output_obj::setEndian( bool b){
	this->bigEndian = b;
	return b;
}


DEFINE_DYNAMIC_FUNC1(Output_obj,setEndian,return )

Void Output_obj::write( haxe::io::Bytes s){
{
		int l = s->length;
		int p = 0;
		while(l > 0){
			int k = this->writeBytes(s,p,l);
			if (k == 0)
				hxThrow (haxe::io::Error_obj::Blocked);
			hxAddEq(p,k);
			hxSubEq(l,k);
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,write,(void))

Void Output_obj::writeFullBytes( haxe::io::Bytes s,int pos,int len){
{
		while(len > 0){
			int k = this->writeBytes(s,pos,len);
			hxAddEq(pos,k);
			hxSubEq(len,k);
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(Output_obj,writeFullBytes,(void))

Void Output_obj::writeFloat( double x){
{
		this->write(haxe::io::Bytes_obj::ofData(haxe::io::Output_obj::_float_bytes(x,this->bigEndian)));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeFloat,(void))

Void Output_obj::writeDouble( double x){
{
		this->write(haxe::io::Bytes_obj::ofData(haxe::io::Output_obj::_double_bytes(x,this->bigEndian)));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeDouble,(void))

Void Output_obj::writeInt8( int x){
{
		if (bool(x < -128) || bool(x >= 128))
			hxThrow (haxe::io::Error_obj::Overflow);
		this->writeByte(int(x) & int(255));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeInt8,(void))

Void Output_obj::writeInt16( int x){
{
		if (bool(x < -32768) || bool(x >= 32768))
			hxThrow (haxe::io::Error_obj::Overflow);
		this->writeUInt16(int(x) & int(65535));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeInt16,(void))

Void Output_obj::writeUInt16( int x){
{
		if (bool(x < 0) || bool(x >= 65536))
			hxThrow (haxe::io::Error_obj::Overflow);
		if (this->bigEndian){
			this->writeByte(int(x) >> int(8));
			this->writeByte(int(x) & int(255));
		}
		else{
			this->writeByte(int(x) & int(255));
			this->writeByte(int(x) >> int(8));
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeUInt16,(void))

Void Output_obj::writeInt24( int x){
{
		if (bool(x < -8388608) || bool(x >= 8388608))
			hxThrow (haxe::io::Error_obj::Overflow);
		this->writeUInt24(int(x) & int(16777215));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeInt24,(void))

Void Output_obj::writeUInt24( int x){
{
		if (bool(x < 0) || bool(x >= 16777216))
			hxThrow (haxe::io::Error_obj::Overflow);
		if (this->bigEndian){
			this->writeByte(int(x) >> int(16));
			this->writeByte(int((int(x) >> int(8))) & int(255));
			this->writeByte(int(x) & int(255));
		}
		else{
			this->writeByte(int(x) & int(255));
			this->writeByte(int((int(x) >> int(8))) & int(255));
			this->writeByte(int(x) >> int(16));
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeUInt24,(void))

Void Output_obj::writeInt31( int x){
{
		if (bool(x < -1073741824) || bool(x >= 1073741824))
			hxThrow (haxe::io::Error_obj::Overflow);
		if (this->bigEndian){
			this->writeByte(hxUShr(x,24));
			this->writeByte(int((int(x) >> int(16))) & int(255));
			this->writeByte(int((int(x) >> int(8))) & int(255));
			this->writeByte(int(x) & int(255));
		}
		else{
			this->writeByte(int(x) & int(255));
			this->writeByte(int((int(x) >> int(8))) & int(255));
			this->writeByte(int((int(x) >> int(16))) & int(255));
			this->writeByte(hxUShr(x,24));
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeInt31,(void))

Void Output_obj::writeUInt30( int x){
{
		if (bool(x < 0) || bool(x >= 1073741824))
			hxThrow (haxe::io::Error_obj::Overflow);
		if (this->bigEndian){
			this->writeByte(hxUShr(x,24));
			this->writeByte(int((int(x) >> int(16))) & int(255));
			this->writeByte(int((int(x) >> int(8))) & int(255));
			this->writeByte(int(x) & int(255));
		}
		else{
			this->writeByte(int(x) & int(255));
			this->writeByte(int((int(x) >> int(8))) & int(255));
			this->writeByte(int((int(x) >> int(16))) & int(255));
			this->writeByte(hxUShr(x,24));
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeUInt30,(void))

Void Output_obj::writeInt32( cpp::CppInt32__ x){
{
		if (this->bigEndian){
			this->writeByte(cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::ushr(x,24)));
			this->writeByte(int(cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::ushr(x,16))) & int(255));
			this->writeByte(int(cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::ushr(x,8))) & int(255));
			this->writeByte(cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::_and(x,cpp::CppInt32___obj::ofInt(255))));
		}
		else{
			this->writeByte(cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::_and(x,cpp::CppInt32___obj::ofInt(255))));
			this->writeByte(int(cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::ushr(x,8))) & int(255));
			this->writeByte(int(cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::ushr(x,16))) & int(255));
			this->writeByte(cpp::CppInt32___obj::toInt(cpp::CppInt32___obj::ushr(x,24)));
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeInt32,(void))

Void Output_obj::prepare( int nbytes){
{
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,prepare,(void))

Void Output_obj::writeInput( haxe::io::Input i,Dynamic bufsize){
{
		if (bufsize == null())
			bufsize = 4096;
		haxe::io::Bytes buf = haxe::io::Bytes_obj::alloc(bufsize);
		try{
			while(true){
				int len = i->readBytes(buf,0,bufsize);
				if (len == 0)
					hxThrow (haxe::io::Error_obj::Blocked);
				int p = 0;
				while(len > 0){
					int k = this->writeBytes(buf,p,len);
					if (k == 0)
						hxThrow (haxe::io::Error_obj::Blocked);
					hxAddEq(p,k);
					hxSubEq(len,k);
				}
			}
		}
		catch(Dynamic __e){
			if (__e.IsClass<haxe::io::Eof >() ){
				haxe::io::Eof e = __e;{
				}
			}
			else throw(__e);
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(Output_obj,writeInput,(void))

Void Output_obj::writeString( String s){
{
		haxe::io::Bytes b = haxe::io::Bytes_obj::ofString(s);
		this->writeFullBytes(b,0,b->length);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Output_obj,writeString,(void))

Dynamic Output_obj::_float_bytes;

Dynamic Output_obj::_double_bytes;


Output_obj::Output_obj()
{
	InitMember(bigEndian);
}

void Output_obj::__Mark()
{
	MarkMember(bigEndian);
}

Dynamic Output_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"flush",sizeof(wchar_t)*5) ) { return flush_dyn(); }
		if (!memcmp(inName.__s,L"close",sizeof(wchar_t)*5) ) { return close_dyn(); }
		if (!memcmp(inName.__s,L"write",sizeof(wchar_t)*5) ) { return write_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"prepare",sizeof(wchar_t)*7) ) { return prepare_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"bigEndian",sizeof(wchar_t)*9) ) { return bigEndian; }
		if (!memcmp(inName.__s,L"writeByte",sizeof(wchar_t)*9) ) { return writeByte_dyn(); }
		if (!memcmp(inName.__s,L"setEndian",sizeof(wchar_t)*9) ) { return setEndian_dyn(); }
		if (!memcmp(inName.__s,L"writeInt8",sizeof(wchar_t)*9) ) { return writeInt8_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"writeBytes",sizeof(wchar_t)*10) ) { return writeBytes_dyn(); }
		if (!memcmp(inName.__s,L"writeFloat",sizeof(wchar_t)*10) ) { return writeFloat_dyn(); }
		if (!memcmp(inName.__s,L"writeInt16",sizeof(wchar_t)*10) ) { return writeInt16_dyn(); }
		if (!memcmp(inName.__s,L"writeInt24",sizeof(wchar_t)*10) ) { return writeInt24_dyn(); }
		if (!memcmp(inName.__s,L"writeInt31",sizeof(wchar_t)*10) ) { return writeInt31_dyn(); }
		if (!memcmp(inName.__s,L"writeInt32",sizeof(wchar_t)*10) ) { return writeInt32_dyn(); }
		if (!memcmp(inName.__s,L"writeInput",sizeof(wchar_t)*10) ) { return writeInput_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"writeDouble",sizeof(wchar_t)*11) ) { return writeDouble_dyn(); }
		if (!memcmp(inName.__s,L"writeUInt16",sizeof(wchar_t)*11) ) { return writeUInt16_dyn(); }
		if (!memcmp(inName.__s,L"writeUInt24",sizeof(wchar_t)*11) ) { return writeUInt24_dyn(); }
		if (!memcmp(inName.__s,L"writeUInt30",sizeof(wchar_t)*11) ) { return writeUInt30_dyn(); }
		if (!memcmp(inName.__s,L"writeString",sizeof(wchar_t)*11) ) { return writeString_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"_float_bytes",sizeof(wchar_t)*12) ) { return _float_bytes; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"_double_bytes",sizeof(wchar_t)*13) ) { return _double_bytes; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"writeFullBytes",sizeof(wchar_t)*14) ) { return writeFullBytes_dyn(); }
	}
	return super::__Field(inName);
}

static int __id__float_bytes = __hxcpp_field_to_id("_float_bytes");
static int __id__double_bytes = __hxcpp_field_to_id("_double_bytes");
static int __id_bigEndian = __hxcpp_field_to_id("bigEndian");
static int __id_writeByte = __hxcpp_field_to_id("writeByte");
static int __id_writeBytes = __hxcpp_field_to_id("writeBytes");
static int __id_flush = __hxcpp_field_to_id("flush");
static int __id_close = __hxcpp_field_to_id("close");
static int __id_setEndian = __hxcpp_field_to_id("setEndian");
static int __id_write = __hxcpp_field_to_id("write");
static int __id_writeFullBytes = __hxcpp_field_to_id("writeFullBytes");
static int __id_writeFloat = __hxcpp_field_to_id("writeFloat");
static int __id_writeDouble = __hxcpp_field_to_id("writeDouble");
static int __id_writeInt8 = __hxcpp_field_to_id("writeInt8");
static int __id_writeInt16 = __hxcpp_field_to_id("writeInt16");
static int __id_writeUInt16 = __hxcpp_field_to_id("writeUInt16");
static int __id_writeInt24 = __hxcpp_field_to_id("writeInt24");
static int __id_writeUInt24 = __hxcpp_field_to_id("writeUInt24");
static int __id_writeInt31 = __hxcpp_field_to_id("writeInt31");
static int __id_writeUInt30 = __hxcpp_field_to_id("writeUInt30");
static int __id_writeInt32 = __hxcpp_field_to_id("writeInt32");
static int __id_prepare = __hxcpp_field_to_id("prepare");
static int __id_writeInput = __hxcpp_field_to_id("writeInput");
static int __id_writeString = __hxcpp_field_to_id("writeString");


Dynamic Output_obj::__IField(int inFieldID)
{
	if (inFieldID==__id__float_bytes) return _float_bytes;
	if (inFieldID==__id__double_bytes) return _double_bytes;
	if (inFieldID==__id_bigEndian) return bigEndian;
	if (inFieldID==__id_writeByte) return writeByte_dyn();
	if (inFieldID==__id_writeBytes) return writeBytes_dyn();
	if (inFieldID==__id_flush) return flush_dyn();
	if (inFieldID==__id_close) return close_dyn();
	if (inFieldID==__id_setEndian) return setEndian_dyn();
	if (inFieldID==__id_write) return write_dyn();
	if (inFieldID==__id_writeFullBytes) return writeFullBytes_dyn();
	if (inFieldID==__id_writeFloat) return writeFloat_dyn();
	if (inFieldID==__id_writeDouble) return writeDouble_dyn();
	if (inFieldID==__id_writeInt8) return writeInt8_dyn();
	if (inFieldID==__id_writeInt16) return writeInt16_dyn();
	if (inFieldID==__id_writeUInt16) return writeUInt16_dyn();
	if (inFieldID==__id_writeInt24) return writeInt24_dyn();
	if (inFieldID==__id_writeUInt24) return writeUInt24_dyn();
	if (inFieldID==__id_writeInt31) return writeInt31_dyn();
	if (inFieldID==__id_writeUInt30) return writeUInt30_dyn();
	if (inFieldID==__id_writeInt32) return writeInt32_dyn();
	if (inFieldID==__id_prepare) return prepare_dyn();
	if (inFieldID==__id_writeInput) return writeInput_dyn();
	if (inFieldID==__id_writeString) return writeString_dyn();
	return super::__IField(inFieldID);
}

Dynamic Output_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 9:
		if (!memcmp(inName.__s,L"bigEndian",sizeof(wchar_t)*9) ) { bigEndian=inValue.Cast<bool >();return inValue; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"_float_bytes",sizeof(wchar_t)*12) ) { _float_bytes=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"_double_bytes",sizeof(wchar_t)*13) ) { _double_bytes=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Output_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"bigEndian",9));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"_float_bytes",12),
	STRING(L"_double_bytes",13),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"bigEndian",9),
	STRING(L"writeByte",9),
	STRING(L"writeBytes",10),
	STRING(L"flush",5),
	STRING(L"close",5),
	STRING(L"setEndian",9),
	STRING(L"write",5),
	STRING(L"writeFullBytes",14),
	STRING(L"writeFloat",10),
	STRING(L"writeDouble",11),
	STRING(L"writeInt8",9),
	STRING(L"writeInt16",10),
	STRING(L"writeUInt16",11),
	STRING(L"writeInt24",10),
	STRING(L"writeUInt24",11),
	STRING(L"writeInt31",10),
	STRING(L"writeUInt30",11),
	STRING(L"writeInt32",10),
	STRING(L"prepare",7),
	STRING(L"writeInput",10),
	STRING(L"writeString",11),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Output_obj::_float_bytes);
	MarkMember(Output_obj::_double_bytes);
};

Class Output_obj::__mClass;

void Output_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"haxe.io.Output",14), TCanCast<Output_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Output_obj::__boot()
{
	Static(_float_bytes) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"float_bytes",11),2);
	Static(_double_bytes) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"double_bytes",12),2);
}

} // end namespace haxe
} // end namespace io
