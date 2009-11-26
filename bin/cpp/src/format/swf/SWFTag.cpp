#include <hxObject.h>

#ifndef INCLUDED_format_swf_FontData
#include <format/swf/FontData.h>
#endif
#ifndef INCLUDED_format_swf_FontInfoData
#include <format/swf/FontInfoData.h>
#endif
#ifndef INCLUDED_format_swf_JPEGData
#include <format/swf/JPEGData.h>
#endif
#ifndef INCLUDED_format_swf_MorphShapeData
#include <format/swf/MorphShapeData.h>
#endif
#ifndef INCLUDED_format_swf_PlaceObject
#include <format/swf/PlaceObject.h>
#endif
#ifndef INCLUDED_format_swf_SWFTag
#include <format/swf/SWFTag.h>
#endif
#ifndef INCLUDED_format_swf_ShapeData
#include <format/swf/ShapeData.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
namespace format{
namespace swf{

SWFTag  SWFTag_obj::TActionScript3(haxe::io::Bytes data,Dynamic context)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TActionScript3",14),13,DynamicArray(0,2).Add(data).Add(context)); }

SWFTag  SWFTag_obj::TBackgroundColor(int color)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TBackgroundColor",16),6,DynamicArray(0,1).Add(color)); }

SWFTag  SWFTag_obj::TBinaryData(int id,haxe::io::Bytes data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TBinaryData",11),21,DynamicArray(0,2).Add(id).Add(data)); }

SWFTag  SWFTag_obj::TBitsJPEG(int id,format::swf::JPEGData data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TBitsJPEG",9),19,DynamicArray(0,2).Add(id).Add(data)); }

SWFTag  SWFTag_obj::TBitsLossless(Dynamic data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TBitsLossless",13),17,DynamicArray(0,1).Add(data)); }

SWFTag  SWFTag_obj::TBitsLossless2(Dynamic data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TBitsLossless2",14),18,DynamicArray(0,1).Add(data)); }

SWFTag  SWFTag_obj::TClip(int id,int frames,Array<format::swf::SWFTag > tags)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TClip",5),7,DynamicArray(0,3).Add(id).Add(frames).Add(tags)); }

SWFTag  SWFTag_obj::TDefineButton2(int id,Array<Dynamic > records)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TDefineButton2",14),26,DynamicArray(0,2).Add(id).Add(records)); }

SWFTag  SWFTag_obj::TDefineEditText(int id,Dynamic data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TDefineEditText",15),27,DynamicArray(0,2).Add(id).Add(data)); }

SWFTag  SWFTag_obj::TDefineScalingGrid(int id,Dynamic splitter)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TDefineScalingGrid",18),29,DynamicArray(0,2).Add(id).Add(splitter)); }

SWFTag  SWFTag_obj::TDoAction(haxe::io::Bytes data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TDoAction",9),24,DynamicArray(0,1).Add(data)); }

SWFTag  SWFTag_obj::TDoInitActions(int id,haxe::io::Bytes data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TDoInitActions",14),12,DynamicArray(0,2).Add(id).Add(data)); }

SWFTag SWFTag_obj::TEnd;

SWFTag  SWFTag_obj::TExportAssets(Array<Dynamic > symbols)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TExportAssets",13),15,DynamicArray(0,1).Add(symbols)); }

SWFTag  SWFTag_obj::TFont(int id,format::swf::FontData data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TFont",5),4,DynamicArray(0,2).Add(id).Add(data)); }

SWFTag  SWFTag_obj::TFontInfo(int id,format::swf::FontInfoData data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TFontInfo",9),5,DynamicArray(0,2).Add(id).Add(data)); }

SWFTag  SWFTag_obj::TFrameLabel(String label,bool anchor)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TFrameLabel",11),11,DynamicArray(0,2).Add(label).Add(anchor)); }

SWFTag  SWFTag_obj::TJPEGTables(haxe::io::Bytes data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TJPEGTables",11),20,DynamicArray(0,1).Add(data)); }

SWFTag  SWFTag_obj::TMetadata(String data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TMetadata",9),28,DynamicArray(0,1).Add(data)); }

SWFTag  SWFTag_obj::TMorphShape(int id,format::swf::MorphShapeData data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TMorphShape",11),3,DynamicArray(0,2).Add(id).Add(data)); }

SWFTag  SWFTag_obj::TPlaceObject2(format::swf::PlaceObject po)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TPlaceObject2",13),8,DynamicArray(0,1).Add(po)); }

SWFTag  SWFTag_obj::TPlaceObject3(format::swf::PlaceObject po)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TPlaceObject3",13),9,DynamicArray(0,1).Add(po)); }

SWFTag  SWFTag_obj::TRemoveObject2(int depth)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TRemoveObject2",14),10,DynamicArray(0,1).Add(depth)); }

SWFTag  SWFTag_obj::TSandBox(Dynamic v)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TSandBox",8),16,DynamicArray(0,1).Add(v)); }

SWFTag  SWFTag_obj::TScriptLimits(int maxRecursion,int timeoutSeconds)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TScriptLimits",13),25,DynamicArray(0,2).Add(maxRecursion).Add(timeoutSeconds)); }

SWFTag  SWFTag_obj::TShape(int id,format::swf::ShapeData data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TShape",6),2,DynamicArray(0,2).Add(id).Add(data)); }

SWFTag SWFTag_obj::TShowFrame;

SWFTag  SWFTag_obj::TSound(Dynamic data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TSound",6),22,DynamicArray(0,1).Add(data)); }

SWFTag  SWFTag_obj::TStartSound(int id,Dynamic soundInfo)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TStartSound",11),23,DynamicArray(0,2).Add(id).Add(soundInfo)); }

SWFTag  SWFTag_obj::TSymbolClass(Array<Dynamic > symbols)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TSymbolClass",12),14,DynamicArray(0,1).Add(symbols)); }

SWFTag  SWFTag_obj::TUnknown(Dynamic id,haxe::io::Bytes data)
	{ return CreateEnum<SWFTag_obj >(STRING(L"TUnknown",8),30,DynamicArray(0,2).Add(id).Add(data)); }

DEFINE_CREATE_ENUM(SWFTag_obj)

int SWFTag_obj::__FindIndex(String inName)
{
	if (inName==STRING(L"TActionScript3",14)) return 13;
	if (inName==STRING(L"TBackgroundColor",16)) return 6;
	if (inName==STRING(L"TBinaryData",11)) return 21;
	if (inName==STRING(L"TBitsJPEG",9)) return 19;
	if (inName==STRING(L"TBitsLossless",13)) return 17;
	if (inName==STRING(L"TBitsLossless2",14)) return 18;
	if (inName==STRING(L"TClip",5)) return 7;
	if (inName==STRING(L"TDefineButton2",14)) return 26;
	if (inName==STRING(L"TDefineEditText",15)) return 27;
	if (inName==STRING(L"TDefineScalingGrid",18)) return 29;
	if (inName==STRING(L"TDoAction",9)) return 24;
	if (inName==STRING(L"TDoInitActions",14)) return 12;
	if (inName==STRING(L"TEnd",4)) return 1;
	if (inName==STRING(L"TExportAssets",13)) return 15;
	if (inName==STRING(L"TFont",5)) return 4;
	if (inName==STRING(L"TFontInfo",9)) return 5;
	if (inName==STRING(L"TFrameLabel",11)) return 11;
	if (inName==STRING(L"TJPEGTables",11)) return 20;
	if (inName==STRING(L"TMetadata",9)) return 28;
	if (inName==STRING(L"TMorphShape",11)) return 3;
	if (inName==STRING(L"TPlaceObject2",13)) return 8;
	if (inName==STRING(L"TPlaceObject3",13)) return 9;
	if (inName==STRING(L"TRemoveObject2",14)) return 10;
	if (inName==STRING(L"TSandBox",8)) return 16;
	if (inName==STRING(L"TScriptLimits",13)) return 25;
	if (inName==STRING(L"TShape",6)) return 2;
	if (inName==STRING(L"TShowFrame",10)) return 0;
	if (inName==STRING(L"TSound",6)) return 22;
	if (inName==STRING(L"TStartSound",11)) return 23;
	if (inName==STRING(L"TSymbolClass",12)) return 14;
	if (inName==STRING(L"TUnknown",8)) return 30;
	return super::__FindIndex(inName);
}

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TActionScript3,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TBackgroundColor,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TBinaryData,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TBitsJPEG,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TBitsLossless,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TBitsLossless2,return)

STATIC_DEFINE_DYNAMIC_FUNC3(SWFTag_obj,TClip,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TDefineButton2,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TDefineEditText,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TDefineScalingGrid,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TDoAction,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TDoInitActions,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TExportAssets,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TFont,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TFontInfo,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TFrameLabel,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TJPEGTables,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TMetadata,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TMorphShape,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TPlaceObject2,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TPlaceObject3,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TRemoveObject2,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TSandBox,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TScriptLimits,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TShape,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TSound,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TStartSound,return)

STATIC_DEFINE_DYNAMIC_FUNC1(SWFTag_obj,TSymbolClass,return)

STATIC_DEFINE_DYNAMIC_FUNC2(SWFTag_obj,TUnknown,return)

int SWFTag_obj::__FindArgCount(String inName)
{
	if (inName==STRING(L"TActionScript3",14)) return 2;
	if (inName==STRING(L"TBackgroundColor",16)) return 1;
	if (inName==STRING(L"TBinaryData",11)) return 2;
	if (inName==STRING(L"TBitsJPEG",9)) return 2;
	if (inName==STRING(L"TBitsLossless",13)) return 1;
	if (inName==STRING(L"TBitsLossless2",14)) return 1;
	if (inName==STRING(L"TClip",5)) return 3;
	if (inName==STRING(L"TDefineButton2",14)) return 2;
	if (inName==STRING(L"TDefineEditText",15)) return 2;
	if (inName==STRING(L"TDefineScalingGrid",18)) return 2;
	if (inName==STRING(L"TDoAction",9)) return 1;
	if (inName==STRING(L"TDoInitActions",14)) return 2;
	if (inName==STRING(L"TEnd",4)) return 0;
	if (inName==STRING(L"TExportAssets",13)) return 1;
	if (inName==STRING(L"TFont",5)) return 2;
	if (inName==STRING(L"TFontInfo",9)) return 2;
	if (inName==STRING(L"TFrameLabel",11)) return 2;
	if (inName==STRING(L"TJPEGTables",11)) return 1;
	if (inName==STRING(L"TMetadata",9)) return 1;
	if (inName==STRING(L"TMorphShape",11)) return 2;
	if (inName==STRING(L"TPlaceObject2",13)) return 1;
	if (inName==STRING(L"TPlaceObject3",13)) return 1;
	if (inName==STRING(L"TRemoveObject2",14)) return 1;
	if (inName==STRING(L"TSandBox",8)) return 1;
	if (inName==STRING(L"TScriptLimits",13)) return 2;
	if (inName==STRING(L"TShape",6)) return 2;
	if (inName==STRING(L"TShowFrame",10)) return 0;
	if (inName==STRING(L"TSound",6)) return 1;
	if (inName==STRING(L"TStartSound",11)) return 2;
	if (inName==STRING(L"TSymbolClass",12)) return 1;
	if (inName==STRING(L"TUnknown",8)) return 2;
	return super::__FindArgCount(inName);
}

Dynamic SWFTag_obj::__Field(const String &inName)
{
	if (inName==STRING(L"TActionScript3",14)) return TActionScript3_dyn();
	if (inName==STRING(L"TBackgroundColor",16)) return TBackgroundColor_dyn();
	if (inName==STRING(L"TBinaryData",11)) return TBinaryData_dyn();
	if (inName==STRING(L"TBitsJPEG",9)) return TBitsJPEG_dyn();
	if (inName==STRING(L"TBitsLossless",13)) return TBitsLossless_dyn();
	if (inName==STRING(L"TBitsLossless2",14)) return TBitsLossless2_dyn();
	if (inName==STRING(L"TClip",5)) return TClip_dyn();
	if (inName==STRING(L"TDefineButton2",14)) return TDefineButton2_dyn();
	if (inName==STRING(L"TDefineEditText",15)) return TDefineEditText_dyn();
	if (inName==STRING(L"TDefineScalingGrid",18)) return TDefineScalingGrid_dyn();
	if (inName==STRING(L"TDoAction",9)) return TDoAction_dyn();
	if (inName==STRING(L"TDoInitActions",14)) return TDoInitActions_dyn();
	if (inName==STRING(L"TEnd",4)) return TEnd;
	if (inName==STRING(L"TExportAssets",13)) return TExportAssets_dyn();
	if (inName==STRING(L"TFont",5)) return TFont_dyn();
	if (inName==STRING(L"TFontInfo",9)) return TFontInfo_dyn();
	if (inName==STRING(L"TFrameLabel",11)) return TFrameLabel_dyn();
	if (inName==STRING(L"TJPEGTables",11)) return TJPEGTables_dyn();
	if (inName==STRING(L"TMetadata",9)) return TMetadata_dyn();
	if (inName==STRING(L"TMorphShape",11)) return TMorphShape_dyn();
	if (inName==STRING(L"TPlaceObject2",13)) return TPlaceObject2_dyn();
	if (inName==STRING(L"TPlaceObject3",13)) return TPlaceObject3_dyn();
	if (inName==STRING(L"TRemoveObject2",14)) return TRemoveObject2_dyn();
	if (inName==STRING(L"TSandBox",8)) return TSandBox_dyn();
	if (inName==STRING(L"TScriptLimits",13)) return TScriptLimits_dyn();
	if (inName==STRING(L"TShape",6)) return TShape_dyn();
	if (inName==STRING(L"TShowFrame",10)) return TShowFrame;
	if (inName==STRING(L"TSound",6)) return TSound_dyn();
	if (inName==STRING(L"TStartSound",11)) return TStartSound_dyn();
	if (inName==STRING(L"TSymbolClass",12)) return TSymbolClass_dyn();
	if (inName==STRING(L"TUnknown",8)) return TUnknown_dyn();
	return super::__Field(inName);
}

static String sStaticFields[] = {
	STRING(L"TActionScript3",14),
	STRING(L"TBackgroundColor",16),
	STRING(L"TBinaryData",11),
	STRING(L"TBitsJPEG",9),
	STRING(L"TBitsLossless",13),
	STRING(L"TBitsLossless2",14),
	STRING(L"TClip",5),
	STRING(L"TDefineButton2",14),
	STRING(L"TDefineEditText",15),
	STRING(L"TDefineScalingGrid",18),
	STRING(L"TDoAction",9),
	STRING(L"TDoInitActions",14),
	STRING(L"TEnd",4),
	STRING(L"TExportAssets",13),
	STRING(L"TFont",5),
	STRING(L"TFontInfo",9),
	STRING(L"TFrameLabel",11),
	STRING(L"TJPEGTables",11),
	STRING(L"TMetadata",9),
	STRING(L"TMorphShape",11),
	STRING(L"TPlaceObject2",13),
	STRING(L"TPlaceObject3",13),
	STRING(L"TRemoveObject2",14),
	STRING(L"TSandBox",8),
	STRING(L"TScriptLimits",13),
	STRING(L"TShape",6),
	STRING(L"TShowFrame",10),
	STRING(L"TSound",6),
	STRING(L"TStartSound",11),
	STRING(L"TSymbolClass",12),
	STRING(L"TUnknown",8),
	String(null()) };

static void sMarkStatics() {
	MarkMember(SWFTag_obj::TEnd);
	MarkMember(SWFTag_obj::TShowFrame);
};

static String sMemberFields[] = { String(null()) };
Class SWFTag_obj::__mClass;

Dynamic __Create_SWFTag_obj() { return new SWFTag_obj; }

void SWFTag_obj::__register()
{

Static(__mClass) = RegisterClass(STRING(L"format.swf.SWFTag",17), TCanCast<SWFTag_obj >,sStaticFields,sMemberFields,
	&__Create_SWFTag_obj, &__Create,
	&super::__SGetClass(), &CreateSWFTag_obj, sMarkStatics);
}

void SWFTag_obj::__boot()
{
Static(TEnd) = CreateEnum<SWFTag_obj >(STRING(L"TEnd",4),1);
Static(TShowFrame) = CreateEnum<SWFTag_obj >(STRING(L"TShowFrame",10),0);
}


} // end namespace format
} // end namespace swf
