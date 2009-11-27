#ifndef INCLUDED_format_swf_Reader
#define INCLUDED_format_swf_Reader

#include <hxObject.h>

#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
DECLARE_CLASS2(format,swf,BlendMode)
DECLARE_CLASS2(format,swf,FillStyle)
DECLARE_CLASS2(format,swf,Filter)
DECLARE_CLASS2(format,swf,FontData)
DECLARE_CLASS2(format,swf,LangCode)
DECLARE_CLASS2(format,swf,LineCapStyle)
DECLARE_CLASS2(format,swf,Morph2LineStyle)
DECLARE_CLASS2(format,swf,MorphFillStyle)
DECLARE_CLASS2(format,swf,PlaceObject)
DECLARE_CLASS2(format,swf,Reader)
DECLARE_CLASS2(format,swf,SWFTag)
DECLARE_CLASS2(format,swf,ShapeRecord)
DECLARE_CLASS2(format,tools,BitsInput)
DECLARE_CLASS2(haxe,io,Bytes)
DECLARE_CLASS2(haxe,io,Input)
namespace format{
namespace swf{


class Reader_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef Reader_obj OBJ_;

	protected:
		Reader_obj();
		Void __construct(haxe::io::Input i);

	public:
		static hxObjectPtr<Reader_obj > __new(haxe::io::Input i);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~Reader_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"Reader",6); }

		haxe::io::Input i;
		format::tools::BitsInput bits;
		int version;
		int bitsRead;
		virtual int readFixed8( haxe::io::Input i);
		Dynamic readFixed8_dyn();

		virtual cpp::CppInt32__ readFixed( );
		Dynamic readFixed_dyn();

		virtual haxe::io::Bytes readUTF8Bytes( );
		Dynamic readUTF8Bytes_dyn();

		virtual Dynamic readRect( );
		Dynamic readRect_dyn();

		virtual Dynamic readMatrixPart( );
		Dynamic readMatrixPart_dyn();

		virtual Dynamic readMatrix( );
		Dynamic readMatrix_dyn();

		virtual Dynamic readRGBA( haxe::io::Input i);
		Dynamic readRGBA_dyn();

		virtual Dynamic readRGB( haxe::io::Input i);
		Dynamic readRGB_dyn();

		virtual Dynamic readCXAColor( int nbits);
		Dynamic readCXAColor_dyn();

		virtual Dynamic readCXA( );
		Dynamic readCXA_dyn();

		virtual Dynamic readGradient( int ver);
		Dynamic readGradient_dyn();

		virtual format::swf::LineCapStyle getLineCap( int t);
		Dynamic getLineCap_dyn();

		virtual Array<Dynamic > readLineStyles( int ver);
		Dynamic readLineStyles_dyn();

		virtual format::swf::FillStyle readFillStyle( int ver);
		Dynamic readFillStyle_dyn();

		virtual Array<format::swf::FillStyle > readFillStyles( int ver);
		Dynamic readFillStyles_dyn();

		virtual Dynamic readShapeWithStyle( int ver);
		Dynamic readShapeWithStyle_dyn();

		virtual Dynamic readShapeWithoutStyle( int ver);
		Dynamic readShapeWithoutStyle_dyn();

		virtual Array<format::swf::ShapeRecord > readShapeRecords( int ver);
		Dynamic readShapeRecords_dyn();

		virtual Array<Dynamic > readClipEvents( );
		Dynamic readClipEvents_dyn();

		virtual Dynamic readFilterFlags( bool top);
		Dynamic readFilterFlags_dyn();

		virtual Dynamic readFilterGradient( );
		Dynamic readFilterGradient_dyn();

		virtual format::swf::Filter readFilter( );
		Dynamic readFilter_dyn();

		virtual Array<format::swf::Filter > readFilters( );
		Dynamic readFilters_dyn();

		virtual String error( Dynamic msg);
		Dynamic error_dyn();

		virtual Dynamic readHeader( );
		Dynamic readHeader_dyn();

		virtual Array<format::swf::SWFTag > readTagList( );
		Dynamic readTagList_dyn();

		virtual format::swf::SWFTag readShape( int len,int ver);
		Dynamic readShape_dyn();

		virtual Dynamic readMorphGradient( int ver);
		Dynamic readMorphGradient_dyn();

		virtual Array<Dynamic > readMorphGradients( int ver);
		Dynamic readMorphGradients_dyn();

		virtual format::swf::MorphFillStyle readMorphFillStyle( int ver);
		Dynamic readMorphFillStyle_dyn();

		virtual Array<format::swf::MorphFillStyle > readMorphFillStyles( int ver);
		Dynamic readMorphFillStyles_dyn();

		virtual Dynamic readMorph1LineStyle( );
		Dynamic readMorph1LineStyle_dyn();

		virtual format::swf::Morph2LineStyle readMorph2LineStyle( );
		Dynamic readMorph2LineStyle_dyn();

		virtual Array<Dynamic > readMorph1LineStyles( );
		Dynamic readMorph1LineStyles_dyn();

		virtual Array<format::swf::Morph2LineStyle > readMorph2LineStyles( );
		Dynamic readMorph2LineStyles_dyn();

		virtual format::swf::SWFTag readMorphShape( int ver);
		Dynamic readMorphShape_dyn();

		virtual format::swf::BlendMode readBlendMode( );
		Dynamic readBlendMode_dyn();

		virtual format::swf::PlaceObject readPlaceObject( bool v3);
		Dynamic readPlaceObject_dyn();

		virtual Dynamic readLossless( int len,bool v2);
		Dynamic readLossless_dyn();

		virtual Array<Dynamic > readSymbols( );
		Dynamic readSymbols_dyn();

		virtual format::swf::SWFTag readSound( int len);
		Dynamic readSound_dyn();

		virtual format::swf::LangCode readLanguage( );
		Dynamic readLanguage_dyn();

		virtual Array<Dynamic > readGlyphs( int len,Array<int > offsets);
		Dynamic readGlyphs_dyn();

		virtual Dynamic readKerningRecord( bool hasWideCodes);
		Dynamic readKerningRecord_dyn();

		virtual format::swf::FontData readFont1Data( int len);
		Dynamic readFont1Data_dyn();

		virtual format::swf::FontData readFont2Data( int ver);
		Dynamic readFont2Data_dyn();

		virtual format::swf::SWFTag readFont( int len,int ver);
		Dynamic readFont_dyn();

		virtual format::swf::SWFTag readFontInfo( int len,int ver);
		Dynamic readFontInfo_dyn();

		virtual Dynamic readSoundInfo( );
		Dynamic readSoundInfo_dyn();

		virtual Array<Dynamic > readEnvelopeRecords( int count);
		Dynamic readEnvelopeRecords_dyn();

		virtual Dynamic readFileAttributes( );
		Dynamic readFileAttributes_dyn();

		virtual format::swf::SWFTag readTag( );
		Dynamic readTag_dyn();

		virtual Dynamic read( );
		Dynamic read_dyn();

};

} // end namespace format
} // end namespace swf

#endif /* INCLUDED_format_swf_Reader */ 
