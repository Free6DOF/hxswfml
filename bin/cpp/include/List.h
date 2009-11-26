#ifndef INCLUDED_List
#define INCLUDED_List

#include <hxObject.h>

DECLARE_CLASS0(List)


class List_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef List_obj OBJ_;

	protected:
		List_obj();
		Void __construct();

	public:
		static hxObjectPtr<List_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~List_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"List",4); }

		Array<Dynamic > h;
		Array<Dynamic > q;
		int length;
		virtual Void add( Dynamic item);
		Dynamic add_dyn();

		virtual Void push( Dynamic item);
		Dynamic push_dyn();

		virtual Dynamic first( );
		Dynamic first_dyn();

		virtual Dynamic last( );
		Dynamic last_dyn();

		virtual Dynamic pop( );
		Dynamic pop_dyn();

		virtual bool isEmpty( );
		Dynamic isEmpty_dyn();

		virtual Void clear( );
		Dynamic clear_dyn();

		virtual bool remove( Dynamic v);
		Dynamic remove_dyn();

		virtual Dynamic iterator( );
		Dynamic iterator_dyn();

		virtual String toString( );
		Dynamic toString_dyn();

		virtual String join( String sep);
		Dynamic join_dyn();

		virtual List filter( Dynamic f);
		Dynamic filter_dyn();

		virtual List map( Dynamic f);
		Dynamic map_dyn();

};


#endif /* INCLUDED_List */ 
