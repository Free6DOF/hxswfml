#ifndef INCLUDED_format_swf_ChannelMode
#define INCLUDED_format_swf_ChannelMode

#include <hxObject.h>

DECLARE_CLASS2(format,swf,ChannelMode)
namespace format{
namespace swf{


class ChannelMode_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef ChannelMode_obj OBJ_;

	public:
		ChannelMode_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.ChannelMode",22); }
		String __ToString() const { return STRING(L"ChannelMode.",12) + tag; }

		static ChannelMode DualChannel;
		static ChannelMode JointStereo;
		static ChannelMode Mono;
		static ChannelMode Stereo;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_ChannelMode */ 
