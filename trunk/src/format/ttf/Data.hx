package format.ttf;

typedef TTF = 
{
	header:Header,
	directory:Array<Entry>,
	tables:Array<Table>
}
typedef Header=
{
	majorVersion : Int,
	minorVersion : Int,
	numTables : Int,
	searchRange : Int,
	entrySelector : Int,
	rangeShift : Int,
}
typedef Entry=
{
	tableName : String,
	checksum : Int,
	offset : Int,
	length : Int,
}
enum Table
{
	TGlyf(descriptions:Array<GlyfDescription>);
	THmtx(metrics:Array<Metric>);
	TCmap(subtables:Array<CmapSubTable>);
	TKern(kerning:Array<KernSubTable>);
	TName(records:Array<NameRecord>);
	THead(data:HeadData);
	THhea(data:HheaData);
	TLoca(data:LocaData);
	TMaxp(data:MaxpData);
	TPost(data:PostData);
	TOS2(data:OS2Data);
	TUnkn(bytes:haxe.io.Bytes);
}
//GLYF
enum GlyfDescription
{
	TGlyphSimple(header:GlyphHeader, data:GlyphSimple);
	TGlyphComposite(header:GlyphHeader, components:Array<GlyphComponent>);
	TGlyphNull;
}
typedef GlyphHeader=
{
	numberOfContours:Int,
	xMin:Int,
	yMin:Int,
	xMax:Int,
	yMax:Int,
}
typedef GlyphSimple=
{
	endPtsOfContours:Array<Int>,
	instructions:Array<Int>,
	flags:Array<Int>,
	xCoordinates:Array<Int>,
	xDeltas:Array<Int>,
	yCoordinates:Array<Int>,
	yDeltas:Array<Int>
}
typedef GlyphComponent=
{
	flags:Int,
	glyphIndex:Int,
	xtranslate:Null<Int>,
	ytranslate:Null<Int>,
	xscale:Null<Float>,
	yscale:Null<Float>,
	point1 : Null<Int>,
	point2 : Null<Int>,
	scale01 : Null<Float>,
	scale10 : Null<Float>,
	instructions:Null<Array<Int>>
}

