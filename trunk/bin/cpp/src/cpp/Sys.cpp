#include <hxObject.h>

#ifndef INCLUDED_Hash
#include <Hash.h>
#endif
#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
#ifndef INCLUDED_cpp_Sys
#include <cpp/Sys.h>
#endif
#ifndef INCLUDED_haxe_Log
#include <haxe/Log.h>
#endif
namespace cpp{

Void Sys_obj::__construct()
{
	return null();
}

Sys_obj::~Sys_obj() { }

Dynamic Sys_obj::__CreateEmpty() { return  new Sys_obj; }
hxObjectPtr<Sys_obj > Sys_obj::__new()
{  hxObjectPtr<Sys_obj > result = new Sys_obj();
	result->__construct();
	return result;}

Dynamic Sys_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<Sys_obj > result = new Sys_obj();
	result->__construct();
	return result;}

Array<String > Sys_obj::args( ){
	return ::__get_args();
}


STATIC_DEFINE_DYNAMIC_FUNC0(Sys_obj,args,return )

String Sys_obj::getEnv( String s){
	String v = cpp::Sys_obj::get_env(s);
	if (v == null())
		return null();
	return v;
}


STATIC_DEFINE_DYNAMIC_FUNC1(Sys_obj,getEnv,return )

Void Sys_obj::putEnv( String s,String v){
{
		cpp::Sys_obj::put_env(s,v);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC2(Sys_obj,putEnv,(void))

Void Sys_obj::sleep( double seconds){
{
		cpp::Sys_obj::_sleep(seconds);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Sys_obj,sleep,(void))

bool Sys_obj::setTimeLocale( String loc){
	return cpp::Sys_obj::set_time_locale(loc);
}


STATIC_DEFINE_DYNAMIC_FUNC1(Sys_obj,setTimeLocale,return )

String Sys_obj::getCwd( ){
	return String(cpp::Sys_obj::get_cwd());
}


STATIC_DEFINE_DYNAMIC_FUNC0(Sys_obj,getCwd,return )

Void Sys_obj::setCwd( String s){
{
		cpp::Sys_obj::set_cwd(s);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Sys_obj,setCwd,(void))

String Sys_obj::systemName( ){
	return cpp::Sys_obj::sys_string();
}


STATIC_DEFINE_DYNAMIC_FUNC0(Sys_obj,systemName,return )

String Sys_obj::escapeArgument( String arg){
	bool ok = true;
	{
		int _g1 = 0;
		int _g = arg.length;
		while(_g1 < _g){
			int i = _g1++;
			switch( (int)(arg.charCodeAt(i))){
				case 32: case 34: {
					ok = false;
				}
				break;
				case 0: case 13: case 10: {
					arg = arg.substr(0,i);
				}
				break;
			}
		}
	}
	if (ok)
		return arg;
	return STRING(L"\"",1) + arg.split(STRING(L"\"",1))->join(STRING(L"\\\"",2)) + STRING(L"\"",1);
}


STATIC_DEFINE_DYNAMIC_FUNC1(Sys_obj,escapeArgument,return )

int Sys_obj::command( String cmd,Array<String > args){
	if (args != null()){
		cmd = cpp::Sys_obj::escapeArgument(cmd);
		{
			int _g = 0;
			while(_g < args->length){
				String a = args->__get(_g);
				++_g;
				hxAddEq(cmd,STRING(L" ",1) + cpp::Sys_obj::escapeArgument(a));
			}
		}
	}
	return cpp::Sys_obj::sys_command(cmd);
}


STATIC_DEFINE_DYNAMIC_FUNC2(Sys_obj,command,return )

Void Sys_obj::exit( int code){
{
		cpp::Sys_obj::sys_exit(code);
	}
return null();
}


STATIC_DEFINE_DYNAMIC_FUNC1(Sys_obj,exit,(void))

double Sys_obj::time( ){
	return cpp::Sys_obj::sys_time();
}


STATIC_DEFINE_DYNAMIC_FUNC0(Sys_obj,time,return )

double Sys_obj::cpuTime( ){
	return cpp::Sys_obj::sys_cpu_time();
}


STATIC_DEFINE_DYNAMIC_FUNC0(Sys_obj,cpuTime,return )

String Sys_obj::executablePath( ){
	return String(cpp::Sys_obj::sys_exe_path());
}


STATIC_DEFINE_DYNAMIC_FUNC0(Sys_obj,executablePath,return )

Hash Sys_obj::environment( ){
	Array<String > vars = cpp::Sys_obj::sys_env();
	Hash result = Hash_obj::__new();
	int i = 0;
	while(i < vars->length){
		result->set(vars->__get(i),vars->__get(i + 1));
		hxAddEq(i,2);
	}
	haxe::Log_obj::trace(result,hxAnon_obj::Create()->Add( STRING(L"fileName",8) , STRING(L"Sys.hx",6))->Add( STRING(L"lineNumber",10) , 87)->Add( STRING(L"className",9) , STRING(L"cpp.Sys",7))->Add( STRING(L"methodName",10) , STRING(L"environment",11)));
	return result;
}


STATIC_DEFINE_DYNAMIC_FUNC0(Sys_obj,environment,return )

Dynamic Sys_obj::get_env;

Dynamic Sys_obj::put_env;

Dynamic Sys_obj::_sleep;

Dynamic Sys_obj::set_time_locale;

Dynamic Sys_obj::get_cwd;

Dynamic Sys_obj::set_cwd;

Dynamic Sys_obj::sys_string;

Dynamic Sys_obj::sys_command;

Dynamic Sys_obj::sys_exit;

Dynamic Sys_obj::sys_time;

Dynamic Sys_obj::sys_cpu_time;

Dynamic Sys_obj::sys_exe_path;

Dynamic Sys_obj::sys_env;


Sys_obj::Sys_obj()
{
}

void Sys_obj::__Mark()
{
}

Dynamic Sys_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 4:
		if (!memcmp(inName.__s,L"args",sizeof(wchar_t)*4) ) { return args_dyn(); }
		if (!memcmp(inName.__s,L"exit",sizeof(wchar_t)*4) ) { return exit_dyn(); }
		if (!memcmp(inName.__s,L"time",sizeof(wchar_t)*4) ) { return time_dyn(); }
		break;
	case 5:
		if (!memcmp(inName.__s,L"sleep",sizeof(wchar_t)*5) ) { return sleep_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"getEnv",sizeof(wchar_t)*6) ) { return getEnv_dyn(); }
		if (!memcmp(inName.__s,L"putEnv",sizeof(wchar_t)*6) ) { return putEnv_dyn(); }
		if (!memcmp(inName.__s,L"getCwd",sizeof(wchar_t)*6) ) { return getCwd_dyn(); }
		if (!memcmp(inName.__s,L"setCwd",sizeof(wchar_t)*6) ) { return setCwd_dyn(); }
		if (!memcmp(inName.__s,L"_sleep",sizeof(wchar_t)*6) ) { return _sleep; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"command",sizeof(wchar_t)*7) ) { return command_dyn(); }
		if (!memcmp(inName.__s,L"cpuTime",sizeof(wchar_t)*7) ) { return cpuTime_dyn(); }
		if (!memcmp(inName.__s,L"get_env",sizeof(wchar_t)*7) ) { return get_env; }
		if (!memcmp(inName.__s,L"put_env",sizeof(wchar_t)*7) ) { return put_env; }
		if (!memcmp(inName.__s,L"get_cwd",sizeof(wchar_t)*7) ) { return get_cwd; }
		if (!memcmp(inName.__s,L"set_cwd",sizeof(wchar_t)*7) ) { return set_cwd; }
		if (!memcmp(inName.__s,L"sys_env",sizeof(wchar_t)*7) ) { return sys_env; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"sys_exit",sizeof(wchar_t)*8) ) { return sys_exit; }
		if (!memcmp(inName.__s,L"sys_time",sizeof(wchar_t)*8) ) { return sys_time; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"systemName",sizeof(wchar_t)*10) ) { return systemName_dyn(); }
		if (!memcmp(inName.__s,L"sys_string",sizeof(wchar_t)*10) ) { return sys_string; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"environment",sizeof(wchar_t)*11) ) { return environment_dyn(); }
		if (!memcmp(inName.__s,L"sys_command",sizeof(wchar_t)*11) ) { return sys_command; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"sys_cpu_time",sizeof(wchar_t)*12) ) { return sys_cpu_time; }
		if (!memcmp(inName.__s,L"sys_exe_path",sizeof(wchar_t)*12) ) { return sys_exe_path; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"setTimeLocale",sizeof(wchar_t)*13) ) { return setTimeLocale_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"escapeArgument",sizeof(wchar_t)*14) ) { return escapeArgument_dyn(); }
		if (!memcmp(inName.__s,L"executablePath",sizeof(wchar_t)*14) ) { return executablePath_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"set_time_locale",sizeof(wchar_t)*15) ) { return set_time_locale; }
	}
	return super::__Field(inName);
}

