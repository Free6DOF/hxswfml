#include <hxObject.h>

#ifndef INCLUDED_format_swf_TagId
#include <format/swf/TagId.h>
#endif
namespace format{
namespace swf{

Void TagId_obj::__construct()
{
	return null();
}

TagId_obj::~TagId_obj() { }

Dynamic TagId_obj::__CreateEmpty() { return  new TagId_obj; }
hxObjectPtr<TagId_obj > TagId_obj::__new()
{  hxObjectPtr<TagId_obj > result = new TagId_obj();
	result->__construct();
	return result;}

Dynamic TagId_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<TagId_obj > result = new TagId_obj();
	result->__construct();
	return result;}

int TagId_obj::End;

int TagId_obj::ShowFrame;

int TagId_obj::DefineShape;

int TagId_obj::PlaceObject;

int TagId_obj::RemoveObject;

int TagId_obj::DefineBits;

int TagId_obj::DefineButton;

int TagId_obj::JPEGTables;

int TagId_obj::SetBackgroundColor;

int TagId_obj::DefineFont;

int TagId_obj::DefineText;

int TagId_obj::DoAction;

int TagId_obj::DefineFontInfo;

int TagId_obj::DefineSound;

int TagId_obj::StartSound;

int TagId_obj::DefineButtonSound;

int TagId_obj::SoundStreamHead;

int TagId_obj::SoundStreamBlock;

int TagId_obj::DefineBitsLossless;

int TagId_obj::DefineBitsJPEG2;

int TagId_obj::DefineShape2;

int TagId_obj::DefineButtonCxform;

int TagId_obj::Protect;

int TagId_obj::PlaceObject2;

int TagId_obj::RemoveObject2;

int TagId_obj::DefineShape3;

int TagId_obj::DefineText2;

int TagId_obj::DefineButton2;

int TagId_obj::DefineBitsJPEG3;

int TagId_obj::DefineBitsLossless2;

int TagId_obj::DefineEditText;

int TagId_obj::DefineSprite;

int TagId_obj::FrameLabel;

int TagId_obj::SoundStreamHead2;

int TagId_obj::DefineMorphShape;

int TagId_obj::DefineFont2;

int TagId_obj::ExportAssets;

int TagId_obj::ImportAssets;

int TagId_obj::EnableDebugger;

int TagId_obj::DoInitAction;

int TagId_obj::DefineVideoStream;

int TagId_obj::VideoFrame;

int TagId_obj::DefineFontInfo2;

int TagId_obj::EnableDebugger2;

int TagId_obj::ScriptLimits;

int TagId_obj::SetTabIndex;

int TagId_obj::FileAttributes;

int TagId_obj::PlaceObject3;

int TagId_obj::ImportAssets2;

int TagId_obj::RawABC;

int TagId_obj::DefineFontAlignZones;

int TagId_obj::CSMTextSettings;

int TagId_obj::DefineFont3;

int TagId_obj::SymbolClass;

int TagId_obj::Metadata;

int TagId_obj::DefineScalingGrid;

int TagId_obj::DoABC;

int TagId_obj::DefineShape4;

int TagId_obj::DefineMorphShape2;

int TagId_obj::DefineSceneAndFrameLabelData;

int TagId_obj::DefineBinaryData;

int TagId_obj::DefineFontName;

int TagId_obj::StartSound2;

int TagId_obj::DefineBitsJPEG4;

int TagId_obj::DefineFont4;


TagId_obj::TagId_obj()
{
}

void TagId_obj::__Mark()
{
}

Dynamic TagId_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"End",sizeof(wchar_t)*3) ) { return End; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"DoABC",sizeof(wchar_t)*5) ) { return DoABC; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"RawABC",sizeof(wchar_t)*6) ) { return RawABC; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"Protect",sizeof(wchar_t)*7) ) { return Protect; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"DoAction",sizeof(wchar_t)*8) ) { return DoAction; }
		if (!memcmp(inName.__s,L"Metadata",sizeof(wchar_t)*8) ) { return Metadata; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"ShowFrame",sizeof(wchar_t)*9) ) { return ShowFrame; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"DefineBits",sizeof(wchar_t)*10) ) { return DefineBits; }
		if (!memcmp(inName.__s,L"JPEGTables",sizeof(wchar_t)*10) ) { return JPEGTables; }
		if (!memcmp(inName.__s,L"DefineFont",sizeof(wchar_t)*10) ) { return DefineFont; }
		if (!memcmp(inName.__s,L"DefineText",sizeof(wchar_t)*10) ) { return DefineText; }
		if (!memcmp(inName.__s,L"StartSound",sizeof(wchar_t)*10) ) { return StartSound; }
		if (!memcmp(inName.__s,L"FrameLabel",sizeof(wchar_t)*10) ) { return FrameLabel; }
		if (!memcmp(inName.__s,L"VideoFrame",sizeof(wchar_t)*10) ) { return VideoFrame; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"DefineShape",sizeof(wchar_t)*11) ) { return DefineShape; }
		if (!memcmp(inName.__s,L"PlaceObject",sizeof(wchar_t)*11) ) { return PlaceObject; }
		if (!memcmp(inName.__s,L"DefineSound",sizeof(wchar_t)*11) ) { return DefineSound; }
		if (!memcmp(inName.__s,L"DefineText2",sizeof(wchar_t)*11) ) { return DefineText2; }
		if (!memcmp(inName.__s,L"DefineFont2",sizeof(wchar_t)*11) ) { return DefineFont2; }
		if (!memcmp(inName.__s,L"SetTabIndex",sizeof(wchar_t)*11) ) { return SetTabIndex; }
		if (!memcmp(inName.__s,L"DefineFont3",sizeof(wchar_t)*11) ) { return DefineFont3; }
		if (!memcmp(inName.__s,L"SymbolClass",sizeof(wchar_t)*11) ) { return SymbolClass; }
		if (!memcmp(inName.__s,L"StartSound2",sizeof(wchar_t)*11) ) { return StartSound2; }
		if (!memcmp(inName.__s,L"DefineFont4",sizeof(wchar_t)*11) ) { return DefineFont4; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"RemoveObject",sizeof(wchar_t)*12) ) { return RemoveObject; }
		if (!memcmp(inName.__s,L"DefineButton",sizeof(wchar_t)*12) ) { return DefineButton; }
		if (!memcmp(inName.__s,L"DefineShape2",sizeof(wchar_t)*12) ) { return DefineShape2; }
		if (!memcmp(inName.__s,L"PlaceObject2",sizeof(wchar_t)*12) ) { return PlaceObject2; }
		if (!memcmp(inName.__s,L"DefineShape3",sizeof(wchar_t)*12) ) { return DefineShape3; }
		if (!memcmp(inName.__s,L"DefineSprite",sizeof(wchar_t)*12) ) { return DefineSprite; }
		if (!memcmp(inName.__s,L"ExportAssets",sizeof(wchar_t)*12) ) { return ExportAssets; }
		if (!memcmp(inName.__s,L"ImportAssets",sizeof(wchar_t)*12) ) { return ImportAssets; }
		if (!memcmp(inName.__s,L"DoInitAction",sizeof(wchar_t)*12) ) { return DoInitAction; }
		if (!memcmp(inName.__s,L"ScriptLimits",sizeof(wchar_t)*12) ) { return ScriptLimits; }
		if (!memcmp(inName.__s,L"PlaceObject3",sizeof(wchar_t)*12) ) { return PlaceObject3; }
		if (!memcmp(inName.__s,L"DefineShape4",sizeof(wchar_t)*12) ) { return DefineShape4; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"RemoveObject2",sizeof(wchar_t)*13) ) { return RemoveObject2; }
		if (!memcmp(inName.__s,L"DefineButton2",sizeof(wchar_t)*13) ) { return DefineButton2; }
		if (!memcmp(inName.__s,L"ImportAssets2",sizeof(wchar_t)*13) ) { return ImportAssets2; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"DefineFontInfo",sizeof(wchar_t)*14) ) { return DefineFontInfo; }
		if (!memcmp(inName.__s,L"DefineEditText",sizeof(wchar_t)*14) ) { return DefineEditText; }
		if (!memcmp(inName.__s,L"EnableDebugger",sizeof(wchar_t)*14) ) { return EnableDebugger; }
		if (!memcmp(inName.__s,L"FileAttributes",sizeof(wchar_t)*14) ) { return FileAttributes; }
		if (!memcmp(inName.__s,L"DefineFontName",sizeof(wchar_t)*14) ) { return DefineFontName; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"SoundStreamHead",sizeof(wchar_t)*15) ) { return SoundStreamHead; }
		if (!memcmp(inName.__s,L"DefineBitsJPEG2",sizeof(wchar_t)*15) ) { return DefineBitsJPEG2; }
		if (!memcmp(inName.__s,L"DefineBitsJPEG3",sizeof(wchar_t)*15) ) { return DefineBitsJPEG3; }
		if (!memcmp(inName.__s,L"DefineFontInfo2",sizeof(wchar_t)*15) ) { return DefineFontInfo2; }
		if (!memcmp(inName.__s,L"EnableDebugger2",sizeof(wchar_t)*15) ) { return EnableDebugger2; }
		if (!memcmp(inName.__s,L"CSMTextSettings",sizeof(wchar_t)*15) ) { return CSMTextSettings; }
		if (!memcmp(inName.__s,L"DefineBitsJPEG4",sizeof(wchar_t)*15) ) { return DefineBitsJPEG4; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"SoundStreamBlock",sizeof(wchar_t)*16) ) { return SoundStreamBlock; }
		if (!memcmp(inName.__s,L"SoundStreamHead2",sizeof(wchar_t)*16) ) { return SoundStreamHead2; }
		if (!memcmp(inName.__s,L"DefineMorphShape",sizeof(wchar_t)*16) ) { return DefineMorphShape; }
		if (!memcmp(inName.__s,L"DefineBinaryData",sizeof(wchar_t)*16) ) { return DefineBinaryData; }
		break;
	case 17:
		if (!memcmp(inName.__s,L"DefineButtonSound",sizeof(wchar_t)*17) ) { return DefineButtonSound; }
		if (!memcmp(inName.__s,L"DefineVideoStream",sizeof(wchar_t)*17) ) { return DefineVideoStream; }
		if (!memcmp(inName.__s,L"DefineScalingGrid",sizeof(wchar_t)*17) ) { return DefineScalingGrid; }
		if (!memcmp(inName.__s,L"DefineMorphShape2",sizeof(wchar_t)*17) ) { return DefineMorphShape2; }
		break;
	case 18:
		if (!memcmp(inName.__s,L"SetBackgroundColor",sizeof(wchar_t)*18) ) { return SetBackgroundColor; }
		if (!memcmp(inName.__s,L"DefineBitsLossless",sizeof(wchar_t)*18) ) { return DefineBitsLossless; }
		if (!memcmp(inName.__s,L"DefineButtonCxform",sizeof(wchar_t)*18) ) { return DefineButtonCxform; }
		break;
	case 19:
		if (!memcmp(inName.__s,L"DefineBitsLossless2",sizeof(wchar_t)*19) ) { return DefineBitsLossless2; }
		break;
	case 20:
		if (!memcmp(inName.__s,L"DefineFontAlignZones",sizeof(wchar_t)*20) ) { return DefineFontAlignZones; }
		break;
	case 28:
		if (!memcmp(inName.__s,L"DefineSceneAndFrameLabelData",sizeof(wchar_t)*28) ) { return DefineSceneAndFrameLabelData; }
	}
	return super::__Field(inName);
}

