#ifndef INCLUDED_cpp_FileKind
#define INCLUDED_cpp_FileKind

#include <hxObject.h>

DECLARE_CLASS1(cpp,FileKind)
namespace cpp{


class FileKind_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef FileKind_obj OBJ_;

	public:
		FileKind_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"cpp.FileKind",12); }
		String __ToString() const { return STRING(L"FileKind.",9) + tag; }

		static FileKind kdir;
		static FileKind kfile;
		static FileKind kother(String k);
		static Dynamic kother_dyn();
};

} // end namespace cpp

#endif /* INCLUDED_cpp_FileKind */ 
