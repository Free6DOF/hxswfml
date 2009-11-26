#ifndef INCLUDED_format_swf_SoundFormat
#define INCLUDED_format_swf_SoundFormat

#include <hxObject.h>

DECLARE_CLASS2(format,swf,SoundFormat)
namespace format{
namespace swf{


class SoundFormat_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef SoundFormat_obj OBJ_;

	public:
		SoundFormat_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.SoundFormat",22); }
		String __ToString() const { return STRING(L"SoundFormat.",12) + tag; }

		static SoundFormat SFADPCM;
		static SoundFormat SFLittleEndianUncompressed;
		static SoundFormat SFMP3;
		static SoundFormat SFNativeEndianUncompressed;
		static SoundFormat SFNellymoser;
		static SoundFormat SFNellymoser16k;
		static SoundFormat SFNellymoser8k;
		static SoundFormat SFSpeex;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_SoundFormat */ 
