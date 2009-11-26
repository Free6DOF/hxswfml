#ifndef INCLUDED_cpp_CppDate__
#define INCLUDED_cpp_CppDate__

#include <hxObject.h>

DECLARE_CLASS1(cpp,CppDate__)
namespace cpp{


class CppDate___obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef CppDate___obj OBJ_;

	protected:
		CppDate___obj();
		Void __construct(int year,int month,int day,int hour,int min,int sec);

	public:
		static hxObjectPtr<CppDate___obj > __new(int year,int month,int day,int hour,int min,int sec);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~CppDate___obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"CppDate__",9); }

		double mSeconds;
		virtual double getTime( );
		Dynamic getTime_dyn();

		virtual int getHours( );
		Dynamic getHours_dyn();

		virtual int getMinutes( );
		Dynamic getMinutes_dyn();

		virtual int getSeconds( );
		Dynamic getSeconds_dyn();

		virtual int getFullYear( );
		Dynamic getFullYear_dyn();

		virtual int getMonth( );
		Dynamic getMonth_dyn();

		virtual int getDate( );
		Dynamic getDate_dyn();

		virtual int getDay( );
		Dynamic getDay_dyn();

		virtual String toString( );
		Dynamic toString_dyn();

		static cpp::CppDate__ now( );
		static Dynamic now_dyn();

		static cpp::CppDate__ fromTime( double t);
		static Dynamic fromTime_dyn();

		static cpp::CppDate__ fromString( String s);
		static Dynamic fromString_dyn();

};

} // end namespace cpp

#endif /* INCLUDED_cpp_CppDate__ */ 
