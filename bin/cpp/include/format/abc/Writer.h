#ifndef INCLUDED_format_abc_Writer
#define INCLUDED_format_abc_Writer

#include <hxObject.h>

DECLARE_CLASS2(format,abc,ABCData)
DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,Name)
DECLARE_CLASS2(format,abc,Namespace)
DECLARE_CLASS2(format,abc,OpWriter)
DECLARE_CLASS2(format,abc,Value)
DECLARE_CLASS2(format,abc,Writer)
DECLARE_CLASS2(haxe,io,Output)
namespace format{
namespace abc{


class Writer_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Writer_obj OBJ_;

	protected:
		Writer_obj();
		Void __construct(haxe::io::Output o);

	public:
		static hxObjectPtr<Writer_obj > __new(haxe::io::Output o);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Writer_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Writer",6); }

		haxe::io::Output o;
		format::abc::OpWriter opw;
		virtual Void beginTag( int id,int len);
		Dynamic beginTag_dyn();

		virtual Void writeInt( int n);
		Dynamic writeInt_dyn();

		virtual Void writeUInt( int n);
		Dynamic writeUInt_dyn();

		virtual Void writeList( Array<Dynamic > a,Dynamic write);
		Dynamic writeList_dyn();

		virtual Void writeList2( Array<Dynamic > a,Dynamic write);
		Dynamic writeList2_dyn();

		virtual Void writeString( String s);
		Dynamic writeString_dyn();

		virtual Void writeIndex( format::abc::Index i);
		Dynamic writeIndex_dyn();

		virtual Void writeIndexOpt( format::abc::Index i);
		Dynamic writeIndexOpt_dyn();

		virtual Void writeNamespace( format::abc::Namespace n);
		Dynamic writeNamespace_dyn();

		virtual Void writeNsSet( Array<format::abc::Index > n);
		Dynamic writeNsSet_dyn();

		virtual Void writeNameByte( int k,int n);
		Dynamic writeNameByte_dyn();

		virtual Void writeName( Dynamic k,format::abc::Name n);
		Dynamic writeName_dyn();

		virtual Void writeValue( bool extra,format::abc::Value v);
		Dynamic writeValue_dyn();

		virtual Void writeField( Dynamic f);
		Dynamic writeField_dyn();

		virtual Void writeMethodType( Dynamic m);
		Dynamic writeMethodType_dyn();

		virtual Void writeMetadata( Dynamic m);
		Dynamic writeMetadata_dyn();

		virtual Void writeClass( Dynamic c);
		Dynamic writeClass_dyn();

		virtual Void writeInit( Dynamic i);
		Dynamic writeInit_dyn();

		virtual Void writeTryCatch( Dynamic t);
		Dynamic writeTryCatch_dyn();

		virtual Void writeFunction( Dynamic f);
		Dynamic writeFunction_dyn();

		virtual Void writeABC( format::abc::ABCData d);
		Dynamic writeABC_dyn();

		static Void write( haxe::io::Output out,format::abc::ABCData data);
		static Dynamic write_dyn();

};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_Writer */ 
