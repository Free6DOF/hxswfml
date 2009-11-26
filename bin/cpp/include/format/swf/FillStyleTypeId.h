#ifndef INCLUDED_format_swf_FillStyleTypeId
#define INCLUDED_format_swf_FillStyleTypeId

#include <hxObject.h>

DECLARE_CLASS2(format,swf,FillStyleTypeId)
namespace format{
namespace swf{


class FillStyleTypeId_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef FillStyleTypeId_obj OBJ_;

	protected:
		FillStyleTypeId_obj();
		Void __construct();

	public:
		static hxObjectPtr<FillStyleTypeId_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~FillStyleTypeId_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"FillStyleTypeId",15); }

		static int Solid;
		static int LinearGradient;
		static int RadialGradient;
		static int FocalRadialGradient;
		static int RepeatingBitmap;
		static int ClippedBitmap;
		static int NonSmoothedRepeatingBitmap;
		static int NonSmoothedClippedBitmap;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_FillStyleTypeId */ 
