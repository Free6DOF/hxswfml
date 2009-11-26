#ifndef INCLUDED_haxe_io_Eof
#define INCLUDED_haxe_io_Eof

#include <hxObject.h>

DECLARE_CLASS2(haxe,io,Eof)
namespace haxe{
namespace io{


class Eof_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Eof_obj OBJ_;

	protected:
		Eof_obj();
		Void __construct();

	public:
		static hxObjectPtr<Eof_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Eof_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Eof",3); }

		virtual String toString( );
		Dynamic toString_dyn();

};

} // end namespace haxe
} // end namespace io

#endif /* INCLUDED_haxe_io_Eof */ 
