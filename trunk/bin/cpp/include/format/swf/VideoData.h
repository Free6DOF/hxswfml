#ifndef INCLUDED_format_swf_VideoData
#define INCLUDED_format_swf_VideoData

#include <hxObject.h>

DECLARE_CLASS2(format,swf,VideoData)
namespace format{
namespace swf{


class VideoData_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef VideoData_obj OBJ_;

	public:
		VideoData_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.VideoData",20); }
		String __ToString() const { return STRING(L"VideoData.",10) + tag; }

		static VideoData H263videoPacket;
		static VideoData SCREENV2videoPacket;
		static VideoData SCREENvideoPacket;
		static VideoData VP6SWFALPHAvideoPacket;
		static VideoData VP6SWFvideoPacket;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_VideoData */ 