static int __id_args = __hxcpp_field_to_id("args");
static int __id_getEnv = __hxcpp_field_to_id("getEnv");
static int __id_putEnv = __hxcpp_field_to_id("putEnv");
static int __id_sleep = __hxcpp_field_to_id("sleep");
static int __id_setTimeLocale = __hxcpp_field_to_id("setTimeLocale");
static int __id_getCwd = __hxcpp_field_to_id("getCwd");
static int __id_setCwd = __hxcpp_field_to_id("setCwd");
static int __id_systemName = __hxcpp_field_to_id("systemName");
static int __id_escapeArgument = __hxcpp_field_to_id("escapeArgument");
static int __id_command = __hxcpp_field_to_id("command");
static int __id_exit = __hxcpp_field_to_id("exit");
static int __id_time = __hxcpp_field_to_id("time");
static int __id_cpuTime = __hxcpp_field_to_id("cpuTime");
static int __id_executablePath = __hxcpp_field_to_id("executablePath");
static int __id_environment = __hxcpp_field_to_id("environment");
static int __id_get_env = __hxcpp_field_to_id("get_env");
static int __id_put_env = __hxcpp_field_to_id("put_env");
static int __id__sleep = __hxcpp_field_to_id("_sleep");
static int __id_set_time_locale = __hxcpp_field_to_id("set_time_locale");
static int __id_get_cwd = __hxcpp_field_to_id("get_cwd");
static int __id_set_cwd = __hxcpp_field_to_id("set_cwd");
static int __id_sys_string = __hxcpp_field_to_id("sys_string");
static int __id_sys_command = __hxcpp_field_to_id("sys_command");
static int __id_sys_exit = __hxcpp_field_to_id("sys_exit");
static int __id_sys_time = __hxcpp_field_to_id("sys_time");
static int __id_sys_cpu_time = __hxcpp_field_to_id("sys_cpu_time");
static int __id_sys_exe_path = __hxcpp_field_to_id("sys_exe_path");
static int __id_sys_env = __hxcpp_field_to_id("sys_env");


