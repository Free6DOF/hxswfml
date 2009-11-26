#ifndef INCLUDED_format_swf_TagId
#define INCLUDED_format_swf_TagId

#include <hxObject.h>

DECLARE_CLASS2(format,swf,TagId)
namespace format{
namespace swf{


class TagId_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef TagId_obj OBJ_;

	protected:
		TagId_obj();
		Void __construct();

	public:
		static hxObjectPtr<TagId_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~TagId_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"TagId",5); }

		static int End;
		static int ShowFrame;
		static int DefineShape;
		static int PlaceObject;
		static int RemoveObject;
		static int DefineBits;
		static int DefineButton;
		static int JPEGTables;
		static int SetBackgroundColor;
		static int DefineFont;
		static int DefineText;
		static int DoAction;
		static int DefineFontInfo;
		static int DefineSound;
		static int StartSound;
		static int DefineButtonSound;
		static int SoundStreamHead;
		static int SoundStreamBlock;
		static int DefineBitsLossless;
		static int DefineBitsJPEG2;
		static int DefineShape2;
		static int DefineButtonCxform;
		static int Protect;
		static int PlaceObject2;
		static int RemoveObject2;
		static int DefineShape3;
		static int DefineText2;
		static int DefineButton2;
		static int DefineBitsJPEG3;
		static int DefineBitsLossless2;
		static int DefineEditText;
		static int DefineSprite;
		static int FrameLabel;
		static int SoundStreamHead2;
		static int DefineMorphShape;
		static int DefineFont2;
		static int ExportAssets;
		static int ImportAssets;
		static int EnableDebugger;
		static int DoInitAction;
		static int DefineVideoStream;
		static int VideoFrame;
		static int DefineFontInfo2;
		static int EnableDebugger2;
		static int ScriptLimits;
		static int SetTabIndex;
		static int FileAttributes;
		static int PlaceObject3;
		static int ImportAssets2;
		static int RawABC;
		static int DefineFontAlignZones;
		static int CSMTextSettings;
		static int DefineFont3;
		static int SymbolClass;
		static int Metadata;
		static int DefineScalingGrid;
		static int DoABC;
		static int DefineShape4;
		static int DefineMorphShape2;
		static int DefineSceneAndFrameLabelData;
		static int DefineBinaryData;
		static int DefineFontName;
		static int StartSound2;
		static int DefineBitsJPEG4;
		static int DefineFont4;
};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_TagId */ 