static int __id_End = __hxcpp_field_to_id("End");
static int __id_ShowFrame = __hxcpp_field_to_id("ShowFrame");
static int __id_DefineShape = __hxcpp_field_to_id("DefineShape");
static int __id_PlaceObject = __hxcpp_field_to_id("PlaceObject");
static int __id_RemoveObject = __hxcpp_field_to_id("RemoveObject");
static int __id_DefineBits = __hxcpp_field_to_id("DefineBits");
static int __id_DefineButton = __hxcpp_field_to_id("DefineButton");
static int __id_JPEGTables = __hxcpp_field_to_id("JPEGTables");
static int __id_SetBackgroundColor = __hxcpp_field_to_id("SetBackgroundColor");
static int __id_DefineFont = __hxcpp_field_to_id("DefineFont");
static int __id_DefineText = __hxcpp_field_to_id("DefineText");
static int __id_DoAction = __hxcpp_field_to_id("DoAction");
static int __id_DefineFontInfo = __hxcpp_field_to_id("DefineFontInfo");
static int __id_DefineSound = __hxcpp_field_to_id("DefineSound");
static int __id_StartSound = __hxcpp_field_to_id("StartSound");
static int __id_DefineButtonSound = __hxcpp_field_to_id("DefineButtonSound");
static int __id_SoundStreamHead = __hxcpp_field_to_id("SoundStreamHead");
static int __id_SoundStreamBlock = __hxcpp_field_to_id("SoundStreamBlock");
static int __id_DefineBitsLossless = __hxcpp_field_to_id("DefineBitsLossless");
static int __id_DefineBitsJPEG2 = __hxcpp_field_to_id("DefineBitsJPEG2");
static int __id_DefineShape2 = __hxcpp_field_to_id("DefineShape2");
static int __id_DefineButtonCxform = __hxcpp_field_to_id("DefineButtonCxform");
static int __id_Protect = __hxcpp_field_to_id("Protect");
static int __id_PlaceObject2 = __hxcpp_field_to_id("PlaceObject2");
static int __id_RemoveObject2 = __hxcpp_field_to_id("RemoveObject2");
static int __id_DefineShape3 = __hxcpp_field_to_id("DefineShape3");
static int __id_DefineText2 = __hxcpp_field_to_id("DefineText2");
static int __id_DefineButton2 = __hxcpp_field_to_id("DefineButton2");
static int __id_DefineBitsJPEG3 = __hxcpp_field_to_id("DefineBitsJPEG3");
static int __id_DefineBitsLossless2 = __hxcpp_field_to_id("DefineBitsLossless2");
static int __id_DefineEditText = __hxcpp_field_to_id("DefineEditText");
static int __id_DefineSprite = __hxcpp_field_to_id("DefineSprite");
static int __id_FrameLabel = __hxcpp_field_to_id("FrameLabel");
static int __id_SoundStreamHead2 = __hxcpp_field_to_id("SoundStreamHead2");
static int __id_DefineMorphShape = __hxcpp_field_to_id("DefineMorphShape");
static int __id_DefineFont2 = __hxcpp_field_to_id("DefineFont2");
static int __id_ExportAssets = __hxcpp_field_to_id("ExportAssets");
static int __id_ImportAssets = __hxcpp_field_to_id("ImportAssets");
static int __id_EnableDebugger = __hxcpp_field_to_id("EnableDebugger");
static int __id_DoInitAction = __hxcpp_field_to_id("DoInitAction");
static int __id_DefineVideoStream = __hxcpp_field_to_id("DefineVideoStream");
static int __id_VideoFrame = __hxcpp_field_to_id("VideoFrame");
static int __id_DefineFontInfo2 = __hxcpp_field_to_id("DefineFontInfo2");
static int __id_EnableDebugger2 = __hxcpp_field_to_id("EnableDebugger2");
static int __id_ScriptLimits = __hxcpp_field_to_id("ScriptLimits");
static int __id_SetTabIndex = __hxcpp_field_to_id("SetTabIndex");
static int __id_FileAttributes = __hxcpp_field_to_id("FileAttributes");
static int __id_PlaceObject3 = __hxcpp_field_to_id("PlaceObject3");
static int __id_ImportAssets2 = __hxcpp_field_to_id("ImportAssets2");
static int __id_RawABC = __hxcpp_field_to_id("RawABC");
static int __id_DefineFontAlignZones = __hxcpp_field_to_id("DefineFontAlignZones");
static int __id_CSMTextSettings = __hxcpp_field_to_id("CSMTextSettings");
static int __id_DefineFont3 = __hxcpp_field_to_id("DefineFont3");
static int __id_SymbolClass = __hxcpp_field_to_id("SymbolClass");
static int __id_Metadata = __hxcpp_field_to_id("Metadata");
static int __id_DefineScalingGrid = __hxcpp_field_to_id("DefineScalingGrid");
static int __id_DoABC = __hxcpp_field_to_id("DoABC");
static int __id_DefineShape4 = __hxcpp_field_to_id("DefineShape4");
static int __id_DefineMorphShape2 = __hxcpp_field_to_id("DefineMorphShape2");
static int __id_DefineSceneAndFrameLabelData = __hxcpp_field_to_id("DefineSceneAndFrameLabelData");
static int __id_DefineBinaryData = __hxcpp_field_to_id("DefineBinaryData");
static int __id_DefineFontName = __hxcpp_field_to_id("DefineFontName");
static int __id_StartSound2 = __hxcpp_field_to_id("StartSound2");
static int __id_DefineBitsJPEG4 = __hxcpp_field_to_id("DefineBitsJPEG4");
static int __id_DefineFont4 = __hxcpp_field_to_id("DefineFont4");


