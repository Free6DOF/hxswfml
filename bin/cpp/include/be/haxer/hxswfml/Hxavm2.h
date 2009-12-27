#ifndef INCLUDED_be_haxer_hxswfml_Hxavm2
#define INCLUDED_be_haxer_hxswfml_Hxavm2

#include <hxObject.h>

DECLARE_CLASS0(Hash)
DECLARE_CLASS3(be,haxer,hxswfml,Hxavm2)
DECLARE_CLASS1(cpp,CppXml__)
DECLARE_CLASS2(format,abc,Context)
DECLARE_CLASS2(format,abc,FieldKind)
DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,OpCode)
DECLARE_CLASS2(format,swf,SWFTag)
namespace be{
namespace haxer{
namespace hxswfml{


class Hxavm2_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Hxavm2_obj OBJ_;

	protected:
		Hxavm2_obj();
		Void __construct();

	public:
		static hxObjectPtr<Hxavm2_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Hxavm2_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Hxavm2",6); }

		bool log;
		bool throwsErrors;
		String name;
		format::abc::Context ctx;
		String className;
		String curClassName;
		Dynamic curClass;
		int maxStack;
		int maxScopeStack;
		int currentStack;
		int currentScopeStack;
		Hash imports;
		Hash functionClosures;
		Hash inits;
		Hash classDefs;
		Hash jumps;
		Hash labels;
		virtual Array<format::swf::SWFTag > xml2abc( String xml);
		Dynamic xml2abc_dyn();

		virtual format::swf::SWFTag xmlToabc( cpp::CppXml__ xml);
		Dynamic xmlToabc_dyn();

		virtual Dynamic createFunction( cpp::CppXml__ node,String functionType,Dynamic isInterface);
		Dynamic createFunction_dyn();

		virtual bool writeCodeBlock( cpp::CppXml__ member,Dynamic f);
		Dynamic writeCodeBlock_dyn();

		virtual String abc2xml( Dynamic abc);
		Dynamic abc2xml_dyn();

		virtual String getImport( String name);
		Dynamic getImport_dyn();

		virtual format::abc::Index namespaceType( String ns);
		Dynamic namespaceType_dyn();

		virtual String getAnyAttribute( Dynamic element,Array<String > arr);
		Dynamic getAnyAttribute_dyn();

		virtual Array<Dynamic > parseLocals( String locals);
		Dynamic parseLocals_dyn();

		virtual format::abc::FieldKind parseFieldKind( String fld);
		Dynamic parseFieldKind_dyn();

		virtual Void nonEmptyStack( String fname);
		Dynamic nonEmptyStack_dyn();

		virtual Void stackError( format::abc::OpCode op,int type);
		Dynamic stackError_dyn();

		virtual Void scopeStackError( format::abc::OpCode op,int type);
		Dynamic scopeStackError_dyn();

		virtual Void logStack( Dynamic msg);
		Dynamic logStack_dyn();

		virtual Void updateStacks( format::abc::OpCode opc);
		Dynamic updateStacks_dyn();

};

} // end namespace be
} // end namespace haxer
} // end namespace hxswfml

#endif /* INCLUDED_be_haxer_hxswfml_Hxavm2 */ 
