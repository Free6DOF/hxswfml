#include <hxObject.h>

#ifndef INCLUDED_List
#include <List.h>
#endif
#ifndef INCLUDED_cpp_CppDate__
#include <cpp/CppDate__.h>
#endif
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_format_tools_CRC32
#include <format/tools/CRC32.h>
#endif
#ifndef INCLUDED_format_tools_IO
#include <format/tools/IO.h>
#endif
#ifndef INCLUDED_format_zip_ExtraField
#include <format/zip/ExtraField.h>
#endif
#ifndef INCLUDED_format_zip_Writer
#include <format/zip/Writer.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesOutput
#include <haxe/io/BytesOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace format{
namespace zip{

Void Writer_obj::__construct(haxe::io::Output o)
{
{
	this->o = o;
	this->files = List_obj::__new();
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

Void Writer_obj::writeZipDate( cpp::CppDate__ date){
{
		int hour = date->getHours();
		int min = date->getMinutes();
		int sec = int(date->getSeconds()) >> int(1);
		this->o->writeUInt16(int(int((int(hour) << int(11))) | int((int(min) << int(5)))) | int(sec));
		int year = date->getFullYear() - 1980;
		int month = date->getMonth() + 1;
		int day = date->getDate();
		this->o->writeUInt16(int(int((int(year) << int(9))) | int((int(month) << int(5)))) | int(day));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeZipDate,(void))

Void Writer_obj::writeEntryHeader( Dynamic f){
{
		haxe::io::Output o = this->o;
		o->writeUInt30(67324752);
		o->writeUInt16(20);
		o->writeUInt16(0);
		if (f->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >() == null()){
			f.FieldRef(STRING(L"fileSize",8)) = 0;
			f.FieldRef(STRING(L"dataSize",8)) = 0;
			f.FieldRef(STRING(L"crc32",5)) = cpp::CppInt32___obj::ofInt(0);
			f.FieldRef(STRING(L"compressed",10)) = false;
			f.FieldRef(STRING(L"data",4)) = haxe::io::Bytes_obj::alloc(0);
		}
		else{
			if (f->__Field(STRING(L"crc32",5)) == null()){
				if (f->__Field(STRING(L"compressed",10)).Cast<bool >())
					hxThrow (STRING(L"CRC32 must be processed before compression",42));
				f.FieldRef(STRING(L"crc32",5)) = format::tools::CRC32_obj::encode(f->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >());
			}
			if (!f.FieldRef(STRING(L"compressed",10)))
				f.FieldRef(STRING(L"fileSize",8)) = f->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >()->length;
			f.FieldRef(STRING(L"dataSize",8)) = f->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >()->length;
		}
		o->writeUInt16(f->__Field(STRING(L"compressed",10)).Cast<bool >() ? int( 8 ) : int( 0 ));
		this->writeZipDate(f->__Field(STRING(L"fileTime",8)).Cast<cpp::CppDate__ >());
		o->writeInt32(f->__Field(STRING(L"crc32",5)));
		o->writeUInt30(f->__Field(STRING(L"dataSize",8)).Cast<int >());
		o->writeUInt30(f->__Field(STRING(L"fileSize",8)).Cast<int >());
		o->writeUInt16(f->__Field(STRING(L"fileName",8)).Cast<String >().length);
		haxe::io::BytesOutput e = haxe::io::BytesOutput_obj::__new();
		if (f->__Field(STRING(L"extraFields",11)).Cast<List >() != null()){
			for(Dynamic __it = f->__Field(STRING(L"extraFields",11)).Cast<List >()->iterator();  __it->__Field(STRING(L"hasNext",7))(); ){
format::zip::ExtraField f1 = __it->__Field(STRING(L"next",4))();
				{
					format::zip::ExtraField _switch_1 = (f1);
					switch((_switch_1)->GetIndex()){
						case 1: {
							cpp::CppInt32__ crc = _switch_1->__Param(1);
							String name = _switch_1->__Param(0);
{
								haxe::io::Bytes namebytes = haxe::io::Bytes_obj::ofString(name);
								e->writeUInt16(28789);
								e->writeUInt16(namebytes->length + 5);
								e->writeByte(1);
								e->writeInt32(crc);
								e->write(namebytes);
							}
						}
						break;
						case 0: {
							haxe::io::Bytes bytes = _switch_1->__Param(1);
							int tag = _switch_1->__Param(0);
{
								e->writeUInt16(tag);
								e->writeUInt16(bytes->length);
								e->write(bytes);
							}
						}
						break;
					}
				}
;
			}
		}
		haxe::io::Bytes ebytes = e->getBytes();
		o->writeUInt16(ebytes->length);
		o->writeString(f->__Field(STRING(L"fileName",8)).Cast<String >());
		o->write(ebytes);
		this->files->add(hxAnon_obj::Create()->Add( STRING(L"name",4) , f->__Field(STRING(L"fileName",8)).Cast<String >())->Add( STRING(L"compressed",10) , f->__Field(STRING(L"compressed",10)).Cast<bool >())->Add( STRING(L"clen",4) , f->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >()->length)->Add( STRING(L"size",4) , f->__Field(STRING(L"fileSize",8)).Cast<int >())->Add( STRING(L"crc",3) , f->__Field(STRING(L"crc32",5)))->Add( STRING(L"date",4) , f->__Field(STRING(L"fileTime",8)).Cast<cpp::CppDate__ >())->Add( STRING(L"fields",6) , ebytes));
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeEntryHeader,(void))

Void Writer_obj::writeEntryData( Dynamic e,haxe::io::Bytes buf,haxe::io::Input data){
{
		format::tools::IO_obj::copy(data,this->o,buf,e->__Field(STRING(L"dataSize",8)).Cast<int >());
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(Writer_obj,writeEntryData,(void))

Void Writer_obj::writeData( List files){
{
		for(Dynamic __it = files->iterator();  __it->__Field(STRING(L"hasNext",7))(); ){
Dynamic f = __it->__Field(STRING(L"next",4))();
			{
				this->writeEntryHeader(f);
				this->o->writeFullBytes(f->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >(),0,f->__Field(STRING(L"data",4)).Cast<haxe::io::Bytes >()->length);
			}
;
		}
		this->writeCDR();
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(Writer_obj,writeData,(void))

Void Writer_obj::writeCDR( ){
{
		int cdr_size = 0;
		int cdr_offset = 0;
		for(Dynamic __it = this->files->iterator();  __it->__Field(STRING(L"hasNext",7))(); ){
Dynamic f = __it->__Field(STRING(L"next",4))();
			{
				int namelen = f->__Field(STRING(L"name",4)).Cast<String >().length;
				int extraFieldsLength = f->__Field(STRING(L"fields",6)).Cast<haxe::io::Bytes >()->length;
				this->o->writeUInt30(33639248);
				this->o->writeUInt16(20);
				this->o->writeUInt16(20);
				this->o->writeUInt16(0);
				this->o->writeUInt16(f->__Field(STRING(L"compressed",10)).Cast<bool >() ? int( 8 ) : int( 0 ));
				this->writeZipDate(f->__Field(STRING(L"date",4)).Cast<cpp::CppDate__ >());
				this->o->writeInt32(f->__Field(STRING(L"crc",3)).Cast<cpp::CppInt32__ >());
				this->o->writeUInt30(f->__Field(STRING(L"clen",4)).Cast<int >());
				this->o->writeUInt30(f->__Field(STRING(L"size",4)).Cast<int >());
				this->o->writeUInt16(namelen);
				this->o->writeUInt16(extraFieldsLength);
				this->o->writeUInt16(0);
				this->o->writeUInt16(0);
				this->o->writeUInt16(0);
				this->o->writeUInt30(0);
				this->o->writeUInt30(cdr_offset);
				this->o->writeString(f->__Field(STRING(L"name",4)).Cast<String >());
				this->o->write(f->__Field(STRING(L"fields",6)).Cast<haxe::io::Bytes >());
				hxAddEq(cdr_size,46 + namelen + extraFieldsLength);
				hxAddEq(cdr_offset,30 + namelen + extraFieldsLength + f->__Field(STRING(L"clen",4)).Cast<int >());
			}
;
		}
		this->o->writeUInt30(101010256);
		this->o->writeUInt16(0);
		this->o->writeUInt16(0);
		this->o->writeUInt16(this->files->length);
		this->o->writeUInt16(this->files->length);
		this->o->writeUInt30(cdr_size);
		this->o->writeUInt30(cdr_offset);
		this->o->writeUInt16(0);
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(Writer_obj,writeCDR,(void))

int Writer_obj::CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE;

int Writer_obj::LOCAL_FILE_HEADER_FIELDS_SIZE;


Writer_obj::Writer_obj()
{
	InitMember(o);
	InitMember(files);
}

void Writer_obj::__Mark()
{
	MarkMember(o);
	MarkMember(files);
}

Dynamic Writer_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { return o; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"files",sizeof(wchar_t)*5) ) { return files; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"writeCDR",sizeof(wchar_t)*8) ) { return writeCDR_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"writeData",sizeof(wchar_t)*9) ) { return writeData_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"writeZipDate",sizeof(wchar_t)*12) ) { return writeZipDate_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"writeEntryData",sizeof(wchar_t)*14) ) { return writeEntryData_dyn(); }
		break;
	case 16:
		if (!memcmp(inName.__s,L"writeEntryHeader",sizeof(wchar_t)*16) ) { return writeEntryHeader_dyn(); }
		break;
	case 29:
		if (!memcmp(inName.__s,L"LOCAL_FILE_HEADER_FIELDS_SIZE",sizeof(wchar_t)*29) ) { return LOCAL_FILE_HEADER_FIELDS_SIZE; }
		break;
	case 36:
		if (!memcmp(inName.__s,L"CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE",sizeof(wchar_t)*36) ) { return CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE; }
	}
	return super::__Field(inName);
}

static int __id_CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE = __hxcpp_field_to_id("CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE");
static int __id_LOCAL_FILE_HEADER_FIELDS_SIZE = __hxcpp_field_to_id("LOCAL_FILE_HEADER_FIELDS_SIZE");
static int __id_o = __hxcpp_field_to_id("o");
static int __id_files = __hxcpp_field_to_id("files");
static int __id_writeZipDate = __hxcpp_field_to_id("writeZipDate");
static int __id_writeEntryHeader = __hxcpp_field_to_id("writeEntryHeader");
static int __id_writeEntryData = __hxcpp_field_to_id("writeEntryData");
static int __id_writeData = __hxcpp_field_to_id("writeData");
static int __id_writeCDR = __hxcpp_field_to_id("writeCDR");


Dynamic Writer_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE) return CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE;
	if (inFieldID==__id_LOCAL_FILE_HEADER_FIELDS_SIZE) return LOCAL_FILE_HEADER_FIELDS_SIZE;
	if (inFieldID==__id_o) return o;
	if (inFieldID==__id_files) return files;
	if (inFieldID==__id_writeZipDate) return writeZipDate_dyn();
	if (inFieldID==__id_writeEntryHeader) return writeEntryHeader_dyn();
	if (inFieldID==__id_writeEntryData) return writeEntryData_dyn();
	if (inFieldID==__id_writeData) return writeData_dyn();
	if (inFieldID==__id_writeCDR) return writeCDR_dyn();
	return super::__IField(inFieldID);
}

Dynamic Writer_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 1:
		if (!memcmp(inName.__s,L"o",sizeof(wchar_t)*1) ) { o=inValue.Cast<haxe::io::Output >();return inValue; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"files",sizeof(wchar_t)*5) ) { files=inValue.Cast<List >();return inValue; }
		break;
	case 29:
		if (!memcmp(inName.__s,L"LOCAL_FILE_HEADER_FIELDS_SIZE",sizeof(wchar_t)*29) ) { LOCAL_FILE_HEADER_FIELDS_SIZE=inValue.Cast<int >();return inValue; }
		break;
	case 36:
		if (!memcmp(inName.__s,L"CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE",sizeof(wchar_t)*36) ) { CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Writer_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"o",1));
	outFields->push(STRING(L"files",5));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE",36),
	STRING(L"LOCAL_FILE_HEADER_FIELDS_SIZE",29),
	String(null()) };

static String sMemberFields[] = {
	STRING(L"o",1),
	STRING(L"files",5),
	STRING(L"writeZipDate",12),
	STRING(L"writeEntryHeader",16),
	STRING(L"writeEntryData",14),
	STRING(L"writeData",9),
	STRING(L"writeCDR",8),
	String(null()) };

static void sMarkStatics() {
	MarkMember(Writer_obj::CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE);
	MarkMember(Writer_obj::LOCAL_FILE_HEADER_FIELDS_SIZE);
};

Class Writer_obj::__mClass;

void Writer_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.zip.Writer",17), TCanCast<Writer_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Writer_obj::__boot()
{
	Static(CENTRAL_DIRECTORY_RECORD_FIELDS_SIZE) = 46;
	Static(LOCAL_FILE_HEADER_FIELDS_SIZE) = 30;
}

} // end namespace format
} // end namespace zip
