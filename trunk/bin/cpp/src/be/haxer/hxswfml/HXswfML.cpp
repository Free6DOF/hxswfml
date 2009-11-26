#include <hxObject.h>

#ifndef INCLUDED_Hash
#include <Hash.h>
#endif
#ifndef INCLUDED_List
#include <List.h>
#endif
#ifndef INCLUDED_hxMath
#include <hxMath.h>
#endif
#ifndef INCLUDED_Std
#include <Std.h>
#endif
#ifndef INCLUDED_StringTools
#include <StringTools.h>
#endif
#ifndef INCLUDED_be_haxer_hxgraphix_HxGraphix
#include <be/haxer/hxgraphix/HxGraphix.h>
#endif
#ifndef INCLUDED_be_haxer_hxswfml_HXswfML
#include <be/haxer/hxswfml/HXswfML.h>
#endif
#ifndef INCLUDED_cpp_CppDate__
#include <cpp/CppDate__.h>
#endif
#ifndef INCLUDED_cpp_CppInt32__
#include <cpp/CppInt32__.h>
#endif
#ifndef INCLUDED_cpp_CppXml__
#include <cpp/CppXml__.h>
#endif
#ifndef INCLUDED_cpp_FileSystem
#include <cpp/FileSystem.h>
#endif
#ifndef INCLUDED_cpp_Lib
#include <cpp/Lib.h>
#endif
#ifndef INCLUDED_cpp_io_File
#include <cpp/io/File.h>
#endif
#ifndef INCLUDED_format_abc_ABCData
#include <format/abc/ABCData.h>
#endif
#ifndef INCLUDED_format_abc_Context
#include <format/abc/Context.h>
#endif
#ifndef INCLUDED_format_abc_Index
#include <format/abc/Index.h>
#endif
#ifndef INCLUDED_format_abc_OpCode
#include <format/abc/OpCode.h>
#endif
#ifndef INCLUDED_format_abc_Writer
#include <format/abc/Writer.h>
#endif
#ifndef INCLUDED_format_mp3_ChannelMode
#include <format/mp3/ChannelMode.h>
#endif
#ifndef INCLUDED_format_mp3_Reader
#include <format/mp3/Reader.h>
#endif
#ifndef INCLUDED_format_mp3_SamplingRate
#include <format/mp3/SamplingRate.h>
#endif
#ifndef INCLUDED_format_mp3_Writer
#include <format/mp3/Writer.h>
#endif
#ifndef INCLUDED_format_swf_BlendMode
#include <format/swf/BlendMode.h>
#endif
#ifndef INCLUDED_format_swf_FillStyle
#include <format/swf/FillStyle.h>
#endif
#ifndef INCLUDED_format_swf_Filter
#include <format/swf/Filter.h>
#endif
#ifndef INCLUDED_format_swf_FontData
#include <format/swf/FontData.h>
#endif
#ifndef INCLUDED_format_swf_JPEGData
#include <format/swf/JPEGData.h>
#endif
#ifndef INCLUDED_format_swf_PlaceObject
#include <format/swf/PlaceObject.h>
#endif
#ifndef INCLUDED_format_swf_Reader
#include <format/swf/Reader.h>
#endif
#ifndef INCLUDED_format_swf_SWFTag
#include <format/swf/SWFTag.h>
#endif
#ifndef INCLUDED_format_swf_ShapeData
#include <format/swf/ShapeData.h>
#endif
#ifndef INCLUDED_format_swf_ShapeRecord
#include <format/swf/ShapeRecord.h>
#endif
#ifndef INCLUDED_format_swf_SoundData
#include <format/swf/SoundData.h>
#endif
#ifndef INCLUDED_format_swf_SoundFormat
#include <format/swf/SoundFormat.h>
#endif
#ifndef INCLUDED_format_swf_SoundRate
#include <format/swf/SoundRate.h>
#endif
#ifndef INCLUDED_format_swf_Writer
#include <format/swf/Writer.h>
#endif
#ifndef INCLUDED_format_tools_CRC32
#include <format/tools/CRC32.h>
#endif
#ifndef INCLUDED_format_zip_Writer
#include <format/zip/Writer.h>
#endif
#ifndef INCLUDED_haxe_io_Bytes
#include <haxe/io/Bytes.h>
#endif
#ifndef INCLUDED_haxe_io_BytesBuffer
#include <haxe/io/BytesBuffer.h>
#endif
#ifndef INCLUDED_haxe_io_BytesInput
#include <haxe/io/BytesInput.h>
#endif
#ifndef INCLUDED_haxe_io_BytesOutput
#include <haxe/io/BytesOutput.h>
#endif
#ifndef INCLUDED_haxe_io_Input
#include <haxe/io/Input.h>
#endif
#ifndef INCLUDED_haxe_io_Output
#include <haxe/io/Output.h>
#endif
namespace be{
namespace haxer{
namespace hxswfml{

Void HXswfML_obj::__construct(Dynamic __o_strict)
{
bool strict = __o_strict.Default(true);
{
	this->strict = strict;
	this->bitmapIds = Array_obj<Array<int > >::__new();
	this->dictionary = Array_obj<String >::__new();
	this->swcClasses = Array_obj<Array<String > >::__new();
	this->library = Hash_obj::__new();
	this->setup();
}
;
	return null();
}

HXswfML_obj::~HXswfML_obj() { }

Dynamic HXswfML_obj::__CreateEmpty() { return  new HXswfML_obj; }
hxObjectPtr<HXswfML_obj > HXswfML_obj::__new(Dynamic __o_strict)
{  hxObjectPtr<HXswfML_obj > result = new HXswfML_obj();
	result->__construct(__o_strict);
	return result;}

Dynamic HXswfML_obj::__Create(DynamicArray inArgs)
{  hxObjectPtr<HXswfML_obj > result = new HXswfML_obj();
	result->__construct(inArgs[0]);
	return result;}

haxe::io::Bytes HXswfML_obj::xml2swf( String input,String fileOut){
	cpp::CppXml__ xml = cpp::CppXml___obj::parse(input);
	haxe::io::BytesOutput swfBytesOutput = haxe::io::BytesOutput_obj::__new();
	format::swf::Writer swfWriter = format::swf::Writer_obj::__new(swfBytesOutput);
	this->createSWF(xml,swfWriter);
	haxe::io::Bytes swfBytes = swfBytesOutput->getBytes();
	if (StringTools_obj::endsWith(fileOut,STRING(L".swf",4))){
		return swfBytes;
	}
	else
		if (StringTools_obj::endsWith(fileOut,STRING(L".swc",4))){
		cpp::CppDate__ date = cpp::CppDate___obj::now();
		double mod = date->getTime();
		haxe::io::BytesOutput xmlBytesOutput = haxe::io::BytesOutput_obj::__new();
		xmlBytesOutput->write(haxe::io::Bytes_obj::ofString(this->createXML(mod)));
		haxe::io::Bytes xmlBytes = xmlBytesOutput->getBytes();
		haxe::io::BytesOutput zipBytesOutput = haxe::io::BytesOutput_obj::__new();
		format::zip::Writer zipWriter = format::zip::Writer_obj::__new(zipBytesOutput);
		List data = List_obj::__new();
		data->push(hxAnon_obj::Create()->Add( STRING(L"fileName",8) , STRING(L"catalog.xml",11))->Add( STRING(L"fileSize",8) , xmlBytes->length)->Add( STRING(L"fileTime",8) , date)->Add( STRING(L"compressed",10) , false)->Add( STRING(L"dataSize",8) , xmlBytes->length)->Add( STRING(L"data",4) , xmlBytes)->Add( STRING(L"crc32",5) , format::tools::CRC32_obj::encode(xmlBytes))->Add( STRING(L"extraFields",11) , null()));
		data->push(hxAnon_obj::Create()->Add( STRING(L"fileName",8) , STRING(L"library.swf",11))->Add( STRING(L"fileSize",8) , swfBytes->length)->Add( STRING(L"fileTime",8) , date)->Add( STRING(L"compressed",10) , false)->Add( STRING(L"dataSize",8) , swfBytes->length)->Add( STRING(L"data",4) , swfBytes)->Add( STRING(L"crc32",5) , format::tools::CRC32_obj::encode(swfBytes))->Add( STRING(L"extraFields",11) , null()));
		zipWriter->writeData(data);
		return zipBytesOutput->getBytes();
	}
	else{
		this->error(STRING(L"!ERROR: Supported file formats for output are .swf and .swc",59));
		return null();
	}
;
;
}


DEFINE_DYNAMIC_FUNC2(HXswfML_obj,xml2swf,return )

Void HXswfML_obj::createSWF( cpp::CppXml__ xml,Dynamic swfWriter){
{
		cpp::CppXml__ swf = xml->firstElement();
		for(Dynamic __it = swf->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ tag = __it->__Field(STRING(L"next",4))();
			{
				this->currentTag = tag;
				this->checkUnknownAttributes();
				String _switch_1 = (this->currentTag->getNodeName().toLowerCase());
				if (  ( _switch_1==STRING(L"header",6))){
					swfWriter->__Field(STRING(L"writeHeader",11))(this->header());
				}
				else if (  ( _switch_1==STRING(L"fileattributes",14))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->fileAttributes());
				}
				else if (  ( _switch_1==STRING(L"setbackgroundcolor",18))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->setBackgroundColor());
				}
				else if (  ( _switch_1==STRING(L"scriptlimits",12))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->scriptLimits());
				}
				else if (  ( _switch_1==STRING(L"definebitsjpeg",14))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->defineBitsJPEG());
				}
				else if (  ( _switch_1==STRING(L"defineshape",11))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->defineShape());
				}
				else if (  ( _switch_1==STRING(L"definesprite",12))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->defineSprite());
				}
				else if (  ( _switch_1==STRING(L"definebutton",12))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->defineButton2());
				}
				else if (  ( _switch_1==STRING(L"definebinarydata",16))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->defineBinaryData());
				}
				else if (  ( _switch_1==STRING(L"definesound",11))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->defineSound());
				}
				else if (  ( _switch_1==STRING(L"definefont",10))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->defineFont());
				}
				else if (  ( _switch_1==STRING(L"defineedittext",14))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->defineEditText());
				}
				else if (  ( _switch_1==STRING(L"defineabc",9))){
					{
						int _g = 0;
						Array<format::swf::SWFTag > _g1 = this->defineABC();
						while(_g < _g1->length){
							format::swf::SWFTag tag1 = _g1->__get(_g);
							++_g;
							swfWriter->__Field(STRING(L"writeTag",8))(tag1);
						}
					}
				}
				else if (  ( _switch_1==STRING(L"definescalinggrid",17))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->defineScalingGrid());
				}
				else if (  ( _switch_1==STRING(L"placeobject",11))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->placeObject2());
				}
				else if (  ( _switch_1==STRING(L"removeobject",12))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->removeObject2());
				}
				else if (  ( _switch_1==STRING(L"startsound",10))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->startSound());
				}
				else if (  ( _switch_1==STRING(L"symbolclass",11))){
					{
						int _g = 0;
						Array<format::swf::SWFTag > _g1 = this->symbolClass();
						while(_g < _g1->length){
							format::swf::SWFTag tag1 = _g1->__get(_g);
							++_g;
							swfWriter->__Field(STRING(L"writeTag",8))(tag1);
						}
					}
				}
				else if (  ( _switch_1==STRING(L"exportassets",12))){
					{
						int _g = 0;
						Array<format::swf::SWFTag > _g1 = this->exportAssets();
						while(_g < _g1->length){
							format::swf::SWFTag tag1 = _g1->__get(_g);
							++_g;
							swfWriter->__Field(STRING(L"writeTag",8))(tag1);
						}
					}
				}
				else if (  ( _switch_1==STRING(L"metadata",8))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->metadata());
				}
				else if (  ( _switch_1==STRING(L"framelabel",10))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->frameLabel());
				}
				else if (  ( _switch_1==STRING(L"showframe",9))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->showFrame());
				}
				else if (  ( _switch_1==STRING(L"endframe",8))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->endFrame());
				}
				else if (  ( _switch_1==STRING(L"tween",5))){
					{
						int _g = 0;
						Array<format::swf::SWFTag > _g1 = this->tween();
						while(_g < _g1->length){
							format::swf::SWFTag tag1 = _g1->__get(_g);
							++_g;
							swfWriter->__Field(STRING(L"writeTag",8))(tag1);
						}
					}
				}
				else if (  ( _switch_1==STRING(L"custom",6))){
					swfWriter->__Field(STRING(L"writeTag",8))(this->custom());
				}
				else  {
					this->error(STRING(L"!ERROR: ",8) + this->currentTag->getNodeName() + STRING(L" is not allowed inside an swf element. Valid children are: ",59) + this->validChildren->get(STRING(L"swf",3)).Cast<Array<String > >()->toString() + STRING(L". TAG: ",7) + this->currentTag->toString());
				}
;
;
			}
;
		}
		swfWriter->__Field(STRING(L"writeEnd",8))();
	}
return null();
}


DEFINE_DYNAMIC_FUNC2(HXswfML_obj,createSWF,(void))

Dynamic HXswfML_obj::header( ){
	return hxAnon_obj::Create()->Add( STRING(L"version",7) , this->getInt(STRING(L"version",7),10,null(),null(),null()))->Add( STRING(L"compressed",10) , this->getBool(STRING(L"compressed",10),true,null()))->Add( STRING(L"width",5) , this->getInt(STRING(L"width",5),800,null(),null(),null()))->Add( STRING(L"height",6) , this->getInt(STRING(L"height",6),600,null(),null(),null()))->Add( STRING(L"fps",3) , this->getInt(STRING(L"fps",3),30,null(),null(),null()))->Add( STRING(L"nframes",7) , this->getInt(STRING(L"frameCount",10),1,null(),null(),null()));
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,header,return )

