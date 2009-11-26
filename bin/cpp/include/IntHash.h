#ifndef INCLUDED_IntHash
#define INCLUDED_IntHash

#include <hxObject.h>

DECLARE_CLASS0(IntHash)


class IntHash_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef IntHash_obj OBJ_;

	protected:
		IntHash_obj();
		Void __construct();

	public:
		static hxObjectPtr<IntHash_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~IntHash_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"IntHash",7); }

		Dynamic h;
		virtual Void set( int key,Dynamic value);
		Dynamic set_dyn();

		virtual Dynamic get( int key);
		Dynamic get_dyn();

		virtual bool exists( int key);
		Dynamic exists_dyn();

		virtual bool remove( int key);
		Dynamic remove_dyn();

		virtual Dynamic keys( );
		Dynamic keys_dyn();

		virtual Dynamic iterator( );
		Dynamic iterator_dyn();

		virtual String toString( );
		Dynamic toString_dyn();

};


#endif /* INCLUDED_IntHash */ 
