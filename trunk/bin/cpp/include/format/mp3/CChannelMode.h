#ifndef INCLUDED_format_mp3_CChannelMode
#define INCLUDED_format_mp3_CChannelMode

#include <hxObject.h>

DECLARE_CLASS2(format,mp3,CChannelMode)
DECLARE_CLASS2(format,mp3,ChannelMode)
namespace format{
namespace mp3{


class CChannelMode_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef CChannelMode_obj OBJ_;

	protected:
		CChannelMode_obj();
		Void __construct();

	public:
		static hxObjectPtr<CChannelMode_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~CChannelMode_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"CChannelMode",12); }

		static int CStereo;
		static int CJointStereo;
		static int CDualChannel;
		static int CMono;
		static int enum2Num( format::mp3::ChannelMode c);
		static Dynamic enum2Num_dyn();

		static format::mp3::ChannelMode num2Enum( int c);
		static Dynamic num2Enum_dyn();

};

} // end namespace format
} // end namespace mp3

#endif /* INCLUDED_format_mp3_CChannelMode */ 