format::swf::SWFTag HXswfML_obj::fileAttributes( ){
	return format::swf::SWFTag_obj::TSandBox(hxAnon_obj::Create()->Add( STRING(L"useDirectBlit",13) , this->getBool(STRING(L"useDirectBlit",13),false,null()))->Add( STRING(L"useGPU",6) , this->getBool(STRING(L"useGPU",6),false,null()))->Add( STRING(L"hasMetaData",11) , this->getBool(STRING(L"hasMetaData",11),false,null()))->Add( STRING(L"actionscript3",13) , this->getBool(STRING(L"actionscript3",13),true,null()))->Add( STRING(L"useNetWork",10) , this->getBool(STRING(L"useNetwork",10),false,null())));
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,fileAttributes,return )

format::swf::SWFTag HXswfML_obj::setBackgroundColor( ){
	return format::swf::SWFTag_obj::TBackgroundColor(this->getInt(STRING(L"color",5),16777215,null(),null(),null()));
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,setBackgroundColor,return )

format::swf::SWFTag HXswfML_obj::scriptLimits( ){
	Dynamic maxRecursion = this->getInt(STRING(L"maxRecursionDepth",17),256,null(),null(),null());
	Dynamic timeoutSeconds = this->getInt(STRING(L"scriptTimeoutSeconds",20),15,null(),null(),null());
	return format::swf::SWFTag_obj::TScriptLimits(maxRecursion,timeoutSeconds);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,scriptLimits,return )

format::swf::SWFTag HXswfML_obj::defineBitsJPEG( ){
	Dynamic id = this->getInt(STRING(L"id",2),null(),true,true,null());
	String file = this->getString(STRING(L"file",4),STRING(L"",0),true);
	haxe::io::Bytes bytes = this->getBytes(file);
	this->storeWidthHeight(id,file,bytes);
	return format::swf::SWFTag_obj::TBitsJPEG(id,format::swf::JPEGData_obj::JDJPEG2(bytes));
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineBitsJPEG,return )

format::swf::SWFTag HXswfML_obj::defineShape( ){
	Dynamic id = this->getInt(STRING(L"id",2),null(),true,true,null());
	Dynamic bounds;
	Dynamic shapeWithStyle;
	if (this->currentTag->exists(STRING(L"bitmapId",8))){
		Dynamic bitmapId = this->getInt(STRING(L"bitmapId",8),null(),null(),null(),null());
		if (this->strict){
			if (this->dictionary->__get(bitmapId) != STRING(L"definebitsjpeg",14)){
				this->error(STRING(L"!ERROR: bitmapId ",17) + bitmapId + STRING(L" must be a reference to a DefineBitsJPEG tag. TAG: ",51) + this->currentTag->toString());
			}
		}
		int width = this->bitmapIds->__get(bitmapId)->__get(0) * 20;
		int height = this->bitmapIds->__get(bitmapId)->__get(1) * 20;
		double scaleX = this->getFloat(STRING(L"scaleX",6),1.0,null()) * 20;
		double scaleY = this->getFloat(STRING(L"scaleY",6),1.0,null()) * 20;
		Dynamic scale = hxAnon_obj::Create()->Add( STRING(L"x",1) , scaleX)->Add( STRING(L"y",1) , scaleY);
		Dynamic rotate0 = this->getFloat(STRING(L"rotate0",7),0.0,null());
		Dynamic rotate1 = this->getFloat(STRING(L"rotate1",7),0.0,null());
		Dynamic rotate = hxAnon_obj::Create()->Add( STRING(L"rs0",3) , rotate0)->Add( STRING(L"rs1",3) , rotate1);
		int x = this->getInt(STRING(L"x",1),0,null(),null(),null()) * 20;
		int y = this->getInt(STRING(L"y",1),0,null(),null(),null()) * 20;
		Dynamic translate = hxAnon_obj::Create()->Add( STRING(L"x",1) , x)->Add( STRING(L"y",1) , y);
		bool repeat = this->getBool(STRING(L"repeat",6),false,null());
		bool smooth = this->getBool(STRING(L"smooth",6),false,null());
		bounds = hxAnon_obj::Create()->Add( STRING(L"left",4) , x)->Add( STRING(L"right",5) , x + width)->Add( STRING(L"top",3) , y)->Add( STRING(L"bottom",6) , y + height);
		shapeWithStyle = hxAnon_obj::Create()->Add( STRING(L"fillStyles",10) , Array_obj<format::swf::FillStyle >::__new().Add(format::swf::FillStyle_obj::FSBitmap(bitmapId,hxAnon_obj::Create()->Add( STRING(L"scale",5) , scale)->Add( STRING(L"rotate",6) , rotate)->Add( STRING(L"translate",9) , translate),repeat,smooth)))->Add( STRING(L"lineStyles",10) , Array_obj<Dynamic >::__new())->Add( STRING(L"shapeRecords",12) , Array_obj<format::swf::ShapeRecord >::__new().Add(format::swf::ShapeRecord_obj::SHRChange(hxAnon_obj::Create()->Add( STRING(L"moveTo",6) , hxAnon_obj::Create()->Add( STRING(L"dx",2) , x + width)->Add( STRING(L"dy",2) , y))->Add( STRING(L"fillStyle0",10) , hxAnon_obj::Create()->Add( STRING(L"idx",3) , 1))->Add( STRING(L"fillStyle1",10) , null())->Add( STRING(L"lineStyle",9) , null())->Add( STRING(L"newStyles",9) , null()))).Add(format::swf::ShapeRecord_obj::SHREdge(x,y + height)).Add(format::swf::ShapeRecord_obj::SHREdge(x - width,y)).Add(format::swf::ShapeRecord_obj::SHREdge(x,y - height)).Add(format::swf::ShapeRecord_obj::SHREdge(x + width,y)).Add(format::swf::ShapeRecord_obj::SHREnd));
		return format::swf::SWFTag_obj::TShape(id,format::swf::ShapeData_obj::SHDShape1(bounds,shapeWithStyle));
	}
	else{
		be::haxer::hxgraphix::HxGraphix hxg = be::haxer::hxgraphix::HxGraphix_obj::__new();
		for(Dynamic __it = this->currentTag->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ cmd = __it->__Field(STRING(L"next",4))();
			{
				this->currentTag = cmd;
				this->checkUnknownAttributes();
				String _switch_2 = (this->currentTag->getNodeName().toLowerCase());
				if (  ( _switch_2==STRING(L"beginfill",9))){
					Dynamic color = this->getInt(STRING(L"color",5),0,null(),null(),null());
					Dynamic alpha = this->getFloat(STRING(L"alpha",5),1.0,null());
					hxg->beginFill(color,alpha);
				}
				else if (  ( _switch_2==STRING(L"begingradientfill",17))){
					String type = this->getString(STRING(L"type",4),STRING(L"",0),true);
					String _switch_3 = (type);
					if (  ( _switch_3==STRING(L"linear",6)) ||  ( _switch_3==STRING(L"radial",6))){
						Array<String > colors = this->getString(STRING(L"colors",6),STRING(L"",0),true).split(STRING(L",",1));
						Array<String > alphas = this->getString(STRING(L"alphas",6),STRING(L"",0),true).split(STRING(L",",1));
						Array<String > ratios = this->getString(STRING(L"ratios",6),STRING(L"",0),true).split(STRING(L",",1));
						Dynamic x = this->getFloat(STRING(L"x",1),0.0,null());
						Dynamic y = this->getFloat(STRING(L"y",1),0.0,null());
						Dynamic scaleX = this->getFloat(STRING(L"scaleX",6),1.0,null());
						Dynamic scaleY = this->getFloat(STRING(L"scaleY",6),1.0,null());
						Dynamic rotate0 = this->getFloat(STRING(L"rotate0",7),0.0,null());
						Dynamic rotate1 = this->getFloat(STRING(L"rotate1",7),0.0,null());
						hxg->beginGradientFill(type,colors,alphas,ratios,x,y,scaleX,scaleY,rotate0,rotate1);
					}
					else  {
						this->error(STRING(L"ERROR! Invalid gradient type ",29) + type + STRING(L". Valid types are: radial,linear. TAG: ",39) + this->currentTag->toString());
					}
;
;
				}
				else if (  ( _switch_2==STRING(L"beginbitmapfill",15))){
					Dynamic bitmapId = this->getInt(STRING(L"bitmapId",8),null(),true,null(),null());
					if (this->strict){
						if (this->dictionary->__get(bitmapId) != STRING(L"definebitsjpeg",14)){
							this->error(STRING(L"!ERROR: bitmapId ",17) + bitmapId + STRING(L" must be a reference to a DefineBitsJPEG tag. TAG: ",51) + this->currentTag->toString());
						}
					}
					Dynamic scaleX = this->getFloat(STRING(L"scaleX",6),1.0,null());
					Dynamic scaleY = this->getFloat(STRING(L"scaleY",6),1.0,null());
					Dynamic scale = hxAnon_obj::Create()->Add( STRING(L"x",1) , scaleX)->Add( STRING(L"y",1) , scaleY);
					Dynamic rotate0 = this->getFloat(STRING(L"rotate0",7),0.0,null());
					Dynamic rotate1 = this->getFloat(STRING(L"rotate1",7),0.0,null());
					Dynamic rotate = hxAnon_obj::Create()->Add( STRING(L"rs0",3) , rotate0)->Add( STRING(L"rs1",3) , rotate1);
					Dynamic x = this->getInt(STRING(L"x",1),0,null(),null(),null());
					Dynamic y = this->getInt(STRING(L"y",1),0,null(),null(),null());
					Dynamic translate = hxAnon_obj::Create()->Add( STRING(L"x",1) , x)->Add( STRING(L"y",1) , y);
					bool repeat = this->getBool(STRING(L"repeat",6),false,null());
					bool smooth = this->getBool(STRING(L"smooth",6),false,null());
					hxg->beginBitmapFill(bitmapId,x,y,scaleX,scaleY,rotate0,rotate1,repeat,smooth);
				}
				else if (  ( _switch_2==STRING(L"linestyle",9))){
					Dynamic width = this->getFloat(STRING(L"width",5),1.0,null());
					Dynamic color = this->getInt(STRING(L"color",5),0,null(),null(),null());
					Dynamic alpha = this->getFloat(STRING(L"alpha",5),1.0,null());
					hxg->lineStyle(width,color,alpha);
				}
				else if (  ( _switch_2==STRING(L"moveto",6))){
					Dynamic x = this->getFloat(STRING(L"x",1),0.0,null());
					Dynamic y = this->getFloat(STRING(L"y",1),0.0,null());
					hxg->moveTo(x,y);
				}
				else if (  ( _switch_2==STRING(L"lineto",6))){
					Dynamic x = this->getFloat(STRING(L"x",1),0.0,null());
					Dynamic y = this->getFloat(STRING(L"y",1),0.0,null());
					hxg->lineTo(x,y);
				}
				else if (  ( _switch_2==STRING(L"curveto",7))){
					Dynamic cx = this->getFloat(STRING(L"cx",2),0.0,null());
					Dynamic cy = this->getFloat(STRING(L"cy",2),0.0,null());
					Dynamic ax = this->getFloat(STRING(L"ax",2),0.0,null());
					Dynamic ay = this->getFloat(STRING(L"ay",2),0.0,null());
					hxg->curveTo(cx,cy,ax,ay);
				}
				else if (  ( _switch_2==STRING(L"endfill",7))){
					hxg->endFill();
				}
				else if (  ( _switch_2==STRING(L"endline",7))){
					hxg->endLine();
				}
				else if (  ( _switch_2==STRING(L"clear",5))){
					hxg->clear();
				}
				else if (  ( _switch_2==STRING(L"drawcircle",10))){
					Dynamic x = this->getFloat(STRING(L"x",1),0.0,null());
					Dynamic y = this->getFloat(STRING(L"y",1),0.0,null());
					Dynamic r = this->getFloat(STRING(L"r",1),0.0,null());
					Dynamic sections = this->getInt(STRING(L"sections",8),16,null(),null(),null());
					hxg->drawCircle(x,y,r,sections);
				}
				else if (  ( _switch_2==STRING(L"drawellipse",11))){
					Dynamic x = this->getFloat(STRING(L"x",1),0.0,null());
					Dynamic y = this->getFloat(STRING(L"y",1),0.0,null());
					Dynamic w = this->getFloat(STRING(L"width",5),0.0,null());
					Dynamic h = this->getFloat(STRING(L"height",6),0.0,null());
					hxg->drawEllipse(x,y,w,h);
				}
				else if (  ( _switch_2==STRING(L"drawrect",8))){
					Dynamic x = this->getFloat(STRING(L"x",1),0.0,null());
					Dynamic y = this->getFloat(STRING(L"y",1),0.0,null());
					Dynamic w = this->getFloat(STRING(L"width",5),0.0,null());
					Dynamic h = this->getFloat(STRING(L"height",6),0.0,null());
					hxg->drawRect(x,y,w,h);
				}
				else if (  ( _switch_2==STRING(L"drawroundrect",13))){
					Dynamic x = this->getFloat(STRING(L"x",1),0.0,null());
					Dynamic y = this->getFloat(STRING(L"y",1),0.0,null());
					Dynamic w = this->getFloat(STRING(L"width",5),0.0,null());
					Dynamic h = this->getFloat(STRING(L"height",6),0.0,null());
					Dynamic r = this->getFloat(STRING(L"r",1),0.0,null());
					hxg->drawRoundRect(x,y,w,h,r);
				}
				else if (  ( _switch_2==STRING(L"drawroundrectcomplex",20))){
					Dynamic x = this->getFloat(STRING(L"x",1),0.0,null());
					Dynamic y = this->getFloat(STRING(L"y",1),0.0,null());
					Dynamic w = this->getFloat(STRING(L"width",5),0.0,null());
					Dynamic h = this->getFloat(STRING(L"height",6),0.0,null());
					Dynamic rtl = this->getFloat(STRING(L"rtl",3),0.0,null());
					Dynamic rtr = this->getFloat(STRING(L"rtr",3),0.0,null());
					Dynamic rbl = this->getFloat(STRING(L"rbl",3),0.0,null());
					Dynamic rbr = this->getFloat(STRING(L"rbr",3),0.0,null());
					hxg->drawRoundRectComplex(x,y,w,h,rtl,rtr,rbl,rbr);
				}
				else  {
					this->error(STRING(L"!ERROR: ",8) + this->currentTag->getNodeName() + STRING(L" is not allowed inside a DefineShape element. Valid children are: ",66) + this->validChildren->get(STRING(L"defineshape",11)).Cast<Array<String > >()->toString() + STRING(L". TAG: ",7) + this->currentTag->toString());
				}
;
;
			}
;
		}
		return hxg->getTag(id);
	}
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineShape,return )

