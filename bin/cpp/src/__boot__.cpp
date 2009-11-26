#include <hxObject.h>

#include <StringTools.h>
#include <format/tools/BitsOutput.h>
#include <be/haxer/hxgraphix/HxGraphix.h>
#include <haxe/io/Bytes.h>
#include <haxe/io/BytesOutput.h>
#include <haxe/io/Error.h>
#include <be/haxer/hxswfml/Main.h>
#include <format/tools/Adler32.h>
#include <format/swf/Tools.h>
#include <format/zip/Writer.h>
#include <Std.h>
#include <cpp/CppDate__.h>
#include <format/swf/Reader.h>
#include <Hash.h>
#include <format/abc/OpWriter.h>
#include <haxe/Log.h>
#include <cpp/io/File.h>
#include <cpp/io/FileSeek.h>
#include <format/abc/Context.h>
#include <format/abc/_Context/NullOutput.h>
#include <format/tools/CRC32.h>
#include <format/tools/Deflate.h>
#include <format/mp3/Writer.h>
#include <be/haxer/hxswfml/HXswfML.h>
#include <format/tools/IO.h>
#include <format/abc/Writer.h>
#include <StringBuf.h>
#include <format/zip/ExtraField.h>
#include <IntHash.h>
#include <cpp/io/FileOutput.h>
#include <haxe/io/Output.h>
#include <Type.h>
#include <ValueType.h>
#include <format/mp3/Emphasis.h>
#include <format/mp3/ChannelMode.h>
#include <format/mp3/Layer.h>
#include <format/mp3/MPEGVersion.h>
#include <format/tools/Inflate.h>
#include <IntIter.h>
#include <format/tools/HuffTools.h>
#include <format/tools/Huffman.h>
#include <format/abc/Operation.h>
#include <format/abc/JumpStyle.h>
#include <format/abc/OpCode.h>
#include <format/abc/ABCData.h>
#include <format/abc/FieldKind.h>
#include <format/abc/MethodKind.h>
#include <format/abc/Value.h>
#include <format/abc/Name.h>
#include <format/abc/Namespace.h>
#include <format/abc/Index.h>
#include <format/swf/Writer.h>
#include <format/mp3/CEmphasis.h>
#include <format/mp3/CChannelMode.h>
#include <format/mp3/CLayer.h>
#include <format/mp3/MPEG.h>
#include <format/mp3/Bitrate.h>
#include <format/mp3/SamplingRate.h>
#include <Reflect.h>
#include <haxe/io/Eof.h>
#include <haxe/io/BytesInput.h>
#include <format/mp3/Tools.h>
#include <cpp/Sys.h>
#include <cpp/io/FileInput.h>
#include <haxe/io/Input.h>
#include <List.h>
#include <cpp/FileSystem.h>
#include <cpp/FileKind.h>
#include <format/swf/Emphasis.h>
#include <format/swf/ChannelMode.h>
#include <format/swf/Layer.h>
#include <format/swf/SamplingRate.h>
#include <format/swf/Bitrate.h>
#include <format/swf/MPEGVersion.h>
#include <format/swf/LangCode.h>
#include <format/swf/FontInfoData.h>
#include <format/swf/FontData.h>
#include <format/swf/SoundRate.h>
#include <format/swf/SoundFormat.h>
#include <format/swf/SoundData.h>
#include <format/swf/VideoData.h>
#include <format/swf/ColorModel.h>
#include <format/swf/JPEGData.h>
#include <format/swf/Filter.h>
#include <format/swf/BlendMode.h>
#include <format/swf/InterpolationMode.h>
#include <format/swf/SpreadMode.h>
#include <format/swf/GradRecord.h>
#include <format/swf/LS2Fill.h>
#include <format/swf/LineJoinStyle.h>
#include <format/swf/LineCapStyle.h>
#include <format/swf/LineStyleData.h>
#include <format/swf/FillStyle.h>
#include <format/swf/ShapeRecord.h>
#include <format/swf/Morph2LineStyle.h>
#include <format/swf/MorphFillStyle.h>
#include <format/swf/MorphShapeData.h>
#include <format/swf/ShapeData.h>
#include <format/swf/PlaceObject.h>
#include <format/swf/SWFTag.h>
#include <format/mp3/Reader.h>
#include <format/mp3/FrameType.h>
#include <format/tools/BitsInput.h>
#include <cpp/CppXml__.h>
#include <cpp/Lib.h>
#include <format/tools/InflateImpl.h>
#include <format/tools/_InflateImpl/State.h>
#include <format/tools/_InflateImpl/Window.h>
#include <haxe/io/BytesBuffer.h>
#include <format/swf/FillStyleTypeId.h>
#include <format/swf/TagId.h>