Dynamic Sys_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_args) return args_dyn();
	if (inFieldID==__id_getEnv) return getEnv_dyn();
	if (inFieldID==__id_putEnv) return putEnv_dyn();
	if (inFieldID==__id_sleep) return sleep_dyn();
	if (inFieldID==__id_setTimeLocale) return setTimeLocale_dyn();
	if (inFieldID==__id_getCwd) return getCwd_dyn();
	if (inFieldID==__id_setCwd) return setCwd_dyn();
	if (inFieldID==__id_systemName) return systemName_dyn();
	if (inFieldID==__id_escapeArgument) return escapeArgument_dyn();
	if (inFieldID==__id_command) return command_dyn();
	if (inFieldID==__id_exit) return exit_dyn();
	if (inFieldID==__id_time) return time_dyn();
	if (inFieldID==__id_cpuTime) return cpuTime_dyn();
	if (inFieldID==__id_executablePath) return executablePath_dyn();
	if (inFieldID==__id_environment) return environment_dyn();
	if (inFieldID==__id_get_env) return get_env;
	if (inFieldID==__id_put_env) return put_env;
	if (inFieldID==__id__sleep) return _sleep;
	if (inFieldID==__id_set_time_locale) return set_time_locale;
	if (inFieldID==__id_get_cwd) return get_cwd;
	if (inFieldID==__id_set_cwd) return set_cwd;
	if (inFieldID==__id_sys_string) return sys_string;
	if (inFieldID==__id_sys_command) return sys_command;
	if (inFieldID==__id_sys_exit) return sys_exit;
	if (inFieldID==__id_sys_time) return sys_time;
	if (inFieldID==__id_sys_cpu_time) return sys_cpu_time;
	if (inFieldID==__id_sys_exe_path) return sys_exe_path;
	if (inFieldID==__id_sys_env) return sys_env;
	return super::__IField(inFieldID);
}