format::swf::SWFTag HXswfML_obj::defineSprite( ){
	Dynamic id = this->getInt(STRING(L"id",2),null(),true,true,null());
	Dynamic frames = this->getInt(STRING(L"frameCount",10),1,null(),null(),null());
	int showFrameCount = 0;
	Array<format::swf::SWFTag > tags = Array_obj<format::swf::SWFTag >::__new();
	cpp::CppXml__ spriteTag = this->currentTag;
	for(Dynamic __it = this->currentTag->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ tag = __it->__Field(STRING(L"next",4))();
		{
			this->currentTag = tag;
			this->checkUnknownAttributes();
			String _switch_4 = (this->currentTag->getNodeName().toLowerCase());
			if (  ( _switch_4==STRING(L"placeobject",11))){
				tags->push(this->placeObject2());
			}
			else if (  ( _switch_4==STRING(L"removeobject",12))){
				tags->push(this->removeObject2());
			}
			else if (  ( _switch_4==STRING(L"startsound",10))){
				tags->push(this->startSound());
			}
			else if (  ( _switch_4==STRING(L"framelabel",10))){
				tags->push(this->frameLabel());
			}
			else if (  ( _switch_4==STRING(L"showframe",9))){
				showFrameCount++;
				tags->push(this->showFrame());
			}
			else if (  ( _switch_4==STRING(L"endframe",8))){
				tags->push(this->endFrame());
			}
			else if (  ( _switch_4==STRING(L"tween",5))){
				{
					int _g = 0;
					Array<format::swf::SWFTag > _g1 = this->tween();
					while(_g < _g1->length){
						format::swf::SWFTag tag1 = _g1->__get(_g);
						++_g;
						tags->push(tag1);
					}
				}
			}
			else  {
				this->error(STRING(L"!ERROR: ",8) + this->currentTag->getNodeName() + STRING(L" is not allowed inside a DefineSprite element. Valid children are: ",67) + this->validChildren->get(STRING(L"definesprite",12)).Cast<Array<String > >()->toString() + STRING(L". TAG: ",7) + this->currentTag->toString());
			}
;
;
		}
;
	}
	return format::swf::SWFTag_obj::TClip(id,frames,tags);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineSprite,return )

format::swf::SWFTag HXswfML_obj::defineButton2( ){
	Dynamic id = this->getInt(STRING(L"id",2),null(),true,true,null());
	Array<Dynamic > buttonRecords = Array_obj<Dynamic >::__new();
	for(Dynamic __it = this->currentTag->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ buttonRecord = __it->__Field(STRING(L"next",4))();
		{
			this->currentTag = buttonRecord;
			this->checkUnknownAttributes();
			String _switch_5 = (this->currentTag->getNodeName().toLowerCase());
			if (  ( _switch_5==STRING(L"buttonstate",11))){
				bool hit = this->getBool(STRING(L"hit",3),false,null());
				bool down = this->getBool(STRING(L"down",4),false,null());
				bool over = this->getBool(STRING(L"over",4),false,null());
				bool up = this->getBool(STRING(L"up",2),false,null());
				if (bool(hit == false) && bool(bool(down == false) && bool(bool(over == false) && bool(up == false)))){
					this->error(STRING(L"!ERROR: You need to set at least one button state to true. TAG: ",64) + this->currentTag->toString());
				}
				Dynamic id1 = this->getInt(STRING(L"id",2),null(),true,false,true);
				Dynamic depth = this->getInt(STRING(L"depth",5),null(),true,null(),null());
				buttonRecords->push(hxAnon_obj::Create()->Add( STRING(L"hit",3) , hit)->Add( STRING(L"down",4) , down)->Add( STRING(L"over",4) , over)->Add( STRING(L"up",2) , up)->Add( STRING(L"id",2) , id1)->Add( STRING(L"depth",5) , depth)->Add( STRING(L"matrix",6) , this->getMatrix()));
			}
			else  {
				this->error(STRING(L"!ERROR: ",8) + this->currentTag->getNodeName() + STRING(L" is not allowed inside a DefineButton element. Valid children are: ",67) + this->validChildren->get(STRING(L"definebutton",12)).Cast<Array<String > >()->toString() + STRING(L". TAG: ",7) + this->currentTag->toString());
			}
;
;
		}
;
	}
	if (buttonRecords->length == 0)
		this->error(STRING(L"!ERROR: You need to supply at least one buttonstate element. TAG: ",66) + this->currentTag->toString());
	return format::swf::SWFTag_obj::TDefineButton2(id,buttonRecords);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineButton2,return )

