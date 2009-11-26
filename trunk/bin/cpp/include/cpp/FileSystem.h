#ifndef INCLUDED_cpp_FileSystem
#define INCLUDED_cpp_FileSystem

#include <hxObject.h>

DECLARE_CLASS1(cpp,FileKind)
DECLARE_CLASS1(cpp,FileSystem)
namespace cpp{


class FileSystem_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef FileSystem_obj OBJ_;

	protected:
		FileSystem_obj();
		Void __construct();

	public:
		static hxObjectPtr<FileSystem_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~FileSystem_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"FileSystem",10); }

		static bool exists( String path);
		static Dynamic exists_dyn();

		static Void rename( String path,String newpath);
		static Dynamic rename_dyn();

		static Dynamic stat( String path);
		static Dynamic stat_dyn();

		static String fullPath( String relpath);
		static Dynamic fullPath_dyn();

		static cpp::FileKind kind( String path);
		static Dynamic kind_dyn();

		static bool isDirectory( String path);
		static Dynamic isDirectory_dyn();

		static Void createDirectory( String path);
		static Dynamic createDirectory_dyn();

		static Void deleteFile( String path);
		static Dynamic deleteFile_dyn();

		static Void deleteDirectory( String path);
		static Dynamic deleteDirectory_dyn();

		static Array<String > readDirectory( String path);
		static Dynamic readDirectory_dyn();

		static Dynamic sys_exists;
	Dynamic &sys_exists_dyn() { return sys_exists;}
		static Dynamic file_delete;
	Dynamic &file_delete_dyn() { return file_delete;}
		static Dynamic sys_rename;
	Dynamic &sys_rename_dyn() { return sys_rename;}
		static Dynamic sys_stat;
	Dynamic &sys_stat_dyn() { return sys_stat;}
		static Dynamic sys_file_type;
	Dynamic &sys_file_type_dyn() { return sys_file_type;}
		static Dynamic sys_create_dir;
	Dynamic &sys_create_dir_dyn() { return sys_create_dir;}
		static Dynamic sys_remove_dir;
	Dynamic &sys_remove_dir_dyn() { return sys_remove_dir;}
		static Dynamic sys_read_dir;
	Dynamic &sys_read_dir_dyn() { return sys_read_dir;}
		static Dynamic file_full_path;
	Dynamic &file_full_path_dyn() { return file_full_path;}
};

} // end namespace cpp

#endif /* INCLUDED_cpp_FileSystem */ 
