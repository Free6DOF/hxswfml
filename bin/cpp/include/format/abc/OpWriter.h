#ifndef INCLUDED_format_abc_OpWriter
#define INCLUDED_format_abc_OpWriter

#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,JumpStyle)
DECLARE_CLASS2(format,abc,OpCode)
DECLARE_CLASS2(format,abc,OpWriter)
DECLARE_CLASS2(format,abc,Operation)
DECLARE_CLASS2(haxe,io,Output)
namespace format{
namespace abc{


class OpWriter_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef OpWriter_obj OBJ_;

	protected:
		OpWriter_obj();
		Void __construct(haxe::io::Output o);

	public:
		static hxObjectPtr<OpWriter_obj > __new(haxe::io::Output o);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~OpWriter_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"OpWriter",8); }

		haxe::io::Output o;
		virtual Void writeInt( int n);
		Dynamic writeInt_dyn();

		virtual Void writeInt32( cpp::CppInt32__ n);
		Dynamic writeInt32_dyn();

		virtual Void toInt( int i);
		Dynamic toInt_dyn();

		virtual Void b( int v);
		Dynamic b_dyn();

		virtual Void reg( int v);
		Dynamic reg_dyn();

		virtual Void idx( format::abc::Index i);
		Dynamic idx_dyn();

		virtual int jumpCode( format::abc::JumpStyle j);
		Dynamic jumpCode_dyn();

		virtual int operationCode( format::abc::Operation o);
		Dynamic operationCode_dyn();

		virtual Void write( format::abc::OpCode op);
		Dynamic write_dyn();

};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_OpWriter */ 