format::swf::SWFTag HXswfML_obj::defineSound( ){
	String file = this->getString(STRING(L"file",4),STRING(L"",0),true);
	haxe::io::BytesInput mp3FileBytes = haxe::io::BytesInput_obj::__new(this->getBytes(file),null(),null());
	format::mp3::Reader mp3Reader = format::mp3::Reader_obj::__new(mp3FileBytes);
	Dynamic mp3 = mp3Reader->read();
	Array<Dynamic > mp3Frames = mp3->__Field(STRING(L"frames",6)).Cast<Array<Dynamic > >();
	Dynamic mp3Header = mp3Frames[0]->__Field(STRING(L"header",6));
	haxe::io::BytesOutput dataBytesOutput = haxe::io::BytesOutput_obj::__new();
	format::mp3::Writer mp3Writer = format::mp3::Writer_obj::__new(dataBytesOutput);
	mp3Writer->write(mp3,false);
	Dynamic sid = this->getInt(STRING(L"id",2),null(),true,true,null());
	struct _Function_1{
		static format::swf::SoundRate Block( Dynamic &mp3Header)/* DEF (not block)(ret intern) */{
			format::mp3::SamplingRate _switch_6 = (mp3Header->__Field(STRING(L"samplingRate",12)).Cast<format::mp3::SamplingRate >());
			switch((_switch_6)->GetIndex()){
				case 1: {
					return format::swf::SoundRate_obj::SR11k;
				}
				break;
				case 3: {
					return format::swf::SoundRate_obj::SR22k;
				}
				break;
				case 6: {
					return format::swf::SoundRate_obj::SR44k;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	format::swf::SoundRate samplingRate = _Function_1::Block(mp3Header);
	if (samplingRate == null())
		this->error(STRING(L"!ERROR: Unsupported MP3 SoundRate ",34) + mp3Header->__Field(STRING(L"samplingRate",12)).Cast<format::mp3::SamplingRate >() + STRING(L" in ",4) + file + STRING(L". TAG: ",7) + this->currentTag->toString());
	struct _Function_2{
		static bool Block( Dynamic &mp3Header)/* DEF (not block)(ret intern) */{
			format::mp3::ChannelMode _switch_7 = (mp3Header->__Field(STRING(L"channelMode",11)).Cast<format::mp3::ChannelMode >());
			switch((_switch_7)->GetIndex()){
				case 0: {
					return true;
				}
				break;
				case 1: {
					return true;
				}
				break;
				case 2: {
					return true;
				}
				break;
				case 3: {
					return false;
				}
				break;
				default: {
					return null();
				}
			}
		}
	};
	return format::swf::SWFTag_obj::TSound(hxAnon_obj::Create()->Add( STRING(L"sid",3) , sid)->Add( STRING(L"format",6) , format::swf::SoundFormat_obj::SFMP3)->Add( STRING(L"rate",4) , samplingRate)->Add( STRING(L"is16bit",7) , true)->Add( STRING(L"isStereo",8) , _Function_2::Block(mp3Header))->Add( STRING(L"samples",7) , cpp::CppInt32___obj::ofInt(mp3->__Field(STRING(L"sampleCount",11)).Cast<int >()))->Add( STRING(L"data",4) , format::swf::SoundData_obj::SDMp3(0,dataBytesOutput->getBytes())));
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineSound,return )

format::swf::SWFTag HXswfML_obj::defineBinaryData( ){
	Dynamic id = this->getInt(STRING(L"id",2),null(),true,true,null());
	String file = this->getString(STRING(L"file",4),STRING(L"",0),true);
	haxe::io::Bytes bytes = this->getBytes(file);
	return format::swf::SWFTag_obj::TBinaryData(id,bytes);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineBinaryData,return )

format::swf::SWFTag HXswfML_obj::defineFont( ){
	Dynamic _id = this->getInt(STRING(L"id",2),null(),true,true,null());
	String file = this->getString(STRING(L"file",4),STRING(L"",0),true);
	haxe::io::Bytes swf = this->getBytes(file);
	haxe::io::BytesInput swfBytesInput = haxe::io::BytesInput_obj::__new(swf,null(),null());
	format::swf::Reader swfReader = format::swf::Reader_obj::__new(swfBytesInput);
	Dynamic header = swfReader->readHeader();
	Array<format::swf::SWFTag > tags = swfReader->readTagList();
	swfBytesInput->close();
	format::swf::SWFTag fontTag = null();
	{
		int _g = 0;
		while(_g < tags->length){
			format::swf::SWFTag tag = tags->__get(_g);
			++_g;
			format::swf::SWFTag _switch_8 = (tag);
			switch((_switch_8)->GetIndex()){
				case 4: {
					format::swf::FontData data = _switch_8->__Param(1);
					int id = _switch_8->__Param(0);
{
						fontTag = format::swf::SWFTag_obj::TFont(_id,data);
					}
				}
				break;
				default: {
				}
			}
		}
	}
	if (fontTag == null())
		this->error(STRING(L"!ERROR: No Font definitions were found inside swf: ",51) + file + STRING(L", TAG: ",7) + this->currentTag->toString());
	return fontTag;
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineFont,return )

format::swf::SWFTag HXswfML_obj::defineEditText( ){
	Dynamic id = this->getInt(STRING(L"id",2),null(),true,true,null());
	Dynamic fontID = this->getInt(STRING(L"fontID",6),null(),null(),null(),null());
	if (this->strict){
		if (bool(fontID != null()) && bool(this->dictionary->__get(fontID) != STRING(L"definefont",10)))
			this->error(STRING(L"!ERROR: The id ",15) + fontID + STRING(L" must be a reference to a DefineFont tag. TAG: ",47) + this->currentTag->toString());
	}
	int textColor = this->getInt(STRING(L"textColor",9),255,null(),null(),null());
	return format::swf::SWFTag_obj::TDefineEditText(id,hxAnon_obj::Create()->Add( STRING(L"bounds",6) , hxAnon_obj::Create()->Add( STRING(L"left",4) , 0)->Add( STRING(L"right",5) , this->getInt(STRING(L"width",5),100,null(),null(),null()) * 20)->Add( STRING(L"top",3) , 0)->Add( STRING(L"bottom",6) , this->getInt(STRING(L"height",6),100,null(),null(),null()) * 20))->Add( STRING(L"hasText",7) , (this->getString(STRING(L"initialText",11),STRING(L"",0),null()) != STRING(L"",0)) ? bool( true ) : bool( false ))->Add( STRING(L"hasTextColor",12) , true)->Add( STRING(L"hasMaxLength",12) , (this->getInt(STRING(L"maxLength",9),0,null(),null(),null()) != 0) ? bool( true ) : bool( false ))->Add( STRING(L"hasFont",7) , (this->getInt(STRING(L"fontID",6),0,null(),null(),null()) != 0) ? bool( true ) : bool( false ))->Add( STRING(L"hasFontClass",12) , (this->getString(STRING(L"fontClass",9),STRING(L"",0),null()) != STRING(L"",0)) ? bool( true ) : bool( false ))->Add( STRING(L"hasLayout",9) , (bool(this->getInt(STRING(L"align",5),0,null(),null(),null()) != 0) || bool(bool(this->getInt(STRING(L"leftMargin",10),0,null(),null(),null()) * 20 != 0) || bool(bool(this->getInt(STRING(L"rightMargin",11),0,null(),null(),null()) * 20 != 0) || bool(bool(this->getInt(STRING(L"indent",6),0,null(),null(),null()) * 20 != 0) || bool(this->getInt(STRING(L"leading",7),0,null(),null(),null()) * 20 != 0))))) ? bool( true ) : bool( false ))->Add( STRING(L"wordWrap",8) , this->getBool(STRING(L"wordWrap",8),true,null()))->Add( STRING(L"multiline",9) , this->getBool(STRING(L"multiline",9),true,null()))->Add( STRING(L"password",8) , this->getBool(STRING(L"password",8),false,null()))->Add( STRING(L"input",5) , !this->getBool(STRING(L"input",5),false,null()))->Add( STRING(L"autoSize",8) , this->getBool(STRING(L"autoSize",8),false,null()))->Add( STRING(L"selectable",10) , !this->getBool(STRING(L"selectable",10),false,null()))->Add( STRING(L"border",6) , this->getBool(STRING(L"border",6),false,null()))->Add( STRING(L"wasStatic",9) , this->getBool(STRING(L"wasStatic",9),false,null()))->Add( STRING(L"html",4) , this->getBool(STRING(L"html",4),false,null()))->Add( STRING(L"useOutlines",11) , this->getBool(STRING(L"useOutlines",11),false,null()))->Add( STRING(L"fontID",6) , this->getInt(STRING(L"fontID",6),null(),null(),null(),null()))->Add( STRING(L"fontClass",9) , this->getString(STRING(L"fontClass",9),STRING(L"",0),null()))->Add( STRING(L"fontHeight",10) , this->getInt(STRING(L"fontHeight",10),12,null(),null(),null()) * 20)->Add( STRING(L"textColor",9) , hxAnon_obj::Create()->Add( STRING(L"r",1) , int((int(textColor) & int(-16777216))) >> int(24))->Add( STRING(L"g",1) , int((int(textColor) & int(16711680))) >> int(16))->Add( STRING(L"b",1) , int((int(textColor) & int(65280))) >> int(8))->Add( STRING(L"a",1) , (int(textColor) & int(255))))->Add( STRING(L"maxLength",9) , this->getInt(STRING(L"maxLength",9),0,null(),null(),null()))->Add( STRING(L"align",5) , this->getInt(STRING(L"align",5),0,null(),null(),null()))->Add( STRING(L"leftMargin",10) , this->getInt(STRING(L"leftMargin",10),0,null(),null(),null()) * 20)->Add( STRING(L"rightMargin",11) , this->getInt(STRING(L"rightMargin",11),0,null(),null(),null()) * 20)->Add( STRING(L"indent",6) , this->getInt(STRING(L"indent",6),0,null(),null(),null()) * 20)->Add( STRING(L"leading",7) , this->getInt(STRING(L"leading",7),0,null(),null(),null()) * 20)->Add( STRING(L"variableName",12) , this->getString(STRING(L"variableName",12),STRING(L"",0),null()))->Add( STRING(L"initialText",11) , this->getString(STRING(L"initialText",11),STRING(L"",0),null())));
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineEditText,return )

Array<format::swf::SWFTag > HXswfML_obj::defineABC( ){
	Array<format::swf::SWFTag > abcTags = Array_obj<format::swf::SWFTag >::__new();
	String remap = this->getString(STRING(L"remap",5),STRING(L"",0),null());
	String file = this->getString(STRING(L"file",4),STRING(L"",0),true);
	String name = this->getString(STRING(L"name",4),null(),false);
	haxe::io::Bytes swf = this->getBytes(file);
	if (StringTools_obj::endsWith(file,STRING(L".abc",4))){
		abcTags->push(format::swf::SWFTag_obj::TActionScript3(swf,name == null() ? Dynamic( null() ) : Dynamic( hxAnon_obj::Create()->Add( STRING(L"id",2) , 1)->Add( STRING(L"label",5) , name) )));
	}
	else{
		haxe::io::BytesInput swfBytesInput = haxe::io::BytesInput_obj::__new(swf,null(),null());
		format::swf::Reader swfReader = format::swf::Reader_obj::__new(swfBytesInput);
		Dynamic header = swfReader->readHeader();
		Array<format::swf::SWFTag > tags = swfReader->readTagList();
		swfBytesInput->close();
		Array<String > lookupStrings = Array_obj<String >::__new().Add(STRING(L"Boot",4)).Add(STRING(L"Lib",3)).Add(STRING(L"Type",4));
		{
			int _g = 0;
			while(_g < tags->length){
				format::swf::SWFTag tag = tags->__get(_g);
				++_g;
				format::swf::SWFTag _switch_9 = (tag);
				switch((_switch_9)->GetIndex()){
					case 13: {
						Dynamic ctx = _switch_9->__Param(1);
						haxe::io::Bytes data = _switch_9->__Param(0);
{
							if (remap == STRING(L"",0)){
								abcTags->push(format::swf::SWFTag_obj::TActionScript3(data,ctx));
							}
							else{
							}
						}
					}
					break;
					default: {
					}
				}
			}
		}
		if (abcTags->length == 0)
			this->error(STRING(L"!ERROR: No ABC files were found inside the given file ",54) + file + STRING(L". TAG : ",8) + this->currentTag->toString());
	}
	return abcTags;
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineABC,return )

format::swf::SWFTag HXswfML_obj::defineScalingGrid( ){
	Dynamic id = this->getInt(STRING(L"id",2),null(),true,false,true);
	int x = this->getInt(STRING(L"x",1),null(),true,null(),null()) * 20;
	int y = this->getInt(STRING(L"y",1),null(),true,null(),null()) * 20;
	int width = this->getInt(STRING(L"width",5),null(),true,null(),null()) * 20;
	int height = this->getInt(STRING(L"height",6),null(),true,null(),null()) * 20;
	Dynamic splitter = hxAnon_obj::Create()->Add( STRING(L"left",4) , x)->Add( STRING(L"right",5) , x + width)->Add( STRING(L"top",3) , y)->Add( STRING(L"bottom",6) , y + height);
	return format::swf::SWFTag_obj::TDefineScalingGrid(id,splitter);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,defineScalingGrid,return )

format::swf::SWFTag HXswfML_obj::placeObject2( ){
	Dynamic id = this->getInt(STRING(L"id",2),null(),null(),null(),null());
	if (id != null())
		this->checkTargetId(id);
	int depth = this->getInt(STRING(L"depth",5),null(),true,null(),null());
	String name = this->getString(STRING(L"name",4),STRING(L"",0),null());
	bool move = this->getBool(STRING(L"move",4),false,null());
	format::swf::PlaceObject placeObject = format::swf::PlaceObject_obj::__new();
	placeObject->depth = depth;
	placeObject->move = !move ? Dynamic( null() ) : Dynamic( true );
	placeObject->cid = id;
	placeObject->matrix = this->getMatrix();
	placeObject->color = null();
	placeObject->ratio = null();
	placeObject->instanceName = name == STRING(L"",0) ? String( null() ) : String( name );
	placeObject->clipDepth = null();
	placeObject->events = null();
	placeObject->filters = null();
	placeObject->blendMode = null();
	placeObject->bitmapCache = false;
	return format::swf::SWFTag_obj::TPlaceObject2(placeObject);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,placeObject2,return )

format::swf::SWFTag HXswfML_obj::moveObject( int depth,int x,int y,Dynamic scaleX,Dynamic scaleY,Dynamic rs0,Dynamic rs1){
	Dynamic id = null();
	int depth1 = depth;
	String name = STRING(L"",0);
	bool move = true;
	Dynamic scale;
	if (bool(scaleX == null()) && bool(scaleY == null()))
		scale = null();
	else
		if (bool(scaleX == null()) && bool(scaleY != null()))
		scale = hxAnon_obj::Create()->Add( STRING(L"x",1) , 1.0)->Add( STRING(L"y",1) , scaleY);
	else
		if (bool(scaleX != null()) && bool(scaleY == null()))
		scale = hxAnon_obj::Create()->Add( STRING(L"x",1) , scaleX)->Add( STRING(L"y",1) , 1.0);
	else
		scale = hxAnon_obj::Create()->Add( STRING(L"x",1) , scaleX)->Add( STRING(L"y",1) , scaleY);
;
;
;
	Dynamic rotate;
	if (bool(rs0 == null()) && bool(rs1 == null()))
		rotate = null();
	else
		if (bool(rs0 == null()) && bool(rs1 != null()))
		rotate = hxAnon_obj::Create()->Add( STRING(L"rs0",3) , 0.0)->Add( STRING(L"rs1",3) , rs1);
	else
		if (bool(rs0 != null()) && bool(rs1 == null()))
		rotate = hxAnon_obj::Create()->Add( STRING(L"rs0",3) , rs0)->Add( STRING(L"rs1",3) , 0.0);
	else
		rotate = hxAnon_obj::Create()->Add( STRING(L"rs0",3) , rs0)->Add( STRING(L"rs1",3) , rs1);
;
;
;
	Dynamic translate = hxAnon_obj::Create()->Add( STRING(L"x",1) , x)->Add( STRING(L"y",1) , y);
	format::swf::PlaceObject placeObject = format::swf::PlaceObject_obj::__new();
	placeObject->depth = depth1;
	placeObject->move = move;
	placeObject->cid = id;
	placeObject->matrix = hxAnon_obj::Create()->Add( STRING(L"scale",5) , scale)->Add( STRING(L"rotate",6) , rotate)->Add( STRING(L"translate",9) , translate);
	placeObject->color = null();
	placeObject->ratio = null();
	placeObject->instanceName = name == STRING(L"",0) ? String( null() ) : String( name );
	placeObject->clipDepth = null();
	placeObject->events = null();
	placeObject->filters = null();
	placeObject->blendMode = null();
	placeObject->bitmapCache = false;
	return format::swf::SWFTag_obj::TPlaceObject2(placeObject);
}


DEFINE_DYNAMIC_FUNC7(HXswfML_obj,moveObject,return )

Array<format::swf::SWFTag > HXswfML_obj::tween( ){
	int depth = this->getInt(STRING(L"depth",5),null(),true,null(),null());
	int frameCount = this->getInt(STRING(L"frameCount",10),null(),true,null(),null());
	Dynamic startX = null();
	Dynamic startY = null();
	Dynamic endX = null();
	Dynamic endY = null();
	Dynamic startScaleX = null();
	Dynamic startScaleY = null();
	Dynamic endScaleX = null();
	Dynamic endScaleY = null();
	Dynamic startRotateO = null();
	Dynamic startRotate1 = null();
	Dynamic endRotateO = null();
	Dynamic endRotate1 = null();
	for(Dynamic __it = this->currentTag->elements();  __it->__Field(STRING(L"hasNext",7))(); ){
cpp::CppXml__ tagNode = __it->__Field(STRING(L"next",4))();
		{
			this->currentTag = tagNode;
			this->checkUnknownAttributes();
			String _switch_10 = (this->currentTag->getNodeName().toLowerCase());
			if (  ( _switch_10==STRING(L"tw",2))){
				String prop = this->getString(STRING(L"prop",4),STRING(L"",0),null());
				Dynamic startxy = null();
				Dynamic endxy = null();
				Dynamic start = null();
				Dynamic end = null();
				if (bool(prop == STRING(L"x",1)) || bool(prop == STRING(L"y",1))){
					startxy = this->getInt(STRING(L"start",5),0,true,null(),null());
					endxy = this->getInt(STRING(L"end",3),0,true,null(),null());
				}
				else{
					start = this->getFloat(STRING(L"start",5),null(),true);
					end = this->getFloat(STRING(L"end",3),null(),true);
				}
				String _switch_11 = (prop);
				if (  ( _switch_11==STRING(L"x",1))){
					startX = startxy;
					endX = endxy;
				}
				else if (  ( _switch_11==STRING(L"y",1))){
					startY = startxy;
					endY = endxy;
				}
				else if (  ( _switch_11==STRING(L"scaleX",6))){
					startScaleX = start;
					endScaleX = end;
				}
				else if (  ( _switch_11==STRING(L"scaleY",6))){
					startScaleY = start;
					endScaleY = end;
				}
				else if (  ( _switch_11==STRING(L"rotate0",7))){
					startRotateO = start;
					endRotateO = end;
				}
				else if (  ( _switch_11==STRING(L"rotate1",7))){
					startRotate1 = start;
					endRotate1 = end;
				}
				else  {
					this->error(STRING(L"!ERROR: Unsupported ",20) + prop + STRING(L" in TW element. Tweenable properties are: x, y, scaleX, scaleY, rotateO, rotate1. TAG: ",87) + this->currentTag->toString());
				}
;
;
			}
			else  {
				this->error(STRING(L"!ERROR: ",8) + this->currentTag->getNodeName() + STRING(L" is not allowed inside a Tween element.  Valid children are: ",61) + this->validChildren->get(STRING(L"tween",5)).Cast<Array<String > >()->toString() + STRING(L". TAG: ",7) + this->currentTag->toString());
			}
;
;
		}
;
	}
	Array<format::swf::SWFTag > tags = Array_obj<format::swf::SWFTag >::__new();
	{
		int _g = 0;
		while(_g < frameCount){
			int i = _g++;
			Dynamic dx = (bool(startX == null()) || bool(endX == null())) ? int( 0 ) : int( Std_obj::toInt(startX + double(((endX - startX) * i)) / double(frameCount)) );
			Dynamic dy = (bool(startY == null()) || bool(endY == null())) ? int( 0 ) : int( Std_obj::toInt(startY + double(((endY - startY) * i)) / double(frameCount)) );
			Dynamic dsx = (bool(startScaleX == null()) || bool(endScaleX == null())) ? Dynamic( null() ) : Dynamic( startScaleX + double(((endScaleX - startScaleX) * i)) / double(frameCount) );
			Dynamic dsy = (bool(startScaleY == null()) || bool(endScaleY == null())) ? Dynamic( null() ) : Dynamic( startScaleY + double(((endScaleY - startScaleY) * i)) / double(frameCount) );
			Dynamic drs0 = (bool(startRotateO == null()) || bool(endRotateO == null())) ? Dynamic( null() ) : Dynamic( startRotateO + double(((endRotateO - startRotateO) * i)) / double(frameCount) );
			Dynamic drs1 = (bool(startRotate1 == null()) || bool(endRotate1 == null())) ? Dynamic( null() ) : Dynamic( startRotate1 + double(((endRotate1 - startRotate1) * i)) / double(frameCount) );
			tags->push(this->moveObject(depth,dx * 20,dy * 20,dsx,dsy,drs0,drs1));
			tags->push(this->showFrame());
		}
	}
	return tags;
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,tween,return )

format::swf::SWFTag HXswfML_obj::removeObject2( ){
	Dynamic depth = this->getInt(STRING(L"depth",5),null(),true,null(),null());
	return format::swf::SWFTag_obj::TRemoveObject2(depth);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,removeObject2,return )

format::swf::SWFTag HXswfML_obj::startSound( ){
	int id = this->getInt(STRING(L"id",2),null(),true,false,true);
	bool stop = this->getBool(STRING(L"stop",4),false,null());
	Dynamic loopCount = this->getInt(STRING(L"loopCount",9),0,null(),null(),null());
	bool hasLoops = loopCount == 0 ? bool( false ) : bool( true );
	return format::swf::SWFTag_obj::TStartSound(id,hxAnon_obj::Create()->Add( STRING(L"syncStop",8) , stop)->Add( STRING(L"hasLoops",8) , hasLoops)->Add( STRING(L"loopCount",9) , loopCount));
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,startSound,return )

Array<format::swf::SWFTag > HXswfML_obj::symbolClass( ){
	Dynamic cid = this->getInt(STRING(L"id",2),null(),true,false,true);
	String className = this->getString(STRING(L"class",5),STRING(L"",0),true);
	Array<Dynamic > symbols = Array_obj<Dynamic >::__new().Add(hxAnon_obj::Create()->Add( STRING(L"cid",3) , cid)->Add( STRING(L"className",9) , className));
	String baseClass = this->getString(STRING(L"base",4),STRING(L"",0),null());
	Array<format::swf::SWFTag > tags = Array_obj<format::swf::SWFTag >::__new();
	if (baseClass != STRING(L"",0)){
		if (this->checkValidBaseClass(baseClass)){
			this->swcClasses->push(Array_obj<String >::__new().Add(className).Add(baseClass));
			tags = Array_obj<format::swf::SWFTag >::__new().Add(this->createABC(className,baseClass)).Add(format::swf::SWFTag_obj::TSymbolClass(symbols));
		}
		else{
			this->error(STRING(L"!ERROR: Invalid base class: ",28) + baseClass + STRING(L". Valid base classes are: ",26) + this->validBaseClasses->toString() + STRING(L". TAG: ",7) + this->currentTag->toString());
		}
	}
	else{
		tags = Array_obj<format::swf::SWFTag >::__new().Add(format::swf::SWFTag_obj::TSymbolClass(symbols));
	}
	return tags;
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,symbolClass,return )

Array<format::swf::SWFTag > HXswfML_obj::exportAssets( ){
	Dynamic cid = this->getInt(STRING(L"id",2),null(),true,false,true);
	String className = this->getString(STRING(L"class",5),STRING(L"",0),true);
	Array<Dynamic > symbols = Array_obj<Dynamic >::__new().Add(hxAnon_obj::Create()->Add( STRING(L"cid",3) , cid)->Add( STRING(L"className",9) , className));
	return Array_obj<format::swf::SWFTag >::__new().Add(format::swf::SWFTag_obj::TExportAssets(symbols));
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,exportAssets,return )

format::swf::SWFTag HXswfML_obj::metadata( ){
	String file = this->getString(STRING(L"file",4),STRING(L"",0),true);
	String data = this->getContent(file);
	return format::swf::SWFTag_obj::TMetadata(data);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,metadata,return )

format::swf::SWFTag HXswfML_obj::frameLabel( ){
	String label = this->getString(STRING(L"name",4),STRING(L"",0),true);
	bool anchor = this->getBool(STRING(L"anchor",6),false,null());
	return format::swf::SWFTag_obj::TFrameLabel(label,anchor);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,frameLabel,return )

format::swf::SWFTag HXswfML_obj::showFrame( ){
	return format::swf::SWFTag_obj::TShowFrame;
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,showFrame,return )

format::swf::SWFTag HXswfML_obj::endFrame( ){
	return format::swf::SWFTag_obj::TEnd;
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,endFrame,return )

format::swf::SWFTag HXswfML_obj::custom( ){
	Dynamic tagId = this->getInt(STRING(L"tagId",5),null(),false,null(),null());
	haxe::io::Bytes data;
	String file = this->getString(STRING(L"file",4),STRING(L"",0),false);
	if (file == STRING(L"",0)){
		String str = this->getString(STRING(L"data",4),STRING(L"",0),true);
		Array<String > arr = str.split(STRING(L",",1));
		haxe::io::BytesBuffer buffer = haxe::io::BytesBuffer_obj::__new();
		{
			int _g1 = 0;
			int _g = arr->length;
			while(_g1 < _g){
				int i = _g1++;
				buffer->b->push(Std_obj::parseInt(arr->__get(i)));
			}
		}
		data = buffer->getBytes();
	}
	else{
		data = this->getBytes(file);
	}
	return format::swf::SWFTag_obj::TUnknown(tagId,data);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,custom,return )

Void HXswfML_obj::storeWidthHeight( int id,String fileName,haxe::io::Bytes b){
{
		String extension = fileName.substr(fileName.lastIndexOf(STRING(L".",1),null()) + 1,null()).toLowerCase();
		int height = 0;
		int width = 0;
		haxe::io::BytesInput bytes = haxe::io::BytesInput_obj::__new(b,null(),null());
		if (bool(extension == STRING(L"jpg",3)) || bool(extension == STRING(L"jpeg",4))){
			if (bool(bytes->readByte() != 255) || bool(bytes->readByte() != 216)){
				this->error(STRING(L"!ERROR: in image file: ",23) + fileName + STRING(L". SOI (Start Of Image) marker 0xff 0xd8 missing , TAG: ",55) + this->currentTag->toString());
			}
			int marker;
			int len;
			while(bytes->readByte() == 255){
				marker = bytes->readByte();
				len = int(int(bytes->readByte()) << int(8)) | int(bytes->readByte());
				if (marker == 192){
					bytes->readByte();
					height = int(int(bytes->readByte()) << int(8)) | int(bytes->readByte());
					width = int(int(bytes->readByte()) << int(8)) | int(bytes->readByte());
					break;
				}
				bytes->read(len - 2);
			}
		}
		else
			if (extension.toLowerCase() == STRING(L"png",3)){
			bytes->setEndian(true);
			bytes->readInt32();
			bytes->readInt32();
			bytes->readInt32();
			bytes->readInt32();
			width = bytes->readUInt30();
			height = bytes->readUInt30();
		}
		else
			if (extension.toLowerCase() == STRING(L"gif",3)){
			bytes->setEndian(false);
			bytes->readInt32();
			bytes->readUInt16();
			width = bytes->readUInt16();
			height = bytes->readUInt16();
		}
;
;
;
		this->bitmapIds[id] = Array_obj<int >::__new().Add(width).Add(height);
	}
return null();
}


DEFINE_DYNAMIC_FUNC3(HXswfML_obj,storeWidthHeight,(void))

format::swf::SWFTag HXswfML_obj::createABC( String className,String baseClass){
	format::abc::Context ctx = format::abc::Context_obj::__new();
	Dynamic c = ctx->beginClass(className);
	c.FieldRef(STRING(L"superclass",10)) = ctx->type(baseClass);
	String _switch_12 = (baseClass);
	if (  ( _switch_12==STRING(L"flash.display.MovieClip",23))){
		ctx->addClassSuper(STRING(L"flash.events.EventDispatcher",28));
		ctx->addClassSuper(STRING(L"flash.display.DisplayObject",27));
		ctx->addClassSuper(STRING(L"flash.display.InteractiveObject",31));
		ctx->addClassSuper(STRING(L"flash.display.DisplayObjectContainer",36));
		ctx->addClassSuper(STRING(L"flash.display.Sprite",20));
		ctx->addClassSuper(STRING(L"flash.display.MovieClip",23));
	}
	else if (  ( _switch_12==STRING(L"flash.display.Sprite",20))){
		ctx->addClassSuper(STRING(L"flash.events.EventDispatcher",28));
		ctx->addClassSuper(STRING(L"flash.display.DisplayObject",27));
		ctx->addClassSuper(STRING(L"flash.display.InteractiveObject",31));
		ctx->addClassSuper(STRING(L"flash.display.DisplayObjectContainer",36));
		ctx->addClassSuper(STRING(L"flash.display.Sprite",20));
	}
	else if (  ( _switch_12==STRING(L"flash.display.SimpleButton",26))){
		ctx->addClassSuper(STRING(L"flash.events.EventDispatcher",28));
		ctx->addClassSuper(STRING(L"flash.display.DisplayObject",27));
		ctx->addClassSuper(STRING(L"flash.display.InteractiveObject",31));
		ctx->addClassSuper(STRING(L"flash.display.SimpleButton",26));
	}
	else if (  ( _switch_12==STRING(L"flash.display.Bitmap",20))){
		ctx->addClassSuper(STRING(L"flash.events.EventDispatcher",28));
		ctx->addClassSuper(STRING(L"flash.display.DisplayObject",27));
		ctx->addClassSuper(STRING(L"flash.display.Bitmap",20));
	}
	else if (  ( _switch_12==STRING(L"flash.media.Sound",17))){
		ctx->addClassSuper(STRING(L"flash.events.EventDispatcher",28));
		ctx->addClassSuper(STRING(L"flash.media.Sound",17));
	}
	else if (  ( _switch_12==STRING(L"flash.text.Font",15))){
		ctx->addClassSuper(STRING(L"flash.text.Font",15));
	}
	else if (  ( _switch_12==STRING(L"flash.utils.ByteArray",21))){
		ctx->addClassSuper(STRING(L"flash.utils.ByteArray",21));
	}
	Dynamic m = ctx->beginMethod(className,Array_obj<format::abc::Index >::__new(),null(),false,false,false,true);
	m.FieldRef(STRING(L"maxStack",8)) = 2;
	c.FieldRef(STRING(L"constructor",11)) = m->__Field(STRING(L"type",4)).Cast<format::abc::Index >();
	ctx->ops(Array_obj<format::abc::OpCode >::__new().Add(format::abc::OpCode_obj::OThis).Add(format::abc::OpCode_obj::OConstructSuper(0)).Add(format::abc::OpCode_obj::ORetVoid));
	ctx->finalize();
	haxe::io::BytesOutput abcOutput = haxe::io::BytesOutput_obj::__new();
	format::abc::Writer_obj::write(abcOutput,ctx->getData());
	return format::swf::SWFTag_obj::TActionScript3(abcOutput->getBytes(),hxAnon_obj::Create()->Add( STRING(L"id",2) , 1)->Add( STRING(L"label",5) , className));
}


DEFINE_DYNAMIC_FUNC2(HXswfML_obj,createABC,return )

String HXswfML_obj::getContent( String file){
	this->checkFileExistence(file);
	return cpp::io::File_obj::getContent(file);
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,getContent,return )

haxe::io::Bytes HXswfML_obj::getBytes( String file){
	this->checkFileExistence(file);
	return cpp::io::File_obj::getBytes(file);
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,getBytes,return )

Dynamic HXswfML_obj::getInt( String att,Dynamic defaultValue,Dynamic __o_required,Dynamic __o_uniqueId,Dynamic __o_targetId){
bool required = __o_required.Default(false);
bool uniqueId = __o_uniqueId.Default(false);
bool targetId = __o_targetId.Default(false);
{
		if (this->currentTag->exists(att))
			if (Math_obj::isNaN(Std_obj::parseInt(this->currentTag->get(att))))
			this->error(STRING(L"!ERROR: attribute ",18) + att + STRING(L" must be an integer: ",21) + this->currentTag->toString());
		if (required)
			if (!this->currentTag->exists(att))
			this->error(STRING(L"!ERROR: Required attribute ",27) + att + STRING(L" is missing in tag: ",20) + this->currentTag->toString());
		if (uniqueId)
			this->checkDictionary(Std_obj::parseInt(this->currentTag->get(att)));
		if (targetId)
			this->checkTargetId(Std_obj::parseInt(this->currentTag->get(att)));
		return this->currentTag->exists(att) ? Dynamic( Std_obj::parseInt(this->currentTag->get(att)) ) : Dynamic( defaultValue );
	}
}


DEFINE_DYNAMIC_FUNC5(HXswfML_obj,getInt,return )

bool HXswfML_obj::getBool( String att,bool defaultValue,Dynamic __o_required){
bool required = __o_required.Default(false);
{
		if (required)
			if (!this->currentTag->exists(att))
			this->error(STRING(L"!ERROR: Required attribute ",27) + att + STRING(L" is missing in tag: ",20) + this->currentTag);
		return this->currentTag->exists(att) ? bool( (this->currentTag->get(att) == STRING(L"true",4) ? bool( true ) : bool( false )) ) : bool( defaultValue );
	}
}


DEFINE_DYNAMIC_FUNC3(HXswfML_obj,getBool,return )

Dynamic HXswfML_obj::getFloat( String att,Dynamic defaultValue,Dynamic __o_required){
bool required = __o_required.Default(false);
{
		if (this->currentTag->exists(att))
			if (Math_obj::isNaN(Std_obj::parseFloat(this->currentTag->get(att))))
			this->error(STRING(L"!ERROR: attribute ",18) + att + STRING(L" must be a number: ",19) + this->currentTag->toString());
		if (required)
			if (!this->currentTag->exists(att))
			this->error(STRING(L"!ERROR: Required attribute ",27) + att + STRING(L" is missing in tag: ",20) + this->currentTag->toString());
		return this->currentTag->exists(att) ? Dynamic( Std_obj::parseFloat(this->currentTag->get(att)) ) : Dynamic( defaultValue );
	}
}


DEFINE_DYNAMIC_FUNC3(HXswfML_obj,getFloat,return )

String HXswfML_obj::getString( String att,String defaultValue,Dynamic __o_required){
bool required = __o_required.Default(false);
{
		if (required)
			if (!this->currentTag->exists(att))
			this->error(STRING(L"!ERROR: Required attribute ",27) + att + STRING(L" is missing in tag: ",20) + this->currentTag->toString());
		return this->currentTag->exists(att) ? String( this->currentTag->get(att) ) : String( defaultValue );
	}
}


DEFINE_DYNAMIC_FUNC3(HXswfML_obj,getString,return )

Dynamic HXswfML_obj::getMatrix( ){
	Dynamic scale;
	Dynamic rotate;
	Dynamic translate;
	Dynamic scaleX = this->getFloat(STRING(L"scaleX",6),null(),null());
	Dynamic scaleY = this->getFloat(STRING(L"scaleY",6),null(),null());
	scale = (bool(scaleX == null()) && bool(scaleY == null())) ? Dynamic( null() ) : Dynamic( hxAnon_obj::Create()->Add( STRING(L"x",1) , scaleX == null() ? Dynamic( 1.0 ) : Dynamic( scaleX ))->Add( STRING(L"y",1) , scaleY == null() ? Dynamic( 1.0 ) : Dynamic( scaleY )) );
	Dynamic rs0 = this->getFloat(STRING(L"rotate0",7),null(),null());
	Dynamic rs1 = this->getFloat(STRING(L"rotate1",7),null(),null());
	rotate = (bool(rs0 == null()) && bool(rs1 == null())) ? Dynamic( null() ) : Dynamic( hxAnon_obj::Create()->Add( STRING(L"rs0",3) , rs0 == null() ? Dynamic( 0.0 ) : Dynamic( rs0 ))->Add( STRING(L"rs1",3) , rs1 == null() ? Dynamic( 0.0 ) : Dynamic( rs1 )) );
	int x = this->getInt(STRING(L"x",1),0,null(),null(),null()) * 20;
	int y = this->getInt(STRING(L"y",1),0,null(),null(),null()) * 20;
	translate = hxAnon_obj::Create()->Add( STRING(L"x",1) , x)->Add( STRING(L"y",1) , y);
	return hxAnon_obj::Create()->Add( STRING(L"scale",5) , scale)->Add( STRING(L"rotate",6) , rotate)->Add( STRING(L"translate",9) , translate);
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,getMatrix,return )

Void HXswfML_obj::checkDictionary( int id){
{
		if (this->strict){
			if (this->dictionary->__get(id) != null()){
				this->error(STRING(L"!ERROR: You are overwriting an existing id: ",44) + id + STRING(L". TAG: ",7) + this->currentTag->toString());
			}
			if (bool(id == 0) && bool(this->currentTag->getNodeName().toLowerCase() != STRING(L"symbolclass",11))){
				this->error(STRING(L"!ERROR: id 0 used outside symbol class. Index 0 can only be used for the SymbolClass tag that references the DefineABC tag which holds your document class/main entry point. Tag: ",178) + this->currentTag->toString());
			}
		}
		this->dictionary[id] = this->currentTag->getNodeName().toLowerCase();
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,checkDictionary,(void))

Void HXswfML_obj::checkTargetId( int id){
{
		if (this->strict){
			if (bool(id != 0) && bool(this->dictionary->__get(id) == null())){
				this->error(STRING(L"!ERROR: The target id ",22) + id + STRING(L" does not exist. TAG: ",22) + this->currentTag->toString());
			}
			else
				if (bool(this->currentTag->getNodeName().toLowerCase() == STRING(L"placeobject",11)) || bool(this->currentTag->getNodeName().toLowerCase() == STRING(L"buttonstate",11))){
				String _switch_13 = (this->dictionary->__get(id));
				if (  ( _switch_13==STRING(L"defineshape",11)) ||  ( _switch_13==STRING(L"definebutton",12)) ||  ( _switch_13==STRING(L"definesprite",12)) ||  ( _switch_13==STRING(L"defineedittext",14))){
				}
				else  {
					this->error(STRING(L"!ERROR: The target id ",22) + id + STRING(L" must be a reference to a DefineShape, DefineButton, DefineSprite or DefineEditText tag. TAG: ",94) + this->currentTag->toString());
				}
;
;
			}
			else
				if (this->currentTag->getNodeName().toLowerCase() == STRING(L"definescalinggrid",17)){
				String _switch_14 = (this->dictionary->__get(id));
				if (  ( _switch_14==STRING(L"definebutton",12)) ||  ( _switch_14==STRING(L"definesprite",12))){
				}
				else  {
					this->error(STRING(L"!ERROR: The target id ",22) + id + STRING(L" must be a reference to a DefineButton or DefineSprite tag. TAG: ",65) + this->currentTag->toString());
				}
;
;
			}
			else
				if (this->currentTag->getNodeName().toLowerCase() == STRING(L"startsound",10)){
				if (this->dictionary->__get(id) != STRING(L"definesound",11)){
					this->error(STRING(L"!ERROR: The target id ",22) + id + STRING(L" must be a reference to a DefineSound tag. TAG: ",48) + this->currentTag->toString());
				}
			}
			else
				if (bool(id != 0) && bool(this->currentTag->getNodeName().toLowerCase() == STRING(L"symbolclass",11))){
				String _switch_15 = (this->dictionary->__get(id));
				if (  ( _switch_15==STRING(L"definebutton",12)) ||  ( _switch_15==STRING(L"definesprite",12)) ||  ( _switch_15==STRING(L"definebinarydata",16)) ||  ( _switch_15==STRING(L"definefont",10)) ||  ( _switch_15==STRING(L"defineabc",9)) ||  ( _switch_15==STRING(L"definesound",11)) ||  ( _switch_15==STRING(L"definebitsjpeg",14))){
				}
				else  {
					this->error(STRING(L"!ERROR: The target id ",22) + id + STRING(L" must be a reference to a DefineButton, DefineSprite, DefineBinaryData, DefineFont, DefineABC, DefineSound or DefineBitsJPEG tag. TAG: ",135) + this->currentTag->toString());
				}
;
;
			}
;
;
;
;
;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,checkTargetId,(void))

Void HXswfML_obj::checkFileExistence( String file){
{
		if (!cpp::FileSystem_obj::exists(file)){
			this->error(STRING(L"!ERROR: File: ",14) + file + STRING(L" could not be found at the given location. TAG: ",48) + this->currentTag->toString());
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,checkFileExistence,(void))

Void HXswfML_obj::setup( ){
{
		this->validChildren = Hash_obj::__new();
		this->validChildren->set(STRING(L"swf",3),Array_obj<String >::__new().Add(STRING(L"header",6)).Add(STRING(L"fileattributes",14)).Add(STRING(L"setbackgroundcolor",18)).Add(STRING(L"scriptlimits",12)).Add(STRING(L"definebitsjpeg",14)).Add(STRING(L"defineshape",11)).Add(STRING(L"definesprite",12)).Add(STRING(L"definebutton",12)).Add(STRING(L"definebinarydata",16)).Add(STRING(L"definesound",11)).Add(STRING(L"definefont",10)).Add(STRING(L"defineedittext",14)).Add(STRING(L"defineabc",9)).Add(STRING(L"definescalinggrid",17)).Add(STRING(L"placeobject",11)).Add(STRING(L"removeobject",12)).Add(STRING(L"startsound",10)).Add(STRING(L"symbolclass",11)).Add(STRING(L"exportassets",12)).Add(STRING(L"metadata",8)).Add(STRING(L"framelabel",10)).Add(STRING(L"showframe",9)).Add(STRING(L"endframe",8)).Add(STRING(L"custom",6)));
		this->validChildren->set(STRING(L"defineshape",11),Array_obj<String >::__new().Add(STRING(L"beginfill",9)).Add(STRING(L"begingradientfill",17)).Add(STRING(L"beginbitmapfill",15)).Add(STRING(L"linestyle",9)).Add(STRING(L"moveto",6)).Add(STRING(L"lineto",6)).Add(STRING(L"curveto",7)).Add(STRING(L"endfill",7)).Add(STRING(L"endline",7)).Add(STRING(L"clear",5)).Add(STRING(L"drawcircle",10)).Add(STRING(L"drawellipse",11)).Add(STRING(L"drawrect",8)).Add(STRING(L"drawroundrect",13)).Add(STRING(L"drawroundrectcomplex",20)).Add(STRING(L"custom",6)));
		this->validChildren->set(STRING(L"definesprite",12),Array_obj<String >::__new().Add(STRING(L"placeobject",11)).Add(STRING(L"removeobject",12)).Add(STRING(L"startsound",10)).Add(STRING(L"framelabel",10)).Add(STRING(L"showframe",9)).Add(STRING(L"endframe",8)).Add(STRING(L"tween",5)).Add(STRING(L"custom",6)));
		this->validChildren->set(STRING(L"definebutton",12),Array_obj<String >::__new().Add(STRING(L"buttonstate",11)).Add(STRING(L"custom",6)));
		this->validChildren->set(STRING(L"tween",5),Array_obj<String >::__new().Add(STRING(L"tw",2)).Add(STRING(L"custom",6)));
		this->validElements = Hash_obj::__new();
		this->validElements->set(STRING(L"swf",3),Array_obj<String >::__new());
		this->validElements->set(STRING(L"header",6),Array_obj<String >::__new().Add(STRING(L"width",5)).Add(STRING(L"height",6)).Add(STRING(L"fps",3)).Add(STRING(L"version",7)).Add(STRING(L"compressed",10)).Add(STRING(L"frameCount",10)));
		this->validElements->set(STRING(L"fileattributes",14),Array_obj<String >::__new().Add(STRING(L"actionscript3",13)).Add(STRING(L"useNetwork",10)).Add(STRING(L"useDirectBlit",13)).Add(STRING(L"useGPU",6)).Add(STRING(L"hasMetaData",11)));
		this->validElements->set(STRING(L"setbackgroundcolor",18),Array_obj<String >::__new().Add(STRING(L"color",5)));
		this->validElements->set(STRING(L"scriptlimits",12),Array_obj<String >::__new().Add(STRING(L"maxRecursionDepth",17)).Add(STRING(L"scriptTimeoutSeconds",20)));
		this->validElements->set(STRING(L"definebitsjpeg",14),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"file",4)));
		this->validElements->set(STRING(L"defineshape",11),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"bitmapId",8)).Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"scaleX",6)).Add(STRING(L"scaleY",6)).Add(STRING(L"rotate0",7)).Add(STRING(L"rotate1",7)).Add(STRING(L"repeat",6)).Add(STRING(L"smooth",6)));
		this->validElements->set(STRING(L"beginfill",9),Array_obj<String >::__new().Add(STRING(L"color",5)).Add(STRING(L"alpha",5)));
		this->validElements->set(STRING(L"begingradientfill",17),Array_obj<String >::__new().Add(STRING(L"colors",6)).Add(STRING(L"alphas",6)).Add(STRING(L"ratios",6)).Add(STRING(L"type",4)).Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"scaleX",6)).Add(STRING(L"scaleY",6)).Add(STRING(L"rotate0",7)).Add(STRING(L"rotate1",7)));
		this->validElements->set(STRING(L"beginbitmapfill",15),Array_obj<String >::__new().Add(STRING(L"bitmapId",8)).Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"scaleX",6)).Add(STRING(L"scaleY",6)).Add(STRING(L"rotate0",7)).Add(STRING(L"rotate1",7)).Add(STRING(L"repeat",6)).Add(STRING(L"smooth",6)));
		this->validElements->set(STRING(L"linestyle",9),Array_obj<String >::__new().Add(STRING(L"width",5)).Add(STRING(L"color",5)).Add(STRING(L"alpha",5)));
		this->validElements->set(STRING(L"moveto",6),Array_obj<String >::__new().Add(STRING(L"x",1)).Add(STRING(L"y",1)));
		this->validElements->set(STRING(L"lineto",6),Array_obj<String >::__new().Add(STRING(L"x",1)).Add(STRING(L"y",1)));
		this->validElements->set(STRING(L"curveto",7),Array_obj<String >::__new().Add(STRING(L"cx",2)).Add(STRING(L"cy",2)).Add(STRING(L"ax",2)).Add(STRING(L"ay",2)));
		this->validElements->set(STRING(L"endfill",7),Array_obj<String >::__new());
		this->validElements->set(STRING(L"endline",7),Array_obj<String >::__new());
		this->validElements->set(STRING(L"clear",5),Array_obj<String >::__new());
		this->validElements->set(STRING(L"drawcircle",10),Array_obj<String >::__new().Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"r",1)).Add(STRING(L"sections",8)));
		this->validElements->set(STRING(L"drawellipse",11),Array_obj<String >::__new().Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"width",5)).Add(STRING(L"height",6)));
		this->validElements->set(STRING(L"drawrect",8),Array_obj<String >::__new().Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"width",5)).Add(STRING(L"height",6)));
		this->validElements->set(STRING(L"drawroundrect",13),Array_obj<String >::__new().Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"width",5)).Add(STRING(L"height",6)).Add(STRING(L"r",1)));
		this->validElements->set(STRING(L"drawroundrectcomplex",20),Array_obj<String >::__new().Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"width",5)).Add(STRING(L"height",6)).Add(STRING(L"rtl",3)).Add(STRING(L"rtr",3)).Add(STRING(L"rbl",3)).Add(STRING(L"rbr",3)));
		this->validElements->set(STRING(L"definesprite",12),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"frameCount",10)));
		this->validElements->set(STRING(L"definebutton",12),Array_obj<String >::__new().Add(STRING(L"id",2)));
		this->validElements->set(STRING(L"buttonstate",11),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"depth",5)).Add(STRING(L"hit",3)).Add(STRING(L"down",4)).Add(STRING(L"over",4)).Add(STRING(L"up",2)).Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"scaleX",6)).Add(STRING(L"scaleY",6)).Add(STRING(L"rotate0",7)).Add(STRING(L"rotate1",7)));
		this->validElements->set(STRING(L"definebinarydata",16),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"file",4)));
		this->validElements->set(STRING(L"definesound",11),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"file",4)));
		this->validElements->set(STRING(L"definefont",10),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"file",4)));
		this->validElements->set(STRING(L"defineedittext",14),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"initialText",11)).Add(STRING(L"fontID",6)).Add(STRING(L"useOutlines",11)).Add(STRING(L"width",5)).Add(STRING(L"height",6)).Add(STRING(L"wordWrap",8)).Add(STRING(L"multiline",9)).Add(STRING(L"password",8)).Add(STRING(L"input",5)).Add(STRING(L"autoSize",8)).Add(STRING(L"selectable",10)).Add(STRING(L"border",6)).Add(STRING(L"wasStatic",9)).Add(STRING(L"html",4)).Add(STRING(L"fontClass",9)).Add(STRING(L"fontHeight",10)).Add(STRING(L"textColor",9)).Add(STRING(L"maxLength",9)).Add(STRING(L"align",5)).Add(STRING(L"leftMargin",10)).Add(STRING(L"rightMargin",11)).Add(STRING(L"indent",6)).Add(STRING(L"leading",7)).Add(STRING(L"variableName",12)).Add(STRING(L"file",4)));
		this->validElements->set(STRING(L"defineabc",9),Array_obj<String >::__new().Add(STRING(L"file",4)).Add(STRING(L"name",4)));
		this->validElements->set(STRING(L"definescalinggrid",17),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"x",1)).Add(STRING(L"width",5)).Add(STRING(L"y",1)).Add(STRING(L"height",6)));
		this->validElements->set(STRING(L"placeobject",11),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"depth",5)).Add(STRING(L"name",4)).Add(STRING(L"move",4)).Add(STRING(L"x",1)).Add(STRING(L"y",1)).Add(STRING(L"scaleX",6)).Add(STRING(L"scaleY",6)).Add(STRING(L"rotate0",7)).Add(STRING(L"rotate1",7)));
		this->validElements->set(STRING(L"removeobject",12),Array_obj<String >::__new().Add(STRING(L"depth",5)));
		this->validElements->set(STRING(L"startsound",10),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"stop",4)).Add(STRING(L"loopCount",9)));
		this->validElements->set(STRING(L"symbolclass",11),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"class",5)).Add(STRING(L"base",4)));
		this->validElements->set(STRING(L"exportassets",12),Array_obj<String >::__new().Add(STRING(L"id",2)).Add(STRING(L"class",5)));
		this->validElements->set(STRING(L"metadata",8),Array_obj<String >::__new().Add(STRING(L"file",4)));
		this->validElements->set(STRING(L"framelabel",10),Array_obj<String >::__new().Add(STRING(L"name",4)).Add(STRING(L"anchor",6)));
		this->validElements->set(STRING(L"showframe",9),Array_obj<String >::__new());
		this->validElements->set(STRING(L"endframe",8),Array_obj<String >::__new());
		this->validElements->set(STRING(L"tween",5),Array_obj<String >::__new().Add(STRING(L"depth",5)).Add(STRING(L"frameCount",10)));
		this->validElements->set(STRING(L"tw",2),Array_obj<String >::__new().Add(STRING(L"prop",4)).Add(STRING(L"start",5)).Add(STRING(L"end",3)));
		this->validElements->set(STRING(L"custom",6),Array_obj<String >::__new().Add(STRING(L"tagId",5)).Add(STRING(L"file",4)).Add(STRING(L"data",4)).Add(STRING(L"comment",7)));
		this->validBaseClasses = Array_obj<String >::__new().Add(STRING(L"flash.display.MovieClip",23)).Add(STRING(L"flash.display.Sprite",20)).Add(STRING(L"flash.display.SimpleButton",26)).Add(STRING(L"flash.display.Bitmap",20)).Add(STRING(L"flash.media.Sound",17)).Add(STRING(L"flash.text.Font",15)).Add(STRING(L"flash.utils.ByteArray",21));
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,setup,(void))

