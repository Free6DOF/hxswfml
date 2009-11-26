#ifndef INCLUDED_cpp_Lib
#define INCLUDED_cpp_Lib

#include <hxObject.h>

DECLARE_CLASS1(cpp,Lib)
namespace cpp{


class Lib_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Lib_obj OBJ_;

	protected:
		Lib_obj();
		Void __construct();

	public:
		static hxObjectPtr<Lib_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Lib_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Lib",3); }

		static Dynamic load( String lib,String prim,int nargs);
		static Dynamic load_dyn();

		static Dynamic loadLazy( Dynamic lib,Dynamic prim,int nargs);
		static Dynamic loadLazy_dyn();

		static Void rethrow( Dynamic inExp);
		static Dynamic rethrow_dyn();

		static Void stringReference( Dynamic inExp);
		static Dynamic stringReference_dyn();

		static Void print( Dynamic v);
		static Dynamic print_dyn();

		static Dynamic haxeToNeko( Dynamic v);
		static Dynamic haxeToNeko_dyn();

		static Dynamic nekoToHaxe( Dynamic v);
		static Dynamic nekoToHaxe_dyn();

		static Void println( Dynamic v);
		static Dynamic println_dyn();

};

} // end namespace cpp

#endif /* INCLUDED_cpp_Lib */ 
