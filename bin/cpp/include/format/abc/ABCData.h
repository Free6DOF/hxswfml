#ifndef INCLUDED_format_abc_ABCData
#define INCLUDED_format_abc_ABCData

#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
DECLARE_CLASS2(format,abc,ABCData)
DECLARE_CLASS2(format,abc,Index)
DECLARE_CLASS2(format,abc,Name)
DECLARE_CLASS2(format,abc,Namespace)
namespace format{
namespace abc{


class ABCData_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef ABCData_obj OBJ_;

	protected:
		ABCData_obj();
		Void __construct();

	public:
		static hxObjectPtr<ABCData_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~ABCData_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"ABCData",7); }

		Array<cpp::CppInt32__ > ints;
		Array<cpp::CppInt32__ > uints;
		Array<double > floats;
		Array<String > strings;
		Array<format::abc::Namespace > namespaces;
		Array<Array<format::abc::Index > > nssets;
		Array<format::abc::Name > names;
		Array<Dynamic > methodTypes;
		Array<Dynamic > metadatas;
		Array<Dynamic > classes;
		Array<Dynamic > inits;
		Array<Dynamic > functions;
		virtual Dynamic get( Array<Dynamic > t,format::abc::Index i);
		Dynamic get_dyn();

};

} // end namespace format
} // end namespace abc

#endif /* INCLUDED_format_abc_ABCData */ 