Void HXswfML_obj::checkUnknownAttributes( ){
{
		if (!this->validElements->exists(this->currentTag->getNodeName().toLowerCase()))
			this->error(STRING(L"!ERROR: Unknown tag: ",21) + this->currentTag->getNodeName());
		for(Dynamic __it = this->currentTag->attributes();  __it->__Field(STRING(L"hasNext",7))(); ){
String a = __it->__Field(STRING(L"next",4))();
			{
				if (!this->checkValidAttribute(a)){
					this->error(STRING(L"!ERROR: Unknown attribute: ",27) + a + STRING(L". Valid attributes are: ",24) + this->validElements->get(this->currentTag->getNodeName().toLowerCase()).Cast<Array<String > >()->toString() + STRING(L". TAG: ",7) + this->currentTag->toString());
				}
			}
;
		}
	}
return null();
}


DEFINE_DYNAMIC_FUNC0(HXswfML_obj,checkUnknownAttributes,(void))

bool HXswfML_obj::checkValidAttribute( String a){
	Array<String > validAttributes = this->validElements->get(this->currentTag->getNodeName().toLowerCase()).Cast<Array<String > >();
	{
		int _g = 0;
		while(_g < validAttributes->length){
			String i = validAttributes->__get(_g);
			++_g;
			if (a == i)
				return true;
		}
	}
	return false;
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,checkValidAttribute,return )

