#ifndef INCLUDED_be_haxer_hxswfml_Hxvml
#define INCLUDED_be_haxer_hxswfml_Hxvml

#include <hxObject.h>

DECLARE_CLASS3(be,haxer,hxswfml,Hxvml)
DECLARE_CLASS2(format,abc,ABCData)
DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,Name)
DECLARE_CLASS2(format,abc,OpCode)
DECLARE_CLASS2(format,abc,Value)
DECLARE_CLASS2(haxe,io,Bytes)
namespace be{
namespace haxer{
namespace hxswfml{


class Hxvml_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Hxvml_obj OBJ_;

	protected:
		Hxvml_obj();
		Void __construct();

	public:
		static hxObjectPtr<Hxvml_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Hxvml_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Hxvml",5); }

		format::abc::ABCData abcFile;
		String xml;
		int indentLevel;
		Array<String > functionClosures;
		String className;
		virtual String abc2xml( String fileName);
		Dynamic abc2xml_dyn();

		virtual String abcToXml( haxe::io::Bytes data);
		Dynamic abcToXml_dyn();

		virtual Void decodeToXML( Array<format::abc::OpCode > ops,Dynamic f);
		Dynamic decodeToXML_dyn();

		virtual String createFunctionClosure( format::abc::Index f);
		Dynamic createFunctionClosure_dyn();

		virtual String parseMethodExtra( Dynamic extra);
		Dynamic parseMethodExtra_dyn();

		virtual String parseLocals( Array<Dynamic > locals);
		Dynamic parseLocals_dyn();

		virtual String indent( );
		Dynamic indent_dyn();

		virtual String getString( format::abc::Index id);
		Dynamic getString_dyn();

		virtual String getInt( format::abc::Index id);
		Dynamic getInt_dyn();

		virtual String getUInt( format::abc::Index id);
		Dynamic getUInt_dyn();

		virtual String getFloat( format::abc::Index id);
		Dynamic getFloat_dyn();

		virtual String getNamespace( format::abc::Index id);
		Dynamic getNamespace_dyn();

		virtual String getName( format::abc::Index id);
		Dynamic getName_dyn();

		virtual String getNameType( format::abc::Name name);
		Dynamic getNameType_dyn();

		virtual String getFieldName( format::abc::Index id);
		Dynamic getFieldName_dyn();

		virtual Dynamic getMethod( format::abc::Index id);
		Dynamic getMethod_dyn();

		virtual Dynamic getClass( format::abc::Index id);
		Dynamic getClass_dyn();

		virtual String cutComma( String str);
		Dynamic cutComma_dyn();

		virtual String getValue( format::abc::Value value);
		Dynamic getValue_dyn();

		virtual String getAnyAttribute( Dynamic element,Array<String > arr);
		Dynamic getAnyAttribute_dyn();

};

} // end namespace be
} // end namespace haxer
} // end namespace hxswfml

#endif /* INCLUDED_be_haxer_hxswfml_Hxvml */ 
