#ifndef INCLUDED_format_swf_MPEGVersion
#define INCLUDED_format_swf_MPEGVersion

#include <hxObject.h>

DECLARE_CLASS2(format,swf,MPEGVersion)
namespace format{
namespace swf{


class MPEGVersion_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef MPEGVersion_obj OBJ_;

	public:
		MPEGVersion_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.MPEGVersion",22); }
		String __ToString() const { return STRING(L"MPEGVersion.",12) + tag; }

		static MPEGVersion MPEG_Reserved;
		static MPEGVersion MPEG_V1;
		static MPEGVersion MPEG_V2;
		static MPEGVersion MPEG_V25;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_MPEGVersion */ 
