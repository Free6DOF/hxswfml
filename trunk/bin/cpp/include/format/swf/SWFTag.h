#ifndef INCLUDED_format_swf_SWFTag
#define INCLUDED_format_swf_SWFTag

#include <hxObject.h>

DECLARE_CLASS2(format,swf,FontData)
DECLARE_CLASS2(format,swf,FontInfoData)
DECLARE_CLASS2(format,swf,JPEGData)
DECLARE_CLASS2(format,swf,MorphShapeData)
DECLARE_CLASS2(format,swf,PlaceObject)
DECLARE_CLASS2(format,swf,SWFTag)
DECLARE_CLASS2(format,swf,ShapeData)
DECLARE_CLASS2(haxe,io,Bytes)
namespace format{
namespace swf{


class SWFTag_obj : public hxEnumBase_obj
{
	typedef hxEnumBase_obj super;
		typedef SWFTag_obj OBJ_;

	public:
		SWFTag_obj() {};
		DO_ENUM_RTTI;
		static void __boot();
		static void __register();
		String GetEnumName( ) const { return STRING(L"format.swf.SWFTag",17); }
		String __ToString() const { return STRING(L"SWFTag.",7) + tag; }

		static SWFTag TActionScript3(haxe::io::Bytes data,Dynamic context);
		static Dynamic TActionScript3_dyn();
		static SWFTag TBackgroundColor(int color);
		static Dynamic TBackgroundColor_dyn();
		static SWFTag TBinaryData(int id,haxe::io::Bytes data);
		static Dynamic TBinaryData_dyn();
		static SWFTag TBitsJPEG(int id,format::swf::JPEGData data);
		static Dynamic TBitsJPEG_dyn();
		static SWFTag TBitsLossless(Dynamic data);
		static Dynamic TBitsLossless_dyn();
		static SWFTag TBitsLossless2(Dynamic data);
		static Dynamic TBitsLossless2_dyn();
		static SWFTag TClip(int id,int frames,Array<format::swf::SWFTag > tags);
		static Dynamic TClip_dyn();
		static SWFTag TDefineButton2(int id,Array<Dynamic > records);
		static Dynamic TDefineButton2_dyn();
		static SWFTag TDefineEditText(int id,Dynamic data);
		static Dynamic TDefineEditText_dyn();
		static SWFTag TDefineScalingGrid(int id,Dynamic splitter);
		static Dynamic TDefineScalingGrid_dyn();
		static SWFTag TDoAction(haxe::io::Bytes data);
		static Dynamic TDoAction_dyn();
		static SWFTag TDoInitActions(int id,haxe::io::Bytes data);
		static Dynamic TDoInitActions_dyn();
		static SWFTag TEnd;
		static SWFTag TExportAssets(Array<Dynamic > symbols);
		static Dynamic TExportAssets_dyn();
		static SWFTag TFont(int id,format::swf::FontData data);
		static Dynamic TFont_dyn();
		static SWFTag TFontInfo(int id,format::swf::FontInfoData data);
		static Dynamic TFontInfo_dyn();
		static SWFTag TFrameLabel(String label,bool anchor);
		static Dynamic TFrameLabel_dyn();
		static SWFTag TJPEGTables(haxe::io::Bytes data);
		static Dynamic TJPEGTables_dyn();
		static SWFTag TMetadata(String data);
		static Dynamic TMetadata_dyn();
		static SWFTag TMorphShape(int id,format::swf::MorphShapeData data);
		static Dynamic TMorphShape_dyn();
		static SWFTag TPlaceObject2(format::swf::PlaceObject po);
		static Dynamic TPlaceObject2_dyn();
		static SWFTag TPlaceObject3(format::swf::PlaceObject po);
		static Dynamic TPlaceObject3_dyn();
		static SWFTag TRemoveObject2(int depth);
		static Dynamic TRemoveObject2_dyn();
		static SWFTag TSandBox(Dynamic v);
		static Dynamic TSandBox_dyn();
		static SWFTag TScriptLimits(int maxRecursion,int timeoutSeconds);
		static Dynamic TScriptLimits_dyn();
		static SWFTag TShape(int id,format::swf::ShapeData data);
		static Dynamic TShape_dyn();
		static SWFTag TShowFrame;
		static SWFTag TSound(Dynamic data);
		static Dynamic TSound_dyn();
		static SWFTag TStartSound(int id,Dynamic soundInfo);
		static Dynamic TStartSound_dyn();
		static SWFTag TSymbolClass(Array<Dynamic > symbols);
		static Dynamic TSymbolClass_dyn();
		static SWFTag TUnknown(Dynamic id,haxe::io::Bytes data);
		static Dynamic TUnknown_dyn();
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_SWFTag */ 