bool HXswfML_obj::checkValidBaseClass( String c){
	{
		int _g = 0;
		Array<String > _g1 = this->validBaseClasses;
		while(_g < _g1->length){
			String i = _g1->__get(_g);
			++_g;
			if (c == i)
				return true;
		}
	}
	return false;
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,checkValidBaseClass,return )

String HXswfML_obj::createXML( double mod){
	String xmlString = STRING(L"",0);
	hxAddEq(xmlString,STRING(L"<?xml version=\"1.0\" encoding =\"utf-8\"?>",39));
	hxAddEq(xmlString,STRING(L"<swc xmlns=\"http://www.adobe.com/flash/swccatalog/9\">",53));
	hxAddEq(xmlString,STRING(L"<versions>",10));
	hxAddEq(xmlString,STRING(L"<swc version=\"1.2\"/>",20));
	hxAddEq(xmlString,STRING(L"<haxe version=\"2.04\"/>",22));
	hxAddEq(xmlString,STRING(L"</versions>",11));
	hxAddEq(xmlString,STRING(L"<features>",10));
	hxAddEq(xmlString,STRING(L"<feature-script-deps/>",22));
	hxAddEq(xmlString,STRING(L"<feature-files/>",16));
	hxAddEq(xmlString,STRING(L"</features>",11));
	hxAddEq(xmlString,STRING(L"<libraries>",11));
	hxAddEq(xmlString,STRING(L"<library path=\"library.swf\">",28));
	{
		int _g = 0;
		Array<Array<String > > _g1 = this->swcClasses;
		while(_g < _g1->length){
			Array<String > i = _g1->__get(_g);
			++_g;
			Array<String > dep = i[1].split(STRING(L".",1));
			hxAddEq(xmlString,STRING(L"<script name=\"",14) + i->__get(0) + STRING(L"\" mod=\"0\" >",11));
			hxAddEq(xmlString,STRING(L"<def id=\"",9) + i->__get(0) + STRING(L"\" />",4));
			hxAddEq(xmlString,STRING(L"<dep id=\"",9) + dep->__get(0) + STRING(L".",1) + dep->__get(1) + STRING(L":",1) + dep->__get(2) + STRING(L"\" type=\"i\" />",13));
			hxAddEq(xmlString,STRING(L"<dep id=\"AS3\" type=\"n\" />",25));
			hxAddEq(xmlString,STRING(L"</script>",9));
		}
	}
	hxAddEq(xmlString,STRING(L"</library>",10));
	hxAddEq(xmlString,STRING(L"</libraries>",12));
	hxAddEq(xmlString,STRING(L"<files>",7));
	hxAddEq(xmlString,STRING(L"</files>",8));
	hxAddEq(xmlString,STRING(L"</swc>",6));
	return xmlString;
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,createXML,return )

