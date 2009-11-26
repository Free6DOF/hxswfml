#ifndef INCLUDED_StringBuf
#define INCLUDED_StringBuf

#include <hxObject.h>

DECLARE_CLASS0(StringBuf)


class StringBuf_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef StringBuf_obj OBJ_;

	protected:
		StringBuf_obj();
		Void __construct();

	public:
		static hxObjectPtr<StringBuf_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~StringBuf_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"StringBuf",9); }

		virtual Void add( Dynamic x);
		Dynamic add_dyn();

		virtual Void addSub( String s,int pos,Dynamic len);
		Dynamic addSub_dyn();

		virtual Void addChar( int c);
		Dynamic addChar_dyn();

		virtual String toString( );
		Dynamic toString_dyn();

		String b;
};


#endif /* INCLUDED_StringBuf */ 