void __boot_all()
{
RegisterResources( GetResources() );
StringTools_obj::__register();
format::tools::BitsOutput_obj::__register();
be::haxer::hxgraphix::HxGraphix_obj::__register();
haxe::io::Bytes_obj::__register();
haxe::io::BytesOutput_obj::__register();
haxe::io::Error_obj::__register();
be::haxer::hxswfml::Main_obj::__register();
format::tools::Adler32_obj::__register();
format::swf::Tools_obj::__register();
format::zip::Writer_obj::__register();
Std_obj::__register();
cpp::CppDate___obj::__register();
format::swf::Reader_obj::__register();
Hash_obj::__register();
format::abc::OpWriter_obj::__register();
haxe::Log_obj::__register();
cpp::io::File_obj::__register();
cpp::io::FileSeek_obj::__register();
format::abc::Context_obj::__register();
format::abc::_Context::NullOutput_obj::__register();
format::tools::CRC32_obj::__register();
format::tools::Deflate_obj::__register();
format::mp3::Writer_obj::__register();
be::haxer::hxswfml::HXswfML_obj::__register();
format::tools::IO_obj::__register();
format::abc::Writer_obj::__register();
StringBuf_obj::__register();
format::zip::ExtraField_obj::__register();
IntHash_obj::__register();
cpp::io::FileOutput_obj::__register();
haxe::io::Output_obj::__register();
Type_obj::__register();
ValueType_obj::__register();
format::mp3::Emphasis_obj::__register();
format::mp3::ChannelMode_obj::__register();
format::mp3::Layer_obj::__register();
format::mp3::MPEGVersion_obj::__register();
format::tools::Inflate_obj::__register();
IntIter_obj::__register();
format::tools::HuffTools_obj::__register();
format::tools::Huffman_obj::__register();
format::abc::Operation_obj::__register();
format::abc::JumpStyle_obj::__register();
format::abc::OpCode_obj::__register();
format::abc::ABCData_obj::__register();
format::abc::FieldKind_obj::__register();
format::abc::MethodKind_obj::__register();
format::abc::Value_obj::__register();
format::abc::Name_obj::__register();
format::abc::Namespace_obj::__register();
format::abc::Index_obj::__register();
format::swf::Writer_obj::__register();
format::mp3::CEmphasis_obj::__register();
format::mp3::CChannelMode_obj::__register();
format::mp3::CLayer_obj::__register();
format::mp3::MPEG_obj::__register();
format::mp3::Bitrate_obj::__register();
format::mp3::SamplingRate_obj::__register();
Reflect_obj::__register();
haxe::io::Eof_obj::__register();
haxe::io::BytesInput_obj::__register();
format::mp3::Tools_obj::__register();
cpp::Sys_obj::__register();
cpp::io::FileInput_obj::__register();
haxe::io::Input_obj::__register();
List_obj::__register();
cpp::FileSystem_obj::__register();
cpp::FileKind_obj::__register();
format::swf::Emphasis_obj::__register();
format::swf::ChannelMode_obj::__register();
format::swf::Layer_obj::__register();
format::swf::SamplingRate_obj::__register();
format::swf::Bitrate_obj::__register();
format::swf::MPEGVersion_obj::__register();
format::swf::LangCode_obj::__register();
format::swf::FontInfoData_obj::__register();
format::swf::FontData_obj::__register();
format::swf::SoundRate_obj::__register();
format::swf::SoundFormat_obj::__register();
format::swf::SoundData_obj::__register();
format::swf::VideoData_obj::__register();
format::swf::ColorModel_obj::__register();
format::swf::JPEGData_obj::__register();
format::swf::Filter_obj::__register();
format::swf::BlendMode_obj::__register();
format::swf::InterpolationMode_obj::__register();
format::swf::SpreadMode_obj::__register();
format::swf::GradRecord_obj::__register();
format::swf::LS2Fill_obj::__register();
format::swf::LineJoinStyle_obj::__register();
format::swf::LineCapStyle_obj::__register();
format::swf::LineStyleData_obj::__register();
format::swf::FillStyle_obj::__register();
format::swf::ShapeRecord_obj::__register();
format::swf::Morph2LineStyle_obj::__register();
format::swf::MorphFillStyle_obj::__register();
format::swf::MorphShapeData_obj::__register();
format::swf::ShapeData_obj::__register();
format::swf::PlaceObject_obj::__register();
format::swf::SWFTag_obj::__register();
format::mp3::Reader_obj::__register();
format::mp3::FrameType_obj::__register();
format::tools::BitsInput_obj::__register();
cpp::CppXml___obj::__register();
cpp::Lib_obj::__register();
format::tools::InflateImpl_obj::__register();
format::tools::_InflateImpl::State_obj::__register();
format::tools::_InflateImpl::Window_obj::__register();
haxe::io::BytesBuffer_obj::__register();
format::swf::FillStyleTypeId_obj::__register();
format::swf::TagId_obj::__register();
cpp::CppXml___obj::__init__();
Std_obj::__init__();
format::swf::TagId_obj::__boot();
format::swf::FillStyleTypeId_obj::__boot();
haxe::io::BytesBuffer_obj::__boot();
format::tools::_InflateImpl::Window_obj::__boot();
format::tools::_InflateImpl::State_obj::__boot();
format::tools::InflateImpl_obj::__boot();
cpp::Lib_obj::__boot();
cpp::CppXml___obj::__boot();
format::tools::BitsInput_obj::__boot();
format::mp3::FrameType_obj::__boot();
format::mp3::Reader_obj::__boot();
format::swf::SWFTag_obj::__boot();
format::swf::PlaceObject_obj::__boot();
format::swf::ShapeData_obj::__boot();
format::swf::MorphShapeData_obj::__boot();
format::swf::MorphFillStyle_obj::__boot();
format::swf::Morph2LineStyle_obj::__boot();
format::swf::ShapeRecord_obj::__boot();
format::swf::FillStyle_obj::__boot();
format::swf::LineStyleData_obj::__boot();
format::swf::LineCapStyle_obj::__boot();
format::swf::LineJoinStyle_obj::__boot();
format::swf::LS2Fill_obj::__boot();
format::swf::GradRecord_obj::__boot();
format::swf::SpreadMode_obj::__boot();
format::swf::InterpolationMode_obj::__boot();
format::swf::BlendMode_obj::__boot();
format::swf::Filter_obj::__boot();
format::swf::JPEGData_obj::__boot();
format::swf::ColorModel_obj::__boot();
format::swf::VideoData_obj::__boot();
format::swf::SoundData_obj::__boot();
format::swf::SoundFormat_obj::__boot();
format::swf::SoundRate_obj::__boot();
format::swf::FontData_obj::__boot();
format::swf::FontInfoData_obj::__boot();
format::swf::LangCode_obj::__boot();
format::swf::MPEGVersion_obj::__boot();
format::swf::Bitrate_obj::__boot();
format::swf::SamplingRate_obj::__boot();
format::swf::Layer_obj::__boot();
format::swf::ChannelMode_obj::__boot();
format::swf::Emphasis_obj::__boot();
cpp::FileKind_obj::__boot();
cpp::FileSystem_obj::__boot();
List_obj::__boot();
haxe::io::Input_obj::__boot();
cpp::io::FileInput_obj::__boot();
cpp::Sys_obj::__boot();
format::mp3::Tools_obj::__boot();
haxe::io::BytesInput_obj::__boot();
haxe::io::Eof_obj::__boot();
Reflect_obj::__boot();
format::mp3::SamplingRate_obj::__boot();
format::mp3::Bitrate_obj::__boot();
format::mp3::MPEG_obj::__boot();
format::mp3::CLayer_obj::__boot();
format::mp3::CChannelMode_obj::__boot();
format::mp3::CEmphasis_obj::__boot();
format::swf::Writer_obj::__boot();
format::abc::Index_obj::__boot();
format::abc::Namespace_obj::__boot();
format::abc::Name_obj::__boot();
format::abc::Value_obj::__boot();
format::abc::MethodKind_obj::__boot();
format::abc::FieldKind_obj::__boot();
format::abc::ABCData_obj::__boot();
format::abc::OpCode_obj::__boot();
format::abc::JumpStyle_obj::__boot();
format::abc::Operation_obj::__boot();
format::tools::Huffman_obj::__boot();
format::tools::HuffTools_obj::__boot();
IntIter_obj::__boot();
format::tools::Inflate_obj::__boot();
format::mp3::MPEGVersion_obj::__boot();
format::mp3::Layer_obj::__boot();
format::mp3::ChannelMode_obj::__boot();
format::mp3::Emphasis_obj::__boot();
ValueType_obj::__boot();
Type_obj::__boot();
haxe::io::Output_obj::__boot();
cpp::io::FileOutput_obj::__boot();
IntHash_obj::__boot();
format::zip::ExtraField_obj::__boot();
StringBuf_obj::__boot();
format::abc::Writer_obj::__boot();
format::tools::IO_obj::__boot();
be::haxer::hxswfml::HXswfML_obj::__boot();
format::mp3::Writer_obj::__boot();
format::tools::Deflate_obj::__boot();
format::tools::CRC32_obj::__boot();
format::abc::_Context::NullOutput_obj::__boot();
format::abc::Context_obj::__boot();
cpp::io::FileSeek_obj::__boot();
cpp::io::File_obj::__boot();
haxe::Log_obj::__boot();
format::abc::OpWriter_obj::__boot();
Hash_obj::__boot();
format::swf::Reader_obj::__boot();
cpp::CppDate___obj::__boot();
Std_obj::__boot();
format::zip::Writer_obj::__boot();
format::swf::Tools_obj::__boot();
format::tools::Adler32_obj::__boot();
be::haxer::hxswfml::Main_obj::__boot();
haxe::io::Error_obj::__boot();
haxe::io::BytesOutput_obj::__boot();
haxe::io::Bytes_obj::__boot();
be::haxer::hxgraphix::HxGraphix_obj::__boot();
format::tools::BitsOutput_obj::__boot();
StringTools_obj::__boot();
}

