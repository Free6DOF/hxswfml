#ifndef INCLUDED_Hash
#define INCLUDED_Hash

#include <hxObject.h>

DECLARE_CLASS0(Hash)


class Hash_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Hash_obj OBJ_;

	protected:
		Hash_obj();
		Void __construct();

	public:
		static hxObjectPtr<Hash_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Hash_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Hash",4); }

		Dynamic h;
		virtual Void set( String key,Dynamic value);
		Dynamic set_dyn();

		virtual Dynamic get( String key);
		Dynamic get_dyn();

		virtual bool exists( String key);
		Dynamic exists_dyn();

		virtual bool remove( String key);
		Dynamic remove_dyn();

		virtual Dynamic keys( );
		Dynamic keys_dyn();

		virtual Dynamic iterator( );
		Dynamic iterator_dyn();

		virtual String toString( );
		Dynamic toString_dyn();

};


#endif /* INCLUDED_Hash */ 
