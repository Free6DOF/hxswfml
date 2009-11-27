#ifndef INCLUDED_be_haxer_hxgraphix_HxGraphix
#define INCLUDED_be_haxer_hxgraphix_HxGraphix

#include <hxObject.h>

DECLARE_CLASS3(be,haxer,hxgraphix,HxGraphix)
DECLARE_CLASS2(format,swf,FillStyle)
DECLARE_CLASS2(format,swf,SWFTag)
DECLARE_CLASS2(format,swf,ShapeRecord)
namespace be{
namespace haxer{
namespace hxgraphix{


class HxGraphix_obj : public virtual hxObject
{
	public:
		typedef hxObject super;
		typedef HxGraphix_obj OBJ_;

	protected:
		HxGraphix_obj();
		Void __construct();

	public:
		static hxObjectPtr<HxGraphix_obj > __new();
		static Dynamic __CreateEmpty();
		static Dynamic __Create(DynamicArray inArgs);
		~HxGraphix_obj();

		DO_RTTI;
		static void __boot();
		static void __register();
		void __Mark();
		String __ToString() const { return STRING(L"HxGraphix",9); }

		double _xMin;
		double _yMin;
		double _xMax;
		double _yMax;
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

		virtual Void lineStyle( Dynamic width,Dynamic color,Dynamic alpha);
		Dynamic lineStyle_dyn();

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

		virtual format::swf::SWFTag getTag( int id);
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
} // end namespace hxgraphix

#endif /* INCLUDED_be_haxer_hxgraphix_HxGraphix */ 