Dynamic TagId_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_End) return End;
	if (inFieldID==__id_ShowFrame) return ShowFrame;
	if (inFieldID==__id_DefineShape) return DefineShape;
	if (inFieldID==__id_PlaceObject) return PlaceObject;
	if (inFieldID==__id_RemoveObject) return RemoveObject;
	if (inFieldID==__id_DefineBits) return DefineBits;
	if (inFieldID==__id_DefineButton) return DefineButton;
	if (inFieldID==__id_JPEGTables) return JPEGTables;
	if (inFieldID==__id_SetBackgroundColor) return SetBackgroundColor;
	if (inFieldID==__id_DefineFont) return DefineFont;
	if (inFieldID==__id_DefineText) return DefineText;
	if (inFieldID==__id_DoAction) return DoAction;
	if (inFieldID==__id_DefineFontInfo) return DefineFontInfo;
	if (inFieldID==__id_DefineSound) return DefineSound;
	if (inFieldID==__id_StartSound) return StartSound;
	if (inFieldID==__id_DefineButtonSound) return DefineButtonSound;
	if (inFieldID==__id_SoundStreamHead) return SoundStreamHead;
	if (inFieldID==__id_SoundStreamBlock) return SoundStreamBlock;
	if (inFieldID==__id_DefineBitsLossless) return DefineBitsLossless;
	if (inFieldID==__id_DefineBitsJPEG2) return DefineBitsJPEG2;
	if (inFieldID==__id_DefineShape2) return DefineShape2;
	if (inFieldID==__id_DefineButtonCxform) return DefineButtonCxform;
	if (inFieldID==__id_Protect) return Protect;
	if (inFieldID==__id_PlaceObject2) return PlaceObject2;
	if (inFieldID==__id_RemoveObject2) return RemoveObject2;
	if (inFieldID==__id_DefineShape3) return DefineShape3;
	if (inFieldID==__id_DefineText2) return DefineText2;
	if (inFieldID==__id_DefineButton2) return DefineButton2;
	if (inFieldID==__id_DefineBitsJPEG3) return DefineBitsJPEG3;
	if (inFieldID==__id_DefineBitsLossless2) return DefineBitsLossless2;
	if (inFieldID==__id_DefineEditText) return DefineEditText;
	if (inFieldID==__id_DefineSprite) return DefineSprite;
	if (inFieldID==__id_FrameLabel) return FrameLabel;
	if (inFieldID==__id_SoundStreamHead2) return SoundStreamHead2;
	if (inFieldID==__id_DefineMorphShape) return DefineMorphShape;
	if (inFieldID==__id_DefineFont2) return DefineFont2;
	if (inFieldID==__id_ExportAssets) return ExportAssets;
	if (inFieldID==__id_ImportAssets) return ImportAssets;
	if (inFieldID==__id_EnableDebugger) return EnableDebugger;
	if (inFieldID==__id_DoInitAction) return DoInitAction;
	if (inFieldID==__id_DefineVideoStream) return DefineVideoStream;
	if (inFieldID==__id_VideoFrame) return VideoFrame;
	if (inFieldID==__id_DefineFontInfo2) return DefineFontInfo2;
	if (inFieldID==__id_EnableDebugger2) return EnableDebugger2;
	if (inFieldID==__id_ScriptLimits) return ScriptLimits;
	if (inFieldID==__id_SetTabIndex) return SetTabIndex;
	if (inFieldID==__id_FileAttributes) return FileAttributes;
	if (inFieldID==__id_PlaceObject3) return PlaceObject3;
	if (inFieldID==__id_ImportAssets2) return ImportAssets2;
	if (inFieldID==__id_RawABC) return RawABC;
	if (inFieldID==__id_DefineFontAlignZones) return DefineFontAlignZones;
	if (inFieldID==__id_CSMTextSettings) return CSMTextSettings;
	if (inFieldID==__id_DefineFont3) return DefineFont3;
	if (inFieldID==__id_SymbolClass) return SymbolClass;
	if (inFieldID==__id_Metadata) return Metadata;
	if (inFieldID==__id_DefineScalingGrid) return DefineScalingGrid;
	if (inFieldID==__id_DoABC) return DoABC;
	if (inFieldID==__id_DefineShape4) return DefineShape4;
	if (inFieldID==__id_DefineMorphShape2) return DefineMorphShape2;
	if (inFieldID==__id_DefineSceneAndFrameLabelData) return DefineSceneAndFrameLabelData;
	if (inFieldID==__id_DefineBinaryData) return DefineBinaryData;
	if (inFieldID==__id_DefineFontName) return DefineFontName;
	if (inFieldID==__id_StartSound2) return StartSound2;
	if (inFieldID==__id_DefineBitsJPEG4) return DefineBitsJPEG4;
	if (inFieldID==__id_DefineFont4) return DefineFont4;
	return super::__IField(inFieldID);
}

