#ifndef INCLUDED_StringTools
#define INCLUDED_StringTools

#include <hxObject.h>

DECLARE_CLASS0(StringTools)


class StringTools_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef StringTools_obj OBJ_;

	protected:
		StringTools_obj();
		Void __construct();

	public:
		static hxObjectPtr<StringTools_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~StringTools_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"StringTools",11); }

		static String urlEncode( String s);
		static Dynamic urlEncode_dyn();

		static String urlDecode( String s);
		static Dynamic urlDecode_dyn();

		static String htmlEscape( String s);
		static Dynamic htmlEscape_dyn();

		static String htmlUnescape( String s);
		static Dynamic htmlUnescape_dyn();

		static bool startsWith( String s,String start);
		static Dynamic startsWith_dyn();

		static bool endsWith( String s,String end);
		static Dynamic endsWith_dyn();

		static bool isSpace( String s,int pos);
		static Dynamic isSpace_dyn();

		static String ltrim( String s);
		static Dynamic ltrim_dyn();

		static String rtrim( String s);
		static Dynamic rtrim_dyn();

		static String trim( String s);
		static Dynamic trim_dyn();

		static String rpad( String s,String c,int l);
		static Dynamic rpad_dyn();

		static String lpad( String s,String c,int l);
		static Dynamic lpad_dyn();

		static String replace( String s,String sub,String by);
		static Dynamic replace_dyn();

		static String hex( int n,Dynamic digits);
		static Dynamic hex_dyn();

};


#endif /* INCLUDED_StringTools */ 
