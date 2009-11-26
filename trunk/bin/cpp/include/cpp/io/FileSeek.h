#ifndef INCLUDED_cpp_io_FileSeek
#define INCLUDED_cpp_io_FileSeek

#include <hxObject.h>

DECLARE_CLASS2(cpp,io,FileSeek)
namespace cpp{
namespace io{


class FileSeek_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef FileSeek_obj OBJ_;

	public:
		FileSeek_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"cpp.io.FileSeek",15); }
		String __ToString() const { return STRING(L"FileSeek.",9) + tag; }

		static FileSeek SeekBegin;
		static FileSeek SeekCur;
		static FileSeek SeekEnd;
};

} // end namespace cpp
} // end namespace io

#endif /* INCLUDED_cpp_io_FileSeek */ 
