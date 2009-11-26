#ifndef INCLUDED_format_swf_PlaceObject
#define INCLUDED_format_swf_PlaceObject

#include <hxObject.h>

DECLARE_CLASS2(format,swf,BlendMode)
DECLARE_CLASS2(format,swf,Filter)
DECLARE_CLASS2(format,swf,PlaceObject)
namespace format{
namespace swf{


class PlaceObject_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef PlaceObject_obj OBJ_;

	protected:
		PlaceObject_obj();
		Void __construct();

	public:
		static hxObjectPtr<PlaceObject_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~PlaceObject_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"PlaceObject",11); }

		int depth;
		bool move;
		Dynamic cid;
		Dynamic matrix;
		Dynamic color;
		Dynamic ratio;
		String instanceName;
		Dynamic clipDepth;
		Array<Dynamic > events;
		Array<format::swf::Filter > filters;
		format::swf::BlendMode blendMode;
		bool bitmapCache;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_PlaceObject */ 