Dynamic Sys_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 6:
		if (!memcmp(inName.__s,L"_sleep",sizeof(wchar_t)*6) ) { _sleep=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"get_env",sizeof(wchar_t)*7) ) { get_env=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"put_env",sizeof(wchar_t)*7) ) { put_env=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"get_cwd",sizeof(wchar_t)*7) ) { get_cwd=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"set_cwd",sizeof(wchar_t)*7) ) { set_cwd=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"sys_env",sizeof(wchar_t)*7) ) { sys_env=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"sys_exit",sizeof(wchar_t)*8) ) { sys_exit=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"sys_time",sizeof(wchar_t)*8) ) { sys_time=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"sys_string",sizeof(wchar_t)*10) ) { sys_string=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"sys_command",sizeof(wchar_t)*11) ) { sys_command=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"sys_cpu_time",sizeof(wchar_t)*12) ) { sys_cpu_time=inValue.Cast<Dynamic >();return inValue; }
		if (!memcmp(inName.__s,L"sys_exe_path",sizeof(wchar_t)*12) ) { sys_exe_path=inValue.Cast<Dynamic >();return inValue; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"set_time_locale",sizeof(wchar_t)*15) ) { set_time_locale=inValue.Cast<Dynamic >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void Sys_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"args",4),
	STRING(L"getEnv",6),
	STRING(L"putEnv",6),
	STRING(L"sleep",5),
	STRING(L"setTimeLocale",13),
	STRING(L"getCwd",6),
	STRING(L"setCwd",6),
	STRING(L"systemName",10),
	STRING(L"escapeArgument",14),
	STRING(L"command",7),
	STRING(L"exit",4),
	STRING(L"time",4),
	STRING(L"cpuTime",7),
	STRING(L"executablePath",14),
	STRING(L"environment",11),
	STRING(L"get_env",7),
	STRING(L"put_env",7),
	STRING(L"_sleep",6),
	STRING(L"set_time_locale",15),
	STRING(L"get_cwd",7),
	STRING(L"set_cwd",7),
	STRING(L"sys_string",10),
	STRING(L"sys_command",11),
	STRING(L"sys_exit",8),
	STRING(L"sys_time",8),
	STRING(L"sys_cpu_time",12),
	STRING(L"sys_exe_path",12),
	STRING(L"sys_env",7),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
	MarkMember(Sys_obj::get_env);
	MarkMember(Sys_obj::put_env);
	MarkMember(Sys_obj::_sleep);
	MarkMember(Sys_obj::set_time_locale);
	MarkMember(Sys_obj::get_cwd);
	MarkMember(Sys_obj::set_cwd);
	MarkMember(Sys_obj::sys_string);
	MarkMember(Sys_obj::sys_command);
	MarkMember(Sys_obj::sys_exit);
	MarkMember(Sys_obj::sys_time);
	MarkMember(Sys_obj::sys_cpu_time);
	MarkMember(Sys_obj::sys_exe_path);
	MarkMember(Sys_obj::sys_env);
};

Class Sys_obj::__mClass;

void Sys_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"cpp.Sys",7), TCanCast<Sys_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void Sys_obj::__boot()
{
	Static(get_env) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"get_env",7),1);
	Static(put_env) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"put_env",7),2);
	Static(_sleep) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_sleep",9),1);
	Static(set_time_locale) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"set_time_locale",15),1);
	Static(get_cwd) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"get_cwd",7),0);
	Static(set_cwd) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"set_cwd",7),1);
	Static(sys_string) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_string",10),0);
	Static(sys_command) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_command",11),1);
	Static(sys_exit) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_exit",8),1);
	Static(sys_time) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_time",8),0);
	Static(sys_cpu_time) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_cpu_time",12),0);
	Static(sys_exe_path) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_exe_path",12),0);
	Static(sys_env) = cpp::Lib_obj::load(STRING(L"std",3),STRING(L"sys_env",7),0);
}

} // end namespace cpp