Dynamic TagId_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 3:
		if (!memcmp(inName.__s,L"End",sizeof(wchar_t)*3) ) { End=inValue.Cast<int >();return inValue; }
		break;
	case 5:
		if (!memcmp(inName.__s,L"DoABC",sizeof(wchar_t)*5) ) { DoABC=inValue.Cast<int >();return inValue; }
		break;
	case 6:
		if (!memcmp(inName.__s,L"RawABC",sizeof(wchar_t)*6) ) { RawABC=inValue.Cast<int >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"Protect",sizeof(wchar_t)*7) ) { Protect=inValue.Cast<int >();return inValue; }
		break;
	case 8:
		if (!memcmp(inName.__s,L"DoAction",sizeof(wchar_t)*8) ) { DoAction=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"Metadata",sizeof(wchar_t)*8) ) { Metadata=inValue.Cast<int >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"ShowFrame",sizeof(wchar_t)*9) ) { ShowFrame=inValue.Cast<int >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"DefineBits",sizeof(wchar_t)*10) ) { DefineBits=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"JPEGTables",sizeof(wchar_t)*10) ) { JPEGTables=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineFont",sizeof(wchar_t)*10) ) { DefineFont=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineText",sizeof(wchar_t)*10) ) { DefineText=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"StartSound",sizeof(wchar_t)*10) ) { StartSound=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"FrameLabel",sizeof(wchar_t)*10) ) { FrameLabel=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"VideoFrame",sizeof(wchar_t)*10) ) { VideoFrame=inValue.Cast<int >();return inValue; }
		break;
	case 11:
		if (!memcmp(inName.__s,L"DefineShape",sizeof(wchar_t)*11) ) { DefineShape=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"PlaceObject",sizeof(wchar_t)*11) ) { PlaceObject=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineSound",sizeof(wchar_t)*11) ) { DefineSound=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineText2",sizeof(wchar_t)*11) ) { DefineText2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineFont2",sizeof(wchar_t)*11) ) { DefineFont2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"SetTabIndex",sizeof(wchar_t)*11) ) { SetTabIndex=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineFont3",sizeof(wchar_t)*11) ) { DefineFont3=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"SymbolClass",sizeof(wchar_t)*11) ) { SymbolClass=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"StartSound2",sizeof(wchar_t)*11) ) { StartSound2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineFont4",sizeof(wchar_t)*11) ) { DefineFont4=inValue.Cast<int >();return inValue; }
		break;
	case 12:
		if (!memcmp(inName.__s,L"RemoveObject",sizeof(wchar_t)*12) ) { RemoveObject=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineButton",sizeof(wchar_t)*12) ) { DefineButton=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineShape2",sizeof(wchar_t)*12) ) { DefineShape2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"PlaceObject2",sizeof(wchar_t)*12) ) { PlaceObject2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineShape3",sizeof(wchar_t)*12) ) { DefineShape3=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineSprite",sizeof(wchar_t)*12) ) { DefineSprite=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"ExportAssets",sizeof(wchar_t)*12) ) { ExportAssets=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"ImportAssets",sizeof(wchar_t)*12) ) { ImportAssets=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DoInitAction",sizeof(wchar_t)*12) ) { DoInitAction=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"ScriptLimits",sizeof(wchar_t)*12) ) { ScriptLimits=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"PlaceObject3",sizeof(wchar_t)*12) ) { PlaceObject3=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineShape4",sizeof(wchar_t)*12) ) { DefineShape4=inValue.Cast<int >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"RemoveObject2",sizeof(wchar_t)*13) ) { RemoveObject2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineButton2",sizeof(wchar_t)*13) ) { DefineButton2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"ImportAssets2",sizeof(wchar_t)*13) ) { ImportAssets2=inValue.Cast<int >();return inValue; }
		break;
	case 14:
		if (!memcmp(inName.__s,L"DefineFontInfo",sizeof(wchar_t)*14) ) { DefineFontInfo=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineEditText",sizeof(wchar_t)*14) ) { DefineEditText=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"EnableDebugger",sizeof(wchar_t)*14) ) { EnableDebugger=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"FileAttributes",sizeof(wchar_t)*14) ) { FileAttributes=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineFontName",sizeof(wchar_t)*14) ) { DefineFontName=inValue.Cast<int >();return inValue; }
		break;
	case 15:
		if (!memcmp(inName.__s,L"SoundStreamHead",sizeof(wchar_t)*15) ) { SoundStreamHead=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineBitsJPEG2",sizeof(wchar_t)*15) ) { DefineBitsJPEG2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineBitsJPEG3",sizeof(wchar_t)*15) ) { DefineBitsJPEG3=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineFontInfo2",sizeof(wchar_t)*15) ) { DefineFontInfo2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"EnableDebugger2",sizeof(wchar_t)*15) ) { EnableDebugger2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"CSMTextSettings",sizeof(wchar_t)*15) ) { CSMTextSettings=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineBitsJPEG4",sizeof(wchar_t)*15) ) { DefineBitsJPEG4=inValue.Cast<int >();return inValue; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"SoundStreamBlock",sizeof(wchar_t)*16) ) { SoundStreamBlock=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"SoundStreamHead2",sizeof(wchar_t)*16) ) { SoundStreamHead2=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineMorphShape",sizeof(wchar_t)*16) ) { DefineMorphShape=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineBinaryData",sizeof(wchar_t)*16) ) { DefineBinaryData=inValue.Cast<int >();return inValue; }
		break;
	case 17:
		if (!memcmp(inName.__s,L"DefineButtonSound",sizeof(wchar_t)*17) ) { DefineButtonSound=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineVideoStream",sizeof(wchar_t)*17) ) { DefineVideoStream=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineScalingGrid",sizeof(wchar_t)*17) ) { DefineScalingGrid=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineMorphShape2",sizeof(wchar_t)*17) ) { DefineMorphShape2=inValue.Cast<int >();return inValue; }
		break;
	case 18:
		if (!memcmp(inName.__s,L"SetBackgroundColor",sizeof(wchar_t)*18) ) { SetBackgroundColor=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineBitsLossless",sizeof(wchar_t)*18) ) { DefineBitsLossless=inValue.Cast<int >();return inValue; }
		if (!memcmp(inName.__s,L"DefineButtonCxform",sizeof(wchar_t)*18) ) { DefineButtonCxform=inValue.Cast<int >();return inValue; }
		break;
	case 19:
		if (!memcmp(inName.__s,L"DefineBitsLossless2",sizeof(wchar_t)*19) ) { DefineBitsLossless2=inValue.Cast<int >();return inValue; }
		break;
	case 20:
		if (!memcmp(inName.__s,L"DefineFontAlignZones",sizeof(wchar_t)*20) ) { DefineFontAlignZones=inValue.Cast<int >();return inValue; }
		break;
	case 28:
		if (!memcmp(inName.__s,L"DefineSceneAndFrameLabelData",sizeof(wchar_t)*28) ) { DefineSceneAndFrameLabelData=inValue.Cast<int >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void TagId_obj::__GetFields(Array<String> &outFields)
{
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	STRING(L"End",3),
	STRING(L"ShowFrame",9),
	STRING(L"DefineShape",11),
	STRING(L"PlaceObject",11),
	STRING(L"RemoveObject",12),
	STRING(L"DefineBits",10),
	STRING(L"DefineButton",12),
	STRING(L"JPEGTables",10),
	STRING(L"SetBackgroundColor",18),
	STRING(L"DefineFont",10),
	STRING(L"DefineText",10),
	STRING(L"DoAction",8),
	STRING(L"DefineFontInfo",14),
	STRING(L"DefineSound",11),
	STRING(L"StartSound",10),
	STRING(L"DefineButtonSound",17),
	STRING(L"SoundStreamHead",15),
	STRING(L"SoundStreamBlock",16),
	STRING(L"DefineBitsLossless",18),
	STRING(L"DefineBitsJPEG2",15),
	STRING(L"DefineShape2",12),
	STRING(L"DefineButtonCxform",18),
	STRING(L"Protect",7),
	STRING(L"PlaceObject2",12),
	STRING(L"RemoveObject2",13),
	STRING(L"DefineShape3",12),
	STRING(L"DefineText2",11),
	STRING(L"DefineButton2",13),
	STRING(L"DefineBitsJPEG3",15),
	STRING(L"DefineBitsLossless2",19),
	STRING(L"DefineEditText",14),
	STRING(L"DefineSprite",12),
	STRING(L"FrameLabel",10),
	STRING(L"SoundStreamHead2",16),
	STRING(L"DefineMorphShape",16),
	STRING(L"DefineFont2",11),
	STRING(L"ExportAssets",12),
	STRING(L"ImportAssets",12),
	STRING(L"EnableDebugger",14),
	STRING(L"DoInitAction",12),
	STRING(L"DefineVideoStream",17),
	STRING(L"VideoFrame",10),
	STRING(L"DefineFontInfo2",15),
	STRING(L"EnableDebugger2",15),
	STRING(L"ScriptLimits",12),
	STRING(L"SetTabIndex",11),
	STRING(L"FileAttributes",14),
	STRING(L"PlaceObject3",12),
	STRING(L"ImportAssets2",13),
	STRING(L"RawABC",6),
	STRING(L"DefineFontAlignZones",20),
	STRING(L"CSMTextSettings",15),
	STRING(L"DefineFont3",11),
	STRING(L"SymbolClass",11),
	STRING(L"Metadata",8),
	STRING(L"DefineScalingGrid",17),
	STRING(L"DoABC",5),
	STRING(L"DefineShape4",12),
	STRING(L"DefineMorphShape2",17),
	STRING(L"DefineSceneAndFrameLabelData",28),
	STRING(L"DefineBinaryData",16),
	STRING(L"DefineFontName",14),
	STRING(L"StartSound2",11),
	STRING(L"DefineBitsJPEG4",15),
	STRING(L"DefineFont4",11),
	String(null()) };

static String sMemberFields[] = {
	String(null()) };

static void sMarkStatics() {
	MarkMember(TagId_obj::End);
	MarkMember(TagId_obj::ShowFrame);
	MarkMember(TagId_obj::DefineShape);
	MarkMember(TagId_obj::PlaceObject);
	MarkMember(TagId_obj::RemoveObject);
	MarkMember(TagId_obj::DefineBits);
	MarkMember(TagId_obj::DefineButton);
	MarkMember(TagId_obj::JPEGTables);
	MarkMember(TagId_obj::SetBackgroundColor);
	MarkMember(TagId_obj::DefineFont);
	MarkMember(TagId_obj::DefineText);
	MarkMember(TagId_obj::DoAction);
	MarkMember(TagId_obj::DefineFontInfo);
	MarkMember(TagId_obj::DefineSound);
	MarkMember(TagId_obj::StartSound);
	MarkMember(TagId_obj::DefineButtonSound);
	MarkMember(TagId_obj::SoundStreamHead);
	MarkMember(TagId_obj::SoundStreamBlock);
	MarkMember(TagId_obj::DefineBitsLossless);
	MarkMember(TagId_obj::DefineBitsJPEG2);
	MarkMember(TagId_obj::DefineShape2);
	MarkMember(TagId_obj::DefineButtonCxform);
	MarkMember(TagId_obj::Protect);
	MarkMember(TagId_obj::PlaceObject2);
	MarkMember(TagId_obj::RemoveObject2);
	MarkMember(TagId_obj::DefineShape3);
	MarkMember(TagId_obj::DefineText2);
	MarkMember(TagId_obj::DefineButton2);
	MarkMember(TagId_obj::DefineBitsJPEG3);
	MarkMember(TagId_obj::DefineBitsLossless2);
	MarkMember(TagId_obj::DefineEditText);
	MarkMember(TagId_obj::DefineSprite);
	MarkMember(TagId_obj::FrameLabel);
	MarkMember(TagId_obj::SoundStreamHead2);
	MarkMember(TagId_obj::DefineMorphShape);
	MarkMember(TagId_obj::DefineFont2);
	MarkMember(TagId_obj::ExportAssets);
	MarkMember(TagId_obj::ImportAssets);
	MarkMember(TagId_obj::EnableDebugger);
	MarkMember(TagId_obj::DoInitAction);
	MarkMember(TagId_obj::DefineVideoStream);
	MarkMember(TagId_obj::VideoFrame);
	MarkMember(TagId_obj::DefineFontInfo2);
	MarkMember(TagId_obj::EnableDebugger2);
	MarkMember(TagId_obj::ScriptLimits);
	MarkMember(TagId_obj::SetTabIndex);
	MarkMember(TagId_obj::FileAttributes);
	MarkMember(TagId_obj::PlaceObject3);
	MarkMember(TagId_obj::ImportAssets2);
	MarkMember(TagId_obj::RawABC);
	MarkMember(TagId_obj::DefineFontAlignZones);
	MarkMember(TagId_obj::CSMTextSettings);
	MarkMember(TagId_obj::DefineFont3);
	MarkMember(TagId_obj::SymbolClass);
	MarkMember(TagId_obj::Metadata);
	MarkMember(TagId_obj::DefineScalingGrid);
	MarkMember(TagId_obj::DoABC);
	MarkMember(TagId_obj::DefineShape4);
	MarkMember(TagId_obj::DefineMorphShape2);
	MarkMember(TagId_obj::DefineSceneAndFrameLabelData);
	MarkMember(TagId_obj::DefineBinaryData);
	MarkMember(TagId_obj::DefineFontName);
	MarkMember(TagId_obj::StartSound2);
	MarkMember(TagId_obj::DefineBitsJPEG4);
	MarkMember(TagId_obj::DefineFont4);
};

Class TagId_obj::__mClass;

void TagId_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"format.swf.TagId",16), TCanCast<TagId_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void TagId_obj::__boot()
{
	Static(End) = 0;
	Static(ShowFrame) = 1;
	Static(DefineShape) = 2;
	Static(PlaceObject) = 4;
	Static(RemoveObject) = 5;
	Static(DefineBits) = 6;
	Static(DefineButton) = 7;
	Static(JPEGTables) = 8;
	Static(SetBackgroundColor) = 9;
	Static(DefineFont) = 10;
	Static(DefineText) = 11;
	Static(DoAction) = 12;
	Static(DefineFontInfo) = 13;
	Static(DefineSound) = 14;
	Static(StartSound) = 15;
	Static(DefineButtonSound) = 17;
	Static(SoundStreamHead) = 18;
	Static(SoundStreamBlock) = 19;
	Static(DefineBitsLossless) = 20;
	Static(DefineBitsJPEG2) = 21;
	Static(DefineShape2) = 22;
	Static(DefineButtonCxform) = 23;
	Static(Protect) = 24;
	Static(PlaceObject2) = 26;
	Static(RemoveObject2) = 28;
	Static(DefineShape3) = 32;
	Static(DefineText2) = 33;
	Static(DefineButton2) = 34;
	Static(DefineBitsJPEG3) = 35;
	Static(DefineBitsLossless2) = 36;
	Static(DefineEditText) = 37;
	Static(DefineSprite) = 39;
	Static(FrameLabel) = 43;
	Static(SoundStreamHead2) = 45;
	Static(DefineMorphShape) = 46;
	Static(DefineFont2) = 48;
	Static(ExportAssets) = 56;
	Static(ImportAssets) = 57;
	Static(EnableDebugger) = 58;
	Static(DoInitAction) = 59;
	Static(DefineVideoStream) = 60;
	Static(VideoFrame) = 61;
	Static(DefineFontInfo2) = 62;
	Static(EnableDebugger2) = 64;
	Static(ScriptLimits) = 65;
	Static(SetTabIndex) = 66;
	Static(FileAttributes) = 69;
	Static(PlaceObject3) = 70;
	Static(ImportAssets2) = 71;
	Static(RawABC) = 72;
	Static(DefineFontAlignZones) = 73;
	Static(CSMTextSettings) = 74;
	Static(DefineFont3) = 75;
	Static(SymbolClass) = 76;
	Static(Metadata) = 77;
	Static(DefineScalingGrid) = 78;
	Static(DoABC) = 82;
	Static(DefineShape4) = 83;
	Static(DefineMorphShape2) = 84;
	Static(DefineSceneAndFrameLabelData) = 86;
	Static(DefineBinaryData) = 87;
	Static(DefineFontName) = 88;
	Static(StartSound2) = 89;
	Static(DefineBitsJPEG4) = 90;
	Static(DefineFont4) = 91;
}

} // end namespace format
} // end namespace swf
