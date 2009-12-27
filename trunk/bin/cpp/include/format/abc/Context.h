#ifndef INCLUDED_format_abc_Context
#define INCLUDED_format_abc_Context

#include <hxObject.h>

DECLARE_CLASS0(Hash)
DECLARE_CLASS0(List)
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
DECLARE_CLASS2(format,abc,ABCData)
DECLARE_CLASS2(format,abc,Context)
DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,JumpStyle)
DECLARE_CLASS2(format,abc,MethodKind)
DECLARE_CLASS2(format,abc,Name)
DECLARE_CLASS2(format,abc,Namespace)
DECLARE_CLASS2(format,abc,OpCode)
DECLARE_CLASS2(format,abc,OpWriter)
DECLARE_CLASS2(format,abc,Value)
DECLARE_CLASS3(format,abc,_Context,NullOutput)
DECLARE_CLASS2(haxe,io,Output)
namespace format{
namespace abc{


class Context_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Context_obj OBJ_;

	protected:
		Context_obj();
		Void __construct();

	public:
		static hxObjectPtr<Context_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Context_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Context",7); }

		format::abc::ABCData data;
		Hash hstrings;
		Dynamic curClass;
		Dynamic curFunction;
		Array<Dynamic > classes;
		Dynamic init;
		int fieldSlot;
		Array<bool > registers;
		format::abc::_Context::NullOutput bytepos;
		format::abc::OpWriter opw;
		List classSupers;
		format::abc::Index emptyString;
		format::abc::Index nsPublic;
		format::abc::Index arrayProp;
		virtual format::abc::Index toInt( cpp::CppInt32__ i);
		Dynamic toInt_dyn();

		virtual format::abc::Index uint( cpp::CppInt32__ i);
		Dynamic uint_dyn();

		virtual format::abc::Index _float( double f);
		Dynamic _float_dyn();

		virtual format::abc::Index string( String s);
		Dynamic string_dyn();

		virtual format::abc::Index namespace( format::abc::Namespace n);
		Dynamic namespace_dyn();

		virtual format::abc::Index nsset( Array<format::abc::Index > ns);
		Dynamic nsset_dyn();

		virtual format::abc::Index name( format::abc::Name n);
		Dynamic name_dyn();

		virtual format::abc::Index getClass( Dynamic n);
		Dynamic getClass_dyn();

		virtual format::abc::Index type( String path);
		Dynamic type_dyn();

		virtual format::abc::Index typeParams( String path);
		Dynamic typeParams_dyn();

		virtual format::abc::Index property( String pname,format::abc::Index ns);
		Dynamic property_dyn();

		virtual format::abc::Index methodType( Dynamic m);
		Dynamic methodType_dyn();

		virtual format::abc::Index lookup( Array<Dynamic > arr,Dynamic n,Dynamic type);
		Dynamic lookup_dyn();

		virtual format::abc::Index elookup( Array<Dynamic > arr,Dynamic n);
		Dynamic elookup_dyn();

		virtual format::abc::ABCData getData( );
		Dynamic getData_dyn();

		virtual format::abc::Index beginInterfaceFunction( Array<format::abc::Index > args,format::abc::Index ret,Dynamic extra);
		Dynamic beginInterfaceFunction_dyn();

		virtual format::abc::Index beginFunction( Array<format::abc::Index > args,format::abc::Index ret,Dynamic extra);
		Dynamic beginFunction_dyn();

		virtual Void endFunction( );
		Dynamic endFunction_dyn();

		virtual int allocRegister( );
		Dynamic allocRegister_dyn();

		virtual Void freeRegister( int i);
		Dynamic freeRegister_dyn();

		virtual Dynamic beginClass( String path,Dynamic isInterface);
		Dynamic beginClass_dyn();

		virtual Void endClass( Dynamic makeInit);
		Dynamic endClass_dyn();

		virtual Void addClassSuper( String sup);
		Dynamic addClassSuper_dyn();

		virtual Dynamic beginInterfaceMethod( String mname,Array<format::abc::Index > targs,format::abc::Index tret,Dynamic isStatic,Dynamic isOverride,Dynamic isFinal,Dynamic willAddLater,format::abc::MethodKind kind,Dynamic extra,format::abc::Index ns);
		Dynamic beginInterfaceMethod_dyn();

		virtual Dynamic beginMethod( String mname,Array<format::abc::Index > targs,format::abc::Index tret,Dynamic isStatic,Dynamic isOverride,Dynamic isFinal,Dynamic willAddLater,format::abc::MethodKind kind,Dynamic extra,format::abc::Index ns);
		Dynamic beginMethod_dyn();

		virtual Void endMethod( );
		Dynamic endMethod_dyn();

		virtual int defineField( String fname,format::abc::Index t,Dynamic isStatic,format::abc::Value value,Dynamic const,format::abc::Index ns);
		Dynamic defineField_dyn();

		virtual Void op( format::abc::OpCode o);
		Dynamic op_dyn();

		virtual Void ops( Array<format::abc::OpCode > ops);
		Dynamic ops_dyn();

		virtual Dynamic backwardJump( );
		Dynamic backwardJump_dyn();

		virtual Dynamic jump( format::abc::JumpStyle $t1);
		Dynamic jump_dyn();

		virtual Void finalize( );
		Dynamic finalize_dyn();

};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_Context */ 
