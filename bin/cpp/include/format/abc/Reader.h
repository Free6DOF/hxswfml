#ifndef INCLUDED_format_abc_Reader
#define INCLUDED_format_abc_Reader

#include <hxObject.h>

DECLARE_CLASS2(format,abc,ABCData)
DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,Name)
DECLARE_CLASS2(format,abc,Namespace)
DECLARE_CLASS2(format,abc,OpReader)
DECLARE_CLASS2(format,abc,Reader)
DECLARE_CLASS2(format,abc,Value)
DECLARE_CLASS2(haxe,io,Input)
namespace format{
namespace abc{


class Reader_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Reader_obj OBJ_;

	protected:
		Reader_obj();
		Void __construct(haxe::io::Input i);

	public:
		static hxObjectPtr<Reader_obj > __new(haxe::io::Input i);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Reader_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Reader",6); }

		haxe::io::Input i;
		format::abc::OpReader opr;
		virtual int readInt( );
		Dynamic readInt_dyn();

		virtual format::abc::Index readIndex( );
		Dynamic readIndex_dyn();

		virtual format::abc::Index readIndexOpt( );
		Dynamic readIndexOpt_dyn();

		virtual Array<Dynamic > readList( Dynamic f);
		Dynamic readList_dyn();

		virtual Array<Dynamic > readList2( Dynamic f);
		Dynamic readList2_dyn();

		virtual String readString( );
		Dynamic readString_dyn();

		virtual format::abc::Namespace readNamespace( );
		Dynamic readNamespace_dyn();

		virtual Array<format::abc::Index > readNsSet( );
		Dynamic readNsSet_dyn();

		virtual format::abc::Name readName( Dynamic k);
		Dynamic readName_dyn();

		virtual format::abc::Value readValue( bool extra);
		Dynamic readValue_dyn();

		virtual Dynamic readMethodType( );
		Dynamic readMethodType_dyn();

		virtual Dynamic readMetadata( );
		Dynamic readMetadata_dyn();

		virtual Dynamic readField( );
		Dynamic readField_dyn();

		virtual Dynamic readClass( );
		Dynamic readClass_dyn();

		virtual Dynamic readInit( );
		Dynamic readInit_dyn();

		virtual Dynamic readTryCatch( );
		Dynamic readTryCatch_dyn();

		virtual Dynamic readFunction( );
		Dynamic readFunction_dyn();

		virtual format::abc::ABCData read( );
		Dynamic read_dyn();

};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_Reader */ 
