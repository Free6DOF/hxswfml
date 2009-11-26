#ifndef INCLUDED_format_abc__Context_NullOutput
#define INCLUDED_format_abc__Context_NullOutput

#include <hxObject.h>

#include <haxe/io/Output.h>
DECLARE_CLASS3(format,abc,_Context,NullOutput)
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Output)
namespace format{
namespace abc{
namespace _Context{


class NullOutput_obj : public haxe::io::Output_obj
{
	public:
		typedef haxe::io::Output_obj super;
		typedef NullOutput_obj OBJ_;

	protected:
		NullOutput_obj();
		Void __construct();

	public:
		static hxObjectPtr<NullOutput_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~NullOutput_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"NullOutput",10); }

		int n;
		virtual Void writeByte( int c);
		Dynamic writeByte_dyn();

		virtual int writeBytes( haxe::io::Bytes b,int pos,int len);
		Dynamic writeBytes_dyn();

};

} // end namespace format
} // end namespace abc
} // end namespace _Context

#endif /* INCLUDED_format_abc__Context_NullOutput */ 