Void HXswfML_obj::error( String msg){
{
		hxThrow (msg);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,error,(void))

Void HXswfML_obj::inform( String msg){
{
		cpp::Lib_obj::println(msg);
	}
return null();
}


DEFINE_DYNAMIC_FUNC1(HXswfML_obj,inform,(void))


HXswfML_obj::HXswfML_obj()
{
	InitMember(currentTag);
	InitMember(validBaseClasses);
	InitMember(validElements);
	InitMember(validChildren);
	InitMember(swcClasses);
	InitMember(bitmapIds);
	InitMember(dictionary);
	InitMember(strict);
	InitMember(library);
}

void HXswfML_obj::__Mark()
{
	MarkMember(currentTag);
	MarkMember(validBaseClasses);
	MarkMember(validElements);
	MarkMember(validChildren);
	MarkMember(swcClasses);
	MarkMember(bitmapIds);
	MarkMember(dictionary);
	MarkMember(strict);
	MarkMember(library);
}

Dynamic HXswfML_obj::__Field(const String &inName)
{
	switch(inName.length) {
	case 5:
		if (!memcmp(inName.__s,L"tween",sizeof(wchar_t)*5) ) { return tween_dyn(); }
		if (!memcmp(inName.__s,L"setup",sizeof(wchar_t)*5) ) { return setup_dyn(); }
		if (!memcmp(inName.__s,L"error",sizeof(wchar_t)*5) ) { return error_dyn(); }
		break;
	case 6:
		if (!memcmp(inName.__s,L"strict",sizeof(wchar_t)*6) ) { return strict; }
		if (!memcmp(inName.__s,L"header",sizeof(wchar_t)*6) ) { return header_dyn(); }
		if (!memcmp(inName.__s,L"custom",sizeof(wchar_t)*6) ) { return custom_dyn(); }
		if (!memcmp(inName.__s,L"getInt",sizeof(wchar_t)*6) ) { return getInt_dyn(); }
		if (!memcmp(inName.__s,L"inform",sizeof(wchar_t)*6) ) { return inform_dyn(); }
		break;
	case 7:
		if (!memcmp(inName.__s,L"library",sizeof(wchar_t)*7) ) { return library; }
		if (!memcmp(inName.__s,L"xml2swf",sizeof(wchar_t)*7) ) { return xml2swf_dyn(); }
		if (!memcmp(inName.__s,L"getBool",sizeof(wchar_t)*7) ) { return getBool_dyn(); }
		break;
	case 8:
		if (!memcmp(inName.__s,L"metadata",sizeof(wchar_t)*8) ) { return metadata_dyn(); }
		if (!memcmp(inName.__s,L"endFrame",sizeof(wchar_t)*8) ) { return endFrame_dyn(); }
		if (!memcmp(inName.__s,L"getBytes",sizeof(wchar_t)*8) ) { return getBytes_dyn(); }
		if (!memcmp(inName.__s,L"getFloat",sizeof(wchar_t)*8) ) { return getFloat_dyn(); }
		break;
	case 9:
		if (!memcmp(inName.__s,L"bitmapIds",sizeof(wchar_t)*9) ) { return bitmapIds; }
		if (!memcmp(inName.__s,L"createSWF",sizeof(wchar_t)*9) ) { return createSWF_dyn(); }
		if (!memcmp(inName.__s,L"defineABC",sizeof(wchar_t)*9) ) { return defineABC_dyn(); }
		if (!memcmp(inName.__s,L"showFrame",sizeof(wchar_t)*9) ) { return showFrame_dyn(); }
		if (!memcmp(inName.__s,L"createABC",sizeof(wchar_t)*9) ) { return createABC_dyn(); }
		if (!memcmp(inName.__s,L"getString",sizeof(wchar_t)*9) ) { return getString_dyn(); }
		if (!memcmp(inName.__s,L"getMatrix",sizeof(wchar_t)*9) ) { return getMatrix_dyn(); }
		if (!memcmp(inName.__s,L"createXML",sizeof(wchar_t)*9) ) { return createXML_dyn(); }
		break;
	case 10:
		if (!memcmp(inName.__s,L"currentTag",sizeof(wchar_t)*10) ) { return currentTag; }
		if (!memcmp(inName.__s,L"swcClasses",sizeof(wchar_t)*10) ) { return swcClasses; }
		if (!memcmp(inName.__s,L"dictionary",sizeof(wchar_t)*10) ) { return dictionary; }
		if (!memcmp(inName.__s,L"defineFont",sizeof(wchar_t)*10) ) { return defineFont_dyn(); }
		if (!memcmp(inName.__s,L"moveObject",sizeof(wchar_t)*10) ) { return moveObject_dyn(); }
		if (!memcmp(inName.__s,L"startSound",sizeof(wchar_t)*10) ) { return startSound_dyn(); }
		if (!memcmp(inName.__s,L"frameLabel",sizeof(wchar_t)*10) ) { return frameLabel_dyn(); }
		if (!memcmp(inName.__s,L"getContent",sizeof(wchar_t)*10) ) { return getContent_dyn(); }
		break;
	case 11:
		if (!memcmp(inName.__s,L"defineShape",sizeof(wchar_t)*11) ) { return defineShape_dyn(); }
		if (!memcmp(inName.__s,L"defineSound",sizeof(wchar_t)*11) ) { return defineSound_dyn(); }
		if (!memcmp(inName.__s,L"symbolClass",sizeof(wchar_t)*11) ) { return symbolClass_dyn(); }
		break;
	case 12:
		if (!memcmp(inName.__s,L"scriptLimits",sizeof(wchar_t)*12) ) { return scriptLimits_dyn(); }
		if (!memcmp(inName.__s,L"defineSprite",sizeof(wchar_t)*12) ) { return defineSprite_dyn(); }
		if (!memcmp(inName.__s,L"placeObject2",sizeof(wchar_t)*12) ) { return placeObject2_dyn(); }
		if (!memcmp(inName.__s,L"exportAssets",sizeof(wchar_t)*12) ) { return exportAssets_dyn(); }
		break;
	case 13:
		if (!memcmp(inName.__s,L"validElements",sizeof(wchar_t)*13) ) { return validElements; }
		if (!memcmp(inName.__s,L"validChildren",sizeof(wchar_t)*13) ) { return validChildren; }
		if (!memcmp(inName.__s,L"defineButton2",sizeof(wchar_t)*13) ) { return defineButton2_dyn(); }
		if (!memcmp(inName.__s,L"removeObject2",sizeof(wchar_t)*13) ) { return removeObject2_dyn(); }
		if (!memcmp(inName.__s,L"checkTargetId",sizeof(wchar_t)*13) ) { return checkTargetId_dyn(); }
		break;
	case 14:
		if (!memcmp(inName.__s,L"fileAttributes",sizeof(wchar_t)*14) ) { return fileAttributes_dyn(); }
		if (!memcmp(inName.__s,L"defineBitsJPEG",sizeof(wchar_t)*14) ) { return defineBitsJPEG_dyn(); }
		if (!memcmp(inName.__s,L"defineEditText",sizeof(wchar_t)*14) ) { return defineEditText_dyn(); }
		break;
	case 15:
		if (!memcmp(inName.__s,L"checkDictionary",sizeof(wchar_t)*15) ) { return checkDictionary_dyn(); }
		break;
	case 16:
		if (!memcmp(inName.__s,L"validBaseClasses",sizeof(wchar_t)*16) ) { return validBaseClasses; }
		if (!memcmp(inName.__s,L"defineBinaryData",sizeof(wchar_t)*16) ) { return defineBinaryData_dyn(); }
		if (!memcmp(inName.__s,L"storeWidthHeight",sizeof(wchar_t)*16) ) { return storeWidthHeight_dyn(); }
		break;
	case 17:
		if (!memcmp(inName.__s,L"defineScalingGrid",sizeof(wchar_t)*17) ) { return defineScalingGrid_dyn(); }
		break;
	case 18:
		if (!memcmp(inName.__s,L"setBackgroundColor",sizeof(wchar_t)*18) ) { return setBackgroundColor_dyn(); }
		if (!memcmp(inName.__s,L"checkFileExistence",sizeof(wchar_t)*18) ) { return checkFileExistence_dyn(); }
		break;
	case 19:
		if (!memcmp(inName.__s,L"checkValidAttribute",sizeof(wchar_t)*19) ) { return checkValidAttribute_dyn(); }
		if (!memcmp(inName.__s,L"checkValidBaseClass",sizeof(wchar_t)*19) ) { return checkValidBaseClass_dyn(); }
		break;
	case 22:
		if (!memcmp(inName.__s,L"checkUnknownAttributes",sizeof(wchar_t)*22) ) { return checkUnknownAttributes_dyn(); }
	}
	return super::__Field(inName);
}

static int __id_currentTag = __hxcpp_field_to_id("currentTag");
static int __id_validBaseClasses = __hxcpp_field_to_id("validBaseClasses");
static int __id_validElements = __hxcpp_field_to_id("validElements");
static int __id_validChildren = __hxcpp_field_to_id("validChildren");
static int __id_swcClasses = __hxcpp_field_to_id("swcClasses");
static int __id_bitmapIds = __hxcpp_field_to_id("bitmapIds");
static int __id_dictionary = __hxcpp_field_to_id("dictionary");
static int __id_strict = __hxcpp_field_to_id("strict");
static int __id_library = __hxcpp_field_to_id("library");
static int __id_xml2swf = __hxcpp_field_to_id("xml2swf");
static int __id_createSWF = __hxcpp_field_to_id("createSWF");
static int __id_header = __hxcpp_field_to_id("header");
static int __id_fileAttributes = __hxcpp_field_to_id("fileAttributes");
static int __id_setBackgroundColor = __hxcpp_field_to_id("setBackgroundColor");
static int __id_scriptLimits = __hxcpp_field_to_id("scriptLimits");
static int __id_defineBitsJPEG = __hxcpp_field_to_id("defineBitsJPEG");
static int __id_defineShape = __hxcpp_field_to_id("defineShape");
static int __id_defineSprite = __hxcpp_field_to_id("defineSprite");
static int __id_defineButton2 = __hxcpp_field_to_id("defineButton2");
static int __id_defineSound = __hxcpp_field_to_id("defineSound");
static int __id_defineBinaryData = __hxcpp_field_to_id("defineBinaryData");
static int __id_defineFont = __hxcpp_field_to_id("defineFont");
static int __id_defineEditText = __hxcpp_field_to_id("defineEditText");
static int __id_defineABC = __hxcpp_field_to_id("defineABC");
static int __id_defineScalingGrid = __hxcpp_field_to_id("defineScalingGrid");
static int __id_placeObject2 = __hxcpp_field_to_id("placeObject2");
static int __id_moveObject = __hxcpp_field_to_id("moveObject");
static int __id_tween = __hxcpp_field_to_id("tween");
static int __id_removeObject2 = __hxcpp_field_to_id("removeObject2");
static int __id_startSound = __hxcpp_field_to_id("startSound");
static int __id_symbolClass = __hxcpp_field_to_id("symbolClass");
static int __id_exportAssets = __hxcpp_field_to_id("exportAssets");
static int __id_metadata = __hxcpp_field_to_id("metadata");
static int __id_frameLabel = __hxcpp_field_to_id("frameLabel");
static int __id_showFrame = __hxcpp_field_to_id("showFrame");
static int __id_endFrame = __hxcpp_field_to_id("endFrame");
static int __id_custom = __hxcpp_field_to_id("custom");
static int __id_storeWidthHeight = __hxcpp_field_to_id("storeWidthHeight");
static int __id_createABC = __hxcpp_field_to_id("createABC");
static int __id_getContent = __hxcpp_field_to_id("getContent");
static int __id_getBytes = __hxcpp_field_to_id("getBytes");
static int __id_getInt = __hxcpp_field_to_id("getInt");
static int __id_getBool = __hxcpp_field_to_id("getBool");
static int __id_getFloat = __hxcpp_field_to_id("getFloat");
static int __id_getString = __hxcpp_field_to_id("getString");
static int __id_getMatrix = __hxcpp_field_to_id("getMatrix");
static int __id_checkDictionary = __hxcpp_field_to_id("checkDictionary");
static int __id_checkTargetId = __hxcpp_field_to_id("checkTargetId");
static int __id_checkFileExistence = __hxcpp_field_to_id("checkFileExistence");
static int __id_setup = __hxcpp_field_to_id("setup");
static int __id_checkUnknownAttributes = __hxcpp_field_to_id("checkUnknownAttributes");
static int __id_checkValidAttribute = __hxcpp_field_to_id("checkValidAttribute");
static int __id_checkValidBaseClass = __hxcpp_field_to_id("checkValidBaseClass");
static int __id_createXML = __hxcpp_field_to_id("createXML");
static int __id_error = __hxcpp_field_to_id("error");
static int __id_inform = __hxcpp_field_to_id("inform");


Dynamic HXswfML_obj::__IField(int inFieldID)
{
	if (inFieldID==__id_currentTag) return currentTag;
	if (inFieldID==__id_validBaseClasses) return validBaseClasses;
	if (inFieldID==__id_validElements) return validElements;
	if (inFieldID==__id_validChildren) return validChildren;
	if (inFieldID==__id_swcClasses) return swcClasses;
	if (inFieldID==__id_bitmapIds) return bitmapIds;
	if (inFieldID==__id_dictionary) return dictionary;
	if (inFieldID==__id_strict) return strict;
	if (inFieldID==__id_library) return library;
	if (inFieldID==__id_xml2swf) return xml2swf_dyn();
	if (inFieldID==__id_createSWF) return createSWF_dyn();
	if (inFieldID==__id_header) return header_dyn();
	if (inFieldID==__id_fileAttributes) return fileAttributes_dyn();
	if (inFieldID==__id_setBackgroundColor) return setBackgroundColor_dyn();
	if (inFieldID==__id_scriptLimits) return scriptLimits_dyn();
	if (inFieldID==__id_defineBitsJPEG) return defineBitsJPEG_dyn();
	if (inFieldID==__id_defineShape) return defineShape_dyn();
	if (inFieldID==__id_defineSprite) return defineSprite_dyn();
	if (inFieldID==__id_defineButton2) return defineButton2_dyn();
	if (inFieldID==__id_defineSound) return defineSound_dyn();
	if (inFieldID==__id_defineBinaryData) return defineBinaryData_dyn();
	if (inFieldID==__id_defineFont) return defineFont_dyn();
	if (inFieldID==__id_defineEditText) return defineEditText_dyn();
	if (inFieldID==__id_defineABC) return defineABC_dyn();
	if (inFieldID==__id_defineScalingGrid) return defineScalingGrid_dyn();
	if (inFieldID==__id_placeObject2) return placeObject2_dyn();
	if (inFieldID==__id_moveObject) return moveObject_dyn();
	if (inFieldID==__id_tween) return tween_dyn();
	if (inFieldID==__id_removeObject2) return removeObject2_dyn();
	if (inFieldID==__id_startSound) return startSound_dyn();
	if (inFieldID==__id_symbolClass) return symbolClass_dyn();
	if (inFieldID==__id_exportAssets) return exportAssets_dyn();
	if (inFieldID==__id_metadata) return metadata_dyn();
	if (inFieldID==__id_frameLabel) return frameLabel_dyn();
	if (inFieldID==__id_showFrame) return showFrame_dyn();
	if (inFieldID==__id_endFrame) return endFrame_dyn();
	if (inFieldID==__id_custom) return custom_dyn();
	if (inFieldID==__id_storeWidthHeight) return storeWidthHeight_dyn();
	if (inFieldID==__id_createABC) return createABC_dyn();
	if (inFieldID==__id_getContent) return getContent_dyn();
	if (inFieldID==__id_getBytes) return getBytes_dyn();
	if (inFieldID==__id_getInt) return getInt_dyn();
	if (inFieldID==__id_getBool) return getBool_dyn();
	if (inFieldID==__id_getFloat) return getFloat_dyn();
	if (inFieldID==__id_getString) return getString_dyn();
	if (inFieldID==__id_getMatrix) return getMatrix_dyn();
	if (inFieldID==__id_checkDictionary) return checkDictionary_dyn();
	if (inFieldID==__id_checkTargetId) return checkTargetId_dyn();
	if (inFieldID==__id_checkFileExistence) return checkFileExistence_dyn();
	if (inFieldID==__id_setup) return setup_dyn();
	if (inFieldID==__id_checkUnknownAttributes) return checkUnknownAttributes_dyn();
	if (inFieldID==__id_checkValidAttribute) return checkValidAttribute_dyn();
	if (inFieldID==__id_checkValidBaseClass) return checkValidBaseClass_dyn();
	if (inFieldID==__id_createXML) return createXML_dyn();
	if (inFieldID==__id_error) return error_dyn();
	if (inFieldID==__id_inform) return inform_dyn();
	return super::__IField(inFieldID);
}

Dynamic HXswfML_obj::__SetField(const String &inName,const Dynamic &inValue)
{
	switch(inName.length) {
	case 6:
		if (!memcmp(inName.__s,L"strict",sizeof(wchar_t)*6) ) { strict=inValue.Cast<bool >();return inValue; }
		break;
	case 7:
		if (!memcmp(inName.__s,L"library",sizeof(wchar_t)*7) ) { library=inValue.Cast<Hash >();return inValue; }
		break;
	case 9:
		if (!memcmp(inName.__s,L"bitmapIds",sizeof(wchar_t)*9) ) { bitmapIds=inValue.Cast<Array<Array<int > > >();return inValue; }
		break;
	case 10:
		if (!memcmp(inName.__s,L"currentTag",sizeof(wchar_t)*10) ) { currentTag=inValue.Cast<cpp::CppXml__ >();return inValue; }
		if (!memcmp(inName.__s,L"swcClasses",sizeof(wchar_t)*10) ) { swcClasses=inValue.Cast<Array<Array<String > > >();return inValue; }
		if (!memcmp(inName.__s,L"dictionary",sizeof(wchar_t)*10) ) { dictionary=inValue.Cast<Array<String > >();return inValue; }
		break;
	case 13:
		if (!memcmp(inName.__s,L"validElements",sizeof(wchar_t)*13) ) { validElements=inValue.Cast<Hash >();return inValue; }
		if (!memcmp(inName.__s,L"validChildren",sizeof(wchar_t)*13) ) { validChildren=inValue.Cast<Hash >();return inValue; }
		break;
	case 16:
		if (!memcmp(inName.__s,L"validBaseClasses",sizeof(wchar_t)*16) ) { validBaseClasses=inValue.Cast<Array<String > >();return inValue; }
	}
	return super::__SetField(inName,inValue);
}

void HXswfML_obj::__GetFields(Array<String> &outFields)
{
	outFields->push(STRING(L"currentTag",10));
	outFields->push(STRING(L"validBaseClasses",16));
	outFields->push(STRING(L"validElements",13));
	outFields->push(STRING(L"validChildren",13));
	outFields->push(STRING(L"swcClasses",10));
	outFields->push(STRING(L"bitmapIds",9));
	outFields->push(STRING(L"dictionary",10));
	outFields->push(STRING(L"strict",6));
	outFields->push(STRING(L"library",7));
	super::__GetFields(outFields);
};

static String sStaticFields[] = {
	String(null()) };

static String sMemberFields[] = {
	STRING(L"currentTag",10),
	STRING(L"validBaseClasses",16),
	STRING(L"validElements",13),
	STRING(L"validChildren",13),
	STRING(L"swcClasses",10),
	STRING(L"bitmapIds",9),
	STRING(L"dictionary",10),
	STRING(L"strict",6),
	STRING(L"library",7),
	STRING(L"xml2swf",7),
	STRING(L"createSWF",9),
	STRING(L"header",6),
	STRING(L"fileAttributes",14),
	STRING(L"setBackgroundColor",18),
	STRING(L"scriptLimits",12),
	STRING(L"defineBitsJPEG",14),
	STRING(L"defineShape",11),
	STRING(L"defineSprite",12),
	STRING(L"defineButton2",13),
	STRING(L"defineSound",11),
	STRING(L"defineBinaryData",16),
	STRING(L"defineFont",10),
	STRING(L"defineEditText",14),
	STRING(L"defineABC",9),
	STRING(L"defineScalingGrid",17),
	STRING(L"placeObject2",12),
	STRING(L"moveObject",10),
	STRING(L"tween",5),
	STRING(L"removeObject2",13),
	STRING(L"startSound",10),
	STRING(L"symbolClass",11),
	STRING(L"exportAssets",12),
	STRING(L"metadata",8),
	STRING(L"frameLabel",10),
	STRING(L"showFrame",9),
	STRING(L"endFrame",8),
	STRING(L"custom",6),
	STRING(L"storeWidthHeight",16),
	STRING(L"createABC",9),
	STRING(L"getContent",10),
	STRING(L"getBytes",8),
	STRING(L"getInt",6),
	STRING(L"getBool",7),
	STRING(L"getFloat",8),
	STRING(L"getString",9),
	STRING(L"getMatrix",9),
	STRING(L"checkDictionary",15),
	STRING(L"checkTargetId",13),
	STRING(L"checkFileExistence",18),
	STRING(L"setup",5),
	STRING(L"checkUnknownAttributes",22),
	STRING(L"checkValidAttribute",19),
	STRING(L"checkValidBaseClass",19),
	STRING(L"createXML",9),
	STRING(L"error",5),
	STRING(L"inform",6),
	String(null()) };

static void sMarkStatics() {
};

Class HXswfML_obj::__mClass;

void HXswfML_obj::__register()
{
	Static(__mClass) = RegisterClass(STRING(L"be.haxer.hxswfml.HXswfML",24), TCanCast<HXswfML_obj> ,sStaticFields,sMemberFields,
	&__CreateEmpty, &__Create,
	&super::__SGetClass(), 0, sMarkStatics);
}

void HXswfML_obj::__boot()
{
}

} // end namespace be
} // end namespace haxer
} // end namespace hxswfml
