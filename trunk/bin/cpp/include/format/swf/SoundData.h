#ifndef INCLUDED_format_swf_SoundData
#define INCLUDED_format_swf_SoundData

#include <hxObject.h>

DECLARE_CLASS2(format,swf,SoundData)
DECLARE_CLASS2(haxe,io,Bytes)
namespace format{
namespace swf{


class SoundData_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef SoundData_obj OBJ_;

	public:
		SoundData_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.SoundData",20); }
		String __ToString() const { return STRING(L"SoundData.",10) + tag; }

		static SoundData SDMp3(int seek,haxe::io::Bytes data);
		static Dynamic SDMp3_dyn();
		static SoundData SDOther(haxe::io::Bytes data);
		static Dynamic SDOther_dyn();
		static SoundData SDRaw(haxe::io::Bytes data);
		static Dynamic SDRaw_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_SoundData */ 