//HMTX
typedef Metric=
{
	advanceWidth:Int,
	leftSideBearing:Int
}
//CMAP
enum CmapSubTable
{
	Cmap0(header:CmapHeader, glyphIndexArray:Array<GlyphIndex>);
	Cmap2(header:CmapHeader, glyphIndexArray:Array<GlyphIndex>, subHeaderKeys:Array<Int>, subHeaders:Array<Int> );
	Cmap4(header:CmapHeader, glyphIndexArray:Array<GlyphIndex>);
	Cmap6(header:CmapHeader, glyphIndexArray:Array<GlyphIndex>, firstCode:Int);
	Cmap8(header:CmapHeader, groups:Array<CmapGroup>, is32:Array<Int>);
	Cmap10(header:CmapHeader, glyphIndexArray:Array<Int>, startCharCode:Int,	numChars:Int);
	Cmap12(header:CmapHeader, groups:Array<CmapGroup>);
	CmapUnk(header:CmapHeader, bytes:haxe.io.Bytes);
}
typedef CmapHeader=
{
	platformId:Int,
	platformSpecificId:Int,
	format:Int,
	offset:Int,
	language:Int
}
typedef GlyphIndex=
{
	charCode : Int,
	index : Int,
	char:String 
}
typedef CmapGroup=
{
	startCharCode:Int, 	
	endCharCode:Int ,	
	startGlyphCode:Int 	
}
//KERN
enum KernSubTable
{
	KernSub0(kerningPairs:Array<KerningPair>);
	KernSub1(array:Array<Int>);
}
typedef KerningPair=
{
	left  : Int,
	right : Int,
	value : Int
}
//NAME
typedef NameRecord=
{
	platformId:Int,
	platformSpecificId:Int,
	languageID:Int,
	nameID:Int,
	length:Int,
	offset:Int,
	record:String,
}
//HEAD
typedef HeadData=
{
	version:Int,
	fontRevision:Int,
	checkSumAdjustment:Int,
	magicNumber:Int,
	flags:Int,
	unitsPerEm:Int,
	created:Float,
	modified:Float,
	xMin:Int,
	yMin:Int,
	xMax:Int,
	yMax:Int,
	macStyle:Int,
	lowestRecPPEM:Int,
	fontDirectionHint:Int,
	indexToLocFormat:Int,
	glyphDataFormat:Int
}
//HHEA
typedef HheaData=
{
	version:Int,
	ascender:Int,
	descender:Int,
	lineGap:Int,
	advanceWidthMax:Int,
	minLeftSideBearing:Int,
	minRightSideBearing:Int,
	xMaxExtent:Int,
	caretSlopeRise:Int,
	caretSlopeRun:Int,
	caretOffset:Int,
	reserved:haxe.io.Bytes,
	metricDataFormat:Int,
	numberOfHMetrics:Int
}
//LOCA
typedef LocaData=
{
	offsets:Array<Int>,
	factor:Int
}
//MAXP
typedef MaxpData=
{
	  versionNumber:Int,
	  numGlyphs:Int,
	  maxPoints:Int,
	  maxContours:Int,
	  maxComponentPoints:Int,
	  maxComponentContours:Int,
	  maxZones:Int,
	  maxTwilightPoints:Int,
	  maxStorage:Int,
	  maxFunctionDefs:Int,
	  maxInstructionDefs:Int,
	  maxStackElements:Int,
	  maxSizeOfInstructions:Int,
	  maxComponentElements:Int,
	  maxComponentDepth:Int
}
//POST
typedef PostData=
{
	version:Int,
	italicAngle:Int,
	underlinePosition:Int,
	underlineThickness:Int,
	isFixedPitch:Int,
	minMemType42:Int,
	maxMemType42:Int,
	minMemType1:Int,
	maxMemType1:Int,
	numGlyphs:Int,
	glyphNameIndex:Array<Int>,
	psGlyphName:Array<String>
}
//OS2
typedef OS2Data=
{
	version : Int,
	xAvgCharWidth : Int,
	usWeightClass : Int,
	usWidthClass : Int,
	fsType : Int,
	ySubscriptXSize : Int,
	ySubscriptYSize : Int,
	ySubscriptXOffset : Int,
	ySubscriptYOffset : Int,
	ySuperscriptXSize : Int,
	ySuperscriptYSize : Int,
	ySuperscriptXOffset : Int,
	ySuperscriptYOffset : Int,
	yStrikeoutSize : Int,
	yStrikeoutPosition : Int,
	sFamilyClass : Int,
	
  bFamilyType : Int,
  bSerifStyle : Int,
  bWeight : Int,
  bProportion : Int,
  bContrast : Int,
  bStrokeVariation : Int,
  bArmStyle : Int,
  bLetterform : Int,
  bMidline : Int,
  bXHeight : Int,
	
  ulUnicodeRange1 : Int,
  ulUnicodeRange2 : Int,
  ulUnicodeRange3 : Int,
  ulUnicodeRange4 : Int,
  achVendorID : Int,
  fsSelection : Int,
  usFirstCharIndex : Int,
  usLastCharIndex : Int,
  sTypoAscender : Int,
  sTypoDescender : Int,
  sTypoLineGap : Int,
  usWinAscent : Int,
  usWinDescent : Int,
	/*
  ulCodePageRange1 : Int,
  ulCodePageRange2 : Int,

  sxHeight : Null<Int>,
  sCapHeight : Null<Int>,
  usDefaultChar : Null<Int>,
  usBreakChar : Null<Int>,
  usMaxContext : Null<Int>
	*/
}
typedef UnicodeRange=
{
	var start:Int;
	var end:Int;
}
typedef GlyfPath=
{
	var type:Null<Int>;
	var x:Float;
	var y:Float;
	var cx:Null<Float>;
	var cy:Null<Float>;
}