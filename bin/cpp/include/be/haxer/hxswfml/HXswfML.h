#ifndef INCLUDED_be_haxer_hxswfml_HXswfML
#define INCLUDED_be_haxer_hxswfml_HXswfML

#include <hxObject.h>

DECLARE_CLASS0(Hash)
DECLARE_CLASS3(be,haxer,hxswfml,HXswfML)
DECLARE_CLASS1(cpp,CppXml__)
DECLARE_CLASS2(format,swf,SWFTag)
DECLARE_CLASS2(haxe,io,Bytes)
namespace be{
namespace haxer{
namespace hxswfml{


class HXswfML_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef HXswfML_obj OBJ_;

	protected:
		HXswfML_obj();
		Void __construct(Dynamic __o_strict);

	public:
		static hxObjectPtr<HXswfML_obj > __new(Dynamic __o_strict);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~HXswfML_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"HXswfML",7); }

		cpp::CppXml__ currentTag;
		Array<String > validBaseClasses;
		Hash validElements;
		Hash validChildren;
		Array<Array<String > > swcClasses;
		Array<Array<int > > bitmapIds;
		Array<String > dictionary;
		bool strict;
		Hash library;
		virtual haxe::io::Bytes xml2swf( String input,String fileOut);
		Dynamic xml2swf_dyn();

		virtual Void createSWF( cpp::CppXml__ xml,Dynamic swfWriter);
		Dynamic createSWF_dyn();

		virtual Dynamic header( );
		Dynamic header_dyn();

		virtual format::swf::SWFTag fileAttributes( );
		Dynamic fileAttributes_dyn();

		virtual format::swf::SWFTag setBackgroundColor( );
		Dynamic setBackgroundColor_dyn();

		virtual format::swf::SWFTag scriptLimits( );
		Dynamic scriptLimits_dyn();

		virtual format::swf::SWFTag defineBitsJPEG( );
		Dynamic defineBitsJPEG_dyn();

		virtual format::swf::SWFTag defineShape( );
		Dynamic defineShape_dyn();

		virtual format::swf::SWFTag defineSprite( );
		Dynamic defineSprite_dyn();

		virtual format::swf::SWFTag defineButton2( );
		Dynamic defineButton2_dyn();

		virtual format::swf::SWFTag defineSound( );
		Dynamic defineSound_dyn();

		virtual format::swf::SWFTag defineBinaryData( );
		Dynamic defineBinaryData_dyn();

		virtual format::swf::SWFTag defineFont( );
		Dynamic defineFont_dyn();

		virtual format::swf::SWFTag defineEditText( );
		Dynamic defineEditText_dyn();

		virtual Array<format::swf::SWFTag > defineABC( );
		Dynamic defineABC_dyn();

		virtual format::swf::SWFTag defineScalingGrid( );
		Dynamic defineScalingGrid_dyn();

		virtual format::swf::SWFTag placeObject2( );
		Dynamic placeObject2_dyn();

		virtual format::swf::SWFTag moveObject( int depth,int x,int y,Dynamic scaleX,Dynamic scaleY,Dynamic rs0,Dynamic rs1);
		Dynamic moveObject_dyn();

		virtual Array<format::swf::SWFTag > tween( );
		Dynamic tween_dyn();

		virtual format::swf::SWFTag removeObject2( );
		Dynamic removeObject2_dyn();

		virtual format::swf::SWFTag startSound( );
		Dynamic startSound_dyn();

		virtual Array<format::swf::SWFTag > symbolClass( );
		Dynamic symbolClass_dyn();

		virtual Array<format::swf::SWFTag > exportAssets( );
		Dynamic exportAssets_dyn();

		virtual format::swf::SWFTag metadata( );
		Dynamic metadata_dyn();

		virtual format::swf::SWFTag frameLabel( );
		Dynamic frameLabel_dyn();

		virtual format::swf::SWFTag showFrame( );
		Dynamic showFrame_dyn();

		virtual format::swf::SWFTag endFrame( );
		Dynamic endFrame_dyn();

		virtual format::swf::SWFTag custom( );
		Dynamic custom_dyn();

		virtual Void storeWidthHeight( int id,String fileName,haxe::io::Bytes b);
		Dynamic storeWidthHeight_dyn();

		virtual format::swf::SWFTag createABC( String className,String baseClass);
		Dynamic createABC_dyn();

		virtual String getContent( String file);
		Dynamic getContent_dyn();

		virtual haxe::io::Bytes getBytes( String file);
		Dynamic getBytes_dyn();

		virtual Dynamic getInt( String att,Dynamic defaultValue,Dynamic required,Dynamic uniqueId,Dynamic targetId);
		Dynamic getInt_dyn();

		virtual bool getBool( String att,bool defaultValue,Dynamic required);
		Dynamic getBool_dyn();

		virtual Dynamic getFloat( String att,Dynamic defaultValue,Dynamic required);
		Dynamic getFloat_dyn();

		virtual String getString( String att,String defaultValue,Dynamic required);
		Dynamic getString_dyn();

		virtual Dynamic getMatrix( );
		Dynamic getMatrix_dyn();

		virtual Void checkDictionary( int id);
		Dynamic checkDictionary_dyn();

		virtual Void checkTargetId( int id);
		Dynamic checkTargetId_dyn();

		virtual Void checkFileExistence( String file);
		Dynamic checkFileExistence_dyn();

		virtual Void setup( );
		Dynamic setup_dyn();

		virtual Void checkUnknownAttributes( );
		Dynamic checkUnknownAttributes_dyn();

		virtual bool checkValidAttribute( String a);
		Dynamic checkValidAttribute_dyn();

		virtual bool checkValidBaseClass( String c);
		Dynamic checkValidBaseClass_dyn();

		virtual String createXML( double mod);
		Dynamic createXML_dyn();

		virtual Void error( String msg);
		Dynamic error_dyn();

		virtual Void inform( String msg);
		Dynamic inform_dyn();

};

} // end namespace be
} // end namespace haxer
} // end namespace hxswfml

#endif /* INCLUDED_be_haxer_hxswfml_HXswfML */ 
