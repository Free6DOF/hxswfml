#ifndef INCLUDED_be_haxer_hxswfml_Main
#define INCLUDED_be_haxer_hxswfml_Main

#include <hxObject.h>

DECLARE_CLASS3(be,haxer,hxswfml,Main)
namespace be{
namespace haxer{
namespace hxswfml{


class Main_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Main_obj OBJ_;

	protected:
		Main_obj();
		Void __construct();

	public:
		static hxObjectPtr<Main_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Main_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Main",4); }

		static Void main( );
		static Dynamic main_dyn();

};

} // end namespace be
} // end namespace haxer
} // end namespace hxswfml

#endif /* INCLUDED_be_haxer_hxswfml_Main */ 
