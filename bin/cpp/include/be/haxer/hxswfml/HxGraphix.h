#ifndef INCLUDED_be_haxer_hxswfml_HxGraphix
#define INCLUDED_be_haxer_hxswfml_HxGraphix

#include <hxObject.h>

DECLARE_CLASS3(be,haxer,hxswfml,HxGraphix)
DECLARE_CLASS2(format,swf,FillStyle)
DECLARE_CLASS2(format,swf,SWFTag)
DECLARE_CLASS2(format,swf,ShapeRecord)
namespace be{
namespace haxer{
namespace hxswfml{


class HxGraphix_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef HxGraphix_obj OBJ_;

	protected:
		HxGraphix_obj();
		Void __construct(Dynamic __o_forceShape3);

	public:
		static hxObjectPtr<HxGraphix_obj > __new(Dynamic __o_forceShape3);
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~HxGraphix_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"HxGraphix",9); }

		int _shapeType;
		bool _forceShape3;
		double _xMin;
		double _yMin;
		double _xMax;
		double _yMax;
		double _xMin2;
		double _yMin2;
		double _xMax2;
		double _yMax2;
		bool _boundsInitialized;
		Array<format::swf::FillStyle > _fillStyles;
		Array<Dynamic > _lineStyles;
		Array<format::swf::ShapeRecord > _shapeRecords;
		double _lastX;
		double _lastY;
		bool _stateFillStyle;
		bool _stateLineStyle;
		virtual Void beginFill( Dynamic color,Dynamic alpha);
		Dynamic beginFill_dyn();

		virtual Void beginGradientFill( Dynamic type,Array<Dynamic > colors,Array<Dynamic > alphas,Array<Dynamic > ratios,double x,double y,double scaleX,double scaleY,Dynamic rotate0,Dynamic rotate1);
		Dynamic beginGradientFill_dyn();

		virtual Void beginBitmapFill( int bitmapId,Dynamic x,Dynamic y,Dynamic scaleX,Dynamic scaleY,Dynamic rotate0,Dynamic rotate1,Dynamic repeat,Dynamic smooth);
		Dynamic beginBitmapFill_dyn();

		virtual Void lineStyle( Dynamic width,Dynamic color,Dynamic alpha,Dynamic pixelHinting,Dynamic scaleMode,Dynamic caps,Dynamic joints,Dynamic miterLimit,Dynamic noClose);
		Dynamic lineStyle_dyn();

		virtual Dynamic lineStyle2( Dynamic color,Dynamic alpha,Dynamic pixelHinting,Dynamic scaleMode,Dynamic caps,Dynamic joints,Dynamic miterLimit,Dynamic noClose);
		Dynamic lineStyle2_dyn();

		virtual Void lineTo( double x,double y);
		Dynamic lineTo_dyn();

		virtual Void moveTo( double x,double y);
		Dynamic moveTo_dyn();

		virtual Void curveTo( double cx,double cy,double ax,double ay);
		Dynamic curveTo_dyn();

		virtual Void endFill( );
		Dynamic endFill_dyn();

		virtual Void endLine( );
		Dynamic endLine_dyn();

		virtual Void clear( );
		Dynamic clear_dyn();

		virtual Void drawRect( double x,double y,double width,double height);
		Dynamic drawRect_dyn();

		virtual Void drawRoundRect( double x,double y,double w,double h,double r);
		Dynamic drawRoundRect_dyn();

		virtual Void drawRoundRectComplex( double x,double y,double w,double h,double rtl,double rtr,double rbl,double rbr);
		Dynamic drawRoundRectComplex_dyn();

		virtual Void drawCircle( double x,double y,double r,Dynamic sections);
		Dynamic drawCircle_dyn();

		virtual Void drawEllipse( double x,double y,double w,double h);
		Dynamic drawEllipse_dyn();

		virtual format::swf::SWFTag getTag( int id,Dynamic useWinding,Dynamic useNonScalingStroke,Dynamic useScalingStroke);
		Dynamic getTag_dyn();

		virtual Void initBounds( double x,double y);
		Dynamic initBounds_dyn();

		virtual Dynamic hexToRgba( int color,double alpha);
		Dynamic hexToRgba_dyn();

		virtual double toFloat5( double _float);
		Dynamic toFloat5_dyn();

};

} // end namespace be
} // end namespace haxer
} // end namespace hxswfml

#endif /* INCLUDED_be_haxer_hxswfml_HxGraphix */ 
