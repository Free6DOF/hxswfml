#ifndef INCLUDED_cpp_Sys
#define INCLUDED_cpp_Sys

#include <hxObject.h>

DECLARE_CLASS0(Hash)
DECLARE_CLASS1(cpp,Sys)
namespace cpp{


class Sys_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Sys_obj OBJ_;

	protected:
		Sys_obj();
		Void __construct();

	public:
		static hxObjectPtr<Sys_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Sys_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Sys",3); }

		static Array<String > args( );
		static Dynamic args_dyn();

		static String getEnv( String s);
		static Dynamic getEnv_dyn();

		static Void putEnv( String s,String v);
		static Dynamic putEnv_dyn();

		static Void sleep( double seconds);
		static Dynamic sleep_dyn();

		static bool setTimeLocale( String loc);
		static Dynamic setTimeLocale_dyn();

		static String getCwd( );
		static Dynamic getCwd_dyn();

		static Void setCwd( String s);
		static Dynamic setCwd_dyn();

		static String systemName( );
		static Dynamic systemName_dyn();

		static String escapeArgument( String arg);
		static Dynamic escapeArgument_dyn();

		static int command( String cmd,Array<String > args);
		static Dynamic command_dyn();

		static Void exit( int code);
		static Dynamic exit_dyn();

		static double time( );
		static Dynamic time_dyn();

		static double cpuTime( );
		static Dynamic cpuTime_dyn();

		static String executablePath( );
		static Dynamic executablePath_dyn();

		static Hash environment( );
		static Dynamic environment_dyn();

		static Dynamic get_env;
	Dynamic &get_env_dyn() { return get_env;}
		static Dynamic put_env;
	Dynamic &put_env_dyn() { return put_env;}
		static Dynamic _sleep;
	Dynamic &_sleep_dyn() { return _sleep;}
		static Dynamic set_time_locale;
	Dynamic &set_time_locale_dyn() { return set_time_locale;}
		static Dynamic get_cwd;
	Dynamic &get_cwd_dyn() { return get_cwd;}
		static Dynamic set_cwd;
	Dynamic &set_cwd_dyn() { return set_cwd;}
		static Dynamic sys_string;
	Dynamic &sys_string_dyn() { return sys_string;}
		static Dynamic sys_command;
	Dynamic &sys_command_dyn() { return sys_command;}
		static Dynamic sys_exit;
	Dynamic &sys_exit_dyn() { return sys_exit;}
		static Dynamic sys_time;
	Dynamic &sys_time_dyn() { return sys_time;}
		static Dynamic sys_cpu_time;
	Dynamic &sys_cpu_time_dyn() { return sys_cpu_time;}
		static Dynamic sys_exe_path;
	Dynamic &sys_exe_path_dyn() { return sys_exe_path;}
		static Dynamic sys_env;
	Dynamic &sys_env_dyn() { return sys_env;}
};

} // end namespace cpp

#endif /* INCLUDED_cpp_Sys */ 
