#ifndef INCLUDED_format_abc_OpReader
#define INCLUDED_format_abc_OpReader

#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,JumpStyle)
DECLARE_CLASS2(format,abc,OpCode)
DECLARE_CLASS2(format,abc,OpReader)
DECLARE_CLASS2(haxe,io,Input)
namespace format{
namespace abc{


class OpReader_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef OpReader_obj OBJ_;

	protected:
		OpReader_obj();
		Void __construct(haxe::io::Input i);

	public:
		static hxObjectPtr<OpReader_obj > __new(haxe::io::Input i);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~OpReader_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"OpReader",8); }

		haxe::io::Input i;
		virtual int readInt( );
		Dynamic readInt_dyn();

		virtual format::abc::Index readIndex( );
		Dynamic readIndex_dyn();

		virtual cpp::CppInt32__ readInt32( );
		Dynamic readInt32_dyn();

		virtual int reg( );
		Dynamic reg_dyn();

		virtual format::abc::OpCode jmp( format::abc::JumpStyle j);
		Dynamic jmp_dyn();

		virtual format::abc::OpCode readOp( int op);
		Dynamic readOp_dyn();

		static int bytePos;
		static Array<Array<String > > jumps;
		static int jumpNameIndex;
		static Array<String > labels;
		static int labelNameIndex;
		static Array<format::abc::OpCode > ops;
		static Array<format::abc::OpCode > decode( haxe::io::Input i);
		static Dynamic decode_dyn();

};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_OpReader */ 
