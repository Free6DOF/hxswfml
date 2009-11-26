#ifndef INCLUDED_format_mp3_FrameType
#define INCLUDED_format_mp3_FrameType

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,FrameType)
namespace format{
namespace mp3{


class FrameType_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef FrameType_obj OBJ_;

	public:
		FrameType_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.mp3.FrameType",20); }
		String __ToString() const { return STRING(L"FrameType.",10) + tag; }

		static FrameType FT_MP3;
		static FrameType FT_NONE;
};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_FrameType */ 
